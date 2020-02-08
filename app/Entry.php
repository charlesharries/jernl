<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function author()
    {
        return $this->belongsTo('App\User');
    }
}
