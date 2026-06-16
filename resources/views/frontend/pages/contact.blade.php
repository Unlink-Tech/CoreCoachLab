@extends('frontend.layouts.main')
@section('page-body-class', 'page-contact')
@section('title','Contact Us')
@section('main-content')

<x-breadcrumb
    :title="__('common.header.contact')"
    :routes="[
        ['label' => __('common.header.contact')]
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
                                {{ __('common.contact.panel_description') }}
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
                            <span class="brand-mark-title">{{ __('common.contact.brand_name') }}</span>
                            <span class="brand-mark-desc">{{ __('common.contact.brand_tagline') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right half: Clean Form Panel -->
                <div class="col-lg-7 form-panel">
                    <div class="panel-content">
                        <div class="form-panel-intro mb-4">
                            <h3 class="form-title">{{ __('common.contact.form_title') }}</h3>
                            <p class="form-subtitle">
                                <i class="fas fa-info-circle text-muted me-1"></i>
                                {{ __('common.contact.form_subtitle') }}
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
                                    <input type="text" name="name" id="name" placeholder="{{ __('common.contact.field_name_placeholder') }}" class="premium-form-input @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="premium-error-msg mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label class="premium-input-label" for="email">
                                        <i class="fas fa-envelope me-2"></i>{{ __('common.email') }}
                                    </label>
                                    <input type="email" name="email" id="email" placeholder="{{ __('common.contact.field_email_placeholder') }}" class="premium-form-input @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="premium-error-msg mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <!-- Subject -->
                                <div class="col-12">
                                    <label class="premium-input-label" for="subject">
                                        <i class="fas fa-tag me-2"></i>{{ __('common.your_subject') }}
                                    </label>
                                    <input type="text" name="subject" id="subject" placeholder="{{ __('common.contact.field_subject_placeholder') }}" class="premium-form-input">
                                </div>

                                <!-- Message -->
                                <div class="col-12">
                                    <label class="premium-input-label" for="message">
                                        <i class="fas fa-comment-dots me-2"></i>{{ __('common.your_message') }}
                                    </label>
                                    <textarea name="message" id="message" rows="5" placeholder="{{ __('common.contact.field_message_placeholder') }}" class="premium-form-input"></textarea>
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
            errors.push({ field: 'name', message: '{{ __('common.contact.validation_name_required') }}' });
            hasErrors = true;
        }

        if (!email) {
            errors.push({ field: 'email', message: '{{ __('common.contact.validation_email_required') }}' });
            hasErrors = true;
        } else if (!isValidEmail(email)) {
            errors.push({ field: 'email', message: '{{ __('common.contact.validation_email_invalid') }}' });
            hasErrors = true;
        }

        if (!subject) {
            errors.push({ field: 'subject', message: '{{ __('common.contact.validation_subject_required') }}' });
            hasErrors = true;
        }

        if (!message) {
            errors.push({ field: 'message', message: '{{ __('common.contact.validation_message_required') }}' });
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
