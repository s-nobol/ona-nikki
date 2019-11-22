<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    protected $fillable = [
        'time', 'category', 'comment',
    ];    
    protected $casts = [
        'count' => 'int',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
