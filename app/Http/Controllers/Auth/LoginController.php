<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function loginAdmin(Request $request)
    {
        $data = [];
        $credentials = $request->only(['email', 'password']);
        if(Auth::guard('admin')->attempt($credentials))
        {
            $admin = Auth::guard('admin')->user();

          $token = $admin->createToken('MyApp', ['admin'])->plainTextToken;

            if (!$token)
                return false;

            $admin->role_type = "admin";

            $data['token'] = $token;

            $data['user'] = $admin;

            return view('index');
        }

        return view('auth.login');
    }

}
