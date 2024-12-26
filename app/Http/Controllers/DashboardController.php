<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Mengambil jumlah total UMKM
        $totalUmkm = Umkm::count();

        // Mengambil jumlah UMKM yang sudah diverifikasi
        $totalVerifikasiUmkm = Umkm::where('status', 'Verifikasi')->count();

        // Mengambil jumlah UMKM yang belum diverifikasi
        $totalBelumverifikasiUmkm = Umkm::where('status', '!=', 'Verifikasi')->count();

        return view('dashboard.index', compact('totalUmkm', 'totalVerifikasiUmkm', 'totalBelumverifikasiUmkm'));
    }
}
