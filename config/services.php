<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'github' => [
        'client_id' => 'YOUR_GITHUB_API', //Github API
        'client_secret' => 'YOUR_GITHUB_SECRET', //Github Secret
        'redirect' => 'http://localhost:8000/login/github/callback',
     ],
     'google' => [
        'client_id' => 'YOUR_GOOGLE_API', //Google API
        'client_secret' => 'YOUR_GOOGLE_SECRET', //Google Secret
        'redirect' => 'http://localhost:8000/login/google/callback',
     ],
     'facebook' => [
        'client_id' => 'YOUR_FACEBOOK_API', //Facebook API
        'client_secret' => 'YOUR_FACEBOK_SECRET', //Facebook Secret
        'redirect' => 'http://localhost:8000/login/facebook/callback',
     ],

    // Hosted payment page opened by the deposit form on /deposits.
    // The default is the (test) checkout used by ventureasiamarkets.com; set DEPOSIT_CHECKOUT_URL for live.
    'deposit_checkout_url' => env('DEPOSIT_CHECKOUT_URL', 'https://checkout-dev.key2payment.com/HostedPaymentPage/co7xhjI3'),

    // SMS verification codes (phone sign-up and forgot password by phone).
    // "log" writes the message to the Laravel log and only works in the local environment;
    // add a provider driver to App\Services\SmsSender and set SMS_DRIVER to send real SMS.
    'sms' => [
        'driver' => env('SMS_DRIVER', 'log'),
    ],

    // Registration: require an email / SMS verification code before creating the account.
    // Off for now (the code field is hidden on the form); set REGISTER_VERIFY_CODE=true to turn it back on.
    'register_verify_code' => env('REGISTER_VERIFY_CODE', false),

];
