<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    public function registrasi() {
        return view('registrasi');
    }

    public function prosesLogin(Request $request) : RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
    
            return redirect()->intended('dashboard');
        }

        if (Auth::guard('owner')->attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('kelolaumkm');
        }
 
        return back()->withErrors([
            'username' => 'Username salah!',
        ])->onlyInput('username');
    }

    public function prosesRegistrasi(Request $request)
    {
        $request->validate([
            'email'   => 'required|email',
            'username'     => 'required|min:5',
            'password'   => 'required|min:5',
        ]);

        $owner = new Owner([
            'username'   => $request->username,
            'password' => Hash::make($request['password']),
            'email' => $request->email,
            'namalengkap' => $request->namalengkap,
            'no_telp' => $request->no_telp

        ]);
        $owner->save();

        return redirect()->route('login')->with('success', 'Registrasi Berhasil. Silahkan login!');
    }

    public function logout(Request $request) : RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
