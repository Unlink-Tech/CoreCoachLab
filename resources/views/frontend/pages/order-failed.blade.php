@extends('frontend.layouts.main')
@section('page-body-class', 'page-order-failed')
@section('title', 'Order Failed')
@section('main-content')

<x-breadcrumb
    :title="__('common.order_failed.page_title')"
    :routes="[['label' => __('common.order_failed.breadcrumb_label')]]"
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
                        <h2 class="status-title">{{ __('common.order_failed.title') }}</h2>
                        <p class="status-text">{{ __('common.order_failed.description') }}</p>
                    </div>

                    <div class="status-help">
                        <h6 class="status-help__title"><i class="fas fa-lightbulb"></i> {{ __('common.order_failed.what_you_can_do') }}</h6>
                        <ul class="status-help__list">
                            <li><i class="fas fa-check"></i><span>{{ __('common.order_failed.check_payment_details') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('common.order_failed.contact_bank') }}</span></li>
                            <li><i class="fas fa-check"></i><span>{{ __('common.order_failed.try_different_payment') }}</span></li>
                        </ul>
                    </div>

                    <div class="status-actions">
                        <a href="{{ route('home') }}" class="status-btn status-btn--primary">
                            <i class="fas fa-home"></i> {{ __('common.home') }}
                        </a>
                    </div>

                    <div class="status-note status-note--left">
                        <h6 class="status-note__title">{{ __('common.order_failed.need_assistance') }}</h6>
                        <p>
                            {{ __('common.order_failed.reach_out') }}
                            <a href="mailto:{{ __('common.company_email') }}">{{ __('common.company_email') }}</a>.
                            {{ __('common.order_failed.we_are_here') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

