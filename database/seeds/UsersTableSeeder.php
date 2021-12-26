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
            'role_id' => '1',
            'name' => 'Projanmo IT',
            'phone' => '01873992222',
            'email' => 'admin@projanmoit.com',
            'address' => 'Mohammadpur',
            'password' => bcrypt('Proit@2021.com'),
        ]);

        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Patwary',
            'phone' => '01726264728',
            'email' => 'ifnpatwary@gmail.com',
            'address' => 'Mohammadpur',
            'password' => bcrypt('Patwary@2020'),
        ]);
    }
}
