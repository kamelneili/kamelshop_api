<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        //
        "product_name" => $faker->sentence,
        "qty" => $faker->numberBetween($min = 1, $max = 10),
        "price" => $faker->numberBetween($min = 100, $max = 900),
        "total" => $faker->numberBetween($min = 1000, $max = 9000),
        "user_id" => $faker->numberBetween($min = 1, $max = 10)
    ];
});
