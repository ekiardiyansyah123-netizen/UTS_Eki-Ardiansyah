
@extends('layouts.admin')

@section('title', 'Products')

@section('content')

<div class="admin-page-heading">
    <div>
        <span class="section-label">MENU MANAGEMENT</span>
        <h1>Products</h1>
        <p>Manage your coffee and beverage menu.</p>
    </div>

    <a href="{{ route('admin.products.create') }}" class="btn btn-dark">
        + Add Product
    </a>
</div>

<div class="admin-panel">

    <div class="panel-heading">
        <div>
            <h2>All Products</h2>
            <p>{{ count($products) }} products available</p>
        </div>

        <div class="admin-search">
            <span>⌕</span>
            <input type="text" id="adminSearch" placeholder="Search products...">
        </div>
    </div>

    <div class="table-responsive">

        <table class="admin-table" id="adminProductTable">

            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($products as $product)

                    <tr data-name="{{ strtolower($product['name']) }}">

                        <td>
                            <div class="table-product">
                                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">

                                <div>
                                    <strong>{{ $product['name'] }}</strong>
                                    <small>Product #{{ $product['id'] }}</small>
                                </div>
                            </div>
                        </td>

                        <td>{{ $product['category'] }}</td>

                        <td>
                            Rp {{ number_format($product['price'], 0, ',', '.') }}
                        </td>

                        <td>
                            <span class="status-badge">Available</span>
                        </td>

                        <td>
                            <div class="table-actions">

                                <a href="{{ route('admin.products.edit', $product['id']) }}" class="action-btn edit-btn">
                                    Edit
                                </a>

                                <button type="button" class="action-btn delete-btn"
                                    onclick="alert('Fitur hapus akan dihubungkan dengan database pada tahap CRUD.')">
                                    Delete
                                </button>

                            </div>
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection

@push('scripts')
<script>
    const adminSearch = document.getElementById('adminSearch');

    adminSearch.addEventListener('input', function () {
        const keyword = this.value.toLowerCase();

        document.querySelectorAll('#adminProductTable tbody tr').forEach(row => {
            row.style.display = row.dataset.name.includes(keyword) ? '' : 'none';
        });
    });
</script>
@endpush
