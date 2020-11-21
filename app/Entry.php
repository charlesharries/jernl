<?php

namespace App;

use ErrorException;
use App\Traits\EncryptsFields;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entry extends Model
{
    use HasFactory, EncryptsFields;

    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
    ];

    /**
     * Relationship with the author of the Entry.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function getIsEncryptedAttribute()
    {
        // TODO(charles): Consider using $this->title->getRawOriginal()
        [$entry] = DB::select('select title, content from entries where id = ?', [$this->id]);
        try {
            $this->encrypter()->decrypt($entry->title);
            $this->encrypter()->decrypt($entry->content);

            return true;
        } catch (DecryptException $e) {
            return false;
        }
    }

    public function getTitleAttribute($value)
    {
        try {
            return $this->encrypter()->decrypt($value);
        } catch (DecryptException $e) {
            return $value;
        }
    }

    public function getContentAttribute($value)
    {
        try {
            return $this->encrypter()->decrypt($value);
        } catch (DecryptException $e) {
            return $value;
        }
    }

    public function setTitleAttribute($value)
    {
        return $this->attributes['title'] = $this->encrypter()->encrypt($value);
    }

    public function setContentAttribute($value)
    {
        return $this->attributes['content'] = $this->encrypter()->encrypt($value);
    }
}
