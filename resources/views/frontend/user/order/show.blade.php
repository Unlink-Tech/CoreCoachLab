@extends('frontend.layouts.main')
@section('page-body-class', 'page-order-show')
@section('title', __('common.order_show.page_title'))

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

<section class="invoice-section pt-80 pb-100">
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

            <!-- Invoice Canvas Card with Premium Design -->
            <div class="invoice-card" style="border-radius: 24px; box-shadow: 0 8px 32px rgba(0,0,0,0.08); overflow: hidden; border: 1px solid rgba(255,255,255,0.5);">

                <!-- Card Header with Brand & Actions - Enhanced Design -->
                <div class="invoice-card__header mb-5" style="background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(248,248,248,0.95) 100%); padding: 40px; border-bottom: 1px solid rgba(0,0,0,0.05);">
                    <div class="d-flex justify-content-between align-items-start gap-4">
                        <div style="flex: 1;">
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                                <i class="fas fa-shopping-bag" style="font-size: 24px; color: var(--color-primary, #7c3aed);"></i>
                                <span class="invoice-brand__logo" style="font-weight: 700; font-size: 16px; color: var(--color-ink, #25221e);">{{ __('common.dashboard.member_card_title') }}</span>
                            </div>
                            <h2 class="invoice-brand__title mt-3" style="font-size: 28px; color: var(--color-ink, #25221e); margin: 0;">{{ __('common.order_information') }}</h2>
                            <div class="d-flex flex-wrap gap-2 mt-4 align-items-center">
                                <span class="order-number-badge" style="background: var(--color-primary, #7c3aed); color: white; padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 14px;">#{{ $order->order_number }}</span>

                                <!-- Payment Status Pill -->
                                @if($isPaymentCompleted)
                                    <span class="db-status-pill db-status-pill--success" style="background: #10b981; color: white; padding: 8px 14px; border-radius: 6px; font-size: 12px; font-weight: 600;"><i class="fas fa-check-circle me-1"></i>{{ __('common.paid') }}</span>
                                @elseif(strtolower($order->payment_status) === 'failed')
                                    <span class="db-status-pill db-status-pill--danger" style="background: #ef4444; color: white; padding: 8px 14px; border-radius: 6px; font-size: 12px; font-weight: 600;"><i class="fas fa-times-circle me-1"></i>{{ __('common.failed') }}</span>
                                @else
                                    <span class="db-status-pill db-status-pill--warning" style="background: #f59e0b; color: white; padding: 8px 14px; border-radius: 6px; font-size: 12px; font-weight: 600;"><i class="fas fa-hourglass-half me-1"></i>{{ __('common.pending') }}</span>
                                @endif

                                <!-- Order Status Pill -->
                                @if($isOrderCompleted)
                                    <span class="db-status-pill db-status-pill--teal" style="background: #06b6d4; color: white; padding: 8px 14px; border-radius: 6px; font-size: 12px; font-weight: 600;"><i class="fas fa-check me-1"></i>{{ __('common.completed') }}</span>
                                @elseif($isOrderCancelled)
                                    <span class="db-status-pill db-status-pill--danger" style="background: #ef4444; color: white; padding: 8px 14px; border-radius: 6px; font-size: 12px; font-weight: 600;"><i class="fas fa-ban me-1"></i>{{ __('common.cancelled') }}</span>
                                @else
                                    <span class="db-status-pill db-status-pill--warning" style="background: #f59e0b; color: white; padding: 8px 14px; border-radius: 6px; font-size: 12px; font-weight: 600;"><i class="fas fa-spinner me-1"></i>{{ ucwords($order->status) }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="invoice-actions d-flex gap-3">
                            <button onclick="window.history.back();" class="invoice-btn invoice-btn--secondary" style="background: white; border: 2px solid var(--color-stone, #d7d6d4); color: var(--color-ink, #25221e); padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">
                                <i class="fas fa-arrow-left me-2"></i>{{ __('common.back') }}
                            </button>
                            <a href="{{ route('order.pdf', $order->id) }}" class="invoice-btn invoice-btn--primary" style="background: var(--color-primary, #7c3aed); color: white; padding: 10px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; transition: all 0.3s ease;">
                                <i class="fas fa-download me-2"></i>{{ __('common.generate_pdf') }}
                            </a>
                        </div>
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

                <!-- Billing details information grid - Enhanced Design -->
                <div class="invoice-details-grid mb-5" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; padding: 0 40px;">
                    <!-- Billing To Card -->
                    <div class="details-card" style="background: linear-gradient(135deg, rgba(124,58,237,0.05) 0%, rgba(124,58,237,0.02) 100%); padding: 24px; border-radius: 16px; border: 1px solid rgba(124,58,237,0.1);">
                        <div class="details-card__title" style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px; font-weight: 700; color: var(--color-ink, #25221e); font-size: 16px;">
                            <i class="fas fa-user-circle" style="color: var(--color-primary, #7c3aed); font-size: 20px;"></i> {{ __('common.billed_to') }}
                        </div>
                        <div class="details-card__body">
                            <div class="detail-row" style="display: flex; justify-content: space-between; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid rgba(0,0,0,0.05);">
                                <span class="detail-label" style="color: var(--color-graphite, #94928f); font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('common.name') }}</span>
                                <span class="detail-value" style="color: var(--color-ink, #25221e); font-weight: 600;">{{ $order->first_name }} {{ $order->last_name }}</span>
                            </div>
                            <div class="detail-row" style="display: flex; justify-content: space-between; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid rgba(0,0,0,0.05);">
                                <span class="detail-label" style="color: var(--color-graphite, #94928f); font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('common.email') }}</span>
                                <span class="detail-value text-break" style="color: var(--color-ink, #25221e); word-break: break-all;">{{ $order->email }}</span>
                            </div>
                            <div class="detail-row" style="display: flex; justify-content: space-between;">
                                <span class="detail-label" style="color: var(--color-graphite, #94928f); font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('common.payment_method') }}</span>
                                <span class="detail-value" style="color: var(--color-primary, #7c3aed); font-weight: 600;"><i class="fas fa-credit-card me-1"></i>{{ __('common.order_show.payment_method_credit_card') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Transaction Details Card -->
                    <div class="details-card" style="background: linear-gradient(135deg, rgba(16,185,129,0.05) 0%, rgba(16,185,129,0.02) 100%); padding: 24px; border-radius: 16px; border: 1px solid rgba(16,185,129,0.1);">
                        <div class="details-card__title" style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px; font-weight: 700; color: var(--color-ink, #25221e); font-size: 16px;">
                            <i class="fas fa-receipt" style="color: #10b981; font-size: 20px;"></i> {{ __('common.transaction_details') }}
                        </div>
                        <div class="details-card__body">
                            <div class="detail-row" style="display: flex; justify-content: space-between; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid rgba(0,0,0,0.05);">
                                <span class="detail-label" style="color: var(--color-graphite, #94928f); font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('common.order_date') }}</span>
                                <span class="detail-value" style="color: var(--color-ink, #25221e); font-weight: 600;">{{ $order->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="detail-row" style="display: flex; justify-content: space-between; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid rgba(0,0,0,0.05);">
                                <span class="detail-label" style="color: var(--color-graphite, #94928f); font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('common.transaction_id') }}</span>
                                <span class="detail-value text-break" style="color: var(--color-ink, #25221e); font-family: monospace; font-size: 12px; word-break: break-all;">{{ $order->trans_id ?? 'N/A' }}</span>
                            </div>
                            <div class="detail-row" style="display: flex; justify-content: space-between;">
                                <span class="detail-label" style="color: var(--color-graphite, #94928f); font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('common.quantity') }}</span>
                                <span class="detail-value" style="color: #10b981; font-weight: 700; font-size: 18px;">{{ $order->quantity }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Purchased Items Table - Enhanced Design -->
                <div class="invoice-table-container" style="padding: 0 40px;">
                    <h3 class="invoice-section-title mb-4" style="font-size: 20px; font-weight: 700; color: var(--color-ink, #25221e); display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-shopping-bag" style="color: var(--color-primary, #7c3aed); font-size: 22px;"></i>{{ __('common.order_details') }}
                    </h3>
                    <div class="table-responsive">
                        <table class="table db-table" style="border-collapse: collapse;">
                            <thead>
                                <tr style="background: linear-gradient(135deg, rgba(124,58,237,0.08) 0%, rgba(124,58,237,0.04) 100%); border-bottom: 2px solid var(--color-primary, #7c3aed);">
                                    <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--color-ink, #25221e); font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('common.product') }}</th>
                                    <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--color-ink, #25221e); font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('common.level') }}</th>
                                    <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--color-ink, #25221e); font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('common.credits') }}</th>
                                    <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--color-ink, #25221e); font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('common.quantity') }}</th>
                                    <th style="padding: 16px; text-align: right; font-weight: 700; color: var(--color-ink, #25221e); font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('common.total') }}</th>
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
                                        <tr style="border-bottom: 1px solid rgba(0,0,0,0.05); transition: background-color 0.3s ease;">
                                            <td class="db-table__course-title" style="padding: 16px; color: var(--color-ink, #25221e); font-weight: 500;">{{ $item_title }}</td>
                                            <td style="padding: 16px;">
                                                @if($level)
                                                    <span class="db-status-pill db-status-pill--teal" style="background: rgba(6,182,212,0.1); color: #06b6d4; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">{{ $level->skill_level }}</span>
                                                @else
                                                    <span class="db-status-pill db-status-pill--neutral" style="background: rgba(0,0,0,0.05); color: var(--color-graphite, #94928f); padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">N/A</span>
                                                @endif
                                            </td>
                                            <td style="padding: 16px;">
                                                @if($cart->points > 0)
                                                    <span class="db-points-badge db-points-badge--amber" style="background: rgba(251,191,36,0.1); color: #f59e0b; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                                        <i class="fas fa-coins me-1"></i>{{ number_format($cart->points) }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">--</span>
                                                @endif
                                            </td>
                                            <td class="font-weight-bold" style="padding: 16px; text-align: center; color: var(--color-primary, #7c3aed); font-weight: 700;">x{{ $cart->quantity }}</td>
                                            <td class="text-right db-table__price" style="padding: 16px; text-align: right; color: var(--color-ink, #25221e); font-weight: 700;">
                                                {{ $currency }} {{ number_format($cart->price, $order->currency == 'JPY' ? 0 : 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-5" style="color: var(--color-graphite, #94928f); font-weight: 500;">
                                            <i class="fas fa-inbox fa-2x mb-3 d-block" style="opacity: 0.3;"></i>
                                            {{ __('common.no_records_found') }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                            <tfoot>
                                <tr class="invoice-summary-row" style="background: linear-gradient(135deg, rgba(124,58,237,0.08) 0%, rgba(124,58,237,0.04) 100%); border-top: 2px solid var(--color-primary, #7c3aed); font-weight: 700;">
                                    <td colspan="3" class="border-0" style="padding: 20px 16px;"></td>
                                    <td class="text-right font-weight-bold" style="padding: 20px 16px; text-align: right; color: var(--color-ink, #25221e); font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">{{ __('common.total') }}:</td>
                                    <td class="text-right grand-total-value" style="padding: 20px 16px; text-align: right; color: var(--color-primary, #7c3aed); font-size: 20px; font-weight: 700;">
                                        {{ $currency }} {{ number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2) }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        @else
            <!-- Order Not Found Card - Enhanced Design -->
            <div class="invoice-card text-center py-5" style="border-radius: 24px; box-shadow: 0 8px 32px rgba(0,0,0,0.08); background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(248,248,248,0.95) 100%); border: 1px solid rgba(255,255,255,0.5); padding: 60px 40px;">
                <i class="fas fa-search fa-4x mb-4" style="color: var(--color-graphite, #94928f); opacity: 0.3;"></i>
                <h3 style="font-size: 24px; font-weight: 700; color: var(--color-ink, #25221e); margin-bottom: 16px;">{{ __('common.order_not_found') }}</h3>
                <p style="color: var(--color-graphite, #94928f); margin-bottom: 30px; font-size: 16px;">The order you're looking for doesn't exist or has been removed.</p>
                <a href="{{ route('home') }}" class="invoice-btn invoice-btn--primary mt-3" style="display: inline-block; background: var(--color-primary, #7c3aed); color: white; padding: 12px 28px; border-radius: 8px; font-weight: 600; text-decoration: none; transition: all 0.3s ease;">
                    <i class="fas fa-home me-2"></i>{{ __('common.home') }}
                </a>
            </div>
        @endif
    </div>
</section>

@endsection

