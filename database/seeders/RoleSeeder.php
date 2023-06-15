<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([ 'name' => 'admin' ]);
        Role::create(['name' =>'simple_user']);

        Permission::create([ 'name' => 'access_panel' ]);

        Permission::create([ 'name' => 'show_roles' ]);
        Permission::create([ 'name' => 'edit_roles' ]);
        Permission::create([ 'name' => 'create_roles' ]);
        Permission::create([ 'name' => 'delete_roles' ]);

        Permission::create([ 'name' => 'show_permissions' ]);
        Permission::create([ 'name' => 'edit_permissions' ]);
        Permission::create([ 'name' => 'create_permissions' ]);
        Permission::create([ 'name' => 'delete_permissions' ]);

        Permission::create([ 'name' => 'show_users' ]);
        Permission::create([ 'name' => 'edit_users' ]);
        Permission::create([ 'name' => 'create_users' ]);
        Permission::create([ 'name' => 'delete_users' ]);

        $role = Role::findByName('admin');
        $role->syncPermissions(Permission::all());

        $user = User::create([
            'name' => 'Admin Padrão',
            'email' => 'yuresamarone34@gmail.com',
            'password' => Hash::make("12345678")
        ]);
        $user->assignRole('admin');

    }
}
