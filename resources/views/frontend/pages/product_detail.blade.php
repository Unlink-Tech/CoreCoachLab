@extends('frontend.layouts.main')

@section('title', $product_detail->title)
@section('description', $product_detail->summary)

@section('main-content')
<div class="tl-breadcrumb catalog-banner pt-60 pb-60">
    <video autoplay muted loop playsinline>
        <source src="{{ asset('assets/images/breadcrumb.mp4') }}" type="video/mp4">
    </video>
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ $product_detail->title }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="{{route('home')}}">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ $product_detail->title }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="product-details-section pt-60 pb-80 bg-light">
    <div class="container">
        <div class="row g-4">
            <!-- Left: Course Levels & Enrollment -->
            <div class="col-xl-7">
                <div class="p-0">
                    <div class="d-flex align-items-center gap-3 mb-5" style="margin-bottom: 2rem !important;">
                        <h2 class="fw-900 text-dark mb-0" style="font-size: 28px; color: #0a0e27;">{{ __('common.select_level') }}</h2>
                        
                    </div>

                    <div class="level-tabs-container">
                        <!-- Navigation Pills for Levels -->
                        <ul class="nav nav-pills modern-pills mb-4 p-0 d-flex gap-2" id="levelTabs" role="tablist" style="flex-wrap: nowrap; overflow-x: auto; -webkit-overflow-scrolling: touch;">
                            @foreach($product_detail->levels as $key => $level)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link level-tab-btn rounded-3 fw-bold border-0 @if($loop->first) active @endif"
                                            id="level-tab-{{ $level->id }}"
                                            data-bs-toggle="pill"
                                            data-bs-target="#level-content-{{ $level->id }}"
                                            type="button" role="tab"
                                            style="padding: 8px 18px; font-size: 13px; letter-spacing: 0.3px; white-space: nowrap; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); @if($loop->first) background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%); color: white; box-shadow: 0 8px 20px rgba(21, 145, 220, 0.25); @else background: rgba(21, 145, 220, 0.08); color: #1591DC; @endif">
                                        {{ $level->skill_level }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Tab Contents -->
                        <div class="tab-content" id="levelTabsContent">
                            @foreach($product_detail->levels as $key => $level)
                                <div class="tab-pane fade @if($loop->first) show active @endif"
                                     id="level-content-{{ $level->id }}"
                                     role="tabpanel">

                                    <!-- Level Badge -->
                                    <div class="mb-4 d-flex align-items-center gap-2">
                                        <span class="badge rounded-2 px-3 py-2" style="background: rgba(21, 145, 220, 0.1); color: #1591DC; font-size: 12px; font-weight: 600;">
                                            <i class="fas fa-level-up-alt me-1"></i> {{ __('common.level') }}: <strong>{{ $level->skill_level }}</strong>
                                        </span>
                                    </div>

                                    <div class="level-info-grid mb-4">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="p-4 rounded-3 h-100 transition-all" style="background: linear-gradient(135deg, rgba(21, 145, 220, 0.08) 0%, rgba(21, 145, 220, 0.04) 100%); border: 1.5px solid rgba(21, 145, 220, 0.15); cursor: pointer;">
                                                    <h6 class="text-uppercase fw-bold mb-2" style="color: #1591DC; font-size: 12px; letter-spacing: 0.6px;">{{__('common.purpose')}}</h6>
                                                    <p class="text-dark fw-bold mb-0" style="font-size: 14px; line-height: 1.5;">{{ $level->purpose }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="p-4 rounded-3 h-100 transition-all" style="background: linear-gradient(135deg, rgba(21, 145, 220, 0.1) 0%, rgba(21, 145, 220, 0.06) 100%); border: 1.5px solid rgba(21, 145, 220, 0.18); cursor: pointer;">
                                                    <h6 class="text-uppercase fw-bold mb-2" style="color: #1591DC; font-size: 12px; letter-spacing: 0.6px;">{{__('common.outcome')}}</h6>
                                                    <p class="text-dark fw-bold mb-0" style="font-size: 14px; line-height: 1.5;">{{ $level->outcome }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="learn-list mb-4">
                                        <h6 class="fw-bold text-dark mb-3" style="font-size: 16px;"><i class="fas fa-check-circle me-2" style="color: #1591DC;"></i> {{__('common.what_learn')}}</h6>
                                        <div class="row g-2">
                                            @php $items = explode('.', $level->learn_info); @endphp
                                            @foreach($items as $item)
                                                @if(trim($item) != '')
                                                    <div class="col-md-10">
                                                        <div class="d-flex gap-2 align-items-start p-2" style="background: linear-gradient(135deg, rgba(21, 145, 220, 0.06) 0%, rgba(44, 94, 173, 0.03) 100%); border: 1px solid rgba(21, 145, 220, 0.12); border-radius: 8px; transition: all 0.3s ease;">
                                                            <i class="fas fa-check" style="color: #1591DC; font-size: 12px; margin-top: 3px; flex-shrink: 0;"></i>
                                                            <span class="text-dark fw-bold" style="font-size: 14px; line-height: 1.5;">{{ trim($item) }}</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="enrollment-footer d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 pt-4" style="border-top: 1.5px solid rgba(21, 145, 220, 0.1);">
                                        <div class="price-display">
                                            <div class="text-muted small fw-bold text-uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">{{ __('common.points') }}</div>
                                            <h3 class="fw-900 mb-0" style="color: #1591DC; font-size: 24px;">
                                                {{ number_format($level->price_in_points) }} <span class="fs-6 opacity-60" style="font-weight: 600;">CREDS</span>
                                            </h3>
                                        </div>

                                        <form action="{{route('single-add-to-cart')}}" method="POST" class="flex-grow-1 flex-md-grow-0 enroll-form" data-product-slug="{{$product_detail->slug}}">
                                            @csrf
                                            <input type="hidden" name="quant[1]" value="1">
                                            <input type="hidden" name="slug" value="{{$product_detail->slug}}">
                                            <input type="hidden" name="price" value="{{$level->price}}">
                                            <input type="hidden" name="price_jp" value="{{$level->price_jp}}">
                                            <input type="hidden" name="price_hk" value="{{$level->price_hk}}">
                                            <input type="hidden" name="level_id" value="{{$level->id}}">
                                            <button type="submit" class="btn w-100 px-4 py-3 fw-bold rounded-3 enroll-btn" style="background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%); color: white; border: none; font-size: 14px; transition: all 0.3s ease;">
                                                {{ __('common.enroll_now') }} <i class="fas fa-arrow-right ms-2"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Media & Description -->
            <div class="col-xl-5">
                <div class="sticky-top" style="top: 100px;">
                    @php $photo = explode(',', $product_detail->photo); @endphp
                    <div class="overflow-hidden mb-4" style="border-radius: 16px; border: 1px solid rgba(21, 145, 220, 0.12); box-shadow: 0 4px 20px rgba(21, 145, 220, 0.08);">
                        <img src="{{ asset($photo[0]) }}" class="w-100 object-fit-cover d-block" style="height: 280px; transition: transform 0.5s ease;">
                    </div>

                    <div class="bg-white p-4 rounded-3 mb-3" style="border: 1px solid rgba(21, 145, 220, 0.12); box-shadow: 0 4px 16px rgba(21, 145, 220, 0.06);">
                        <h6 class="fw-bold text-dark mb-3" style="font-size: 16px;">{{ __('common.course_overview') }}</h6>
                        <p class="text-muted mb-0" style="font-size: 14px; line-height: 1.6;">{{$product_detail->description}}</p>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .product-details-section {
        padding-top: 60px !important;
        padding-bottom: 80px !important;
        background: #f8fafc;
    }

    .level-tab-btn {
        color: #1591DC !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        background: rgba(21, 145, 220, 0.08) !important;
        font-weight: 600;
    }

    .level-tab-btn:hover:not(.active) {
        background: rgba(21, 145, 220, 0.15) !important;
        color: #1591DC !important;
        transform: translateY(-2px);
    }

    .level-tab-btn.active {
        background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%) !important;
        color: white !important;
        box-shadow: 0 12px 32px rgba(21, 145, 220, 0.28) !important;
    }

    .level-info-grid > .row > .col-md-6 > div {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .level-info-grid > .row > .col-md-6 > div:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(21, 145, 220, 0.15);
        border-color: rgba(21, 145, 220, 0.3) !important;
    }

    .tiny { font-size: 0.75rem; }

    .sticky-top {
        transition: all 0.3s ease;
    }

    @media (max-width: 992px) {
        .col-xl-7, .col-xl-5 {
            margin-bottom: 1.5rem;
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
