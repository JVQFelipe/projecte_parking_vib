<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ParkingRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parking_rates')->insert([
            'parking_id' => 1,
            'rate_id' => 1        
        ]);
        DB::table('parking_rates')->insert([
            'parking_id' => 1,
            'rate_id' => 2        
        ]);
        DB::table('parking_rates')->insert([
            'parking_id' => 2,
            'rate_id' => 1        
        ]);
        DB::table('parking_rates')->insert([
            'parking_id' => 2,
            'rate_id' => 2        
        ]);
        DB::table('parking_rates')->insert([
            'parking_id' => 3,
            'rate_id' => 1        
        ]);
        DB::table('parking_rates')->insert([
            'parking_id' => 3,
            'rate_id' => 2        
        ]);
    }
}
