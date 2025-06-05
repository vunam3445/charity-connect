<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            //
            'organization_id' => Organization::inRandomOrder()->first()->organization_id ?? Organization::factory(),
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'start_date' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'end_date' => $this->faker->dateTimeBetween('+2 weeks', '+3 weeks'),
            'location' => $this->faker->address(),
            'min_quantity' => $this->faker->numberBetween(1, 10),
            'max_quantity' => $this->faker->numberBetween(10, 100),
            'quantity_now' => 0,
            'status' => 'active',
            'approved' => 'pending',
            'image' => $this->faker->imageUrl(640, 480, 'events', true),
        ];
    }
}
