@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('page_title', 'Edit Kategori')
@section('page_breadcrumb', 'Admin / Kategori / Edit')

@section('content')

<div style="max-width:600px;">
    <div style="margin-bottom:1.5rem;">
        <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline btn-sm">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <div class="admin-card-title">Edit Kategori: <em>{{ $kategori->nama }}</em></div>
        </div>
        <div class="admin-card-body-padded">
            <form method="POST" action="{{ route('admin.kategori.update', $kategori) }}" class="admin-form">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Nama Kategori <span class="form-required">*</span></label>
                    <input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                           value="{{ old('nama', $kategori->nama) }}" required>
                    @error('nama')<div class="form-invalid-feedback"><i class="fa fa-exclamation-circle"></i> {{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                </div>

                <div style="display:flex;gap:1rem;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
