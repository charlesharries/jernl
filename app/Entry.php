<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Encryption\DecryptException;

class Entry extends Model
{
    public $fillable = ['title', 'content', 'user_id', 'date'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    /**
     * The user key to encrypt/decrypt values in the database.
     * 
     * @var string
     */
    protected $userKey = '';

    /**
     * The encrypter for encrypting and decrypting values
     * in the database.
     * 
     * @var \Illuminate\Encryption\Encrypter
     */
    protected $encrypter = '';

    public function __construct()
    {
        $this->initEncrypter();
    }

    public function author()
    {
        return $this->belongsTo('App\User');
    }

    protected function setUserKey() {
        if ($this->userKey && strlen($this->userKey) > 0) return;

        $encryptedUserKey = auth()->user()->encrypted_user_key;
        $passwordKey = request()->session()->get('password_key');
        $encrypter = new \Illuminate\Encryption\Encrypter(
            $passwordKey, \Config::get('app.cipher')
        );

        $this->userKey = $encrypter->decrypt($encryptedUserKey);
    }

    protected function initEncrypter() {
        $this->setUserKey();
        $this->encrypter = new \Illuminate\Encryption\Encrypter(
            $this->userKey, \Config::get('app.cipher')
        );
    }

    public function getIsEncryptedAttribute() {
        [$entry] = \DB::select('select title, content from entries where id = ?', [$this->id]);
        try {
            $this->encrypter->decrypt($entry->title);
            $this->encrypter->decrypt($entry->content);
            return true;
        } catch (DecryptException $e) {
            return false;
        }
    }

    public function getTitleAttribute($value) {
        try {
            return $this->encrypter->decrypt($value);
        } catch (DecryptException $e) {
            return $value;
        }
    }

    public function getContentAttribute($value) {
        try {
            return $this->encrypter->decrypt($value);
        } catch (DecryptException $e) {
            return $value;
        }
    }

    public function setTitleAttribute($value) {
        return $this->attributes['title'] = $this->encrypter->encrypt($value);
    }

    public function setContentAttribute($value) {
        return $this->attributes['content'] = $this->encrypter->encrypt($value);
    }
}
