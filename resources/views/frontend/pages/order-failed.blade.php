@extends('frontend.layouts.main')
@section('title', 'Order Failed')
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
                <div class="banner-txt"><h1 class="tl-breadcrumb-title"><i class="fas fa-times-circle me-3" style="color: #ef4444;"></i>{{ __('common.payment_unsuccessful') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.failed') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="failed-section pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-9">
                <div class="modern-failed-card p-5 border-0 shadow-lg bg-white" style="border-radius: 20px; background: linear-gradient(135deg, #ffffff 0%, #fff8f8 100%);">
                    <div class="text-center mb-5">
                        <div class="failed-icon-container d-inline-block position-relative mb-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 120px; height: 120px; background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(239, 68, 68, 0.05) 100%); border: 2px solid rgba(239, 68, 68, 0.2);">
                                <i class="fas fa-times-circle" style="font-size: 60px; color: #ef4444;"></i>
                            </div>
                        </div>

                        <h2 class="fw-bold text-dark mb-2" style="font-size: 32px; letter-spacing: -1px;">{{ __('common.payment_error') }}</h2>
                        <p class="text-muted mb-5" style="font-size: 16px; line-height: 1.6;">{{ __('common.payment_failure_message') }}</p>
                    </div>

                    <div class="help-card p-4 rounded-3 mb-5" style="background: rgba(239, 68, 68, 0.04); border-left: 4px solid #ef4444;">
                        <h6 class="fw-bold text-dark mb-3" style="font-size: 14px; color: #ef4444; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-lightbulb me-2"></i> {{ __('common.what_you_can_do') }}</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 small d-flex gap-2" style="color: #0a0e27;">
                                <i class="fas fa-check text-success mt-1" style="flex-shrink: 0;"></i>
                                <span>{{ __('common.check_payment_details') }}</span>
                            </li>
                            <li class="mb-2 small d-flex gap-2" style="color: #0a0e27;">
                                <i class="fas fa-check text-success mt-1" style="flex-shrink: 0;"></i>
                                <span>{{ __('common.contact_bank') }}</span>
                            </li>
                            <li class="small d-flex gap-2" style="color: #0a0e27;">
                                <i class="fas fa-check text-success mt-1" style="flex-shrink: 0;"></i>
                                <span>{{ __('common.try_different_payment') }}</span>
                            </li>
                        </ul>
                    </div>

                    <div class="d-flex flex-column flex-md-row gap-3 justify-content-center mt-5">
                        <a href="{{ route('home') }}" class="btn btn-light rounded-4 px-5 py-3 fw-bold border border-light" style="background: #f8fbff; transition: all 0.3s ease;">
                            <i class="fas fa-home me-2"></i>{{ __('common.home') }}
                        </a>
                    </div>

                    <div class="mt-5 pt-4 border-top border-light">
                        <h6 class="fw-bold text-dark mb-3" style="font-size: 14px;">{{ __('common.need_assistance') }}</h6>
                        <p class="small text-muted mb-0" style="line-height: 1.6;">
                            {{ __('common.reach_out') }}
                            <a href="mailto:{{ __('common.company_email') }}" class="fw-bold" style="color: #1591DC; text-decoration: none;">{{ __('common.company_email') }}</a>.
                            {{ __('common.we_are_here') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .failed-section {
        background: linear-gradient(135deg, #f8fbff 0%, #ffffff 100%);
    }

    .failed-icon-container i {
        animation: scaleIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes scaleIn {
        0% {
            transform: scale(0);
        }
        100% {
            transform: scale(1);
        }
    }

    .help-card {
        transition: all 0.3s ease;
    }

    .help-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(239, 68, 68, 0.1);
    }

    .btn {
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(239, 68, 68, 0.3);
    }

    .btn-light:hover {
        background: rgba(21, 145, 220, 0.08) !important;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .failed-section {
            padding-top: 60px !important;
            padding-bottom: 60px !important;
        }

        .modern-failed-card {
            padding: 30px !important;
        }

        .d-flex.flex-md-row {
            flex-direction: column !important;
        }

        .btn {
            width: 100%;
        }
    }
</style>
@endpush
