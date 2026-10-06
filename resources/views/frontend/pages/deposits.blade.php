@extends('frontend.layouts.main')
@section('page-body-class', 'page-deposits')
@section('title','Deposits')
@section('main-content')

{{-- Mirrors ventureasiamarkets.com/deposits. The dashboard is the reference site's own
     component (public/assets/js/deposits-page.js), rendered with React 18.
     Styles: public/assets/css/markets.css (scoped "vr-" classes).
     The deposit form opens config('services.deposit_checkout_url') in a new tab. --}}
<div class="va-mk" id="vaDeposits"
    data-home="{{ route('home') }}" data-accounts="{{ route('accounts') }}"
    data-checkout-url="{{ config('services.deposit_checkout_url') }}">
    <noscript>
        <section class="vr-section"><div class="vr-container">
            <p>This page needs JavaScript enabled.</p>
        </div></section>
    </noscript>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/react/18.2.0/umd/react.production.min.js"
    integrity="sha512-8Q6Y9XnTbOE+JNvjBQwJ2H8S+UV4uA6hiRykhdtIyDYZ2TprdNmWOUaKdGzOhyr4dCyk287OejbPvwl7lrfqrQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/18.2.0/umd/react-dom.production.min.js"
    integrity="sha512-MOCpqoRoisCTwJ8vQQiciZv0qcpROCidek3GTFS6KTk2+y7munJIlKCVkFCYY+p3ErYFXCjmFjnfTTRSC1OHWQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ url('assets/js/deposits-page.js') }}"></script>
@endpush

@endsection
