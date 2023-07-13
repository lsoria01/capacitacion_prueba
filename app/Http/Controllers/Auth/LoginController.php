<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLoginForm(){
        return view ('auth.login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'curp' => 'required | string',
            'password' => 'required | string'
        ]);
        if (Auth::attempt(['usuario' => $request->curp, 'password' => $request->password, 'estatus' => 1])){
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => trans('auth.failed')]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
