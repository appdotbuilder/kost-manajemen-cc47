<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement([
            'WiFi Gratis', 'AC', 'Kamar Mandi Dalam', 'Parkir Motor', 'Laundry',
            'CCTV', 'Dapur Bersama', 'Akses 24 Jam', 'Dekat Kampus', 'Dekat Mall'
        ]);
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'type' => fake()->randomElement(['fasilitas', 'lokasi', 'eksklusif', 'reguler']),
            'icon' => fake()->randomElement(['wifi', 'ac', 'bath', 'parking', 'laundry']),
            'description' => fake()->sentence(),
        ];
    }
}