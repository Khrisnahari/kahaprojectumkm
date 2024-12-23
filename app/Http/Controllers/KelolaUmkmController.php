<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\View\View;

class KelolaUmkmController extends Controller
{
    public function index():View {
       // Ambil ID owner yang sedang login
        $ownerId = FacadesAuth::guard('owner')->user()->id;

        // Ambil UMKM yang terkait dengan owner tersebut
        $umkms = Umkm::where('owner_id', $ownerId)->latest()->get();

        return view('kelola-umkm.index', compact('umkms'));
    }

    public function create(): View
    {
        return view('kelola-umkm.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image'             => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama_umkm'         => 'required',
            'alamat'            => 'required',
            'deskripsi_umkm'    => 'required'
        ], [
            'image.required'        => 'Gambar wajib diunggah.',
            'image.image'           => 'File harus berupa gambar.',
            'image.mimes'           => 'Format gambar harus jpeg, jpg, atau png.',
            'image.max'             => 'Ukuran gambar maksimal 2MB.',
            'nama_umkm.required'    => 'Nama UMKM tidak boleh kosong.',
            'alamat.required'       => 'Alamat wajib diisi.',
            'deskripsi_umkm.required' => 'Tentang UMKM tidak boleh kosong.'
        ]);


        //upload image
        $image = $request->file('image');
        $image->store('umkm', 'public');

        Umkm::create([
            'image'          => $image->hashName(),
            'nama_umkm'      => $request->nama_umkm,
            'kategori'       => $request->kategori,
            'alamat'         => $request->alamat,
            'deskripsi_umkm' => $request->deskripsi_umkm,
            'status'         => 'Belum Verifikasi',
            'owner_id'       => FacadesAuth::guard('owner')->user()->id
        ]);

        return redirect()->route('kelolaumkm.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
