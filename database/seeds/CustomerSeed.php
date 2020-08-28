<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('customer')->insert([
            'name' => 'thaihoang',
            'email' => 'thaihoangdo0512@gmail.com',
            'phone'=>'0989942742',
            'password' => bcrypt('123456'),
        ]);
    }
}
