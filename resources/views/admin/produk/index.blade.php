@extends('layouts.admin')

@section('title', 'Manajemen Produk')
@section('page_title', 'Manajemen Produk')
@section('page_breadcrumb', 'Admin / Produk')

@section('content')

<!-- Filter Bar -->
<form method="GET" action="{{ route('admin.produk.index') }}" style="margin-bottom:1.5rem;">
    <div style="display:flex;gap:1rem;flex-wrap:wrap;align-items:center;">
        <div class="filter-search" style="flex:1;min-width:200px;">
            <span class="filter-search-icon"><i class="fa fa-search"></i></span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk...">
        </div>

        <select name="kategori" class="form-select" style="width:auto;padding:.6rem 2rem .6rem 1rem;" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach($kategoris as $k)
            <option value="{{ $k->id }}" {{ request('kategori') == $k->id ? 'selected' : '' }}>
                {{ $k->nama }}
            </option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-outline btn-sm">Filter</button>
        @if(request('search') || request('kategori'))
        <a href="{{ route('admin.produk.index') }}" class="btn btn-sm" style="background:var(--soft-beige);color:var(--espresso);">Reset</a>
        @endif
    </div>
</form>

<div class="admin-card">
    <div class="admin-card-header">
        <div class="admin-card-title">
            Daftar Produk
            <span style="font-size:.8rem;font-weight:400;color:var(--text-muted);margin-left:.5rem;">
                ({{ $produks->total() }} produk)
            </span>
        </div>
        <a href="{{ route('admin.produk.create') }}" class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i> Tambah Produk
        </a>
    </div>

    <div class="admin-card-body">
        @if($produks->count() > 0)
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produks as $i => $p)
                <tr>
                    <td style="color:var(--text-muted);font-size:.82rem;">{{ $produks->firstItem() + $i }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:.875rem;">
                            @if($p->foto)
                                <img src="{{ asset('storage/' . $p->foto) }}" class="table-product-img" alt="{{ $p->nama }}">
                            @else
                                <div class="table-product-img" style="display:flex;align-items:center;justify-content:center;font-size:1.3rem;background:var(--soft-beige);">☕</div>
                            @endif
                            <div>
                                <div class="table-product-name">{{ $p->nama }}</div>
                                <div class="table-product-category">{{ Str::limit($p->deskripsi_singkat ?? $p->deskripsi, 45) }}</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge badge-caramel">{{ $p->kategori->nama ?? '-' }}</span></td>
                    <td style="font-weight:600;white-space:nowrap;">{{ $p->harga_format }}</td>
                    <td>
                        @if($p->featured)
                            <span class="badge badge-caramel">⭐ Featured</span>
                        @else
                            <span style="color:var(--text-muted);font-size:.82rem;">–</span>
                        @endif
                    </td>
                    <td>
                        @if($p->tersedia)
                            <span class="badge badge-green">Tersedia</span>
                        @else
                            <span class="badge badge-red">Tidak</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('admin.produk.edit', $p) }}" class="btn-icon btn-icon-edit" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.produk.destroy', $p) }}" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="button" class="btn-icon btn-icon-delete" data-delete title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($produks->hasPages())
        <div style="padding:1.25rem 1.5rem;border-top:1px solid #eae6e0;">
            <div class="pagination-wrapper" style="justify-content:flex-start;">
                {{ $produks->links('vendor.pagination.essenza') }}
            </div>
        </div>
        @endif

        @else
        <div class="empty-state" style="padding:3rem;">
            <div class="empty-state-icon">☕</div>
            <h3>Belum Ada Produk</h3>
            <p>Mulai tambahkan produk kopi pertama Anda.</p>
            <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">Tambah Produk</a>
        </div>
        @endif
    </div>
</div>

@endsection
