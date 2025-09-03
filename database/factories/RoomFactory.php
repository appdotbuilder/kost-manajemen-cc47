<?php

namespace Database\Factories;

use App\Models\Kost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $monthlyPrice = fake()->randomFloat(2, 500000, 2000000);
        
        return [
            'kost_id' => Kost::factory(),
            'room_number' => fake()->numberBetween(1, 50),
            'floor' => fake()->numberBetween(1, 3),
            'description' => fake()->sentence(),
            'facilities' => fake()->randomElements([
                'AC', 'Kasur', 'Lemari', 'Meja Belajar', 'WiFi', 'Kamar Mandi Dalam'
            ], random_int(3, 5)),
            'photos' => [fake()->imageUrl(640, 480, 'room')],
            'size' => fake()->randomFloat(2, 9, 25),
            'monthly_price' => $monthlyPrice,
            'quarterly_price' => $monthlyPrice * 3 * 0.95, // 5% discount
            'yearly_price' => $monthlyPrice * 12 * 0.90, // 10% discount
            'status' => fake()->randomElement(['kosong', 'terisi', 'booking']),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the room is available.
     */
    public function available(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'kosong',
        ]);
    }

    /**
     * Indicate that the room is occupied.
     */
    public function occupied(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'terisi',
        ]);
    }
}