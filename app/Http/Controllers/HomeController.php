<?php

namespace App\Http\Controllers;

use App\Models\ProdukUmkm;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function home(): View {
        // Ambil produk dan kategori terkait
        $produk = ProdukUmkm::select('produk.*', 'umkm.kategori')
            ->join('umkm', 'umkm.owner_id', '=', 'produk.owner_id') // Join tabel produk dengan umkm
            ->orderBy('umkm.kategori') // Urutkan berdasarkan kategori
            ->orderBy('produk.id', 'desc') // Urutkan berdasarkan produk ID
            ->get();
    
        // Kelompokkan berdasarkan kategori
        $groupedByKategori = $produk->groupBy('kategori');
    
        // Atur urutan kategori, "Makanan" terlebih dahulu
        $groupedByKategori = $groupedByKategori->sortBy(function ($products, $kategori) {
            return $kategori === 'Makanan' ? 0 : 1; // "Makanan" diberi prioritas tertinggi
        });
    
        // Terapkan pola zigzag untuk setiap kategori
        $groupedByKategori = $groupedByKategori->map(function ($produks) {
            return $this->applyZigzag($produks); // Terapkan fungsi zigzag pada setiap kategori
        });
    
        // Kirim data ke view
        return view('home', compact('groupedByKategori'));
    }
    
    // Fungsi untuk menerapkan pola zigzag
    protected function applyZigzag($produks)
    {
        $zigzag = [];
        $maxLength = $produks->count();
        for ($i = 0; $i < $maxLength; $i++) {
            if ($i % 2 === 0) {
                $zigzag[] = $produks->shift(); // Ambil produk pertama
            } else {
                $zigzag[] = $produks->pop(); // Ambil produk terakhir
            }
        }
        return collect($zigzag); // Kembalikan sebagai koleksi
    }
}
