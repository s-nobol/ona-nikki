<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Log;

class Url_Log_Test extends TestCase
{
    
    use RefreshDatabase;
    private $user;
    private $log;
    
    /**
    *
    * / store / edit  / delete のみ利用
    * 
    */
    
    public function setUp():void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->log = factory(Log::class)->create(['user_id' => $this->user->id ,]);  
    }
    
    
    // Log作成
    public function test__api__create()
    {  
      
        // ログインせずにアクセス
        $response = $this->post('/api/logs');
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $current_user = User::where('id', $this->user->id )->first();
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        // ログインしてにアクセス
        $response = $this->post('/api/logs');
        $response->assertStatus(200);
    }
    
    
    // Log編集
    public function test__api__update()
    {  
      
        // ログインせずにアクセス
        $response = $this->put('/api/logs/'.$this->log->id);
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $current_user = User::where('id', $this->user->id )->first();
        // print_r($current_user->id , $this->log->user());
        $this->actingAs($this->user);
        $this->assertTrue(Auth::check());
        
        // ログインしてにアクセス
        $response = $this->put('/api/logs/'.$this->log->id);
        $response->assertStatus(200);
    }
    
    
    // Log削除
    public function test__api__destroy()
    {  
      
        // ログインせずにアクセス
        $response = $this->delete('/api/logs/'.$this->log->id);
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $current_user = User::where('id', $this->user->id )->first();
        $this->actingAs($this->user);
        $this->assertTrue(Auth::check());
        
        // ログインしてにアクセス
        $response = $this->delete('/api/logs/'.$this->log->id);
        $response->assertStatus(200);
    }
    
}
