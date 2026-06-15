@extends('frontend.layouts.main')
@section('title','Contact Us')
@section('main-content')

<x-breadcrumb 
    :title="__('common.contact')" 
    :routes="[
        ['label' => __('common.contact')]
    ]" 
/>

<section class="contact-page-section">
    <!-- Ambient blurred background shapes for warm atmosphere -->
    <div class="contact-bg-blob blob-1"></div>
    <div class="contact-bg-blob blob-2"></div>

    <div class="container contact-content-container">
        <!-- Single Unified Premium Card with Asymmetric Layout -->
        <div class="unified-contact-card">
            <div class="row g-0 h-100">
                <!-- Left half: Brand Canvas & Company Details (No Phone) -->
                <div class="col-lg-5 brand-details-panel">
                    <div class="panel-content">
                        <div>
                            <span class="modern-badge mb-3">{{ __('common.get_in_touch') }}</span>
                            <h2 class="panel-title mb-4">{{ __('common.contact_header') }}</h2>
                            <p class="panel-text mb-5">
                                Have questions about our masterclasses, schedules, or curriculum? Write to us, and our team will get back to you within 24 hours.
                            </p>
                        </div>

                        <!-- Company Metadata List -->
                        <div class="company-info-list">
                            <!-- Company Name -->
                            <div class="info-item mb-4">
                                <div class="info-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="info-body">
                                    <span class="info-label">{{ __('common.company') }}</span>
                                    <span class="info-value">{{ $misc['Company Name'] ?? __('common.company_name') }}</span>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="info-item mb-4">
                                <div class="info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info-body">
                                    <span class="info-label">{{ __('common.email') }}</span>
                                    <a href="mailto:{{ $misc['Company Email'] ?? __('common.company_email') }}" class="info-value link-value">
                                        {{ $misc['Company Email'] ?? __('common.company_email') }}
                                    </a>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info-body">
                                    <span class="info-label">{{ __('common.our_location') }}</span>
                                    <span class="info-value">{{ $misc['Company Address'] ?? __('common.company_Address') }}</span>
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

                <!-- Right half: Clean Form Panel -->
                <div class="col-lg-7 form-panel">
                    <div class="panel-content">
                        <div class="form-panel-intro mb-4">
                            <h3 class="form-title">{{ __('common.contact') }}</h3>
                            <p class="form-subtitle">
                                <i class="fas fa-info-circle text-muted me-1"></i>
                                {{ __('common.contact_message') }}
                            </p>
                        </div>

                        <form method="POST" action="{{ route('contact.send') }}" id="contactform" onsubmit="return handleSubmit(event)">
                            @csrf
                            <div class="row g-4">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <label class="premium-input-label" for="name">
                                        <i class="fas fa-user me-2"></i>{{ __('common.name') }}
                                    </label>
                                    <input type="text" name="name" id="name" placeholder="{{ __('common.enter_name') }}" class="premium-form-input @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="premium-error-msg mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label class="premium-input-label" for="email">
                                        <i class="fas fa-envelope me-2"></i>{{ __('common.email') }}
                                    </label>
                                    <input type="email" name="email" id="email" placeholder="{{ __('common.enter_email') }}" class="premium-form-input @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="premium-error-msg mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <!-- Subject -->
                                <div class="col-12">
                                    <label class="premium-input-label" for="subject">
                                        <i class="fas fa-tag me-2"></i>{{ __('common.your_subject') }}
                                    </label>
                                    <input type="text" name="subject" id="subject" placeholder="{{ __('common.enter_subject') }}" class="premium-form-input">
                                </div>

                                <!-- Message -->
                                <div class="col-12">
                                    <label class="premium-input-label" for="message">
                                        <i class="fas fa-comment-dots me-2"></i>{{ __('common.your_message') }}
                                    </label>
                                    <textarea name="message" id="message" rows="5" placeholder="{{ __('common.enter_message') }}" class="premium-form-input"></textarea>
                                </div>

                                <!-- Captcha (optional) -->
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

                                <!-- Submit Button -->
                                <div class="col-12 mt-4">
                                    <button type="submit" class="premium-submit-btn">
                                        <i class="fas fa-paper-plane me-2"></i> {{ __('common.send_message') }}
                                    </button>
                                </div>
                            </div>
                        </form>
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
       CONTACT PAGE - REVAMPED PREMIUM EDITORIAL STYLE
       ============================================================ */

    .contact-page-section {
        background-color: #fffdfb; /* Crisp warm backdrop */
        position: relative;
        overflow: hidden;
    }

    /* Ambient blur backdrop shapes */
    .contact-bg-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(90px);
        -webkit-filter: blur(90px);
        pointer-events: none;
        opacity: 0.55;
        z-index: 1;
    }

    .contact-bg-blob.blob-1 {
        width: 380px;
        height: 380px;
        background-color: var(--color-mint-wash, #f0f6df);
        top: -100px;
        left: -120px;
    }

    .contact-bg-blob.blob-2 {
        width: 320px;
        height: 320px;
        background-color: var(--color-sky-wash, #dceaff);
        bottom: -80px;
        right: -80px;
    }

    .contact-content-container {
        position: relative;
        z-index: 2;
    }

    /* Single Unified Premium Card Layout */
    .unified-contact-card {
        background-color: var(--surface-paper-canvas, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-cards, 12px);
        overflow: hidden;
        box-shadow: var(--shadow-subtle, 0px 1px 0px 0px rgba(37, 34, 30, 0.04));
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        animation: slideInUp 0.6s ease-out;
    }

    .unified-contact-card:hover {
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

    /* Company Metadata List inside the panel */
    .company-info-list {
        display: flex;
        flex-direction: column;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }

    .info-icon {
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

    .info-item:hover .info-icon {
        background-color: var(--color-ember-red, #e34432);
        border-color: var(--color-ember-red, #e34432);
        color: #ffffff;
    }

    .info-body {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-caption, 12px);
        font-weight: var(--font-weight-semibold, 600);
        color: var(--color-graphite, #94928f);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        line-height: 1.2;
        margin-bottom: 4px;
    }

    .info-value {
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-body-sm, 14px);
        color: var(--color-ink, #25221e);
        font-weight: var(--font-weight-medium, 500);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    a.info-value:hover {
        color: var(--color-ember-red, #e34432);
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
    .premium-form-input.is-invalid {
        border-color: var(--color-ember-red, #e34432) !important;
        background-color: #fffaf9 !important;
    }

    .premium-error-msg {
        color: var(--color-deep-ember, #cf3520);
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-caption, 12px);
        font-weight: var(--font-weight-medium, 500);
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

    /* Badges Style */
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
<script>
    function handleSubmit(event) {
        event.preventDefault();

        // Get form values
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const message = document.getElementById('message').value.trim();

        // Clear previous error messages
        document.querySelectorAll('.custom-error-message').forEach(el => el.remove());
        document.querySelectorAll('.premium-form-input').forEach(el => el.classList.remove('is-invalid'));

        let hasErrors = false;
        const errors = [];

        // Validation checks
        if (!name) {
            errors.push({ field: 'name', message: '{{ __('common.validate_name') }}' });
            hasErrors = true;
        }

        if (!email) {
            errors.push({ field: 'email', message: '{{ __('common.validate_email') }}' });
            hasErrors = true;
        } else if (!isValidEmail(email)) {
            errors.push({ field: 'email', message: '{{ __('common.validate_email_invalid') }}' });
            hasErrors = true;
        }

        if (!subject) {
            errors.push({ field: 'subject', message: '{{ __('common.validate_subject') }}' });
            hasErrors = true;
        }

        if (!message) {
            errors.push({ field: 'message', message: '{{ __('common.validate_message') }}' });
            hasErrors = true;
        }

        // Show error messages
        if (hasErrors) {
            errors.forEach(error => {
                const field = document.getElementById(error.field);
                if (field) {
                    field.classList.add('is-invalid');
                    const errorDiv = document.createElement('span');
                    errorDiv.className = 'text-danger small mt-2 d-block custom-error-message';
                    errorDiv.innerHTML = `<i class="fas fa-info-circle me-1"></i>${error.message}`;
                    field.parentElement.appendChild(errorDiv);
                }
            });
            return false;
        }

        // If no errors, submit the form
        document.getElementById('contactform').submit();
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Add real-time validation
    document.getElementById('name')?.addEventListener('change', function() {
        this.classList.toggle('is-invalid', !this.value.trim());
        const errorMsg = this.parentElement.querySelector('.custom-error-message');
        if (errorMsg && this.value.trim()) errorMsg.remove();
    });

    document.getElementById('email')?.addEventListener('change', function() {
        const isValid = this.value.trim() && isValidEmail(this.value.trim());
        this.classList.toggle('is-invalid', !isValid);
        const errorMsg = this.parentElement.querySelector('.custom-error-message');
        if (errorMsg && isValid) errorMsg.remove();
    });

    document.getElementById('subject')?.addEventListener('change', function() {
        this.classList.toggle('is-invalid', !this.value.trim());
        const errorMsg = this.parentElement.querySelector('.custom-error-message');
        if (errorMsg && this.value.trim()) errorMsg.remove();
    });

    document.getElementById('message')?.addEventListener('change', function() {
        this.classList.toggle('is-invalid', !this.value.trim());
        const errorMsg = this.parentElement.querySelector('.custom-error-message');
        if (errorMsg && this.value.trim()) errorMsg.remove();
    });
</script>
@endpush
