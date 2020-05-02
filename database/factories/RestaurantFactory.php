<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        'restaurantName' => $faker->company,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'deal' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'image' => 'https://via.placeholder.com/150'
    ];
});
