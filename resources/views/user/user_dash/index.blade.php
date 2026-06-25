@extends('user.user_dash.layout')

@section('title', 'Dashboard')

@section('content')
<style>
    /* Dashboard Header */
    .dashboard-header {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
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
    
    .header-content {
        position: relative;
        z-index: 1;
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
    
    /* Add Crosshair Button */
    .add-crosshair-btn {
        padding: 0.75rem 1.5rem;
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        z-index: 1;
    }
    
    .add-crosshair-btn:hover {
        transform: translateY(-3px);
        box-shadow: var(--glow-pink);
    }
    
    .add-crosshair-btn i {
        font-size: 1rem;
    }
    
    /* Quick Stats */
    .quick-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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
    }
    
    /* Section Grid */
    .section-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    /* Card Sections */
    .card-section {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 10px;
        padding: 1.25rem;
    }
    
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.6rem;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--dark-border);
    }
    
    .section-icon {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-gradient);
        color: white;
        font-size: 1rem;
        flex-shrink: 0;
    }
    
    .section-title {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-primary);
        flex: 1;
    }
    
    .section-link {
        font-size: 0.75rem;
        color: var(--primary-pink);
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .section-link:hover {
        opacity: 0.8;
    }
    
    /* Crosshair Items */
    .crosshair-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .crosshair-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        background: var(--dark-bg);
        border: 1px solid var(--dark-border);
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .crosshair-item:hover {
        border-color: var(--primary-pink);
        transform: translateX(5px);
    }
    
    .crosshair-preview {
        width: 45px;
        height: 45px;
        border-radius: 8px;
        background: rgba(255, 45, 95, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1.2rem;
        color: var(--primary-pink);
    }
    
    .crosshair-content {
        flex: 1;
        min-width: 0;
    }
    
    .crosshair-name {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.2rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .crosshair-meta {
        display: flex;
        gap: 0.75rem;
        font-size: 0.65rem;
        color: var(--text-muted);
    }
    
    .crosshair-meta span {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .crosshair-actions {
        display: flex;
        gap: 0.4rem;
        flex-shrink: 0;
    }
    
    .action-btn {
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
        font-size: 0.75rem;
    }
    
    .action-btn:hover {
        background: var(--dark-card);
        border-color: var(--primary-pink);
        color: var(--primary-pink);
        transform: translateY(-2px);
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 2rem 1rem;
        color: var(--text-muted);
    }
    
    .empty-state i {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        opacity: 0.3;
    }
    
    .empty-state p {
        font-size: 0.8rem;
        margin-bottom: 0.5rem;
    }
    
    .empty-state button {
        display: inline-block;
        margin-top: 0.75rem;
        padding: 0.5rem 1rem;
        background: var(--primary-gradient);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .empty-state button:hover {
        transform: translateY(-2px);
        box-shadow: var(--glow-pink);
    }
</style>

<!-- Dashboard Header -->
<div class="dashboard-header">
    <div class="header-content">
        <h1 class="dashboard-title">Welcome back, {{ auth()->user()->name }}! 👋</h1>
        <p class="dashboard-subtitle">Explore and manage your favorite crosshairs</p>
    </div>
    <button class="add-crosshair-btn" onclick="openUserAddModal()">
        <i class="fas fa-plus-circle"></i>
        Add Crosshair
    </button>
</div>

<!-- Quick Stats -->
<div class="quick-stats">
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(52, 152, 219, 0.1); color: #3498db;">
            <i class="fas fa-crosshairs"></i>
        </div>
        <div class="stat-label">Total Crosshairs</div>
        <div class="stat-value">{{ $stats['total_crosshairs'] ?? 0 }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(0, 210, 91, 0.1); color: var(--success);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-label">Approved</div>
        <div class="stat-value">{{ $stats['approved'] ?? 0 }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(255, 184, 0, 0.1); color: var(--warning);">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-label">Pending</div>
        <div class="stat-value">{{ $stats['pending'] ?? 0 }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(52, 152, 219, 0.1); color: var(--info);">
            <i class="fas fa-eye"></i>
        </div>
        <div class="stat-label">Total Views</div>
        <div class="stat-value">{{ number_format($stats['total_views'] ?? 0) }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(0, 210, 91, 0.1); color: var(--success);">
            <i class="fas fa-copy"></i>
        </div>
        <div class="stat-label">Total Copies</div>
        <div class="stat-value">{{ number_format($stats['total_copies'] ?? 0) }}</div>
    </div>
    
    @if(($stats['rejected'] ?? 0) > 0)
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(255, 71, 87, 0.1); color: var(--danger);">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-label">Rejected</div>
        <div class="stat-value">{{ $stats['rejected'] ?? 0 }}</div>
    </div>
    @endif
</div>

<!-- Main Content Grid -->
<div class="section-grid">
    <!-- My Approved Crosshairs -->
    <div class="card-section">
        <div class="section-header">
            <div class="section-icon" style="background: linear-gradient(135deg, #00D25B 0%, #00A346 100%);">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3 class="section-title">My Approved Crosshairs</h3>
            <a href="#" class="section-link">View All →</a>
        </div>
        
        @if(isset($my_crosshairs['approved']) && $my_crosshairs['approved']->count() > 0)
            <div class="crosshair-list">
                @foreach($my_crosshairs['approved'] as $crosshair)
                    <div class="crosshair-item">
                        <div class="crosshair-preview">
                            <i class="fas fa-crosshairs"></i>
                        </div>
                        <div class="crosshair-content">
                            <div class="crosshair-name">{{ $crosshair->name }}</div>
                            <div class="crosshair-meta">
                                <span><i class="fas fa-folder"></i> {{ $crosshair->category->name ?? 'N/A' }}</span>
                                <span><i class="fas fa-eye"></i> {{ $crosshair->views }}</span>
                                <span><i class="fas fa-copy"></i> {{ $crosshair->copies }}</span>
                            </div>
                        </div>
                        <div class="crosshair-actions">
                            <button class="action-btn" onclick="viewCrosshair('{{ $crosshair->slug }}')" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="action-btn" onclick="copyCrosshairCode('{{ $crosshair->crosshair_code }}')" title="Copy">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-crosshairs"></i>
                <p>No approved crosshairs yet</p>
                <button onclick="openUserAddModal()">Create New Crosshair</button>
            </div>
        @endif
    </div>
    
    <!-- My Pending Crosshairs -->
    <div class="card-section">
        <div class="section-header">
            <div class="section-icon" style="background: linear-gradient(135deg, #FFB800 0%, #FF8C00 100%);">
                <i class="fas fa-clock"></i>
            </div>
            <h3 class="section-title">Pending Approval</h3>
            <a href="#" class="section-link">View All →</a>
        </div>
        
        @if(isset($my_crosshairs['pending']) && $my_crosshairs['pending']->count() > 0)
            <div class="crosshair-list">
                @foreach($my_crosshairs['pending'] as $crosshair)
                    <div class="crosshair-item">
                        <div class="crosshair-preview" style="background: rgba(255, 184, 0, 0.1); color: var(--warning);">
                            <i class="fas fa-crosshairs"></i>
                        </div>
                        <div class="crosshair-content">
                            <div class="crosshair-name">{{ $crosshair->name }}</div>
                            <div class="crosshair-meta">
                                <span><i class="fas fa-folder"></i> {{ $crosshair->category->name ?? 'N/A' }}</span>
                                <span><i class="far fa-clock"></i> {{ $crosshair->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="crosshair-actions">
                            {{-- <button class="action-btn" onclick="viewCrosshair('{{ $crosshair->slug }}')" title="View">
                                <i class="fas fa-eye"></i>
                            </button> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-clock"></i>
                <p>No pending crosshairs</p>
            </div>
        @endif
    </div>
</div>

<!-- Rejected Crosshairs (Only show if there are any) -->
@if(isset($my_crosshairs['rejected']) && $my_crosshairs['rejected']->count() > 0)
<div class="card-section" style="margin-bottom: 1.5rem;">
    <div class="section-header">
        <div class="section-icon" style="background: linear-gradient(135deg, #FF4757 0%, #E84118 100%);">
            <i class="fas fa-times-circle"></i>
        </div>
        <h3 class="section-title">Rejected Crosshairs</h3>
        <a href="#" class="section-link">View All →</a>
    </div>
    
    <div class="crosshair-list">
        @foreach($my_crosshairs['rejected'] as $crosshair)
            <div class="crosshair-item">
                <div class="crosshair-preview" style="background: rgba(255, 71, 87, 0.1); color: var(--danger);">
                    <i class="fas fa-crosshairs"></i>
                </div>
                <div class="crosshair-content">
                    <div class="crosshair-name">{{ $crosshair->name }}</div>
                    <div class="crosshair-meta">
                        <span><i class="fas fa-folder"></i> {{ $crosshair->category->name ?? 'N/A' }}</span>
                        <span><i class="far fa-clock"></i> {{ $crosshair->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="crosshair-actions">
                    {{-- <button class="action-btn" onclick="viewCrosshair('{{ $crosshair->slug }}')" title="View">
                        <i class="fas fa-eye"></i>
                    </button> --}}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

<!-- Include User Add Crosshair Modal -->
@include('user.modals.add_crosshair')

@push('scripts')
<script>
    // View Crosshair
function viewCrosshair(slug) {
    const baseUrl = "{{ route('crosshairs.index') }}";  // Yeh generate karega: /crosshairs
    window.location.href = baseUrl + '/' + slug;         // Final: /crosshairs/hindi-test
}
    
    // Copy Crosshair Code
    function copyCrosshairCode(code) {
        navigator.clipboard.writeText(code).then(() => {
            showNotification('Crosshair code copied!', 'success');
        }).catch(err => {
            console.error('Failed to copy:', err);
            showNotification('Failed to copy code', 'error');
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