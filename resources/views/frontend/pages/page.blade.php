@extends('frontend.layouts.main')
@section('title', $page_data->page_title)
@section('main-content')

<div class="tl-breadcrumb about-banner pt-60 pb-60">
    <video autoplay muted loop playsinline>
        <source src="{{ asset('assets/images/breadcrumb.mp4') }}" type="video/mp4">
    </video>
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ $page_data->page_title }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ $page_data->page_title }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="policy-content-section pt-120 pb-120 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="modern-card p-5 p-md-5 border-0 shadow-sm bg-white" style="border-radius: 30px;">
                    <div class="policy-rich-text">
                        {!! $page_data->page_desc !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .policy-rich-text {
        font-size: 16px;
        line-height: 1.8;
        color: #4a5568;
    }
    .policy-rich-text h1, .policy-rich-text h2, .policy-rich-text h3 {
        color: #1a202c;
        font-weight: 800;
        margin-top: 2.5rem;
        margin-bottom: 1.25rem;
        letter-spacing: -0.5px;
    }
    .policy-rich-text p {
        margin-bottom: 1.5rem;
    }
    .policy-rich-text ol {
        margin-bottom: 1.5rem !important;
        padding-left: 2.5rem !important;
        list-style-type: decimal !important;
        list-style-position: outside !important;
        counter-reset: ol-counter !important;
    }
    .policy-rich-text ol li {
        display: list-item !important;
        list-style-type: decimal !important;
        list-style-position: outside !important;
        margin-bottom: 1.5rem !important;
        color: #4a5568 !important;
        font-size: 16px;
    }
    .policy-rich-text ol li::marker {
        font-size: 1.8em;
        font-weight: 800;
        color: #1a202c;
    }
    .policy-rich-text ol li h3 {
        display: inline;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        margin-left: 0.3rem !important;
        font-size: 1.8em;
    }
    .policy-rich-text ol li h4 {
        color: #1591DC;
        font-weight: 700;
        margin-top: 1.5rem !important;
        margin-bottom: 0.75rem !important;
        font-size: 1.4em;
    }
    .policy-rich-text ul {
        margin: 1rem 0 1.5rem 2rem !important;
        padding-left: 1.5rem !important;
        list-style-type: disc !important;
        list-style-position: outside !important;
    }
    .policy-rich-text ul li {
        display: list-item !important;
        list-style-type: disc !important;
        list-style-position: outside !important;
        margin-bottom: 0.5rem !important;
        color: #4a5568 !important;
    }
    .policy-rich-text li {
        margin-bottom: 0.75rem !important;
        color: #4a5568 !important;
    }

    /* Table Styling */
    .policy-rich-text table {
        width: 100% !important;
        margin: 2rem 0 !important;
        border-collapse: collapse !important;
        border: none !important;
        box-shadow: 0 2px 8px rgba(21, 145, 220, 0.1) !important;
        border-radius: 12px !important;
        overflow: hidden !important;
    }

    .policy-rich-text table tr {
        border: none !important;
    }

    .policy-rich-text table tr:nth-child(odd) {
        background-color: #f8fafc !important;
    }

    .policy-rich-text table tr:nth-child(even) {
        background-color: #ffffff !important;
    }

    .policy-rich-text table tr:hover {
        background-color: rgba(21, 145, 220, 0.05) !important;
        transition: background-color 0.3s ease !important;
    }

    .policy-rich-text table td {
        padding: 16px 20px !important;
        border: 1px solid rgba(21, 145, 220, 0.15) !important;
        color: #4a5568 !important;
        font-size: 15px !important;
        line-height: 1.6 !important;
    }

    .policy-rich-text table td:first-child {
        background-color: rgba(21, 145, 220, 0.08) !important;
        font-weight: 700 !important;
        color: #1591DC !important;
        width: 30% !important;
    }

    .policy-rich-text table strong {
        color: #1591DC !important;
        font-weight: 700 !important;
    }

    .policy-rich-text table img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 8px !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1) !important;
    }

    .policy-rich-text table th {
        background: linear-gradient(135deg, #1591DC 0%, rgba(21, 145, 220, 0.8) 100%) !important;
        color: white !important;
        padding: 18px 20px !important;
        font-weight: 700 !important;
        text-align: left !important;
        font-size: 15px !important;
        letter-spacing: 0.5px !important;
        border: none !important;
    }
</style>
@endpush

