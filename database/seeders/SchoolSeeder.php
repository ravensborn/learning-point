<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $school1 = School::factory()->create();
        $school2 = School::factory()->create();

        Grade::factory(4)->create([
            'school_id' => $school1->id
        ]);

        Grade::factory(4)->create([
            'school_id' => $school2->id
        ]);
    }
}
