@extends('frontend.layouts.main')
@section('page-body-class', 'page-under-construction')
@section('title','Under Construction')
@section('main-content')

{{-- Layout and content mirror ventureasiamarkets.com/under-construction.
     Menu links for pages that aren't built yet point here. --}}
<section class="va-uc">
    <div class="va-uc__glow"></div>
    <div class="va-hero__container va-uc__inner">
        <div class="va-uc__art">
            <img src="{{ asset('assets/images/under-construction.svg') }}" alt="Page Under Construction">
        </div>
        <div class="va-uc__badge" data-va-reveal>
            <span class="va-uc__dot"></span>
            <span class="va-uc__badge-text">Under Construction</span>
        </div>
        <h1 data-va-reveal>Work in Progress</h1>
        <p class="va-uc__text" data-va-reveal>We are currently crafting something exceptional. This page is undergoing active development and will be launched very soon. Stay tuned!</p>
        <div class="va-uc__actions" data-va-reveal>
            <a class="va-btn va-btn--primary" href="{{ route('home') }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Back to Home
            </a>
            <a class="va-btn va-btn--ghost" href="{{ route('contact') }}">Contact Support</a>
        </div>
    </div>
</section>

@endsection
