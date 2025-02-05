<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BeritaController extends Controller
{
    /**
     * Tampilkan form tambah berita.
     */
    public function create()
    {
        return view('berita.create');
    }

    /**
     * Simpan berita ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'halaman' => 'required',
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
            'video' => 'nullable|url|regex:/^(https:\/\/www\.youtube\.com\/embed\/)/',
        ]);
    
        // Upload gambar jika ada
        $gambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $gambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $gambar);
        }
    
        // Simpan data ke database
        Berita::create([
            'halaman' => $request->halaman,
            'judul' => $request->judul,
            'konten' => $request->konten,
            'gambar' => $gambar,
            'video' => $request->video,
        ]);
    
        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }
    

    /**
     * Tampilkan daftar berita.
     */
        public function index()
        {
            $beritas = Berita::all();
            return view('berita.index', compact('beritas'));
        }


    /**
     * Hapus berita.
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
    
        // Hapus gambar jika ada
        if ($berita->gambar && file_exists(public_path('uploads/' . $berita->gambar))) {
            unlink(public_path('uploads/' . $berita->gambar));
        }
    
        $berita->delete();
    
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'halaman' => 'required',
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'video' => 'nullable|url|regex:/^(https:\/\/www\.youtube\.com\/embed\/)/',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $berita = Berita::findOrFail($id);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar && file_exists(public_path('uploads/' . $berita->gambar))) {
                unlink(public_path('uploads/' . $berita->gambar));
            }

            $file = $request->file('gambar');
            $gambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $gambar);
            $berita->gambar = $gambar;
        }

        // Update data lainnya
        $berita->update([
            'halaman' => $request->halaman,
            'judul' => $request->judul,
            'konten' => $request->konten,
            'video' => $request->video,
            'gambar' => $berita->gambar ?? $berita->gambar,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id); // Ambil berita berdasarkan ID, jika tidak ditemukan akan error 404

        // Increment jumlah pembaca
        $berita->increment('views');

        return view('berita.show', compact('berita'));
    }

    public function showBerita($id)
    {
        $berita = Berita::findOrFail($id); // Ambil berita berdasarkan ID, jika tidak ditemukan akan error 404

        // Increment jumlah pembaca
        $berita->increment('views');

        return view('berita.showBerita', compact('berita'));
    }


    public function daftarBerita() : View {
         // Ambil semua berita dari database
         $beritas = Berita::latest()->paginate(10);

         // Kirim ke view
         return view('berita.daftar-berita', compact('beritas'));
    }
}
