@extends('frontend.layouts.main')
@section('page-body-class', 'page-order-show')
@section('title', 'Order Details')

@section('main-content')

<div class="tl-breadcrumb about-banner pt-60 pb-60">
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.order_detail') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.order_detail') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="invoice-section pt-100 pb-100">
    <!-- Ambient artistic blobs in background -->
    <div class="account-bg-blob blob-mint"></div>
    <div class="account-bg-blob blob-sky"></div>
    <div class="account-bg-blob blob-peach"></div>

    <div class="container invoice-container">
        @if($order)
            @php
                $currency = match($order->currency) {
                    'USD' => '$',
                    'JPY' => '¥',
                    'HKD' => 'HK$',
                    default => '$',
                };
                $isPaymentCompleted = strtolower($order->payment_status) === 'completed';
                $isOrderCompleted = strtolower($order->status) === 'completed';
                $isOrderCancelled = strtolower($order->status) === 'cancel';
            @endphp

            <!-- Invoice Canvas Card -->
            <div class="invoice-card">
                
                <!-- Card Header with Brand & Actions -->
                <div class="invoice-card__header mb-5">
                    <div class="invoice-brand">
                        <span class="invoice-brand__logo">ARTIFY STUDIO</span>
                        <h2 class="invoice-brand__title mt-1">{{ __('common.order_information') }}</h2>
                        <div class="d-flex flex-wrap gap-2 mt-2 align-items-center">
                            <span class="order-number-badge">#{{ $order->order_number }}</span>
                            
                            <!-- Payment Status Pill -->
                            @if($isPaymentCompleted)
                                <span class="db-status-pill db-status-pill--success">{{ __('common.paid') }}</span>
                            @elseif(strtolower($order->payment_status) === 'failed')
                                <span class="db-status-pill db-status-pill--danger">{{ __('common.failed') }}</span>
                            @else
                                <span class="db-status-pill db-status-pill--warning">{{ __('common.pending') }}</span>
                            @endif

                            <!-- Order Status Pill -->
                            @if($isOrderCompleted)
                                <span class="db-status-pill db-status-pill--teal">{{ __('common.completed') }}</span>
                            @elseif($isOrderCancelled)
                                <span class="db-status-pill db-status-pill--danger">{{ __('common.cancelled') }}</span>
                            @else
                                <span class="db-status-pill db-status-pill--warning">{{ ucwords($order->status) }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="invoice-actions">
                        <button onclick="window.history.back();" class="invoice-btn invoice-btn--secondary">
                            <i class="fas fa-arrow-left"></i> {{ __('common.back') }}
                        </button>
                        <a href="{{ route('order.pdf', $order->id) }}" class="invoice-btn invoice-btn--primary">
                            <i class="fas fa-download"></i> {{ __('common.generate_pdf') }}
                        </a>
                    </div>
                </div>

                <!-- Timeline / Stepper progress tracker -->
                <div class="invoice-progress-container mb-5">
                    <div class="invoice-stepper">
                        <div class="stepper-line">
                            <div class="stepper-line-fill" style="width: {{ $isOrderCompleted ? '100%' : ($isPaymentCompleted ? '50%' : '15%') }}"></div>
                        </div>
                        
                        <div class="stepper-step completed">
                            <div class="step-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <span class="step-label">{{ __('common.order_placed') }}</span>
                            <span class="step-date">{{ $order->created_at->format('d M Y') }}</span>
                        </div>

                        <div class="stepper-step {{ $isPaymentCompleted ? 'completed' : 'pending' }}">
                            <div class="step-icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <span class="step-label">{{ __('common.payment') }}</span>
                            <span class="step-date">
                                @if($isPaymentCompleted)
                                    {{ __('common.paid') }}
                                @else
                                    {{ __('common.pending') }}
                                @endif
                            </span>
                        </div>

                        <div class="stepper-step @if($isOrderCompleted) completed @elseif($isOrderCancelled) cancelled @else pending @endif">
                            <div class="step-icon">
                                @if($isOrderCancelled)
                                    <i class="fas fa-times-circle"></i>
                                @else
                                    <i class="fas fa-check-circle"></i>
                                @endif
                            </div>
                            <span class="step-label">
                                @if($isOrderCancelled)
                                    {{ __('common.cancelled') }}
                                @else
                                    {{ __('common.completed') }}
                                @endif
                            </span>
                            <span class="step-date">
                                @if($isOrderCompleted)
                                    {{ __('common.processed') }}
                                @elseif($isOrderCancelled)
                                    {{ __('common.cancelled') }}
                                @else
                                    --
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Billing details information grid -->
                <div class="invoice-details-grid mb-5">
                    <div class="details-card">
                        <div class="details-card__title">
                            <i class="fas fa-user-circle"></i> {{ __('common.billed_to') }}
                        </div>
                        <div class="details-card__body">
                            <div class="detail-row">
                                <span class="detail-label">{{ __('common.name') }}</span>
                                <span class="detail-value">{{ $order->first_name }} {{ $order->last_name }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">{{ __('common.email') }}</span>
                                <span class="detail-value text-break">{{ $order->email }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">{{ __('common.payment_method') }}</span>
                                <span class="detail-value">Credit Card</span>
                            </div>
                        </div>
                    </div>

                    <div class="details-card">
                        <div class="details-card__title">
                            <i class="fas fa-info-circle"></i> {{ __('common.transaction_details') }}
                        </div>
                        <div class="details-card__body">
                            <div class="detail-row">
                                <span class="detail-label">{{ __('common.order_date') }}</span>
                                <span class="detail-value">{{ $order->created_at->format('d M Y, g:i a') }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">{{ __('common.transaction_id') }}</span>
                                <span class="detail-value text-break">{{ $order->trans_id ?? 'N/A' }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">{{ __('common.quantity') }}</span>
                                <span class="detail-value">{{ $order->quantity }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Purchased Items Table -->
                <div class="invoice-table-container">
                    <h3 class="invoice-section-title mb-3">
                        <i class="fas fa-list-ul me-2 text-danger"></i>{{ __('common.order_details') }}
                    </h3>
                    <div class="table-responsive">
                        <table class="table db-table">
                            <thead>
                                <tr>
                                    <th>{{ __('common.product') }}</th>
                                    <th>{{ __('common.level') }}</th>
                                    <th>{{ __('common.credits') }}</th>
                                    <th>{{ __('common.quantity') }}</th>
                                    <th class="text-right">{{ __('common.total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($order->cart_info) && count($order->cart_info) > 0)
                                    @foreach($order->cart_info as $cart)
                                        @php 
                                            // Safe fallback check for product relation
                                            $item_title = '';
                                            if ($cart->product) {
                                                $item_title = $cart->product->title;
                                            } else {
                                                $product = DB::table('products')->select('title')->where('id', $cart->product_id)->first();
                                                $item_title = $product ? $product->title : 'N/A';
                                            }

                                            // Level detail extraction if applicable
                                            $level = null;
                                            if($cart->product_id < 1000) {
                                                $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                                                                 ->where('price_in_points', $cart->points)
                                                                                 ->first();
                                            }
                                        @endphp
                                        <tr>
                                            <td class="db-table__course-title">{{ $item_title }}</td>
                                            <td>
                                                @if($level)
                                                    <span class="db-status-pill db-status-pill--teal">{{ $level->skill_level }}</span>
                                                @else
                                                    <span class="db-status-pill db-status-pill--neutral">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($cart->points > 0)
                                                    <span class="db-points-badge db-points-badge--amber">
                                                        <i class="fas fa-coins me-1"></i>{{ number_format($cart->points) }} CREDS
                                                    </span>
                                                @else
                                                    <span class="text-muted">--</span>
                                                @endif
                                            </td>
                                            <td class="font-weight-bold">x{{ $cart->quantity }}</td>
                                            <td class="text-right db-table__price">
                                                {{ $currency }} {{ number_format($cart->price, $order->currency == 'JPY' ? 0 : 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            {{ __('common.no_records_found') }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                            <tfoot>
                                <tr class="invoice-summary-row">
                                    <td colspan="3" class="border-0"></td>
                                    <td class="text-right font-weight-bold">{{ __('common.total') }}:</td>
                                    <td class="text-right grand-total-value">
                                        {{ $currency }} {{ number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2) }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        @else
            <div class="invoice-card text-center py-5">
                <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                <h3>{{ __('common.order_not_found') }}</h3>
                <a href="{{ route('home') }}" class="invoice-btn invoice-btn--primary mt-3">
                    <i class="fas fa-home"></i> {{ __('common.home') }}
                </a>
            </div>
        @endif
    </div>
</section>

@endsection

