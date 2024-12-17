<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UmkmController extends Controller
{
    public function index() : View
    {
        $umkms = Umkm::latest()->paginate(10);
        $no = ($umkms->currentPage() - 1) * $umkms->perPage() + 1; 
        return view('umkm.index' ,compact('umkms','no'));
    }

    public function create(): View
    {
        return view('umkm.create');
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'image'             => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama_umkm'         => 'required',
            'alamat'            => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->store('umkm','public');

        //create product
        Umkm::create([
            'image'          => $image->hashName(),
            'nama_umkm'      => $request->nama_umkm,
            'kategori'       => $request->kategori,
            'alamat'         => $request->alamat,
            'status'         => 'Belum Verifikasi'
        ]);

        //redirect to index
        return redirect()->route('umkm.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        //get product by ID
        $umkm = Umkm::findOrFail($id);

        //render view with product
        return view('umkm.show', compact('umkm'));
    }

    public function edit(string $id): View
    {
        //get product by ID
        $umkm = Umkm::findOrFail($id);

        //render view with umkm
        return view('umkm.edit', compact('umkm'));
    }


    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'image'         => 'image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric'
        ]);

        //get product by ID
        $umkm = Umkm::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->store('umkm','public');

            //delete old image
            Storage::delete('public/umkm/'.$umkm->image);

            //update product with new image
            $umkm->update([
                'image'         => $image->hashName(),
                'nama_umkm'     => $request->nama_umkm,
                'kategori'      => $request->kategori,
                'alamat'        => $request->alamat
            ]);

        } else {

            //update product without image
            $umkm->update([
               'nama_umkm'     => $request->nama_umkm,
                'kategori'      => $request->kategori,
                'alamat'        => $request->alamat
            ]);
        }

        //redirect to index
        return redirect()->route('umkm.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        //get product by ID
        $umkm = Umkm::findOrFail($id);

        //delete image
        // Storage::delete('public/products/'. $product->image);

        //delete product
        $umkm->delete();

        //redirect to index
        return redirect()->route('umkm.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
