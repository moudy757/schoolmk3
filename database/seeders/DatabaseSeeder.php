<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RolesAndPermissionsSeeder::class,
            User::create([
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'login_id' => 'admin' . date("Y") . str_pad(1, 3, '0', STR_PAD_LEFT),
                'password' => Hash::make('admin'),
            ])->assignRole('admin'),

            UserSeeder::class,
            NewsSeeder::class,
        ]);
    }
}
