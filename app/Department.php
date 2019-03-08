<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [ 
        'department', 'address', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
