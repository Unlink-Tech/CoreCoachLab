@extends('frontend.layouts.main')
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
                            <h2 class="panel-title mb-4">Reset Your Password</h2>
                            <p class="panel-text mb-5">
                                No worries, we will send you secure instructions to reset your account password and restore your access.
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
                                    <span class="benefit-title">Request Link</span>
                                    <span class="benefit-desc">Enter your registered email address to request a reset link.</span>
                                </div>
                            </div>

                            <!-- Benefit 2 -->
                            <div class="benefit-item mb-4">
                                <div class="benefit-icon">
                                    <i class="fas fa-envelope-open-text"></i>
                                </div>
                                <div class="benefit-body">
                                    <span class="benefit-title">Check Inbox</span>
                                    <span class="benefit-desc">Click the link inside the verification email we send you.</span>
                                </div>
                            </div>

                            <!-- Benefit 3 -->
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="benefit-body">
                                    <span class="benefit-title">Secure Update</span>
                                    <span class="benefit-desc">Create a new secure password to sign back in immediately.</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Brand Mark -->
                        <div class="panel-brand-mark mt-5">
                            <span class="brand-mark-title">Artify Academy</span>
                            <span class="brand-mark-desc">Cultivating Artistry & Technique</span>
                        </div>
                    </div>
                </div>

                <!-- Right half: Clean Forgot Password Panel -->
                <div class="col-lg-7 form-panel">
                    <div class="panel-content">
                        <div class="form-panel-intro mb-4">
                            <h3 class="form-title">{{ __('common.reset_password') }}</h3>
                            <p class="form-subtitle">
                                <i class="fas fa-info-circle text-muted me-1"></i>
                                Enter your email address to recover your account.
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
                                    <input type="email" name="email" id="email" placeholder="{{ __('common.email') }}" value="{{old('email')}}" class="premium-form-input @error('email') is-invalid @enderror" required>
                                    @error('email')
                                        <span class="premium-error-msg mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <!-- Captcha -->
                                <div class="col-12 pt-2">
                                    <label class="premium-input-label">{{ __('common.security_verification') }}</label>
                                    <div class="row align-items-center g-3">
                                        <div class="col-md-8">
                                            <input type="text" id="captcha" name="captcha" autocomplete="off" class="premium-form-input" placeholder="{{ __('common.fill_captcha') }}" required>
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
                                        <i class="fas fa-paper-plane me-2"></i> {{ __('common.send_reset_link') }}
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
                                <a href="{{route('login.form')}}" class="register-redirect-link fw-bold text-decoration-none">{{ __('common.login') }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* ============================================================
       FORGOT PASSWORD PAGE - REVAMPED PREMIUM EDITORIAL STYLE
       ============================================================ */

    .auth-page-section {
        background-color: #fffdfb; /* Crisp warm backdrop */
        position: relative;
        overflow: hidden;
    }

    /* Ambient blur backdrop shapes */
    .auth-bg-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(90px);
        -webkit-filter: blur(90px);
        pointer-events: none;
        opacity: 0.55;
        z-index: 1;
    }

    .auth-bg-blob.blob-1 {
        width: 380px;
        height: 380px;
        background-color: var(--color-mint-wash, #f0f6df);
        top: -100px;
        left: -120px;
    }

    .auth-bg-blob.blob-2 {
        width: 320px;
        height: 320px;
        background-color: var(--color-sky-wash, #dceaff);
        bottom: -80px;
        right: -80px;
    }

    .auth-content-container {
        position: relative;
        z-index: 2;
    }

    /* Single Unified Premium Card Layout */
    .unified-auth-card {
        background-color: var(--surface-paper-canvas, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-cards, 12px);
        overflow: hidden;
        box-shadow: var(--shadow-subtle, 0px 1px 0px 0px rgba(37, 34, 30, 0.04));
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        animation: slideInUp 0.6s ease-out;
    }

    .unified-auth-card:hover {
        border-color: var(--color-stone, #d7d6d4);
        box-shadow: var(--shadow-lg, 0px 14px 19px -9px rgba(37, 34, 30, 0.07), 0px 10px 48px 0px rgba(37, 34, 30, 0.18));
    }

    /* Left Panel details style */
    .brand-details-panel {
        background-color: var(--surface-cream-wash, #fff6f0);
        border-right: 1px solid var(--color-stone, #d7d6d4);
    }

    .panel-content {
        padding: var(--spacing-48, 48px);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .panel-title {
        font-family: var(--font-graphik), sans-serif;
        font-size: var(--text-heading, 38px);
        font-weight: var(--font-weight-bold, 700);
        line-height: var(--leading-heading, 1.28);
        letter-spacing: var(--tracking-heading, -0.19px);
        color: var(--color-ink, #25221e);
    }

    .panel-text {
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-body, 16px);
        line-height: var(--leading-body, 1.5);
        color: var(--color-pencil, #6f6c69);
    }

    /* Benefits Metadata List inside the panel */
    .benefits-info-list {
        display: flex;
        flex-direction: column;
    }

    .benefit-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }

    .benefit-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 6px;
        background-color: var(--surface-paper-canvas, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        color: var(--color-deep-ember, #cf3520);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .benefit-item:hover .benefit-icon {
        background-color: var(--color-ember-red, #e34432);
        border-color: var(--color-ember-red, #e34432);
        color: #ffffff;
    }

    .benefit-body {
        display: flex;
        flex-direction: column;
    }

    .benefit-title {
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-body-sm, 14px);
        font-weight: var(--font-weight-semibold, 600);
        color: var(--color-ink, #25221e);
        margin-bottom: 2px;
    }

    .benefit-desc {
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-caption, 12px);
        color: var(--color-pencil, #6f6c69);
        line-height: 1.4;
    }

    /* Bottom Brand Mark */
    .panel-brand-mark {
        display: flex;
        flex-direction: column;
        border-top: 1px solid var(--color-stone, #d7d6d4);
        padding-top: 24px;
    }

    .brand-mark-title {
        font-family: var(--font-graphik), sans-serif;
        font-size: var(--text-body-lg, 18px);
        font-weight: var(--font-weight-bold, 700);
        color: var(--color-ink, #25221e);
    }

    .brand-mark-desc {
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-caption, 12px);
        color: var(--color-pencil, #6f6c69);
    }

    /* Right Panel: Clean Form Panel */
    .form-panel {
        background-color: var(--surface-paper-canvas, #fefdfc);
    }

    .form-title {
        font-family: var(--font-graphik), sans-serif;
        font-size: var(--text-subheading, 21px);
        font-weight: var(--font-weight-bold, 700);
        color: var(--color-ink, #25221e);
        margin: 0 0 8px 0;
    }

    .form-subtitle {
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-body-sm, 14px);
        color: var(--color-pencil, #6f6c69);
        margin: 0;
    }

    /* Premium Input Elements */
    .premium-input-label {
        display: block;
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-caption, 12px);
        font-weight: var(--font-weight-semibold, 600);
        color: var(--color-ink, #25221e);
        margin-bottom: 8px;
    }

    .premium-form-input {
        width: 100%;
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-body-sm, 14px);
        font-weight: var(--font-weight-medium, 500);
        color: var(--color-ink, #25221e);
        background-color: var(--surface-paper-canvas, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-inputs, 8px);
        padding: 12px 16px;
        transition: all 0.25s cubic-bezier(0.165, 0.84, 0.44, 1);
        outline: none;
    }

    .premium-form-input::placeholder {
        color: var(--color-graphite, #94928f);
        font-weight: var(--font-weight-regular, 400);
    }

    .premium-form-input:focus {
        border-color: var(--color-ember-red, #e34432);
        background-color: var(--surface-paper-canvas, #fefdfc);
        box-shadow: 0 0 0 3px rgba(227, 68, 50, 0.08);
    }

    /* Validation and Error elements */
    .premium-form-input.is-invalid, .premium-form-input.error {
        border-color: var(--color-ember-red, #e34432) !important;
        background-color: #fffaf9 !important;
    }

    .premium-error-msg {
        color: var(--color-deep-ember, #cf3520);
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-caption, 12px);
        font-weight: var(--font-weight-medium, 500);
    }

    label.error {
        color: var(--color-deep-ember, #cf3520) !important;
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-caption, 12px) !important;
        font-weight: var(--font-weight-medium, 500) !important;
        margin-top: 6px !important;
        display: block !important;
    }

    .captcha-image-container img {
        border-radius: var(--radius-inputs, 8px);
        border: 1px solid var(--color-stone, #d7d6d4);
    }

    /* Submit Button */
    .premium-submit-btn {
        width: 100%;
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-body-sm, 14px);
        font-weight: var(--font-weight-semibold, 600);
        color: #ffffff;
        background-color: var(--color-ember-red, #e34432);
        border: 1px solid var(--color-ember-red, #e34432);
        border-radius: var(--radius-buttons, 8px);
        padding: 14px 24px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 4px 14px rgba(227, 68, 50, 0.2);
    }

    .premium-submit-btn:hover {
        background-color: var(--color-deep-ember, #cf3520);
        border-color: var(--color-deep-ember, #cf3520);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(227, 68, 50, 0.35);
    }

    .premium-submit-btn:active {
        transform: translateY(0);
    }

    /* Badges & Links Style */
    .modern-badge {
        display: inline-block;
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-caption, 12px);
        font-weight: var(--font-weight-semibold, 600);
        line-height: 1;
        color: var(--color-deep-ember, #cf3520);
        background-color: var(--surface-cream-wash, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-badges, 8px);
        padding: 6px 12px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    .register-redirect-link {
        color: var(--color-ember-red, #e34432);
        transition: color 0.2s ease;
    }

    .register-redirect-link:hover {
        color: var(--color-deep-ember, #cf3520);
        text-decoration: underline !important;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 991px) {
        .brand-details-panel {
            border-right: none;
            border-bottom: 1px solid var(--color-stone, #d7d6d4);
        }
    }

    @media (max-width: 768px) {
        .panel-content {
            padding: var(--spacing-24, 24px);
        }
    }
</style>
@endpush

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
                email: "{{ __('common.email_required') }}",
                captcha: "{{ __('common.fill_it') }}"
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
