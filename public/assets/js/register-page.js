/* Registration page (user/register): "Open Live Account".
   Layout follows the reference open-account form: Email / Phone Number tabs, Country, First Name,
   email or phone, Password, Referred by and the confirmations.
   The Individual / Company radio is hidden for now; account_type is always submitted as "individual".
   An optional code step (off for now, see config services.register_verify_code) verifies the contact:
   "Request Code" emails one (route('register.code')), "Send SMS Code" texts one (route('register.sms-code')). The form POSTs to route('register.submit');
   server errors and old input come back via data-init. Countries: countries.js (window.VA_COUNTRIES).
   Requires React 18 (UMD). Styles: markets.css (scoped "vr-" classes). */
(function () {
    var root = document.getElementById('vaRegister');
    if (!root || !window.React || !window.ReactDOM || !window.VA_COUNTRIES) return;
    var React = window.React;
    var h = React.createElement;
    var useState = React.useState, useEffect = React.useEffect, useRef = React.useRef;
    var d = root.dataset;
    // Verification code step on/off (config services.register_verify_code); hidden while off.
    var VERIFY_CODE = d.verifyCode === '1';
    // Phone Number sign-up hidden for now (email only); set true to bring back the Email / Phone Number tabs.
    var PHONE_SIGNUP = false;
    var init = {};
    try { init = JSON.parse(d.init || '{}'); } catch (err) { init = {}; }

    var COUNTRIES = window.VA_COUNTRIES;
    var EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var PASSWORD_RE = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,15}$/;
    var PASSWORD_MSG = 'Password must be 8-15 characters, including uppercase letters, lowercase letters, numbers, and special characters.';

    function byName(name) { return COUNTRIES.find(function (c) { return c.name === name; }) || null; }
    function byCode(code) { return COUNTRIES.find(function (c) { return c.code === code; }) || null; }

    function post(url, data) {
        return fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': d.token },
            credentials: 'same-origin',
            body: JSON.stringify(data)
        }).then(function (res) {
            return res.json().catch(function () { return {}; }).then(function (body) {
                return { ok: res.ok && body.ok, field: body.field, message: body.message };
            });
        }).catch(function () {
            return { ok: false, field: 'verificationCode', message: 'Network error. Please try again.' };
        });
    }

    // Real submit: post the form to the Laravel registration route.
    function submitForm(fields) {
        var f = document.createElement('form');
        f.method = 'POST';
        f.action = d.action;
        f.style.display = 'none';
        fields._token = d.token;
        Object.keys(fields).forEach(function (k) {
            var i = document.createElement('input');
            i.type = 'hidden'; i.name = k; i.value = fields[k] == null ? '' : fields[k];
            f.appendChild(i);
        });
        document.body.appendChild(f);
        f.submit();
    }

    var chevron = h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', strokeWidth: '2.5' }, h('path', { d: 'M6 9l6 6 6-6' }));
    var check = h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', strokeWidth: '2.5' },
        h('path', { d: 'M22 11.08V12a10 10 0 11-5.93-9.14' }), h('path', { d: 'M22 4L12 14.01l-3-3' }));

    /* Searchable country picker; "showCode" shows the dialling code on the button (phone field). */
    function CountryPicker(props) {
        var _o = useState(false), open = _o[0], setOpen = _o[1];
        var _q = useState(''), query = _q[0], setQuery = _q[1];
        var ref = useRef(null);
        useEffect(function () {
            function onDown(e) { if (ref.current && !ref.current.contains(e.target)) setOpen(false); }
            document.addEventListener('mousedown', onDown);
            return function () { document.removeEventListener('mousedown', onDown); };
        }, []);
        var q = query.toLowerCase();
        var list = COUNTRIES.filter(function (c) { return c.name.toLowerCase().indexOf(q) !== -1 || c.code.indexOf(query) !== -1; });
        var value = props.value;

        return h('div', { className: 'vr-login-code-selector', ref: ref, style: props.showCode ? null : { width: '100%' } },
            h('button', {
                type: 'button', id: props.id, disabled: props.disabled,
                className: 'vr-login-code-trigger' + (props.error ? ' vr-error' : ''),
                style: props.showCode ? null : { height: '48px', padding: '0 20px' },
                onClick: function () { setOpen(!open); },
                'aria-haspopup': 'listbox', 'aria-expanded': open
            },
                h('span', { className: value ? null : 'vr-auth-placeholder' },
                    value ? (value.flag + ' ' + (props.showCode ? value.code : value.name)) : props.placeholder),
                chevron),
            open && h('div', { className: 'vr-login-code-dropdown', style: props.showCode ? { width: '280px' } : { width: '100%' } },
                h('div', { className: 'vr-login-code-search' },
                    h('input', { type: 'text', placeholder: 'Search country...', value: query, autoFocus: true,
                        onChange: function (e) { setQuery(e.target.value); } })),
                h('div', { className: 'vr-login-code-options', role: 'listbox' },
                    list.length ? list.map(function (c) {
                        var selected = value && value.iso === c.iso;
                        return h('button', {
                            key: c.iso, type: 'button', role: 'option', 'aria-selected': selected,
                            className: 'vr-login-code-option' + (selected ? ' vr-selected' : ''),
                            onClick: function () { props.onChange(c); setOpen(false); setQuery(''); }
                        },
                            h('span', null, c.flag),
                            h('span', { style: { flex: 1, whiteSpace: 'nowrap', overflow: 'hidden', textOverflow: 'ellipsis' } }, c.name),
                            h('span', { style: { color: 'var(--muted)', fontSize: '12px' } }, c.code));
                    }) : h('div', { style: { padding: '12px', fontSize: '13px', color: 'var(--muted)', textAlign: 'center' } }, 'No results found'))));
    }

    function Field(props) {
        return h('div', { className: 'vr-login-field' },
            props.label && h('label', { htmlFor: props.htmlFor }, props.label, props.required && h('span', { className: 'vr-auth-req' }, '*')),
            props.children,
            props.error && h('div', { className: 'vr-login-error-msg' }, props.error));
    }

    function Register() {
        var initCountry = byName(init.country);
        var _m = useState(PHONE_SIGNUP && init.method === 'phone' ? 'phone' : 'email'), method = _m[0], setMethod = _m[1];
        var _c = useState(initCountry), country = _c[0], setCountry = _c[1];
        // Several countries share a code (e.g. +1), so prefer the chosen country when its code matches.
        var initDial = initCountry && initCountry.code === init.phoneCode ? initCountry
            : byCode(init.phoneCode) || initCountry || byName('India');
        var _dc = useState(initDial), dial = _dc[0], setDial = _dc[1];
        var _dt = useState(!!init.phoneCode), dialTouched = _dt[0], setDialTouched = _dt[1];
        var _f = useState(init.firstName || ''), firstName = _f[0], setFirstName = _f[1];
        var _e = useState(init.email || ''), email = _e[0], setEmail = _e[1];
        var _p = useState(init.phone || ''), phone = _p[0], setPhone = _p[1];
        var _v = useState(''), code = _v[0], setCode = _v[1];
        var _pw = useState(''), password = _pw[0], setPassword = _pw[1];
        var _sp = useState(false), showPw = _sp[0], setShowPw = _sp[1];
        var _r = useState(init.referredBy || ''), referredBy = _r[0], setReferredBy = _r[1];
        var accountType = 'individual';
        var _u = useState(!!init.notUs), notUs = _u[0], setNotUs = _u[1];
        var _t = useState(!!init.agree), agree = _t[0], setAgree = _t[1];
        var _mk = useState(!!init.marketing), marketing = _mk[0], setMarketing = _mk[1];
        var _er = useState(init.errors || {}), errors = _er[0], setErrors = _er[1];
        var _s = useState(false), submitting = _s[0], setSubmitting = _s[1];
        var _cs = useState(!!init.codeSent), codeSent = _cs[0], setCodeSent = _cs[1];
        var _cd = useState(0), countdown = _cd[0], setCountdown = _cd[1];
        var _sd = useState(false), sending = _sd[0], setSending = _sd[1];

        useEffect(function () {
            if (countdown <= 0) return;
            var t = setTimeout(function () { setCountdown(countdown - 1); }, 1000);
            return function () { clearTimeout(t); };
        }, [countdown]);

        function clearError(key) {
            if (errors[key]) setErrors(function (prev) { var n = Object.assign({}, prev); delete n[key]; return n; });
        }
        function setError(key, msg) {
            setErrors(function (prev) { var n = Object.assign({}, prev); n[key] = msg; return n; });
        }
        function switchMethod(next) {
            if (next === method) return;
            setMethod(next);
            setCode('');
            setCodeSent(false);
            setCountdown(0);
            setErrors({});
        }
        function pickCountry(c) {
            setCountry(c);
            clearError('country');
            if (!dialTouched) setDial(c); // dialling code follows the country until changed by hand
        }

        function requestCode() {
            if (method === 'email') {
                if (!email.trim()) return setError('email', 'Email address is required to request code');
                if (!EMAIL_RE.test(email.trim())) return setError('email', 'Please enter a valid email address');
            } else if (phone.replace(/\D/g, '').length < 5) {
                return setError('phone', 'Please enter a valid phone number');
            }
            setSending(true);
            var req = method === 'email'
                ? post(d.codeUrl, { email: email.trim() })
                : post(d.smsCodeUrl, { phone_code: dial.code, phone: phone });
            req.then(function (r) {
                setSending(false);
                if (r.ok) { setCodeSent(true); setCountdown(60); clearError('verificationCode'); }
                else setError(r.field || (method === 'email' ? 'email' : 'phone'), r.message || 'Could not send the code. Please try again.');
            });
        }

        function validate() {
            var e = {};
            if (!country) e.country = 'Please select your country';
            if (!firstName.trim()) e.firstName = 'First name is required';
            if (method === 'email') {
                if (!email.trim()) e.email = 'Email address is required';
                else if (!EMAIL_RE.test(email.trim())) e.email = 'Please enter a valid email address';
            } else if (!phone.trim()) e.phone = 'Phone number is required';
            else if (phone.replace(/\D/g, '').length < 5) e.phone = 'Please enter a valid phone number';
            if (!VERIFY_CODE) { /* no code step */ }
            else if (!code.trim()) e.verificationCode = method === 'email' ? 'Please enter a valid email verification code' : 'Please enter the SMS verification code';
            else if (!/^\d{4,8}$/.test(code.trim())) e.verificationCode = 'Verification code must be numeric (4-8 digits)';
            else if (!codeSent) e.verificationCode = 'Please request a verification code first';
            if (!password) e.password = 'Password is required';
            else if (!PASSWORD_RE.test(password)) e.password = PASSWORD_MSG;
            if (!notUs) e.notUsResident = 'Please tick the checkbox to proceed';
            if (!agree) e.agreeTerms = 'You must agree to the terms of the registration agreement to proceed';
            setErrors(e);
            return Object.keys(e).length === 0;
        }

        function onSubmit(ev) {
            ev.preventDefault();
            if (!validate()) return;
            setSubmitting(true);
            submitForm({
                register_method: method, country: country.name, first_name: firstName.trim(),
                email: method === 'email' ? email.trim() : '', phone_code: method === 'phone' ? dial.code : '',
                phone: method === 'phone' ? phone : '', verification_code: code.trim(), password: password,
                referred_by: referredBy, account_type: accountType,
                not_us_resident: notUs ? '1' : '', agree_terms: agree ? '1' : '', marketing_consent: marketing ? '1' : ''
            });
        }

        function input(id, type, value, set, errKey, extra) {
            return h('div', { className: 'vr-login-input-wrap', style: extra && extra.wrapStyle },
                h('input', Object.assign({
                    id: id, type: type, value: value, disabled: submitting,
                    className: 'vr-login-input' + (errors[errKey] ? ' vr-error' : ''),
                    onChange: function (e) { set(e.target.value); clearError(errKey); }
                }, extra && extra.attrs)),
                extra && extra.after);
        }

        function checkbox(checked, set, errKey, children) {
            return h('div', { style: { display: 'flex', flexDirection: 'column', gap: '4px' } },
                h('label', { className: 'vr-auth-check' },
                    h('input', { type: 'checkbox', checked: checked, disabled: submitting,
                        onChange: function (e) { set(e.target.checked); if (errKey) clearError(errKey); } }),
                    h('span', null, children)),
                errKey && errors[errKey] && h('div', { className: 'vr-login-error-msg' }, errors[errKey]));
        }

        var legalLink = function (hash, text) {
            return h('a', { href: d.legal + '#' + hash, target: '_blank', rel: 'noopener' }, text);
        };
        var codeLabel = method === 'email' ? 'Email Verification Code' : 'SMS Verification Code';
        var codeButton = countdown > 0 ? 'Resend in ' + countdown + 's'
            : sending ? 'Sending...'
            : method === 'email' ? 'Request Code' : 'Send SMS Code';

        var form = h('form', { id: 'register-form', className: 'vr-login-form', onSubmit: onSubmit, noValidate: true, style: { gap: '16px' } },
            PHONE_SIGNUP && h('div', { className: 'vr-login-tabs', style: { marginBottom: '4px' }, role: 'tablist' },
                h('button', { type: 'button', role: 'tab', 'aria-selected': method === 'email', className: 'vr-login-tab' + (method === 'email' ? ' vr-active' : ''), onClick: function () { switchMethod('email'); }, disabled: submitting }, 'Email'),
                h('button', { type: 'button', role: 'tab', 'aria-selected': method === 'phone', className: 'vr-login-tab' + (method === 'phone' ? ' vr-active' : ''), onClick: function () { switchMethod('phone'); }, disabled: submitting }, 'Phone Number')),

            h(Field, { label: 'Country', required: true, htmlFor: 'country', error: errors.country },
                h(CountryPicker, { id: 'country', value: country, onChange: pickCountry, placeholder: 'Select your country', error: errors.country, disabled: submitting })),

            h(Field, { label: 'First Name', required: true, htmlFor: 'firstName', error: errors.firstName },
                input('firstName', 'text', firstName, setFirstName, 'firstName', { attrs: { autoComplete: 'given-name', placeholder: 'Please Enter', maxLength: 100 } })),

            method === 'email'
                ? h(Field, { label: 'Email', required: true, htmlFor: 'email', error: errors.email },
                    input('email', 'email', email, function (v) { setEmail(v); setCodeSent(false); }, 'email', { attrs: { autoComplete: 'email', placeholder: 'Please Enter' } }))
                : h(Field, { label: 'Phone Number', required: true, htmlFor: 'phone', error: errors.phone },
                    h('div', { className: 'vr-login-phone-row' },
                        h(CountryPicker, { value: dial, showCode: true, error: errors.phone, disabled: submitting,
                            onChange: function (c) { setDial(c); setDialTouched(true); setCodeSent(false); clearError('phone'); } }),
                        input('phone', 'tel', phone, function (v) { setPhone(v); setCodeSent(false); }, 'phone', { wrapStyle: { flex: 1 }, attrs: { autoComplete: 'tel-national', inputMode: 'tel', placeholder: 'Phone Number' } }))),

            VERIFY_CODE && h(Field, { label: codeLabel, required: true, htmlFor: 'verificationCode', error: errors.verificationCode },
                h('div', { className: 'vr-login-phone-row' },
                    input('verificationCode', 'text', code, setCode, 'verificationCode', { wrapStyle: { flex: 1 }, attrs: { inputMode: 'numeric', autoComplete: 'one-time-code', maxLength: 8,
                        placeholder: method === 'email' ? 'Enter the code sent to your email' : 'SMS code expires in 5 minutes' } }),
                    h('button', { type: 'button', className: 'vr-btn vr-btn--ghost', style: { borderRadius: '999px', padding: '0 20px', fontSize: '13.5px', height: '48px', minWidth: '132px' },
                        onClick: requestCode, disabled: countdown > 0 || sending || submitting }, codeButton))),

            h(Field, { label: 'Password', required: true, htmlFor: 'password', error: errors.password },
                input('password', showPw ? 'text' : 'password', password, setPassword, 'password', {
                    attrs: { autoComplete: 'new-password', placeholder: 'Please Enter' },
                    after: h('button', { type: 'button', className: 'vr-login-password-toggle', onClick: function () { setShowPw(!showPw); }, 'aria-label': showPw ? 'Hide password' : 'Show password' },
                        showPw
                            ? h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', strokeWidth: '2' },
                                h('path', { d: 'M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24' }),
                                h('line', { x1: '1', y1: '1', x2: '23', y2: '23' }))
                            : h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', strokeWidth: '2' },
                                h('path', { d: 'M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z' }), h('circle', { cx: '12', cy: '12', r: '3' })))
                })),

            h(Field, { label: 'Referred by (optional)', htmlFor: 'referredBy' },
                input('referredBy', 'text', referredBy, setReferredBy, 'referredBy', { attrs: { placeholder: 'Partner referral code', maxLength: 50 } })),

            checkbox(notUs, setNotUs, 'notUsResident', 'I confirm that I am not a U.S. person, including a U.S. citizen or resident.'),
            checkbox(agree, setAgree, 'agreeTerms', ['I have read, understood, and agree to the ',
                legalLink('agreement', 'Client Services Agreement'), ', ', legalLink('risk', 'Risk Disclosure'), ' and ', legalLink('privacy', 'Privacy Policy'), '.']),
            checkbox(marketing, setMarketing, null, ['I agree to Venture Asia using my data for product/service information, offers, events, and application support. You can unsubscribe anytime. For details, see our ',
                legalLink('privacy', 'Privacy Policy'), '.'])
        );

        return h('div', { className: 'vr-login-page' },
            h('div', { className: 'vr-login-form-side', style: { maxWidth: '620px' } },
                h('div', { className: 'vr-login-form-header' },
                    h('div', { className: 'vr-login-header-top', style: { marginBottom: '24px' } },
                        h('a', { href: d.home }, h('img', { src: d.logo, alt: 'Venture Asia logo', className: 'vr-login-logo' })),
                        h('a', { href: d.home, className: 'vr-login-back-home' },
                            h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', strokeWidth: '2.5', style: { width: '16px', height: '16px' } }, h('path', { d: 'M19 12H5M12 19l-7-7 7-7' })),
                            'Back to Home')),
                    h('div', { className: 'vr-login-header', style: { marginBottom: '20px' } },
                        h('h1', null, 'Open Live Account'),
                        h('p', null, 'Configure your account profile to launch live platform trading.'))),
                h('div', { className: 'vr-login-form-scrollable' }, form),
                h('div', { className: 'vr-login-form-footer' },
                    h('button', { type: 'submit', form: 'register-form', className: 'vr-btn vr-btn--primary', style: { width: '100%', padding: '15px' }, disabled: submitting },
                        submitting ? 'Creating Account...' : 'Create Account'),
                    h('div', { className: 'vr-auth-links vr-auth-links--center' },
                        h('a', { href: d.demo }, 'Practice Trading'),
                        h('a', { href: d.login }, 'Login')))),
            h('div', { className: 'vr-login-brand-side' },
                h('div', { className: 'vr-login-brand-content' },
                    h('div', { className: 'vr-login-brand-badge' }, 'Institutional Conditions'),
                    h('h2', null, 'Your Premium Gateway to Global Markets'),
                    h('p', null, 'Trade over 600+ instruments with raw spreads, high execution speeds, and a secure trading platform tailored for performance.'),
                    h('div', { className: 'vr-login-features' },
                        ['Segregated client funds in tier-1 bank custody',
                         'Ultra-low latency execution via global Equinix servers',
                         'Dynamic, cross-platform liquidity access under one portal'].map(function (t) {
                            return h('div', { key: t, className: 'vr-login-feat-item' }, check, h('span', null, t));
                        })))));
    }

    window.ReactDOM.createRoot(root).render(h(Register));
})();
