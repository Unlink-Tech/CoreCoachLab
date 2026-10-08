<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\PhoneNumber;
use App\Services\SmsSender;
use App\Services\VerificationCode;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;

class ForgotPasswordController extends Controller
{
    /*
    | Forgot password, by email or by phone number.
    |
    | Email: Laravel's reset-link flow (SendsPasswordResetEmails, then ResetPasswordController).
    | Phone: an SMS code (5 minutes) proves the number; the user then sets a new password here.
    */

    use SendsPasswordResetEmails;

    private const SMS_TTL_MINUTES = 5;
    /** Minutes the user has to choose a new password after the SMS code is accepted. */
    private const MOBILE_RESET_WINDOW_MINUTES = 15;

    public function showLinkRequestForm()
    {
        return view('frontend.pages.forget-pwd-form');
    }

    /**
     * Email the reset link. Overrides the trait method, whose local copy in vendor/ was edited to
     * require a captcha and to only say "contact admin" instead of sending anything.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email'], ['email.required' => 'Email is required']);

        try {
            // Same SMTP timeout cap as the registration code email (see FrontendController).
            config(['mail.mailers.smtp.timeout' => 10]);
            app('mail.manager')->purge('smtp');
            $response = $this->broker()->sendResetLink($request->only('email'));
        } catch (\Throwable $e) {
            \Log::error('Password reset email failed: ' . $e->getMessage());
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'We could not send the email right now. Please try again shortly.']);
        }

        if ($response === Password::RESET_LINK_SENT) {
            return back()->with('status', 'We have emailed your password reset link. Please check your inbox.');
        }

        return back()->withInput($request->only('email'))->withErrors(['email' => trans($response)]);
    }

    public function showMobileForm()
    {
        return view('frontend.pages.forget-pwd-mobile');
    }

    /** "Send SMS Code" on the phone form (JSON). */
    public function sendMobileCode(Request $request, SmsSender $sms)
    {
        $user = PhoneNumber::findUser($request->input('phone_code'), $request->input('phone'));
        if (!$user) {
            return response()->json(['ok' => false, 'field' => 'phone', 'message' => 'No account is registered with this phone number'], 422);
        }
        if (!$sms->available()) {
            return response()->json(['ok' => false, 'field' => 'code', 'message' => 'Password reset by phone is not available yet. Please reset with your email address.'], 503);
        }

        // One request per 60s per session (the button's countdown) and 6 per hour per IP.
        $sessionKey = 'reset-sms:' . $request->session()->getId();
        $ipKey = 'reset-sms-ip:' . $request->ip();
        if (RateLimiter::tooManyAttempts($sessionKey, 1) || RateLimiter::tooManyAttempts($ipKey, 6)) {
            $wait = max(RateLimiter::availableIn($sessionKey), RateLimiter::tooManyAttempts($ipKey, 6) ? RateLimiter::availableIn($ipKey) : 0);
            return response()->json(['ok' => false, 'field' => 'code', 'message' => 'Please wait ' . $wait . 's before requesting another code'], 429);
        }
        RateLimiter::hit($sessionKey, 60);
        RateLimiter::hit($ipKey, 3600);

        $phone = PhoneNumber::normalize($request->input('phone_code'), $request->input('phone'));
        $code = VerificationCode::issue($request, 'reset_sms_code', 'user:' . $user->id, self::SMS_TTL_MINUTES);
        if (!$sms->send($phone, 'Your Venture Asia password reset code is ' . $code . '. It expires in ' . self::SMS_TTL_MINUTES . ' minutes.')) {
            VerificationCode::forget($request, 'reset_sms_code');
            return response()->json(['ok' => false, 'field' => 'code', 'message' => 'We could not send the code right now. Please try again shortly.'], 503);
        }

        return response()->json(['ok' => true]);
    }

    /** Submit on the phone form: check the SMS code, then continue to "set a new password". */
    public function verifyMobileCode(Request $request)
    {
        $request->validate([
            'phone_code' => ['required', 'regex:/^\+\d{1,4}$/'],
            'phone' => 'required|string|max:20',
            'code' => 'required|digits:6',
        ], [
            'phone.required' => 'Phone number is required',
            'code.required' => 'SMS code is required',
            'code.digits' => 'The SMS code has 6 digits',
        ]);

        $user = PhoneNumber::findUser($request->input('phone_code'), $request->input('phone'));
        if (!$user) {
            return back()->withErrors(['phone' => 'No account is registered with this phone number'])->withInput();
        }
        if ($error = VerificationCode::check($request, 'reset_sms_code', 'user:' . $user->id, (string) $request->input('code'))) {
            return back()->withErrors(['code' => $error])->withInput();
        }

        VerificationCode::forget($request, 'reset_sms_code');
        $request->session()->put('mobile_password_reset', [
            'user_id' => $user->id,
            'expires_at' => now()->addMinutes(self::MOBILE_RESET_WINDOW_MINUTES)->timestamp,
        ]);

        return redirect()->route('password.mobile.reset');
    }

    public function showMobileResetForm(Request $request)
    {
        if (!$this->mobileResetUser($request)) {
            return redirect()->route('password.request.mobile')
                ->withErrors(['code' => 'Please verify your phone number first']);
        }

        return view('frontend.pages.forget-pwd-new');
    }

    public function resetWithMobile(Request $request)
    {
        $user = $this->mobileResetUser($request);
        if (!$user) {
            return redirect()->route('password.request.mobile')
                ->withErrors(['code' => 'Your verification has expired. Please request a new SMS code']);
        }

        // Same password rule as registration.
        $request->validate([
            'password' => ['required', 'string', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};\':"\\\\|,.<>\/?]).{8,15}$/'],
        ], [
            'password.regex' => 'Password must be 8-15 characters, including uppercase letters, lowercase letters, numbers, and special characters.',
            'password.confirmed' => 'The passwords do not match',
        ]);

        $user->password = Hash::make($request->input('password'));
        $user->setRememberToken(\Illuminate\Support\Str::random(60));
        $user->save();
        $request->session()->forget('mobile_password_reset');

        $request->session()->flash('success', 'Your password has been reset. Please log in with your new password.');
        return redirect()->route('login.form');
    }

    /** The user who verified their phone in this session, while the reset window is open. */
    private function mobileResetUser(Request $request): ?User
    {
        $pending = $request->session()->get('mobile_password_reset');
        if (!$pending || $pending['expires_at'] < now()->timestamp) {
            $request->session()->forget('mobile_password_reset');
            return null;
        }

        return User::where('status', 'active')->find($pending['user_id']);
    }
}
