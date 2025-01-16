<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    public function index() : View {

        $pembelis = Pembeli::latest()->paginate(10);
        $no = ($pembelis->currentPage() - 1) * $pembelis->perPage() + 1;

        return view('pembeli.index', compact('pembelis','no'));
    }

    public function destroy($id): RedirectResponse
    {
        $pembeli = Pembeli::findOrFail($id);

        // Storage::delete('public/umkm/' . $umkm->image);

        $pembeli->delete();

        return redirect()->route('pembeli.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}
