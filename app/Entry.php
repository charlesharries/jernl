<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    public function author()
    {
        return $this->belongsTo('App\User');
    }
}
