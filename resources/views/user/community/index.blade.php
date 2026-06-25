@extends('layouts.app')

@section('title', 'Community Hub - PrecisionAim')

@section('content')
<div class="community-hub">
    <div class="container">
        <!-- Hero Section -->
        <section class="community-hero">
            <div class="hero-content">
                <h1 class="hero-title">Community <span class="text-gradient">Hub</span></h1>
                <p class="hero-subtitle">
                    Connect with fellow gamers, share your creations, and discover the best crosshairs 
                    from our amazing community of {{ number_format(52000) }}+ players.
                </p>
                
                <div class="community-stats">
                    <div class="stat-card">
                        <div class="stat-number">{{ number_format(567) }}</div>
                        <div class="stat-label">Community Crosshairs</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ number_format(52847) }}</div>
                        <div class="stat-label">Active Members</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ number_format(1250) }}</div>
                        <div class="stat-label">Creators</div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Featured Section -->
        <section class="featured-section">
            <h2 class="section-title">Featured <span class="text-gradient">Creators</span></h2>
            
            <div class="creators-grid">
                @foreach($topContributors as $contributor)
                <div class="creator-card">
                    <div class="creator-avatar">
                        <img src="{{ $contributor['avatar'] }}" alt="{{ $contributor['username'] }}">
                        <div class="rank-badge">#{{ $contributor['rank'] }}</div>
                    </div>
                    <div class="creator-info">
                        <h3 class="creator-name">{{ $contributor['username'] }}</h3>
                        <div class="creator-stats">
                            <div class="stat">
                                <i class="fas fa-upload"></i>
                                <span>{{ $contributor['uploads'] }} uploads</span>
                            </div>
                            <div class="stat">
                                <i class="fas fa-download"></i>
                                <span>{{ number_format($contributor['downloads']) }} downloads</span>
                            </div>
                        </div>
                        <button class="btn btn-outline btn-sm">View Profile</button>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        
        <!-- Recent Activity -->
        <section class="activity-section">
            <div class="activity-grid">
                <div class="activity-column">
                    <h3 class="activity-title">
                        <i class="fas fa-fire text-gradient"></i>
                        Recent Activity
                    </h3>
                    
                    <div class="activity-feed">
                        @foreach($recentActivity as $activity)
                        <div class="activity-item">
                            <div class="activity-icon {{ $activity['type'] }}">
                                @if($activity['type'] == 'upload')
                                    <i class="fas fa-upload"></i>
                                @else
                                    <i class="fas fa-star"></i>
                                @endif
                            </div>
                            <div class="activity-content">
                                <p><strong>{{ $activity['user'] }}</strong> {{ $activity['action'] }} 
                                   <span class="highlight">{{ $activity['item'] }}</span></p>
                                <span class="time">{{ $activity['time'] }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="leaderboard-preview">
                    <h3 class="activity-title">
                        <i class="fas fa-trophy text-gradient"></i>
                        Top Contributors
                    </h3>
                    
                    <div class="leaderboard-list">
                        @foreach(array_slice($topContributors, 0, 5) as $index => $contributor)
                        <div class="leaderboard-item">
                            <div class="rank">#{{ $index + 1 }}</div>
                            <img src="{{ $contributor['avatar'] }}" alt="{{ $contributor['username'] }}" class="avatar">
                            <div class="contributor-info">
                                <div class="name">{{ $contributor['username'] }}</div>
                                <div class="score">{{ number_format($contributor['downloads']) }} downloads</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <a href="{{ route('community.leaderboard') }}" class="btn btn-primary btn-sm">
                        View Full Leaderboard
                    </a>
                </div>
            </div>
        </section>
        
        <!-- Community Guidelines -->
        <section class="guidelines-section">
            <h2 class="section-title">Community <span class="text-gradient">Guidelines</span></h2>
            
            <div class="guidelines-grid">
                <div class="guideline-card">
                    <div class="guideline-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Be Respectful</h3>
                    <p>Treat all community members with respect and kindness.</p>
                </div>
                
                <div class="guideline-card">
                    <div class="guideline-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>Quality First</h3>
                    <p>Share high-quality crosshairs that enhance gameplay experience.</p>
                </div>
                
                <div class="guideline-card">
                    <div class="guideline-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>No Cheating</h3>
                    <p>Only share legitimate crosshairs that comply with anti-cheat systems.</p>
                </div>
                
                <div class="guideline-card">
                    <div class="guideline-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Help Others</h3>
                    <p>Support fellow gamers with feedback and constructive criticism.</p>
                </div>
            </div>
        </section>
    </div>
</div>

<style>
.community-hub {
    padding: 2rem 0;
}

.community-hero {
    text-align: center;
    padding: 4rem 0;
    background: linear-gradient(135deg, var(--dark-bg) 0%, var(--dark-card) 100%);
    border-radius: 2rem;
    margin-bottom: 4rem;
}

.hero-title {
    font-family: 'Orbitron', monospace;
    font-size: clamp(2.5rem, 4vw, 3.5rem);
    font-weight: 700;
    margin-bottom: 1rem;
}

.hero-subtitle {
    font-size: 1.2rem;
    color: var(--text-secondary);
    margin-bottom: 3rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.community-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    max-width: 800px;
    margin: 0 auto;
}

.stat-card {
    background: var(--dark-card);
    padding: 2rem;
    border-radius: 1rem;
    border: 1px solid var(--dark-border);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    border-color: var(--primary-pink);
}

.stat-number {
    font-family: 'Orbitron', monospace;
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-pink);
    display: block;
}

.stat-label {
    color: var(--text-secondary);
    margin-top: 0.5rem;
}

.featured-section {
    margin-bottom: 4rem;
}

.section-title {
    font-family: 'Orbitron', monospace;
    font-size: 2.5rem;
    text-align: center;
    margin-bottom: 3rem;
}

.creators-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.creator-card {
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1.5rem;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
}

.creator-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 60px rgba(255, 45, 95, 0.15);
    border-color: var(--primary-pink);
}

.creator-avatar {
    position: relative;
    display: inline-block;
    margin-bottom: 1.5rem;
}

.creator-avatar img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 3px solid var(--primary-pink);
}

.rank-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: var(--primary-gradient);
    color: white;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: bold;
}

.creator-name {
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.creator-stats {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-bottom: 1.5rem;
}

.stat {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.stat i {
    color: var(--primary-coral);
}

.activity-section {
    margin-bottom: 4rem;
}

.activity-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
}

.activity-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-family: 'Orbitron', monospace;
    font-size: 1.5rem;
    margin-bottom: 2rem;
}

.activity-feed {
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1rem;
    padding: 2rem;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid var(--dark-border);
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.activity-icon.upload {
    background: var(--primary-gradient);
}

.activity-icon.featured {
    background: linear-gradient(135deg, #FFD700, #FFA500);
}

.activity-content p {
    color: var(--text-secondary);
    margin: 0 0 0.5rem 0;
}

.highlight {
    color: var(--primary-pink);
    font-weight: 600;
}

.time {
    color: var(--text-muted);
    font-size: 0.85rem;
}

.leaderboard-preview {
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1rem;
    padding: 2rem;
    height: fit-content;
}

.leaderboard-list {
    margin-bottom: 2rem;
}

.leaderboard-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid var(--dark-border);
}

.leaderboard-item:last-child {
    border-bottom: none;
}

.rank {
    font-family: 'Orbitron', monospace;
    font-weight: 700;
    color: var(--primary-pink);
    width: 30px;
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.contributor-info {
    flex: 1;
}

.name {
    color: var(--text-primary);
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.score {
    color: var(--text-secondary);
    font-size: 0.85rem;
}

.guidelines-section {
    text-align: center;
}

.guidelines-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
}

.guideline-card {
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1rem;
    padding: 2rem;
    transition: all 0.3s ease;
}

.guideline-card:hover {
    transform: translateY(-4px);
    border-color: var(--primary-pink);
}

.guideline-icon {
    width: 60px;
    height: 60px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.5rem;
    color: white;
}

.guideline-card h3 {
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.guideline-card p {
    color: var(--text-secondary);
    line-height: 1.6;
}

@media (max-width: 768px) {
    .activity-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .creators-grid {
        grid-template-columns: 1fr;
    }
    
    .community-stats {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection