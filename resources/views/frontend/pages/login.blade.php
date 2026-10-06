@extends('frontend.layouts.main')
@section('page-body-class', 'page-login')
@section('title','Login')
@section('main-content')

{{-- Mirrors ventureasiamarkets.com/login. The form is the reference site's own component
     (public/assets/js/login-page.js, React 18) with a real POST to route('login.submit').
     Styles: public/assets/css/markets.css (scoped "vr-" classes). --}}
@php
    $vaLoginInit = [
        'method' => old('login_method', 'email'),
        'email' => old('email', ''),
        'phone' => old('phone', ''),
        'errors' => session('loginerror') ? ['password' => session('loginerror')] : new \stdClass(),
    ];
@endphp
<div class="va-mk" id="vaLogin"
    data-home="{{ route('home') }}"
    data-forgot="{{ route('password.request') }}"
    data-register="{{ route('register.form') }}"
    data-action="{{ route('login.submit') }}"
    data-token="{{ csrf_token() }}"
    data-logo="{{ asset('assets/images/venture-logo.png') }}"
    data-init='@json($vaLoginInit)'>
    <noscript>
        {{-- Plain fallback so login still works without JavaScript --}}
        <form method="POST" action="{{ route('login.submit') }}" style="max-width:360px;margin:80px auto;display:grid;gap:12px">
            @csrf
            <input type="hidden" name="login_method" value="email">
            <label>Email <input type="email" name="email" required></label>
            <label>Password <input type="password" name="password" required></label>
            <button type="submit">Log In</button>
        </form>
    </noscript>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/react/18.2.0/umd/react.production.min.js"
    integrity="sha512-8Q6Y9XnTbOE+JNvjBQwJ2H8S+UV4uA6hiRykhdtIyDYZ2TprdNmWOUaKdGzOhyr4dCyk287OejbPvwl7lrfqrQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/18.2.0/umd/react-dom.production.min.js"
    integrity="sha512-MOCpqoRoisCTwJ8vQQiciZv0qcpROCidek3GTFS6KTk2+y7munJIlKCVkFCYY+p3ErYFXCjmFjnfTTRSC1OHWQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ url('assets/js/login-page.js') }}"></script>
@endpush

@endsection
