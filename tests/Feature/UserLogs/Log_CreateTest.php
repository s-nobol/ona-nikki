<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Auth;
use Carbon\Carbon;

use App\User;
use App\Log;
class Log_CreateTest extends TestCase
{

    use RefreshDatabase;
    private $user;
    private $log;
    
    // ./vendor/bin/phpunit tests/Feature/Log_CreateTest.php
    
    public function setUp():void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->log = factory(Log::class)->create(['user_id' => $this->user->id ,]);  
        
        
        // ログイン
        $current_user = User::where('id', $this->user->id )->first();
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
    }
    
        
    // urlのテストなので中身については問わない
    public function test__api__create_Log()
    {  
        // ログイン
        $current_user = User::where('id', $this->user->id )->first();
        $this->actingAs($current_user);
        $this->assertTrue(Auth::check());
        
        $log_count = Log::all()->count();
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $time = Carbon::create()->hour;
        
        $response = $this->json('post', '/api/logs' );
        $response->assertStatus(200);
        
        // Logが新しく作成されているか・
        $this->assertEquals($log_count+1,  Log::all()->count());
        
        // Jsonに希望の値が帰ってきているか？
        $response->assertJson([
            'logs' => [],
        ]);
    }
    
    public function test__api__update_Log()
    {  
        $log_count = Log::all()->count();
        $month = Carbon::create()->month;
        $time = Carbon::create()->hour;
        
        $log_id = $this->log->id;
        $text = "これはテストコメントです" ;
        
        $response = $this->putJson('/api/logs/'.$log_id , ['comment' => $text ]);
        $response->assertStatus(200);
        
        // Jsonに希望の値が帰ってきているか？
        // $response->assertJson([
        //     'comment' => $text,
        // ]);
    }
}
