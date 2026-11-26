
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Essenza Coffee') | Sip the Good Vibes</title>

    <meta name="description" content="Essenza Coffee - Sip the Good Vibes. Nikmati kopi premium dengan pengalaman yang hangat dan berkesan.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/essenza.css') }}">
</head>

<body>

    <header class="navbar">
        <div class="container nav-container">

            <a href="{{ route('home') }}" class="brand">
                <span class="brand-icon">E</span>

                <span class="brand-text">
                    <strong>ESSENZA</strong>
                    <small>COFFEE</small>
                </span>
            </a>

            <nav class="nav-links" id="navLinks">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('menu') }}" class="{{ request()->routeIs('menu*') ? 'active' : '' }}">Our Menu</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Our Story</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            </nav>

            <div class="nav-actions">
                <a href="{{ route('menu') }}" class="btn btn-dark nav-cta">
                    Explore Menu
                    <span>↗</span>
                </a>

                <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                    ☰
                </button>
            </div>

        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">

            <div class="footer-main">

                <div class="footer-brand">
                    <a href="{{ route('home') }}" class="brand brand-footer">
                        <span class="brand-icon">E</span>

                        <span class="brand-text">
                            <strong>ESSENZA</strong>
                            <small>COFFEE</small>
                        </span>
                    </a>

                    <p>
                        A little moment of coffee,<br>
                        a lot of good vibes.
                    </p>
                </div>

                <div class="footer-column">
                    <h4>Explore</h4>
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('menu') }}">Our Menu</a>
                    <a href="{{ route('about') }}">Our Story</a>
                    <a href="{{ route('contact') }}">Contact</a>
                </div>

                <div class="footer-column">
                    <h4>Visit Us</h4>
                    <p>Bandar Lampung, Indonesia</p>
                    <p>Every day · 09.00 – 22.00</p>
                </div>

                <div class="footer-column">
                    <h4>Connect</h4>
                    <a href="#">Instagram</a>
                    <a href="#">WhatsApp</a>
                    <a href="#">Email</a>
                </div>

            </div>

            <div class="footer-bottom">
                <span>© {{ date('Y') }} Essenza Coffee.</span>
                <span>Crafted with warmth & coffee.</span>
            </div>

        </div>
    </footer>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.getElementById('navLinks');

        if (menuToggle && navLinks) {
            menuToggle.addEventListener('click', () => {
                navLinks.classList.toggle('show');
            });
        }

        document.querySelectorAll('.reveal').forEach((element) => {
            element.classList.add('visible');
        });
    </script>

    @stack('scripts')

</body>
</html>
