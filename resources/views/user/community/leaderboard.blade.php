@extends('layouts.app')

@section('title', 'Community Leaderboard - PrecisionAim')

@section('content')
<div class="leaderboard-page">
    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <h1 class="page-title">Community <span class="text-gradient">Leaderboard</span></h1>
            <p class="page-subtitle">
                Recognize our top contributors and most active community members.
            </p>
        </div>
        
        <!-- Category Tabs -->
        <div class="leaderboard-tabs">
            @foreach($categories as $category)
            <button class="tab-btn {{ $loop->first ? 'active' : '' }}" data-category="{{ $category }}">
                {{ ucfirst($category) }}
            </button>
            @endforeach
        </div>
        
        <!-- Top 3 Podium -->
        <div class="podium-section">
            <div class="podium">
                @foreach(array_slice($leaderboard, 0, 3) as $index => $user)
                <div class="podium-place place-{{ $index + 1 }}">
                    <div class="podium-rank">
                        @if($index === 0)
                            <i class="fas fa-crown"></i>
                        @elseif($index === 1)
                            <i class="fas fa-medal"></i>
                        @else
                            <i class="fas fa-award"></i>
                        @endif
                        <span>#{{ $index + 1 }}</span>
                    </div>
                    <div class="podium-avatar">
                        <img src="{{ $user['avatar'] }}" alt="{{ $user['username'] }}">
                    </div>
                    <h3 class="podium-name">{{ $user['username'] }}</h3>
                    <div class="podium-stats">
                        <div class="stat">
                            <span class="value">{{ number_format($user['downloads']) }}</span>
                            <span class="label">Downloads</span>
                        </div>
                        <div class="stat">
                            <span class="value">{{ $user['uploads'] }}</span>
                            <span class="label">Uploads</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Full Leaderboard -->
        <div class="leaderboard-table">
            <div class="table-header">
                <h3>Full Rankings</h3>
                <div class="table-controls">
                    <select class="period-select">
                        <option>All Time</option>
                        <option>This Year</option>
                        <option>This Month</option>
                        <option>This Week</option>
                    </select>
                </div>
            </div>
            
            <div class="table-content">
                @foreach($leaderboard as $index => $user)
                <div class="leaderboard-row {{ $index < 3 ? 'top-three' : '' }}">
                    <div class="rank-column">
                        <span class="rank-number">#{{ $index + 1 }}</span>
                        @if($index < 3)
                            <div class="rank-badge badge-{{ $index + 1 }}"></div>
                        @endif
                    </div>
                    
                    <div class="user-column">
                        <img src="{{ $user['avatar'] }}" alt="{{ $user['username'] }}" class="user-avatar">
                        <div class="user-info">
                            <h4 class="username">{{ $user['username'] }}</h4>
                            <span class="user-title">Community Contributor</span>
                        </div>
                    </div>
                    
                    <div class="stats-column">
                        <div class="stat-item">
                            <i class="fas fa-download"></i>
                            <span>{{ number_format($user['downloads']) }}</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-upload"></i>
                            <span>{{ $user['uploads'] }}</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-star"></i>
                            <span>{{ $user['average_rating'] }}</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-trophy"></i>
                            <span>{{ $user['featured_count'] }}</span>
                        </div>
                    </div>
                    
                    <div class="actions-column">
                        <button class="btn btn-outline btn-sm">View Profile</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Achievement Showcase -->
        <div class="achievements-showcase">
            <h3 class="showcase-title">Community Achievements</h3>
            <div class="achievements-grid">
                <div class="achievement-item">
                    <div class="achievement-icon gold">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="achievement-info">
                        <h4>Download King</h4>
                        <p>Most downloaded crosshair creator</p>
                        <span class="achievement-holder">ProGamer123</span>
                    </div>
                </div>
                
                <div class="achievement-item">
                    <div class="achievement-icon silver">
                        <i class="fas fa-upload"></i>
                    </div>
                    <div class="achievement-info">
                        <h4>Prolific Creator</h4>
                        <p>Most crosshairs uploaded</p>
                        <span class="achievement-holder">CrosshairKing</span>
                    </div>
                </div>
                
                <div class="achievement-item">
                    <div class="achievement-icon bronze">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="achievement-info">
                        <h4>Quality Master</h4>
                        <p>Highest average rating</p>
                        <span class="achievement-holder">AimMaster</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.leaderboard-page {
    padding: 2rem 0;
}

.page-header {
    text-align: center;
    margin-bottom: 3rem;
}

.page-title {
    font-family: 'Orbitron', monospace;
    font-size: 3rem;
    margin-bottom: 1rem;
}

.page-subtitle {
    font-size: 1.2rem;
    color: var(--text-secondary);
}

.leaderboard-tabs {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-bottom: 3rem;
}

.tab-btn {
    padding: 0.75rem 2rem;
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 2rem;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s ease;
}

.tab-btn.active,
.tab-btn:hover {
    background: var(--primary-gradient);
    color: white;
    border-color: var(--primary-pink);
}

.podium-section {
    margin-bottom: 4rem;
}

.podium {
    display: grid;
    grid-template-columns: 1fr 1.2fr 1fr;
    gap: 2rem;
    max-width: 800px;
    margin: 0 auto;
    align-items: end;
}

.podium-place {
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1.5rem;
    padding: 2rem 1.5rem;
    text-align: center;
    position: relative;
    transition: all 0.3s ease;
}

.podium-place.place-1 {
    transform: translateY(-20px);
    border-color: #FFD700;
    background: linear-gradient(135deg, var(--dark-card), rgba(255, 215, 0, 0.1));
}

.podium-place.place-2 {
    border-color: #C0C0C0;
    background: linear-gradient(135deg, var(--dark-card), rgba(192, 192, 192, 0.1));
}

.podium-place.place-3 {
    border-color: #CD7F32;
    background: linear-gradient(135deg, var(--dark-card), rgba(205, 127, 50, 0.1));
}

.podium-rank {
    position: absolute;
    top: -15px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--primary-gradient);
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    color: white;
    font-size: 0.8rem;
}

.podium-rank i {
    font-size: 1.2rem;
    margin-bottom: 0.2rem;
}

.podium-avatar {
    margin: 2rem 0 1rem;
}

.podium-avatar img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 3px solid var(--primary-pink);
}

.podium-name {
    color: var(--text-primary);
    margin-bottom: 1rem;
    font-family: 'Orbitron', monospace;
}

.podium-stats {
    display: flex;
    justify-content: space-around;
    gap: 1rem;
}

.podium-stats .stat {
    text-align: center;
}

.podium-stats .value {
    display: block;
    font-family: 'Orbitron', monospace;
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--primary-pink);
}

.podium-stats .label {
    font-size: 0.8rem;
    color: var(--text-secondary);
}

.leaderboard-table {
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1rem;
    margin-bottom: 4rem;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2rem;
    border-bottom: 1px solid var(--dark-border);
}

.table-header h3 {
    font-family: 'Orbitron', monospace;
    color: var(--text-primary);
    margin: 0;
}

.period-select {
    background: var(--dark-bg);
    border: 1px solid var(--dark-border);
    border-radius: 0.5rem;
    padding: 0.5rem 1rem;
    color: var(--text-primary);
}

.leaderboard-row {
    display: grid;
    grid-template-columns: 80px 1fr 300px 150px;
    align-items: center;
    gap: 2rem;
    padding: 1.5rem 2rem;
    border-bottom: 1px solid var(--dark-border);
    transition: all 0.3s ease;
}

.leaderboard-row:hover {
    background: rgba(255, 45, 95, 0.05);
}

.leaderboard-row:last-child {
    border-bottom: none;
}

.rank-column {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.rank-number {
    font-family: 'Orbitron', monospace;
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--primary-pink);
}

.rank-badge {
    width: 20px;
    height: 20px;
    border-radius: 50%;
}

.rank-badge.badge-1 { background: #FFD700; }
.rank-badge.badge-2 { background: #C0C0C0; }
.rank-badge.badge-3 { background: #CD7F32; }

.user-column {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.username {
    color: var(--text-primary);
    margin: 0 0 0.25rem 0;
    font-weight: 600;
}

.user-title {
    color: var(--text-secondary);
    font-size: 0.85rem;
}

.stats-column {
    display: flex;
    gap: 2rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.stat-item i {
    color: var(--primary-coral);
    width: 16px;
}

.achievements-showcase {
    text-align: center;
}

.showcase-title {
    font-family: 'Orbitron', monospace;
    font-size: 2rem;
    margin-bottom: 2rem;
    color: var(--text-primary);
}

.achievements-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.achievement-item {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1rem;
    padding: 2rem;
    transition: all 0.3s ease;
}

.achievement-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
}

.achievement-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    flex-shrink: 0;
}

.achievement-icon.gold { background: linear-gradient(135deg, #FFD700, #FFA500); }
.achievement-icon.silver { background: linear-gradient(135deg, #C0C0C0, #A8A8A8); }
.achievement-icon.bronze { background: linear-gradient(135deg, #CD7F32, #B8860B); }

.achievement-info {
    text-align: left;
    flex: 1;
}

.achievement-info h4 {
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.achievement-info p {
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.achievement-holder {
    color: var(--primary-pink);
    font-weight: 600;
}

@media (max-width: 768px) {
    .podium {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .podium-place.place-1 {
        transform: none;
        order: 1;
    }
    
    .podium-place.place-2 {
        order: 2;
    }
    
    .podium-place.place-3 {
        order: 3;
    }
    
    .leaderboard-row {
        grid-template-columns: 60px 1fr;
        gap: 1rem;
    }
    
    .stats-column {
        grid-column: 1 / -1;
        margin-top: 1rem;
        justify-content: space-around;
    }
    
    .actions-column {
        grid-column: 1 / -1;
        margin-top: 1rem;
    }
    
    .achievement-item {
        flex-direction: column;
        text-align: center;
    }
    
    .achievement-info {
        text-align: center;
    }
}
</style>
@endsection
