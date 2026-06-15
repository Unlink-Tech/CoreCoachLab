@extends('frontend.layouts.main')

@if(isset($category->title) && $category->title)
    @section('title', $category->title)
    @section('description', $category->summary)
@else
    @section('title', __('common.explore_courses'))
    @section('description', __('common.explore_courses'))
@endif

@section('main-content')
<div class="tl-breadcrumb about-banner pt-60 pb-60">
    <video autoplay muted loop playsinline>
        <source src="{{ asset('assets/images/breadcrumb.mp4') }}" type="video/mp4">
    </video>
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">
                    @if(isset($category->title) && $category->title)
                        {{$category->title}}
                    @else
                        {{ __('common.explore_courses') }}
                    @endif
                </h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>
                            @if(isset($category->title) && $category->title)
                                {{$category->title}}
                            @else
                                {{ __('common.explore_courses') }}
                            @endif
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- CATEGORY HEADER SECTION -->
@if(isset($category->title) && $category->title)
<section class="category-header-section pt-80 pb-40" style="background: linear-gradient(135deg, #f0f4ff 0%, #e8f1f9 100%);">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Category Image -->
            @if($category->photo)
            <div class="col-lg-4 col-md-5">
                <div class="category-header-image" style="border-radius: 20px; overflow: hidden; box-shadow: 0 30px 80px rgba(21, 145, 220, 0.15); border: 2px solid rgba(21, 145, 220, 0.1);">
                    <img src="{{ $category->photo }}" alt="{{ $category->title }}" class="w-100" style="display: block; transition: transform 0.4s ease;">
                </div>
            </div>
            @endif

            <!-- Category Info -->
            <div class="col-lg-8 col-md-7">
                <span class="modern-badge mb-3" style="font-size: 11px; font-weight: 700; color: #1591DC; background: rgba(21, 145, 220, 0.08); padding: 8px 14px; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block;">{{ __('common.gal_category_explore') }}</span>

                <h1 class="modern-h2 mb-3" style="font-size: 42px; font-weight: 900; color: #0a0e27; line-height: 1.3;">
                    {{ $category->title }}
                </h1>

                @if($category->summary)
                <p class="mb-5 text-muted" style="font-size: 16px; color: #666; font-weight: 500; line-height: 1.8;">
                    {{ $category->summary }}
                </p>
                @endif

            
            </div>
        </div>
    </div>
</section>
@endif

<section class="catalog-section bg-light">
    <div class="container">
        <div class="row mb-5 align-items-center">
            <div class="col-md-6">
                <h4 class="fw-bold text-dark mb-0">
                   {{ __('common.courses') }} {{ __('common.available') }}
                </h4>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="catalog-filter d-inline-flex gap-3">
                    <!-- Placeholder for future filters if needed -->
                </div>
            </div>
        </div>

        <div class="row g-4">
            @foreach($products as $course)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="modern-card h-100 border-0 bg-white overflow-hidden catalog-card premium-card" style="border-radius: 24px; box-shadow: 0 8px 32px rgba(21, 145, 220, 0.1); border: 1.5px solid rgba(21, 145, 220, 0.12); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);">
                        <!-- Image Container with Overlay -->
                        <div class="position-relative overflow-hidden" style="height: 300px; background: linear-gradient(135deg, #f0f4ff 0%, #e8f1f9 100%);">
                            <a href="{{route('product-detail',$course->slug)}}" class="d-block h-100">
                                <img src="{{url($course->photo)}}" class="w-100 h-100 object-fit-cover catalog-card-img" style="transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);">
                            </a>

                            <!-- Overlay Gradient -->
                            <div class="position-absolute bottom-0 start-0 w-100" style="height: 100px; background: linear-gradient(to top, rgba(10, 14, 39, 0.3) 0%, transparent 100%);"></div>

                        
                            
                        </div>

                        <!-- Content Container -->
                        <div class="p-6 d-flex flex-column" style="padding: 1.75rem !important;">
                           

                            <!-- Title -->
                            <h5 class="fw-900 text-dark line-clamp-2" style="font-size: 20px; line-height: 1.35; color: #0a0e27; margin-bottom: 0.75rem; font-weight: 900;">
                                <a href="{{route('product-detail',$course->slug)}}" class="text-dark text-decoration-none" style="transition: color 0.3s ease;">
                                    {{$course->title}}
                                </a>
                            </h5>

                            <!-- Summary/Description -->
                            <p class="text-muted line-clamp-3 flex-grow-1" style="font-size: 14px; line-height: 1.5; color: #666; margin-bottom: 1.25rem;">
                                {{$course->summary}}
                            </p>

                            <!-- Footer Section -->
                            <div class="d-flex align-items-center gap-3 mt-auto" style="border-top: 1.5px solid rgba(21, 145, 220, 0.1); padding-top: 1rem;">
                                <a href="{{route('product-detail',$course->slug)}}" class="btn btn-sm flex-grow-1" style="background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%); color: white; border: none; border-radius: 10px; font-weight: 600; font-size: 14px; padding: 10px 16px; transition: all 0.3s ease; letter-spacing: 0.5px;">
                                    {{ __('common.view_more') }}
                                </a>
                                <a href="{{route('product-detail',$course->slug)}}" class="catalog-card-btn d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: linear-gradient(135deg, rgba(21, 145, 220, 0.12) 0%, rgba(21, 145, 220, 0.06) 100%); border-radius: 12px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-decoration: none;">
                                    <i class="fas fa-arrow-right" style="color: #1591DC; font-size: 18px; transition: transform 0.3s ease;"></i>
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

<!-- RELATED CATEGORIES SECTION -->
<section class="related-categories-section" style="background: linear-gradient(135deg, #ffffff 0%, #f8fbff 100%);">
    <div class="container">
        <div class="text-center mb-5">
            <span class="modern-badge">{{ __('common.gal_category_badge') }}</span>
            <h2 class="modern-h2 mt-3">{{ __('common.explore_more') }}</h2>
            <p class="text-muted mx-auto mt-3" style="max-width: 600px;">
                {{ __('common.explore_other_categories') }}
            </p>
        </div>

        <div class="row g-4">
            @php
                $allCategories = \App\Models\Category::where('status','active')
                    ->where('is_parent',1)
                    ->orderBy('title','ASC')
                    ->limit(6)
                    ->get();
            @endphp

            @forelse($allCategories as $cat)
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ route('product-lists', $cat->slug) }}" class="category-link-card">
                        <div class="category-link-item">
                            <div class="category-link-icon">
                                @if($cat->photo)
                                    <img src="{{ $cat->photo }}" alt="{{ $cat->title }}" class="category-link-img">
                                @else
                                    <i class="fas fa-book"></i>
                                @endif
                            </div>
                            <h5 class="category-link-title">{{ $cat->title }}</h5>
                           
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">{{ __('common.no_categories') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .catalog-section > .container {
        padding-top: 60px !important;
        padding-bottom: 60px !important;
    }

    .premium-card {
        position: relative;
        overflow: hidden;
    }

    .premium-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(21, 145, 220, 0.05) 0%, transparent 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        pointer-events: none;
    }

    .catalog-card {
        position: relative;
    }

    .catalog-card:hover {
        transform: translateY(-16px);
        box-shadow: 0 32px 64px rgba(21, 145, 220, 0.18) !important;
        border-color: rgba(21, 145, 220, 0.25) !important;
    }

    .catalog-card:hover::before {
        opacity: 1;
    }

    .catalog-card-img {
        transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .catalog-card:hover .catalog-card-img {
        transform: scale(1.1);
    }

    .catalog-card-btn {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .catalog-card:hover .btn {
        box-shadow: 0 12px 28px rgba(21, 145, 220, 0.3) !important;
        transform: translateY(-2px);
    }

    .catalog-card:hover .catalog-card-btn {
        background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%) !important;
        box-shadow: 0 12px 28px rgba(21, 145, 220, 0.3) !important;
        transform: scale(1.12);
    }

    .catalog-card:hover .catalog-card-btn i {
        color: white !important;
        transform: translateX(2px);
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* =========================================
       RELATED CATEGORIES LINKS
       ========================================= */

    .category-link-card {
        text-decoration: none;
        display: block;
        height: 100%;
    }

    .category-link-item {
        background: white;
        border-radius: 14px;
        padding: 16px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(21, 145, 220, 0.08);
        border: 1px solid rgba(21, 145, 220, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .category-link-card:hover .category-link-item {
        box-shadow: 0 12px 32px rgba(21, 145, 220, 0.15);
        transform: translateY(-4px);
        border-color: rgba(21, 145, 220, 0.2);
    }

    .category-link-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #f0f4ff 0%, #e8f1f9 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
        font-size: 24px;
        color: #1591DC;
        overflow: hidden;
    }

    .category-link-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .category-link-card:hover .category-link-img {
        transform: scale(1.1);
    }

    .category-link-title {
        font-size: 13px;
        font-weight: 700;
        color: #0a0e27;
        margin: 0 0 6px 0;
        line-height: 1.4;
    }

    .category-link-count {
        font-size: 11px;
        color: #1591DC;
        font-weight: 600;
        margin: 0;
    }

    /* =========================================
       RESPONSIVE
       ========================================= */

    @media (max-width: 768px) {
        .catalog-card:hover {
            transform: translateY(-8px);
        }

        .related-category-image {
            height: 120px;
        }

        .category-header-section {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }
    }

    @media (max-width: 480px) {
        .related-category-card {
            border-radius: 12px;
        }

        .related-category-image {
            height: 100px;
        }

        .related-category-content {
            padding: 10px;
        }

        .related-category-title {
            font-size: 12px;
        }
    }
</style>
@endpush
