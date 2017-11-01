<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $timestamps=false;

    protected $fillable=[
        'st_id','sub_id','fromdate','todate','totalclasses','attended','massbunk','fac_id',
    ];

    protected $hidden = [

    ];
}
