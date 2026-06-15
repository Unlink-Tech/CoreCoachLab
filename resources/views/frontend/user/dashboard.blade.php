@extends('frontend.layouts.main')
@section('title', __('common.dashboard'))
@section('main-content')

<x-breadcrumb 
    :title="__('common.my_account')" 
    :routes="[
        ['label' => __('common.my_account')]
    ]" 
/>

<section class="account-section pt-60 pb-80">
    <!-- Ambient blurred background shapes for warm creative atmosphere -->
    <div class="account-bg-blob blob-mint"></div>
    <div class="account-bg-blob blob-sky"></div>
    <div class="account-bg-blob blob-peach"></div>

    <div class="container account-container">
        <div class="row g-5 align-items-stretch">
            
            <!-- LEFT COLUMN: Profile Sidebar -->
            <div class="col-xl-4 col-lg-4 col-md-12">
                <div class="db-profile-sidebar">
                    <!-- Artify Membership Card (Glassmorphic Dark Theme) -->
                    <div class="artify-member-card">
                        <div class="member-card-glow"></div>
                        <div class="member-card-inner">
                            <div class="member-card-header">
                                <span class="member-logo">ARTIFY STUDIO</span>
                                <i class="fas fa-coins coin-icon"></i>
                            </div>
                            <div class="member-card-body">
                                <span class="balance-label">{{ __('common.available_points') }}</span>
                                <h2 class="balance-value">
                                    {{ Auth::user()->points_balance ?? 0 }} <small>CREDS</small>
                                </h2>
                            </div>
                            <div class="member-card-footer">
                                <div class="member-name">{{ Auth::user()->name ?? 'Creative Artist' }}</div>
                                <a href="{{ route('points.topup') }}" class="member-topup-btn">
                                    <i class="fas fa-plus"></i> Recharge
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Greeting & Overview -->
                    <div class="db-profile-overview mb-4">
                        <h4 class="greeting-title">Welcome back, {{ explode(' ', Auth::user()->name)[0] ?? 'Artist' }}! 👋</h4>
                        <p class="greeting-text">Your creative journey continues. Keep unlocking courses to master your skills.</p>
                        
                        <!-- Mini Stats Grid -->
                        <div class="db-mini-stats">
                            <div class="mini-stat-item">
                                <span class="mini-stat-value">{{ isset($redeemedOrders) ? count($redeemedOrders) : 0 }}</span>
                                <span class="mini-stat-label">Enrolled</span>
                            </div>
                            <div class="mini-stat-divider"></div>
                            <div class="mini-stat-item">
                                <span class="mini-stat-value">{{ isset($redeemedOrders) ? count($redeemedOrders->where('status', 'Completed')) : 0 }}</span>
                                <span class="mini-stat-label">Completed</span>
                            </div>
                            <div class="mini-stat-divider"></div>
                            <div class="mini-stat-item">
                                <span class="mini-stat-value">{{ Auth::user()->created_at->format('Y') }}</span>
                                <span class="mini-stat-label">Joined</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Navigation Tabs -->
                    <ul class="nav flex-column db-side-tabs" id="dashboardTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="points-purchased-tab" data-bs-toggle="tab" data-bs-target="#points-purchased" type="button" role="tab" aria-controls="points-purchased" aria-selected="true">
                                <i class="fas fa-wallet"></i> Purchase History
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="points-redeemed-tab" data-bs-toggle="tab" data-bs-target="#points-redeemed" type="button" role="tab" aria-controls="points-redeemed" aria-selected="false">
                                <i class="fas fa-graduation-cap"></i> Redeemed Courses
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="change-password-tab" data-bs-toggle="tab" data-bs-target="#change-password" type="button" role="tab" aria-controls="change-password" aria-selected="false">
                                <i class="fas fa-lock"></i> Security & Password
                            </button>
                        </li>
                        <li class="nav-item mt-3">
                            <a href="{{ route('user.logout') }}" class="db-side-logout">
                                <i class="fas fa-sign-out-alt"></i> Logout Profile
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- RIGHT COLUMN: Dynamic Content area -->
            <div class="col-xl-8 col-lg-8 col-md-12">
                <div class="db-main-content h-100">
                    <div class="tab-content" id="dashboardContent">
                        
                        <!-- Points Purchased Tab -->
                        <div class="tab-pane fade show active" id="points-purchased" role="tabpanel" aria-labelledby="points-purchased-tab">
                            <div class="db-content-card">
                                <h3 class="db-content-card__title">
                                    <i class="fas fa-wallet me-2"></i>{{ __('common.points_purchased_wallet') }}
                                </h3>

                                @if(isset($purchasedOrders) && count($purchasedOrders) > 0)
                                    <div class="table-responsive">
                                        <table class="table db-table">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('common.order_number') }}</th>
                                                    <th>{{ __('common.points_bought') }}</th>
                                                    <th>{{ __('common.price_paid') }}</th>
                                                    <th>{{ __('common.payment_status') }}</th>
                                                    <th>{{ __('common.date') }}</th>
                                                    <th>{{ __('common.action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($purchasedOrders as $order)
                                                <tr>
                                                    <td class="db-table__highlight">{{ $order->order_number }}</td>
                                                    <td>
                                                        <span class="db-points-badge db-points-badge--amber">
                                                            <i class="fas fa-coins me-1"></i>{{ number_format($order->cart_info->sum('points')) }} CREDS
                                                        </span>
                                                    </td>
                                                    <td class="db-table__price">{{ Helper::getCurrencySymbol($order->currency) }}{{ number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2) }}</td>
                                                    <td>
                                                        @if($order->payment_status === 'Completed')
                                                            <span class="db-status-pill db-status-pill--success">{{ __('common.paid') }}</span>
                                                        @elseif($order->payment_status === 'Failed')
                                                            <span class="db-status-pill db-status-pill--danger">{{ __('common.failed') }}</span>
                                                        @else
                                                            <span class="db-status-pill db-status-pill--warning">{{ __('common.pending') }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="db-table__date">{{ $order->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        <a href="{{route('user.order.show', $order->id)}}" class="db-action-btn">
                                                            <i class="fas fa-eye me-1"></i>{{ __('common.view') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="fas fa-inbox fa-4x mb-3" style="color: var(--color-stone, #d7d6d4);"></i>
                                        <h5 class="text-muted mt-3">{{ __('common.no_past_orders') }}</h5>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Points Redeemed Tab -->
                        <div class="tab-pane fade" id="points-redeemed" role="tabpanel" aria-labelledby="points-redeemed-tab">
                            <div class="db-content-card">
                                <h3 class="db-content-card__title">
                                    <i class="fas fa-graduation-cap me-2"></i>{{ __('common.points_redeemed_courses') }}
                                </h3>

                                @if(isset($redeemedOrders) && count($redeemedOrders) > 0)
                                    <div class="table-responsive">
                                        <table class="table db-table">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('common.order_number') }}</th>
                                                    <th>{{ __('common.course_name') }}</th>
                                                    <th>{{ __('common.level') }}</th>
                                                    <th>{{ __('common.points_used') }}</th>
                                                    <th>{{ __('common.status') }}</th>
                                                    <th>{{ __('common.date') }}</th>
                                                    <th>{{ __('common.action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($redeemedOrders as $order)
                                                @php
                                                    $cartItem = $order->cart_info->first();
                                                    $level = null;
                                                    if($cartItem) {
                                                        $level = \App\Models\ProductLevel::where('course_id', $cartItem->product_id)
                                                                                         ->where('price_in_points', $cartItem->points)
                                                                                         ->first();
                                                    }
                                                @endphp
                                                <tr>
                                                    <td class="db-table__highlight">{{ $order->order_number }}</td>
                                                    <td class="db-table__course-title">{{ $cartItem ? $cartItem->product->title : 'N/A' }}</td>
                                                    <td>
                                                        @if($level)
                                                            <span class="db-status-pill db-status-pill--teal">{{ $level->skill_level }}</span>
                                                        @else
                                                            <span class="db-status-pill db-status-pill--neutral">N/A</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="db-points-badge db-points-badge--teal">
                                                            <i class="fas fa-coins me-1"></i>{{ number_format($order->cart_info->sum('points')) }} CREDS
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if(strtolower($order->status) === 'completed')
                                                            <span class="db-status-pill db-status-pill--success">{{ __('common.redeemed') }}</span>
                                                        @else
                                                            <span class="db-status-pill db-status-pill--warning">{{ $order->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="db-table__date">{{ $order->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        <a href="{{route('user.order.show', $order->id)}}" class="db-action-btn">
                                                            <i class="fas fa-eye me-1"></i>{{ __('common.view') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="fas fa-book fa-4x mb-3" style="color: var(--color-stone, #d7d6d4);"></i>
                                        <h5 class="text-muted mt-3">{{ __('common.no_past_orders') }}</h5>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Change Password Tab -->
                        <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                            <div class="db-content-card">
                                <h3 class="db-content-card__title">
                                    <i class="fas fa-lock me-2"></i>{{ __('common.change_password') }}
                                </h3>

                                <div class="row">
                                    <div class="col-lg-10 mx-auto">
                                        <form action="{{ route('change.password') }}" method="POST" class="db-form" id="password-form" onsubmit="return handlePasswordSubmit(event)">
                                            @csrf

                                            <!-- Current Password -->
                                            <div class="db-form-group">
                                                <label for="current_password" class="db-label">
                                                    <i class="fas fa-key me-2"></i>{{ __('common.current_password') }}
                                                </label>
                                                <input type="password" id="current_password" name="current_password" class="db-input"
                                                       placeholder="{{ __('common.current_password_placeholder') }}">
                                            </div>

                                            <!-- New Password -->
                                            <div class="db-form-group">
                                                <label for="new_password" class="db-label">
                                                    <i class="fas fa-lock me-2"></i>{{ __('common.new_password') }}
                                                </label>
                                                <input type="password" id="new_password" name="new_password" class="db-input"
                                                       placeholder="{{ __('common.new_password_placeholder') }}">
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="db-form-group">
                                                <label for="new_confirm_password" class="db-label">
                                                    <i class="fas fa-check-circle me-2"></i>{{ __('common.confirm_password') }}
                                                </label>
                                                <input type="password" id="new_confirm_password" name="new_confirm_password" class="db-input"
                                                       placeholder="{{ __('common.confirm_password_placeholder') }}">
                                            </div>

                                            <!-- Submit Button -->
                                            <button type="submit" class="db-submit-btn">
                                                <i class="fas fa-save me-2"></i>{{ __('common.update_password') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
       USER DASHBOARD - REDESIGNED CREATIVE STUDIO CANVAS GRID
       ============================================================ */

    .account-section {
        background-color: var(--surface-paper-canvas, #fefdfc);
        position: relative;
        overflow: hidden;
        min-height: 75vh;
    }

    /* Ambient background glows */
    .account-bg-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(120px);
        -webkit-filter: blur(120px);
        pointer-events: none;
        opacity: 0.65;
        z-index: 0;
        mix-blend-mode: multiply;
    }
    .blob-mint {
        width: 420px;
        height: 420px;
        background-color: var(--color-mint-wash, #f0f6df);
        top: -100px;
        left: -100px;
        animation: dbFloat 20s ease-in-out infinite;
    }
    .blob-sky {
        width: 360px;
        height: 360px;
        background-color: var(--color-sky-wash, #dceaff);
        bottom: -80px;
        right: -80px;
        animation: dbFloat 24s ease-in-out infinite reverse;
    }
    .blob-peach {
        width: 300px;
        height: 300px;
        background-color: var(--surface-cream-wash, #fff6f0);
        top: 40%;
        left: 45%;
        animation: dbFloat 28s ease-in-out infinite;
    }

    @keyframes dbFloat {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50%      { transform: translate(24px, -28px) scale(1.06); }
    }

    .account-container {
        position: relative;
        z-index: 1;
    }

    /* ---- LEFT PANEL: SIDEBAR ---- */
    .db-profile-sidebar {
        display: flex;
        flex-direction: column;
        height: 100%;
        animation: dbFadeInLeft 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    /* Artify Member Card (Credit Card / Glassmorphic look) */
    .artify-member-card {
        background: linear-gradient(135deg, #1e1b18 0%, #2f2b27 100%);
        border: 1px solid rgba(254, 253, 252, 0.08);
        border-radius: 20px;
        padding: 24px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 14px 32px rgba(30, 27, 24, 0.18);
        margin-bottom: 24px;
        color: #fff;
    }
    .member-card-glow {
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(227, 68, 50, 0.4) 0%, transparent 70%);
        filter: blur(10px);
        pointer-events: none;
    }
    .member-card-inner {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 150px;
    }
    .member-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .member-logo {
        font-family: var(--font-graphik), sans-serif;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.15em;
        opacity: 0.8;
    }
    .coin-icon {
        font-size: 20px;
        color: #ffb830;
        text-shadow: 0 0 10px rgba(255, 184, 48, 0.5);
    }
    .member-card-body {
        margin: 16px 0;
    }
    .balance-label {
        font-family: var(--font-inter), sans-serif;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.1em;
        opacity: 0.6;
        text-transform: uppercase;
        display: block;
        margin-bottom: 4px;
    }
    .balance-value {
        font-family: var(--font-graphik), sans-serif;
        font-size: 32px;
        font-weight: 800;
        color: #fff;
        margin: 0;
        display: flex;
        align-items: baseline;
        gap: 6px;
    }
    .balance-value small {
        font-size: 14px;
        font-weight: 600;
        color: var(--color-ember-red, #e34432);
    }
    .member-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .member-name {
        font-family: var(--font-inter), sans-serif;
        font-size: 13px;
        font-weight: 600;
        opacity: 0.9;
        letter-spacing: 0.02em;
    }
    .member-topup-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 6px 12px;
        border-radius: 8px;
        font-family: var(--font-inter), sans-serif;
        font-size: 11px;
        font-weight: 700;
        color: #fff;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .member-topup-btn:hover {
        background: #fff;
        color: #1e1b18;
    }

    /* Greeting Overview */
    .db-profile-overview {
        background: var(--color-cream, #fff6f0);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 18px;
        padding: 22px;
        box-shadow: var(--shadow-subtle);
    }
    .greeting-title {
        font-family: var(--font-graphik), sans-serif;
        font-size: 18px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        margin: 0 0 6px 0;
    }
    .greeting-text {
        font-family: var(--font-inter), sans-serif;
        font-size: 13px;
        line-height: 1.5;
        color: var(--color-pencil, #6f6c69);
        margin: 0 0 18px 0;
    }
    .db-mini-stats {
        display: flex;
        align-items: center;
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 12px;
        padding: 12px 6px;
    }
    .mini-stat-item {
        flex: 1;
        text-align: center;
    }
    .mini-stat-value {
        display: block;
        font-family: var(--font-graphik), sans-serif;
        font-size: 20px;
        font-weight: 800;
        color: var(--color-ink, #25221e);
        line-height: 1.1;
    }
    .mini-stat-label {
        font-family: var(--font-inter), sans-serif;
        font-size: 9.5px;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--color-graphite, #94928f);
        letter-spacing: 0.05em;
        margin-top: 4px;
        display: block;
    }
    .mini-stat-divider {
        width: 1px;
        height: 24px;
        background-color: var(--color-stone, #d7d6d4);
    }

    /* Vertical Navigation tabs */
    .db-side-tabs {
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 18px;
        padding: 10px;
        gap: 4px;
        box-shadow: var(--shadow-subtle);
    }
    .db-side-tabs .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        border-radius: 10px;
        padding: 12px 16px;
        background: transparent;
        border: none;
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: var(--color-pencil, #6f6c69);
        text-align: left;
        width: 100%;
        transition: all 0.25s ease;
    }
    .db-side-tabs .nav-link i {
        font-size: 14px;
        opacity: 0.8;
    }
    .db-side-tabs .nav-link:hover {
        color: var(--color-deep-ember, #cf3520);
        background: var(--surface-cream-wash, #fff6f0);
    }
    .db-side-tabs .nav-link.active {
        color: var(--color-ember-red, #e34432);
        background: var(--color-cream, #fff6f0);
        position: relative;
    }
    .db-side-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background-color: var(--color-ember-red, #e34432);
    }
    .db-side-logout {
        display: flex;
        align-items: center;
        gap: 12px;
        border-radius: 10px;
        padding: 12px 16px;
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        font-weight: 700;
        color: var(--color-ember-red, #e34432);
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .db-side-logout:hover {
        background: rgba(227, 68, 50, 0.06);
        color: var(--color-deep-ember, #cf3520);
    }

    /* ---- RIGHT PANEL: MAIN CONTENT ---- */
    .db-main-content {
        animation: dbFadeInRight 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
    }
    .db-content-card {
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: 18px;
        padding: 36px clamp(18px, 4vw, 44px);
        box-shadow: var(--shadow-subtle);
        height: 100%;
    }
    .db-content-card__title {
        font-family: var(--font-graphik), sans-serif;
        font-size: 20px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        margin-bottom: 28px;
        display: flex;
        align-items: center;
    }
    .db-content-card__title i {
        color: var(--color-ember-red, #e34432);
    }

    /* ---- TABLE DESIGN ---- */
    .db-table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }
    .db-table thead th {
        background: var(--surface-cream-wash, #fff6f0) !important;
        border-bottom: 1.5px solid var(--color-stone, #d7d6d4) !important;
        color: var(--color-deep-ember, #cf3520) !important;
        font-family: var(--font-inter), sans-serif;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 14px 16px;
    }
    .db-table tbody tr {
        border-bottom: 1px solid rgba(37,34,30,0.06) !important;
        transition: background-color 0.2s ease;
    }
    .db-table tbody tr:hover {
        background-color: var(--color-cream, #fff6f0) !important;
    }
    .db-table tbody td {
        padding: 16px;
        vertical-align: middle;
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        color: var(--color-pencil, #6f6c69);
    }
    .db-table__highlight {
        font-weight: 700;
        color: var(--color-ink, #25221e) !important;
    }
    .db-table__course-title {
        color: var(--color-ink, #25221e) !important;
        font-weight: 600;
    }
    .db-table__price {
        font-family: var(--font-graphik), sans-serif;
        font-weight: 700;
        color: var(--color-ink, #25221e);
    }
    .db-table__date {
        color: var(--color-graphite, #94928f);
    }

    /* ---- BADGES & PILLS ---- */
    .db-points-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
        border: 1px solid transparent;
    }
    .db-points-badge--amber {
        background: var(--color-cream, #fff6f0);
        border-color: rgba(227, 68, 50, 0.15);
        color: var(--color-ember-red, #e34432);
    }
    .db-points-badge--teal {
        background: var(--color-sky-wash, #dceaff);
        border-color: rgba(73, 125, 126, 0.15);
        color: var(--color-teal-dusk, #497d7e);
    }

    .db-status-pill {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .db-status-pill--success { background: var(--color-mint-wash, #f0f6df); color: var(--color-forest, #446c3d); }
    .db-status-pill--warning { background: var(--surface-cream-wash, #fff6f0); color: #cf7820; }
    .db-status-pill--danger  { background: #ffebeb; color: #cf3220; }
    .db-status-pill--teal    { background: var(--color-sky-wash, #dceaff); color: var(--color-teal-dusk, #497d7e); }
    .db-status-pill--neutral { background: #f1f0ef; color: var(--color-pencil, #6f6c69); }

    /* ---- ACTION BUTTONS ---- */
    .db-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: transparent;
        border: 1px solid var(--color-stone, #d7d6d4);
        color: var(--color-pencil, #6f6c69);
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.25s ease;
    }
    .db-action-btn:hover {
        border-color: rgba(227, 68, 50, 0.3);
        background: var(--color-cream, #fff6f0);
        color: var(--color-deep-ember, #cf3520);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37,34,30,0.03);
    }

    /* ---- FORMS ---- */
    .db-form {
        display: grid;
        gap: 20px;
    }
    .db-form-group {
        display: flex;
        flex-direction: column;
    }
    .db-label {
        font-family: var(--font-inter), sans-serif;
        font-size: 12px;
        font-weight: 700;
        color: var(--color-ink, #25221e);
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: flex;
        align-items: center;
    }
    .db-label i {
        color: var(--color-ember-red, #e34432);
    }
    .db-input {
        width: 100%;
        padding: 12px 15px;
        background: var(--surface-paper-canvas, #fefdfc);
        border: 1.5px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-lg, 8px);
        color: var(--color-ink, #25221e);
        font-family: var(--font-inter), sans-serif;
        font-size: 14px;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .db-input:focus {
        outline: none;
        background: #fff;
        border-color: var(--color-ember-red, #e34432);
        box-shadow: 0 0 0 4px rgba(227, 68, 50, 0.12);
        transform: translateY(-1px);
    }
    .db-submit-btn {
        background: var(--color-ember-red, #e34432);
        color: var(--color-paper, #fefdfc);
        border: none;
        border-radius: var(--radius-buttons, 8px);
        padding: 14px 20px;
        font-family: var(--font-inter), sans-serif;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 4px 14px rgba(227, 68, 50, 0.2);
    }
    .db-submit-btn:hover {
        background: var(--color-deep-ember, #cf3520);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(227, 68, 50, 0.35);
    }

    /* ---- ENTRANCE ANIMATIONS ---- */
    @keyframes dbFadeInLeft {
        from { opacity: 0; transform: translateX(-32px); }
        to   { opacity: 1; transform: translateX(0); }
    }
    @keyframes dbFadeInRight {
        from { opacity: 0; transform: translateX(32px); }
        to   { opacity: 1; transform: translateX(0); }
    }

    /* ---- RESPONSIVE ---- */
    @media (max-width: 991px) {
        .db-profile-sidebar { margin-bottom: 32px; }
        .db-content-card { padding: 24px 20px; }
    }
    @media (max-width: 575px) {
        .db-mini-stats { padding: 12px 4px; }
        .db-side-tabs { padding: 6px; }
        .db-side-tabs .nav-link { padding: 10px 12px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .db-profile-sidebar,
        .db-main-content,
        .account-bg-blob { animation: none !important; }
    }

    .db-input.is-invalid {
        border-color: var(--color-ember-red, #e34432) !important;
        background-color: #fffaf9 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    function handlePasswordSubmit(event) {
        event.preventDefault();

        // Get form values
        const currentPassword = document.getElementById('current_password').value.trim();
        const newPassword = document.getElementById('new_password').value.trim();
        const newConfirmPassword = document.getElementById('new_confirm_password').value.trim();

        // Clear previous error messages
        document.querySelectorAll('.custom-error-message').forEach(el => el.remove());
        document.querySelectorAll('.db-input').forEach(el => el.classList.remove('is-invalid'));

        let hasErrors = false;
        const errors = [];

        // Validation checks
        if (!currentPassword) {
            errors.push({ field: 'current_password', message: 'Current password is required.' });
            hasErrors = true;
        }

        if (!newPassword) {
            errors.push({ field: 'new_password', message: 'New password is required.' });
            hasErrors = true;
        } else if (newPassword.length < 8) {
            errors.push({ field: 'new_password', message: 'New password must be at least 8 characters long.' });
            hasErrors = true;
        }

        if (!newConfirmPassword) {
            errors.push({ field: 'new_confirm_password', message: 'Confirm password is required.' });
            hasErrors = true;
        } else if (newPassword !== newConfirmPassword) {
            errors.push({ field: 'new_confirm_password', message: 'Passwords do not match.' });
            hasErrors = true;
        }

        // Show error messages
        if (hasErrors) {
            errors.forEach(error => {
                const field = document.getElementById(error.field);
                if (field) {
                    field.classList.add('is-invalid');
                    const errorDiv = document.createElement('span');
                    errorDiv.className = 'text-danger small mt-2 d-block custom-error-message';
                    errorDiv.innerHTML = `<i class="fas fa-info-circle me-1"></i>${error.message}`;
                    field.parentElement.appendChild(errorDiv);
                }
            });
            return false;
        }

        // If no errors, submit the form
        document.getElementById('password-form').submit();
    }

    // Add real-time validation
    document.getElementById('current_password')?.addEventListener('input', function() {
        this.classList.toggle('is-invalid', !this.value.trim());
        const errorMsg = this.parentElement.querySelector('.custom-error-message');
        if (errorMsg && this.value.trim()) errorMsg.remove();
    });

    document.getElementById('new_password')?.addEventListener('input', function() {
        const isValid = this.value.trim() && this.value.trim().length >= 8;
        this.classList.toggle('is-invalid', !isValid);
        const errorMsg = this.parentElement.querySelector('.custom-error-message');
        if (errorMsg && isValid) errorMsg.remove();
    });

    document.getElementById('new_confirm_password')?.addEventListener('input', function() {
        const newPassword = document.getElementById('new_password').value.trim();
        const isValid = this.value.trim() && this.value.trim() === newPassword;
        this.classList.toggle('is-invalid', !isValid);
        const errorMsg = this.parentElement.querySelector('.custom-error-message');
        if (errorMsg && isValid) errorMsg.remove();
    });
</script>
@endpush
