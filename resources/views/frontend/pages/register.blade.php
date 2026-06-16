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

<section class="auth-page-section">
    <!-- Ambient blurred background shapes for warm atmosphere -->
    <div class="auth-bg-blob blob-1"></div>
    <div class="auth-bg-blob blob-2"></div>

    <div class="container auth-content-container">
        <!-- Single Unified Premium Card with Asymmetric Layout -->
        <div class="unified-auth-card">
            <div class="row g-0 h-100">
                <!-- Left half: Brand Canvas & Community Benefits -->
                <div class="col-lg-5 brand-details-panel">
                    <div class="panel-content">
                        <div>
                            <span class="modern-badge mb-3">{{ __('common.join_community') }}</span>
                            <h2 class="panel-title mb-4">{{ __('common.register.panel_title') }}</h2>
                            <p class="panel-text mb-5">
                                {{ __('common.register.panel_description') }}
                            </p>
                        </div>

                        <!-- Benefit List -->
                        <div class="benefits-info-list">
                            <!-- Benefit 1 -->
                            <div class="benefit-item mb-4">
                                <div class="benefit-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="benefit-body">
                                    <span class="benefit-title">{{ __('common.register.benefit_1_title') }}</span>
                                    <span class="benefit-desc">{{ __('common.register.benefit_1_description') }}</span>
                                </div>
                            </div>

                            <!-- Benefit 2 -->
                            <div class="benefit-item mb-4">
                                <div class="benefit-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <div class="benefit-body">
                                    <span class="benefit-title">{{ __('common.register.benefit_2_title') }}</span>
                                    <span class="benefit-desc">{{ __('common.register.benefit_2_description') }}</span>
                                </div>
                            </div>

                            <!-- Benefit 3 -->
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <div class="benefit-body">
                                    <span class="benefit-title">{{ __('common.register.benefit_3_title') }}</span>
                                    <span class="benefit-desc">{{ __('common.register.benefit_3_description') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Brand Mark -->
                        <div class="panel-brand-mark mt-5">
                            <span class="brand-mark-title">{{ __('common.register.brand_name') }}</span>
                            <span class="brand-mark-desc">{{ __('common.register.brand_tagline') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right half: Clean Sign Up Panel -->
                <div class="col-lg-7 form-panel">
                    <div class="panel-content">
                        <div class="form-panel-intro mb-4">
                            <h3 class="form-title">{{ __('common.register.form_title') }}</h3>
                            <p class="form-subtitle">
                                <i class="fas fa-info-circle text-muted me-1"></i>
                                {{ __('common.register.form_subtitle') }}
                            </p>
                        </div>

                        <form name="frmRegister" id="frmRegister" action="{{route('register.submit')}}" method="post">
                            @csrf
                            <div class="row g-4">
                                <!-- Name -->
                                <div class="col-12">
                                    <label class="premium-input-label" for="name">
                                        <i class="fas fa-user me-2"></i>{{ __('common.name') }}
                                    </label>
                                    <input type="text" name="name" id="name" placeholder="{{ __('common.register.field_name_placeholder') }}" value="{{old('name')}}" class="premium-form-input @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="premium-error-msg mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-12">
                                    <label class="premium-input-label" for="email">
                                        <i class="fas fa-envelope me-2"></i>{{ __('common.email') }}
                                    </label>
                                    <input type="email" name="email" id="email" placeholder="{{ __('common.register.field_email_placeholder') }}" value="{{old('email')}}" class="premium-form-input @error('email') is-invalid @enderror" required>
                                    @error('email')
                                        <span class="premium-error-msg mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="col-md-6">
                                    <label class="premium-input-label" for="password">
                                        <i class="fas fa-lock me-2"></i>{{ __('common.password') }}
                                    </label>
                                    <input type="password" name="password" id="password" placeholder="{{ __('common.register.field_password_placeholder') }}" class="premium-form-input @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <span class="premium-error-msg mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <label class="premium-input-label" for="password_confirmation">
                                        <i class="fas fa-lock-open me-2"></i>{{ __('common.confirm_password') }}
                                    </label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ __('common.register.field_confirm_password_placeholder') }}" class="premium-form-input">
                                </div>

                                <!-- Captcha -->
                                @if(env('CAPTCHA_ENABLED', true))
                                    <div class="col-12 pt-2">
                                        <label class="premium-input-label">{{ __('common.security_verification') }}</label>
                                        <div class="row align-items-center g-3">
                                            <div class="col-md-8">
                                                <input type="text" id="captcha" name="captcha" autocomplete="off" class="premium-form-input" placeholder="{{ __('common.fill_captcha') }}">
                                            </div>
                                            <div class="col-md-4 captcha-image-container text-center">
                                                @captcha
                                            </div>
                                        </div>
                                        @error('captcha')
                                            <span class="premium-error-msg mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{ __('common.captcha_error') }}</span>
                                        @enderror
                                    </div>
                                @endif

                                <!-- Submit Register Button -->
                                <div class="col-12 mt-4">
                                    <button class="premium-submit-btn" type="submit" name="submit-form">
                                        <i class="fas fa-user-plus me-2"></i> {{ __('common.register.submit_button') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Divider -->
                        <div class="my-4 d-flex align-items-center">
                            <div style="flex: 1; height: 1px; background: var(--color-stone, #d7d6d4);"></div>
                            <span class="mx-3 small text-muted">{{ __('common.or') }}</span>
                            <div style="flex: 1; height: 1px; background: var(--color-stone, #d7d6d4);"></div>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="text-muted mb-0">
                                {{ __('common.already_account') }}
                                <a href="{{route('login.form')}}" class="login-redirect-link fw-bold text-decoration-none">{{ __('common.account.login') }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
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
                // custom error placement to avoid breaking the layout
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
