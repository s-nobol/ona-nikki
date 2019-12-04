<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Http\Requests\UserRequest;
class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
        $this->authorizeResource(User::class, 'user');  
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // return view('user.show')->with([ 'user' => $user ]);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return view('user.edit')->with([ 'user' => $user ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user = $user->fill($request->all());
        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    
    // リセット
    public function resetlevel(User $user)
    {
        $user->level = 1;
        $user->point = 0;
        $user->experience_point = 300;
        $user->save();
        return "ユーザーレベルリセットしました";
    }
    
    // レベルアップ
    public function levelup(Request $request, User $user)
    {   
        // ゲージの残りを返却
        $user->level = $user->level + 1; 
        $user->point = $request->point;
        $user->experience_point = $user->experience_point + 50 ;
        $user->save();
        return $user;
    }
    
    
    
    // レベルアップ
    public function addPoint(Request $request, User $user)
    {   
        // ゲージの残りを返却
        $point = 50;
        $before_point = $user->point;
        $before_experience_point = $user->experience_point;
        $before_level = $user->level;
        
        // ポイントを追加
        $user->point = $before_point + $point ;
        
        // レベルアップの場合
        if ($before_point+$point > $before_experience_point ) {
            $user->level = $user->level + 1 ;  //level-up
            $user->point = $before_point+$point - $before_experience_point; //( 300+50 ) - 300 => 50 
            $user->experience_point = $before_experience_point + 50 ;
            $point = $before_experience_point - $before_point;
        }
        $user->save();
    }
    
    
}
