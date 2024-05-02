<?php


namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{

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

            return $data;
        }
        return 0;
    }

}