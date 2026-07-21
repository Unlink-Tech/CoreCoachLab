@extends('frontend.layouts.main')
@section('page-body-class', 'page-product_detail')

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

@php
    $photo = explode(',', $product_detail->photo);
    $min_credits = 0;
    if(isset($product_detail->levels) && count($product_detail->levels)) {
        $min_credits = $product_detail->levels->min('price_in_points');
    }
@endphp

{{-- ============================================================
     HERO — editorial split with copy left, offset postcard right
     ============================================================ --}}
<section class="pd-hero">
    <span class="pd-hero__blob pd-hero__blob--a" aria-hidden="true"></span>
    <span class="pd-hero__blob pd-hero__blob--b" aria-hidden="true"></span>

    <div class="container pd-hero__inner">
        <div class="pd-hero__grid">
            {{-- LEFT: Copy --}}
            <div class="pd-hero__copy">
                <span class="pd-eyebrow">
                    <span class="pd-eyebrow__dot" aria-hidden="true"></span>
                    {{ __('common.courses') }}
                </span>
                <h1 class="pd-hero__title">{{ $product_detail->title }}</h1>
                @if($product_detail->summary)
                    <p class="pd-hero__lede">{{ $product_detail->summary }}</p>
                @endif

                <div class="pd-hero__meta">
                    <div class="pd-hero__stat">
                        <span class="pd-hero__stat-num">{{ count($product_detail->levels) }}</span>
                        <span class="pd-hero__stat-label">{{ __('common.level') }}</span>
                    </div>
                    @if($min_credits > 0)
                        <div class="pd-hero__stat pd-hero__stat--split">
                            <span class="pd-hero__stat-num">{{ number_format($min_credits) }}</span>
                            <span class="pd-hero__stat-label">{{ __('common.product_lists.price_from') }} · {{ __('common.account.creds') }}</span>
                        </div>
                    @endif
                    <a href="#pd-levels" class="pd-hero__cta">
                        <span>{{ __('common.enroll_now') }}</span>
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </div>
            </div>

            {{-- RIGHT: Media --}}
            <div class="pd-hero__media">
                <span class="pd-hero__media-back" aria-hidden="true"></span>
                <div class="pd-hero__media-frame">
                    <img src="{{ asset($photo[0]) }}" alt="{{ $product_detail->title }}" class="pd-hero__img">
                    <span class="pd-hero__media-scrim" aria-hidden="true"></span>
                    <span class="pd-hero__media-tag">
                        <span class="pd-hero__media-dot" aria-hidden="true"></span>
                        {{ __('common.courses') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     OVERVIEW — centered readable column
     ============================================================ --}}
@if($product_detail->description)
<section class="pd-overview">
    <div class="auto-container pd-overview__inner">
        <div class="pd-overview__heading">
            <span class="pd-eyebrow pd-eyebrow--center">
                <span class="pd-eyebrow__dot" aria-hidden="true"></span>
                {{ __('common.course_overview') }}
            </span>
            <h2 class="pd-overview__title">{{ __('common.course_overview') }}</h2>
            <span class="pd-overview__rule" aria-hidden="true"></span>
        </div>
        <div class="pd-overview__body">
            {!! nl2br(e($product_detail->description)) !!}
        </div>
    </div>
</section>
@endif

{{-- ============================================================
     LEVELS & ENROLL — dark selector card with segmented tabs
     ============================================================ --}}
<section class="pd-levels" id="pd-levels">
    <span class="pd-levels__blob pd-levels__blob--a" aria-hidden="true"></span>

    <div class="auto-container pd-levels__inner">
        <div class="pd-levels__heading text-center">
            <span class="pd-eyebrow pd-eyebrow--center">
                <span class="pd-eyebrow__dot" aria-hidden="true"></span>
                {{ __('common.select_level') }}
            </span>
            <h2 class="pd-levels__title">{{ __('common.select_level') }}</h2>
            <p class="pd-levels__lede">
                {{ count($product_detail->levels) }} {{ __('common.level') }}
            </p>
        </div>

        {{-- Segmented level tabs --}}
        <ul class="nav nav-pills pd-tabs" id="levelTabs" role="tablist">
            @foreach($product_detail->levels as $key => $level)
                <li class="nav-item" role="presentation">
                    <button class="pd-tab @if($loop->first) active @endif"
                            id="level-tab-{{ $level->id }}"
                            data-bs-toggle="pill"
                            data-bs-target="#level-content-{{ $level->id }}"
                            type="button" role="tab">
                        <span class="pd-tab__num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="pd-tab__label">{{ $level->skill_level }}</span>
                    </button>
                </li>
            @endforeach
        </ul>

        <div class="tab-content pd-tab-content" id="levelTabsContent">
            @foreach($product_detail->levels as $key => $level)
                <div class="tab-pane fade @if($loop->first) show active @endif"
                     id="level-content-{{ $level->id }}" role="tabpanel">
                    <article class="pd-level">

                        {{-- Head --}}
                        <div class="pd-level__head">
                            <span class="pd-level__tag">
                                <i class="fas fa-signal"></i>
                                {{ __('common.level') }} · <strong>{{ $level->skill_level }}</strong>
                            </span>
                        </div>

                        {{-- Purpose + Outcome --}}
                        <div class="pd-level__grid">
                            <div class="pd-level__cell">
                                <span class="pd-level__cell-label">
                                    <i class="fas fa-compass"></i>
                                    {{ __('common.purpose') }}
                                </span>
                                <p class="pd-level__cell-text">{{ $level->purpose }}</p>
                            </div>
                            <div class="pd-level__cell">
                                <span class="pd-level__cell-label">
                                    <i class="fas fa-trophy"></i>
                                    {{ __('common.outcome') }}
                                </span>
                                <p class="pd-level__cell-text">{{ $level->outcome }}</p>
                            </div>
                        </div>

                        {{-- What you'll learn --}}
                        <div class="pd-level__learn">
                            <h4 class="pd-level__learn-title">
                                <i class="fas fa-check-circle"></i>
                                {{ __('common.what_learn') }}
                            </h4>
                            <ul class="pd-level__learn-list">
                                @php $items = explode('.', $level->learn_info); @endphp
                                @foreach($items as $item)
                                    @if(trim($item) != '')
                                        <li>
                                            <span class="pd-level__learn-check"><i class="fas fa-check"></i></span>
                                            <span>{{ trim($item) }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        {{-- Enroll bar --}}
                        <div class="pd-level__enroll">
                            <div class="pd-level__price">
                                <span class="pd-level__price-label">{{ __('common.points') }}</span>
                                <span class="pd-level__price-value">
                                    {{ number_format($level->price_in_points) }}
                                    <small>{{ __('common.account.creds') }}</small>
                                </span>
                            </div>
                            <form action="{{route('single-add-to-cart')}}" method="POST" class="enroll-form" data-product-slug="{{$product_detail->slug}}">
                                @csrf
                                <input type="hidden" name="quant[1]" value="1">
                                <input type="hidden" name="slug" value="{{$product_detail->slug}}">
                                <input type="hidden" name="price" value="{{$level->price}}">
                                <input type="hidden" name="price_jp" value="{{$level->price_jp}}">
                                <input type="hidden" name="price_hk" value="{{$level->price_hk}}">
                                <input type="hidden" name="level_id" value="{{$level->id}}">
                                <button type="submit" class="enroll-btn pd-level__enroll-btn">
                                    <span>{{ __('common.enroll_now') }}</span>
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </form>
                        </div>

                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection


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
