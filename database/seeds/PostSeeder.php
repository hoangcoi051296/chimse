<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post')->insert([
            'title' => 'dọn nhà',
            'status' => 'dọn gấp',
            'description' => 'việc nhẹ lương cao',
            'price' => 1000,
            'address' => 'Đà Nẵng',
            'category_id' => 1,
            'helper_id' => 1
        ],
            [
                'title' => 'dọn nhà 2',
                'status' => 'dọn gấp 2 ',
                'description' => 'việc nhẹ lương cao 2',
                'price' => 10002,
                'address' => 'Đà Nẵng 2',
                'category_id' => 1,
                'helper_id' => 2
            ]);

    }
}
