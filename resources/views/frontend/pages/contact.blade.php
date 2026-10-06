@extends('frontend.layouts.main')
@section('page-body-class', 'page-contact')
@section('title','Contact Us')
@section('main-content')

{{-- Layout and content mirror ventureasiamarkets.com/contact. Styles: public/assets/css/home-hero.css --}}
@php
    $vaTopics = ['Opening an account', 'Markets & instruments', 'Funding & withdrawals', 'Platform & technical', 'Refunds & cancellations', 'Something else'];
@endphp

{{-- Page hero --}}
<section class="va-page-hero" style="padding-bottom: 0;">
    <div class="va-hero__container">
        <div class="va-breadcrumb" data-va-reveal><a href="{{ route('home') }}">Home</a> / Contact</div>
        <div style="max-width: 720px;">
            <h1 data-va-reveal>Talk to us.</h1>
            <p class="va-lead" data-va-reveal>Questions about markets, accounts or funding? Our multilingual team is available 24 hours a day, five days a week.</p>
        </div>
    </div>
</section>

<section class="va-section">
    <div class="va-hero__container va-split va-split--start va-split--contact">

        {{-- Contact details --}}
        <div data-va-reveal>
            <div class="va-card">
                <h3 class="va-feat-title">Customer service</h3>
                <div class="va-contact-line">
                    <span class="va-ci">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                    </span>
                    <div>
                        <div class="va-contact-line__key">Email</div>
                        <a class="va-contact-line__link" href="mailto:support@ventureasiamarkets.com">support@ventureasiamarkets.com</a>
                    </div>
                </div>
                <div class="va-contact-line">
                    <span class="va-ci">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 21s-7-6.3-7-11a7 7 0 0114 0c0 4.7-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
                    </span>
                    <div>
                        <div class="va-contact-line__key">Permanent establishment</div>
                        <div class="va-contact-line__val">Venture Asia,<br>3 Emerald Park, Trianon, Quatre Bornes, 72257, Mauritius.</div>
                    </div>
                </div>
                <div class="va-contact-line">
                    <span class="va-ci">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                    </span>
                    <div>
                        <div class="va-contact-line__key">Support hours</div>
                        <div class="va-contact-line__val">24 hours / 5 days (Mon–Fri)</div>
                    </div>
                </div>
            </div>

            <div class="va-card va-card-billing">
                <div class="va-card-billing__badges">
                    <span class="va-pay-badge">
                        <svg viewBox="0 0 48 16" xmlns="http://www.w3.org/2000/svg" aria-label="Visa"><text x="0" y="13" font-family="Arial, sans-serif" font-weight="700" font-style="italic" font-size="15" fill="#1A1F71" style="font-size: 15px">VISA</text></svg>
                    </span>
                    <span class="va-pay-badge">
                        <svg viewBox="0 0 40 24" xmlns="http://www.w3.org/2000/svg" aria-label="Mastercard"><circle cx="15" cy="12" r="9" fill="#EB001B"/><circle cx="25" cy="12" r="9" fill="#F79E1B"/><path d="M20 5.2a9 9 0 000 13.6 9 9 0 000-13.6z" fill="#FF5F00"/></svg>
                    </span>
                </div>
                <p class="va-card-billing__text">
                    Card transactions are billed by <strong>Venture Asia</strong> (merchant outlet country: <strong>Republic of Mauritius</strong>) and processed in <strong>US Dollars (USD, $)</strong> over a secure, encrypted connection.
                </p>
            </div>
        </div>

        {{-- Message form --}}
        <div data-va-reveal>
            <form class="va-card va-form" id="contact-form" method="POST" action="{{ route('contact.send') }}" novalidate>
                @csrf
                <h3 class="va-feat-title" style="margin-bottom: 6px;">Send us a message</h3>
                <p class="va-form__intro">We'll get back to you within one business day.</p>

                @if(session('success'))
                    <div class="va-form-ok" role="status">Thanks! Your message has been noted. Our team will be in touch shortly.</div>
                @endif
                @if(session('error'))
                    <div class="va-form-err" role="alert">{{ session('error') }}</div>
                @endif

                <div class="va-grid va-grid-2 va-form__row" style="margin-top: 4px;">
                    <div class="va-field">
                        <label for="fn">First name</label>
                        <input id="fn" name="first_name" type="text" value="{{ old('first_name') }}" autocomplete="given-name" required>
                        @error('first_name')<span class="va-field__err">{{ $message }}</span>@enderror
                    </div>
                    <div class="va-field">
                        <label for="ln">Last name</label>
                        <input id="ln" name="last_name" type="text" value="{{ old('last_name') }}" autocomplete="family-name" required>
                        @error('last_name')<span class="va-field__err">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="va-grid va-grid-2 va-form__row" style="margin-top: 16px;">
                    <div class="va-field">
                        <label for="em">Email</label>
                        <input id="em" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>
                        @error('email')<span class="va-field__err">{{ $message }}</span>@enderror
                    </div>
                    <div class="va-field">
                        <label for="ph">Phone (optional)</label>
                        <input id="ph" name="phone" type="tel" value="{{ old('phone') }}" autocomplete="tel">
                        @error('phone')<span class="va-field__err">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="va-field" style="margin-top: 16px;">
                    <label for="topic">Topic</label>
                    <select id="topic" name="topic">
                        @foreach($vaTopics as $topic)
                            <option {{ old('topic', $vaTopics[0]) === $topic ? 'selected' : '' }}>{{ $topic }}</option>
                        @endforeach
                    </select>
                    @error('topic')<span class="va-field__err">{{ $message }}</span>@enderror
                </div>
                <div class="va-field" style="margin-top: 16px;">
                    <label for="msg">Message</label>
                    <textarea id="msg" name="message" placeholder="How can we help?" required>{{ old('message') }}</textarea>
                    @error('message')<span class="va-field__err">{{ $message }}</span>@enderror
                </div>
                <label class="va-form__agree">
                    <input type="checkbox" id="agree" name="agree" value="1" {{ old('agree') ? 'checked' : '' }} required>
                    <span>I agree to the processing of my data in line with the <a href="{{ route('legal.documents') }}#privacy">Privacy Policy</a> and understand trading carries risk.</span>
                </label>
                @error('agree')<span class="va-field__err">{{ $message }}</span>@enderror
                <button class="va-btn va-btn--primary va-btn--lg va-form__submit" type="submit">
                    Send message
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </button>
            </form>
        </div>

    </div>
</section>

@endsection
