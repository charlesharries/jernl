<?php

namespace App;

use App\Entry;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'encrypted_user_key',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function generateEncryptedUserKey(string $password)
    {
        
        $userKey = \Str::random(32);

        $passwordKey = self::generatePasswordKey($password);

        $encrypter = new \Illuminate\Encryption\Encrypter(
            $passwordKey, \Config::get('app.cipher')
        );

        return $encrypter->encrypt($userKey);
    }

    public static function generatePasswordKey(string $password) {
        $appKey = \Illuminate\Support\Facades\Crypt::getKey();

        return hash_pbkdf2( "sha256", $password, $appKey, 200000, 32);
    }

    public function entries()
    {
        return $this->hasMany('App\Entry');
    }

    public function entriesOn($day)
    {
        return Entry::where(['user_id' => auth()->id()])
            ->whereDate('date', '=', $day)
            ->get();
    }

    public function allEntryDates($year) {
        return Entry::where(['user_id' => auth()->id()])
            ->whereYear('date', '=', $year)
            ->pluck('date')
            ->map(function($date) { return $date->format('Y-m-d'); })
            ->toArray();
    }
}
