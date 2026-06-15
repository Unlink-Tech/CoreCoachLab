@extends('frontend.layouts.main')
@section('title', 'Course Cart')
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
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.cart') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.cart') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@auth
<section class="cart-section bg-light">
    <div class="container">
        @php
            $user = auth()->user();
            $points = $user->points_balance ?? 0;
        @endphp

        <!-- Available Points Banner -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="modern-card p-4 border-0 shadow-sm bg-white" style="border-radius: 24px; border: 1px solid rgba(21, 145, 220, 0.1); background: linear-gradient(135deg, rgba(21, 145, 220, 0.05) 0%, rgba(44, 94, 173, 0.05) 100%);">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-coins" style="font-size: 24px; color: #1591DC;"></i>
                        <div>
                            <span class="text-muted" style="font-size: 14px;">{{ __('common.available_credits') }}</span>
                            <h4 class="mb-0 fw-800" style="font-weight: 800; color: #0a0e27;">{{ number_format($points) }} <span style="color: #1591DC; font-size: 18px;">CREDS</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-5">
            <!-- Left: Cart Items -->
            <div class="col-xl-8">
                <div class="modern-card p-4 p-md-5 border-0 shadow-sm bg-white" style="border-radius: 24px; border: 1px solid rgba(21, 145, 220, 0.1);">
                    <h5 class="fw-bold text-dark mb-5 d-flex align-items-center gap-3" style="color: #0a0e27;">
                        <i class="fas fa-graduation-cap" style="color: #1591DC;"></i>
                        {{ __('common.courses_in_cart') }}
                    </h5>

                    @if(Helper::cartCount())
                        <div class="row g-3">
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

                                        // Check if this is a course (product_id < 1000)
                                        if($cart->product_id < 1000) {
                                            $is_course = true;
                                            // Look up level by matching course_id and price_in_points
                                            $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                                         ->where('price_in_points', $cart->points)
                                                         ->first();
                                        }
                                    }
                                @endphp

                                <div class="col-md-6">
                                    <div class="course-card-item h-100 p-4 border rounded-3" style="border-color: rgba(21, 145, 220, 0.15); transition: all 0.3s ease;">
                                        <!-- Course Image -->
                                        <div class="position-relative mb-4 overflow-hidden rounded-3" style="height: 200px; background: rgba(21, 145, 220, 0.05);">
                                            <img src="{{ $item_image }}" alt="{{ $item_title }}" class="w-100 h-100 object-fit-cover">
                                            <a href="{{ route('cart-delete', $cart->id) }}" class="position-absolute top-0 end-0 m-3 btn btn-sm rounded-circle" style="width: 40px; height: 40px; background: rgba(220, 53, 69, 0.9); border: none; z-index: 10;" title="Remove from cart">
                                                <i class="fas fa-trash-alt text-white" style="font-size: 14px;"></i>
                                            </a>
                                        </div>

                                        <!-- Course Title -->
                                        <a href="{{ $item_link }}" class="fw-bold text-decoration-none d-block mb-3" style="color: #0a0e27; font-size: 16px; line-height: 1.4;">
                                            {{ $item_title }}
                                        </a>

                                        <!-- Level Badge (for courses only) -->
                                        @if($is_course)
                                            <div class="mb-3 d-flex align-items-center gap-2">
                                                <span class="badge rounded-2 px-3 py-2" style="background: rgba(21, 145, 220, 0.1); color: #1591DC; font-size: 12px; font-weight: 600;">
                                                    <i class="fas fa-level-up-alt me-1"></i> Level: <strong>{{ $level ? $level->skill_level : 'N/A' }}</strong>
                                                </span>
                                            </div>
                                        @else
                                            <div class="mb-3">
                                                <span class="badge rounded-2 px-3 py-2" style="background: rgba(255, 193, 7, 0.1); color: #FFC107; font-size: 12px; font-weight: 600;">
                                                    <i class="fas fa-wallet me-1"></i> {{ __('common.points_top_up') }}
                                                </span>
                                            </div>
                                        @endif

                                        <!-- Cost Display -->
                                        <div class="mt-4 pt-3 border-top" style="border-color: rgba(21, 145, 220, 0.15);">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted" style="font-size: 13px;">{{ $is_course ? __('common.points_cost') : __('common.price') }}</span>
                                                <span class="fw-800" style="font-weight: 800; color: #1591DC; font-size: 18px;">
                                                    @if($is_course)
                                                        <i class="fas fa-coins me-1"></i>{{ number_format($cart->points) }} CREDS
                                                    @else
                                                        {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}
                                                        <div style="color: #1591DC; font-size: 12px; font-weight: 600; margin-top: 4px;">({{ number_format($cart->points) }} CREDS)</div>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-basket fa-4x mb-4" style="color: rgba(21, 145, 220, 0.2);"></i>
                            <h4 class="text-dark fw-bold mb-3" style="color: #0a0e27;">{{ __('common.no_cart_available') }}</h4>
                            <p class="text-muted mb-4">{{ __('common.empty_cart_message') }}</p>
                            <a href="{{ route('product-lists') }}" class="modern-btn modern-btn-solid" style="background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%); color: white; border: none; border-radius: 10px; padding: 12px 28px; font-weight: 600; display: inline-block; text-decoration: none;">
                                <i class="fas fa-arrow-left me-2"></i>{{ __('common.continue_shopping') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="col-xl-4">
                <div class="modern-card p-5 border-0 shadow-sm bg-white sticky-top" style="border-radius: 24px; border: 1px solid rgba(21, 145, 220, 0.1); top: 120px; z-index: 10;">
                    <h5 class="fw-bold mb-5" style="color: #0a0e27; font-size: 18px;">
                        <i class="fas fa-receipt me-2" style="color: #1591DC;"></i>{{ __('common.order_summary') }}
                    </h5>

                    @if(Helper::cartCount() && Helper::getAllProductFromCart()->where('order_id', null)->count() > 0)
                        @php
                            $total_points = Helper::totalCartPoints();
                        @endphp

                        <!-- Cart Items Count -->
                        <div class="mb-4 pb-4 border-bottom" style="border-color: rgba(21, 145, 220, 0.1) !important;">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted" style="font-size: 14px;">{{ __('common.item_count') }}</span>
                                <span class="fw-bold" style="color: #0a0e27;">{{ Helper::getAllProductFromCart()->where('order_id', null)->count() }}</span>
                            </div>
                        </div>

                        <!-- Total Points -->
                        <div class="mb-5 d-flex justify-content-between align-items-center pb-4 border-bottom" style="border-color: rgba(21, 145, 220, 0.1) !important;">
                            <h5 class="fw-bold mb-0" style="color: #0a0e27;">{{ __('common.total') }}:</h5>
                            <h4 class="fw-800 mb-0" style="font-weight: 800; color: #1591DC;">
                                <i class="fas fa-coins me-1"></i>{{ number_format($total_points) }} <span style="font-size: 14px;">CREDS</span>
                            </h4>
                        </div>

                        <!-- Redeem Points Button -->
                        <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST" style="display:none;">
                            @csrf
                        </form>
                        <button type="button" onclick="document.getElementById('redeemPointsForm').submit();" class="modern-btn w-100 py-3 text-center mb-4 rounded-3 text-decoration-none" style="background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%); color: white; border: none; font-weight: 600; box-shadow: 0 4px 12px rgba(21, 145, 220, 0.3); transition: all 0.3s ease; cursor: pointer;">
                            <i class="fas fa-lock me-2"></i>{{ __('common.redeem_points') ?? 'Redeem Points' }}
                        </button>

                        <!-- Continue Shopping -->
                        <a href="{{ route('product-lists') }}" class="modern-btn w-100 py-3 text-center rounded-3 d-block text-decoration-none" style="background: transparent; color: #1591DC; border: 2px solid rgba(21, 145, 220, 0.3); font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-plus me-2"></i>{{ __('common.continue_shopping') }}
                        </a>

                    
                    @else
                        <div class="border-0 rounded-3 p-4 text-center mb-0" style="background: rgba(21, 145, 220, 0.05); border: 1px solid rgba(21, 145, 220, 0.1);">
                            <i class="fas fa-info-circle mb-3" style="font-size: 24px; color: rgba(21, 145, 220, 0.3);"></i>
                            <p class="mb-0" style="color: #666; font-size: 14px;">Your summary will appear once you add items to the cart.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@else
<section class="cart-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="modern-card p-5 border-0 shadow-sm bg-white text-center" style="border-radius: 24px; border: 1px solid rgba(21, 145, 220, 0.1); min-height: 300px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <i class="fas fa-lock fa-4x mb-4" style="color: rgba(21, 145, 220, 0.2);"></i>
                    <h3 class="fw-bold mb-3" style="color: #0a0e27;">{{ __('common.sign_in_required') }}</h3>
                    <p class="text-muted mb-4" style="font-size: 15px; max-width: 400px;">{{ __('common.sign_in_message') }}</p>
                    <a href="{{ route('login.form') }}" class="modern-btn modern-btn-solid" style="background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%); color: white; border: none; border-radius: 10px; padding: 12px 32px; font-weight: 600; text-decoration: none; display: inline-block;">
                        <i class="fas fa-sign-in-alt me-2"></i>{{ __('common.sign_in') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endauth

@endsection

@push('styles')
<style>
    .course-card-item {
        transition: all 0.3s ease;
        background: #fff;
    }

    .course-card-item:hover {
        transform: translateY(-4px);
        border-color: rgba(21, 145, 220, 0.3) !important;
        box-shadow: 0 8px 24px rgba(21, 145, 220, 0.1);
    }

    .modern-btn.disabled {
        opacity: 0.6;
        cursor: not-allowed;
        pointer-events: none;
    }

    .object-fit-cover {
        object-fit: cover;
    }

    @media (max-width: 768px) {
        .sticky-top {
            position: static !important;
            margin-top: 24px;
        }

        .course-card-item {
            margin-bottom: 16px;
        }
    }
</style>
@endpush

