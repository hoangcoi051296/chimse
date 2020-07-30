<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('managers')->insert([
            'name' => 'thaihoang',
            'email' => 'thaihoangdo0512@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
