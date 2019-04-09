<?php

use Illuminate\Database\Seeder;

class UserTripsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_trips')->insert([
            [
                'user_id' => '1',
                'trip_id' => '2'
            ],[
                'user_id' => '4',
                'trip_id' => '3'
            ]
        ]);
    }
}
