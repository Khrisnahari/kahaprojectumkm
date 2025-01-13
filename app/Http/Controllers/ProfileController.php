<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Umkm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $umkm = Umkm::where('owner_id', Auth::guard('owner')->id())->first();
        return view('profile.index', compact('umkm'));
    }

    public function detailUmkm(string $id): View
    {
        $umkm = Umkm::with('owner')->findOrFail($id);
        return view('profile.detail-umkm', compact('umkm'));
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

        return redirect()->route('profile.index')->with('success', 'Profile berhasil diperbarui!');
    }

    public function updateUmkm(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'image'             => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama_umkm'         => 'required',
            'alamat'            => 'required',
            'deskripsi_umkm'    => 'required'
        ]);

        $umkm = Umkm::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->store('umkm', 'public');

            //delete old image
            Storage::delete('public/umkm/' . $umkm->image);

            $umkm->update([
                'image'         => $image->hashName(),
                'nama_umkm'     => $request->nama_umkm,
                'kategori'      => $request->kategori,
                'alamat'        => $request->alamat,
                'deskripsi_umkm' => $request->deskripsi_umkm
            ]);
        } else {

            $umkm->update([
                'nama_umkm'     => $request->nama_umkm,
                'kategori'      => $request->kategori,
                'alamat'        => $request->alamat,
                'deskripsi_umkm' => $request->deskripsi_umkm
            ]);
        }

        return redirect()->route('detailumkm', ['id' => $umkm->id])->with(['success' => 'Data Berhasil Diubah!']);
    }
}
