<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function client(){
    	return $this->belongsTo('App\Client','fk_client_id','id');
    }

    public function product(){
    	return $this->belongsTo('App\Product','fk_product_id','id');
    }
}
