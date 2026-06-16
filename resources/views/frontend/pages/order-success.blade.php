@extends('frontend.layouts.main')
@section('page-body-class', 'page-order-success')
@section('title','Order Success')
@php
use App\Models\Order;
$order = Order::where('trans_id', $transaction_id)->first();
@endphp
@section('main-content')

<x-breadcrumb
    :title="__('common.order_successful')"
    :routes="[['label' => __('common.order_success')]]"
/>

<section class="order-status order-status--success">
    <span class="order-status__glow os-glow-mint" aria-hidden="true"></span>
    <span class="order-status__glow os-glow-sky" aria-hidden="true"></span>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-9">
                <div class="status-card">
                    <span class="status-card__accent status-card__accent--success" aria-hidden="true"></span>

                    <div class="text-center">
                        <div class="status-icon status-icon--success">
                            <i class="fas fa-check"></i>
                        </div>
                        <h2 class="status-title">{{ __('common.order_successful') }}</h2>
                        <p class="status-text">{{ __('common.thank_you_order') }} {{ __('common.enrollment_confirmed') }}</p>
                    </div>

                    @if($order)
                    <div class="status-grid">
                        <div class="status-fact">
                            <span class="status-fact__label">{{ __('common.order_number') }}</span>
                            <span class="status-fact__value">{{ $order->order_number }}</span>
                        </div>
                        <div class="status-fact">
                            <span class="status-fact__label">{{ __('common.total_amount') }}</span>
                            <span class="status-fact__value">
                                @php
                                    $currency = match($order->currency) {
                                        'USD' => '$',
                                        'JPY' => '¥',
                                        'HKD' => 'HK$',
                                        default => '$',
                                    };
                                @endphp
                                {{ $currency }} {{number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2)}}
                            </span>
                        </div>
                        <div class="status-fact">
                            <span class="status-fact__label">{{ __('common.transaction_id') }}</span>
                            <span class="status-fact__value">{{ $transaction_id }}</span>
                        </div>
                        <div class="status-fact status-fact--accent">
                            <span class="status-fact__label">{{ __('common.payment_status') }}</span>
                            <span class="status-pill status-pill--success">{{ ucwords($order->payment_status) }}</span>
                        </div>
                    </div>
                    @endif

                    <div class="status-actions">
                        <a href="{{route('user.order.show',$order->id)}}" class="status-btn status-btn--primary">
                            <i class="fas fa-eye"></i> {{ __('common.view_details') }}
                        </a>
                        <a href="{{route('home')}}" class="status-btn status-btn--ghost">
                            <i class="fas fa-home"></i> {{ __('common.home') }}
                        </a>
                        @if($order)
                            <a href="{{route('order.pdf',$order->id)}}" class="status-btn status-btn--outline">
                                <i class="fas fa-download"></i> {{ __('common.download_pdf_invoice') }}
                            </a>
                        @endif
                    </div>

                    @if($email_status=='inactive')
                        <div class="status-note">
                            <p>{{ __('common.high_traffic') }} <a href="{{route('order.pdf',$order->id)}}">{{ __('common.download_pdf_invoice') }}</a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

