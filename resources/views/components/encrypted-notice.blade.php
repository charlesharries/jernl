@if(Session::has('password_key'))
    <div class="EncryptedNotice EncryptedNotice--encrypted">
        <app-icon use="lock" />
        <span>Encrypted</span>
    </div>
@else
    <div class="EncryptedNotice EncryptedNotice--unencrypted">
        <app-icon use="unlock" />
        <span>Unencrypted</span>
    </div>
@endif