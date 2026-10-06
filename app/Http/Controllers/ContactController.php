<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function sendContact(Request $request)
    {
        $rules = [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:40',
            'topic' => 'required|in:Opening an account,Markets & instruments,Funding & withdrawals,Platform & technical,Refunds & cancellations,Something else',
            'message' => 'required|string',
            'agree' => 'accepted',
        ];

        // The redesigned contact form has no captcha field; set CAPTCHA_ENABLED=true only if one is added back.
        if (env('CAPTCHA_ENABLED', false)) {
            $rules['captcha'] = 'required|captcha';
        }

        $request->validate($rules, [
            'agree.accepted' => 'Please agree to the Privacy Policy before sending.',
        ]);

        // ContactMail expects name/subject, so map the new fields onto them.
        $data = $request->only('email', 'phone', 'message', 'topic');
        $data['name'] = trim($request->input('first_name') . ' ' . $request->input('last_name'));
        $data['subject'] = $request->input('topic');
        $admin = env('MAIL_FROM_ADDRESS') ?? config('mail.from.address') ?? 'support@example.com';

        if (!$admin || empty(trim($admin))) {
            return redirect('contact')->with('error', __('common.email_configuration_error') ?? 'Email configuration error. Please contact support.');
        }

       // Mail::to($admin)->send(new ContactMail($data));
        
        return redirect('contact')->with('success', __('common.message_sent_successfully'));
    }
}
