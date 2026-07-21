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

<!-- POINTS TOP UP SECTION - EDITORIAL STUDIO DESIGN (mirrors index.blade.php) -->
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
