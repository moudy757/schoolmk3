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

        $permissions = [
            'admins.create',
            'admins.read',
            'admins.update',
            'admins.delete',
            'courses.create',
            'courses.read',
            'courses.update',
            'courses.delete',
            'courses.enroll',
            'courses.own.enroll',
            'courses.drop',
            'courses.own.drop',
            'users.create',
            'users.read',
            'users.update',
            'users.delete',
            'news.create',
            'news.create.admin',
            'news.create.students',
            'news.read',
            'news.update',
            'news.delete',
            'enrolledStudents.read',
            'grades.read',
            'grades.update',
            'grades.own.read',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        Role::firstOrCreate(['name' => 'super-admin']);

        $adminPermissions = [
            'courses.read',
            'courses.update',
            'courses.delete',
            'courses.enroll',
            'courses.drop',
            'users.create',
            'users.read',
            'users.update',
            'users.delete',
            'news.create',
            'news.read',
            'news.update',
            'news.delete',
            'enrolledStudents.read',
            'grades.read',
            'grades.update',
            'news.create.admin',
        ];
        Role::firstOrCreate(['name' => 'admin'])->syncPermissions($adminPermissions);

        $teacherPermissions = [
            'courses.create',
            'courses.read',
            'courses.update',
            'courses.delete',
            'enrolledStudents.read',
            'grades.read',
            'grades.update',
            'news.create.students',
            'news.create',
        ];
        Role::firstOrCreate(['name' => 'teacher'])->syncPermissions($teacherPermissions);

        $studentPermissions = [
            'courses.own.enroll',
            'courses.own.drop',
            'grades.own.read',
        ];
        Role::firstOrCreate(['name' => 'student'])->syncPermissions($studentPermissions);
    }
}
