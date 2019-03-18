<?php

namespace App;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use Sortable; 
    
    protected $fillable = [ 'device', ];

    /**
     * The attributes that may be sorted by.
     *
     * @var array
     */
    public $sortable = [ 'id', 'device', ];
}
