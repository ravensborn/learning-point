<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\StudentRelation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentRelation>
 */
class StudentRelationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $counter = 2;

        return [
            'name' => $this->faker->randomElement(array_keys(StudentRelation::AVAILABLE_RELATIONS)),
            'student_id' => 1,
            'related_id' => $counter++,
        ];
    }
}
