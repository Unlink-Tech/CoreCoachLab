@extends('frontend.layouts.main')
@section('page-body-class', 'page-checkout')
@section('title', 'Checkout')
@section('main-content')

    <x-breadcrumb
        :title="__('common.checkout')"
        :routes="[
            ['label' => __('common.cart.title'), 'url' => route('cart')],
            ['label' => __('common.checkout')]
        ]"
    />

    <!-- Checkout Section -->
    <section class="kv-checkout-section">
        <!-- Background Grid & Glowing Blobs -->
        <div class="kv-pattern" aria-hidden="true"></div>
        <span class="kv-glow kv-glow-mint" aria-hidden="true"></span>
        <span class="kv-glow kv-glow-sky" aria-hidden="true"></span>

        <div class="container">

            <form name="frmCheckout" id="frmCheckout" method="POST" action="{{route('cart.order')}}">
                @csrf

                <!-- Progress stepper (visual guide) -->
                <div class="kv-stepper" aria-hidden="true">
                    <div class="kv-stepper__step">
                        <span class="kv-stepper__dot"><i class="fas fa-user"></i></span>
                        <span class="kv-stepper__label">{{ __('common.billing_details') }}</span>
                    </div>
                    <span class="kv-stepper__bar"></span>
                    <div class="kv-stepper__step">
                        <span class="kv-stepper__dot"><i class="fas fa-clipboard-list"></i></span>
                        <span class="kv-stepper__label">{{ __('common.additional_information') }}</span>
                    </div>
                    <span class="kv-stepper__bar"></span>
                    <div class="kv-stepper__step">
                        <span class="kv-stepper__dot"><i class="fas fa-credit-card"></i></span>
                        <span class="kv-stepper__label">{{ __('common.card_details') }}</span>
                    </div>
                    <span class="kv-stepper__bar"></span>
                    <div class="kv-stepper__step">
                        <span class="kv-stepper__dot"><i class="fas fa-shield-alt"></i></span>
                        <span class="kv-stepper__label">{{ __('common.place_order') }}</span>
                    </div>
                </div>

                <div class="kv-checkout-grid">

                    <!-- Billing Details Column -->
                    <div class="kv-checkout-form">

                        <!-- Billing Information Card -->
                        <div class="kv-checkout-card">
                            <h3 class="kv-checkout-card-title">
                                <span class="kv-step">1</span>
                                <i class="fas fa-user-circle"></i>
                                {{ __('common.billing_details')}}
                            </h3>
                            <div class="kv-checkout-form-grid">
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.first_name') }} *</label>
                                    <input type="text" name="first_name" id="first_name" value="" placeholder="{{ __('common.first_name') }}" class="kv-input">
                                    @error('first_name')
                                    <span class='kv-error'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.last_name') }} *</label>
                                    <input type="text" name="last_name" id="last_name" value="" placeholder="{{ __('common.last_name') }}" class="kv-input">
                                    @error('last_name')
                                    <span class='kv-error'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.email') }} *</label>
                                    <input name="email" type="email" id="email" value="{{ auth()->user()->email ?? '' }}" placeholder="{{ __('common.email') }}" class="kv-input">
                                    @error('email')
                                    <span class='kv-error'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.phone') }} *</label>
                                    <input type="tel" name="phone" id="phone" placeholder="{{ __('common.phone') }}" value="{{ auth()->user()->phone ?? '' }}" class="kv-input" pattern="[0-9\-\+\s\(\)]{7,}" inputmode="tel">
                                    @error('phone')
                                    <span class='kv-error'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="kv-checkout-form-group kv-checkout-form-group-full">
                                    <label class="kv-label">{{ __('common.address') }} *</label>
                                    <input type="text" name="address1" id="address" value="{{ auth()->user()->address ?? '' }}" placeholder="{{ __('common.address') }}" class="kv-input">
                                    @error('address1')
                                    <span class='kv-error'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.town_city') }} *</label>
                                    <input type="text" name="city" id="city" value="{{ auth()->user()->city ?? '' }}" placeholder="{{ __('common.town_city') }}" class="kv-input">
                                    @error('city')
                                    <span class='kv-error'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.zip_code') }} *</label>
                                    <input type="text" name="post_code" id="post_code" pattern="[0-9]*" placeholder="{{ __('common.zip_code') }}" value="{{ auth()->user()->zip ?? '' }}" class="kv-input">
                                    @error('post_code')
                                    <span class='kv-error'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.state') }} *</label>
                                    <input type="text" name="state" id="state" value="{{ auth()->user()->state ?? '' }}" placeholder="{{ __('common.state') }}" class="kv-input">
                                    @error('state')
                                    <span class='kv-error'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.country') }} *</label>
                                    <select name="country" id="country" class="kv-input kv-select">
                                        <option value="">{{__('common.select_country_placeholder')}}</option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BR">Brazil</option>
                                        <option value="CA">Canada</option>
                                        <option value="CN">China</option>
                                        <option value="CO">Colombia</option>
                                        <option value="HR">Croatia</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="EG">Egypt</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GR">Greece</option>
                                        <option value="HK">Hong Kong SAR China</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JP">Japan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KR">South Korea</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MX">Mexico</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NO">Norway</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="RU">Russia</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SG">Singapore</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="ES">Spain</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="TW">Taiwan</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TR">Turkey</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="VN">Vietnam</option>
                                    </select>
                                    @error('country')
                                    <span class="kv-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information Card -->
                        <div class="kv-checkout-card">
                            <h3 class="kv-checkout-card-title">
                                <span class="kv-step">2</span>
                                <i class="fas fa-clipboard-list"></i>
                                {{ __('common.additional_information') }}
                            </h3>
                            <div class="kv-checkout-form-group kv-checkout-form-group-full">
                                <label class="kv-label">{{ __('common.notes') }} *</label>
                                <textarea name="note" placeholder="{{ __('common.notes_about_order') }}" class="kv-input kv-textarea"></textarea>
                            </div>
                        </div>

                        <!-- Payment Card -->
                        <div class="kv-checkout-card">
                            <h3 class="kv-checkout-card-title">
                                <span class="kv-step">3</span>
                                <i class="fas fa-credit-card"></i>
                                {{ __('common.card_details') }}
                            </h3>
                            <div class="kv-checkout-form-grid">
                                <div class="kv-checkout-form-group kv-checkout-form-group-full">
                                    <label class="kv-label">{{ __('common.card_holder_name') }}</label>
                                    <input type="text" name="name" id="name_on_card" class="kv-input" placeholder="{{ __('common.card_holder_name') }}">
                                    @error('name')<span class='kv-error'>{{$message}}</span>@enderror
                                </div>
                                <div class="kv-checkout-form-group kv-checkout-form-group-full">
                                    <label class="kv-label">{{ __('common.card_number') }}</label>
                                    <input type="text" name="card_number" id="card_number" placeholder="{{__('common.card_number_placeholder')}}" class="kv-input cc-number" pattern="[0-9\s]{19}" inputmode="numeric" maxlength="19" autocomplete="cc-number" oninput="this.value = this.value.replace(/\D/g, '').substring(0, 16).replace(/(.{4})/g, '$1 ').trim();">
                                    @error('card_number')<span class='kv-error'>{{$message}}</span>@enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.expiry_month') }}</label>
                                    <div class="kv-card-expiry">
                                        <input type="text" class="kv-input" name="expiry_month" id="expiry_month" placeholder="MM" pattern="[0-9]{2}" inputmode="numeric" maxlength="2" min="01" max="12">
                                        <span class="kv-card-separator"> / </span>
                                        <input type="text" class="kv-input" name="expiry_year" id="expiry_year" placeholder="YYYY" pattern="[0-9]{4}" inputmode="numeric" maxlength="4">
                                    </div>
                                    @error('expiry_month')<span class='kv-error'>{{$message}}</span>@enderror
                                    @error('expiry_year')<span class='kv-error'>{{$message}}</span>@enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.cvv') }}</label>
                                    <input id="cvv" name="cvv" type="text" autocomplete="off" placeholder="••••" class="kv-input cc-cvc" pattern="[0-9]{3,4}" inputmode="numeric" maxlength="4">
                                    @error('cvv')<span class='kv-error'>{{$message}}</span>@enderror
                                </div>
                            </div>
                            <div class="kv-secure-note">
                                <i class="fas fa-lock"></i>
                                <span>{{__('common.card_bill_description')}}</span>
                            </div>
                            <div class="kv-payment-methods">
                                <img src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('common.cart.accepted_payment_methods') }}" loading="lazy">
                            </div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="kv-checkout-card kv-checkout-terms">
                            <h3 class="kv-checkout-card-title">
                                <span class="kv-step">4</span>
                                <i class="fas fa-file-signature"></i>
                                {{ __('common.terms_conditions') }}
                            </h3>
                            <div class="kv-terms-group">
                                <div class="kv-terms-row">
                                    <input type="checkbox" id="terms" name="terms" class="kv-checkbox">
                                    <label for="terms">
                                        {{__('common.agree_terms_conditions')}} <a href="{{ route('pages', 'terms-conditions') }}" target='_blank'>{{ __('common.terms_conditions') }}</a>
                                    </label>
                                </div>
                                @error('terms')
                                <span class='kv-error'>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="kv-terms-group">
                                <div class="kv-terms-row">
                                    <input type="checkbox" id="privacy" name="privacy" class="kv-checkbox">
                                    <label for="privacy">
                                        {{__('common.agree_privacy_policy')}} <a href="{{ route('pages', 'privacy-policy') }}" target='_blank'>{{ __('common.privacy_policy') }}</a>
                                    </label>
                                </div>
                                @error('privacy')
                                <span class='kv-error'>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="kv-terms-group">
                                <div class="kv-terms-row">
                                    <input type="checkbox" id="delivery" name="delivery" class="kv-checkbox">
                                    <label for="delivery">
                                        {{__('common.agree_delivery_policy')}} <a href="{{ route('pages', 'delivery-policy') }}" target='_blank'>{{ __('common.delivery_policy') }}</a>
                                    </label>
                                </div>
                                @error('delivery')
                                <span class='kv-error'>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="kv-terms-group">
                                <div class="kv-terms-row">
                                    <input type="checkbox" id="refund" name="refund" class="kv-checkbox">
                                    <label for="refund">
                                        {{__('common.agree_refund_policy')}} <a href="{{ route('pages', 'refund-policy') }}" target='_blank'>{{ __('common.refund_policy') }}</a>
                                    </label>
                                </div>
                                @error('refund')
                                <span class='kv-error'>{{$message}}</span>
                                @enderror
                            </div>

                            <!-- DBA Reference -->
                            <div class="kv-checkout-dba-reference" style="margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(37, 34, 30, 0.08); display: flex; flex-direction: column; gap: 12px;">
                                <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                                    <div class="kv-dba-image-wrapper" style="flex-shrink: 0; background: #fff; padding: 6px; border: 1.5px solid var(--color-stone, #d7d6d4); border-radius: var(--radius-lg, 8px); box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05); transition: border-color 0.2s ease, transform 0.2s ease;">
                                        <img src="{{ asset('assets/images/dba.png') }}" alt="{{ __('common.dba_reference') }}" style="max-width: 140px; height: auto; display: block; border-radius: 4px;" />
                                    </div>
                                    <div class="kv-dba-text-wrapper" style="flex: 1; min-width: 200px;">
                                        <h4 style="margin: 0 0 6px 0; font-family: var(--font-inter), sans-serif; font-size: 13px; font-weight: 700; color: var(--color-ink, #25221e); text-transform: uppercase; letter-spacing: 0.03em;">
                                            {{ __('common.dba_reference') }}
                                        </h4>
                                        <p style="margin: 0; font-family: var(--font-inter), sans-serif; font-size: 12px; line-height: 1.5; color: var(--color-pencil, #6f6c69);">
                                            {{ __('common.dba_description') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Column -->
                    <div class="kv-checkout-summary">
                        <div class="kv-checkout-card kv-checkout-order">
                            <h3 class="kv-checkout-card-title">
                                <i class="fas fa-shopping-bag"></i>
                                {{ __('common.your_order') }}
                            </h3>
                            <div class="kv-checkout-order-table">
                                <div class="kv-checkout-order-header">
                                    <span>{{ __('common.product') }}</span>
                                    <span>{{ __('common.total') }}</span>
                                </div>
                                @php
                                    $total_amount = Helper::totalCartPrice();
                                    if(session()->has('coupon')) {
                                        $total_amount -= Session::get('coupon')['value'];
                                    }
                                @endphp
                                @if(Helper::getAllProductFromCart())
                                @foreach(Helper::getAllProductFromCart() as $key => $cart)
                                @php
                                    $user_id = auth()->check() ? auth()->id() : session('guest');
                                    $points = App\Models\Cart::where('user_id', $user_id)->where('order_id',null)->pluck('points')->first();
                                @endphp
                                <div class="kv-checkout-order-item">
                                    <span class="kv-checkout-order-points">
                                        <i class="fas fa-coins"></i>
                                        {{ number_format($points) }} {{ __('common.points') }}
                                    </span>
                                    <span class="kv-checkout-order-price">
                                        {{ Helper::getCurrencySymbol(session('currency')) }} {{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}
                                    </span>
                                </div>
                                @endforeach
                                @endif
                                <div class="kv-checkout-order-total">
                                    <span>{{ __('common.total') }}:</span>
                                    <span class="kv-checkout-order-total-value">
                                        {{ Helper::getCurrencySymbol(session('currency')) }} {{ number_format($total_amount, session('currency')=='JPY' ? 0 : 2) }}
                                    </span>
                                </div>
                            </div>

                            @if(env('CAPTCHA_ENABLED', true))
                            <!-- Captcha -->
                            <div class="kv-captcha-group">
                                <label class="kv-label">{{ __('common.security_code') }} *</label>
                                <div class="kv-captcha-wrapper">
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('common.fill_captcha') }}" class="kv-input">
                                    <div class="kv-captcha-display">
                                        @captcha
                                    </div>
                                </div>
                                @error('captcha')
                                    <span class="kv-error">{{ __('common.captcha_error') }}</span>
                                @enderror
                            </div>
                            @endif

                            <!-- Submit Button -->
                            <button type="submit" class="kv-btn kv-btn-accent kv-btn-lg w-100" id="button-confirm">
                                <i class="fas fa-shield-alt"></i>
                                {{ __('common.place_order') }}
                            </button>

                            <a href="{{ route('home') }}" class="kv-btn kv-btn-outline kv-btn-lg w-100">
                                <i class="fas fa-arrow-left"></i>
                                {{ __('common.continue_shopping') }}
                            </a>

                            <div class="kv-summary-assure">
                                <i class="fas fa-lock"></i> {{ __('common.cart.secure_checkout') }}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{url('assets/js/jquery.payment.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery("#frmCheckout").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    minlength: 10
                },
                address1: "required",
                post_code: "required",
                city: "required",
                state: "required",
                country: "required",
                name: "required",
                card_number: "required",
                expiry_month: "required",
                expiry_year: "required",
                cvv: "required",
                terms: "required",
                privacy: "required",
                delivery: "required",
                refund: "required",
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "required"
                @endif
            },
            messages: {
                first_name: "{{ __('common.first_name_required') }}",
                last_name: "{{ __('common.last_name_required') }}",
                email: "{{ __('common.email_required') }}",
                phone: {
                    required: "{{ __('common.phone_required') }}",
                    minlength: "{{ __('common.phone_minlength') }}"
                },
                address1: "{{ __('common.address_required') }}",
                post_code: "{{ __('common.post_code_required') }}",
                city: "{{ __('common.city_required') }}",
                state: "{{ __('common.state_required') }}",
                country: "{{ __('common.country_required') }}",
                name: "{{ __('common.card_name_required') }}",
                card_number: "{{ __('common.card_number_required') }}",
                expiry_month: "{{ __('common.expiry_month_required') }}",
                expiry_year: "{{ __('common.expiry_year_required') }}",
                cvv: "{{ __('common.cvv_required') }}",
                terms: "{{ __('common.accept_terms_conditions') }}",
                privacy: "{{ __('common.accept_privacy_policy') }}",
                delivery: "{{ __('common.accept_delivery_policy') }}",
                refund: "{{ __('common.accept_refund_policy') }}",
                captcha: "{{ __('common.fill_it') }}"
            },
            errorClass: "kv-error",
            errorPlacement: function(error, element) {
                error.css({
                    "font-size": "0.85rem",
                    "color": "#ff4757",
                    "margin-top": "6px",
                    "display": "block",
                    "font-weight": "500"
                });
                if (element.attr("type") === "checkbox") {
                    error.appendTo(element.closest(".kv-terms-group"));
                } else if (element.attr("id") === "expiry_month" || element.attr("id") === "expiry_year") {
                    error.insertAfter(element.closest(".kv-card-expiry"));
                } else {
                    error.insertAfter(element);
                }
            }
        });

        // Card CVC formatting
        jQuery('.cc-cvc').payment('formatCardCVC');

        // Phone number input restriction - allow only digits, spaces, hyphens, plus, and parentheses
        jQuery('#phone').on('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9\-\+\s\(\)]/.test(char)) {
                e.preventDefault();
            }
        });

        // Card number - display as 4111 1111 1111 1111 while typing or pasting
        const formatCardNumber = function(input) {
            const digits = input.value.replace(/\D/g, '').substring(0, 16);
            input.value = digits.replace(/(.{4})/g, '$1 ').trim();
        };

        jQuery('#card_number').on('input paste', function() {
            setTimeout(() => formatCardNumber(this), 0);
        }).on('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char)) {
                e.preventDefault();
            }
        });

        // Expiry month - only digits
        jQuery('#expiry_month').on('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char)) {
                e.preventDefault();
            }
        }).on('input', function() {
            let value = this.value.replace(/[^0-9]/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2);
                if (parseInt(value) > 12) {
                    value = '12';
                }
            }
            this.value = value;
        });

        // Expiry year - only digits
        jQuery('#expiry_year').on('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char)) {
                e.preventDefault();
            }
        }).on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 4);
        });

        // CVV - only digits
        jQuery('#cvv').on('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char)) {
                e.preventDefault();
            }
        }).on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 4);
        });
    });
</script>
@endpush

