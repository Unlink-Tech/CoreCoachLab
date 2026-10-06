@extends('frontend.layouts.main')
@section('page-body-class', 'page-news')
@section('title','Market News')
@section('main-content')

{{-- Layout and content mirror ventureasiamarkets.com/resources/news. Styles: public/assets/css/home-hero.css --}}

{{-- Page hero --}}
<section class="va-page-hero">
    <div class="va-hero__container">
        <div class="va-breadcrumb" data-va-reveal><a href="{{ route('home') }}">Home</a> / Resources / News</div>
        <div style="max-width: 760px;">
            <h1 data-va-reveal>Market News</h1>
            <p class="va-lead" data-va-reveal>Stay ahead of the markets with real-time global news coverage, top financial stories, and economic updates.</p>
        </div>
    </div>
</section>

{{-- News feed: TradingView timeline, re-created when the market tab changes --}}
<section class="va-section" style="padding-top: 0;">
    <div class="va-hero__container">
        <div class="va-glassbox va-news" data-va-reveal>
            <div class="va-news__tabs" role="tablist" aria-label="News market">
                <button type="button" class="va-news__tab is-active" role="tab" aria-selected="true" data-va-news="forex">Forex</button>
                <button type="button" class="va-news__tab" role="tab" aria-selected="false" data-va-news="stock">Shares</button>
                <button type="button" class="va-news__tab" role="tab" aria-selected="false" data-va-news="index">Indices</button>
            </div>
            <div class="tradingview-widget-container va-news__feed" id="vaNewsFeed"></div>
        </div>
    </div>
</section>

@push('scripts')
<script>
(function () {
    var feed = document.getElementById('vaNewsFeed');
    if (!feed) return;
    var tabs = Array.prototype.slice.call(document.querySelectorAll('[data-va-news]'));
    function load(market) {
        feed.innerHTML = '<div class="tradingview-widget-container__widget"></div>';
        var s = document.createElement('script');
        s.src = 'https://s3.tradingview.com/external-embedding/embed-widget-timeline.js';
        s.type = 'text/javascript';
        s.async = true;
        s.innerHTML = JSON.stringify({
            displayMode: 'compact', feedMode: 'market', market: market, colorTheme: 'dark',
            isTransparent: true, locale: 'en', width: '100%', height: '580'
        });
        feed.appendChild(s);
    }
    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            if (tab.classList.contains('is-active')) return;
            tabs.forEach(function (t) {
                var on = t === tab;
                t.classList.toggle('is-active', on);
                t.setAttribute('aria-selected', on ? 'true' : 'false');
            });
            load(tab.getAttribute('data-va-news'));
        });
    });
    load('forex');
})();
</script>
@endpush

@endsection
