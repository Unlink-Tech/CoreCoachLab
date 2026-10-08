/* Forgot password pages: dialling-code options, "Send SMS Code" (with a 60s resend countdown)
   and show/hide toggles for the new-password fields. */
(function () {
    // Show / hide password
    document.querySelectorAll('[data-va-toggle]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var input = document.getElementById(btn.getAttribute('data-va-toggle'));
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
        });
    });

    var form = document.getElementById('vaResetMobile');
    if (!form) return;

    // Dialling codes ("+60 Malaysia"), keeping the previously chosen one selected.
    var dial = form.querySelector('[data-va-dial]');
    if (dial && window.VA_COUNTRIES) {
        var selected = dial.getAttribute('data-selected') || dial.value;
        dial.innerHTML = '';
        window.VA_COUNTRIES.forEach(function (c) {
            var opt = document.createElement('option');
            opt.value = c.code;
            opt.setAttribute('data-long', c.flag + ' ' + c.code + '  ' + c.name);
            opt.setAttribute('data-short', c.flag + ' ' + c.code);
            opt.setAttribute('data-iso', c.iso);
            dial.appendChild(opt);
        });
        var match = Array.prototype.find.call(dial.options, function (o) { return o.value === selected; });
        (match || dial.querySelector('[data-iso="IN"]') || dial.options[0]).selected = true;

        // The closed box only fits "flag +code"; the open list shows country names too.
        var expand = function () {
            Array.prototype.forEach.call(dial.options, function (o) { o.textContent = o.getAttribute('data-long'); });
        };
        var compact = function () {
            expand();
            var o = dial.options[dial.selectedIndex];
            if (o) o.textContent = o.getAttribute('data-short');
        };
        dial.addEventListener('mousedown', expand);
        dial.addEventListener('focus', expand);
        dial.addEventListener('change', compact);
        dial.addEventListener('blur', compact);
        compact();
    }

    function showError(field, message) {
        var el = form.querySelector('[data-va-error="' + field + '"]');
        var input = form.querySelector('[name="' + field + '"]');
        if (el) { el.textContent = message || ''; el.hidden = !message; }
        if (input) input.classList.toggle('vr-error', !!message);
    }
    form.querySelector('[name="phone"]').addEventListener('input', function () { showError('phone', ''); });
    form.querySelector('[name="code"]').addEventListener('input', function () { showError('code', ''); });

    var sendBtn = form.querySelector('[data-va-send]');
    var sentNote = form.querySelector('[data-va-sent]');
    var timer = null;

    function countdown(seconds) {
        clearInterval(timer);
        sendBtn.disabled = true;
        sendBtn.textContent = 'Resend in ' + seconds + 's';
        timer = setInterval(function () {
            seconds -= 1;
            if (seconds <= 0) {
                clearInterval(timer);
                sendBtn.disabled = false;
                sendBtn.textContent = 'Send SMS Code';
            } else {
                sendBtn.textContent = 'Resend in ' + seconds + 's';
            }
        }, 1000);
    }

    sendBtn.addEventListener('click', function () {
        var phone = form.querySelector('[name="phone"]').value.trim();
        showError('phone', '');
        showError('code', '');
        if (!/\d{5,}/.test(phone.replace(/\D/g, ''))) {
            showError('phone', 'Please enter a valid phone number');
            return;
        }
        sendBtn.disabled = true;
        sendBtn.textContent = 'Sending...';
        fetch(form.getAttribute('data-code-url'), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value
            },
            credentials: 'same-origin',
            body: JSON.stringify({ phone_code: dial.value, phone: phone })
        }).then(function (res) {
            return res.json().catch(function () { return {}; }).then(function (body) {
                if (res.ok && body.ok) {
                    sentNote.hidden = false;
                    countdown(60);
                    form.querySelector('[name="code"]').focus();
                } else {
                    showError(body.field || 'phone', body.message || 'Could not send the code. Please try again.');
                    sendBtn.disabled = false;
                    sendBtn.textContent = 'Send SMS Code';
                }
            });
        }).catch(function () {
            showError('code', 'Network error. Please try again.');
            sendBtn.disabled = false;
            sendBtn.textContent = 'Send SMS Code';
        });
    });

    form.addEventListener('submit', function (e) {
        var ok = true;
        if (!form.querySelector('[name="phone"]').value.trim()) { showError('phone', 'Phone number is required'); ok = false; }
        if (!form.querySelector('[name="code"]').value.trim()) { showError('code', 'SMS code is required'); ok = false; }
        if (!ok) e.preventDefault();
    });
})();
