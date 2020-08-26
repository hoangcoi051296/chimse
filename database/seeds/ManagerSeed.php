<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManagerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('managers')->insert([
            'name' => 'SU',
            'email' => 'thaihoangdo0512@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        DB::table('managers')->insert([
            'name' => 'TH',
            'email' => 'ht96937469@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        DB::table('managers')->insert([
            'name' => 'TT',
            'email' => 'hoangcoi051296@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
