<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function getLogin()
    {
        //dd(Hash::make('admin2')); bam mat khau 
        return view('enduser.login');
    }


    public function postLogin(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($data)) {
            return redirect('/home');
        } else {
            return redirect('/login/index')->with('error', 'Error login !');
        }
    }
    public function postLogout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect('/home');
    }
}
