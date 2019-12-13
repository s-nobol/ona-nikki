<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


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
        'browsing_log' => 'boolean',
    ];
    
    
    public function logs(){
        return $this->hasMany('App\Log');
    }
}
