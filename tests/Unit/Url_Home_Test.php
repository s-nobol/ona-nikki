<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\Auth;

class Url_Home_Test extends TestCase
{
    
    use RefreshDatabase;
    
    private $flamer;
    private $category;
    private $user;
    
    
    public function setUp():void
    {
        parent::setUp();
        // $category = factory(Category::class)->create();
        // $flamer = factory(Flamer::class)->create(['category_id' => 1,]);  
        
        // ログイン用のユーザー
        // $this->user = factory(User::class)->create();
        
    }
        
    public function test__home__index()
    {
        
        // ログインせずにアクセス
        // $response = $this->get('/api/home');
        $response = $this->get('/home');
        $response->assertStatus(200);
        
        
    }
    
    
    // 年
    public function test__home__year()
    {
        //エラーデータ
        $response = $this->get('/test2019');
        $response->assertStatus(404);
        
        //成功
        $response = $this->get('/2019');
        $response->assertStatus(200);
    }
    // 月
    public function test__home__month()
    {
        // エラーデータ
        $response = $this->get('/2019/test');
        $response->assertStatus(404);
        
        
        //成功
        $response = $this->get('/2019/1');
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
    // public function test__api__home__year()
    // {
    //     $response = $this->get('/api/2019');
    //     $response->assertStatus(200);
    // }
    
    // public function test__api__home__month()
    // {
    //     $response = $this->get('/api/2019/1');
    //     $response->assertStatus(200);
    // }
    
}
