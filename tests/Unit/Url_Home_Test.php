<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\Auth;

class Url_Home_Test extends TestCase
{
    
    use RefreshDatabase;
    
    private $user;
    private $log;
    
    /**
     * 
     * ./vendor/bin/phpunit tests/Unit/Url_Home_Test.php
     * 
     * /
    
    public function setUp():void
    {
        parent::setUp();
        // ログイン用のユーザー
        // $this->user = factory(User::class)->create();
        
    }
        
    public function test__home__index()
    {
        
        // ログインせずにアクセス
        $response = $this->json('get', '/api/home' );
        $response->assertStatus(200);
        
        
    }
    
    
    
    // エリア
    
    // 性別
    
    // ランキング
    
    
    
    /**
    *
    * Api 用のルーティングテスト
    * 
    **/
    public function test__api__home__year()
    {
        //エラーデータ
        $response = $this->json('get', '/api/logs/test2019' );
        $response->assertStatus(404);
        
        //成功
        $response = $this->json('get', '/api/logs/2019' );
        $response->assertStatus(200);
    }
    
    public function test__api__home__month()
    {
        //エラーデータ
        $response = $this->json('get', '/api/logs/2019/test' );
        $response->assertStatus(404);
        
        //成功
        $response = $this->json('get', '/api/logs/2019/5' );
        $response->assertStatus(200);
    }
    
    // // 年
    // public function test__home__year()
    // {
    //     //エラーデータ
    //     $response = $this->get('/test2019');
    //     $response->assertStatus(404);
        
    //     //成功
    //     $response = $this->get('/2019');
    //     $response->assertStatus(200);
    // }
    // // 月
    // public function test__home__month()
    // {
    //     // エラーデータ
    //     $response = $this->get('/2019/test');
    //     $response->assertStatus(404);
        
        
    //     //成功
    //     $response = $this->get('/2019/1');
    //     $response->assertStatus(200);
    // }
}
