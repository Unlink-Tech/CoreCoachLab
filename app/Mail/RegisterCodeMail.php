<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Email verification code sent from the registration form ("Request Code").
 */
class RegisterCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $code;
    public $minutes;

    public function __construct(string $code, int $minutes)
    {
        $this->code = $code;
        $this->minutes = $minutes;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Your Venture Asia verification code')
            ->view('emails.register-code')
            ->with(['code' => $this->code, 'minutes' => $this->minutes]);
    }
}
