<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    public function redirectTo() {

        switch(Auth::user()->role) {
            case 1:
                return $this->redirectTo = '/admin';
                break;

            case 2:
                return $this->redirectTo = '/super-admin';
                break;

            default:
                return $this->redirectTo = '/login';
                break;
        }
    }
    
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }
}
