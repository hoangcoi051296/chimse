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
//        $this->call(Hseeder::class);
        DB::table('customer')->insert([
            'name' => 'thaihoang',
            'phone'=>1234,
            'email' => 'thaihoangdo0512@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
