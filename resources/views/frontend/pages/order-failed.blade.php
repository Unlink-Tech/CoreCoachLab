@extends('frontend.layouts.main')
@section('title', 'Order Failed')
@section('main-content')

<x-breadcrumb
    :title="__('common.payment_unsuccessful')"
    :routes="[['label' => __('common.failed')]]"
/>

<section class="order-status order-status--failed">
    <span class="order-status__glow os-glow-peach" aria-hidden="true"></span>
    <span class="order-status__glow os-glow-sky" aria-hidden="true"></span>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-9">
                <div class="status-card">
                    <span class="status-card__accent status-card__accent--failed" aria-hidden="true"></span>

                    <div class="text-center">
                        <div class="status-icon status-icon--error">
                            <i class="fas fa-times"></i>
                        </div>
                        <h2 class="status-title">{{ __('common.payment_error') }}</h2>
                        <p class="status-text">{{ __('common.payment_failure_message') }}</p>
                    </div>

                    <div class="status-help">
                        <h6 class="status-help__title"><i class="fas fa-lightbulb"></i> {{ __('common.what_you_can_do') }}</h6>
                        <ul class="status-help__list">
                            <li><i class="fas fa-check"></i><span>{{ __('common.check_payment_details') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('common.contact_bank') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('common.try_different_payment') }}</span></li>
                        </ul>
                    </div>

                    <div class="status-actions">
                        <a href="{{ route('home') }}" class="status-btn status-btn--primary">
                            <i class="fas fa-home"></i> {{ __('common.home') }}
                        </a>
                    </div>

                    <div class="status-note status-note--left">
                        <h6 class="status-note__title">{{ __('common.need_assistance') }}</h6>
                        <p>
                            {{ __('common.reach_out') }}
                            <a href="mailto:{{ __('common.company_email') }}">{{ __('common.company_email') }}</a>.
                            {{ __('common.we_are_here') }}
                        </p>
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
       ORDER STATUS PAGE — warm theme
       ========================================= */
    .order-status {
        position: relative;
        overflow: hidden;
        background: var(--surface-paper-canvas, #fefdfc);
        padding: 80px 0 100px;
    }
    .order-status__glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        pointer-events: none;
        z-index: 0;
        opacity: 0.55;
    }
    .os-glow-peach { width: 360px; height: 360px; background: var(--color-cream, #fff6f0); top: -120px; left: -80px; }
    .os-glow-sky   { width: 320px; height: 320px; background: var(--color-sky-wash, #dceaff); bottom: 2%; right: -100px; }
    .order-status .container { position: relative; z-index: 1; }

    /* card */
    .status-card {
        position: relative;
        overflow: hidden;
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 24px;
        padding: clamp(28px, 4vw, 56px);
        box-shadow: 0 20px 50px rgba(37, 34, 30, 0.07), 0 2px 8px rgba(37, 34, 30, 0.03);
        animation: osRise 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
    }
    .status-card__accent {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
    }
    .status-card__accent--failed { background: linear-gradient(90deg, var(--color-ember-red, #e34432), var(--color-deep-ember, #cf3520)); }

    /* icon */
    .status-icon {
        width: 110px;
        height: 110px;
        margin: 0 auto 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 50px;
        animation: osPop 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 0.1s both;
    }
    .status-icon--error {
        background: rgba(227, 68, 50, 0.10);
        border: 2px solid rgba(227, 68, 50, 0.25);
        color: var(--color-ember-red, #e34432);
    }

    .status-title {
        font-family: var(--font-graphik), sans-serif;
        font-size: clamp(26px, 3.4vw, 36px);
        font-weight: var(--font-weight-bold, 700);
        letter-spacing: -0.02em;
        color: var(--color-ink, #25221e);
        margin: 0 0 10px;
    }
    .status-text {
        font-family: var(--font-inter), sans-serif;
        font-size: 16px;
        line-height: 1.65;
        color: var(--color-pencil, #6f6c69);
        margin: 0 auto 32px;
        max-width: 520px;
    }

    /* help card */
    .status-help {
        background: var(--color-cream, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-left: 4px solid var(--color-ember-red, #e34432);
        border-radius: 14px;
        padding: 22px 24px;
        margin-bottom: 32px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .status-help:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }
    .status-help__title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: var(--font-inter), sans-serif;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: var(--color-deep-ember, #cf3520);
        margin: 0 0 14px;
    }
    .status-help__list { list-style: none; margin: 0; padding: 0; display: grid; gap: 10px; }
    .status-help__list li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        line-height: 1.5;
        color: var(--color-ink, #25221e);
    }
    .status-help__list li i { color: var(--color-forest, #446c3d); font-size: 12px; margin-top: 4px; flex-shrink: 0; }

    /* actions */
    .status-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
    }
    .status-btn {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 13px 26px;
        border-radius: var(--radius-buttons, 8px);
        font-family: var(--font-inter), sans-serif;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.25s ease;
    }
    .status-btn--primary {
        background: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-ember-red, #e34432);
        box-shadow: 0 8px 20px rgba(227, 68, 50, 0.3);
    }
    .status-btn--primary:hover { background: var(--color-deep-ember, #cf3520); color: var(--color-paper, #fefdfc); transform: translateY(-2px); box-shadow: 0 12px 26px rgba(227, 68, 50, 0.4); }

    /* note */
    .status-note {
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid var(--color-stone, #d7d6d4);
        text-align: center;
    }
    .status-note--left { text-align: left; }
    .status-note__title {
        font-family: var(--font-graphik), sans-serif;
        font-size: 15px;
        font-weight: var(--font-weight-semibold, 600);
        color: var(--color-ink, #25221e);
        margin: 0 0 8px;
    }
    .status-note p {
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        line-height: 1.6;
        color: var(--color-pencil, #6f6c69);
        margin: 0;
    }
    .status-note a { color: var(--color-cobalt-link, #0f66ae); font-weight: 600; text-decoration: none; }
    .status-note a:hover { color: var(--color-deep-ember, #cf3520); }

    @keyframes osRise { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes osPop { 0% { transform: scale(0); } 100% { transform: scale(1); } }

    @media (max-width: 575px) {
        .order-status { padding: 52px 0 64px; }
        .status-actions { flex-direction: column; }
        .status-btn { width: 100%; justify-content: center; }
    }
    @media (prefers-reduced-motion: reduce) {
        .status-card, .status-icon { animation: none !important; }
        .status-help { transition: none !important; }
    }
</style>
@endpush
