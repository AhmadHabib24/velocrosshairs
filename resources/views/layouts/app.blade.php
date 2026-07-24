<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="pytzcoDkZoK3ZAyigYcbZaWU_NeXV11YztLRB9Td2pI" />
    <title>@yield('title', 'Velocrosshairs - Professional Gaming Crosshairs')</title>
    <meta name="description"
        content="@yield('description', 'Download professional gaming crosshairs, create custom crosshair overlays, and improve your aim with our advanced crosshair technology.')">
    <meta name="keywords" content="@yield('keywords', 'gaming, crosshairs, valorant, overlays')">
    <link rel="canonical" href="{{ url()->current() }}" />
        <!-- Favicon (multi-size) -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('crosshairlogo.png?v=2') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('crosshairlogo.png?v=2') }}">
        <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('crosshairlogo.png?v=2') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('crosshairlogo.png?v=2') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preload" href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'" />
    <noscript><link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" /></noscript>
    
    <link rel="preload" href="https://fonts.bunny.net/css?family=orbitron:400,500,700,900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'" />
    <noscript><link href="https://fonts.bunny.net/css?family=orbitron:400,500,700,900&display=swap" rel="stylesheet" /></noscript>
    <!-- Defer Bootstrap CSS -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"></noscript>

    <!-- Defer Icons (FontAwesome) -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>

    <style>
        /* Override FontAwesome font-display to swap */
        @font-face {
          font-family: 'Font Awesome 6 Free';
          font-style: normal;
          font-weight: 900;
          font-display: swap;
          src: url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-solid-900.woff2") format("woff2"),
               url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-solid-900.ttf") format("truetype");
        }
        @font-face {
          font-family: 'Font Awesome 6 Brands';
          font-style: normal;
          font-weight: 400;
          font-display: swap;
          src: url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-brands-400.woff2") format("woff2"),
               url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/webfonts/fa-brands-400.ttf") format("truetype");
        }
        
        :root {
            --primary-pink: #FF2D5F;
            --primary-coral: #FF6B7A;
            --primary-gradient: linear-gradient(135deg, #FF2D5F 0%, #FF6B7A 100%);

            --dark-bg: #0A0B0F;
            --dark-card: #1A1B23;
            --dark-border: #2A2B35;
            --text-primary: #FFFFFF;
            --text-secondary: #B4B6C7;
            --text-muted: #8A8D9F;

            --success: #00D25B;
            --warning: #FFB800;
            --danger: #FF4757;

            --glow-pink: 0 0 20px rgba(255, 45, 95, 0.3);
            --glow-coral: 0 0 20px rgba(255, 107, 122, 0.3);
            --card-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark-bg);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .font-gaming { font-family: 'Orbitron', monospace; }

        /* ==========================
           Navigation (Renamed)
        ========================== */
        .vc-navbar {
            background: rgba(10, 11, 15, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--dark-border);
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .vc-navbar.scrolled {
            background: rgba(10, 11, 15, 0.98);
            box-shadow: var(--card-shadow);
        }

        .vc-navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            height: 72px;

            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            column-gap: 2rem;
        }

        .vc-nav-left {
            justify-self: start;
            display: flex;
            align-items: center;
        }

        .vc-logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--text-primary);
        }

        .vc-logo img {
            width: 88px;
            height: 88px;
            margin-right: 0.75rem;
            display: block;
        }

        .vc-nav-links {
            justify-self: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .vc-nav-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .vc-nav-links a:hover,
        .vc-nav-links a.active {
            color: var(--primary-pink);
            text-shadow: var(--glow-pink);
        }

        .vc-nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-gradient);
            transition: width 0.3s ease;
        }

        .vc-nav-links a:hover::after,
        .vc-nav-links a.active::after { width: 100%; }

        .vc-nav-auth {
            justify-self: end;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Dropdown */
        .vc-nav-links li { position: relative; }

        .vc-dropdown-menu {
            display: block;
            position: absolute;
            top: 100%;
            left: 0;
            background: #0f1114;
            padding: 8px 0;
            min-width: 200px;
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.6);
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transform: translateY(6px);
            transition: opacity 180ms ease, transform 180ms ease, visibility 180ms;
        }

        .vc-dropdown-menu a {
            display: block;
            padding: 8px 16px;
            color: var(--text-secondary);
            text-decoration: none;
            white-space: nowrap;
        }

        .vc-dropdown-menu a:hover {
            color: var(--primary-pink);
            background: rgba(255, 45, 95, 0.06);
        }

        .vc-nav-links li.vc-dropdown:hover > .vc-dropdown-menu,
        .vc-nav-links li.vc-dropdown.open > .vc-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .vc-mobile-menu-btn {
            display: none;
            flex-direction: column;
            gap: 4px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
        }

        .vc-mobile-menu-btn span {
            width: 25px;
            height: 3px;
            background: var(--text-primary);
        }
        .vc-mobile-auth {
            display: none;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--primary-gradient);
            color: white;
            box-shadow: var(--glow-pink);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(255, 45, 95, 0.4);
            color: white;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary-pink);
            color: var(--primary-pink);
        }

        .btn-outline:hover {
            background: var(--primary-pink);
            color: white;
            box-shadow: var(--glow-pink);
        }

        .btn-ghost {
            background: transparent;
            color: var(--text-secondary);
            padding: 0.6rem 0;
        }

        .btn-ghost:hover {
            color: var(--primary-pink);
            background: rgba(255, 45, 95, 0.1);
        }

        .main-content {
            margin-top: 80px;
            min-height: calc(100vh - 80px);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .footer {
            background: var(--dark-card);
            border-top: 1px solid var(--dark-border);
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            color: var(--text-primary);
            margin-bottom: 1rem;
            font-family: 'Orbitron', monospace;
        }

        .footer-section ul { list-style: none; }
        .footer-section li { margin-bottom: 0.5rem; }

        .footer-section a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section a:hover { color: var(--primary-pink); }

        .footer-bottom {
            border-top: 1px solid var(--dark-border);
            padding-top: 1rem;
            text-align: center;
            color: var(--text-muted);
        }
        .footer-brand{
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 0.75rem;
        }
        
        .footer-logo-img{
            width: 90px;     /* size adjust here */
            height: 90px;
            object-fit: contain;
            display: block;
        }
        .footer-socials{
            display: flex;
            gap: 12px;
            margin-top: 0.5rem;
            flex-wrap: wrap;
        }
        
        .footer-social{
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--dark-bg);
            border: 1px solid var(--dark-border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            font-size: 18px;
            transition: all 0.25s ease;
            text-decoration: none;
        }
        
        .footer-social:hover{
            background: var(--primary-pink);
            color: white;
            border-color: var(--primary-pink);
            transform: translateY(-2px);
            box-shadow: var(--glow-pink);
        }



        /* Responsive */
        @media (max-width: 768px) {
            .vc-navbar-container {
                display: flex;
                justify-content: space-between;
                padding: 0 1rem;
                position: relative;
            }
            .vc-mobile-auth {
        display: block;   /* mobile menu open ho to auth dikhe */
        margin-top: 0.5rem;
        padding-top: 0.5rem;
        border-top: 1px solid var(--dark-border);
    }

            .vc-nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: rgba(10, 11, 15, 0.98);
                flex-direction: column;
                padding: 1.5rem 2rem;
                border-top: 1px solid var(--dark-border);
                gap: 1rem;
            }

            .vc-nav-links.active { display: flex; }

            .vc-mobile-menu-btn { display: flex; }

            /* Desktop auth hide on mobile (auth will be inside dropdown now) */
            .vc-nav-auth { display: none; }

            .container { padding: 0 1rem; }
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 2rem 0;
            gap: 0.5rem;
            justify-content: center;
        }

        .page-item .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .page-item .page-link i {
            font-size: 14px;
            width: auto;
            margin: 0;
        }

        .page-item.active .page-link {
            background: var(--primary-pink);
            color: #fff;
            border-color: var(--primary-pink);
            box-shadow: var(--glow-pink);
        }

        .page-item:not(.active):not(.disabled) .page-link:hover {
            border-color: var(--primary-pink);
            color: var(--primary-pink);
        }

        .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
            background: var(--dark-bg);
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Navigation -->
    <nav class="vc-navbar" id="navbar">
        <div class="vc-navbar-container">

            <!-- Left: Logo -->
            <div class="vc-nav-left">
                <a href="{{ route('/') }}" class="vc-logo">
                    <img src="{{ asset('crosshairlogo-small.png?v=2') }}" alt="Velocrosshairs Logo">
                </a>
            </div>

            <!-- Center: Nav Links -->
            <ul class="vc-nav-links" id="navLinks">
                <li>
                    <a href="{{ route('/') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                </li>

                <li class="vc-dropdown">
                    <a href="{{ route('crosshairs.index') }}"
                       class="{{ request()->routeIs('crosshairs.*') ? 'active' : '' }}">
                        Crosshairs
                    </a>

                    @if(isset($navCategories) && $navCategories->count())
                        <ul class="vc-dropdown-menu">
                            @foreach($navCategories as $category)
                                <li>
                                    <a href="{{ route('crosshairs.index', ['category' => $category->slug]) }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
                <li>
                    <a href="{{ route('about-us') }}" class="{{ request()->routeIs('about-us') ? 'active' : '' }}">About Us</a>
                </li>
                <li>
                    <a href="{{ route('blogs.index') }}" class="{{ request()->routeIs('blogs.*') ? 'active' : '' }}">Blog</a>
                </li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                {{-- ✅ MOBILE AUTH LINKS INSIDE MENU --}}
                <li class="vc-mobile-auth">
                    @auth
                        <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" class="btn btn-ghost" style="color: var(--primary-pink); width: 100%; justify-content: flex-start; margin-bottom: 0.5rem;">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline w-100 mt-2">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline w-100">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary mt-2 w-100">Sign Up</a>
                    @endauth
                </li>
            </ul>

            <!-- Right: Auth buttons (Desktop only) -->
            <div class="vc-nav-auth">
                @auth
                    <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" class="btn btn-ghost" style="color: var(--primary-pink);">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-outline" style="margin-left: 0.5rem;">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline" style="margin-right: 0.5rem;">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button class="vc-mobile-menu-btn" onclick="toggleMobileMenu()" aria-label="Toggle navigation">
                <span></span><span></span><span></span>
            </button>

        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
    <div class="container">
        <div class="footer-content">

            <div class="footer-section">
                <!-- ✅ LOGO + NAME -->
                <div class="footer-brand">
                    <img src="{{ asset('crosshairlogo-small.png?v=2') }}" alt="Velocrosshairs Logo" class="footer-logo-img">
                    <!--<h3>Velocrosshairs</h3>-->
                </div>

                <p style="color: var(--text-secondary); margin-bottom: 1rem;">
                    Professional gaming crosshairs and overlay technology for competitive gamers.
                </p>

                <div class="footer-socials">
                    <a href="https://www.facebook.com/profile.php?id=61554388204731" class="footer-social" title="Facebook" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                
                    <a href="https://www.pinterest.com/velocrosshairs/" class="footer-social" title="Pinterest" aria-label="Pinterest">
                        <i class="fab fa-pinterest-p"></i>
                    </a>
                
                    <a href="https://www.instagram.com/velocrosshairs/" class="footer-social" title="Instagram" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                
                    <a href="#" class="footer-social" title="TikTok" aria-label="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                
                    <a href="https://x.com/velocrosshairs" class="footer-social" title="X (Twitter)" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                
                    <a href="https://www.youtube.com/channel/UCvRaClS5p9q3n00U8T_xGnw" class="footer-social" title="YouTube" aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>

            </div>

            <div class="footer-section">
                <h3>Product</h3>
                <ul>
                    <li><a href="{{ route('crosshairs.index') }}">Browse Crosshairs</a></li>
                    <li><a href="{{ route('crosshairs.index') }}">Categories</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Support</h3>
                <ul>
                    {{-- ❌ Removed these pages --}}
                    {{-- <li><a href="#">Help Center</a></li> --}}
                    {{-- <li><a href="#">Installation Guide</a></li> --}}
                    {{-- <li><a href="#">Compatibility</a></li> --}}
                    <li><a href="{{ route('about-us') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a href="{{ route('Privacy-Policy') }}">Privacy Policy</a></li>
                    
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Velocrosshairs. All rights reserved.
               
            </p>
        </div>
    </div>
</footer>


    <!-- Scripts -->
    <script defer>
        window.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('scroll', function () {
                const navbar = document.getElementById('navbar');
                if (window.scrollY > 50) navbar.classList.add('scrolled');
                else navbar.classList.remove('scrolled');
            });

            document.addEventListener('click', function (event) {
                const navLinks = document.getElementById('navLinks');
                const mobileBtn = document.querySelector('.vc-mobile-menu-btn');

                if (!navLinks.contains(event.target) && !mobileBtn.contains(event.target)) {
                    navLinks.classList.remove('active');
                }
            });
        });

        function toggleMobileMenu() {
            document.getElementById('navLinks').classList.toggle('active');
        }
    </script>

    <script defer>
        window.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function (e) {
                const dropdowns = document.querySelectorAll('.vc-nav-links li.vc-dropdown');

                const clickedDropdown = e.target.closest('.vc-nav-links li.vc-dropdown');
                if (clickedDropdown) {
                    dropdowns.forEach(d => { if (d !== clickedDropdown) d.classList.remove('open'); });
                    clickedDropdown.classList.toggle('open');
                    return;
                }
                dropdowns.forEach(d => d.classList.remove('open'));
            });

            window.addEventListener('resize', () => {
                document.querySelectorAll('.vc-nav-links li.vc-dropdown').forEach(d => d.classList.remove('open'));
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
