@extends('frontend.layouts.auth')
@section('page-body-class', 'page-forget-pwd-form')
@section('title','Forgot Password')
@section('auth-heading', 'Forgot Password?')
@section('auth-subheading', 'Enter your account’s email address to reset your password.')

{{-- Forgot password by email: sends Laravel's reset link (ForgotPasswordController::sendResetLinkEmail). --}}
@section('auth-form')
    @if (session('status'))
        <div class="vr-auth-note vr-auth-note--ok" role="status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="vr-login-form" novalidate>
        @csrf
        <div class="vr-login-field">
            <label for="email">Email<span class="vr-auth-req">*</span></label>
            <div class="vr-login-input-wrap">
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Please Enter"
                    autocomplete="email" required autofocus
                    class="vr-login-input @error('email') vr-error @enderror">
            </div>
            @error('email')<div class="vr-login-error-msg">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="vr-btn vr-btn--primary" style="width:100%;padding:15px">Submit</button>
    </form>

    <div class="vr-auth-links">
        <a href="{{ route('login.form') }}" class="vr-auth-back">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Back to log in
        </a>
        {{-- Phone number reset hidden for now (email only, like login / register); restore when phone accounts return.
        <a href="{{ route('password.request.mobile') }}" class="vr-login-forgot">Reset with phone number</a> --}}
    </div>
@endsection
