<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfilePembeliController extends Controller
{
    public function index() : View {
        $pembeli = Auth::guard('pembeli')->user();
        return view('profile-pembeli.index' , compact('pembeli'));
    }

    public function update(Request $request , string $id)
    {
        $pembeli = Auth::guard('pembeli')->user();

        $pembeli = Pembeli::findOrFail($id);

        // Update data
        $pembeli->update([
            'namalengkap' => $request->namalengkap,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('profilepembeli')->with('success', 'Profil berhasil diperbarui!');
    }
}
