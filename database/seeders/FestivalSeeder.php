<?php

namespace Database\Seeders;

use App\Models\Festival;
use Illuminate\Database\Seeder;

class FestivalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Festival::create([
            'aufbau_start' => '2025-06-01',
            'festival_start' => '2025-06-06',
            'abbau_start' => '2025-06-11',
            'abbau_end' => '2025-06-13',
            'aufbau_end' => '2025-06-06',
            'festival_end' => '2025-06-10',
        ]);
    }
}
