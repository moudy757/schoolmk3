<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'super@mail.com',
            'password' => Hash::make('super'),
        ])->assignRole('super-admin');

        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
        ])->assignRole('admin');

        $teacher = Teacher::create([
            'dob' => '1995-5-15',
        ]);

        $teacher->user()->create([
            'name' => 'teacher',
            'email' => 'teacher@mail.com',
            'password' => Hash::make('teacher'),
        ])->assignRole('teacher');

        $student = Student::create([
            'dob' => '2005-5-15,'
        ]);

        $student->user()->create([
            'name' => 'student',
            'email' => 'student@mail.com',
            'password' => Hash::make('student'),
        ])->assignRole('student');
    }
}
