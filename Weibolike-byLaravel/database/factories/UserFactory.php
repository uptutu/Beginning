<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    $date_time = $faker->date() . ' ' . $faker->time();
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'is_admin' => false,
        'password' => $password ?: $password = bcrypt('secrect'),
        'remember_token' => str_random(10),
        'created_at' => $date_time,
        'updated_at' => $date_time,
        'activated' => true,
    ];
});