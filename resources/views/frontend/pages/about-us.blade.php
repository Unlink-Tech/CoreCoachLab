@extends('frontend.layouts.main')
@section('page-body-class', 'page-about-us')
@section('title','About Us')
@section('main-content')

<x-breadcrumb
    :title="__('common.header.about')"
    :routes="[
        ['label' => __('common.header.about')]
    ]"
/>

{{-- ============================================================
     HERO — matches home page about-info--new layout (photo collage)
     ============================================================ --}}
<section class="about-info about-info--new pt-120 pb-120">
    <div class="auto-container">
        <div class="about-info--new__grid">

            {{-- LEFT: Content (badge + title + description from earlier About Us page) --}}
            <div class="about-info--new__left">
                <!-- <span class="modern-badge mb-3">{{ __('common.gal_about_section_badge') }}</span> -->
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
            </div>

            {{-- RIGHT: Category Bento Grid --}}
            <div class="abt-bento">
                <div class="abt-bento__card abt-bento__card--tall">
                    <img src="{{ asset('assets/images/yoga.webp') }}" alt="Yoga">
                    <div class="abt-bento__overlay">
                        <span class="abt-bento__label"><i class="fas fa-spa"></i> Yoga</span>
                    </div>
                </div>
                <div class="abt-bento__card">
                    <img src="{{ asset('assets/images/strength.webp') }}" alt="Strength">
                    <div class="abt-bento__overlay">
                        <span class="abt-bento__label"><i class="fas fa-dumbbell"></i> Strength</span>
                    </div>
                </div>
                <div class="abt-bento__card">
                    <img src="{{ asset('assets/images/calm.webp') }}" alt="Calm">
                    <div class="abt-bento__overlay">
                        <span class="abt-bento__label"><i class="fas fa-peace"></i> Calm</span>
                    </div>
                </div>
                <div class="abt-bento__card abt-bento__card--wide">
                    <img src="{{ asset('assets/images/diet.webp') }}" alt="Diet">
                    <div class="abt-bento__overlay">
                        <span class="abt-bento__label"><i class="fas fa-leaf"></i> Diet</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     PILLARS — 4 numbered editorial cards
     ============================================================ --}}
<section class="abt-pillars pt-120 pb-120">
    <div class="auto-container">

        @php
            $pillars = [
                ['icon' => 'fas fa-user-tie',      'title_key' => 'common.about.pillar_1_title', 'desc_key' => 'common.about.pillar_1_description', 'num' => '01', 'tint' => 0],
                ['icon' => 'fas fa-book-open',     'title_key' => 'common.about.pillar_2_title', 'desc_key' => 'common.about.pillar_2_description', 'num' => '02', 'tint' => 1],
                ['icon' => 'fas fa-paint-brush',   'title_key' => 'common.about.pillar_3_title', 'desc_key' => 'common.about.pillar_3_description', 'num' => '03', 'tint' => 2],
                ['icon' => 'fas fa-graduation-cap','title_key' => 'common.about.pillar_4_title', 'desc_key' => 'common.about.pillar_4_description', 'num' => '04', 'tint' => 3],
            ];
        @endphp

        <div class="abt-pillars__grid">
            @foreach($pillars as $p)
                <article class="abt-pillar abt-pillar--tint-{{ $p['tint'] }}">
                    <span class="abt-pillar__accent" aria-hidden="true"></span>
                    <span class="abt-pillar__number" aria-hidden="true">{{ $p['num'] }}</span>
                    <div class="abt-pillar__icon">
                        <i class="{{ $p['icon'] }}"></i>
                    </div>
                    <h3 class="abt-pillar__title">{{ __($p['title_key']) }}</h3>
                    <p class="abt-pillar__desc">{{ __($p['desc_key']) }}</p>
                </article>
            @endforeach
        </div>

    </div>
</section>

{{-- ============================================================
     WHAT YOU'LL LEARN — 5 numbered curriculum cards
     ============================================================ --}}
<section class="abt-learn pt-120 pb-120">
    <span class="abt-learn__blob abt-learn__blob--a" aria-hidden="true"></span>

    <div class="auto-container abt-learn__inner">
        <div class="abt-learn__heading text-center mb-5">
            <!-- <span class="modern-badge">{{ __('common.about.learn_section_badge') }}</span> -->
            <h2 class="abt-learn__title mt-3">{{ __('common.about.learn_section_title') }}</h2>
            <p class="abt-learn__lede mt-3">{{ __('common.about.learn_section_subtitle') }}</p>
        </div>

        @php
            $topics = [
                ['num' => '01', 'title_key' => 'common.about.learn_1_title', 'desc_key' => 'common.about.learn_1_desc'],
                ['num' => '02', 'title_key' => 'common.about.learn_2_title', 'desc_key' => 'common.about.learn_2_desc'],
                ['num' => '03', 'title_key' => 'common.about.learn_3_title', 'desc_key' => 'common.about.learn_3_desc'],
                ['num' => '04', 'title_key' => 'common.about.learn_4_title', 'desc_key' => 'common.about.learn_4_desc'],
                ['num' => '05', 'title_key' => 'common.about.learn_5_title', 'desc_key' => 'common.about.learn_5_desc'],
            ];
        @endphp

        <ol class="abt-learn__list">
            @foreach($topics as $t)
                <li class="abt-learn__item">
                    <span class="abt-learn__num">{{ $t['num'] }}</span>
                    <div class="abt-learn__body">
                        <h3 class="abt-learn__topic">{{ __($t['title_key']) }}</h3>
                        <p class="abt-learn__desc">{{ __($t['desc_key']) }}</p>
                    </div>
                    <span class="abt-learn__spark" aria-hidden="true"></span>
                </li>
            @endforeach
        </ol>
    </div>
</section>

{{-- ============================================================
     WHY CHOOSE Core Coach Lab? — Left copy + 6 checkmark features
     ============================================================ --}}
<section class="abt-why pt-120 pb-120">
    <span class="abt-why__blob abt-why__blob--a" aria-hidden="true"></span>
    <span class="abt-why__blob abt-why__blob--b" aria-hidden="true"></span>

    <div class="auto-container abt-why__inner">
        <div class="abt-why__grid">
            {{-- LEFT: heading --}}
            <div class="abt-why__copy">
                <!-- <span class="modern-badge">{{ __('common.about.why_choose_badge') }}</span> -->
                <h2 class="abt-why__title mt-3">{{ __('common.about.why_choose_title') }}</h2>
                <p class="abt-why__lede mt-3">{{ __('common.about.why_choose_subtitle') }}</p>
                <span class="abt-why__rule" aria-hidden="true"></span>
            </div>

            {{-- RIGHT: 6 checkmark features (2-col grid) --}}
            <ul class="abt-why__features">
                @foreach([
                    'common.about.why_choose_1',
                    'common.about.why_choose_2',
                    'common.about.why_choose_3',
                    'common.about.why_choose_4',
                    'common.about.why_choose_5',
                    'common.about.why_choose_6',
                ] as $key)
                    <li class="abt-why__feature">
                        <span class="abt-why__check"><i class="fas fa-check"></i></span>
                        <span class="abt-why__label">{{ __($key) }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

@endsection
