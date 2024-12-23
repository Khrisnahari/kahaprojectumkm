<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index():View {
        $owner = Auth::guard('owner')->user(); // Ambil owner yang sedang login
         return view('profile.index', compact('owner'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Ambil data owner yang sedang login
        $owner = Auth::guard('owner')->user();

        $owner = Owner::findOrFail($id);
    
        // Update data owner
        $owner->update([
            'username'     => $request->username,
            'email'        => $request->email,
            'namalengkap'  => $request->namalengkap,
            'no_telp'      => $request->no_telp,
        ]);
    
        return redirect()->route('kelolaumkm.index')->with('success', 'Profile berhasil diperbarui!');
    }
    
    
}
