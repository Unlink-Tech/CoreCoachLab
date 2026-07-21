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

<section class="ct-hero">
    <span class="ct-hero__blob ct-hero__blob--a" aria-hidden="true"></span>
    <span class="ct-hero__blob ct-hero__blob--b" aria-hidden="true"></span>

    <div class="container ct-hero__inner">
        {{-- Heading --}}
        <div class="ct-hero__heading text-center">
            <span class="ct-eyebrow">
                <span class="ct-eyebrow__dot" aria-hidden="true"></span>
                {{ __('common.get_in_touch') }}
            </span>
            <h1 class="ct-hero__title">{{ __('common.contact_header') }}</h1>
            <p class="ct-hero__lede">{{ __('common.contact.panel_description') }}</p>
            <span class="ct-hero__rule" aria-hidden="true"></span>
        </div>

        {{-- Contact info cards --}}
        <div class="ct-info-grid">
            <div class="ct-info">
                <span class="ct-info__icon"><i class="fas fa-building"></i></span>
                <span class="ct-info__label">{{ __('common.company') }}</span>
                <span class="ct-info__value">{{ $misc['Company Name'] ?? __('common.company_name') }}</span>
            </div>
            <div class="ct-info">
                <span class="ct-info__icon"><i class="fas fa-envelope"></i></span>
                <span class="ct-info__label">{{ __('common.email') }}</span>
                <a href="mailto:{{ $misc['Company Email'] ?? __('common.company_email') }}" class="ct-info__value ct-info__value--link">
                    {{ $misc['Company Email'] ?? __('common.company_email') }}
                </a>
            </div>
            <div class="ct-info">
                <span class="ct-info__icon"><i class="fas fa-map-marker-alt"></i></span>
                <span class="ct-info__label">{{ __('common.our_location') }}</span>
                <span class="ct-info__value">{{ $misc['Company Address'] ?? __('common.company_Address') }}</span>
            </div>
        </div>
    </div>
</section>

<section class="ct-form-section">
    <span class="ct-form-section__blob" aria-hidden="true"></span>

    <div class="auto-container ct-form-section__inner">
        <div class="ct-form-heading text-center">
            <span class="ct-eyebrow">
                <span class="ct-eyebrow__dot" aria-hidden="true"></span>
                {{ __('common.contact.form_title') }}
            </span>
            <h2 class="ct-form-heading__title">{{ __('common.contact.form_title') }}</h2>
            <p class="ct-form-heading__sub">{{ __('common.contact.form_subtitle') }}</p>
        </div>

        <div class="ct-form-card">
            <form method="POST" action="{{ route('contact.send') }}" id="contactform" onsubmit="return handleSubmit(event)" class="ct-form">
                @csrf
                <div class="ct-form__row">
                    {{-- Name --}}
                    <div class="ct-form__field">
                        <label class="ct-form__label" for="name">
                            <i class="fas fa-user"></i>{{ __('common.name') }}
                        </label>
                        <input type="text" name="name" id="name"
                               placeholder="{{ __('common.contact.field_name_placeholder') }}"
                               class="premium-form-input ct-form__input @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="ct-form__error"><i class="fas fa-info-circle"></i> {{$message}}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="ct-form__field">
                        <label class="ct-form__label" for="email">
                            <i class="fas fa-envelope"></i>{{ __('common.email') }}
                        </label>
                        <input type="email" name="email" id="email"
                               placeholder="{{ __('common.contact.field_email_placeholder') }}"
                               class="premium-form-input ct-form__input @error('email') is-invalid @enderror">
                        @error('email')
                            <span class="ct-form__error"><i class="fas fa-info-circle"></i> {{$message}}</span>
                        @enderror
                    </div>
                </div>

                {{-- Subject --}}
                <div class="ct-form__field">
                    <label class="ct-form__label" for="subject">
                        <i class="fas fa-tag"></i>{{ __('common.your_subject') }}
                    </label>
                    <input type="text" name="subject" id="subject"
                           placeholder="{{ __('common.contact.field_subject_placeholder') }}"
                           class="premium-form-input ct-form__input">
                </div>

                {{-- Message --}}
                <div class="ct-form__field">
                    <label class="ct-form__label" for="message">
                        <i class="fas fa-comment-dots"></i>{{ __('common.your_message') }}
                    </label>
                    <textarea name="message" id="message" rows="6"
                              placeholder="{{ __('common.contact.field_message_placeholder') }}"
                              class="premium-form-input ct-form__input ct-form__textarea"></textarea>
                </div>

                {{-- Captcha --}}
                @if(env('CAPTCHA_ENABLED', true))
                    <div class="ct-form__field">
                        <label class="ct-form__label" for="captcha">
                            <i class="fas fa-shield-alt"></i>{{ __('common.security_verification') }}
                        </label>
                        <div class="ct-form__captcha">
                            <input type="text" id="captcha" name="captcha" autocomplete="off"
                                   placeholder="{{ __('common.fill_captcha') }}"
                                   class="premium-form-input ct-form__input">
                            <div class="ct-form__captcha-img">@captcha</div>
                        </div>
                        @error('captcha')
                            <span class="ct-form__error"><i class="fas fa-info-circle"></i> {{ __('common.captcha_error') }}</span>
                        @enderror
                    </div>
                @endif

                {{-- Submit --}}
                <button type="submit" class="ct-form__submit">
                    <span>{{ __('common.send_message') }}</span>
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
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
