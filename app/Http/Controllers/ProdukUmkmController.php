<?php

namespace App\Http\Controllers;

use App\Models\ProdukUmkm;
use App\Models\Umkm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProdukUmkmController extends Controller
{
    public function index() : View {
        // Ambil ID owner yang sedang login
        $ownerId = Auth::guard('owner')->user()->id;
        $produks = ProdukUmkm::where('owner_id', $ownerId)->latest()->paginate(10);
        $no = ($produks->currentPage() - 1) * $produks->perPage() + 1;
        return view('produk.index',compact('produks', 'no'));
    }

    public function create() : View {
        $umkm = Umkm::where('owner_id', Auth::guard('owner')->user()->id)->first();
        return view('produk.create',compact('umkm'));
    }

    public function store(Request $request): RedirectResponse {

        $umkm = Umkm::where('owner_id', Auth::guard('owner')->user()->id)->first();
        
        $request->validate([
            'image'             => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama_produk'       => 'required',
            'deskripsi'         => 'required|string|max:65535',
            'harga'             => 'required',
            'stok' => $umkm->kategori === 'Fashion' ? 'required|numeric' : 'nullable',
        ], [
            'image.required'            => 'Gambar wajib diunggah.',
            'image.image'               => 'File harus berupa gambar.',
            'image.mimes'               => 'Format gambar harus jpeg, jpg, atau png.',
            'image.max'                 => 'Ukuran gambar maksimal 2MB.',
            'nama_produk.required'      => 'Nama Produk tidak boleh kosong.',
            'deskripsi.required'        => 'Deskripsi tidak boleh kosong.',
            'harga.required'            => 'Harga tidak boleh kosong.',
            'stok.required'             => 'Stok tidak boleh kosong.'
        ]);


        //upload image
        $image = $request->file('image');
        $image->store('produk', 'public');

        $stok = $umkm->kategori === 'Fashion' ? $request->stok : 0;

        ProdukUmkm::create([
            'image'             => $image->hashName(),
            'nama_produk'       => $request->nama_produk,
            'deskripsi'         => $request->deskripsi,
            'harga'             => $request->harga,
            'stok'              => $stok,
            'owner_id'          => Auth::guard('owner')->user()->id
        ]);

        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        $produk = ProdukUmkm::findOrFail($id);
        $umkm = Umkm::where('owner_id', Auth::guard('owner')->user()->id)->first();
        return view('produk.show', compact('produk','umkm'));
    }

    public function edit(string $id): View
    {
        $produk = ProdukUmkm::findOrFail($id);
        $umkm = Umkm::where('owner_id', Auth::guard('owner')->user()->id)->first();
        return view('produk.edit', compact('produk','umkm'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $umkm = Umkm::where('owner_id', Auth::guard('owner')->user()->id)->first();
        $request->validate([
            'nama_produk'       => 'required',
            'deskripsi'         => 'required|string|max:65535',
            'harga'             => 'required',
            'stok' => $umkm->kategori === 'Fashion' ? 'required|numeric' : 'nullable',
        ], [
            'nama_produk.required'      => 'Nama Produk tidak boleh kosong.',
            'deskripsi.required'        => 'Deskripsi tidak boleh kosong.',
            'harga.required'            => 'Harga tidak boleh kosong.',
            'stok.required'             => 'Stok tidak boleh kosong.'
        ]);


        $produk = ProdukUmkm::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->store('produk', 'public');

            //delete old image
            Storage::delete('public/produk/' . $produk->image);

            $stok = $umkm->kategori === 'Fashion' ? $request->stok : 0;

            $produk->update([
                'image'             => $image->hashName(),
                'nama_produk'       => $request->nama_produk,
                'deskripsi'         => $request->deskripsi,
                'harga'             => $request->harga,
                'stok'              => $stok,
                'owner_id'          => Auth::guard('owner')->user()->id
            ]);
        } else {

            $stok = $umkm->kategori === 'Fashion' ? $request->stok : 0;

            $produk->update([
                'nama_produk'       => $request->nama_produk,
                'deskripsi'         => $request->deskripsi,
                'harga'             => $request->harga,
                'stok'              => $stok,
                'owner_id'          => Auth::guard('owner')->user()->id
            ]);
        }

        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


    public function destroy($id): RedirectResponse
    {
        $produk = ProdukUmkm::findOrFail($id);

        Storage::delete('public/produk/' . $produk->image);

        $produk->delete();

        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
