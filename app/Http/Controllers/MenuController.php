<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with('kategori')->where('tersedia', true);

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        $produks = $query->latest()->paginate(9)->withQueryString();
        $kategoris = Kategori::withCount(['produks' => function ($q) {
            $q->where('tersedia', true);
        }])->get();

        return view('menu.index', compact('produks', 'kategoris'));
    }

    public function show($slug)
    {
        $produk = Produk::with('kategori')->where('slug', $slug)->firstOrFail();
        $related = Produk::with('kategori')
            ->where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $produk->id)
            ->where('tersedia', true)
            ->take(3)
            ->get();

        return view('menu.show', compact('produk', 'related'));
    }
}
