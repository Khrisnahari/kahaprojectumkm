<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Owner;
use App\Models\Pembeli;
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

    public function registrasipembeli() {
        return view ('registrasipembeli');
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

        if (Auth::guard('pembeli')->attempt($credentials)) {
            $request->session()->regenerate();
            
            $totalItems = Cart::where('pembeli_id', Auth::guard('pembeli')->user()->id)->sum('quantity');
            session(['cart.totalItems' => $totalItems]);

            // Cek apakah ada parameter redirect
            $redirectUrl = $request->input('redirect', route('home'));
    
            return redirect($redirectUrl);
        }
    
 
        return back()->withErrors([
            'username' => 'Username salah!',
        ])->onlyInput('username');
    }

    public function prosesRegistrasi(Request $request)
    {
        $request->validate([
            'namalengkap'     => 'required',
            'email'   => 'required|email',
            'username'     => 'required|min:5',
            'no_telp'     => 'required|numeric',
            'password'   => 'required|min:5',
        ], [
            'namalengkap.required'        => 'Nama Lengkap tidak boleh kosong',
            'email.required'    => 'Email tidak boleh kosong',
            'username.required'       => 'Username tidak boleh kosong',
            'no_telp.required' => 'Nomor Telepon tidak boleh kosong',
            'no_telp.numeric'  => 'Nomor Telepon harus berupa angka',
            'password.required' => 'Password tidak boleh kosong',
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


    public function prosesRegistrasiPembeli(Request $request)
    {
        $request->validate([
            'namalengkap'     => 'required',
            'email'   => 'required|email',
            'username'     => 'required|min:5',
            'no_telp'     => 'required|numeric',
            'alamat'     => 'required',
            'password'   => 'required|min:5',
        ], [
            'namalengkap.required'        => 'Nama Lengkap tidak boleh kosong',
            'email.required'    => 'Email tidak boleh kosong',
            'username.required'       => 'Username tidak boleh kosong',
            'no_telp.required' => 'Nomor Telepon tidak boleh kosong',
            'no_telp.numeric'  => 'Nomor Telepon harus berupa angka',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        $pembeli = new Pembeli([
            'username'   => $request->username,
            'password' => Hash::make($request['password']),
            'email' => $request->email,
            'namalengkap' => $request->namalengkap,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat

        ]);
        $pembeli->save();

        return redirect()->route('login')->with('success', 'Registrasi Berhasil. Silahkan login!');
    }

    public function logout(Request $request) : RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/home');
    }

}
