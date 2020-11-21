<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class EntryEncryptionProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(static::class, function ($app) {
            return $this->newEncrypter();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Create the encrypter.
     *
     * @return \Illuminate\Encryption\Encrypter
     */
    public function newEncrypter(): Encrypter
    {
        // If we're in a testing environment, use the app key as
        // the key for encrypting/decrypting, so we don't have to
        // worry about setting cookies.
        if ('testing' === App::environment()) {
            $key = $this->parseKey(Config::get('app.key'));

            return new Encrypter($key, Config::get('app.cipher'));
        }

        return new Encrypter($this->getUserKey(), Config::get('app.cipher'));
    }

    /**
     * Parse the encryption key.
     *
     * @param  array  $config
     * @return string
     */
    protected function parseKey(string $key)
    {
        if (Str::startsWith($key, $prefix = 'base64:')) {
            $key = base64_decode(Str::after($key, $prefix));
        }

        return $key;
    }

    /**
     * Get the user key.
     *
     * @return string
     */
    public function getUserKey(): string
    {
        $encryptedUserKey = auth()->user()->encrypted_user_key;

        $passwordKey = request()->cookie('password_key');

        $encrypter = new Encrypter($passwordKey, Config::get('app.cipher'));

        return $encrypter->decrypt($encryptedUserKey);
    }
}
