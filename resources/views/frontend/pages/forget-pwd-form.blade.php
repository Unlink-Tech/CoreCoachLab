@extends('frontend.layouts.main')
@section('page-body-class', 'page-forget-pwd-form')
@section('title','Forgot Password')
@section('main-content')

<x-breadcrumb
    :title="__('common.forgetpwd')"
    :routes="[
        ['label' => __('common.forgetpwd')]
    ]"
/>

<section class="auth-v2">
    <span class="auth-v2__blob auth-v2__blob--a" aria-hidden="true"></span>
    <span class="auth-v2__blob auth-v2__blob--b" aria-hidden="true"></span>

    <div class="container auth-v2__inner">
        <div class="auth-v2__card">

            {{-- LEFT: dark editorial aside --}}
            <aside class="auth-v2__aside">
                <span class="auth-v2__aside-glow" aria-hidden="true"></span>
                <div class="auth-v2__aside-inner">
                    <div class="auth-v2__aside-icon">
                        <i class="fas fa-key"></i>
                    </div>
                    <span class="auth-v2__eyebrow auth-v2__eyebrow--dark">
                        <span class="auth-v2__eyebrow-dot" aria-hidden="true"></span>
                        {{ __('common.forgetpwd') }}
                    </span>
                    <h2 class="auth-v2__aside-title">{{ __('common.forgot_password.panel_title') }}</h2>
                    <p class="auth-v2__aside-desc">{{ __('common.forgot_password.panel_description') }}</p>

                    <ul class="auth-v2__steps">
                        @foreach([1,2,3] as $n)
                            <li class="auth-v2__step">
                                <span class="auth-v2__step-num">{{ str_pad($n, 2, '0', STR_PAD_LEFT) }}</span>
                                <div>
                                    <strong>{{ __('common.forgot_password.step_' . $n . '_title') }}</strong>
                                    <p>{{ __('common.forgot_password.step_' . $n . '_description') }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="auth-v2__brand-mark">
                        <span class="auth-v2__brand-name">{{ __('common.forgot_password.brand_name') }}</span>
                        <span class="auth-v2__brand-tagline">{{ __('common.forgot_password.brand_tagline') }}</span>
                    </div>
                </div>
            </aside>

            {{-- RIGHT: form panel --}}
            <div class="auth-v2__panel">
                <div class="auth-v2__panel-head">
                    <span class="auth-v2__eyebrow">
                        <span class="auth-v2__eyebrow-dot" aria-hidden="true"></span>
                        {{ __('common.forgot_password.form_title') }}
                    </span>
                    <h1 class="auth-v2__panel-title">{{ __('common.forgot_password.form_title') }}</h1>
                    <p class="auth-v2__panel-sub">{{ __('common.forgot_password.form_subtitle') }}</p>
                </div>

                <form name="frmLogin" id="frmLogin" action="{{route('password.email')}}" method="post" class="auth-v2__form">
                    @csrf

                    <div class="auth-v2__field">
                        <label class="auth-v2__label" for="email">
                            <i class="fas fa-envelope"></i>{{ __('common.email') }}
                        </label>
                        <input type="email" name="email" id="email"
                               placeholder="{{ __('common.forgot_password.field_email_placeholder') }}"
                               value="{{old('email')}}"
                               class="premium-form-input auth-v2__input @error('email') is-invalid @enderror" required>
                        @error('email')
                            <span class="auth-v2__error"><i class="fas fa-info-circle"></i> {{$message}}</span>
                        @enderror
                    </div>

                    <div class="auth-v2__field">
                        <label class="auth-v2__label" for="captcha">
                            <i class="fas fa-shield-alt"></i>{{ __('common.security_verification') }}
                        </label>
                        <div class="auth-v2__captcha">
                            <input type="text" id="captcha" name="captcha" autocomplete="off"
                                   placeholder="{{ __('common.forgot_password.field_captcha_placeholder') }}"
                                   class="premium-form-input auth-v2__input" required>
                            <div class="auth-v2__captcha-img">@captcha</div>
                        </div>
                        @error('captcha')
                            <span class="auth-v2__error"><i class="fas fa-info-circle"></i> {{ __('common.captcha_error') }}</span>
                        @enderror
                    </div>

                    <button type="submit" name="submit-form" class="auth-v2__submit">
                        <span>{{ __('common.forgot_password.submit_button') }}</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>

                <div class="auth-v2__divider"><span>{{ __('common.or') }}</span></div>

                <p class="auth-v2__switch">
                    {{ __('common.remember_password') }}
                    <a href="{{route('login.form')}}">{{ __('common.account.login') }}</a>
                </p>
            </div>

        </div>
    </div>
</section>

@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#frmLogin").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                captcha: "required"
            },
            messages: {
                email: "{{ __('common.forgot_password.validation_email_required') }}",
                captcha: "{{ __('common.forgot_password.validation_captcha_required') }}"
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent());
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('error').removeClass(validClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('error').addClass(validClass);
            }
        });
    });
</script>
@endpush
