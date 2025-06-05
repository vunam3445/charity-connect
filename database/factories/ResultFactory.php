<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Event;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Result>
 */
class ResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'result_id' => (string) Str::uuid(),
            'event_id' => Event::inRandomOrder()->first()?->event_id ?? Event::factory(),
            'content' => $this->faker->paragraph(),
            'images' => $this->faker->imageUrl(640, 480, 'charity', true, 'result'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
