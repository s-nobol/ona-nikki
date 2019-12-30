<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    
    
    protected $fillable = [
        'name', 'color', 
    ];      
    protected $casts = [
        'created_at' => 'datetime:Y年m月d日',
    ];
}
