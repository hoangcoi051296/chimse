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
        $this->call(PermissionSeed::class);
        $this->call(CustomerSeed::class);
        $this->call(CategorySeed::class);
        $this->call(ManagerSeed::class);
        $this->call(Hseeder::class);

    }
}
