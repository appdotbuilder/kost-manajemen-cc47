<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kost>
 */
class KostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = 'Kost ' . fake()->company();
        
        return [
            'user_id' => User::factory(),
            'name' => $name,
            'slug' => Str::slug($name . '-' . fake()->randomNumber(3)),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'province' => fake()->randomElement(['DKI Jakarta', 'Jawa Barat', 'Jawa Tengah', 'DI Yogyakarta', 'Jawa Timur']),
            'postal_code' => fake()->postcode(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->safeEmail(),
            'photos' => [fake()->imageUrl(640, 480, 'buildings')],
            'description' => fake()->paragraph(3),
            'rules' => fake()->text(200),
            'facilities' => fake()->randomElements([
                'WiFi', 'AC', 'Kamar Mandi Dalam', 'Parkir', 'Laundry', 'CCTV', 'Dapur'
            ], random_int(3, 6)),
            'gender_type' => fake()->randomElement(['putra', 'putri', 'campur']),
            'kost_type' => fake()->randomElement(['reguler', 'eksklusif']),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the kost is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}