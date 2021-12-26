<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('websites')->insert([
            'title' => 'Title',
            'email' => 'demo@gmail.com',
            'address' => 'Address',
            'phone' => '01315482234',
        ]);
    }
}
