@extends('frontend.layouts.main') 
@section('title','About Us')
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
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.about') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.about') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="about-page-section pt-120 pb-120">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Left: Images -->
            <div class="col-xl-6 col-lg-6">
                <div class="modern-img-wrapper">
                    <img src="{{ asset('assets/images/h-1.png') }}" alt="About Us" class="w-100 rounded-4 shadow-lg">
                </div>
            </div>

            <!-- Right: Content -->
            <div class="col-xl-6 col-lg-6 ps-xl-5">
                <span class="modern-badge mb-3">{{ __('common.gal_about_section_badge') }}</span>
                <h2 class="modern-h2 mb-4">{{ __('common.gal_about_section_title') }}</h2>
                <p class="text-muted lead mb-5">
                    {{ __('common.gal_about_section_description') }}
                </p>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="mx-auto mb-4 bg-primary text-white d-flex align-items-center justify-content-center"
     style="width: 60px; height: 60px; font-size: 24px; border-radius: 20%;"><i class="fas fa-graduation-cap"></i></div>
                            <h6 class="mb-0 fw-bold">{{ __('common.gal_why_expert_title') }}</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="mx-auto mb-4 bg-primary text-white d-flex align-items-center justify-content-center"
     style="width: 60px; height: 60px; font-size: 24px; border-radius: 20%;"><i class="fas fa-certificate"></i></div>
                            <h6 class="mb-0 fw-bold">{{ __('common.gal_about_certifications') }}</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="mx-auto mb-4 bg-primary text-white d-flex align-items-center justify-content-center"
     style="width: 60px; height: 60px; font-size: 24px; border-radius: 20%;"><i class="fas fa-laptop-code"></i></div>
                            <h6 class="mb-0 fw-bold">{{ __('common.gal_why_industry_title') }}</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="mx-auto mb-4 bg-primary text-white d-flex align-items-center justify-content-center"
     style="width: 60px; height: 60px; font-size: 24px; border-radius: 20%;"><i class="fas fa-project-diagram"></i></div>
                            <h6 class="mb-0 fw-bold">{{ __('common.gal_why_projects_title') }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="values-section pt-120 pb-120 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="modern-badge">{{ __('common.gal_why_badge') }}</span>
            <h2 class="modern-h2 mt-3">{{ __('common.gal_why_title') }}</h2>
        </div>

        <div class="row g-4">
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="modern-card text-center p-5 h-100">
                    <div class="mx-auto mb-4 bg-primary text-white d-flex align-items-center justify-content-center"
     style="width: 60px; height: 60px; font-size: 24px; border-radius: 20%;">
                         <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4>{{ __('common.gal_why_expert_title') }}</h4>
                    <p class="text-muted mt-3 mb-0">{{ __('common.gal_why_expert_desc') }}</p>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="modern-card text-center p-5 h-100">
                    <div class="mx-auto mb-4 bg-primary text-white d-flex align-items-center justify-content-center"
     style="width: 60px; height: 60px; font-size: 24px; border-radius: 20%;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4>{{ __('common.gal_why_industry_title') }}</h4>
                    <p class="text-muted mt-3 mb-0">{{ __('common.gal_why_industry_desc') }}</p>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="modern-card text-center p-5 h-100">
                    <div class="mx-auto mb-4 bg-primary text-white d-flex align-items-center justify-content-center"
     style="width: 60px; height: 60px; font-size: 24px; border-radius: 20%;">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <h4>{{ __('common.gal_why_projects_title') }}</h4>
                    <p class="text-muted mt-3 mb-0">{{ __('common.gal_why_projects_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

