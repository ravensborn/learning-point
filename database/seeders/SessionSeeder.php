<?php

namespace Database\Seeders;

use App\Models\Attendee;
use App\Models\Session;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Session::factory(3)->create();
        Attendee::factory(3)->create();
    }
}
