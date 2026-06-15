@extends('frontend.layouts.main')
@section('title', 'Cart')
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

<section class="cart-section bg-light">
    <div class="container">
        <div class="row g-5">
            <!-- Left: Cart Items -->
            <div class="col-xl-8">
                <div class="modern-card p-4 p-md-5 border-0 shadow-sm bg-white" style="border-radius: 24px; border: 1px solid rgba(21, 145, 220, 0.1);">
                    <h5 class="fw-bold text-dark mb-5 d-flex align-items-center gap-3" style="color: #0a0e27;">
                        <i class="fas fa-shopping-cart" style="color: #1591DC;"></i>
                        {{ __('common.item_summary') }}
                    </h5>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr class="text-uppercase small fw-bold" style="color: #1591DC; border-bottom: 2px solid rgba(21, 145, 220, 0.15);">
                                    <th class="border-0 pb-4">{{ __('common.product') }}</th>
                                    <th class="border-0 pb-4 text-center">{{ __('common.price') }}</th>
                                    <th class="border-0 pb-4 text-end">{{ __('common.remove') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Helper::cartCount())
                                    @foreach(Helper::getAllProductFromCart() as $key=>$cart)
                                        @php
                                            $item_title = __('common.points_top_up');
                                            $item_link = "#";
                                            if($cart->product) {
                                                $item_title = $cart->product->title;
                                                $item_link = route('product-detail', $cart->product->slug);
                                            }
                                        @endphp
                                        <tr class="border-bottom" style="border-color: rgba(21, 145, 220, 0.1);">
                                            <td class="py-4">
                                                <div class="d-flex flex-column gap-2">
                                                    <a href="{{ $item_link }}" class="fw-bold text-decoration-none" style="color: #0a0e27; font-size: 15px;">{{ $item_title }}</a>
                                                    <span class="badge rounded-2" style="background: rgba(21, 145, 220, 0.1); color: #1591DC; width: fit-content; font-size: 11px; font-weight: 600;">{{ __('common.learning_path') }}</span>
                                                </div>
                                            </td>
                                            <td class="py-4 text-center">
                                                <span class="fw-800" style="font-weight: 800; color: #0a0e27;">
                                                    @if($cart->product_id < 1000 && $cart->points > 0)
                                                        <i class="fas fa-coins me-1" style="color: #1591DC;"></i> {{ number_format($cart->points) }} CRDS
                                                    @elseif($cart->product_id >= 1000)
                                                        {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}
                                                        <div style="color: #1591DC; font-size: 12px; font-weight: 600; margin-top: 4px;">({{ number_format($cart->points) }} CRDS)</div>
                                                    @else
                                                        {{ Helper::getCurrencySymbol(session('currency')) }}
                                                        {{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="py-4 text-end">
                                                <a href="{{ route('cart-delete',$cart->id) }}" class="btn rounded-2 border-0" style="width: 40px; height: 40px; background: rgba(220, 53, 69, 0.1); transition: all 0.3s ease;">
                                                    <i class="fas fa-trash-alt" style="color: #dc3545; font-size: 16px;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center py-5">
                                            <div class="py-5">
                                                <i class="fas fa-shopping-basket fa-4x mb-4" style="color: rgba(21, 145, 220, 0.2);"></i>
                                                <h4 class="text-dark fw-bold mb-3" style="color: #0a0e27;">{{ __('common.no_cart_available') }}</h4>
                                                <a href="{{route('product-lists')}}" class="modern-btn modern-btn-solid" style="background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%); color: white; border: none; border-radius: 10px; padding: 10px 24px; font-weight: 600;">{{ __('common.continue_shopping') }}</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="col-xl-4">
                <div class="modern-card p-5 border-0 shadow-sm bg-white sticky-top" style="border-radius: 24px; border: 1px solid rgba(21, 145, 220, 0.1); top: 120px; z-index: 10;">
                    <h5 class="fw-bold mb-5" style="color: #0a0e27; font-size: 18px;">{{ __('common.order_summary') }}</h5>

                    @if(Helper::cartCount())
                        @php
                            $total_amount = Helper::totalCartPrice();
                            if(session()->has('coupon')) {
                                $total_amount -= Session::get('coupon')['value'];
                            }
                        @endphp
                        
                        

                        <div class="mb-5 d-flex justify-content-between align-items-center pt-4 border-top" style="border-color: rgba(21, 145, 220, 0.1) !important;">
                            <h5 class="fw-bold mb-0" style="color: #0a0e27;">{{ __('common.total') }}:</h5>
                            <h4 class="fw-800 mb-0" style="font-weight: 800; color: #1591DC;">
                                @if(Helper::totalCartPoints() > 0)
                                    <i class="fas fa-coins me-1"></i> {{ number_format(Helper::totalCartPoints()) }} CRDS
                                @else
                                    {{ Helper::getCurrencySymbol(session('currency')) }} 
                                    {{ number_format($total_amount, session('currency')=='JPY' ? 0 : 2) }}
                                @endif
                            </h4>
                        </div>

                        <a href="{{ route('checkout') }}" class="modern-btn w-100 py-3 text-center mb-4 rounded-3" style="background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%); color: white; border: none; font-weight: 600; box-shadow: 0 4px 12px rgba(21, 145, 220, 0.3); transition: all 0.3s ease;">
                            {{ __('common.checkout') }} <i class="fas fa-arrow-right ms-2"></i>
                        </a>

                        <div class="text-center">
                            <img src="{{ asset('assets/images/payment.png') }}" alt="Payments" class="img-fluid opacity-50" style="max-height: 30px;">
                        </div>
                    @else
                        <div class="border-0 rounded-3 p-4 text-center mb-0" style="background: rgba(21, 145, 220, 0.05); border: 1px solid rgba(21, 145, 220, 0.1);">
                            <p class="mb-0" style="color: #666; font-size: 14px;">{{ __('common.summary_empty') }}</p>
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
    .hover-primary:hover { color: var(--primary) !important; }
    .bg-soft-primary { background: var(--primary-10); color: var(--primary); }
</style>
@endpush
