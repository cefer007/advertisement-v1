<?php

namespace App\Http\Controllers\dashboard\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('dashboard.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $check = Auth::attempt(['email'=> $request->email, 'password'=> $request->password]);
        if(!$check){
            return to_route('dashboard.login')->with('error', 'Email or password is wrong');
        }

        return to_route('dashboard.home')->with('success', 'Login successfully');
    }


    public function logout()
    {
        auth()->logout();
        return to_route('dashboard.login');
    }
}
