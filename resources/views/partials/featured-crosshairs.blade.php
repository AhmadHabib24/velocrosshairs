@props(['crosshairs' => []])

<section class="showcase">
    <div class="container">
        <div class="section-header fade-in">
            <h2 class="section-title">Featured <span class="text-gradient">Crosshairs</span></h2>
            <p class="section-subtitle">
                Handpicked crosshairs from professional players and community favorites.
            </p>
        </div>
        
        <!-- Featured Categories Tabs -->
        <div class="featured-tabs">
            <button class="tab-btn active" data-category="all">All Featured</button>
            <button class="tab-btn" data-category="pro">Pro Players</button>
            <button class="tab-btn" data-category="community">Community</button>
            <button class="tab-btn" data-category="trending">Trending</button>
        </div>
        
        <!-- Crosshairs Showcase Grid -->
        <div class="showcase-container">
            <div class="showcase-grid" id="crosshairsGrid">
                <!-- Pro Classic -->
                <div class="crosshair-showcase fade-in" data-category="pro">
                    <div class="showcase-header">
                        <div class="showcase-badge pro">Pro Player</div>
                        <div class="showcase-actions">
                            <button class="action-btn" title="Preview">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="action-btn" title="Favorite">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="crosshair-preview-area">
                        <div class="preview-bg"></div>
                        <svg class="crosshair-svg" width="80" height="80" viewBox="0 0 80 80">
                            <g stroke="#FF2D5F" stroke-width="3" fill="none">
                                <line x1="40" y1="15" x2="40" y2="35" stroke-linecap="round" />
                                <line x1="40" y1="45" x2="40" y2="65" stroke-linecap="round" />
                                <line x1="15" y1="40" x2="35" y2="40" stroke-linecap="round" />
                                <line x1="45" y1="40" x2="65" y2="40" stroke-linecap="round" />
                                <circle cx="40" cy="40" r="2" fill="#FF2D5F" />
                            </g>
                        </svg>
                        <div class="quick-preview">
                            <button class="btn btn-sm btn-primary">Quick Preview</button>
                        </div>
                    </div>
                    
                    <div class="showcase-info">
                        <h3 class="crosshair-name">Pro Tournament</h3>
                        <p class="crosshair-author">by <span>TenZ</span></p>
                        
                        <div class="crosshair-stats">
                            <div class="stat">
                                <i class="fas fa-download"></i>
                                <span>12.5K</span>
                            </div>
                            <div class="stat">
                                <i class="fas fa-star"></i>
                                <span>4.9</span>
                            </div>
                            <div class="stat">
                                <i class="fas fa-gamepad"></i>
                                <span>Valorant</span>
                            </div>
                        </div>
                        
                        <div class="showcase-tags">
                            <span class="tag">Tournament</span>
                            <span class="tag">Professional</span>
                        </div>
                    </div>
                </div>
                
                <!-- Minimal Elite -->
                <div class="crosshair-showcase fade-in" data-category="community">
                    <div class="showcase-header">
                        <div class="showcase-badge community">Community</div>
                        <div class="showcase-actions">
                            <button class="action-btn" title="Preview">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="action-btn" title="Favorite">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="crosshair-preview-area">
                        <div class="preview-bg"></div>
                        <svg class="crosshair-svg" width="80" height="80" viewBox="0 0 80 80">
                            <g stroke="#00FFFF" stroke-width="2" fill="none">
                                <line x1="40" y1="25" x2="40" y2="37" />
                                <line x1="40" y1="43" x2="40" y2="55" />
                                <line x1="25" y1="40" x2="37" y2="40" />
                                <line x1="43" y1="40" x2="55" y2="40" />
                            </g>
                        </svg>
                        <div class="quick-preview">
                            <button class="btn btn-sm btn-primary">Quick Preview</button>
                        </div>
                    </div>
                    
                    <div class="showcase-info">
                        <h3 class="crosshair-name">Minimal Elite</h3>
                        <p class="crosshair-author">by <span>CleanDesign</span></p>
                        
                        <div class="crosshair-stats">
                            <div class="stat">
                                <i class="fas fa-download"></i>
                                <span>8.2K</span>
                            </div>
                            <div class="stat">
                                <i class="fas fa-star"></i>
                                <span>4.7</span>
                            </div>
                            <div class="stat">
                                <i class="fas fa-gamepad"></i>
                                <span>CS2</span>
                            </div>
                        </div>
                        
                        <div class="showcase-tags">
                            <span class="tag">Minimal</span>
                            <span class="tag">Clean</span>
                        </div>
                    </div>
                </div>
                
                <!-- Neon Glow -->
                <div class="crosshair-showcase fade-in" data-category="trending">
                    <div class="showcase-header">
                        <div class="showcase-badge trending">🔥 Trending</div>
                        <div class="showcase-actions">
                            <button class="action-btn" title="Preview">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="action-btn" title="Favorite">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="crosshair-preview-area">
                        <div class="preview-bg"></div>
                        <svg class="crosshair-svg" width="80" height="80" viewBox="0 0 80 80">
                            <defs>
                                <filter id="neonGlow" x="-50%" y="-50%" width="200%" height="200%">
                                    <feGaussianBlur stdDeviation="3" result="coloredBlur"/>
                                    <feMerge>
                                        <feMergeNode in="coloredBlur"/>
                                        <feMergeNode in="SourceGraphic"/>
                                    </feMerge>
                                </filter>
                            </defs>
                            <g stroke="#00FF88" stroke-width="3" fill="none" filter="url(#neonGlow)">
                                <line x1="40" y1="18" x2="40" y2="32" stroke-linecap="round" />
                                <line x1="40" y1="48" x2="40" y2="62" stroke-linecap="round" />
                                <line x1="18" y1="40" x2="32" y2="40" stroke-linecap="round" />
                                <line x1="48" y1="40" x2="62" y2="40" stroke-linecap="round" />
                                <circle cx="40" cy="40" r="4" fill="none" stroke="#00FF88" stroke-width="2" />
                            </g>
                        </svg>
                        <div class="quick-preview">
                            <button class="btn btn-sm btn-primary">Quick Preview</button>
                        </div>
                    </div>
                    
                    <div class="showcase-info">
                        <h3 class="crosshair-name">Neon Glow</h3>
                        <p class="crosshair-author">by <span>NeonMaster</span></p>
                        
                        <div class="crosshair-stats">
                            <div class="stat">
                                <i class="fas fa-download"></i>
                                <span>15.1K</span>
                            </div>
                            <div class="stat">
                                <i class="fas fa-star"></i>
                                <span>4.8</span>
                            </div>
                            <div class="stat">
                                <i class="fas fa-gamepad"></i>
                                <span>Apex</span>
                            </div>
                        </div>
                        
                        <div class="showcase-tags">
                            <span class="tag">Glow</span>
                            <span class="tag">Colorful</span>
                        </div>
                    </div>
                </div>
                
                <!-- Sniper Pro -->
                <div class="crosshair-showcase fade-in" data-category="pro">
                    <div class="showcase-header">
                        <div class="showcase-badge pro">Pro Player</div>
                        <div class="showcase-actions">
                            <button class="action-btn" title="Preview">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="action-btn" title="Favorite">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="crosshair-preview-area">
                        <div class="preview-bg"></div>
                        <svg class="crosshair-svg" width="80" height="80" viewBox="0 0 80 80">
                            <g stroke="#FFD700" stroke-width="1" fill="none">
                                <line x1="40" y1="10" x2="40" y2="30" />
                                <line x1="40" y1="50" x2="40" y2="70" />
                                <line x1="10" y1="40" x2="30" y2="40" />
                                <line x1="50" y1="40" x2="70" y2="40" />
                                <circle cx="40" cy="40" r="15" stroke-width="1" />
                                <circle cx="40" cy="40" r="1" fill="#FFD700" />
                            </g>
                        </svg>
                        <div class="quick-preview">
                            <button class="btn btn-sm btn-primary">Quick Preview</button>
                        </div>
                    </div>
                    
                    <div class="showcase-info">
                        <h3 class="crosshair-name">Sniper Elite</h3>
                        <p class="crosshair-author">by <span>s1mple</span></p>
                        
                        <div class="crosshair-stats">
                            <div class="stat">
                                <i class="fas fa-download"></i>
                                <span>9.8K</span>
                            </div>
                            <div class="stat">
                                <i class="fas fa-star"></i>
                                <span>4.9</span>
                            </div>
                            <div class="stat">
                                <i class="fas fa-gamepad"></i>
                                <span>CS2</span>
                            </div>
                        </div>
                        
                        <div class="showcase-tags">
                            <span class="tag">Precision</span>
                            <span class="tag">Sniper</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- View All Button -->
        <div class="showcase-footer">
            <a href="{{ route('crosshairs.index') }}" class="btn btn-outline btn-lg">
                <i class="fas fa-grid-3x3"></i>
                <span>View All {{ number_format(567) }} Crosshairs</span>
            </a>
        </div>
    </div>
</section>

<style>
.showcase {
    padding: 6rem 0;
    background: var(--dark-bg);
}

.featured-tabs {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin: 3rem 0;
    flex-wrap: wrap;
}

.tab-btn {
    padding: 0.75rem 1.5rem;
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 2rem;
    color: var(--text-secondary);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.tab-btn.active,
.tab-btn:hover {
    background: var(--primary-gradient);
    color: white;
    border-color: var(--primary-pink);
    transform: translateY(-2px);
}

.showcase-container {
    position: relative;
}

.showcase-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
}

.crosshair-showcase {
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1.5rem;
    overflow: hidden;
    transition: all 0.4s ease;
    position: relative;
}

.crosshair-showcase:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 60px rgba(255, 45, 95, 0.15);
    border-color: var(--primary-pink);
}

.showcase-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.5rem 0;
}

.showcase-badge {
    padding: 0.4rem 1rem;
    border-radius: 1rem;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.showcase-badge.pro {
    background: linear-gradient(135deg, #FFD700, #FFA500);
    color: #000;
}

.showcase-badge.community {
    background: linear-gradient(135deg, #00D25B, #00A854);
    color: white;
}

.showcase-badge.trending {
    background: linear-gradient(135deg, #FF4757, #FF3838);
    color: white;
}

.showcase-actions {
    display: flex;
    gap: 0.5rem;
}

.action-btn {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: var(--dark-bg);
    border: 1px solid var(--dark-border);
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.action-btn:hover {
    background: var(--primary-pink);
    color: white;
    border-color: var(--primary-pink);
    transform: scale(1.1);
}

.crosshair-preview-area {
    aspect-ratio: 16/10;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    margin: 1rem;
    border-radius: 1rem;
}

.preview-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        linear-gradient(90deg, rgba(255, 45, 95, 0.05) 1px, transparent 1px),
        linear-gradient(rgba(255, 45, 95, 0.05) 1px, transparent 1px);
    background-size: 20px 20px;
    opacity: 0.5;
}

.crosshair-svg {
    z-index: 2;
    transition: all 0.4s ease;
}

.crosshair-showcase:hover .crosshair-svg {
    transform: scale(1.2);
}

.quick-preview {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0;
    transition: all 0.3s ease;
    z-index: 3;
}

.crosshair-showcase:hover .quick-preview {
    opacity: 1;
}

.showcase-info {
    padding: 1.5rem;
}

.crosshair-name {
    font-family: 'Orbitron', monospace;
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.crosshair-author {
    color: var(--text-secondary);
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
}

.crosshair-author span {
    color: var(--primary-pink);
    font-weight: 600;
}

.crosshair-stats {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1.5rem;
}

.stat {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.stat i {
    color: var(--primary-coral);
    font-size: 0.8rem;
}

.showcase-tags {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.tag {
    background: rgba(255, 45, 95, 0.1);
    color: var(--primary-pink);
    padding: 0.3rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.75rem;
    font-weight: 500;
    border: 1px solid rgba(255, 45, 95, 0.2);
}

.showcase-footer {
    text-align: center;
    margin-top: 4rem;
}

.btn-lg {
    padding: 1rem 2rem;
    font-size: 1.1rem;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
}

/* Responsive */
@media (max-width: 768px) {
    .showcase {
        padding: 4rem 0;
    }
    
    .showcase-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .featured-tabs {
        gap: 0.25rem;
    }
    
    .tab-btn {
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const crosshairs = document.querySelectorAll('.crosshair-showcase');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const category = this.dataset.category;
            
            // Update active tab
            tabBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter crosshairs
            crosshairs.forEach(crosshair => {
                const crosshairCategory = crosshair.dataset.category;
                if (category === 'all' || crosshairCategory === category) {
                    crosshair.style.display = 'block';
                    setTimeout(() => {
                        crosshair.style.opacity = '1';
                        crosshair.style.transform = 'translateY(0)';
                    }, 100);
                } else {
                    crosshair.style.opacity = '0';
                    crosshair.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        crosshair.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
    
    // Handle favorite buttons
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            
            if (this.querySelector('.fa-heart')) {
                const icon = this.querySelector('i');
                if (icon.classList.contains('far')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    this.style.background = 'var(--primary-pink)';
                    this.style.color = 'white';
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    this.style.background = '';
                    this.style.color = '';
                }
            }
        });
    });
    
    // Handle quick preview buttons
    document.querySelectorAll('.quick-preview .btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            // Here you could open a modal or redirect to the crosshair page
            console.log('Quick preview clicked');
        });
    });
});
</script>