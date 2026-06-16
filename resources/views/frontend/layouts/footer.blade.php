<!-- Main Footer -->
{{-- Footer styles moved to assets/css/app.css --}}

<footer class="af-footer" role="contentinfo">
    <span class="af-footer__glow" aria-hidden="true"></span>
    <div class="af-footer__top">
        <div class="af-container">

            <!-- Featured newsletter CTA -->
            <section class="af-cta" aria-label="Newsletter">
                <div class="af-cta__copy">
                    <span class="af-cta__eyebrow">{{ __('common.footer.newsletter_eyebrow') }}</span>
                    <h3 class="af-cta__title">{{ __('common.footer.newsletter_title') }}</h3>
                    <p class="af-cta__desc">{{ __('common.footer.newsletter_description') }}</p>
                </div>
                <div class="af-cta__form">
                    <div class="subscribe-form">
                        <form>
                            <div class="form-group">
                                <input type="email" name="email" class="email" placeholder="{{ __('common.footer.newsletter_email_placeholder') }}" aria-label="{{ __('common.footer.newsletter_email_placeholder') }}" required>
                                <button type="submit" class="theme-btn" aria-label="{{ __('common.stay_updated') }}"><i class="fas fa-paper-plane" aria-hidden="true"></i></button>
                            </div>
                        </form>
                        <p class="text-success suces_rinfo" role="status" style="display: none;">{{ __('common.footer.newsletter_success') }}</p>
                    </div>
                </div>
            </section>

            <div class="af-footer__grid">

                <!-- Column 1: Brand -->
                <div class="af-footer__brand">
                    <a href="{{route('home')}}" class="af-footer__logo">
                        <img src="{{url('assets/images/logo.jpg')}}" alt="{{ $misc['Company Name'] ?? __('common.company_name') }}">
                    </a>
                    <ul class="af-footer__contact">
                        <li>
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                            <a href="mailto:{{ $misc['Company Email'] ?? __('common.company_email') }}">{{ $misc['Company Email'] ?? __('common.company_email') }}</a>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            <span>{{ $misc['Company Address'] ?? __('common.company_Address') }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Column 2: Platform -->
                <nav class="af-footer__col" aria-label="{{ __('common.footer.platform') }}">
                    <h4 class="af-footer__heading">{{ __('common.footer.platform') }}</h4>
                    <ul class="af-footer__links">
                        <li><a href="{{route('home')}}">{{ __('common.footer.home') }}</a></li>
                        <li><a href="{{route('product-lists')}}">{{ __('common.footer.catalog') }}</a></li>
                        <li><a href="{{route('about-us')}}">{{ __('common.footer.about') }}</a></li>
                        <li><a href="{{route('contact')}}">{{ __('common.footer.contact') }}</a></li>
                    </ul>
                </nav>

                <!-- Column 3: Support -->
                <nav class="af-footer__col" aria-label="{{ __('common.footer.support') }}">
                    <h4 class="af-footer__heading">{{ __('common.footer.support') }}</h4>
                    <ul class="af-footer__links">
                        <li><a href="{{route('pages','privacy-policy')}}">{{ __('common.footer.privacy_policy') }}</a></li>
                        <li><a href="{{route('pages','terms-conditions')}}">{{ __('common.footer.terms_policy') }}</a></li>
                        <li><a href="{{route('pages','refund-policy')}}">{{ __('common.footer.refund_policy') }}</a></li>
                        <li><a href="{{route('pages','delivery-policy')}}">{{ __('common.footer.delivery_policy') }}</a></li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="af-footer__bottom">
        <div class="af-container">
            <div class="af-footer__bottom-inner">
                <div class="af-footer__copyright">
                    &copy; {{ date('Y') }} <a href="{{route('home')}}">{{ $misc['Company Name'] ?? __('common.company_name') }}.</a> {{ __('common.footer.copyright_text') }}
                </div>
                <div class="af-footer__payment">
                    <img src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('common.footer.accepted_payment_methods') }}">
                </div>
            </div>
        </div>
    </div>
</footer>
	<!--End Main Footer -->

</div><!-- End Page Wrapper -->

<!-- Scroll To Top -->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>
<script src="{{url('assets/js/jquery.js')}}"></script> 
<script src="{{url('assets/js/popper.min.js')}}"></script>
<!--Revolution Slider-->
<script src="{{url('assets/plugins/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
<script src="{{url('assets/js/main-slider-script.js')}}"></script>
<!--Revolution Slider-->
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/jquery.fancybox.js')}}"></script>
<script src="{{url('assets/js/jquery-ui.js')}}"></script>
<script src="{{url('assets/js/wow.js')}}"></script>
<script src="{{url('assets/js/appear.js')}}"></script>
<script src="{{url('assets/js/jquery.countdown.js')}}"></script>
<script src="{{url('assets/js/select2.min.js')}}"></script>
<script src="{{url('assets/js/swiper.min.js')}}"></script>
<script src="{{url('assets/js/owl.js')}}"></script>
<script src="{{url('assets/js/script.js')}}"></script>

<script>
    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
     $('.alert:not(.alert-dismissible)').slideUp();
     $('.modern-alert').fadeOut(function() {
       $(this).remove();
     });
 }, 5000);
$(".suces_rinfo").hide();

$(".subscribe-form").on('submit', function(event){
    event.preventDefault();
    $(".suces_rinfo").show();

    // reset form
    $(".subscribe-form form")[0].reset();

    // hide success message after 5 seconds
    setTimeout(function(){
        $(".suces_rinfo").fadeOut();
    }, 5000); 
});
</script>


</body>
</html>