<?php

use Illuminate\Database\Seeder;

class LogssTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        // Log 50個
        factory(App\Log::class, 3000)->create()->each(function ($log) {});
    }
}
