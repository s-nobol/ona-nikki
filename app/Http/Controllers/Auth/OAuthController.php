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
     * GitHubの認証ページヘユーザーをリダイレクト
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($OAuth)
    {
        return Socialite::driver($OAuth)->redirect();
    }



    /**
     * GitHubからユーザー情報を取得
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($OAuth)
    {
        
        $socialUser  = Socialite::driver($OAuth)->user();
        
        // メールアドレスからユーザーを探す
        $user = User::where([ 'email' => $socialUser->getEmail() ])->first();

        if ($user) {
            Auth::login($user);
            return redirect('/home');
        } else {
            $user = User::create([
                'name' => $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                // 'password' => Hash::make($socialUser->getNickname()),  // 例としての記述なので、マネしないように
            ]);
            
            // ユーザーの作成
            // dd("ユーザーの作成");
            Auth::login($user);
            return redirect('/home');
        }
        
        return redirect()->route('home');
    }
}


// getId()
// getNickname()
// getName()
// getEmail()
// getAvatar()
// $user->token;