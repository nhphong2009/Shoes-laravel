<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    
    protected $fillable = [
    		'code', 
    		'customer_name', 
    		'customer_mobile', 
    		'customer_address', 
    		'status', 
    	];

    public function orderdetails(){
      return $this->hasMany('App\Orderdetail');
    }
}
