<!-- Main Footer -->
{{-- Styles: public/assets/css/footer.css --}}
@php
	// Replace '#' with real routes as the pages are built.
	$vfCompany = 'Venture Asia';
	$vfAddress = '3 Emerald Park, Trianon, Quatre Bornes, 72257, Mauritius.';
	$vfEmail = 'support@ventureasiamarkets.com';
	$vfColumns = [
		'Markets' => [
			['label' => 'Forex', 'url' => route('markets.forex')],
			['label' => 'Indices', 'url' => route('markets.indices')],
			['label' => 'Commodities', 'url' => route('markets.commodities')],
			['label' => 'Shares', 'url' => route('markets.shares')],
		],
		'Trading' => [
			['label' => 'Trading Platforms', 'url' => route('under-construction')],
			['label' => 'Copy Trading', 'url' => route('copy-trading')],
			['label' => 'Account Types', 'url' => route('accounts')],
			['label' => 'Deposits & Withdrawals', 'url' => route('funding')],
		],
		'Company & Legal' => [
			['label' => 'About us', 'url' => route('about-us')],
			['label' => 'Help Center', 'url' => route('help')],
			['label' => 'Legal Documents', 'url' => route('legal.documents')],
			['label' => 'Contact', 'url' => route('contact')],
		],
	];
@endphp
<footer class="vf" role="contentinfo">
	<div class="vf__container">

		<div class="vf__top">
			<div>
				<a class="vf__brand" href="{{ route('home') }}">
					<img class="vf__brand-mark" src="{{ url('assets/images/venture-logo.png') }}" alt="Venture Asia logo">
				</a>
				<p class="vf__contact">
					<strong>{{ $vfCompany }}</strong><br>
					{{ $vfAddress }}
				</p>
				<p class="vf__contact vf__contact--service">
					Customer service<br>
					<a class="vf__accent" href="mailto:{{ $vfEmail }}">{{ $vfEmail }}</a><br>
					<span class="vf__dim">Support available 24 hours / 5 days</span>
				</p>
			</div>

			@foreach($vfColumns as $heading => $links)
				<div>
					<h6 class="vf__heading">{{ $heading }}</h6>
					<div class="vf__links">
						@foreach($links as $link)
							<a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
						@endforeach
					</div>
				</div>
			@endforeach
		</div>

		<div class="vf__merchant">
			<div class="vf__pay-row">
				<span class="vf__pay-badge">
					<svg viewBox="0 0 48 24" xmlns="http://www.w3.org/2000/svg" aria-label="Visa"><text x="24" y="17" text-anchor="middle" font-family="Arial, sans-serif" font-weight="700" font-style="italic" font-size="15" letter-spacing="0.5" fill="#1A1F71" style="font-size: 15px">VISA</text></svg>
				</span>
				<span class="vf__pay-badge">
					<svg viewBox="0 0 48 24" xmlns="http://www.w3.org/2000/svg" aria-label="Mastercard"><circle cx="19" cy="12" r="9" fill="#EB001B"/><circle cx="29" cy="12" r="9" fill="#F79E1B"/><path d="M24 5.2a9 9 0 000 13.6 9 9 0 000-13.6z" fill="#FF5F00"/></svg>
				</span>
				<span class="vf__pay-badge">
					<svg viewBox="0 0 48 24" xmlns="http://www.w3.org/2000/svg" aria-label="American Express"><rect width="48" height="24" rx="3" fill="#006FCF"/><text x="24" y="15" text-anchor="middle" font-family="Arial, sans-serif" font-weight="700" font-size="9" letter-spacing="0.5" fill="#FFFFFF" style="font-size: 9px">AMEX</text></svg>
				</span>
				<span class="vf__pay-badge">
					<svg viewBox="0 0 48 24" xmlns="http://www.w3.org/2000/svg" aria-label="JCB"><rect x="1" y="2" width="14" height="20" rx="2" fill="#0F4C97"/><rect x="17" y="2" width="14" height="20" rx="2" fill="#B5121B"/><rect x="33" y="2" width="14" height="20" rx="2" fill="#1A8C3A"/><text x="8" y="16" text-anchor="middle" font-family="Arial, sans-serif" font-weight="700" font-size="11" fill="#FFFFFF" style="font-size: 11px">J</text><text x="24" y="16" text-anchor="middle" font-family="Arial, sans-serif" font-weight="700" font-size="11" fill="#FFFFFF" style="font-size: 11px">C</text><text x="40" y="16" text-anchor="middle" font-family="Arial, sans-serif" font-weight="700" font-size="11" fill="#FFFFFF" style="font-size: 11px">B</text></svg>
				</span>
				<span class="vf__pay-label">Secured card payments</span>
			</div>
			<strong>Merchant outlet country:</strong> Mauritius.
			<strong>Transaction currency:</strong> all card transactions are processed in United States Dollar (US Dollar, symbol $, code USD).
			Card details are transmitted over an encrypted TLS 1.2+ connection and handled by PCI-DSS compliant payment processors;
			{{ $vfCompany }} does not store full card numbers.
			See our <a class="vf__accent" href="{{ route('legal.refund-policy') }}">Refund &amp; Cancellation Policy</a>,
			<a class="vf__accent" href="{{ route('legal.delivery-policy') }}">Service Delivery Policy</a> and
			<a class="vf__accent" href="{{ route('legal.privacy-policy') }}">Privacy Policy</a>.
		</div>

		<div class="vf__strip">
			Venture Asia is authorised and regulated by the Financial Services Commission (FSC) of Mauritius as a Full-Service Investment Dealer (excluding Underwriting), under licence number GB 26205976.<br>
			Registered address: {{ $vfAddress }}
		</div>

		<div class="vf__strip">
			<strong class="vf__strong">Risk warning:</strong> Trading derivatives and leveraged products carries a high level of risk to your capital and you may lose more than your initial deposit.
			These products are not suitable for all investors. Past performance is not a reliable indicator of future results.
			The information on this website is general in nature and does not constitute financial advice. Please consider our
			<a class="vf__accent" href="{{ route('legal.documents') }}#risk">Risk Disclosure</a> and seek independent advice if necessary.
			The services described may not be available in all jurisdictions and are not directed at residents of any country where such distribution would be contrary to local law.
		</div>

		<div class="vf__bottom">
			<span class="vf__copyright">&copy; {{ date('Y') }} {{ $vfCompany }}. All Rights Reserved.</span>
			<div class="vf__legal-links">
				<a href="{{ route('help') }}">Help Center</a>
				<a href="{{ route('legal.documents') }}">Legal Documents</a>
			</div>
		</div>

	</div>
</footer>

{{-- Floating contact button (same behaviour as ventureasiamarkets.com) --}}
<div class="vfc" id="vfc">
	<div class="vfc__bubble" id="vfcBubble">
		Hi, how can we help you?
		<button type="button" class="vfc__bubble-close" id="vfcBubbleClose" aria-label="Close message">
			<svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2" fill="none"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
		</button>
	</div>
	<button type="button" class="vfc__btn" id="vfcBtn" aria-label="Contact options" aria-expanded="false" aria-controls="vfcMenu">
		<span class="vfc__icon-default">
			<svg viewBox="0 0 24 24" width="28" height="28" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
		</span>
		<span class="vfc__icon-close">
			<svg viewBox="0 0 24 24" width="28" height="28" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
		</span>
	</button>
	<div class="vfc__menu" id="vfcMenu">
		{{-- Live chat isn't set up yet; point this at the chat provider when ready. --}}
		<a href="{{ route('under-construction') }}" class="vfc__item">
			<span class="vfc__label">Live Chat</span>
			<span class="vfc__icon-wrap">
				<svg viewBox="0 0 24 24" width="22" height="22" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
			</span>
		</a>
		<a href="{{ route('contact') }}" class="vfc__item">
			<span class="vfc__label">Callback</span>
			<span class="vfc__icon-wrap">
				<svg viewBox="0 0 24 24" width="22" height="22" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
			</span>
		</a>
	</div>
</div>
<script>
	(function () {
		var root = document.getElementById('vfc');
		if (!root) return;
		var btn = document.getElementById('vfcBtn');
		var menu = document.getElementById('vfcMenu');
		var bubble = document.getElementById('vfcBubble');
		function setOpen(open) {
			btn.classList.toggle('vfc__btn--active', open);
			menu.classList.toggle('vfc__menu--open', open);
			bubble.classList.toggle('vfc__bubble--hidden', open);
			btn.setAttribute('aria-expanded', open ? 'true' : 'false');
		}
		btn.addEventListener('click', function () { setOpen(!menu.classList.contains('vfc__menu--open')); });
		document.addEventListener('mousedown', function (e) {
			if (menu.classList.contains('vfc__menu--open') && !root.contains(e.target)) setOpen(false);
		});
		document.addEventListener('keydown', function (e) { if (e.key === 'Escape') setOpen(false); });
		document.getElementById('vfcBubbleClose').addEventListener('click', function (e) {
			e.stopPropagation();
			bubble.style.display = 'none';
		});
	})();
</script>
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
<script src="{{ url('assets/js/va-sections.js') }}"></script>
<script src="{{ url('assets/js/markets.js') }}"></script>

<script>
    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
     $('.alert:not(.alert-dismissible)').slideUp();
     $('.modern-alert').fadeOut(function() {
       $(this).remove();
     });
 }, 5000);

</script>


</body>
</html>