@extends('frontend.layouts.main')
@section('title', 'Cart')
@section('main-content')

<x-breadcrumb
    :title="__('common.cart')"
    :routes="[['label' => __('common.cart')]]"
/>

<section class="cart-redesign">
    <!-- Background Grid & Glowing Blobs -->
    <div class="cart-pattern" aria-hidden="true"></div>
    <span class="cart-glow cart-glow-mint" aria-hidden="true"></span>
    <span class="cart-glow cart-glow-sky" aria-hidden="true"></span>

    <div class="container">
        <div class="row g-4">
            <!-- LEFT COLUMN: Cart Items -->
            <div class="col-xl-8 col-lg-7">
                <div class="cart-items-section">
                    <div class="cart-section-header">
                        <h2 class="cart-section-title">
                            <i class="fas fa-bag-shopping"></i> {{ __('common.item_summary') }}
                        </h2>
                        @if(Helper::cartCount())
                            <span class="cart-section-count">{{ Helper::cartCount() }}</span>
                        @endif
                    </div>

                    @if(Helper::cartCount())
                        <div class="cart-items-list">
                            @foreach(Helper::getAllProductFromCart() as $key=>$cart)
                                @php
                                    $item_title = __('common.points_top_up');
                                    $item_image = asset('images/placeholder.jpg');
                                    $item_link = "#";
                                    $is_course = false;
                                    if($cart->product) {
                                        $item_title = $cart->product->title;
                                        $item_link = route('product-detail', $cart->product->slug);
                                        $item_image = asset($cart->product->photo ?? 'images/placeholder.jpg');
                                        if($cart->product_id < 1000) {
                                            $is_course = true;
                                        }
                                    }
                                @endphp

                                <div class="cart-item-card">
                                    @if($is_course)
                                        <!-- Thumbnail -->
                                        <div class="cart-item-card__media">
                                            <img src="{{ $item_image }}" alt="{{ $item_title }}">
                                            <span class="cart-item-card__badge cart-item-card__badge--course">
                                                <i class="fas fa-palette"></i> {{ __('common.learning_path') }}
                                            </span>
                                        </div>
                                    @else
                                        <!-- Credits Top Up Badge Visual instead of Image -->
                                        <div class="cart-item-card__credits-visual">
                                            <i class="fas fa-coins"></i>
                                            <span class="cart-item-card__credits-amount">+{{ number_format($cart->points) }}</span>
                                            <span class="cart-item-card__credits-unit">CREDS</span>
                                        </div>
                                    @endif

                                    <!-- Details Content -->
                                    <div class="cart-item-card__details">
                                        <a href="{{ $item_link }}" class="cart-item-card__title">{{ $item_title }}</a>
                                        <div class="cart-item-card__meta">
                                            @if($is_course)
                                                <span class="cart-item-card__type"><i class="fas fa-book-open"></i> Course</span>
                                            @else
                                                <span class="cart-item-card__type"><i class="fas fa-wallet"></i> Wallet Package</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Price details -->
                                    <div class="cart-item-card__price">
                                        <span class="cart-item-card__price-label">Price</span>
                                        <span class="cart-item-card__price-value">
                                            @if($cart->product_id < 1000 && $cart->points > 0)
                                                <span class="price-creds"><i class="fas fa-coins"></i> {{ number_format($cart->points) }} <span class="price-unit">CRDS</span></span>
                                            @else
                                                <span class="price-main">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</span>
                                            @endif
                                        </span>
                                    </div>

                                    <!-- Delete Button -->
                                    <div class="cart-item-card__action">
                                        <a href="{{ route('cart-delete', $cart->id) }}" class="cart-item-card__remove" title="{{ __('common.remove') }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <a href="{{ route('product-lists') }}" class="cart-continue-link">
                            <i class="fas fa-arrow-left"></i> {{ __('common.continue_shopping') }}
                        </a>
                    @else
                        <div class="cart-empty-state">
                            <div class="cart-empty-state__icon-wrap">
                                <i class="fas fa-shopping-basket"></i>
                            </div>
                            <h4 class="cart-empty-state__title">{{ __('common.no_cart_available') }}</h4>
                            <a href="{{ route('product-lists') }}" class="cart-action-btn cart-action-btn--primary">
                                <i class="fas fa-arrow-left"></i> {{ __('common.continue_shopping') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- RIGHT COLUMN: Order Summary Sidebar -->
            <div class="col-xl-4 col-lg-5">
                <aside class="cart-sidebar">
                    <div class="cart-sidebar__header">
                        <h3 class="cart-sidebar__title">
                            <i class="fas fa-receipt"></i> {{ __('common.order_summary') }}
                        </h3>
                    </div>

                    @if(Helper::cartCount())
                        @php
                            $total_amount = Helper::totalCartPrice();
                            if(session()->has('coupon')) {
                                $total_amount -= Session::get('coupon')['value'];
                            }
                        @endphp

                        <div class="cart-sidebar__rows">
                            <div class="cart-sidebar__row cart-sidebar__row--total">
                                <span class="cart-sidebar__row-label">{{ __('common.total') }}</span>
                                <span class="cart-sidebar__row-value">
                                    @if(Helper::totalCartPoints() > 0)
                                        <i class="fas fa-coins"></i> {{ number_format(Helper::totalCartPoints()) }} <span class="total-unit">CRDS</span>
                                    @else
                                        {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($total_amount, session('currency')=='JPY' ? 0 : 2) }}
                                    @endif
                                </span>
                            </div>
                        </div>

                        <a href="{{ route('checkout') }}" class="cart-action-btn cart-action-btn--checkout cart-action-btn--block">
                            {{ __('common.checkout') }} <i class="fas fa-arrow-right"></i>
                        </a>

                        <ul class="cart-sidebar__trust">
                            <li>
                                <div class="cart-sidebar__trust-icon-wrap cart-sidebar__trust-icon-wrap--security">
                                    <i class="fas fa-shield-halved"></i>
                                </div>
                                <span>{{ __('common.secure_checkout') ?? 'Secure checkout' }}</span>
                            </li>
                            <li>
                                <div class="cart-sidebar__trust-icon-wrap cart-sidebar__trust-icon-wrap--access">
                                    <i class="fas fa-clock-rotate-left"></i>
                                </div>
                                <span>{{ __('common.lifetime_access') ?? 'Lifetime access' }}</span>
                            </li>
                        </ul>

                        <div class="cart-sidebar__pay">
                            <img src="{{ asset('assets/images/payment.png') }}" alt="Accepted payment methods">
                        </div>
                    @else
                        <div class="cart-sidebar__empty">
                            <i class="fas fa-info-circle"></i>
                            <p>{{ __('common.summary_empty') ?? 'Your summary will appear once you add items to the cart.' }}</p>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* =========================================
       CART PAGE REDESIGN — Warm Editorial Theme
       ========================================= */
    .cart-redesign {
        position: relative;
        overflow: hidden;
        background-color: var(--surface-paper-canvas, #fefdfc);
        padding: var(--spacing-48, 48px) 0 var(--spacing-80, 80px);
        font-family: var(--font-inter, sans-serif);
        min-height: 60vh;
    }
    
    /* Background Pattern & Glow Blobs */
    .cart-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(37, 34, 30, 0.03) 1.2px, transparent 1.2px);
        background-size: 24px 24px;
        pointer-events: none;
        z-index: 0;
    }
    .cart-glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(120px);
        pointer-events: none;
        z-index: 0;
        opacity: 0.65;
        mix-blend-mode: multiply;
    }
    .cart-glow-mint { 
        width: 450px; 
        height: 450px; 
        background: radial-gradient(circle, var(--color-mint-wash, #f0f6df) 0%, rgba(240, 246, 223, 0.2) 70%, transparent 100%); 
        top: -150px; 
        left: -100px; 
        animation: cartRedesignDrift 22s ease-in-out infinite; 
    }
    .cart-glow-sky  { 
        width: 400px; 
        height: 400px; 
        background: radial-gradient(circle, var(--color-sky-wash, #dceaff) 0%, rgba(220, 234, 255, 0.2) 70%, transparent 100%); 
        bottom: 8%; 
        right: -100px; 
        animation: cartRedesignDrift 28s ease-in-out infinite reverse; 
    }
    @keyframes cartRedesignDrift { 
        0%, 100% { transform: translate(0, 0) scale(1); } 
        50% { transform: translate(40px, -30px) scale(1.08); } 
    }
    
    .cart-redesign .container { 
        position: relative; 
        z-index: 1; 
    }

    /* ---- ITEMS CONTAINER & CARDS ---- */
    .cart-items-section {
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-xl, 15px);
        padding: var(--spacing-32, 32px);
        box-shadow: 0 4px 20px rgba(37, 34, 30, 0.02);
    }
    .cart-section-header {
        display: flex; 
        align-items: center; 
        justify-content: space-between;
        padding-bottom: var(--spacing-20, 20px); 
        margin-bottom: var(--spacing-24, 24px);
        border-bottom: 1px solid var(--color-stone, #d7d6d4);
    }
    .cart-section-title {
        display: flex; 
        align-items: center; 
        gap: 12px;
        font-family: var(--font-graphik, sans-serif);
        font-size: 20px; 
        font-weight: 700;
        color: var(--color-ink, #25221e); 
        margin: 0;
    }
    .cart-section-title i { 
        color: var(--color-ember-red, #e34432); 
        font-size: 20px; 
    }
    .cart-section-count {
        background: rgba(227, 68, 50, 0.08); 
        color: var(--color-deep-ember, #cf3520);
        font-size: 13px; 
        font-weight: 700;
        padding: 4px 12px; 
        border-radius: 999px;
    }

    /* Modern List of Cart Items */
    .cart-items-list {
        display: flex;
        flex-direction: column;
        gap: var(--spacing-16, 16px);
    }

    /* Horizontal Cart Card Redesign */
    .cart-item-card {
        display: flex;
        align-items: center;
        gap: var(--spacing-20, 20px);
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-lg, 8px);
        padding: var(--spacing-16, 16px);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
    }
    .cart-item-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(37, 34, 30, 0.06);
        border-color: rgba(227, 68, 50, 0.25);
    }
    
    /* Card media/thumbnail */
    .cart-item-card__media {
        position: relative;
        width: 140px;
        height: 84px;
        flex-shrink: 0;
        border-radius: 6px;
        overflow: hidden;
        background: linear-gradient(135deg, var(--color-cream, #fff6f0), var(--color-mint-wash, #f0f6df));
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    .cart-item-card__media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .cart-item-card:hover .cart-item-card__media img {
        transform: scale(1.05);
    }
    
    /* Badges positioned on images */
    .cart-item-card__badge {
        position: absolute;
        bottom: 6px;
        left: 6px;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 8px;
        border-radius: var(--radius-sm, 2.5px);
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.02em;
        -webkit-backdrop-filter: blur(8px);
        backdrop-filter: blur(8px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        text-transform: uppercase;
    }
    .cart-item-card__badge--course {
        background: rgba(254, 253, 252, 0.95);
        color: var(--color-forest, #446c3d);
        border: 1px solid var(--color-stone, #d7d6d4);
    }
    .cart-item-card__badge--topup {
        background: rgba(254, 253, 252, 0.95);
        color: var(--color-deep-ember, #cf3520);
        border: 1px solid var(--color-stone, #d7d6d4);
    }

    /* Credits Visual (in place of top-up images) */
    .cart-item-card__credits-visual {
        width: 140px;
        height: 84px;
        flex-shrink: 0;
        border-radius: 6px;
        background: linear-gradient(135deg, rgba(227, 68, 50, 0.08) 0%, rgba(255, 160, 32, 0.08) 100%);
        border: 1px solid rgba(227, 68, 50, 0.15);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--color-ember-red, #e34432);
        gap: 2px;
        box-shadow: inset 0 2px 6px rgba(227, 68, 50, 0.02);
    }
    .cart-item-card__credits-visual i {
        font-size: 20px;
        animation: ccCoinPulse 2s ease-in-out infinite;
    }
    .cart-item-card__credits-amount {
        font-family: var(--font-graphik, sans-serif);
        font-size: 15px;
        font-weight: 800;
        color: var(--color-ink, #25221e);
        line-height: 1.1;
        margin-top: 2px;
    }
    .cart-item-card__credits-unit {
        font-size: 9px;
        font-weight: 700;
        color: var(--color-deep-ember, #cf3520);
        letter-spacing: 0.05em;
    }
    
    @keyframes ccCoinPulse {
        0%, 100% { transform: scale(1); filter: drop-shadow(0 0 0 transparent); }
        50% { transform: scale(1.1); filter: drop-shadow(0 2px 4px rgba(227, 68, 50, 0.2)); }
    }

    /* Details styling */
    .cart-item-card__details {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        gap: 6px;
        min-width: 0; /* Prevents overflow with flex */
    }
    .cart-item-card__title {
        font-family: var(--font-graphik, sans-serif);
        font-size: 16px;
        font-weight: 600;
        line-height: 1.35;
        color: var(--color-ink, #25221e);
        text-decoration: none;
        transition: color 0.2s ease;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .cart-item-card__title:hover {
        color: var(--color-deep-ember, #cf3520);
        text-decoration: none;
    }
    .cart-item-card__meta {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 12px;
        color: var(--color-pencil, #6f6c69);
    }
    .cart-item-card__type {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .cart-item-card__type i {
        font-size: 11px;
    }

    /* Price alignment */
    .cart-item-card__price {
        text-align: right;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-end;
        padding-left: var(--spacing-16, 16px);
        border-left: 1px solid var(--color-stone, #d7d6d4);
        min-width: 130px;
    }
    .cart-item-card__price-label {
        font-size: 11px;
        color: var(--color-pencil, #6f6c69);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 2px;
    }
    .cart-item-card__price-value {
        font-family: var(--font-graphik, sans-serif);
        font-size: 18px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }
    .cart-item-card__price-value i {
        color: var(--color-ember-red, #e34432);
        font-size: 14px;
        margin-right: 2px;
    }
    .cart-item-card__price-value .price-creds {
        display: flex;
        align-items: baseline;
        gap: 3px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
    }
    .cart-item-card__price-value .price-unit {
        font-size: 11px;
        font-weight: 700;
        color: var(--color-pencil, #6f6c69);
    }
    .cart-item-card__price-value .price-main {
        font-size: 17px;
        color: var(--color-ink, #25221e);
        font-weight: 700;
    }

    /* Action (Remove button) */
    .cart-item-card__action {
        flex-shrink: 0;
    }
    .cart-item-card__remove {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: transparent;
        color: var(--color-graphite, #94928f);
        font-size: 14px;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        text-decoration: none;
    }
    .cart-item-card__remove:hover {
        background: rgba(227, 68, 50, 0.08);
        border-color: rgba(227, 68, 50, 0.1);
        color: var(--color-ember-red, #e34432);
        transform: scale(1.08);
        text-decoration: none;
    }

    .cart-continue-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 24px;
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: var(--color-deep-ember, #cf3520);
        text-decoration: none;
        transition: gap 0.25s cubic-bezier(0.16, 1, 0.3, 1), transform 0.25s ease;
    }
    .cart-continue-link:hover {
        gap: 12px;
        color: var(--color-deep-ember, #cf3520);
        text-decoration: none;
        transform: translateX(-2px);
    }

    /* ---- STICKY ORDER SUMMARY SIDEBAR ---- */
    .cart-sidebar {
        position: -webkit-sticky;
        position: sticky;
        top: 110px;
        background: linear-gradient(180deg, var(--color-paper, #fefdfc) 0%, var(--surface-cream-wash, #fff6f0) 100%);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-xl, 15px);
        padding: var(--spacing-28, 28px);
        box-shadow: 0 10px 30px rgba(37, 34, 30, 0.04);
        animation: cartFadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.1s both;
    }
    .cart-sidebar__header {
        border-bottom: 1px solid var(--color-stone, #d7d6d4);
        padding-bottom: var(--spacing-16, 16px);
        margin-bottom: var(--spacing-20, 20px);
    }
    .cart-sidebar__title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: var(--font-graphik, sans-serif);
        font-size: 18px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        margin: 0;
    }
    .cart-sidebar__title i {
        color: var(--color-ember-red, #e34432);
        font-size: 16px;
    }
    
    .cart-sidebar__rows {
        display: flex;
        flex-direction: column;
        gap: var(--spacing-12, 12px);
        margin-bottom: var(--spacing-24, 24px);
    }
    .cart-sidebar__row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 14px;
    }
    .cart-sidebar__row-label {
        color: var(--color-pencil, #6f6c69);
    }
    .cart-sidebar__row-value {
        font-weight: 600;
        color: var(--color-ink, #25221e);
    }
    
    /* Total cost indicator */
    .cart-sidebar__row--total {
        padding-top: var(--spacing-16, 16px);
        border-top: 1px solid var(--color-stone, #d7d6d4);
        align-items: baseline;
    }
    .cart-sidebar__row--total .cart-sidebar__row-label {
        font-size: 15px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
    }
    .cart-sidebar__row--total .cart-sidebar__row-value {
        font-family: var(--font-graphik, sans-serif);
        font-size: 24px;
        font-weight: 800;
        color: var(--color-ember-red, #e34432);
        display: flex;
        align-items: baseline;
        gap: 4px;
    }
    .cart-sidebar__row--total .cart-sidebar__row-value i {
        font-size: 16px;
    }
    .cart-sidebar__row--total .total-unit {
        font-size: 12px;
        font-weight: 700;
        color: var(--color-pencil, #6f6c69);
    }

    /* Reusable Cart Action Button */
    .cart-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 13px 24px;
        border-radius: var(--radius-buttons, 8px);
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        border: none;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        text-align: center;
    }
    .cart-action-btn:hover {
        text-decoration: none;
    }
    .cart-action-btn--primary {
        background: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        box-shadow: 0 4px 14px rgba(227, 68, 50, 0.25);
    }
    .cart-action-btn--primary:hover {
        background: var(--color-deep-ember, #cf3520);
        color: var(--color-paper, #fefdfc);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(227, 68, 50, 0.35);
    }
    .cart-action-btn--checkout {
        background: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        box-shadow: 0 4px 14px rgba(227, 68, 50, 0.2);
    }
    .cart-action-btn--checkout:hover {
        background: var(--color-deep-ember, #cf3520);
        color: var(--color-paper, #fefdfc);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(227, 68, 50, 0.3);
    }
    .cart-action-btn--checkout i {
        transition: transform 0.25s ease;
    }
    .cart-action-btn--checkout:hover i {
        transform: translateX(4px);
    }
    .cart-action-btn--block {
        display: flex;
        width: 100%;
        margin-bottom: var(--spacing-12, 12px);
    }
    .cart-action-btn--block:last-child {
        margin-bottom: 0;
    }

    /* Trust section */
    .cart-sidebar__trust {
        list-style: none;
        margin: var(--spacing-24, 24px) 0 0;
        padding: var(--spacing-16, 16px);
        display: flex;
        flex-direction: column;
        gap: var(--spacing-12, 12px);
        background-color: rgba(37, 34, 30, 0.02);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-lg, 8px);
    }
    .cart-sidebar__trust li {
        display: flex;
        align-items: center;
        gap: var(--spacing-12, 12px);
        font-size: 13px;
        font-weight: 600;
        color: var(--color-pencil, #6f6c69);
    }
    .cart-sidebar__trust li:not(:last-child) {
        padding-bottom: var(--spacing-8, 8px);
        border-bottom: 1px solid rgba(37, 34, 30, 0.05);
    }
    .cart-sidebar__trust-icon-wrap {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .cart-sidebar__trust-icon-wrap--security {
        background-color: rgba(15, 102, 174, 0.08);
        color: var(--color-cobalt-link, #0f66ae);
        border: 1px solid rgba(15, 102, 174, 0.12);
    }
    .cart-sidebar__trust-icon-wrap--access {
        background-color: rgba(68, 108, 61, 0.08);
        color: var(--color-forest, #446c3d);
        border: 1px solid rgba(68, 108, 61, 0.12);
    }
    .cart-sidebar__trust i {
        font-size: 12px;
    }
    
    .cart-sidebar__pay {
        margin-top: var(--spacing-20, 20px);
        padding-top: var(--spacing-16, 16px);
        border-top: 1px solid var(--color-stone, #d7d6d4);
        text-align: center;
    }
    .cart-sidebar__pay img {
        height: 24px;
        width: auto;
        opacity: 0.85;
    }

    /* Empty State for Summary */
    .cart-sidebar__empty {
        text-align: center;
        padding: var(--spacing-24, 24px) var(--spacing-16, 16px);
        background: rgba(37, 34, 30, 0.02);
        border: 1px dashed var(--color-stone, #d7d6d4);
        border-radius: var(--radius-lg, 8px);
    }
    .cart-sidebar__empty i {
        font-size: 24px;
        color: var(--color-graphite, #94928f);
        margin-bottom: 8px;
        display: block;
    }
    .cart-sidebar__empty p {
        font-size: 13px;
        color: var(--color-pencil, #6f6c69);
        margin: 0;
        line-height: 1.4;
    }

    /* ---- EMPTY STATE ---- */
    .cart-empty-state {
        text-align: center;
        padding: var(--spacing-48, 48px) var(--spacing-24, 24px);
    }
    .cart-empty-state__icon-wrap {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--color-cream, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        color: var(--color-graphite, #94928f);
        font-size: 32px;
        margin-bottom: var(--spacing-20, 20px);
        box-shadow: inset 0 2px 8px rgba(0,0,0,0.02);
    }
    .cart-empty-state__title {
        font-family: var(--font-graphik, sans-serif);
        font-size: 22px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        margin: 0 0 var(--spacing-20, 20px);
    }

    /* ---- Animations ---- */
    @keyframes cartFadeUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .cart-items-section {
        animation: cartFadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.05s both;
    }

    /* ---- Responsive Adaptations ---- */
    @media (max-width: 991px) {
        .cart-sidebar {
            position: static;
            top: auto;
            margin-top: var(--spacing-16, 16px);
        }
    }
    @media (max-width: 767px) {
        .cart-item-card {
            flex-direction: column;
            align-items: stretch;
            gap: var(--spacing-16, 16px);
        }
        .cart-item-card__media {
            width: 100%;
            height: 180px;
        }
        .cart-item-card__credits-visual {
            width: 100%;
            height: 120px;
        }
        .cart-item-card__price {
            border-left: none;
            border-top: 1px solid var(--color-stone, #d7d6d4);
            padding-left: 0;
            padding-top: var(--spacing-12, 12px);
            align-items: flex-start;
            text-align: left;
            min-width: 0;
        }
        .cart-item-card__price-value {
            align-items: flex-start;
            flex-direction: row;
            gap: 8px;
        }
        .cart-item-card__remove {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
    }
    @media (max-width: 575px) {
        .cart-redesign {
            padding: var(--spacing-32, 32px) 0 var(--spacing-64, 64px);
        }
        .cart-items-section {
            padding: var(--spacing-20, 20px);
        }
    }
    @media (prefers-reduced-motion: reduce) {
        .cart-glow, .cart-items-section, .cart-sidebar {
            animation: none !important;
        }
    }
</style>
@endpush
