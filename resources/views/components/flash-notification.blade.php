{{-- ============================================================
     FLASH NOTIFICATION TOASTS  (self-contained component)
     Reads Laravel session flash keys set by backend controllers:
       session('success'), session('error'), session('loginerror')
     Presentational only — no backend logic, no global-CSS dependency.
     ============================================================ --}}

@if (session('success') || session('error') || session('loginerror'))
<div class="af-toasts" aria-live="polite" aria-atomic="true">

    @if (session('success'))
        <div class="af-toast af-toast--success" role="alert">
            <span class="af-toast__icon"><i class="fas fa-check-circle"></i></span>
            <div class="af-toast__msg">{{ session('success') }}</div>
            <button type="button" class="af-toast__close" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
    @endif

    @if (session('error'))
        <div class="af-toast af-toast--danger" role="alert">
            <span class="af-toast__icon"><i class="fas fa-exclamation-circle"></i></span>
            <div class="af-toast__msg">{{ session('error') }}</div>
            <button type="button" class="af-toast__close" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
    @endif

    @if (session('loginerror'))
        <div class="af-toast af-toast--danger" role="alert">
            <span class="af-toast__icon"><i class="fas fa-exclamation-circle"></i></span>
            <div class="af-toast__msg">{{ session('loginerror') }}</div>
            <button type="button" class="af-toast__close" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
    @endif

</div>

<style>
    /* fixed stack, top-right — never affects page/header layout */
    .af-toasts {
        position: fixed;
        top: 90px;
        right: 20px;
        z-index: 2000;
        display: flex;
        flex-direction: column;
        gap: 12px;
        width: 360px;
        max-width: calc(100vw - 40px);
        pointer-events: none;
    }

    .af-toast {
        position: relative;
        pointer-events: auto;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px 16px;
        background: var(--color-paper, #fefdfc);
        border: 1px solid var(--color-stone, #d7d6d4);
        border-radius: var(--radius-lg, 8px);
        color: var(--color-ink, #25221e);
        box-shadow: 0 16px 40px rgba(37, 34, 30, 0.14), 0 2px 8px rgba(37, 34, 30, 0.06);
        -webkit-backdrop-filter: blur(8px);
                backdrop-filter: blur(8px);
        overflow: hidden;
        animation: afToastIn 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        transition: opacity 0.35s ease, transform 0.35s ease;
    }
    .af-toast.af-toast--out { opacity: 0; transform: translateX(40px); }

    /* left accent stripe */
    .af-toast::before {
        content: '';
        position: absolute;
        left: 0; top: 0; bottom: 0;
        width: 4px;
    }
    .af-toast--success::before { background: var(--color-forest, #446c3d); }
    .af-toast--danger::before  { background: var(--color-ember-red, #e34432); }

    /* icon medallion */
    .af-toast__icon {
        flex-shrink: 0;
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 18px;
    }
    .af-toast--success .af-toast__icon { background: var(--color-mint-wash, #f0f6df); color: var(--color-forest, #446c3d); }
    .af-toast--danger  .af-toast__icon { background: rgba(227, 68, 50, 0.10); color: var(--color-ember-red, #e34432); }

    /* message */
    .af-toast__msg {
        flex: 1;
        font-family: var(--font-inter, sans-serif);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.5;
        color: var(--color-ink, #25221e);
        word-break: break-word;
    }

    /* close button */
    .af-toast__close {
        flex-shrink: 0;
        width: 26px;
        height: 26px;
        padding: 0;
        margin: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 50%;
        background: transparent;
        color: var(--color-graphite, #94928f);
        font-size: 13px;
        cursor: pointer;
        opacity: 0.85;
        transition: opacity 0.2s ease, background 0.2s ease, color 0.2s ease;
    }
    .af-toast__close:hover {
        opacity: 1;
        background: rgba(37, 34, 30, 0.06);
        color: var(--color-ink, #25221e);
    }

    @keyframes afToastIn {
        from { opacity: 0; transform: translateX(40px); }
        to   { opacity: 1; transform: translateX(0); }
    }

    @media (max-width: 575px) {
        .af-toasts { top: 78px; right: 12px; left: 12px; width: auto; }
    }
    @media (prefers-reduced-motion: reduce) {
        .af-toast { animation: none; }
    }
</style>

<script>
    (function () {
        var toasts = document.querySelectorAll('.af-toast');
        toasts.forEach(function (toast) {
            var dismiss = function () {
                toast.classList.add('af-toast--out');
                setTimeout(function () { toast.remove(); }, 350);
            };
            var btn = toast.querySelector('.af-toast__close');
            if (btn) btn.addEventListener('click', dismiss);
            // auto-dismiss after 5s
            setTimeout(dismiss, 5000);
        });
    })();
</script>
@endif
