<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => 'TRS-000' . $this->faker->randomNumber(3, true),
            'user' => [
                'name' => 'Yad',
                'email' => 'yad@gmail.com',
            ],
            'type' => Transaction::TYPE_DEPOSIT,
            'amount' => 100,
            'description' => 'Seeder deposit.',
            'transactable_id' => 1,
            'transactable_type' => Student::class,
        ];
    }
}
