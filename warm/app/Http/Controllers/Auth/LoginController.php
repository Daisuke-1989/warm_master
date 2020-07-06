<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Inst;
use App\Event;
use App\Inst_user;
use App\Student;
use App\Http\Controllers\Controller;
use App\vender\OtherAuthenticatesUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    use OtherAuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function redirectTo(){
        $type = $this->guard()->user()->type;
        if($type === 1){
            return '/home';//viewsでreturnはできない。errorとなる。
        }
        if($type === 2){
            return '/insts';
        }
        if($type === 3){
            return '/students';
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
