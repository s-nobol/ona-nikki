<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\Auth;
use App\User;

class UserStatusTest extends TestCase
{
    
    
    use RefreshDatabase;
    private $user;
    private $data;
    private $second_user;


    public function setUp():void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->second_user = factory(User::class)->create();
        $this->actingAs($this->user);
        $this->data = [
                'age' => '', 
                'sex' => '', 
                'location' => '', 
                'career' => '',
            ];
    }
    
    /**
    * ./vendor/bin/phpunit tests/Feature/UserStatusTest.php
    * @test
    */
    public function Api_users_edit_ユーザー編集()
    {
        $data = $this->data;
        
        $this->assertTrue(Auth::check());
        
        
        
        // 有効なデータでログイン（年齢）
        $data['age'] = "18歳";
        $response = $this->json(  'PUT',   '/api/users/'.$this->user->id.'/status_update',
            $data );
        $response->assertStatus(422);
        
        
        // 有効なデータでログイン（性別）
        $data['sex'] = "男";
        $response = $this->json(  'PUT',   '/api/users/'.$this->user->id.'/status_update',
            $data );
        $response->assertStatus(422);
        
        $user = User::where('id', $this->user->id )->first();
        $this->assertEquals(false, $user->status_check);
        
        
        // 有効なデータでログイン（地域）
        $data['location'] = "北海道";
        $response = $this->json(  'PUT',   '/api/users/'.$this->user->id.'/status_update',
            $data );
        $response->assertStatus(200);
        
        
        $user = User::where('id', $this->user->id )->first();
        $this->assertEquals(true, $user->status_check);
        
        //成功
        $data['career'] = "高校";
        $response = $this->json(  'PUT',   '/api/users/'.$this->user->id.'/status_update',
            $data );
        $response->assertStatus(200);
        
        
        
        $user = User::where('id', $this->user->id )->first();
        $this->assertEquals(true, $user->status_check);
        
        //クライアントユーザーではない
        $response = $this->json(  'PUT',   '/api/users/'.$this->second_user->id.'/status_update',
            $data );
        
        $response->assertStatus(403);
        // $this->assertEquals($this->user->id, $this->second_user->id);
    }
}
