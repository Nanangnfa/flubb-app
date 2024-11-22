<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected function redirectTo()
    {
        if (auth()->user()->hasRole('admin')) {
            return '/dashboard/admin';
        } elseif (auth()->user()->hasRole('influencer')) {
            return '/dashboard/influencer';
        } elseif (auth()->user()->hasRole('business')) {
            return '/dashboard/business';
        }

        return '/';
    }

    // Override logout untuk redirect
    protected function loggedOut(Request $request)
    {
        return redirect('/');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
