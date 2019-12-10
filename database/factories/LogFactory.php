<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Log;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Log::class, function (Faker $faker) {
   return [
        'user_id' => rand(1,99),
        'month' => rand(1,12),
        'day' => rand(1,30),
        'time' => rand(0,23),
        'category' => rand(1,5),
        'coin' => rand(0,15),
        'created_at' =>  Carbon::create(rand(2018,2019),rand(1,12)),
    ];
});
