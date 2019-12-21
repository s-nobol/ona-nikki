<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use Illuminate\Support\Facades\Auth;
use App\Follow;
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'level','experience_point',
        'age','location','sex',
        'browsing_log','',
        'receive_email','theme',
        'oauth_image','oauth_check',
    ];
    
            
            
            

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'count' => 'integer',
        'email_verified_at' => 'datetime',
        'level' => 'integer',
        'point' => 'integer',
        'experience_point' => 'integer',
        'status_check' => 'boolean',
        'browsing_log' => 'boolean',
        
    ];
     protected $appends = [
         'followed_by_user',
    ];
    
    
    public function logs(){
        return $this->hasMany('App\Log');
    }
    
    
    //user.followers でuserがフォローしているユーザーを返す
    public function followers(){
        return $this->belongsToMany(self::class, 'App\Follow', 'user_id', 'followed_id');
    }
    
    
    
    /**
    * アクセサ - liked_by_user
    * @return boolean
    */
    public function getFollowedByUserAttribute()
    {
        
        if (Auth::guest()) {
            return false;
        }
        
        $follow = Follow::where('user_id',Auth::user()->id)->where('followed_id',$this->id)->first();
        if($follow){
            return true;
        }
        return false;
    }
}
