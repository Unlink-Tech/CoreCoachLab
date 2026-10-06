/* Markets pages: "open an account" step accordion.
   Each step's open/closed markup (copied from the reference site) is stored in
   <template data-va-step-active|inactive="N">; clicking a step swaps them in. */
(function () {
    var root = document.querySelector('[data-va-steps-root]');
    if (!root) return;
    var slots = Array.prototype.slice.call(root.querySelectorAll('[data-va-step]'));
    if (!slots.length) return;

    function tpl(kind, n) {
        return root.querySelector('template[data-va-step-' + kind + '="' + n + '"]');
    }
    function prepare(slot, n) {
        var btn = slot.querySelector('[data-va-step-btn]');
        if (!btn) return;
        btn.setAttribute('role', 'button');
        btn.setAttribute('tabindex', '0');
        btn.setAttribute('aria-expanded', slot.getAttribute('data-open') === '1' ? 'true' : 'false');
    }
    function open(n) {
        slots.forEach(function (slot) {
            var i = slot.getAttribute('data-va-step');
            var t = tpl(i === String(n) ? 'active' : 'inactive', i);
            if (!t) return;
            slot.innerHTML = t.innerHTML;
            slot.setAttribute('data-open', i === String(n) ? '1' : '0');
            prepare(slot, i);
        });
    }
    slots.forEach(function (slot, i) {
        slot.setAttribute('data-open', i === 0 ? '1' : '0');
        prepare(slot, i);
    });
    root.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-va-step-btn]');
        if (btn && root.contains(btn)) open(btn.getAttribute('data-va-step-btn'));
    });
    root.addEventListener('keydown', function (e) {
        if (e.key !== 'Enter' && e.key !== ' ') return;
        var btn = e.target.closest('[data-va-step-btn]');
        if (!btn) return;
        e.preventDefault();
        open(btn.getAttribute('data-va-step-btn'));
        var again = root.querySelector('[data-va-step-btn="' + btn.getAttribute('data-va-step-btn') + '"]');
        if (again) again.focus();
    });
})();
