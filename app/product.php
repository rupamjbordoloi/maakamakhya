<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    

    public function client(){
    	return $this->belongsTo('App\Client','fk_client_id','id');
    }
}
