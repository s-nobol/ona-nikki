<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\User;
use App\Log;

class Url_User_Test extends TestCase
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
    
        
    // showは誰でもアクセスできる。
    public function test__api__show()
    {  
        $current_user = User::where('id', $this->user->id )->first();
        
        // ログインせずにアクセス
        $response = $this->get('/api/users/'.$current_user->id );
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        $response = $this->get('/api/users/'.$current_user->id );
        $response->assertStatus(200);
    }
    
        
    // show edit update delete
    public function test__api__update()
    {
        $current_user = User::where('id', $this->user->id )->first();
        
        // ログインせずにアクセス(はじかれる)
        $response = $this->get('/api/users/'.$current_user->id );
        $response->assertStatus(401);
        
        
        // ログインしてにアクセス
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        // べつのユーザーにアクセス(はじかれる)
        $response = $this->get('/api/users/'.$current_user->id );
        $response->assertStatus(403);
        
        $response = $this->get('/api/users/'.$current_user->id );
        $response->assertStatus(200);
    }
    
        
    // show edit update delete
    public function test__api__destroy()
    { 
        $current_user = User::where('id', $this->user->id )->first();
        
        // ログインせずにアクセス(はじかれる)
        $response = $this->get('/api/users/'.$current_user->id );
        $response->assertStatus(401);
        
        
        // ログインしてにアクセス
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        
        // べつのユーザーにアクセス(はじかれる)
        $response = $this->get('/api/users/'.$current_user->id );
        $response->assertStatus(403);
        
        $response = $this->get('/api/users/'.$current_user->id );
        $response->assertStatus(200);
        
        
        // 後日管理人以外アクセスできないようにする
        // $response = $this->get('/api/user/'.$current_user->id );
        // $response->assertStatus(200);
    }
    
    
    
    
}
