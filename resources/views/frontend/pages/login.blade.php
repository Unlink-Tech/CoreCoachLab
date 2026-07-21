@extends('frontend.layouts.main')
@section('page-body-class', 'page-login')
@section('title','Login')
@section('main-content')

<x-breadcrumb
    :title="__('common.account.login')"
    :routes="[
        ['label' => __('common.account.login')]
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
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                    <span class="auth-v2__eyebrow auth-v2__eyebrow--dark">
                        <span class="auth-v2__eyebrow-dot" aria-hidden="true"></span>
                        {{ __('common.account.login') }}
                    </span>
                    <h2 class="auth-v2__aside-title">{{ __('common.login.panel_title') }}</h2>
                    <p class="auth-v2__aside-desc">{{ __('common.login.panel_description') }}</p>

                    <ul class="auth-v2__benefits">
                        @foreach([1,2,3] as $n)
                            <li class="auth-v2__benefit">
                                <span class="auth-v2__benefit-check"><i class="fas fa-check"></i></span>
                                <div>
                                    <strong>{{ __('common.login.benefit_' . $n . '_title') }}</strong>
                                    <p>{{ __('common.login.benefit_' . $n . '_description') }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="auth-v2__brand-mark">
                        <span class="auth-v2__brand-name">{{ __('common.login.brand_name') }}</span>
                        <span class="auth-v2__brand-tagline">{{ __('common.login.brand_tagline') }}</span>
                    </div>
                </div>
            </aside>

            {{-- RIGHT: form panel --}}
            <div class="auth-v2__panel">
                <div class="auth-v2__panel-head">
                    <span class="auth-v2__eyebrow">
                        <span class="auth-v2__eyebrow-dot" aria-hidden="true"></span>
                        {{ __('common.login.form_title') }}
                    </span>
                    <h1 class="auth-v2__panel-title">{{ __('common.login.form_title') }}</h1>
                    <p class="auth-v2__panel-sub">{{ __('common.login.form_subtitle') }}</p>
                </div>

                <form name="frmLogin" id="frmLogin" action="{{route('login.submit')}}" method="post" class="auth-v2__form">
                    @csrf

                    <div class="auth-v2__field">
                        <label class="auth-v2__label" for="email">
                            <i class="fas fa-envelope"></i>{{ __('common.email') }}
                        </label>
                        <input type="email" name="email" id="email"
                               placeholder="{{ __('common.login.field_email_placeholder') }}"
                               value="{{old('email')}}"
                               class="premium-form-input auth-v2__input @error('email') is-invalid @enderror" required>
                        @error('email')
                            <span class="auth-v2__error"><i class="fas fa-info-circle"></i> {{$message}}</span>
                        @enderror
                    </div>

                    <div class="auth-v2__field">
                        <label class="auth-v2__label" for="password">
                            <i class="fas fa-lock"></i>{{ __('common.password') }}
                        </label>
                        <div class="auth-v2__pw-wrap">
                            <input type="password" name="password" id="password"
                                   placeholder="{{ __('common.login.field_password_placeholder') }}"
                                   class="premium-form-input auth-v2__input @error('password') is-invalid @enderror" required>
                            <button type="button" class="auth-v2__pw-eye" data-toggle="password" aria-label="Toggle password visibility">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="auth-v2__error"><i class="fas fa-info-circle"></i> {{$message}}</span>
                        @enderror
                    </div>

                    <div class="auth-v2__row-inline">
                        <span></span>
                        <a href="{{route('forgetpwd.form')}}" class="auth-v2__link">
                            {{ __('common.lost_password_text') }}
                        </a>
                    </div>

                    <button type="submit" name="submit-form" class="auth-v2__submit">
                        <span>{{ __('common.login.submit_button') }}</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <div class="auth-v2__divider"><span>{{ __('common.or') }}</span></div>

                <p class="auth-v2__switch">
                    {{ __('common.dont_have_account') }}
                    <a href="{{route('register.form')}}">{{ __('common.sign_up_now') }}</a>
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
        $("#frmLogin").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 5
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                password: {
                    required: "{{ __('common.login.validation_password_required') }}",
                    minlength: "{{ __('common.login.validation_password_minlength') }}"
                },
                email: "{{ __('common.login.validation_email_required') }}"
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
