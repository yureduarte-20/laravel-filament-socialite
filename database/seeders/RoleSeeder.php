<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();
        try {
            Role::create(['name' => Role::ADMIN_ROLE_NAME]);
            Role::create(['name' => Role::SIMPLE_USER_ROLE_NAME]);

            Permission::create(['name' => Permission::GRANT_ACCESS_PANEL]);

            Permission::create(['name' => 'show_roles']);
            Permission::create(['name' => 'edit_roles']);
            Permission::create(['name' => 'create_roles']);
            Permission::create(['name' => 'delete_roles']);

            Permission::create(['name' => 'show_permissions']);
            Permission::create(['name' => 'edit_permissions']);
            Permission::create(['name' => 'create_permissions']);
            Permission::create(['name' => 'delete_permissions']);

            Permission::create(['name' => 'show_users']);
            Permission::create(['name' => 'edit_users']);
            Permission::create(['name' => 'create_users']);
            Permission::create(['name' => 'delete_users']);

            $role = Role::findByName(Role::ADMIN_ROLE_NAME);
            $role->syncPermissions(Permission::all());

            $user = User::create([
                'name' => 'Admin Padrão',
                'email' => env('ADMIN_DEFAULT_EMAIL', "yuresamarone34@gmail.com"),
                'password' => Hash::make(env('ADMIN_DEFAULT_PASSWORD', "12345678"))
            ]);
            $user->assignRole('admin');
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            logger()->error($e->getMessage().'\n'.$e->getTraceAsString());
        }
    }
}
