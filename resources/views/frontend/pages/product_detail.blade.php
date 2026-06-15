@extends('frontend.layouts.main')

@section('title', $product_detail->title)
@section('description', $product_detail->summary)

@section('main-content')
<x-breadcrumb
    :title="$product_detail->title"
    :routes="[
        ['label' => __('common.explore_courses'), 'url' => route('product-lists')],
        ['label' => $product_detail->title]
    ]"
/>

@php $photo = explode(',', $product_detail->photo); @endphp
<section class="course-detail">
    <span class="course-detail__glow cd-glow-mint" aria-hidden="true"></span>
    <span class="course-detail__glow cd-glow-sky" aria-hidden="true"></span>

    <div class="container">
        <div class="row g-5">
            <!-- levels & enrollment (now on the RIGHT) -->
            <div class="col-xl-7 col-lg-7 order-lg-2 cd-reveal">
                <span class="course-eyebrow"><i class="fas fa-palette"></i> {{ __('common.courses') }}</span>
                <h2 class="course-title">{{ $product_detail->title }}</h2>
                @if($product_detail->summary)
                    <p class="course-lead">{{ $product_detail->summary }}</p>
                @endif

                <div class="level-section">
                    <div class="level-section__head">
                        <h3 class="level-section__title">{{ __('common.select_level') }}</h3>
                        <span class="level-section__count">{{ count($product_detail->levels) }} {{ __('common.level') }}</span>
                    </div>

                    <!-- Level pills -->
                    <ul class="nav nav-pills level-pills" id="levelTabs" role="tablist">
                        @foreach($product_detail->levels as $key => $level)
                            <li class="nav-item" role="presentation">
                                <button class="level-pill @if($loop->first) active @endif"
                                        id="level-tab-{{ $level->id }}"
                                        data-bs-toggle="pill"
                                        data-bs-target="#level-content-{{ $level->id }}"
                                        type="button" role="tab">
                                    {{ $level->skill_level }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Tab contents -->
                    <div class="tab-content" id="levelTabsContent">
                        @foreach($product_detail->levels as $key => $level)
                            <div class="tab-pane fade @if($loop->first) show active @endif"
                                 id="level-content-{{ $level->id }}" role="tabpanel">
                                <div class="level-card">
                                    <span class="level-card__tag"><i class="fas fa-signal"></i> {{ __('common.level') }}: <strong>{{ $level->skill_level }}</strong></span>

                                    <div class="level-grid">
                                        <div class="level-info">
                                            <span class="level-info__label">{{ __('common.purpose') }}</span>
                                            <p class="level-info__text">{{ $level->purpose }}</p>
                                        </div>
                                        <div class="level-info">
                                            <span class="level-info__label">{{ __('common.outcome') }}</span>
                                            <p class="level-info__text">{{ $level->outcome }}</p>
                                        </div>
                                    </div>

                                    <div class="level-learn">
                                        <h4 class="level-learn__title"><i class="fas fa-check-circle"></i> {{ __('common.what_learn') }}</h4>
                                        <ul class="level-learn__list">
                                            @php $items = explode('.', $level->learn_info); @endphp
                                            @foreach($items as $item)
                                                @if(trim($item) != '')
                                                    <li><i class="fas fa-check"></i><span>{{ trim($item) }}</span></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="level-enroll">
                                        <div class="level-price">
                                            <span class="level-price__label">{{ __('common.points') }}</span>
                                            <span class="level-price__value">{{ number_format($level->price_in_points) }} <small>CREDS</small></span>
                                        </div>
                                        <form action="{{route('single-add-to-cart')}}" method="POST" class="enroll-form" data-product-slug="{{$product_detail->slug}}">
                                            @csrf
                                            <input type="hidden" name="quant[1]" value="1">
                                            <input type="hidden" name="slug" value="{{$product_detail->slug}}">
                                            <input type="hidden" name="price" value="{{$level->price}}">
                                            <input type="hidden" name="price_jp" value="{{$level->price_jp}}">
                                            <input type="hidden" name="price_hk" value="{{$level->price_hk}}">
                                            <input type="hidden" name="level_id" value="{{$level->id}}">
                                            <button type="submit" class="enroll-btn">
                                                {{ __('common.enroll_now') }} <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- media & overview (now on the LEFT, sticky) -->
            <div class="col-xl-5 col-lg-5 order-lg-1 cd-reveal cd-reveal--delay">
                <aside class="course-aside">
                    <div class="course-aside__media">
                        <img src="{{ asset($photo[0]) }}" alt="{{ $product_detail->title }}">
                        <span class="course-aside__badge"><i class="fas fa-palette"></i> {{ __('common.courses') }}</span>
                    </div>

                    <div class="course-aside__card">
                        <h3 class="course-aside__title">{{ __('common.course_overview') }}</h3>
                        <p class="course-aside__text">{{ $product_detail->description }}</p>

                        <ul class="course-aside__facts">
                            <li><span class="fact-ico"><i class="fas fa-layer-group"></i></span> {{ count($product_detail->levels) }} {{ __('common.level') }}</li>
                            <li><span class="fact-ico"><i class="fas fa-infinity"></i></span> {{ __('common.lifetime_access') ?? 'Lifetime access' }}</li>
                            <li><span class="fact-ico"><i class="fas fa-certificate"></i></span> {{ __('common.certificate') ?? 'Certificate of completion' }}</li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* =========================================
       COURSE DETAIL — warm theme
       ========================================= */
    .course-detail {
        position: relative;
        overflow: hidden;
        background: var(--surface-paper-canvas, #fefdfc);
        padding: 64px 0 88px;
    }
    .course-detail__glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        pointer-events: none;
        z-index: 0;
        opacity: 0.5;
    }
    .cd-glow-mint { width: 360px; height: 360px; background: var(--color-mint-wash, #f0f6df); top: -120px; left: -100px; }
    .cd-glow-sky  { width: 320px; height: 320px; background: var(--color-sky-wash, #dceaff); bottom: 4%; right: -120px; }
    .course-detail .container { position: relative; z-index: 1; }

    /* header */
    .course-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 14px;
        margin-bottom: 16px;
        border-radius: 999px;
        background: var(--color-cream, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        box-shadow: var(--shadow-subtle);
        font-family: var(--font-inter), sans-serif;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--color-deep-ember, #cf3520);
    }
    .course-eyebrow i { color: var(--color-ember-red, #e34432); }
    .course-title {
        font-family: var(--font-graphik), sans-serif;
        font-size: clamp(28px, 3.6vw, 40px);
        font-weight: var(--font-weight-bold, 700);
        line-height: 1.15;
        letter-spacing: -0.02em;
        color: var(--color-ink, #25221e);
        margin: 0 0 14px;
    }
    .course-lead {
        font-family: var(--font-inter), sans-serif;
        font-size: 16px;
        line-height: 1.7;
        color: var(--color-pencil, #6f6c69);
        margin: 0 0 36px;
        max-width: 600px;
    }

    /* level section */
    .level-section__head {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 18px;
    }
    .level-section__title {
        font-family: var(--font-graphik), sans-serif;
        font-size: 22px;
        font-weight: var(--font-weight-semibold, 600);
        color: var(--color-ink, #25221e);
        margin: 0;
    }
    .level-section__count {
        font-family: var(--font-inter), sans-serif;
        font-size: 12px;
        font-weight: 600;
        color: var(--color-deep-ember, #cf3520);
        background: rgba(227, 68, 50, 0.08);
        border-radius: 999px;
        padding: 4px 11px;
    }

    /* pills */
    .level-pills {
        display: flex;
        flex-wrap: nowrap;
        gap: 8px;
        padding: 0;
        margin: 0 0 22px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .level-pills::-webkit-scrollbar { height: 0; }
    .level-pill {
        flex-shrink: 0;
        border: 1px solid var(--color-stone, #d7d6d4);
        background: var(--color-paper, #fefdfc);
        color: var(--color-ink, #25221e);
        font-family: var(--font-inter), sans-serif;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.02em;
        padding: 9px 18px;
        border-radius: 999px;
        white-space: nowrap;
        cursor: pointer;
        transition: all 0.25s ease;
    }
    .level-pill:hover:not(.active) {
        border-color: rgba(227, 68, 50, 0.4);
        color: var(--color-deep-ember, #cf3520);
        background: rgba(227, 68, 50, 0.05);
    }
    .level-pill.active {
        background: var(--color-ember-red, #e34432);
        border-color: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        box-shadow: 0 6px 16px rgba(227, 68, 50, 0.28);
    }

    /* level card */
    .level-card {
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 18px;
        padding: 28px;
        box-shadow: var(--shadow-subtle);
    }
    .level-card__tag {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 6px 13px;
        border-radius: 999px;
        background: var(--color-mint-wash, #f0f6df);
        color: var(--color-forest, #446c3d);
        font-family: var(--font-inter), sans-serif;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 22px;
    }
    .level-card__tag strong { font-weight: 700; }

    .level-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 26px;
    }
    .level-info {
        background: var(--color-cream, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 14px;
        padding: 18px;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        position: relative;
    }
    .level-info::before {
        content: '';
        position: absolute;
        top: 0; left: 0; bottom: 0;
        width: 4px;
        border-radius: 14px 0 0 14px;
        background-color: var(--color-ember-red, #e34432);
        opacity: 0.35;
    }
    .level-info:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
        border-color: rgba(227, 68, 50, 0.35);
    }
    .level-info__label {
        display: block;
        font-family: var(--font-inter), sans-serif;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--color-deep-ember, #cf3520);
        margin-bottom: 8px;
    }
    .level-info__text {
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        line-height: 1.55;
        color: var(--color-ink, #25221e);
        margin: 0;
    }

    /* what you'll learn */
    .level-learn { margin-bottom: 26px; }
    .level-learn__title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: var(--font-graphik), sans-serif;
        font-size: 16px;
        font-weight: var(--font-weight-semibold, 600);
        color: var(--color-ink, #25221e);
        margin: 0 0 14px;
    }
    .level-learn__title i { color: var(--color-ember-red, #e34432); font-size: 15px; }
    .level-learn__list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: grid;
        gap: 8px;
    }
    .level-learn__list li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 11px 14px;
        background: var(--surface-paper-canvas, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 10px;
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        line-height: 1.5;
        color: var(--color-ink, #25221e);
        transition: border-color 0.25s ease, background 0.25s ease;
    }
    .level-learn__list li:hover {
        border-color: rgba(227, 68, 50, 0.3);
        background: var(--color-cream, #fff6f0);
    }
    .level-learn__list li i {
        color: var(--color-forest, #446c3d);
        font-size: 12px;
        margin-top: 4px;
        flex-shrink: 0;
    }

    /* enroll footer */
    .level-enroll {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding-top: 22px;
        border-top: 1px solid var(--color-stone, #d7d6d4);
    }
    .level-price__label {
        display: block;
        font-family: var(--font-inter), sans-serif;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--color-graphite, #94928f);
        margin-bottom: 2px;
    }
    .level-price__value {
        font-family: var(--font-graphik), sans-serif;
        font-size: 26px;
        font-weight: var(--font-weight-bold, 700);
        color: var(--color-ember-red, #e34432);
        line-height: 1;
    }
    .level-price__value small { font-size: 13px; font-weight: 600; color: var(--color-pencil, #6f6c69); }
    .enroll-form { flex-shrink: 0; }
    .enroll-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        border: none;
        border-radius: var(--radius-buttons, 8px);
        font-family: var(--font-inter), sans-serif;
        font-size: 15px;
        font-weight: 600;
        padding: 13px 26px;
        cursor: pointer;
        box-shadow: 0 8px 20px rgba(227, 68, 50, 0.3);
        transition: background 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
    }
    .enroll-btn:hover {
        background: var(--color-deep-ember, #cf3520);
        transform: translateY(-2px);
        box-shadow: 0 12px 26px rgba(227, 68, 50, 0.4);
    }
    .enroll-btn:disabled { opacity: 0.75; cursor: wait; transform: none; }
    .enroll-btn i { transition: transform 0.25s ease; }
    .enroll-btn:hover i { transform: translateX(4px); }

    /* =========================================
       RIGHT ASIDE
       ========================================= */
    .course-aside {
        position: sticky;
        top: 100px;
    }
    .course-aside__media {
        position: relative;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid var(--color-stone, #d7d6d4);
        box-shadow: var(--shadow-lg);
        margin-bottom: 20px;
        background: var(--color-paper, #fefdfc);
        padding: 8px; /* frame effect */
    }
    .course-aside__media img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        display: block;
        transition: transform 0.6s ease;
        border-radius: 12px;
    }
    .course-aside__media:hover img { transform: scale(1.05); }
    .course-aside__badge {
        position: absolute;
        top: 22px; left: 22px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(254, 253, 252, 0.92);
        -webkit-backdrop-filter: blur(6px);
                backdrop-filter: blur(6px);
        border: 1px solid rgba(215, 214, 212, 0.7);
        font-family: var(--font-inter), sans-serif;
        font-size: 11px;
        font-weight: 600;
        text-transform: capitalize;
        color: var(--color-ink, #25221e);
    }
    .course-aside__badge i { color: var(--color-ember-red, #e34432); font-size: 10px; }

    .course-aside__card {
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 18px;
        padding: 26px;
        box-shadow: var(--shadow-subtle);
    }
    .course-aside__title {
        font-family: var(--font-graphik), sans-serif;
        font-size: 18px;
        font-weight: var(--font-weight-semibold, 600);
        color: var(--color-ink, #25221e);
        margin: 0 0 12px;
    }
    .course-aside__text {
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        line-height: 1.7;
        color: var(--color-pencil, #6f6c69);
        margin: 0 0 20px;
    }
    .course-aside__facts {
        list-style: none;
        margin: 0;
        padding: 18px 0 0;
        border-top: 1px solid var(--color-stone, #d7d6d4);
        display: grid;
        gap: 12px;
    }
    .course-aside__facts li {
        display: flex;
        align-items: center;
        gap: 12px;
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        font-weight: 500;
        color: var(--color-ink, #25221e);
    }
    .fact-ico {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: var(--color-mint-wash, #f0f6df);
        color: var(--color-forest, #446c3d);
        font-size: 14px;
    }

    /* =========================================
       ANIMATIONS
       ========================================= */
    @keyframes cdReveal {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes cdRevealLeft {
        from { opacity: 0; transform: translateX(-24px); }
        to   { opacity: 1; transform: translateX(0); }
    }
    @keyframes cdRevealRight {
        from { opacity: 0; transform: translateX(24px); }
        to   { opacity: 1; transform: translateX(0); }
    }

    /* columns slide in from sides */
    .cd-reveal { animation: cdRevealRight 0.7s cubic-bezier(0.16, 1, 0.3, 1) both; }
    .cd-reveal--delay { animation: cdRevealLeft 0.7s cubic-bezier(0.16, 1, 0.3, 1) 0.12s both; }

    /* level card content transitions */
    .tab-pane.fade.show .level-card__tag { animation: cdReveal 0.5s ease both; }
    .tab-pane.fade.show .level-grid      { animation: cdReveal 0.5s ease 0.08s both; }
    .tab-pane.fade.show .level-learn     { animation: cdReveal 0.5s ease 0.16s both; }
    .tab-pane.fade.show .level-enroll    { animation: cdReveal 0.5s ease 0.24s both; }

    /* learn items staggering */
    .tab-pane.fade.show .level-learn__list li { animation: cdReveal 0.45s ease both; }
    .tab-pane.fade.show .level-learn__list li:nth-child(1) { animation-delay: 0.20s; }
    .tab-pane.fade.show .level-learn__list li:nth-child(2) { animation-delay: 0.26s; }
    .tab-pane.fade.show .level-learn__list li:nth-child(3) { animation-delay: 0.32s; }
    .tab-pane.fade.show .level-learn__list li:nth-child(4) { animation-delay: 0.38s; }
    .tab-pane.fade.show .level-learn__list li:nth-child(5) { animation-delay: 0.44s; }
    .tab-pane.fade.show .level-learn__list li:nth-child(n+6) { animation-delay: 0.50s; }

    /* media + facts gentle entrance */
    .course-aside__media { animation: cdReveal 0.7s cubic-bezier(0.16, 1, 0.3, 1) 0.18s both; }
    .course-aside__card  { animation: cdReveal 0.7s cubic-bezier(0.16, 1, 0.3, 1) 0.28s both; }
    .course-aside__facts li { animation: cdReveal 0.5s ease both; }
    .course-aside__facts li:nth-child(1) { animation-delay: 0.40s; }
    .course-aside__facts li:nth-child(2) { animation-delay: 0.48s; }
    .course-aside__facts li:nth-child(3) { animation-delay: 0.56s; }

    /* =========================================
       RESPONSIVE
       ========================================= */
    @media (max-width: 991px) {
        .course-detail { padding: 44px 0 64px; }
        .course-aside { position: static; top: auto; margin-top: 8px; }
        .cd-reveal, .cd-reveal--delay { animation-name: cdReveal; }
    }
    @media (max-width: 575px) {
        .level-card { padding: 20px; }
        .level-grid { grid-template-columns: 1fr; }
        .level-enroll { flex-direction: column; align-items: stretch; }
        .enroll-btn { width: 100%; justify-content: center; }
        .course-aside__media img { height: 240px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .course-aside__media img, .level-info, .enroll-btn { transition: none !important; }
        .cd-reveal, .cd-reveal--delay,
        .course-aside__media, .course-aside__card, .course-aside__facts li,
        .tab-pane.fade.show .level-card__tag,
        .tab-pane.fade.show .level-grid,
        .tab-pane.fade.show .level-learn,
        .tab-pane.fade.show .level-enroll,
        .tab-pane.fade.show .level-learn__list li {
            animation: none !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.querySelectorAll('.enroll-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const btn = this.querySelector('.enroll-btn');
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>{{ __("common.processing") ?? "Processing..." }}';

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
            btn.innerHTML = originalText;
            console.error('Error:', error);
        });
    });
});
</script>
@endpush
