<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            "manager_id" => null,
            "password" => bcrypt("12345678")
        ]);
        User::factory()->create([
            'name' => 'hr',
            'email' => 'hr@example.com',
            'role' => 'hr',
            "manager_id" => null,
            "password" => bcrypt("12345678")
        ]);
    }
}
