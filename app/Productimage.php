<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productimage extends Model
{
    protected $table = 'product_images';
    
    protected $fillable = [
    		'product_id', 
    		'link', 
    	];

    public function product(){
      return $this->belongsTo('App\Product', 'product_id');
    }
}
