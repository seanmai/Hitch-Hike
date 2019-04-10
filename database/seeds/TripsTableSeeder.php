<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TripsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trips')->insert([
            [
                'title' => 'Hawkwood to Sulphur Mountain',
                'description' => 'Going up to Sulphur Mountain for a hike by myself pls keep me company',
                'driver_id' => '1',
                'available_seats' => '4',
                'pickup' => '51.128513, -114.184257',
                'dropoff' => '51.122737, -115.556335',
                'departure_time' => 'April 29, 2019 - 10:00AM'
            ],[
                'title' => 'Brentwood to Banff, 3 seats!',
                'description' => 'Going up with my friend 3 back seats available in my comfy SUV, AUX priveleges included!',
                'available_seats' => '3',
                'driver_id' => '3',
                'pickup' => '51.087651, -114.130915',
                'dropoff' => '51.182159, -115.557333',
                'departure_time' => 'April 29, 2019 - 10:00AM'
            ],[
                'title' => 'Not a kidnapping',
                'description' => 'Definitely not a kidnapping. My van has room for 13 people',
                'available_seats' => '13',
                'driver_id' => '2',
                'pickup' => '51.129987, -113.972796',
                'dropoff' => '51.130927, -113.878509',
                'departure_time' => 'April 29, 2019 - 10:00AM'
            ],[
                'title' => 'Somerset to University',
                'description' => 'Pooling to school with some friends, we have 1 seat available!',
                'available_seats' => '1',
                'driver_id' => '5',
                'pickup' => '50.899250, -114.069561',
                'dropoff' => '51.078584, -114.134921',
                'departure_time' => 'April 29, 2019 - 10:00AM'
            ],[
                'title' => 'Driving down the block',
                'description' => 'I just want some company while I go down the block',
                'available_seats' => '4',
                'driver_id' => '4',
                'pickup' => '51.062360, -114.065075',
                'dropoff' => '51.062495, -114.067403',
                'departure_time' => 'April 29, 2019 - 10:00AM'
            ],[
                'title' => 'School to climbing gym',
                'description' => 'Just going from school to the climbing gym like always!',
                'available_seats' => '3',
                'driver_id' => '2',
                'pickup' => '51.078584, -114.134921',
                'dropoff' => '51.066188, -114.065190',
                'departure_time' => 'April 29, 2019 - 10:00AM'
            ]
        ]);
    }
}
