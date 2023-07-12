<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('login', $data);
    }

    public function cekLogin(Request $request)
    {
        $ambilData = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($ambilData)){
            $request->session()->regenerate();
            return redirect()->to('dashboard');
        }

        return back()->with('error', 'Gagal Login');
    }
}
