<?php

use Illuminate\Database\Seeder;

class Hseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(\App\Models\Employee::class,10)->create();
        factory(\App\Models\Customer::class,10)->create();
        factory(\App\Models\Post::class,100)->create();

    }
}
