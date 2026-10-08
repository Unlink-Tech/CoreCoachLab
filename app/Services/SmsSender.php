<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

/**
 * Sends SMS verification codes.
 *
 * Only the "log" driver exists so far: the message is written to the Laravel log, and it is
 * accepted in the local environment only, so phone verification stays switched off elsewhere
 * until a real provider is added here and selected with SMS_DRIVER (config/services.php).
 */
class SmsSender
{
    /** Whether SMS can be delivered in this environment. */
    public function available(): bool
    {
        $driver = config('services.sms.driver', 'log');

        return $driver === 'log' ? app()->environment('local') : false;
    }

    /** Send $message to an E.164-style number (e.g. +60123456789). Returns false if it was not sent. */
    public function send(string $to, string $message): bool
    {
        if (!$this->available()) {
            return false;
        }

        // "log" driver (local development only).
        Log::info('SMS to ' . $to . ': ' . $message);

        return true;
    }
}
