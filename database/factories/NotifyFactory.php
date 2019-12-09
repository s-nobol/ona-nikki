<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Notify;
use Faker\Generator as Faker;

$factory->define(Notify::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->sentence,
    ];
});
