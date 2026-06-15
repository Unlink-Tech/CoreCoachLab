<!-- Main Footer -->
<style>
    /* ============================================================
       ARTIFY ACADEMY — FOOTER (new warm theme)
       Visual redesign only; routes & handlers preserved.
       ============================================================ */
    .af-footer {
        position: relative;
        overflow: hidden;
        background: var(--color-cream, #fff6f0);
        color: var(--color-ink, #25221e);
        border-top: 1px solid var(--color-stone, #d7d6d4);
        font-family: var(--font-inter, 'Inter', sans-serif);
        isolation: isolate;
    }

    /* gradient accent line bookending the page (matches header) */
    .af-footer::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg,
            var(--color-ember-red, #e34432) 0%,
            var(--color-teal-dusk, #497d7e) 35%,
            var(--color-forest, #446c3d) 60%,
            var(--color-ember-red, #e34432) 100%);
        opacity: .8;
        z-index: 2;
    }

    /* soft decorative washes — the "studio light" atmosphere */
    .af-footer__glow {
        position: absolute;
        inset: 0;
        z-index: -1;
        pointer-events: none;
        overflow: hidden;
    }
    .af-footer__glow::before,
    .af-footer__glow::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
    }
    .af-footer__glow::before {
        width: 460px; height: 460px;
        top: -180px; right: -120px;
        background: radial-gradient(circle, rgba(220,234,255,0.55) 0%, transparent 70%);
    }
    .af-footer__glow::after {
        width: 420px; height: 420px;
        bottom: -200px; left: -140px;
        background: radial-gradient(circle, rgba(240,246,223,0.7) 0%, transparent 70%);
    }

    .af-container {
        position: relative;
        z-index: 1;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
    }

    .af-footer__top { padding: 64px 0 56px; }

    /* ---- Featured newsletter CTA banner ---- */
    .af-cta {
        position: relative;
        overflow: hidden;
        display: grid;
        grid-template-columns: 1.1fr 1fr;
        align-items: center;
        gap: 32px;
        padding: 40px 48px;
        margin-bottom: 64px;
        border-radius: 24px;
        border: 1px solid var(--color-stone, #d7d6d4);
        background:
            radial-gradient(120% 140% at 100% 0%, rgba(220,234,255,0.55) 0%, transparent 55%),
            radial-gradient(120% 140% at 0% 100%, rgba(240,246,223,0.7) 0%, transparent 55%),
            linear-gradient(135deg, #fffefd 0%, #fff6f0 100%);
        box-shadow: 0 18px 40px rgba(37, 34, 30, 0.06);
    }
    .af-cta__eyebrow {
        display: inline-block;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        color: var(--color-deep-ember, #cf3520);
        margin-bottom: 10px;
    }
    .af-cta__title {
        font-family: var(--font-graphik, 'Inter', sans-serif);
        font-size: 30px;
        line-height: 1.15;
        font-weight: 700;
        letter-spacing: -0.02em;
        color: var(--color-ink, #25221e);
        margin: 0 0 8px;
    }
    .af-cta__desc {
        font-size: 15px;
        line-height: 1.6;
        color: var(--color-pencil, #6f6c69);
        margin: 0;
        max-width: 420px;
    }
    .af-cta__form { justify-self: end; width: 100%; max-width: 440px; }

    .af-footer__grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 48px;
        align-items: start;
    }

    /* ---- Brand column ---- */
    .af-footer__logo { display: inline-block; line-height: 0; transition: opacity .25s ease; }
    .af-footer__logo:hover { opacity: .85; }
    .af-footer__logo img { max-width: 190px; height: auto; }

    .af-footer__tagline {
        position: relative;
        display: inline-block;
        margin: 18px 0 24px;
        padding-bottom: 12px;
        font-family: var(--font-graphik, 'Inter', sans-serif);
        font-size: 19px;
        font-weight: 600;
        letter-spacing: -0.01em;
        color: var(--color-ink, #25221e);
    }
    /* hand-painted brush underline */
    .af-footer__tagline::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 64px;
        height: 4px;
        border-radius: 4px;
        background: linear-gradient(90deg, var(--color-ember-red, #e34432), var(--color-teal-dusk, #497d7e));
    }

    .af-footer__contact { list-style: none; margin: 0; padding: 0; }
    .af-footer__contact li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 12px;
        font-size: 15px;
        line-height: 1.5;
        color: var(--color-pencil, #6f6c69);
    }
    .af-footer__contact li i {
        color: var(--color-ember-red, #e34432);
        font-size: 14px;
        margin-top: 4px;
        flex-shrink: 0;
        width: 16px;
        text-align: center;
    }
    .af-footer__contact a {
        color: var(--color-pencil, #6f6c69);
        text-decoration: none;
        transition: color .2s ease;
    }
    .af-footer__contact a:hover { color: var(--color-deep-ember, #cf3520); }

    /* ---- Heading (eyebrow style) ---- */
    .af-footer__heading {
        margin: 4px 0 20px;
        font-family: var(--font-inter, 'Inter', sans-serif);
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--color-pencil, #6f6c69);
    }

    /* ---- Link lists ---- */
    .af-footer__links { list-style: none; margin: 0; padding: 0; }
    .af-footer__links li { margin-bottom: 12px; }
    .af-footer__links a {
        position: relative;
        display: inline-block;
        color: var(--color-ink, #25221e);
        font-size: 15px;
        text-decoration: none;
        transition: color .2s ease, transform .2s ease;
    }
    .af-footer__links a:hover {
        color: var(--color-deep-ember, #cf3520);
        transform: translateX(3px);
    }

    /* ---- Newsletter ---- */
    .af-footer__news-desc {
        margin: 0 0 18px;
        font-size: 15px;
        line-height: 1.55;
        color: var(--color-pencil, #6f6c69);
        max-width: 320px;
    }
    .af-footer .subscribe-form .form-group {
        display: flex;
        align-items: stretch;
        background: var(--color-paper, #fefdfc);
        border: 1.5px solid var(--color-stone, #d7d6d4);
        border-radius: 999px;
        padding: 6px 6px 6px 8px;
        max-width: 380px;
        box-shadow: 0 1px 2px rgba(37, 34, 30, 0.04);
        transition: border-color .25s ease, box-shadow .25s ease, transform .25s ease;
    }
    .af-footer .subscribe-form .form-group:hover {
        border-color: var(--color-graphite, #94928f);
    }
    .af-footer .subscribe-form .form-group:focus-within {
        border-color: var(--color-ember-red, #e34432);
        box-shadow: 0 0 0 4px rgba(227, 68, 50, 0.12);
        transform: translateY(-1px);
    }
    .af-footer .subscribe-form input.email {
        flex: 1 1 auto;
        border: none !important;
        background: transparent !important;
        outline: none !important;
        padding: 11px 14px !important;
        font-family: var(--font-inter, 'Inter', sans-serif) !important;
        font-size: 15px !important;
        color: var(--color-ink, #25221e) !important;
        box-shadow: none !important;
        min-width: 0;
        letter-spacing: 0.01em;
    }
    .af-footer .subscribe-form input.email::placeholder { color: var(--color-graphite, #94928f) !important; }
    .af-footer .subscribe-form button.theme-btn {
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 44px;
        padding: 0 !important;
        border: none !important;
        border-radius: 999px !important;
        background: linear-gradient(135deg, var(--color-ember-red, #e34432), var(--color-deep-ember, #cf3520)) !important;
        color: var(--color-paper, #fefdfc) !important;
        font-size: 15px !important;
        cursor: pointer;
        transition: transform .25s cubic-bezier(.34,1.56,.64,1), box-shadow .25s ease !important;
        box-shadow: 0 4px 12px rgba(227, 68, 50, 0.32) !important;
    }
    .af-footer .subscribe-form button.theme-btn:hover {
        transform: translateY(-1px) scale(1.04);
        box-shadow: 0 6px 16px rgba(227, 68, 50, 0.42) !important;
    }
    .af-footer .subscribe-form button.theme-btn:hover i { animation: afPlane .5s ease; }
    @keyframes afPlane {
        0% { transform: translate(0,0); }
        40% { transform: translate(3px,-3px) rotate(8deg); }
        100% { transform: translate(0,0); }
    }
    .af-footer .subscribe-form .suces_rinfo {
        margin-top: 14px;
        font-size: 14px;
        color: var(--color-forest, #446c3d) !important;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }
    .af-footer .subscribe-form .suces_rinfo::before {
        content: '\f058'; /* fa check-circle */
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        color: var(--color-forest, #446c3d);
    }

    /* ---- Bottom bar ---- */
    .af-footer__bottom {
        border-top: 1px solid var(--color-stone, #d7d6d4);
        padding: 20px 0;
    }
    .af-footer__bottom-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }
    .af-footer__copyright {
        font-size: 14px;
        color: var(--color-pencil, #6f6c69);
    }
    .af-footer__copyright a {
        color: var(--color-ink, #25221e);
        font-weight: 600;
        text-decoration: none;
        transition: color .2s ease;
    }
    .af-footer__copyright a:hover { color: var(--color-deep-ember, #cf3520); }

    .af-footer__payment {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 999px;
        box-shadow: 0 1px 2px rgba(37, 34, 30, 0.04);
        transition: box-shadow .25s ease, transform .25s ease;
    }
    .af-footer__payment:hover {
        box-shadow: 0 4px 12px rgba(37, 34, 30, 0.08);
        transform: translateY(-1px);
    }
    .af-footer__payment img {
        height: 24px;
        width: auto;
        display: block;
        opacity: .85;
        filter: saturate(.9);
        transition: opacity .25s ease;
    }
    .af-footer__payment:hover img { opacity: 1; }

    @media (max-width: 575px) {
        .af-footer__bottom-inner { flex-direction: column; text-align: center; gap: 14px; }
    }

    /* form fills the CTA column */
    .af-cta .subscribe-form .form-group { max-width: 100% !important; }

    /* ---- Responsive ---- */
    @media (max-width: 991px) {
        .af-cta {
            grid-template-columns: 1fr;
            gap: 24px;
            padding: 36px 32px;
            margin-bottom: 52px;
        }
        .af-cta__form { justify-self: stretch; max-width: 100%; }
        .af-footer__grid {
            grid-template-columns: 1.5fr 1fr 1fr;
            gap: 40px 32px;
        }
    }
    @media (max-width: 700px) {
        .af-footer__grid {
            grid-template-columns: 1fr 1fr;
            gap: 36px 28px;
        }
        .af-footer__brand { grid-column: 1 / -1; }
    }
    @media (max-width: 575px) {
        .af-footer__top { padding: 48px 0 36px; }
        .af-cta { padding: 28px 22px; border-radius: 18px; }
        .af-cta__title { font-size: 24px; }
        .af-footer__grid {
            grid-template-columns: 1fr;
            gap: 32px;
        }
    }
</style>

<footer class="af-footer" role="contentinfo">
    <span class="af-footer__glow" aria-hidden="true"></span>
    <div class="af-footer__top">
        <div class="af-container">

            <!-- Featured newsletter CTA -->
            <section class="af-cta" aria-label="Newsletter">
                <div class="af-cta__copy">
                    <span class="af-cta__eyebrow">Stay Inspired</span>
                    <h3 class="af-cta__title">Bring your ideas to life.</h3>
                    <p class="af-cta__desc">Get updates on new courses and academy news — fresh inspiration, straight to your inbox.</p>
                </div>
                <div class="af-cta__form">
                    <div class="subscribe-form">
                        <form>
                            <div class="form-group">
                                <input type="email" name="email" class="email" placeholder="{{ __('common.your_email_address') }}" aria-label="{{ __('common.your_email_address') }}" required>
                                <button type="submit" class="theme-btn" aria-label="{{ __('common.stay_updated') }}"><i class="fas fa-paper-plane" aria-hidden="true"></i></button>
                            </div>
                        </form>
                        <p class="text-success suces_rinfo" role="status" style="display: none;">{{ __('common.thanks_for_subscribing') }}</p>
                    </div>
                </div>
            </section>

            <div class="af-footer__grid">

                <!-- Column 1: Brand -->
                <div class="af-footer__brand">
                    <a href="{{route('home')}}" class="af-footer__logo">
                        <img src="{{url('assets/images/logo.png')}}" alt="{{ $misc['Company Name'] ?? __('common.company_name') }}">
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
                <nav class="af-footer__col" aria-label="{{ __('common.platform') }}">
                    <h4 class="af-footer__heading">{{ __('common.platform') }}</h4>
                    <ul class="af-footer__links">
                        <li><a href="{{route('home')}}">{{ __('common.home') }}</a></li>
                        <li><a href="{{route('product-lists')}}">{{ __('common.catalog') }}</a></li>
                        <li><a href="{{route('about-us')}}">{{ __('common.about') }}</a></li>
                        <li><a href="{{route('contact')}}">{{ __('common.contact') }}</a></li>
                    </ul>
                </nav>

                <!-- Column 3: Support -->
                <nav class="af-footer__col" aria-label="{{ __('common.support') }}">
                    <h4 class="af-footer__heading">{{ __('common.support') }}</h4>
                    <ul class="af-footer__links">
                        <li><a href="{{route('pages','privacy-policy')}}">{{ __('common.privacy_policy') }}</a></li>
                        <li><a href="{{route('pages','terms-conditions')}}">{{ __('common.terms_policy') }}</a></li>
                        <li><a href="{{route('pages','refund-policy')}}">{{ __('common.refund_policy') }}</a></li>
                        <li><a href="{{route('pages','delivery-policy')}}">{{ __('common.delivery_policy') }}</a></li>
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
                    &copy; {{ date('Y') }} <a href="{{route('home')}}">{{ $misc['Company Name'] ?? __('common.company_name') }}</a>. {{ __('common.all_rights_reserved') }}
                </div>
                <div class="af-footer__payment">
                    <img src="{{ asset('assets/images/payment.png') }}" alt="Accepted payment methods">
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