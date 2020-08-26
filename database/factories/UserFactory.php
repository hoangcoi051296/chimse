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
        $employee_id=rand(1,50);
    }else{
        $employee_id=null;
    }
    return [
        'title' => $faker->name,
        'description' => $faker->text,
        'price'=>rand(100,200),
        'status'=>$status,
        'district_id'=>$district=districtSeed(),
        'ward_id'=>wardSeed($district),
        'addressDetails'=>$faker->address,
        'category_id'=>rand(1,10),
        'employee_id'=>$employee_id,
        'customer_id'=>rand(1,50),
    ];
});

