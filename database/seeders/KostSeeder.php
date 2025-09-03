<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Kost;
use App\Models\User;
use Illuminate\Database\Seeder;

class KostSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create categories
        $categories = [
            ['name' => 'WiFi Gratis', 'slug' => 'wifi-gratis', 'type' => 'fasilitas', 'icon' => 'wifi'],
            ['name' => 'AC', 'slug' => 'ac', 'type' => 'fasilitas', 'icon' => 'ac'],
            ['name' => 'Kamar Mandi Dalam', 'slug' => 'kamar-mandi-dalam', 'type' => 'fasilitas', 'icon' => 'bath'],
            ['name' => 'Parkir Motor', 'slug' => 'parkir-motor', 'type' => 'fasilitas', 'icon' => 'parking'],
            ['name' => 'Laundry', 'slug' => 'laundry', 'type' => 'fasilitas', 'icon' => 'laundry'],
            ['name' => 'CCTV', 'slug' => 'cctv', 'type' => 'fasilitas', 'icon' => 'security'],
            ['name' => 'Dapur Bersama', 'slug' => 'dapur-bersama', 'type' => 'fasilitas', 'icon' => 'kitchen'],
            ['name' => 'Dekat Kampus', 'slug' => 'dekat-kampus', 'type' => 'lokasi', 'icon' => 'university'],
            ['name' => 'Pusat Kota', 'slug' => 'pusat-kota', 'type' => 'lokasi', 'icon' => 'city'],
            ['name' => 'Dekat Mall', 'slug' => 'dekat-mall', 'type' => 'lokasi', 'icon' => 'shopping'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create a demo user if doesn't exist
        $demoUser = User::firstOrCreate([
            'email' => 'demo@kostku.com'
        ], [
            'name' => 'Demo User',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // Create sample kosts
        for ($i = 1; $i <= 3; $i++) {
            $kost = Kost::create([
                'user_id' => $demoUser->id,
                'name' => "Kost Sejahtera {$i}",
                'slug' => "kost-sejahtera-{$i}-" . random_int(1000, 9999),
                'address' => "Jl. Merdeka No. {$i}0",
                'city' => $i === 1 ? 'Jakarta' : ($i === 2 ? 'Bandung' : 'Yogyakarta'),
                'province' => $i === 1 ? 'DKI Jakarta' : ($i === 2 ? 'Jawa Barat' : 'DI Yogyakarta'),
                'postal_code' => '1' . str_pad((string)$i, 4, '0', STR_PAD_LEFT),
                'phone' => '0812345' . str_pad((string)$i, 5, '0', STR_PAD_LEFT),
                'email' => "kost{$i}@sejahtera.com",
                'description' => "Kost nyaman dengan fasilitas lengkap di lokasi strategis kost {$i}.",
                'rules' => "1. Dilarang membawa teman lawan jenis\n2. Jam malam maksimal 22:00\n3. Dilarang merokok di dalam kamar\n4. Jaga kebersihan bersama",
                'facilities' => ['WiFi', 'Parkir', 'Laundry', 'CCTV', 'Dapur Bersama'],
                'gender_type' => $i === 1 ? 'campur' : ($i === 2 ? 'putra' : 'putri'),
                'kost_type' => $i <= 2 ? 'reguler' : 'eksklusif',
                'is_active' => true,
            ]);

            // Attach categories
            $categoryIds = Category::inRandomOrder()->limit(random_int(3, 6))->pluck('id');
            $kost->categories()->attach($categoryIds);
        }
    }
}