<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\Auth;
use App\User;

class UserEditTest extends TestCase
{
    
    use RefreshDatabase;
    private $user;


    public function setUp():void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->actingAs($this->user);
    }
    
    /**
    * ./vendor/bin/phpunit tests/Feature/UserEditTest.php
    * @test
    */
    public function Api_users_edit_ユーザー編集()
    {
        $this->assertTrue(Auth::check());
        
        // 無効なデータでログイン
        $response = $this->json('PUT', '/api/users/'.$this->user->id, [
            'name' => '', 
            'age' => ' ', 
            'sex' => ' ', 
            'address' => '', 
            'theme' => '', 
            'receive_email' => true, 
        ]);
        
        $response->assertStatus(422);
        
        
        // 有効なデータでログイン
        $response = $this->json('PUT', '/api/users/'.$this->user->id, [
            'name' => 'name', 
            'email' => 'test@example.com', 
            'age' => 15, 
            'sex' => 'man', 
            'location' => 'tokyo', 
            'browsing_log' => false, 
            'receive_email' => true, 
            'theme' => 'red', 
        ]);
        

        $response->assertStatus(200);
        $response->assertJson(['name' =>'name']);

        $this->assertAuthenticatedAs($this->user);
        
        
        // ログアウト
        $response = $this->json('POST', '/api/logout');
        $response->assertStatus(200);
        $this->assertGuest($guard = null);

    }
}
