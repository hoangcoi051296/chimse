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
        'ward_id'=>null,
        'district_id'=>null,
    ];
});
$factory->define(\App\Models\Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'is_active'=>0,
        'phone'=>$faker->unique()->phoneNumber,
        'ward_id'=>null,
        'district_id'=>null,
    ];
});
$factory->define(\App\Models\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->text,
        'price'=>random_int(100,1000),
        'status'=>random_int(0,7),
        'ward_id'=>null,
        'district_id'=>null,
        'category_id'=>random_int(1,10),
        'employee_id'=>random_int(1,10),
        'customer_id'=>random_int(1,10),
    ];
});
$factory->define(\App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
