<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function product()
    {
    	return $this->hasMany('App\Product');
    }

    public function order()
    {
    	return $this->hasMany('App\Order');
    }
}
