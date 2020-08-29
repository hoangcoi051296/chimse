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
            'name' => 'admin',
            'email' => 'thangcon123@gmail.com',
            'phone'=>'0346687019',
            'password' => bcrypt('12345'),
        ]);
    }
}
