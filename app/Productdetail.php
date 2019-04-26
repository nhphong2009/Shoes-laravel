<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productdetail extends Model
{
    protected $table = 'product_details';
    
    protected $fillable = [
    		'product_id', 
    		'color_id', 
    		'size_id', 
    		'style_id', 
    		'material_id', 
    		'quantity', 
    	];

    public function product(){
      return $this->belongsTo('App\Product', 'product_id');
    }

    public function color(){
      return $this->belongsTo('App\Color', 'color_id');
    }

    public function size(){
      return $this->belongsTo('App\Size', 'size_id');
    }

    public function style(){
      return $this->belongsTo('App\Style', 'style_id');
    }

    public function material(){
      return $this->belongsTo('App\Material', 'material_id');
    }
}
