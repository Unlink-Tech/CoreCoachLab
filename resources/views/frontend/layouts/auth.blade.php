@extends('frontend.layouts.main')
@section('main-content')

{{-- Shared shell for the forgot / reset password pages: the login page's layout and styles
     (markets.css "vr-login-*"), with the form in @section('auth-form'). --}}
<div class="va-mk">
    <div class="vr-login-page">
        <div class="vr-login-form-side">
            <div class="vr-login-form-header">
                <div class="vr-login-header-top" style="margin-bottom:24px">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/images/venture-logo.png') }}" alt="Venture Asia logo" class="vr-login-logo"></a>
                    <a href="{{ route('home') }}" class="vr-login-back-home">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:16px;height:16px"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Back to Home
                    </a>
                </div>
                <div class="vr-login-header" style="margin-bottom:20px">
                    <h1>@yield('auth-heading')</h1>
                    @hasSection('auth-subheading')<p>@yield('auth-subheading')</p>@endif
                </div>
            </div>
            <div class="vr-login-form-scrollable">
                @yield('auth-form')
            </div>
        </div>
        <div class="vr-login-brand-side">
            <div class="vr-login-brand-content">
                <div class="vr-login-brand-badge">Institutional Conditions</div>
                <h2>Your Premium Gateway to Global Markets</h2>
                <p>Trade over 600+ instruments with raw spreads, high execution speeds, and a secure trading platform tailored for performance.</p>
                <div class="vr-login-features">
                    @foreach ([
                        'Segregated client funds in tier-1 bank custody',
                        'Ultra-low latency execution via global Equinix servers',
                        'Dynamic, cross-platform liquidity access under one portal',
                    ] as $feature)
                        <div class="vr-login-feat-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><path d="M22 4L12 14.01l-3-3"/></svg>
                            <span>{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
