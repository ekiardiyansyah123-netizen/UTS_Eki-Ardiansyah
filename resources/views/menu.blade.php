
@extends('layouts.app')

@section('title', 'Our Menu')

@section('content')

<section class="page-hero">
    <div class="container">
        <span class="section-label">MADE WITH LOVE & COFFEE</span>

        <h1>Our <em>menu.</em></h1>

        <p>
            Discover your new favorite drink.
            Every cup, a moment worth enjoying.
        </p>
    </div>
</section>

<section class="section catalog-section">
    <div class="container">

        <div class="catalog-toolbar">

            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">
                    All
                </button>

                <button class="filter-btn" data-filter="Coffee">
                    Coffee
                </button>

                <button class="filter-btn" data-filter="Non Coffee">
                    Non Coffee
                </button>
            </div>

            <div class="search-box">
                <span>⌕</span>
                <input
                    type="text"
                    id="productSearch"
                    placeholder="Search your favorite..."
                >
            </div>

        </div>

        <div class="product-grid catalog-grid" id="productGrid">

            @foreach($products as $product)

                <article class="product-card catalog-card"
                    data-category="{{ $product['category'] }}"
                    data-name="{{ strtolower($product['name']) }}">

                    <a href="{{ route('menu.detail', $product['slug']) }}" class="product-image">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
                    </a>

                    <div class="product-info">
                        <div>
                            <span class="product-category">
                                {{ $product['category'] }}
                            </span>

                            <h3>{{ $product['name'] }}</h3>
                        </div>

                        <span class="product-price">
                            Rp {{ number_format($product['price'], 0, ',', '.') }}
                        </span>
                    </div>

                    <p class="product-description">
                        {{ $product['description'] }}
                    </p>

                    <a href="{{ route('menu.detail', $product['slug']) }}" class="product-link">
                        View details <span>↗</span>
                    </a>

                </article>

            @endforeach

        </div>

        <div id="emptyResult" class="empty-result" style="display:none;">
            <h3>Menu not found</h3>
            <p>Try searching for another drink.</p>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    const filterButtons = document.querySelectorAll('.filter-btn');
    const productCards = document.querySelectorAll('.catalog-card');
    const searchInput = document.getElementById('productSearch');
    const emptyResult = document.getElementById('emptyResult');

    let currentFilter = 'all';

    function filterProducts() {
        const keyword = searchInput.value.toLowerCase();
        let visibleCount = 0;

        productCards.forEach(card => {
            const category = card.dataset.category;
            const name = card.dataset.name;

            const categoryMatch =
                currentFilter === 'all' || category === currentFilter;

            const searchMatch = name.includes(keyword);

            if (categoryMatch && searchMatch) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        emptyResult.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));

            button.classList.add('active');
            currentFilter = button.dataset.filter;

            filterProducts();
        });
    });

    searchInput.addEventListener('input', filterProducts);
</script>
@endpush
