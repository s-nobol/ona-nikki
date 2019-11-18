<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\User;
use Hash;
use Auth;

class OAuthController extends Controller
{
    
    
     /**
     * $OAuthの認証ページヘユーザーをリダイレクト
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($OAuth)
    {
        // return Socialite::driver($OAuth)->redirect();
        return Socialite::driver($OAuth)->redirect()->getTargetUrl();

    }



    /**
     * $OAuthからユーザー情報を取得
     *try今度いれる
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($OAuth)
    {
        
        $socialUser  = Socialite::driver($OAuth)->user();
        
        $user = User::where([ 'email' => $socialUser->getEmail() ])->first();


        if ($user) {
            Auth::login($user);
        } else {
            $user = User::create([
                'name' => $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'oauth_check' => true,
                // 'password' => Hash::make($socialUser->getNickname()),  // すべてのアカウントで共通する
            ]);
            
            Auth::login($user);
        }
        
        return Auth::user();
    }
}
// getId()
// getNickname()
// getName()
// getEmail()
// getAvatar()
// $user->token;