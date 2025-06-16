<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use Carbon\Carbon;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $tickets = [
            [
                'plate' => 'ABC1234',
                'entryTime' => Carbon::now()->subHours(5),
                'exitTime' => Carbon::now()->subHours(1),
                'isPaid' => true,
                'totalPay' => 3.42,
                'paymentOption' => 'card',
                'parking_id' => 1,
                'parkingslot_id' => 1,

            ],
            [
                'plate' => 'XYZ5678',
                'entryTime' => Carbon::now()->subHours(8),
                'exitTime' => Carbon::now()->subHours(3),
                'isPaid' => false,
                'totalPay' => 3.42,
                'paymentOption' => 'card',
                'parking_id' => 1,
                'parkingslot_id' => 2,

            ],
            [
                'plate' => 'DEF9101',
                'entryTime' => Carbon::now()->subHours(12),
                'exitTime' => Carbon::now()->subHours(2),
                'isPaid' => true,
                'totalPay' => 3.42,
                'paymentOption' => 'card',
                'parking_id' => 1,
                'parkingslot_id' => 3,

            ],
            [
                'plate' => '9483PLT',
                'entryTime' => Carbon::now()->subHours(12),
                'exitTime' => Carbon::now()->subHours(2),
                'isPaid' => false,
                'totalPay' => 6.42,
                'paymentOption' => 'card',
                'parking_id' => 2,
                'parkingslot_id' => 1,

            ],
            [
                'plate' => '2934TTL',
                'entryTime' => Carbon::now()->subHours(12),
                'exitTime' => Carbon::now()->subHours(2),
                'isPaid' => true,
                'totalPay' => 9.37,
                'paymentOption' => 'cash',
                'parking_id' => 2,
                'parkingslot_id' => 2,

            ],
            [
                'plate' => '1430DTH',
                'entryTime' => Carbon::now()->subHours(12),
                'exitTime' => Carbon::now()->subHours(2),
                'isPaid' => true,
                'totalPay' => 11.36,
                'paymentOption' => 'card',
                'parking_id' => 3,
                'parkingslot_id' => 1,

            ],
            [
                'plate' => '3840MMN',
                'entryTime' => Carbon::now()->subHours(12),
                'exitTime' => Carbon::now()->subHours(2),
                'isPaid' => true,
                'totalPay' => 5.78,
                'paymentOption' => 'card',
                'parking_id' => 3,
                'parkingslot_id' => 2,

            ],
            
        ];

        
        foreach ($tickets as $ticketData) {
            Ticket::create($ticketData);
        }
    }
}

