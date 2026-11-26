
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="admin-page-heading">
    <div>
        <span class="section-label">OVERVIEW</span>
        <h1>Dashboard</h1>
        <p>Welcome back to Essenza Coffee management.</p>
    </div>

    <a href="{{ route('admin.products.create') }}" class="btn btn-dark">
        + Add Product
    </a>
</div>

<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-top">
            <span>Total Products</span>
            <div class="stat-icon">☕</div>
        </div>

        <h2>{{ count($products) }}</h2>
        <p>Available menu items</p>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            <span>Categories</span>
            <div class="stat-icon">▦</div>
        </div>

        <h2>{{ count(array_unique(array_column($products, 'category'))) }}</h2>
        <p>Product categories</p>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            <span>Average Price</span>
            <div class="stat-icon">Rp</div>
        </div>

        <h2>
            Rp {{ number_format(array_sum(array_column($products, 'price')) / max(count($products), 1), 0, ',', '.') }}
        </h2>

        <p>Average menu price</p>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            <span>Brand Status</span>
            <div class="stat-icon">✦</div>
        </div>

        <h2 class="status-text">Active</h2>
        <p>Essenza Coffee</p>
    </div>

</div>

<div class="admin-panel">

    <div class="panel-heading">
        <div>
            <h2>Recent Products</h2>
            <p>Latest items in your menu</p>
        </div>

        <a href="{{ route('admin.products') }}" class="text-link">
            View all <span>→</span>
        </a>
    </div>

    <div class="table-responsive">

        <table class="admin-table">

            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @foreach(array_slice($products, 0, 5) as $product)

                    <tr>
                        <td>
                            <div class="table-product">
                                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">

                                <div>
                                    <strong>{{ $product['name'] }}</strong>
                                    <small>Product #{{ $product['id'] }}</small>
                                </div>
                            </div>
                        </td>

                        <td>{{ $product['category'] }}</td>

                        <td>
                            Rp {{ number_format($product['price'], 0, ',', '.') }}
                        </td>

                        <td>
                            <span class="status-badge">Available</span>
                        </td>
                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

<div class="admin-welcome-card">
    <div>
        <span class="section-label light-label">ESSENZA COFFEE</span>

        <h2>Small moments.<br><em>Big feelings.</em></h2>

        <p>
            Manage your menu and keep delivering
            beautiful coffee experiences.
        </p>
    </div>

    <div class="welcome-decoration">E</div>
</div>

@endsection
```blade
@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="admin-dashboard">

    {{-- SIDEBAR --}}
    <aside class="admin-sidebar">

        <div class="admin-sidebar-brand">
            <div class="admin-sidebar-logo">E</div>

            <div>
                <h2>ESSENZA</h2>
                <span>COFFEE ADMIN</span>
            </div>
        </div>

        <div class="admin-sidebar-label">
            MENU UTAMA
        </div>

        <nav class="admin-sidebar-nav">

            <a href="{{ url('/admin/dashboard') }}" class="admin-nav-item active">
                <span class="admin-nav-icon">▦</span>
                Dashboard
            </a>

            <a href="#produk" class="admin-nav-item">
                <span class="admin-nav-icon">☕</span>
                Produk
            </a>

            <a href="#kategori" class="admin-nav-item">
                <span class="admin-nav-icon">◈</span>
                Kategori
            </a>

            <a href="#pesanan" class="admin-nav-item">
                <span class="admin-nav-icon">▤</span>
                Pesanan
            </a>

            <a href="#stok" class="admin-nav-item">
                <span class="admin-nav-icon">▣</span>
                Stok
            </a>

            <a href="#laporan" class="admin-nav-item">
                <span class="admin-nav-icon">▥</span>
                Laporan
            </a>

        </nav>

        <div class="admin-sidebar-bottom">

            <a href="{{ route('home') }}" class="admin-nav-item">
                <span class="admin-nav-icon">↗</span>
                Lihat Website
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf

                <button type="submit" class="admin-logout-button">
                    <span class="admin-nav-icon">⇥</span>
                    Logout
                </button>
            </form>

        </div>

    </aside>


    {{-- MAIN CONTENT --}}
    <div class="admin-main">

        {{-- HEADER --}}
        <div class="admin-topbar">

            <div>
                <span class="admin-page-subtitle">OVERVIEW</span>
                <h1>Dashboard</h1>
                <p>Welcome back to Essenza Coffee administration.</p>
            </div>

            <div class="admin-profile">

                <div class="admin-profile-avatar">
                    E
                </div>

                <div class="admin-profile-info">
                    <strong>Administrator</strong>
                    <span>{{ session('admin_email') }}</span>
                </div>

            </div>

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="admin-success-message">
                {{ session('success') }}
            </div>
        @endif


        {{-- STATISTICS --}}
        <section class="admin-stat-grid">

            <div class="admin-stat-card">

                <div class="admin-stat-top">
                    <span>Total Produk</span>
                    <div class="admin-stat-icon brown">☕</div>
                </div>

                <h2>6</h2>

                <p class="admin-stat-description">
                    Produk menu tersedia
                </p>

            </div>


            <div class="admin-stat-card">

                <div class="admin-stat-top">
                    <span>Kategori</span>
                    <div class="admin-stat-icon beige">◈</div>
                </div>

                <h2>2</h2>

                <p class="admin-stat-description">
                    Coffee & Non Coffee
                </p>

            </div>


            <div class="admin-stat-card">

                <div class="admin-stat-top">
                    <span>Total Pesanan</span>
                    <div class="admin-stat-icon green">▤</div>
                </div>

                <h2>0</h2>

                <p class="admin-stat-description">
                    Belum ada transaksi
                </p>

            </div>


            <div class="admin-stat-card">

                <div class="admin-stat-top">
                    <span>Pendapatan</span>
                    <div class="admin-stat-icon gold">Rp</div>
                </div>

                <h2>Rp 0</h2>

                <p class="admin-stat-description">
                    Total pendapatan
                </p>

            </div>

        </section>


        {{-- CONTENT GRID --}}
        <div class="admin-content-grid">


            {{-- QUICK ACTIONS --}}
            <section class="admin-panel admin-quick-panel">

                <div class="admin-panel-header">

                    <div>
                        <span class="admin-section-label">QUICK ACCESS</span>
                        <h2>Quick Actions</h2>
                    </div>

                </div>

                <div class="admin-quick-actions">

                    <a href="#produk" class="admin-quick-action">

                        <div class="admin-quick-icon">
                            ☕
                        </div>

                        <div>
                            <strong>Kelola Produk</strong>
                            <span>Atur menu coffee shop</span>
                        </div>

                        <span class="admin-quick-arrow">→</span>

                    </a>


                    <a href="#kategori" class="admin-quick-action">

                        <div class="admin-quick-icon">
                            ◈
                        </div>

                        <div>
                            <strong>Kelola Kategori</strong>
                            <span>Atur kategori produk</span>
                        </div>

                        <span class="admin-quick-arrow">→</span>

                    </a>


                    <a href="#stok" class="admin-quick-action">

                        <div class="admin-quick-icon">
                            ▣
                        </div>

                        <div>
                            <strong>Periksa Stok</strong>
                            <span>Pantau persediaan</span>
                        </div>

                        <span class="admin-quick-arrow">→</span>

                    </a>

                </div>

            </section>


            {{-- WELCOME PANEL --}}
            <section class="admin-panel admin-welcome-panel">

                <div class="admin-welcome-decoration">
                    E
                </div>

                <span class="admin-section-label">
                    ESSENZA COFFEE
                </span>

                <h2>Crafted with warmth & coffee.</h2>

                <p>
                    Kelola bisnis coffee shop Anda dengan mudah.
                    Mulai dari produk, kategori, stok hingga
                    penjualan dalam satu dashboard.
                </p>

                <a href="{{ route('home') }}" class="admin-welcome-button">
                    Kunjungi Website
                    <span>↗</span>
                </a>

            </section>

        </div>


        {{-- PRODUCT OVERVIEW --}}
        <section class="admin-panel admin-product-overview" id="produk">

            <div class="admin-panel-header">

                <div>
                    <span class="admin-section-label">MENU MANAGEMENT</span>
                    <h2>Produk Essenza</h2>
                </div>

                <a href="{{ route('menu') }}" class="admin-panel-link">
                    Lihat Menu Website →
                </a>

            </div>

            <div class="admin-product-placeholder">

                <div class="admin-product-placeholder-icon">
                    ☕
                </div>

                <h3>Pengelolaan Produk</h3>

                <p>
                    Halaman tambah, edit, hapus, dan pengaturan
                    stok produk akan kita buat pada tahap berikutnya.
                </p>

            </div>

        </section>


        {{-- OTHER SECTIONS --}}
        <section class="admin-panel admin-information-panel">

            <div class="admin-panel-header">
                <div>
                    <span class="admin-section-label">INFORMATION</span>
                    <h2>Informasi Sistem</h2>
                </div>
            </div>

            <div class="admin-information-list">

                <div>
                    <span>Status Website</span>
                    <strong class="admin-status-online">
                        ● Online
                    </strong>
                </div>

                <div>
                    <span>Login Admin</span>
                    <strong>Aktif</strong>
                </div>

                <div>
                    <span>Website</span>
                    <strong>Essenza Coffee</strong>
                </div>

            </div>

        </section>


        {{-- FOOTER --}}
        <div class="admin-dashboard-footer">
            © {{ date('Y') }} Essenza Coffee · Admin Dashboard
        </div>

    </div>

</div>

@endsection