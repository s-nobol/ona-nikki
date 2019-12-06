<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          // ログインユーザー
        DB::table('users')->insert([
            'name' => '123123123',
            'email' => '123@example.com',
            'password' => bcrypt('123123123'),
            
            'browsing_log' => true,
            // 'role' => 3 ,//ユーザーにレベル3の権限
        ]);
        // Log 50個
        factory(App\User::class, 100)->create()->each(function ($log) {});
    }
}
