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

        factory(\App\Models\Employee::class,50)->create();
        factory(\App\Models\Customer::class,50)->create();
        factory(\App\Models\Post::class,10000)->create();

    }
}
