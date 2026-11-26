
@extends('layouts.admin')

@section('title', isset($product) && $product ? 'Edit Product' : 'Add Product')

@section('content')

@php
    $isEdit = isset($product) && $product;
@endphp

<div class="admin-page-heading">
    <div>
        <span class="section-label">MENU MANAGEMENT</span>
        <h1>{{ $isEdit ? 'Edit Product' : 'Add Product' }}</h1>
        <p>{{ $isEdit ? 'Update product information.' : 'Add a new item to your menu.' }}</p>
    </div>

    <a href="{{ route('admin.products') }}" class="btn btn-outline-dark">
        ← Back
    </a>
</div>

<div class="admin-form-layout">

    <div class="admin-panel">

        <div class="panel-heading">
            <div>
                <h2>Product Information</h2>
                <p>Fill in the details below.</p>
            </div>
        </div>

        {{-- FORM CRUD --}}
        <form
            action="{{ $isEdit
                ? route('admin.products.update', $product['id'])
                : route('admin.products.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @if($isEdit)
                @method('PUT')
            @endif

            <div class="admin-form">

                {{-- PRODUCT NAME --}}
                <div class="form-group">
                    <label for="name">Product Name *</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="e.g. Signature Latte"
                        value="{{ old('name', $product['name'] ?? '') }}"
                        required
                    >
                </div>

                {{-- CATEGORY --}}
                <div class="form-group">
                    <label for="category">Category *</label>

                    <select id="category" name="category" required>
                        <option value="">Select category</option>

                        <option value="Coffee"
                            {{ old('category', $product['category'] ?? '') == 'Coffee' ? 'selected' : '' }}>
                            Coffee
                        </option>

                        <option value="Non Coffee"
                            {{ old('category', $product['category'] ?? '') == 'Non Coffee' ? 'selected' : '' }}>
                            Non Coffee
                        </option>
                    </select>
                </div>

                {{-- PRICE --}}
                <div class="form-group">
                    <label for="price">Price (IDR) *</label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        placeholder="28000"
                        value="{{ old('price', $product['price'] ?? '') }}"
                        min="0"
                        required
                    >
                </div>

                {{-- STOCK --}}
                <div class="form-group">
                    <label for="stock">Stock *</label>

                    <input
                        type="number"
                        id="stock"
                        name="stock"
                        placeholder="20"
                        value="{{ old('stock', $product['stock'] ?? 0) }}"
                        min="0"
                        required
                    >
                </div>

                {{-- DESCRIPTION --}}
                <div class="form-group">
                    <label for="description">Description *</label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Describe this product..."
                        required
                    >{{ old('description', $product['description'] ?? '') }}</textarea>
                </div>

                {{-- IMAGE --}}
                <div class="form-group">
                    <label for="image">Product Image</label>

                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/jpeg,image/png,image/jpg,image/webp"
                    >

                    <small>JPG, PNG, or WEBP. Maximum 2 MB.</small>
                </div>

                {{-- CURRENT IMAGE --}}
                @if($isEdit && !empty($product['image']))
                    <div class="current-image">
                        <label>Current Image</label>

                        <img
                            src="{{ $product['image'] }}"
                            alt="{{ $product['name'] }}"
                            style="max-width: 200px; border-radius: 12px;"
                        >
                    </div>
                @endif

                {{-- ERROR VALIDATION --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Please check the form:</strong>

                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- BUTTONS --}}
                <div class="form-actions">

                    <a href="{{ route('admin.products') }}" class="btn btn-outline-dark">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-dark">
                        {{ $isEdit ? 'Save Changes' : 'Create Product' }}
                    </button>

                </div>

            </div>
        </form>

    </div>

    {{-- LIVE PREVIEW --}}
    <div class="form-preview-card">

        <span class="section-label">PREVIEW</span>

        <h3>Your product will look like this</h3>

        <div class="preview-image">
            <img
                id="previewImage"
                src="{{ $product['image'] ?? 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=800&q=85' }}"
                alt="Product preview"
            >
        </div>

        <div class="preview-info">

            <span class="product-category" id="previewCategory">
                {{ $product['category'] ?? 'Coffee' }}
            </span>

            <h3 id="previewName">
                {{ $product['name'] ?? 'Product Name' }}
            </h3>

            <p id="previewDescription">
                {{ $product['description'] ?? 'Your product description will appear here.' }}
            </p>

            <div class="preview-price" id="previewPrice">
                Rp {{ number_format($product['price'] ?? 0, 0, ',', '.') }}
            </div>

            <div style="margin-top: 10px;">
                Stock: <span id="previewStock">{{ $product['stock'] ?? 0 }}</span>
            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>
    const nameInput = document.getElementById('name');
    const categoryInput = document.getElementById('category');
    const priceInput = document.getElementById('price');
    const stockInput = document.getElementById('stock');
    const descriptionInput = document.getElementById('description');
    const imageInput = document.getElementById('image');

    // Preview nama
    nameInput.addEventListener('input', function () {
        document.getElementById('previewName').textContent =
            this.value || 'Product Name';
    });

    // Preview kategori
    categoryInput.addEventListener('change', function () {
        document.getElementById('previewCategory').textContent =
            this.value || 'Coffee';
    });

    // Preview harga
    priceInput.addEventListener('input', function () {
        const price = Number(this.value || 0);

        document.getElementById('previewPrice').textContent =
            'Rp ' + price.toLocaleString('id-ID');
    });

    // Preview stok
    stockInput.addEventListener('input', function () {
        document.getElementById('previewStock').textContent =
            this.value || 0;
    });

    // Preview deskripsi
    descriptionInput.addEventListener('input', function () {
        document.getElementById('previewDescription').textContent =
            this.value || 'Your product description will appear here.';
    });

    // Preview gambar
    imageInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();

            reader.onload = function (event) {
                document.getElementById('previewImage').src =
                    event.target.result;
            };

            reader.readAsDataURL(this.files[0]);
        }
    });
</script>

@endpush
