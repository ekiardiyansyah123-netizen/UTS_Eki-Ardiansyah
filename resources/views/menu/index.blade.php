@extends('layouts.app')

@section('title', 'Menu')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>/</span>
            <span>Menu</span>
        </div>
        <h1>Menu Essenza Coffee</h1>
        <p>Temukan cita rasa premium dalam setiap tegukan</p>
    </div>
</div>

<!-- Catalog Section -->
<section class="section">
    <div class="container">

        <!-- Filter Bar -->
        <form method="GET" action="{{ route('menu.index') }}" id="filterForm">
            <div class="filter-bar">
                <div class="filter-search">
                    <span class="filter-search-icon"><i class="fa fa-search"></i></span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari minuman favorit Anda..."
                           autocomplete="off">
                </div>

                <div class="filter-tags">
                    <a href="{{ route('menu.index', array_filter(['search' => request('search')])) }}"
                       class="filter-tag {{ !request('kategori') ? 'active' : '' }}">
                        Semua
                    </a>
                    @foreach($kategoris as $kat)
                    <a href="{{ route('menu.index', array_filter(['search' => request('search'), 'kategori' => $kat->slug])) }}"
                       class="filter-tag {{ request('kategori') === $kat->slug ? 'active' : '' }}">
                        {{ $kat->nama }}
                        <sup style="font-size:.7em;opacity:.7;">{{ $kat->produks_count }}</sup>
                    </a>
                    @endforeach
                </div>
            </div>
        </form>

        <!-- Results info -->
        @if(request('search') || request('kategori'))
        <div style="margin-bottom:1.5rem;color:var(--text-muted);font-size:.875rem;">
            Menampilkan <strong style="color:var(--espresso);">{{ $produks->total() }}</strong> produk
            @if(request('search')) untuk "<strong>{{ request('search') }}</strong>"@endif
            @if(request('kategori')) di kategori "<strong>{{ request('kategori') }}</strong>"@endif
        </div>
        @endif

        <!-- Products Grid -->
        @if($produks->count() > 0)
        <div class="products-grid">
            @foreach($produks as $index => $produk)
            <div class="product-card animate-on-scroll animate-delay-{{ ($index % 3) + 1 }}">
                <div class="product-card-image">
                    @if($produk->foto)
                        <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama }}" loading="lazy">
                    @else
                        <div class="product-card-placeholder">☕</div>
                    @endif
                    @if($produk->featured)
                        <span class="product-card-badge">Best Seller</span>
                    @endif
                </div>
                <div class="product-card-body">
                    <div class="product-card-category">{{ $produk->kategori->nama ?? '' }}</div>
                    <div class="product-card-name">{{ $produk->nama }}</div>
                    <p class="product-card-desc">
                        {{ $produk->deskripsi_singkat ?? Str::limit($produk->deskripsi, 80) }}
                    </p>
                    <div class="product-card-footer">
                        <span class="product-price">{{ $produk->harga_format }}</span>
                        <a href="{{ route('menu.show', $produk->slug) }}" class="btn btn-primary btn-sm">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($produks->hasPages())
        <div class="pagination-wrapper">
            {{ $produks->links('vendor.pagination.essenza') }}
        </div>
        @endif

        @else
        <div class="empty-state">
            <div class="empty-state-icon">🔍</div>
            <h3>Produk Tidak Ditemukan</h3>
            <p>Coba ubah kata kunci pencarian atau pilih kategori yang berbeda.</p>
            <a href="{{ route('menu.index') }}" class="btn btn-primary">Lihat Semua Menu</a>
        </div>
        @endif

    </div>
</section>

@endsection
