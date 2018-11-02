<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function favorite() 
    {
        return $this->belongsTo('App\Favorite');
    }

    public function categories()
    {
        return $this->hasMany('App\Category');
    }
}
