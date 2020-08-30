<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'phone'=>$faker->unique()->phoneNumber,
        'avatar'=>$faker->imageUrl(),
        'district_id'=>$district=districtSeed(),
        'ward_id'=>wardSeed($district),
        'listJob'=>rand(1,3).rand(4,7).rand(8,10),
        'avgRate'=>5,
        'status'=>0,

    ];
});
$factory->define(\App\Models\Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'is_active'=>0,
        'avatar'=>$faker->imageUrl(),
        'phone'=>$faker->unique()->phoneNumber,
        'district_id'=>$district=districtSeed(),
        'ward_id'=>wardSeed($district),
    ];
});
$factory->define(\App\Models\Post::class, function (Faker $faker) {
    $status=rand(0,7);
    if ($status>=3){
        $employee_id=rand(1,10);
    }else{
        $employee_id=null;
    }
    $start_date = strtotime(now()->subDay(rand(0,15)));
    $end_date = strtotime(now()->addDay(rand(0,15)));
    $val =rand($start_date,$end_date);
    $dateTime = new DateTime(date('Y-m-d H:i:s', $val));
    $start=$dateTime->format('Y-m-d H:i:s');
    $endTime=$dateTime->add(new DateInterval('PT'.rand(2,6).'H'));
    $end=  $endTime->format('Y-m-d H:i:s');
    return [
        'title' => $faker->name,
        'description' => $faker->text,
        'price'=>rand(100,200),
        'status'=>$status,
        'district_id'=>$district=districtSeed(),
        'ward_id'=>wardSeed($district),
        'time_start'=>$start,
        'time_end' => $end,
        'addressDetails'=>$faker->address,
        'category_id'=>rand(1,10),
        'employee_id'=>$employee_id,
        'customer_id'=>rand(1,10),
    ];
});

