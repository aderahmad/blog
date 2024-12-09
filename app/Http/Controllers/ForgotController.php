<?php

namespace App\Http\Controllers;

use App\Mail\ForgotMail;
use App\Models\Pengguna;
use App\Models\PasswordResetTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



class ForgotController extends Controller
{
    public function formForgot() {
        return view('login.form-forgot');
    }

    public function processForgot(Request $req) {
        $this->validate($req, [
            'email' => 'required|string|email'
        ]);

        try {
            $datas = $req->all();
            $getData = Pengguna::where('email', $datas['email'])->first();
            if(empty($getData)) {
                return redirect()->route('forgot.form-forgot')->with('error', __('email salah'));
            }
            $token = Str::random(54);
            $dataPasswordResetTokens = PasswordResetTokens::where('email', $datas['email'])->first();
            if(!empty($dataPasswordResetTokens)){
                PasswordResetTokens::where('email', $datas['email'])->delete();
            }
            $datasToken = new PasswordResetTokens;
            $datasToken->email = $datas['email'];
            $datasToken->token = $token;
            $datasToken->created_at = date('Y-m-d H:i:s');
            $datasToken->save();

            $dataEmail = [
                'nama_pengguna' => $getData->name,
                'url_reset' => env('APP_URL') . '/forgot/reset-password/' . $token,
            ];

            Mail::to($datas['email'])->send(new ForgotMail($dataEmail));

            return redirect()->route('forgot.form-forgot')->with('success', __('Silahkan periksa emial Anda'));
        } catch (\Throwable $th) {
            return redirect()->route('forgot.form-forgot')->with('error', __($th->getMessage()));
        }
    }

    public function resetPassword($token) {
        $dataReset = PasswordResetTokens::where('token', $token)->whereDate('created_at', '=', date('Y-m-d'))->first();
        if(empty($dataReset)) {
            return redirect()->route('forgot.form-forgot')->with('error',__('Token tidak valid'));
        }
        $token = $token;
        $email = $dataReset->email;

        return view('login.form-atur-ulang-password', compact('email', 'token'));
    }

    public function prosesResetPassword(Request $req)
    {

        $this->validate($req, [
            'password' => 'required|string|min:8|confirmed',
        ]);

        $datas = $req->all();
        Pengguna::where('email', $datas['email'])->update([
            'password' => Hash::make($datas['password'])
        ]);

        passwordResetTokens::where('email', $datas['email'])->delete();

        return redirect()->route('login.form-login')->with('success', __('Reset password sukses'));
    }
}
