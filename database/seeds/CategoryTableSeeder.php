<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CategoryTableSeeder
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [ 'name' => '素人',      'color' => 'crimson'],
            [ 'name' => '女子大生',  'color' => 'lightskyblue'],
            [ 'name' => 'ギャル',    'color' => 'sienna'],
            [ 'name' => 'おねえさん','color' => 'tomato'],
            [ 'name' => 'OL',        'color' => 'mediumpurple'],
            [ 'name' => '巨乳',      'color' => 'lavender'],
            [ 'name' => 'のぞき',    'color' => 'salmon'],
            [ 'name' => 'ロリ',      'color' => 'oldlace'],
            [ 'name' => '盗撮',      'color' => 'lightslategray'],
            [ 'name' => '企画',      'color' => 'lightyellow'],
            
        ]);
    }
}
