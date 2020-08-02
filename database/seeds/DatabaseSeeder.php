<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('customer')->insert([
//            'name' => 'thangcon',
//            'email' => 'thangcon@gmail.com',
//            'password' => bcrypt('12345678'),
//        ]);
        // DB::table('post')->insert([
        //    'title' => 'dọn nhà',
        //    'status' => 'dọn gấp',
        //    'description' => 'việc nhẹ lương cao',
        //    'price' => '1000$',
        //    'address' => 'Đà Nẵng'
        // ]);
        DB::table('managers')->insert([
            'name' => 'thaihoang',
            'email' => 'thaihoangdo0512@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
