<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$users = factory(\App\User::class, 10)->create();
        App\User::create([
        	'name' => 'reza',
        	'email' => 'edzapodka@gmail.com',
            'admin' => 1,
        	'password' => bcrypt('password')
        ]);
    }
}
