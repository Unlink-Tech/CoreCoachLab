@extends('frontend.layouts.main')
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

@push('styles')
<style>
    /* =========================================
       ORDER STATUS PAGE — warm theme
       ========================================= */
    .order-status {
        position: relative;
        overflow: hidden;
        background: var(--surface-paper-canvas, #fefdfc);
        padding: 80px 0 100px;
    }
    .order-status__glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        pointer-events: none;
        z-index: 0;
        opacity: 0.55;
    }
    .os-glow-mint { width: 360px; height: 360px; background: var(--color-mint-wash, #f0f6df); top: -120px; left: -80px; }
    .os-glow-sky  { width: 320px; height: 320px; background: var(--color-sky-wash, #dceaff); bottom: 2%; right: -100px; }
    .order-status .container { position: relative; z-index: 1; }

    /* card */
    .status-card {
        position: relative;
        overflow: hidden;
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 24px;
        padding: clamp(28px, 4vw, 56px);
        box-shadow: 0 20px 50px rgba(37, 34, 30, 0.07), 0 2px 8px rgba(37, 34, 30, 0.03);
        animation: osRise 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
    }
    .status-card__accent {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
    }
    .status-card__accent--success { background: linear-gradient(90deg, var(--color-forest, #446c3d), var(--color-teal-dusk, #497d7e)); }

    /* icon */
    .status-icon {
        width: 110px;
        height: 110px;
        margin: 0 auto 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 50px;
        animation: osPop 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 0.1s both;
    }
    .status-icon--success {
        background: var(--color-mint-wash, #f0f6df);
        border: 2px solid rgba(68, 108, 61, 0.25);
        color: var(--color-forest, #446c3d);
    }

    .status-title {
        font-family: var(--font-graphik), sans-serif;
        font-size: clamp(26px, 3.4vw, 36px);
        font-weight: var(--font-weight-bold, 700);
        letter-spacing: -0.02em;
        color: var(--color-ink, #25221e);
        margin: 0 0 10px;
    }
    .status-text {
        font-family: var(--font-inter), sans-serif;
        font-size: 16px;
        line-height: 1.65;
        color: var(--color-pencil, #6f6c69);
        margin: 0 auto 36px;
        max-width: 520px;
    }

    /* facts grid */
    .status-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-bottom: 36px;
    }
    .status-fact {
        background: var(--color-cream, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 14px;
        padding: 18px 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }
    .status-fact:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
        border-color: rgba(227, 68, 50, 0.3);
    }
    .status-fact--accent { background: var(--color-mint-wash, #f0f6df); border-color: rgba(68, 108, 61, 0.2); }
    .status-fact__label {
        display: block;
        font-family: var(--font-inter), sans-serif;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: var(--color-graphite, #94928f);
        margin-bottom: 8px;
    }
    .status-fact__value {
        font-family: var(--font-graphik), sans-serif;
        font-size: 18px;
        font-weight: var(--font-weight-semibold, 600);
        color: var(--color-ink, #25221e);
        word-break: break-word;
    }
    .status-pill {
        display: inline-block;
        padding: 5px 14px;
        border-radius: 999px;
        font-family: var(--font-inter), sans-serif;
        font-size: 13px;
        font-weight: 600;
    }
    .status-pill--success { background: var(--color-forest, #446c3d); color: #fff; }

    /* actions */
    .status-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
    }
    .status-btn {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 13px 26px;
        border-radius: var(--radius-buttons, 8px);
        font-family: var(--font-inter), sans-serif;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.25s ease;
    }
    .status-btn--primary {
        background: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-ember-red, #e34432);
        box-shadow: 0 8px 20px rgba(227, 68, 50, 0.3);
    }
    .status-btn--primary:hover { background: var(--color-deep-ember, #cf3520); color: var(--color-paper, #fefdfc); transform: translateY(-2px); box-shadow: 0 12px 26px rgba(227, 68, 50, 0.4); }
    .status-btn--ghost {
        background: var(--color-paper, #fefdfc);
        color: var(--color-ink, #25221e);
        border: 1px solid var(--color-stone, #d7d6d4);
    }
    .status-btn--ghost:hover { background: var(--color-cream, #fff6f0); color: var(--color-deep-ember, #cf3520); border-color: rgba(227, 68, 50, 0.3); transform: translateY(-2px); }
    .status-btn--outline {
        background: transparent;
        color: var(--color-deep-ember, #cf3520);
        border: 1.5px solid var(--color-ember-red, #e34432);
    }
    .status-btn--outline:hover { background: var(--color-ember-red, #e34432); color: var(--color-paper, #fefdfc); transform: translateY(-2px); }

    /* note */
    .status-note {
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid var(--color-stone, #d7d6d4);
        text-align: center;
    }
    .status-note p {
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        line-height: 1.6;
        color: var(--color-pencil, #6f6c69);
        margin: 0;
    }
    .status-note a { color: var(--color-cobalt-link, #0f66ae); font-weight: 600; text-decoration: none; }
    .status-note a:hover { color: var(--color-deep-ember, #cf3520); }

    @keyframes osRise { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes osPop { 0% { transform: scale(0); } 100% { transform: scale(1); } }

    @media (max-width: 575px) {
        .order-status { padding: 52px 0 64px; }
        .status-grid { grid-template-columns: 1fr; }
        .status-actions { flex-direction: column; }
        .status-btn { width: 100%; justify-content: center; }
    }
    @media (prefers-reduced-motion: reduce) {
        .status-card, .status-icon { animation: none !important; }
        .status-fact { transition: none !important; }
    }
</style>
@endpush
