@extends('layouts.admin')

@section('title', 'Tambah Kategori')
@section('page_title', 'Tambah Kategori')
@section('page_breadcrumb', 'Admin / Kategori / Tambah')

@section('content')

<div style="max-width:600px;">
    <div style="margin-bottom:1.5rem;">
        <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline btn-sm">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <div class="admin-card-title">Form Tambah Kategori</div>
        </div>
        <div class="admin-card-body-padded">
            <form method="POST" action="{{ route('admin.kategori.store') }}" class="admin-form">
                @csrf

                <div class="form-group">
                    <label>Nama Kategori <span class="form-required">*</span></label>
                    <input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                           value="{{ old('nama') }}" placeholder="Contoh: Espresso Based" required>
                    @error('nama')<div class="form-invalid-feedback"><i class="fa fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"
                              placeholder="Deskripsi singkat tentang kategori ini...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')<div class="form-invalid-feedback"><i class="fa fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                </div>

                <div style="display:flex;gap:1rem;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan Kategori
                    </button>
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
