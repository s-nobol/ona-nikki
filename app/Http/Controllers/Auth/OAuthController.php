<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;
use Hash;
// use Auth;

class OAuthController extends Controller
{
    
    // use AuthenticatesUsers;
    
     /**
     * $OAuthの認証ページヘユーザーをリダイレクト
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($OAuth)
    {
        return Socialite::driver($OAuth)->redirect()->getTargetUrl();
    }



    /**
     * $OAuthからユーザー情報を取得
     *　try今度いれる
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($OAuth)
    {
        
        $socialUser = Socialite::driver($OAuth)->user();
        
        $user = User::where([ 'email' => $socialUser->getEmail() ])->first();
        
        

        if ($user) {
            auth()->login($user, true);
            // Auth::login($user);
        } else {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                // 'password' => $socialUser->getEmail(),
                'oauth_image' => $socialUser->avatar_original,
                'oauth_check' => true,
                'password' => Hash::make($socialUser->getName()),  // すべてのアカウントで共通する
            ]);
            
            auth()->login($user, true);
        }
        
        return Auth::user();
    }
    
    
}