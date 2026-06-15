@extends('frontend.layouts.main')

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

@endsection

@push('styles')
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
    @media (max-width: 480px) {
        .points-number {
            font-size: 32px;
        }
        .luxury-calculator-wrapper,
        .learning-pathway-card {
            padding: 20px 16px;
        }
        .benefit-title {
            font-size: 12px;
        }
    }
</style>
@endpush

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
