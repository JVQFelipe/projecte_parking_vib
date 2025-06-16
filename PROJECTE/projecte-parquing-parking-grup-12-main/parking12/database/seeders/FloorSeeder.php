<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Floor;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {


        $floors = [
            [
                'name' => 'P1 - Planta 1',
                'latitude' => '0',
                'longitude' => '0',
                'capacity' => 60,
                'isOpen' => true,
                'parking_id' => 1,
            ],
            [
                'name' => 'P1 - Planta 2',
                'latitude' => '0',
                'longitude' => '0',
                'capacity' => 60,
                'isOpen' => true,
                'parking_id' => 1,
            ],
            [
                'name' => 'P2 - Planta 1',
                'latitude' => '0',
                'longitude' => '0',
                'capacity' => 60,
                'isOpen' => true,
                'parking_id' => 2,
            ],
            [
                'name' => 'P2 - Planta 2',
                'latitude' => '0',
                'longitude' => '0',
                'capacity' => 60,
                'isOpen' => true,
                'parking_id' => 2,
            ],
            [
                'name' => 'P3 - Planta 1',
                'latitude' => '0',
                'longitude' => '0',
                'capacity' => 60,
                'isOpen' => true,
                'parking_id' => 3,
            ],
            [
                'name' => 'P3 - Planta 2',
                'latitude' => '0',
                'longitude' => '0',
                'capacity' => 60,
                'isOpen' => true,
                'parking_id' => 3,
            ],
        ];

        

        foreach ($floors as $floorData) {
            Floor::create($floorData);
        }
    }
}

