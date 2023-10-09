<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $subjectGroups = ['Group A', 'Group B', 'Group C'];

        foreach ($subjectGroups as $subjectGroup) {
            Group::factory()->create([
                'name' => $subjectGroup,
                'model' => Subject::class
            ]);
        }
    }
}
