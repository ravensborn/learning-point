<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::factory(20)->create();

        foreach (Student::all() as $student) {
            $student->addMedia(public_path('images/user.png'))
                ->preservingOriginal()
                ->toMediaCollection('avatar');
        }
    }
}
