<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'User Dashboard') - Cross hairs</title>
    <meta name="google-site-verification" content="pytzcoDkZoK3ZAyigYcbZaWU_NeXV11YztLRB9Td2pI" />
    <link rel="canonical" href="{{ url()->current() }}" />
     <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('crosshairlogo.png?v=2') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('crosshairlogo.png?v=2') }}">
        <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('crosshairlogo.png?v=2') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('crosshairlogo.png?v=2') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Orbitron:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            /* Primary colors */
            --primary-pink: #FF2D5F;
            --primary-coral: #FF6B7A;
            --primary-gradient: linear-gradient(135deg, #FF2D5F 0%, #FF6B7A 100%);

            /* Background colors */
            --dark-bg: #0A0B0F;
            --dark-card: #1A1B23;
            --dark-border: #2A2B35;
            --sidebar-bg: #12131A;

            /* Text colors */
            --text-primary: #FFFFFF;
            --text-secondary: #B4B6C7;
            --text-muted: #6B6D7A;

            /* Accent colors */
            --success: #00D25B;
            --warning: #FFB800;
            --danger: #FF4757;
            --info: #3498db;

            /* Effects */
            --glow-pink: 0 0 20px rgba(255, 45, 95, 0.3);
            --card-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark-bg);
            color: var(--text-primary);
            font-size: 14px;
            overflow-x: hidden;
        }

        /* User Layout Container */
        .user-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--dark-border);
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: var(--dark-bg);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--primary-pink);
            border-radius: 4px;
        }

        /* Sidebar Header */
        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid var(--dark-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            gap: 0.75rem;
        }

        .sidebar-logo-icon {
            width: 35px;
            height: 35px;
            /*background: var(--primary-gradient);*/
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .sidebar-logo-text {
            font-family: 'Orbitron', monospace;
            font-size: 1.1rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            white-space: nowrap;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 1.2rem;
            padding: 0.5rem;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            color: var(--primary-pink);
        }

        .sidebar.collapsed .sidebar-logo-text,
        .sidebar.collapsed .sidebar-toggle {
            display: none;
        }

        /* Sidebar Menu */
        .sidebar-menu {
            padding: 1rem 0;
        }

        .menu-section {
            margin-bottom: 1.5rem;
        }

        .menu-section-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 0 1rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .sidebar.collapsed .menu-section-title {
            display: none;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            font-size: 0.85rem;
        }

        .menu-item:hover {
            background: rgba(255, 45, 95, 0.1);
            color: var(--primary-pink);
        }

        .menu-item.active {
            background: rgba(255, 45, 95, 0.15);
            color: var(--primary-pink);
            border-right: 3px solid var(--primary-pink);
        }

        .menu-item i {
            font-size: 1.1rem;
            width: 24px;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .menu-item-text {
            white-space: nowrap;
        }

        .sidebar.collapsed .menu-item-text {
            display: none;
        }

        .sidebar.collapsed .menu-item {
            justify-content: center;
            padding: 0.75rem 0;
        }

        .sidebar.collapsed .menu-item i {
            margin-right: 0;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            transition: margin-left 0.3s ease;
        }

        .sidebar.collapsed + .main-content {
            margin-left: 70px;
        }

        /* Top Bar */
        .topbar {
            background: var(--dark-card);
            border-bottom: 1px solid var(--dark-border);
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 1.3rem;
            cursor: pointer;
        }

        .topbar-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .topbar-search {
            position: relative;
            display: flex;
            align-items: center;
        }

        .topbar-search input {
            background: var(--dark-bg);
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            color: var(--text-primary);
            font-size: 0.85rem;
            width: 250px;
            transition: all 0.3s ease;
        }

        .topbar-search input:focus {
            outline: none;
            border-color: var(--primary-pink);
            box-shadow: var(--glow-pink);
        }

        .topbar-search i {
            position: absolute;
            left: 0.75rem;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* User Menu */
        .user-menu-wrapper {
            position: relative;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            background: var(--dark-bg);
            border: 1px solid var(--dark-border);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-menu:hover {
            border-color: var(--primary-pink);
        }

        .user-menu.active {
            border-color: var(--primary-pink);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
            color: white;
            text-transform: uppercase;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .user-role {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        .user-menu i.fa-chevron-down {
            color: var(--text-muted);
            font-size: 0.75rem;
            transition: transform 0.3s ease;
        }

        .user-menu.active i.fa-chevron-down {
            transform: rotate(180deg);
        }

        /* User Dropdown */
        .user-dropdown {
            position: absolute;
            top: calc(100% + 0.5rem);
            right: 0;
            min-width: 220px;
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
            overflow: hidden;
        }

        .user-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-header {
            padding: 1rem;
            border-bottom: 1px solid var(--dark-border);
            background: rgba(255, 45, 95, 0.05);
        }

        .dropdown-user-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.2rem;
        }

        .dropdown-user-email {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .dropdown-menu {
            padding: 0.5rem;
            list-style: none;
            margin: 0;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .dropdown-item:hover {
            background: var(--dark-bg);
            color: var(--text-primary);
        }

        .dropdown-item i {
            width: 20px;
            font-size: 0.9rem;
        }

        .dropdown-item.logout {
            color: var(--danger);
        }

        .dropdown-item.logout:hover {
            background: rgba(255, 71, 87, 0.1);
            color: var(--danger);
        }

        .dropdown-divider {
            height: 1px;
            background: var(--dark-border);
            margin: 0.5rem 0;
        }

        /* Content Area */
        .content-area {
            padding: 1.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar.collapsed + .main-content {
                margin-left: 0;
            }

            .mobile-menu-btn {
                display: block;
            }

            .topbar-search {
                display: none;
            }

            .user-info {
                display: none;
            }

            .content-area {
                padding: 1rem;
            }
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
    <div class="user-layout">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
             <div class="sidebar-header">
                <a href="{{ route('user.dashboard') }}" class="sidebar-logo">
                    <div class="sidebar-logo-icon">
                        <img src="{{ asset('crosshairlogo.png?v=2') }}" 
                             alt="Crosshair Logo" 
                             style="width: 100%; height: 100%; object-fit: contain;"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <i class="fas fa-gamepad" style="display: none;"></i>
                    </div>
                    <span class="sidebar-logo-text">Cross hairs</span>
                </a>
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>

            <nav class="sidebar-menu">
                <div class="menu-section">
                    <div class="menu-section-title">Main</div>
                    <a href="{{ route('user.dashboard') }}" class="menu-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i>
                        <span class="menu-item-text">Dashboard</span>
                    </a>
                    <a href="#" class="menu-item">
                        <i class="fas fa-crosshairs"></i>
                        <span class="menu-item-text">Browse Crosshairs</span>
                    </a>
                </div>

                <div class="menu-section">
                    <div class="menu-section-title">My Content</div>
                    <a href="#" class="menu-item">
                        <i class="fas fa-heart"></i>
                        <span class="menu-item-text">Favorites</span>
                    </a>
                    <a href="#" class="menu-item">
                        <i class="fas fa-history"></i>
                        <span class="menu-item-text">Recent Views</span>
                    </a>
                    <a href="#" class="menu-item">
                        <i class="fas fa-bookmark"></i>
                        <span class="menu-item-text">Saved</span>
                    </a>
                </div>

                <div class="menu-section">
                    <div class="menu-section-title">Account</div>
                    <a href="#" class="menu-item">
                        <i class="fas fa-user"></i>
                        <span class="menu-item-text">Profile</span>
                    </a>
                    <a href="#" class="menu-item">
                        <i class="fas fa-cog"></i>
                        <span class="menu-item-text">Settings</span>
                    </a>
                    <a href="{{ route('logout') }}" class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="menu-item-text">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <div class="topbar">
                <div class="topbar-left">
                    <button class="mobile-menu-btn" id="mobileMenuBtn">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="topbar-title">@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="topbar-right">
                    <div class="topbar-search">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search crosshairs...">
                    </div>

                    <div class="user-menu-wrapper">
                        <div class="user-menu" onclick="toggleUserMenu()">
                            <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                            <div class="user-info">
                                <div class="user-name">{{ auth()->user()->name }}</div>
                                <div class="user-role">{{ ucfirst(auth()->user()->role) }}</div>
                            </div>
                            <i class="fas fa-chevron-down"></i>
                        </div>

                        <div class="user-dropdown" id="userDropdown">
                            <div class="dropdown-header">
                                <div class="dropdown-user-name">{{ auth()->user()->name }}</div>
                                <div class="dropdown-user-email">{{ auth()->user()->email }}</div>
                            </div>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('user.dashboard') }}" class="dropdown-item">
                                        <i class="fas fa-home"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-user"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item">
                                        <i class="fas fa-cog"></i>
                                        <span>Settings</span>
                                    </a>
                                </li>

                                <div class="dropdown-divider"></div>

                                <li>
                                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                        @csrf
                                        <button type="submit" class="dropdown-item logout" style="width: 100%; background: none; border: none; text-align: left;">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
            });
        }

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('mobile-active');
            });
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                    sidebar.classList.remove('mobile-active');
                }
            }
        });

        // User Menu Toggle
        function toggleUserMenu() {
            const menu = document.querySelector('.user-menu');
            const dropdown = document.getElementById('userDropdown');

            menu.classList.toggle('active');
            dropdown.classList.toggle('active');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const wrapper = document.querySelector('.user-menu-wrapper');
            const menu = document.querySelector('.user-menu');
            const dropdown = document.getElementById('userDropdown');

            if (wrapper && !wrapper.contains(event.target)) {
                menu.classList.remove('active');
                dropdown.classList.remove('active');
            }
        });

        // Close dropdown with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const menu = document.querySelector('.user-menu');
                const dropdown = document.getElementById('userDropdown');

                menu.classList.remove('active');
                dropdown.classList.remove('active');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>