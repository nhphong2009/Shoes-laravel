<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';
    
    protected $fillable = [
    		'name', 
    	];

    public function productdetails(){
      return $this->hasMany('App\Productdetail');
    }
}
