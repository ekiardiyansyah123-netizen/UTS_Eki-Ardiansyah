
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin') | Essenza Coffee</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/essenza.css') }}">
</head>

<body class="admin-body">

<div class="admin-layout">

    <aside class="admin-sidebar">

        <a href="{{ route('home') }}" class="brand admin-brand">
            <span class="brand-icon">E</span>

            <span class="brand-text">
                <strong>ESSENZA</strong>
                <small>COFFEE</small>
            </span>
        </a>

        <div class="sidebar-label">
            MANAGEMENT
        </div>

        <nav class="admin-nav">

            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span>▦</span>
                Dashboard
            </a>

            <a href="{{ route('admin.products') }}"
               class="{{ request()->routeIs('admin.products') ? 'active' : '' }}">
                <span>☕</span>
                Products
            </a>

            <a href="{{ route('menu') }}">
                <span>↗</span>
                View Website
            </a>

        </nav>

        <div class="sidebar-bottom">
            <div class="admin-profile">
                <div class="admin-avatar">E</div>

                <div>
                    <strong>Admin Essenza</strong>
                    <small>Administrator</small>
                </div>
            </div>
        </div>

    </aside>

    <main class="admin-main">

        <header class="admin-topbar">

            <button class="admin-menu-toggle" id="adminMenuToggle">
                ☰
            </button>

            <div class="admin-topbar-title">
                <span>ESSENZA COFFEE</span>
                <small>Management Panel</small>
            </div>

            <a href="{{ route('home') }}" class="admin-view-site">
                View Website ↗
            </a>

        </header>

        <div class="admin-content">
            @yield('content')
        </div>

    </main>

</div>

<script>
    const adminMenuToggle = document.getElementById('adminMenuToggle');
    const adminSidebar = document.querySelector('.admin-sidebar');

    if (adminMenuToggle && adminSidebar) {
        adminMenuToggle.addEventListener('click', () => {
            adminSidebar.classList.toggle('sidebar-open');
        });
    }
</script>

@stack('scripts')

</body>
</html>
