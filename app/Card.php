<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [ 
        'inventory', 
        'model', 
        'characteristic', 
        'movement', 
        'condition', 
        'photo', 
        'comment',
        'department_id',
        'device_id',
    ];
}
