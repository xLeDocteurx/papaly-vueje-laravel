<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public function boards()
	{
		return $this->belongsTo('App\Board');
	}

    public function links()
    {
    	return $this->hasMany('App\Link');
    }
    
    public function sub_cat()
    {
    	return $this->hasMany('App\SubCatRelation');
    }
}
