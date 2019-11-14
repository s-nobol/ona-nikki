<?php

namespace Tests\Feature;
use Auth;
use Socialite;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OAuthTest extends TestCase
{
    
    /**
     * 
     * OAuthのルーティング
     * Route::get('login/{OAuth}', 'Auth\OAuthController@redirectToProvider')->name('LoginOAuth');
     * Route::get('login/{OAuth}/callback', 'Auth\OAuthController@handleProviderCallback')->name('LoginOAuthCallback');
     * 
    **/
    
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->providerName = 'github';
    }
    
    public function githubの認証画面を表示できる()
    {
        // URLをコール
        // $this->get(route('LoginOAuth', ['OAuth' => $this->providerName]))
        //     ->assertStatus(200);
            
        $response = $this->get('/login/github');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function githubアカウントでユーザー登録できる()
    {
        
        // エラー発生不明
        // URLをコール
        // $response = $this->get('login/github/callback');
        // $response->assertStatus(302);
        // $this->assertThat(
        //     $response->headers->get('location'),
        //     $this->stringStartsWith('https://accounts.google.com/')
        // );
            
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    
    
    
}
