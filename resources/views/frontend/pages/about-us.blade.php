@extends('frontend.layouts.main')
@section('page-body-class', 'page-about-us')
@section('title','About Us')
@section('main-content')

{{-- Content and layout mirror ventureasiamarkets.com/about. Styles: public/assets/css/home-hero.css --}}

{{-- Page hero --}}
<section class="va-page-hero">
    <div class="va-hero__container">
        <div class="va-breadcrumb" data-va-reveal><a href="{{ route('home') }}">Home</a> / About Us</div>
        <div class="va-page-hero__body">
            <h1 data-va-reveal>A broker built on<br>trust and technology.</h1>
            <p class="va-lead" data-va-reveal>Venture Asia exists to give traders fair access to the world's markets, with the pricing, platforms and protection serious traders deserve, and the human support too many brokers forget.</p>
        </div>
    </div>
</section>

{{-- Key figures --}}
<section class="va-section va-section--tight">
    <div class="va-hero__container">
        <div class="va-glassbox va-trust va-trust--about" data-va-reveal>
            <div class="va-stat" data-va-count="600" data-va-suffix="+">
                <div class="va-stat__num">600+</div>
                <div class="va-stat__label">Instruments</div>
            </div>
            <div class="va-stat" data-va-count="100" data-va-suffix="+">
                <div class="va-stat__num">100+</div>
                <div class="va-stat__label">Countries served</div>
            </div>
            <div class="va-stat" data-va-count="24" data-va-suffix="/5">
                <div class="va-stat__num">24/5</div>
                <div class="va-stat__label">Client support</div>
            </div>
            <div class="va-stat" data-va-count="4">
                <div class="va-stat__num">4</div>
                <div class="va-stat__label">Asset classes</div>
            </div>
        </div>
    </div>
</section>

{{-- Our mission --}}
<section class="va-section">
    <div class="va-hero__container va-split">
        <div data-va-reveal>
            <span class="va-eyebrow">Our mission</span>
            <h2 class="va-h2" style="font-size: clamp(28px, 3.8vw, 46px);">Make professional-grade trading genuinely accessible.</h2>
            <p class="va-body-text" style="margin-top: 18px;">We started Venture Asia with a simple conviction: traders deserve institutional pricing, dependable technology and straight answers, without the opacity that surrounds much of the industry.</p>
            <p class="va-body-text" style="margin-top: 16px;">Today we bring forex, indices, commodities and shares together on one platform, backed by tier-1 liquidity and a team that treats client protection as a first principle, not a footnote.</p>
        </div>
        <div class="va-img-ph" data-va-reveal>
            <img src="{{ asset('assets/images/about-us-venture.jpg') }}" alt="About Us" loading="lazy">
        </div>
    </div>
</section>

{{-- Eight reasons --}}
@php
    $vaAdvantages = [
        ['title' => 'Low Trading Costs', 'stroke' => '#4edf8e',
         'text' => 'Benefit from ultra-tight spreads and fully transparent pricing models, ensuring your aggregate trading overhead is kept minimal.',
         'icon' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v12M9 9h6M9 15h6"/>'],
        ['title' => 'Flexible Leverage Scaling', 'stroke' => 'var(--accent-2)',
         'text' => 'Expand market positions with leverage configurations of up to 1:2000 on primary asset classes.',
         'icon' => '<path d="M3 14l9-3 9 3M6 14v4M18 14v4M12 3v18"/>'],
        ['title' => 'Diversified Instruments', 'stroke' => 'var(--accent-2)',
         'text' => 'Gain access to 600+ instruments across Forex, Commodities, Indices, and Global Shares from a single dashboard.',
         'icon' => '<rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>'],
        ['title' => 'Ultra-Fast Execution', 'stroke' => 'var(--accent-2)',
         'text' => 'Orders are routed to tier-1 banks in under 20ms, preventing slippage, requotes, or order rejections.',
         'icon' => '<path d="M13 2L4 14h7l-1 8 9-12h-7z"/>'],
        ['title' => 'Elite Platforms Suite', 'stroke' => 'var(--accent-2)',
         'text' => 'Trade on MetaTrader 4, MetaTrader 5, and WebTrader synced seamlessly across desktop and mobile.',
         'icon' => '<rect x="2" y="4" width="20" height="13" rx="2"/><path d="M8 21h8M12 17v4"/>'],
        ['title' => 'Segregated Fund Security', 'stroke' => 'var(--accent-2)',
         'text' => 'Your trading capital is held securely in segregated client trust accounts with top-tier international banks.',
         'icon' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>'],
        ['title' => 'VA Social Copy Trading', 'stroke' => 'var(--accent-2)',
         'text' => 'Automatically replicate the trades of top-performing managers, or share your own strategies for profit.',
         'icon' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>'],
        ['title' => '24/5 Customer Assistance', 'stroke' => 'var(--accent-2)',
         'text' => 'Access dedicated round-the-clock multilingual assistance via phone, email, and live chat during the trading week.',
         'icon' => '<path d="M3 18v-6a9 9 0 0 1 18 0v6M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3"/>'],
    ];
@endphp
<section class="va-section va-section--bordered">
    <div class="va-hero__container va-split va-split--start va-split--resources">
        <div class="va-sticky-col" data-va-reveal>
            <div>
                <span class="va-eyebrow">Venture Asia Advantages</span>
                <h2 class="va-h2" style="font-size: clamp(28px, 3.8vw, 44px); line-height: 1.2;">Eight Reasons<br>to Trade with Us</h2>
            </div>
            <div class="va-eight">
                <div class="va-eight__glow" aria-hidden="true"></div>
                <svg width="240" height="280" viewBox="0 0 240 280" fill="none" aria-hidden="true">
                    <path d="M60 40 L20 60 L20 220 L60 240" stroke="rgba(255,255,255,0.15)" stroke-width="1.5"/>
                    <path d="M60 40 L60 240" stroke="var(--line)" stroke-width="1.5"/>
                    <path d="M180 40 L220 60 L220 220 L180 240" stroke="rgba(255,255,255,0.15)" stroke-width="1.5"/>
                    <path d="M180 40 L180 240" stroke="var(--line)" stroke-width="1.5"/>
                    <text x="120" y="176" text-anchor="middle" font-size="150" font-weight="800" font-family="'Sora', sans-serif" fill="url(#va-number-grad)" style="font-size: 150px; font-weight: 800; font-family: 'Sora', sans-serif; filter: drop-shadow(0 0 15px rgba(44,212,230,0.35));">8</text>
                    <defs>
                        <linearGradient id="va-number-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="var(--accent-2)"/>
                            <stop offset="100%" stop-color="#4edf8e"/>
                        </linearGradient>
                    </defs>
                </svg>
            </div>
        </div>
        <div class="va-adv-list" data-va-reveal>
            @foreach($vaAdvantages as $adv)
                <div class="va-card va-adv">
                    <span class="va-feat-ico va-adv__ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="{{ $adv['stroke'] }}" stroke-width="1.8" aria-hidden="true">{!! $adv['icon'] !!}</svg>
                    </span>
                    <div>
                        <h3 class="va-adv__title">{{ $adv['title'] }}</h3>
                        <p class="va-adv__text">{{ $adv['text'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Principles --}}
@php
    $vaPrinciples = [
        ['title' => 'Transparency', 'text' => 'Clear pricing, clear terms, clear costs. No hidden mark-ups and no surprises on your statement.',
         'icon' => '<circle cx="12" cy="12" r="9"/><path d="M8 12l3 3 5-6"/>'],
        ['title' => 'Client protection', 'text' => 'Segregated funds, strong security and responsible practices: your interests come first.',
         'icon' => '<path d="M12 2l8 4v6c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/>'],
        ['title' => 'Technology', 'text' => 'Low-latency infrastructure and proven platforms, so you can act on opportunity without friction.',
         'icon' => '<path d="M13 2L4 14h7l-1 8 9-12h-7z"/>'],
        ['title' => 'Real support', 'text' => "A knowledgeable, multilingual team that's available when markets are, by chat, email and phone.",
         'icon' => '<circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0116 0"/>'],
        ['title' => 'Education first', 'text' => "We'd rather you trade well than trade often. Knowledge is built into everything we offer.",
         'icon' => '<path d="M22 9L12 4 2 9l10 5 10-5z"/><path d="M6 11v5c0 1 3 3 6 3s6-2 6-3v-5"/>'],
        ['title' => 'Global outlook', 'text' => "Markets don't sleep and neither does opportunity: we connect clients to them worldwide.",
         'icon' => '<circle cx="12" cy="12" r="9"/><path d="M2 12h20M12 3a14 14 0 000 18M12 3a14 14 0 010 18"/>'],
    ];
@endphp
<section class="va-section va-why">
    <div class="va-hero__container">
        <div class="va-section-head va-center" data-va-reveal>
            <span class="va-eyebrow">What we stand for</span>
            <h2>Principles we don't<br>compromise on.</h2>
        </div>
        <div class="va-grid va-grid-3" style="margin-top: 46px;" data-va-reveal>
            @foreach($vaPrinciples as $p)
                <div class="va-card">
                    <span class="va-feat-ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">{!! $p['icon'] !!}</svg>
                    </span>
                    <h3 class="va-feat-title">{{ $p['title'] }}</h3>
                    <p class="va-feat-text">{{ $p['text'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Company details --}}
<section class="va-section">
    <div class="va-hero__container">
        <div class="va-section-head" data-va-reveal>
            <span class="va-eyebrow">Company details</span>
            <h2>Who you're dealing with.</h2>
        </div>
        <div class="va-grid va-grid-2 va-details" data-va-reveal>
            <div class="va-card">
                <h3 class="va-feat-title" style="font-size: 19px;">Registered entity</h3>
                <div class="va-details__rows">
                    <div class="va-details__row">
                        <span class="va-details__key">Company</span>
                        <span class="va-details__val">Venture Asia</span>
                    </div>
                    <div class="va-details__row">
                        <span class="va-details__key">Registration</span>
                        <span class="va-details__val">No. 8427654-1 <span class="va-details__note">(placeholder)</span></span>
                    </div>
                    <div class="va-details__row">
                        <span class="va-details__key">Permanent establishment</span>
                        <span class="va-details__val">Suite 305, Eden Plaza,<br>Eden Island, Mahé,<br>Republic of Mauritius</span>
                    </div>
                    <div class="va-details__row">
                        <span class="va-details__key">Merchant outlet country</span>
                        <span class="va-details__val">Republic of Mauritius</span>
                    </div>
                </div>
            </div>
            <div class="va-card">
                <h3 class="va-feat-title" style="font-size: 19px;">What we offer</h3>
                <p class="va-feat-text va-feat-text--spaced">Venture Asia provides online brokerage services for trading Contracts for Difference (CFDs) on:</p>
                <ul class="va-details__list">
                    <li>Foreign exchange (currency pairs)</li>
                    <li>Stock indices</li>
                    <li>Commodities (metals &amp; energies)</li>
                    <li>Company shares</li>
                </ul>
                <p class="va-feat-text va-feat-text--spaced">Services include access to trading platforms, market data, educational resources and account funding in US Dollars (USD, $). These are leveraged products carrying significant risk.</p>
            </div>
        </div>
    </div>
</section>

{{-- Let's talk --}}
<section class="va-section va-section--tight" style="padding-bottom: 90px;">
    <div class="va-hero__container">
        <div class="va-glassbox va-talk" data-va-reveal>
            <h2 class="va-h2" style="font-size: clamp(26px, 3.4vw, 40px);">Let's talk.</h2>
            <p class="va-talk__text">Whether you're new to trading or moving from another broker, we're happy to help you get started.</p>
            <a class="va-btn va-btn--primary va-btn--lg" style="margin-top: 26px;" href="{{ route('contact') }}">
                Talk to us
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
        </div>
    </div>
</section>

@endsection
