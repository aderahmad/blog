<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function formRegister() {
        return view('login.form-register', [
            'title' => 'register'
        ]);
    }

    public function prosesRegister(Request $req) {
        try {
            $this->validate($req, [
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:penggunas',
                'email' => 'required|email|unique:penggunas',
                'password' => 'required|string|min:8',
            ]);
    
            $datas = $req->all();
            $save_data = new Pengguna;
            $save_data->name = $datas['name'];
            $save_data->username = $datas['username'];
            $save_data->email = $datas['email'];
            $save_data->password = Hash::make($datas['password']);
            $save_data->save();
            return redirect()->route('register.form-register')->with('success',__('berhasil mendaftar'));
        } catch (\Throwable $th) {
            return redirect()->route('register.form-register')->with('error',__($th->getMessage()));
        }
    }
}
