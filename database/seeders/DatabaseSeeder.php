<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Lwwcas\LaravelCountries\Database\Seeders\LcDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            CitySeeder::class,
            UserSeeder::class,
//            GroupSeeder::class, //Fake
//            ExpenseSeeder::class, //Fake
//            SubjectSeeder::class, //Fake
//            SchoolSeeder::class, //Fake
//            FamilySeeder::class, //Fake
//            StudentSeeder::class, //Fake
//            TeacherSeeder::class, //Fake
//            EmployeeSeeder::class, //Fake
//            SessionSeeder::class, //Fake
            LcDatabaseSeeder::class,
        ]);
    }
}
