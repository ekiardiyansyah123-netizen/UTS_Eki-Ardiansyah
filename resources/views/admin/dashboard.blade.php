
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="admin-page-heading">
    <div>
        <span class="section-label">OVERVIEW</span>
        <h1>Dashboard</h1>
        <p>Welcome back to Essenza Coffee management.</p>
    </div>

    <a href="{{ route('admin.products.create') }}" class="btn btn-dark">
        + Add Product
    </a>
</div>

<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-top">
            <span>Total Products</span>
            <div class="stat-icon">☕</div>
        </div>

        <h2>{{ count($products) }}</h2>
        <p>Available menu items</p>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            <span>Categories</span>
            <div class="stat-icon">▦</div>
        </div>

        <h2>{{ count(array_unique(array_column($products, 'category'))) }}</h2>
        <p>Product categories</p>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            <span>Average Price</span>
            <div class="stat-icon">Rp</div>
        </div>

        <h2>
            Rp {{ number_format(array_sum(array_column($products, 'price')) / max(count($products), 1), 0, ',', '.') }}
        </h2>

        <p>Average menu price</p>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            <span>Brand Status</span>
            <div class="stat-icon">✦</div>
        </div>

        <h2 class="status-text">Active</h2>
        <p>Essenza Coffee</p>
    </div>

</div>

<div class="admin-panel">

    <div class="panel-heading">
        <div>
            <h2>Recent Products</h2>
            <p>Latest items in your menu</p>
        </div>

        <a href="{{ route('admin.products') }}" class="text-link">
            View all <span>→</span>
        </a>
    </div>

    <div class="table-responsive">

        <table class="admin-table">

            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @foreach(array_slice($products, 0, 5) as $product)

                    <tr>
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
                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

<div class="admin-welcome-card">
    <div>
        <span class="section-label light-label">ESSENZA COFFEE</span>

        <h2>Small moments.<br><em>Big feelings.</em></h2>

        <p>
            Manage your menu and keep delivering
            beautiful coffee experiences.
        </p>
    </div>

    <div class="welcome-decoration">E</div>
</div>

@endsection
