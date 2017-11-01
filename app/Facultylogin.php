<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facultylogin extends Model
{
public $timestamps=false;
   protected $fillable=['userid', 'password', 'category','name','branch'];




}
