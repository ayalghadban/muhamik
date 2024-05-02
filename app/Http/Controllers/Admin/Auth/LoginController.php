<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;
    public  function __construct (private AuthService $service){
    }

    public function login(Request $request)
    {
        $data = $this->service->loginAdmin($request);
        if($data == 0)
        return redirect()->
                back()->
                withInput($request->only('email','password','remember'))->withErrors([
                        'email' =>'please enter correct email address',
                        'password' =>'please enter password']);
        else
            return view('index');
    }

}
