
@extends('layouts.admin')

@section('title', $product ? 'Edit Product' : 'Add Product')

@section('content')

<div class="admin-page-heading">
    <div>
        <span class="section-label">MENU MANAGEMENT</span>

        <h1>{{ $product ? 'Edit Product' : 'Add Product' }}</h1>

        <p>
            {{ $product ? 'Update product information.' : 'Add a new item to your menu.' }}
        </p>
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

        <form action="#" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="admin-form">

                <div class="form-group">
                    <label for="name">Product Name *</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="e.g. Signature Latte"
                        value="{{ $product['name'] ?? '' }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="category">Category *</label>

                    <select id="category" name="category" required>
                        <option value="">Select category</option>

                        <option value="Coffee"
                            {{ isset($product) && $product['category'] === 'Coffee' ? 'selected' : '' }}>
                            Coffee
                        </option>

                        <option value="Non Coffee"
                            {{ isset($product) && $product['category'] === 'Non Coffee' ? 'selected' : '' }}>
                            Non Coffee
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price (IDR) *</label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        placeholder="28000"
                        value="{{ $product['price'] ?? '' }}"
                        min="0"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="description">Description *</label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Describe this product..."
                        required
                    >{{ $product['description'] ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Product Image</label>

                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                    >
                </div>

                @if(isset($product))
                    <div class="current-image">
                        <label>Current Image</label>

                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
                    </div>
                @endif

                <div class="form-actions">
                    <a href="{{ route('admin.products') }}" class="btn btn-outline-dark">
                        Cancel
                    </a>

                    <button type="button" class="btn btn-dark"
                        onclick="alert('Form akan disambungkan ke CRUD Laravel pada tahap backend.')">
                        {{ $product ? 'Save Changes' : 'Create Product' }}
                    </button>
                </div>

            </div>

        </form>

    </div>

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
        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
    const nameInput = document.getElementById('name');
    const categoryInput = document.getElementById('category');
    const priceInput = document.getElementById('price');
    const descriptionInput = document.getElementById('description');
    const imageInput = document.getElementById('image');

    nameInput.addEventListener('input', () => {
        document.getElementById('previewName').textContent =
            nameInput.value || 'Product Name';
    });

    categoryInput.addEventListener('change', () => {
        document.getElementById('previewCategory').textContent =
            categoryInput.value || 'Coffee';
    });

    priceInput.addEventListener('input', () => {
        const price = Number(priceInput.value || 0);

        document.getElementById('previewPrice').textContent =
            'Rp ' + price.toLocaleString('id-ID');
    });

    descriptionInput.addEventListener('input', () => {
        document.getElementById('previewDescription').textContent =
            descriptionInput.value || 'Your product description will appear here.';
    });

    imageInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();

            reader.onload = function (event) {
                document.getElementById('previewImage').src = event.target.result;
            };

            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endpush
