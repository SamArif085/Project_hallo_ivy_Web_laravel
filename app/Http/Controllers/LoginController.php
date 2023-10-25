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
            'password' => 'required',
        ]);

        if (Auth::attempt($ambilData)) {
            $request->session()->regenerate();
            if (Auth::user()->role == 1) {
                return redirect()->intended('dashboardAdmin');
            }
            if (Auth::user()->role == 2) {
                return redirect()->intended('dashboard');
            }
        }
        return back()->with('error', 'Gagal Login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
