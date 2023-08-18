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
        // $username = $request->username;
        // $password = $request->password;

        $ambilData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($ambilData)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->with('error', 'Gagal Login');
    }

    public function apiLogin(Request $request)
    {

        // $data = array(
        //     'contoh' => 'contoh API',
        // );

        // return response()->json($data);

        $ambilData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($ambilData)) {
            $request->session()->regenerate();

            $data = array(
                'status' => 'success',
                'message' => 'Berhasil Login',
                'value' => [
                    'id' => Auth::user()->id,
                    'name' => Auth::user()->name,
                    'username' => Auth::user()->username,
                ]
            );

            return response()->json($data, 200);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
