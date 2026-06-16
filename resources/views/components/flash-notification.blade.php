{{-- Flash notification toasts component --}}
@if (session('success') || session('error') || session('loginerror'))
<div class="artify-toasts" aria-live="polite" aria-atomic="true" role="region" aria-label="Notifications">

    @if (session('success'))
        <div class="artify-toast artify-toast--success" role="alert">
            <div class="artify-toast__content">
                <span class="artify-toast__icon"><i class="fas fa-check-circle"></i></span>
                <div class="artify-toast__message">{{ session('success') }}</div>
            </div>
            <button type="button" class="artify-toast__close" aria-label="Dismiss notification">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="artify-toast artify-toast--error" role="alert">
            <div class="artify-toast__content">
                <span class="artify-toast__icon"><i class="fas fa-exclamation-circle"></i></span>
                <div class="artify-toast__message">{{ session('error') }}</div>
            </div>
            <button type="button" class="artify-toast__close" aria-label="Dismiss notification">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    @if (session('loginerror'))
        <div class="artify-toast artify-toast--error" role="alert">
            <div class="artify-toast__content">
                <span class="artify-toast__icon"><i class="fas fa-exclamation-circle"></i></span>
                <div class="artify-toast__message">{{ session('loginerror') }}</div>
            </div>
            <button type="button" class="artify-toast__close" aria-label="Dismiss notification">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

</div>

<script>
    (function initToasts() {
        const toasts = document.querySelectorAll('.artify-toast');

        toasts.forEach(function (toast) {
            const dismiss = function () {
                toast.classList.add('artify-toast--dismiss');
                setTimeout(function () { toast.remove(); }, 350);
            };

            const closeBtn = toast.querySelector('.artify-toast__close');
            if (closeBtn) closeBtn.addEventListener('click', dismiss);

            setTimeout(dismiss, 5000);
        });
    })();
</script>
@endif
