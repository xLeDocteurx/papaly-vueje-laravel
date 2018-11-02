<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCatRelation extends Model
{
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    public function sub_category()
    {
        return $this->belongsTo('App\Category');
    }
}
