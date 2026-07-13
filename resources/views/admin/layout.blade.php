<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Cross hairs</title>
    <meta name="google-site-verification" content="pytzcoDkZoK3ZAyigYcbZaWU_NeXV11YztLRB9Td2pI" />
    <!-- Favicon (multi-size) -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('crosshairlogo.png?v=2') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('crosshairlogo.png?v=2') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('crosshairlogo.png?v=2') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('crosshairlogo.png?v=2') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Orbitron:wght@400;500;700;900&display=swap"
        rel="stylesheet">
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
            --text-muted: #8A8D9F;

            /* Accent colors */
            --success: #00D25B;
            --warning: #FFB800;
            --danger: #FF4757;

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

        /* Admin Layout Container */
        .admin-layout {
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

        .menu-badge {
            margin-left: auto;
            background: var(--primary-pink);
            color: white;
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 10px;
            font-weight: 600;
        }

        .sidebar.collapsed .menu-badge {
            display: none;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            transition: margin-left 0.3s ease;
        }

        .sidebar.collapsed+.main-content {
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

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .topbar-btn {
            background: var(--dark-bg);
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .topbar-btn:hover {
            border-color: var(--primary-pink);
            color: var(--primary-pink);
        }

        .topbar-btn .badge {
            position: absolute;
            top: 0;
            right: 0;
            transform: translate(40%, -40%);
            background: var(--danger);
            color: white;
            font-size: 0.65rem;
            padding: 0.2rem 0.4rem;
            border-radius: 50rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 18px;
            height: 18px;
            line-height: 1;
            white-space: nowrap;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 0.75rem;
            background: var(--dark-bg);
            border: 1px solid var(--dark-border);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-menu:hover {
            border-color: var(--primary-pink);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.85rem;
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

            .sidebar.collapsed+.main-content {
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
    </style>
    <style>
        .user-menu-wrapper {
            position: relative;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-menu:hover {
            background: var(--dark-bg);
            border-color: var(--primary-pink);
        }

        .user-menu.active {
            background: var(--dark-bg);
            border-color: var(--primary-pink);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
            font-size: 1rem;
            text-transform: uppercase;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.1rem;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .user-menu i.fa-chevron-down {
            transition: transform 0.3s ease;
        }

        .user-menu.active i.fa-chevron-down {
            transform: rotate(180deg);
        }

        /* Dropdown Menu */
        .user-dropdown {
            position: absolute;
            top: calc(100% + 0.5rem);
            right: 0;
            min-width: 200px;
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

        /* Notification Dropdown Styles */
        .notification-wrapper {
            position: relative;
        }

        .notification-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 380px;
            max-height: 500px;
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            display: none;
            flex-direction: column;
            z-index: 1000;
            animation: slideDown 0.3s ease;
        }

        .notification-dropdown.active {
            display: flex;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .notification-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--dark-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-header h3 {
            margin: 0;
            font-size: 1rem;
            color: var(--text-primary);
            font-weight: 600;
        }

        .mark-all-read {
            background: none;
            border: none;
            color: var(--primary-pink);
            font-size: 0.85rem;
            cursor: pointer;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            transition: 0.2s;
        }

        .mark-all-read:hover {
            background: rgba(255, 45, 95, 0.1);
        }

        .notification-list {
            flex: 1;
            overflow-y: auto;
            max-height: 400px;
        }

        .notification-list::-webkit-scrollbar {
            width: 6px;
        }

        .notification-list::-webkit-scrollbar-track {
            background: var(--dark-bg);
        }

        .notification-list::-webkit-scrollbar-thumb {
            background: var(--dark-border);
            border-radius: 3px;
        }

        .notification-list::-webkit-scrollbar-thumb:hover {
            background: var(--primary-pink);
        }

        .notification-loading {
            padding: 2rem;
            text-align: center;
            color: var(--text-muted);
        }

        .notification-item {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--dark-border);
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            gap: 1rem;
            position: relative;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item:hover {
            background: rgba(255, 45, 95, 0.05);
        }

        .notification-item.unread {
            background: rgba(255, 45, 95, 0.08);
        }

        .notification-item.unread::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--primary-pink);
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1.1rem;
        }

        .notification-icon.info {
            background: rgba(0, 123, 255, 0.15);
            color: #007bff;
        }

        .notification-icon.warning {
            background: rgba(255, 193, 7, 0.15);
            color: #ffc107;
        }

        .notification-icon.success {
            background: rgba(40, 167, 69, 0.15);
            color: #28a745;
        }

        .notification-content {
            flex: 1;
        }

        .notification-title {
            font-weight: 600;
            color: var(--text-primary);
            margin: 0 0 0.25rem;
            font-size: 0.9rem;
        }

        .notification-message {
            color: var(--text-secondary);
            font-size: 0.85rem;
            margin: 0 0 0.5rem;
            line-height: 1.4;
        }

        .notification-time {
            color: var(--text-muted);
            font-size: 0.75rem;
        }

        .notification-empty {
            padding: 3rem 2rem;
            text-align: center;
            color: var(--text-muted);
        }

        .notification-empty i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        .notification-footer {
            padding: 0.75rem 1.25rem;
            border-top: 1px solid var(--dark-border);
            text-align: center;
        }

        .view-all-btn {
            color: var(--primary-pink);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: 0.2s;
        }

        .view-all-btn:hover {
            color: var(--primary-coral);
        }

        /* Badge pulse animation for unread */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.8;
                transform: scale(1.1);
            }
        }

        .badge {
            animation: pulse 2s infinite;
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
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
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
                    <a href="{{ route('admin.dashboard') }}"
                        class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i>
                        <span class="menu-item-text">Dashboard</span>
                    </a>
                </div>

                <div class="menu-section">
                    <div class="menu-section-title">Management</div>
                    
                    <a href="{{route('admin.users.index')}}" class="menu-item">
                        <i class="fas fa-users"></i>
                        <span class="menu-item-text">Users</span>
                    </a>
                    
                    <a href="{{ route('admin.categories.index') }}"
                        class="menu-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-tags"></i>
                        <span class="menu-item-text">Categories</span>
                    </a>
                    
                    <a href="{{route('admin.CrossChair.index')}}" class="menu-item">
                        <i class="fas fa-crosshairs"></i>
                        <span class="menu-item-text">Crosshairs</span>
                    </a>
                    
                    <a href="{{route('admin.CrossChairbg.index')}}" class="menu-item">
                        <i class="fas fa-images"></i>
                        <span class="menu-item-text">Background images</span>
                    </a>
                    
                    <a href="{{route('admin.contacts.index')}}" class="menu-item">
                        <i class="fas fa-envelope"></i>
                        <span class="menu-item-text">Contact Us Details</span>
                    </a>
                    
                </div>

                <div class="menu-section">
                    <div class="menu-section-title">Blog Management</div>
                    
                    <a href="{{ route('admin.blogs.index') }}" class="menu-item {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                        <i class="fas fa-blog"></i>
                        <span class="menu-item-text">Blogs</span>
                    </a>

                    <a href="{{ route('admin.blog-categories.index') }}" class="menu-item {{ request()->routeIs('admin.blog-categories.*') ? 'active' : '' }}">
                        <i class="fas fa-list"></i>
                        <span class="menu-item-text">Blog Categories</span>
                    </a>

                    <a href="{{ route('admin.tags.index') }}" class="menu-item {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                        <i class="fas fa-tags"></i>
                        <span class="menu-item-text">Tags</span>
                    </a>
                </div>

                <div class="menu-section">
                    <div class="menu-section-title">Settings</div>
                    <a href="#" class="menu-item">
                        <i class="fas fa-cog"></i>
                        <span class="menu-item-text">Settings</span>
                    </a>
                    <a href="{{ route('logout') }}" class="menu-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                        <input type="text" placeholder="Search...">
                    </div>

                    <div class="topbar-actions">
                        <!-- Notification Dropdown -->
                        <div class="notification-wrapper">
                            <button class="topbar-btn" id="notificationBtn">
                                <i class="fas fa-bell"></i>
                                <span class="badge" id="notificationBadge">
                                    {{ \App\Models\Notification::unread()->count() }}
                                </span>
                            </button>
                            
                            <div class="notification-dropdown" id="notificationDropdown">
                                <div class="notification-header">
                                    <h3>Notifications</h3>
                                    <button class="mark-all-read" id="markAllRead">
                                        <i class="fas fa-check-double"></i> Mark all read
                                    </button>
                                </div>
                                
                                <div class="notification-list" id="notificationList">
                                    <div class="notification-loading">
                                        <i class="fas fa-spinner fa-spin"></i>
                                        Loading notifications...
                                    </div>
                                </div>
                                
                                <div class="notification-footer">
                                    <a href="{{ route('admin.notifications.index') }}" class="view-all-btn">
                                        View All Notifications
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Email Notification Dropdown -->
                        <div class="notification-wrapper">
                            <button class="topbar-btn" id="emailBtn">
                                <i class="fas fa-envelope"></i>
                                <span class="badge" id="emailBadge" style="{{ \App\Models\EmailLog::where('is_read', false)->count() > 0 ? '' : 'display:none;' }}">
                                    {{ \App\Models\EmailLog::where('is_read', false)->count() }}
                                </span>
                            </button>
                            
                            <div class="notification-dropdown" id="emailDropdown">
                                <div class="notification-header">
                                    <h3>Email Logs</h3>
                                    <button class="mark-all-read" id="markAllEmailRead">
                                        <i class="fas fa-check-double"></i> Mark all read
                                    </button>
                                </div>
                                
                                <div class="notification-list" id="emailList">
                                    <div class="notification-loading">
                                        <i class="fas fa-spinner fa-spin"></i>
                                        Loading emails...
                                    </div>
                                </div>
                                
                                <div class="notification-footer">
                                    <!-- Optional View All if you create an index page -->
                                    <a href="#" class="view-all-btn">
                                        Email Notification Center
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="user-menu-wrapper">
                        <div class="user-menu" onclick="toggleUserMenu()">
                            <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                            <div class="user-info">
                                <div class="user-name">{{ auth()->user()->name }}</div>
                                <div class="user-role">{{ ucfirst(auth()->user()->role) }}</div>
                            </div>
                            <i class="fas fa-chevron-down" style="color: var(--text-muted); font-size: 0.8rem;"></i>
                        </div>

                        <div class="user-dropdown" id="userDropdown">
                            <div class="dropdown-header">
                                <div class="dropdown-user-name">{{ auth()->user()->name }}</div>
                                <div class="dropdown-user-email">{{ auth()->user()->email }}</div>
                            </div>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
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
                                        <button type="submit" class="dropdown-item logout"
                                            style="width: 100%; background: none; border: none; text-align: left;">
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
    </script>
    <script>
        function toggleUserMenu() {
            const menu = document.querySelector('.user-menu');
            const dropdown = document.getElementById('userDropdown');

            menu.classList.toggle('active');
            dropdown.classList.toggle('active');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            const wrapper = document.querySelector('.user-menu-wrapper');
            const menu = document.querySelector('.user-menu');
            const dropdown = document.getElementById('userDropdown');

            if (wrapper && !wrapper.contains(event.target)) {
                menu.classList.remove('active');
                dropdown.classList.remove('active');
            }
        });

        // Close dropdown with Escape key
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                const menu = document.querySelector('.user-menu');
                const dropdown = document.getElementById('userDropdown');

                menu.classList.remove('active');
                dropdown.classList.remove('active');
            }
        });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const notificationBtn = document.getElementById('notificationBtn');
        const notificationDropdown = document.getElementById('notificationDropdown');
        const notificationList = document.getElementById('notificationList');
        const notificationBadge = document.getElementById('notificationBadge');
        const markAllReadBtn = document.getElementById('markAllRead');
        
        // Toggle notification dropdown
        notificationBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            notificationDropdown.classList.toggle('active');
            
            if (notificationDropdown.classList.contains('active')) {
                loadNotifications();
            }
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!notificationDropdown.contains(e.target) && e.target !== notificationBtn && !notificationBtn.contains(e.target)) {
                notificationDropdown.classList.remove('active');
            }
        });
        
        // Load notifications
        function loadNotifications() {
            fetch('{{ route("admin.notifications.unread") }}')
                .then(response => response.json())
                .then(data => {
                    displayNotifications(data.notifications);
                    updateBadge(data.unread_count);
                })
                .catch(error => {
                    console.error('Error loading notifications:', error);
                    notificationList.innerHTML = `
                        <div class="notification-empty">
                            <i class="fas fa-exclamation-triangle"></i>
                            <p>Failed to load notifications</p>
                        </div>
                    `;
                });
        }
        
        // Display notifications
        function displayNotifications(notifications) {
            if (notifications.length === 0) {
                notificationList.innerHTML = `
                    <div class="notification-empty">
                        <i class="fas fa-bell-slash"></i>
                        <p>No new notifications</p>
                    </div>
                `;
                return;
            }
            
            notificationList.innerHTML = notifications.map(notification => `
                <div class="notification-item ${notification.is_read ? '' : 'unread'}" 
                     data-id="${notification.id}"
                     data-link="${notification.link || '#'}">
                    <div class="notification-icon ${notification.color}">
                        <i class="${notification.icon}"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-title">${notification.title}</div>
                        <div class="notification-message">${notification.message}</div>
                        <div class="notification-time">${formatTime(notification.created_at)}</div>
                    </div>
                </div>
            `).join('');
            
            // Add click handlers to notification items
            document.querySelectorAll('.notification-item').forEach(item => {
                item.addEventListener('click', function() {
                    const notificationId = this.dataset.id;
                    const link = this.dataset.link;
                    
                    markAsRead(notificationId, () => {
                        if (link && link !== '#' && link !== 'null') {
                            window.location.href = link;
                        }
                    });
                });
            });
        }
        
        // Mark notification as read
        function markAsRead(notificationId, callback) {
            fetch(`/admin/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadNotifications();
                    if (callback) callback();
                }
            })
            .catch(error => console.error('Error:', error));
        }
        
        // Mark all as read
        markAllReadBtn.addEventListener('click', function() {
            fetch('{{ route("admin.notifications.readAll") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadNotifications();
                }
            })
            .catch(error => console.error('Error:', error));
        });
        
        // Update badge count
        function updateBadge(count) {
            if (count > 0) {
                notificationBadge.textContent = count > 99 ? '99+' : count;
                notificationBadge.style.display = 'flex';
            } else {
                notificationBadge.style.display = 'none';
            }
        }
        
        // Format time
        function formatTime(timestamp) {
            const date = new Date(timestamp);
            const now = new Date();
            const diff = Math.floor((now - date) / 1000);
            
            if (diff < 60) return 'Just now';
            if (diff < 3600) return Math.floor(diff / 60) + ' minutes ago';
            if (diff < 86400) return Math.floor(diff / 3600) + ' hours ago';
            if (diff < 604800) return Math.floor(diff / 86400) + ' days ago';
            
            return date.toLocaleDateString();
        }
        
        // Auto-refresh notifications every 30 seconds
        setInterval(() => {
            if (!notificationDropdown.classList.contains('active')) {
                fetch('{{ route("admin.notifications.unread") }}')
                    .then(response => response.json())
                    .then(data => {
                        updateBadge(data.unread_count);
                    });
            }
        }, 30000);
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const emailBtn = document.getElementById('emailBtn');
        const emailDropdown = document.getElementById('emailDropdown');
        const emailList = document.getElementById('emailList');
        const emailBadge = document.getElementById('emailBadge');
        const markAllEmailReadBtn = document.getElementById('markAllEmailRead');
        
        // Toggle email dropdown
        emailBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            emailDropdown.classList.toggle('active');
            
            if (emailDropdown.classList.contains('active')) {
                loadEmails();
            }
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!emailDropdown.contains(e.target) && e.target !== emailBtn && !emailBtn.contains(e.target)) {
                emailDropdown.classList.remove('active');
            }
        });
        
        // Load emails
        function loadEmails() {
            fetch('{{ route("admin.emails.unread") }}')
                .then(response => response.json())
                .then(data => {
                    displayEmails(data.emails);
                    updateEmailBadge(data.unread_count);
                })
                .catch(error => {
                    console.error('Error loading emails:', error);
                    emailList.innerHTML = `
                        <div class="notification-empty">
                            <i class="fas fa-exclamation-triangle"></i>
                            <p>Failed to load emails</p>
                        </div>
                    `;
                });
        }
        
        // Display emails
        function displayEmails(emails) {
            if (emails.length === 0) {
                emailList.innerHTML = `
                    <div class="notification-empty">
                        <i class="fas fa-envelope-open"></i>
                        <p>No new emails</p>
                    </div>
                `;
                return;
            }
            
            emailList.innerHTML = emails.map(email => `
                <div class="notification-item ${email.is_read ? '' : 'unread'}" 
                     data-link="${email.link || '#'}">
                    <div class="notification-icon ${email.color}">
                        <i class="${email.icon}"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-title">${email.title}</div>
                        <div class="notification-message">${email.message}</div>
                        <div class="notification-time">${formatTime(email.created_at)}</div>
                    </div>
                </div>
            `).join('');
            
            // Add click handlers to email items
            document.querySelectorAll('#emailList .notification-item').forEach(item => {
                item.addEventListener('click', function() {
                    const link = this.dataset.link;
                    if (link && link !== '#' && link !== 'null') {
                        window.location.href = link;
                    }
                });
            });
        }
        
        // Mark all as read
        markAllEmailReadBtn.addEventListener('click', function() {
            fetch('{{ route("admin.emails.readAll") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadEmails();
                }
            })
            .catch(error => console.error('Error:', error));
        });
        
        // Update badge count
        function updateEmailBadge(count) {
            if (count > 0) {
                emailBadge.textContent = count > 99 ? '99+' : count;
                emailBadge.style.display = 'flex';
            } else {
                emailBadge.style.display = 'none';
            }
        }
        
        // Format time
        function formatTime(timestamp) {
            const date = new Date(timestamp);
            const now = new Date();
            const diff = Math.floor((now - date) / 1000);
            
            if (diff < 60) return 'Just now';
            if (diff < 3600) return Math.floor(diff / 60) + ' minutes ago';
            if (diff < 86400) return Math.floor(diff / 3600) + ' hours ago';
            if (diff < 604800) return Math.floor(diff / 86400) + ' days ago';
            
            return date.toLocaleDateString();
        }
        
        // Auto-refresh emails every 30 seconds
        setInterval(() => {
            if (!emailDropdown.classList.contains('active')) {
                fetch('{{ route("admin.emails.unread") }}')
                    .then(response => response.json())
                    .then(data => {
                        updateEmailBadge(data.unread_count);
                    });
            }
        }, 30000);
    });
    </script>

    @stack('scripts')
</body>

</html>