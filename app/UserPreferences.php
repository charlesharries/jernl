<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPreferences extends Model
{
    protected $fillable = ['user_id', 'use_serif'];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User');
    }
}
