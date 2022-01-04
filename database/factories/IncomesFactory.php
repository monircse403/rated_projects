<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Incomes;
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

$factory->define(Incomes::class, function (Faker $faker) {
    return [
        'customer_id' => factory(App\Customers::class),
        'description' => $faker->text,
        'amount' => $faker->randomFloat(NULL, 1, NULL),
        'income_date' => $faker->date('Y-m-d'),
        'tax_year'   => $faker->year('now'),
    ];
});
