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
        'department_id'
    ];
}
