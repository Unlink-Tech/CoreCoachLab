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

<section class="policy-content-section">
    <!-- Ambient blurred background shapes for warm creative atmosphere -->
    <div class="policy-bg-blob blob-mint"></div>
    <div class="policy-bg-blob blob-sky"></div>
    <div class="policy-bg-blob blob-peach"></div>

    <div class="container policy-content-container">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10">
                <div class="premium-rich-text-card">
                    <div class="policy-rich-text">
                        {!! $page_data->page_desc !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

