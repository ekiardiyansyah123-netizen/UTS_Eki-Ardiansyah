
@extends('layouts.app')

@section('title', 'Our Story')

@section('content')

<section class="page-hero">
    <div class="container">
        <span class="section-label">A LITTLE STORY ABOUT US</span>

        <h1>Our <em>story.</em></h1>

        <p>
            A love for coffee, a passion for meaningful moments.
        </p>
    </div>
</section>

<section class="section story-section">
    <div class="container story-grid">

        <div class="story-image">
            <img
                src="https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=1000&q=85"
                alt="Coffee preparation"
            >
        </div>

        <div class="story-content">
            <span class="section-label">THE ESSENZA BEGINNING</span>

            <h2>
                Born from a love<br>
                of <em>coffee.</em>
            </h2>

            <p>
                Essenza Coffee was created from a simple idea:
                coffee should make ordinary moments feel special.
            </p>

            <p>
                We believe the best experiences don't always need
                to be extraordinary. Sometimes, a good cup of coffee,
                a warm atmosphere, and a meaningful conversation
                are enough.
            </p>

            <p>
                That's why we bring quality ingredients, thoughtful
                preparation, and a welcoming atmosphere together
                in every experience.
            </p>
        </div>

    </div>
</section>

<section class="experience-section story-values">
    <div class="container experience-grid">

        <div class="experience-content">
            <span class="section-label light-label">OUR PHILOSOPHY</span>

            <h2>
                Sip the<br>
                <em>Good Vibes.</em>
            </h2>

            <p>
                A cup of coffee is an invitation to slow down,
                appreciate the present, and reconnect with yourself
                and the people around you.
            </p>

        </div>

        <div class="experience-image">
            <img
                src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1000&q=85"
                alt="Coffee and atmosphere"
            >
        </div>

    </div>
</section>

<section class="section values-section">
    <div class="container">

        <div class="center-heading">
            <span class="section-label">OUR VALUES</span>
            <h2>What we <em>believe.</em></h2>
        </div>

        <div class="values-grid">

            <div class="value-card">
                <span class="value-number">01</span>
                <div class="value-icon">✦</div>
                <h3>Authenticity</h3>
                <p>
                    Honest flavors, carefully chosen ingredients,
                    and genuine experiences.
                </p>
            </div>

            <div class="value-card">
                <span class="value-number">02</span>
                <div class="value-icon">♡</div>
                <h3>Hospitality</h3>
                <p>
                    Everyone deserves a warm welcome
                    and a comfortable place to be.
                </p>
            </div>

            <div class="value-card">
                <span class="value-number">03</span>
                <div class="value-icon">☕</div>
                <h3>Craftsmanship</h3>
                <p>
                    We care about every detail
                    in every cup we serve.
                </p>
            </div>

        </div>

    </div>
</section>

@endsection
