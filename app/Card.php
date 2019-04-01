<?php

namespace App;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use Sortable;
    
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
        'user_id',
    ];

    /**
     * The attributes that may be sorted by.
     *
     * @var array
     */
    public $sortable = [
        'id',
        'inventory', 
        'model',
        'movement', 
        'condition',
        'department_id',
        'device.device',
        'department.department'
    ];

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function device()
    {
        return $this->belongsTo('App\Device');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
