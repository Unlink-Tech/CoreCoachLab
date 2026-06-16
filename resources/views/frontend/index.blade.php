@extends('frontend.layouts.main')
@section('page-body-class', 'page-index')

@section('main-content')

<section class="af-hero">
    <!-- Decorative animated background -->
    <div class="af-hero__bg" aria-hidden="true">
        <span class="af-hero__blob af-hero__blob--ember"></span>
        <span class="af-hero__blob af-hero__blob--teal"></span>
        <span class="af-hero__blob af-hero__blob--sky"></span>
        <span class="af-hero__grid"></span>
    </div>

    <div class="auto-container af-hero__inner">
        <!-- LEFT: copy -->
        <div class="af-hero__content">
            <span class="af-hero__eyebrow">
                <span class="af-hero__eyebrow-dot"></span>
                <i class="fas fa-palette"></i> {{ $misc['Company Name'] ?? __('Artify Academy') }}
            </span>

            <h1 class="af-hero__title">{{ __('common.gal_hero_title') }}</h1>

            <p class="af-hero__subtitle">{{ __('common.gal_hero_subtitle') }}</p>

            <div class="af-hero__actions">
                <a href="{{ route('product-lists') }}" class="af-hero__btn af-hero__btn--primary">
                    {{ __('common.gal_hero_cta') }} <i class="fas fa-arrow-right"></i>
                </a>
                <a href="{{ route('product-lists') }}" class="af-hero__btn af-hero__btn--ghost">
                    <span class="af-hero__btn-play"><i class="fas fa-play"></i></span> {{ __('Watch showreel') }}
                </a>
            </div>

            <!-- Browse disciplines -->
            <div class="af-hero__disciplines">
                <span class="af-hero__disciplines-label">{{ __('Popular') }}:</span>
                <a href="{{ route('product-lists') }}" class="af-hero__chip"><i class="fas fa-pencil-alt"></i> {{ __('Sketching') }}</a>
                <a href="{{ route('product-lists') }}" class="af-hero__chip"><i class="fas fa-paint-brush"></i> {{ __('Watercolor') }}</a>
                <a href="{{ route('product-lists') }}" class="af-hero__chip"><i class="fas fa-palette"></i> {{ __('Oil Painting') }}</a>
                <a href="{{ route('product-lists') }}" class="af-hero__chip"><i class="fas fa-desktop"></i> {{ __('Digital Art') }}</a>
            </div>

            <!-- Social proof: stacked avatars + rating -->
            <div class="af-hero__trust">
                <div class="af-hero__avatars">
                    <img src="{{ asset('assets/art-classes/2.jpg') }}" alt="Student">
                    <img src="{{ asset('assets/art-classes/5.jpg') }}" alt="Student">
                    <img src="{{ asset('assets/art-classes/9.jpg') }}" alt="Student">
                    <img src="{{ asset('assets/art-classes/4.jpg') }}" alt="Student">
                </div>
                <div class="af-hero__trust-meta">
                    <span class="af-hero__stars" aria-hidden="true">★★★★★</span>
                    <span class="af-hero__trust-text">{{ __('Loved by 12,000+ creative learners') }}</span>
                </div>
            </div>
        </div>

        <!-- RIGHT: studio video + artwork collage -->
        <div class="af-hero__media">
            <div class="af-hero__collage">
                <!-- Main looping studio video -->
                <figure class="af-hero__tile af-hero__tile--video">
                    <video autoplay loop muted playsinline preload="metadata" poster="{{ asset('assets/art-classes/10.jpg') }}">
                        <source src="{{ asset('assets/art-classes/hero.mp4') }}" type="video/mp4">
                    </video>
                    <span class="af-hero__livetag"><span class="af-hero__live-dot"></span> {{ __('In the studio') }}</span>
                    <figcaption class="af-hero__caption">
                        &ldquo;{{ __('common.gal_hero_testimonial') }}&rdquo;
                    </figcaption>
                </figure>

                <!-- Stacked artwork tiles -->
                <figure class="af-hero__tile af-hero__tile--a">
                    <img src="{{ asset('assets/art-classes/3.jpg') }}" alt="Watercolor drawing artwork" loading="lazy">
                    <figcaption class="af-hero__tiletag"><i class="fas fa-pencil-alt"></i> {{ __('Sketching') }}</figcaption>
                </figure>
                <figure class="af-hero__tile af-hero__tile--b">
                    <img src="{{ asset('assets/art-classes/6.jpg') }}" alt="Oil painting artwork" loading="lazy">
                    <figcaption class="af-hero__tiletag"><i class="fas fa-palette"></i> {{ __('Oil Painting') }}</figcaption>
                </figure>
            </div>

            <!-- Floating glass "live class" card -->
            <div class="af-hero__floatcard">
                <span class="af-hero__floatcard-thumb">
                    <img src="{{ asset('assets/art-classes/1.webp') }}" alt="" loading="lazy">
                </span>
                <div class="af-hero__floatcard-body">
                    <strong>{{ __('Watercolor Masterclass') }}</strong>
                    <span><span class="af-hero__live-dot"></span> {{ __('Live now · 320 watching') }}</span>
                </div>
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
