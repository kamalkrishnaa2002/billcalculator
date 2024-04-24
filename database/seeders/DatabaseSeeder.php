<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\TelescopicRatesSeeder;
use Database\Seeders\NonTelescopicRatesSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(TelescopicRatesSeeder::class);
        $this->call(NonTelescopicRatesSeeder::class);
    }
}
