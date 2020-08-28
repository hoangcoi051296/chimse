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
//        $this->call(permissionSeed::class);
//        $this->call(Hseeder::class);
        DB::table('customer')->insert([
            'name' => 'thaihoang',
            'email' => 'thaihoangdo0512@gmail.com',
            'phone'=>'0989942742',
            'password' => bcrypt('12345678'),
        ]);
    }
}
