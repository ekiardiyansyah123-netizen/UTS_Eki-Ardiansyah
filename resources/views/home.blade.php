
@extends('layouts.app')

@section('title', 'Home')

@section('content')

<section class="hero">
    <div class="hero-background"></div>

    <div class="container hero-content">

        <div class="hero-label">
            <span class="label-dot"></span>
            YOUR DAILY COFFEE RITUAL
        </div>

        <h1>
            Find your<br>
            <em>perfect</em> moment.
        </h1>

        <p class="hero-description">
            More than just coffee. A little escape from the ordinary,
            crafted to make every moment feel special.
        </p>

        <div class="hero-buttons">
            <a href="{{ route('menu') }}" class="btn btn-light">
                Discover Our Menu <span>↗</span>
            </a>

            <a href="{{ route('about') }}" class="btn btn-outline-light">
                Our Story
            </a>
        </div>

        <div class="hero-bottom">
            <div class="hero-rating">
                <span>★★★★★</span>
                <small>Made with love, served with warmth.</small>
            </div>

            <div class="hero-scroll">
                SCROLL TO DISCOVER ↓
            </div>
        </div>

    </div>
</section>

<section class="section intro-section">
    <div class="container intro-grid">

        <div class="intro-image-wrap">
            <img
                src="https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=900&q=85"
                alt="Coffee being prepared"
                class="intro-image"
            >

            <div class="image-caption">
                <span>01 / THE ESSENZA EXPERIENCE</span>
            </div>
        </div>

        <div class="intro-content">
            <span class="section-label">WELCOME TO ESSENZA</span>

            <h2>
                Good coffee.<br>
                <em>Better moments.</em>
            </h2>

            <p>
                At Essenza, we believe coffee is more than a drink.
                It's the pause you deserve, the conversation you love,
                and the moments that make life beautiful.
            </p>

            <p>
                Every cup is carefully crafted using quality ingredients
                and a little extra love.
            </p>

            <a href="{{ route('about') }}" class="text-link">
                Get to know us <span>→</span>
            </a>
        </div>

    </div>
</section>

<section class="section menu-section">
    <div class="container">

        <div class="section-heading">
            <div>
                <span class="section-label">MADE FOR YOUR MOMENT</span>
                <h2>Our <em>favorites.</em></h2>
            </div>

            <a href="{{ route('menu') }}" class="text-link">
                View all menu <span>→</span>
            </a>
        </div>

        <div class="product-grid">

            @foreach(array_slice($products, 0, 4) as $product)

                <article class="product-card">

                    <a href="{{ route('menu.detail', $product['slug']) }}" class="product-image">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">

                        <span class="product-tag">
                            ESSENZA FAVORITE
                        </span>
                    </a>

                    <div class="product-info">
                        <div>
                            <span class="product-category">{{ $product['category'] }}</span>
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
                        Discover <span>↗</span>
                    </a>

                </article>

            @endforeach

        </div>

    </div>
</section>

<section class="experience-section">
    <div class="container experience-grid">

        <div class="experience-content">
            <span class="section-label light-label">A MOMENT FOR YOURSELF</span>

            <h2>
                Slow down.<br>
                <em>Take a sip.</em>
            </h2>

            <p>
                Life moves fast. Let your coffee be the moment
                you pause, breathe, and enjoy the little things.
            </p>

            <a href="{{ route('menu') }}" class="btn btn-light">
                Find your favorite <span>↗</span>
            </a>
        </div>

        <div class="experience-image">
            <img
                src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1000&q=85"
                alt="Coffee shop experience"
            >
        </div>

    </div>
</section>

<section class="section values-section">
    <div class="container">

        <div class="center-heading">
            <span class="section-label">WHY ESSENZA</span>
            <h2>Every cup has a <em>purpose.</em></h2>
            <p>Small details. Thoughtfully made. Beautifully served.</p>
        </div>

        <div class="values-grid">

            <div class="value-card">
                <span class="value-number">01</span>
                <div class="value-icon">✦</div>
                <h3>Quality Ingredients</h3>
                <p>
                    We choose carefully selected ingredients
                    to create the perfect balance in every cup.
                </p>
            </div>

            <div class="value-card">
                <span class="value-number">02</span>
                <div class="value-icon">☕</div>
                <h3>Made with Care</h3>
                <p>
                    Every drink is prepared with attention,
                    passion, and a little extra love.
                </p>
            </div>

            <div class="value-card">
                <span class="value-number">03</span>
                <div class="value-icon">♡</div>
                <h3>Warm Experience</h3>
                <p>
                    A welcoming space where good coffee
                    and meaningful moments come together.
                </p>
            </div>

        </div>

    </div>
</section>

<section class="cta-section">
    <div class="container cta-content">
        <span class="section-label">YOUR NEXT FAVORITE CUP</span>

        <h2>
            Let's make your day<br>
            a little <em>better.</em>
        </h2>

        <a href="{{ route('menu') }}" class="btn btn-dark">
            Explore our menu <span>↗</span>
        </a>
    </div>
</section>

@endsection
