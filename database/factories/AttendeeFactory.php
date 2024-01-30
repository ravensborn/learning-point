<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendee>
 */
class AttendeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'session_id' => 1,
            'student_id' => $this->faker->randomElement(Student::all()->pluck('id')),
            'attending' => true,
            'charged' => true,
            'charge_list' => [],
            'cancellation_charge_list' => [],
        ];
    }
}
