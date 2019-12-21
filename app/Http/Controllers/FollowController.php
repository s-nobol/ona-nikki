<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;
use DB;

use App\User;
class FollowController extends Controller
{
    
    
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function show(Follow $follow)
    {
    }
    public function store(Request $request, User $user)
    {
        
        $this->check_auth($user);
        Follow::firstOrCreate([
            'user_id' => Auth::id(),
            'followed_id' => $user->id,
        ]);
        
        return response()->json(['result' => true]);
        
    }



    public function destroy(User $user)
    {
        $this->check_auth($user); 
        
        $user = Auth::user()->followers()->detach($user->id);
        
        return response()->json(['result' => true]);

    }
    
    // ユーザーIdと同じならはじく
    private function check_auth(User $user){
        if($user->id == Auth::user()->id){
            abort(403);
        }
    }
}
