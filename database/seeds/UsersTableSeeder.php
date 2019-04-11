<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Seanus Beanus',
                'email' => 'seandmai@gmail.com',
                'password' => bcrypt('asdfasdf')
            ],[
                'name' => 'Waf',
                'email' => 'wafa.anam@gmail.com',
                'password' => bcrypt('asdfasdf')
            ],[
                'name' => 'Matt Gluten',
                'email' => 'glutenslayer@gmail.com',
                'password' => bcrypt('asdfasdf')
            ],[
                'name' => 'Aggressive Bean',
                'email' => 'chevy@gmail.com',
                'password' => bcrypt('asdfasdf')
            ],[
                'name' => 'Sweetest Bean',
                'email' => 'karla@gmail.com',
                'password' => bcrypt('asdfasdf')
            ],[
                'name' => "Je m'apelle Patrick",
                'email' => 'patrick@gmail.com',
                'password' => bcrypt('asdfasdf')
            ]
        ]);
    }
}
