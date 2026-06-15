@extends('frontend.layouts.main')
@section('title', 'Cart')
@section('main-content')

<x-breadcrumb
    :title="__('common.cart')"
    :routes="[['label' => __('common.cart')]]"
/>

<section class="cart-page">
    <span class="cart-page__glow cart-glow-mint" aria-hidden="true"></span>
    <span class="cart-page__glow cart-glow-sky" aria-hidden="true"></span>

    <div class="container">
        <div class="row g-5">
            <!-- LEFT: Cart items -->
            <div class="col-xl-8 col-lg-7">
                <div class="cart-panel">
                    <div class="cart-panel__head">
                        <h2 class="cart-panel__title"><i class="fas fa-bag-shopping"></i> {{ __('common.item_summary') }}</h2>
                        @if(Helper::cartCount())
                            <span class="cart-count-pill">{{ Helper::cartCount() }}</span>
                        @endif
                    </div>

                    @if(Helper::cartCount())
                        <ul class="cart-items">
                            @foreach(Helper::getAllProductFromCart() as $key=>$cart)
                                @php
                                    $item_title = __('common.points_top_up');
                                    $item_link = "#";
                                    if($cart->product) {
                                        $item_title = $cart->product->title;
                                        $item_link = route('product-detail', $cart->product->slug);
                                    }
                                @endphp
                                <li class="cart-item">
                                    <span class="cart-item__icon"><i class="fas fa-palette"></i></span>

                                    <div class="cart-item__info">
                                        <a href="{{ $item_link }}" class="cart-item__title">{{ $item_title }}</a>
                                        <span class="cart-item__tag">{{ __('common.learning_path') }}</span>
                                    </div>

                                    <div class="cart-item__price">
                                        @if($cart->product_id < 1000 && $cart->points > 0)
                                            <span class="price-creds"><i class="fas fa-coins"></i> {{ number_format($cart->points) }} CRDS</span>
                                        @elseif($cart->product_id >= 1000)
                                            <span class="price-main">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</span>
                                            <span class="price-sub">({{ number_format($cart->points) }} CRDS)</span>
                                        @else
                                            <span class="price-main">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</span>
                                        @endif
                                    </div>

                                    <a href="{{ route('cart-delete',$cart->id) }}" class="cart-item__remove" aria-label="{{ __('common.remove') }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('product-lists') }}" class="cart-continue">
                            <i class="fas fa-arrow-left"></i> {{ __('common.continue_shopping') }}
                        </a>
                    @else
                        <div class="cart-empty">
                            <span class="cart-empty__icon"><i class="fas fa-shopping-basket"></i></span>
                            <h4 class="cart-empty__title">{{ __('common.no_cart_available') }}</h4>
                            <a href="{{route('product-lists')}}" class="cart-btn-primary">{{ __('common.continue_shopping') }}</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- RIGHT: Order summary -->
            <div class="col-xl-4 col-lg-5">
                <aside class="cart-summary">
                    <h3 class="cart-summary__title">{{ __('common.order_summary') }}</h3>

                    @if(Helper::cartCount())
                        @php
                            $total_amount = Helper::totalCartPrice();
                            if(session()->has('coupon')) {
                                $total_amount -= Session::get('coupon')['value'];
                            }
                        @endphp

                        <div class="cart-summary__total">
                            <span class="cart-summary__total-label">{{ __('common.total') }}</span>
                            <span class="cart-summary__total-value">
                                @if(Helper::totalCartPoints() > 0)
                                    <i class="fas fa-coins"></i> {{ number_format(Helper::totalCartPoints()) }} CRDS
                                @else
                                    {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($total_amount, session('currency')=='JPY' ? 0 : 2) }}
                                @endif
                            </span>
                        </div>

                        <a href="{{ route('checkout') }}" class="cart-btn-primary cart-btn-primary--block">
                            {{ __('common.checkout') }} <i class="fas fa-arrow-right"></i>
                        </a>

                        <ul class="cart-summary__trust">
                            <li><i class="fas fa-lock"></i> {{ __('common.secure_checkout') ?? 'Secure checkout' }}</li>
                            <li><i class="fas fa-infinity"></i> {{ __('common.lifetime_access') ?? 'Lifetime access' }}</li>
                        </ul>

                        <div class="cart-summary__pay">
                            <img src="{{ asset('assets/images/payment.png') }}" alt="Accepted payment methods">
                        </div>
                    @else
                        <div class="cart-summary__empty">
                            <p>{{ __('common.summary_empty') }}</p>
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
       CART PAGE — warm theme
       ========================================= */
    .cart-page {
        position: relative;
        overflow: hidden;
        background: var(--surface-paper-canvas, #fefdfc);
        padding: 64px 0 88px;
    }
    .cart-page__glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        pointer-events: none;
        z-index: 0;
        opacity: 0.5;
    }
    .cart-glow-mint { width: 340px; height: 340px; background: var(--color-mint-wash, #f0f6df); top: -120px; left: -90px; }
    .cart-glow-sky  { width: 300px; height: 300px; background: var(--color-sky-wash, #dceaff); bottom: 4%; right: -90px; }
    .cart-page .container { position: relative; z-index: 1; }

    /* ---- Items panel ---- */
    .cart-panel {
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 22px;
        padding: 32px;
        box-shadow: var(--shadow-subtle);
    }
    .cart-panel__head {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 22px;
        margin-bottom: 8px;
        border-bottom: 1px solid var(--color-stone, #d7d6d4);
    }
    .cart-panel__title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: var(--font-graphik), sans-serif;
        font-size: 21px;
        font-weight: var(--font-weight-semibold, 600);
        color: var(--color-ink, #25221e);
        margin: 0;
    }
    .cart-panel__title i { color: var(--color-ember-red, #e34432); font-size: 18px; }
    .cart-count-pill {
        margin-left: auto;
        background: rgba(227, 68, 50, 0.08);
        color: var(--color-deep-ember, #cf3520);
        font-family: var(--font-inter), sans-serif;
        font-size: 13px;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 999px;
    }

    .cart-items { list-style: none; margin: 0; padding: 0; }
    .cart-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 18px 0;
        border-bottom: 1px solid var(--color-stone, #d7d6d4);
    }
    .cart-item:last-child { border-bottom: none; }
    .cart-item__icon {
        flex-shrink: 0;
        width: 52px;
        height: 52px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--color-cream, #fff6f0), var(--color-mint-wash, #f0f6df));
        border: 1px solid var(--color-stone, #d7d6d4);
        color: var(--color-ember-red, #e34432);
        font-size: 20px;
    }
    .cart-item__info { flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 6px; }
    .cart-item__title {
        font-family: var(--font-graphik), sans-serif;
        font-size: 16px;
        font-weight: var(--font-weight-semibold, 600);
        color: var(--color-ink, #25221e);
        text-decoration: none;
        line-height: 1.35;
        transition: color 0.2s ease;
    }
    .cart-item__title:hover { color: var(--color-deep-ember, #cf3520); }
    .cart-item__tag {
        align-self: flex-start;
        font-family: var(--font-inter), sans-serif;
        font-size: 11px;
        font-weight: 600;
        color: var(--color-forest, #446c3d);
        background: var(--color-mint-wash, #f0f6df);
        padding: 3px 10px;
        border-radius: 999px;
    }
    .cart-item__price {
        text-align: right;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        gap: 2px;
        min-width: 120px;
    }
    .price-creds, .price-main {
        font-family: var(--font-graphik), sans-serif;
        font-size: 17px;
        font-weight: var(--font-weight-bold, 700);
        color: var(--color-ink, #25221e);
        white-space: nowrap;
    }
    .price-creds i { color: var(--color-ember-red, #e34432); font-size: 14px; }
    .price-sub { font-family: var(--font-inter), sans-serif; font-size: 12px; font-weight: 600; color: var(--color-deep-ember, #cf3520); }
    .cart-item__remove {
        flex-shrink: 0;
        width: 42px;
        height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(227, 68, 50, 0.07);
        border: 1px solid rgba(227, 68, 50, 0.15);
        color: var(--color-ember-red, #e34432);
        font-size: 15px;
        text-decoration: none;
        transition: all 0.25s ease;
    }
    .cart-item__remove:hover {
        background: var(--color-ember-red, #e34432);
        border-color: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        transform: translateY(-2px);
    }

    .cart-continue {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 24px;
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: var(--color-deep-ember, #cf3520);
        text-decoration: none;
        transition: gap 0.2s ease;
    }
    .cart-continue:hover { gap: 12px; color: var(--color-deep-ember, #cf3520); }

    /* empty */
    .cart-empty { text-align: center; padding: 40px 20px; }
    .cart-empty__icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 88px;
        height: 88px;
        border-radius: 50%;
        background: var(--color-cream, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        color: var(--color-graphite, #94928f);
        font-size: 36px;
        margin-bottom: 20px;
    }
    .cart-empty__title {
        font-family: var(--font-graphik), sans-serif;
        font-size: 20px;
        font-weight: var(--font-weight-semibold, 600);
        color: var(--color-ink, #25221e);
        margin: 0 0 20px;
    }

    /* ---- Summary ---- */
    .cart-summary {
        position: sticky;
        top: 100px;
        background: linear-gradient(180deg, #fffefd 0%, #fff7f1 100%);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 22px;
        padding: 30px;
        box-shadow: 0 14px 40px rgba(37, 34, 30, 0.06);
    }
    .cart-summary__title {
        font-family: var(--font-graphik), sans-serif;
        font-size: 19px;
        font-weight: var(--font-weight-semibold, 600);
        color: var(--color-ink, #25221e);
        margin: 0 0 24px;
    }
    .cart-summary__total {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 0;
        margin-bottom: 22px;
        border-top: 1px solid var(--color-stone, #d7d6d4);
        border-bottom: 1px solid var(--color-stone, #d7d6d4);
    }
    .cart-summary__total-label {
        font-family: var(--font-inter), sans-serif;
        font-size: 15px;
        font-weight: 600;
        color: var(--color-pencil, #6f6c69);
    }
    .cart-summary__total-value {
        font-family: var(--font-graphik), sans-serif;
        font-size: 24px;
        font-weight: var(--font-weight-bold, 700);
        color: var(--color-ember-red, #e34432);
    }
    .cart-summary__total-value i { font-size: 18px; }

    .cart-btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 14px 26px;
        border-radius: var(--radius-buttons, 8px);
        background: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        font-family: var(--font-inter), sans-serif;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 8px 20px rgba(227, 68, 50, 0.3);
        transition: all 0.25s ease;
    }
    .cart-btn-primary:hover { background: var(--color-deep-ember, #cf3520); color: var(--color-paper, #fefdfc); transform: translateY(-2px); box-shadow: 0 12px 26px rgba(227, 68, 50, 0.4); }
    .cart-btn-primary i { transition: transform 0.25s ease; }
    .cart-btn-primary:hover i { transform: translateX(4px); }
    .cart-btn-primary--block { display: flex; width: 100%; }

    .cart-summary__trust {
        list-style: none;
        margin: 22px 0 0;
        padding: 0;
        display: grid;
        gap: 10px;
    }
    .cart-summary__trust li {
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: var(--font-inter), sans-serif;
        font-size: 13px;
        font-weight: 500;
        color: var(--color-pencil, #6f6c69);
    }
    .cart-summary__trust i { color: var(--color-forest, #446c3d); font-size: 13px; width: 16px; text-align: center; }

    .cart-summary__pay {
        margin-top: 22px;
        padding-top: 20px;
        border-top: 1px solid var(--color-stone, #d7d6d4);
        text-align: center;
    }
    .cart-summary__pay img { height: 26px; width: auto; opacity: 0.85; }

    .cart-summary__empty {
        background: var(--color-cream, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 14px;
        padding: 22px;
        text-align: center;
    }
    .cart-summary__empty p {
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        color: var(--color-pencil, #6f6c69);
        margin: 0;
    }

    /* ---- Responsive ---- */
    @media (max-width: 991px) {
        .cart-summary { position: static; top: auto; }
    }
    @media (max-width: 575px) {
        .cart-page { padding: 44px 0 64px; }
        .cart-panel { padding: 22px; }
        .cart-item { flex-wrap: wrap; }
        .cart-item__price { min-width: 0; text-align: left; align-items: flex-start; margin-left: 68px; }
        .cart-item__remove { margin-left: auto; }
    }
</style>
@endpush
