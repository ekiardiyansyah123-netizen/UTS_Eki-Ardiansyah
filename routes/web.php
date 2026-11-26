
<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| DATA PRODUK ESSENZA COFFEE (DEMO)
|--------------------------------------------------------------------------
| Data sementara. Nantinya akan diganti dengan database MySQL.
*/

$products = [
    [
        'id' => 1,
        'name' => 'Espresso',
        'category' => 'Coffee',
        'price' => 25000,
        'stock' => 20,
        'description' => 'Espresso klasik dengan karakter rasa yang kuat, aroma khas kopi, dan crema yang lembut.',
        'image' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=800&q=85',
    ],
    [
        'id' => 2,
        'name' => 'Cappuccino',
        'category' => 'Coffee',
        'price' => 35000,
        'stock' => 15,
        'description' => 'Perpaduan espresso, susu steamed, dan foam lembut dengan cita rasa seimbang.',
        'image' => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?auto=format&fit=crop&w=800&q=85',
    ],
    [
        'id' => 3,
        'name' => 'Cafe Latte',
        'category' => 'Coffee',
        'price' => 32000,
        'stock' => 18,
        'description' => 'Espresso dengan susu creamy yang menghasilkan rasa lembut dan nikmat.',
        'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&w=800&q=85',
    ],
    [
        'id' => 4,
        'name' => 'Caramel Macchiato',
        'category' => 'Coffee',
        'price' => 38000,
        'stock' => 12,
        'description' => 'Minuman kopi dengan susu creamy dan sentuhan karamel manis yang memanjakan.',
        'image' => 'https://images.unsplash.com/photo-1485808191679-5f86510681a2?auto=format&fit=crop&w=800&q=85',
    ],
    [
        'id' => 5,
        'name' => 'Matcha Latte',
        'category' => 'Non Coffee',
        'price' => 35000,
        'stock' => 14,
        'description' => 'Matcha pilihan yang dipadukan dengan susu untuk menghasilkan rasa earthy dan creamy.',
        'image' => 'https://images.unsplash.com/photo-1515823064-d6e0c04616a7?auto=format&fit=crop&w=800&q=85',
    ],
    [
        'id' => 6,
        'name' => 'Chocolate Latte',
        'category' => 'Non Coffee',
        'price' => 33000,
        'stock' => 10,
        'description' => 'Cokelat premium dengan susu segar, cocok untuk menemani waktu santai.',
        'image' => 'https://images.unsplash.com/photo-1544787219-7f47payload?auto=format&fit=crop&w=800&q=85',
    ],
];


/*
|--------------------------------------------------------------------------
| WEBSITE PENGUNJUNG
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', function () use ($products) {
    return view('home', compact('products'));
})->name('home');


// Katalog menu
Route::get('/menu', function () use ($products) {
    return view('menu', compact('products'));
})->name('menu');


// Detail produk
Route::get('/menu/{id}', function ($id) use ($products) {

    $product = collect($products)->firstWhere('id', (int) $id);

    if (!$product) {
        abort(404);
    }

    return view('detail', compact('product', 'products'));

})->name('product.detail');


// About / Our Story
Route::get('/about', function () {
    return view('about');
})->name('about');


// Contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');


/*
|--------------------------------------------------------------------------
| ADMIN ESSENZA COFFEE
|--------------------------------------------------------------------------
| Dashboard dan manajemen produk sementara menggunakan data demo.
*/

Route::prefix('admin')->name('admin.')->group(function () use ($products) {

    // Dashboard
    Route::get('/', function () use ($products) {
        return view('admin.dashboard', compact('products'));
    })->name('dashboard');


    // Daftar produk
    Route::get('/products', function () use ($products) {
        return view('admin.products', compact('products'));
    })->name('products');


    // Form tambah produk
    Route::get('/products/create', function () {
        $product = null;

        return view('admin.form', compact('product'));
    })->name('products.create');


    // Form edit produk
    Route::get('/products/{id}/edit', function ($id) use ($products) {

        $product = collect($products)->firstWhere('id', (int) $id);

        if (!$product) {
            abort(404);
        }

        return view('admin.form', compact('product'));

    })->name('products.edit');

});
