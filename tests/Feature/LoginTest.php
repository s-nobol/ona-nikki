<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    
    
    use RefreshDatabase;
    private $user;


    public function setUp():void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }
    
    

    /**
    * ./vendor/bin/phpunit tests/Feature/LoginTest.php
    * @test
    */
    public function Api_でログインする()
    {
        
        // 無効なデータでログイン
        $response = $this->json('POST', '/api/login', [
            'email' => 'email@test.com', 
            'password' => 'testest'
        ]);
        
        $response->assertStatus(422);
        $this->assertGuest($guard = null);;
        
        
        // 有効なデータでログイン
        $response = $this->json('POST', '/api/login', [
            'email' => $this->user->email, 
            'password' => 'password'
        ]);
        

        $response
            ->assertStatus(200)
            ->assertJson(['name' => $this->user->name]);

        $this->assertAuthenticatedAs($this->user);
        
        
        // ログアウト
        $response = $this->json('POST', '/api/logout');
        $response->assertStatus(200);
        $this->assertGuest($guard = null);

    }
    
    
    
    // Remenber_meを利用したログイン
    // public function Api_でログインする()
    // {
    //     $response = $this->json('POST', '/api/login', [
    //         'email' => $this->user->email, 
    //         'password' => 'password'
    //     ]);
        

    //     $response
    //         ->assertStatus(200)
    //         ->assertJson(['name' => $this->user->name]);

    //     $this->assertAuthenticatedAs($this->user);
        
        
    //     // ログアウト
    //     $response = $this->json('POST', '/api/logout');
    //     $response->assertStatus(200);
    //     $this->assertGuest($guard = null);;

    // }
}
