<?php

namespace App\Services;

use Illuminate\Http\Request;

/**
 * One-time numeric codes kept hashed in the session, tied to one target (an email address or a
 * phone number), with an expiry and a limit on wrong attempts.
 */
class VerificationCode
{
    public const MAX_ATTEMPTS = 5;

    /** Create a new code for $target under $key and return it (the caller delivers it). */
    public static function issue(Request $request, string $key, string $target, int $ttlMinutes): string
    {
        $code = (string) random_int(100000, 999999);
        $request->session()->put($key, [
            'target' => $target,
            'hash' => \Hash::make($code),
            'expires_at' => now()->addMinutes($ttlMinutes)->timestamp,
            'attempts' => 0,
        ]);

        return $code;
    }

    /** Whether a still-valid code for $target is waiting under $key. */
    public static function pending(Request $request, string $key, string $target): bool
    {
        $stored = $request->session()->get($key);

        return $stored && $stored['target'] === $target && $stored['expires_at'] > now()->timestamp;
    }

    /** Check $input against the stored code. Returns null when it matches, otherwise an error message. */
    public static function check(Request $request, string $key, string $target, string $input): ?string
    {
        $stored = $request->session()->get($key);
        if (!$stored || $stored['target'] !== $target) {
            return 'Please request a verification code first';
        }
        if ($stored['expires_at'] < now()->timestamp) {
            $request->session()->forget($key);
            return 'This code has expired. Please request a new one';
        }
        if ($stored['attempts'] >= self::MAX_ATTEMPTS) {
            $request->session()->forget($key);
            return 'Too many incorrect attempts. Please request a new code';
        }
        if (!\Hash::check($input, $stored['hash'])) {
            $stored['attempts']++;
            $request->session()->put($key, $stored);
            return 'The verification code is incorrect';
        }

        return null;
    }

    public static function forget(Request $request, string $key): void
    {
        $request->session()->forget($key);
    }
}
