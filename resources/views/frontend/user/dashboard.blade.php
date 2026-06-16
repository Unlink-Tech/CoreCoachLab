@extends('frontend.layouts.main')
@section('page-body-class', 'page-dashboard')
@section('title', __('common.dashboard.page_title'))
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
                                <span class="member-logo">{{ __('common.dashboard.member_card_title') }}</span>
                                <i class="fas fa-coins coin-icon"></i>
                            </div>
                            <div class="member-card-body">
                                <span class="balance-label">{{ __('common.available_points') }}</span>
                                <h2 class="balance-value">
                                    {{ Auth::user()->points_balance ?? 0 }} <small>{{ __('common.account.creds') }}</small>
                                </h2>
                            </div>
                            <div class="member-card-footer">
                                <div class="member-name">{{ Auth::user()->name ?? 'Creative Artist' }}</div>
                                <a href="{{ route('points.topup') }}" class="member-topup-btn">
                                    <i class="fas fa-plus"></i> {{ __('common.dashboard.recharge_button') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Greeting & Overview -->
                    <div class="db-profile-overview mb-4">
                        <h4 class="greeting-title">{{ __('common.dashboard.greeting', ['name' => explode(' ', Auth::user()->name)[0] ?? 'Artist']) }}</h4>
                        <p class="greeting-text">{{ __('common.dashboard.greeting_message') }}</p>
                        
                        <!-- Mini Stats Grid -->
                        <div class="db-mini-stats">
                            <div class="mini-stat-item">
                                <span class="mini-stat-value">{{ isset($redeemedOrders) ? count($redeemedOrders) : 0 }}</span>
                                <span class="mini-stat-label">{{ __('common.dashboard.enrolled_label') }}</span>
                            </div>
                            <div class="mini-stat-divider"></div>
                            <div class="mini-stat-item">
                                <span class="mini-stat-value">{{ isset($redeemedOrders) ? count($redeemedOrders->where('status', 'Completed')) : 0 }}</span>
                                <span class="mini-stat-label">{{ __('common.dashboard.completed_label') }}</span>
                            </div>
                            <div class="mini-stat-divider"></div>
                            <div class="mini-stat-item">
                                <span class="mini-stat-value">{{ Auth::user()->created_at->format('Y') }}</span>
                                <span class="mini-stat-label">{{ __('common.dashboard.joined_label') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Navigation Tabs -->
                    <ul class="nav flex-column db-side-tabs" id="dashboardTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="points-purchased-tab" data-bs-toggle="tab" data-bs-target="#points-purchased" type="button" role="tab" aria-controls="points-purchased" aria-selected="true">
                                <i class="fas fa-wallet"></i> {{ __('common.dashboard.purchase_history_tab') }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="points-redeemed-tab" data-bs-toggle="tab" data-bs-target="#points-redeemed" type="button" role="tab" aria-controls="points-redeemed" aria-selected="false">
                                <i class="fas fa-book-open"></i> {{ __('common.dashboard.redeemed_courses_tab') }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="change-password-tab" data-bs-toggle="tab" data-bs-target="#change-password" type="button" role="tab" aria-controls="change-password" aria-selected="false">
                                <i class="fas fa-lock"></i> {{ __('common.dashboard.security_password_tab') }}
                            </button>
                        </li>
                        <li class="nav-item mt-3">
                            <a href="{{ route('user.logout') }}" class="db-side-logout">
                                <i class="fas fa-sign-out-alt"></i> {{ __('common.dashboard.logout_button') }}
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
                                        <i class="fas fa-wallet fa-4x mb-3" style="color: var(--color-stone, #d7d6d4);"></i>
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
                                        <i class="fas fa-book-open fa-4x mb-3" style="color: var(--color-stone, #d7d6d4);"></i>
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
