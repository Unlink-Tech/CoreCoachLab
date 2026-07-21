<!-- Full-viewport Progress Preloader -->
<div id="preloader" class="artify-preloader" role="progressbar" aria-label="Loading" aria-valuemin="0"
	aria-valuemax="100" aria-valuenow="0">
	<div class="artify-preloader__inner">
		<span class="artify-preloader__label">Loading</span>
		<div class="artify-preloader__count">
			<span id="preloader-percent">0</span><span class="artify-preloader__percent-sym">%</span>
		</div>
		<div class="artify-preloader__bar">
			<span class="artify-preloader__bar-fill" id="preloader-fill"></span>
		</div>
	</div>
</div>

<!-- =============================================
     MAIN HEADER
     ============================================= -->
@php
	$navCategories = \App\Models\Category::where('status', 'active')->where('is_parent', 1)->orderBy('title', 'ASC')->get();
@endphp
<header class="nh" id="nh">
	<div class="nh__inner">

		{{-- LOGO --}}
		<a href="{{ route('home') }}" class="nh__logo" aria-label="Core Coach Lab">
			<img src="{{ url('assets/images/logo-dark.png') }}" alt="Core Coach Lab" class="nh__logo-img">
		</a>

		{{-- CENTER NAV (desktop) --}}
		<nav class="nh__nav" aria-label="Main navigation">
			<ul class="nh__nav-list">

				<li class="nh__nav-item nh__nav-item--drop">
					<a href="{{ route('product-lists') }}"
						class="nh__nav-link {{ Route::is('product-lists') ? 'nh__nav-link--active' : '' }}">
						{{ __('common.header.catalog') }}
						<svg class="nh__caret" width="10" height="6" viewBox="0 0 10 6" fill="none">
							<path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
								stroke-linejoin="round" />
						</svg>
					</a>
					<div class="nh__dropdown nh__dropdown--catalog">
						<div class="nh__dropdown-inner">
							@forelse($navCategories as $cat)
								<a class="nh__drop-item" href="{{ route('product-lists', $cat->slug) }}">
									<span class="nh__drop-ico"><i class="fas fa-graduation-cap"></i></span>
									<span>{{ $cat->title }}</span>
								</a>
							@empty
								<span
									class="nh__drop-item nh__drop-item--muted">{{ __('common.categories.no_categories') }}</span>
							@endforelse
							<hr class="nh__drop-divider">
							<a class="nh__drop-item nh__drop-item--all" href="{{ route('product-lists') }}">
								<span class="nh__drop-ico"><i class="fas fa-th"></i></span>
								<span>{{ __('common.categories.view_all') }}</span>
							</a>
						</div>
					</div>
				</li>

				<li class="nh__nav-item">
					<a href="{{ route('about-us') }}"
						class="nh__nav-link {{ Route::is('about-us') ? 'nh__nav-link--active' : '' }}">
						{{ __('common.header.about') }}
					</a>
				</li>

				<li class="nh__nav-item">
					<a href="{{ route('contact') }}"
						class="nh__nav-link {{ Route::is('contact') ? 'nh__nav-link--active' : '' }}">
						{{ __('common.header.contact') }}
					</a>
				</li>

			</ul>
		</nav>

		{{-- RIGHT ACTIONS --}}
		<div class="nh__actions">

			{{-- Language --}}
			@php $isJa = session('app_locale') == 'ja' || app()->getLocale() == 'ja'; @endphp
			<div class="nh__pill-drop nh__pill-drop--lang">
				<button class="nh__pill-btn" type="button" aria-label="Language">
					<span class="fi {{ $isJa ? 'fi-jp' : 'fi-gb' }} nh__flag"></span>
					<span class="nh__pill-label">{{ $isJa ? 'JP' : 'EN' }}</span>
					<svg class="nh__caret" width="10" height="6" viewBox="0 0 10 6" fill="none">
						<path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
							stroke-linejoin="round" />
					</svg>
				</button>
				<div class="nh__dropdown nh__dropdown--end">
					<div class="nh__dropdown-inner">
						<a class="nh__drop-item {{ !$isJa ? 'nh__drop-item--active' : '' }}"
							href="{{ route('change.language', 'en') }}">
							<span
								class="fi fi-gb nh__drop-ico-flag"></span><span>{{ __('common.language.english') }}</span>
							<i class="fas fa-check nh__drop-check"></i>
						</a>
						<a class="nh__drop-item {{ $isJa ? 'nh__drop-item--active' : '' }}"
							href="{{ route('change.language', 'ja') }}">
							<span
								class="fi fi-jp nh__drop-ico-flag"></span><span>{{ __('common.language.japanese') }}</span>
							<i class="fas fa-check nh__drop-check"></i>
						</a>
					</div>
				</div>
			</div>

			{{-- Currency --}}
			@php
				$currentCurrency = session('currency', 'USD');
				$currencies = Helper::CurrenciesList();
			@endphp
			<div class="nh__pill-drop nh__pill-drop--currency nh__hide-md">
				<button class="nh__pill-btn" type="button" aria-label="Currency">
					<span class="nh__pill-label">{{ Helper::getCurrencySymbol($currentCurrency) }}
						{{ $currentCurrency }}</span>
					<svg class="nh__caret" width="10" height="6" viewBox="0 0 10 6" fill="none">
						<path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
							stroke-linejoin="round" />
					</svg>
				</button>
				<div class="nh__dropdown nh__dropdown--end">
					<div class="nh__dropdown-inner">
						@foreach($currencies as $cur)
							@if($cur->code != 'HKD')
								<a class="nh__drop-item {{ $currentCurrency == $cur->code ? 'nh__drop-item--active' : '' }}"
									href="{{ route('change.currency', $cur->code) }}">
									<span class="nh__drop-ico"><i class="fas fa-coins"></i></span>
									<span>{{ $cur->code }} {{ Helper::getCurrencySymbol($cur->code) }}</span>
									<i class="fas fa-check nh__drop-check"></i>
								</a>
							@endif
						@endforeach
					</div>
				</div>
			</div>

			{{-- Account --}}
			<div class="nh__pill-drop nh__pill-drop--account">
				<button class="nh__acct-btn" type="button" aria-label="Account">
					@if(Auth::check())
						<span class="nh__acct-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
						<span class="nh__acct-name nh__hide-sm">{{ Str::limit(Auth::user()->name, 12) }}</span>
					@else
						<i class="fas fa-user nh__acct-ico"></i>
						<span class="nh__acct-name nh__hide-sm">{{ __('common.account.login') }}</span>
					@endif
					<svg class="nh__caret" width="10" height="6" viewBox="0 0 10 6" fill="none">
						<path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
							stroke-linejoin="round" />
					</svg>
				</button>
				<div class="nh__dropdown nh__dropdown--end nh__dropdown--account">
					<div class="nh__dropdown-inner">
						@if(Auth::check())
							<div class="nh__acct-head">
								<div class="nh__acct-head-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
								<div>
									<div class="nh__acct-head-name">{{ Auth::user()->name }}</div>
									<div class="nh__acct-head-credits"><i class="fas fa-coins"></i>
										{{ Auth::user()->points_balance ?? 0 }} {{ __('common.account.creds') }}</div>
								</div>
							</div>
							<hr class="nh__drop-divider">
							<a class="nh__drop-item" href="{{ route('user') }}"><span class="nh__drop-ico"><i
										class="fas fa-tachometer-alt"></i></span><span>{{ __('common.account.my_account') }}</span></a>
							<a class="nh__drop-item" href="{{ route('points.topup') }}"><span class="nh__drop-ico"><i
										class="fas fa-coins"></i></span><span>{{ __('common.account.points_top_up') }}</span></a>
							<hr class="nh__drop-divider">
							<a class="nh__drop-item nh__drop-item--danger" href="{{ route('user.logout') }}"><span
									class="nh__drop-ico"><i
										class="fas fa-sign-out-alt"></i></span><span>{{ __('common.account.logout') }}</span></a>
						@else
							<a class="nh__drop-item" href="{{ route('login.form') }}"><span class="nh__drop-ico"><i
										class="fas fa-sign-in-alt"></i></span><span>{{ __('common.account.login') }}</span></a>
							<hr class="nh__drop-divider">
							<div class="nh__acct-cta">
								<a href="{{ route('register.form') }}"
									class="nh__cta-register">{{ __('common.account.register') }}</a>
							</div>
						@endif
					</div>
				</div>
			</div>

			{{-- Cart --}}
			<a href="javascript:void(0)" class="nh__cart-btn cart-btn modern-cart-btn"
				aria-label="{{ __('common.cart.shopping_cart') }}">
				<i class="fas fa-shopping-bag"></i>
				<span class="nh__cart-badge cart-badge cart-count">{{ Helper::totalCartQuantity() }}</span>
			</a>

			{{-- Start Learning CTA --}}
			<a href="{{ route('product-lists') }}" class="nh__start-btn nh__hide-md">
				{{ __('common.header.start_learning') }}
			</a>

			{{-- Hamburger --}}
			<button class="nh__burger" id="nhBurger" aria-label="Open menu" aria-expanded="false">
				<span></span><span></span><span></span>
			</button>
		</div>

	</div>{{-- /.nh__inner --}}

	{{-- MOBILE DRAWER --}}
	<div class="nh__drawer" id="nhDrawer" aria-hidden="true">
		<div class="nh__drawer-overlay" id="nhOverlay"></div>
		<div class="nh__drawer-panel">
			<div class="nh__drawer-head">
				<a href="{{ route('home') }}"><img src="{{ url('assets/images/logo-dark.png') }}" alt="Core Coach Lab"
						class="nh__drawer-logo"></a>
				<button class="nh__drawer-close" id="nhDrawerClose" aria-label="Close menu"><i
						class="fas fa-times"></i></button>
			</div>
			<nav class="nh__drawer-nav">
				{{-- Catalog (expandable) --}}
				<div class="nh__drawer-group">
					<button type="button" class="nh__drawer-link nh__drawer-toggle" aria-expanded="false"
						onclick="this.classList.toggle('nh__drawer-toggle--open'); this.setAttribute('aria-expanded', this.classList.contains('nh__drawer-toggle--open')); this.nextElementSibling.classList.toggle('nh__drawer-sub--open');">
						<span class="nh__drawer-link-inner">
							<i class="fas fa-th-large"></i>
							{{ __('common.header.catalog') }}
						</span>
						<svg class="nh__drawer-caret" width="12" height="7" viewBox="0 0 10 6" fill="none"
							aria-hidden="true">
							<path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
								stroke-linejoin="round" />
						</svg>
					</button>
					<div class="nh__drawer-sub">
						@forelse($navCategories as $cat)
							<a class="nh__drawer-sub-link" href="{{ route('product-lists', $cat->slug) }}">
								<span class="nh__drawer-sub-ico"><i class="fas fa-graduation-cap"></i></span>
								<span>{{ $cat->title }}</span>
							</a>
						@empty
							<span
								class="nh__drawer-sub-link nh__drawer-sub-link--muted">{{ __('common.categories.no_categories') }}</span>
						@endforelse
						<a class="nh__drawer-sub-link nh__drawer-sub-link--all" href="{{ route('product-lists') }}">
							<span class="nh__drawer-sub-ico"><i class="fas fa-th"></i></span>
							<span>{{ __('common.categories.view_all') }}</span>
						</a>
					</div>
				</div>

				<a class="nh__drawer-link" href="{{ route('about-us') }}">
					<span class="nh__drawer-link-inner">
						<i class="fas fa-info-circle"></i>
						{{ __('common.header.about') }}
					</span>
				</a>
				<a class="nh__drawer-link" href="{{ route('contact') }}">
					<span class="nh__drawer-link-inner">
						<i class="fas fa-envelope"></i>
						{{ __('common.header.contact') }}
					</span>
				</a>
			</nav>
			<div class="nh__drawer-footer">
				@if(Auth::check())
					<a class="nh__drawer-link" href="{{ route('user') }}"><i class="fas fa-tachometer-alt"></i>
						{{ __('common.account.my_account') }}</a>
					<a class="nh__drawer-link" href="{{ route('points.topup') }}"><i class="fas fa-coins"></i>
						{{ __('common.account.points_top_up') }}</a>
					<a class="nh__drawer-link nh__drawer-link--danger" href="{{ route('user.logout') }}"><i
							class="fas fa-sign-out-alt"></i> {{ __('common.account.logout') }}</a>
				@else
					<a class="nh__drawer-link" href="{{ route('login.form') }}"><i class="fas fa-sign-in-alt"></i>
						{{ __('common.account.login') }}</a>
					<a class="nh__drawer-btn" href="{{ route('register.form') }}">{{ __('common.account.register') }}</a>
				@endif
				<a class="nh__drawer-btn nh__drawer-btn--outline"
					href="{{ route('product-lists') }}">{{ __('common.header.start_learning') }}</a>
			</div>
		</div>
	</div>

	{{-- Cart Drawer (preserved) --}}
	<div class="cartfix-area modern-cart-drawer">
		<div class="cartcanvas__info">
			<div class="offcanvas__wrapper">
				<div class="cartcanvas__content">
					<div class="mb-4 d-flex justify-content-between align-items-center border-bottom pb-4"
						style="border-color: var(--color-stone, #d7d6d4) !important;">
						<h4 class="fw-800 text-dark mb-0"
							style="font-family: var(--font-graphik), sans-serif; font-weight: 700; letter-spacing: -0.5px; color: var(--color-ink, #25221e);">
							{{ __('common.cart.shopping_cart') }}
						</h4>
						<div class="cartcanvas__close rounded-circle d-flex align-items-center justify-content-center"
							style="width: 40px; height: 40px; cursor: pointer;">
							<i class="fas fa-times" style="font-size: 14px; font-weight: 600;"></i>
						</div>
					</div>
					<ul class="cart-list list-unstyled">
						@if(Helper::cartCount())
							@foreach(Helper::getAllProductFromCart() as $key => $cart)
								<li
									class="d-flex align-items-center mb-4 p-3 rounded-4 bg-white shadow-sm border border-light position-relative">
									<a href="{{ route('cart-delete', $cart->id) }}"
										class="remove-item position-absolute top-0 end-0 m-2 text-danger opacity-50"
										style="z-index: 5;"><i class="fas fa-times-circle"></i></a>
									@php
										$item_photo = asset('assets/images/placeholder.jpg');
										$item_title = __('common.points_top_up');
										$item_link = "#";
										$is_course = false;
										$level = null;
										if ($cart->product) {
											$photo_arr = array_filter(explode(',', $cart->product->photo ?? ''));
											if (!empty($photo_arr)) {
												$item_photo = asset(trim(reset($photo_arr)));
											}
											$item_title = $cart->product->title;
											$item_link = route('product-detail', $cart->product->slug);
											if ($cart->product_id < 1000) {
												$is_course = true;
												$level = \App\Models\ProductLevel::where('course_id', $cart->product_id)->where('price_in_points', $cart->points)->first();
											}
										}
									@endphp
									@if($is_course)
										<div class="cart-thumb flex-shrink-0 me-3"><img src="{{ $item_photo }}"
												alt="{{ $item_title }}"
												onerror="this.src='{{ asset('assets/images/placeholder.jpg') }}'"></div>
									@else
										<div class="cart-thumb cart-thumb--credits flex-shrink-0 me-3"><i class="fas fa-coins"></i>
										</div>
									@endif
									<div class="cart-info flex-grow-1 pe-4">
										<a href="{{ $item_link }}"
											class="fw-bold text-dark text-decoration-none small d-block mb-1">{{ $item_title }}</a>
										@if($is_course && $level)
											<span class="badge rounded-2 px-2 py-1 me-2"
												style="background: var(--color-sky-wash, #dceaff); color: var(--color-teal-dusk, #497d7e); font-size: 11px; font-weight: 700; display: inline-block; margin-bottom: 6px; border: 1px solid rgba(73, 125, 126, 0.15);">
												<i class="fas fa-level-up-alt me-1"
													style="font-size: 10px;"></i>{{ $level->skill_level }}
											</span>
										@endif
										<p class="mb-0 small text-muted">
											<span class="fw-bold"
												style="color: var(--color-ember-red, #e34432);">{{ $cart->quantity }}</span> x
											@if($cart->product_id < 1000 && $cart->points > 0)
												<span class="db-points-badge--amber"><i
														class="fas fa-coins me-1"></i>{{ number_format($cart->points) }}
													{{ __('common.account.creds') }}</span>
											@elseif($cart->product_id >= 1000)
												<span
													style="font-weight: 700; color: var(--color-ink, #25221e);">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency') == 'JPY' ? 0 : 2) }}</span>
												<span class="small ms-1"
													style="color: var(--color-teal-dusk, #497d7e); font-weight: 600;">({{ number_format($cart->points) }}
													{{ __('common.account.creds') }})</span>
											@else
												<span
													style="font-weight: 700; color: var(--color-ink, #25221e);">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency') == 'JPY' ? 0 : 2) }}</span>
											@endif
										</p>
									</div>
								</li>
							@endforeach
						@else
							<li class="text-center py-5">
								<div class="opacity-20 mb-3"><i class="fas fa-shopping-basket fa-4x"></i></div>
								<p class="text-muted fw-bold">{{ __('common.cart.no_cart_available') }}</p>
								<a href="{{ route('product-lists') }}"
									class="modern-btn modern-btn-outline small py-2">{{ __('common.header.catalog') }}</a>
							</li>
						@endif
					</ul>
					@if(Helper::cartCount())
						@php
							$total_amount = Helper::totalCartPrice();
							if (session()->has('coupon')) {
								$total_amount -= Session::get('coupon')['value'];
							}
							$has_courses = false;
							$has_topups = false;
							foreach (Helper::getAllProductFromCart() as $item) {
								if ($item->product_id < 1000) {
									$has_courses = true;
								} else if ($item->product_id >= 1000) {
									$has_topups = true;
								}
							}
						@endphp
						<div class="cart-footer border-top mt-5 pt-4"
							style="border-color: var(--color-stone, #d7d6d4) !important;">
							<div class="d-flex justify-content-between align-items-center mb-4">
								<h5 class="fw-bold mb-0"
									style="font-family: var(--font-inter),sans-serif; font-weight: 700; color: var(--color-pencil, #6f6c69);">
									{{ __('common.cart.total') }}:
								</h5>
								<h4 class="fw-800 mb-0"
									style="font-family: var(--font-graphik),sans-serif; font-weight: 800; color: var(--color-ember-red, #e34432);">
									@if(Helper::totalCartPoints() > 0)
										<i class="fas fa-coins me-1"></i> {{ number_format(Helper::totalCartPoints()) }}
										{{ __('common.account.creds') }}
									@else
										{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($total_amount, session('currency') == 'JPY' ? 0 : 2) }}
									@endif
								</h4>
							</div>
							<div class="cart-drawer-btns d-flex gap-2 w-100">
								@if($has_courses && !$has_topups)
									<a href="{{ route('coursecart') }}"
										class="modern-btn modern-btn-outline text-center py-2 px-3 flex-grow-1"
										style="border: 1.5px solid var(--color-stone, #d7d6d4); color: var(--color-pencil,#6f6c69); border-radius: 10px; font-weight: 700; font-size: 13px;">{{ __('common.cart.view_cart') }}</a>
									<button type="button" onclick="document.getElementById('redeemPointsForm').submit();"
										class="modern-btn modern-btn-solid text-center py-2 px-3 flex-grow-1"
										style="background: var(--color-ember-red,#e34432); color: white; border: none; border-radius: 10px; font-weight: 700; font-size: 13px; cursor: pointer;">
										<i class="fas fa-lock me-1"></i>{{ __('common.cart.redeem_points') }}
									</button>
									<form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST"
										style="display:none;">@csrf</form>
								@elseif($has_topups && !$has_courses)
									<a href="{{ route('cart') }}"
										class="modern-btn modern-btn-outline text-center py-2 px-3 flex-grow-1"
										style="border: 1.5px solid var(--color-stone,#d7d6d4); color: var(--color-pencil,#6f6c69); border-radius: 10px; font-weight: 700; font-size: 13px;">{{ __('common.cart.view_cart') }}</a>
									<a href="{{ Auth::check() ? route('checkout') : route('login.form') }}"
										class="modern-btn modern-btn-solid text-center py-2 px-3 flex-grow-1"
										style="background: var(--color-ember-red,#e34432); color: white; border: none; border-radius: 10px; font-weight: 700; font-size: 13px;">{{ __('common.cart.checkout') }}</a>
								@else
									<a href="{{ route('coursecart') }}"
										class="modern-btn modern-btn-outline text-center py-2 px-3 flex-grow-1"
										style="border: 1.5px solid var(--color-stone,#d7d6d4); color: var(--color-pencil,#6f6c69); border-radius: 10px; font-weight: 700; font-size: 13px;">{{ __('common.cart.view_cart') }}</a>
								@endif
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="offcanvas__overlay"></div>

</header>

@cookieconsentview
<x-flash-notification />

<script>
	(function () {
		/* Preloader — 0-100 progress bar */
		var preloader = document.getElementById('preloader');
		if (preloader) {
			var percentEl = document.getElementById('preloader-percent');
			var fillEl = document.getElementById('preloader-fill');
			var progress = 0;
			var loaded = false;

			function setProgress(v) {
				progress = Math.max(0, Math.min(100, v));
				var rounded = Math.round(progress);
				if (percentEl) percentEl.textContent = rounded;
				if (fillEl) fillEl.style.width = progress + '%';
				preloader.setAttribute('aria-valuenow', rounded);
			}

			/* Animate up to 90% while the page is still loading */
			var tick = setInterval(function () {
				if (loaded) return;
				var step = (90 - progress) * 0.06;
				if (step < 0.35) step = 0.35;
				setProgress(progress + step);
				if (progress >= 90) {
					setProgress(90);
					clearInterval(tick);
				}
			}, 80);

			function finishPreloader() {
				if (loaded) return;
				loaded = true;
				clearInterval(tick);
				setProgress(100);
				setTimeout(function () { preloader.classList.add('hidden'); }, 380);
			}

			window.addEventListener('load', function () {
				setTimeout(finishPreloader, 300);
			});

			/* Safety net — always dismiss within 5s */
			setTimeout(function () {
				if (!preloader.classList.contains('hidden')) finishPreloader();
			}, 5000);
		}

		/* Scroll glass */
		var nh = document.getElementById('nh');
		if (nh) {
			function onScroll() { nh.classList.toggle('nh--scrolled', window.scrollY > 20); }
			window.addEventListener('scroll', onScroll, { passive: true });
			onScroll();
		}

		/* Mobile drawer */
		var burger = document.getElementById('nhBurger');
		var drawer = document.getElementById('nhDrawer');
		var overlay = document.getElementById('nhOverlay');
		var closeBtn = document.getElementById('nhDrawerClose');
		function openDrawer() { drawer.classList.add('nh__drawer--open'); burger.setAttribute('aria-expanded', 'true'); drawer.setAttribute('aria-hidden', 'false'); document.body.style.overflow = 'hidden'; }
		function closeDrawer() { drawer.classList.remove('nh__drawer--open'); burger.setAttribute('aria-expanded', 'false'); drawer.setAttribute('aria-hidden', 'true'); document.body.style.overflow = ''; }
		if (burger) burger.addEventListener('click', openDrawer);
		if (overlay) overlay.addEventListener('click', closeDrawer);
		if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
		document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeDrawer(); });
	})();
</script>