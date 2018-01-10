<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable =['order_id','product_id','harga','jumlah','sub_total','keterangan'];
    public function product()
    {
    	return $this->belongsTo('App\Produk');
    }

    public function order()
    {
    	return $this->belongsTo('App\Order');
    }
}
