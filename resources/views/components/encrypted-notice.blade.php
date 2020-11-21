@if(Cookie::get('password_key'))
    <div class="EncryptedNotice EncryptedNotice--encrypted button">
        <x-app-icon use="lock" />
        <span>Encrypted</span>
    </div>
@else
    <div class="EncryptedNotice EncryptedNotice--unencrypted button">
        <x-app-icon use="unlock" />
        <span>Unencrypted</span>
    </div>
@endif
