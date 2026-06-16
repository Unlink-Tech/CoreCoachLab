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
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;475;500;600;625;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Caecilia:wght@400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Shantell+Sans:wght@400&display=swap" rel="stylesheet">
<link href="{{url('assets/css/global.css')}}" rel="stylesheet">
<link href="{{url('assets/css/style.css')}}" rel="stylesheet">
<link href="{{url('assets/css/responsive.css')}}" rel="stylesheet">
<link href="{{url('assets/css/color-utilities.css')}}" rel="stylesheet">
<link href="{{url('assets/css/theme.css')}}" rel="stylesheet">
<link rel="shortcut icon" href="{{url('assets/images/favicon.png')}}" type="image/x-icon">
<link rel="icon" href="{{url('assets/images/favicon.png')}}" type="image/x-icon">
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
<link rel="stylesheet" href="{{url('assets/css/app.css')}}">
</head>

<body class="@yield('page-body-class')">

<div class="page-wrapper">
	<!-- Preloader -->
   <div id="preloader" >
        <div class="preloader">
            <span></span>
            <span></span>
        </div>
    </div>
	<!-- Main Header-->
	<header class="main-header sticky-top">
		<div class="container px-3 px-md-5">
			<div class="header-wrapper d-flex align-items-center justify-content-between py-3">
				<!-- Logo -->
				<div class="logo-section">
					<a href="{{route('home')}}" class="logo-link">
						<img src="{{url('assets/images/logo.png')}}" alt="Artify Academy" class="logo-img">
					</a>
				</div>

				<!-- Center Navigation -->
				<nav class="center-nav d-none d-lg-block">
					<ul class="nav-list">
						<li class="nav-item dropdown nav-dropdown hover-dropdown">
							<a href="{{route('product-lists')}}" class="nav-link nav-toggle {{ Route::is('product-lists') ? 'active' : '' }}">
								{{ __('common.catalog') }}
								<svg class="nav-caret" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
							</a>
							<ul class="dropdown-menu catalog-menu">
								@php
									$categories = \App\Models\Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
								@endphp
								@forelse($categories as $cat)
									<li>
										<a class="dropdown-item" href="{{ route('product-lists', $cat->slug) }}">
											<i class="fas fa-palette dd-icon"></i><span>{{ $cat->title }}</span>
										</a>
									</li>
								@empty
									<li><span class="dropdown-item dropdown-item--muted">No categories</span></li>
								@endforelse
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item dropdown-item--all" href="{{route('product-lists')}}"><i class="fas fa-th dd-icon"></i><span>View all courses</span></a></li>
							</ul>
						</li>
						<li class="nav-item"><a href="{{route('about-us')}}" class="nav-link {{ Route::is('about-us') ? 'active' : '' }}">{{ __('common.about')}}</a></li>
						<li class="nav-item"><a href="{{route('contact')}}" class="nav-link {{ Route::is('contact') ? 'active' : '' }}">{{ __('common.contact') }}</a></li>
					</ul>
				</nav>

				<!-- Right Actions -->
				<div class="right-actions d-flex align-items-center">
					<!-- Language Selector -->
					<div class="dropdown language-selector hover-dropdown d-none d-md-block">
						<button class="selector-btn" type="button">
							<i class="fas fa-globe selector-ico"></i>
							<span>@if(session('app_locale') == 'ja' || app()->getLocale() == 'ja') JP @else EN @endif</span>
							<svg class="nav-caret" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</button>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item {{ (session('app_locale') != 'ja' && app()->getLocale() != 'ja') ? 'active' : '' }}" href="{{ route('change.language', 'en') }}"><i class="fas fa-globe dd-icon"></i><span>English</span><i class="fas fa-check dd-check"></i></a></li>
							<li><a class="dropdown-item {{ (session('app_locale') == 'ja' || app()->getLocale() == 'ja') ? 'active' : '' }}" href="{{ route('change.language', 'ja') }}"><i class="fas fa-globe dd-icon"></i><span>日本語</span><i class="fas fa-check dd-check"></i></a></li>
						</ul>
					</div>

					<!-- Currency Selector -->
					<div class="dropdown currency-selector hover-dropdown d-none d-lg-block">
						@php
							$currentCurrency = session('currency', 'USD');
							$currencies = Helper::CurrenciesList();
						@endphp
						<button class="selector-btn" type="button">
							<span>{{ Helper::getCurrencySymbol($currentCurrency) }} {{ $currentCurrency }}</span>
							<svg class="nav-caret" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</button>
						<ul class="dropdown-menu dropdown-menu-end">
							@foreach($currencies as $cur)
								@if($cur->code != 'HKD')
									<li><a class="dropdown-item {{ $currentCurrency == $cur->code ? 'active' : '' }}" href="{{ route('change.currency', $cur->code) }}"><i class="fas fa-coins dd-icon"></i><span>{{ $cur->code }} {{ Helper::getCurrencySymbol($cur->code) }}</span><i class="fas fa-check dd-check"></i></a></li>
								@endif
							@endforeach
						</ul>
					</div>

					<!-- Account Dropdown -->
					<div class="dropdown account-menu hover-dropdown">
						<button class="account-btn" type="button">
							<i class="fas fa-user-circle account-ico"></i>
							@if(Auth::check())<span class="account-name d-none d-md-inline">{{ Str::limit(Auth::user()->name, 12) }}</span>@endif
							<svg class="nav-caret" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</button>
						<ul class="dropdown-menu dropdown-menu-end account-dropdown">
							@if(Auth::check())
								<li class="account-head">
									<span class="account-head__name">{{ Auth::user()->name }}</span>
									<span class="account-head__credits"><i class="fas fa-coins"></i> {{ Auth::user()->points_balance ?? 0 }} CREDS</span>
								</li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="{{ route('user') }}"><i class="fas fa-tachometer-alt dd-icon"></i><span>{{ __('common.my_account') }}</span></a></li>
								<li><a class="dropdown-item" href="{{ route('points.topup') }}"><i class="fas fa-coins dd-icon"></i><span>{{ __('common.points_top_up') }}</span></a></li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item dropdown-item--danger" href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt dd-icon"></i><span>{{ __('common.logout') }}</span></a></li>
							@else
								<li><a class="dropdown-item" href="{{ route('login.form') }}"><i class="fas fa-sign-in-alt dd-icon"></i><span>{{ __('common.login') }}</span></a></li>
								<li><hr class="dropdown-divider"></li>
								<li class="account-cta"><a href="{{ route('register.form') }}" class="primary-btn primary-btn--block">{{ __('common.register') }}</a></li>
							@endif
						</ul>
					</div>

					<!-- Cart Button -->
					<a href="javascript:void(0)" class="cart-btn modern-cart-btn" aria-label="Shopping cart">
						<i class="fas fa-shopping-bag"></i>
						<span class="cart-badge cart-count">{{ Helper::totalCartQuantity() }}</span>
					</a>
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
                        <div class="mb-4 d-flex justify-content-between align-items-center border-bottom pb-4" style="border-color: var(--color-stone, #d7d6d4) !important;">
                            <h4 class="fw-800 text-dark mb-0" style="font-family: var(--font-graphik), sans-serif; font-weight: 700; letter-spacing: -0.5px; color: var(--color-ink, #25221e);">{{ __('common.shopping_cart') }}</h4>
                            <div class="cartcanvas__close rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; cursor: pointer;">
                                <i class="fas fa-times" style="font-size: 14px; font-weight: 600;"></i>
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
                                                <span class="badge rounded-2 px-2 py-1 me-2" style="background: var(--color-sky-wash, #dceaff); color: var(--color-teal-dusk, #497d7e); font-size: 11px; font-weight: 700; display: inline-block; margin-bottom: 6px; border: 1px solid rgba(73, 125, 126, 0.15);">
                                                    <i class="fas fa-level-up-alt me-1" style="font-size: 10px;"></i>{{ $level->skill_level }}
                                                </span>
                                            @endif

                                            <p class="mb-0 small text-muted">
                                                <span class="fw-bold" style="color: var(--color-ember-red, #e34432);">{{ $cart->quantity }}</span> x 
                                                @if($cart->product_id < 1000 && $cart->points > 0)
                                                    <span class="db-points-badge--amber"><i class="fas fa-coins me-1"></i>{{ number_format($cart->points) }} CREDS</span>
                                                @elseif($cart->product_id >= 1000)
                                                    <span style="font-weight: 700; color: var(--color-ink, #25221e);">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</span>
                                                    <span class="small ms-1" style="color: var(--color-teal-dusk, #497d7e); font-weight: 600;">({{ number_format($cart->points) }} CREDS)</span>
                                                @else
                                                    <span style="font-weight: 700; color: var(--color-ink, #25221e);">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</span>
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
                            <div class="cart-footer border-top mt-5 pt-4" style="border-color: var(--color-stone, #d7d6d4) !important;">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="fw-bold text-dark mb-0" style="font-family: var(--font-inter), sans-serif; font-weight: 700; color: var(--color-pencil, #6f6c69);">{{ __('common.total') }}:</h5>
                                    <h4 class="fw-800 mb-0" style="font-family: var(--font-graphik), sans-serif; font-weight: 800; color: var(--color-ember-red, #e34432);">
                                        @if(Helper::totalCartPoints() > 0)
                                            <i class="fas fa-coins me-1"></i> {{ number_format(Helper::totalCartPoints()) }} CREDS
                                        @else
                                            {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($total_amount, session('currency')=='JPY' ? 0 : 2) }}
                                        @endif
                                    </h4>
                                </div>
                                <div class="cart-drawer-btns d-flex gap-2 w-100">
                                    @if($has_courses && !$has_topups)
                                        <!-- Courses Only -->
                                        <a href="{{ route('coursecart') }}" class="modern-btn modern-btn-outline text-center py-2 px-3 flex-grow-1" style="background: transparent; border: 1.5px solid var(--color-stone, #d7d6d4); color: var(--color-pencil, #6f6c69); border-radius: 10px; font-weight: 700; font-size: 13px; transition: all 0.25s ease;">{{ __('common.view_cart') }}</a>
                                        <button type="button" onclick="document.getElementById('redeemPointsForm').submit();" class="modern-btn modern-btn-solid text-center py-2 px-3 flex-grow-1" style="background: var(--color-ember-red, #e34432); color: white; border: none; border-radius: 10px; font-weight: 700; font-size: 13px; transition: all 0.25s ease; box-shadow: 0 4px 12px rgba(227, 68, 50, 0.15); cursor: pointer;">
                                            <i class="fas fa-lock me-1"></i>{{ __('common.redeem_points') ?? 'Redeem' }}
                                        </button>
                                        <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST" style="display:none;">
                                            @csrf
                                        </form>
                                    @elseif($has_topups && !$has_courses)
                                        <!-- Top-ups Only -->
                                        <a href="{{ route('cart') }}" class="modern-btn modern-btn-outline text-center py-2 px-3 flex-grow-1" style="background: transparent; border: 1.5px solid var(--color-stone, #d7d6d4); color: var(--color-pencil, #6f6c69); border-radius: 10px; font-weight: 700; font-size: 13px; transition: all 0.25s ease;">{{ __('common.view_cart') }}</a>
                                        <a href="{{ Auth::check() ? route('checkout') : route('login.form') }}" class="modern-btn modern-btn-solid text-center py-2 px-3 flex-grow-1" style="background: var(--color-ember-red, #e34432); color: white; border: none; border-radius: 10px; font-weight: 700; font-size: 13px; transition: all 0.25s ease; box-shadow: 0 4px 12px rgba(227, 68, 50, 0.15);">{{ __('common.checkout') }}</a>
                                    @else
                                        <!-- Mixed: Courses + Top-ups -->
                                        <a href="{{ route('coursecart') }}" class="modern-btn modern-btn-outline text-center py-2 px-3 flex-grow-1" style="background: transparent; border: 1.5px solid var(--color-stone, #d7d6d4); color: var(--color-pencil, #6f6c69); border-radius: 10px; font-weight: 700; font-size: 13px; transition: all 0.25s ease;">{{ __('common.view_cart') }}</a>
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
        {{-- Flash notification toasts (themed component) --}}
        <x-flash-notification />
	<!--End Main Header -->
