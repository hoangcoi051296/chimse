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
        DB::table('managers')->insert([
            'name' => 'thaihoang',
            'email' => 'thaihoangdo0512@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
