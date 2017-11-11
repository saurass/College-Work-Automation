<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pro_debarred extends Model
{
    public $timestamps=false;

    protected $fillable=[
        'st_id','exam','sub',
    ];

    protected $hidden = [

    ];
}
