/* Login page (user/login).
   The login component (Dm) and country list (Io) are taken from the ventureasiamarkets.com
   bundle so the design and client-side validation match the reference. Patches (marked
   __init / __submit) replace the reference's demo "success" timer with a real POST to
   route('login.submit'), and pre-fill the form + server error after a failed attempt.
   Requires React 18 (UMD). Styles: markets.css (scoped "vr-" classes). */
(function () {
    var root = document.getElementById('vaLogin');
    if (!root || !window.React || !window.ReactDOM) return;
    var React = window.React;
    var d = root.dataset;
    var __init = {};
    // Mobile Number login hidden for now (email only); set true to bring back the Email Address / Mobile Number tabs.
    var __phoneLogin = false;
    try { __init = JSON.parse(d.init || '{}'); } catch (err) { __init = {}; }

    function u(props) { return props; } // router <Link> stand-in
    var hrefFor = { '/': d.home, '/forgot-password': d.forgot, '/under-construction': d.register };

    function prefix(cls) {
        return String(cls).split(/\s+/).filter(function (c) { return c && c !== 'reveal'; })
            .map(function (c) { return c.indexOf('tradingview') === 0 ? c : 'vr-' + c; }).join(' ');
    }
    function adapt(type, props, key) {
        var p = Object.assign({}, props);
        if (p.className) p.className = prefix(p.className);
        if (key !== undefined) p.key = key;
        if (type === u) {
            type = 'a';
            p.href = hrefFor[p.to] || '#';
            delete p.to;
        }
        return React.createElement(type, p);
    }
    var e = { jsx: adapt, jsxs: adapt, Fragment: React.Fragment };
    var m = React;
    var Fs = d.logo;

    // Real submit: post to the Laravel login route (CSRF token from the page).
    function __submit(v) {
        var f = document.createElement('form');
        f.method = 'POST';
        f.action = d.action;
        f.style.display = 'none';
        var fields = { _token: d.token, login_method: v.method, password: v.password };
        if (v.method === 'phone') { fields.phone = v.phone; fields.phone_code = v.code; }
        else { fields.email = v.email; }
        Object.keys(fields).forEach(function (k) {
            var i = document.createElement('input');
            i.type = 'hidden'; i.name = k; i.value = fields[k];
            f.appendChild(i);
        });
        document.body.appendChild(f);
        f.submit();
    }

    var Io = [{code:"+1",name:"United States",flag:"🇺🇸"},{code:"+91",name:"India",flag:"🇮🇳"},{code:"+44",name:"United Kingdom",flag:"🇬🇧"},{code:"+61",name:"Australia",flag:"🇦🇺"},{code:"+1",name:"Canada",flag:"🇨🇦"},{code:"+49",name:"Germany",flag:"🇩🇪"},{code:"+65",name:"Singapore",flag:"🇸🇬"},{code:"+971",name:"United Arab Emirates",flag:"🇦🇪"},{code:"+60",name:"Malaysia",flag:"🇲🇾"},{code:"+852",name:"Hong Kong",flag:"🇭🇰"},{code:"+81",name:"Japan",flag:"🇯🇵"},{code:"+64",name:"New Zealand",flag:"🇳🇿"},{code:"+33",name:"France",flag:"🇫🇷"},{code:"+39",name:"Italy",flag:"🇮🇹"},{code:"+34",name:"Spain",flag:"🇪🇸"},{code:"+41",name:"Switzerland",flag:"🇨🇭"}];

    var Dm = ()=>{const[t,s]=m.useState(__phoneLogin&&__init.method||"email"),[n,i]=m.useState(__init.email||""),[r,a]=m.useState(__init.phone||""),[l,o]=m.useState(Io[0]),[c,d]=m.useState(""),[f,x]=m.useState(!1),[y,j]=m.useState(!1),[w,k]=m.useState(""),[b,h]=m.useState(__init.errors||{}),[p,g]=m.useState(!1),[v,C]=m.useState(!1),z=m.useRef(null);m.useEffect(()=>{const W=R=>{z.current&&!z.current.contains(R.target)&&j(!1)};return document.addEventListener("mousedown",W),()=>{document.removeEventListener("mousedown",W)}},[]);const F=W=>{s(W),h({}),C(!1)},T=Io.filter(W=>W.name.toLowerCase().includes(w.toLowerCase())||W.code.includes(w)),L=()=>{const W={};return t==="email"?n.trim()?/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(n)||(W.email="Please enter a valid email address"):W.email="Email address is required":r.trim()?/^\d{6,15}$/.test(r.replace(/[\s-()]/g,""))||(W.phone="Please enter a valid phone number (6 to 15 digits)"):W.phone="Phone number is required",c?c.length<6&&(W.password="Password must be at least 6 characters"):W.password="Password is required",h(W),Object.keys(W).length===0},B=W=>{W.preventDefault(),L()&&(g(!0),__submit({method:t,email:n,phone:r,code:l.code,password:c}))};return e.jsxs("div",{className:"login-page",children:[e.jsxs("div",{className:"login-form-side",children:[e.jsxs("div",{className:"login-form-header",children:[e.jsxs("div",{className:"login-header-top",children:[e.jsx(u,{to:"/",children:e.jsx("img",{src:Fs,alt:"Venture Asia logo",className:"login-logo"})}),e.jsxs(u,{to:"/",className:"login-back-home",children:[e.jsx("svg",{viewBox:"0 0 24 24",fill:"none",stroke:"currentColor",strokeWidth:"2.5",style:{width:"16px",height:"16px"},children:e.jsx("path",{d:"M19 12H5M12 19l-7-7 7-7"})}),"Back to Home"]})]}),e.jsxs("div",{className:"login-header",children:[e.jsx("h1",{children:"Secure Portal Login"}),e.jsx("p",{children:"Access your accounts, analytics, and platform controls."})]})]}),v&&e.jsxs("div",{className:"reveal",style:{background:"rgba(46, 255, 123, 0.1)",border:"1px solid rgba(46, 255, 123, 0.3)",borderRadius:"12px",padding:"16px",marginBottom:"24px",color:"#2eff7b",fontSize:"14.5px",display:"flex",alignItems:"center",gap:"10px"},children:[e.jsxs("svg",{viewBox:"0 0 24 24",fill:"none",stroke:"currentColor",strokeWidth:"2.5",style:{width:"20px",height:"20px",flexShrink:0},children:[e.jsx("path",{d:"M22 11.08V12a10 10 0 11-5.93-9.14"}),e.jsx("path",{d:"M22 4L12 14.01l-3-3"})]}),e.jsx("span",{children:"Verification code sent successfully. Redirecting portal..."})]}),!v&&e.jsxs(e.Fragment,{children:[e.jsxs("div",{className:"login-form-scrollable",children:[__phoneLogin&&e.jsxs("div",{className:"login-tabs",children:[e.jsx("button",{type:"button",className:`login-tab ${t==="email"?"active":""}`,onClick:()=>F("email"),children:"Email Address"}),e.jsx("button",{type:"button",className:`login-tab ${t==="phone"?"active":""}`,onClick:()=>F("phone"),children:"Mobile Number"})]}),e.jsxs("form",{id:"login-form",className:"login-form",onSubmit:B,children:[t==="email"?e.jsxs("div",{className:"login-field",children:[e.jsx("label",{htmlFor:"email",children:"Email Address"}),e.jsx("div",{className:"login-input-wrap",children:e.jsx("input",{id:"email",type:"text",placeholder:"Enter registered email",value:n,onChange:W=>{i(W.target.value),b.email&&h(R=>({...R,email:""}))},className:`login-input ${b.email?"error":""}`,disabled:p})}),b.email&&e.jsx("div",{className:"login-error-msg",children:b.email})]}):e.jsxs("div",{className:"login-field",children:[e.jsx("label",{htmlFor:"phone",children:"Mobile Number"}),e.jsxs("div",{className:"login-phone-row",children:[e.jsxs("div",{className:"login-code-selector",ref:z,children:[e.jsxs("button",{type:"button",className:`login-code-trigger ${b.phone?"error":""}`,onClick:()=>j(!y),disabled:p,children:[e.jsxs("span",{children:[l.flag," ",l.code]}),e.jsx("svg",{viewBox:"0 0 24 24",fill:"none",stroke:"currentColor",strokeWidth:"2.5",children:e.jsx("path",{d:"M6 9l6 6 6-6"})})]}),y&&e.jsxs("div",{className:"login-code-dropdown",children:[e.jsx("div",{className:"login-code-search",children:e.jsx("input",{type:"text",placeholder:"Search countries...",value:w,onChange:W=>k(W.target.value),autoFocus:!0})}),e.jsx("div",{className:"login-code-options",children:T.length>0?T.map((W,R)=>e.jsxs("button",{type:"button",className:`login-code-option ${l.code===W.code&&l.name===W.name?"selected":""}`,onClick:()=>{o(W),j(!1),k("")},children:[e.jsx("span",{children:W.flag}),e.jsx("span",{style:{flex:1,whiteSpace:"nowrap",overflow:"hidden",textOverflow:"ellipsis"},children:W.name}),e.jsx("span",{style:{color:"var(--muted)",fontSize:"12px"},children:W.code})]},R)):e.jsx("div",{style:{padding:"12px",fontSize:"13px",color:"var(--muted)",textAlign:"center"},children:"No country found"})})]})]}),e.jsx("div",{className:"login-input-wrap",style:{flex:1},children:e.jsx("input",{id:"phone",type:"text",placeholder:"Enter phone number",value:r,onChange:W=>{a(W.target.value),b.phone&&h(R=>({...R,phone:""}))},className:`login-input ${b.phone?"error":""}`,disabled:p})})]}),b.phone&&e.jsx("div",{className:"login-error-msg",children:b.phone})]}),e.jsxs("div",{className:"login-field",children:[e.jsx("label",{htmlFor:"password",children:"Password"}),e.jsxs("div",{className:"login-input-wrap",children:[e.jsx("input",{id:"password",type:f?"text":"password",placeholder:"Enter account password",value:c,onChange:W=>{d(W.target.value),b.password&&h(R=>({...R,password:""}))},className:`login-input ${b.password?"error":""}`,disabled:p}),e.jsx("button",{type:"button",className:"login-password-toggle",onClick:()=>x(!f),disabled:p,"aria-label":f?"Hide password":"Show password",children:f?e.jsxs("svg",{viewBox:"0 0 24 24",fill:"none",stroke:"currentColor",strokeWidth:"2",children:[e.jsx("path",{d:"M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"}),e.jsx("line",{x1:"1",y1:"1",x2:"23",y2:"23"})]}):e.jsxs("svg",{viewBox:"0 0 24 24",fill:"none",stroke:"currentColor",strokeWidth:"2",children:[e.jsx("path",{d:"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"}),e.jsx("circle",{cx:"12",cy:"12",r:"3"})]})})]}),b.password&&e.jsx("div",{className:"login-error-msg",children:b.password})]}),e.jsx("div",{className:"login-extra-links",children:e.jsx(u,{to:"/forgot-password",className:"login-forgot",children:"Forgot Password?"})})]})]}),e.jsxs("div",{className:"login-form-footer",children:[e.jsx("button",{type:"submit",form:"login-form",className:"btn btn--primary",style:{width:"100%",padding:"15px"},disabled:p,children:p?e.jsxs("span",{className:"flex ac jc gap-10",children:[e.jsx("svg",{viewBox:"0 0 24 24",stroke:"currentColor",strokeWidth:"3",style:{width:"18px",height:"18px",animation:"spin 1s linear infinite"},children:e.jsx("path",{fill:"none",d:"M12 2v4m0 12v4M4.93 4.93l2.83 2.83m8.48 8.48l2.83 2.83M2 12h4m12 0h4M4.93 19.07l2.83-2.83m8.48-8.48l2.83-2.83"})}),"Processing..."]}):"Log In"}),e.jsxs("div",{className:"login-footer",style:{marginTop:"0",textAlign:"center"},children:["Don't have an account? ",e.jsx(u,{to:"/under-construction",children:"Open Account"})]})]})]})]}),e.jsx("div",{className:"login-brand-side",children:e.jsxs("div",{className:"login-brand-content",children:[e.jsx("div",{className:"login-brand-badge",children:"Institutional Conditions"}),e.jsx("h2",{children:"Your Premium Gateway to Global Markets"}),e.jsx("p",{children:"Trade over 600+ instruments with raw spreads, high execution speeds, and a secure trading platform tailored for performance."}),e.jsxs("div",{className:"login-features",children:[e.jsxs("div",{className:"login-feat-item",children:[e.jsxs("svg",{viewBox:"0 0 24 24",fill:"none",stroke:"currentColor",strokeWidth:"2.5",children:[e.jsx("path",{d:"M22 11.08V12a10 10 0 11-5.93-9.14"}),e.jsx("path",{d:"M22 4L12 14.01l-3-3"})]}),e.jsx("span",{children:"Segregated client funds in tier-1 bank custody"})]}),e.jsxs("div",{className:"login-feat-item",children:[e.jsxs("svg",{viewBox:"0 0 24 24",fill:"none",stroke:"currentColor",strokeWidth:"2.5",children:[e.jsx("path",{d:"M22 11.08V12a10 10 0 11-5.93-9.14"}),e.jsx("path",{d:"M22 4L12 14.01l-3-3"})]}),e.jsx("span",{children:"Ultra-low latency execution via global Equinix servers"})]}),e.jsxs("div",{className:"login-feat-item",children:[e.jsxs("svg",{viewBox:"0 0 24 24",fill:"none",stroke:"currentColor",strokeWidth:"2.5",children:[e.jsx("path",{d:"M22 11.08V12a10 10 0 11-5.93-9.14"}),e.jsx("path",{d:"M22 4L12 14.01l-3-3"})]}),e.jsx("span",{children:"Dynamic, cross-platform liquidity access under one portal"})]})]})]})})]})};

    window.ReactDOM.createRoot(root).render(React.createElement(Dm));
})();
