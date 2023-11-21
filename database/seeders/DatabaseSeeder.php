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
            CitySeeder::class,
            UserSeeder::class,
            GroupSeeder::class,
            SubjectSeeder::class,
            StudentSeeder::class,
            LcDatabaseSeeder::class
        ]);
    }
}
