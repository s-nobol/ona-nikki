<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Log;
use Faker\Generator as Faker;

$factory->define(Log::class, function (Faker $faker) {
   return [
        'user_id' => 1,
        'time' => $faker->time,
    ];
});
// $table->time('time');

// $table->string('category')->nullable();
// $table->string('comment')->nullable();
// // $table->string('taime')->nullable(); 費やした時間

// $table->timestamps();


// // User
// $table->bigInteger('user_id')->unsigned();
// $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');