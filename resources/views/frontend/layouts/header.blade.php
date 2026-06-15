<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>@yield('title','Grand Axis Learning – Online Courses for Skills & Career Growth')</title>
<meta name="title" content="Grand Axis Learning – Professional Online Courses">
<meta name="description" content="Grand Axis Learning offers expert-led online courses to build in-demand skills, advance careers, and support professional growth.">
<meta name="keywords" content="online courses, e-learning platform, skill development, career growth, professional training, upskilling">
<meta name="author" content="Grand Axis Learning">
<!-- Stylesheets -->
<link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{url('assets/plugins/revolution/css/settings.css')}}" rel="stylesheet" type="text/css">
<link href="{{url('assets/plugins/revolution/css/layers.css')}}" rel="stylesheet" type="text/css">
<link href="{{url('assets/plugins/revolution/css/navigation.css')}}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;475;500;600;625;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Caecilia:wght@400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Shantell+Sans:wght@400&display=swap" rel="stylesheet">
<link href="{{url('assets/css/global.css')}}" rel="stylesheet">
<link href="{{url('assets/css/style.css')}}" rel="stylesheet">
<link href="{{url('assets/css/responsive.css')}}" rel="stylesheet">
<link href="{{url('assets/css/color-utilities.css')}}" rel="stylesheet">
<link href="{{url('assets/css/theme.css')}}" rel="stylesheet">
<link rel="shortcut icon" href="{{url('assets/images/favicon.png')}}" type="image/x-icon">
<link rel="icon" href="{{url('assets/images/favicon.png')}}" type="image/x-icon">
<!-- Open Graph / Facebook Meta Tags -->
<meta property="og:type" content="website">
<meta property="og:title" content="@yield('title', 'Grand Axis Learning – Professional Online Courses')">
<meta property="og:description" content="Expert-led online courses designed for professional skill development and career growth.">
@if(isset($og_image))
<meta property="og:image" content="{{ $og_image }}">
@endif
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:site_name" content="Grand Axis Learning">
<meta property="og:locale" content="en_US">
 <!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	     @cookieconsentscripts
        <style>
            /* ============================================================
               COOKIE CONSENT
               ============================================================ */
            .cookiesBtn__link {
                background: var(--color-ink) !important;
                border: none !important;
                color: var(--color-paper) !important;
            }

            /* ============================================================
               SCROLLBAR STYLING (NEW THEME)
               ============================================================ */
            html {
                scroll-behavior: smooth;
                scrollbar-width: thin;
                scrollbar-color: var(--color-ember-red) var(--color-lighter);
            }

            ::-webkit-scrollbar {
                width: 10px;
                height: 10px;
            }

            ::-webkit-scrollbar-track {
                background: var(--color-lighter);
                border-radius: 5px;
            }

            ::-webkit-scrollbar-thumb {
                background: var(--color-ember-red);
                border-radius: 5px;
                border: 2px solid var(--color-lighter);
                transition: all var(--transition-normal);
            }

            ::-webkit-scrollbar-thumb:hover {
                background: var(--color-deep-ember);
                box-shadow: 0 0 8px rgba(227, 68, 50, 0.4);
            }

            /* ============================================================
               HEADER STYLING (NEW THEME)
               ============================================================ */
            header.main-header {
                position: sticky !important;
                top: 0 !important;
                background-color: var(--surface-paper-canvas) !important;
                background-image: none !important;
                border-bottom: 1px solid var(--color-stone) !important;
                z-index: 1030 !important;
                transition: all var(--transition-normal);
                width: 100% !important;
                left: 0 !important;
                right: 0 !important;
                padding: var(--spacing-12) 0 !important;
                box-shadow: none !important;
            }

            header.main-header.sticky-top {
                box-shadow: var(--shadow-subtle);
            }

            header.main-header:hover {
                box-shadow: var(--shadow-subtle);
            }

            header.main-header .auto-container {
                padding: var(--spacing-12) var(--spacing-20);
                max-width: var(--page-max-width);
                margin: 0 auto;
            }

            /* ============================================================
               LOGO STYLING
               ============================================================ */
            .logo-box {
                display: flex;
                align-items: center;
                gap: var(--spacing-8);
                flex-shrink: 0;
            }

            .logo-box a {
                display: inline-flex;
                align-items: center;
                text-decoration: none;
                transition: transform var(--transition-normal);
                outline: none;
            }

            .logo-box a:hover {
                transform: translateY(-2px);
            }

            .logo-box a:focus {
                outline: 2px solid var(--color-cobalt-link);
                outline-offset: 4px;
                border-radius: var(--radius-sm);
            }

            .logo-box img {
                height: 44px;
                width: auto;
                display: block;
                object-fit: contain;
                transition: filter var(--transition-normal);
            }

            .modern-nav > li.dropdown > a {
                color: inherit;
                text-decoration: none;
                gap: 6px;
                display: inline-flex;
                align-items: center;
            }

            .dropdown-item i {
                font-size: 12px;
            }

            .dropdown-menu {
                min-width: 200px;
            }

            .currency-dropdown {
                min-width: auto;
            }

            .logo-box a:hover img {
                filter: brightness(1.1);
            }

            /* ============================================================
               NAVIGATION STYLING
               ============================================================ */
            nav.modern-nav-wrapper {
                flex: 1;
                display: flex;
                justify-content: center;
            }

            .modern-nav {
                display: flex;
                list-style: none;
                margin: 0;
                padding: 0;
                gap: var(--spacing-8);
            }

            .modern-nav > li {
                position: relative;
            }

            .modern-nav > li > a {
                display: inline-flex !important;
                align-items: center !important;
                gap: var(--spacing-4) !important;
                padding: var(--spacing-8) var(--spacing-16) !important;
                color: var(--color-ink) !important;
                font-family: var(--font-inter) !important;
                font-size: var(--text-body) !important;
                font-weight: var(--font-weight-medium) !important;
                line-height: var(--leading-body) !important;
                letter-spacing: var(--tracking-body) !important;
                text-decoration: none !important;
                transition: all var(--transition-normal) !important;
                border-radius: var(--radius-nav) !important;
                position: relative !important;
            }

            .modern-nav > li > a::after {
                content: '';
                position: absolute;
                bottom: 6px;
                left: var(--spacing-16);
                right: var(--spacing-16);
                height: 2px;
                background-color: var(--color-ember-red);
                transform: scaleX(0);
                transform-origin: center;
                transition: transform var(--transition-normal);
            }

            .modern-nav > li > a:hover {
                color: var(--color-deep-ember);
                background-color: rgba(227, 68, 50, 0.05);
            }

            .modern-nav > li > a:hover::after {
                transform: scaleX(1);
            }

            .modern-nav > li.active > a {
                color: var(--color-deep-ember);
                background-color: rgba(207, 53, 32, 0.08);
            }

            .modern-nav > li.active > a::after {
                transform: scaleX(1);
            }

            /* ============================================================
               DROPDOWN STYLING
               ============================================================ */
            .dropdown-menu {
                background-color: var(--surface-paper-canvas) !important;
                border: 1px solid var(--color-stone) !important;
                border-radius: var(--radius-lg) !important;
                padding: var(--spacing-8) 0 !important;
                margin-top: var(--spacing-8) !important;
                min-width: 200px !important;
                box-shadow: var(--shadow-lg) !important;
                animation: slideDown var(--transition-normal) ease-out !important;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-8px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .dropdown-menu.show {
                display: block;
                animation: slideDown var(--transition-normal) ease-out;
            }

            .dropdown-item {
                color: var(--color-ink) !important;
                font-family: var(--font-inter) !important;
                font-size: var(--text-body-sm) !important;
                font-weight: var(--font-weight-regular) !important;
                line-height: var(--leading-body-sm) !important;
                letter-spacing: var(--tracking-body-sm) !important;
                padding: var(--spacing-12) var(--spacing-16) !important;
                display: flex !important;
                align-items: center !important;
                gap: var(--spacing-8) !important;
                border: none !important;
                background-color: transparent !important;
                transition: all var(--transition-normal) !important;
                text-decoration: none !important;
                border-radius: 0 !important;
                cursor: pointer !important;
                white-space: nowrap !important;
            }

            .dropdown-item:hover {
                background-color: rgba(227, 68, 50, 0.08);
                color: var(--color-deep-ember);
                padding-left: calc(var(--spacing-16) + 4px);
            }

            .dropdown-item:focus {
                background-color: rgba(207, 53, 32, 0.1);
                outline: none;
                border-left: 3px solid var(--color-deep-ember);
                padding-left: calc(var(--spacing-16) - 3px);
            }

            .dropdown-item.active {
                background-color: var(--surface-tinted-wave);
                color: var(--color-ink);
                font-weight: var(--font-weight-semibold);
            }

            .dropdown-item.active.bg-primary {
                background-color: var(--color-ember-red) !important;
                color: var(--color-paper) !important;
            }

            .dropdown-item.text-muted {
                color: var(--color-graphite);
                cursor: default;
                pointer-events: none;
            }

            .dropdown-item i {
                font-size: 14px;
                flex-shrink: 0;
                color: var(--color-ember-red);
            }

            .dropdown-divider {
                height: 1px;
                background-color: var(--color-stone);
                margin: var(--spacing-8) 0;
                border: none;
            }

            /* ============================================================
               BUTTONS STYLING
               ============================================================ */
            .modern-btn {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                gap: var(--spacing-4) !important;
                padding: var(--spacing-8) var(--spacing-12) !important;
                border: 1px solid transparent !important;
                border-radius: var(--radius-buttons) !important;
                font-family: var(--font-inter) !important;
                font-size: var(--text-body-sm) !important;
                font-weight: var(--font-weight-medium) !important;
                line-height: var(--leading-body-sm) !important;
                letter-spacing: var(--tracking-body-sm) !important;
                color: var(--color-ink) !important;
                background-color: transparent !important;
                text-decoration: none !important;
                cursor: pointer !important;
                transition: all var(--transition-normal) !important;
                outline: none !important;
                white-space: nowrap !important;
            }

            .modern-btn:hover {
                background-color: rgba(227, 68, 50, 0.05) !important;
                color: var(--color-deep-ember) !important;
            }

            .modern-btn:focus {
                outline: 2px solid var(--color-cobalt-link);
                outline-offset: 2px;
            }

            .modern-btn-outline {
                border: 1px solid var(--color-stone);
                background-color: var(--surface-paper-canvas);
                color: var(--color-ink);
            }

            .modern-btn-outline:hover {
                border-color: var(--color-deep-ember);
                background-color: rgba(207, 53, 32, 0.05);
                color: var(--color-deep-ember);
            }

            .modern-btn-solid {
                background-color: var(--color-ember-red) !important;
                color: var(--color-paper) !important;
                border: 1px solid var(--color-ember-red) !important;
                font-weight: var(--font-weight-semibold) !important;
                box-shadow: var(--shadow-lg) !important;
            }

            .modern-btn-solid:hover {
                background-color: var(--color-deep-ember) !important;
                border-color: var(--color-deep-ember) !important;
                transform: translateY(-1px) !important;
                box-shadow: var(--shadow-lg) !important;
            }

            .modern-btn-solid:active {
                background-color: var(--color-charcoal) !important;
                transform: translateY(0) !important;
            }

            /* ============================================================
               CART BUTTON
               ============================================================ */
            .modern-cart-btn {
                position: relative !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                width: 44px !important;
                height: 44px !important;
                padding: 0 !important;
                color: var(--color-ink) !important;
                background-color: var(--surface-paper-canvas) !important;
                border: 1px solid var(--color-stone) !important;
                border-radius: var(--radius-buttons) !important;
                font-size: 20px !important;
                cursor: pointer !important;
                transition: all var(--transition-normal) !important;
                text-decoration: none !important;
            }

            .modern-cart-btn:hover {
                background-color: rgba(227, 68, 50, 0.08) !important;
                border-color: var(--color-deep-ember) !important;
                color: var(--color-deep-ember) !important;
            }

            .modern-cart-btn:focus {
                outline: 2px solid var(--color-cobalt-link);
                outline-offset: 2px;
            }

            .cart-count {
                position: absolute !important;
                top: -8px !important;
                right: -8px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                width: 24px !important;
                height: 24px !important;
                min-width: 24px !important;
                background-color: var(--color-ember-red) !important;
                color: var(--color-paper) !important;
                border-radius: 50% !important;
                font-family: var(--font-inter) !important;
                font-size: 11px !important;
                font-weight: var(--font-weight-bold) !important;
                line-height: 1 !important;
                animation: scaleIn 0.3s ease-out !important;
            }

            @keyframes scaleIn {
                from {
                    transform: scale(0);
                }
                to {
                    transform: scale(1);
                }
            }

            /* ============================================================
               RESPONSIVE
               ============================================================ */
            @media (max-width: 767px) {
                header.main-header {
                    padding: var(--spacing-8) 0;
                }

                header.main-header .auto-container {
                    padding: var(--spacing-8) var(--spacing-12);
                }

                .logo-box img {
                    height: 40px;
                }

                .modern-btn {
                    padding: var(--spacing-8) var(--spacing-8);
                    font-size: var(--text-caption);
                }

                .dropdown.d-none.d-md-block {
                    display: none;
                }

                .dropdown.d-none.d-lg-block {
                    display: none;
                }
            }

            /* Cart item title full text with line breaks */
            .cart-info a {
                white-space: normal !important;
                word-wrap: break-word !important;
                overflow: visible !important;
                text-overflow: clip !important;
                display: block !important;
                line-height: 1.4 !important;
            }

            /* ============================================================
               REVAMPED NAVBAR (restored)
               ============================================================ */
            header.main-header {
                background: linear-gradient(180deg, #fffdfb 0%, #fff6f0 100%) !important;
                border-bottom: 1px solid rgba(215, 214, 212, 0.7) !important;
                box-shadow: 0 4px 18px rgba(37, 34, 30, 0.05) !important;
                padding: 0 !important;
                overflow: visible !important;
            }
            .header-wrapper { gap: 24px !important; width: 100% !important; overflow: visible !important; }
            .logo-section { display: flex !important; align-items: center !important; flex-shrink: 0 !important; }
            .logo-link { display: inline-flex !important; align-items: center !important; transition: transform .3s cubic-bezier(.34,1.56,.64,1) !important; }
            .logo-link:hover { transform: translateY(-1px) scale(1.02) !important; }
            .logo-img { height: 40px !important; width: auto !important; display: block !important; object-fit: contain !important; }

            /* center nav */
            .center-nav { flex: 1 1 auto !important; display: flex !important; justify-content: center !important; }
            .nav-list { display: flex !important; align-items: center !important; list-style: none !important; margin: 0 !important; padding: 0 !important; column-gap: 8px !important; }
            .nav-item { position: relative !important; margin: 0 !important; }
            .nav-link {
                position: relative !important;
                display: inline-flex !important; align-items: center !important; gap: 6px !important;
                padding: 9px 15px !important; border-radius: 999px !important;
                color: var(--color-ink) !important; font-family: var(--font-inter) !important;
                font-size: 15px !important; font-weight: 500 !important; text-decoration: none !important;
                white-space: nowrap !important; line-height: 1 !important;
                transition: color .25s ease, background-color .25s ease, transform .25s cubic-bezier(.34,1.56,.64,1) !important;
            }
            .nav-link:hover, .nav-link.active { color: var(--color-deep-ember) !important; background-color: rgba(227,68,50,.07) !important; transform: translateY(-1px) !important; }
            .nav-toggle::after, .dropdown-toggle::after { display: none !important; }
            .nav-caret { width: 10px !important; height: 6px !important; opacity: .5 !important; flex-shrink: 0 !important; transition: transform .28s cubic-bezier(.34,1.56,.64,1) !important; }
            .hover-dropdown:hover .nav-caret { transform: rotate(180deg) !important; opacity: 1 !important; }

            /* right actions */
            .right-actions { display: flex !important; align-items: center !important; column-gap: 6px !important; flex-shrink: 0 !important; }
            .selector-btn, .account-btn {
                display: inline-flex !important; align-items: center !important; gap: 6px !important;
                background: transparent !important; border: 1px solid transparent !important;
                color: var(--color-ink) !important; font-family: var(--font-inter) !important;
                font-size: 14px !important; font-weight: 500 !important; cursor: pointer !important;
                padding: 7px 12px !important; border-radius: 999px !important; line-height: 1 !important;
                transition: all .2s ease, transform .25s cubic-bezier(.34,1.56,.64,1) !important;
            }
            .selector-btn:hover, .account-btn:hover, .hover-dropdown:hover .selector-btn, .hover-dropdown:hover .account-btn {
                color: var(--color-deep-ember) !important; background-color: rgba(227,68,50,.07) !important; border-color: rgba(227,68,50,.22) !important; transform: translateY(-1px) !important;
            }
            .selector-ico { font-size: 13px !important; opacity: .7 !important; }
            .account-ico { font-size: 18px !important; transition: transform .25s ease !important; }
            .hover-dropdown:hover .account-ico { transform: scale(1.08) !important; color: var(--color-ember-red) !important; }
            .account-name { max-width: 120px !important; overflow: hidden !important; text-overflow: ellipsis !important; white-space: nowrap !important; }

            /* primary button (register CTA in account dropdown) */
            .primary-btn {
                background: var(--color-ember-red) !important; color: var(--color-paper) !important;
                border: none !important; padding: 9px 20px !important; border-radius: 8px !important;
                font-family: var(--font-inter) !important; font-size: 14px !important; font-weight: 600 !important;
                text-decoration: none !important; display: inline-block !important; text-align: center !important;
                box-shadow: 0 2px 10px rgba(227,68,50,.28) !important; transition: all .2s ease !important;
            }
            .primary-btn:hover { background: var(--color-deep-ember) !important; color: var(--color-paper) !important; transform: translateY(-1px) !important; }
            .primary-btn--block { display: block !important; width: 100% !important; }

            /* cart button (themed, overrides old .modern-cart-btn) */
            .cart-btn {
                position: relative !important; display: inline-flex !important; align-items: center !important; justify-content: center !important;
                width: 44px !important; height: 44px !important; margin-left: 2px !important;
                color: var(--color-ink) !important; background: transparent !important; border: 1px solid transparent !important;
                font-size: 18px !important; border-radius: 8px !important; text-decoration: none !important;
                transition: all .2s ease !important;
            }
            .cart-btn:hover { color: var(--color-deep-ember) !important; background: rgba(227,68,50,.08) !important; border-color: rgba(227,68,50,.25) !important; transform: translateY(-1px) !important; }
            .cart-btn .cart-badge, .cart-btn .cart-count {
                position: absolute !important; top: -4px !important; right: -4px !important;
                display: flex !important; align-items: center !important; justify-content: center !important;
                min-width: 20px !important; height: 20px !important; padding: 0 4px !important;
                background: var(--color-ember-red) !important; color: var(--color-paper) !important;
                border: 2px solid #fff6f0 !important; border-radius: 999px !important;
                font-family: var(--font-inter) !important; font-size: 10px !important; font-weight: 700 !important; line-height: 1 !important;
            }

            /* hover dropdowns */
            .hover-dropdown { position: relative !important; }
            .main-header .hover-dropdown .dropdown-menu {
                display: block !important; position: absolute !important; top: calc(100% + 14px) !important; inset: auto !important; margin: 0 !important;
                background: linear-gradient(180deg, #fffefd 0%, #fff7f1 100%) !important;
                border: 1px solid rgba(215,214,212,.8) !important; border-radius: 15px !important; padding: 8px !important; min-width: 230px !important;
                box-shadow: 0 10px 30px rgba(37,34,30,.12), inset 0 1px 0 rgba(255,255,255,.8) !important;
                opacity: 0 !important; visibility: hidden !important; transform: translateY(10px) scale(.98) !important; transform-origin: top center !important;
                pointer-events: none !important; transition: opacity .22s ease, transform .26s cubic-bezier(.34,1.4,.5,1), visibility .22s !important; z-index: 1040 !important;
            }
            .main-header .hover-dropdown .dropdown-menu-end, .main-header .hover-dropdown .account-dropdown { right: 0 !important; left: auto !important; }
            .main-header .hover-dropdown .catalog-menu { left: 0 !important; right: auto !important; }
            .main-header .hover-dropdown .dropdown-menu::before { content: '' !important; position: absolute !important; top: -16px !important; left: 0 !important; right: 0 !important; height: 16px !important; }
            .main-header .hover-dropdown:hover .dropdown-menu, .main-header .hover-dropdown:focus-within .dropdown-menu {
                opacity: 1 !important; visibility: visible !important; transform: translateY(0) scale(1) !important; pointer-events: auto !important;
            }
            .main-header .dropdown-item {
                display: flex !important; align-items: center !important; gap: 10px !important;
                color: var(--color-ink) !important; font-family: var(--font-inter) !important; font-size: 14px !important; font-weight: 500 !important;
                padding: 10px 12px !important; border: none !important; border-radius: 8px !important; background: transparent !important; text-decoration: none !important; white-space: nowrap !important; transition: all .15s ease !important;
            }
            .main-header .dropdown-item:hover { background: rgba(227,68,50,.08) !important; color: var(--color-deep-ember) !important; }
            .main-header .dropdown-item.active { background: var(--color-mint-wash) !important; color: var(--color-forest) !important; font-weight: 600 !important; }
            .main-header .dropdown-divider { height: 1px !important; background: var(--color-stone) !important; margin: 6px 4px !important; border: none !important; opacity: .6 !important; }
            .dd-icon { font-size: 13px !important; width: 18px !important; text-align: center !important; color: var(--color-ember-red) !important; flex-shrink: 0 !important; }
            .dropdown-item.active .dd-icon { color: var(--color-forest) !important; }
            .dd-check { font-size: 11px !important; width: 14px !important; margin-left: auto !important; color: var(--color-forest) !important; opacity: 0 !important; flex-shrink: 0 !important; }
            .dropdown-item.active .dd-check { opacity: 1 !important; }
            .account-head { padding: 6px 12px 10px !important; display: flex !important; flex-direction: column !important; gap: 3px !important; }
            .account-head__name { font-family: var(--font-graphik) !important; font-weight: 600 !important; font-size: 15px !important; color: var(--color-ink) !important; }
            .account-head__credits { font-size: 12px !important; color: var(--color-cobalt-link) !important; font-weight: 500 !important; display: inline-flex !important; align-items: center !important; gap: 6px !important; }
            .account-head__credits i { color: var(--color-ember-red) !important; }
            .account-cta { padding: 4px 6px 2px !important; }

            @media (max-width: 991px) {
                .center-nav { display: none !important; }
                .currency-selector { display: none !important; }
                .account-name { display: none !important; }
            }
            @media (max-width: 767px) {
                .logo-img { height: 34px !important; }
                .right-actions { column-gap: 2px !important; }
                .language-selector, .currency-selector { display: none !important; }
                .account-btn { padding: 7px 8px !important; }
                .cart-btn { width: 40px !important; height: 40px !important; }
            }
        </style>
</head>

<body>

<div class="page-wrapper">
	<!-- Preloader -->
   <div id="preloader" >
        <div class="preloader">
            <span></span>
            <span></span>
        </div>
    </div>
	<!-- Main Header-->
	<header class="main-header sticky-top">
		<div class="container px-3 px-md-5">
			<div class="header-wrapper d-flex align-items-center justify-content-between py-3">
				<!-- Logo -->
				<div class="logo-section">
					<a href="{{route('home')}}" class="logo-link">
						<img src="{{url('assets/images/logo.png')}}" alt="Artify Academy" class="logo-img">
					</a>
				</div>

				<!-- Center Navigation -->
				<nav class="center-nav d-none d-lg-block">
					<ul class="nav-list">
						<li class="nav-item dropdown nav-dropdown hover-dropdown">
							<a href="{{route('product-lists')}}" class="nav-link nav-toggle {{ Route::is('product-lists') ? 'active' : '' }}">
								{{ __('common.catalog') }}
								<svg class="nav-caret" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
							</a>
							<ul class="dropdown-menu catalog-menu">
								@php
									$categories = \App\Models\Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
								@endphp
								@forelse($categories as $cat)
									<li>
										<a class="dropdown-item" href="{{ route('product-lists', $cat->slug) }}">
											<i class="fas fa-palette dd-icon"></i><span>{{ $cat->title }}</span>
										</a>
									</li>
								@empty
									<li><span class="dropdown-item dropdown-item--muted">No categories</span></li>
								@endforelse
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item dropdown-item--all" href="{{route('product-lists')}}"><i class="fas fa-th dd-icon"></i><span>View all courses</span></a></li>
							</ul>
						</li>
						<li class="nav-item"><a href="{{route('about-us')}}" class="nav-link {{ Route::is('about-us') ? 'active' : '' }}">{{ __('common.about')}}</a></li>
						<li class="nav-item"><a href="{{route('contact')}}" class="nav-link {{ Route::is('contact') ? 'active' : '' }}">{{ __('common.contact') }}</a></li>
					</ul>
				</nav>

				<!-- Right Actions -->
				<div class="right-actions d-flex align-items-center">
					<!-- Language Selector -->
					<div class="dropdown language-selector hover-dropdown d-none d-md-block">
						<button class="selector-btn" type="button">
							<i class="fas fa-globe selector-ico"></i>
							<span>@if(session('app_locale') == 'ja' || app()->getLocale() == 'ja') JP @else EN @endif</span>
							<svg class="nav-caret" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</button>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item {{ (session('app_locale') != 'ja' && app()->getLocale() != 'ja') ? 'active' : '' }}" href="{{ route('change.language', 'en') }}"><i class="fas fa-globe dd-icon"></i><span>English</span><i class="fas fa-check dd-check"></i></a></li>
							<li><a class="dropdown-item {{ (session('app_locale') == 'ja' || app()->getLocale() == 'ja') ? 'active' : '' }}" href="{{ route('change.language', 'ja') }}"><i class="fas fa-globe dd-icon"></i><span>日本語</span><i class="fas fa-check dd-check"></i></a></li>
						</ul>
					</div>

					<!-- Currency Selector -->
					<div class="dropdown currency-selector hover-dropdown d-none d-lg-block">
						@php
							$currentCurrency = session('currency', 'USD');
							$currencies = Helper::CurrenciesList();
						@endphp
						<button class="selector-btn" type="button">
							<span>{{ Helper::getCurrencySymbol($currentCurrency) }} {{ $currentCurrency }}</span>
							<svg class="nav-caret" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</button>
						<ul class="dropdown-menu dropdown-menu-end">
							@foreach($currencies as $cur)
								@if($cur->code != 'HKD')
									<li><a class="dropdown-item {{ $currentCurrency == $cur->code ? 'active' : '' }}" href="{{ route('change.currency', $cur->code) }}"><i class="fas fa-coins dd-icon"></i><span>{{ $cur->code }} {{ Helper::getCurrencySymbol($cur->code) }}</span><i class="fas fa-check dd-check"></i></a></li>
								@endif
							@endforeach
						</ul>
					</div>

					<!-- Account Dropdown -->
					<div class="dropdown account-menu hover-dropdown">
						<button class="account-btn" type="button">
							<i class="fas fa-user-circle account-ico"></i>
							@if(Auth::check())<span class="account-name d-none d-md-inline">{{ Str::limit(Auth::user()->name, 12) }}</span>@endif
							<svg class="nav-caret" width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</button>
						<ul class="dropdown-menu dropdown-menu-end account-dropdown">
							@if(Auth::check())
								<li class="account-head">
									<span class="account-head__name">{{ Auth::user()->name }}</span>
									<span class="account-head__credits"><i class="fas fa-coins"></i> {{ Auth::user()->points_balance ?? 0 }} CREDS</span>
								</li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="{{ route('user') }}"><i class="fas fa-tachometer-alt dd-icon"></i><span>{{ __('common.my_account') }}</span></a></li>
								<li><a class="dropdown-item" href="{{ route('points.topup') }}"><i class="fas fa-coins dd-icon"></i><span>{{ __('common.points_top_up') }}</span></a></li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item dropdown-item--danger" href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt dd-icon"></i><span>{{ __('common.logout') }}</span></a></li>
							@else
								<li><a class="dropdown-item" href="{{ route('login.form') }}"><i class="fas fa-sign-in-alt dd-icon"></i><span>{{ __('common.login') }}</span></a></li>
								<li><hr class="dropdown-divider"></li>
								<li class="account-cta"><a href="{{ route('register.form') }}" class="primary-btn primary-btn--block">{{ __('common.register') }}</a></li>
							@endif
						</ul>
					</div>

					<!-- Cart Button -->
					<a href="javascript:void(0)" class="cart-btn modern-cart-btn" aria-label="Shopping cart">
						<i class="fas fa-shopping-bag"></i>
						<span class="cart-badge cart-count">{{ Helper::totalCartQuantity() }}</span>
					</a>
				</div>
			</div>
		</div>
		<!-- Mobile Menu  -->

		<!-- Mobile Menu  -->
		<div class="mobile-menu">
			<div class="menu-backdrop"></div>

			<!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
			<nav class="menu-box">
				<div class="upper-box">
					<div class="nav-logo"><a href="{{route('home')}}"><img src="{{url('assets/images/logo.png')}}" alt="" title=""></a></div>
					<div class="close-btn"><i class="icon fa fa-times"></i></div>
				</div>

				<ul class="navigation clearfix">
					<!--Keep This Empty / Menu will come through Javascript-->
				</ul>		
			
			</nav>
		</div><!-- End Mobile Menu -->



		<!-- Sticky Header  -->
		<div class="sticky-header">
			<div class="auto-container">
				<div class="inner-container">
					<!--Logo-->
					<div class="logo">
						<a href="{{route('home')}}" title=""><img src="{{url('assets/images/logo.png')}}" alt="" title=""></a>
					</div>

					<!--Right Col-->
					<div class="nav-outer">
						<!-- Main Menu -->
						<nav class="main-menu">
							<div class="navbar-collapse show collapse clearfix">
								<ul class="navigation clearfix">
									<!--Keep This Empty / Menu will come through Javascript-->
								</ul>
							</div>
						</nav><!-- Main Menu End-->
                        <div class="ui-btn-outer d-md-none d-xl-none d-lg-none">						
						<a href="javascript:void(0)" class="ui-btn"><i class="lnr-icon-shopping-cart text-light"></i>
					    
                     <span class="cart-count">
                                        @if(Helper::getAllProductFromCart())
                    <span >{{ Helper::totalCartQuantity() }}</span>
                                @else
                                <span class="cart-count">0</span>
                                @endif
                            </span>       
					 
					</a>
					</div>
						<!--Mobile Navigation Toggler-->
						<div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
					</div>
				</div>
			</div>
		</div><!-- End Sticky Menu -->
		  <!-- Offcanvas Area Start -->
        <div class="cartfix-area modern-cart-drawer">
            <div class="cartcanvas__info">
                <div class="offcanvas__wrapper">
                    <div class="cartcanvas__content">
                        <div class="mb-4 d-flex justify-content-between align-items-center border-bottom pb-4" style="border-color: rgba(21, 145, 220, 0.1) !important;">
                            <h4 class="fw-800 text-dark mb-0" style="font-weight: 800; letter-spacing: -0.5px; color: #0a0e27;">{{ __('common.shopping_cart') }}</h4>
                            <div class="cartcanvas__close rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; cursor: pointer; background: linear-gradient(135deg, rgba(21, 145, 220, 0.1) 0%, rgba(21, 145, 220, 0.05) 100%); border: 1px solid rgba(21, 145, 220, 0.2); transition: all 0.3s ease;">
                                <i class="fas fa-times" style="color: #1591DC; font-size: 16px; font-weight: 600;"></i>
                            </div>
                        </div>

                        <ul class="cart-list list-unstyled">
                            @if(Helper::cartCount())
                                @foreach(Helper::getAllProductFromCart() as $key=>$cart)
                                    <li class="d-flex align-items-center mb-4 p-3 rounded-4 bg-white shadow-sm border border-light position-relative">
                                        <a href="{{ route('cart-delete',$cart->id) }}" class="remove-item position-absolute top-0 end-0 m-2 text-danger opacity-50 hover-opacity-100" style="z-index: 5;">
                                            <i class="fas fa-times-circle"></i>
                                        </a>
                                        @php
                                            $item_photo = asset('assets/images/placeholder.jpg');
                                            $item_title = __('common.points_top_up');
                                            $item_link = "#";
                                            $is_course = false;
                                            $level = null;
                                            if($cart->product) {
                                                $photo_arr = explode(',', $cart->product->photo);
                                                $item_photo = $photo_arr[0];
                                                $item_title = $cart->product->title;
                                                $item_link = route('product-detail', $cart->product->slug);

                                                // Check if this is a course (product_id < 1000)
                                                if($cart->product_id < 1000) {
                                                    $is_course = true;
                                                    // Look up level by matching course_id and price_in_points
                                                    $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                                                 ->where('price_in_points', $cart->points)
                                                                 ->first();
                                                }
                                            }
                                        @endphp

                                        <div class="cart-info pe-4">
                                            <a href="{{ $item_link }}" class="fw-bold text-dark text-decoration-none small d-block mb-1">{{ $item_title }}</a>

                                            <!-- Level Badge (for courses only) -->
                                            @if($is_course && $level)
                                                <span class="badge rounded-2 px-2 py-1 me-2" style="background: rgba(21, 145, 220, 0.1); color: #1591DC; font-size: 11px; font-weight: 600; display: inline-block; margin-bottom: 6px;">
                                                    <i class="fas fa-level-up-alt me-1" style="font-size: 10px;"></i>{{ $level->skill_level }}
                                                </span>
                                            @endif

                                            <p class="mb-0 small text-muted">
                                                <span class="fw-bold text-primary">{{ $cart->quantity }}</span> x 
                                                @if($cart->product_id < 1000 && $cart->points > 0)
                                                    {{ number_format($cart->points) }} CREDS
                                                @elseif($cart->product_id >= 1000)
                                                    {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}
                                                    <span class="text-primary small ms-1">({{ number_format($cart->points) }} CREDS)</span>
                                                @else
                                                    {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}
                                                @endif
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li class="text-center py-5">
                                    <div class="opacity-20 mb-3"><i class="fas fa-shopping-basket fa-4x"></i></div>
                                    <p class="text-muted fw-bold">{{ __('common.no_cart_available') }}</p>
                                    <a href="{{route('product-lists')}}" class="modern-btn modern-btn-outline small py-2">{{ __('common.catalog') }}</a>
                                </li>
                            @endif
                        </ul>

                        @if(Helper::cartCount())
                            @php
                                $total_amount = Helper::totalCartPrice();
                                if(session()->has('coupon')) { $total_amount -= Session::get('coupon')['value']; }

                                // Detect cart type
                                $has_courses = false;
                                $has_topups = false;
                                foreach(Helper::getAllProductFromCart() as $item) {
                                    if($item->product_id < 1000) {
                                        $has_courses = true;
                                    } else if($item->product_id >= 1000) {
                                        $has_topups = true;
                                    }
                                }
                            @endphp
                            <div class="cart-footer border-top mt-5 pt-4" style="border-color: rgba(21, 145, 220, 0.1) !important;">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="fw-bold text-dark mb-0" style="color: #0a0e27;">{{ __('common.total') }}:</h5>
                                    <h4 class="fw-800 mb-0" style="font-weight: 800; color: #1591DC;">
                                        @if(Helper::totalCartPoints() > 0)
                                            <i class="fas fa-coins me-1"></i> {{ number_format(Helper::totalCartPoints()) }} CREDS
                                        @else
                                            {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($total_amount, session('currency')=='JPY' ? 0 : 2) }}
                                        @endif
                                    </h4>
                                </div>
                                <div class="cart-btn d-flex gap-2">
                                    @if($has_courses && !$has_topups)
                                        <!-- Courses Only -->
                                        <a href="{{ route('coursecart') }}" class="modern-btn modern-btn-outline text-center py-2 px-3 flex-grow-1" style="background: transparent; border: 2px solid #1591DC; color: #1591DC; border-radius: 10px; font-weight: 600; font-size: 13px; transition: all 0.3s ease;">{{ __('common.view_cart') }}</a>
                                        <button type="button" onclick="document.getElementById('redeemPointsForm').submit();" class="modern-btn modern-btn-solid text-center py-2 px-3 flex-grow-1" style="background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%); color: white; border: none; border-radius: 10px; font-weight: 600; font-size: 13px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(21, 145, 220, 0.3); cursor: pointer;">
                                            <i class="fas fa-lock me-1"></i>{{ __('common.redeem_points') ?? 'Redeem' }}
                                        </button>
                                        <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST" style="display:none;">
                                            @csrf
                                        </form>
                                    @elseif($has_topups && !$has_courses)
                                        <!-- Top-ups Only -->
                                        <a href="{{ route('cart') }}" class="modern-btn modern-btn-outline text-center py-2 px-3 flex-grow-1" style="background: transparent; border: 2px solid #1591DC; color: #1591DC; border-radius: 10px; font-weight: 600; font-size: 13px; transition: all 0.3s ease;">{{ __('common.view_cart') }}</a>
                                        <a href="{{ Auth::check() ? route('checkout') : route('login.form') }}" class="modern-btn modern-btn-solid text-center py-2 px-3 flex-grow-1" style="background: linear-gradient(135deg, #1591DC 0%, #2C5EAD 100%); color: white; border: none; border-radius: 10px; font-weight: 600; font-size: 13px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(21, 145, 220, 0.3);">{{ __('common.checkout') }}</a>
                                    @else
                                        <!-- Mixed: Courses + Top-ups -->
                                        <a href="{{ route('coursecart') }}" class="modern-btn modern-btn-outline text-center py-2 px-3 flex-grow-1" style="background: transparent; border: 2px solid #1591DC; color: #1591DC; border-radius: 10px; font-weight: 600; font-size: 13px; transition: all 0.3s ease;">{{ __('common.view_cart') }}</a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
             <!-- Offcanvas Area Start -->
			 <div class="offcanvas__overlay"></div>
	</header>
@cookieconsentview		
        {{-- Flash notification toasts (themed component) --}}
        <x-flash-notification />
	<!--End Main Header -->
