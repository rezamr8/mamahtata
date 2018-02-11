<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable =['order_id','product_id','panjang','lebar','luas','harga','jumlah','sub_total','biaya_setting','keterangan','keuntungan','discount'];
    public function product()
    {
    	return $this->belongsTo('App\Produk');
    }

    public function order()
    {
    	return $this->belongsTo('App\Order');
    }

    public function stokkeluar()
    {
        return $this->belongsTo('App\StokKeluar');
    }
}
