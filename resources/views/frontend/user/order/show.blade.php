@extends('frontend.layouts.main')
@section('title','Order Details')

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
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.order_detail') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.order_detail') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

      <section class="cart-area pt-100 pb-100">
				<div class="container">
					<div class="row">
            <div class="table-responsive">

              <div class="card">
                <h5 class="card-header">
                  <button onclick="window.history.back();" class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-arrow-left fa-sm text-white-50"></i> {{ __('common.back') }}</button>
                  <a href="{{route('order.pdf',$order->id)}}" class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i> {{ __('common.generate_pdf') }}</a>
                </h5>
                <div class="card-body">
                  @if($order)
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                          <th>{{ __('common.order_number') }}</th>
                          <th>{{ __('common.name') }}</th>
                          <th>{{ __('common.email') }}</th>
                          <th>{{ __('common.quantity') }}</th>
                          <th class="text-right">{{ __('common.total_amount') }}</th>
                          <th>{{ __('common.status') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                          <td>{{$order->order_number}}</td>
                          <td>{{$order->first_name}} {{$order->last_name}}</td>
                          <td>{{$order->email}}</td>
                          <td>{{$order->quantity}}</td>
                          <td class="text-right ft-w-b">
                            
                            @php
                              $currency = match($order->currency) {
                                  'USD' => '$',
                                  'JPY' => '¥',
                                  'HKD' => 'HK$',
                                  default => '$',
                              };

                              if($order->currency == "USD") {
                                  $orderTotalAmount = number_format($order->total_amount, 2);
                              
                              }
                              else {
            $orderTotalAmount = number_format($order->total_amount_jp, 2);
                              
                              }
                            @endphp
                            
                            {{ $currency }}   
   {{number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2)}}                              
                             
                          </td>
                          <td>
                            {{ ucwords($order->status) }}
                          </td>
                          

                      </tr>
                    </tbody>
                  </table>

                  <section class="confirmation_part section_padding">
                    <div class="order_boxes">
                      <div class="row">
                        <div class="col-lg-12 col-lx-12">
                          <div class="order-info">
                            <h4 class="text-center pb-4">{{ __('common.order_information') }}</h4>
                            <table class="table">
                                  <tr class="">
                                      <td>{{ __('common.order_number') }}</td>
                                      <td> : {{$order->order_number}}</td>
                                  </tr>
                                  <tr>
                                      <td>{{ __('common.order_date') }}</td>
                                      <td> : {{$order->created_at->format('D d M, Y')}} at {{$order->created_at->format('g : i a')}} </td>
                                  </tr>
                                  <tr>
                                      <td>{{ __('common.quantity') }}</td>
                                      <td> : {{$order->quantity}}</td>
                                  </tr>
                                  <tr>
                                      <td>{{ __('common.order_status') }}</td>
                                      <td> : {{ ucwords($order->status) }}</td>
                                  </tr>
                                  <tr>
                                      <td>{{ __('common.total_amount') }}</td>
                                      <td> : 
  {{ $currency }}  
  {{number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2)}}                                     
                                      
                                      </td>
                                  </tr>
                                  <tr>
                                    <td>{{ __('common.payment_method') }}</td>
                                    <td> : Credit Card</td>
                                  </tr>
                                  <tr>
                                      <td>{{ __('common.payment_status') }}</td>
                                      <td> : {{ ucwords($order->payment_status) }}</td>
                                  </tr>
                                  <tr>
                                      <td>{{ __('common.transaction_id') }}</td>
                                      <td> : {{ $order->trans_id }}</td>
                                  </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                  @endif

                </div>
              </div>

              </div>
          </div>
        </div>
      </section>

@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }
</style>
@endpush
