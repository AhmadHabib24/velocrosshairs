@extends('layouts.app')

@section('title', 'My Profile - PrecisionAim')

@section('content')
<div class="profile-page">
    <div class="container">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-avatar">
                <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=120&h=120&fit=crop&crop=face" 
                     alt="{{ $user->name }}" class="avatar-img">
                <button class="edit-avatar-btn" title="Change Avatar">
                    <i class="fas fa-camera"></i>
                </button>
            </div>
            
            <div class="profile-info">
                <h1 class="profile-name">{{ $user->name }}</h1>
                <p class="profile-email">{{ $user->email }}</p>
                <p class="member-since">Member since {{ date('M Y', strtotime($userStats['join_date'])) }}</p>
                
                <div class="profile-badges">
                    <span class="badge verified">
                        <i class="fas fa-check-circle"></i>
                        Verified
                    </span>
                    @if($userStats['featured_count'] > 0)
                    <span class="badge featured">
                        <i class="fas fa-star"></i>
                        Featured Creator
                    </span>
                    @endif
                </div>
            </div>
            
            <div class="profile-actions">
                <button class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                    Edit Profile
                </button>
                <button class="btn btn-outline">
                    <i class="fas fa-cog"></i>
                    Settings
                </button>
            </div>
        </div>
        
        <!-- Stats Overview -->
        <div class="stats-section">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon uploads">
                        <i class="fas fa-upload"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number">{{ $userStats['total_uploads'] }}</span>
                        <span class="stat-label">Uploads</span>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon downloads">
                        <i class="fas fa-download"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number">{{ number_format($userStats['total_downloads']) }}</span>
                        <span class="stat-label">Downloads</span>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon likes">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number">{{ number_format($userStats['total_likes']) }}</span>
                        <span class="stat-label">Likes</span>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon featured">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number">{{ $userStats['featured_count'] }}</span>
                        <span class="stat-label">Featured</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="profile-content">
            <!-- Navigation Tabs -->
            <div class="profile-tabs">
                <button class="tab-btn active" data-tab="crosshairs">
                    <i class="fas fa-crosshairs"></i>
                    My Crosshairs
                </button>
                <button class="tab-btn" data-tab="favorites">
                    <i class="fas fa-heart"></i>
                    Favorites
                </button>
                <button class="tab-btn" data-tab="achievements">
                    <i class="fas fa-trophy"></i>
                    Achievements
                </button>
                <button class="tab-btn" data-tab="activity">
                    <i class="fas fa-clock"></i>
                    Activity
                </button>
            </div>
            
            <!-- Tab Content -->
            <div class="tab-content">
                <!-- My Crosshairs Tab -->
                <div class="tab-pane active" id="crosshairs">
                    <div class="crosshairs-header">
                        <h3>My Crosshairs ({{ count($recentCrosshairs) }})</h3>
                        <a href="{{ route('crosshairs.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Create New
                        </a>
                    </div>
                    
                    <div class="crosshairs-grid">
                        @forelse($recentCrosshairs as $crosshair)
                        <div class="crosshair-item">
                            <div class="crosshair-preview">
                                <svg width="60" height="60" viewBox="0 0 60 60">
                                    <g stroke="#FF2D5F" stroke-width="2" fill="none">
                                        <line x1="30" y1="12" x2="30" y2="24" />
                                        <line x1="30" y1="36" x2="30" y2="48" />
                                        <line x1="12" y1="30" x2="24" y2="30" />
                                        <line x1="36" y1="30" x2="48" y2="30" />
                                    </g>
                                </svg>
                            </div>
                            
                            <div class="crosshair-info">
                                <h4>{{ $crosshair['name'] }}</h4>
                                <div class="crosshair-stats">
                                    <span><i class="fas fa-download"></i> {{ number_format($crosshair['downloads']) }}</span>
                                    <span><i class="fas fa-star"></i> {{ $crosshair['rating'] }}</span>
                                </div>
                                <div class="crosshair-status status-{{ $crosshair['status'] }}">
                                    {{ ucfirst($crosshair['status']) }}
                                </div>
                            </div>
                            
                            <div class="crosshair-actions">
                                <button class="action-btn" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn" title="Share">
                                    <i class="fas fa-share"></i>
                                </button>
                                <button class="action-btn delete-btn" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        @empty
                        <div class="empty-state">
                            <i class="fas fa-crosshairs"></i>
                            <h4>No crosshairs yet</h4>
                            <p>Create your first crosshair to get started!</p>
                            <a href="{{ route('crosshairs.create') }}" class="btn btn-primary">
                                Create Crosshair
                            </a>
                        </div>
                        @endforelse
                    </div>
                </div>
                
                <!-- Favorites Tab -->
                <div class="tab-pane" id="favorites">
                    <div class="favorites-content">
                        <h3>Favorite Crosshairs</h3>
                        <p class="tab-description">Crosshairs you've favorited from the community</p>
                        
                        <div class="favorites-grid">
                            <!-- Sample favorite items -->
                            <div class="favorite-item">
                                <div class="favorite-preview">
                                    <svg width="50" height="50" viewBox="0 0 50 50">
                                        <g stroke="#00FFFF" stroke-width="2" fill="none">
                                            <line x1="25" y1="10" x2="25" y2="20" />
                                            <line x1="25" y1="30" x2="25" y2="40" />
                                            <line x1="10" y1="25" x2="20" y2="25" />
                                            <line x1="30" y1="25" x2="40" y2="25" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="favorite-info">
                                    <h4>Pro Elite</h4>
                                    <p>by ProGamer123</p>
                                    <button class="btn btn-outline btn-sm">View</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Achievements Tab -->
                <div class="tab-pane" id="achievements">
                    <div class="achievements-content">
                        <h3>Achievements</h3>
                        <p class="tab-description">Your progress and milestones</p>
                        
                        <div class="achievements-grid">
                            @foreach($achievements as $achievement)
                            <div class="achievement-item {{ $achievement['unlocked'] ? 'unlocked' : 'locked' }}">
                                <div class="achievement-icon">
                                    <i class="{{ $achievement['icon'] }}"></i>
                                </div>
                                <div class="achievement-info">
                                    <h4>{{ $achievement['name'] }}</h4>
                                    <p>{{ $achievement['description'] }}</p>
                                    @if($achievement['unlocked'])
                                        <span class="unlock-date">Unlocked {{ date('M j, Y', strtotime($achievement['date'])) }}</span>
                                    @else
                                        <span class="locked-text">Not yet unlocked</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Activity Tab -->
                <div class="tab-pane" id="activity">
                    <div class="activity-content">
                        <h3>Recent Activity</h3>
                        <p class="tab-description">Your latest actions and interactions</p>
                        
                        <div class="activity-timeline">
                            <div class="activity-item">
                                <div class="activity-icon upload">
                                    <i class="fas fa-upload"></i>
                                </div>
                                <div class="activity-content">
                                    <p><strong>Uploaded</strong> a new crosshair "Custom Pro"</p>
                                    <span class="activity-time">2 hours ago</span>
                                </div>
                            </div>
                            
                            <div class="activity-item">
                                <div class="activity-icon like">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div class="activity-content">
                                    <p><strong>Liked</strong> "Minimal Elite" by CleanDesign</p>
                                    <span class="activity-time">1 day ago</span>
                                </div>
                            </div>
                            
                            <div class="activity-item">
                                <div class="activity-icon download">
                                    <i class="fas fa-download"></i>
                                </div>
                                <div class="activity-content">
                                    <p><strong>Downloaded</strong> "Pro Tournament" by TenZ</p>
                                    <span class="activity-time">3 days ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-page {
    padding: 2rem 0;
}

.profile-header {
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 2rem;
    align-items: center;
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1.5rem;
    padding: 2rem;
    margin-bottom: 2rem;
}

.profile-avatar {
    position: relative;
}

.avatar-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid var(--primary-pink);
    object-fit: cover;
}

.edit-avatar-btn {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 35px;
    height: 35px;
    background: var(--primary-gradient);
    border: none;
    border-radius: 50%;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.edit-avatar-btn:hover {
    transform: scale(1.1);
}

.profile-name {
    font-family: 'Orbitron', monospace;
    font-size: 2rem;
    color: var(--text-primary);
    margin: 0 0 0.5rem 0;
}
.profile-email {
    color: var(--text-secondary);
    margin: 0 0 0.5rem 0;
}

.member-since {
    color: var(--text-muted);
    font-size: 0.9rem;
    margin: 0 0 1rem 0;
}

.profile-badges {
    display: flex;
    gap: 0.5rem;
}

.badge {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 1rem;
    font-size: 0.8rem;
    font-weight: 600;
}

.badge.verified {
    background: rgba(0, 210, 91, 0.1);
    color: var(--success);
    border: 1px solid var(--success);
}

.badge.featured {
    background: rgba(255, 215, 0, 0.1);
    color: #FFD700;
    border: 1px solid #FFD700;
}

.profile-actions {
    display: flex;
    gap: 1rem;
}

.stats-section {
    margin-bottom: 2rem;
    line-height: 1.6;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}


.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
}

.stat-card {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1rem;
    padding: 1.5rem;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    border-color: var(--primary-pink);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: white;
}

.stat-icon.uploads { background: linear-gradient(135deg, #FF2D5F, #FF6B7A); }
.stat-icon.downloads { background: linear-gradient(135deg, #00D25B, #00A854); }
.stat-icon.likes { background: linear-gradient(135deg, #FF4757, #FF3838); }
.stat-icon.featured { background: linear-gradient(135deg, #FFD700, #FFA500); }

.stat-number {
    display: block;
    font-family: 'Orbitron', monospace;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
}

.stat-label {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.profile-content {
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1.5rem;
    overflow: hidden;
}

.profile-tabs {
    display: flex;
    border-bottom: 1px solid var(--dark-border);
}

.tab-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    padding: 1.5rem;
    background: none;
    border: none;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.tab-btn:hover,
.tab-btn.active {
    background: rgba(255, 45, 95, 0.1);
    color: var(--primary-pink);
}

.tab-btn.active {
    border-bottom: 2px solid var(--primary-pink);
}

.tab-content {
    padding: 2rem;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}

.crosshairs-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.crosshairs-header h3 {
    color: var(--text-primary);
    font-family: 'Orbitron', monospace;
    margin: 0;
}

.crosshairs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

.crosshair-item {
    background: var(--dark-bg);
    border: 1px solid var(--dark-border);
    border-radius: 1rem;
    padding: 1.5rem;
    transition: all 0.3s ease;
    position: relative;
}

.crosshair-item:hover {
    transform: translateY(-4px);
    border-color: var(--primary-pink);
}

.crosshair-preview {
    text-align: center;
    margin-bottom: 1rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 0.5rem;
}

.crosshair-info h4 {
    color: var(--text-primary);
    margin-bottom: 0.75rem;
    font-weight: 600;
}

.crosshair-stats {
    display: flex;
    gap: 1rem;
    margin-bottom: 0.75rem;
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.crosshair-stats i {
    color: var(--primary-coral);
}

.crosshair-status {
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    width: fit-content;
}

.status-published {
    background: rgba(0, 210, 91, 0.1);
    color: var(--success);
}

.status-draft {
    background: rgba(255, 184, 0, 0.1);
    color: var(--warning);
}

.status-pending {
    background: rgba(255, 107, 122, 0.1);
    color: var(--primary-coral);
}

.crosshair-actions {
    position: absolute;
    top: 1rem;
    right: 1rem;
    display: flex;
    gap: 0.5rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.crosshair-item:hover .crosshair-actions {
    opacity: 1;
}

.action-btn {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    color: var(--text-secondary);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.action-btn:hover {
    background: var(--primary-pink);
    color: white;
    border-color: var(--primary-pink);
}

.delete-btn:hover {
    background: var(--danger);
    border-color: var(--danger);
}

.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 4rem 2rem;
    color: var(--text-secondary);
}

.empty-state i {
    font-size: 4rem;
    color: var(--text-muted);
    margin-bottom: 1rem;
}

.empty-state h4 {
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.tab-description {
    color: var(--text-secondary);
    margin-bottom: 2rem;
}

.favorites-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1.5rem;
}

.favorite-item {
    background: var(--dark-bg);
    border: 1px solid var(--dark-border);
    border-radius: 1rem;
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
}

.favorite-item:hover {
    transform: translateY(-4px);
    border-color: var(--primary-pink);
}

.favorite-preview {
    margin-bottom: 1rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 0.5rem;
}

.favorite-info h4 {
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.favorite-info p {
    color: var(--text-secondary);
    margin-bottom: 1rem;
    font-size: 0.9rem;
}

.achievements-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.achievement-item {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    background: var(--dark-bg);
    border: 1px solid var(--dark-border);
    border-radius: 1rem;
    padding: 1.5rem;
    transition: all 0.3s ease;
}

.achievement-item.unlocked {
    border-color: var(--success);
    background: rgba(0, 210, 91, 0.05);
}

.achievement-item.locked {
    opacity: 0.6;
}

.achievement-item:hover {
    transform: translateY(-2px);
}

.achievement-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.achievement-item.unlocked .achievement-icon {
    background: var(--success);
    color: white;
}

.achievement-item.locked .achievement-icon {
    background: var(--dark-border);
    color: var(--text-muted);
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

.unlock-date {
    color: var(--success);
    font-size: 0.8rem;
    font-weight: 500;
}

.locked-text {
    color: var(--text-muted);
    font-size: 0.8rem;
}

.activity-timeline {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: var(--dark-bg);
    border: 1px solid var(--dark-border);
    border-radius: 0.75rem;
}

.activity-item .activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    color: white;
    flex-shrink: 0;
}

.activity-icon.upload { background: var(--primary-gradient); }
.activity-icon.like { background: linear-gradient(135deg, #FF4757, #FF3838); }
.activity-icon.download { background: linear-gradient(135deg, #00D25B, #00A854); }

.activity-content p {
    color: var(--text-secondary);
    margin: 0 0 0.5rem 0;
}

.activity-time {
    color: var(--text-muted);
    font-size: 0.85rem;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .profile-header {
        grid-template-columns: 1fr;
        text-align: center;
        gap: 1.5rem;
    }
    
    .profile-actions {
        justify-content: center;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .profile-tabs {
        flex-direction: column;
    }
    
    .tab-btn {
        justify-content: flex-start;
        padding: 1rem 1.5rem;
    }
    
    .crosshairs-grid,
    .favorites-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .crosshairs-header {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .achievement-item {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<script>
// Tab functionality
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const tabId = this.dataset.tab;
        
        // Update active tab button
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        // Update active tab content
        document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
        document.getElementById(tabId).classList.add('active');
    });
});

// Action button functionality
document.querySelectorAll('.action-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        
        if (this.classList.contains('delete-btn')) {
            if (confirm('Are you sure you want to delete this crosshair?')) {
                this.closest('.crosshair-item').remove();
            }
        } else {
            // Handle other actions (edit, share, etc.)
            console.log('Action clicked:', this.title);
        }
    });
});

// Edit avatar functionality
document.querySelector('.edit-avatar-btn').addEventListener('click', function() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    
    input.addEventListener('change', function() {
        if (this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.avatar-img').src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    input.click();
});
</script>
@endsection