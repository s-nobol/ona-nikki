<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Auth;
use App\User;
use App\Notify;
use App\Log;

class Url_Notify_Test extends TestCase
{
    
    use RefreshDatabase;
    private $user;
    private $notify;
    
    /**
    *
    * / store / edit  / delete のみ利用
    * vendor/bin/phpunit/ 
    *  ./vendor/bin/phpunit tests/Unit/Url_Notify_Test.php
    */
    
    public function setUp():void
    {
        parent::setUp();
        $this->user = factory(User::class)->create([  'role' => 3  ]);
        $this->notify = factory(Notify::class)->create();
    }
    
    
    // notify作成
    public function test__api__store()
    {  
      
        // ログインせずにアクセス
        $response = $this->post('/api/notify');
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $current_user = User::where('id', $this->user->id )->first();
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        // ログインしてにアクセス
        $response = $this->post('/api/notify');
        $response->assertStatus(200);
    }   
    
    // notify作成
    public function test__api__edit()
    {  
      
        // ログインせずにアクセス
        $response = $this->post('/api/notify');
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $current_user = User::where('id', $this->user->id )->first();
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        // ログインしてにアクセス
        $response = $this->post('/api/notify');
        $response->assertStatus(200);
    }
    
    
    // notify編集
    public function test__api__update()
    {  
      
        // ログインせずにアクセス
        $response = $this->put('/api/notify/'.$this->notify->id);
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $current_user = User::where('id', $this->user->id )->first();
        // print_r($current_user->id , $this->notify->user());
        $this->actingAs($this->user);
        $this->assertTrue(Auth::check());
        
        // ログインしてにアクセス
        $response = $this->put('/api/notify/'.$this->notify->id);
        $response->assertStatus(200);
    }
    
    
    // notify削除
    public function test__api__destroy()
    {  
      
        // ログインせずにアクセス
        $response = $this->delete('/api/notify/'.$this->notify->id);
        $response->assertStatus(401);
        
        // ログインしてにアクセス
        $current_user = User::where('id', $this->user->id )->first();
        $this->actingAs($this->user);
        $this->assertTrue(Auth::check());
        
        // ログインしてにアクセス
        $response = $this->delete('/api/notify/'.$this->notify->id);
        $response->assertStatus(200);
    }
}
