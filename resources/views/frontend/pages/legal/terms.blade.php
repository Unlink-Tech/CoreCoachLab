@extends('frontend.layouts.main')
@section('page-body-class', 'page-terms')
@section('title','Terms & Conditions')
@section('main-content')

{{-- Content mirrors ventureasiamarkets.com/legal/terms. --}}

{{-- Page hero --}}
<section class="va-page-hero va-page-hero--doc">
    <div class="va-hero__container">
        <div class="va-breadcrumb" data-va-reveal>
            <a href="{{ route('home') }}">Home</a> / Legal / Terms
        </div>
        <h1 data-va-reveal>Terms &amp; Conditions</h1>
        <p class="va-doc-meta" data-va-reveal>Last updated: June 2026 · Venture Asia</p>
    </div>
</section>

<section class="va-section">
    <div class="va-hero__container">
        <div class="va-doc" data-va-reveal>
            <h2>1. About these terms</h2>
            <p>These Terms &amp; Conditions govern your access to and use of the website and services provided by Venture Asia ("the Company", "we", "us"). By using our website, opening an account or trading with us, you agree to these terms.</p>

            <h2>2. Eligibility</h2>
            <p>You must be at least 18 years old and legally able to enter into a binding contract. You must not be a resident of, or accessing our services from, a jurisdiction where doing so is prohibited. We may require identity verification before providing services.</p>

            <h2>3. Our services</h2>
            <p>We provide an electronic platform for trading Contracts for Difference (CFDs) on forex, indices, commodities and shares, together with related market data and educational materials. We act as the counterparty or intermediary to your trades as described in your account documentation. A full description of the services is available on our <a href="{{ route('home') }}#markets">Markets</a> and <a href="{{ route('accounts') }}">Trading</a> pages.</p>

            <h2>4. Risk acknowledgement</h2>
            <p>Trading leveraged products carries a high level of risk and can result in losses exceeding your deposits. You confirm that you understand these risks. Please read our <a href="{{ route('legal.risk-disclosure') }}">Risk Disclosure</a>.</p>

            <h2>5. Account &amp; funding</h2>
            <p>You are responsible for keeping your login credentials secure and for all activity on your account. Deposits and withdrawals are processed in <strong>US Dollars (USD, $)</strong>. Funding terms, including accepted payment methods, are set out on our <a href="{{ route('funding') }}">Funding</a> page.</p>

            <h2>6. Fees &amp; charges</h2>
            <p>Spreads, commissions, swaps and any other applicable charges are disclosed in your account documentation and on the platform. You are responsible for any third-party charges, such as bank or card-issuer fees.</p>

            <h2>7. Refunds &amp; cancellations</h2>
            <p>Refunds of unused funds and cancellations are handled in accordance with our <a href="{{ route('legal.refund-policy') }}">Refund &amp; Cancellation Policy</a>.</p>

            <h2>8. Privacy</h2>
            <p>We process personal data in accordance with our <a href="{{ route('legal.privacy-policy') }}">Privacy &amp; Data Protection Policy</a>.</p>

            <h2>9. Prohibited use</h2>
            <p>You must not use our services for any unlawful purpose, including money laundering, market abuse or fraud. We may suspend or close accounts that breach these terms or applicable law.</p>

            <h2>10. Limitation of liability</h2>
            <p>To the maximum extent permitted by law, we are not liable for losses arising from market movements, your trading decisions, or events beyond our reasonable control, including interruptions to access or third-party failures.</p>

            <h2>11. Intellectual property</h2>
            <p>All content on this website, including text, graphics, logos and software, is owned by or licensed to the Company and may not be reproduced without permission.</p>

            <h2>12. Amendments</h2>
            <p>We may update these terms from time to time. Continued use of our services after changes are published constitutes acceptance of the revised terms.</p>

            <h2>13. Governing law &amp; contact</h2>
            <p>These terms are governed by the laws applicable at our place of registration. Questions can be directed to <a href="mailto:support@ventureasiamarkets.com">support@ventureasiamarkets.com</a> or Venture Asia, 3 Emerald Park, Trianon, Quatre Bornes, 72257, Mauritius.</p>
        </div>
    </div>
</section>

@endsection
