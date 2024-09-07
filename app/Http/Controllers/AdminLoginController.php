<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    public function showloginform()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = request(['phone_number', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect('business');
            }
            else{
                return response()->json('you are not an admin');
            }
        }
        return redirect('login_form');
    }

    public function logout()
    {
        Session::flush();

        return redirect('login_form');
    }

}
