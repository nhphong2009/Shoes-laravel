<?php

namespace App;

use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Rateable;
    
    protected $table = 'products';
    
    protected $fillable = [
    		'code', 
    		'name', 
    		'slug', 
    		'price', 
    		'sale_price', 
    		'category_id', 
    		'brand_id', 
    		'content', 
    		'admin_id', 
    		'description', 
    		'thumbnail', 
    	];

    public function brand(){
      return $this->belongsTo('App\Brand', 'brand_id');
    }

    public function category(){
      return $this->belongsTo('App\Category', 'category_id');
    }

    public function admin(){
      return $this->belongsTo('App\User', 'admin_id');
    }

    public function productdetails(){
      return $this->hasMany('App\Productdetail');
    }

    public function productimages(){
      return $this->hasMany('App\Productimage');
    }
}
