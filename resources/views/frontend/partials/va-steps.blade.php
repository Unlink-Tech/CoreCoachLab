{{-- "Start your journey in only 4 steps" block (home, legal documents). Optional: $sectionClass --}}
@php
    $vaSteps = [
        ['num' => '01', 'step' => 'Step One', 'label' => 'Register User', 'pill' => 'Signup', 'title' => 'Create Profile',
         'text' => 'Complete our secure registration form in under 2 minutes.', 'stroke' => 'var(--accent-2)',
         'icon' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>'],
        ['num' => '02', 'step' => 'Step Two', 'label' => 'Verifying ID', 'pill' => 'Approved', 'title' => 'Identity Verification',
         'text' => 'Submit quick proof of ID and address for automated KYC approval.', 'stroke' => '#4edf8e',
         'icon' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>'],
        ['num' => '03', 'step' => 'Step Three', 'label' => '+ $30,000', 'pill' => 'Deposit', 'title' => 'Fund Your Account',
         'text' => 'Make a deposit using your preferred secure payment method.', 'stroke' => 'var(--accent-2)',
         'icon' => '<rect x="2" y="5" width="20" height="14" rx="2" ry="2"/><line x1="2" y1="10" x2="22" y2="10"/>'],
        ['num' => '04', 'step' => 'Step Four', 'label' => 'Active Trades', 'pill' => 'Complete', 'title' => 'Launch Trading',
         'text' => 'Gain access to 600+ instruments and place your first trade.', 'stroke' => '#4edf8e',
         'icon' => '<path d="M3 3v18h18M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/>'],
    ];
@endphp
<section class="va-section {{ $sectionClass ?? '' }}">
    <div class="va-hero__container">
        <h2 class="va-steps__title" data-va-reveal>Start your journey in only <span>4 steps:</span></h2>
        <div class="va-steps" data-va-reveal>
            @foreach($vaSteps as $s)
                <div class="va-step">
                    <div class="va-step__num-row">
                        <span class="va-step__num">{{ $s['num'] }}</span>
                        <span class="va-step__step">{{ $s['step'] }}</span>
                    </div>
                    <div class="va-step__mock">
                        <div class="va-step__dots"><span></span><span></span><span></span></div>
                        <div class="va-step__row">
                            <div class="va-step__ico">
                                <svg viewBox="0 0 24 24" fill="none" stroke="{{ $s['stroke'] }}" stroke-width="2.5" aria-hidden="true">{!! $s['icon'] !!}</svg>
                            </div>
                            <span class="va-step__label">{{ $s['label'] }}</span>
                        </div>
                        <div class="va-step__pill">
                            {{ $s['pill'] }}
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
                        </div>
                    </div>
                    <h3>{{ $s['title'] }}</h3>
                    <p>{{ $s['text'] }}</p>
                </div>
            @endforeach
        </div>
        <div class="va-steps__cta" data-va-reveal>
            <a class="va-btn va-btn--primary va-btn--lg va-steps__btn" href="{{ route('register.form') }}">
                Open Account
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
            </a>
        </div>
    </div>
</section>
