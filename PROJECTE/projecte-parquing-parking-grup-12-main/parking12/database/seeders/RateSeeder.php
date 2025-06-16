<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Rate;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rates = [
            [
                'name' => 'Normal',
                'isActive' => true,
                'ratePerMinute' => 0.07,
            ],
            [
                'name' => 'Abonat',
                'isActive' => true,
                'ratePerMinute' => 0.03,
            ],
        ];
    
    foreach ($rates as $rateData) {
        Rate::create($rateData);
    }
    
}
}
