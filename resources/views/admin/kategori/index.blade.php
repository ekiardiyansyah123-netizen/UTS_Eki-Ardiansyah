@extends('layouts.admin')

@section('title', 'Manajemen Kategori')
@section('page_title', 'Manajemen Kategori')
@section('page_breadcrumb', 'Admin / Kategori')

@section('content')

<div class="admin-card">
    <div class="admin-card-header">
        <div class="admin-card-title">Daftar Kategori</div>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i> Tambah Kategori
        </a>
    </div>

    <div class="admin-card-body">
        @if($kategoris->count() > 0)
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Slug</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Produk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoris as $i => $k)
                <tr>
                    <td style="color:var(--text-muted);font-size:.82rem;">{{ $i + 1 }}</td>
                    <td style="font-weight:600;">{{ $k->nama }}</td>
                    <td><code style="font-size:.78rem;background:var(--warm-cream);padding:.2rem .5rem;border-radius:4px;">{{ $k->slug }}</code></td>
                    <td style="color:var(--text-muted);">{{ Str::limit($k->deskripsi, 50) ?? '—' }}</td>
                    <td>
                        <span class="badge badge-caramel">{{ $k->produks_count }} produk</span>
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('admin.kategori.edit', $k) }}" class="btn-icon btn-icon-edit" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.kategori.destroy', $k) }}" style="display:inline;">
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
        @else
        <div class="empty-state" style="padding:3rem;">
            <div class="empty-state-icon">🏷️</div>
            <h3>Belum Ada Kategori</h3>
            <p>Tambahkan kategori untuk mengorganisir produk Anda.</p>
            <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
        </div>
        @endif
    </div>
</div>

@endsection
