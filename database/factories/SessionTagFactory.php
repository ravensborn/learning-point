<?php

namespace Database\Factories;

use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SessionTag>
 */
class SessionTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'session_id' => $this->faker->randomElement(Session::all()->pluck('id')),
            'name' => $this->faker->word()
        ];
    }
}
