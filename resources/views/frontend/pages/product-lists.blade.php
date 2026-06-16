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
    $cat_icon = 'fas fa-palette';
    $cat_slug = strtolower($category->slug);
    if (strpos($cat_slug, 'blockchain') !== false || strpos($cat_slug, 'web3') !== false) {
        $cat_icon = 'fas fa-cubes';
    } elseif (strpos($cat_slug, 'business') !== false || strpos($cat_slug, 'strategy') !== false) {
        $cat_icon = 'fas fa-chart-line';
    } elseif (strpos($cat_slug, 'cyber') !== false || strpos($cat_slug, 'security') !== false || strpos($cat_slug, 'intelligence') !== false) {
        $cat_icon = 'fas fa-shield-alt';
    } elseif (strpos($cat_slug, 'transformation') !== false || strpos($cat_slug, 'enterprise') !== false || strpos($cat_slug, 'erp') !== false) {
        $cat_icon = 'fas fa-network-wired';
    } elseif (strpos($cat_slug, 'ai') !== false || strpos($cat_slug, 'machine') !== false || strpos($cat_slug, 'brain') !== false) {
        $cat_icon = 'fas fa-brain';
    } elseif (strpos($cat_slug, 'design') !== false || strpos($cat_slug, 'art') !== false || strpos($cat_slug, 'painting') !== false) {
        $cat_icon = 'fas fa-paint-brush';
    }
@endphp
@php
    $pl_count = method_exists($products, 'total') ? $products->total() : count($products);
@endphp
<section class="cat-hero">
    <div class="container">
        <div class="cat-hero__card" @if($category->photo) style="--cat-cover: url('{{ $category->photo }}');" @endif>
            <div class="cat-hero__media {{ $category->photo ? '' : 'cat-hero__media--plain' }}"></div>
            <div class="cat-hero__veil"></div>

            <div class="cat-hero__inner">
                <span class="cat-hero__eyebrow"><i class="{{ $cat_icon }}"></i> {{ __('common.gal_category_explore') }}</span>
                <h2 class="cat-hero__title">{{ $category->title }}</h2>
                @if($category->summary)
                     <p class="cat-hero__summary">{{ $category->summary }}</p>
                @endif
                <div class="cat-hero__stats">
                    <span class="cat-hero__chip"><i class="fas fa-graduation-cap"></i> {{ $pl_count }} {{ __('common.courses') }}</span>
                    <a href="#catalog" class="cat-hero__cta">{{ __('common.view_more') }} <i class="fas fa-arrow-down"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<section class="catalog-section" id="catalog">
    <div class="container">
        <div class="catalog-head text-center">
            <span class="catalog-head__badge">{{ __('common.gal_category_explore') }}</span>
            <h2 class="catalog-head__title">{{ __('common.courses') }} {{ __('common.available') }}</h2>
            <p class="catalog-head__sub">
                {{ __('common.product_lists.subtitle') }}
            </p>
        </div>

        <!-- 3. Dynamic Catalog Filter Toolbar -->
        <div class="catalog-toolbar mb-5">
            <div class="row align-items-center g-3">
                <div class="col-md-5 col-lg-6">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="catalog-search" class="catalog-search-control" placeholder="{{ __('common.product_lists.search_placeholder') }}">
                    </div>
                </div>
                <div class="col-md-7 col-lg-6 d-flex justify-content-md-end gap-2 flex-wrap">
                    <button class="filter-btn active" data-filter="all">{{ __('common.product_lists.all_courses') }}</button>
                    @php
                        $unique_cats = [];
                        foreach($products as $course) {
                            if($course->cat_info && !in_array($course->cat_info->id, array_keys($unique_cats))) {
                                $unique_cats[$course->cat_info->id] = $course->cat_info->title;
                            }
                        }
                    @endphp
                    @foreach($unique_cats as $cat_id => $cat_title)
                        <button class="filter-btn" data-filter="{{ $cat_id }}">{{ $cat_title }}</button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row g-4" id="course-list-container">
            @foreach($products as $course)
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 course-card-item" data-category="{{ $course->cat_id }}" data-title="{{ strtolower($course->title) }}">
                    <div class="course-tile course-tile--tint-{{ $loop->index % 3 }}">
                        <!-- Image with hover overlay -->
                        <div class="course-tile-image">
                            @if($course->photo)
                                <img src="{{ url($course->photo) }}" alt="{{ $course->title }}" class="course-tile-img" loading="lazy">
                            @else
                                <div class="course-tile-placeholder"><i class="fas fa-palette"></i></div>
                            @endif
                            <div class="course-tile-overlay">
                                <a href="{{ route('product-detail', $course->slug) }}" class="course-tile-explore">
                                    {{ __('common.view_more') }} <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="course-tile-content">
                            <div class="course-tile-meta">
                                <div class="course-tile-badge"><i class="fas fa-palette"></i></div>
                                @if(isset($course->levels) && count($course->levels))
                                    <span class="course-tile-levels"><i class="fas fa-layer-group"></i> {{ count($course->levels) }} {{ __('common.level') }}</span>
                                @endif
                            </div>

                            <h3 class="course-tile-title line-clamp-2">
                                <a href="{{ route('product-detail', $course->slug) }}">{{ $course->title }}</a>
                            </h3>

                            <p class="course-tile-desc line-clamp-2">{{ $course->summary }}</p>

                            <!-- Custom Price Display Footer -->
                            <div class="course-tile-footer">
                                <div class="course-tile-price">
                                    @if(isset($course->levels) && count($course->levels))
                                        @php
                                            $min_points = $course->levels->min('price_in_points');
                                        @endphp
                                        <span class="price-prefix">{{ __('common.product_lists.price_from') }}</span>
                                        <span class="price-value">{{ number_format($min_points) }} <small>{{ __('common.account.creds') }}</small></span>
                                    @endif
                                </div>
                                <a href="{{ route('product-detail', $course->slug) }}" class="course-tile-btn">
                                    <span>{{ __('common.product_lists.learn_button') }}</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
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
