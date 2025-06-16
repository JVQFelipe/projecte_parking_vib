<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Img;

class ImgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            [
                'name' => 'Parking Entrance',
                'url' => 'https://example.com/images/parking-entrance.jpg',
                'parking_id' => 1,
            ],
    
            
        ];

        
        foreach ($images as $imageData) {
            Img::create($imageData);
        }
    }
}