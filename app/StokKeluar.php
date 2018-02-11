<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StokKeluar extends Model
{
    //

    protected $table = 'stok_keluar';
    protected $fillable = ['order_id','produk_id','jumlah'];

    public function order()
    {
    	return $this->belongsTo('App\Order');
    }

    public function product()
    {
    	return $this->belongsTo('App\Produk');
    }





    
}
