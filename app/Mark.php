<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    public $timestamps=false;

    protected $fillable=[
        'st_id','sub_id','marks_obtained','max_mark','examname'
    ];

    protected $hidden = [

    ];
}
