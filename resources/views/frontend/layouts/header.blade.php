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
	$isJa = session('app_locale') == 'ja' || app()->getLocale() == 'ja';

	// Mega menu definitions. Replace '#' with real routes as the pages are built.
	$vhMarkets = [
		['icon' => 'fa-solid fa-arrow-trend-up', 'title' => __('Forex'), 'desc' => __('60+ major, minor & exotic FX pairs'), 'url' => route('markets.forex')],
		['icon' => 'fa-solid fa-chart-simple', 'title' => __('Indices'), 'desc' => __('Global equity index CFDs'), 'url' => route('markets.indices')],
		['icon' => 'fa-solid fa-coins', 'title' => __('Commodities'), 'desc' => __('Gold, silver, oil & energies'), 'url' => route('markets.commodities')],
		['icon' => 'fa-solid fa-chart-line', 'title' => __('Shares'), 'desc' => __('Trade US & global stock CFDs'), 'url' => route('markets.shares')],
	];

	$vhTrading = [
		['title' => __('Trading Platforms'), 'url' => route('under-construction'), 'items' => [
			['icon' => 'fa-regular fa-window-maximize', 'title' => __('MetaTrader 4'), 'url' => 'https://www.metatrader4.com/en/download', 'external' => true],
			['icon' => 'fa-regular fa-window-maximize', 'title' => __('MetaTrader 5'), 'url' => 'https://www.metatrader5.com/en/download', 'external' => true],
			['icon' => 'fa-solid fa-globe', 'title' => __('WebTrader'), 'url' => route('under-construction')],
		]],
		['title' => __('Copy Trading'), 'url' => route('copy-trading'), 'items' => [
			['icon' => 'fa-solid fa-user-group', 'title' => __('Copy Trading Pro'), 'url' => route('copy-trading') . '#copy-trading-pro'],
			['icon' => 'fa-solid fa-chart-line', 'title' => __('Myfxbook'), 'url' => route('copy-trading') . '#myfxbook'],
		]],
		['title' => __('Account'), 'url' => route('accounts'), 'items' => [
			['icon' => 'fa-solid fa-layer-group', 'title' => __('Account Types'), 'url' => route('accounts')],
			['icon' => 'fa-regular fa-star', 'title' => __('Standard'), 'url' => route('accounts.standard')],
			['icon' => 'fa-solid fa-flask', 'title' => __('Demo Account'), 'url' => route('accounts.demo')],
		]],
		['title' => __('Deposits & Withdrawals'), 'url' => route('funding'), 'items' => [
			['icon' => 'fa-solid fa-arrow-right-arrow-left fa-rotate-90', 'title' => __('Deposits & Withdrawals'), 'url' => route('funding')],
		]],
	];

	$vhResources = [
		['title' => __('Market Outlook'), 'url' => route('under-construction'), 'items' => [
			['icon' => 'fa-solid fa-graduation-cap', 'title' => __('Academy'), 'url' => route('under-construction')],
			['icon' => 'fa-regular fa-newspaper', 'title' => __('News'), 'url' => route('news')],
			['icon' => 'fa-solid fa-chart-line', 'title' => __('Analysis'), 'url' => route('under-construction')],
		]],
		['title' => __('Tools'), 'url' => route('under-construction'), 'items' => [
			['icon' => 'fa-solid fa-bullseye', 'title' => __('Trading Central'), 'url' => route('under-construction')],
			['icon' => 'fa-regular fa-calendar', 'title' => __('Economic Calendar'), 'url' => route('under-construction')],
			['icon' => 'fa-solid fa-calculator', 'title' => __('Trading Calculator'), 'url' => route('calculator')],
			['icon' => 'fa-regular fa-file-lines', 'title' => __('Contract Specifications'), 'url' => route('under-construction')],
			['icon' => 'fa-solid fa-server', 'title' => __('VPS'), 'url' => route('vps')],
		]],
	];

	$vhAbout = [
		['icon' => 'fa-solid fa-graduation-cap', 'title' => __('About Us'), 'desc' => __('Learn about our vision and journey'), 'url' => route('about-us')],
		['icon' => 'fa-regular fa-id-card', 'title' => __('Legal Documents'), 'desc' => __('Read terms, privacy, and disclosures'), 'url' => route('legal.documents')],
		['icon' => 'fa-regular fa-circle-question', 'title' => __('Help Centre'), 'desc' => __('Frequently asked questions & support'), 'url' => route('help')],
		['icon' => 'fa-regular fa-rectangle-list', 'title' => __('Contact Us'), 'desc' => __('Get in touch with our global support'), 'url' => route('contact')],
	];

	$vhMenus = [
		['key' => 'markets', 'label' => __('Markets'), 'type' => 'cards', 'data' => $vhMarkets, 'active' => Route::is('markets.*')],
		['key' => 'trading', 'label' => __('Trading'), 'type' => 'columns', 'data' => $vhTrading],
		['key' => 'resources', 'label' => __('Resources'), 'type' => 'columns', 'data' => $vhResources],
		['key' => 'about', 'label' => __('About Us'), 'type' => 'cards', 'data' => $vhAbout, 'active' => Route::is('about-us', 'contact', 'faqs', 'help', 'legal.documents')],
	];
@endphp
<header class="vh" id="vh">
	{{-- LIVE TICKER (TradingView ticker tape — same symbols as ventureasiamarkets.com) --}}
	<div class="vh-ticker" aria-label="Live market prices">
		<div class="vh-ticker__inner">
			<script type="module" src="https://widgets.tradingview-widget.com/w/en/tv-ticker-tape.js" async></script>
			<tv-ticker-tape
				symbols="FOREXCOM:SPXUSD,FOREXCOM:NSXUSD,FOREXCOM:DJI,FX:EURUSD,CMCMARKETS:GOLD,FX:GBPUSD,FX:USDJPY,FX_IDC:USDHKD,FX_IDC:USDSGD"
				hide-chart="true" item-size="compact" transparent="true" theme="dark"></tv-ticker-tape>
		</div>
	</div>

	<div class="vh__inner">

		{{-- LOGO --}}
		<a href="{{ route('home') }}" class="vh__logo" aria-label="Venture Asia">
			<img src="{{ url('assets/images/venture-logo.png') }}" alt="Venture Asia" class="vh__logo-img">
		</a>

		{{-- CENTER NAV (desktop) --}}
		<nav class="vh__nav" aria-label="Main navigation">
			<ul class="vh__nav-list">
				@foreach($vhMenus as $menu)
					<li class="vh__item" data-vh-item>
						<button type="button" class="vh__link {{ !empty($menu['active']) ? 'vh__link--current' : '' }}"
							aria-expanded="false" aria-controls="vh-panel-{{ $menu['key'] }}">
							{{ $menu['label'] }}
							<svg class="vh__caret" width="10" height="6" viewBox="0 0 10 6" fill="none" aria-hidden="true">
								<path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
									stroke-linejoin="round" />
							</svg>
						</button>

						<div class="vh__panel vh__panel--{{ $menu['type'] }}" id="vh-panel-{{ $menu['key'] }}">
							@if($menu['type'] === 'cards')
								<div class="vh__cards">
									@foreach($menu['data'] as $card)
										<a class="vh__card" href="{{ $card['url'] }}">
											<span class="vh__card-ico"><i class="{{ $card['icon'] }}"></i></span>
											<span class="vh__card-text">
												<span class="vh__card-title">{{ $card['title'] }}</span>
												<span class="vh__card-desc">{{ $card['desc'] }}</span>
											</span>
										</a>
									@endforeach
								</div>
							@else
								<div class="vh__cols" style="--vh-cols: {{ count($menu['data']) }}">
									@foreach($menu['data'] as $col)
										<div class="vh__col">
											<a class="vh__col-head" href="{{ $col['url'] }}">
												{{ $col['title'] }}
												<i class="fa-solid fa-chevron-right"></i>
											</a>
											<ul class="vh__col-list">
												@foreach($col['items'] as $sub)
													<li>
														<a class="vh__col-link" href="{{ $sub['url'] }}" @if(!empty($sub['external'])) target="_blank" rel="noopener noreferrer" @endif>
															<i class="{{ $sub['icon'] }}"></i>
															<span>{{ $sub['title'] }}</span>
														</a>
													</li>
												@endforeach
											</ul>
										</div>
									@endforeach
								</div>
							@endif
						</div>
					</li>
				@endforeach
			</ul>
		</nav>

		{{-- RIGHT ACTIONS --}}
		<div class="vh__actions">
			@if(Auth::check())
				<a href="{{ route('user.logout') }}" class="vh__btn vh__btn--ghost vh__hide-sm">{{ __('common.account.logout') }}</a>
				<a href="{{ route('user') }}" class="vh__btn vh__btn--primary vh__hide-xs">
					{{ __('common.account.my_account') }}
					<i class="fa-solid fa-arrow-right"></i>
				</a>
			@else
				<a href="{{ route('login.form') }}" class="vh__btn vh__btn--ghost vh__hide-sm">{{ __('Login') }}</a>
				<a href="{{ route('register.form') }}" class="vh__btn vh__btn--primary vh__hide-xs">
					{{ __('Open Account') }}
					<i class="fa-solid fa-arrow-right"></i>
				</a>
			@endif

			{{-- Language --}}
			<div class="vh__lang" data-vh-item>
				<button type="button" class="vh__lang-btn" aria-expanded="false" aria-label="Language">
					<span class="fi {{ $isJa ? 'fi-jp' : 'fi-gb' }} vh__flag"></span>
					<span>{{ $isJa ? 'JP' : 'EN' }}</span>
					<svg class="vh__caret" width="10" height="6" viewBox="0 0 10 6" fill="none" aria-hidden="true">
						<path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
							stroke-linejoin="round" />
					</svg>
				</button>
				<div class="vh__panel vh__panel--lang">
					<a class="vh__lang-item {{ !$isJa ? 'vh__lang-item--active' : '' }}" href="{{ route('change.language', 'en') }}">
						<span class="fi fi-gb vh__flag"></span><span>{{ __('common.language.english') }}</span>
						<i class="fa-solid fa-check"></i>
					</a>
					<a class="vh__lang-item {{ $isJa ? 'vh__lang-item--active' : '' }}" href="{{ route('change.language', 'ja') }}">
						<span class="fi fi-jp vh__flag"></span><span>{{ __('common.language.japanese') }}</span>
						<i class="fa-solid fa-check"></i>
					</a>
				</div>
			</div>

			{{-- Hamburger --}}
			<button class="vh__burger" id="vhBurger" type="button" aria-label="Open menu" aria-expanded="false"
				aria-controls="vhDrawer">
				<span></span><span></span><span></span>
			</button>
		</div>

	</div>{{-- /.vh__inner --}}

	{{-- MOBILE DRAWER --}}
	<div class="vh__drawer" id="vhDrawer" aria-hidden="true">
		<div class="vh__drawer-overlay" data-vh-close></div>
		<div class="vh__drawer-panel">
			<div class="vh__drawer-head">
				<a href="{{ route('home') }}"><img src="{{ url('assets/images/venture-logo.png') }}" alt="Venture Asia"
						class="vh__drawer-logo"></a>
				<button class="vh__drawer-close" type="button" data-vh-close aria-label="Close menu"><i
						class="fa-solid fa-xmark"></i></button>
			</div>

			<nav class="vh__drawer-nav" aria-label="Mobile navigation">
				@foreach($vhMenus as $menu)
					<div class="vh__acc">
						<button type="button" class="vh__acc-btn" aria-expanded="false">
							{{ $menu['label'] }}
							<svg class="vh__caret" width="12" height="7" viewBox="0 0 10 6" fill="none" aria-hidden="true">
								<path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
									stroke-linejoin="round" />
							</svg>
						</button>
						<div class="vh__acc-body">
							@if($menu['type'] === 'cards')
								@foreach($menu['data'] as $card)
									<a class="vh__acc-link" href="{{ $card['url'] }}">
										<i class="{{ $card['icon'] }}"></i><span>{{ $card['title'] }}</span>
									</a>
								@endforeach
							@else
								@foreach($menu['data'] as $col)
									<span class="vh__acc-head">{{ $col['title'] }}</span>
									@foreach($col['items'] as $sub)
										<a class="vh__acc-link" href="{{ $sub['url'] }}" @if(!empty($sub['external'])) target="_blank" rel="noopener noreferrer" @endif>
											<i class="{{ $sub['icon'] }}"></i><span>{{ $sub['title'] }}</span>
										</a>
									@endforeach
								@endforeach
							@endif
						</div>
					</div>
				@endforeach
			</nav>

			<div class="vh__drawer-footer">
				@if(Auth::check())
					<a href="{{ route('user') }}" class="vh__btn vh__btn--primary">{{ __('common.account.my_account') }}
						<i class="fa-solid fa-arrow-right"></i></a>
					<a href="{{ route('user.logout') }}" class="vh__btn vh__btn--ghost">{{ __('common.account.logout') }}</a>
				@else
					<a href="{{ route('register.form') }}" class="vh__btn vh__btn--primary">{{ __('Open Account') }}
						<i class="fa-solid fa-arrow-right"></i></a>
					<a href="{{ route('login.form') }}" class="vh__btn vh__btn--ghost">{{ __('Login') }}</a>
				@endif
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

		/* Scroll state */
		var vh = document.getElementById('vh');
		if (vh) {
			function onScroll() { vh.classList.toggle('vh--scrolled', window.scrollY > 20); }
			window.addEventListener('scroll', onScroll, { passive: true });
			onScroll();
		}

		/* Desktop mega menus: hover on pointer devices, click/keyboard everywhere */
		var items = document.querySelectorAll('[data-vh-item]');
		var hoverable = window.matchMedia('(hover: hover) and (pointer: fine)');

		function fitPanel(item) {
			var panel = item.querySelector('.vh__panel');
			if (!panel || panel.classList.contains('vh__panel--lang')) return;
			panel.style.setProperty('--vh-shift', '0px');
			var r = panel.getBoundingClientRect();
			var gutter = 16, vw = document.documentElement.clientWidth, shift = 0;
			if (r.left < gutter) shift = gutter - r.left;
			else if (r.right > vw - gutter) shift = (vw - gutter) - r.right;
			panel.style.setProperty('--vh-shift', shift + 'px');
		}
		function setOpen(item, open) {
			item.classList.toggle('vh--open', open);
			var btn = item.querySelector('button');
			if (btn) btn.setAttribute('aria-expanded', open ? 'true' : 'false');
			if (open) fitPanel(item);
		}
		function closeAll(except) {
			items.forEach(function (it) { if (it !== except) setOpen(it, false); });
		}

		items.forEach(function (item) {
			var btn = item.querySelector('button');
			var timer;
			btn.addEventListener('click', function (e) {
				e.stopPropagation();
				var open = !item.classList.contains('vh--open');
				closeAll(item);
				setOpen(item, open);
			});
			item.addEventListener('mouseenter', function () {
				if (!hoverable.matches) return;
				clearTimeout(timer);
				closeAll(item);
				setOpen(item, true);
			});
			item.addEventListener('mouseleave', function () {
				if (!hoverable.matches) return;
				timer = setTimeout(function () { setOpen(item, false); }, 120);
			});
		});
		document.addEventListener('click', function (e) {
			if (!e.target.closest('[data-vh-item]')) closeAll();
		});

		/* Mobile drawer */
		var burger = document.getElementById('vhBurger');
		var drawer = document.getElementById('vhDrawer');
		function openDrawer() { drawer.classList.add('vh__drawer--open'); burger.setAttribute('aria-expanded', 'true'); drawer.setAttribute('aria-hidden', 'false'); document.body.style.overflow = 'hidden'; }
		function closeDrawer() { drawer.classList.remove('vh__drawer--open'); burger.setAttribute('aria-expanded', 'false'); drawer.setAttribute('aria-hidden', 'true'); document.body.style.overflow = ''; }
		if (burger && drawer) {
			burger.addEventListener('click', openDrawer);
			drawer.querySelectorAll('[data-vh-close]').forEach(function (el) { el.addEventListener('click', closeDrawer); });
			drawer.querySelectorAll('.vh__acc-btn').forEach(function (btn) {
				btn.addEventListener('click', function () {
					var acc = btn.parentElement;
					var open = !acc.classList.contains('vh__acc--open');
					acc.classList.toggle('vh__acc--open', open);
					btn.setAttribute('aria-expanded', open ? 'true' : 'false');
				});
			});
		}
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape') { closeAll(); if (drawer) closeDrawer(); }
		});
	})();
</script>
