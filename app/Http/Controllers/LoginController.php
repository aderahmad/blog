<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function formLogin() {
        return view('login.form-login', [
            'title' => 'login',
        ]);
    }

    public function prosesLogin(Request $req) {

        request()->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $kredensil = $req->only([
            'email', 'password',
        ]);

        if(Auth::attempt($kredensil)){
            $req->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        
        return back()->with('login_gagal' , 'login failed');

            
    }
}
