<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'wallet' => $this->faker->randomNumber(3,true),
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->lastName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'birthday' => $this->faker->date,
            'blood_type' => $this->faker->bloodGroup(),
            'primary_phone_number' => $this->faker->e164PhoneNumber(),
            'secondary_phone_number' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->email,
            'country' => 'IQ',
            'city_id' => City::ERBIL,
            'address' => $this->faker->streetAddress,
        ];
    }
}
