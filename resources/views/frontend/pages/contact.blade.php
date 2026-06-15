@extends('frontend.layouts.main')
@section('title','Contact Us')
@section('main-content')

<div class="tl-breadcrumb contact-banner pt-60 pb-60">
    <video autoplay muted loop playsinline>
        <source src="{{ asset('assets/images/breadcrumb.mp4') }}" type="video/mp4">
    </video>
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.contact') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.contact') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="contact-section pt-60 pb-80 bg-light" style="position: relative; overflow: hidden;">
    <!-- Decorative Blobs -->
    <div class="modern-blob modern-blob-1" style="top: -100px; left: -100px; width: 400px; height: 400px; background: rgba(var(--modern-primary-rgb), 0.05);"></div>
    <div class="modern-blob modern-blob-2" style="bottom: -100px; right: -100px; width: 400px; height: 400px; background: rgba(var(--modern-primary-rgb), 0.05);"></div>

    <div class="container">
        <div class="row g-5">
            <!-- Left: Contact Details -->
            <div class="col-xl-4 col-lg-5 d-none d-lg-block">
                <span class="modern-badge mb-3">{{ __('common.get_in_touch') }}</span>
                <h3 class="modern-h2 mb-5" style="font-size: 24px; color: var(--text-dark);">{{ __('common.contact_header') }}</h3>

                <div class="contact-info-cards">
                    <div class="modern-card p-4 mb-4 border-0 shadow-sm d-flex align-items-start gap-3">
                        <div class="bg-primary text-white border-0 flex-shrink-0 d-flex align-items-center justify-content-center rounded-3" style="width: 50px; height: 50px; min-width: 50px;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-2" style="color: var(--text-dark);">{{ __('common.email') }}</h6>
                            <a href="mailto:{{ $misc['Company Email'] ?? __('common.company_email') }}" class="text-muted text-decoration-none small">{{ $misc['Company Email'] ?? __('common.company_email') }}</a>
                        </div>
                    </div>

                    <div class="modern-card p-4 mb-4 border-0 shadow-sm d-flex align-items-start gap-3">
                        <div class="bg-primary text-white border-0 flex-shrink-0 d-flex align-items-center justify-content-center rounded-3" style="width: 50px; height: 50px; min-width: 50px;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-2" style="color: var(--text-dark);">{{ __('common.our_location') }}</h6>
                            <span class="text-muted small">{{ $misc['Company Address'] ?? __('common.company_Address') }}</span>
                        </div>
                    </div>

                    <div class="modern-card p-4 mb-4 border-0 shadow-sm d-flex align-items-start gap-3">
                        <div class="bg-primary text-white border-0 flex-shrink-0 d-flex align-items-center justify-content-center rounded-3" style="width: 50px; height: 50px; min-width: 50px;">
                            <i class="fas fa-building"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-2" style="color: var(--text-dark);">{{ __('common.company') }}</h6>
                            <span class="text-muted small">{{ $misc['Company Name'] ?? __('common.company_name') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Contact Form -->
            <div class="col-xl-8 col-lg-7 col-md-12">
                <div class="modern-card contact-card border-0 shadow-xl overflow-hidden" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(20px); border-radius: 20px;">
                    <!-- Header Section with Gradient -->
                    <div class="contact-card-header p-5 text-center" style="background: linear-gradient(135deg, var(--primary-10) 0%, var(--secondary-10) 100%);">
                        <div class="mb-3">
                            <i class="fas fa-envelope text-primary" style="font-size: 48px; opacity: 0.8;"></i>
                        </div>
                       
                        <h2 class="modern-h2 mb-0" style="font-size: 28px; color: var(--text-dark);">{{ __('common.contact') }}</h2>
                    </div>

                    <!-- Content Section -->
                    <div class="p-5">
                        <p class="text-muted text-center mb-5" style="font-size: 14px;">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            {{ __('common.contact_message') }}
                        </p>

                        <form method="POST" action="{{ route('contact.send') }}" id="contactform" onsubmit="return handleSubmit(event)">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="small fw-bold text-uppercase opacity-75 mb-2 d-flex align-items-center">
                                        <i class="fas fa-user text-primary me-2" style="font-size: 12px;"></i>
                                        {{ __('common.name') }}
                                    </label>
                                    <input type="text" name="name" id="name" placeholder="{{ __('common.enter_name') }}" class="form-control form-control-lg bg-light border-1 py-3 px-4 rounded-3 @error('name') is-invalid @enderror" style="border-color: var(--border-light);">
                                    @error('name')
                                        <span class="text-danger small mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="small fw-bold text-uppercase opacity-75 mb-2 d-flex align-items-center">
                                        <i class="fas fa-envelope text-primary me-2" style="font-size: 12px;"></i>
                                        {{ __('common.email') }}
                                    </label>
                                    <input type="email" name="email" id="email" placeholder="{{ __('common.enter_email') }}" class="form-control form-control-lg bg-light border-1 py-3 px-4 rounded-3 @error('email') is-invalid @enderror" style="border-color: var(--border-light);">
                                    @error('email')
                                        <span class="text-danger small mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="small fw-bold text-uppercase opacity-75 mb-2 d-flex align-items-center">
                                        <i class="fas fa-phone text-primary me-2" style="font-size: 12px;"></i>
                                        {{ __('common.phone') }}
                                    </label>
                                    <input type="text" name="phone" id="phone" placeholder="{{ __('common.phone') }}" class="form-control form-control-lg bg-light border-1 py-3 px-4 rounded-3 @error('phone') is-invalid @enderror" style="border-color: var(--border-light);" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    @error('phone')
                                        <span class="text-danger small mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="small fw-bold text-uppercase opacity-75 mb-2 d-flex align-items-center">
                                        <i class="fas fa-tag text-primary me-2" style="font-size: 12px;"></i>
                                        {{ __('common.your_subject') }}
                                    </label>
                                    <input type="text" name="subject" id="subject" placeholder="{{ __('common.enter_subject') }}" class="form-control form-control-lg bg-light border-1 py-3 px-4 rounded-3" style="border-color: var(--border-light);">
                                </div>

                                <div class="col-12">
                                    <label class="small fw-bold text-uppercase opacity-75 mb-2 d-flex align-items-center">
                                        <i class="fas fa-message text-primary me-2" style="font-size: 12px;"></i>
                                        {{ __('common.your_message') }}
                                    </label>
                                    <textarea name="message" id="message" rows="4" placeholder="{{ __('common.enter_message') }}" class="form-control form-control-lg bg-light border-1 py-3 px-4 rounded-3" style="border-color: var(--border-light);"></textarea>
                                </div>

                                @if(env('CAPTCHA_ENABLED', true))
                                    <div class="col-12 pt-3">
                                        <label class="small fw-bold text-uppercase opacity-75 mb-2 d-block">{{ __('common.security_verification') }}</label>
                                        <div class="row align-items-center g-3">
                                            <div class="col-md-8">
                                                <input type="text" id="captcha" name="captcha" autocomplete="off" class="form-control form-control-lg bg-light border-1 py-3 px-4 rounded-3" placeholder="{{ __('common.fill_captcha') }}"  style="border-color: var(--border-light);">
                                            </div>
                                            <div class="col-md-4 cpatcha-imgs text-center">
                                                @captcha
                                            </div>
                                        </div>
                                        @error('captcha')
                                            <span class="text-danger small mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{ __('common.captcha_error') }}</span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="col-12 mt-4">
                                    <button type="submit" class="modern-btn modern-btn-solid w-100 py-3 fw-bold shadow-lg rounded-3" style="font-size: 15px; letter-spacing: 0.5px;">
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
    .contact-card {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        animation: slideInUp 0.6s ease-out;
    }

    .contact-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(var(--primary-rgb), 0.25) !important;
    }

    .contact-card-header {
        border-bottom: 1px solid rgba(var(--primary-rgb), 0.1);
    }

    .form-control {
        font-size: 15px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 1px solid var(--border-light) !important;
    }

    .form-control:focus {
        background-color: var(--white) !important;
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 4px rgba(var(--primary-rgb), 0.15) !important;
    }

    .form-control::placeholder {
        color: #a0aec0;
        font-weight: 400;
    }

    .form-control-lg {
        border-radius: 12px;
    }

    .error {
        color: #dc3545 !important;
        font-size: 13px;
        margin-top: 5px;
        font-weight: 500;
    }

    .cpatcha-imgs img {
        border-radius: 12px;
        border: 1px solid var(--border-light);
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
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
        const phone = document.getElementById('phone').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const message = document.getElementById('message').value.trim();

        // Clear previous error messages
        document.querySelectorAll('.custom-error-message').forEach(el => el.remove());
        document.querySelectorAll('.form-control').forEach(el => el.classList.remove('is-invalid'));

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

        if (!phone) {
            errors.push({ field: 'phone', message: '{{ __('common.validate_phone') }}' });
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

    document.getElementById('phone')?.addEventListener('change', function() {
        this.classList.toggle('is-invalid', !this.value.trim());
        const errorMsg = this.parentElement.querySelector('.custom-error-message');
        if (errorMsg && this.value.trim()) errorMsg.remove();
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
