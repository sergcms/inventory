<?php

namespace App;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use Sortable;
    
    protected $fillable = [ 
        'department', 'address', 'user_id',
    ];

    /**
     * The attributes that may be sorted by.
     *
     * @var array
     */
    public $sortable = [
        'id', 'department', 'address', 'user.name', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function card()
    {
        return $this->hasOne('App\Card');
    }
}
