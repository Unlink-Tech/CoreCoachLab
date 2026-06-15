@extends('frontend.layouts.main')
@section('title','Order Success')
@php
use App\Models\Order;
$order = Order::where('trans_id', $transaction_id)->first();
@endphp
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
                <div class="banner-txt"><h1 class="tl-breadcrumb-title"><i class="fas fa-check-circle me-3" style="color: #22c55e;"></i>{{ __('common.order_success') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.order_success') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="success-section pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-9">
                <div class="modern-success-card p-5 border-0 shadow-lg bg-white" style="border-radius: 20px; background: linear-gradient(135deg, #ffffff 0%, #f8fbff 100%);">
                    <div class="text-center mb-5">
                        <div class="success-icon-container d-inline-block position-relative mb-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 120px; height: 120px; background: linear-gradient(135deg, rgba(34, 197, 94, 0.15) 0%, rgba(34, 197, 94, 0.05) 100%); border: 2px solid rgba(34, 197, 94, 0.2);">
                                <i class="fas fa-check-circle" style="font-size: 60px; color: #22c55e;"></i>
                            </div>
                        </div>

                        <h2 class="fw-bold text-dark mb-2" style="font-size: 32px; letter-spacing: -1px;">{{ __('common.order_successful') }}</h2>
                        <p class="text-muted mb-5" style="font-size: 16px; line-height: 1.6;">{{ __('common.thank_you_order') }} {{ __('common.enrollment_confirmed') }}</p>
                    </div>

                    @if($order)
                    <div class="order-info-grid mb-5">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-card p-4 rounded-3 bg-light border border-light" style="background: rgba(21, 145, 220, 0.04);">
                                    <div class="text-uppercase small fw-bold mb-2" style="color: #1591DC; letter-spacing: 0.5px;">{{ __('common.order_number') }}</div>
                                    <div class="fw-bold text-dark" style="font-size: 18px;">{{ $order->order_number }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-card p-4 rounded-3 bg-light border border-light" style="background: rgba(21, 145, 220, 0.04);">
                                    <div class="text-uppercase small fw-bold mb-2" style="color: #1591DC; letter-spacing: 0.5px;">{{ __('common.total_amount') }}</div>
                                    <div class="fw-bold text-dark" style="font-size: 18px;">
                                        @php
                                            $currency = match($order->currency) {
                                                'USD' => '$',
                                                'JPY' => '¥',
                                                'HKD' => 'HK$',
                                                default => '$',
                                            };
                                        @endphp
                                        {{ $currency }} {{number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2)}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-card p-4 rounded-3 bg-light border border-light" style="background: rgba(21, 145, 220, 0.04);">
                                    <div class="text-uppercase small fw-bold mb-2" style="color: #1591DC; letter-spacing: 0.5px;">{{ __('common.transaction_id') }}</div>
                                    <div class="fw-bold text-dark" style="font-size: 18px;">{{ $transaction_id }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-card p-4 rounded-3 bg-light border border-light" style="background: rgba(34, 197, 94, 0.08);">
                                    <div class="text-uppercase small fw-bold mb-2" style="color: #22c55e; letter-spacing: 0.5px;">{{ __('common.payment_status') }}</div>
                                    <div class="fw-bold text-dark" style="font-size: 18px;">
                                        <span class="badge" style="background: #22c55e;">{{ ucwords($order->payment_status) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="d-flex flex-column flex-md-row gap-3 justify-content-center mt-5">
                        <a href="{{route('user.order.show',$order->id)}}" class="btn btn-primary rounded-4 px-5 py-3 fw-bold shadow-sm" style="background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%); border: none; transition: all 0.3s ease;">
                            <i class="fas fa-eye me-2"></i>{{ __('common.view_details') }}
                        </a>
                        <a href="{{route('home')}}" class="btn btn-light rounded-4 px-5 py-3 fw-bold border border-light" style="background: #f8fbff; transition: all 0.3s ease;">
                            <i class="fas fa-home me-2"></i>{{ __('common.home') }}
                        </a>
                        @if($order)
                            <a href="{{route('order.pdf',$order->id)}}" class="btn btn-outline-primary rounded-4 px-5 py-3 fw-bold" style="color: #1591DC; border-color: #1591DC; transition: all 0.3s ease;">
                                <i class="fas fa-download me-2"></i>{{ __('common.download_pdf_invoice') }}
                            </a>
                        @endif
                    </div>

                    @if($email_status=='inactive')
                        <div class="mt-5 pt-4 border-top border-light">
                            <p class="text-muted mb-0" style="font-size: 14px; line-height: 1.6;">{{ __('common.high_traffic') }} <a href="{{route('order.pdf',$order->id)}}" class="fw-bold" style="color: #1591DC; text-decoration: none;">{{ __('common.download_pdf_invoice') }}</a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .success-section {
        background: linear-gradient(135deg, #f8fbff 0%, #ffffff 100%);
    }

    .success-icon-container i {
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

    .info-card {
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(21, 145, 220, 0.1);
    }

    .btn {
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(21, 145, 220, 0.3);
    }

    .btn-light:hover {
        background: rgba(21, 145, 220, 0.08) !important;
        transform: translateY(-2px);
    }

    .btn-outline-primary:hover {
        background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%) !important;
        color: white !important;
        border-color: #1591DC !important;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .success-section {
            padding-top: 60px !important;
            padding-bottom: 60px !important;
        }

        .modern-success-card {
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
