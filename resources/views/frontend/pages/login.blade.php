@extends('frontend.layouts.main')
@section('title','Login')
@section('main-content')

<div class="tl-breadcrumb about-banner pt-60 pb-60">
    <video autoplay muted loop playsinline>
        <source src="{{ asset('assets/images/breadcrumb.mp4') }}" type="video/mp4">
    </video>
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.login') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.login') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="auth-section pt-60 pb-80 bg-light" style="position: relative; overflow: hidden;">
    <!-- Decorative Blobs -->
    <div class="modern-blob modern-blob-1" style="top: -100px; left: -100px; width: 400px; height: 400px; background: var(--primary-10);"></div>
    <div class="modern-blob modern-blob-2" style="bottom: -100px; right: -100px; width: 400px; height: 400px; background: var(--primary-10);"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-9">
                <div class="modern-card auth-card border-0 shadow-xl overflow-hidden" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(20px); border-radius: 20px;">
                    <!-- Header Section with Gradient -->
                    <div class="auth-card-header p-5 text-center" style="background: linear-gradient(135deg, var(--primary-10) 0%, var(--secondary-10) 100%);">
                        <div class="mb-3">
                            <i class="fas fa-lock-open text-primary" style="font-size: 48px; opacity: 0.8;"></i>
                        </div>
                        <span class="modern-badge mb-3">{{ __('common.welcome_back') }}</span>
                        <h2 class="modern-h2 mb-0" style="font-size: 28px; color: var(--text-dark);">{{ __('common.login') }}</h2>
                    </div>

                    <!-- Content Section -->
                    <div class="p-5">
                        <form name="frmLogin" id="frmLogin" action="{{route('login.submit')}}" method="post">
                            @csrf

                            <!-- Email Field -->
                            <div class="mb-4">
                                <label class="small fw-bold text-uppercase opacity-75 mb-2 d-flex align-items-center">
                                    <i class="fas fa-envelope text-primary me-2" style="font-size: 12px;"></i>
                                    {{ __('common.email') }}
                                </label>
                                <input type="email" name="email" id="email" placeholder="{{ __('common.email') }}" value="{{old('email')}}" class="form-control form-control-lg bg-light border-1 py-3 px-4 rounded-3 @error('email') is-invalid @enderror" style="border-color: var(--border-light);">
                                @error('email')
                                    <span class="text-danger small mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="mb-2">
                                <label class="small fw-bold text-uppercase opacity-75 mb-2 d-flex align-items-center">
                                    <i class="fas fa-lock text-primary me-2" style="font-size: 12px;"></i>
                                    {{ __('common.password') }}
                                </label>
                                <input type="password" name="password" id="password" placeholder="{{ __('common.password') }}" class="form-control form-control-lg bg-light border-1 py-3 px-4 rounded-3 @error('password') is-invalid @enderror" style="border-color: var(--border-light);">
                                @error('password')
                                    <span class="text-danger small mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                @enderror
                            </div>

                            <!-- Forgot Password Link -->
                            <div class="text-end mb-4">
                                <a href="{{route('forgetpwd.form')}}" class="small text-primary fw-bold text-decoration-none hover-underline">{{ __('common.lost_password_text') }}</a>
                            </div>

                            <!-- Login Button -->
                            <div class="mt-5">
                                <button class="modern-btn modern-btn-solid w-100 py-3 fw-bold shadow-lg rounded-3" type="submit" name="submit-form" style="font-size: 15px; letter-spacing: 0.5px;">
                                    <i class="fas fa-sign-in-alt me-2"></i> {{ __('common.login') }}
                                </button>
                            </div>
                        </form>

                        <!-- Divider -->
                        <div class="my-4 d-flex align-items-center">
                            <div style="flex: 1; height: 1px; background: var(--border-light);"></div>
                            <span class="mx-3 small text-muted">{{ __('common.or') }}</span>
                            <div style="flex: 1; height: 1px; background: var(--border-light);"></div>
                        </div>

                        <!-- Sign Up Link -->
                        <div class="text-center">
                            <p class="text-muted mb-0">
                                {{ __('common.dont_have_account') }}
                                <a href="{{route('register.form')}}" class="text-primary fw-bold text-decoration-none hover-underline">{{ __('common.sign_up_now') }}</a>
                            </p>
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
    .auth-card {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        animation: slideInUp 0.6s ease-out;
    }

    .auth-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(var(--primary-rgb), 0.25) !important;
    }

    .auth-card-header {
        border-bottom: 1px solid rgba(var(--primary-rgb), 0.1);
    }

    .form-control {
        font-size: 15px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 1px solid var(--border-light) !important;
    }

    .form-control:focus {
        background-color: var(--white) !important;
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 4px rgba(var(--primary-rgb), 0.15) !important;
    }

    .form-control::placeholder {
        color: #a0aec0;
        font-weight: 400;
    }

    .form-control-lg {
        border-radius: 12px;
    }

    .error {
        color: #dc3545 !important;
        font-size: 13px;
        margin-top: 5px;
        font-weight: 500;
    }

    .hover-underline:hover {
        text-decoration: underline !important;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert {
        border-radius: 12px;
        padding: 15px 20px;
        font-weight: 500;
    }

    .alert-success {
        background-color: rgba(75, 184, 250, 0.1) !important;
        border-color: rgba(75, 184, 250, 0.3) !important;
        color: var(--primary) !important;
    }

    .alert-danger {
        background-color: rgba(239, 68, 68, 0.1) !important;
        border-color: rgba(239, 68, 68, 0.3) !important;
        color: #dc3545 !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#frmLogin").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 5
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                password: {
                    required: "{{ __('common.password_required') }}",
                    minlength: "{{ __('common.password_confirmation_min') }}"
                },
                email: "{{ __('common.email_required') }}"
            }
        });
    });
</script>
@endpush

