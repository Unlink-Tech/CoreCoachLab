@extends('frontend.layouts.main') 
@section('page-body-class', 'page-about-us')
@section('title','About Us')
@section('main-content')

<x-breadcrumb
    :title="__('common.header.about')"
    :routes="[
        ['label' => __('common.header.about')]
    ]"
/>

<section class="about-page-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Left: Asymmetric Overlapping Artwork Gallery -->
            <div class="col-xl-6 col-lg-6">
                <div class="asymmetric-gallery-wrapper">
                    <div class="gallery-frame frame-main">
                        <img src="{{ asset('assets/art-classes/11.webp') }}" alt="Academy Painting Masterclass" class="main-artwork-img" loading="lazy">
                    </div>
                    <div class="gallery-frame frame-secondary">
                        <img src="{{ asset('assets/art-classes/6.webp') }}" alt="Digital Illustration Class" class="offset-artwork-img" loading="lazy">
                    </div>
                    <div class="gallery-frame frame-tertiary">
                        <img src="{{ asset('assets/art-classes/12.webp') }}" alt="Watercolor Study" class="tertiary-artwork-img" loading="lazy">
                    </div>
                    <!-- Decorative soft backdrop shapes -->
                    <div class="gallery-bg-accent-1"></div>
                    <div class="gallery-bg-accent-2"></div>
                    <div class="gallery-bg-accent-3"></div>
                </div>
            </div>

            <!-- Right: Content & Core Pillars -->
            <div class="col-xl-6 col-lg-6 ps-xl-5">
                <span class="modern-badge mb-3">{{ __('common.gal_about_section_badge') }}</span>
                <h2 class="modern-h2 mb-4">{{ __('common.gal_about_section_title') }}</h2>
                <p class="about-description-text mb-5">
                    {{ __('common.gal_about_section_description') }}
                </p>

                <div class="row g-4">
                    <!-- Pillar 1: Master-Led Instruction -->
                    <div class="col-sm-6">
                        <div class="about-pillar-card">
                            <div class="pillar-icon-wrapper">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h4 class="pillar-title">{{ __('common.about.pillar_1_title') }}</h4>
                            <p class="pillar-desc">{{ __('common.about.pillar_1_description') }}</p>
                        </div>
                    </div>

                    <!-- Pillar 2: Structured Learning -->
                    <div class="col-sm-6">
                        <div class="about-pillar-card">
                            <div class="pillar-icon-wrapper">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <h4 class="pillar-title">{{ __('common.about.pillar_2_title') }}</h4>
                            <p class="pillar-desc">{{ __('common.about.pillar_2_description') }}</p>
                        </div>
                    </div>

                    <!-- Pillar 3: Industry Alignment -->
                    <div class="col-sm-6">
                        <div class="about-pillar-card">
                            <div class="pillar-icon-wrapper">
                                <i class="fas fa-paint-brush"></i>
                            </div>
                            <h4 class="pillar-title">{{ __('common.about.pillar_3_title') }}</h4>
                            <p class="pillar-desc">{{ __('common.about.pillar_3_description') }}</p>
                        </div>
                    </div>

                    <!-- Pillar 4: Practical Projects -->
                    <div class="col-sm-6">
                        <div class="about-pillar-card">
                            <div class="pillar-icon-wrapper">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h4 class="pillar-title">{{ __('common.about.pillar_4_title') }}</h4>
                            <p class="pillar-desc">{{ __('common.about.pillar_4_description') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

