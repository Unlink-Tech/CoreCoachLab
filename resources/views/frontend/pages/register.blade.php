@extends('frontend.layouts.main')
@section('page-body-class', 'page-register')
@section('title','Register')
@section('main-content')

{{-- "Open Live Account" form (public/assets/js/register-page.js, React 18): Email or Phone Number tab,
     each verified by a code (route('register.code') emails it, route('register.sms-code') texts it),
     then a real POST to route('register.submit').
     Styles: public/assets/css/markets.css (scoped "vr-" classes). --}}
@php
    // Map Laravel validation errors onto the field names the form uses.
    $vaFieldMap = [
        'register_method' => 'email',
        'country' => 'country',
        'first_name' => 'firstName',
        'email' => 'email',
        'phone' => 'phone',
        'phone_code' => 'phone',
        'verification_code' => 'verificationCode',
        'password' => 'password',
        'not_us_resident' => 'notUsResident',
        'agree_terms' => 'agreeTerms',
        'account_type' => 'email',
        'referred_by' => 'email',
        'captcha' => 'agreeTerms',
    ];
    $vaErrors = [];
    foreach ($errors->getMessages() as $field => $messages) {
        $key = $vaFieldMap[$field] ?? 'email';
        $vaErrors[$key] = $vaErrors[$key] ?? $messages[0];
    }
    $vaMethod = old('register_method') === 'phone' ? 'phone' : 'email';
    // Lets the form be resubmitted without re-requesting a still-valid code.
    $vaCodeSent = $vaMethod === 'phone'
        ? \App\Services\VerificationCode::pending(request(), 'register_sms_code', (string) \App\Services\PhoneNumber::normalize(old('phone_code'), old('phone')))
        : \App\Services\VerificationCode::pending(request(), 'register_code', strtolower(trim((string) old('email'))));
    $vaRegisterInit = [
        'method' => $vaMethod,
        'country' => old('country', ''),
        'firstName' => old('first_name', ''),
        'email' => old('email', ''),
        'phoneCode' => old('phone_code', ''),
        'phone' => old('phone', ''),
        'referredBy' => old('referred_by', ''),
        'accountType' => old('account_type', 'individual'),
        'notUs' => (bool) old('not_us_resident'),
        'agree' => (bool) old('agree_terms'),
        'marketing' => (bool) old('marketing_consent'),
        'errors' => $vaErrors ?: new \stdClass(),
        'codeSent' => $vaCodeSent,
    ];
@endphp
<div class="va-mk" id="vaRegister"
    data-home="{{ route('home') }}"
    data-login="{{ route('login.form') }}"
    data-demo="{{ route('accounts.demo') }}"
    data-legal="{{ route('legal.documents') }}"
    data-action="{{ route('register.submit') }}"
    data-code-url="{{ route('register.code') }}"
    data-sms-code-url="{{ route('register.sms-code') }}"
    data-verify-code="{{ config('services.register_verify_code') ? '1' : '0' }}"
    data-token="{{ csrf_token() }}"
    data-logo="{{ asset('assets/images/venture-logo.png') }}"
    data-init='@json($vaRegisterInit)'>
    <noscript>
        <section class="vr-section"><div class="vr-container">
            <p>Registration needs JavaScript enabled (for the verification code step).</p>
        </div></section>
    </noscript>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/react/18.2.0/umd/react.production.min.js"
    integrity="sha512-8Q6Y9XnTbOE+JNvjBQwJ2H8S+UV4uA6hiRykhdtIyDYZ2TprdNmWOUaKdGzOhyr4dCyk287OejbPvwl7lrfqrQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/18.2.0/umd/react-dom.production.min.js"
    integrity="sha512-MOCpqoRoisCTwJ8vQQiciZv0qcpROCidek3GTFS6KTk2+y7munJIlKCVkFCYY+p3ErYFXCjmFjnfTTRSC1OHWQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ url('assets/js/countries.js') }}"></script>
<script src="{{ url('assets/js/register-page.js') }}"></script>
@endpush

@endsection
