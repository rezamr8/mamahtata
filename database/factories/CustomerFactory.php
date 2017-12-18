<?php

use Faker\Generator as Faker;



$factory->define(App\Customer::class, function (Faker $faker) {
    static $password;

    return [
        'nama' => $faker->name,
        'alamat' => $faker->streetAddress,
        'no_hp' => $faker->phoneNumber
        
    ];
});
