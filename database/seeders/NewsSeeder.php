<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            News::create([
                'name' => fake()->unique()->sentence(2),
                'body' => fake()->paragraph(15),
                'for_whom' => 'all',
                'course_id' => null,
                'user_id' => fake()->numberBetween(1, 2),
            ]);
        }
    }
}
