<?php

namespace App\Traits;

use App\Providers\EntryEncryptionProvider;

trait EncryptsFields {
    protected function encrypter()
    {
        return resolve(EntryEncryptionProvider::class);
    }
}
