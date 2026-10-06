@extends('frontend.layouts.main')
@section('page-body-class', 'page-refund-policy')
@section('title','Refund & Cancellation Policy')
@section('main-content')

{{-- Content mirrors ventureasiamarkets.com/legal/refund-policy. --}}

{{-- Page hero --}}
<section class="va-page-hero va-page-hero--doc">
    <div class="va-hero__container">
        <div class="va-breadcrumb" data-va-reveal>
            <a href="{{ route('home') }}">Home</a> / Legal / Refund &amp; Cancellation
        </div>
        <h1 data-va-reveal>Refund &amp; Cancellation Policy</h1>
        <p class="va-doc-meta" data-va-reveal>Last updated: June 2026 · Venture Asia</p>
    </div>
</section>

<section class="va-section">
    <div class="va-hero__container">
        <div class="va-doc" data-va-reveal>
            <div class="va-callout">
                <p><strong>In short:</strong> deposited funds that have not been used for trading can be refunded to the original payment method on request. Realised trading losses, fees and the cost of services already delivered are non-refundable. This policy is communicated to you before you fund your account.</p>
            </div>

            <h2>1. Scope</h2>
            <p>This policy explains your rights regarding refunds, returns and cancellations when you fund and use a trading account with Venture Asia ("we", "us", "the Company"). It applies to all card and bank-transfer transactions processed through our website and platforms. We make this policy clearly available before any purchase or deposit decision is made.</p>

            <h2>2. Nature of our services</h2>
            <p>We provide access to online trading in leveraged Contracts for Difference (CFDs) and related services such as platform access, market data and educational materials. These are financial services, not physical goods. When you deposit funds, you are crediting your own trading account; you are not purchasing a product that is shipped or returned.</p>

            <h2>3. Refund of unused funds</h2>
            <ul>
                <li>You may request a withdrawal (refund) of any cleared funds in your account that have not been consumed by trading activity, fees or charges.</li>
                <li>Where required by card scheme rules, refunds of card deposits are returned to the <strong>same card</strong> used for the original deposit, up to the original deposit amount.</li>
                <li>Amounts exceeding the original card deposit are returned by bank transfer to an account in your name.</li>
                <li>Refunds are processed in <strong>US Dollars (USD, $)</strong>, the currency in which the original transaction was made. Currency conversion, where applicable, is performed by your card issuer or bank at their prevailing rate.</li>
            </ul>

            <h2>4. What is non-refundable</h2>
            <ul>
                <li>Realised losses resulting from your trading activity.</li>
                <li>Spreads, commissions, swaps, and other trading costs that have already been incurred.</li>
                <li>Third-party fees (for example, bank or card-issuer charges).</li>
                <li>Services that have already been delivered or consumed.</li>
            </ul>

            <h2>5. How to request a refund or cancellation</h2>
            <p>To request a refund of unused funds or to cancel a pending deposit, contact our customer service team:</p>
            <ul>
                <li>Email: <a href="mailto:support@ventureasiamarkets.com">support@ventureasiamarkets.com</a></li>
            </ul>
            <p>Please include your account details and the transaction reference. We aim to acknowledge requests within one business day.</p>

            <h2>6. Processing times</h2>
            <p>Approved refunds are typically processed within <strong>1–3 business days</strong>. The time for funds to appear in your account depends on your bank or card issuer and may take additional working days.</p>

            <h2>7. Chargebacks &amp; disputes</h2>
            <p>If you believe a transaction is incorrect, please contact us first so we can resolve it quickly. Initiating a chargeback without contacting us may delay resolution. We retain transaction records to assist in resolving any dispute fairly.</p>

            <h2>8. Anti-money-laundering</h2>
            <p>Refunds and withdrawals are subject to identity verification and applicable anti-money-laundering and counter-terrorism-financing requirements. We may decline or delay a refund where we are required to do so by law.</p>

            <h2>9. Contact</h2>
            <p>Questions about this policy can be directed to <a href="mailto:support@ventureasiamarkets.com">support@ventureasiamarkets.com</a> or by post to Venture Asia, 3 Emerald Park, Trianon, Quatre Bornes, 72257, Mauritius.</p>
        </div>
    </div>
</section>

@endsection
