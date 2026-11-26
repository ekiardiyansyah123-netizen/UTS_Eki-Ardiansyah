@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('page_title', 'Tambah Produk')
@section('page_breadcrumb', 'Admin / Produk / Tambah')

@section('content')

<div style="max-width:860px;">
    <div style="margin-bottom:1.5rem;">
        <a href="{{ route('admin.produk.index') }}" class="btn btn-outline btn-sm">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <div class="admin-card-title">Form Tambah Produk</div>
        </div>
        <div class="admin-card-body-padded">
            <form method="POST" action="{{ route('admin.produk.store') }}" enctype="multipart/form-data" class="admin-form">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Produk <span class="form-required">*</span></label>
                        <input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                               value="{{ old('nama') }}" placeholder="Contoh: Caramel Latte" required>
                        @error('nama')<div class="form-invalid-feedback"><i class="fa fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Kategori <span class="form-required">*</span></label>
                        <select name="kategori_id" class="form-select {{ $errors->has('kategori_id') ? 'is-invalid' : '' }}" required>
                            <option value="">— Pilih Kategori —</option>
                            @foreach($kategoris as $k)
                            <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('kategori_id')<div class="form-invalid-feedback"><i class="fa fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Harga (Rupiah) <span class="form-required">*</span></label>
                        <input type="number" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}"
                               value="{{ old('harga') }}" placeholder="45000" min="0" required>
                        @error('harga')<div class="form-invalid-feedback"><i class="fa fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Singkat</label>
                        <input type="text" name="deskripsi_singkat" class="form-control"
                               value="{{ old('deskripsi_singkat') }}" placeholder="Maks. 255 karakter" maxlength="255">
                        <div class="form-hint">Tampil di kartu produk katalog.</div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi Lengkap <span class="form-required">*</span></label>
                    <textarea name="deskripsi" class="form-control {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}"
                              rows="5" placeholder="Deskripsikan produk secara lengkap..." required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')<div class="form-invalid-feedback"><i class="fa fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Foto Produk</label>
                    <div class="image-upload-box">
                        <input type="file" name="foto" accept="image/jpg,image/jpeg,image/png,image/webp">
                        <div class="image-upload-icon">📷</div>
                        <div class="image-upload-text">
                            <strong>Klik untuk unggah</strong> atau drag & drop<br>
                            <span style="font-size:.78rem;opacity:.7;">JPG, PNG, WebP — Maks. 2MB</span>
                        </div>
                    </div>
                    <div class="image-preview-wrapper">
                        <img src="" alt="Preview foto produk">
                    </div>
                    @error('foto')<div class="form-invalid-feedback"><i class="fa fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                </div>

                <div style="display:flex;gap:2rem;padding:1.25rem 0;border-top:1px solid #eae6e0;border-bottom:1px solid #eae6e0;margin-bottom:1.5rem;">
                    <label class="form-check">
                        <input type="checkbox" name="tersedia" class="form-check-input" value="1"
                               {{ old('tersedia', '1') == '1' ? 'checked' : '' }}>
                        <span class="form-check-label">Produk Tersedia</span>
                    </label>
                    <label class="form-check">
                        <input type="checkbox" name="featured" class="form-check-input" value="1"
                               {{ old('featured') ? 'checked' : '' }}>
                        <span class="form-check-label">Tampilkan sebagai Best Seller</span>
                    </label>
                </div>

                <div style="display:flex;gap:1rem;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan Produk
                    </button>
                    <a href="{{ route('admin.produk.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
