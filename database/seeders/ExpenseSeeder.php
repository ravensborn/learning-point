<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Expense::factory(10)->create([
            'group_id' => Group::where('model', Expense::class)->inRandomOrder()->first()
        ]);
    }
}
