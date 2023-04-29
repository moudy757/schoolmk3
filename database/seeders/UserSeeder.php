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
    public function __construct(private CourseSeeder $course)
    {
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'name' => 'Super Admin',
        //     'email' => 'super@mail.com',
        //     'login_id' => 'SUPER-' . date("Y") . str_pad(1, 3, '0', STR_PAD_LEFT),
        //     'password' => Hash::make('super'),
        // ])->assignRole('super-admin');

        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'login_id' => 'admin' . date("Y") . str_pad(1, 3, '0', STR_PAD_LEFT),
            'password' => Hash::make('admin'),
        ])->assignRole('admin');

        $teacher1 = Teacher::create([
            'dob' => '1995-5-15',
        ]);

        $teacher1->user()->create([
            'name' => 'Teacher',
            'email' => 'teacher@mail.com',
            'login_id' => 'tc' . date("Y") . str_pad($teacher1->id, 3, '0', STR_PAD_LEFT),
            'password' => Hash::make('teacher'),
        ])->assignRole('teacher');

        $teacher2 = Teacher::create([
            'dob' => '1995-5-15',
        ]);

        $teacher2->user()->create([
            'name' => 'Teacher2',
            'email' => 'teacher2@mail.com',
            'login_id' => 'tc' . date("Y") . str_pad($teacher2->id, 3, '0', STR_PAD_LEFT),
            'password' => Hash::make('teacher'),
        ])->assignRole('teacher');

        for ($i = 1; $i <= 10; $i++) {
            $this->course->run($teacher1->id);
            $this->course->run($teacher2->id);
        }

        $student1 = Student::create([
            'dob' => '2005-5-15',
            'level' => '3'
        ]);

        $student1->user()->create([
            'name' => 'Student',
            'email' => 'student@mail.com',
            'login_id' => 'st' . date("Y") . str_pad($student1->id, 3, '0', STR_PAD_LEFT),
            'password' => Hash::make('student'),
        ])->assignRole('student');

        for ($i = 1; $i <= 19; $i++) {
            $student2 = Student::create([
                'dob' => '2005-5-15',
                'level' => '3'
            ]);

            $student2->user()->create([
                'name' => fake()->name(),
                'email' => fake()->unique()->email(),
                'login_id' => 'st' . date("Y") . str_pad($student2->id, 3, '0', STR_PAD_LEFT),
                'password' => Hash::make('student'),
            ])->assignRole('student');

            $student2->courses()->syncWithoutDetaching([1, ['student_name' => $student2->name]]);
        }
    }
}
