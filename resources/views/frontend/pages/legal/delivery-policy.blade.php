@extends('frontend.layouts.main')
@section('page-body-class', 'page-delivery-policy')
@section('title','Service Delivery & Availability Policy')
@section('main-content')

{{-- Content mirrors ventureasiamarkets.com/legal/delivery-policy. --}}

{{-- Page hero --}}
<section class="va-page-hero va-page-hero--doc">
    <div class="va-hero__container">
        <div class="va-breadcrumb" data-va-reveal>
            <a href="{{ route('home') }}">Home</a> / Legal / Service Delivery
        </div>
        <h1 data-va-reveal>Service Delivery &amp; Availability Policy</h1>
        <p class="va-doc-meta" data-va-reveal>Last updated: June 2026 · Venture Asia</p>
    </div>
</section>

<section class="va-section">
    <div class="va-hero__container">
        <div class="va-doc" data-va-reveal>
            <div class="va-callout">
                <p><strong>Digital delivery.</strong> Our services are delivered electronically; there is no physical shipment. Account access is provided immediately after verification and funding. Availability is restricted in certain countries, as set out below.</p>
            </div>

            <h2>1. Nature of delivery</h2>
            <p>Venture Asia provides online financial services. All services (account access, trading platforms, market data and educational materials) are delivered <strong>electronically over the internet</strong>. No physical goods are shipped, and there are no postage or freight charges.</p>

            <h2>2. Timing of delivery</h2>
            <ul>
                <li>Account credentials and platform access are typically provided <strong>immediately</strong> after your identity is verified and your account is funded.</li>
                <li>Card deposits are usually credited instantly; bank transfers are credited once cleared.</li>
                <li>If access is delayed for verification or security reasons, our team will contact you.</li>
            </ul>

            <h2>3. Geographic availability</h2>
            <p>Our services are available to clients in many countries; however, the country of the merchant outlet is disclosed to you at the time payment options are presented (<strong>Republic of Mauritius</strong>). We do not direct our services to, or accept clients from, jurisdictions where doing so would be contrary to local law or regulation.</p>

            <h2>4. Restricted jurisdictions &amp; export restrictions</h2>
            <p>We do not provide services to residents of, or accept funds originating from, countries subject to comprehensive international sanctions or where the provision of such services is prohibited. This includes, where applicable, jurisdictions such as those subject to United Nations, OFAC or equivalent sanctions programmes. By way of example, accounts cannot be opened from certain sanctioned territories.</p>
            <ul>
                <li>We screen clients and transactions against applicable sanctions lists.</li>
                <li>We may refuse, suspend or close accounts that breach these restrictions.</li>
                <li>It is your responsibility to ensure that using our services is lawful in your country of residence.</li>
            </ul>

            <h2>5. Special conditions</h2>
            <p>Where local conditions, regulatory requirements or sanctions affect the availability or scope of services in a particular country, those conditions are applied at onboarding and may change without notice in response to legal developments.</p>

            <h2>6. Service interruptions</h2>
            <p>While we aim for continuous availability, access may occasionally be interrupted for maintenance, upgrades or circumstances beyond our control. We will give notice of planned maintenance where reasonably practicable.</p>

            <h2>7. Contact</h2>
            <p>For questions about service availability in your country, contact <a href="mailto:support@ventureasiamarkets.com">support@ventureasiamarkets.com</a> before funding your account.</p>
        </div>
    </div>
</section>

@endsection
