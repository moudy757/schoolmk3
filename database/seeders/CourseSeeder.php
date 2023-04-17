<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($id): void
    {
        Course::create([
            'name' => fake()->unique()->name(),
            'description' => fake()->sentence(15),
            'level' => fake()->numberBetween(1, 3),
            'teacher_id' => $id,
        ]);
    }
}
