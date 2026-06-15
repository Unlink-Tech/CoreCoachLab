@extends('frontend.layouts.main')
@section('title', 'Course Cart')
@section('main-content')

<x-breadcrumb
    :title="__('common.cart')"
    :routes="[['label' => __('common.cart')]]"
/>

@auth
<section class="ccart-redesign">
    <!-- Background Grid & Glowing Blobs -->
    <div class="ccart-pattern" aria-hidden="true"></div>
    <span class="ccart-glow ccart-glow-mint" aria-hidden="true"></span>
    <span class="ccart-glow ccart-glow-sky" aria-hidden="true"></span>

    <div class="container">
        @php
            $user = auth()->user();
            $points = $user->points_balance ?? 0;
        @endphp

        <!-- Available Credits Balance Card -->
        <div class="ccart-balance-card">
            <div class="ccart-balance-card__info">
                <div class="ccart-balance-card__icon-wrap">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="ccart-balance-card__text">
                    <span class="ccart-balance-card__label">{{ __('common.available_credits') }}</span>
                    <span class="ccart-balance-card__value">
                        {{ number_format($points) }} <span class="ccart-balance-card__currency">CREDS</span>
                    </span>
                </div>
            </div>
            <a href="{{ route('points.topup') }}" class="ccart-btn-topup">
                <i class="fas fa-plus"></i> {{ __('common.points_top_up') }}
            </a>
        </div>

        <div class="row g-4">
            <!-- LEFT COLUMN: Cart Items -->
            <div class="col-xl-8 col-lg-7">
                <div class="ccart-items-section">
                    <div class="ccart-section-header">
                        <h2 class="ccart-section-title">
                            <i class="fas fa-graduation-cap"></i> {{ __('common.courses_in_cart') }}
                        </h2>
                        @if(Helper::cartCount())
                            <span class="ccart-section-count">
                                {{ Helper::getAllProductFromCart()->where('order_id', null)->count() }}
                            </span>
                        @endif
                    </div>

                    @if(Helper::cartCount() && Helper::getAllProductFromCart()->where('order_id', null)->count() > 0)
                        <div class="ccart-items-list">
                            @foreach(Helper::getAllProductFromCart()->where('order_id', null) as $key=>$cart)
                                @php
                                    $item_title = __('common.points_top_up');
                                    $item_image = asset('images/placeholder.jpg');
                                    $item_link = "#";
                                    $is_course = false;
                                    $level = null;

                                    if($cart->product) {
                                        $item_title = $cart->product->title;
                                        $item_link = route('product-detail', $cart->product->slug);
                                        $item_image = asset($cart->product->photo ?? 'images/placeholder.jpg');

                                        if($cart->product_id < 1000) {
                                            $is_course = true;
                                            $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                                         ->where('price_in_points', $cart->points)
                                                         ->first();
                                        }
                                    }
                                @endphp

                                <div class="ccart-item-card">
                                    @if($is_course)
                                        <!-- Thumbnail -->
                                        <div class="ccart-item-card__media">
                                            <img src="{{ $item_image }}" alt="{{ $item_title }}">
                                            <span class="ccart-item-card__badge ccart-item-card__badge--course">
                                                <i class="fas fa-signal"></i> {{ $level ? $level->skill_level : 'Course' }}
                                            </span>
                                        </div>
                                    @else
                                        <!-- Credits Top Up Badge Visual instead of Image -->
                                        <div class="ccart-item-card__credits-visual">
                                            <i class="fas fa-coins"></i>
                                            <span class="ccart-item-card__credits-amount">+{{ number_format($cart->points) }}</span>
                                            <span class="ccart-item-card__credits-unit">CREDS</span>
                                        </div>
                                    @endif

                                    <!-- Details Content -->
                                    <div class="ccart-item-card__details">
                                        <a href="{{ $item_link }}" class="ccart-item-card__title">{{ $item_title }}</a>
                                        <div class="ccart-item-card__meta">
                                            @if($is_course)
                                                <span class="ccart-item-card__type"><i class="fas fa-book-open"></i> Course Enrollment</span>
                                            @else
                                                <span class="ccart-item-card__type"><i class="fas fa-wallet"></i> Wallet Top Up</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Cost details -->
                                    <div class="ccart-item-card__cost">
                                        <span class="ccart-item-card__cost-label">
                                            {{ $is_course ? __('common.points_cost') : __('common.price') }}
                                        </span>
                                        <span class="ccart-item-card__cost-value">
                                            @if($is_course)
                                                <span class="cost-creds"><i class="fas fa-coins"></i> {{ number_format($cart->points) }} <span class="cost-unit">CREDS</span></span>
                                            @else
                                                <span class="cost-price">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</span>
                                            @endif
                                        </span>
                                    </div>

                                    <!-- Delete Button -->
                                    <div class="ccart-item-card__action">
                                        <a href="{{ route('cart-delete', $cart->id) }}" class="ccart-item-card__remove" title="{{ __('common.remove') }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="ccart-empty-state">
                            <div class="ccart-empty-state__icon-wrap">
                                <i class="fas fa-shopping-basket"></i>
                            </div>
                            <h4 class="ccart-empty-state__title">{{ __('common.no_cart_available') }}</h4>
                            <p class="ccart-empty-state__text">{{ __('common.empty_cart_message') }}</p>
                            <a href="{{ route('product-lists') }}" class="ccart-action-btn ccart-action-btn--primary">
                                <i class="fas fa-arrow-left"></i> {{ __('common.continue_shopping') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- RIGHT COLUMN: Order Summary Sidebar -->
            <div class="col-xl-4 col-lg-5">
                <aside class="ccart-sidebar">
                    <div class="ccart-sidebar__header">
                        <h3 class="ccart-sidebar__title">
                            <i class="fas fa-receipt"></i> {{ __('common.order_summary') }}
                        </h3>
                    </div>

                    @if(Helper::cartCount() && Helper::getAllProductFromCart()->where('order_id', null)->count() > 0)
                        @php
                            $total_points = Helper::totalCartPoints();
                            $enough = $points >= $total_points;
                        @endphp

                        <div class="ccart-sidebar__rows">
                            <div class="ccart-sidebar__row">
                                <span class="ccart-sidebar__row-label">{{ __('common.item_count') }}</span>
                                <span class="ccart-sidebar__row-value">
                                    {{ Helper::getAllProductFromCart()->where('order_id', null)->count() }}
                                </span>
                            </div>
                            
                            <div class="ccart-sidebar__row ccart-sidebar__row--total">
                                <span class="ccart-sidebar__row-label">{{ __('common.total') }}</span>
                                <span class="ccart-sidebar__row-value">
                                    <i class="fas fa-coins"></i> {{ number_format($total_points) }} <span class="total-unit">CREDS</span>
                                </span>
                            </div>
                        </div>

                        <!-- Credit Availability Alert -->
                        <div class="ccart-status-alert {{ $enough ? 'ccart-status-alert--success' : 'ccart-status-alert--danger' }}">
                            <div class="ccart-status-alert__icon">
                                <i class="fas {{ $enough ? 'fa-check-circle' : 'fa-exclamation-triangle' }}"></i>
                            </div>
                            <div class="ccart-status-alert__content">
                                @if($enough)
                                    <span class="ccart-status-alert__title">Sufficient Credits</span>
                                    <span class="ccart-status-alert__desc">You have enough credits to complete this enrollment.</span>
                                @else
                                    <span class="ccart-status-alert__title">Insufficient Credits</span>
                                    <span class="ccart-status-alert__desc">You need {{ number_format($total_points - $points) }} more CREDS for this purchase.</span>
                                @endif
                            </div>
                        </div>

                        <!-- Action Form / Checkout -->
                        <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST" style="display:none;">
                            @csrf
                        </form>

                        @if($enough)
                            <button type="button" onclick="document.getElementById('redeemPointsForm').submit();" class="ccart-action-btn ccart-action-btn--checkout ccart-action-btn--block">
                                <i class="fas fa-lock"></i> {{ __('common.redeem_points') ?? 'Purchase' }}
                            </button>
                        @else
                            <a href="{{ route('points.topup') }}" class="ccart-action-btn ccart-action-btn--topup ccart-action-btn--block">
                                <i class="fas fa-plus-circle"></i> {{ __('common.points_top_up') }}
                            </a>
                            <button type="button" class="ccart-action-btn ccart-action-btn--checkout ccart-action-btn--block ccart-action-btn--disabled" disabled>
                                <i class="fas fa-lock"></i> {{ __('common.redeem_points') ?? 'Purchase' }} (Low Credits)
                            </button>
                        @endif

                        <a href="{{ route('product-lists') }}" class="ccart-action-btn ccart-action-btn--ghost ccart-action-btn--block">
                            <i class="fas fa-plus"></i> {{ __('common.continue_shopping') }}
                        </a>
                    @else
                        <div class="ccart-sidebar__empty">
                            <i class="fas fa-info-circle"></i>
                            <p>{{ __('common.summary_empty') ?? 'Your summary will appear once you add items to the cart.' }}</p>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </div>
</section>
@else
<!-- Guest Section -->
<section class="ccart-redesign">
    <div class="ccart-pattern" aria-hidden="true"></div>
    <span class="ccart-glow ccart-glow-mint" aria-hidden="true"></span>
    <span class="ccart-glow ccart-glow-sky" aria-hidden="true"></span>
    
    <div class="container">
        <div class="ccart-guard-card">
            <div class="ccart-guard-card__icon-wrap">
                <i class="fas fa-lock"></i>
            </div>
            <h3 class="ccart-guard-card__title">{{ __('common.sign_in_required') }}</h3>
            <p class="ccart-guard-card__text">{{ __('common.sign_in_message') }}</p>
            <a href="{{ route('login.form') }}" class="ccart-action-btn ccart-action-btn--primary">
                <i class="fas fa-sign-in-alt"></i> {{ __('common.sign_in') }}
            </a>
        </div>
    </div>
</section>
@endauth

@endsection

@push('styles')
<style>
    /* =========================================
       COURSE CART REDESIGN — Warm Editorial Theme
       ========================================= */
    .ccart-redesign {
        position: relative;
        overflow: hidden;
        background-color: var(--surface-paper-canvas, #fefdfc);
        padding: var(--spacing-48, 48px) 0 var(--spacing-80, 80px);
        font-family: var(--font-inter, sans-serif);
        min-height: 60vh;
    }
    
    /* Background Pattern & Glow Blobs */
    .ccart-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(37, 34, 30, 0.03) 1.2px, transparent 1.2px);
        background-size: 24px 24px;
        pointer-events: none;
        z-index: 0;
    }
    .ccart-glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(120px);
        pointer-events: none;
        z-index: 0;
        opacity: 0.65;
        mix-blend-mode: multiply;
    }
    .ccart-glow-mint { 
        width: 450px; 
        height: 450px; 
        background: radial-gradient(circle, var(--color-mint-wash, #f0f6df) 0%, rgba(240, 246, 223, 0.2) 70%, transparent 100%); 
        top: -150px; 
        left: -100px; 
        animation: ccRedesignDrift 22s ease-in-out infinite; 
    }
    .ccart-glow-sky  { 
        width: 400px; 
        height: 400px; 
        background: radial-gradient(circle, var(--color-sky-wash, #dceaff) 0%, rgba(220, 234, 255, 0.2) 70%, transparent 100%); 
        bottom: 8%; 
        right: -100px; 
        animation: ccRedesignDrift 28s ease-in-out infinite reverse; 
    }
    @keyframes ccRedesignDrift { 
        0%, 100% { transform: translate(0, 0) scale(1); } 
        50% { transform: translate(40px, -30px) scale(1.08); } 
    }
    
    .ccart-redesign .container { 
        position: relative; 
        z-index: 1; 
    }

    /* ---- AVAILABLE CREDITS BALANCE CARD ---- */
    .ccart-balance-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: var(--spacing-20, 20px);
        padding: var(--spacing-24, 24px) var(--spacing-32, 32px);
        margin-bottom: var(--spacing-32, 32px);
        border-radius: var(--radius-xl, 15px);
        background: linear-gradient(135deg, var(--color-paper, #fefdfc), #ffffff);
        border: 1px solid var(--color-stone, #d7d6d4);
        box-shadow: 0 4px 20px rgba(37, 34, 30, 0.03);
        animation: ccFadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
        position: relative;
        overflow: hidden;
    }
    .ccart-balance-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 4px; height: 100%;
        background: var(--color-ember-red, #e34432);
    }
    .ccart-balance-card__info { 
        display: flex; 
        align-items: center; 
        gap: var(--spacing-20, 20px); 
    }
    .ccart-balance-card__icon-wrap {
        width: 60px; 
        height: 60px;
        display: inline-flex; 
        align-items: center; 
        justify-content: center;
        border-radius: 50%;
        background: rgba(227, 68, 50, 0.06);
        color: var(--color-ember-red, #e34432);
        font-size: 24px;
        box-shadow: inset 0 2px 6px rgba(227, 68, 50, 0.05);
    }
    .ccart-balance-card__text {
        display: flex;
        flex-direction: column;
        gap: var(--spacing-4, 4px);
    }
    .ccart-balance-card__label { 
        font-size: 13px; 
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        color: var(--color-pencil, #6f6c69); 
    }
    .ccart-balance-card__value { 
        font-family: var(--font-graphik, sans-serif); 
        font-size: 28px; 
        font-weight: 800; 
        color: var(--color-ink, #25221e); 
        line-height: 1.1; 
        display: flex;
        align-items: baseline;
        gap: 6px;
    }
    .ccart-balance-card__currency { 
        font-size: 13px; 
        color: var(--color-deep-ember, #cf3520); 
        font-weight: 700; 
        letter-spacing: 0.05em;
    }
    
    /* Elegant top up button */
    .ccart-btn-topup {
        display: inline-flex; 
        align-items: center; 
        gap: 8px;
        padding: 12px 24px; 
        border-radius: var(--radius-buttons, 8px);
        background: var(--color-ink, #25221e);
        color: var(--color-paper, #fefdfc);
        font-size: 14px; 
        font-weight: 600;
        text-decoration: none; 
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        border: 1px solid var(--color-ink, #25221e);
        box-shadow: 0 4px 12px rgba(37, 34, 30, 0.15);
    }
    .ccart-btn-topup:hover { 
        background: var(--color-ember-red, #e34432); 
        border-color: var(--color-ember-red, #e34432); 
        color: var(--color-paper, #fefdfc); 
        transform: translateY(-2px); 
        box-shadow: 0 6px 18px rgba(227, 68, 50, 0.3);
    }
    .ccart-btn-topup:active {
        transform: translateY(0);
    }

    /* ---- CARDS & CONTAINERS ---- */
    .ccart-items-section {
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-xl, 15px);
        padding: var(--spacing-32, 32px);
        box-shadow: 0 4px 20px rgba(37, 34, 30, 0.02);
    }
    .ccart-section-header {
        display: flex; 
        align-items: center; 
        justify-content: space-between;
        padding-bottom: var(--spacing-20, 20px); 
        margin-bottom: var(--spacing-24, 24px);
        border-bottom: 1px solid var(--color-stone, #d7d6d4);
    }
    .ccart-section-title {
        display: flex; 
        align-items: center; 
        gap: 12px;
        font-family: var(--font-graphik, sans-serif);
        font-size: 20px; 
        font-weight: 700;
        color: var(--color-ink, #25221e); 
        margin: 0;
    }
    .ccart-section-title i { 
        color: var(--color-ember-red, #e34432); 
        font-size: 20px; 
    }
    .ccart-section-count {
        background: rgba(227, 68, 50, 0.08); 
        color: var(--color-deep-ember, #cf3520);
        font-size: 13px; 
        font-weight: 700;
        padding: 4px 12px; 
        border-radius: 999px;
    }

    /* Modern List of Cart Items */
    .ccart-items-list {
        display: flex;
        flex-direction: column;
        gap: var(--spacing-16, 16px);
    }

    /* Horizontal Cart Card Redesign */
    .ccart-item-card {
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
    .ccart-item-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(37, 34, 30, 0.06);
        border-color: rgba(227, 68, 50, 0.25);
    }
    
    /* Card media/thumbnail */
    .ccart-item-card__media {
        position: relative;
        width: 140px;
        height: 84px;
        flex-shrink: 0;
        border-radius: 6px;
        overflow: hidden;
        background: linear-gradient(135deg, var(--color-cream, #fff6f0), var(--color-mint-wash, #f0f6df));
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    .ccart-item-card__media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .ccart-item-card:hover .ccart-item-card__media img {
        transform: scale(1.05);
    }
    
    /* Badges positioned on images */
    .ccart-item-card__badge {
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
    .ccart-item-card__badge--course {
        background: rgba(254, 253, 252, 0.95);
        color: var(--color-forest, #446c3d);
        border: 1px solid var(--color-stone, #d7d6d4);
    }
    .ccart-item-card__badge--topup {
        background: rgba(254, 253, 252, 0.95);
        color: var(--color-deep-ember, #cf3520);
        border: 1px solid var(--color-stone, #d7d6d4);
    }

    /* Credits Visual (in place of top-up images) */
    .ccart-item-card__credits-visual {
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
    .ccart-item-card__credits-visual i {
        font-size: 20px;
        animation: ccCoinPulse 2s ease-in-out infinite;
    }
    .ccart-item-card__credits-amount {
        font-family: var(--font-graphik, sans-serif);
        font-size: 15px;
        font-weight: 800;
        color: var(--color-ink, #25221e);
        line-height: 1.1;
        margin-top: 2px;
    }
    .ccart-item-card__credits-unit {
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
    .ccart-item-card__details {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        gap: 6px;
        min-width: 0; /* Prevents overflow with flex */
    }
    .ccart-item-card__title {
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
    .ccart-item-card__title:hover {
        color: var(--color-deep-ember, #cf3520);
        text-decoration: none;
    }
    .ccart-item-card__meta {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 12px;
        color: var(--color-pencil, #6f6c69);
    }
    .ccart-item-card__type {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .ccart-item-card__type i {
        font-size: 11px;
    }

    /* Cost alignment */
    .ccart-item-card__cost {
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
    .ccart-item-card__cost-label {
        font-size: 11px;
        color: var(--color-pencil, #6f6c69);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 2px;
    }
    .ccart-item-card__cost-value {
        font-family: var(--font-graphik, sans-serif);
        font-size: 18px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }
    .ccart-item-card__cost-value i {
        color: var(--color-ember-red, #e34432);
        font-size: 14px;
        margin-right: 2px;
    }
    .ccart-item-card__cost-value .cost-creds {
        display: flex;
        align-items: baseline;
        gap: 3px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
    }
    .ccart-item-card__cost-value .cost-unit {
        font-size: 11px;
        font-weight: 700;
        color: var(--color-pencil, #6f6c69);
    }
    .ccart-item-card__cost-value .cost-price {
        font-size: 17px;
        color: var(--color-ink, #25221e);
        font-weight: 700;
    }

    /* Action (Remove button) */
    .ccart-item-card__action {
        flex-shrink: 0;
    }
    .ccart-item-card__remove {
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
    .ccart-item-card__remove:hover {
        background: rgba(227, 68, 50, 0.08);
        border-color: rgba(227, 68, 50, 0.1);
        color: var(--color-ember-red, #e34432);
        transform: scale(1.08);
        text-decoration: none;
    }

    /* ---- STICKY ORDER SUMMARY SIDEBAR ---- */
    .ccart-sidebar {
        position: -webkit-sticky;
        position: sticky;
        top: 110px;
        background: linear-gradient(180deg, var(--color-paper, #fefdfc) 0%, var(--surface-cream-wash, #fff6f0) 100%);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-xl, 15px);
        padding: var(--spacing-28, 28px);
        box-shadow: 0 10px 30px rgba(37, 34, 30, 0.04);
        animation: ccFadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.1s both;
    }
    .ccart-sidebar__header {
        border-bottom: 1px solid var(--color-stone, #d7d6d4);
        padding-bottom: var(--spacing-16, 16px);
        margin-bottom: var(--spacing-20, 20px);
    }
    .ccart-sidebar__title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: var(--font-graphik, sans-serif);
        font-size: 18px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        margin: 0;
    }
    .ccart-sidebar__title i {
        color: var(--color-ember-red, #e34432);
        font-size: 16px;
    }
    
    .ccart-sidebar__rows {
        display: flex;
        flex-direction: column;
        gap: var(--spacing-12, 12px);
        margin-bottom: var(--spacing-20, 20px);
    }
    .ccart-sidebar__row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 14px;
    }
    .ccart-sidebar__row-label {
        color: var(--color-pencil, #6f6c69);
    }
    .ccart-sidebar__row-value {
        font-weight: 600;
        color: var(--color-ink, #25221e);
    }
    
    /* Total cost indicator */
    .ccart-sidebar__row--total {
        padding-top: var(--spacing-16, 16px);
        border-top: 1px solid var(--color-stone, #d7d6d4);
        margin-top: 4px;
        align-items: baseline;
    }
    .ccart-sidebar__row--total .ccart-sidebar__row-label {
        font-size: 15px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
    }
    .ccart-sidebar__row--total .ccart-sidebar__row-value {
        font-family: var(--font-graphik, sans-serif);
        font-size: 24px;
        font-weight: 800;
        color: var(--color-ember-red, #e34432);
        display: flex;
        align-items: baseline;
        gap: 4px;
    }
    .ccart-sidebar__row--total .ccart-sidebar__row-value i {
        font-size: 16px;
    }
    .ccart-sidebar__row--total .total-unit {
        font-size: 12px;
        font-weight: 700;
        color: var(--color-pencil, #6f6c69);
    }

    /* Status Alerts inside Summary */
    .ccart-status-alert {
        display: flex;
        gap: 12px;
        padding: 14px;
        border-radius: var(--radius-lg, 8px);
        margin-bottom: var(--spacing-20, 20px);
        border: 1px solid transparent;
    }
    .ccart-status-alert--success {
        background-color: var(--color-mint-wash, #f0f6df);
        border-color: rgba(68, 108, 61, 0.15);
        color: var(--color-forest, #446c3d);
    }
    .ccart-status-alert--danger {
        background-color: rgba(227, 68, 50, 0.06);
        border-color: rgba(227, 68, 50, 0.12);
        color: var(--color-deep-ember, #cf3520);
    }
    .ccart-status-alert__icon {
        font-size: 16px;
        margin-top: 1px;
    }
    .ccart-status-alert__content {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .ccart-status-alert__title {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.02em;
    }
    .ccart-status-alert__desc {
        font-size: 12px;
        line-height: 1.4;
        opacity: 0.9;
    }

    /* Reusable Cart Action Button */
    .ccart-action-btn {
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
    .ccart-action-btn:hover {
        text-decoration: none;
    }
    .ccart-action-btn--primary {
        background: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        box-shadow: 0 4px 14px rgba(227, 68, 50, 0.25);
    }
    .ccart-action-btn--primary:hover {
        background: var(--color-deep-ember, #cf3520);
        color: var(--color-paper, #fefdfc);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(227, 68, 50, 0.35);
    }
    .ccart-action-btn--checkout {
        background: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        box-shadow: 0 4px 14px rgba(227, 68, 50, 0.2);
    }
    .ccart-action-btn--checkout:hover {
        background: var(--color-deep-ember, #cf3520);
        color: var(--color-paper, #fefdfc);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(227, 68, 50, 0.3);
    }
    .ccart-action-btn--topup {
        background: var(--color-ink, #25221e);
        color: var(--color-paper, #fefdfc);
        margin-bottom: var(--spacing-12, 12px);
    }
    .ccart-action-btn--topup:hover {
        background: #000;
        color: var(--color-paper, #fefdfc);
        transform: translateY(-2px);
    }
    .ccart-action-btn--ghost {
        background: transparent;
        color: var(--color-pencil, #6f6c69);
        border: 1px solid var(--color-stone, #d7d6d4);
    }
    .ccart-action-btn--ghost:hover {
        background: var(--color-cream, #fff6f0);
        border-color: rgba(227, 68, 50, 0.2);
        color: var(--color-deep-ember, #cf3520);
    }
    .ccart-action-btn--disabled {
        background: var(--color-stone, #d7d6d4);
        color: var(--color-graphite, #94928f);
        cursor: not-allowed;
        box-shadow: none;
    }
    .ccart-action-btn--disabled:hover {
        background: var(--color-stone, #d7d6d4);
        color: var(--color-graphite, #94928f);
        transform: none;
        box-shadow: none;
    }
    .ccart-action-btn--block {
        display: flex;
        width: 100%;
        margin-bottom: var(--spacing-12, 12px);
    }
    .ccart-action-btn--block:last-child {
        margin-bottom: 0;
    }

    /* Empty State for Summary */
    .ccart-sidebar__empty {
        text-align: center;
        padding: var(--spacing-24, 24px) var(--spacing-16, 16px);
        background: rgba(37, 34, 30, 0.02);
        border: 1px dashed var(--color-stone, #d7d6d4);
        border-radius: var(--radius-lg, 8px);
    }
    .ccart-sidebar__empty i {
        font-size: 24px;
        color: var(--color-graphite, #94928f);
        margin-bottom: 8px;
        display: block;
    }
    .ccart-sidebar__empty p {
        font-size: 13px;
        color: var(--color-pencil, #6f6c69);
        margin: 0;
        line-height: 1.4;
    }

    /* ---- EMPTY & GUARD STATES ---- */
    .ccart-empty-state, .ccart-guard-card {
        text-align: center;
        padding: var(--spacing-48, 48px) var(--spacing-24, 24px);
    }
    .ccart-empty-state__icon-wrap, .ccart-guard-card__icon-wrap {
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
    .ccart-empty-state__title, .ccart-guard-card__title {
        font-family: var(--font-graphik, sans-serif);
        font-size: 22px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        margin: 0 0 var(--spacing-12, 12px);
    }
    .ccart-empty-state__text, .ccart-guard-card__text {
        font-size: 15px;
        color: var(--color-pencil, #6f6c69);
        margin: 0 auto var(--spacing-24, 24px);
        max-width: 440px;
        line-height: 1.5;
    }
    
    .ccart-guard-card {
        max-width: 540px;
        margin: 0 auto;
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-xl, 15px);
        box-shadow: 0 10px 40px rgba(37, 34, 30, 0.05);
        padding: var(--spacing-48, 48px) var(--spacing-32, 32px);
        animation: ccFadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    /* ---- Animations ---- */
    @keyframes ccFadeUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .ccart-items-section {
        animation: ccFadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.05s both;
    }

    /* ---- Responsive Adaptations ---- */
    @media (max-width: 991px) {
        .ccart-sidebar {
            position: static;
            top: auto;
            margin-top: var(--spacing-16, 16px);
        }
    }
    @media (max-width: 767px) {
        .ccart-item-card {
            flex-direction: column;
            align-items: stretch;
            gap: var(--spacing-16, 16px);
        }
        .ccart-item-card__media {
            width: 100%;
            height: 180px;
        }
        .ccart-item-card__credits-visual {
            width: 100%;
            height: 120px;
        }
        .ccart-item-card__cost {
            border-left: none;
            border-top: 1px solid var(--color-stone, #d7d6d4);
            padding-left: 0;
            padding-top: var(--spacing-12, 12px);
            align-items: flex-start;
            text-align: left;
            min-width: 0;
        }
        .ccart-item-card__cost-value {
            align-items: flex-start;
            flex-direction: row;
            gap: 8px;
        }
        .ccart-item-card__remove {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .ccart-balance-card {
            flex-direction: column;
            align-items: stretch;
            padding: var(--spacing-20, 20px);
        }
        .ccart-btn-topup {
            justify-content: center;
        }
    }
    @media (max-width: 575px) {
        .ccart-redesign {
            padding: var(--spacing-32, 32px) 0 var(--spacing-64, 64px);
        }
        .ccart-items-section {
            padding: var(--spacing-20, 20px);
        }
    }
    @media (prefers-reduced-motion: reduce) {
        .ccart-glow, .ccart-balance-card, .ccart-items-section, .ccart-sidebar, .ccart-guard-card {
            animation: none !important;
        }
    }
</style>
@endpush
