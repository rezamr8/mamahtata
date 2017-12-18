<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
       
        $product = factory(\App\Product::class, 10)->create();

        //php artisan db:seed --class=ProductsTableSeeder
    }
}
