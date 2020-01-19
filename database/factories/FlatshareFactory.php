<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Flatshare;
use Faker\Generator as Faker;

$factory->define(Flatshare::class, function (Faker $faker) {
    return [
        "name" => $faker->colorName,
        "tagid" => $faker->numberBetween(1000, 9999),
    ];
});
