<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    protected $table = 'order_details';
    
    protected $fillable = [
    		'order_id', 
    		'product_id', 
            'quantity', 
            'size_id', 
    		'color_id', 
    	];

    public function product(){
      return $this->belongsTo('App\Product', 'product_id');
    }

    public function order(){
      return $this->belongsTo('App\Order', 'order_id');
    }

    public function size(){
      return $this->belongsTo('App\Size', 'size_id');
    }

    public function color(){
      return $this->belongsTo('App\Color', 'color_id');
    }
}
