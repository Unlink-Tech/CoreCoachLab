@extends('frontend.layouts.main')
@section('page-body-class', 'page-legal-documents')
@section('title','Legal Documents')
@section('main-content')

{{-- Layout and content mirror ventureasiamarkets.com/legal/documents.
     Document text lives in resources/data/legal-documents.json. --}}
@php
    $vaLegalDocs = json_decode(file_get_contents(resource_path('data/legal-documents.json')), true);
@endphp

{{-- Page hero --}}
<section class="va-page-hero">
    <div class="va-hero__container">
        <div class="va-breadcrumb" data-va-reveal>
            <a href="{{ route('home') }}">Home</a> / <a href="{{ route('about-us') }}">Company</a> / Legal Documents
        </div>
        <div style="max-width: 780px;">
            <h1 data-va-reveal>Legal &amp; Regulations</h1>
            <p class="va-lead" data-va-reveal>Review our customer agreements, regulatory framework, best execution guidelines, and safety policies. We stand for transparency at every stage of your trading journey.</p>
        </div>
    </div>
</section>

{{-- Documents: tab list + active document --}}
<section class="va-section va-section--bordered">
    <div class="va-hero__container">
        <div class="va-legal" data-va-reveal data-va-legal>
            <div class="va-legal__sidebar" role="tablist" aria-label="Regulatory documents">
                <div class="va-legal__sidebar-head">
                    <span class="va-eyebrow va-legal__eyebrow">Venture Asia Group</span>
                    <h4 class="va-legal__sidebar-title">Regulatory Documents</h4>
                </div>
                @foreach($vaLegalDocs as $i => $doc)
                    <button type="button" class="va-legal__tab {{ $i === 0 ? 'is-active' : '' }}" role="tab"
                        id="va-legal-tab-{{ $doc['id'] }}" aria-controls="va-legal-panel-{{ $doc['id'] }}"
                        aria-selected="{{ $i === 0 ? 'true' : 'false' }}" data-va-legal-tab="{{ $doc['id'] }}">
                        <span class="va-legal__tab-ind">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
                        </span>
                        <span class="va-legal__tab-text">{{ $doc['title'] }}</span>
                    </button>
                @endforeach
            </div>

            <div class="va-glassbox va-legal__content">
                @foreach($vaLegalDocs as $i => $doc)
                    <div class="va-legal__panel" role="tabpanel" id="va-legal-panel-{{ $doc['id'] }}"
                        aria-labelledby="va-legal-tab-{{ $doc['id'] }}" {{ $i === 0 ? '' : 'hidden' }}>
                        <div class="va-legal__intro" style="background: {{ $doc['gradient'] }}; border: {{ $doc['border'] }};">
                            <div class="va-legal__intro-head">
                                <div class="va-legal__intro-ico" style="background: {{ $doc['iconBg'] }};">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" aria-hidden="true">{!! $doc['icon'] !!}</svg>
                                </div>
                                <div>
                                    <h3 class="va-legal__intro-title">{{ $doc['heading'] }}</h3>
                                    <p class="va-legal__intro-sub">{{ $doc['subtitle'] }}</p>
                                </div>
                            </div>
                            <p class="va-legal__intro-text">{{ $doc['intro'] }}</p>
                        </div>

                        @foreach($doc['items'] as $item)
                            <div class="va-legal__item" style="border-left-color: {{ $item['color'] }};">
                                <div class="va-legal__item-num" style="color: {{ $item['color'] }};">{{ $item['num'] }}</div>
                                <div class="va-legal__item-body">
                                    <h5 class="va-legal__item-title">{{ $item['title'] }}</h5>
                                    <p class="va-legal__item-text">{{ $item['text'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- 4 steps (shared with the homepage) --}}
@include('frontend.partials.va-steps', ['sectionClass' => 'va-section--bordered va-legal-steps'])

@push('scripts')
<script>
(function () {
    var root = document.querySelector('[data-va-legal]');
    if (!root) return;
    var tabs = Array.prototype.slice.call(root.querySelectorAll('[data-va-legal-tab]'));
    function show(id, focus) {
        var found = false;
        tabs.forEach(function (tab) {
            var on = tab.getAttribute('data-va-legal-tab') === id;
            if (on) found = true;
            tab.classList.toggle('is-active', on);
            tab.setAttribute('aria-selected', on ? 'true' : 'false');
            tab.tabIndex = on ? 0 : -1;
            document.getElementById('va-legal-panel-' + tab.getAttribute('data-va-legal-tab')).hidden = !on;
            if (on && focus) tab.focus();
        });
        return found;
    }
    tabs.forEach(function (tab, i) {
        tab.tabIndex = i === 0 ? 0 : -1;
        tab.addEventListener('click', function () { show(tab.getAttribute('data-va-legal-tab')); });
        tab.addEventListener('keydown', function (e) {
            var dir = (e.key === 'ArrowDown' || e.key === 'ArrowRight') ? 1 : (e.key === 'ArrowUp' || e.key === 'ArrowLeft') ? -1 : 0;
            if (!dir) return;
            e.preventDefault();
            show(tabs[(i + dir + tabs.length) % tabs.length].getAttribute('data-va-legal-tab'), true);
        });
    });
    /* Deep links such as /legal/documents#risk open that document, like the reference site */
    function fromHash() { var id = location.hash.replace('#', ''); if (id) show(id); }
    window.addEventListener('hashchange', fromHash);
    fromHash();
})();
</script>
@endpush

@endsection
