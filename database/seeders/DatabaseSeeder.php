<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\FestivalSeeder;
use Database\Seeders\WorkdaySeeder;
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
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            FestivalSeeder::class,
            WorkdaySeeder::class,
        ]);
    }
}
