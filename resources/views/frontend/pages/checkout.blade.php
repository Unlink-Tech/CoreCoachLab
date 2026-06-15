@extends('frontend.layouts.main')
@section('title', 'Checkout')
@section('main-content')

    <x-breadcrumb
        :title="__('common.checkout')"
        :routes="[
            ['label' => __('common.cart'), 'url' => route('cart')],
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
                                <img src="{{ asset('assets/images/payment.png') }}" alt="Payment Methods">
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
                                <i class="fas fa-lock"></i> {{ __('common.secure_checkout') ?? 'Secure & encrypted checkout' }}
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

@push('styles')
<style>
    /* =========================================
       CHECKOUT — Warm Editorial Redesign
       ========================================= */
    .kv-checkout-section {
        position: relative;
        overflow: hidden;
        background-color: var(--surface-paper-canvas, #fefdfc);
        padding: var(--spacing-48, 48px) 0 var(--spacing-80, 80px);
        font-family: var(--font-inter, sans-serif);
        min-height: 70vh;
    }
    
    /* Background Pattern & Glow Blobs */
    .kv-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(37, 34, 30, 0.03) 1.2px, transparent 1.2px);
        background-size: 24px 24px;
        pointer-events: none;
        z-index: 0;
    }
    .kv-glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(120px);
        pointer-events: none;
        z-index: 0;
        opacity: 0.65;
        mix-blend-mode: multiply;
    }
    .kv-glow-mint { 
        width: 450px; 
        height: 450px; 
        background: radial-gradient(circle, var(--color-mint-wash, #f0f6df) 0%, rgba(240, 246, 223, 0.2) 70%, transparent 100%); 
        top: -150px; 
        left: -100px; 
        animation: kvGlowFloat 22s ease-in-out infinite; 
    }
    .kv-glow-sky  { 
        width: 400px; 
        height: 400px; 
        background: radial-gradient(circle, var(--color-sky-wash, #dceaff) 0%, rgba(220, 234, 255, 0.2) 70%, transparent 100%); 
        bottom: 8%; 
        right: -100px; 
        animation: kvGlowFloat 28s ease-in-out infinite reverse; 
    }
    
    .kv-checkout-section .container { 
        position: relative; 
        z-index: 1; 
    }

    .kv-checkout-grid {
        display: grid;
        grid-template-columns: 1.4fr 380px;
        gap: var(--spacing-32, 32px);
        align-items: start;
    }

    /* ---- PROGRESS STEPPER ---- */
    .kv-stepper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0;
        max-width: 800px;
        margin: 0 auto var(--spacing-48, 48px);
        padding: var(--spacing-16, 16px) var(--spacing-32, 32px);
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-xl, 15px);
        box-shadow: 0 4px 20px rgba(37, 34, 30, 0.02);
        animation: kvFadeDown 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
    }
    .kv-stepper__step {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }
    .kv-stepper__dot {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: var(--color-cream, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        color: var(--color-ember-red, #e34432);
        font-size: 14px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
    }
    .kv-stepper__step:hover .kv-stepper__dot {
        background: var(--color-ember-red, #e34432);
        border-color: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(227, 68, 50, 0.25);
    }
    .kv-stepper__label {
        font-family: var(--font-inter), sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: var(--color-ink, #25221e);
        white-space: nowrap;
    }
    .kv-stepper__bar {
        flex: 1;
        height: 2px;
        min-width: 20px;
        margin: 0 var(--spacing-16, 16px);
        background: linear-gradient(90deg, var(--color-ember-red, #e34432), var(--color-stone, #d7d6d4));
        border-radius: 2px;
        opacity: 0.6;
    }

    /* ---- CARDS ---- */
    .kv-checkout-card {
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-xl, 15px);
        padding: var(--spacing-28, 28px);
        margin-bottom: var(--spacing-24, 24px);
        box-shadow: 0 4px 20px rgba(37, 34, 30, 0.02);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .kv-checkout-card:hover {
        border-color: rgba(227, 68, 50, 0.25);
        box-shadow: 0 12px 36px rgba(37, 34, 30, 0.06);
    }

    .kv-checkout-card-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-family: var(--font-graphik, sans-serif);
        font-size: 19px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        margin: 0 0 var(--spacing-24, 24px) 0;
        padding-bottom: var(--spacing-12, 12px);
        border-bottom: 1px solid var(--color-stone, #d7d6d4);
    }
    .kv-checkout-card-title > i { 
        color: var(--color-ember-red, #e34432); 
        font-size: 18px; 
    }
    
    /* Stepper digit inside title */
    .kv-step {
        flex-shrink: 0;
        width: 26px;
        height: 26px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        font-family: var(--font-inter), sans-serif;
        font-size: 12px;
        font-weight: 700;
        box-shadow: 0 3px 8px rgba(227, 68, 50, 0.25);
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .kv-checkout-card:hover .kv-step { 
        transform: scale(1.1) rotate(-6deg); 
    }

    /* ---- FORM INPUTS ---- */
    .kv-checkout-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--spacing-16, 16px);
    }
    .kv-checkout-form-group { 
        display: flex; 
        flex-direction: column; 
        position: relative;
    }
    .kv-checkout-form-group-full { 
        grid-column: 1 / -1; 
    }

    .kv-label {
        font-family: var(--font-inter), sans-serif;
        font-size: 12px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        margin-bottom: 6px;
        display: block;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: color 0.2s ease;
    }
    .kv-checkout-form-group:focus-within > .kv-label { 
        color: var(--color-deep-ember, #cf3520); 
    }

    .kv-input,
    .kv-select,
    .kv-textarea {
        width: 100%;
        padding: 12px 15px;
        background: var(--surface-paper-canvas, #fefdfc);
        border: 1.5px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-lg, 8px);
        color: var(--color-ink, #25221e);
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: transform;
    }
    .kv-input:focus,
    .kv-select:focus,
    .kv-textarea:focus {
        outline: none;
        background: #fff;
        border-color: var(--color-ember-red, #e34432);
        box-shadow: 0 0 0 4px rgba(227, 68, 50, 0.12);
        transform: translateY(-1px);
    }
    .kv-input::placeholder { color: var(--color-graphite, #94928f); }
    .kv-select option { color: var(--color-ink, #25221e); }
    .kv-textarea { resize: vertical; min-height: 120px; }

    /* Expiry divider and layout */
    .kv-card-expiry { 
        display: flex; 
        gap: 10px; 
        align-items: center; 
    }
    .kv-card-expiry .kv-input { 
        flex: 1; 
    }
    .kv-card-separator { 
        color: var(--color-graphite, #94928f); 
        font-weight: 700; 
    }

    /* Secure Banner in Form */
    .kv-secure-note {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-top: var(--spacing-20, 20px);
        padding: 14px var(--spacing-16, 16px);
        background: var(--color-mint-wash, #f0f6df);
        border: 1px solid rgba(68, 108, 61, 0.12);
        border-radius: var(--radius-lg, 8px);
        font-size: 13px;
        line-height: 1.5;
        color: var(--color-forest, #446c3d);
    }
    .kv-secure-note i { 
        margin-top: 3px; 
        font-size: 14px;
    }
    
    .kv-payment-methods { 
        margin-top: var(--spacing-20, 20px); 
        text-align: center;
        padding-top: var(--spacing-16, 16px);
        border-top: 1px solid var(--color-stone, #d7d6d4);
    }
    .kv-payment-methods img { 
        height: 26px; 
        width: auto; 
        opacity: 0.85; 
    }

    /* ---- TERMS AND CONDITIONS CHECKBOXES ---- */
    .kv-checkbox {
        width: 18px;
        height: 18px;
        margin-top: 2px;
        cursor: pointer;
        accent-color: var(--color-ember-red, #e34432);
        flex-shrink: 0;
    }
    .kv-terms-group {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: var(--spacing-12, 12px);
        padding: var(--spacing-8, 8px) var(--spacing-12, 12px) var(--spacing-12, 12px);
        border-bottom: 1px solid rgba(37, 34, 30, 0.05);
        transition: all 0.2s ease;
        border-radius: 6px;
    }
    .kv-terms-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        width: 100%;
    }
    .kv-terms-group:last-child { 
        border-bottom: none; 
        margin-bottom: 0; 
        padding-bottom: 0; 
    }
    .kv-terms-group:hover { 
        padding-left: var(--spacing-16, 16px);
        background-color: rgba(37, 34, 30, 0.02);
    }
    .kv-terms-row label {
        color: var(--color-pencil, #6f6c69);
        font-size: 13px;
        line-height: 1.5;
        cursor: pointer;
        margin: 0;
    }
    .kv-terms-row a {
        color: var(--color-cobalt-link, #0f66ae);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s ease;
    }
    .kv-terms-row a:hover { 
        color: var(--color-deep-ember, #cf3520); 
        text-decoration: underline; 
    }

    /* ---- ORDER SUMMARY SIDEBAR ---- */
    .kv-checkout-summary { 
        position: -webkit-sticky;
        position: sticky; 
        top: 110px; 
        height: fit-content; 
    }
    .kv-checkout-order {
        background: linear-gradient(180deg, var(--color-paper, #fefdfc) 0%, var(--surface-cream-wash, #fff6f0) 100%);
    }
    .kv-checkout-order-table {
        margin-bottom: var(--spacing-20, 20px);
        padding-bottom: var(--spacing-16, 16px);
        border-bottom: 1px solid var(--color-stone, #d7d6d4);
    }
    .kv-checkout-order-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--color-stone, #d7d6d4);
        font-weight: 700;
        color: var(--color-graphite, #94928f);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }
    .kv-checkout-order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: var(--spacing-12, 12px) 0;
        border-bottom: 1px dashed var(--color-stone, #d7d6d4);
    }
    .kv-checkout-order-points {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--color-ink, #25221e);
        font-size: 13.5px;
        font-weight: 600;
    }
    .kv-checkout-order-points i { 
        color: var(--color-ember-red, #e34432); 
    }
    .kv-checkout-order-price {
        font-family: var(--font-graphik, sans-serif);
        color: var(--color-ink, #25221e);
        font-weight: 700;
        font-size: 14px;
    }
    .kv-checkout-order-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: var(--spacing-16, 16px);
        padding-top: var(--spacing-16, 16px);
        border-top: 1px solid var(--color-stone, #d7d6d4);
    }
    .kv-checkout-order-total span:first-child {
        font-size: 14px;
        font-weight: 700;
        color: var(--color-pencil, #6f6c69);
    }
    .kv-checkout-order-total-value {
        font-family: var(--font-graphik, sans-serif);
        font-size: 22px;
        font-weight: 800;
        color: var(--color-ember-red, #e34432);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Captcha inputs formatting */
    .kv-captcha-group { 
        margin-bottom: var(--spacing-20, 20px); 
    }
    .kv-captcha-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        align-items: center;
    }
    .kv-captcha-display {
        background: var(--surface-paper-canvas, #fefdfc);
        border: 1.5px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-lg, 8px);
        padding: 5px 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .kv-captcha-display img { 
        max-width: 100%; 
        height: 38px; 
        border-radius: var(--radius-sm, 2.5px); 
    }

    /* ---- ACTION BUTTONS ---- */
    .kv-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 13px 20px;
        border: none;
        border-radius: var(--radius-buttons, 8px);
        font-size: 14.5px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        margin-bottom: var(--spacing-12, 12px);
        position: relative;
        overflow: hidden;
    }
    .kv-btn-accent {
        background: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        box-shadow: 0 4px 14px rgba(227, 68, 50, 0.25);
    }
    .kv-btn-accent:hover {
        background: var(--color-deep-ember, #cf3520);
        color: var(--color-paper, #fefdfc);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(227, 68, 50, 0.35);
        text-decoration: none;
    }
    /* Sheen Sweep */
    .kv-btn-accent::after {
        content: '';
        position: absolute;
        top: 0; left: -120%;
        width: 60%; height: 100%;
        background: linear-gradient(120deg, transparent, rgba(255,255,255,0.4), transparent);
        transform: skewX(-20deg);
        transition: left 0.6s ease;
    }
    .kv-btn-accent:hover::after { 
        left: 140%; 
    }
    
    .kv-btn-outline {
        background: transparent;
        color: var(--color-pencil, #6f6c69);
        border: 1px solid var(--color-stone, #d7d6d4);
    }
    .kv-btn-outline:hover {
        border-color: rgba(227, 68, 50, 0.25);
        color: var(--color-deep-ember, #cf3520);
        background: var(--color-cream, #fff6f0);
        text-decoration: none;
    }
    .kv-btn-lg { 
        padding: 14px 24px; 
    }

    .kv-summary-assure {
        margin-top: 6px;
        text-align: center;
        font-size: 12px;
        color: var(--color-graphite, #94928f);
    }
    .kv-summary-assure i { 
        color: var(--color-forest, #446c3d); 
        margin-right: 4px; 
    }

    .kv-summary-assure {
        margin-top: 6px;
        text-align: center;
        font-size: 12px;
        color: var(--color-graphite, #94928f);
    }
    .kv-summary-assure i { color: var(--color-forest, #446c3d); margin-right: 4px; }

    /* ---- ENTRANCE ANIMATIONS ---- */
    @keyframes kvFadeDown { from { opacity: 0; transform: translateY(-16px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes kvRise { from { opacity: 0; transform: translateY(22px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes kvGlowFloat { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(30px,-30px) scale(1.08); } }

    .kv-glow-mint { animation: kvGlowFloat 20s ease-in-out infinite; }
    .kv-glow-sky  { animation: kvGlowFloat 26s ease-in-out infinite reverse; }

    /* Staggered Form Section Entrance */
    .kv-checkout-form .kv-checkout-card { animation: kvRise 0.6s cubic-bezier(0.16, 1, 0.3, 1) both; }
    .kv-checkout-form .kv-checkout-card:nth-child(1) { animation-delay: 0.05s; }
    .kv-checkout-form .kv-checkout-card:nth-child(2) { animation-delay: 0.12s; }
    .kv-checkout-form .kv-checkout-card:nth-child(3) { animation-delay: 0.19s; }
    .kv-checkout-form .kv-checkout-card:nth-child(4) { animation-delay: 0.26s; }
    .kv-checkout-summary { animation: kvRise 0.7s cubic-bezier(0.16, 1, 0.3, 1) 0.2s both; }

    /* ---- Validation Errors (JQuery validation) ---- */
    label.error,
    .kv-error {
        color: #e34432;
        font-size: 12px;
        font-weight: 600;
        margin-top: 6px;
        display: block;
    }
    input.error,
    textarea.error,
    select.error {
        border-color: #e34432 !important;
        background-color: rgba(227, 68, 50, 0.04) !important;
    }
    input.error:focus,
    textarea.error:focus,
    select.error:focus { 
        border-color: #e34432 !important; 
        box-shadow: 0 0 0 4px rgba(227, 68, 50, 0.12) !important;
    }

    /* Expiry Month/Year and Checkbox styling alignment */
    #expiry_month-error,
    #expiry_year-error {
        margin-top: 6px;
    }
    .kv-captcha-display { order: 1; }
    #captcha-error,
    label#captcha-error {
        position: static !important;
        padding: 0 !important;
        order: 2;
        grid-column: 1 / -1;
        margin-top: 8px;
    }
    .kv-terms-group .kv-error,
    .kv-terms-group label.error {
        margin-top: 4px;
        padding-left: 30px;
    }

    /* ---- Responsive Adaptations ---- */
    @media (max-width: 1024px) {
        .kv-checkout-grid { grid-template-columns: 1fr; }
        .kv-checkout-summary { position: static; top: auto; }
    }
    @media (max-width: 768px) {
        .kv-checkout-section { padding: var(--spacing-32, 32px) 0 var(--spacing-64, 64px); }
        .kv-checkout-form-grid { grid-template-columns: 1fr; }
        .kv-checkout-card { padding: var(--spacing-20, 20px); }
        .kv-stepper { border-radius: 18px; flex-wrap: wrap; gap: 10px 0; padding: var(--spacing-16, 16px); }
        .kv-stepper__label { display: none; }
        .kv-stepper__bar { min-width: 16px; margin: 0 6px; }
    }
    @media (max-width: 480px) {
        .kv-checkout-card { padding: var(--spacing-16, 16px); margin-bottom: var(--spacing-16, 16px); }
    }
    @media (prefers-reduced-motion: reduce) {
        .kv-stepper, .kv-glow-mint, .kv-glow-sky,
        .kv-checkout-form .kv-checkout-card, .kv-checkout-summary { animation: none !important; }
    }
</style>
@endpush
