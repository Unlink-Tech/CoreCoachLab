@extends('frontend.layouts.main')
@section('title', $page_data->page_title)
@section('main-content')

<x-breadcrumb 
    :title="$page_data->page_title" 
    :routes="[
        ['label' => $page_data->page_title]
    ]" 
/>

<section class="policy-content-section">
    <!-- Ambient blurred background shapes for warm creative atmosphere -->
    <div class="policy-bg-blob blob-mint"></div>
    <div class="policy-bg-blob blob-sky"></div>
    <div class="policy-bg-blob blob-peach"></div>

    <div class="container policy-content-container">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10">
                <div class="premium-rich-text-card">
                    <div class="policy-rich-text">
                        {!! $page_data->page_desc !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* ============================================================
       DYNAMIC PAGES - PREMIUM EDITORIAL TEXT STYLING
       ============================================================ */

    .policy-content-section {
        background-color: #fffdfb; /* Crisp warm backdrop */
        position: relative;
        overflow: hidden;
        padding: 80px 0 100px;
    }

    /* faint dotted sketch-grid, masked to fade at the edges */
    .policy-content-section::before {
        content: '';
        position: absolute;
        inset: 0;
        z-index: 0;
        background-image: radial-gradient(rgba(37, 34, 30, 0.05) 1px, transparent 1px);
        background-size: 26px 26px;
        -webkit-mask-image: radial-gradient(ellipse 70% 60% at 50% 30%, #000 0%, transparent 80%);
                mask-image: radial-gradient(ellipse 70% 60% at 50% 30%, #000 0%, transparent 80%);
        pointer-events: none;
    }

    /* Ambient light blur glows behind rich text card (gently drifting) */
    .policy-bg-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        -webkit-filter: blur(100px);
        pointer-events: none;
        opacity: 0.6;
        z-index: 1;
        will-change: transform;
    }

    .policy-bg-blob.blob-mint {
        width: 380px;
        height: 380px;
        background-color: var(--color-mint-wash, #f0f6df);
        top: -80px;
        left: -100px;
        animation: policyDrift 18s ease-in-out infinite;
    }

    .policy-bg-blob.blob-sky {
        width: 320px;
        height: 320px;
        background-color: var(--color-sky-wash, #dceaff);
        bottom: 10%;
        right: -80px;
        animation: policyDrift 22s ease-in-out infinite reverse;
    }

    .policy-bg-blob.blob-peach {
        width: 280px;
        height: 280px;
        background-color: var(--surface-cream-wash, #fff6f0);
        top: 35%;
        left: 50%;
        opacity: 0.8;
        animation: policyDrift 26s ease-in-out infinite;
    }

    @keyframes policyDrift {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33%      { transform: translate(28px, -34px) scale(1.05); }
        66%      { transform: translate(-22px, 22px) scale(0.97); }
    }

    .policy-content-container {
        position: relative;
        z-index: 2;
    }

    /* Premium card container with smooth elevate effects */
    .premium-rich-text-card {
        position: relative;
        background-color: var(--surface-paper-canvas, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 18px;
        padding: 56px clamp(28px, 5vw, 64px);
        box-shadow:
            0 1px 0 rgba(255, 255, 255, 0.8) inset,
            0 18px 50px rgba(37, 34, 30, 0.06),
            0 2px 8px rgba(37, 34, 30, 0.03);
        transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.4s ease, border-color 0.4s ease;
        animation: slideInUp 0.6s ease-out;
        overflow: hidden;
    }

    /* gradient accent strip across the top of the card */
    .premium-rich-text-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg,
            var(--color-ember-red, #e34432) 0%,
            var(--color-teal-dusk, #497d7e) 50%,
            var(--color-forest, #446c3d) 100%);
    }

    /* faint document watermark in the corner */
    .premium-rich-text-card::after {
        content: '\f15c'; /* fa file-alt */
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        top: 26px; right: 30px;
        font-size: 64px;
        color: var(--color-ember-red, #e34432);
        opacity: 0.05;
        pointer-events: none;
        line-height: 1;
    }

    .premium-rich-text-card:hover {
        transform: translateY(-4px);
        border-color: rgba(227, 68, 50, 0.4);
        box-shadow:
            0 1px 0 rgba(255, 255, 255, 0.8) inset,
            0 28px 60px rgba(37, 34, 30, 0.10),
            0 4px 12px rgba(37, 34, 30, 0.05);
    }

    .policy-rich-text {
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-body, 16px);
        line-height: var(--leading-body, 1.6);
        color: var(--color-pencil, #6f6c69);
    }

    .policy-rich-text h1, 
    .policy-rich-text h2, 
    .policy-rich-text h3 {
        font-family: var(--font-graphik), sans-serif;
        color: var(--color-ink, #25221e);
        font-weight: var(--font-weight-bold, 700);
        margin-top: 40px;
        margin-bottom: 20px;
        letter-spacing: var(--tracking-heading, -0.19px);
    }

    .policy-rich-text p {
        margin-bottom: 24px;
        color: var(--color-pencil, #6f6c69);
    }

    /* decorative gradient accent under section headings */
    .policy-rich-text h2 {
        position: relative;
        padding-bottom: 14px;
    }
    .policy-rich-text h2::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 52px;
        height: 3px;
        border-radius: 3px;
        background: linear-gradient(90deg, var(--color-ember-red, #e34432), var(--color-teal-dusk, #497d7e));
    }

    /* elegant drop-cap on the opening paragraph */
    .policy-rich-text > p:first-of-type::first-letter {
        font-family: var(--font-graphik), Georgia, serif;
    /* Modern Sliding Underline Link Effects */
    .policy-rich-text a {
        color: var(--color-cobalt-link, #0f66ae);
        text-decoration: none;
        font-weight: var(--font-weight-medium, 500);
        position: relative;
        transition: color 0.25s ease;
    }

    .policy-rich-text a::after {
        content: '';
        position: absolute;
        width: 100%;
        transform: scaleX(0);
        height: 1.5px;
        bottom: -2px;
        left: 0;
        background-color: var(--color-ember-red, #e34432);
        transform-origin: bottom right;
        transition: transform 0.25s ease-out;
    }

    .policy-rich-text a:hover {
        color: var(--color-ember-red, #e34432);
    }

    .policy-rich-text a:hover::after {
        transform: scaleX(1);
        transform-origin: bottom left;
    }

    /* Ordered List Styling with hover highlights */
    .policy-rich-text ol {
        margin-bottom: 24px !important;
        padding-left: 32px !important;
        list-style-type: decimal !important;
        list-style-position: outside !important;
    }

    .policy-rich-text ol li {
        display: list-item !important;
        list-style-type: decimal !important;
        list-style-position: outside !important;
        margin-bottom: 24px !important;
        color: var(--color-pencil, #6f6c69) !important;
        font-size: var(--text-body, 16px);
        transition: all 0.25s ease;
    }

    .policy-rich-text ol li:hover {
        transform: translateX(4px);
        color: var(--color-ink, #25221e) !important;
    }

    .policy-rich-text ol li::marker {
        font-family: var(--font-graphik), sans-serif;
        font-size: 1.6em;
        font-weight: var(--font-weight-bold, 700);
        color: var(--color-ember-red, #e34432);
        transition: color 0.25s ease;
    }

    .policy-rich-text ol li:hover::marker {
        color: var(--color-deep-ember, #cf3520);
    }

    .policy-rich-text ol li h3 {
        display: inline;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        margin-left: 8px !important;
        font-size: 1.6em;
        line-height: var(--leading-heading, 1.28);
    }

    .policy-rich-text ol li h4 {
        color: var(--color-deep-ember, #cf3520);
        font-family: var(--font-graphik), sans-serif;
        font-weight: var(--font-weight-bold, 700);
        margin-top: 24px !important;
        margin-bottom: 12px !important;
        font-size: 1.3em;
        transition: color 0.25s ease;
    }

    .policy-rich-text ol li h4:hover {
        color: var(--color-ember-red, #e34432);
    }

    /* Unordered List Styling (Bullet points) with micro-interactivity */
    .policy-rich-text ul {
        margin: 16px 0 24px 20px !important;
        padding-left: 20px !important;
        list-style-type: disc !important;
        list-style-position: outside !important;
    }

    .policy-rich-text ul li {
        display: list-item !important;
        list-style-type: disc !important;
        list-style-position: outside !important;
        margin-bottom: 8px !important;
        color: var(--color-pencil, #6f6c69) !important;
        font-size: var(--text-body-sm, 14px);
        transition: all 0.2s ease;
    }

    .policy-rich-text ul li:hover {
        transform: translateX(4px);
        color: var(--color-ink, #25221e) !important;
    }

    .policy-rich-text ul li::marker {
        color: var(--color-ember-red, #e34432) !important;
        transition: color 0.2s ease;
    }

    .policy-rich-text ul li:hover::marker {
        color: var(--color-deep-ember, #cf3520) !important;
    }

    .policy-rich-text li {
        margin-bottom: 12px !important;
        color: var(--color-pencil, #6f6c69) !important;
    }

    /* Metadata / Company Details Container in Raw HTML */
    .policy-rich-text .contact-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin: 32px 0 !important;
        padding: 24px !important;
        background-color: var(--surface-cream-wash, #fff6f0) !important;
        border: 1px solid var(--color-stone, #d7d6d4) !important;
        border-radius: var(--radius-cards, 8px) !important;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
    }

    .policy-rich-text .contact-content:hover {
        border-color: var(--color-ember-red, #e34432) !important;
        box-shadow: var(--shadow-subtle, 0px 1px 0px 0px rgba(37, 34, 30, 0.04)) !important;
        transform: translateY(-2px) !important;
    }

    .policy-rich-text .contact-content .content {
        display: flex !important;
        flex-direction: column !important;
    }

    .policy-rich-text .contact-content .title {
        font-family: var(--font-graphik), sans-serif !important;
        font-size: var(--text-body-sm, 14px) !important;
        font-weight: var(--font-weight-bold, 700) !important;
        color: var(--color-deep-ember, #cf3520) !important;
        margin-top: 0 !important;
        margin-bottom: 8px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
    }

    .policy-rich-text .contact-content p,
    .policy-rich-text .contact-content span {
        font-family: var(--font-inter), sans-serif !important;
        font-size: var(--text-body-sm, 14px) !important;
        color: var(--color-pencil, #6f6c69) !important;
        margin: 0 !important;
    }

    /* Table Styling with scale transitions and elevated shadows */
    .policy-rich-text table {
        width: 100% !important;
        margin: 32px 0 !important;
        border-collapse: collapse !important;
        border: none !important;
        box-shadow: 0 4px 12px rgba(37, 34, 30, 0.03) !important;
        border-radius: var(--radius-cards, 8px) !important;
        overflow: hidden !important;
        transition: all 0.3s ease !important;
    }

    .policy-rich-text table:hover {
        box-shadow: 0 8px 24px rgba(37, 34, 30, 0.08) !important;
        transform: translateY(-2px) !important;
    }

    .policy-rich-text table tr {
        border: none !important;
    }

    .policy-rich-text table tr:nth-child(odd) {
        background-color: var(--surface-paper-canvas, #fefdfc) !important;
    }

    .policy-rich-text table tr:nth-child(even) {
        background-color: #fcfbfa !important;
    }

    .policy-rich-text table tr:hover {
        background-color: var(--surface-cream-wash, #fff6f0) !important;
        transition: background-color 0.25s ease !important;
    }

    .policy-rich-text table td {
        padding: 16px 20px !important;
        border: 1px solid var(--color-stone, #d7d6d4) !important;
        color: var(--color-pencil, #6f6c69) !important;
        font-size: var(--text-body-sm, 14px) !important;
        line-height: 1.6 !important;
    }

    .policy-rich-text table td:first-child {
        background-color: var(--surface-cream-wash, #fff6f0) !important;
        font-weight: var(--font-weight-bold, 700) !important;
        color: var(--color-deep-ember, #cf3520) !important;
        width: 30% !important;
    }

    .policy-rich-text table strong {
        color: var(--color-deep-ember, #cf3520) !important;
        font-weight: var(--font-weight-bold, 700) !important;
    }

    .policy-rich-text table img,
    .policy-rich-text img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: var(--radius-images, 15px) !important;
        box-shadow: var(--shadow-subtle, 0px 1px 0px 0px rgba(37, 34, 30, 0.04)) !important;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
    }

    .policy-rich-text img:hover {
        transform: scale(1.02) !important;
        box-shadow: var(--shadow-lg, 0px 14px 19px -9px rgba(37, 34, 30, 0.07), 0px 10px 48px 0px rgba(37, 34, 30, 0.18)) !important;
    }

    .policy-rich-text table th {
        background: linear-gradient(135deg, var(--color-ember-red, #e34432) 0%, var(--color-deep-ember, #cf3520) 100%) !important;
        color: #ffffff !important;
        padding: 18px 20px !important;
        font-weight: var(--font-weight-bold, 700) !important;
        text-align: left !important;
        font-size: var(--text-body-sm, 14px) !important;
        letter-spacing: 0.5px !important;
        border: none !important;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .policy-content-section { padding: 48px 0 64px; }
        .premium-rich-text-card {
            padding: var(--spacing-24, 24px);
            border-radius: 14px;
        }
        .premium-rich-text-card::after { font-size: 48px; top: 18px; right: 20px; }
        .policy-rich-text > p:first-of-type::first-letter { font-size: 2.8em; }
    }

    @media (prefers-reduced-motion: reduce) {
        .policy-bg-blob,
        .premium-rich-text-card { animation: none !important; }
    }
</style>
@endpush
