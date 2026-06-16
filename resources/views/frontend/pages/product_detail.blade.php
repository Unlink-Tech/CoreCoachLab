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
                                            <span class="level-price__value">{{ number_format($level->price_in_points) }} <small>{{ __('common.account.creds') }}</small></span>
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
                            <li><span class="fact-ico"><i class="fas fa-infinity"></i></span> {{ __('common.product_detail.lifetime_access') }}</li>
                            <li><span class="fact-ico"><i class="fas fa-images"></i></span> {{ __('common.product_detail.portfolio_building') }}</li>
                        </ul>
                    </div>
                </aside>
            </div>
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
