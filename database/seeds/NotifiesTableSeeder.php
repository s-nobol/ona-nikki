<?php

use Illuminate\Database\Seeder;

class NotifiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=NotifiesTableSeeder
     * @return void
     */
    public function run()
    {
        // Notify 15個
        factory(App\Notify::class, 5)->create()->each(function ($notify) {});
    }
}
