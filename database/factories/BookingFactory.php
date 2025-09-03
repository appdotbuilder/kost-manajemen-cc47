<?php

namespace Database\Factories;

use App\Models\Kost;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $checkInDate = fake()->dateTimeBetween('now', '+1 month');
        $durationMonths = fake()->randomElement([1, 3, 6, 12]);
        $monthlyPrice = fake()->randomFloat(2, 500000, 2000000);
        $totalAmount = $monthlyPrice * $durationMonths;
        
        return [
            'booking_code' => 'BK-' . Str::upper(Str::random(8)),
            'kost_id' => Kost::factory(),
            'room_id' => Room::factory(),
            'customer_name' => fake()->name(),
            'customer_email' => fake()->safeEmail(),
            'customer_phone' => fake()->phoneNumber(),
            'booking_date' => fake()->dateTimeBetween('-1 week', 'now'),
            'check_in_date' => $checkInDate,
            'duration_months' => $durationMonths,
            'total_amount' => $totalAmount,
            'deposit_amount' => $monthlyPrice * 0.5, // 50% deposit
            'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
            'notes' => fake()->optional()->sentence(),
            'payment_proof' => null,
            'expires_at' => fake()->dateTimeBetween('now', '+3 days'),
        ];
    }

    /**
     * Indicate that the booking is confirmed.
     */
    public function confirmed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'confirmed',
            'payment_proof' => [fake()->imageUrl(400, 300, 'payment')],
        ]);
    }
}