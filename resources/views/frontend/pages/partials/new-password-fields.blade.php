{{-- New password + confirmation, with show/hide toggles (public/assets/js/forgot-password.js). --}}
@foreach ([
    ['name' => 'password', 'label' => 'New Password', 'autocomplete' => 'new-password'],
    ['name' => 'password_confirmation', 'label' => 'Confirm New Password', 'autocomplete' => 'new-password'],
] as $field)
    <div class="vr-login-field">
        <label for="{{ $field['name'] }}">{{ $field['label'] }}<span class="vr-auth-req">*</span></label>
        <div class="vr-login-input-wrap">
            <input id="{{ $field['name'] }}" type="password" name="{{ $field['name'] }}" placeholder="Please Enter"
                autocomplete="{{ $field['autocomplete'] }}" required
                class="vr-login-input @error('password') vr-error @enderror">
            <button type="button" class="vr-login-password-toggle" data-va-toggle="{{ $field['name'] }}" aria-label="Show password">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
        </div>
        @if ($loop->first)
            @error('password')<div class="vr-login-error-msg">{{ $message }}</div>@enderror
        @endif
    </div>
@endforeach
<p class="vr-auth-hint" style="margin:-8px 0 0">8-15 characters, including uppercase and lowercase letters, numbers and special characters.</p>
