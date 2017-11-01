<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllowMenu extends Model
{
    //
    public $timestamps=false;

    protected $fillable=[
        'update_subject','delete_subject','delete_student','view_elective','add_subject','assign_role','assign_elective','add_student'
    ];

    protected $hidden = [

    ];
}
