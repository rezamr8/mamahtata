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
        	'name' => 'admin',
        	'email' => 'admin@print.com',
          'admin' => 1,
        	'password' => 'password'
        ]);

        App\User::create([
            'name' => 'setting',
            'email' => 'setting@print.com',
            'admin' => 0,
            'password' => 'password'
        ]);

        App\User::create([
            'name' => 'kasir',
            'email' => 'kasir@print.com',
            'admin' => 0,
            'password' => 'password'
        ]);
    }
}
