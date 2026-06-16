@extends('frontend.layouts.main')
@section('page-body-class', 'page-topup')

@section('title', __('common.points_top_up'))

@section('main-content')
<x-breadcrumb 
    :title="__('common.top_up_points')" 
    :routes="[
        ['label' => __('common.top_up_points')]
    ]" 
/>

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
                    <h5 class="benefit-title">{{ __('common.index.unlock_courses') }}</h5>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="learning-benefit-card">
                    <span class="benefit-emoji"><i class="fas fa-book-open"></i></span>
                    <h5 class="benefit-title">{{ __('common.index.access_paths') }}</h5>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="learning-benefit-card">
                    <span class="benefit-emoji"><i class="fas fa-trophy"></i></span>
                    <h5 class="benefit-title">{{ __('common.index.earn_rewards') }}</h5>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="learning-benefit-card">
                    <span class="benefit-emoji"><i class="fas fa-chart-line"></i></span>
                    <h5 class="benefit-title">{{ __('common.index.accelerate_growth') }}</h5>
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
                            <h3 class="pathway-title">{{ __('common.index.pathways_title') }}</h3>
                            <p class="pathway-subtitle">{{ __('common.index.pathways_subtitle') }}</p>
                        </div>
                    </div>

                    <!-- Visual Progression Timeline / Grid -->
                    <div class="visual-progression-timeline">
                        <!-- Step 1: Standard -->
                        <div class="timeline-step" id="step_standard">
                            <div class="step-badge">1</div>
                            <div class="step-content">
                                <div class="step-header">
                                    <h4 class="step-title">{{ __('common.index.tier_standard_title') }}</h4>
                                    <span class="step-bonus">×1.0</span>
                                </div>
                                <p class="step-desc">{{ __('common.index.tier_standard_desc') }}</p>
                                <div class="step-range"><strong>{{ session('currency') == 'JPY' ? '1 - 79,999 ¥' : '$1 - $499' }}</strong></div>
                            </div>
                        </div>

                        <!-- Step 2: Premium -->
                        <div class="timeline-step" id="step_premium">
                            <div class="step-badge">2</div>
                            <div class="step-content">
                                <div class="step-header">
                                    <h4 class="step-title">{{ __('common.index.tier_premium_title') }}</h4>
                                    <span class="step-bonus">×2.0 {{ __('common.index.bonus') }}</span>
                                </div>
                                <p class="step-desc">{{ __('common.index.tier_premium_desc') }}</p>
                                <div class="step-range"><strong>{{ session('currency') == 'JPY' ? '80,000 - 159,999 ¥' : '$500 - $999' }}</strong></div>
                            </div>
                        </div>

                        <!-- Step 3: Elite -->
                        <div class="timeline-step" id="step_elite">
                            <div class="step-badge">3</div>
                            <div class="step-content">
                                <div class="step-header">
                                    <h4 class="step-title">{{ __('common.index.tier_elite_title') }}</h4>
                                    <span class="step-bonus">×2.5 {{ __('common.index.bonus') }}</span>
                                </div>
                                <p class="step-desc">{{ __('common.index.tier_elite_desc') }}</p>
                                <div class="step-range"><strong>{{ session('currency') == 'JPY' ? '160,000 - 239,999 ¥' : '$1,000 - $1,499' }}</strong></div>
                            </div>
                        </div>

                        <!-- Step 4: VIP -->
                        <div class="timeline-step" id="step_vip">
                            <div class="step-badge">4</div>
                            <div class="step-content">
                                <div class="step-header">
                                    <h4 class="step-title">{{ __('common.index.tier_vip_title') }}</h4>
                                    <span class="step-bonus">×3.0 {{ __('common.index.bonus') }}</span>
                                </div>
                                <p class="step-desc">{{ __('common.index.tier_vip_desc') }}</p>
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
                                    <label class="input-label-premium">{{ __('common.index.calc_label') }}</label>
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
                                        <span class="breakdown-label">{{ __('common.index.base_credits') }}</span>
                                        <span class="breakdown-value" id="base_points">0</span>
                                    </div>
                                    <div class="breakdown-row">
                                        <span class="breakdown-label">{{ __('common.index.multiplier_bonus') }}</span>
                                        <span class="breakdown-value bonus-badge" id="multiplier_display">×1</span>
                                    </div>
                                    <div class="breakdown-divider"></div>
                                    <div class="breakdown-row breakdown-total">
                                        <span class="breakdown-label">{{ __('common.index.unlocking_potential') }}</span>
                                        <span class="breakdown-value-total" id="total_points">0</span>
                                    </div>
                                </div>

                                <!-- Large Credits Display -->
                                <div class="points-display-premium mb-4">
                                    <span class="points-number" id="total_points_large">0</span>
                                    <span class="points-unit">{{ __('common.index.credits_unlocked') }}</span>
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
                                <strong>{{ session('currency') == 'JPY' ? __('common.index.credit_note_jpy') : __('common.index.credit_note_usd') }}</strong>
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

@endsection


@push('scripts')
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
@endpush
