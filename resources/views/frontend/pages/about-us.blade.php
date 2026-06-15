@extends('frontend.layouts.main') 
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
                        <img src="{{ asset('assets/art-classes/11.jpg') }}" alt="Academy Painting Masterclass" class="main-artwork-img">
                    </div>
                    <div class="gallery-frame frame-secondary">
                        <img src="{{ asset('assets/art-classes/6.jpg') }}" alt="Digital Illustration Class" class="offset-artwork-img">
                    </div>
                    <div class="gallery-frame frame-tertiary">
                        <img src="{{ asset('assets/art-classes/12.jpg') }}" alt="Watercolor Study" class="tertiary-artwork-img">
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

@push('styles')
<style>
    /* ============================================================
       ABOUT PAGE - MODERN EDITORIAL GALLERY & PILLARS
       ============================================================ */

    .about-page-section {
        background-color: #fffdfb; /* Crisp warm backdrop */
        position: relative;
        overflow: hidden;
    }

    .asymmetric-gallery-wrapper {
        position: relative;
        height: 520px;
        width: 100%;
    }

    /* Ambient light blur glows behind gallery */
    .gallery-bg-accent-1 {
        position: absolute;
        top: 10%;
        left: 5%;
        width: 260px;
        height: 260px;
        background-color: var(--color-mint-wash, #f0f6df);
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.6;
        z-index: 1;
        pointer-events: none;
    }

    .gallery-bg-accent-2 {
        position: absolute;
        bottom: 10%;
        right: 5%;
        width: 300px;
        height: 300px;
        background-color: var(--color-sky-wash, #dceaff);
        border-radius: 50%;
        filter: blur(90px);
        opacity: 0.5;
        z-index: 1;
        pointer-events: none;
    }

    .gallery-bg-accent-3 {
        position: absolute;
        top: 40%;
        left: 45%;
        width: 180px;
        height: 180px;
        background-color: var(--surface-cream-wash, #fff6f0);
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.8;
        z-index: 1;
        pointer-events: none;
    }

    /* Elegant Editorial Frames */
    .gallery-frame {
        position: absolute;
        border-radius: var(--radius-images, 15px);
        border: 1px solid var(--color-stone, #d7d6d4);
        overflow: hidden;
        background-color: var(--surface-paper-canvas, #fefdfc);
        box-shadow: var(--shadow-subtle, 0px 1px 0px 0px rgba(37, 34, 30, 0.04));
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .gallery-frame img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    /* Asymmetrical positions */
    .frame-main {
        top: 12%;
        left: 0;
        width: 62%;
        height: 68%;
        z-index: 2;
    }

    .frame-secondary {
        top: 0;
        right: 2%;
        width: 48%;
        height: 44%;
        z-index: 3;
    }

    .frame-tertiary {
        bottom: 2%;
        right: 18%;
        width: 36%;
        height: 36%;
        z-index: 4;
    }

    /* Hover Micro-interactions */
    .gallery-frame:hover {
        transform: translateY(-8px) scale(1.015);
        border-color: var(--color-ember-red, #e34432);
        box-shadow: var(--shadow-lg, 0px 14px 19px -9px rgba(37, 34, 30, 0.07), 0px 10px 48px 0px rgba(37, 34, 30, 0.18));
        z-index: 10 !important;
    }

    .gallery-frame:hover img {
        transform: scale(1.07);
    }

    /* Badges, Typography & Descriptive Elements */
    .modern-badge {
        display: inline-block;
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-caption, 12px);
        font-weight: var(--font-weight-semibold, 600);
        line-height: 1;
        color: var(--color-deep-ember, #cf3520);
        background-color: var(--surface-cream-wash, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-badges, 8px);
        padding: 6px 12px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    .modern-h2 {
        font-family: var(--font-graphik), sans-serif;
        font-size: var(--text-heading, 38px);
        font-weight: var(--font-weight-bold, 700);
        line-height: var(--leading-heading, 1.28);
        letter-spacing: var(--tracking-heading, -0.19px);
        color: var(--color-ink, #25221e);
    }

    .about-description-text {
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-body, 16px);
        line-height: var(--leading-body, 1.5);
        color: var(--color-pencil, #6f6c69);
    }

    /* Core Pillars Cards style */
    .about-pillar-card {
        background-color: var(--surface-paper-canvas, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-cards, 8px);
        padding: var(--spacing-20, 20px);
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .about-pillar-card:hover {
        transform: translateY(-4px);
        border-color: var(--color-ember-red, #e34432);
        box-shadow: var(--shadow-subtle, 0px 1px 0px 0px rgba(37, 34, 30, 0.04));
    }

    .pillar-icon-wrapper {
        width: 44px;
        height: 44px;
        border-radius: 6px;
        background-color: var(--surface-cream-wash, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--color-deep-ember, #cf3520);
        font-size: 18px;
        margin-bottom: var(--spacing-16, 16px);
        transition: all 0.3s ease;
    }

    .about-pillar-card:hover .pillar-icon-wrapper {
        background-color: var(--color-ember-red, #e34432);
        border-color: var(--color-ember-red, #e34432);
        color: #ffffff;
    }

    .pillar-title {
        font-family: var(--font-graphik), sans-serif;
        font-size: var(--text-body-lg, 18px);
        font-weight: var(--font-weight-bold, 700);
        color: var(--color-ink, #25221e);
        margin: 0 0 var(--spacing-8, 8px) 0;
    }

    .pillar-desc {
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-body-sm, 14px);
        line-height: var(--leading-body-sm, 1.5);
        color: var(--color-pencil, #6f6c69);
        margin: 0;
    }

    /* Responsive Adjustments */
    @media (max-width: 991px) {
        .asymmetric-gallery-wrapper {
            height: 420px;
            margin-bottom: var(--spacing-32, 32px);
        }
    }

    @media (max-width: 576px) {
        .asymmetric-gallery-wrapper {
            height: 320px;
        }
        .modern-h2 {
            font-size: var(--text-subheading, 21px);
        }
    }
</style>
@endpush

@endsection

