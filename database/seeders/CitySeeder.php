<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'IQ' => ['Erbil', 'Slemani', 'Duhok', 'Kirkuk', 'Baghdad', 'Basra']
        ];

        foreach ($cities as $country => $extracted_cities) {

            foreach ($extracted_cities as $city) {

                City::factory()->create([
                    'country' => $country,
                    'name' => $city
                ]);

            }

        }
    }
}
