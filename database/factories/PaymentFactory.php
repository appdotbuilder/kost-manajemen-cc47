<?php

namespace Database\Factories;

use App\Models\Kost;
use App\Models\Room;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amount = fake()->randomFloat(2, 500000, 2000000);
        $status = fake()->randomElement(['pending', 'paid', 'overdue']);
        $paidAmount = $status === 'paid' ? $amount : 0;
        
        return [
            'invoice_number' => 'INV-' . date('Ymd') . '-' . Str::upper(Str::random(6)),
            'kost_id' => Kost::factory(),
            'tenant_id' => Tenant::factory(),
            'room_id' => Room::factory(),
            'payment_type' => fake()->randomElement(['sewa', 'deposit', 'denda']),
            'period_month' => fake()->monthName(),
            'period_year' => fake()->year(),
            'due_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'payment_date' => $status === 'paid' ? fake()->dateTimeBetween('-2 weeks', 'now') : null,
            'amount' => $amount,
            'paid_amount' => $paidAmount,
            'payment_method' => $status === 'paid' ? fake()->randomElement(['transfer', 'cash', 'e_wallet']) : null,
            'status' => $status,
            'notes' => fake()->optional()->sentence(),
            'payment_proof' => $status === 'paid' ? [fake()->imageUrl(400, 300, 'payment')] : null,
        ];
    }

    /**
     * Indicate that the payment is paid.
     */
    public function paid(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'paid',
            'paid_amount' => $attributes['amount'],
            'payment_date' => fake()->dateTimeBetween('-2 weeks', 'now'),
            'payment_method' => fake()->randomElement(['transfer', 'cash', 'e_wallet']),
            'payment_proof' => [fake()->imageUrl(400, 300, 'payment')],
        ]);
    }

    /**
     * Indicate that the payment is overdue.
     */
    public function overdue(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'overdue',
            'due_date' => fake()->dateTimeBetween('-2 months', '-1 week'),
        ]);
    }
}