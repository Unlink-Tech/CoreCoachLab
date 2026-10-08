@extends('frontend.layouts.auth')
@section('page-body-class', 'page-forget-pwd-form')
@section('title','Forgot Password')
@section('auth-heading', 'Enter Your Login Phone Number')

{{-- Forgot password by phone: "Send SMS Code" (JSON, route('password.mobile.code')), then Submit checks
     the code and continues to the new-password form (ForgotPasswordController). --}}
@section('auth-form')
    <form method="POST" action="{{ route('password.mobile.verify') }}" class="vr-login-form" id="vaResetMobile" novalidate
        data-code-url="{{ route('password.mobile.code') }}">
        @csrf
        <div class="vr-login-field">
            <label for="phone">Phone Number<span class="vr-auth-req">*</span></label>
            <div class="vr-login-phone-row">
                <select name="phone_code" class="vr-auth-dial" aria-label="Country dialling code"
                    data-va-dial data-selected="{{ old('phone_code') }}">
                    <option value="{{ old('phone_code', '+91') }}">{{ old('phone_code', '+91') }}</option>
                </select>
                <div class="vr-login-input-wrap" style="flex:1">
                    <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" inputmode="tel"
                        autocomplete="tel-national" required
                        class="vr-login-input @error('phone') vr-error @enderror">
                </div>
            </div>
            <div class="vr-login-error-msg" data-va-error="phone" @if(!$errors->has('phone')) hidden @endif>{{ $errors->first('phone') }}</div>
        </div>

        <button type="button" class="vr-btn vr-btn--ghost" style="width:100%" data-va-send>Send SMS Code</button>

        <div class="vr-login-field">
            <label for="code">SMS Code<span class="vr-auth-req">*</span></label>
            <div class="vr-login-input-wrap">
                <input id="code" type="text" name="code" inputmode="numeric" maxlength="6" autocomplete="one-time-code"
                    placeholder="SMS code expires in 5 minutes" required
                    class="vr-login-input @error('code') vr-error @enderror">
            </div>
            <div class="vr-login-error-msg" data-va-error="code" @if(!$errors->has('code')) hidden @endif>{{ $errors->first('code') }}</div>
            <div class="vr-auth-hint" data-va-sent hidden>We sent a 6-digit code to your phone.</div>
        </div>

        <button type="submit" class="vr-btn vr-btn--primary" style="width:100%;padding:15px">Submit</button>
    </form>

    <div class="vr-auth-links">
        <a href="{{ route('login.form') }}" class="vr-auth-back">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Back to log in
        </a>
        <a href="{{ route('password.request') }}" class="vr-login-forgot">Reset with email instead</a>
    </div>
@endsection

@push('scripts')
<script src="{{ url('assets/js/countries.js') }}"></script>
<script src="{{ url('assets/js/forgot-password.js') }}"></script>
@endpush
