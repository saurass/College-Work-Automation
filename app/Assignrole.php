<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignrole extends Model
{
    //
    public $timestamps=false;

    protected $fillable=[
        'user_id', 'sub_id', 'fac_id', 'fac_id_2', 'lab_assistant_id' ,'branch','semester','section','exam1','exam2','exam3','exam4','exam5'
    ];

    protected $hidden = [

    ];
}
