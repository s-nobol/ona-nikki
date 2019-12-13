<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserStatusRequest;
class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
        $this->authorizeResource(User::class, 'user');  
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
    
    
    public function status_update(UserStatusRequest $request, User $user){
        
        (Auth::user()->id  == $user->id) ? 'Yes' : abort(403); // クライアントユーザーか確認
        
        $user = $user->fill($request->all());
        $user->save();
        $this->status_check($user);
        return $user;
    }
    
    //  php artisan make:test UserStatusTest  
    
    // ステータスを確認
    private function status_check(User $user){
        if($user->status_check){
            return false;
        }
        //年齢、性別　Locationが入力されている
        if($user->age && $user->sex && $user->location){
            $user->status_check = true;
            $user->save();
        }
    }
    
    
    
    
    
    
    // コインの合計を抽出する(後日削除)
    public function donation()
    {
        $string = 'coin';
        $logs = Auth::user()->logs()
            ->select(DB::raw('count(*) as count, '.$string.' as label'))
            ->groupBy($string)
            // ->sum('coin');
            // ->orderBy('sex','desc')
            ->get();
            
        $logs_sum = Auth::user()->logs()->sum('coin');
        
        
        return  compact('logs_sum','logs');
    }
    
    
    
}
