<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UmkmController extends Controller
{
    public function index(): View
    {
        $umkms = Umkm::latest()->paginate(10);
        $no = ($umkms->currentPage() - 1) * $umkms->perPage() + 1;
        return view('umkm.index', compact('umkms', 'no'));
    }

    public function create(): View
    {
        return view('umkm.create');
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
            'status'         => 'Belum Verifikasi'
        ]);

        return redirect()->route('umkm.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        $umkm = Umkm::findOrFail($id);
        return view('umkm.show', compact('umkm'));
    }

    public function edit(string $id): View
    {
        $umkm = Umkm::findOrFail($id);
        return view('umkm.edit', compact('umkm'));
    }


    public function update(Request $request, $id): RedirectResponse
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

        return redirect()->route('umkm.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $umkm = Umkm::findOrFail($id);

        Storage::delete('public/umkm/' . $umkm->image);

        $umkm->delete();

        return redirect()->route('umkm.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function verifikasi($id)
    {
        // Cari UMKM berdasarkan ID
        $umkm = Umkm::findOrFail($id);

        // Ubah status menjadi "Terverifikasi"
        $umkm->status = 'Verifikasi';
        $umkm->save();

        // Redirect dengan pesan sukses
        return redirect()->route('umkm.index')->with('success', 'UMKM berhasil diverifikasi.');
    }
}
