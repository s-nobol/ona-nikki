<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    $sex=['男','女','その他'];
    $location = [ '北海道', '東北', '関東', '中部', '関西', '四国', '中国', '九州' ];
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        
        'age' => rand(10,15),
        'sex' => $sex[rand(0,2)],
        'location' => $location[rand(0,7)],
        
        'level' => 1,
        'point' => 50,
        'experience_point' => 300,
        'browsing_log' => false,
        
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
