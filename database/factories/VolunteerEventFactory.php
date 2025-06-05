<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use App\Models\Volunteer;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VolunteerEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'event_id' => Event::inRandomOrder()->value('event_id'), // lấy 1 event_id random
            'volunteer_id' => Volunteer::inRandomOrder()->value('volunteer_id'), // lấy 1 volunteer_id random
            'status' => $this->faker->randomElement(['registered', 'completed', 'not completed']),
            'created_at' => now(),
            'updated_at' => now(),
            //
        ];
    }
}
