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
    
    
    public function setUp():void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->log = factory(Log::class)->create(['user_id' => $this->user->id ,]);  
    }
    
        
    // urlのテストなので中身については問わない
    public function test__api__Yeas__Log()
    {  
        $current_user = User::where('id', $this->user->id )->first();
      
        
        // ログインせずにアクセス
        $response = $this->get('/api/logs/2019' );
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        // ログインしてにアクセス
        $response = $this->get('/api/logs/2019' );
        $response->assertStatus(200);
    }
    
    public function test__api__month__Log()
    {  
        $current_user = User::where('id', $this->user->id )->first();
      
        
        // ログインせずにアクセス
        $response = $this->get('/api/logs/2019/1' );
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        // ログインしてにアクセス
        $response = $this->get('/api/logs/2019/1' );
        $response->assertStatus(200);
    }
    
    
    // urlのテストなので中身については問わない
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
    
    // urlのテストなので中身については問わない
    public function test__api__update()
    {  
      
        // ログインせずにアクセス
        $response = $this->put('/api/logs/'.$this->log);
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $current_user = User::where('id', $this->user->id )->first();
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        // ログインしてにアクセス
        $response = $this->put('/api/logs/'.$this->log);
        $response->assertStatus(200);
    }
    
    // urlのテストなので中身については問わない
    public function test__api__destroy()
    {  
      
        // ログインせずにアクセス
        $response = $this->delete('/api/logs/'.$this->log);
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $current_user = User::where('id', $this->user->id )->first();
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        // ログインしてにアクセス
        $response = $this->delete('/api/logs/'.$this->log);
        $response->assertStatus(200);
    }
    
}
