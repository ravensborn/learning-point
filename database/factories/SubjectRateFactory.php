<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubjectRate>
 */
class SubjectRateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject_id' => 1,
            'rate' => $this->faker->randomElement([10,20,30,40,50]),
            'number_of_students' => $this->faker->randomElement([1,2,3,4,5]),
        ];
    }
}
