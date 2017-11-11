<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debarred extends Model
{
    public $timestamps=false;

    protected $fillable=[
        'st_id','exam',
    ];

    protected $hidden = [

    ];
}
