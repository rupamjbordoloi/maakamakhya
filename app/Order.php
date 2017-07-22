<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	 protected $fillable = [
        'order_id', 'fk_client_id', 'fk_product_id', 'sq_feets', 'fk_tax_id','estimated_rate','balance_estimate','balance_sq_feets','approval','fk_user_created_id',
    ];

    public function client(){
    	return $this->belongsTo('App\Client','fk_client_id','id');
    }

    public function product(){
    	return $this->belongsTo('App\Product','fk_product_id','id');
    }
     public function tax(){
    	return $this->belongsTo('App\Tax','fk_tax_id','id');
    }
}
