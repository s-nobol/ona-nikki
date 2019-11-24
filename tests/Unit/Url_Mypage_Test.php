<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Log;

class Url_Mypage_Test extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;
    private $user;
    private $log;
    
    
    public function setUp():void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->log = factory(Log::class)->create(['user_id' => $this->user->id ,]);  
    }
    
    
    public function test__mypageにアクセス()
    {  
        $current_user = User::where('id', $this->user->id )->first();
      
        
        // ログインせずにアクセス
        $response = $this->get('/api/mypage' );
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        // ログインしてにアクセス
        $response = $this->get('/api/mypage' );
        $response->assertStatus(200);
    }
    
        
    public function test__mypage_logs_2019にアクセス()
    {  
        $current_user = User::where('id', $this->user->id )->first();
      
        
        // ログインせずにアクセス
        $response = $this->get('/api/mypage/logs/2019' );
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        // ログインしてにアクセス
        $response = $this->get('/api/mypage/logs/2019' );
        $response->assertStatus(200);
    }  
    
    
    public function test__mypage_Logsにアクセス()
    {  
        $current_user = User::where('id', $this->user->id )->first();
      
        
        // ログインせずにアクセス
        $response = $this->get('/api/mypage/logs' );
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        // ログインしてにアクセス
        $response = $this->get('/api/mypage/logs' );
        $response->assertStatus(200);
    }
    
    
    public function test__mypage_questにアクセス()
    {  
        $current_user = User::where('id', $this->user->id )->first();
      
        
        // ログインせずにアクセス
        $response = $this->get('/api/mypage/quest' );
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        // ログインしてにアクセス
        $response = $this->get('/api/mypage/quest' );
        $response->assertStatus(200);
    }
}
