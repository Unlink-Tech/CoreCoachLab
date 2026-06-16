@extends('frontend.layouts.main') 
@section('page-body-class', 'page-about-us')
@section('title','About Us')
@section('main-content')

<x-breadcrumb 
    :title="__('common.about')" 
    :routes="[
        ['label' => __('common.about')]
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
                                <i class="fas fa-palette"></i>
                            </div>
                            <h4 class="pillar-title">Master Artists</h4>
                            <p class="pillar-desc">{{ __('common.gal_about_expert_instruction') }}</p>
                        </div>
                    </div>

                    <!-- Pillar 2: Certificates of Completion -->
                    <div class="col-sm-6">
                        <div class="about-pillar-card">
                            <div class="pillar-icon-wrapper">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <h4 class="pillar-title">Certifications</h4>
                            <p class="pillar-desc">{{ __('common.gal_about_certifications_desc') }}</p>
                        </div>
                    </div>

                    <!-- Pillar 3: Industry Alignment -->
                    <div class="col-sm-6">
                        <div class="about-pillar-card">
                            <div class="pillar-icon-wrapper">
                                <i class="fas fa-feather-alt"></i>
                            </div>
                            <h4 class="pillar-title">Modern Skills</h4>
                            <p class="pillar-desc">Explore illustration techniques aligned with gallery standards and digital design.</p>
                        </div>
                    </div>

                    <!-- Pillar 4: Practical Projects -->
                    <div class="col-sm-6">
                        <div class="about-pillar-card">
                            <div class="pillar-icon-wrapper">
                                <i class="fas fa-images"></i>
                            </div>
                            <h4 class="pillar-title">Live Portfolios</h4>
                            <p class="pillar-desc">Develop structured creative art portfolios guided step-by-step by master instructors.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

