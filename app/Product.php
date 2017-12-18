<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $fillable = ['nama','harga','stok'];

    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }

    public function orderdetail()
    {
    	return $this->hasMany('App\OrderDetail');
    }
}
