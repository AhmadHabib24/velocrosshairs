@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<style>
    /* Dashboard Specific Styles */
    .dashboard-header {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: var(--primary-gradient);
        opacity: 0.1;
        border-radius: 50%;
        transform: translate(50%, -50%);
    }
    
    .dashboard-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .dashboard-subtitle {
        color: var(--text-muted);
        font-size: 0.75rem;
    }
    
    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .stat-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 10px;
        padding: 1.25rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
        border-color: var(--primary-pink);
        box-shadow: var(--glow-pink);
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 80px;
        height: 80px;
        background: var(--primary-gradient);
        opacity: 0.05;
        border-radius: 50%;
        transform: translate(30%, -30%);
    }
    
    .stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        margin-bottom: 0.75rem;
    }
    
    .stat-icon.users {
        background: rgba(255, 45, 95, 0.1);
        color: var(--primary-pink);
    }
    
    .stat-icon.categories {
        background: rgba(255, 107, 53, 0.1);
        color: var(--primary-coral);
    }
    
    .stat-icon.crosshairs {
        background: rgba(0, 210, 91, 0.1);
        color: var(--success);
    }
    
    .stat-icon.views {
        background: rgba(52, 152, 219, 0.1);
        color: #3498db;
    }
    
    .stat-label {
        color: var(--text-muted);
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.4rem;
    }
    
    .stat-value {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1;
        margin-bottom: 0.4rem;
    }
    
    .stat-change {
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    
    .stat-change.positive {
        color: var(--success);
    }
    
    .stat-change.negative {
        color: var(--danger);
    }
    
    /* SEO Spotlight Section */
    .seo-spotlight {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 10px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }
    
    .seo-spotlight-header {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--dark-border);
    }
    
    .seo-spotlight-icon {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-size: 1rem;
    }
    
    .seo-spotlight-title {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-primary);
    }
    
    .seo-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.6rem 0;
        border-bottom: 1px solid var(--dark-border);
    }
    
    .seo-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    
    .seo-rank {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.9rem;
        flex-shrink: 0;
    }
    
    .seo-rank.rank-1 {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    }
    
    .seo-rank.rank-2 {
        background: linear-gradient(135deg, #C0C0C0 0%, #A8A8A8 100%);
        color: white;
    }
    
    .seo-rank.rank-3 {
        background: linear-gradient(135deg, #CD7F32 0%, #8B4513 100%);
        color: white;
    }
    
    .seo-rank.rank-other {
        background: rgba(52, 152, 219, 0.1);
        color: #3498db;
    }
    
    .seo-content {
        flex: 1;
        min-width: 0;
    }
    
    .seo-name {
        color: var(--text-primary);
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 0.2rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .seo-meta {
        display: flex;
        gap: 0.75rem;
        font-size: 0.65rem;
        color: var(--text-muted);
    }
    
    .seo-meta span {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .seo-actions {
        display: flex;
        gap: 0.4rem;
        flex-shrink: 0;
    }
    
    .seo-btn {
        width: 30px;
        height: 30px;
        border-radius: 6px;
        border: 1px solid var(--dark-border);
        background: var(--dark-bg);
        color: var(--text-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 0.75rem;
    }
    
    .seo-btn:hover {
        background: var(--dark-card);
        border-color: var(--primary-pink);
        color: var(--primary-pink);
        transform: translateY(-2px);
    }
    
    .seo-btn.copy-btn:hover {
        border-color: var(--success);
        color: var(--success);
    }
    
    /* Recent Activity Section */
    .activity-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .activity-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 10px;
        padding: 1.25rem;
    }
    
    .activity-header {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--dark-border);
    }
    
    .activity-icon {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-gradient);
        color: white;
        font-size: 1rem;
    }
    
    .activity-title {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-primary);
    }
    
    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .activity-item {
        padding: 0.6rem 0;
        border-bottom: 1px solid var(--dark-border);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .activity-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    
    .activity-item:first-child {
        padding-top: 0;
    }
    
    .activity-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: white;
        flex-shrink: 0;
        font-size: 0.75rem;
    }
    
    .activity-content {
        flex: 1;
    }
    
    .activity-text {
        color: var(--text-secondary);
        font-size: 0.75rem;
        margin-bottom: 0.2rem;
    }
    
    .activity-text strong {
        color: var(--text-primary);
    }
    
    .activity-time {
        color: var(--text-muted);
        font-size: 0.65rem;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 1.5rem;
        color: var(--text-muted);
    }
    
    .empty-state i {
        font-size: 2rem;
        margin-bottom: 0.75rem;
        opacity: 0.3;
    }
    
    .empty-state p {
        font-size: 0.75rem;
    }
</style>

<!-- Dashboard Header -->
<div class="dashboard-header">
    <h1 class="dashboard-title">Welcome back, {{ auth()->user()->name }}! 👋</h1>
    <p class="dashboard-subtitle">Here's what's happening with your platform today.</p>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <!-- Total Users -->
    <div class="stat-card">
        <div class="stat-icon users">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-label">Total Users</div>
        <div class="stat-value">{{ $stats['total_users'] }}</div>
        <div class="stat-change positive">
            <i class="fas fa-arrow-up"></i>
            <span>{{ $stats['active_users'] }} Active</span>
        </div>
    </div>
    
    <!-- Total Categories -->
    <div class="stat-card">
        <div class="stat-icon categories">
            <i class="fas fa-folder"></i>
        </div>
        <div class="stat-label">Categories</div>
        <div class="stat-value">{{ $stats['total_categories'] }}</div>
        <div class="stat-change positive">
            <i class="fas fa-check-circle"></i>
            <span>{{ $stats['active_categories'] }} Active</span>
        </div>
    </div>
    
    <!-- Total CrossChairs -->
    <div class="stat-card">
        <div class="stat-icon crosshairs">
            <i class="fas fa-crosshairs"></i>
        </div>
        <div class="stat-label">Crosshairs</div>
        <div class="stat-value">{{ $stats['total_crosschairs'] }}</div>
        <div class="stat-change positive">
            <i class="fas fa-fire"></i>
            <span>{{ $stats['active_crosschairs'] }} Published</span>
        </div>
    </div>
    
    <!-- Total Views -->
    <div class="stat-card">
        <div class="stat-icon views">
            <i class="fas fa-eye"></i>
        </div>
        <div class="stat-label">Total Views</div>
        <div class="stat-value">{{ number_format($stats['total_views']) }}</div>
        <div class="stat-change positive">
            <i class="fas fa-chart-line"></i>
            <span>{{ number_format($stats['total_copies']) }} Copies</span>
        </div>
    </div>
</div>

<!-- SEO Spotlight - Top Ranking CrossChairs -->
<div class="seo-spotlight">
    <div class="seo-spotlight-header">
        <div class="seo-spotlight-icon">
            <i class="fas fa-chart-line"></i>
        </div>
        <h3 class="seo-spotlight-title">SEO Spotlight - Top Ranking Crosshairs</h3>
    </div>
    @forelse($top_seo_crosschairs as $index => $crosschair)
        <div class="seo-item">
            <div class="seo-rank rank-{{ $index + 1 <= 3 ? $index + 1 : 'other' }}">
                #{{ $index + 1 }}
            </div>
            <div class="seo-content">
                <div class="seo-name">{{ $crosschair->name }}</div>
                <div class="seo-meta">
                    <span><i class="fas fa-eye"></i> {{ number_format($crosschair->views) }}</span>
                    <span><i class="fas fa-copy"></i> {{ number_format($crosschair->copies) }}</span>
                    <span><i class="fas fa-folder"></i> {{ $crosschair->category->name }}</span>
                </div>
            </div>
            <div class="seo-actions">
                <button class="seo-btn" onclick="copyShareLink('{{ url('/crosschair/' . $crosschair->slug) }}')" title="Copy Share Link">
                    <i class="fas fa-share-alt"></i>
                </button>
                <button class="seo-btn copy-btn" onclick="copyCrosshairCode('{{ $crosschair->crosshair_code }}')" title="Copy Code">
                    <i class="fas fa-code"></i>
                </button>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <i class="fas fa-chart-line"></i>
            <p>No crosshairs available for SEO ranking yet</p>
        </div>
    @endforelse
</div>

<!-- Recent Activity Section -->
<div class="activity-section">
    <!-- Recent Users -->
    <div class="activity-card">
        <div class="activity-header">
            <div class="activity-icon">
                <i class="fas fa-users"></i>
            </div>
            <h3 class="activity-title">Recent Users</h3>
        </div>
        <ul class="activity-list">
            @forelse($recent_users as $user)
                <li class="activity-item">
                    <div class="activity-avatar">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">
                            <strong>{{ $user->name }}</strong> joined as {{ ucfirst($user->role) }}
                        </div>
                        <div class="activity-time">
                            <i class="far fa-clock"></i> {{ $user->created_at->diffForHumans() }}
                        </div>
                    </div>
                </li>
            @empty
                <div class="empty-state">
                    <i class="fas fa-user-slash"></i>
                    <p>No recent users</p>
                </div>
            @endforelse
        </ul>
    </div>
    
    <!-- Recent CrossChairs -->
    <div class="activity-card">
        <div class="activity-header">
            <div class="activity-icon">
                <i class="fas fa-crosshairs"></i>
            </div>
            <h3 class="activity-title">Recent Crosshairs</h3>
        </div>
        <ul class="activity-list">
            @forelse($recent_crosschairs as $crosschair)
                <li class="activity-item">
                    <div class="activity-avatar" style="background: rgba(0, 210, 91, 0.2); color: var(--success);">
                        <i class="fas fa-crosshairs"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">
                            <strong>{{ $crosschair->name }}</strong> in {{ $crosschair->category->name }}
                        </div>
                        <div class="activity-time">
                            <i class="far fa-clock"></i> {{ $crosschair->created_at->diffForHumans() }}
                        </div>
                    </div>
                </li>
            @empty
                <div class="empty-state">
                    <i class="fas fa-crosshairs"></i>
                    <p>No recent crosshairs</p>
                </div>
            @endforelse
        </ul>
    </div>
    
    <!-- Popular CrossChairs -->
    <div class="activity-card">
        <div class="activity-header">
            <div class="activity-icon">
                <i class="fas fa-fire"></i>
            </div>
            <h3 class="activity-title">Most Popular</h3>
        </div>
        <ul class="activity-list">
            @forelse($popular_crosschairs as $crosschair)
                <li class="activity-item">
                    <div class="activity-avatar" style="background: rgba(255, 45, 95, 0.2); color: var(--primary-pink);">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">
                            <strong>{{ $crosschair->name }}</strong>
                        </div>
                        <div class="activity-time">
                            <i class="fas fa-eye"></i> {{ $crosschair->views }} views · 
                            <i class="fas fa-copy"></i> {{ $crosschair->copies }} copies
                        </div>
                    </div>
                </li>
            @empty
                <div class="empty-state">
                    <i class="fas fa-chart-line"></i>
                    <p>No popular crosshairs yet</p>
                </div>
            @endforelse
        </ul>
    </div>
</div>

@push('scripts')
<script>
    // Copy Crosshair Code Function
    function copyCrosshairCode(code) {
        navigator.clipboard.writeText(code).then(() => {
            showNotification('Crosshair code copied!', 'success');
        }).catch(err => {
            console.error('Failed to copy:', err);
            showNotification('Failed to copy code', 'error');
        });
    }
    
    // Copy Share Link Function
    function copyShareLink(url) {
        navigator.clipboard.writeText(url).then(() => {
            showNotification('Share link copied!', 'success');
        }).catch(err => {
            console.error('Failed to copy:', err);
            showNotification('Failed to copy link', 'error');
        });
    }
    
    // Show Notification
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 0.75rem 1.25rem;
            background: ${type === 'success' ? 'rgba(0, 210, 91, 0.9)' : 'rgba(255, 71, 87, 0.9)'};
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            z-index: 9999;
            font-size: 0.8rem;
            font-weight: 600;
            animation: slideIn 0.3s ease;
        `;
        notification.innerHTML = `<i class="fas fa-${type === 'success' ? 'check' : 'times'}-circle"></i> ${message}`;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }, 2500);
    }
    
    // Add CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
</script>
@endpush
@endsection