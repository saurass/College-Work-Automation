<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps=false;

    protected $fillable=[
        'st_id','name','semester','section','branch','OE1','OE2','OE3',
    ];

    protected $hidden = [

    ];
}
