@extends('frontend.layouts.main')
@section('page-body-class', 'page-register')
@section('title','Register')
@section('main-content')

{{-- Mirrors ventureasiamarkets.com/register. The form is the reference site's own component
     (public/assets/js/register-page.js, React 18) with a real emailed verification code
     (route('register.code')) and a real POST to route('register.submit').
     Styles: public/assets/css/markets.css (scoped "vr-" classes). --}}
@php
    // Map Laravel validation errors onto the field names the reference form uses.
    $vaFieldMap = [
        'email' => 'email',
        'verification_code' => 'verificationCode',
        'password' => 'password',
        'not_us_resident' => 'notUsResident',
        'agree_terms' => 'agreeTerms',
        'country' => 'email',
        'account_type' => 'email',
        'referred_by' => 'email',
        'captcha' => 'agreeTerms',
    ];
    $vaErrors = [];
    foreach ($errors->getMessages() as $field => $messages) {
        $key = $vaFieldMap[$field] ?? 'email';
        $vaErrors[$key] = $vaErrors[$key] ?? $messages[0];
    }
    $vaPendingCode = session('register_code');
    $vaRegisterInit = [
        'country' => old('country', ''),
        'email' => old('email', ''),
        'referredBy' => old('referred_by', ''),
        'accountType' => old('account_type', 'individual'),
        'notUs' => (bool) old('not_us_resident'),
        'agree' => (bool) old('agree_terms'),
        'errors' => $vaErrors ?: new \stdClass(),
        // Lets the form be resubmitted without re-requesting a still-valid code.
        'codeSent' => $vaPendingCode && old('email') && $vaPendingCode['email'] === strtolower(trim(old('email')))
            && $vaPendingCode['expires_at'] > now()->timestamp,
    ];
@endphp
<div class="va-mk" id="vaRegister"
    data-home="{{ route('home') }}"
    data-login="{{ route('login.form') }}"
    data-legal="{{ route('legal.documents') }}"
    data-action="{{ route('register.submit') }}"
    data-code-url="{{ route('register.code') }}"
    data-token="{{ csrf_token() }}"
    data-logo="{{ asset('assets/images/venture-logo.png') }}"
    data-init='@json($vaRegisterInit)'>
    <noscript>
        <section class="vr-section"><div class="vr-container">
            <p>Registration needs JavaScript enabled (for the email verification step).</p>
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
<script src="{{ url('assets/js/register-page.js') }}"></script>
@endpush

@endsection
