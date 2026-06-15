@extends('frontend.layouts.main')

@section('main-content')

<section class="af-hero">
    <!-- Decorative animated background -->
    <div class="af-hero__bg" aria-hidden="true">
        <span class="af-hero__blob af-hero__blob--ember"></span>
        <span class="af-hero__blob af-hero__blob--teal"></span>
        <span class="af-hero__blob af-hero__blob--sky"></span>
        <span class="af-hero__grid"></span>
        <svg class="af-hero__wave" viewBox="0 0 1440 320" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0,180 C240,80 480,260 720,180 C960,100 1200,240 1440,160" fill="none" stroke="rgba(227,68,50,0.18)" stroke-width="2"/>
            <path d="M0,220 C260,140 520,300 760,210 C1000,130 1220,250 1440,200" fill="none" stroke="rgba(73,125,126,0.18)" stroke-width="2"/>
        </svg>
    </div>

    <div class="auto-container af-hero__inner">
        <!-- LEFT: copy -->
        <div class="af-hero__content">
            <span class="af-hero__eyebrow">
                <i class="fas fa-palette"></i> {{ $misc['Company Name'] ?? __('Artify Academy') }}
            </span>

            <h1 class="af-hero__title">{{ __('common.gal_hero_title') }}</h1>

            <p class="af-hero__subtitle">{{ __('common.gal_hero_subtitle') }}</p>

            <div class="af-hero__actions">
                <a href="{{ route('product-lists') }}" class="af-hero__btn af-hero__btn--primary">
                    {{ __('common.gal_hero_cta') }} <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- RIGHT: studio video + multiple artwork accents -->
        <div class="af-hero__media">
            <!-- Main looping studio video -->
            <div class="af-hero__videocard">
                <video autoplay loop muted playsinline preload="metadata" poster="{{ asset('assets/art-classes/10.jpg') }}">
                    <source src="{{ asset('assets/art-classes/hero.mp4') }}" type="video/mp4">
                </video>
                <span class="af-hero__livetag"><span class="af-hero__live-dot"></span> In the studio</span>
                <div class="af-hero__caption">
                    <p class="af-hero__caption-text">&ldquo;{{ __('common.gal_hero_testimonial') }}&rdquo;</p>
                </div>
            </div>

            <!-- Floating Artwork Accent 1 (Left / Top Overlap) -->
            <div class="af-hero__accent af-hero__accent--left">
                <img src="{{ asset('assets/art-classes/3.jpg') }}" alt="Watercolor drawing artwork">
            </div>

            <!-- Floating Artwork Accent 2 (Right Overlap - Original) -->
            <div class="af-hero__accent af-hero__accent--right">
                <img src="{{ asset('assets/art-classes/10.jpg') }}" alt="Acrylic pour artwork">
            </div>

            <!-- Floating Artwork Accent 3 (Bottom Overlap) -->
            <div class="af-hero__accent af-hero__accent--bottom">
                <img src="{{ asset('assets/art-classes/6.jpg') }}" alt="Oil painting artwork">
            </div>
        </div>
    </div>
</section>

<!-- CATEGORY SECTION -->
<section class="category-section pt-120 pb-120" style="background: var(--surface-cream-wash, #fff6f0); border-top: 1px solid var(--color-stone, #d7d6d4); border-bottom: 1px solid var(--color-stone, #d7d6d4);">
    <div class="auto-container">
        <div class="text-center mb-5">
            <span class="modern-badge">{{ __('common.gal_category_badge') }}</span>
            <h2 class="modern-h2 mt-3">{{ __('common.gal_category_title') }}</h2>
            <p class="text-muted mx-auto mt-3" style="max-width: 600px;">
                {{ __('common.gal_category_subtitle') }}
            </p>
        </div>

        <div class="row g-4">
            @if(isset($category_lists) && $category_lists->count() > 0)
                @foreach($category_lists as $category)
                    @php
                        $category_icon = 'fas fa-palette';
                        $slug = strtolower($category->slug);
                        if (strpos($slug, 'blockchain') !== false || strpos($slug, 'web3') !== false) {
                            $category_icon = 'fas fa-cubes';
                        } elseif (strpos($slug, 'business') !== false || strpos($slug, 'strategy') !== false) {
                            $category_icon = 'fas fa-chart-line';
                        } elseif (strpos($slug, 'cyber') !== false || strpos($slug, 'security') !== false || strpos($slug, 'intelligence') !== false) {
                            $category_icon = 'fas fa-shield-alt';
                        } elseif (strpos($slug, 'transformation') !== false || strpos($slug, 'enterprise') !== false || strpos($slug, 'erp') !== false) {
                            $category_icon = 'fas fa-network-wired';
                        } elseif (strpos($slug, 'ai') !== false || strpos($slug, 'machine') !== false || strpos($slug, 'brain') !== false) {
                            $category_icon = 'fas fa-brain';
                        } elseif (strpos($slug, 'design') !== false || strpos($slug, 'art') !== false || strpos($slug, 'painting') !== false) {
                            $category_icon = 'fas fa-paint-brush';
                        }
                    @endphp
                    <div class="col-custom-5">
                        <div class="category-card-premium category-card-premium--tint-{{ $loop->index % 3 }}">
                            <div class="category-card-image">
                                @if($category->photo)
                                    <img src="{{ $category->photo }}" alt="{{ $category->title }}" class="category-img">
                                @else
                                    <div class="category-img-placeholder">
                                        <i class="fas fa-book"></i>
                                    </div>
                                @endif
                                <div class="category-overlay">
                                    <a href="{{ route('product-lists', $category->slug) }}" class="category-explore-btn">
                                        {{ __('common.gal_category_explore') }}
                                        <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="category-card-content">
                                <div class="category-meta-row d-flex align-items-center justify-content-between mb-3">
                                    <div class="category-icon-badge">
                                        <i class="{{ $category_icon }}"></i>
                                    </div>
                                    <span class="category-count mb-0">
                                        <i class="fas fa-graduation-cap"></i>
                                        {{ $category->products_count }} {{ __('common.gal_category_courses') }}
                                    </span>
                                </div>

                                <h3 class="category-title">
                                    <a href="{{ route('product-lists', $category->slug) }}">
                                        {{ $category->title }}
                                    </a>
                                </h3>
                                @if($category->summary)
                                    <p class="category-description">
                                        {{ Str::limit($category->summary, 80) }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>



<section class="prduct-info pt-120 pb-120" style="background: var(--color-paper, #fefdfc); border-bottom: 1px solid var(--color-stone, #d7d6d4);">
    <div class="auto-container">
        <div class="text-center mb-5">
            <span class="modern-badge">{{ __('common.gal_programs_badge') }}</span>
            <h2 class="modern-h2 mt-3">{{ __('common.gal_programs_title') }}</h2>
            <p class="text-muted mx-auto mt-3" style="max-width: 600px;">{{ __('common.gal_programs_subtitle') }}</p>
        </div>

        <div class="courses-carousel owl-carousel owl-theme">
            @php $products = Helper::getRandomProduct(6); @endphp

            @foreach($products as $product)
                <div class="modern-course-card">
                    <div class="course-img-container">
                        @php $photo = explode(',', $product->photo); @endphp
                        <img src="{{ $photo[0] }}" alt="{{ $product->title }}">
                    </div>
                    
                    <div class="course-content">
                        <h4 class="course-title">
                            <a href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a>
                        </h4>
                        <p class="course-summary">{{ Str::limit($product->summary, 85) }}</p>

                        <div class="course-footer">
                            <a href="{{ route('product-detail', $product->slug) }}" class="course-enroll-link">
                                {{ __('common.enroll_now') }} <i class="fas fa-chevron-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('product-lists') }}" class="modern-btn modern-btn-outline">
                {{ __('common.gal_programs_cta') }} <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<section class="chse_secton pt-120 pb-120" style="background: var(--color-paper, #fefdfc); border-bottom: 1px solid var(--color-stone, #d7d6d4);">
    <div class="auto-container">
        <div class="text-center mb-5">
            <span class="modern-badge">{{ __('common.gal_why_badge') }}</span>
            <h2 class="modern-h2 mt-3">{{ __('common.gal_why_title') }}</h2>
        </div>

        <div class="row g-4">
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="why-card-premium why-card-premium--tint-0">
                    <div class="why-icon-badge">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="why-title">{{ __('common.gal_why_expert_title') }}</h3>
                    <p class="why-desc">{{ __('common.gal_why_expert_desc') }}</p>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="why-card-premium why-card-premium--tint-1">
                    <div class="why-icon-badge">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="why-title">{{ __('common.gal_why_industry_title') }}</h3>
                    <p class="why-desc">{{ __('common.gal_why_industry_desc') }}</p>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="why-card-premium why-card-premium--tint-2">
                    <div class="why-icon-badge">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <h3 class="why-title">{{ __('common.gal_why_projects_title') }}</h3>
                    <p class="why-desc">{{ __('common.gal_why_projects_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-info pt-120 pb-120" style="background: var(--color-cream, #fff6f0); border-top: 1px solid var(--color-stone, #d7d6d4); border-bottom: 1px solid var(--color-stone, #d7d6d4);">
    <div class="auto-container">
        <div class="row align-items-center g-5">
            <!-- LEFT: Content -->
            <div class="col-xl-7 col-lg-7 col-md-12 pe-xl-5">
                <span class="modern-badge mb-3">{{ __('common.gal_about_section_badge') }}</span>
                <h2 class="modern-h2 mb-4" style="color: var(--color-ink, #25221e);">{{ __('common.gal_about_section_title') }}</h2>
                <p class="mb-5 text-muted" style="font-size: 15px; color: var(--color-pencil, #6f6c69) !important; font-weight: 500; line-height: 1.8;">{{ __('common.gal_about_section_description') }}</p>

                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="about-feature-item">
                            <div class="about-feature-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div>
                                <h4 class="about-feature-title">{{ __('common.gal_why_expert_title') }}</h4>
                                <p class="about-feature-desc">{{ __('common.gal_about_expert_instruction') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="about-feature-item">
                            <div class="about-feature-icon icon-forest">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <div>
                                <h4 class="about-feature-title">{{ __('common.gal_about_certifications') }}</h4>
                                <p class="about-feature-desc">{{ __('common.gal_about_certifications_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Video (Portrait) -->
            <div class="col-xl-5 col-lg-5 col-md-12">
                <div class="modern-video-wrapper" style="border-radius: 20px; overflow: hidden; box-shadow: var(--shadow-lg); border: 1px solid var(--color-stone, #d7d6d4); max-width: 350px; margin: 0 auto; aspect-ratio: 9/16; background: #000;">
                    <video class="w-100 h-100" autoplay loop muted playsinline style="object-fit: cover; display: block;">
                        <source src="{{ asset('assets/art-classes/v1.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="tech-hero-section">
    <video class="tech-hero-video" autoplay loop muted playsinline preload="auto" poster="{{ asset('assets/images/background/4.jpg') }}">
        <source src="{{ asset('assets/images/home-video.mp4') }}" type="video/mp4">
    </video>
    <div class="tech-hero-overlay"></div>
    <div class="tech-hero-container">
        <div class="tech-hero-glass-card">
            <div class="tech-hero-content">
                <h2>{{ __('common.gal_tech_hero_title') }}</h2>
                <p>{{ __('common.gal_tech_hero_description') }}</p>
                <a href="{{ route('product-lists') }}" class="modern-btn modern-btn-solid shadow-lg">
                    {{ __('common.gal_tech_hero_cta') }} <i class="fas fa-chevron-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- POINTS TOP UP SECTION - PREMIUM LUXURY DESIGN -->
<section class="points-topup-section pt-120 pb-120" id="topup">
    <div class="auto-container">
        <div class="text-center mb-5">
            <span class="modern-badge">{{ __('common.gal_topup_badge') }}</span>
            <h2 class="modern-h2 mt-3">{{ __('common.gal_topup_title') }}</h2>
            <p class="text-muted mx-auto mt-3" style="max-width: 600px;">
                {{ __('common.gal_topup_description') }}
            </p>
        </div>

        <div class="row align-items-center g-5">
            <!-- PREMIUM TIER CARDS -->
            <div class="col-xl-6 col-lg-6">
                <div class="premium-tier-section">
                    <!-- Section Header -->
                    <div class="tier-section-header">
                        <div class="header-icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M16 2L20.123 12.038H30.879L22.378 17.962L26.501 28L16 22.076L5.499 28L9.622 17.962L1.121 12.038H11.877L16 2Z" fill="url(#tierGradient)"/>
                                <defs>
                                    <linearGradient id="tierGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#1591DC;stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#2C5EAD;stop-opacity:1" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div class="header-text">
                            <h3 class="tier-title">{{ __('common.gal_tiers_title') }}</h3>
                            <p class="tier-subtitle">{{ __('common.gal_tiers_subtitle') }}</p>
                        </div>
                    </div>

                    <!-- Tier Cards Grid -->
                    @if(session('currency') == 'JPY')
                    <div class="tier-cards-grid">
                        <!-- Tier 1 -->
                        <div class="tier-card tier-card-1">
                            <div class="tier-badge-large">1</div>
                            <h4 class="tier-card-label">Standard</h4>
                            <div class="tier-range-text">1 - 79,999 ¥</div>
                            <div class="tier-multiplier">
                                <span class="multiplier-text">×1</span>
                                <span class="multiplier-label">Bonus</span>
                            </div>
                            <div class="tier-indicator-bar">
                                <div class="tier-indicator-fill" style="width: 0%;"></div>
                            </div>
                        </div>

                        <!-- Tier 2 -->
                        <div class="tier-card tier-card-2">
                            <div class="tier-badge-large tier-badge-premium">2</div>
                            <h4 class="tier-card-label">Premium</h4>
                            <div class="tier-range-text">80,000 - 159,999 ¥</div>
                            <div class="tier-multiplier">
                                <span class="multiplier-text multiplier-active">×2</span>
                                <span class="multiplier-label">Bonus</span>
                            </div>
                            <div class="tier-indicator-bar">
                                <div class="tier-indicator-fill" style="width: 50%;"></div>
                            </div>
                        </div>

                        <!-- Tier 3 -->
                        <div class="tier-card tier-card-3">
                            <div class="tier-badge-large tier-badge-elite">3</div>
                            <h4 class="tier-card-label">Elite</h4>
                            <div class="tier-range-text">160,000 - 239,999 ¥</div>
                            <div class="tier-multiplier">
                                <span class="multiplier-text multiplier-active">×2.5</span>
                                <span class="multiplier-label">Bonus</span>
                            </div>
                            <div class="tier-indicator-bar">
                                <div class="tier-indicator-fill" style="width: 75%;"></div>
                            </div>
                        </div>

                        <!-- Tier 4 -->
                        <div class="tier-card tier-card-4">
                            <div class="tier-badge-large tier-badge-vip">4</div>
                            <h4 class="tier-card-label">VIP</h4>
                            <div class="tier-range-text">240,000+ ¥</div>
                            <div class="tier-multiplier">
                                <span class="multiplier-text multiplier-active">×3</span>
                                <span class="multiplier-label">Bonus</span>
                            </div>
                            <div class="tier-indicator-bar">
                                <div class="tier-indicator-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="currency-note">*160 JPY = 1 Credit</div>
                    @else
                    <div class="tier-cards-grid">
                        <!-- Tier 1 -->
                        <div class="tier-card tier-card-1">
                            <div class="tier-badge-large">1</div>
                            <h4 class="tier-card-label">Standard</h4>
                            <div class="tier-range-text">$1 - $499</div>
                            <div class="tier-multiplier">
                                <span class="multiplier-text">×1</span>
                                <span class="multiplier-label">Bonus</span>
                            </div>
                            <div class="tier-indicator-bar">
                                <div class="tier-indicator-fill" style="width: 0%;"></div>
                            </div>
                        </div>

                        <!-- Tier 2 -->
                        <div class="tier-card tier-card-2">
                            <div class="tier-badge-large tier-badge-premium">2</div>
                            <h4 class="tier-card-label">Premium</h4>
                            <div class="tier-range-text">$500 - $999</div>
                            <div class="tier-multiplier">
                                <span class="multiplier-text multiplier-active">×2</span>
                                <span class="multiplier-label">Bonus</span>
                            </div>
                            <div class="tier-indicator-bar">
                                <div class="tier-indicator-fill" style="width: 50%;"></div>
                            </div>
                        </div>

                        <!-- Tier 3 -->
                        <div class="tier-card tier-card-3">
                            <div class="tier-badge-large tier-badge-elite">3</div>
                            <h4 class="tier-card-label">Elite</h4>
                            <div class="tier-range-text">$1,000 - $1,499</div>
                            <div class="tier-multiplier">
                                <span class="multiplier-text multiplier-active">×2.5</span>
                                <span class="multiplier-label">Bonus</span>
                            </div>
                            <div class="tier-indicator-bar">
                                <div class="tier-indicator-fill" style="width: 75%;"></div>
                            </div>
                        </div>

                        <!-- Tier 4 -->
                        <div class="tier-card tier-card-4">
                            <div class="tier-badge-large tier-badge-vip">4</div>
                            <h4 class="tier-card-label">VIP</h4>
                            <div class="tier-range-text">$1,500+</div>
                            <div class="tier-multiplier">
                                <span class="multiplier-text multiplier-active">×3</span>
                                <span class="multiplier-label">Bonus</span>
                            </div>
                            <div class="tier-indicator-bar">
                                <div class="tier-indicator-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="currency-note">*1 USD = 1 Credit</div>
                    @endif
                </div>
            </div>

            <!-- PREMIUM LUXURY CALCULATOR -->
            <div class="col-xl-6 col-lg-6">
                <div class="luxury-calculator-wrapper">
                    <!-- Decorative background elements -->
                    <div class="calc-bg-blob calc-blob-1"></div>
                    <div class="calc-bg-blob calc-blob-2"></div>

                    <div class="luxury-calculator">
                        <!-- Header -->
                        <div class="calc-header-premium">
                            <div class="calc-header-top">
                                <h2 class="calc-title-premium">{{ __('common.gal_calc_title') }}</h2>
                                <p class="calc-tagline">{{ __('common.gal_calc_tagline') }}</p>
                            </div>
                            <div class="calc-currency-badge">{{ session('currency') == 'JPY' ? '¥' : '$' }}</div>
                        </div>

                        <!-- Main Form -->
                        <form action="{{ route('points.add-to-cart') }}" method="POST" class="luxury-calc-form enroll-form" data-topup-form="1">
                            @csrf

                            <!-- Amount Input with Premium Styling -->
                            <div class="premium-input-section">
                                <label class="input-label-premium">{{ __('common.gal_calc_input_label') }}</label>
                                <div class="premium-amount-input-wrapper">
                                    <input
                                        type="number"
                                        name="amount"
                                        id="topup_amount"
                                        class="premium-amount-input"
                                        placeholder="0"
                                        min="1"
                                        required
                                    >
                                    <span class="input-currency">{{ session('currency') == 'JPY' ? '¥' : '$' }}</span>
                                </div>
                            </div>

                            <!-- Points Breakdown Card -->
                            <div class="points-breakdown-card">
                                <div class="breakdown-row">
                                    <span class="breakdown-label">{{ __('common.gal_calc_base_points') }}</span>
                                    <span class="breakdown-value" id="base_points">0</span>
                                </div>
                                <div class="breakdown-row">
                                    <span class="breakdown-label">{{ __('common.gal_calc_tier_bonus') }}</span>
                                    <span class="breakdown-value bonus-badge" id="multiplier_display">×1</span>
                                </div>
                                <div class="breakdown-divider"></div>
                                <div class="breakdown-row breakdown-total">
                                    <span class="breakdown-label">{{ __('common.gal_calc_youll_get') }}</span>
                                    <span class="breakdown-value-total" id="total_points">0</span>
                                </div>
                            </div>

                            <!-- Large Points Display -->
                            <div class="points-display-premium">
                                <span class="points-number" id="total_points_large">0</span>
                                <span class="points-unit">{{ __('common.gal_calc_points_unit') }}</span>
                            </div>

                            <!-- Benefits Checklist -->
                            <div class="benefits-section">
                                <div class="benefit-item">
                                    <i class="fas fa-bolt"></i>
                                    <span>{{ __('common.gal_calc_benefit_access') }}</span>
                                </div>
                                <div class="benefit-item">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>{{ __('common.gal_calc_benefit_payment') }}</span>
                                </div>
                                <div class="benefit-item">
                                    <i class="fas fa-unlock"></i>
                                    <span>{{ __('common.gal_calc_benefit_lifetime') }}</span>
                                </div>
                            </div>

                            <!-- Premium Button -->
                            <button type="submit" class="btn-premium-checkout enroll-btn">
                                <span class="btn-label">{{ __('common.gal_calc_button') }}</span>
                                <span class="btn-icon"><i class="fas fa-arrow-right"></i></span>
                                <span class="btn-shine"></span>
                            </button>
                        </form>

                        <!-- Trust Badge -->
                        <div class="trust-indicator">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('common.gal_calc_trust_message') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* =========================================
       PREMIUM TIER CARDS - LUXURY DESIGN
       ========================================= */

    .premium-tier-section {
        background: #ffffff;
        border-radius: 20px;
        padding: 28px 32px;
        box-shadow: 0 2px 8px rgba(21, 145, 220, 0.06);
        border: 1px solid rgba(21, 145, 220, 0.12);
    }

    /* Header */
    .tier-section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .header-icon {
        width: 40px;
        height: 40px;
        background: rgba(21, 145, 220, 0.08);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .tier-title {
        font-size: 20px;
        font-weight: 800;
        color: #0a0e27;
        margin: 0;
    }

    .tier-subtitle {
        font-size: 13px;
        color: #666;
        margin: 4px 0 0 0;
        font-weight: 500;
    }

    /* Tier Cards Grid */
    .tier-cards-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-bottom: 12px;
    }

    .tier-card {
        background: #f8fafc;
        border: 1px solid #e8eef8;
        border-radius: 12px;
        padding: 14px;
        position: relative;
    }

    .tier-badge-large {
        display: inline-flex;
        width: 32px;
        height: 32px;
        background: #f0f4ff;
        color: #1591DC;
        border-radius: 8px;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 6px;
        border: none;
    }

    .tier-badge-premium {
        background: #f0f4ff;
    }

    .tier-badge-elite {
        background: #f0f4ff;
    }

    .tier-badge-vip {
        background: #f0f4ff;
    }

    .tier-card-label {
        font-size: 15px;
        font-weight: 700;
        color: #0a0e27;
        margin: 0 0 6px 0;
    }

    .tier-range-text {
        font-size: 12px;
        color: #666;
        margin-bottom: 10px;
        font-weight: 500;
    }

    .tier-multiplier {
        display: flex;
        align-items: baseline;
        gap: 4px;
        margin-bottom: 8px;
    }

    .multiplier-text {
        font-size: 18px;
        font-weight: 700;
        color: #666;
    }

    .multiplier-active {
        color: #1591DC;
        font-weight: 800;
    }

    .multiplier-label {
        font-size: 11px;
        color: #999;
        text-transform: uppercase;
        font-weight: 600;
    }

    .tier-indicator-bar {
        width: 100%;
        height: 3px;
        background: #e8eef8;
        border-radius: 2px;
        overflow: hidden;
    }

    .tier-indicator-fill {
        height: 100%;
        background: #1591DC;
    }

    .currency-note {
        font-size: 12px;
        color: #1591DC;
        background: rgba(21, 145, 220, 0.06);
        padding: 10px 14px;
        border-radius: 8px;
        display: inline-block;
        font-weight: 600;
    }

    /* =========================================
       LUXURY CALCULATOR - PREMIUM DESIGN
       ========================================= */

    .luxury-calculator-wrapper {
        position: relative;
        height: 100%;
    }

    .calc-bg-blob {
        display: none;
    }

    .luxury-calculator {
        background: #ffffff;
        border: 1px solid rgba(21, 145, 220, 0.12);
        border-radius: 20px;
        padding: 28px 32px;
        box-shadow: 0 2px 8px rgba(21, 145, 220, 0.06);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    /* Calculator Header */
    .calc-header-premium {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 18px;
    }

    .calc-title-premium {
        font-size: 20px;
        font-weight: 800;
        color: #0a0e27;
        margin: 0 0 4px 0;
    }

    .calc-tagline {
        font-size: 13px;
        color: #666;
        margin: 0;
        font-weight: 500;
    }

    .calc-currency-badge {
        width: 40px;
        height: 40px;
        background: #1591DC;
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
        box-shadow: none;
    }

    /* Form Styling */
    .luxury-calc-form {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .premium-input-section {
        margin-bottom: 16px;
    }

    .input-label-premium {
        display: block;
        font-size: 11px;
        font-weight: 600;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 8px;
    }

    .premium-amount-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .premium-amount-input {
        width: 100%;
        font-size: 32px;
        font-weight: 800;
        color: #0a0e27;
        background: transparent;
        border: none;
        border-bottom: 2px solid #e8eef8;
        padding: 10px 0;
        outline: none;
        letter-spacing: -0.5px;
    }

    .premium-amount-input:focus {
        border-bottom-color: #1591DC;
    }

    .input-currency {
        position: absolute;
        right: 18px;
        font-size: 24px;
        font-weight: 700;
        color: #1591DC;
        opacity: 0.6;
    }

    /* Points Breakdown */
    .points-breakdown-card {
        background: #f8fafc;
        border: 1px solid #e8eef8;
        border-radius: 12px;
        padding: 14px;
        margin-bottom: 12px;
    }

    .breakdown-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        font-size: 12px;
    }

    .breakdown-row.breakdown-total {
        margin-bottom: 0;
    }

    .breakdown-label {
        color: #666;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .breakdown-value {
        font-weight: 700;
        color: #0a0e27;
        font-size: 13px;
    }

    .bonus-badge {
        background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .breakdown-divider {
        height: 1px;
        background: #e8eef8;
        margin: 8px 0;
    }

    .breakdown-value-total {
        font-size: 16px;
        font-weight: 800;
        background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Large Points Display */
    .points-display-premium {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-bottom: 16px;
        padding: 8px 12px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px dashed #e8eef8;
    }

    .points-number {
        font-size: 32px;
        font-weight: 900;
        background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -1px;
    }

    .points-unit {
        font-size: 11px;
        color: #666;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    /* Benefits */
    .benefits-section {
        display: flex;
        gap: 10px;
        margin-bottom: 16px;
    }

    .benefit-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        padding: 10px;
        background: #f8fafc;
        border-radius: 10px;
        border: 1px solid #e8eef8;
    }

    .benefit-item i {
        font-size: 14px;
        color: #1591DC;
    }

    .benefit-item span {
        font-size: 10px;
        color: #666;
        font-weight: 500;
        text-align: center;
    }

    /* Premium Button */
    .btn-premium-checkout {
        width: 100%;
        padding: 12px 20px;
        background: #1591DC;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(21, 145, 220, 0.3);
        transition: background 0.2s ease, box-shadow 0.2s ease;
        margin-bottom: 12px;
    }

    .btn-premium-checkout:hover {
        background: #0e7ab8;
        box-shadow: 0 4px 12px rgba(21, 145, 220, 0.4);
    }

    .btn-premium-checkout:active {
        transform: scale(0.98);
    }

    .btn-label {
        font-weight: 600;
    }

    .btn-icon {
        display: none;
    }

    .btn-shine {
        display: none;
    }

    /* Trust Badge */
    .trust-indicator {
        text-align: center;
        font-size: 11px;
        color: #888;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }

    .trust-indicator i {
        color: #1591DC;
        font-size: 12px;
    }

    /* =========================================
       RESPONSIVE DESIGN
       ========================================= */

    @media (max-width: 768px) {
        .premium-tier-section,
        .luxury-calculator {
            padding: 24px 20px;
        }

        .calc-title-premium {
            font-size: 16px;
        }

        .premium-amount-input {
            font-size: 24px;
        }

        .points-number {
            font-size: 32px;
        }

        .tier-title {
            font-size: 16px;
        }
    }

    @media (max-width: 480px) {
        .premium-tier-section,
        .luxury-calculator {
            padding: 20px 16px;
        }

        .tier-section-header {
            gap: 10px;
            margin-bottom: 16px;
        }

        .header-icon {
            width: 36px;
            height: 36px;
        }

        .tier-title {
            font-size: 16px;
        }

        .tier-subtitle {
            font-size: 11px;
        }

        .calc-title-premium {
            font-size: 15px;
        }

        .calc-tagline {
            font-size: 11px;
        }

        .premium-amount-input {
            font-size: 22px;
        }

        .points-number {
            font-size: 30px;
        }

        .tier-cards-grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .tier-card {
            padding: 12px;
        }

        .btn-premium-checkout {
            padding: 10px 16px;
            font-size: 13px;
        }

        .calc-header-premium {
            flex-direction: column;
            gap: 10px;
        }

        .calc-currency-badge {
            width: 36px;
            height: 36px;
            font-size: 16px;
        }
    }
</style>

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
        }

        amountInput.addEventListener('input', calculatePoints);
        amountInput.addEventListener('change', calculatePoints);
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



<style>
    /* =========================================
       HERO MULTIPLE ARTWORK ACCENTS
       ========================================= */
    .af-hero__accent--left {
        left: -50px !important;
        right: auto !important;
        top: 10% !important;
        transform: translateY(0) rotate(-6deg) !important;
        width: 28% !important;
        max-width: 130px !important;
        z-index: 2 !important;
        animation: afCardFloat 18s ease-in-out infinite !important;
    }
    .af-hero__accent--right {
        right: -30px !important;
        top: 50% !important;
        transform: translateY(-50%) rotate(4deg) !important;
        width: 34% !important;
        max-width: 165px !important;
        z-index: 4 !important;
        animation: afCardFloat 14s ease-in-out infinite !important;
    }
    .af-hero__accent--bottom {
        left: 20% !important;
        right: auto !important;
        bottom: -35px !important;
        top: auto !important;
        transform: rotate(-3deg) !important;
        width: 25% !important;
        max-width: 120px !important;
        z-index: 3 !important;
        animation: afCardFloat 16s ease-in-out infinite 1s !important;
    }

    @media (max-width: 991px) {
        .af-hero__accent--left {
            left: -20px !important;
            width: 24% !important;
        }
        .af-hero__accent--right {
            right: -10px !important;
            width: 28% !important;
        }
        .af-hero__accent--bottom {
            bottom: -20px !important;
            left: 25% !important;
            width: 22% !important;
        }
    }

    @media (max-width: 575px) {
        .af-hero__accent--left,
        .af-hero__accent--bottom {
            display: none !important;
        }
        .af-hero__accent--right {
            right: -10px !important;
            top: 50% !important;
            width: 38% !important;
            transform: translateY(-50%) rotate(4deg) !important;
        }
    }

    /* =========================================
       PREMIUM CATEGORY CARDS
       ========================================= */

    /* Custom 5-column grid columns */
    .col-custom-5 {
        position: relative;
        width: 100%;
        padding-right: 12px;
        padding-left: 12px;
        flex: 0 0 100%;
        max-width: 100%;
    }

    @media (min-width: 576px) {
        .col-custom-5 {
            flex: 0 0 50% !important;
            max-width: 50% !important;
        }
    }

    @media (min-width: 768px) {
        .col-custom-5 {
            flex: 0 0 33.3333% !important;
            max-width: 33.3333% !important;
        }
    }

    @media (min-width: 992px) {
        .col-custom-5 {
            flex: 0 0 25% !important;
            max-width: 25% !important;
        }
    }

    @media (min-width: 1200px) {
        .col-custom-5 {
            flex: 0 0 20% !important;
            max-width: 20% !important;
        }
    }

    .modern-badge {
        display: inline-flex !important;
        align-items: center !important;
        font-family: var(--font-inter) !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        letter-spacing: 0.08em !important;
        padding: 6px 12px !important;
        border-radius: var(--radius-badges, 8px) !important;
        background-color: var(--color-cream, #fff6f0) !important;
        color: var(--color-deep-ember, #cf3520) !important;
        border: 1px solid var(--color-stone, #d7d6d4) !important;
        text-transform: uppercase !important;
        box-shadow: var(--shadow-subtle) !important;
        margin-bottom: 15px !important;
    }

    .category-section {
        position: relative;
        overflow: hidden;
    }

    .category-card-premium {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-subtle, 0 1px 3px rgba(0,0,0,0.05));
        padding: 18px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .category-card-premium:hover {
        box-shadow: rgba(37, 34, 30, 0.08) 0px 14px 28px, rgba(37, 34, 30, 0.04) 0px 4px 10px;
        transform: translateY(-6px);
    }

    /* Dynamic tint background colors by default */
    .category-card-premium--tint-0 {
        background-color: var(--color-cream, #fff6f0) !important;
        border: 1px solid rgba(227, 68, 50, 0.15) !important;
    }
    .category-card-premium--tint-0:hover {
        border-color: rgba(227, 68, 50, 0.45) !important;
        background-color: var(--color-cream, #fff6f0) !important;
    }

    .category-card-premium--tint-1 {
        background-color: var(--color-mint-wash, #f0f6df) !important;
        border: 1px solid rgba(68, 108, 61, 0.15) !important;
    }
    .category-card-premium--tint-1:hover {
        border-color: rgba(68, 108, 61, 0.45) !important;
        background-color: var(--color-mint-wash, #f0f6df) !important;
    }

    .category-card-premium--tint-2 {
        background-color: var(--color-sky-wash, #dceaff) !important;
        border: 1px solid rgba(15, 102, 174, 0.15) !important;
    }
    .category-card-premium--tint-2:hover {
        border-color: rgba(15, 102, 174, 0.45) !important;
        background-color: var(--color-sky-wash, #dceaff) !important;
    }

    .category-icon-badge {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        box-shadow: var(--shadow-subtle);
        transition: all 0.3s ease;
    }

    /* Icon badge default coloring per tint */
    .category-card-premium--tint-0 .category-icon-badge {
        color: var(--color-deep-ember, #cf3520) !important;
        border-color: rgba(227, 68, 50, 0.25) !important;
        background-color: var(--color-paper, #fefdfc) !important;
    }
    .category-card-premium--tint-1 .category-icon-badge {
        color: var(--color-forest, #446c3d) !important;
        border-color: rgba(68, 108, 61, 0.25) !important;
        background-color: var(--color-paper, #fefdfc) !important;
    }
    .category-card-premium--tint-2 .category-icon-badge {
        color: var(--color-cobalt-link, #0f66ae) !important;
        border-color: rgba(15, 102, 174, 0.25) !important;
        background-color: var(--color-paper, #fefdfc) !important;
    }

    /* Badge hover logic based on card tint */
    .category-card-premium--tint-0:hover .category-icon-badge {
        background-color: var(--color-ember-red, #e34432) !important;
        color: var(--color-paper, #fefdfc) !important;
        border-color: var(--color-ember-red, #e34432) !important;
    }
    .category-card-premium--tint-1:hover .category-icon-badge {
        background-color: var(--color-forest, #446c3d) !important;
        color: var(--color-paper, #fefdfc) !important;
        border-color: var(--color-forest, #446c3d) !important;
    }
    .category-card-premium--tint-2:hover .category-icon-badge {
        background-color: var(--color-cobalt-link, #0f66ae) !important;
        color: var(--color-paper, #fefdfc) !important;
        border-color: var(--color-cobalt-link, #0f66ae) !important;
    }

    .category-card-image {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
        border-radius: 12px;
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
    }

    .category-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition-normal, 0.25s ease);
    }

    .category-card-premium:hover .category-img {
        transform: scale(1.05);
    }

    .category-img-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: var(--color-deep-ember, #cf3520);
        background: var(--color-paper, #fefdfc);
    }

    .category-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(37, 34, 30, 0.65);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity var(--transition-normal, 0.25s ease);
        backdrop-filter: blur(2px);
    }

    .category-card-premium:hover .category-overlay {
        opacity: 1;
    }

    .category-explore-btn {
        background: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        padding: 10px 20px;
        border-radius: var(--radius-buttons, 8px);
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all var(--transition-normal, 0.25s ease);
        box-shadow: 0 4px 12px rgba(227, 68, 50, 0.2);
    }

    .category-explore-btn:hover {
        background: var(--color-deep-ember, #cf3520);
        box-shadow: 0 6px 16px rgba(227, 68, 50, 0.35);
        transform: translateY(-2px);
        color: var(--color-paper, #fefdfc);
    }

    .category-card-content {
        padding: 20px 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .category-title {
        font-family: var(--font-graphik, sans-serif);
        font-size: 17px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        margin: 0 0 12px 0;
    }

    .category-title a {
        color: var(--color-ink, #25221e);
        text-decoration: none;
        transition: color var(--transition-normal, 0.25s ease);
    }

    .category-title a:hover {
        color: var(--color-deep-ember, #cf3520);
    }

    .category-count {
        font-size: 12px;
        color: var(--color-deep-ember, #cf3520);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
        margin: 0 0 10px 0;
    }

    .category-count i {
        font-size: 11px;
    }

    .category-description {
        font-size: 13px;
        color: var(--color-pencil, #6f6c69);
        margin: 0;
        line-height: 1.5;
    }

    /* =========================================
       RESPONSIVE DESIGN
       ========================================= */

    @media (max-width: 768px) {
        .category-card-image {
            height: 180px;
        }

        .category-card-content {
            padding: 16px 14px;
        }

        .category-title {
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .category-card-image {
            height: 160px;
        }

        .category-card-content {
            padding: 14px 12px;
        }

        .category-title {
            font-size: 13px;
        }

        .category-count {
            font-size: 11px;
        }

        .category-explore-btn {
            padding: 8px 14px;
            font-size: 12px;
        }
    }

    /* =========================================
       REVAMPED COURSE CARDS & CAROUSEL
       ========================================= */

    .courses-carousel {
        position: relative;
        padding: 0 10px;
    }

    .courses-carousel .owl-item {
        padding: 15px;
    }

    .courses-carousel .owl-stage-outer {
        padding-top: 15px !important;
        padding-bottom: 25px !important;
        margin-top: -15px !important;
        margin-bottom: -25px !important;
    }

    .courses-carousel .owl-nav {
        position: absolute;
        top: 50%;
        left: -60px;
        right: -60px;
        transform: translateY(-50%);
        display: flex;
        justify-content: space-between;
        pointer-events: none;
        z-index: 10 !important;
    }

    .courses-carousel .owl-nav .owl-prev,
    .courses-carousel .owl-nav .owl-next {
        width: 44px !important;
        height: 44px !important;
        border-radius: 50% !important;
        background: var(--color-paper, #fefdfc) !important;
        border: 1px solid var(--color-stone, #d7d6d4) !important;
        color: var(--color-ink, #25221e) !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 16px !important;
        box-shadow: 0 4px 10px rgba(37, 34, 30, 0.06) !important;
        transition: all 0.3s ease !important;
        pointer-events: auto !important;
    }

    .courses-carousel .owl-nav .owl-prev:hover,
    .courses-carousel .owl-nav .owl-next:hover {
        background: var(--color-cream, #fff6f0) !important;
        color: var(--color-deep-ember, #cf3520) !important;
        border-color: rgba(227, 68, 50, 0.35) !important;
        box-shadow: 0 6px 15px rgba(37, 34, 30, 0.1) !important;
        transform: translateY(-2px);
    }

    .courses-carousel .owl-dots {
        text-align: center;
        margin-top: 20px;
    }

    .courses-carousel .owl-dots .owl-dot {
        width: 8px !important;
        height: 8px !important;
        border-radius: 50% !important;
        background-color: var(--color-stone, #d7d6d4) !important;
        margin: 0 5px !important;
        display: inline-block !important;
        transition: all 0.3s ease !important;
    }

    .courses-carousel .owl-dots .owl-dot.active {
        background-color: var(--color-deep-ember, #cf3520) !important;
        transform: scale(1.3);
    }

    @media (max-width: 1300px) {
        .courses-carousel .owl-nav {
            position: static;
            transform: none;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
            pointer-events: auto;
        }
    }

    /* Course Card Overrides */
    .modern-course-card {
        background: var(--color-paper, #fefdfc) !important;
        border: 1px solid var(--color-stone, #d7d6d4) !important;
        border-radius: 16px !important;
        overflow: hidden !important;
        box-shadow: var(--shadow-subtle, rgba(37, 34, 30, 0.04) 0px 1px 0px 0px) !important;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .modern-course-card:hover {
        transform: translateY(-6px) !important;
        box-shadow: rgba(37, 34, 30, 0.08) 0px 14px 28px, rgba(37, 34, 30, 0.04) 0px 4px 10px !important;
        border-color: rgba(227, 68, 50, 0.35) !important;
    }

    .course-img-container {
        border-radius: 0 !important;
        border-bottom: 1px solid var(--color-stone, #d7d6d4) !important;
    }

    .course-content {
        padding: 24px !important;
        display: flex !important;
        flex-direction: column !important;
        flex-grow: 1 !important;
    }

    .course-title {
        font-family: var(--font-graphik, sans-serif) !important;
        font-size: 18px !important;
        font-weight: 700 !important;
    }

    .course-title a {
        color: var(--color-ink, #25221e) !important;
        transition: color 0.3s ease !important;
    }

    .course-title a:hover {
        color: var(--color-deep-ember, #cf3520) !important;
    }

    .course-summary {
        color: var(--color-pencil, #6f6c69) !important;
        font-family: var(--font-inter, sans-serif) !important;
        font-size: 14px !important;
        line-height: 1.6 !important;
        margin-bottom: 20px !important;
    }

    .course-footer {
        border-top: 1px solid var(--color-stone, #d7d6d4) !important;
        margin-top: auto !important;
        padding-top: 15px !important;
    }

    .course-enroll-link {
        color: var(--color-deep-ember, #cf3520) !important;
        font-family: var(--font-inter) !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
    }

    .course-enroll-link:hover {
        color: var(--color-ink, #25221e) !important;
        transform: translateX(3px) !important;
    }

    /* =========================================
       REVAMPED ABOUT SECTION
       ========================================= */
    .about-feature-item {
        background: var(--color-paper, #fefdfc) !important;
        border: 1px solid var(--color-stone, #d7d6d4) !important;
        border-radius: 12px !important;
        padding: 20px !important;
        display: flex !important;
        align-items: start !important;
        gap: 16px !important;
        transition: all 0.3s ease !important;
        box-shadow: var(--shadow-subtle) !important;
    }

    .about-feature-item:hover {
        transform: translateY(-3px) !important;
        box-shadow: rgba(37, 34, 30, 0.06) 0px 8px 16px !important;
        border-color: rgba(227, 68, 50, 0.25) !important;
    }

    .about-feature-icon {
        width: 44px !important;
        height: 44px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 18px !important;
        flex-shrink: 0 !important;
        background-color: var(--color-cream, #fff6f0) !important;
        color: var(--color-deep-ember, #cf3520) !important;
        border: 1px solid rgba(227, 68, 50, 0.15) !important;
    }

    .about-feature-icon.icon-forest {
        background-color: var(--color-mint-wash, #f0f6df) !important;
        color: var(--color-forest, #446c3d) !important;
        border: 1px solid rgba(68, 108, 61, 0.15) !important;
    }

    .about-feature-title {
        font-family: var(--font-graphik, sans-serif) !important;
        font-size: 15px !important;
        font-weight: 700 !important;
        color: var(--color-ink, #25221e) !important;
        margin-bottom: 6px !important;
    }

    .about-feature-desc {
        font-family: var(--font-inter, sans-serif) !important;
        font-size: 13.5px !important;
        color: var(--color-pencil, #6f6c69) !important;
        line-height: 1.5 !important;
        margin-bottom: 0 !important;
    }

    .modern-img-wrapper:hover img {
        transform: scale(1.03) !important;
    }

    .modern-video-wrapper {
        position: relative;
        transition: transform 0.4s ease, box-shadow 0.4s ease !important;
    }

    .modern-video-wrapper:hover {
        transform: scale(1.02) translateY(-4px) !important;
        box-shadow: rgba(37, 34, 30, 0.12) 0px 20px 40px !important;
    }

    /* =========================================
       REVAMPED WHY CHOOSE US SECTION
       ========================================= */
    .why-card-premium {
        border-radius: 16px !important;
        overflow: hidden !important;
        box-shadow: var(--shadow-subtle, rgba(37, 34, 30, 0.04) 0px 1px 0px 0px) !important;
        padding: 40px 30px !important;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .why-card-premium:hover {
        transform: translateY(-6px) !important;
        box-shadow: rgba(37, 34, 30, 0.08) 0px 14px 28px, rgba(37, 34, 30, 0.04) 0px 4px 10px !important;
    }

    /* Tint backgrounds by default */
    .why-card-premium--tint-0 {
        background-color: var(--color-cream, #fff6f0) !important;
        border: 1px solid rgba(227, 68, 50, 0.15) !important;
    }
    .why-card-premium--tint-0:hover {
        border-color: rgba(227, 68, 50, 0.45) !important;
    }

    .why-card-premium--tint-1 {
        background-color: var(--color-mint-wash, #f0f6df) !important;
        border: 1px solid rgba(68, 108, 61, 0.15) !important;
    }
    .why-card-premium--tint-1:hover {
        border-color: rgba(68, 108, 61, 0.45) !important;
    }

    .why-card-premium--tint-2 {
        background-color: var(--color-sky-wash, #dceaff) !important;
        border: 1px solid rgba(15, 102, 174, 0.15) !important;
    }
    .why-card-premium--tint-2:hover {
        border-color: rgba(15, 102, 174, 0.45) !important;
    }

    .why-icon-badge {
        width: 64px !important;
        height: 64px !important;
        border-radius: 50% !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 24px !important;
        margin-bottom: 24px !important;
        box-shadow: var(--shadow-subtle) !important;
        transition: all 0.3s ease !important;
    }

    /* Icon color per tint */
    .why-card-premium--tint-0 .why-icon-badge {
        color: var(--color-deep-ember, #cf3520) !important;
        border: 1px solid rgba(227, 68, 50, 0.2) !important;
        background-color: var(--color-paper, #fefdfc) !important;
    }
    .why-card-premium--tint-1 .why-icon-badge {
        color: var(--color-forest, #446c3d) !important;
        border: 1px solid rgba(68, 108, 61, 0.2) !important;
        background-color: var(--color-paper, #fefdfc) !important;
    }
    .why-card-premium--tint-2 .why-icon-badge {
        color: var(--color-cobalt-link, #0f66ae) !important;
        border: 1px solid rgba(15, 102, 174, 0.2) !important;
        background-color: var(--color-paper, #fefdfc) !important;
    }

    /* Icon hover states */
    .why-card-premium--tint-0:hover .why-icon-badge {
        background-color: var(--color-ember-red, #e34432) !important;
        color: var(--color-paper, #fefdfc) !important;
        border-color: var(--color-ember-red, #e34432) !important;
    }
    .why-card-premium--tint-1:hover .why-icon-badge {
        background-color: var(--color-forest, #446c3d) !important;
        color: var(--color-paper, #fefdfc) !important;
        border-color: var(--color-forest, #446c3d) !important;
    }
    .why-card-premium--tint-2:hover .why-icon-badge {
        background-color: var(--color-cobalt-link, #0f66ae) !important;
        color: var(--color-paper, #fefdfc) !important;
        border-color: var(--color-cobalt-link, #0f66ae) !important;
    }

    .why-title {
        font-family: var(--font-graphik, sans-serif) !important;
        font-size: 20px !important;
        font-weight: 700 !important;
        color: var(--color-ink, #25221e) !important;
        margin-bottom: 12px !important;
    }

    .why-desc {
        font-family: var(--font-inter, sans-serif) !important;
        font-size: 14px !important;
        color: var(--color-pencil, #6f6c69) !important;
        line-height: 1.6 !important;
        margin-bottom: 0 !important;
    }
</style>

@endsection
