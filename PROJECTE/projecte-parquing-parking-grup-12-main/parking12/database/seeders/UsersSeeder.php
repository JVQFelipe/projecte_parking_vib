<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'prova',
                'email' => 'prova@prova',
                'password' => Hash::make('prova1234'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'admin',
            ],
            [
                'name' => 'admin',
                'email' => 'admin@admin',
                'password' => Hash::make('admin1234'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'admin',
            ],
            [
                'name' => 'manager1',
                'email' => 'manager1@manager',
                'password' => Hash::make('manager1234'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'manager',
                'parking_id' => '1',
            ],
            [
                'name' => 'manager2',
                'email' => 'manager2@manager',
                'password' => Hash::make('manager1234'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'manager',
                'parking_id' => '2',
            ],
        ];
        
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
