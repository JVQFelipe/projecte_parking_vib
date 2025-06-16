<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        	ParkingSeeder::class,
        	FloorSeeder::class,
            ParkingSlotSeederp1p1::class,
            ParkingSlotSeederp1p2::class,
            ParkingSlotSeederp2p1::class,
            ParkingSlotSeederp2p2::class,
            ParkingSlotSeederp3p1::class,
            ParkingSlotSeederp3p2::class,
        	ImgSeeder::class,
            UsersSeeder::class,
            TicketSeeder::class,
            RateSeeder::class,
            ParkingRateSeeder::class,

         ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
