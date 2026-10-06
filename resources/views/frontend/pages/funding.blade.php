@extends('frontend.layouts.main')
@section('page-body-class', 'page-funding')
@section('title','Deposits & Withdrawals')
@section('main-content')

{{-- Mirrors ventureasiamarkets.com/trading/funding. The page is the reference site's own
     component (public/assets/js/funding-page.js), rendered with React 18.
     Styles: public/assets/css/markets.css (scoped "vr-" classes). --}}
<div class="va-mk" id="vaFunding"
    data-home="{{ route('home') }}" data-login="{{ route('login.form') }}" data-register="{{ route('register.form') }}">
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
<script src="{{ url('assets/js/funding-page.js') }}"></script>
@endpush

@endsection
