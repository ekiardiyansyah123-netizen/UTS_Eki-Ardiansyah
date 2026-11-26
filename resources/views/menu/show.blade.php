@extends('layouts.app')

@section('title', $produk->nama)
@section('meta_description', $produk->deskripsi_singkat ?? Str::limit($produk->deskripsi, 160))

@section('content')

<!-- Product Detail -->
<div style="padding-top:5rem;"></div>

<section class="product-detail">
    <div class="container">

        <!-- Back Button -->
        <div style="margin-bottom:2rem;">
            <a href="{{ route('menu.index') }}" class="btn btn-outline btn-sm">
                <i class="fa fa-arrow-left"></i>
                Kembali ke Menu
            </a>
        </div>

        <!-- Breadcrumb -->
        <div class="breadcrumb" style="justify-content:flex-start;margin-bottom:2rem;">
            <a href="{{ route('home') }}">Home</a>
            <span>/</span>
            <a href="{{ route('menu.index') }}">Menu</a>
            <span>/</span>
            <span>{{ $produk->nama }}</span>
        </div>

        <div class="product-detail-grid">

            <!-- Product Image -->
            <div class="animate-on-scroll">
                <div class="product-detail-image">
                    @if($produk->foto)
                        <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama }}">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:6rem;background:linear-gradient(135deg,var(--soft-beige),var(--warm-cream));">
                            ☕
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="animate-on-scroll animate-delay-2">
                <div class="product-detail-category">{{ $produk->kategori->nama ?? '' }}</div>

                @if($produk->featured)
                    <span style="display:inline-flex;align-items:center;gap:.4rem;background:rgba(185,130,80,.12);color:var(--caramel-dark);font-size:.75rem;font-weight:600;padding:.3rem .9rem;border-radius:100px;margin-bottom:.75rem;">
                        ⭐ Best Seller
                    </span>
                @endif

                <h1 class="product-detail-name">{{ $produk->nama }}</h1>

                <div class="product-detail-price">{{ $produk->harga_format }}</div>

                @if($produk->tersedia)
                    <div class="product-available-badge">
                        <i class="fa fa-check-circle"></i>
                        Tersedia Sekarang
                    </div>
                @else
                    <div style="display:inline-flex;align-items:center;gap:.4rem;background:rgba(239,68,68,.1);color:#dc2626;font-size:.82rem;font-weight:500;padding:.4rem .9rem;border-radius:100px;margin-bottom:1.5rem;">
                        <i class="fa fa-times-circle"></i>
                        Sedang Tidak Tersedia
                    </div>
                @endif

                <div class="product-detail-divider"></div>

                <p class="product-detail-desc">{{ $produk->deskripsi }}</p>

                <div style="background:var(--warm-cream);border-radius:var(--radius-md);padding:1.25rem 1.5rem;margin-bottom:2rem;">
                    <div style="font-size:.8rem;font-weight:600;color:var(--espresso);margin-bottom:.75rem;letter-spacing:.05em;text-transform:uppercase;">Informasi Produk</div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;font-size:.875rem;">
                        <div>
                            <span style="color:var(--text-muted);">Kategori</span><br>
                            <strong>{{ $produk->kategori->nama ?? '-' }}</strong>
                        </div>
                        <div>
                            <span style="color:var(--text-muted);">Harga</span><br>
                            <strong>{{ $produk->harga_format }}</strong>
                        </div>
                        <div>
                            <span style="color:var(--text-muted);">Status</span><br>
                            <strong>{{ $produk->tersedia ? 'Tersedia' : 'Tidak Tersedia' }}</strong>
                        </div>
                        <div>
                            <span style="color:var(--text-muted);">Label</span><br>
                            <strong>{{ $produk->featured ? 'Best Seller' : 'Regular' }}</strong>
                        </div>
                    </div>
                </div>

                <div style="display:flex;gap:1rem;flex-wrap:wrap;">
                    <a href="{{ route('menu.index') }}" class="btn btn-outline">
                        <i class="fa fa-list"></i>
                        Lihat Menu Lain
                    </a>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($related->count() > 0)
        <div style="margin-top:5rem;">
            <div class="section-header">
                <span class="section-label">Menu Lainnya</span>
                <h2 class="section-title">Mungkin Anda Juga Suka</h2>
            </div>

            <div class="products-grid">
                @foreach($related as $index => $item)
                <div class="product-card animate-on-scroll animate-delay-{{ $index + 1 }}">
                    <div class="product-card-image">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" loading="lazy">
                        @else
                            <div class="product-card-placeholder">☕</div>
                        @endif
                    </div>
                    <div class="product-card-body">
                        <div class="product-card-category">{{ $item->kategori->nama ?? '' }}</div>
                        <div class="product-card-name">{{ $item->nama }}</div>
                        <p class="product-card-desc">{{ Str::limit($item->deskripsi, 80) }}</p>
                        <div class="product-card-footer">
                            <span class="product-price">{{ $item->harga_format }}</span>
                            <a href="{{ route('menu.show', $item->slug) }}" class="btn btn-primary btn-sm">Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

@endsection
