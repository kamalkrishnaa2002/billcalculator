<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TelescopicRate;
use Illuminate\Support\Facades\DB;
class TelescopicRatesSeeder extends Seeder
{
    public function run()
    {
        $rates = [
            ['start_units' => 0, 'end_units' => 50, 'rate' => 3.50],
            ['start_units' => 51, 'end_units' => 100, 'rate' => 4.20],
            ['start_units' => 101, 'end_units' => 150, 'rate' => 5.20],
            ['start_units' => 151, 'end_units' => 200, 'rate' => 5.80],
            ['start_units' => 201, 'end_units' => 250, 'rate' => 6.50],
        ];

        foreach ($rates as $rate) {
            DB::table('telescopic_rates')->insert($rate);
        }
    }
}
