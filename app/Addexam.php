<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addexam extends Model
{
    public $timestamps=false;

    protected $fillable=[
        'exam_name','branch','semester','status','max_mark',
    ];

    protected $hidden = [

    ];
}
