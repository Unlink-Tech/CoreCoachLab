@extends('frontend.layouts.auth')
@section('page-body-class', 'page-forget-pwd-form')
@section('title','Reset Password')
@section('auth-heading', 'Set a New Password')
@section('auth-subheading', 'Choose a new password for your account.')

{{-- Landing page of the emailed reset link (ResetPasswordController). --}}
@section('auth-form')
    <form method="POST" action="{{ route('password.update') }}" class="vr-login-form" novalidate>
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="vr-login-field">
            <label for="email">Email<span class="vr-auth-req">*</span></label>
            <div class="vr-login-input-wrap">
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" required
                    class="vr-login-input @error('email') vr-error @enderror">
            </div>
            @error('email')<div class="vr-login-error-msg">{{ $message }}</div>@enderror
        </div>

        @include('frontend.pages.partials.new-password-fields')

        <button type="submit" class="vr-btn vr-btn--primary" style="width:100%;padding:15px">Reset Password</button>
    </form>

    <div class="vr-auth-links">
        <a href="{{ route('login.form') }}" class="vr-auth-back">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Back to log in
        </a>
    </div>
@endsection

@push('scripts')
<script src="{{ url('assets/js/forgot-password.js') }}"></script>
@endpush
