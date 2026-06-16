<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta: Character Set & Basic -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<!-- Meta: Title & Description -->
	<title>@yield('title', 'Artify Academy - Online Art Classes & Digital Illustration Courses')</title>
	<meta name="title" content="Artify Academy - Professional Online Art Courses">
	<meta name="description" content="Learn professional art skills at Artify Academy. Explore online courses in digital illustration, traditional fine arts, character design, graphic design, and advanced drawing techniques.">
	<meta name="keywords" content="online art classes, digital illustration, character design, graphic design, drawing courses, painting tutorials, concept art, animation design, artistic education, professional art training">
	<meta name="author" content="Artify Academy">

	<!-- Meta: Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:title" content="@yield('title', 'Artify Academy - Professional Online Art Courses')">
	<meta property="og:description" content="Master digital illustration, character design, traditional fine arts, graphic design, and advanced drawing at Artify Academy. Learn from industry professionals.">
	@if(isset($og_image))
		<meta property="og:image" content="{{ $og_image }}">
	@else
		<meta property="og:image" content="{{ asset('assets/images/logo.jpg') }}">
	@endif
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:site_name" content="Artify Academy">
	<meta property="og:locale" content="en_US">

	<!-- Meta: Twitter Card -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="@yield('title', 'Artify Academy - Professional Online Art Courses')">
	<meta name="twitter:description" content="Master digital illustration, character design, traditional fine arts, graphic design, and advanced drawing at Artify Academy. Learn from industry professionals.">
	@if(isset($og_image))
		<meta name="twitter:image" content="{{ $og_image }}">
	@else
		<meta name="twitter:image" content="{{ asset('assets/images/logo.jpg') }}">
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVJkEZSMUkrQ6usKu8zIstOWilQLyUChqkZ1DywcksPfdSV1XJ9FSUQTcnWEk5Zr2v+n7Pp1/0A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Stylesheets: Flag Icons (language selector) -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />

	<!-- Stylesheets: Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;475;500;600;625;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Caecilia:wght@400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Shantell+Sans:wght@400&display=swap" rel="stylesheet">

	<!-- Stylesheets: Application -->
	<link href="{{ url('assets/css/global.css') }}" rel="stylesheet">
	<link href="{{ url('assets/css/style.css') }}" rel="stylesheet">
	<link href="{{ url('assets/css/responsive.css') }}" rel="stylesheet">
	<link href="{{ url('assets/css/color-utilities.css') }}" rel="stylesheet">
	<link href="{{ url('assets/css/theme.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ url('assets/css/app.css') }}">

	<!-- Cookie Consent Scripts -->
	@cookieconsentscripts
</head>

