<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Meta: Character Set & Basic -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<!-- Meta: Title & Description -->
	<title>@yield('title', 'Venture Asia - Trade Forex, Indices, Commodities & Shares')</title>
	<meta name="title" content="Venture Asia - Trade Forex, Indices, Commodities &amp; Shares">
	<meta name="description"
		content="Venture Asia is a multi-asset broker offering CFD trading on forex, indices, commodities and shares with deep liquidity, fast execution and 24/5 support.">
	<meta name="keywords"
		content="online art classes, digital illustration, character design, graphic design, drawing courses, painting tutorials, concept art, animation design, artistic education, professional art training">
	<meta name="author" content="Core Coach Lab">

	<!-- Meta: Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:title" content="@yield('title', 'Core Coach Lab - Professional Online Art Courses')">
	<meta property="og:description"
		content="Master digital illustration, character design, traditional fine arts, graphic design, and advanced drawing at Core Coach Lab. Learn from industry professionals.">
	@if(isset($og_image))
		<meta property="og:image" content="{{ $og_image }}">
	@else
		<meta property="og:image" content="{{ asset('assets/images/logo.png') }}">
	@endif
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:site_name" content="Core Coach Lab">
	<meta property="og:locale" content="en_US">

	<!-- Meta: Twitter Card -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="@yield('title', 'Core Coach Lab - Professional Online Art Courses')">
	<meta name="twitter:description"
		content="Master digital illustration, character design, traditional fine arts, graphic design, and advanced drawing at Core Coach Lab. Learn from industry professionals.">
	@if(isset($og_image))
		<meta name="twitter:image" content="{{ $og_image }}">
	@else
		<meta name="twitter:image" content="{{ asset('assets/images/logo.png') }}">
	@endif
	<meta name="twitter:site" content="@ArtifyAcademy">
	<meta name="twitter:creator" content="@ArtifyAcademy">

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ url('assets/images/favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ url('assets/images/favicon.ico') }}" type="image/x-icon">

	<!-- Stylesheets: Core Framework -->
	<link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ url('assets/plugins/revolution/css/settings.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ url('assets/plugins/revolution/css/layers.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ url('assets/plugins/revolution/css/navigation.css') }}" rel="stylesheet" type="text/css">

	<!-- Stylesheets: Font Awesome Icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
		integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Stylesheets: Flag Icons (language selector) -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />

	<!-- Stylesheets: Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;475;500;600;625;700&display=swap"
		rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap"
		rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Caecilia:wght@400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Shantell+Sans:wght@400&display=swap" rel="stylesheet">
	<link
		href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Great+Vibes&display=swap"
		rel="stylesheet">

	<!-- Stylesheets: Application -->
	<link href="{{ url('assets/css/global.css') }}" rel="stylesheet">
	<link href="{{ url('assets/css/style.css') }}" rel="stylesheet">
	<link href="{{ url('assets/css/responsive.css') }}" rel="stylesheet">
	<link href="{{ url('assets/css/color-utilities.css') }}" rel="stylesheet">
	<link href="{{ url('assets/css/theme.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ url('assets/css/app.css') }}">
	<link rel="stylesheet" href="{{ url('assets/css/header.css') }}">
	<link rel="stylesheet" href="{{ url('assets/css/footer.css') }}">
	<link rel="stylesheet" href="{{ url('assets/css/home-hero.css') }}">
	<link rel="stylesheet" href="{{ url('assets/css/venture-theme.css') }}">
	{{-- Scoped reference styles: must load after the theme (see top of file) --}}
	<link rel="stylesheet" href="{{ url('assets/css/markets.css') }}">

	<!-- Cookie Consent Scripts -->
	@cookieconsentscripts
</head>