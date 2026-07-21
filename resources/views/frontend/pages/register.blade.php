@extends('frontend.layouts.main')
@section('page-body-class', 'page-register')
@section('title','Register')
@section('main-content')

<x-breadcrumb
    :title="__('common.account.register')"
    :routes="[
        ['label' => __('common.account.register')]
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
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <span class="auth-v2__eyebrow auth-v2__eyebrow--dark">
                        <span class="auth-v2__eyebrow-dot" aria-hidden="true"></span>
                        {{ __('common.account.register') }}
                    </span>
                    <h2 class="auth-v2__aside-title">{{ __('common.register.panel_title') }}</h2>
                    <p class="auth-v2__aside-desc">{{ __('common.register.panel_description') }}</p>

                    <ul class="auth-v2__benefits">
                        @foreach([1,2,3] as $n)
                            <li class="auth-v2__benefit">
                                <span class="auth-v2__benefit-check"><i class="fas fa-check"></i></span>
                                <div>
                                    <strong>{{ __('common.register.benefit_' . $n . '_title') }}</strong>
                                    <p>{{ __('common.register.benefit_' . $n . '_description') }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="auth-v2__brand-mark">
                        <span class="auth-v2__brand-name">{{ __('common.register.brand_name') }}</span>
                        <span class="auth-v2__brand-tagline">{{ __('common.register.brand_tagline') }}</span>
                    </div>
                </div>
            </aside>

            {{-- RIGHT: form panel --}}
            <div class="auth-v2__panel">
                <div class="auth-v2__panel-head">
                    <span class="auth-v2__eyebrow">
                        <span class="auth-v2__eyebrow-dot" aria-hidden="true"></span>
                        {{ __('common.register.form_title') }}
                    </span>
                    <h1 class="auth-v2__panel-title">{{ __('common.register.form_title') }}</h1>
                    <p class="auth-v2__panel-sub">{{ __('common.register.form_subtitle') }}</p>
                </div>

                <form name="frmRegister" id="frmRegister" action="{{route('register.submit')}}" method="post" class="auth-v2__form">
                    @csrf

                    <div class="auth-v2__field">
                        <label class="auth-v2__label" for="name">
                            <i class="fas fa-user"></i>{{ __('common.name') }}
                        </label>
                        <input type="text" name="name" id="name"
                               placeholder="{{ __('common.register.field_name_placeholder') }}"
                               value="{{old('name')}}"
                               class="premium-form-input auth-v2__input @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="auth-v2__error"><i class="fas fa-info-circle"></i> {{$message}}</span>
                        @enderror
                    </div>

                    <div class="auth-v2__field">
                        <label class="auth-v2__label" for="email">
                            <i class="fas fa-envelope"></i>{{ __('common.email') }}
                        </label>
                        <input type="email" name="email" id="email"
                               placeholder="{{ __('common.register.field_email_placeholder') }}"
                               value="{{old('email')}}"
                               class="premium-form-input auth-v2__input @error('email') is-invalid @enderror" required>
                        @error('email')
                            <span class="auth-v2__error"><i class="fas fa-info-circle"></i> {{$message}}</span>
                        @enderror
                    </div>

                    <div class="auth-v2__row">
                        <div class="auth-v2__field">
                            <label class="auth-v2__label" for="password">
                                <i class="fas fa-lock"></i>{{ __('common.password') }}
                            </label>
                            <div class="auth-v2__pw-wrap">
                                <input type="password" name="password" id="password"
                                       placeholder="{{ __('common.register.field_password_placeholder') }}"
                                       class="premium-form-input auth-v2__input @error('password') is-invalid @enderror" required>
                                <button type="button" class="auth-v2__pw-eye" data-toggle="password" aria-label="Toggle password visibility">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="auth-v2__error"><i class="fas fa-info-circle"></i> {{$message}}</span>
                            @enderror
                        </div>

                        <div class="auth-v2__field">
                            <label class="auth-v2__label" for="password_confirmation">
                                <i class="fas fa-lock-open"></i>{{ __('common.confirm_password') }}
                            </label>
                            <div class="auth-v2__pw-wrap">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       placeholder="{{ __('common.register.field_confirm_password_placeholder') }}"
                                       class="premium-form-input auth-v2__input">
                                <button type="button" class="auth-v2__pw-eye" data-toggle="password_confirmation" aria-label="Toggle confirm password visibility">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    @if(env('CAPTCHA_ENABLED', true))
                        <div class="auth-v2__field">
                            <label class="auth-v2__label" for="captcha">
                                <i class="fas fa-shield-alt"></i>{{ __('common.security_verification') }}
                            </label>
                            <div class="auth-v2__captcha">
                                <input type="text" id="captcha" name="captcha" autocomplete="off"
                                       placeholder="{{ __('common.fill_captcha') }}"
                                       class="premium-form-input auth-v2__input">
                                <div class="auth-v2__captcha-img">@captcha</div>
                            </div>
                            @error('captcha')
                                <span class="auth-v2__error"><i class="fas fa-info-circle"></i> {{ __('common.captcha_error') }}</span>
                            @enderror
                        </div>
                    @endif

                    <button type="submit" name="submit-form" class="auth-v2__submit">
                        <span>{{ __('common.register.submit_button') }}</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <div class="auth-v2__divider"><span>{{ __('common.or') }}</span></div>

                <p class="auth-v2__switch">
                    {{ __('common.already_account') }}
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
    // Password eye toggle
    document.querySelectorAll('.auth-v2__pw-eye').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var targetId = btn.getAttribute('data-toggle');
            var input = document.getElementById(targetId);
            var icon  = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    });

    $(document).ready(function() {
        $("#frmRegister").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 5
                },
                password: {
                    required: true,
                    minlength: 5
                },
                password_confirmation: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "required"
                @endif
            },
            messages: {
                name: "{{ __('common.register.validation_name_required') }}",
                password: {
                    required: "{{ __('common.register.validation_password_required') }}",
                    minlength: "{{ __('common.register.validation_password_minlength') }}"
                },
                password_confirmation: {
                    required: "{{ __('common.register.validation_confirm_password_required') }}",
                    minlength: "{{ __('common.register.validation_confirm_password_minlength') }}",
                    equalTo: "{{ __('common.register.validation_password_mismatch') }}"
                },
                email: "{{ __('common.register.validation_email_required') }}",
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "{{ __('common.register.validation_captcha_required') }}"
                @endif
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
