<?php

namespace Database\Factories;

use App\Models\Volunteer;
use Illuminate\Database\Eloquent\Factories\Factory;

class VolunteerFactory extends Factory
{
    protected $model = Volunteer::class;

    public function definition()
    {
        return [
            'volunteer_id' => $this->faker->uuid,
            'username' => $this->faker->userName,
            'password' => bcrypt('123123'),
            'email' => $this->faker->unique()->safeEmail,
            'fullname' => $this->faker->name,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'avatar' => $this->faker->imageUrl(),
            'cover' => $this->faker->imageUrl(),
            'point' => $this->faker->numberBetween(0, 100),
            'role' => $this->faker->word,
        ];
    }
}
