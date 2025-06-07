<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Festival;

class FestivalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Festival::create([
            'aufbau_start' => '2025-06-01',
            'aufbau_end' => '2025-06-05',
            'festival_start' => '2025-06-06',
            'festival_end' => '2025-06-10',
            'abbau_start' => '2025-06-11',
            'abbau_end' => '2025-06-13',
        ]);
    }
}
