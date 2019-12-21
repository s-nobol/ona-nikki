<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\Auth;

use App\User;
use App\Log;
class Url_Follow_Test extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $otheruser;
    private $log;
    
    /**
    *
    * / store / edit  / delete のみ利用
    *  ./vendor/bin/phpunit tests/Unit/Url_Follow_Test.php
    */
    
    public function setUp():void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->otheruser = factory(User::class)->create();
        // $this->log = factory(Log::class)->create(['user_id' => $this->user->id ,]);  
    }
    
    
    // フォロー
    public function test__api__following()
    {  
      
        // ログインせずにアクセス
        $response = $this->post('/api/follow/'.$this->otheruser->id);
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $current_user = User::where('id', $this->user->id )->first();
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        
        
        // エラーアクセス
        $response = $this->post('/api/follow/'.$this->user->id);
        $response->assertStatus(403);
        
        
        // エラーアクセス
        $response = $this->post('/api/follow/'.$this->otheruser->id);
        $response->assertStatus(200);
    }
    
    
    
    // フォロー解除
    public function test__api__follow__delete()
    {  
      
        // ログインせずにアクセス
        $response = $this->delete('/api/follow/'.$this->otheruser->id);
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $current_user = User::where('id', $this->user->id )->first();
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        
        
        // エラーアクセス
        $response = $this->post('/api/follow/'.$this->user->id);
        $response->assertStatus(403);
        
        
        // エラーアクセス
        $response = $this->post('/api/follow/'.$this->otheruser->id);
        $response->assertStatus(200);
    }
    
}