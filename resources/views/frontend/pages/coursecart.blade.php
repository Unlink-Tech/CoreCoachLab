@extends('frontend.layouts.main')
@section('page-body-class', 'page-coursecart')
@section('title', __('common.coursecart.page_title'))
@section('main-content')

<x-breadcrumb
    :title="__('common.cart.title')"
    :routes="[['label' => __('common.cart.title')]]"
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
                        {{ number_format($points) }} <span class="ccart-balance-card__currency">{{ __('common.account.creds') }}</span>
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
                                                <i class="fas fa-signal"></i> {{ $level ? $level->skill_level : __('common.courses') }}
                                            </span>
                                        </div>
                                    @else
                                        <!-- Credits Top Up Badge Visual instead of Image -->
                                        <div class="ccart-item-card__credits-visual">
                                            <i class="fas fa-coins"></i>
                                            <span class="ccart-item-card__credits-amount">+{{ number_format($cart->points) }}</span>
                                            <span class="ccart-item-card__credits-unit">{{ __('common.account.creds') }}</span>
                                        </div>
                                    @endif

                                    <!-- Details Content -->
                                    <div class="ccart-item-card__details">
                                        <a href="{{ $item_link }}" class="ccart-item-card__title">{{ $item_title }}</a>
                                        <div class="ccart-item-card__meta">
                                            @if($is_course)
                                                <span class="ccart-item-card__type"><i class="fas fa-book-open"></i> {{ __('common.coursecart.course_enrollment') }}</span>
                                            @else
                                                <span class="ccart-item-card__type"><i class="fas fa-wallet"></i> {{ __('common.coursecart.wallet_topup') }}</span>
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
                                                <span class="cost-creds"><i class="fas fa-coins"></i> {{ number_format($cart->points) }} <span class="cost-unit">{{ __('common.account.creds') }}</span></span>
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
                                    <i class="fas fa-coins"></i> {{ number_format($total_points) }} <span class="total-unit">{{ __('common.account.creds') }}</span>
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
                                    <span class="ccart-status-alert__title">{{ __('common.coursecart.sufficient_credits') }}</span>
                                    <span class="ccart-status-alert__desc">{{ __('common.coursecart.have_enough_credits') }}</span>
                                @else
                                    <span class="ccart-status-alert__title">{{ __('common.coursecart.insufficient_credits') }}</span>
                                    <span class="ccart-status-alert__desc">{{ __('common.coursecart.need_more_credits', ['amount' => number_format($total_points - $points)]) }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Action Form / Checkout -->
                        <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST" style="display:none;">
                            @csrf
                        </form>

                        @if($enough)
                            <button type="button" onclick="document.getElementById('redeemPointsForm').submit();" class="ccart-action-btn ccart-action-btn--checkout ccart-action-btn--block">
                                <i class="fas fa-lock"></i> {{ __('common.cart.redeem_points') }}
                            </button>
                        @else
                            <a href="{{ route('points.topup') }}" class="ccart-action-btn ccart-action-btn--topup ccart-action-btn--block">
                                <i class="fas fa-plus-circle"></i> {{ __('common.points_top_up') }}
                            </a>
                            <button type="button" class="ccart-action-btn ccart-action-btn--checkout ccart-action-btn--block ccart-action-btn--disabled" disabled>
                                <i class="fas fa-lock"></i> {{ __('common.cart.redeem_points') }} ({{ __('common.coursecart.low_credits') }})
                            </button>
                        @endif

                        <a href="{{ route('product-lists') }}" class="ccart-action-btn ccart-action-btn--ghost ccart-action-btn--block">
                            <i class="fas fa-plus"></i> {{ __('common.continue_shopping') }}
                        </a>
                    @else
                        <div class="ccart-sidebar__empty">
                            <i class="fas fa-info-circle"></i>
                            <p>{{ __('common.cart.summary_empty') }}</p>
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

