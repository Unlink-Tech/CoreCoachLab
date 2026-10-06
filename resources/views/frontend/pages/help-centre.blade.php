@extends('frontend.layouts.main')
@section('page-body-class', 'page-help-centre')
@section('title','Help Centre')
@section('main-content')

{{-- Layout and content mirror ventureasiamarkets.com/resources/help. Styles: public/assets/css/home-hero.css --}}
@php
    $vaHelpTabs = [
        ['id' => 'about', 'label' => 'About Venture Asia',
         'icon' => '<circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>'],
        ['id' => 'accounts', 'label' => 'Accounts',
         'icon' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>'],
        ['id' => 'funding', 'label' => 'Deposit & Withdrawal',
         'icon' => '<rect x="2" y="5" width="20" height="14" rx="2" ry="2"/><line x1="2" y1="10" x2="22" y2="10"/>'],
        ['id' => 'platforms', 'label' => 'Trading Platforms',
         'icon' => '<rect x="4" y="4" width="16" height="16" rx="2"/><path d="M9 9h6v6"/>'],
        ['id' => 'conditions', 'label' => 'Trading Conditions',
         'icon' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
        ['id' => 'support', 'label' => 'Trading Support',
         'icon' => '<circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>'],
    ];
    $vaFaqs = [
        ['category' => 'about', 'question' => 'What is Venture Asia?',
         'answer' => 'Venture Asia is a multi-asset financial brokerage offering Contracts for Difference (CFDs) on forex, indices, commodities, and shares. We deliver professional-grade trading solutions, competitive pricing spreads, and global client support.'],
        ['category' => 'about', 'question' => 'Is Venture Asia a registered broker?',
         'answer' => 'Yes, Venture Asia is a registered entity. Our corporate records and principal office are located in the Republic of Mauritius. Client funds are kept strictly in segregated bank trust accounts to ensure safety and security.'],
        ['category' => 'accounts', 'question' => 'How do I open a live account?',
         'answer' => 'To register, click the "Talk to Us" button or contact our support team. We will guide you through a quick onboarding process where you will upload proof of identity and address to complete your registration.'],
        ['category' => 'accounts', 'question' => 'Do you offer Demo accounts?',
         'answer' => 'Yes, we provide free Demo accounts loaded with virtual funds. Demo accounts replicate real market conditions, allowing you to test trading strategies and become familiar with our platforms risk-free.'],
        ['category' => 'funding', 'question' => 'What methods can I use to deposit funds?',
         'answer' => 'We support Visa, Mastercard, international bank wire transfers, and popular e-wallets. All credit and debit transactions are secured through encrypted TLS protocols.'],
        ['category' => 'funding', 'question' => 'How long do withdrawals take?',
         'answer' => 'Withdrawal requests are processed by our funding department within 24 hours. The time it takes for funds to reach your account depends on the method: e-wallets are near-instant, cards take 2-5 days, and wire transfers take 3-7 business days.'],
        ['category' => 'platforms', 'question' => 'Which trading platforms do you support?',
         'answer' => 'We support MetaTrader 4 (MT4), MetaTrader 5 (MT5), and WebTrader. These platforms are fully optimized for Windows, macOS, iOS, and Android devices, providing a seamless trading experience.'],
        ['category' => 'platforms', 'question' => 'Can I trade using my mobile phone?',
         'answer' => 'Yes, both MT4 and MT5 offer dedicated mobile apps for iOS and Android. You can download them directly from the App Store or Google Play Store and log in using your Venture Asia account credentials.'],
        ['category' => 'conditions', 'question' => 'What is the maximum leverage available?',
         'answer' => 'We offer flexible leverage options scaling up to 1:2000 on primary currency pairs and major indices. Leverage details vary based on account balance and asset class.'],
        ['category' => 'conditions', 'question' => 'Do you charge commission on trades?',
         'answer' => 'Venture Asia offers $0 commission trading on our standard account type, where trading fees are built into tight spreads. Raw ECN accounts feature zero-spread options with fixed flat commissions.'],
        ['category' => 'support', 'question' => 'When is client support available?',
         'answer' => 'Our customer support desk is available 24 hours a day, 5 days a week (Monday through Friday), aligned with international market hours.'],
        ['category' => 'support', 'question' => 'How do I contact customer support?',
         'answer' => 'You can reach our help desk via the live chat portal on our website, by sending an email to support@ventureasia.com, or by calling our direct helpline numbers listed on the contact page.'],
    ];
@endphp

{{-- Page hero --}}
<section class="va-page-hero">
    <div class="va-hero__container">
        <div class="va-breadcrumb" data-va-reveal><a href="{{ route('home') }}">Home</a> / Resources / Help Centre</div>
        <div style="max-width: 760px;">
            <h1 data-va-reveal>Help Centre</h1>
            <p class="va-lead" data-va-reveal>Answers, fast. Explore our frequently asked questions about account registration, safety of funds, billing details, and trading parameters.</p>
        </div>
    </div>
</section>

{{-- Topic tabs --}}
<section class="va-section va-section--tight">
    <div class="va-hero__container">
        <div class="va-help-tabs" role="tablist" aria-label="Help topics" data-va-reveal>
            @foreach($vaHelpTabs as $i => $tab)
                <button type="button" class="va-help-tab {{ $i === 0 ? 'is-active' : '' }}" role="tab"
                    aria-selected="{{ $i === 0 ? 'true' : 'false' }}" data-va-help-tab="{{ $tab['id'] }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">{!! $tab['icon'] !!}</svg>
                    <span>{{ $tab['label'] }}</span>
                </button>
            @endforeach
        </div>
    </div>
</section>

{{-- FAQs --}}
<section class="va-section" style="padding-top: 0;">
    <div class="va-hero__container va-split va-split--start va-split--resources">
        <div class="va-sticky-col va-help-side" data-va-reveal>
            <span class="va-eyebrow">FAQ Help desk</span>
            <h2 class="va-h2" style="font-size: clamp(28px, 3.4vw, 40px);">Frequently Asked Questions</h2>
            <p class="va-body-text" style="margin-top: 16px; font-size: 16px;">Can't find what you need? Our customer support desk is open 24 hours a day, 5 days a week to help you.</p>
            <a class="va-btn va-btn--primary va-help-side__btn" href="{{ route('contact') }}">
                Contact support
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
        </div>
        <div class="va-faqs" data-va-reveal>
            @foreach($vaHelpTabs as $i => $tab)
                <div class="va-faqs__group" data-va-help-panel="{{ $tab['id'] }}" {{ $i === 0 ? '' : 'hidden' }}>
                    @foreach(array_values(array_filter($vaFaqs, fn ($f) => $f['category'] === $tab['id'])) as $j => $faq)
                        <details class="va-faq" {{ $j === 0 ? 'open' : '' }}>
                            <summary>{{ $faq['question'] }}</summary>
                            <div class="va-faq__content"><p>{{ $faq['answer'] }}</p></div>
                        </details>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script>
(function () {
    var tabs = Array.prototype.slice.call(document.querySelectorAll('[data-va-help-tab]'));
    var panels = Array.prototype.slice.call(document.querySelectorAll('[data-va-help-panel]'));
    function show(id) {
        tabs.forEach(function (t) {
            var on = t.getAttribute('data-va-help-tab') === id;
            t.classList.toggle('is-active', on);
            t.setAttribute('aria-selected', on ? 'true' : 'false');
        });
        panels.forEach(function (p) {
            var on = p.getAttribute('data-va-help-panel') === id;
            p.hidden = !on;
            /* Like the reference: switching topics re-opens the first question only */
            if (on) p.querySelectorAll('details').forEach(function (d, i) { d.open = i === 0; });
        });
    }
    tabs.forEach(function (t) { t.addEventListener('click', function () { show(t.getAttribute('data-va-help-tab')); }); });
})();
</script>
@endpush

@endsection
