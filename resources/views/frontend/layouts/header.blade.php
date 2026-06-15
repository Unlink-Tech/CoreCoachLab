<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>@yield('title','Grand Axis Learning – Online Courses for Skills & Career Growth')</title>
<meta name="title" content="Grand Axis Learning – Professional Online Courses">
<meta name="description" content="Grand Axis Learning offers expert-led online courses to build in-demand skills, advance careers, and support professional growth.">
<meta name="keywords" content="online courses, e-learning platform, skill development, career growth, professional training, upskilling">
<meta name="author" content="Grand Axis Learning">
<!-- Stylesheets -->
<link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{url('assets/plugins/revolution/css/settings.css')}}" rel="stylesheet" type="text/css">
<link href="{{url('assets/plugins/revolution/css/layers.css')}}" rel="stylesheet" type="text/css">
<link href="{{url('assets/plugins/revolution/css/navigation.css')}}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
<link href="{{url('assets/css/global.css')}}" rel="stylesheet">
<link href="{{url('assets/css/style.css')}}" rel="stylesheet">
<link href="{{url('assets/css/responsive.css')}}" rel="stylesheet">
<link href="{{url('assets/css/color-utilities.css')}}" rel="stylesheet">
<link rel="shortcut icon" href="{{url('assets/images/favicon.ico')}}" type="image/x-icon">
<link rel="icon" href="{{url('assets/images/favicon.ico')}}" type="image/x-icon">
<!-- Open Graph / Facebook Meta Tags -->
<meta property="og:type" content="website">
<meta property="og:title" content="@yield('title', 'Grand Axis Learning – Professional Online Courses')">
<meta property="og:description" content="Expert-led online courses designed for professional skill development and career growth.">
@if(isset($og_image))
<meta property="og:image" content="{{ $og_image }}">
@endif
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:site_name" content="Grand Axis Learning">
<meta property="og:locale" content="en_US">
 <!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	     @cookieconsentscripts
        <style>
            .cookiesBtn__link {
                background: black !important;
                border: none !important;
            }

            /* Global Smooth Scroll and Scrollbar Styling */
            html {
                scroll-behavior: smooth;
                /* Firefox scrollbar styling */
                scrollbar-width: thin;
                scrollbar-color: #1591DC #f8fbff;
            }

            /* Chrome, Safari, and Edge scrollbar styling */
            ::-webkit-scrollbar {
                width: 10px;
                height: 10px;
            }

            ::-webkit-scrollbar-track {
                background: linear-gradient(180deg, #f8fbff 0%, #ffffff 100%);
                border-radius: 5px;
            }

            ::-webkit-scrollbar-thumb {
                background: linear-gradient(180deg, #1591DC 0%, #2C5EAD 100%);
                border-radius: 5px;
                border: 2px solid #f8fbff;
                transition: all 0.3s ease;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(180deg, #2C5EAD 0%, #0066B2 100%);
                box-shadow: 0 0 8px rgba(21, 145, 220, 0.4);
            }

            /* Sticky Header Styling */
            header.main-header {
                position: sticky !important;
                top: 0 !important;
                background: linear-gradient(135deg, #ffffff 0%, #f8fbff 100%);
                backdrop-filter: blur(10px);
                box-shadow: 0 4px 20px rgba(21, 145, 220, 0.1);
                z-index: 1030 !important;
                transition: all 0.3s ease;
                width: 100%;
                left: 0;
                right: 0;
            }

            header.main-header:hover {
                box-shadow: 0 8px 30px rgba(21, 145, 220, 0.15);
            }

            header.main-header .auto-container {
                padding: 12px 15px;
            }

            /* Mobile sticky header improvements */
            @media (max-width: 767px) {
                header.main-header {
                    padding-top: 8px;
                    padding-bottom: 8px;
                }

                header.main-header .auto-container {
                    padding: 8px 10px;
                }
            }

            /* Cart item title full text with line breaks */
            .cart-info a {
                white-space: normal !important;
                word-wrap: break-word !important;
                overflow: visible !important;
                text-overflow: clip !important;
                display: block !important;
                line-height: 1.4 !important;
            }
        </style>
</head>

<body>

<div class="page-wrapper">
	<!-- Preloader -->
   <div id="preloader" >
        <div class="preloader">
            <span></span>
            <span></span>
        </div>
    </div>
	<!-- Main Header-->
	<header class="main-header modern-header sticky-top">
		<div class="auto-container">
			<div class="header-inner d-flex align-items-center justify-content-between">
				<!-- Logo -->
				<div class="logo-box">
					<a href="{{route('home')}}"><img src="{{url('assets/images/logo.png')}}" alt="header-logo" style="height: 44px;"></a>  
				</div>

				<!-- Centered Nav -->
				<nav class="modern-nav-wrapper d-none d-lg-block">
					<ul class="modern-nav list-unstyled mb-0 d-flex align-items-center">
						<li class="{{ Route::is('home') ? 'active' : '' }}"><a href="{{route('home')}}">{{ __('common.home')}}</a></li>
						<li class="dropdown">
							<a href="{{route('product-lists')}}" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="color: inherit; text-decoration: none; gap: 6px; display: inline-flex; align-items: center;">
								{{ __('common.catalog') }}
							</a>
							<ul class="dropdown-menu dropdown-menu-end animated-dropdown">
								@php
									$categories = \App\Models\Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
								@endphp
								@forelse($categories as $cat)
									<li>
										<a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 rounded-3" href="{{ route('product-lists', $cat->slug) }}">
											<i class="fas fa-book" style="font-size: 12px; color: #1591DC;"></i>
											{{ $cat->title }}
										</a>
									</li>
								@empty
									<li><span class="dropdown-item text-muted small">No categories</span></li>
								@endforelse
							</ul>
						</li>
						<li class="{{ Route::is('about-us') ? 'active' : '' }}"><a href="{{route('about-us')}}">{{ __('common.about')}}</a></li>
						<li class="{{ Route::is('contact') ? 'active' : '' }}"><a href="{{route('contact')}}">{{ __('common.contact') }}</a></li>
					</ul>
				</nav>

				<!-- Right Actions -->
				<div class="header-actions d-flex align-items-center">
					<!-- Language Switcher -->
					<div class="dropdown d-none d-md-block">
						<a href="javascript:void(0)" class="modern-btn modern-btn-outline dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">
							@if(session('app_locale') == 'ja' || app()->getLocale() == 'ja')
								<span>JP</span> <span class="d-none d-sm-inline">日本語</span>
							@else
								<span>EN</span> <span class="d-none d-sm-inline">English</span>
							@endif
						</a>
						<ul class="dropdown-menu dropdown-menu-end animated-dropdown">
							<li>
								<a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 rounded-3 {{ (session('app_locale') != 'ja' && app()->getLocale() != 'ja') ? 'active bg-primary text-white' : '' }}" href="{{ route('change.language', 'en') }}">
									<span>🇬🇧</span> English
								</a>
							</li>
							<li>
								<a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 rounded-3 {{ (session('app_locale') == 'ja' || app()->getLocale() == 'ja') ? 'active bg-primary text-white' : '' }}" href="{{ route('change.language', 'ja') }}">
									<span>🇯🇵</span> 日本語
								</a>
							</li>
						</ul>
					</div>

					<!-- Currency Switcher -->
					<div class="dropdown d-none d-lg-block">
						@php
							$currentCurrency = session('currency', 'USD');
							$currencies = Helper::CurrenciesList();
						@endphp
						<a href="javascript:void(0)" class="modern-btn modern-btn-outline dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">
							<span class="fw-bold text-primary">{{ Helper::getCurrencySymbol($currentCurrency) }}</span> 
							<span>{{ $currentCurrency }}</span>
						</a>
						<ul class="dropdown-menu dropdown-menu-end animated-dropdown currency-dropdown" style="min-width: 160px;">
							@foreach($currencies as $cur)
								@if($cur->code != 'HKD')
									<li>
										<a class="dropdown-item d-flex align-items-center justify-content-between gap-3 py-2 px-3 rounded-3 {{ $currentCurrency == $cur->code ? 'active bg-primary text-white' : '' }}" href="{{ route('change.currency', $cur->code) }}">
											<span>{{ $cur->code }}</span>
											<span class="fw-bold opacity-75">{{ Helper::getCurrencySymbol($cur->code) }}</span>
										</a>
									</li>
								@endif
							@endforeach
						</ul>
					</div>

					@if(Auth::check())
						<!-- Available Points Display -->
						<a href="{{ route('points.topup') }}" class="modern-btn modern-btn-outline d-flex align-items-center gap-2" style="background: linear-gradient(135deg, rgba(21, 145, 220, 0.05) 0%, rgba(44, 94, 173, 0.05) 100%); border: 1px solid rgba(21, 145, 220, 0.2); padding: 8px 14px; border-radius: 10px;">
							<i class="fas fa-coins" style="color: #1591DC; font-size: 16px;"></i>
							<span class="d-none d-md-inline fw-bold" style="color: #0a0e27; font-size: 14px;">{{ Auth::user()->points_balance ?? 0 }}</span>
							<span class="d-none d-lg-inline" style="color: #1591DC; font-size: 12px; font-weight: 600;">CREDS</span>
						</a>

						<!-- User Dropdown -->
						<div class="dropdown">
							<a href="javascript:void(0)" class="modern-btn modern-btn-outline dropdown-toggle" data-bs-toggle="dropdown">
								<span class="d-none d-sm-inline">{{Auth::user()->name}}</span>
								<span class="d-sm-none"><i class="fas fa-user"></i></span>
							</a>
							<ul class="dropdown-menu dropdown-menu-end animated-dropdown">
								<li><a class="dropdown-item" href="{{ route('user') }}">{{ __('common.my_account') }}</a></li>
								<!-- <li><a class="dropdown-item" href="{{ route('user') }}">{{ __('common.points_dashboard') }}</a></li> -->
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="{{ route('user.logout') }}">{{ __('common.logout') }}</a></li>
							</ul>
						</div>
					@else
						<a href="{{ route('login.form') }}" class="modern-btn modern-btn-outline">{{ __('common.login') }}</a>
						<a href="{{ route('register.form') }}" class="modern-btn modern-btn-solid">{{ __('common.register') }}</a>
					@endif

					<div class="ui-btn-outer">
						<a href="javascript:void(0)" class="ui-btn modern-cart-btn">
							<i class="lnr-icon-cart1"></i>
							<span class="cart-count">
								{{ Helper::totalCartQuantity() }}
							</span>
						</a>
					</div>


				</div>
			</div>
		</div>
		<!-- Mobile Menu  -->

		<!-- Mobile Menu  -->
		<div class="mobile-menu">
			<div class="menu-backdrop"></div>

			<!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
			<nav class="menu-box">
				<div class="upper-box">
					<div class="nav-logo"><a href="{{route('home')}}"><img src="{{url('assets/images/logo.png')}}" alt="" title=""></a></div>
					<div class="close-btn"><i class="icon fa fa-times"></i></div>
				</div>

				<ul class="navigation clearfix">
					<!--Keep This Empty / Menu will come through Javascript-->
				</ul>		
			
			</nav>
		</div><!-- End Mobile Menu -->



		<!-- Sticky Header  -->
		<div class="sticky-header">
			<div class="auto-container">
				<div class="inner-container">
					<!--Logo-->
					<div class="logo">
						<a href="{{route('home')}}" title=""><img src="{{url('assets/images/logo.png')}}" alt="" title=""></a>
					</div>

					<!--Right Col-->
					<div class="nav-outer">
						<!-- Main Menu -->
						<nav class="main-menu">
							<div class="navbar-collapse show collapse clearfix">
								<ul class="navigation clearfix">
									<!--Keep This Empty / Menu will come through Javascript-->
								</ul>
							</div>
						</nav><!-- Main Menu End-->
                        <div class="ui-btn-outer d-md-none d-xl-none d-lg-none">						
						<a href="javascript:void(0)" class="ui-btn"><i class="lnr-icon-shopping-cart text-light"></i>
					    
                     <span class="cart-count">
                                        @if(Helper::getAllProductFromCart())
                    <span >{{ Helper::totalCartQuantity() }}</span>
                                @else
                                <span class="cart-count">0</span>
                                @endif
                            </span>       
					 
					</a>
					</div>
						<!--Mobile Navigation Toggler-->
						<div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
					</div>
				</div>
			</div>
		</div><!-- End Sticky Menu -->
		  <!-- Offcanvas Area Start -->
        <div class="cartfix-area modern-cart-drawer">
            <div class="cartcanvas__info">
                <div class="offcanvas__wrapper">
                    <div class="cartcanvas__content">
                        <div class="mb-4 d-flex justify-content-between align-items-center border-bottom pb-4" style="border-color: rgba(21, 145, 220, 0.1) !important;">
                            <h4 class="fw-800 text-dark mb-0" style="font-weight: 800; letter-spacing: -0.5px; color: #0a0e27;">{{ __('common.shopping_cart') }}</h4>
                            <div class="cartcanvas__close rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; cursor: pointer; background: linear-gradient(135deg, rgba(21, 145, 220, 0.1) 0%, rgba(21, 145, 220, 0.05) 100%); border: 1px solid rgba(21, 145, 220, 0.2); transition: all 0.3s ease;">
                                <i class="fas fa-times" style="color: #1591DC; font-size: 16px; font-weight: 600;"></i>
                            </div>
                        </div>

                        <ul class="cart-list list-unstyled">
                            @if(Helper::cartCount())
                                @foreach(Helper::getAllProductFromCart() as $key=>$cart)
                                    <li class="d-flex align-items-center mb-4 p-3 rounded-4 bg-white shadow-sm border border-light position-relative">
                                        <a href="{{ route('cart-delete',$cart->id) }}" class="remove-item position-absolute top-0 end-0 m-2 text-danger opacity-50 hover-opacity-100" style="z-index: 5;">
                                            <i class="fas fa-times-circle"></i>
                                        </a>
                                        @php
                                            $item_photo = asset('assets/images/placeholder.jpg');
                                            $item_title = __('common.points_top_up');
                                            $item_link = "#";
                                            $is_course = false;
                                            $level = null;
                                            if($cart->product) {
                                                $photo_arr = explode(',', $cart->product->photo);
                                                $item_photo = $photo_arr[0];
                                                $item_title = $cart->product->title;
                                                $item_link = route('product-detail', $cart->product->slug);

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

                                        <div class="cart-info pe-4">
                                            <a href="{{ $item_link }}" class="fw-bold text-dark text-decoration-none small d-block mb-1">{{ $item_title }}</a>

                                            <!-- Level Badge (for courses only) -->
                                            @if($is_course && $level)
                                                <span class="badge rounded-2 px-2 py-1 me-2" style="background: rgba(21, 145, 220, 0.1); color: #1591DC; font-size: 11px; font-weight: 600; display: inline-block; margin-bottom: 6px;">
                                                    <i class="fas fa-level-up-alt me-1" style="font-size: 10px;"></i>{{ $level->skill_level }}
                                                </span>
                                            @endif

                                            <p class="mb-0 small text-muted">
                                                <span class="fw-bold text-primary">{{ $cart->quantity }}</span> x 
                                                @if($cart->product_id < 1000 && $cart->points > 0)
                                                    {{ number_format($cart->points) }} CREDS
                                                @elseif($cart->product_id >= 1000)
                                                    {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}
                                                    <span class="text-primary small ms-1">({{ number_format($cart->points) }} CREDS)</span>
                                                @else
                                                    {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}
                                                @endif
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li class="text-center py-5">
                                    <div class="opacity-20 mb-3"><i class="fas fa-shopping-basket fa-4x"></i></div>
                                    <p class="text-muted fw-bold">{{ __('common.no_cart_available') }}</p>
                                    <a href="{{route('product-lists')}}" class="modern-btn modern-btn-outline small py-2">{{ __('common.catalog') }}</a>
                                </li>
                            @endif
                        </ul>

                        @if(Helper::cartCount())
                            @php
                                $total_amount = Helper::totalCartPrice();
                                if(session()->has('coupon')) { $total_amount -= Session::get('coupon')['value']; }

                                // Detect cart type
                                $has_courses = false;
                                $has_topups = false;
                                foreach(Helper::getAllProductFromCart() as $item) {
                                    if($item->product_id < 1000) {
                                        $has_courses = true;
                                    } else if($item->product_id >= 1000) {
                                        $has_topups = true;
                                    }
                                }
                            @endphp
                            <div class="cart-footer border-top mt-5 pt-4" style="border-color: rgba(21, 145, 220, 0.1) !important;">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="fw-bold text-dark mb-0" style="color: #0a0e27;">{{ __('common.total') }}:</h5>
                                    <h4 class="fw-800 mb-0" style="font-weight: 800; color: #1591DC;">
                                        @if(Helper::totalCartPoints() > 0)
                                            <i class="fas fa-coins me-1"></i> {{ number_format(Helper::totalCartPoints()) }} CREDS
                                        @else
                                            {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($total_amount, session('currency')=='JPY' ? 0 : 2) }}
                                        @endif
                                    </h4>
                                </div>
                                <div class="cart-btn d-flex gap-2">
                                    @if($has_courses && !$has_topups)
                                        <!-- Courses Only -->
                                        <a href="{{ route('coursecart') }}" class="modern-btn modern-btn-outline text-center py-2 px-3 flex-grow-1" style="background: transparent; border: 2px solid #1591DC; color: #1591DC; border-radius: 10px; font-weight: 600; font-size: 13px; transition: all 0.3s ease;">{{ __('common.view_cart') }}</a>
                                        <button type="button" onclick="document.getElementById('redeemPointsForm').submit();" class="modern-btn modern-btn-solid text-center py-2 px-3 flex-grow-1" style="background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%); color: white; border: none; border-radius: 10px; font-weight: 600; font-size: 13px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(21, 145, 220, 0.3); cursor: pointer;">
                                            <i class="fas fa-lock me-1"></i>{{ __('common.redeem_points') ?? 'Redeem' }}
                                        </button>
                                        <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST" style="display:none;">
                                            @csrf
                                        </form>
                                    @elseif($has_topups && !$has_courses)
                                        <!-- Top-ups Only -->
                                        <a href="{{ route('cart') }}" class="modern-btn modern-btn-outline text-center py-2 px-3 flex-grow-1" style="background: transparent; border: 2px solid #1591DC; color: #1591DC; border-radius: 10px; font-weight: 600; font-size: 13px; transition: all 0.3s ease;">{{ __('common.view_cart') }}</a>
                                        <a href="{{ Auth::check() ? route('checkout') : route('login.form') }}" class="modern-btn modern-btn-solid text-center py-2 px-3 flex-grow-1" style="background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%); color: white; border: none; border-radius: 10px; font-weight: 600; font-size: 13px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(21, 145, 220, 0.3);">{{ __('common.checkout') }}</a>
                                    @else
                                        <!-- Mixed: Courses + Top-ups -->
                                        <a href="{{ route('coursecart') }}" class="modern-btn modern-btn-outline text-center py-2 px-3 flex-grow-1" style="background: transparent; border: 2px solid #1591DC; color: #1591DC; border-radius: 10px; font-weight: 600; font-size: 13px; transition: all 0.3s ease;">{{ __('common.view_cart') }}</a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
             <!-- Offcanvas Area Start -->
			 <div class="offcanvas__overlay"></div>
	</header>
@cookieconsentview		
        @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show modern-alert modern-alert-success" role="alert">
        <div class="d-flex align-items-center gap-3">
            <i class="fas fa-check-circle" style="font-size: 20px; flex-shrink: 0; color: #4BB8FA;"></i>
            <div style="color: white;">{{ session('success') }}</div>
        </div>
        <button type="button" class="btn-close modern-alert-close" data-bs-dismiss="alert" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show modern-alert modern-alert-danger" role="alert">
        <div class="d-flex align-items-center gap-3">
            <i class="fas fa-exclamation-circle" style="font-size: 20px; flex-shrink: 0; color: #ff6b6b;"></i>
            <div style="color: white;">{{ session('error') }}</div>
        </div>
        <button type="button" class="btn-close modern-alert-close" data-bs-dismiss="alert" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
    </div>
@endif

@if (session('loginerror'))
    <div class="alert alert-danger alert-dismissible fade show modern-alert modern-alert-danger" role="alert">
        <div class="d-flex align-items-center gap-3">
            <i class="fas fa-exclamation-circle" style="font-size: 20px; flex-shrink: 0; color: #ff6b6b;"></i>
            <div style="color: white;">{{ session('loginerror') }}</div>
        </div>
        <button type="button" class="btn-close modern-alert-close" data-bs-dismiss="alert" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
    </div>
@endif
	<!--End Main Header -->
