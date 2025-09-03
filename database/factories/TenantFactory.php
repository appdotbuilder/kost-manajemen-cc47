<?php

namespace Database\Factories;

use App\Models\Kost;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kost_id' => Kost::factory(),
            'room_id' => Room::factory(),
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'id_number' => fake()->numerify('##############'),
            'emergency_contact_name' => fake()->name(),
            'emergency_contact_phone' => fake()->phoneNumber(),
            'profession' => fake()->jobTitle(),
            'documents' => [
                'ktp' => fake()->imageUrl(400, 300, 'documents'),
                'kk' => fake()->imageUrl(400, 300, 'documents'),
            ],
            'check_in_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'check_out_date' => null,
            'status' => 'aktif',
            'notes' => fake()->optional()->sentence(),
        ];
    }

    /**
     * Indicate that the tenant has checked out.
     */
    public function checkedOut(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'keluar',
            'check_out_date' => fake()->dateTimeBetween($attributes['check_in_date'] ?? '-6 months', 'now'),
        ]);
    }
}