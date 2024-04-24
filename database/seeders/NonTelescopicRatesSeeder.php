<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NonTelescopicRate;
use Illuminate\Support\Facades\DB;
class NonTelescopicRatesSeeder extends Seeder
{
  
    public function run()
    {
        $rates = [
            ['start_units' => 0, 'end_units' => 300, 'rate' => 5.95],
            ['start_units' => 0, 'end_units' => 350, 'rate' => 6.30],
            ['start_units' => 0, 'end_units' => 400, 'rate' => 6.45],
            ['start_units' => 0, 'end_units' => 500, 'rate' => 6.65],
            ['start_units' => 501, 'end_units' => null, 'rate' => 6.90],
        ];

        foreach ($rates as $rate) {
            DB::table('non_telescopic_rates')->insert($rate);
        }
    }
}
