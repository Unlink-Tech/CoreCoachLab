<?php

namespace App\Services;

use App\User;

/**
 * Phone numbers entered as a dialling code (e.g. "+60") plus a local number.
 * They are stored on users.phone as "+" followed by digits only (e.g. "+60123456789").
 */
class PhoneNumber
{
    /** "+60" and "12-345 6789" => "+60123456789"; null when the number part has no digits. */
    public static function normalize(?string $code, ?string $number): ?string
    {
        $digits = preg_replace('/\D+/', '', (string) $number);
        if ($digits === '') {
            return null;
        }

        return '+' . preg_replace('/\D+/', '', (string) $code) . ltrim($digits, '0');
    }

    /**
     * The active user whose stored phone matches. Older rows may hold the number with or without
     * the dialling code, a leading 0 or formatting characters, so all of those are compared.
     */
    public static function findUser(?string $code, ?string $number, bool $activeOnly = true): ?User
    {
        $digits = ltrim(preg_replace('/\D+/', '', (string) $number), '0');
        if ($digits === '') {
            return null;
        }
        $dial = preg_replace('/\D+/', '', (string) $code);

        $query = User::whereNotNull('phone')->where('phone', '!=', '');
        if ($activeOnly) {
            $query->where('status', 'active');
        }

        return $query->get()->first(function ($user) use ($digits, $dial) {
            $stored = ltrim(preg_replace('/\D+/', '', $user->phone), '0');
            return $stored === $digits || $stored === $dial . $digits;
        });
    }
}
