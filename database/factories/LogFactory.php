<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Log;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Log::class, function (Faker $faker) {
   return [
        'user_id' => 1,
        'time' => rand(0,23),
        'month' => rand(1,12),
        'created_at' =>  Carbon::create(rand(2017,2020),rand(1,12)),
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