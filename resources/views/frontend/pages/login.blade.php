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

<section class="auth-page-section">
    <!-- Ambient blurred background shapes for warm atmosphere -->
    <div class="auth-bg-blob blob-1"></div>
    <div class="auth-bg-blob blob-2"></div>

    <div class="container auth-content-container">
        <!-- Single Unified Premium Card with Asymmetric Layout -->
        <div class="unified-auth-card">
            <div class="row g-0 h-100">
                <!-- Left half: Brand Canvas & Welcome Info -->
                <div class="col-lg-5 brand-details-panel">
                    <div class="panel-content">
                        <div>
                            <span class="modern-badge mb-3">{{ __('common.welcome_back') }}</span>
                            <h2 class="panel-title mb-4">{{ __('common.login.panel_title') }}</h2>
                            <p class="panel-text mb-5">
                                {{ __('common.login.panel_description') }}
                            </p>
                        </div>

                        <!-- Benefit List -->
                        <div class="benefits-info-list">
                            <!-- Benefit 1 -->
                            <div class="benefit-item mb-4">
                                <div class="benefit-icon">
                                    <i class="fas fa-play-circle"></i>
                                </div>
                                <div class="benefit-body">
                                    <span class="benefit-title">{{ __('common.login.benefit_1_title') }}</span>
                                    <span class="benefit-desc">{{ __('common.login.benefit_1_description') }}</span>
                                </div>
                            </div>

                            <!-- Benefit 2 -->
                            <div class="benefit-item mb-4">
                                <div class="benefit-icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <div class="benefit-body">
                                    <span class="benefit-title">{{ __('common.login.benefit_2_title') }}</span>
                                    <span class="benefit-desc">{{ __('common.login.benefit_2_description') }}</span>
                                </div>
                            </div>

                            <!-- Benefit 3 -->
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="benefit-body">
                                    <span class="benefit-title">{{ __('common.login.benefit_3_title') }}</span>
                                    <span class="benefit-desc">{{ __('common.login.benefit_3_description') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Brand Mark -->
                        <div class="panel-brand-mark mt-5">
                            <span class="brand-mark-title">{{ __('common.login.brand_name') }}</span>
                            <span class="brand-mark-desc">{{ __('common.login.brand_tagline') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right half: Clean Login Panel -->
                <div class="col-lg-7 form-panel">
                    <div class="panel-content">
                        <div class="form-panel-intro mb-4">
                            <h3 class="form-title">{{ __('common.login.form_title') }}</h3>
                            <p class="form-subtitle">
                                <i class="fas fa-info-circle text-muted me-1"></i>
                                {{ __('common.login.form_subtitle') }}
                            </p>
                        </div>

                        <form name="frmLogin" id="frmLogin" action="{{route('login.submit')}}" method="post">
                            @csrf
                            <div class="row g-4">
                                <!-- Email -->
                                <div class="col-12">
                                    <label class="premium-input-label" for="email">
                                        <i class="fas fa-envelope me-2"></i>{{ __('common.email') }}
                                    </label>
                                    <input type="email" name="email" id="email" placeholder="{{ __('common.login.field_email_placeholder') }}" value="{{old('email')}}" class="premium-form-input @error('email') is-invalid @enderror" required>
                                    @error('email')
                                        <span class="premium-error-msg mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="col-12">
                                    <label class="premium-input-label" for="password">
                                        <i class="fas fa-lock me-2"></i>{{ __('common.password') }}
                                    </label>
                                    <input type="password" name="password" id="password" placeholder="{{ __('common.login.field_password_placeholder') }}" class="premium-form-input @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <span class="premium-error-msg mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <!-- Forgot Password Link -->
                                <div class="col-12 text-end">
                                    <a href="{{route('forgetpwd.form')}}" class="forgot-password-link small">{{ __('common.lost_password_text') }}</a>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 mt-4">
                                    <button class="premium-submit-btn" type="submit" name="submit-form">
                                        <i class="fas fa-sign-in-alt me-2"></i> {{ __('common.login.submit_button') }}
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

                        <!-- Sign Up Link -->
                        <div class="text-center">
                            <p class="text-muted mb-0">
                                {{ __('common.dont_have_account') }}
                                <a href="{{route('register.form')}}" class="register-redirect-link fw-bold text-decoration-none">{{ __('common.sign_up_now') }}</a>
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
