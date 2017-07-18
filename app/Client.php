<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
     protected $fillable = [
        'name', 'vat', 'email', 'company_name', 'address', 'zipcode', 'city', 'saddress', 'szipcode', 'scity', 'primary_number', 'secondary_number', 'industry_id', 'fk_user_id',
    ];

    public function order(){
    	return $this->hasMany('App\Order','id','fk_client_id');
    }

   
}
