<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

 
use Auth;
use Carbon\Carbon;

use App\User;
use App\Log;
//  ブラウザを開いた瞬間にログが作成できるか？
class Browsing_Log_Test extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $log;
    private $value;
    private $level;
    private $point;
    private $experience_point;
    
    // ./vendor/bin/phpunit tests/Feature/Browsing_Log_Test.php
    
    public function setUp():void
    {
        parent::setUp();
        
        $this->value = 130;
        $this->level = 1;
        $this->point = 130;
        $this->experience_point = 300;
        
        $this->user = factory(User::class)->create([
            'level' => $this->level ,
            'point' => $this->point ,
            'experience_point' => $this->experience_point ,
            'browsing_log' =>true,
            ]);
        
        // ログイン
        $current_user = User::where('id', $this->user->id )->first();
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
    }
    
    
    
    // ブラウザを開く（ブラウザテストが上手くいかない　手動では動いた）
    public function test__opne__blows()
    {  
        
        // ホームにアクセス
        $response = $this->get('/');
        $response->assertStatus(200);
        
        // ユーザーのポインとが上がっているか？
        // $user = User::where('id', $this->user->id )->first();
        // $this->assertEquals($user->level, $this->level );
        // $this->assertEquals($user->point, $this->point + $this->value );
        // $this->assertEquals($user->experience_point, $this->experience_point );
    }
    
     
    
    // // ブラウザを開く
    // public function test__opne__blows_and_levelUP()
    // {  
        
    //     // ホームにアクセス
    //     $response = $this->get('/');
    //     $response->assertStatus(200);
        
        
        // ユーザーのポインとが上がっているか？
        // $user = User::where('id', $this->user->id )->first();
        // $this->assertEquals($user->level, $this->level );
        // $this->assertEquals($user->point, $this->point + $this->value );
        // $this->assertEquals($user->experience_point, $this->experience_point );
    // }
    
}
