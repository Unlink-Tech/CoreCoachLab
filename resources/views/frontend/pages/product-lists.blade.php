@extends('frontend.layouts.main')
@section('page-body-class', 'page-product-lists')

@if(isset($category->title) && $category->title)
    @section('title', $category->title)
    @section('description', $category->summary)
@else
    @section('title', __('common.explore_courses'))
    @section('description', __('common.explore_courses'))
@endif

@section('main-content')
@php
    $pl_title = (isset($category->title) && $category->title) ? $category->title : __('common.explore_courses');
@endphp
<x-breadcrumb
    :title="$pl_title"
    :routes="[['label' => $pl_title]]"
/>

<!-- CATEGORY HEADER SECTION -->
@if(isset($category->title) && $category->title)
@php
    $cat_icon = 'fas fa-book-open';
    $cat_slug = strtolower($category->slug);
    if (strpos($cat_slug, 'blockchain') !== false || strpos($cat_slug, 'web3') !== false) {
        $cat_icon = 'fas fa-cubes';
    } elseif (strpos($cat_slug, 'business') !== false || strpos($cat_slug, 'strategy') !== false) {
        $cat_icon = 'fas fa-chart-line';
    } elseif (strpos($cat_slug, 'cyber') !== false || strpos($cat_slug, 'security') !== false || strpos($cat_slug, 'intelligence') !== false) {
        $cat_icon = 'fas fa-shield-alt';
    } elseif (strpos($cat_slug, 'transformation') !== false || strpos($cat_slug, 'enterprise') !== false || strpos($cat_slug, 'erp') !== false) {
        $cat_icon = 'fas fa-network-wired';
    } elseif (strpos($cat_slug, 'machine-learning') !== false || strpos($cat_slug, 'artificial') !== false || strpos($cat_slug, '-ai-') !== false || strpos($cat_slug, 'brain') !== false) {
        $cat_icon = 'fas fa-brain';
    } elseif (strpos($cat_slug, 'marketing') !== false || strpos($cat_slug, 'advertising') !== false || strpos($cat_slug, 'seo') !== false || strpos($cat_slug, 'social') !== false || strpos($cat_slug, 'search') !== false || strpos($cat_slug, 'optim') !== false) {
        $cat_icon = 'fas fa-bullhorn';
    } elseif (strpos($cat_slug, 'design') !== false || strpos($cat_slug, 'art') !== false || strpos($cat_slug, 'painting') !== false) {
        $cat_icon = 'fas fa-paint-brush';
    } elseif (strpos($cat_slug, 'data') !== false || strpos($cat_slug, 'analytics') !== false) {
        $cat_icon = 'fas fa-chart-bar';
    } elseif (strpos($cat_slug, 'development') !== false || strpos($cat_slug, 'code') !== false || strpos($cat_slug, 'programming') !== false) {
        $cat_icon = 'fas fa-code';
    }
@endphp
@php
    $pl_count = method_exists($products, 'total') ? $products->total() : count($products);
@endphp

<section class="cat-banner">
    <div class="container">
        <div class="cat-banner__card">
            {{-- Backdrop layers --}}
            <div class="cat-banner__bg" aria-hidden="true">
                @if($category->photo)
                    <img src="{{ $category->photo }}"
                         alt=""
                         class="cat-banner__bg-img">
                @else
                    <div class="cat-banner__bg-fallback">
                        <i class="{{ $cat_icon }}"></i>
                    </div>
                @endif
                <span class="cat-banner__scrim"></span>
                <span class="cat-banner__glow"></span>
            </div>

            {{-- Content overlay --}}
            <div class="cat-banner__content">
                <div class="cat-banner__top">
                    <span class="cat-banner__icon">
                        <i class="{{ $cat_icon }}"></i>
                    </span>
                    <span class="cat-banner__eyebrow">
                        <span class="cat-banner__eyebrow-dot" aria-hidden="true"></span>
                        {{ __('common.gal_category_explore') }}
                    </span>
                </div>

                <h1 class="cat-banner__title">{{ $category->title }}</h1>

                @if($category->summary)
                    <p class="cat-banner__desc">{{ $category->summary }}</p>
                @endif

                <div class="cat-banner__foot">
                    <div class="cat-banner__stat">
                        <span class="cat-banner__stat-num">{{ $pl_count }}</span>
                        <span class="cat-banner__stat-label">{{ __('common.courses') }}</span>
                    </div>
                    <a href="#catalog" class="cat-banner__cta">
                        <span>{{ __('common.view_more') }}</span>
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<section class="catalog-v2" id="catalog">
    <span class="catalog-v2__blob catalog-v2__blob--a" aria-hidden="true"></span>
    <span class="catalog-v2__blob catalog-v2__blob--b" aria-hidden="true"></span>

    <div class="container catalog-v2__inner">
        <div class="catalog-v2__heading text-center">
            <span class="catalog-v2__eyebrow">
                <span class="catalog-v2__eyebrow-dot" aria-hidden="true"></span>
                {{ __('common.gal_category_explore') }}
            </span>
            <h2 class="catalog-v2__title">{{ __('common.courses') }} {{ __('common.available') }}</h2>
            <p class="catalog-v2__lede">{{ __('common.product_lists.subtitle') }}</p>
            <span class="catalog-v2__rule" aria-hidden="true"></span>
        </div>

        <div class="catalog-v2__grid" id="course-list-container">
            @foreach($products as $course)
                <article class="catalog-v2__card course-card-item"
                         data-category="{{ $course->cat_id }}"
                         data-title="{{ strtolower($course->title) }}">
                    <a href="{{ route('product-detail', $course->slug) }}" class="catalog-v2__media" aria-label="{{ $course->title }}">
                        @if($course->photo)
                            <img src="{{ url($course->photo) }}" alt="{{ $course->title }}" loading="lazy" class="catalog-v2__img">
                        @else
                            <div class="catalog-v2__img-fallback"><i class="fas fa-book-open"></i></div>
                        @endif
                        <span class="catalog-v2__scrim" aria-hidden="true"></span>
                        <!-- @if(isset($course->levels) && count($course->levels))
                            <span class="catalog-v2__level">
                                <i class="fas fa-layer-group"></i>
                                {{ count($course->levels) }} {{ __('common.level') }}
                            </span>
                        @endif -->
                    </a>

                    <div class="catalog-v2__body">
                        <h3 class="catalog-v2__course-title">
                            <a href="{{ route('product-detail', $course->slug) }}">{{ $course->title }}</a>
                        </h3>
                        <p class="catalog-v2__desc">{{ Str::limit($course->summary, 120) }}</p>

                        <div class="catalog-v2__foot">
                            <div class="catalog-v2__price">
                                @if(isset($course->levels) && count($course->levels))
                                    @php $min_points = $course->levels->min('price_in_points'); @endphp
                                    <span class="catalog-v2__price-label">{{ __('common.product_lists.price_from') }}</span>
                                    <span class="catalog-v2__price-value">
                                        {{ number_format($min_points) }}
                                        <small>{{ __('common.account.creds') }}</small>
                                    </span>
                                @endif
                            </div>
                            <a href="{{ route('product-detail', $course->slug) }}" class="catalog-v2__cta">
                                <span>{{ __('common.product_lists.learn_button') }}</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="catalog-v2__pagination">
            {{ $products->links() }}
        </div>
    </div>
</section>

@endsection


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('catalog-search');
        const filterBtns = document.querySelectorAll('.filter-btn');
        const courseCards = document.querySelectorAll('.course-card-item');

        function filterCourses() {
            const searchQuery = searchInput.value.toLowerCase().trim();
            const activeFilter = document.querySelector('.filter-btn.active').getAttribute('data-filter');

            courseCards.forEach(card => {
                const title = card.getAttribute('data-title') || '';
                const category = card.getAttribute('data-category') || '';

                const matchesSearch = title.includes(searchQuery);
                const matchesFilter = activeFilter === 'all' || category === activeFilter;

                if (matchesSearch && matchesFilter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        if (searchInput) {
            searchInput.addEventListener('input', filterCourses);
        }

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                filterCourses();
            });
        });
    });
</script>
@endpush
