@include('frontend.layouts.head')

<body class="@yield('page-body-class')">

<div class="page-wrapper">

@include('frontend.layouts.header')
@yield('main-content')
@include('frontend.layouts.footer')
@stack('styles')
@stack('scripts')

</div>
</body>
</html>