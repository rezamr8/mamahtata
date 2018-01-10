<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Produk::class, function (Faker $faker) {
    

    return [
        'nama' => 'Product-'.$faker->word,
        'harga' => '10000',
        'stok' => '10'
        
    ];
});
