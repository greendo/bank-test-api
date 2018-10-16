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

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'cnp' => $faker->boolean
    ];
});

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomFloat(0, 1000),
        'limit' => $faker->randomFloat(0, 1000),
        'customer_id' => random_int(0, 5)
    ];
});