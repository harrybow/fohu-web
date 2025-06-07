<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkdaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        collect(['2025-06-10','2025-06-11','2025-06-12'])->each(function($date){
            \App\Models\Workday::create(['day'=>$date]);
        });
    }
}
