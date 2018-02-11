<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
	protected $fillable=['customer_id','no_order','uang_muka','total_produk','total_biaya_setting','piutang'];
    public function orderdetail()
    {
    	return $this->hasmany('App\OrderDetail');
    }

    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }

    public function stokkeluar()
    {
    	return $this->hasmany('App\StokKeluar');
    }

    // public function orderdetail()
    // {
    //     return $this->hasManyThrough('App\StokKeluar','App\OrderDetail','order_id','id');
    // }

}
