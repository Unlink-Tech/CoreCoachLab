@extends('frontend.layouts.main')

@section('title', __('common.points_top_up'))

@section('main-content')
<div class="tl-breadcrumb topup-banner pt-60 pb-60">
    <video autoplay muted loop playsinline>
        <source src="{{ asset('assets/images/breadcrumb.mp4') }}" type="video/mp4">
    </video>
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.top_up_points') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.top_up_points') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- POINTS TOP UP SECTION - PREMIUM LUXURY DESIGN -->
<section class="points-topup-section pt-120 pb-120" id="topup">
    <div class="auto-container">
        <div class="text-center mb-5">
            <span class="modern-badge">{{ __('common.points_top_up') }}</span>
            <h2 class="modern-h2 mt-3">{{ __('common.maximize_value') }}</h2>
            <p class="text-muted mx-auto mt-3" style="max-width: 600px;">
                {{ __('common.topup_description') }}
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
                            <h3 class="tier-title">{{ __('common.tier_rewards') }}</h3>
                            <p class="tier-subtitle">{{ __('common.bigger_purchases') }}</p>
                        </div>
                    </div>

                    <!-- Tier Cards Grid -->

                    @if(session('currency') == 'JPY')
                    <div class="tier-cards-grid">
                        <!-- Tier 1 -->
                        <div class="tier-card tier-card-1">
                            <div class="tier-badge-large">1</div>
                            <h4 class="tier-card-label">{{ __('common.tier_standard') }}</h4>
                            <div class="tier-range-text"><strong>1 - 79,999 ¥</strong></div>
                            <div class="tier-multiplier">
                                <span class="multiplier-text">×1</span>
                                <span class="multiplier-label">{{ __('common.bonus') }}</span>
                            </div>
                            <div class="tier-indicator-bar">
                                <div class="tier-indicator-fill" style="width: 0%;"></div>
                            </div>
                        </div>

                        <!-- Tier 2 -->
                        <div class="tier-card tier-card-2">
                            <div class="tier-badge-large tier-badge-premium">2</div>
                            <h4 class="tier-card-label">{{ __('common.tier_premium') }}</h4>
                            <div class="tier-range-text"><strong>80,000 - 159,999 ¥</strong></div>
                            <div class="tier-multiplier">
                                <span class="multiplier-text multiplier-active">×2</span>
                                <span class="multiplier-label">{{ __('common.bonus') }}</span>
                            </div>
                            <div class="tier-indicator-bar">
                                <div class="tier-indicator-fill" style="width: 50%;"></div>
                            </div>
                        </div>

                        <!-- Tier 3 -->
                        <div class="tier-card tier-card-3">
                            <div class="tier-badge-large tier-badge-elite">3</div>
                            <h4 class="tier-card-label">{{ __('common.tier_elite') }}</h4>
                            <div class="tier-range-text"><strong>160,000 - 239,999 ¥</strong></div>
                            <div class="tier-multiplier">
                                <span class="multiplier-text multiplier-active">×2.5</span>
                                <span class="multiplier-label">{{ __('common.bonus') }}</span>
                            </div>
                            <div class="tier-indicator-bar">
                                <div class="tier-indicator-fill" style="width: 75%;"></div>
                            </div>
                        </div>

                        <!-- Tier 4 -->
                        <div class="tier-card tier-card-4">
                            <div class="tier-badge-large tier-badge-vip">4</div>
                            <h4 class="tier-card-label">{{ __('common.tier_vip') }}</h4>
                            <div class="tier-range-text"><strong>240,000+ ¥</strong></div>
                            <div class="tier-multiplier">
                                <span class="multiplier-text multiplier-active">×3</span>
                                <span class="multiplier-label">{{ __('common.bonus') }}</span>
                            </div>
                            <div class="tier-indicator-bar">
                                <div class="tier-indicator-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="currency-note"><strong>{{ __('common.jpy_conversion_note') }}</strong></div>
                    @else
                    <div class="tier-cards-grid">
                        <!-- Tier 1 -->
                        <div class="tier-card tier-card-1">
                            <div class="tier-badge-large">1</div>
                            <h4 class="tier-card-label">{{ __('common.tier_standard') }}</h4>
                            <div class="tier-range-text"><strong>$1 - $499</strong></div>
                            <div class="tier-multiplier">
                                <span class="multiplier-text">×1</span>
                                <span class="multiplier-label">{{ __('common.bonus') }}</span>
                            </div>
                            <div class="tier-indicator-bar">
                                <div class="tier-indicator-fill" style="width: 0%;"></div>
                            </div>
                        </div>

                        <!-- Tier 2 -->
                        <div class="tier-card tier-card-2">
                            <div class="tier-badge-large tier-badge-premium">2</div>
                            <h4 class="tier-card-label">{{ __('common.tier_premium') }}</h4>
                            <div class="tier-range-text"><strong>$500 - $999</strong></div>
                            <div class="tier-multiplier">
                                <span class="multiplier-text multiplier-active">×2</span>
                                <span class="multiplier-label">{{ __('common.bonus') }}</span>
                            </div>
                            <div class="tier-indicator-bar">
                                <div class="tier-indicator-fill" style="width: 50%;"></div>
                            </div>
                        </div>

                        <!-- Tier 3 -->
                        <div class="tier-card tier-card-3">
                            <div class="tier-badge-large tier-badge-elite">3</div>
                            <h4 class="tier-card-label">{{ __('common.tier_elite') }}</h4>
                            <div class="tier-range-text"><strong>$1,000 - $1,499</strong></div>
                            <div class="tier-multiplier">
                                <span class="multiplier-text multiplier-active">×2.5</span>
                                <span class="multiplier-label">{{ __('common.bonus') }}</span>
                            </div>
                            <div class="tier-indicator-bar">
                                <div class="tier-indicator-fill" style="width: 75%;"></div>
                            </div>
                        </div>

                        <!-- Tier 4 -->
                        <div class="tier-card tier-card-4">
                            <div class="tier-badge-large tier-badge-vip">4</div>
                            <h4 class="tier-card-label">{{ __('common.tier_vip') }}</h4>
                            <div class="tier-range-text"><strong>$1,500+</strong></div>
                            <div class="tier-multiplier">
                                <span class="multiplier-text multiplier-active">×3</span>
                                <span class="multiplier-label">{{ __('common.bonus') }}</span>
                            </div>
                            <div class="tier-indicator-bar">
                                <div class="tier-indicator-fill" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="currency-note"><strong>{{ __('common.usd_conversion_note') }}</strong></div>
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
                                <h2 class="calc-title-premium">{{ __('common.instant_recharge') }}</h2>
                                <p class="calc-tagline">{{ __('common.get_more_points_faster') }}</p>
                            </div>
                            <div class="calc-currency-badge"><strong>{{ session('currency') == 'JPY' ? '¥' : '$' }}</strong></div>
                        </div>

                        <!-- Main Form -->
                        <form action="{{ route('points.add-to-cart') }}" method="POST" class="luxury-calc-form">
                            @csrf

                            <!-- Amount Input with Premium Styling -->
                            <div class="premium-input-section">
                                <label class="input-label-premium">{{ __('common.how_much_would_you_like') }}</label>
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

                            <!-- Points Breakdown Card -->
                            <div class="points-breakdown-card">
                                <div class="breakdown-row">
                                    <span class="breakdown-label">{{ __('common.base_points') }}</span>
                                    <span class="breakdown-value" id="base_points">0</span>
                                </div>
                                <div class="breakdown-row">
                                    <span class="breakdown-label">{{ __('common.tier_bonus') }}</span>
                                    <span class="breakdown-value bonus-badge" id="multiplier_display">×1</span>
                                </div>
                                <div class="breakdown-divider"></div>
                                <div class="breakdown-row breakdown-total">
                                    <span class="breakdown-label">{{ __('common.youll_get') }}</span>
                                    <span class="breakdown-value-total" id="total_points">0</span>
                                </div>
                            </div>

                            <!-- Large Points Display -->
                            <div class="points-display-premium">
                                <span class="points-number" id="total_points_large">0</span>
                                <span class="points-unit">{{ __('common.points') }}</span>
                            </div>

                            <!-- Benefits Checklist -->
                            <div class="benefits-section">
                                <div class="benefit-item">
                                    <i class="fas fa-bolt"></i>
                                    <span>{{ __('common.instant_credit') }}</span>
                                </div>
                                <div class="benefit-item">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>{{ __('common.secure_100percent') }}</span>
                                </div>
                                <div class="benefit-item">
                                    <i class="fas fa-unlock"></i>
                                    <span>{{ __('common.gal_calc_benefit_lifetime') }}</span>
                                </div>
                            </div>

                            <!-- Premium Button -->
                            <button type="submit" class="btn-premium-checkout">
                                <span class="btn-label">{{ __('common.add_to_cart') }}</span>
                                <span class="btn-icon"><i class="fas fa-arrow-right"></i></span>
                                <span class="btn-shine"></span>
                            </button>
                        </form>
                        <!-- Dynamic Currency Conversion Note -->
                        <div class="currency-note-calc mt-3 mb-3 text-center" style="font-size: 12px; color: #666; font-weight: 600;">
                            <strong>{{ session('currency') == 'JPY' ? '*160 JPY = 1 Credit' : '*1 USD = 1 Credit' }}</strong>
                        </div>

                        <!-- Trust Badge -->
                        <div class="trust-indicator">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('common.trusted_by_thousands') }}</span>
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

    /* ============================================
       RESPONSIVE DESIGN
       ============================================ */

    @media (max-width: 768px) {
        .bonus-multipliers-card,
        .calculator-content {
            padding: 28px 20px;
        }

        .calculator-title {
            font-size: 24px;
        }

        .calc-number-input {
            font-size: 28px;
        }

        #total_points_large {
            font-size: 36px;
        }

        .bonus-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .tiers-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .bonus-multipliers-card,
        .calculator-content {
            padding: 20px 16px;
        }

        .calculator-title {
            font-size: 20px;
        }

        .calc-number-input {
            font-size: 24px;
        }

        #total_points_large {
            font-size: 32px;
        }

        .tiers-grid {
            grid-template-columns: 1fr;
        }

        .recharge-submit-btn {
            flex-direction: column;
            gap: 8px;
        }

        .btn-arrow {
            display: none;
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

            // Update displays
            basePointsDisplay.textContent = basePoints.toLocaleString();
            multiplierDisplay.textContent = '×' + multiplier;
            totalPointsDisplay.textContent = totalPoints.toLocaleString();
            totalPointsLarge.textContent = totalPoints.toLocaleString();
        }

        amountInput.addEventListener('input', calculatePoints);
        amountInput.addEventListener('change', calculatePoints);
    });
</script>
@endpush

