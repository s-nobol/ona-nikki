<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
class RegisterTest extends TestCase
{
    
    use RefreshDatabase;
    private $user;

   /**
    * ./vendor/bin/phpunit tests/Feature/LoginTest.php
     * @test
     */
    public function Api_で新規登録する()
    {   $data = [
            'name' => 'test_name',
            'email' => 'dummy@email.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
        ];
        
        $response = $this->json('POST', '/api/register', $data);
        
        // 正しい値が帰るか？
        $response->assertStatus(201);
        $response->assertJson([
            'name' => $data['name'],
            'email'=> $data['email'] 
        ]);
            
            
        $user = User::first();
        $this->assertEquals($data['name'], $user->name);
        

        $this->assertAuthenticatedAs($user);
        
        
        // ログアウト
        $response = $this->json('POST', '/api/logout');
        $response->assertStatus(200);
        $this->assertGuest($guard = null);;

    }
}
