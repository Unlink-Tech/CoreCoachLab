/* Shared animations for the Venture Asia sections (home, about, ...):
   reveal-on-scroll, stat count-up, and TradingView market-summary skin. */
(function () {
    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* Reveal-on-scroll: fade/slide items in as they enter the viewport (items already visible stay put) */
    var items = Array.prototype.slice.call(document.querySelectorAll('[data-va-reveal]'));
    if (!reduce && 'IntersectionObserver' in window) {
        var vh = window.innerHeight || document.documentElement.clientHeight;
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) { e.target.classList.add('va-in'); io.unobserve(e.target); }
            });
        }, { rootMargin: '0px 0px 60px 0px' });
        items.forEach(function (el, i) {
            var r = el.getBoundingClientRect();
            if (r.top < vh && r.bottom > 0) return;
            el.classList.add('va-armed');
            el.style.transitionDelay = Math.min((i % 6) * 0.06, 0.4) + 's';
            io.observe(el);
        });
    }

    /* Stat counters: ease-out count-up over 1.5s once half visible */
    function format(el, value) {
        var d = parseInt(el.dataset.vaDecimals || '0', 10);
        return (el.dataset.vaPrefix || '') + value.toLocaleString('en-US', {
            minimumFractionDigits: d, maximumFractionDigits: d,
            useGrouping: el.dataset.vaGrouping !== 'false'
        }) + (el.dataset.vaSuffix || '');
    }
    var stats = Array.prototype.slice.call(document.querySelectorAll('[data-va-count]'));
    if (!reduce && 'IntersectionObserver' in window) {
        var so = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (!e.isIntersecting) return;
                so.unobserve(e.target);
                var el = e.target, num = el.querySelector('.va-stat__num');
                var target = parseFloat(el.dataset.vaCount), start = null;
                function step(t) {
                    if (!start) start = t;
                    var p = Math.min((t - start) / 1500, 1);
                    num.textContent = format(el, target * (1 - Math.pow(1 - p, 3)));
                    if (p < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            });
        }, { threshold: 0.5 });
        stats.forEach(function (el) {
            el.querySelector('.va-stat__num').textContent = format(el, 0);
            so.observe(el);
        });
    }

    /* Same widget-skin tweaks the reference injects into each market summary's shadow DOM */
    var css = '* { border-color: rgba(140, 178, 224, 0.14) !important;'
        + ' --tv-color-toolbar-button-background-active: rgba(46, 123, 255, 0.12) !important;'
        + ' --tv-color-toolbar-button-background-active-hover: rgba(46, 123, 255, 0.20) !important; }'
        + ' iframe { border: none !important; }'
        + ' .active, .selected, [class*="active"], [class*="selected"], [aria-selected="true"] {'
        + ' background-color: rgba(46, 123, 255, 0.12) !important; color: #EAF2FC !important;'
        + ' border-color: rgba(140, 178, 224, 0.24) !important; }';
    document.querySelectorAll('.va-sector tv-market-summary').forEach(function (w) {
        var tries = 0, t = setInterval(function () {
            if (w.shadowRoot) {
                var s = document.createElement('style');
                s.textContent = css;
                w.shadowRoot.appendChild(s);
                clearInterval(t);
            } else if (++tries > 100) clearInterval(t);
        }, 100);
    });
})();
