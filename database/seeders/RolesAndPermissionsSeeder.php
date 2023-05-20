<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions

        // Permission::firstOrCreate(['name' => 'create courses']);
        // Permission::firstOrCreate(['name' => 'read courses']);
        // Permission::firstOrCreate(['name' => 'update courses']);
        // Permission::firstOrCreate(['name' => 'delete courses']);
        Permission::firstOrCreate(['name' => 'add admins']);

        // create roles and assign created permissions

        // this can be done as separate statements
        // $role = Role::create(['name' => 'writer']);
        // $role->givePermissionTo('edit articles');

        // or may be done by chaining
        // $role = Role::create(['name' => 'moderator'])
        //     ->givePermissionTo(['publish articles', 'unpublish articles']);

        $role = Role::firstOrCreate(['name' => 'super-admin'])->givePermissionTo('add admins');
        $role = Role::firstOrCreate(['name' => 'admin']);
        $role = Role::firstOrCreate(['name' => 'teacher']);
        $role = Role::firstOrCreate(['name' => 'student']);
        // $role->givePermissionTo(Permission::all());
    }
}
