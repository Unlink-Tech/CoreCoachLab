@extends('frontend.layouts.main')
@section('page-body-class', 'page-index')

@section('main-content')

<section class="va-hero">
    <div class="va-hero__container va-hero__grid">

        {{-- LEFT: copy --}}
        <div class="va-hero__copy">
            <span class="va-chip"><span class="va-chip__dot"></span> Multi-asset trading · 600+ instruments</span>
            <h1 class="va-hero__title">
                Trade the world's<br>markets with<br><span class="va-hero__title-accent">precision.</span>
            </h1>
            <p class="va-hero__lede">
                Forex, indices, commodities and global shares on one institutional-grade platform, with tight spreads, fast execution and a team that actually picks up the phone.
            </p>
            <div class="va-hero__ctas">
                <a class="va-btn va-btn--primary va-btn--lg" href="{{ route('contact') }}">
                    Talk to us
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
                <a class="va-btn va-btn--ghost va-btn--lg" href="{{ route('under-construction') }}">Explore markets</a>
            </div>
            <div class="va-hero__trust">
                <div class="va-hero__trust-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent-2)" stroke-width="2" aria-hidden="true"><path d="M12 2l8 4v6c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/></svg>
                    <span>Segregated client funds</span>
                </div>
                <div class="va-hero__trust-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent-2)" stroke-width="2" aria-hidden="true"><path d="M13 2L4 14h7l-1 8 9-12h-7z"/></svg>
                    <span>Execution from 0.0 pips</span>
                </div>
                <div class="va-hero__trust-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent-2)" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                    <span>24/5 multilingual support</span>
                </div>
            </div>
        </div>

        {{-- RIGHT: live market board --}}
        <div class="va-hero__board-wrap">
            <div class="va-glassbox va-board">
                <div class="va-board__head">
                    <div class="va-board__title">
                        <span class="va-board__dot"></span>
                        <span>Live Market Board</span>
                    </div>
                    <span class="va-board__meta">streaming · indicative</span>
                </div>
                <div class="va-board__widget">
                    {{-- TradingView Market Overview — same config as ventureasiamarkets.com --}}
                    <div class="tradingview-widget-container">
                        <div class="tradingview-widget-container__widget"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
                        {
                          "colorTheme": "dark",
                          "dateRange": "12M",
                          "locale": "en",
                          "largeChartUrl": "",
                          "isTransparent": true,
                          "showFloatingTooltip": false,
                          "plotLineColorGrowing": "rgba(31, 203, 139, 1)",
                          "plotLineColorFalling": "rgba(255, 93, 108, 1)",
                          "gridLineColor": "rgba(140, 178, 224, 0.08)",
                          "scaleFontColor": "#A4BAD6",
                          "belowLineFillColorGrowing": "rgba(31, 203, 139, 0.12)",
                          "belowLineFillColorFalling": "rgba(255, 93, 108, 0.12)",
                          "belowLineFillColorGrowingBottom": "rgba(31, 203, 139, 0)",
                          "belowLineFillColorFallingBottom": "rgba(255, 93, 108, 0)",
                          "symbolActiveColor": "rgba(46, 123, 255, 0.12)",
                          "tabs": [
                            {
                              "title": "Indices",
                              "symbols": [
                                { "s": "FOREXCOM:SPXUSD", "d": "S&P 500 Index" },
                                { "s": "FOREXCOM:NSXUSD", "d": "US 100 Cash CFD" },
                                { "s": "FOREXCOM:DJI", "d": "Dow Jones Industrial Average Index" },
                                { "s": "INDEX:NKY", "d": "Japan 225" },
                                { "s": "INDEX:DEU40", "d": "DAX Index" },
                                { "s": "FOREXCOM:UKXGBP", "d": "FTSE 100 Index" }
                              ],
                              "originalTitle": "Indices"
                            },
                            {
                              "title": "Futures",
                              "symbols": [
                                { "s": "BMFBOVESPA:ISP1!", "d": "S&P 500" },
                                { "s": "BMFBOVESPA:EUR1!", "d": "Euro" },
                                { "s": "CMCMARKETS:GOLD", "d": "Gold" },
                                { "s": "PYTH:WTI3!", "d": "WTI Crude Oil" },
                                { "s": "BMFBOVESPA:CCM1!", "d": "Corn" }
                              ],
                              "originalTitle": "Futures"
                            },
                            {
                              "title": "Bonds",
                              "symbols": [
                                { "s": "EUREX:FGBL1!", "d": "Euro Bund" },
                                { "s": "EUREX:FBTP1!", "d": "Euro BTP" },
                                { "s": "EUREX:FGBM1!", "d": "Euro BOBL" }
                              ],
                              "originalTitle": "Bonds"
                            },
                            {
                              "title": "Forex",
                              "symbols": [
                                { "s": "FX:EURUSD", "d": "EUR to USD" },
                                { "s": "FX:GBPUSD", "d": "GBP to USD" },
                                { "s": "FX:USDJPY", "d": "USD to JPY" },
                                { "s": "FX:USDCHF", "d": "USD to CHF" },
                                { "s": "FX:AUDUSD", "d": "AUD to USD" },
                                { "s": "FX:USDCAD", "d": "USD to CAD" }
                              ],
                              "originalTitle": "Forex"
                            }
                          ],
                          "support_host": "https://www.tradingview.com",
                          "width": "100%",
                          "height": "480",
                          "showSymbolLogo": true,
                          "showChart": true
                        }
                        </script>
                    </div>
                </div>
                <a class="va-btn va-btn--ghost va-btn--sm va-board__all" href="{{ route('under-construction') }}">View all instruments</a>
            </div>
            <div class="va-hero__glow" aria-hidden="true"></div>
        </div>

    </div>
</section>

{{-- Key stats (numbers count up when scrolled into view) --}}
<section class="va-section va-section--tight">
    <div class="va-hero__container">
        <div class="va-glassbox va-trust" data-va-reveal>
            <div class="va-stat" data-va-count="2000" data-va-prefix="1:" data-va-grouping="false">
                <div class="va-stat__num">1:2000</div>
                <div class="va-stat__label">Maximum Leverage</div>
            </div>
            <div class="va-stat" data-va-count="0" data-va-decimals="1">
                <div class="va-stat__num">0.0</div>
                <div class="va-stat__label">Spreads from (pips)</div>
            </div>
            <div class="va-stat" data-va-count="20" data-va-prefix="&lt;" data-va-suffix="ms">
                <div class="va-stat__num">&lt;20ms</div>
                <div class="va-stat__label">Avg. execution speed</div>
            </div>
            <div class="va-stat" data-va-count="0" data-va-decimals="1">
                <div class="va-stat__num">0.0</div>
                <div class="va-stat__label">Commission</div>
            </div>
        </div>
    </div>
</section>

{{-- Markets --}}
@php
    $vaSectors = [
        ['name' => 'Forex', 'symbols' => ['OANDA:EURUSD', 'FX:USDJPY', 'SAXO:JPYHKD']],
        ['name' => 'Commodities', 'symbols' => ['OANDA:XAUUSD', 'OANDA:XAGUSD', 'CFI:WTI']],
        ['name' => 'Indices', 'symbols' => ['PEPPERSTONE:GER40', 'PEPPERSTONE:NAS100', 'PEPPERSTONE:US500']],
        ['name' => 'Shares', 'symbols' => ['NASDAQ:AAPL', 'NASDAQ:TSLA', 'NASDAQ:NVDA']],
    ];
@endphp
<section class="va-section" id="markets">
    <div class="va-hero__container">
        <div class="va-markets__head">
            <div class="va-section-head" data-va-reveal>
                <span class="va-eyebrow">Markets</span>
                <h2>Four asset classes.<br>One account.</h2>
                <p>Access deep liquidity across the markets that move the world, switching between them seamlessly without juggling multiple logins.</p>
            </div>
            <a class="va-btn va-btn--ghost" href="{{ route('under-construction') }}" data-va-reveal>
                All markets
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
        </div>
        <div class="va-grid va-grid-4 va-markets__grid">
            @foreach($vaSectors as $sector)
                <div class="va-card va-sector" data-va-reveal>
                    <h3 class="va-sector__title">{{ $sector['name'] }}</h3>
                    <div class="tradingview-widget-container va-sector__widget">
                        <tv-market-summary
                            symbol-sectors='@json([['sectionName' => $sector['name'], 'symbols' => $sector['symbols']]])'
                            direction="vertical" item-size="compact" mode="custom" transparent="true" theme="dark"></tv-market-summary>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Why Venture Asia --}}
@php
    $vaFeatures = [
        ['title' => 'Lightning execution', 'text' => 'Orders filled in ~30ms via tier-1 liquidity and low-latency infrastructure. No dealing desk, no requotes.',
         'icon' => '<path d="M13 2L4 14h7l-1 8 9-12h-7z"/>'],
        ['title' => 'Funds you can trust', 'text' => 'Client money is held in segregated accounts with reputable banks, kept separate from company funds.',
         'icon' => '<path d="M12 2l8 4v6c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/>'],
        ['title' => 'Razor-thin spreads', 'text' => 'Raw spreads from 0.0 pips with transparent, low commissions, so more of every move stays yours.',
         'icon' => '<path d="M4 17l5-5 4 3 7-8"/><path d="M14 4h6v6"/>'],
        ['title' => 'Platforms you know', 'text' => 'MetaTrader on desktop, web and mobile, plus advanced charting, EAs and one-click trading.',
         'icon' => '<rect x="2" y="4" width="20" height="13" rx="2"/><path d="M8 21h8M12 17v4"/>'],
        ['title' => 'Real human support', 'text' => 'A multilingual team available 24 hours a day, five days a week, by chat, email and phone.',
         'icon' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>'],
        ['title' => 'Learn as you grow', 'text' => 'Structured education, daily analysis and trading tools to sharpen your edge at every level.',
         'icon' => '<path d="M22 9L12 4 2 9l10 5 10-5z"/><path d="M6 11v5c0 1 3 3 6 3s6-2 6-3v-5"/>'],
    ];
@endphp
<section class="va-section va-why">
    <div class="va-hero__container">
        <div class="va-section-head va-center" data-va-reveal>
            <span class="va-eyebrow">Why Venture Asia</span>
            <h2>Built for traders who<br>expect more.</h2>
            <p>Institutional pricing, robust technology and a genuine commitment to client protection: the things that matter when real money is on the line.</p>
        </div>
        <div class="va-grid va-grid-3 va-why__grid">
            @foreach($vaFeatures as $feature)
                <div class="va-card" data-va-reveal>
                    <span class="va-feat-ico">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">{!! $feature['icon'] !!}</svg>
                    </span>
                    <h3 class="va-feat-title">{{ $feature['title'] }}</h3>
                    <p class="va-feat-text">{{ $feature['text'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- The platform --}}
<section class="va-section">
    <div class="va-hero__container va-split">
        <div data-va-reveal>
            <span class="va-eyebrow">The platform</span>
            <h2 class="va-platform__title">Powerful where it counts. Simple where it should be.</h2>
            <p class="va-platform__lede">Trade from a single, responsive interface engineered for clarity under pressure, with advanced charting, depth-of-market, risk tools and one-click execution, on every device.</p>
            <div class="va-checks">
                @foreach([
                    'Real-time charts with 50+ indicators and drawing tools',
                    'One-click trading, stops, limits and trailing protection',
                    'Automated strategies and Expert Advisor support',
                    'Sync seamlessly across desktop, web and mobile',
                ] as $point)
                    <div class="va-check">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--up)" stroke-width="2.2" aria-hidden="true"><path d="M20 6L9 17l-5-5"/></svg>
                        <span>{{ $point }}</span>
                    </div>
                @endforeach
            </div>
            <a class="va-btn va-btn--primary va-platform__btn" href="{{ route('under-construction') }}">
                Explore the platform
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
        </div>
        <div class="va-platform__media" data-va-reveal>
            <div class="va-img-ph">
                <img src="{{ asset('assets/images/platform.jpg') }}" alt="Trading platform charts" loading="lazy">
            </div>
            <div class="va-glassbox va-pl">
                <div class="va-pl__label">Position P/L</div>
                <div class="va-pl__value">+$4,182.55</div>
                <div class="va-pl__meta">XAU/USD · 2.0 lots</div>
            </div>
        </div>
    </div>
</section>

{{-- 4 steps --}}
@include('frontend.partials.va-steps')

{{-- CTA --}}
<section class="va-section">
    <div class="va-hero__container">
        <div class="va-glassbox va-cta" data-va-reveal>
            <div class="va-cta__glow" aria-hidden="true"></div>
            <div class="va-cta__body">
                <h2 class="va-cta__title">Ready when you are.</h2>
                <p class="va-cta__text">Have a question about markets, accounts or funding? Our team is one message away.</p>
                <div class="va-cta__actions">
                    <a class="va-btn va-btn--primary va-btn--lg" href="{{ route('contact') }}">
                        Talk to us
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </a>
                    <a class="va-btn va-btn--ghost va-btn--lg" href="{{ route('accounts') }}">See account types</a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script type="module" src="https://widgets.tradingview-widget.com/w/en/tv-market-summary.js" async></script>
@endpush






@endsection
