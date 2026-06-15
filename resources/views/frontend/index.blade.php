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

<!-- POINTS TOP UP SECTION - CREATIVE progression DESIGN -->
<section class="points-topup-section pt-120 pb-120" id="topup" style="background-color: var(--color-paper, #fefdfc) !important; border-top: 1px solid var(--color-stone, #d7d6d4);">
    <div class="auto-container">
        <!-- 1. Section Header -->
        <div class="text-center mb-5">
            <span class="modern-badge">{{ __('common.gal_topup_badge') }}</span>
            <h2 class="modern-h2 mt-3" style="color: var(--color-ink, #25221e);">{{ __('common.gal_topup_title') }}</h2>
            <p class="text-muted mx-auto mt-3" style="max-width: 600px; color: var(--color-pencil, #6f6c69) !important; font-size: 15px;">
                {{ __('common.gal_topup_description') }}
            </p>
        </div>

        <!-- 2. Benefits Row -->
        <div class="row g-4 mb-5 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="learning-benefit-card">
                    <span class="benefit-emoji"><i class="fas fa-palette"></i></span>
                    <h5 class="benefit-title">Unlock Premium Courses</h5>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="learning-benefit-card">
                    <span class="benefit-emoji"><i class="fas fa-book-open"></i></span>
                    <h5 class="benefit-title">Access Learning Paths</h5>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="learning-benefit-card">
                    <span class="benefit-emoji"><i class="fas fa-trophy"></i></span>
                    <h5 class="benefit-title">Earn Bonus Rewards</h5>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="learning-benefit-card">
                    <span class="benefit-emoji"><i class="fas fa-chart-line"></i></span>
                    <h5 class="benefit-title">Accelerate Your Growth</h5>
                </div>
            </div>
        </div>

        <div class="row align-items-stretch g-5">
            <!-- 3. Learning Tier System (Left Column) -->
            <div class="col-xl-6 col-lg-6">
                <div class="learning-pathway-card h-100">
                    <div class="pathway-header mb-4">
                        <div class="header-icon-modern">
                            <i class="fas fa-compass"></i>
                        </div>
                        <div>
                            <h3 class="pathway-title">Creative Pathways</h3>
                            <p class="pathway-subtitle">Bonus multipliers grow as you commit to your artistic journey</p>
                        </div>
                    </div>

                    <!-- Visual Progression Timeline / Grid -->
                    <div class="visual-progression-timeline">
                        <!-- Step 1: Standard -->
                        <div class="timeline-step" id="step_standard">
                            <div class="step-badge">1</div>
                            <div class="step-content">
                                <div class="step-header">
                                    <h4 class="step-title">Standard</h4>
                                    <span class="step-bonus">×1.0</span>
                                </div>
                                <p class="step-desc">Ideal for beginners starting their learning journey</p>
                                <div class="step-range"><strong>{{ session('currency') == 'JPY' ? '1 - 79,999 ¥' : '$1 - $499' }}</strong></div>
                            </div>
                        </div>

                        <!-- Step 2: Premium -->
                        <div class="timeline-step" id="step_premium">
                            <div class="step-badge">2</div>
                            <div class="step-content">
                                <div class="step-header">
                                    <h4 class="step-title">Premium</h4>
                                    <span class="step-bonus">×2.0 Bonus</span>
                                </div>
                                <p class="step-desc">Most popular for active learners building consistency</p>
                                <div class="step-range"><strong>{{ session('currency') == 'JPY' ? '80,000 - 159,999 ¥' : '$500 - $999' }}</strong></div>
                            </div>
                        </div>

                        <!-- Step 3: Elite -->
                        <div class="timeline-step" id="step_elite">
                            <div class="step-badge">3</div>
                            <div class="step-content">
                                <div class="step-header">
                                    <h4 class="step-title">Elite</h4>
                                    <span class="step-bonus">×2.5 Bonus</span>
                                </div>
                                <p class="step-desc">For serious students looking to master their craft</p>
                                <div class="step-range"><strong>{{ session('currency') == 'JPY' ? '160,000 - 239,999 ¥' : '$1,000 - $1,499' }}</strong></div>
                            </div>
                        </div>

                        <!-- Step 4: VIP -->
                        <div class="timeline-step" id="step_vip">
                            <div class="step-badge">4</div>
                            <div class="step-content">
                                <div class="step-header">
                                    <h4 class="step-title">VIP</h4>
                                    <span class="step-bonus">×3.0 Bonus</span>
                                </div>
                                <p class="step-desc">Maximum rewards, comprehensive pathway access</p>
                                <div class="step-range"><strong>{{ session('currency') == 'JPY' ? '240,000+ ¥' : '$1,500+' }}</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Credits Calculator (Right Column) -->
            <div class="col-xl-6 col-lg-6">
                <div class="luxury-calculator-wrapper h-100">
                    <div class="luxury-calculator d-flex flex-column justify-content-between h-100">
                        <div>
                            <!-- Header -->
                            <div class="calc-header-premium mb-4">
                                <div>
                                    <h3 class="calc-title-premium">{{ __('common.gal_calc_title') }}</h3>
                                    <p class="calc-tagline">{{ __('common.gal_calc_tagline') }}</p>
                                </div>
                                <div class="calc-currency-badge"><strong>{{ session('currency') == 'JPY' ? '¥' : '$' }}</strong></div>
                            </div>

                            <!-- Main Form -->
                            <form action="{{ route('points.add-to-cart') }}" method="POST" class="luxury-calc-form enroll-form" data-topup-form="1">
                                @csrf

                                <!-- Amount Input -->
                                <div class="premium-input-section mb-4">
                                    <label class="input-label-premium">Set Your Learning Commitment</label>
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
                                        <span class="input-currency"><strong>{{ session('currency') == 'JPY' ? '¥' : '$' }}</strong></span>
                                    </div>
                                </div>

                                <!-- Points Breakdown -->
                                <div class="points-breakdown-card mb-4">
                                    <div class="breakdown-row">
                                        <span class="breakdown-label">Base Learning Credits</span>
                                        <span class="breakdown-value" id="base_points">0</span>
                                    </div>
                                    <div class="breakdown-row">
                                        <span class="breakdown-label">Multiplier Bonus</span>
                                        <span class="breakdown-value bonus-badge" id="multiplier_display">×1</span>
                                    </div>
                                    <div class="breakdown-divider"></div>
                                    <div class="breakdown-row breakdown-total">
                                        <span class="breakdown-label">Unlocking Potential</span>
                                        <span class="breakdown-value-total" id="total_points">0</span>
                                    </div>
                                </div>

                                <!-- Large Credits Display -->
                                <div class="points-display-premium mb-4">
                                    <span class="points-number" id="total_points_large">0</span>
                                    <span class="points-unit">Credits Unlocked</span>
                                </div>

                                <!-- Premium Button inside form -->
                                <button type="submit" class="btn-premium-checkout enroll-btn w-100">
                                    <span class="btn-label">{{ __('common.gal_calc_button') }}</span>
                                    <span class="btn-icon"><i class="fas fa-arrow-right"></i></span>
                                    <span class="btn-shine"></span>
                                </button>
                            </form>
                            <!-- Dynamic Currency Conversion Note -->
                            <div class="currency-note-calc mt-3 text-center" style="font-size: 12px; color: var(--color-graphite, #94928f); font-weight: 600;">
                                <strong>{{ session('currency') == 'JPY' ? '*160 JPY = 1 Credit' : '*1 USD = 1 Credit' }}</strong>
                            </div>
                        </div>

                        <!-- Trust Badge -->
                        <div class="trust-indicator mt-3 text-center">
                            <i class="fas fa-lock me-1"></i>
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
       REDESIGNED LEARNING CREDITS PROGRESSION
       ========================================= */

    .points-topup-section {
        background-color: var(--color-paper, #fefdfc) !important;
        border-top: 1px solid var(--color-stone, #d7d6d4);
        font-family: var(--font-inter), sans-serif;
    }

    /* Benefits Row */
    .learning-benefit-card {
        background: var(--surface-cream-wash, #fffaf6);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-lg, 12px);
        padding: 18px 16px;
        text-align: center;
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .learning-benefit-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-subtle, 0 4px 12px rgba(37,34,30,0.04));
    }
    .benefit-emoji {
        font-size: 26px;
        display: block;
        margin-bottom: 10px;
    }
    .benefit-title {
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        font-weight: var(--font-weight-semibold, 600);
        color: var(--color-ink, #25221e);
        margin: 0;
    }

    /* Pathway Card */
    .learning-pathway-card {
        background: var(--color-cream, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-xl, 20px);
        padding: 32px;
    }
    .pathway-header {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .header-icon-modern {
        width: 46px;
        height: 46px;
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: var(--color-ember-red, #e34432);
        box-shadow: var(--shadow-subtle, 0 4px 12px rgba(37,34,30,0.04));
    }
    .pathway-title {
        font-family: var(--font-graphik), sans-serif;
        font-size: 20px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        margin: 0;
    }
    .pathway-subtitle {
        font-size: 13px;
        color: var(--color-pencil, #6f6c69);
        margin: 4px 0 0 0;
    }

    /* Timeline Progression */
    .visual-progression-timeline {
        display: flex;
        flex-direction: column;
        gap: 24px;
        position: relative;
        padding-left: 20px;
        margin-top: 24px;
    }
    .visual-progression-timeline::before {
        content: '';
        position: absolute;
        left: 31px;
        top: 15px;
        bottom: 15px;
        width: 2px;
        background: var(--color-stone, #d7d6d4);
        z-index: 0;
    }
    .timeline-step {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        position: relative;
        z-index: 1;
    }
    .step-badge {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--color-paper, #fefdfc);
        border: 2px solid var(--color-stone, #d7d6d4);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        color: var(--color-graphite, #94928f);
        flex-shrink: 0;
        margin-top: 4px;
        transition: all 0.3s ease;
    }
    .timeline-step-highlight .step-badge {
        background: var(--color-ember-red, #e34432);
        border-color: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        box-shadow: 0 0 0 4px rgba(227, 68, 50, 0.15);
    }
    .step-content {
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 12px;
        padding: 16px 20px;
        flex-grow: 1;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-subtle, 0 4px 12px rgba(37,34,30,0.04));
    }
    .timeline-step-highlight .step-content {
        border-color: var(--color-ember-red, #e34432);
        background: var(--color-paper, #fefdfc);
    }
    .step-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 6px;
    }
    .step-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        margin: 0;
    }
    .step-bonus {
        font-size: 12px;
        font-weight: 700;
        color: var(--color-pencil, #6f6c69);
        padding: 2px 8px;
        background: var(--surface-cream-wash, #fffaf6);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 6px;
    }
    .timeline-step-highlight .step-bonus {
        color: var(--color-paper, #fefdfc);
        background: var(--color-ember-red, #e34432);
        border-color: var(--color-ember-red, #e34432);
    }
    .step-desc {
        font-size: 13px;
        color: var(--color-pencil, #6f6c69);
        margin: 0 0 8px 0;
        line-height: 1.45;
    }
    .step-range {
        font-size: 11px;
        font-weight: 600;
        color: var(--color-graphite, #94928f);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Calculator Redesign */
    .luxury-calculator-wrapper {
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-xl, 20px);
        padding: 32px;
        box-shadow: var(--shadow-subtle, 0 4px 12px rgba(37,34,30,0.04));
    }
    .calc-header-premium {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
    .calc-title-premium {
        font-family: var(--font-graphik), sans-serif;
        font-size: 20px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        margin: 0;
    }
    .calc-tagline {
        font-size: 13px;
        color: var(--color-pencil, #6f6c69);
        margin: 4px 0 0 0;
    }
    .calc-currency-badge {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: var(--color-cream, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
    }

    /* Calculator inputs styling */
    .input-label-premium {
        font-size: 13px;
        font-weight: 600;
        color: var(--color-pencil, #6f6c69);
        margin-bottom: 8px;
        display: block;
    }
    .premium-amount-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }
    .premium-amount-input {
        width: 100%;
        background: var(--surface-cream-wash, #fffaf6) !important;
        border: 1px solid var(--color-stone, #d7d6d4) !important;
        border-radius: var(--radius-buttons, 10px) !important;
        padding: 14px 44px 14px 20px !important;
        font-size: 22px !important;
        font-weight: 700 !important;
        color: var(--color-ink, #25221e) !important;
        transition: all 0.25s ease;
    }
    .premium-amount-input:focus {
        background: var(--color-paper, #fefdfc) !important;
        border-color: var(--color-deep-ember, #cf3520) !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(207, 53, 32, 0.08);
    }
    .input-currency {
        position: absolute;
        right: 20px;
        font-size: 18px;
        font-weight: 700;
        color: var(--color-graphite, #94928f);
        pointer-events: none;
    }

    /* Breakdown card styling */
    .points-breakdown-card {
        background: var(--color-cream, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 12px;
        padding: 20px;
    }
    .breakdown-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }
    .breakdown-row:last-child {
        margin-bottom: 0;
    }
    .breakdown-label {
        font-size: 13px;
        font-weight: 500;
        color: var(--color-pencil, #6f6c69);
    }
    .breakdown-value {
        font-size: 14px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
    }
    .bonus-badge {
        padding: 3px 8px;
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 6px;
        font-size: 12px;
        color: var(--color-ember-red, #e34432) !important;
    }
    .breakdown-divider {
        height: 1px;
        background: var(--color-stone, #d7d6d4);
        margin: 16px 0;
    }
    .breakdown-total .breakdown-label {
        font-weight: 700;
        color: var(--color-ink, #25221e);
    }
    .breakdown-value-total {
        font-size: 20px;
        font-weight: 800;
        color: var(--color-ember-red, #e34432);
    }

    /* Large display */
    .points-display-premium {
        background: var(--surface-cream-wash, #fffaf6);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        box-shadow: inset 0 2px 4px rgba(37,34,30,0.02);
    }
    .points-number {
        display: block;
        font-family: var(--font-graphik), sans-serif;
        font-size: 40px;
        font-weight: 800;
        color: var(--color-ink, #25221e);
        line-height: 1.1;
        margin-bottom: 4px;
    }
    .points-unit {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--color-graphite, #94928f);
    }

    /* Buttons & Indicators */
    .btn-premium-checkout {
        background: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        border: none;
        border-radius: var(--radius-buttons, 10px);
        padding: 14px 28px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.25s cubic-bezier(.34,1.56,.64,1);
        box-shadow: 0 4px 14px rgba(227, 68, 50, 0.2);
    }
    .btn-premium-checkout:hover {
        background: var(--color-deep-ember, #cf3520);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(227, 68, 50, 0.3);
    }
    .btn-premium-checkout:active {
        transform: translateY(1px);
    }
    .trust-indicator {
        font-size: 12px;
        color: var(--color-pencil, #6f6c69);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    .trust-indicator i {
        color: var(--color-cobalt-link, #0f66ae);
    }

    /* Milestone reward card */
    .reward-milestone-card {
        background: var(--color-cream, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 16px;
        padding: 24px 20px;
        height: 100%;
        transition: all 0.3s cubic-bezier(.34,1.56,.64,1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: var(--shadow-subtle, 0 4px 12px rgba(37,34,30,0.04));
    }
    .reward-milestone-card:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: var(--shadow-lg, 0 12px 28px rgba(37,34,30,0.08));
        border-color: var(--color-deep-ember, #cf3520);
    }
    .reward-milestone-card--popular {
        background: var(--color-paper, #fefdfc);
        border-color: var(--color-ember-red, #e34432);
        border-width: 2px;
        position: relative;
    }
    .reward-milestone-card--popular::after {
        content: 'RECOMMENDED';
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        font-size: 9px;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 999px;
        letter-spacing: 0.06em;
    }
    .milestone-credits {
        font-size: 12px;
        font-weight: 800;
        color: var(--color-ember-red, #e34432);
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 8px;
    }
    .milestone-title {
        font-family: var(--font-graphik), sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        margin: 0 0 10px 0;
    }
    .milestone-desc {
        font-size: 13px;
        color: var(--color-pencil, #6f6c69);
        line-height: 1.5;
        margin: 0 0 16px 0;
    }
    .milestone-lock-status {
        font-size: 12px;
        font-weight: 600;
        color: var(--color-graphite, #94928f);
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: auto;
    }
    .milestone-lock-status i {
        font-size: 11px;
    }
    .reward-milestone-card--popular .milestone-lock-status {
        color: var(--color-ember-red, #e34432);
    }

    /* Responsive */
    @media (max-width: 991px) {
        .learning-pathway-card, .luxury-calculator-wrapper {
            padding: 24px;
        }
    }
    @media (max-width: 768px) {
        .visual-progression-timeline::before {
            left: 21px;
        }
        .step-badge {
            width: 20px;
            height: 20px;
            font-size: 10px;
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
