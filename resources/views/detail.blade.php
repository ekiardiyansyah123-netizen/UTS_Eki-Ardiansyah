
@extends('layouts.app')

@section('title', $product['name'])

@section('content')

<section class="detail-section">
    <div class="container">

        <a href="{{ route('menu') }}" class="back-link">
            ← Back to menu
        </a>

        <div class="detail-grid">

            <div class="detail-image">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
            </div>

            <div class="detail-content">

                <span class="section-label">
                    ESSENZA COFFEE / {{ strtoupper($product['category']) }}
                </span>

                <h1>{{ $product['name'] }}</h1>

                <div class="detail-price">
                    Rp {{ number_format($product['price'], 0, ',', '.') }}
                </div>

                <div class="detail-divider"></div>

                <p class="detail-description">
                    {{ $product['description'] }}
                </p>

                <div class="detail-features">
                    <div>
                        <span>✦</span>
                        <p>Premium ingredients</p>
                    </div>

                    <div>
                        <span>☕</span>
                        <p>Freshly prepared</p>
                    </div>

                    <div>
                        <span>♡</span>
                        <p>Made with love</p>
                    </div>
                </div>

                <a href="{{ route('menu') }}" class="btn btn-dark detail-button">
                    Explore other menu <span>↗</span>
                </a>

                <div class="detail-note">
                    <span>ESSENZA NOTE</span>
                    <p>
                        A little moment of coffee,
                        a lot of good vibes.
                    </p>
                </div>

            </div>

        </div>

    </div>
</section>

@endsection
