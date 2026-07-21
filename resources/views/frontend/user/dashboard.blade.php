@extends('frontend.layouts.main')
@section('page-body-class', 'page-dashboard')
@section('title', __('common.dashboard.page_title'))
@section('main-content')

    <x-breadcrumb :title="__('common.my_account')" :routes="[
            ['label' => __('common.my_account')]
        ]" />

    @php
        $firstName = explode(' ', Auth::user()->name)[0] ?? 'Artist';
        $enrolledCount = isset($redeemedOrders) ? count($redeemedOrders) : 0;
        $completedCount = isset($redeemedOrders) ? count($redeemedOrders->where('status', 'Completed')) : 0;
        $joinedYear = Auth::user()->created_at->format('Y');
    @endphp

    {{-- ============================================================
         HERO — welcome + balance + stats
         ============================================================ --}}
    <section class="dash-hero">
        <span class="dash-hero__blob dash-hero__blob--a" aria-hidden="true"></span>
        <span class="dash-hero__blob dash-hero__blob--b" aria-hidden="true"></span>

        <div class="container dash-hero__inner">
            <div class="dash-hero__grid">

                {{-- LEFT: greeting --}}
                <div class="dash-hero__welcome">
                    <div class="dash-hero__avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <span class="dash-eyebrow">
                            <span class="dash-eyebrow__dot" aria-hidden="true"></span>
                            {{ __('common.my_account') }}
                        </span>
                        <h1 class="dash-hero__title">
                            {{ __('common.dashboard.greeting', ['name' => $firstName]) }}
                        </h1>
                        <p class="dash-hero__lede">{{ __('common.dashboard.greeting_message') }}</p>
                        <a href="{{ route('user.logout') }}" class="dash-hero__logout">
                            <i class="fas fa-sign-out-alt"></i>
                            {{ __('common.dashboard.logout_button') }}
                        </a>
                    </div>
                </div>

                {{-- RIGHT: dark balance card --}}
                <div class="dash-hero__balance">
                    <span class="dash-hero__balance-glow" aria-hidden="true"></span>
                    <div class="dash-hero__balance-inner">
                        <span class="dash-eyebrow dash-eyebrow--dark">
                            <span class="dash-eyebrow__dot" aria-hidden="true"></span>
                            {{ __('common.dashboard.member_card_title') }}
                        </span>
                        <span class="dash-hero__balance-label">{{ __('common.available_points') }}</span>
                        <div class="dash-hero__balance-value">
                            {{ number_format(Auth::user()->points_balance ?? 0) }}
                            <small>{{ __('common.account.creds') }}</small>
                        </div>
                        <div class="dash-hero__balance-foot">
                            <span class="dash-hero__balance-name">{{ Auth::user()->name ?? 'Creative Artist' }}</span>
                            <a href="{{ route('points.topup') }}" class="dash-hero__topup">
                                <i class="fas fa-plus"></i>
                                {{ __('common.dashboard.recharge_button') }}
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Stats row --}}
            <div class="dash-hero__stats">
                <div class="dash-stat">
                    <span class="dash-stat__num">{{ $enrolledCount }}</span>
                    <span class="dash-stat__label">{{ __('common.dashboard.enrolled_label') }}</span>
                </div>
                <div class="dash-stat">
                    <span class="dash-stat__num">{{ $completedCount }}</span>
                    <span class="dash-stat__label">{{ __('common.dashboard.completed_label') }}</span>
                </div>
                <div class="dash-stat">
                    <span class="dash-stat__num">{{ $joinedYear }}</span>
                    <span class="dash-stat__label">{{ __('common.dashboard.joined_label') }}</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         MAIN CONTENT — editorial tab bar + panels
         ============================================================ --}}
    <section class="dash-content">
        <div class="container dash-content__inner">

            {{-- Editorial tab bar (dark pill container) --}}
            <ul class="nav nav-pills dash-tabs" id="dashboardTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link dash-tab active"
                            id="points-purchased-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#points-purchased"
                            type="button" role="tab"
                            aria-controls="points-purchased" aria-selected="true">
                        <span class="dash-tab__num">01</span>
                        <span class="dash-tab__label">
                            <i class="fas fa-wallet"></i>
                            {{ __('common.dashboard.purchase_history_tab') }}
                        </span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link dash-tab"
                            id="points-redeemed-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#points-redeemed"
                            type="button" role="tab"
                            aria-controls="points-redeemed" aria-selected="false">
                        <span class="dash-tab__num">02</span>
                        <span class="dash-tab__label">
                            <i class="fas fa-book-open"></i>
                            {{ __('common.dashboard.redeemed_courses_tab') }}
                        </span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link dash-tab"
                            id="change-password-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#change-password"
                            type="button" role="tab"
                            aria-controls="change-password" aria-selected="false">
                        <span class="dash-tab__num">03</span>
                        <span class="dash-tab__label">
                            <i class="fas fa-lock"></i>
                            {{ __('common.dashboard.security_password_tab') }}
                        </span>
                    </button>
                </li>
            </ul>

            <div class="tab-content dash-panels" id="dashboardContent">

                {{-- ---- Purchase history ---- --}}
                <div class="tab-pane fade show active" id="points-purchased" role="tabpanel" aria-labelledby="points-purchased-tab">
                    <article class="dash-panel">
                        <div class="dash-panel__head">
                            <span class="dash-panel__ico"><i class="fas fa-wallet"></i></span>
                            <div>
                                <h3 class="dash-panel__title">{{ __('common.points_purchased_wallet') }}</h3>
                                <p class="dash-panel__sub">{{ __('common.dashboard.purchase_history_tab') }}</p>
                            </div>
                        </div>

                        @if(isset($purchasedOrders) && count($purchasedOrders) > 0)
                            <div class="table-responsive">
                                <table class="table dash-table">
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
                                                <td class="dash-table__ref">{{ $order->order_number }}</td>
                                                <td>
                                                    <span class="dash-chip dash-chip--ember">
                                                        <i class="fas fa-coins"></i>
                                                        {{ number_format($order->cart_info->sum('points')) }}
                                                        {{ __('common.account.creds') }}
                                                    </span>
                                                </td>
                                                <td class="dash-table__price">
                                                    {{ Helper::getCurrencySymbol($order->currency) }}{{ number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2) }}
                                                </td>
                                                <td>
                                                    @if($order->payment_status === 'Completed')
                                                        <span class="dash-status dash-status--success">{{ __('common.paid') }}</span>
                                                    @elseif($order->payment_status === 'Failed')
                                                        <span class="dash-status dash-status--danger">{{ __('common.failed') }}</span>
                                                    @else
                                                        <span class="dash-status dash-status--warning">{{ __('common.pending') }}</span>
                                                    @endif
                                                </td>
                                                <td class="dash-table__date">{{ $order->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <a href="{{route('user.order.show', $order->id)}}" class="dash-btn">
                                                        <i class="fas fa-eye"></i>
                                                        {{ __('common.view') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="dash-empty">
                                <div class="dash-empty__ico"><i class="fas fa-wallet"></i></div>
                                <p>{{ __('common.no_past_orders') }}</p>
                            </div>
                        @endif
                    </article>
                </div>

                {{-- ---- Redeemed courses ---- --}}
                <div class="tab-pane fade" id="points-redeemed" role="tabpanel" aria-labelledby="points-redeemed-tab">
                    <article class="dash-panel">
                        <div class="dash-panel__head">
                            <span class="dash-panel__ico"><i class="fas fa-graduation-cap"></i></span>
                            <div>
                                <h3 class="dash-panel__title">{{ __('common.points_redeemed_courses') }}</h3>
                                <p class="dash-panel__sub">{{ __('common.dashboard.redeemed_courses_tab') }}</p>
                            </div>
                        </div>

                        @if(isset($redeemedOrders) && count($redeemedOrders) > 0)
                            <div class="table-responsive">
                                <table class="table dash-table">
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
                                                if ($cartItem) {
                                                    $level = \App\Models\ProductLevel::where('course_id', $cartItem->product_id)
                                                        ->where('price_in_points', $cartItem->points)
                                                        ->first();
                                                }
                                            @endphp
                                            <tr>
                                                <td class="dash-table__ref">{{ $order->order_number }}</td>
                                                <td class="dash-table__course">{{ $cartItem ? $cartItem->product->title : 'N/A' }}</td>
                                                <td>
                                                    @if($level)
                                                        <span class="dash-status dash-status--info">{{ $level->skill_level }}</span>
                                                    @else
                                                        <span class="dash-status dash-status--neutral">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="dash-chip dash-chip--ember">
                                                        <i class="fas fa-coins"></i>
                                                        {{ number_format($order->cart_info->sum('points')) }}
                                                        {{ __('common.account.creds') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if(strtolower($order->status) === 'completed')
                                                        <span class="dash-status dash-status--success">{{ __('common.redeemed') }}</span>
                                                    @else
                                                        <span class="dash-status dash-status--warning">{{ $order->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="dash-table__date">{{ $order->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <a href="{{route('user.order.show', $order->id)}}" class="dash-btn">
                                                        <i class="fas fa-eye"></i>
                                                        {{ __('common.view') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="dash-empty">
                                <div class="dash-empty__ico"><i class="fas fa-book-open"></i></div>
                                <p>{{ __('common.no_past_orders') }}</p>
                            </div>
                        @endif
                    </article>
                </div>

                {{-- ---- Change password ---- --}}
                <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                    <article class="dash-panel">
                        <div class="dash-panel__head">
                            <span class="dash-panel__ico"><i class="fas fa-lock"></i></span>
                            <div>
                                <h3 class="dash-panel__title">{{ __('common.change_password') }}</h3>
                                <p class="dash-panel__sub">{{ __('common.dashboard.security_password_tab') }}</p>
                            </div>
                        </div>

                        <form action="{{ route('change.password') }}" method="POST" class="dash-form" id="password-form" onsubmit="return handlePasswordSubmit(event)">
                            @csrf

                            <div class="dash-field">
                                <label for="current_password" class="dash-label">
                                    <i class="fas fa-key"></i>{{ __('common.current_password') }}
                                </label>
                                <input type="password" id="current_password" name="current_password"
                                       class="db-input dash-input"
                                       placeholder="{{ __('common.current_password_placeholder') }}">
                            </div>

                            <div class="dash-form__row">
                                <div class="dash-field">
                                    <label for="new_password" class="dash-label">
                                        <i class="fas fa-lock"></i>{{ __('common.new_password') }}
                                    </label>
                                    <input type="password" id="new_password" name="new_password"
                                           class="db-input dash-input"
                                           placeholder="{{ __('common.new_password_placeholder') }}">
                                </div>

                                <div class="dash-field">
                                    <label for="new_confirm_password" class="dash-label">
                                        <i class="fas fa-check-circle"></i>{{ __('common.confirm_password') }}
                                    </label>
                                    <input type="password" id="new_confirm_password" name="new_confirm_password"
                                           class="db-input dash-input"
                                           placeholder="{{ __('common.confirm_password_placeholder') }}">
                                </div>
                            </div>

                            <button type="submit" class="dash-submit">
                                <span>{{ __('common.update_password') }}</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </form>
                    </article>
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
        document.getElementById('current_password')?.addEventListener('input', function () {
            this.classList.toggle('is-invalid', !this.value.trim());
            const errorMsg = this.parentElement.querySelector('.custom-error-message');
            if (errorMsg && this.value.trim()) errorMsg.remove();
        });

        document.getElementById('new_password')?.addEventListener('input', function () {
            const isValid = this.value.trim() && this.value.trim().length >= 8;
            this.classList.toggle('is-invalid', !isValid);
            const errorMsg = this.parentElement.querySelector('.custom-error-message');
            if (errorMsg && isValid) errorMsg.remove();
        });

        document.getElementById('new_confirm_password')?.addEventListener('input', function () {
            const newPassword = document.getElementById('new_password').value.trim();
            const isValid = this.value.trim() && this.value.trim() === newPassword;
            this.classList.toggle('is-invalid', !isValid);
            const errorMsg = this.parentElement.querySelector('.custom-error-message');
            if (errorMsg && isValid) errorMsg.remove();
        });
    </script>
@endpush
