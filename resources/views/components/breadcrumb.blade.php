@props([
    'title' => '',
    'routes' => [],
    'description' => ''
])

<section class="artf-crumb" aria-label="Page introduction">
    <span class="artf-crumb__glow artf-crumb__glow--a" aria-hidden="true"></span>
    <span class="artf-crumb__glow artf-crumb__glow--b" aria-hidden="true"></span>

    <div class="container artf-crumb__inner">
        <!-- Route trail -->
        <nav class="artf-crumb__trail" aria-label="breadcrumb">
            <ol>
                <li>
                    <a href="{{ route('home') }}">
                        <i class="fas fa-home" aria-hidden="true"></i>
                        <span>{{ __('common.home') ?? 'Home' }}</span>
                    </a>
                </li>
                @foreach($routes as $route)
                    <li class="artf-crumb__sep" aria-hidden="true">/</li>
                    @if(isset($route['url']) && !$loop->last)
                        <li>
                            <a href="{{ $route['url'] }}">{{ $route['label'] }}</a>
                        </li>
                    @else
                        <li class="artf-crumb__current" aria-current="page">
                            <span>{{ $route['label'] }}</span>
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>

        <!-- Heading -->
        <div class="artf-crumb__heading">
            @if(!empty($title))
                <h1 class="artf-crumb__title">{{ $title }}</h1>
            @endif
            @if(!empty($description))
                <p class="artf-crumb__desc">{{ $description }}</p>
            @endif
        </div>

        <span class="artf-crumb__rule" aria-hidden="true"></span>
    </div>
</section>

<style>
    /* =========================================
       BREADCRUMB — DARK EDITORIAL HERO (compact)
       ========================================= */
    section.artf-crumb,
    .artf-crumb {
        position: relative !important;
        overflow: hidden !important;
        margin: 0 !important;
        padding: 0px 0 0px !important;
        background-color: #16130f !important;
        background-image:
            linear-gradient(90deg, rgba(22, 19, 15, 0.94) 0%, rgba(22, 19, 15, 0.78) 45%, rgba(22, 19, 15, 0.55) 100%),
            url('{{ asset('assets/images/breadcrumb.webp') }}') !important;
        background-repeat: no-repeat, no-repeat !important;
        background-position: center center, center center !important;
        background-size: cover, cover !important;
        color: rgba(255, 255, 255, 0.72) !important;
        font-family: var(--font-inter, 'Inter', sans-serif) !important;
        isolation: isolate !important;
        border-radius: 0 !important;
        border: 0 !important;
        box-shadow: none !important;
    }

    /* Ambient warm ember glow, top-right */
    .artf-crumb__glow {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        filter: blur(80px);
        z-index: 0;
    }
    .artf-crumb__glow--a {
        top: -160px;
        right: -140px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(227, 68, 50, 0.32) 0%, transparent 70%);
    }
    .artf-crumb__glow--b {
        bottom: -180px;
        left: -140px;
        width: 420px;
        height: 420px;
        background: radial-gradient(circle, rgba(15, 102, 174, 0.20) 0%, transparent 70%);
    }

    .artf-crumb__inner {
        position: relative;
        z-index: 1;
    }

    /* ---- Route trail ---- */
    .artf-crumb__trail ol {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        list-style: none;
        padding: 0;
        margin: 0 0 20px 0;
        font-family: var(--font-inter, sans-serif);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.16em;
        text-transform: uppercase;
    }
    .artf-crumb__trail li {
        display: inline-flex;
        align-items: center;
        color: rgba(255, 255, 255, 0.5);
    }
    .artf-crumb__trail li a {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        padding: 4px 0;
        border-bottom: 1px solid transparent;
        transition: color 0.25s ease, border-color 0.25s ease;
    }
    .artf-crumb__trail li a i {
        font-size: 11px;
        color: #f0a58c;
    }
    .artf-crumb__trail li a:hover {
        color: #ffffff;
        border-bottom-color: #f0a58c;
    }
    .artf-crumb__sep {
        color: rgba(255, 255, 255, 0.20);
        font-weight: 400;
        font-size: 13px;
    }
    .artf-crumb__current {
        color: #f0a58c;
        padding: 4px 0;
    }

    /* ---- Heading ---- */
    .artf-crumb__heading {
        max-width: 900px;
        animation: artfCrumbReveal 0.8s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
    }
    .artf-crumb__title {
        font-family: var(--font-graphik, 'Inter', sans-serif) !important;
        font-size: 42px !important;
        font-weight: 800 !important;
        line-height: 1.1 !important;
        letter-spacing: -0.02em !important;
        color: #ffffff !important;
        margin: 0 0 12px 0 !important;
    }
    .artf-crumb__desc {
        font-family: var(--font-inter, sans-serif);
        font-size: 15px;
        font-weight: 400;
        line-height: 1.55;
        color: rgba(255, 255, 255, 0.55);
        margin: 0;
        max-width: 620px;
        animation: artfCrumbReveal 0.8s cubic-bezier(0.165, 0.84, 0.44, 1) 0.1s forwards;
    }

    /* ---- Gradient rule accent ---- */
    .artf-crumb__rule {
        display: block;
        width: 72px;
        height: 3px;
        margin-top: 22px;
        border-radius: 3px;
        background: linear-gradient(90deg, var(--color-ember-red, #e34432), #f0a58c);
        box-shadow: 0 0 14px rgba(227, 68, 50, 0.45);
    }

    @keyframes artfCrumbReveal {
        0%   { opacity: 0; transform: translateY(14px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    /* ---- Responsive ---- */
    @media (max-width: 767px) {
        section.artf-crumb,
        .artf-crumb {
            padding: 42px 0 36px !important;
        }
        .artf-crumb__trail ol {
            gap: 8px;
            font-size: 10.5px;
            margin-bottom: 16px;
        }
        .artf-crumb__title {
            font-size: 32px !important;
        }
        .artf-crumb__desc {
            font-size: 14px;
        }
        .artf-crumb__rule {
            margin-top: 18px;
        }
    }

    @media (max-width: 480px) {
        section.artf-crumb,
        .artf-crumb {
            padding: 36px 0 30px !important;
        }
        .artf-crumb__title {
            font-size: 26px !important;
        }
        .artf-crumb__desc {
            font-size: 13.5px;
        }
    }
</style>
