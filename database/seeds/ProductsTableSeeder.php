<?php

use Illuminate\Database\Seeder;
use App\Produk;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
       
        $product = factory(\App\Produk::class, 10)->create();

        //php artisan db:seed --class=ProductsTableSeeder
    }
}
