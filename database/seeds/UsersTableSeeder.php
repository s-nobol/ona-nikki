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
            
            'browsing_log' => false,
            'role' => 3 ,//ユーザーにレベル3の権限
        ]);
        
        // サブログインユーザー
        DB::table('users')->insert([
            'name' => '456456456',
            'email' => '456@example.com',
            'password' => bcrypt('456456456'),
            
            'browsing_log' => false,
            'role' => 2 , //管理者権限なし
        ]);
        
        // Log 50個
        factory(App\User::class, 100)->create()->each(function ($log) {});
    }
}
