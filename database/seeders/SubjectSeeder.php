<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subject::factory(30)->create([
            'group_id' => Group::where('model', Subject::class)->inRandomOrder()->first()
        ]);
    }
}
