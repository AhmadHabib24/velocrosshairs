@props(['stats' => []])

<section class="stats-section">
    <div class="container">
        <div class="stats-content">
            <!-- Main Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card big-stat" data-animate="true">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number" data-target="{{ $stats['total_users'] ?? 52847 }}">0</h3>
                        <p class="stat-label">Active Users</p>
                        <div class="stat-trend positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+12% this month</span>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card big-stat" data-animate="true">
                    <div class="stat-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number" data-target="{{ $stats['total_downloads'] ?? 1250000 }}">0</h3>
                        <p class="stat-label">Total Downloads</p>
                        <div class="stat-trend positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+8% this week</span>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card" data-animate="true">
                    <div class="stat-icon small">
                        <i class="fas fa-crosshairs"></i>
                    </div>
                    <div class="stat-content">
                        <h4 class="stat-number" data-target="{{ $stats['total_crosshairs'] ?? 567 }}">0</h4>
                        <p class="stat-label">Crosshairs Available</p>
                    </div>
                </div>
                
                <div class="stat-card" data-animate="true">
                    <div class="stat-icon small">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-content">
                        <h4 class="stat-number" data-target="48">0</h4>
                        <p class="stat-label">Pro Players</p>
                    </div>
                </div>
                
                <div class="stat-card" data-animate="true">
                    <div class="stat-icon small">
                        <i class="fas fa-gamepad"></i>
                    </div>
                    <div class="stat-content">
                        <h4 class="stat-number" data-target="200">0</h4>
                        <p class="stat-label">Supported Games</p>
                    </div>
                </div>
                
                <div class="stat-card uptime-card" data-animate="true">
                    <div class="stat-icon small">
                        <i class="fas fa-server"></i>
                    </div>
                    <div class="stat-content">
                        <h4 class="stat-number">{{ $stats['uptime'] ?? 99.9 }}%</h4>
                        <p class="stat-label">Uptime</p>
                        <div class="uptime-indicator">
                            <div class="uptime-bar">
                                <div class="uptime-fill" style="width: {{ $stats['uptime'] ?? 99.9 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Live Activity Feed -->
            <div class="activity-section">
                <div class="activity-header">
                    <h3 class="activity-title">
                        <span class="activity-pulse"></span>
                        Live Activity
                    </h3>
                    <span class="activity-count">{{ rand(50, 150) }} users online</span>
                </div>
                
                <div class="activity-feed">
                    <div class="activity-item">
                        <div class="activity-icon download">
                            <i class="fas fa-download"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>ProGamer123</strong> downloaded <span class="crosshair-name">Tournament Elite</span></p>
                            <span class="activity-time">2 seconds ago</span>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon upload">
                            <i class="fas fa-upload"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>CrosshairMaster</strong> uploaded a new crosshair <span class="crosshair-name">Neon Strike</span></p>
                            <span class="activity-time">15 seconds ago</span>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon like">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>AimBot99</strong> liked <span class="crosshair-name">Minimal Pro</span></p>
                            <span class="activity-time">32 seconds ago</span>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon featured">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="activity-content">
                            <p><span class="crosshair-name">Classic Dot</span> was featured by moderators</p>
                            <span class="activity-time">1 minute ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Achievement Badges -->
        <div class="achievements-section">
            <h3 class="achievements-title">Community Milestones</h3>
            <div class="achievements-grid">
                <div class="achievement-badge earned">
                    <div class="achievement-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="achievement-info">
                        <h4>1M Downloads</h4>
                        <p>Reached 1 million total downloads!</p>
                    </div>
                </div>
                
                <div class="achievement-badge earned">
                    <div class="achievement-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="achievement-info">
                        <h4>50K Community</h4>
                        <p>50,000 active users milestone</p>
                    </div>
                </div>
                
                <div class="achievement-badge in-progress">
                    <div class="achievement-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="achievement-info">
                        <h4>100 Pro Players</h4>
                        <p>Progress: 48/100 verified pros</p>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 48%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.stats-section {
    padding: 6rem 0;
    background: linear-gradient(135deg, var(--dark-card) 0%, var(--dark-bg) 100%);
    position: relative;
    overflow: hidden;
}

.stats-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><circle cx="30" cy="30" r="1" fill="rgba(255,45,95,0.1)"/></g></svg>') repeat;
    opacity: 0.3;
}

.stats-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 4rem;
    margin-bottom: 4rem;
    position: relative;
    z-index: 2;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: auto auto auto;
    gap: 2rem;
}

.stat-card {
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1.5rem;
    padding: 2rem;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--primary-gradient);
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.stat-card:hover::before {
    transform: scaleX(1);
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 60px rgba(255, 45, 95, 0.15);
    border-color: var(--primary-pink);
}

.big-stat {
    grid-row: span 2;
    display: flex;
    align-items: center;
    gap: 2rem;
    padding: 3rem;
}

.stat-icon {
    width: 80px;
    height: 80px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    flex-shrink: 0;
    box-shadow: var(--glow-pink);
}

.stat-icon.small {
    width: 50px;
    height: 50px;
    font-size: 1.3rem;
    margin-bottom: 1rem;
}

.stat-number {
    font-family: 'Orbitron', monospace;
    font-size: 3rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    line-height: 1;
}

.big-stat .stat-number {
    font-size: 4rem;
}

.stat-card:not(.big-stat) .stat-number {
    font-size: 2.5rem;
}

.stat-label {
    color: var(--text-secondary);
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 1rem;
}

.stat-trend {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
    border-radius: 1rem;
    width: fit-content;
}

.stat-trend.positive {
    background: rgba(0, 210, 91, 0.1);
    color: var(--success);
}

.stat-trend i {
    font-size: 0.8rem;
}

.uptime-card {
    position: relative;
}

.uptime-indicator {
    margin-top: 1rem;
}

.uptime-bar {
    width: 100%;
    height: 6px;
    background: var(--dark-border);
    border-radius: 3px;
    overflow: hidden;
}

.uptime-fill {
    height: 100%;
    background: var(--success);
    border-radius: 3px;
    transition: width 2s ease;
}

.activity-section {
    background: var(--dark-bg);
    border: 1px solid var(--dark-border);
    border-radius: 1.5rem;
    padding: 2rem;
    height: fit-content;
}

.activity-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--dark-border);
}

.activity-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-family: 'Orbitron', monospace;
    font-size: 1.2rem;
    color: var(--text-primary);
    margin: 0;
}

.activity-pulse {
    width: 12px;
    height: 12px;
    background: var(--success);
    border-radius: 50%;
    animation: pulse-dot 2s infinite;
}

@keyframes pulse-dot {
    0% { 
        box-shadow: 0 0 0 0 rgba(0, 210, 91, 0.7);
    }
    70% { 
        box-shadow: 0 0 0 10px rgba(0, 210, 91, 0);
    }
    100% { 
        box-shadow: 0 0 0 0 rgba(0, 210, 91, 0);
    }
}

.activity-count {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.activity-feed {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 0.75rem;
    transition: all 0.3s ease;
}

.activity-item:hover {
    background: rgba(255, 45, 95, 0.05);
}

.activity-icon {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    color: white;
    flex-shrink: 0;
}

.activity-icon.download {
    background: var(--primary-gradient);
}

.activity-icon.upload {
    background: linear-gradient(135deg, #00D25B, #00A854);
}

.activity-icon.like {
    background: linear-gradient(135deg, #FF4757, #FF3838);
}

.activity-icon.featured {
    background: linear-gradient(135deg, #FFD700, #FFA500);
}

.activity-content p {
    color: var(--text-secondary);
    margin: 0;
    line-height: 1.4;
}

.activity-content strong {
    color: var(--text-primary);
}

.crosshair-name {
    color: var(--primary-pink);
    font-weight: 600;
}

.activity-time {
    color: var(--text-muted);
    font-size: 0.8rem;
}

.achievements-section {
    text-align: center;
    position: relative;
    z-index: 2;
}

.achievements-title {
    font-family: 'Orbitron', monospace;
    font-size: 2rem;
    color: var(--text-primary);
    margin-bottom: 2rem;
}

.achievements-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

.achievement-badge {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1rem;
    padding: 2rem;
    transition: all 0.3s ease;
}

.achievement-badge.earned {
    border-color: var(--success);
    background: rgba(0, 210, 91, 0.05);
}

.achievement-badge.in-progress {
    border-color: var(--warning);
    background: rgba(255, 184, 0, 0.05);
}

.achievement-badge:hover {
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
    flex-shrink: 0;
}

.achievement-badge.earned .achievement-icon {
    background: var(--success);
    color: white;
}

.achievement-badge.in-progress .achievement-icon {
    background: var(--warning);
    color: var(--dark-bg);
}

.achievement-info {
    text-align: left;
    flex: 1;
}

.achievement-info h4 {
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.achievement-info p {
    color: var(--text-secondary);
    margin: 0;
    font-size: 0.9rem;
}

.progress-bar {
    width: 100%;
    height: 4px;
    background: var(--dark-border);
    border-radius: 2px;
    overflow: hidden;
    margin-top: 0.75rem;
}

.progress-fill {
    height: 100%;
    background: var(--warning);
    border-radius: 2px;
    transition: width 2s ease;
}

/* Responsive */
@media (max-width: 1024px) {
    .stats-content {
        grid-template-columns: 1fr;
        gap: 3rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .big-stat {
        grid-row: span 1;
        flex-direction: column;
        text-align: center;
        gap: 1rem;
        padding: 2rem;
    }
}

@media (max-width: 768px) {
    .stats-section {
        padding: 4rem 0;
    }
    
    .stat-number,
    .big-stat .stat-number {
        font-size: 2.5rem;
    }
    
    .achievements-grid {
        grid-template-columns: 1fr;
    }
    
    .achievement-badge {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .achievement-info {
        text-align: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate numbers when in view
    const observerOptions = {
        threshold: 0.3
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting && entry.target.dataset.animate === 'true') {
                animateNumber(entry.target.querySelector('.stat-number'));
                entry.target.dataset.animate = 'false'; // Prevent re-animation
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.stat-card[data-animate="true"]').forEach(card => {
        observer.observe(card);
    });
    
    function animateNumber(element) {
        const target = parseInt(element.dataset.target);
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            
            // Format number
            if (target >= 1000000) {
                element.textContent = (current / 1000000).toFixed(1) + 'M';
            } else if (target >= 1000) {
                element.textContent = (current / 1000).toFixed(1) + 'K';
            } else {
                element.textContent = Math.floor(current).toLocaleString();
            }
        }, 16);
    }
    
    // Simulate live activity updates
    function updateActivity() {
        const activities = [
            { type: 'download', user: 'Player' + Math.floor(Math.random() * 1000), action: 'downloaded', item: 'Pro Crosshair' },
            { type: 'upload', user: 'Creator' + Math.floor(Math.random() * 100), action: 'uploaded', item: 'New Design' },
            { type: 'like', user: 'User' + Math.floor(Math.random() * 500), action: 'liked', item: 'Minimal Cross' }
        ];
        
        const randomActivity = activities[Math.floor(Math.random() * activities.length)];
        console.log('New activity:', randomActivity);
        
        // Update user count
        const userCount = document.querySelector('.activity-count');
        const currentCount = parseInt(userCount.textContent.match(/\d+/)[0]);
        const newCount = currentCount + Math.floor(Math.random() * 10) - 5;
        userCount.textContent = Math.max(50, newCount) + ' users online';
    }
    
    // Update activity every 30 seconds
    setInterval(updateActivity, 30000);
});
</script>