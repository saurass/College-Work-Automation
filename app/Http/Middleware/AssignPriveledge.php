<?php

namespace App\Http\Middleware;

use App\Facultylogin;
use Closure;
use Illuminate\Support\Facades\Redirect;

class AssignPriveledge
{
    public function handle($request, Closure $next)
    {
        $username=session('username');
        $category=Facultylogin::where('userid',$username)->first()->category;
        if($category=='HOD' || $category=='ADMIN'||$category=='FACULTY')
        {
            return $next($request);
        }
        else
        {
            return redirect('/home');
        }
    }
}
