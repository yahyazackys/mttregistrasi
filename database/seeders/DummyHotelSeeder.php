<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;

class DummyHotelSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Center',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Vendor 1
        $vendor1 = User::create([
            'name' => 'Budi Purnomo',
            'email' => 'vendor1@example.com',
            'password' => Hash::make('password'),
            'role' => 'vendor',
            'pic_name' => 'Budi Purnomo',
            'phone' => '081234567890',
            'terms_agreed' => true
        ]);

        $hotel1 = Hotel::create([
            'user_id' => $vendor1->id,
            'name' => 'Hotel Harmoni Solo',
            'address' => 'Jl. Slamet Riyadi No. 123',
            'city' => 'Surakarta',
            'map_embed' => 'https://maps.google.com',
            'category' => 'Bintang 3',
            'total_rooms' => 45,
            'facilities' => ['WiFi', 'Parkir', 'Sarapan']
        ]);

        Room::create([
            'hotel_id' => $hotel1->id,
            'name' => 'Superior',
            'size' => '24m²',
            'facilities' => ['AC', 'TV'],
            'units' => 15,
            'publish_rate' => 650000,
            'corporate_rate' => 500000,
            'start_date' => now(),
            'end_date' => now()->addMonths(6),
        ]);

        // Vendor 2
        $vendor2 = User::create([
            'name' => 'Rina Sari',
            'email' => 'vendor2@example.com',
            'password' => Hash::make('password'),
            'role' => 'vendor',
            'pic_name' => 'Rina Sari',
            'phone' => '082223334445',
            'terms_agreed' => true
        ]);

        $hotel2 = Hotel::create([
            'user_id' => $vendor2->id,
            'name' => 'Hotel Galaxy Jaya',
            'address' => 'Jl. Sudirman No. 9',
            'city' => 'Jakarta',
            'map_embed' => 'https://maps.google.com',
            'category' => 'Bintang 5',
            'total_rooms' => 150,
            'facilities' => ['WiFi', 'Sarapan']
        ]);

        Room::create([
            'hotel_id' => $hotel2->id,
            'name' => 'Executive Suite',
            'size' => '45m²',
            'facilities' => ['AC', 'TV', 'Air Panas'],
            'units' => 25,
            'publish_rate' => 1500000,
            'corporate_rate' => 1100000,
            'start_date' => now(),
            'end_date' => now()->addMonths(6),
        ]);
    }
}

