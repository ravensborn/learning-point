<?php

namespace Database\Factories;

use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => 'SESH-000' . $this->faker->randomNumber(3, true),
            'user_id' => 1,
            'teacher_id' => 1,
            'subject_id' => 1,
            'status' => Session::STATUS_PENDING,
            'type' => $this->faker->randomElement([Session::TYPE_THEORETICAL, Session::TYPE_PRACTICAL]),
            'time_in' => now(),
            'time_out' => now()->addHour()->addMinutes(30),
//            'rate' => $this->faker->randomNumber(2, true),
            'note' => $this->faker->paragraph,
        ];
    }
}
