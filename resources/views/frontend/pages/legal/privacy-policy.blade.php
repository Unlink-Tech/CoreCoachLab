@extends('frontend.layouts.main')
@section('page-body-class', 'page-privacy-policy')
@section('title','Privacy & Data Protection Policy')
@section('main-content')

{{-- Content mirrors ventureasiamarkets.com/legal/privacy-policy. --}}

{{-- Page hero --}}
<section class="va-page-hero va-page-hero--doc">
    <div class="va-hero__container">
        <div class="va-breadcrumb" data-va-reveal>
            <a href="{{ route('home') }}">Home</a> / Legal / Privacy
        </div>
        <h1 data-va-reveal>Privacy &amp; Data Protection Policy</h1>
        <p class="va-doc-meta" data-va-reveal>Last updated: June 2026 · Venture Asia</p>
    </div>
</section>

<section class="va-section">
    <div class="va-hero__container">
        <div class="va-doc" data-va-reveal>
            <div class="va-callout">
                <p><strong>Your data, protected.</strong> We collect only what we need, we never sell your personal information, and we secure payment-card data using encryption and PCI-DSS compliant processors. We do not store your full card number.</p>
            </div>

            <h2>1. Who we are</h2>
            <p>Venture Asia is the data controller responsible for your personal information. You can contact us at <a href="mailto:support@ventureasiamarkets.com">support@ventureasiamarkets.com</a> or 3 Emerald Park, Trianon, Quatre Bornes, 72257, Mauritius.</p>

            <h2>2. Information we collect</h2>
            <ul>
                <li><strong>Identity &amp; contact data:</strong> name, date of birth, address, email, phone number and identity documents needed for account verification.</li>
                <li><strong>Financial data:</strong> transaction history, account balances and the payment details you provide to fund your account.</li>
                <li><strong>Technical data:</strong> IP address, device and browser information, and usage data collected via cookies.</li>
            </ul>

            <h2>3. How we use your data</h2>
            <ul>
                <li>To open, verify, operate and secure your trading account.</li>
                <li>To process deposits and withdrawals and to prevent fraud.</li>
                <li>To meet legal, regulatory and anti-money-laundering obligations.</li>
                <li>To provide support and, where you consent, to send service and marketing communications.</li>
            </ul>

            <h2>4. Payment-card data &amp; security</h2>
            <p>The security of your payment information is a priority. When you submit card details:</p>
            <ul>
                <li>Data is transmitted over an encrypted connection using <strong>TLS 1.2 or higher</strong>.</li>
                <li>Card processing is handled by <strong>PCI-DSS compliant</strong> payment service providers.</li>
                <li>We do <strong>not</strong> store your full card number (PAN) or card security code (CVV) on our systems.</li>
                <li>Access to personal data is restricted to authorised personnel on a need-to-know basis.</li>
            </ul>

            <h2>5. Sharing your data</h2>
            <p>We share data only with: payment processors and banks to complete transactions; identity-verification and fraud-prevention providers; regulators and authorities where legally required; and technology providers who operate our services under confidentiality obligations. We do not sell your personal data.</p>

            <h2>6. International transfers</h2>
            <p>Your data may be processed in countries other than your own. Where it is, we take steps to ensure an appropriate level of protection is in place.</p>

            <h2>7. Data retention</h2>
            <p>We retain personal and transaction data for as long as your account is active and thereafter for the period required by applicable law (including financial record-keeping and anti-money-laundering rules).</p>

            <h2>8. Your rights</h2>
            <p>Subject to applicable law, you may request access to, correction of, or deletion of your personal data, and you may object to or restrict certain processing. To exercise these rights, contact <a href="mailto:support@ventureasiamarkets.com">support@ventureasiamarkets.com</a>.</p>

            <h2>9. Cookies</h2>
            <p>We use cookies to operate the website, remember preferences and understand usage. You can control cookies through your browser settings; disabling some cookies may affect functionality.</p>

            <h2>10. Changes</h2>
            <p>We may update this policy from time to time. The latest version will always be available on this page with its effective date.</p>
        </div>
    </div>
</section>

@endsection
