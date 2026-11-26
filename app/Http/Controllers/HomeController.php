<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProduks = Produk::with('kategori')
            ->where('tersedia', true)
            ->where('featured', true)
            ->latest()
            ->take(6)
            ->get();

        $totalProduks = Produk::where('tersedia', true)->count();
        $kategoris = Kategori::withCount('produks')->get();

        return view('home', compact('featuredProduks', 'totalProduks', 'kategoris'));
    }
}
