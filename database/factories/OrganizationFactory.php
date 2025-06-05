<?php


namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    public function definition()
    {
        return [
            'organization_id' => $this->faker->uuid,
            'username' => $this->faker->userName,
            'password' => bcrypt('password'),  // Mã hóa mật khẩu
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'founded_at' => $this->faker->date(),  // Ngày thành lập
            'representative' => $this->faker->name,  // Người đại diện
            'description' => $this->faker->optional()->text,

            'cover' => $this->faker->imageUrl(),
            'website' => $this->faker->url,
            'avatar' => $this->faker->imageUrl(),
            'approved' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'role' => $this->faker->word,
        ];
    }
}
