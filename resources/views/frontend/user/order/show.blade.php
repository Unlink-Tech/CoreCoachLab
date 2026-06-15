@extends('frontend.layouts.main')
@section('title', 'Order Details')

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

@push('styles')
<style>
    /* ============================================================
       ORDER SHOW / INVOICE CANVAS - REDESIGNED EDITORIAL THEMING
       ============================================================ */

    .invoice-section {
        background-color: var(--surface-paper-canvas, #fefdfc);
        position: relative;
        overflow: hidden;
        min-height: 80vh;
    }

    /* Background artistic glows */
    .account-bg-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(120px);
        -webkit-filter: blur(120px);
        pointer-events: none;
        opacity: 0.65;
        z-index: 0;
        mix-blend-mode: multiply;
    }
    .blob-mint {
        width: 450px;
        height: 450px;
        background-color: var(--color-mint-wash, #f0f6df);
        top: -100px;
        left: -100px;
        animation: invoiceFloat 22s ease-in-out infinite;
    }
    .blob-sky {
        width: 380px;
        height: 380px;
        background-color: var(--color-sky-wash, #dceaff);
        bottom: -80px;
        right: -80px;
        animation: invoiceFloat 26s ease-in-out infinite reverse;
    }
    .blob-peach {
        width: 320px;
        height: 320px;
        background-color: var(--surface-cream-wash, #fff6f0);
        top: 35%;
        left: 40%;
        animation: invoiceFloat 30s ease-in-out infinite;
    }

    @keyframes invoiceFloat {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50%      { transform: translate(28px, -32px) scale(1.08); }
    }

    .invoice-container {
        position: relative;
        z-index: 2;
    }

    /* ---- INVOICE CARD CONTAINER ---- */
    .invoice-card {
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 20px;
        padding: clamp(20px, 5vw, 50px);
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05), 0 1px 3px -1px rgba(0, 0, 0, 0.03);
    }

    /* ---- BRANDING & HEADER ---- */
    .invoice-card__header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 24px;
        border-bottom: 1.5px dashed var(--color-stone, #d7d6d4);
        padding-bottom: 30px;
    }

    .invoice-brand__logo {
        font-family: var(--font-graphik), sans-serif;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.18em;
        color: var(--color-pencil, #6f6c69);
        text-transform: uppercase;
        display: block;
    }

    .invoice-brand__title {
        font-family: var(--font-graphik), sans-serif;
        font-size: 24px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
    }

    .order-number-badge {
        font-family: var(--font-graphik), sans-serif;
        font-size: 13px;
        font-weight: 700;
        background: var(--color-cream, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        color: var(--color-ink, #25221e);
        padding: 4px 10px;
        border-radius: 6px;
    }

    .invoice-actions {
        display: flex;
        gap: 12px;
    }

    /* Action Buttons */
    .invoice-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        font-family: var(--font-inter), sans-serif;
        font-size: 13px;
        font-weight: 700;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.25s ease;
        cursor: pointer;
    }

    .invoice-btn--primary {
        background: var(--color-ember-red, #e34432);
        color: #fff !important;
        border: 1px solid var(--color-ember-red, #e34432);
        box-shadow: 0 4px 12px rgba(227, 68, 50, 0.18);
    }
    .invoice-btn--primary:hover {
        background: var(--color-deep-ember, #cf3520);
        border-color: var(--color-deep-ember, #cf3520);
        transform: translateY(-1.5px);
        box-shadow: 0 6px 16px rgba(227, 68, 50, 0.25);
    }

    .invoice-btn--secondary {
        background: transparent;
        color: var(--color-pencil, #6f6c69) !important;
        border: 1px solid var(--color-stone, #d7d6d4);
    }
    .invoice-btn--secondary:hover {
        background: var(--color-cream, #fff6f0);
        color: var(--color-deep-ember, #cf3520) !important;
        border-color: rgba(227, 68, 50, 0.3);
        transform: translateY(-1.5px);
    }

    /* ---- PROGRESS TIMELINE STEPPER ---- */
    .invoice-progress-container {
        background: var(--surface-cream-wash, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 16px;
        padding: 24px;
    }

    .invoice-stepper {
        display: flex;
        justify-content: space-between;
        position: relative;
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }

    .stepper-line {
        position: absolute;
        top: 20px;
        left: 40px;
        right: 40px;
        height: 4px;
        background: var(--color-stone, #d7d6d4);
        z-index: 1;
        border-radius: 2px;
    }
    .stepper-line-fill {
        height: 100%;
        background: var(--color-teal-dusk, #497d7e);
        border-radius: 2px;
        transition: width 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .stepper-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
        width: 120px;
        text-align: center;
    }

    .step-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--color-paper, #fefdfc);
        border: 2px solid var(--color-stone, #d7d6d4);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: var(--color-graphite, #94928f);
        transition: all 0.3s ease;
    }

    .step-label {
        margin-top: 10px;
        font-family: var(--font-inter), sans-serif;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--color-graphite, #94928f);
    }

    .step-date {
        font-family: var(--font-inter), sans-serif;
        font-size: 10.5px;
        color: var(--color-pencil, #6f6c69);
        margin-top: 2px;
    }

    /* Stepper Status States */
    .stepper-step.completed .step-icon {
        background: var(--color-teal-dusk, #497d7e);
        border-color: var(--color-teal-dusk, #497d7e);
        color: #fff;
        box-shadow: 0 0 10px rgba(73, 125, 126, 0.25);
    }
    .stepper-step.completed .step-label {
        color: var(--color-teal-dusk, #497d7e);
    }

    .stepper-step.cancelled .step-icon {
        background: var(--color-ember-red, #e34432);
        border-color: var(--color-ember-red, #e34432);
        color: #fff;
    }
    .stepper-step.cancelled .step-label {
        color: var(--color-ember-red, #e34432);
    }

    .stepper-step.pending .step-icon {
        background: var(--color-paper, #fefdfc);
        border-color: var(--color-stone, #d7d6d4);
        animation: stepperPulse 2s infinite ease-in-out;
    }

    @keyframes stepperPulse {
        0%, 100% { transform: scale(1); box-shadow: 0 0 0 rgba(0,0,0,0); }
        50% { transform: scale(1.04); box-shadow: 0 0 8px rgba(37,34,30,0.06); }
    }

    /* ---- METADATA DETAILS GRID ---- */
    .invoice-details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
    }

    .details-card {
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 14px;
        padding: 24px;
        transition: transform 0.2s ease;
    }
    .details-card:hover {
        transform: translateY(-2px);
    }

    .details-card__title {
        font-family: var(--font-graphik), sans-serif;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--color-deep-ember, #cf3520);
        border-bottom: 1px solid var(--color-stone, #d7d6d4);
        padding-bottom: 12px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid rgba(37,34,30,0.03);
        font-family: var(--font-inter), sans-serif;
        font-size: 13.5px;
    }
    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        color: var(--color-pencil, #6f6c69);
        font-weight: 500;
    }
    .detail-value {
        color: var(--color-ink, #25221e);
        font-weight: 700;
        text-align: right;
    }

    /* ---- TABLE AND ITEMS LIST ---- */
    .invoice-section-title {
        font-family: var(--font-graphik), sans-serif;
        font-weight: 700;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--color-ink, #25221e);
    }

    .db-table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 12px;
        overflow: hidden;
    }
    .db-table thead th {
        background: var(--surface-cream-wash, #fff6f0) !important;
        border-bottom: 1.5px solid var(--color-stone, #d7d6d4) !important;
        color: var(--color-deep-ember, #cf3520) !important;
        font-family: var(--font-inter), sans-serif;
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 14px 16px;
    }
    .db-table tbody tr {
        border-bottom: 1px solid var(--color-stone, rgba(215, 214, 212, 0.5)) !important;
        transition: background-color 0.2s ease;
    }
    .db-table tbody tr:last-child {
        border-bottom: none !important;
    }
    .db-table tbody tr:hover {
        background-color: var(--surface-cream-wash, #fff6f0) !important;
    }
    .db-table tbody td {
        padding: 16px;
        vertical-align: middle;
        font-family: var(--font-inter), sans-serif;
        font-size: 13.5px;
        color: var(--color-pencil, #6f6c69);
    }
    .db-table__course-title {
        color: var(--color-ink, #25221e) !important;
        font-weight: 700;
    }
    .db-table__price {
        font-family: var(--font-graphik), sans-serif;
        font-weight: 800;
        color: var(--color-ink, #25221e);
    }

    /* Badges & Status Pills */
    .db-points-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 11.5px;
        font-weight: 700;
        border: 1px solid transparent;
    }
    .db-points-badge--amber {
        background: var(--color-cream, #fff6f0);
        border-color: rgba(227, 68, 50, 0.15);
        color: var(--color-ember-red, #e34432);
    }
    .db-status-pill {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .db-status-pill--success { background: var(--color-mint-wash, #f0f6df); color: var(--color-forest, #446c3d); }
    .db-status-pill--warning { background: var(--surface-cream-wash, #fff6f0); color: #cf7820; }
    .db-status-pill--danger  { background: #ffebeb; color: #cf3220; }
    .db-status-pill--teal    { background: var(--color-sky-wash, #dceaff); color: var(--color-teal-dusk, #497d7e); }
    .db-status-pill--neutral { background: #f1f0ef; color: var(--color-pencil, #6f6c69); }

    /* Summary / Total Row */
    .invoice-summary-row td {
        padding-top: 20px !important;
        padding-bottom: 20px !important;
        font-family: var(--font-graphik), sans-serif;
        font-size: 15px;
        color: var(--color-ink, #25221e);
    }
    .grand-total-value {
        font-size: 20px !important;
        font-weight: 800 !important;
        color: var(--color-ember-red, #e34432) !important;
    }

    /* ---- RESPONSIVE LAYOUTS ---- */
    @media (max-width: 768px) {
        .invoice-card__header {
            flex-direction: column;
            align-items: stretch;
        }
        .invoice-actions {
            justify-content: flex-start;
        }
        .invoice-actions .invoice-btn {
            flex: 1;
            justify-content: center;
        }
        .invoice-stepper {
            flex-direction: column;
            align-items: flex-start;
            gap: 24px;
            padding-left: 20px;
        }
        .stepper-line {
            left: 31px;
            top: 20px;
            bottom: 20px;
            width: 4px;
            height: auto;
        }
        .stepper-line-fill {
            width: 100%;
            height: 50%;
            transition: height 0.6s ease;
        }
        .stepper-step {
            flex-direction: row;
            text-align: left;
            width: 100%;
            gap: 16px;
        }
        .step-label {
            margin-top: 0;
        }
    }
</style>
@endpush
