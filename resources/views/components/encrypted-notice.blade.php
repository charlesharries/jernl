@if(Session::has('password_key'))
    <div class="EncryptedNotice EncryptedNotice--encrypted">
        <x-app-icon use="lock" />
        <span>Encrypted</span>
    </div>
@else
    <div class="EncryptedNotice EncryptedNotice--unencrypted">
        <x-app-icon use="unlock" />
        <span>Unencrypted</span>
    </div>
@endif