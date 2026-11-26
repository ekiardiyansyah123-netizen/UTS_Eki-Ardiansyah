
@extends('layouts.app')

@section('title', 'Our Menu')

@section('content')

{{-- MENU HERO --}}
<section class="menu-hero">
    <div class="container menu-hero-content">

        <span class="section-label">MADE WITH LOVE</span>

        <h1>
            Discover our<br>
            <em>menu.</em>
        </h1>

        <p>
            Find your favorite drink and make every moment
            a little more special.
        </p>

    </div>
</section>


{{-- MENU CATALOG --}}
<section class="section catalog-section">
    <div class="container">

        {{-- HEADER --}}
        <div class="section-heading catalog-heading">

            <div>
                <span class="section-label">
                    SOMETHING FOR EVERY MOMENT
                </span>

                <h2>Explore our <em>favorites.</em></h2>
            </div>

            <span class="catalog-count">
                {{ count($products) }} products
            </span>

        </div>


        {{-- SEARCH --}}
        <div class="menu-search-wrapper">

            <div class="menu-search">

                <span class="search-icon">⌕</span>

                <input
                    type="text"
                    id="menuSearch"
                    placeholder="Search your favorite coffee..."
                >

                <button
                    type="button"
                    id="clearSearch"
                    class="clear-search"
                >
                    ×
                </button>

            </div>

        </div>


        {{-- CATEGORY FILTER --}}
        <div class="menu-filter">

            <button
                type="button"
                class="filter-btn active"
                data-filter="all"
            >
                All Menu
            </button>

            @foreach(array_unique(array_column($products, 'category')) as $category)

                <button
                    type="button"
                    class="filter-btn"
                    data-filter="{{ $category }}"
                >
                    {{ $category }}
                </button>

            @endforeach

        </div>


        {{-- PRODUCT GRID --}}
        <div class="product-grid catalog-grid" id="productGrid">

            @forelse($products as $product)

                <article
                    class="product-card catalog-card"
                    data-category="{{ $product['category'] }}"
                    data-name="{{ strtolower($product['name']) }}"
                >

                    {{-- PRODUCT IMAGE --}}
                    <a
                        href="{{ route('product.detail', $product['id']) }}"
                        class="product-image"
                    >

                        <img
                            src="{{ $product['image'] }}"
                            alt="{{ $product['name'] }}"
                            loading="lazy"
                        >

                        <span class="product-tag">
                            ESSENZA FAVORITE
                        </span>

                    </a>


                    {{-- PRODUCT INFO --}}
                    <div class="product-info">

                        <div>

                            <span class="product-category">
                                {{ $product['category'] }}
                            </span>

                            <h3>
                                {{ $product['name'] }}
                            </h3>

                        </div>

                        <span class="product-price">
                            Rp {{ number_format($product['price'], 0, ',', '.') }}
                        </span>

                    </div>


                    {{-- PRODUCT DESCRIPTION --}}
                    @if(isset($product['description']) && $product['description'])

                        <p class="catalog-description">
                            {{ $product['description'] }}
                        </p>

                    @endif


                    {{-- DETAIL BUTTON --}}
                    <a
                        href="{{ route('product.detail', $product['id']) }}"
                        class="catalog-detail-link"
                    >
                        Discover this drink <span>↗</span>
                    </a>

                </article>

            @empty

                <div class="empty-menu">

                    <div class="empty-menu-icon">☕</div>

                    <h3>Our menu is preparing.</h3>

                    <p>
                        There are currently no products available.
                        Please come back soon.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- NO SEARCH RESULTS --}}
        <div id="noResults" class="no-results" style="display: none;">

            <div class="empty-menu-icon">⌕</div>

            <h3>No drinks found.</h3>

            <p>
                Try another keyword or choose a different category.
            </p>

        </div>

    </div>
</section>


{{-- MENU CTA --}}
<section class="cta-section">
    <div class="container cta-content">

        <span class="section-label">
            YOUR NEXT FAVORITE CUP
        </span>

        <h2>
            Every sip is a<br>
            <em>little escape.</em>
        </h2>

        <a href="{{ route('about') }}" class="btn btn-dark">
            Discover our story <span>↗</span>
        </a>

    </div>
</section>


{{-- MENU FILTER SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const filterButtons = document.querySelectorAll('.filter-btn');
    const productCards = document.querySelectorAll('.catalog-card');
    const searchInput = document.getElementById('menuSearch');
    const clearSearch = document.getElementById('clearSearch');
    const noResults = document.getElementById('noResults');

    let activeCategory = 'all';

    function filterProducts() {

        const keyword = searchInput.value.toLowerCase().trim();

        let visibleCount = 0;

        productCards.forEach(function (card) {

            const category = card.dataset.category;
            const name = card.dataset.name;

            const categoryMatch =
                activeCategory === 'all' ||
                category === activeCategory;

            const searchMatch =
                name.includes(keyword);

            if (categoryMatch && searchMatch) {

                card.style.display = '';
                visibleCount++;

            } else {

                card.style.display = 'none';

            }

        });

        if (noResults) {
            noResults.style.display =
                visibleCount === 0 ? 'block' : 'none';
        }

    }


    // CATEGORY FILTER
    filterButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            filterButtons.forEach(function (btn) {
                btn.classList.remove('active');
            });

            button.classList.add('active');

            activeCategory = button.dataset.filter;

            filterProducts();

        });

    });


    // SEARCH
    if (searchInput) {

        searchInput.addEventListener('input', filterProducts);

    }


    // CLEAR SEARCH
    if (clearSearch) {

        clearSearch.addEventListener('click', function () {

            searchInput.value = '';

            filterProducts();

            searchInput.focus();

        });

    }

});
</script>

@endsection
