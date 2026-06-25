<header class="navbar" id="navbar">
    <div class="navbar-container">
        <a href="{{ route('home') }}" class="logo">
            <!-- Your logo here - replace with actual logo -->
            <div style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: var(--primary-gradient); border-radius: 8px;">
                <i class="fas fa-crosshairs" style="color: white; font-size: 20px;"></i>
            </div>
            <span class="logo-text">Velocrosshairs</span>
        </a>
        
        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li class="dropdown">
                <a href="{{ route('crosshairs.index') }}" class="{{ request()->routeIs('crosshairs.*') ? 'active' : '' }}">
                    Crosshairs <i class="fas fa-chevron-down"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('crosshairs.index') }}">Browse All</a>
                    <a href="{{ route('crosshairs.categories') }}">Categories</a>
                    <a href="{{ route('crosshairs.create') }}">Designer</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="{{ route('community.index') }}" class="{{ request()->routeIs('community.*') ? 'active' : '' }}">
                    Community <i class="fas fa-chevron-down"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('community.index') }}">Community Hub</a>
                    <a href="{{ route('community.leaderboard') }}">Leaderboard</a>
                </div>
            </li>
            <li><a href="{{ route('download') }}" class="{{ request()->routeIs('download') ? 'active' : '' }}">Download</a></li>
        </ul>
        
        <div class="nav-auth">
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
        
        <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<style>
.dropdown {
    position: relative;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 0.5rem;
    padding: 0.5rem 0;
    min-width: 180px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
    margin-top: 0.5rem;
}

.dropdown:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-menu a {
    display: block;
    padding: 0.75rem 1rem;
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.3s ease;
}

.dropdown-menu a:hover {
    background: rgba(255, 45, 95, 0.1);
    color: var(--primary-pink);
}

.user-dropdown {
    position: relative;
}

.user-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 0.5rem;
    padding: 0.5rem 1rem;
    color: var(--text-primary);
    cursor: pointer;
    transition: all 0.3s ease;
}

.user-btn:hover {
    border-color: var(--primary-pink);
}

.user-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    object-fit: cover;
}

.user-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 0.5rem;
    padding: 0.5rem 0;
    min-width: 200px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
    margin-top: 0.5rem;
}

.user-menu.active {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.user-menu a {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.3s ease;
}

.user-menu a:hover {
    background: rgba(255, 45, 95, 0.1);
    color: var(--primary-pink);
}

.menu-divider {
    height: 1px;
    background: var(--dark-border);
    margin: 0.5rem 0;
}

.logout-btn {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    background: none;
    border: none;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: left;
}

.logout-btn:hover {
    background: rgba(255, 71, 87, 0.1);
    color: var(--danger);
}
</style>

<script>
function toggleUserMenu() {
    const menu = document.getElementById('userMenu');
    menu.classList.toggle('active');
}

// Close user menu when clicking outside
document.addEventListener('click', function(event) {
    const userDropdown = document.querySelector('.user-dropdown');
    const userMenu = document.getElementById('userMenu');
    
    if (userDropdown && !userDropdown.contains(event.target)) {
        userMenu.classList.remove('active');
    }
});
</script>