@extends('frontend.layouts.main')
@section('page-body-class', 'page-cart')
@section('title', 'Cart')
@section('main-content')

<x-breadcrumb
    :title="__('common.cart.title')"
    :routes="[['label' => __('common.cart.title')]]"
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
                                        $photo_arr = array_filter(explode(',', $cart->product->photo ?? ''));
                                        if(!empty($photo_arr)) {
                                            $item_image = asset(trim(reset($photo_arr)));
                                        }
                                        if($cart->product_id < 1000) {
                                            $is_course = true;
                                        }
                                    }
                                @endphp

                                <div class="cart-item-card">
                                    @if($is_course)
                                        <!-- Thumbnail -->
                                        <div class="cart-item-card__media">
                                            <img src="{{ $item_image }}" alt="{{ $item_title }}" onerror="this.src='{{ asset('assets/images/placeholder.jpg') }}'">
                                            <span class="cart-item-card__badge cart-item-card__badge--course">
                                                <i class="fas fa-palette"></i> {{ __('common.learning_path') }}
                                            </span>
                                        </div>
                                    @else
                                        <!-- Credits Top Up Badge Visual instead of Image -->
                                        <div class="cart-item-card__credits-visual">
                                            <i class="fas fa-coins"></i>
                                            <span class="cart-item-card__credits-amount">+{{ number_format($cart->points) }}</span>
                                            <span class="cart-item-card__credits-unit">{{ __('common.account.creds') }}</span>
                                        </div>
                                    @endif

                                    <!-- Details Content -->
                                    <div class="cart-item-card__details">
                                        <a href="{{ $item_link }}" class="cart-item-card__title">{{ $item_title }}</a>
                                        <div class="cart-item-card__meta">
                                            @if($is_course)
                                                <span class="cart-item-card__type"><i class="fas fa-book-open"></i> {{ __('common.cart.type_course') }}</span>
                                            @else
                                                <span class="cart-item-card__type"><i class="fas fa-wallet"></i> {{ __('common.cart.type_wallet') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Price details -->
                                    <div class="cart-item-card__price">
                                        <span class="cart-item-card__price-label">{{ __('common.cart.price') }}</span>
                                        <span class="cart-item-card__price-value">
                                            @if($cart->product_id < 1000 && $cart->points > 0)
                                                <span class="price-creds"><i class="fas fa-coins"></i> {{ number_format($cart->points) }} <span class="price-unit">{{ __('common.account.creds') }}</span></span>
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
                                <span class="cart-sidebar__row-label">{{ __('common.total') }}:</span>
                                <span class="cart-sidebar__row-value">
                                    @if(Helper::totalCartPoints() > 0)
                                        <i class="fas fa-coins"></i> {{ number_format(Helper::totalCartPoints()) }} <span class="total-unit">{{ __('common.account.creds') }}</span>
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
                                    <i class="fas fa-lock"></i>
                                </div>
                                <span>{{ __('common.cart.secure_checkout') }}</span>
                            </li>
                            <li>
                                <div class="cart-sidebar__trust-icon-wrap cart-sidebar__trust-icon-wrap--access">
                                    <i class="fas fa-infinity"></i>
                                </div>
                                <span>{{ __('common.cart.lifetime_access') }}</span>
                            </li>
                        </ul>

                        <div class="cart-sidebar__pay">
                            <img src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('common.cart.accepted_payment_methods') }}" loading="lazy">
                        </div>
                    @else
                        <div class="cart-sidebar__empty">
                            <i class="fas fa-info-circle"></i>
                            <p>{{ __('common.cart.summary_empty') }}</p>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </div>
</section>

@endsection

