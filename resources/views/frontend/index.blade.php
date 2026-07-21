@extends('frontend.layouts.main')
@section('page-body-class', 'page-index')

@section('main-content')

<section class="artify-hero artify-hero--arch artify-hero--carousel" data-hero-carousel data-interval="6000">
    {{-- Decorative botanical line-art --}}
    <span class="artify-hero--arch__leaf artify-hero--arch__leaf--left" aria-hidden="true"></span>
    <span class="artify-hero--arch__leaf artify-hero--arch__leaf--right" aria-hidden="true"></span>

    @php
        // Each slide = one category. Same image reused for now — swap per-slide later.
        $heroSlides = [
            ['lead' => 'gal_hero_s1_lead', 'accent' => 'gal_hero_s1_accent', 'tagline' => 'gal_hero_s1_tagline', 'desc' => 'gal_hero_s1_desc', 'title' => 'gal_hero_s1_title', 'img' => 'assets/images/yoga.webp'],
            ['lead' => 'gal_hero_s2_lead', 'accent' => 'gal_hero_s2_accent', 'tagline' => 'gal_hero_s2_tagline', 'desc' => 'gal_hero_s2_desc', 'title' => 'gal_hero_s2_title', 'img' => 'assets/images/calm.webp'],
            ['lead' => 'gal_hero_s3_lead', 'accent' => 'gal_hero_s3_accent', 'tagline' => 'gal_hero_s3_tagline', 'desc' => 'gal_hero_s3_desc', 'title' => 'gal_hero_s3_title', 'img' => 'assets/images/strength.webp'],
        ];
    @endphp

    <div class="auto-container artify-hero--arch__stage">
        <div class="artify-hero--arch__slides">
            @foreach($heroSlides as $i => $slide)
            <div class="artify-hero--arch__slide {{ $i === 0 ? 'is-active' : '' }}" data-hero-slide="{{ $i }}">
                <div class="artify-hero--arch__container">

                    {{-- LEFT: Content --}}
                    <div class="artify-hero--arch__left">

                        {{-- Headline: serif + script accent --}}
                        <h1 class="artify-hero--arch__title">
                            <span class="artify-hero--arch__title-serif">{{ __('common.'.$slide['lead']) }}</span>
                            <span class="artify-hero--arch__title-script">{{ __('common.'.$slide['accent']) }}</span>
                        </h1>

                        {{-- Tagline with rule --}}
                        <div class="artify-hero--arch__tagline">
                            <span class="artify-hero--arch__rule"></span>
                            <span class="artify-hero--arch__tagline-text">{{ __('common.'.$slide['tagline']) }}</span>
                        </div>

                        {{-- Intro description --}}
                        <div class="artify-hero--arch__intro">
                            <p class="artify-hero--arch__desc">{{ __('common.'.$slide['desc']) }}</p>
                        </div>

                        {{-- CTA Buttons --}}
                        <div class="artify-hero--arch__buttons">
                            <a href="{{ route('product-lists') }}" class="artify-hero--arch__btn artify-hero--arch__btn--primary">
                                {{ __('common.gal_hero_cta') }}
                            </a>
                            <a href="{{ route('contact') }}" class="artify-hero--arch__btn artify-hero--arch__btn--secondary">
                                {{ __('common.index.browse_courses') }}
                            </a>
                        </div>
                    </div>

                    {{-- RIGHT: Arched portrait --}}
                    <div class="artify-hero--arch__right">
                        <div class="artify-hero--arch__frame">
                            <img src="{{ asset($slide['img']) }}" alt="{{ __('common.'.$slide['title']) }}" class="artify-hero--arch__img" {{ $i === 0 ? '' : 'loading=lazy' }}>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        {{-- Navigation dots --}}
        <div class="artify-hero--arch__dots" role="tablist" aria-label="Hero slides">
            @foreach($heroSlides as $i => $slide)
            <button type="button" class="artify-hero--arch__dot {{ $i === 0 ? 'is-active' : '' }}" data-hero-dot="{{ $i }}" role="tab" aria-label="{{ __('common.'.$slide['accent']) }}" aria-selected="{{ $i === 0 ? 'true' : 'false' }}"></button>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script>
(function () {
    var root = document.querySelector('[data-hero-carousel]');
    if (!root) return;
    var slides = Array.prototype.slice.call(root.querySelectorAll('[data-hero-slide]'));
    var dots   = Array.prototype.slice.call(root.querySelectorAll('[data-hero-dot]'));
    if (slides.length < 2) return;

    var current = 0;
    var interval = parseInt(root.getAttribute('data-interval'), 10) || 6000;
    var timer = null;

    function show(next) {
        next = (next + slides.length) % slides.length;
        if (next === current) return;
        slides[current].classList.remove('is-active');
        dots[current] && dots[current].classList.remove('is-active');
        dots[current] && dots[current].setAttribute('aria-selected', 'false');
        slides[next].classList.add('is-active');
        dots[next] && dots[next].classList.add('is-active');
        dots[next] && dots[next].setAttribute('aria-selected', 'true');
        current = next;
    }
    function nextSlide() { show(current + 1); }
    function start() { stop(); timer = setInterval(nextSlide, interval); }
    function stop()  { if (timer) { clearInterval(timer); timer = null; } }

    dots.forEach(function (dot, i) {
        dot.addEventListener('click', function () { show(i); start(); });
    });
    root.addEventListener('mouseenter', stop);
    root.addEventListener('mouseleave', start);
    document.addEventListener('visibilitychange', function () {
        document.hidden ? stop() : start();
    });

    start();
})();
</script>
@endpush

<section class="category-bento-section pt-120 pb-120">
    <div class="auto-container">
        <div class="bento-heading text-center mb-5">
            <h2 class="modern-h2 mt-3">{{ __('common.gal_category_title') }}</h2>
            <p class="text-muted mx-auto mt-3" style="max-width: 600px;">
                {{ __('common.gal_category_subtitle') }}
            </p>
        </div>

        @if(isset($category_lists) && $category_lists->count() > 0)
            <div class="bento-grid">
                @foreach($category_lists as $category)
                    @php
                        $category_icon = 'fas fa-book-open';
                        $slug = strtolower($category->slug);
                        if (strpos($slug, 'blockchain') !== false || strpos($slug, 'web3') !== false) {
                            $category_icon = 'fas fa-cubes';
                        } elseif (strpos($slug, 'business') !== false || strpos($slug, 'strategy') !== false) {
                            $category_icon = 'fas fa-chart-line';
                        } elseif (strpos($slug, 'cyber') !== false || strpos($slug, 'security') !== false || strpos($slug, 'intelligence') !== false) {
                            $category_icon = 'fas fa-shield-alt';
                        } elseif (strpos($slug, 'transformation') !== false || strpos($slug, 'enterprise') !== false || strpos($slug, 'erp') !== false) {
                            $category_icon = 'fas fa-network-wired';
                        } elseif (strpos($slug, 'machine-learning') !== false || strpos($slug, 'artificial') !== false || strpos($slug, '-ai-') !== false || strpos($slug, 'brain') !== false) {
                            $category_icon = 'fas fa-brain';
                        } elseif (strpos($slug, 'marketing') !== false || strpos($slug, 'advertising') !== false || strpos($slug, 'seo') !== false || strpos($slug, 'social') !== false || strpos($slug, 'search') !== false || strpos($slug, 'optim') !== false) {
                            $category_icon = 'fas fa-bullhorn';
                        } elseif (strpos($slug, 'design') !== false || strpos($slug, 'art') !== false || strpos($slug, 'painting') !== false) {
                            $category_icon = 'fas fa-paint-brush';
                        } elseif (strpos($slug, 'data') !== false || strpos($slug, 'analytics') !== false) {
                            $category_icon = 'fas fa-chart-bar';
                        } elseif (strpos($slug, 'development') !== false || strpos($slug, 'code') !== false || strpos($slug, 'programming') !== false) {
                            $category_icon = 'fas fa-code';
                        }
                    @endphp

                    @if($loop->first)
                        <a href="{{ route('product-lists', $category->slug) }}"
                           class="bento-tile bento-tile--featured">
                            <div class="bento-tile__media">
                                @if($category->photo)
                                    <img src="{{ $category->photo }}"
                                         alt="{{ $category->title }}"
                                         class="bento-tile__img">
                                @else
                                    <div class="bento-tile__img-fallback">
                                        <i class="{{ $category_icon }}"></i>
                                    </div>
                                @endif
                                <span class="bento-tile__scrim"></span>
                            </div>

                            <div class="bento-tile__body">
                                <span class="bento-tile__eyebrow">
                                    <i class="fas fa-star"></i>
                                    {{ __('common.gal_category_badge') }}
                                </span>
                                <h3 class="bento-tile__headline">{{ $category->title }}</h3>
                                @if($category->summary)
                                    <p class="bento-tile__lede">
                                        {{ Str::limit($category->summary, 95) }}
                                    </p>
                                @endif
                                <div class="bento-tile__footer">
                                    <span class="bento-tile__cta">
                                        {{ __('common.gal_category_explore') }}
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @else
                        <a href="{{ route('product-lists', $category->slug) }}"
                           class="bento-tile bento-tile--compact bento-tile--tint-{{ ($loop->index - 1) % 4 }}">
                            <div class="bento-tile__thumb">
                                @if($category->photo)
                                    <img src="{{ $category->photo }}"
                                         alt="{{ $category->title }}"
                                         class="bento-tile__thumb-img">
                                @else
                                    <div class="bento-tile__thumb-fallback">
                                        <i class="{{ $category_icon }}"></i>
                                    </div>
                                @endif
                                <span class="bento-tile__thumb-scrim"></span>
                                <span class="bento-tile__icon-chip">
                                    <i class="{{ $category_icon }}"></i>
                                </span>
                            </div>
                            <div class="bento-tile__body-sm">
                                <h4 class="bento-tile__label">{{ $category->title }}</h4>
                                @if($category->summary)
                                    <p class="bento-tile__desc-sm">
                                        {{ Str::limit($category->summary, 80) }}
                                    </p>
                                @endif
                                <div class="bento-tile__foot-sm">
                                    <span class="bento-tile__more">
                                        {{ __('common.gal_category_explore') }}
                                    </span>
                                    <span class="bento-tile__arrow" aria-hidden="true">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</section>

<section class="about-info about-info--new pt-120 pb-120">
    <div class="auto-container">
        <div class="about-info--new__grid">

            {{-- LEFT: Content --}}
            <div class="about-info--new__left">
                <h2 class="about-info--new__title">{{ __('common.gal_about_section_title') }}</h2>
                <p class="about-info--new__desc">{{ __('common.gal_about_section_description') }}</p>

                <ul class="about-info--new__features">
                    <li class="about-info--new__feature">
                        <div class="about-info--new__check"><i class="fas fa-check"></i></div>
                        <div>
                            <strong class="about-info--new__feat-title">{{ __('common.gal_about_wide_courses_title') }}</strong>
                            <p class="about-info--new__feat-desc">{{ __('common.gal_about_wide_courses_desc') }}</p>
                        </div>
                    </li>
                    <li class="about-info--new__feature">
                        <div class="about-info--new__check"><i class="fas fa-check"></i></div>
                        <div>
                            <strong class="about-info--new__feat-title">{{ __('common.gal_about_cost_effective_title') }}</strong>
                            <p class="about-info--new__feat-desc">{{ __('common.gal_about_cost_effective_desc') }}</p>
                        </div>
                    </li>
                    <li class="about-info--new__feature">
                        <div class="about-info--new__check"><i class="fas fa-check"></i></div>
                        <div>
                            <strong class="about-info--new__feat-title">{{ __('common.gal_about_networking_title') }}</strong>
                            <p class="about-info--new__feat-desc">{{ __('common.gal_about_networking_desc') }}</p>
                        </div>
                    </li>
                </ul>

                <a href="{{ route('register.form') }}" class="about-info--new__cta">
                    {{ __('common.gal_about_cta_btn') }}
                </a>
            </div>

            {{-- RIGHT: Photo Collage --}}
            <div class="about-info--new__right">
                {{-- Column 1: tall rounded card --}}
                <div class="about-info--new__col">
                    <div class="about-info--new__photo about-info--new__photo--tall about-info--new__photo--green">
                        <img src="{{ asset('assets/images/yoga.webp') }}" alt="{{ __('common.index.student_1_alt') }}">
                    </div>
                </div>

                {{-- Column 2: tallest card (center) --}}
                <div class="about-info--new__col about-info--new__col--center">
                    <div class="about-info--new__photo about-info--new__photo--tallest about-info--new__photo--pink">
                        <img src="{{ asset('assets/images/strength.webp') }}" alt="{{ __('common.index.student_2_alt') }}">
                    </div>
                </div>

                {{-- Column 3: circle top + shorter card bottom --}}
                <div class="about-info--new__col about-info--new__col--stack">
                    <div class="about-info--new__photo about-info--new__photo--circle about-info--new__photo--teal">
                        <img src="{{ asset('assets/images/calm.webp') }}" alt="{{ __('common.index.student_2_alt') }}">
                    </div>
                    <div class="about-info--new__photo about-info--new__photo--short about-info--new__photo--amber">
                        <img src="{{ asset('assets/images/diet.webp') }}" alt="{{ __('common.index.student_3_alt') }}">
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<section class="prduct-info pgrid-section pt-120 pb-120">
    <div class="auto-container">

        {{-- Section Header --}}
        <div class="pgrid-section__head">
            <div>
                <!-- <span class="modern-badge">{{ __('common.gal_programs_badge') }}</span> -->
                <h2 class="pgrid-section__title">{{ __('common.gal_programs_title') }}</h2>
                <p class="pgrid-section__sub">{{ __('common.gal_programs_subtitle') }}</p>
            </div>
            <a href="{{ route('product-lists') }}" class="pgrid-section__all-btn">
                {{ __('common.gal_programs_cta') }} <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        {{-- Course Grid --}}
        @php $products = Helper::getRandomProduct(6); @endphp
        <div class="pgrid">
            @foreach($products as $index => $product)
                @php
                    $photo = array_filter(explode(',', $product->photo ?? ''));
                    $img   = !empty($photo) ? trim(reset($photo)) : asset('assets/images/placeholder.jpg');
                    // Accent colours cycle per card
                    $accents = ['#1abc9c','#e85d8a','#f5c518','#0f66ae','#446c3d','#c1940d'];
                    $accent  = $accents[$index % count($accents)];
                @endphp
                <article class="pgrid__card" style="--card-accent: {{ $accent }};">
                    <a href="{{ route('product-detail', $product->slug) }}" class="pgrid__img-wrap">
                        <img src="{{ $img }}"
                             alt="{{ $product->title }}"
                             class="pgrid__img"
                             onerror="this.src='{{ asset('assets/images/placeholder.jpg') }}'">
                        <div class="pgrid__img-overlay"></div>
                    </a>

                    <div class="pgrid__body">
                        <h3 class="pgrid__title">
                            <a href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a>
                        </h3>
                        <p class="pgrid__summary">{{ Str::limit($product->summary, 90) }}</p>

                        <div class="pgrid__foot">
                            <a href="{{ route('product-detail', $product->slug) }}" class="pgrid__enroll">
                                {{ __('common.enroll_now') }}
                                <span class="pgrid__enroll-ico"><i class="fas fa-arrow-right"></i></span>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Mobile CTA --}}
        <div class="text-center mt-5 d-lg-none">
            <a href="{{ route('product-lists') }}" class="modern-btn modern-btn-outline">
                {{ __('common.gal_programs_cta') }} <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>

    </div>
</section>

<!-- CATEGORY SECTION -->




<section class="why-choose-section pt-120 pb-120">
    <div class="auto-container">
        <div class="why-choose-heading text-center mb-5">
            <h2 class="modern-h2 mt-3">{{ __('common.gal_why_title') }}</h2>
        </div>

        <div class="why-choose-grid">
            <article class="why-choose-card why-choose-card--tint-0">
                <span class="why-choose-card__accent" aria-hidden="true"></span>
                <span class="why-choose-card__number" aria-hidden="true">01</span>
                <div class="why-choose-card__icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="why-choose-card__title">{{ __('common.gal_why_expert_title') }}</h3>
                <p class="why-choose-card__desc">{{ __('common.gal_why_expert_desc') }}</p>
            </article>

            <article class="why-choose-card why-choose-card--tint-1">
                <span class="why-choose-card__accent" aria-hidden="true"></span>
                <span class="why-choose-card__number" aria-hidden="true">02</span>
                <div class="why-choose-card__icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="why-choose-card__title">{{ __('common.gal_why_industry_title') }}</h3>
                <p class="why-choose-card__desc">{{ __('common.gal_why_industry_desc') }}</p>
            </article>

            <article class="why-choose-card why-choose-card--tint-2">
                <span class="why-choose-card__accent" aria-hidden="true"></span>
                <span class="why-choose-card__number" aria-hidden="true">03</span>
                <div class="why-choose-card__icon">
                    <i class="fas fa-project-diagram"></i>
                </div>
                <h3 class="why-choose-card__title">{{ __('common.gal_why_projects_title') }}</h3>
                <p class="why-choose-card__desc">{{ __('common.gal_why_projects_desc') }}</p>
            </article>
        </div>
    </div>
</section>


<!-- POINTS TOP UP SECTION - EDITORIAL STUDIO DESIGN -->
<section class="topup-studio-section pt-120 pb-120" id="topup">
    <span class="topup-studio__blob topup-studio__blob--a" aria-hidden="true"></span>
    <span class="topup-studio__blob topup-studio__blob--b" aria-hidden="true"></span>

    <div class="auto-container topup-studio__inner">
        <!-- Header -->
        <div class="topup-studio__heading text-center">
            <h2 class="modern-h2">{{ __('common.gal_topup_title') }}</h2>
            <p class="topup-studio__lede mt-3">{{ __('common.gal_topup_description') }}</p>
        </div>

        <!-- Benefit chips -->
        <div class="topup-studio__chips">
            <div class="topup-studio__chip">
                <span class="topup-studio__chip-icon"><i class="fas fa-unlock-alt"></i></span>
                <span class="topup-studio__chip-label">{{ __('common.index.unlock_courses') }}</span>
            </div>
            <div class="topup-studio__chip">
                <span class="topup-studio__chip-icon"><i class="fas fa-book-open"></i></span>
                <span class="topup-studio__chip-label">{{ __('common.index.access_paths') }}</span>
            </div>
            <div class="topup-studio__chip">
                <span class="topup-studio__chip-icon"><i class="fas fa-trophy"></i></span>
                <span class="topup-studio__chip-label">{{ __('common.index.earn_rewards') }}</span>
            </div>
            <div class="topup-studio__chip">
                <span class="topup-studio__chip-icon"><i class="fas fa-chart-line"></i></span>
                <span class="topup-studio__chip-label">{{ __('common.index.accelerate_growth') }}</span>
            </div>
        </div>

        <!-- Studio panel: tiers left, calculator right -->
        <div class="topup-studio__panel">
            <!-- Tier ladder -->
            <div class="topup-studio__tiers">
                <div class="topup-studio__tiers-head">
                    <span class="topup-studio__tiers-icon"><i class="fas fa-compass"></i></span>
                    <div>
                        <h3 class="topup-studio__tiers-title">{{ __('common.index.pathways_title') }}</h3>
                        <p class="topup-studio__tiers-sub">{{ __('common.index.pathways_subtitle') }}</p>
                    </div>
                </div>

                <ol class="topup-studio__ladder">
                    <li class="topup-studio__step timeline-step" id="step_standard">
                        <span class="topup-studio__step-marker">01</span>
                        <div class="topup-studio__step-body">
                            <div class="topup-studio__step-head">
                                <h4 class="topup-studio__step-title">{{ __('common.index.tier_standard_title') }}</h4>
                                <span class="topup-studio__step-multi">×1.0</span>
                            </div>
                            <p class="topup-studio__step-desc">{{ __('common.index.tier_standard_desc') }}</p>
                            <span class="topup-studio__step-range">{{ session('currency') == 'JPY' ? '1 - 79,999 ¥' : '$1 - $499' }}</span>
                        </div>
                    </li>

                    <li class="topup-studio__step timeline-step" id="step_premium">
                        <span class="topup-studio__step-marker">02</span>
                        <div class="topup-studio__step-body">
                            <div class="topup-studio__step-head">
                                <h4 class="topup-studio__step-title">{{ __('common.index.tier_premium_title') }}</h4>
                                <span class="topup-studio__step-multi">×2.0 {{ __('common.index.bonus') }}</span>
                            </div>
                            <p class="topup-studio__step-desc">{{ __('common.index.tier_premium_desc') }}</p>
                            <span class="topup-studio__step-range">{{ session('currency') == 'JPY' ? '80,000 - 159,999 ¥' : '$500 - $999' }}</span>
                        </div>
                    </li>

                    <li class="topup-studio__step timeline-step" id="step_elite">
                        <span class="topup-studio__step-marker">03</span>
                        <div class="topup-studio__step-body">
                            <div class="topup-studio__step-head">
                                <h4 class="topup-studio__step-title">{{ __('common.index.tier_elite_title') }}</h4>
                                <span class="topup-studio__step-multi">×2.5 {{ __('common.index.bonus') }}</span>
                            </div>
                            <p class="topup-studio__step-desc">{{ __('common.index.tier_elite_desc') }}</p>
                            <span class="topup-studio__step-range">{{ session('currency') == 'JPY' ? '160,000 - 239,999 ¥' : '$1,000 - $1,499' }}</span>
                        </div>
                    </li>

                    <li class="topup-studio__step timeline-step" id="step_vip">
                        <span class="topup-studio__step-marker">04</span>
                        <div class="topup-studio__step-body">
                            <div class="topup-studio__step-head">
                                <h4 class="topup-studio__step-title">{{ __('common.index.tier_vip_title') }}</h4>
                                <span class="topup-studio__step-multi">×3.0 {{ __('common.index.bonus') }}</span>
                            </div>
                            <p class="topup-studio__step-desc">{{ __('common.index.tier_vip_desc') }}</p>
                            <span class="topup-studio__step-range">{{ session('currency') == 'JPY' ? '240,000+ ¥' : '$1,500+' }}</span>
                        </div>
                    </li>
                </ol>
            </div>

            <!-- Calculator -->
            <div class="topup-studio__calc">
                <div class="topup-studio__calc-head">
                    <div>
                        <span class="topup-studio__calc-eyebrow">
                            <i class="fas fa-bolt"></i> {{ __('common.gal_calc_tagline') }}
                        </span>
                        <h3 class="topup-studio__calc-title">{{ __('common.gal_calc_title') }}</h3>
                    </div>
                    <span class="topup-studio__calc-badge">
                        <strong>{{ session('currency') == 'JPY' ? '¥' : '$' }}</strong>
                    </span>
                </div>

                <form action="{{ route('points.add-to-cart') }}" method="POST" class="topup-studio__form enroll-form" data-topup-form="1">
                    @csrf

                    <label class="topup-studio__field-label" for="topup_amount">{{ __('common.index.calc_label') }}</label>
                    <div class="topup-studio__amount">
                        <span class="topup-studio__amount-sym">{{ session('currency') == 'JPY' ? '¥' : '$' }}</span>
                        <input
                            type="number"
                            name="amount"
                            id="topup_amount"
                            class="topup-studio__amount-input"
                            placeholder="0"
                            min="1"
                            required
                        >
                    </div>

                    <div class="topup-studio__breakdown">
                        <div class="topup-studio__break-row">
                            <span class="topup-studio__break-label">{{ __('common.index.base_credits') }}</span>
                            <span class="topup-studio__break-value" id="base_points">0</span>
                        </div>
                        <div class="topup-studio__break-row">
                            <span class="topup-studio__break-label">{{ __('common.index.multiplier_bonus') }}</span>
                            <span class="topup-studio__break-value topup-studio__multi-pill" id="multiplier_display">×1</span>
                        </div>
                        <div class="topup-studio__break-divider"></div>
                        <div class="topup-studio__break-row topup-studio__break-row--total">
                            <span class="topup-studio__break-label">{{ __('common.index.unlocking_potential') }}</span>
                            <span class="topup-studio__break-value" id="total_points">0</span>
                        </div>
                    </div>

                    <div class="topup-studio__result">
                        <span class="topup-studio__result-num" id="total_points_large">0</span>
                        <span class="topup-studio__result-unit">{{ __('common.index.credits_unlocked') }}</span>
                    </div>

                    <button type="submit" class="topup-studio__cta enroll-btn">
                        <span class="topup-studio__cta-label">{{ __('common.gal_calc_button') }}</span>
                        <span class="topup-studio__cta-icon"><i class="fas fa-arrow-right"></i></span>
                    </button>
                </form>

                <p class="topup-studio__note">
                    <strong>{{ session('currency') == 'JPY' ? __('common.index.credit_note_jpy') : __('common.index.credit_note_usd') }}</strong>
                </p>

                <div class="topup-studio__trust">
                    <i class="fas fa-lock"></i>
                    <span>{{ __('common.gal_calc_trust_message') }}</span>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const amountInput = document.getElementById('topup_amount');
        const totalPointsDisplay = document.getElementById('total_points');
        const totalPointsLarge = document.getElementById('total_points_large');
        const basePointsDisplay = document.getElementById('base_points');
        const multiplierDisplay = document.getElementById('multiplier_display');

        function calculatePoints() {
            const amount = parseFloat(amountInput.value) || 0;
            let multiplier = 1;
            const isJPY = {{ session('currency') == 'JPY' ? 'true' : 'false' }};

            let basePoints = 0;

            if (isJPY) {
                basePoints = Math.floor(amount / 160);

                if (amount >= 240000) multiplier = 3;
                else if (amount >= 160000) multiplier = 2.5;
                else if (amount >= 80000) multiplier = 2;
            } else {
                basePoints = Math.floor(amount);

                if (amount >= 1500) multiplier = 3;
                else if (amount >= 1000) multiplier = 2.5;
                else if (amount >= 500) multiplier = 2;
            }

            const totalPoints = Math.round(basePoints * multiplier);

            basePointsDisplay.textContent = basePoints.toLocaleString();
            multiplierDisplay.textContent = '×' + multiplier.toFixed(1);
            totalPointsDisplay.textContent = totalPoints.toLocaleString();
            totalPointsLarge.textContent = totalPoints.toLocaleString();

            // Dynamic highlighting of steps
            document.querySelectorAll('.timeline-step').forEach(step => {
                step.classList.remove('timeline-step-highlight');
            });
            if (isJPY) {
                if (amount >= 240000) document.getElementById('step_vip').classList.add('timeline-step-highlight');
                else if (amount >= 160000) document.getElementById('step_elite').classList.add('timeline-step-highlight');
                else if (amount >= 80000) document.getElementById('step_premium').classList.add('timeline-step-highlight');
                else document.getElementById('step_standard').classList.add('timeline-step-highlight');
            } else {
                if (amount >= 1500) document.getElementById('step_vip').classList.add('timeline-step-highlight');
                else if (amount >= 1000) document.getElementById('step_elite').classList.add('timeline-step-highlight');
                else if (amount >= 500) document.getElementById('step_premium').classList.add('timeline-step-highlight');
                else document.getElementById('step_standard').classList.add('timeline-step-highlight');
            }
        }

        amountInput.addEventListener('input', calculatePoints);
        amountInput.addEventListener('change', calculatePoints);

        // Run initial calculation to highlight standard by default
        calculatePoints();
    });
</script>

<script>
document.querySelectorAll('.enroll-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const btn = this.querySelector('.enroll-btn');
        const originalHTML = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

        const formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            redirect: 'manual'
        })
        .then(response => {
            setTimeout(() => {
                location.reload();
            }, 500);
        })
        .catch(error => {
            btn.disabled = false;
            btn.innerHTML = originalHTML;
            console.error('Error:', error);
        });
    });
});
</script>




@endsection
