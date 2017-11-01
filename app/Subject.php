<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $timestamps = false;
    //
    protected $fillable=[
        'sub_id', 'sub_name', 'branch','category','semester',
    ];

    protected $hidden = [
        'marks',
    ];
}
