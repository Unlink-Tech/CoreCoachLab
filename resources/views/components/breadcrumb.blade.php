@props([
    'title' => '',
    'routes' => [],
    'description' => ''
])

<div class="premium-breadcrumb-banner">
    <!-- Atmospheric Ambient Blur Blobs -->
    <div class="breadcrumb-blob blob-mint"></div>
    <div class="breadcrumb-blob blob-sky"></div>
    <div class="breadcrumb-blob blob-peach"></div>

    <!-- Thin Organic Wave Illustration vectors -->
    <div class="breadcrumb-svg-waves">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 280" fill="none" class="waves-svg">
            <path d="M-80,120 C180,60 320,180 580,100 C840,20 980,160 1240,110 C1380,85 1460,115 1520,120" stroke="var(--color-teal-dusk, #497d7e)" stroke-width="1.2" stroke-opacity="0.18" />
            <path d="M-40,160 C220,100 380,220 620,140 C860,60 1020,180 1280,130 C1390,110 1480,135 1540,140" stroke="var(--color-forest, #446c3d)" stroke-width="1.0" stroke-opacity="0.12" />
            <path d="M-60,90 C140,40 280,140 520,80 C760,20 900,120 1140,80 C1280,60 1360,80 1420,90" stroke="var(--color-ember-red, #e34432)" stroke-width="0.8" stroke-opacity="0.08" />
        </svg>
    </div>

    <!-- Content Layout Wrapper -->
    <div class="container breadcrumb-content-container">
        <!-- Breadcrumb Navigation Route Trail -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav-wrapper">
            <ol class="breadcrumb-nav-list">
                <li class="breadcrumb-nav-item">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i>{{ __('common.home') ?? 'Home' }}
                    </a>
                </li>
                @foreach($routes as $route)
                    <li class="breadcrumb-nav-separator">
                        <i class="fas fa-chevron-right"></i>
                    </li>
                    @if(isset($route['url']) && !$loop->last)
                        <li class="breadcrumb-nav-item">
                            <a href="{{ $route['url'] }}">{{ $route['label'] }}</a>
                        </li>
                    @else
                        <li class="breadcrumb-nav-item active" aria-current="page">
                            <span>{{ $route['label'] }}</span>
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>

        <!-- Page Heading Information Hierarchy -->
        <div class="breadcrumb-header-group">
            @if(!empty($title))
                <h1 class="breadcrumb-page-title">{{ $title }}</h1>
            @endif
            @if(!empty($description))
                <p class="breadcrumb-page-description">{{ $description }}</p>
            @endif
        </div>
    </div>
</div>

<style>
    /* =========================================
       PREMIUM EDITORIAL BREADCRUMB BANNER
       ========================================= */

    .premium-breadcrumb-banner {
        position: relative;
        padding: var(--spacing-64, 64px) 0 var(--spacing-48, 48px) 0;
        margin-bottom: var(--spacing-48, 48px);
        background-color: #fffbf8; /* Warm paper-planner background wash */
        border-bottom: 1px solid var(--color-stone, #d7d6d4);
        overflow: hidden;
    }

    /* Ambient Blur Blobs background layer */
    .breadcrumb-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        -webkit-filter: blur(80px);
        pointer-events: none;
        opacity: 0.7;
        z-index: 1;
    }

    .blob-mint {
        width: 320px;
        height: 320px;
        background-color: var(--color-mint-wash, #f0f6df); /* Pale Green Blur Accent */
        top: -120px;
        left: -80px;
    }

    .blob-sky {
        width: 280px;
        height: 280px;
        background-color: var(--color-sky-wash, #dceaff); /* Pale Blue Blur Accent */
        bottom: -100px;
        right: 40px;
    }

    .blob-peach {
        width: 240px;
        height: 240px;
        background-color: var(--surface-cream-wash, #fff6f0); /* Subtle Warm Peach Accent */
        top: 20px;
        right: -80px;
        opacity: 0.85;
    }

    /* SVG thin organic wave illustration backgrounds */
    .breadcrumb-svg-waves {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 2;
        pointer-events: none;
    }

    .waves-svg {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Content container layout */
    .breadcrumb-content-container {
        position: relative;
        z-index: 3;
    }

    /* Breadcrumb route trail list */
    .breadcrumb-nav-list {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        list-style: none;
        padding: 0;
        margin: 0 0 var(--spacing-16, 16px) 0;
        gap: 4px;
    }

    .breadcrumb-nav-item {
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-caption, 12px);
        font-weight: var(--font-weight-medium, 500);
        line-height: var(--leading-caption, 1.5);
        letter-spacing: var(--tracking-caption, 0.14px);
        background-color: var(--surface-paper-canvas, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-sm, 2.5px);
        padding: 3px 10px;
        transition: all 0.2s cubic-bezier(0.165, 0.84, 0.44, 1);
        display: flex;
        align-items: center;
    }

    .breadcrumb-nav-item:hover {
        background-color: var(--surface-cream-wash, #fff6f0);
        border-color: var(--color-ember-red, #e34432);
        transform: translateY(-1px);
    }

    .breadcrumb-nav-item a {
        color: var(--color-pencil, #6f6c69);
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: color 0.2s ease;
    }

    .breadcrumb-nav-item a:hover {
        color: var(--color-deep-ember, #cf3520);
    }

    .breadcrumb-nav-item.active {
        background-color: var(--surface-cream-wash, #fff6f0);
        border-color: var(--color-stone, #d7d6d4);
        color: var(--color-ink, #25221e);
        font-weight: var(--font-weight-semibold, 600);
    }

    .breadcrumb-nav-separator {
        display: flex;
        align-items: center;
        color: var(--color-graphite, #94928f);
        font-size: 8px;
        margin: 0 var(--spacing-4, 4px);
    }

    /* Page title and description */
    .breadcrumb-header-group {
        max-width: 760px;
    }

    .breadcrumb-page-title {
        font-family: var(--font-graphik), sans-serif;
        font-size: var(--text-heading-lg, 44px);
        font-weight: var(--font-weight-bold, 700);
        line-height: var(--leading-heading-lg, 1.15);
        letter-spacing: var(--tracking-heading-lg, -0.22px);
        color: var(--color-ink, #25221e);
        margin: 0 0 var(--spacing-8, 8px) 0;
        animation: revealText 0.8s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
    }

    .breadcrumb-page-description {
        font-family: var(--font-inter), sans-serif;
        font-size: var(--text-body, 16px);
        font-weight: var(--font-weight-regular, 400);
        line-height: var(--leading-body, 1.5);
        letter-spacing: var(--tracking-body, 0.16px);
        color: var(--color-pencil, #6f6c69);
        margin: 0;
        animation: revealText 0.8s cubic-bezier(0.165, 0.84, 0.44, 1) 0.1s forwards;
    }

    @keyframes revealText {
        0% {
            opacity: 0;
            transform: translateY(12px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .premium-breadcrumb-banner {
            padding: var(--spacing-48, 48px) 0 var(--spacing-32, 32px) 0;
        }

        .breadcrumb-page-title {
            font-size: var(--text-heading, 38px);
            letter-spacing: var(--tracking-heading, -0.19px);
        }

        .breadcrumb-page-description {
            font-size: var(--text-body-sm, 14px);
        }
    }
</style>
