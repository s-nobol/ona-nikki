<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\Auth;

use App\User;
use App\Log;
use App\Follow;
class Follow_Test extends TestCase
{

    use RefreshDatabase;
    private $user;
    private $otheruser;
    private $log;
    private $follow;
    
    /**
    *
    * / store / edit  / delete のみ利用
    *  ./vendor/bin/phpunit tests/Feature/Follow_Test.php
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
      
        
        // ログイン
        $current_user = User::where('id', $this->user->id )->first();
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        $follow_count = Follow::where('user_id', $this->user->id )->get()->count();
        
        
        // Follow追加
        $response = $this->post('/api/follow/'.$this->otheruser->id);
        $response->assertStatus(200);
        
        
        
        // ユーザーのフォロワーは増えているか？
        $follow_count2 = Follow::where('user_id', $this->user->id )->get()->count();
        $this->assertEquals($follow_count+1, $follow_count2);
      
      
      
        // Follow削除
        $response = $this->delete('/api/follow/'.$this->otheruser->id);
        $response->assertStatus(200);
        
        
        
        // ユーザーのフォロワーは減っている？
        $delete_follow_count = Follow::where('user_id', $this->user->id )->get()->count();
        $this->assertEquals($follow_count, $delete_follow_count);
    }
    
    
    
    // 同じ相手に複数フォローできない？
    public function test__api__user_on_Follow()
    {
        
        // ログイン
        $current_user = User::where('id', $this->user->id )->first();
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        $follow_count = Follow::where('user_id', $this->user->id )->get()->count();
        
        
        // Follow追加
        $response = $this->post('/api/follow/'.$this->otheruser->id);
        $response->assertStatus(200);
        
        
        
        // ユーザーのフォロワーは増えているか？
        $follow_count2 = Follow::where('user_id', $this->user->id )->get()->count();
        $this->assertEquals($follow_count+1, $follow_count2);
      
      
      
        // Follow追加（フォローはできない）
        $response = $this->post('/api/follow/'.$this->otheruser->id);
        $response->assertStatus(200);
        
        
        
        // ユーザーのフォロワーは減っている？
        $delete_follow_count = Follow::where('user_id', $this->user->id )->get()->count();
        $this->assertEquals($follow_count+1, $delete_follow_count);
    }
}
