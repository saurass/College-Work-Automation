<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Facultylogin;
use Auth;
use Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    // public function username()
    // {
    //     return 'username';
    // }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/studentpage';
    protected function redirectTo()
        {   

            $user=Auth::user();
            $username=$user->username;
            $type=Facultylogin::select('category','branch')->where('userid',$username)->first();

            session(['username' => $username]);
               
                if($type==NULL){
                    session(['usertype' => "STUDENT"]);
                    return '/studentpage';
                }
                else{
                     session(['usertype' => $type->category]);
                     
                    if($type->category=="ADMIN"){
                        return '/adminpage';
                    }
                    else{
                        session(['branch' => $type->branch]);


                        if($type->category=="HOD")

                            return '/hodpage';
                        else 
                            return '/facultypage';
                        }

                        
                       
                    }

            
        }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
