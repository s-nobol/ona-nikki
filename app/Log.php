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
        'count' => 'integer',
        'check' => 'boolean',
        'created_at' => 'datetime:Y年m月d日',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
