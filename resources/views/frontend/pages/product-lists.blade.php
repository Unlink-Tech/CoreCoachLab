@extends('frontend.layouts.main')

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
                Explore our creative courses syllabus
            </p>
        </div>

        <!-- 3. Dynamic Catalog Filter Toolbar -->
        <div class="catalog-toolbar mb-5">
            <div class="row align-items-center g-3">
                <div class="col-md-5 col-lg-6">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="catalog-search" class="catalog-search-control" placeholder="Search for courses...">
                    </div>
                </div>
                <div class="col-md-7 col-lg-6 d-flex justify-content-md-end gap-2 flex-wrap">
                    <button class="filter-btn active" data-filter="all">All Courses</button>
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
                                        <span class="price-prefix">From</span>
                                        <span class="price-value">{{ number_format($min_points) }} <small>CREDS</small></span>
                                    @endif
                                </div>
                                <a href="{{ route('product-detail', $course->slug) }}" class="course-tile-btn">
                                    <span>Learn</span>
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

@push('styles')
<style>
    /* =========================================
       CATEGORY COVER HERO (magazine style)
       ========================================= */
    .cat-hero {
        background: var(--surface-paper-canvas, #fefdfc);
        padding: 32px 0 8px;
    }
    .cat-hero__card {
        position: relative;
        overflow: hidden;
        border-radius: 24px;
        min-height: 340px;
        display: flex;
        align-items: flex-end;
        border: 1px solid var(--color-stone, #d7d6d4);
        box-shadow: var(--shadow-lg);
    }
    /* generic catalog cover if no category */
    .cat-hero__media--generic {
        background: linear-gradient(135deg, var(--color-teal-dusk, #497d7e), var(--color-ember-red, #e34432));
    }
    .cat-hero__card--generic {
        background: var(--color-cream, #fff6f0);
    }
    
    /* cover image / fallback */
    .cat-hero__media {
        position: absolute;
        inset: 0;
        background-image: var(--cat-cover, none);
        background-size: cover;
        background-position: center;
        transform: scale(1.02);
        transition: transform 8s ease;
    }
    .cat-hero__card:hover .cat-hero__media { transform: scale(1.08); }
    .cat-hero__media--plain {
        background-image: none;
        background: linear-gradient(135deg, var(--color-teal-dusk, #497d7e), var(--color-ink, #25221e));
    }
    /* readability veil */
    .cat-hero__veil {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(37, 34, 30, 0.82) 0%, rgba(37, 34, 30, 0.45) 55%, rgba(37, 34, 30, 0.15) 100%),
            linear-gradient(0deg, rgba(37, 34, 30, 0.55) 0%, transparent 60%);
    }
    /* top gradient accent line */
    .cat-hero__card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        z-index: 3;
        background: linear-gradient(90deg, var(--color-ember-red, #e34432), var(--color-teal-dusk, #497d7e), var(--color-forest, #446c3d));
    }

    .cat-hero__inner {
        position: relative;
        z-index: 2;
        padding: clamp(28px, 4vw, 48px);
        max-width: 720px;
    }
    .cat-hero__eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 14px;
        margin-bottom: 16px;
        border-radius: 999px;
        background: rgba(254, 253, 252, 0.14);
        -webkit-backdrop-filter: blur(8px);
                backdrop-filter: blur(8px);
        border: 1px solid rgba(254, 253, 252, 0.25);
        font-family: var(--font-inter), sans-serif;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #fff;
    }
    .cat-hero__eyebrow i { color: #ffd9cf; }

    .cat-hero__title {
        font-family: var(--font-graphik), sans-serif;
        font-size: clamp(30px, 4.4vw, 50px);
        font-weight: var(--font-weight-bold, 700);
        line-height: 1.08;
        letter-spacing: -0.02em;
        color: #fff;
        margin: 0 0 14px;
        text-shadow: 0 2px 18px rgba(0, 0, 0, 0.25);
    }
    .cat-hero__summary {
        font-family: var(--font-inter), sans-serif;
        font-size: clamp(15px, 1.4vw, 17px);
        line-height: 1.65;
        color: rgba(255, 255, 255, 0.88);
        margin: 0 0 24px;
        max-width: 600px;
    }

    .cat-hero__stats {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
    }
    .cat-hero__chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 16px;
        border-radius: 999px;
        background: rgba(254, 253, 252, 0.16);
        -webkit-backdrop-filter: blur(8px);
                backdrop-filter: blur(8px);
        border: 1px solid rgba(254, 253, 252, 0.25);
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #fff;
    }
    .cat-hero__chip i { font-size: 13px; color: #ffd9cf; }
    .cat-hero__cta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 999px;
        background: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 8px 18px rgba(227, 68, 50, 0.4);
        transition: background 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
    }
    .cat-hero__cta:hover {
        background: var(--color-deep-ember, #cf3520);
        color: var(--color-paper, #fefdfc);
        transform: translateY(-2px);
    }
    .cat-hero__cta i { font-size: 12px; transition: transform 0.25s ease; }
    .cat-hero__cta:hover i { transform: translateY(3px); }

    /* =========================================
       CATALOG SECTION + TOOLBAR
       ========================================= */
    .catalog-section {
        background: var(--surface-paper-canvas, #fefdfc);
        padding: 56px 0 80px;
    }
    .catalog-head { margin-bottom: 48px; }
    .catalog-head__badge {
        display: inline-flex;
        align-items: center;
        font-family: var(--font-inter), sans-serif;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 6px 12px;
        border-radius: var(--radius-badges, 8px);
        background-color: var(--color-cream, #fff6f0);
        color: var(--color-deep-ember, #cf3520);
        border: 1px solid var(--color-stone, #d7d6d4);
        box-shadow: var(--shadow-subtle);
        margin-bottom: 16px;
    }
    .catalog-head__title {
        font-family: var(--font-graphik), sans-serif;
        font-size: clamp(28px, 3.6vw, 42px);
        font-weight: var(--font-weight-bold, 700);
        line-height: 1.15;
        letter-spacing: -0.02em;
        color: var(--color-ink, #25221e);
        margin: 0 0 12px;
    }
    .catalog-head__sub {
        font-family: var(--font-inter), sans-serif;
        font-size: 16px;
        line-height: 1.6;
        color: var(--color-pencil, #6f6c69);
        margin: 0 auto;
        max-width: 600px;
    }

    /* CATALOG TOOLBAR (Search & Filters) */
    .catalog-toolbar {
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 16px;
        padding: 18px 24px;
        box-shadow: var(--shadow-subtle);
    }
    .search-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
    }
    .search-icon {
        position: absolute;
        left: 16px;
        color: var(--color-graphite, #94928f);
        font-size: 14px;
        pointer-events: none;
    }
    .catalog-search-control {
        width: 100%;
        background: var(--surface-paper-canvas, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-buttons, 8px);
        padding: 11px 16px 11px 42px;
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        color: var(--color-ink, #25221e);
        transition: all 0.25s ease;
    }
    .catalog-search-control:focus {
        outline: none;
        border-color: var(--color-ember-red, #e34432);
        box-shadow: 0 0 0 3px rgba(227, 68, 50, 0.08);
    }
    .filter-btn {
        background: var(--surface-paper-canvas, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        color: var(--color-pencil, #6f6c69);
        font-family: var(--font-inter), sans-serif;
        font-size: 13px;
        font-weight: 600;
        padding: 9px 18px;
        border-radius: var(--radius-buttons, 8px);
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .filter-btn:hover {
        border-color: rgba(227, 68, 50, 0.3);
        color: var(--color-deep-ember, #cf3520);
        background: var(--color-cream, #fff6f0);
    }
    .filter-btn.active {
        background: var(--color-ember-red, #e34432);
        border-color: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        box-shadow: 0 4px 12px rgba(227, 68, 50, 0.2);
    }

    /* =========================================
       COURSE TILE
       ========================================= */
    .course-tile {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-subtle);
        padding: 18px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .course-tile:hover {
        box-shadow: rgba(37, 34, 30, 0.08) 0px 14px 28px, rgba(37, 34, 30, 0.04) 0px 4px 10px;
        transform: translateY(-6px);
    }

    /* tint variants */
    .course-tile--tint-0 {
        background-color: var(--color-cream, #fff6f0);
        border: 1px solid rgba(227, 68, 50, 0.15);
    }
    .course-tile--tint-0:hover { border-color: rgba(227, 68, 50, 0.45); }
    .course-tile--tint-1 {
        background-color: var(--color-mint-wash, #f0f6df);
        border: 1px solid rgba(68, 108, 61, 0.15);
    }
    .course-tile--tint-1:hover { border-color: rgba(68, 108, 61, 0.45); }
    .course-tile--tint-2 {
        background-color: var(--color-sky-wash, #dceaff);
        border: 1px solid rgba(15, 102, 174, 0.15);
    }
    .course-tile--tint-2:hover { border-color: rgba(15, 102, 174, 0.45); }

    /* image overlay */
    .course-tile-image {
        position: relative;
        width: 100%;
        height: 190px;
        overflow: hidden;
        border-radius: 12px;
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
    }
    .course-tile-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .course-tile:hover .course-tile-img { transform: scale(1.06); }
    .course-tile-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 42px;
        color: var(--color-deep-ember, #cf3520);
        background: var(--color-paper, #fefdfc);
    }
    .course-tile-overlay {
        position: absolute;
        inset: 0;
        background: rgba(37, 34, 30, 0.62);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        -webkit-backdrop-filter: blur(2px);
                backdrop-filter: blur(2px);
    }
    .course-tile:hover .course-tile-overlay { opacity: 1; }
    .course-tile-explore {
        background: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        padding: 10px 18px;
        border-radius: var(--radius-buttons, 8px);
        font-family: var(--font-inter), sans-serif;
        font-weight: 600;
        font-size: 13px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 12px rgba(227, 68, 50, 0.25);
        transform: translateY(6px);
        transition: all 0.3s ease;
    }
    .course-tile:hover .course-tile-explore { transform: translateY(0); }
    .course-tile-explore:hover {
        background: var(--color-deep-ember, #cf3520);
        color: var(--color-paper, #fefdfc);
    }

    /* content */
    .course-tile-content {
        padding: 18px 2px 2px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .course-tile-meta {
        display: flex;
        align-items: center;
        margin-bottom: 14px;
    }
    .course-tile-badge {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        background: var(--color-paper, #fefdfc);
        box-shadow: var(--shadow-subtle);
        transition: all 0.3s ease;
    }
    .course-tile--tint-0 .course-tile-badge { color: var(--color-deep-ember, #cf3520); border: 1px solid rgba(227, 68, 50, 0.25); }
    .course-tile--tint-1 .course-tile-badge { color: var(--color-forest, #446c3d); border: 1px solid rgba(68, 108, 61, 0.25); }
    .course-tile--tint-2 .course-tile-badge { color: var(--color-cobalt-link, #0f66ae); border: 1px solid rgba(15, 102, 174, 0.25); }
    
    .course-tile-levels {
        margin-left: auto;
        font-family: var(--font-inter), sans-serif;
        font-size: 11px;
        font-weight: 600;
        color: var(--color-pencil, #6f6c69);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .course-tile-title {
        font-family: var(--font-graphik), sans-serif;
        font-size: 17px;
        font-weight: 700;
        line-height: 1.32;
        margin: 0 0 10px;
    }
    .course-tile-title a {
        color: var(--color-ink, #25221e);
        text-decoration: none;
        transition: color 0.25s ease;
    }
    .course-tile-title a:hover { color: var(--color-deep-ember, #cf3520); }

    .course-tile-desc {
        font-family: var(--font-inter), sans-serif;
        font-size: 13px;
        line-height: 1.55;
        color: var(--color-pencil, #6f6c69);
        margin: 0 0 18px 0;
    }

    /* Course Tile Footer Details */
    .course-tile-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        padding-top: 14px;
        border-top: 1px dashed var(--color-stone, #d7d6d4);
    }
    .course-tile-price {
        display: flex;
        flex-direction: column;
    }
    .price-prefix {
        font-family: var(--font-inter), sans-serif;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--color-graphite, #94928f);
    }
    .price-value {
        font-family: var(--font-graphik), sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: var(--color-ember-red, #e34432);
    }
    .price-value small {
        font-size: 11px;
        font-weight: 600;
        color: var(--color-pencil, #6f6c69);
    }
    .course-tile-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-family: var(--font-inter), sans-serif;
        font-size: 12px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        text-decoration: none;
        transition: color 0.2s ease, transform 0.2s ease;
    }
    .course-tile-btn i {
        font-size: 10px;
        transition: transform 0.2s ease;
    }
    .course-tile:hover .course-tile-btn {
        color: var(--color-ember-red, #e34432);
    }
    .course-tile:hover .course-tile-btn i {
        transform: translateX(3px);
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* =========================================
       PAGINATION
       ========================================= */
    .catalog-section .pagination { gap: 6px; }
    .catalog-section .page-link {
        color: var(--color-ink, #25221e);
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-buttons, 8px) !important;
        font-family: var(--font-inter), sans-serif;
        font-weight: 500;
        padding: 9px 15px;
        transition: all 0.2s ease;
    }
    .catalog-section .page-link:hover {
        color: var(--color-deep-ember, #cf3520);
        background: rgba(227, 68, 50, 0.06);
        border-color: rgba(227, 68, 50, 0.3);
        box-shadow: none;
    }
    .catalog-section .page-item.active .page-link {
        background: var(--color-ember-red, #e34432);
        border-color: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        box-shadow: 0 4px 12px rgba(227, 68, 50, 0.28);
    }
    .catalog-section .page-item.disabled .page-link {
        color: var(--color-graphite, #94928f);
        background: var(--color-paper, #fefdfc);
        border-color: var(--color-stone, #d7d6d4);
        opacity: 0.6;
    }

    /* =========================================
       RESPONSIVE
       ========================================= */
    #catalog { scroll-margin-top: 90px; }

    @media (max-width: 768px) {
        .cat-hero { padding: 20px 0 4px; }
        .cat-hero__card { min-height: 300px; border-radius: 18px; }
        .cat-hero__veil {
            background: linear-gradient(0deg, rgba(37, 34, 30, 0.85) 0%, rgba(37, 34, 30, 0.3) 70%, rgba(37, 34, 30, 0.15) 100%);
        }
        .catalog-section { padding: 40px 0 56px; }
        .course-tile:hover { transform: translateY(-4px); }
        .course-tile-image { height: 170px; }
        .cat-hero__stats { gap: 10px; }
        .cat-hero__cta, .cat-hero__chip { font-size: 13px; }
        .catalog-toolbar { padding: 14px 16px; }
    }

    @media (prefers-reduced-motion: reduce) {
        .course-tile,
        .course-tile-img,
        .cat-hero__media { transition: none !important; }
        .course-tile:hover { transform: none !important; }
        .cat-hero__card:hover .cat-hero__media { transform: scale(1.02) !important; }
    }
</style>
@endpush

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
