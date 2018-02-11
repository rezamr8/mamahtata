<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsTableSeeder extends Seeder
{
    public function run()
	{
    	// Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'Administrator']);
        Permission::create(['name' => 'setting']);
        Permission::create(['name' => 'kasir']);
        

        // create roles and assign existing permissions
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('Administrator');
        

        $role = Role::create(['name' => 'setting']);
        $role->givePermissionTo('setting');

        $role = Role::create(['name' => 'kasir']);
        $role->givePermissionTo('kasir');

        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_id' => 1,
            'model_type' => 'App\User'
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => 2,
            'model_id' => 2,
            'model_type' => 'App\User'
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => 3,
            'model_id' => 3,
            'model_type' => 'App\User'
        ]);
        
    }
}