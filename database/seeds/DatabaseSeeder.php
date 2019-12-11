<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
            
        $this->call([
            UsersTableSeeder::class,
            CategoryTableSeeder::class,
            LogssTableSeeder::class,
            NotifiesTableSeeder::class,
        ]);
        
// $ php artisan make:seed LogssTableSeeder
// $ php artisan db:seed
    }
}
