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

<section class="auth-page-section">
    <!-- Ambient blurred background shapes for warm atmosphere -->
    <div class="auth-bg-blob blob-1"></div>
    <div class="auth-bg-blob blob-2"></div>

    <div class="container auth-content-container">
        <!-- Single Unified Premium Card with Asymmetric Layout -->
        <div class="unified-auth-card">
            <div class="row g-0 h-100">
                <!-- Left half: Brand Canvas & Reset Instructions -->
                <div class="col-lg-5 brand-details-panel">
                    <div class="panel-content">
                        <div>
                            <span class="modern-badge mb-3">{{ __('common.security_first') }}</span>
                            <h2 class="panel-title mb-4">{{ __('common.forgot_password.panel_title') }}</h2>
                            <p class="panel-text mb-5">
                                {{ __('common.forgot_password.panel_description') }}
                            </p>
                        </div>

                        <!-- Benefit List -->
                        <div class="benefits-info-list">
                            <!-- Benefit 1 -->
                            <div class="benefit-item mb-4">
                                <div class="benefit-icon">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                                <div class="benefit-body">
                                    <span class="benefit-title">{{ __('common.forgot_password.step_1_title') }}</span>
                                    <span class="benefit-desc">{{ __('common.forgot_password.step_1_description') }}</span>
                                </div>
                            </div>

                            <!-- Benefit 2 -->
                            <div class="benefit-item mb-4">
                                <div class="benefit-icon">
                                    <i class="fas fa-envelope-open-text"></i>
                                </div>
                                <div class="benefit-body">
                                    <span class="benefit-title">{{ __('common.forgot_password.step_2_title') }}</span>
                                    <span class="benefit-desc">{{ __('common.forgot_password.step_2_description') }}</span>
                                </div>
                            </div>

                            <!-- Benefit 3 -->
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="benefit-body">
                                    <span class="benefit-title">{{ __('common.forgot_password.step_3_title') }}</span>
                                    <span class="benefit-desc">{{ __('common.forgot_password.step_3_description') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Brand Mark -->
                        <div class="panel-brand-mark mt-5">
                            <span class="brand-mark-title">{{ __('common.forgot_password.brand_name') }}</span>
                            <span class="brand-mark-desc">{{ __('common.forgot_password.brand_tagline') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right half: Clean Forgot Password Panel -->
                <div class="col-lg-7 form-panel">
                    <div class="panel-content">
                        <div class="form-panel-intro mb-4">
                            <h3 class="form-title">{{ __('common.forgot_password.form_title') }}</h3>
                            <p class="form-subtitle">
                                <i class="fas fa-info-circle text-muted me-1"></i>
                                {{ __('common.forgot_password.form_subtitle') }}
                            </p>
                        </div>

                        <form name="frmLogin" id="frmLogin" action="{{route('password.email')}}" method="post">
                            @csrf
                            <div class="row g-4">
                                <!-- Email -->
                                <div class="col-12">
                                    <label class="premium-input-label" for="email">
                                        <i class="fas fa-envelope me-2"></i>{{ __('common.email') }}
                                    </label>
                                    <input type="email" name="email" id="email" placeholder="{{ __('common.forgot_password.field_email_placeholder') }}" value="{{old('email')}}" class="premium-form-input @error('email') is-invalid @enderror" required>
                                    @error('email')
                                        <span class="premium-error-msg mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <!-- Captcha -->
                                <div class="col-12 pt-2">
                                    <label class="premium-input-label">{{ __('common.security_verification') }}</label>
                                    <div class="row align-items-center g-3">
                                        <div class="col-md-8">
                                            <input type="text" id="captcha" name="captcha" autocomplete="off" class="premium-form-input" placeholder="{{ __('common.forgot_password.field_captcha_placeholder') }}" required>
                                        </div>
                                        <div class="col-md-4 captcha-image-container text-center">
                                            @captcha
                                        </div>
                                    </div>
                                    @error('captcha')
                                        <span class="premium-error-msg mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{ __('common.captcha_error') }}</span>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 mt-4">
                                    <button class="premium-submit-btn" type="submit" name="submit-form">
                                        <i class="fas fa-paper-plane me-2"></i> {{ __('common.forgot_password.submit_button') }}
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

                        <!-- Back to Login Link -->
                        <div class="text-center">
                            <p class="text-muted mb-0">
                                {{ __('common.remember_password') }}
                                <a href="{{route('login.form')}}" class="register-redirect-link fw-bold text-decoration-none">{{ __('common.account.login') }}</a>
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
