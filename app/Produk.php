<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'produks';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nama', 'harga_beli','harga_jual', 'stok'];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function orderdetail()
    {
        return $this->hasMany('App\OrderDetail');
    }

    public function stokkeluar()
    {
        return $this->hasMany('App\StokKeluar');
    }

    
}
