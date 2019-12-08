<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Auth;
use Carbon\Carbon;

use App\User;
use App\Log;
class Level_Up_Test extends TestCase
{

    use RefreshDatabase;
    private $user;
    private $log;
    private $value;
    private $level;
    private $point;
    private $experience_point;
    
    // ./vendor/bin/phpunit tests/Feature/UserLogs/Level_Up_Test.php
    
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
        ]);
        
        // ログイン
        $current_user = User::where('id', $this->user->id )->first();
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
    }
    
        
    public function test__pintUp()
    {  
        
        $response = $this->Json('post','/api/logs/');
        $response->assertStatus(200);
        // ユーザーのポインとが上がっているか？
        
        $user = User::where('id', $this->user->id )->first();
        $this->assertEquals($user->level, $this->level );
        $this->assertEquals($user->point, $this->point + $this->value );
        $this->assertEquals($user->experience_point, $this->experience_point );
    }
    
    
    // このテストはどうするか？
    // public function test__LevelUp()
    // {  
    
        
    //     $response = $this->Json('post','/api/logs/');
    //     $response->assertStatus(200);
        
    //     $response = $this->Json('post','/api/logs/');
    //     $response->assertStatus(200);
    //     // ユーザーのポインとが上がっているか？
        
    //     // レベルアップしているか確認
    //     $user = User::where('id', $this->user->id )->first();
    //     $this->assertEquals($user->level, $this->level +1 );
    //     // $this->assertEquals($user->point, $this->point + $this->value );
    //     $this->assertEquals($user->experience_point, $this->experience_point +50);
    // }
    
}

// [user_id] => 1
// [month] => 12
// [day] => 3
// [time] => 20:36:26
// [updated_at] => 2019-12-03 20:36:26
// [created_at] => 2019-12-03 20:36:26
// [id] => 2
