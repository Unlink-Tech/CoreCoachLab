@extends('frontend.layouts.main')
@section('page-body-class', 'page-page')
@section('title', $page_data->page_title)
@section('main-content')

<x-breadcrumb
    :title="$page_data->page_title"
    :routes="[
        ['label' => $page_data->page_title]
    ]"
/>

<section class="doc-section">
    <div class="doc-topline"></div>

    <div class="container doc-container">
        <div class="doc-layout">

            {{-- Sticky meta rail --}}
            <aside class="doc-rail">
                <div class="doc-rail-inner">
                    <span class="doc-chip">
                        <i class="fas fa-shield-alt"></i> Official Document
                    </span>

                    <h2 class="doc-rail-title">{{ $page_data->page_title }}</h2>

                    <div class="doc-rail-divider"></div>

                    @if(!empty($page_data->updated_at))
                    <div class="doc-meta-row">
                        <span class="doc-meta-label">Last updated</span>
                        <span class="doc-meta-value">{{ \Carbon\Carbon::parse($page_data->updated_at)->format('F j, Y') }}</span>
                    </div>
                    @endif

                    <div class="doc-meta-row">
                        <span class="doc-meta-label">Reading time</span>
                        <span class="doc-meta-value">A few minutes</span>
                    </div>

                    <p class="doc-rail-note">
                        Please read this document carefully. By using our platform you agree to the terms described here.
                    </p>

                    <a href="#" onclick="window.print(); return false;" class="doc-print-btn">
                        <i class="fas fa-print"></i> Print / Save as PDF
                    </a>
                </div>
            </aside>

            {{-- Article sheet --}}
            <article class="doc-sheet">
                <div class="doc-sheet-flag">
                    <i class="fas fa-file-signature"></i>
                </div>
                <div class="policy-rich-text">
                    {!! $page_data->page_desc !!}
                </div>
            </article>

        </div>
    </div>
</section>

@endsection
