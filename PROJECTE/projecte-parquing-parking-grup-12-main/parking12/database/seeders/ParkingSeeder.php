<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Parking;
use Carbon\Carbon;

class ParkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ejemplos de datos para parkings
        $parkings = [
            [
                'name' => 'Parc Central',
                'address' => 'Avinguda Ramon i Cajal',
                'city' => 'Tarragona',
                'latitude' => 41.116708,
                'longitude' => 1.237641,
                'openTime' => Carbon::parse('06:00:00'),
                'closingTime' => Carbon::parse('22:00:00'),
                'parkingType' => 'OpenAccess',
                'isOpen' => true,
                'availableSlots' => 120,
            ],
            [
                'name' => 'Horta Gran',
                'address' => 'Avinguda Roma, 1',
                'city' => 'Tarragona',
                'latitude' => 41.11889,
                'longitude' => 1.234288,
                'openTime' => Carbon::parse('07:00:00'),
                'closingTime' => Carbon::parse('23:00:00'),
                'parkingType' => 'PlateRecognition',
                'isOpen' => true,
                'availableSlots' => 120,
            ],
            [
                'name' => 'Campus Catalunya',
                'address' => 'Avinguda Catalunya',
                'city' => 'Tarragona',
                'latitude' => 41.123329,
                'longitude' => 1.250507,
                'openTime' => Carbon::parse('08:00:00'),
                'closingTime' => Carbon::parse('22:00:00'),
                'parkingType' => 'AssignedSlot',
                'isOpen' => false,
                'availableSlots' => 120,
            ],
        ];

        foreach ($parkings as $parkingData) {
            Parking::create($parkingData);
        }
    }
}

