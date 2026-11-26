@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('page_title', 'Edit Produk')
@section('page_breadcrumb', 'Admin / Produk / Edit')

@section('content')

<div style="max-width:860px;">
    <div style="margin-bottom:1.5rem;">
        <a href="{{ route('admin.produk.index') }}" class="btn btn-outline btn-sm">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <div class="admin-card-title">Edit Produk: <em>{{ $produk->nama }}</em></div>
        </div>
        <div class="admin-card-body-padded">
            <form method="POST" action="{{ route('admin.produk.update', $produk) }}" enctype="multipart/form-data" class="admin-form">
                @csrf @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Produk <span class="form-required">*</span></label>
                        <input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                               value="{{ old('nama', $produk->nama) }}" required>
                        @error('nama')<div class="form-invalid-feedback"><i class="fa fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Kategori <span class="form-required">*</span></label>
                        <select name="kategori_id" class="form-select {{ $errors->has('kategori_id') ? 'is-invalid' : '' }}" required>
                            <option value="">— Pilih Kategori —</option>
                            @foreach($kategoris as $k)
                            <option value="{{ $k->id }}" {{ old('kategori_id', $produk->kategori_id) == $k->id ? 'selected' : '' }}>
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
                               value="{{ old('harga', $produk->harga) }}" min="0" required>
                        @error('harga')<div class="form-invalid-feedback"><i class="fa fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Singkat</label>
                        <input type="text" name="deskripsi_singkat" class="form-control"
                               value="{{ old('deskripsi_singkat', $produk->deskripsi_singkat) }}" maxlength="255">
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi Lengkap <span class="form-required">*</span></label>
                    <textarea name="deskripsi" class="form-control {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}"
                              rows="5" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                    @error('deskripsi')<div class="form-invalid-feedback"><i class="fa fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Foto Produk</label>

                    @if($produk->foto)
                    <div style="margin-bottom:1rem;display:flex;align-items:center;gap:1rem;">
                        <img src="{{ asset('storage/' . $produk->foto) }}" alt="Foto saat ini"
                             style="width:80px;height:80px;object-fit:cover;border-radius:var(--radius-md);box-shadow:var(--shadow-sm);">
                        <div>
                            <div style="font-size:.82rem;font-weight:600;color:var(--espresso);">Foto Saat Ini</div>
                            <div style="font-size:.75rem;color:var(--text-muted);">Unggah foto baru untuk mengganti.</div>
                        </div>
                    </div>
                    @endif

                    <div class="image-upload-box">
                        <input type="file" name="foto" accept="image/jpg,image/jpeg,image/png,image/webp">
                        <div class="image-upload-icon">📷</div>
                        <div class="image-upload-text">
                            <strong>Klik untuk ganti foto</strong><br>
                            <span style="font-size:.78rem;opacity:.7;">JPG, PNG, WebP — Maks. 2MB</span>
                        </div>
                    </div>
                    <div class="image-preview-wrapper">
                        <img src="" alt="Preview foto baru">
                    </div>
                    @error('foto')<div class="form-invalid-feedback"><i class="fa fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                </div>

                <div style="display:flex;gap:2rem;padding:1.25rem 0;border-top:1px solid #eae6e0;border-bottom:1px solid #eae6e0;margin-bottom:1.5rem;">
                    <label class="form-check">
                        <input type="checkbox" name="tersedia" class="form-check-input" value="1"
                               {{ old('tersedia', $produk->tersedia ? '1' : '') == '1' ? 'checked' : '' }}>
                        <span class="form-check-label">Produk Tersedia</span>
                    </label>
                    <label class="form-check">
                        <input type="checkbox" name="featured" class="form-check-input" value="1"
                               {{ old('featured', $produk->featured ? '1' : '') == '1' ? 'checked' : '' }}>
                        <span class="form-check-label">Tampilkan sebagai Best Seller</span>
                    </label>
                </div>

                <div style="display:flex;gap:1rem;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.produk.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
