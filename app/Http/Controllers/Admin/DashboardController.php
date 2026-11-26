<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk   = Produk::count();
        $totalKategori = Kategori::count();
        $produkTersedia = Produk::where('tersedia', true)->count();
        $produkTerbaru  = Produk::with('kategori')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProduk', 'totalKategori', 'produkTersedia', 'produkTerbaru'
        ));
    }
}
