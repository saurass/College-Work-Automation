<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ufm extends Model
{
     public $timestamps=false;

    protected $fillable=[
        'st_id','exam','sub',
    ];

    protected $hidden = [

    ];
}
