@extends('frontend.layouts.main')
@section('page-body-class', 'page-risk-disclosure')
@section('title','Risk Disclosure')
@section('main-content')

{{-- Content mirrors ventureasiamarkets.com/legal/risk-disclosure. --}}

{{-- Page hero --}}
<section class="va-page-hero va-page-hero--doc">
    <div class="va-hero__container">
        <div class="va-breadcrumb" data-va-reveal>
            <a href="{{ route('home') }}">Home</a> / Legal / Risk Disclosure
        </div>
        <h1 data-va-reveal>Risk Disclosure</h1>
        <p class="va-doc-meta" data-va-reveal>Last updated: June 2026 · Venture Asia</p>
    </div>
</section>

<section class="va-section">
    <div class="va-hero__container">
        <div class="va-doc" data-va-reveal>
            <div class="va-callout va-callout--risk">
                <p><strong>High-risk warning.</strong> Trading leveraged derivatives such as CFDs carries a high level of risk to your capital. You can lose more than your initial deposit. These products are not suitable for everyone. Only trade with money you can afford to lose.</p>
            </div>

            <h2>1. Leverage works both ways</h2>
            <p>Leverage allows you to control a large position with a relatively small amount of capital. While this can magnify profits, it equally magnify losses. A small adverse market move can result in a loss that is large relative to your deposit.</p>

            <h2>2. You may lose more than you deposit</h2>
            <p>Because of leverage and market volatility, losses can exceed the funds in your account. You may be required to deposit additional funds at short notice to maintain your positions, and positions may be closed automatically if your margin falls below required levels.</p>

            <h2>3. Market risk &amp; volatility</h2>
            <p>Prices can move rapidly and unpredictably in response to economic data, geopolitical events and changes in market sentiment. Gaps and slippage can cause orders to be filled at prices different from those expected.</p>

            <h2>4. No guaranteed returns</h2>
            <p>Past performance is not a reliable indicator of future results. No representation is made that any account will or is likely to achieve profits or losses similar to those discussed in any materials we provide.</p>

            <h2>5. Not investment advice</h2>
            <p>Information on our website and platforms is general in nature and does not take account of your personal circumstances. It does not constitute investment, financial, legal or tax advice. You should seek independent professional advice if you are unsure whether trading is suitable for you.</p>

            <h2>6. Technology &amp; execution risk</h2>
            <p>Online trading depends on technology and connectivity. Disruptions, delays or failures in hardware, software or internet connectivity may affect your ability to trade or the execution of your orders.</p>

            <h2>7. Suitability</h2>
            <p>You should carefully consider whether trading leveraged products is appropriate for you in light of your experience, objectives, financial resources and risk tolerance.</p>

            <h2>8. Contact</h2>
            <p>If you have questions about the risks of trading with us, contact <a href="mailto:support@ventureasiamarkets.com">support@ventureasiamarkets.com</a> before opening or funding an account.</p>
        </div>
    </div>
</section>

@endsection
