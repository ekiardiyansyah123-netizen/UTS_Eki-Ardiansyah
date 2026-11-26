
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AdminAuthController;

/*
|--------------------------------------------------------------------------
| HELPER: MENGAMBIL DATA PRODUK DARI DATABASE
|--------------------------------------------------------------------------
*/

$getProducts = function () {

    $rows = DB::table('produks')
        ->leftJoin('kategoris', 'produks.kategori_id', '=', 'kategoris.id')
        ->select(
            'produks.*',
            'kategoris.nama as kategori_nama'
        )
        ->orderBy('produks.id', 'desc')
        ->get();

    return $rows->map(function ($row) {

        return [
            'id' => $row->id,
            'name' => $row->nama,
            'category' => $row->kategori_nama ?? 'Uncategorized',
            'price' => $row->harga,
            'stock' => $row->stok,
            'description' => $row->deskripsi,
            'image' => $row->gambar
                ? Storage::url($row->gambar)
                : 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=800&q=85',
        ];

    })->toArray();

};


/*
|--------------------------------------------------------------------------
| WEBSITE PENGUNJUNG
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', function () use ($getProducts) {

    $products = $getProducts();

    return view('home', compact('products'));

})->name('home');


// Katalog menu
Route::get('/menu', function () use ($getProducts) {

    $products = $getProducts();

    return view('menu', compact('products'));

})->name('menu');


// Detail produk
Route::get('/menu/{id}', function ($id) use ($getProducts) {

    $products = $getProducts();

    $product = collect($products)->firstWhere('id', (int) $id);

    if (!$product) {
        abort(404);
    }

    return view('detail', compact('product', 'products'));

})->name('product.detail');


// About
Route::get('/about', function () {
    return view('about');
})->name('about');


// Contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');


/*
|--------------------------------------------------------------------------
| ADMIN LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'authenticate'])
    ->name('admin.authenticate');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');


/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD & CRUD PRODUK
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () use ($getProducts) {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () use ($getProducts) {

        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $products = $getProducts();

        return view('admin.dashboard', compact('products'));

    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | DAFTAR PRODUK
    |--------------------------------------------------------------------------
    */

    Route::get('/products', function () use ($getProducts) {

        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $products = $getProducts();

        return view('admin.products', compact('products'));

    })->name('products');


    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH PRODUK
    |--------------------------------------------------------------------------
    */

    Route::get('/products/create', function () {

        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $product = null;

        return view('admin.form', compact('product'));

    })->name('products.create');


    /*
    |--------------------------------------------------------------------------
    | SIMPAN PRODUK BARU
    |--------------------------------------------------------------------------
    */

    Route::post('/products', function () {

        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        request()->validate([
            'name' => 'required|string|max:150',
            'category' => 'required|in:Coffee,Non Coffee',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Cari kategori
        $category = DB::table('kategoris')
            ->where('nama', request('category'))
            ->first();

        if (!$category) {
            return back()
                ->withInput()
                ->withErrors(['category' => 'Kategori tidak ditemukan di database.']);
        }

        // Upload gambar jika tersedia
        $imagePath = null;

        if (request()->hasFile('image')) {
            $imagePath = request()->file('image')->store('products', 'public');
        }

        // Simpan produk ke database
        DB::table('produks')->insert([
            'nama' => request('name'),
            'kategori_id' => $category->id,
            'harga' => request('price'),
            'stok' => request('stock'),
            'deskripsi' => request('description'),
            'gambar' => $imagePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('admin.products')
            ->with('success', 'Produk berhasil ditambahkan!');

    })->name('products.store');


    /*
    |--------------------------------------------------------------------------
    | FORM EDIT PRODUK
    |--------------------------------------------------------------------------
    */

    Route::get('/products/{id}/edit', function ($id) use ($getProducts) {

        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $products = $getProducts();

        $product = collect($products)->firstWhere('id', (int) $id);

        if (!$product) {
            abort(404);
        }

        return view('admin.form', compact('product'));

    })->name('products.edit');


    /*
    |--------------------------------------------------------------------------
    | UPDATE PRODUK
    |--------------------------------------------------------------------------
    */

    Route::put('/products/{id}', function ($id) {

        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $product = DB::table('produks')->where('id', $id)->first();

        if (!$product) {
            abort(404);
        }

        request()->validate([
            'name' => 'required|string|max:150',
            'category' => 'required|in:Coffee,Non Coffee',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $category = DB::table('kategoris')
            ->where('nama', request('category'))
            ->first();

        if (!$category) {
            return back()
                ->withInput()
                ->withErrors(['category' => 'Kategori tidak ditemukan.']);
        }

        // Pertahankan gambar lama
        $imagePath = $product->gambar;

        // Jika upload gambar baru
        if (request()->hasFile('image')) {

            // Hapus gambar lama jika berasal dari storage
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = request()->file('image')
                ->store('products', 'public');
        }

        DB::table('produks')
            ->where('id', $id)
            ->update([
                'nama' => request('name'),
                'kategori_id' => $category->id,
                'harga' => request('price'),
                'stok' => request('stock'),
                'deskripsi' => request('description'),
                'gambar' => $imagePath,
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('admin.products')
            ->with('success', 'Produk berhasil diperbarui!');

    })->name('products.update');


    /*
    |--------------------------------------------------------------------------
    | HAPUS PRODUK
    |--------------------------------------------------------------------------
    */

    Route::delete('/products/{id}', function ($id) {

        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $product = DB::table('produks')
            ->where('id', $id)
            ->first();

        if (!$product) {
            abort(404);
        }

        // Hapus gambar dari storage jika ada
        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }

        DB::table('produks')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('admin.products')
            ->with('success', 'Produk berhasil dihapus!');

    })->name('products.destroy');

});