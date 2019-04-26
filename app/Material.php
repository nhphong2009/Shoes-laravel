<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materials';
    
    protected $fillable = [
    		'name', 
    	];

    public function productdetails(){
      return $this->hasMany('App\Productdetail');
    }
}
