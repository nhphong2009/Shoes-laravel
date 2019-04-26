<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    protected $table = 'styles';
    
    protected $fillable = [
    		'name',
    	];

    public function productdetails(){
      return $this->hasMany('App\Productdetail');
    }
}
