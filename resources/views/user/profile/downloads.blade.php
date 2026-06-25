@extends('layouts.app')

@section('title', 'My Downloads - PrecisionAim')

@section('content')
<div class="downloads-page">
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="header-content">
                <h1 class="page-title">My <span class="text-gradient">Downloads</span></h1>
                <p class="page-subtitle">
                    All the crosshairs you've downloaded and your download history.
                </p>
            </div>
            
            <div class="header-actions">
                <div class="download-stats">
                    <div class="stat">
                        <span class="stat-number">{{ count($downloads) }}</span>
                        <span class="stat-label">Total Downloads</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">{{ collect($downloads)->unique('crosshair_id')->count() }}</span>
                        <span class="stat-label">Unique Crosshairs</span>
                    </div>
                </div>
                
                <button class="btn btn-primary export-btn">
                    <i class="fas fa-download"></i>
                    Export All
                </button>
            </div>
        </div>
        
        <!-- Filters -->
        <div class="filters-section">
            <div class="filters-container">
                <div class="filter-group">
                    <label>Search Downloads</label>
                    <div class="search-input">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search by name or author..." id="searchInput">
                    </div>
                </div>
                
                <div class="filter-group">
                    <label>Sort by</label>
                    <select id="sortSelect">
                        <option value="newest">Most Recent</option>
                        <option value="oldest">Oldest First</option>
                        <option value="name">Name A-Z</option>
                        <option value="author">Author A-Z</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label>Date Range</label>
                    <select id="dateFilter">
                        <option value="all">All Time</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                        <option value="year">This Year</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Downloads List -->
        <div class="downloads-section">
            @if(count($downloads) > 0)
                <div class="downloads-grid">
                    @foreach($downloads as $download)
                    <div class="download-item" data-name="{{ strtolower($download['name']) }}" data-author="{{ strtolower($download['author']) }}" data-date="{{ $download['downloaded_at'] }}">
                        <div class="download-preview">
                            <div class="preview-container">
                                @if($download['preview'] == 'classic-crosshair')
                                    <svg width="60" height="60" viewBox="0 0 60 60">
                                        <g stroke="#FF2D5F" stroke-width="2" fill="none">
                                            <line x1="30" y1="12" x2="30" y2="24" stroke-linecap="round" />
                                            <line x1="30" y1="36" x2="30" y2="48" stroke-linecap="round" />
                                            <line x1="12" y1="30" x2="24" y2="30" stroke-linecap="round" />
                                            <line x1="36" y1="30" x2="48" y2="30" stroke-linecap="round" />
                                            <circle cx="30" cy="30" r="2" fill="#FF2D5F" />
                                        </g>
                                    </svg>
                                @else
                                    <svg width="60" height="60" viewBox="0 0 60 60">
                                        <g stroke="#00FFFF" stroke-width="1" fill="none">
                                            <line x1="30" y1="15" x2="30" y2="25" />
                                            <line x1="30" y1="35" x2="30" y2="45" />
                                            <line x1="15" y1="30" x2="25" y2="30" />
                                            <line x1="35" y1="30" x2="45" y2="30" />
                                        </g>
                                    </svg>
                                @endif
                            </div>
                        </div>
                        
                        <div class="download-info">
                            <h3 class="download-name">{{ $download['name'] }}</h3>
                            <p class="download-author">by {{ $download['author'] }}</p>
                            <div class="download-meta">
                                <span class="download-date">
                                    <i class="fas fa-calendar"></i>
                                    {{ date('M j, Y g:i A', strtotime($download['downloaded_at'])) }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="download-actions">
                            <button class="action-btn view-btn" onclick="viewCrosshair({{ $download['crosshair_id'] }})" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="action-btn download-btn" onclick="redownload({{ $download['crosshair_id'] }})" title="Download Again">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="action-btn share-btn" onclick="shareCrosshair({{ $download['crosshair_id'] }})" title="Share">
                                <i class="fas fa-share-alt"></i>
                            </button>
                            <button class="action-btn remove-btn" onclick="removeFromHistory({{ $download['crosshair_id'] }})" title="Remove from History">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="pagination-section">
                    <button class="btn btn-outline" disabled>
                        <i class="fas fa-chevron-left"></i>
                        Previous
                    </button>
                    
                    <div class="page-numbers">
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <span class="page-dots">...</span>
                        <button class="page-btn">10</button>
                    </div>
                    
                    <button class="btn btn-outline">
                        Next
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <h3>No Downloads Yet</h3>
                    <p>You haven't downloaded any crosshairs yet. Browse our collection to find the perfect crosshair for your gaming setup!</p>
                    <a href="{{ route('crosshairs.index') }}" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        Browse Crosshairs
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.downloads-page {
    padding: 2rem 0;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 3rem;
    padding: 2rem;
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1.5rem;
}

.page-title {
    font-family: 'Orbitron', monospace;
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}

.page-subtitle {
    color: var(--text-secondary);
    font-size: 1.1rem;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.download-stats {
    display: flex;
    gap: 2rem;
}

.stat {
    text-align: center;
}

.stat-number {
    display: block;
    font-family: 'Orbitron', monospace;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-pink);
}

.stat-label {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.filters-section {
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1rem;
    padding: 2rem;
    margin-bottom: 2rem;
}

.filters-container {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    gap: 2rem;
    align-items: end;
}

.filter-group label {
    display: block;
    color: var(--text-primary);
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.search-input {
    position: relative;
}

.search-input i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
}

.search-input input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    background: var(--dark-bg);
    border: 1px solid var(--dark-border);
    border-radius: 0.5rem;
    color: var(--text-primary);
    transition: all 0.3s ease;
}

.search-input input:focus {
    outline: none;
    border-color: var(--primary-pink);
    box-shadow: 0 0 0 3px rgba(255, 45, 95, 0.1);
}

.filter-group select {
    width: 100%;
    padding: 0.75rem 1rem;
    background: var(--dark-bg);
    border: 1px solid var(--dark-border);
    border-radius: 0.5rem;
    color: var(--text-primary);
    transition: all 0.3s ease;
}

.filter-group select:focus {
    outline: none;
    border-color: var(--primary-pink);
}

.downloads-section {
    margin-bottom: 2rem;
}

.downloads-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.download-item {
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1rem;
    padding: 1.5rem;
    transition: all 0.3s ease;
    position: relative;
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.download-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 15px 40px rgba(255, 45, 95, 0.1);
    border-color: var(--primary-pink);
}

.download-preview {
    flex-shrink: 0;
}

.preview-container {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.download-info {
    flex: 1;
}

.download-name {
    font-family: 'Orbitron', monospace;
    color: var(--text-primary);
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.download-author {
    color: var(--text-secondary);
    margin-bottom: 0.75rem;
}

.download-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
    color: var(--text-muted);
    font-size: 0.85rem;
}

.download-date {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.download-actions {
    display: flex;
    gap: 0.5rem;
    flex-shrink: 0;
}

.action-btn {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: var(--dark-bg);
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
    transform: scale(1.1);
}

.remove-btn:hover {
    background: var(--danger);
    border-color: var(--danger);
}

.pagination-section {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    padding: 2rem 0;
}

.page-numbers {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.page-btn {
    width: 40px;
    height: 40px;
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

.page-btn:hover,
.page-btn.active {
    background: var(--primary-pink);
    color: white;
    border-color: var(--primary-pink);
}

.page-dots {
    color: var(--text-muted);
    padding: 0 0.5rem;
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1.5rem;
}

.empty-icon {
    font-size: 4rem;
    color: var(--text-muted);
    margin-bottom: 1.5rem;
}

.empty-state h3 {
    color: var(--text-primary);
    font-family: 'Orbitron', monospace;
    margin-bottom: 1rem;
}

.empty-state p {
    color: var(--text-secondary);
    margin-bottom: 2rem;                    <div class="category-tags">
                        <span class="tag">Precision</span>
                        <span class="tag">Center Dot</span>
                        <span class="tag">Accuracy</span>
                    </div>
                </div>
            </div>
            
            <div class="category-card" onclick="filterByCategory('thick')">
                <div class="category-preview">
                    <div class="preview-bg thick-bg"></div>
                    <svg width="80" height="80" viewBox="0 0 80 80">
                        <g stroke="#FF6B7A" stroke-width="5" fill="none">
                            <line x1="40" y1="18" x2="40" y2="30" stroke-linecap="round" />
                            <line x1="40" y1="50" x2="40" y2="62" stroke-linecap="round" />
                            <line x1="18" y1="40" x2="30" y2="40" stroke-linecap="round" />
                            <line x1="50" y1="40" x2="62" y2="40" stroke-linecap="round" />
                        </g>
                    </svg>
                </div>
                
                <div class="category-info">
                    <h3 class="category-name">Thick Lines</h3>
                    <p class="category-description">Bold, thick crosshairs for high visibility and impact</p>
                    <div class="category-stats">
                        <span class="crosshair-count">21 crosshairs</span>
                        <span class="popularity">High Contrast</span>
                    </div>
                    <div class="category-tags">
                        <span class="tag">Bold</span>
                        <span class="tag">Visible</span>
                        <span class="tag">Impact</span>
                    </div>
                </div>
            </div>
            
            <div class="category-card" onclick="filterByCategory('pro')">
                <div class="category-preview">
                    <div class="preview-bg pro-bg"></div>
                    <svg width="80" height="80" viewBox="0 0 80 80">
                        <g stroke="#00D25B" stroke-width="2" fill="none">
                            <line x1="40" y1="22" x2="40" y2="34" />
                            <line x1="40" y1="46" x2="40" y2="58" />
                            <line x1="22" y1="40" x2="34" y2="40" />
                            <line x1="46" y1="40" x2="58" y2="40" />
                            <circle cx="40" cy="40" r="1" fill="#00D25B" />
                        </g>
                    </svg>
                </div>
                
                <div class="category-info">
                    <h3 class="category-name">Pro Player</h3>
                    <p class="category-description">Crosshairs used by professional esports players</p>
                    <div class="category-stats">
                        <span class="crosshair-count">67 crosshairs</span>
                        <span class="popularity">Pro Verified</span>
                    </div>
                    <div class="category-tags">
                        <span class="tag">Professional</span>
                        <span class="tag">Competitive</span>
                        <span class="tag">Verified</span>
                    </div>
                </div>
            </div>
            
            <div class="category-card" onclick="filterByCategory('colorful')">
                <div class="category-preview">
                    <div class="preview-bg colorful-bg"></div>
                    <svg width="80" height="80" viewBox="0 0 80 80">
                        <defs>
                            <linearGradient id="rainbow" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#ff0000;stop-opacity:1" />
                                <stop offset="16%" style="stop-color:#ff8c00;stop-opacity:1" />
                                <stop offset="33%" style="stop-color:#ffd700;stop-opacity:1" />
                                <stop offset="50%" style="stop-color:#00ff00;stop-opacity:1" />
                                <stop offset="66%" style="stop-color:#00bfff;stop-opacity:1" />
                                <stop offset="83%" style="stop-color:#8a2be2;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#ff1493;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <g stroke="url(#rainbow)" stroke-width="3" fill="none">
                            <line x1="40" y1="20" x2="40" y2="32" stroke-linecap="round" />
                            <line x1="40" y1="48" x2="40" y2="60" stroke-linecap="round" />
                            <line x1="20" y1="40" x2="32" y2="40" stroke-linecap="round" />
                            <line x1="48" y1="40" x2="60" y2="40" stroke-linecap="round" />
                            <circle cx="40" cy="40" r="3" fill="url(#rainbow)" />
                        </g>
                    </svg>
                </div>
                
                <div class="category-info">
                    <h3 class="category-name">Colorful</h3>
                    <p class="category-description">Vibrant and colorful crosshairs with unique visual effects</p>
                    <div class="category-stats">
                        <span class="crosshair-count">19 crosshairs</span>
                        <span class="popularity">Creative</span>
                    </div>
                    <div class="category-tags">
                        <span class="tag">Vibrant</span>
                        <span class="tag">Creative</span>
                        <span class="tag">Unique</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Popular Tags -->
        <div class="popular-tags-section">
            <h3 class="section-title">Popular Tags</h3>
            <div class="tags-cloud">
                <span class="cloud-tag" data-popularity="high">Professional</span>
                <span class="cloud-tag" data-popularity="medium">Minimal</span>
                <span class="cloud-tag" data-popularity="high">Precision</span>
                <span class="cloud-tag" data-popularity="low">Colorful</span>
                <span class="cloud-tag" data-popularity="medium">Bold</span>
                <span class="cloud-tag" data-popularity="high">Competitive</span>
                <span class="cloud-tag" data-popularity="low">Creative</span>
                <span class="cloud-tag" data-popularity="medium">Clean</span>
                <span class="cloud-tag" data-popularity="high">Traditional</span>
                <span class="cloud-tag" data-popularity="low">Unique</span>
                <span class="cloud-tag" data-popularity="medium">Versatile</span>
                <span class="cloud-tag" data-popularity="high">Accuracy</span>
            </div>
        </div>
        
        <!-- Quick Stats -->
        <div class="stats-overview">
            <div class="stat-card">
                <i class="fas fa-crosshairs"></i>
                <div class="stat-info">
                    <span class="stat-number">{{ number_format(567) }}</span>
                    <span class="stat-label">Total Crosshairs</span>
                </div>
            </div>
            
            <div class="stat-card">
                <i class="fas fa-star"></i>
                <div class="stat-info">
                    <span class="stat-number">{{ number_format(48) }}</span>
                    <span class="stat-label">Pro Players</span>
                </div>
            </div>
            
            <div class="stat-card">
                <i class="fas fa-download"></i>
                <div class="stat-info">
                    <span class="stat-number">{{ number_format(1250000) }}</span>
                    <span class="stat-label">Downloads</span>
                </div>
            </div>
            
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <div class="stat-info">
                    <span class="stat-number">{{ number_format(1250) }}</span>
                    <span class="stat-label">Creators</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.categories-page {
    padding: 2rem 0;
}

.page-header {
    text-align: center;
    margin-bottom: 4rem;
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

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.category-card {
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1.5rem;
    overflow: hidden;
    transition: all 0.4s ease;
    cursor: pointer;
    position: relative;
}

.category-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 60px rgba(255, 45, 95, 0.2);
    border-color: var(--primary-pink);
}

.category-preview {
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.preview-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0.3;
}

.preview-bg.classic-bg {
    background: radial-gradient(circle, rgba(255, 45, 95, 0.2) 0%, transparent 70%);
}

.preview-bg.minimal-bg {
    background: radial-gradient(circle, rgba(0, 255, 255, 0.2) 0%, transparent 70%);
}

.preview-bg.dot-bg {
    background: radial-gradient(circle, rgba(255, 215, 0, 0.2) 0%, transparent 70%);
}

.preview-bg.thick-bg {
    background: radial-gradient(circle, rgba(255, 107, 122, 0.2) 0%, transparent 70%);
}

.preview-bg.pro-bg {
    background: radial-gradient(circle, rgba(0, 210, 91, 0.2) 0%, transparent 70%);
}

.preview-bg.colorful-bg {
    background: radial-gradient(circle, rgba(255, 20, 147, 0.2) 0%, rgba(138, 43, 226, 0.2) 50%, rgba(0, 191, 255, 0.2) 100%);
}

.category-preview svg {
    z-index: 2;
    position: relative;
    transition: all 0.4s ease;
}

.category-card:hover .category-preview svg {
    transform: scale(1.2);
}

.category-info {
    padding: 2rem;
}

.category-name {
    font-family: 'Orbitron', monospace;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.category-description {
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.category-stats {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 0.5rem;
}

.crosshair-count {
    color: var(--primary-pink);
    font-weight: 600;
}

.popularity {
    color: var(--success);
    font-size: 0.9rem;
    font-weight: 500;
}

.category-tags {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.tag {
    background: rgba(255, 45, 95, 0.1);
    color: var(--primary-pink);
    padding: 0.4rem 0.8rem;
    border-radius: 1rem;
    font-size: 0.8rem;
    font-weight: 500;
    border: 1px solid rgba(255, 45, 95, 0.2);
}

.popular-tags-section {
    text-align: center;
    margin-bottom: 4rem;
}

.section-title {
    font-family: 'Orbitron', monospace;
    font-size: 2rem;
    color: var(--text-primary);
    margin-bottom: 2rem;
}

.tags-cloud {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.cloud-tag {
    padding: 0.75rem 1.5rem;
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 2rem;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.cloud-tag[data-popularity="high"] {
    font-size: 1.1rem;
    color: var(--primary-pink);
    border-color: var(--primary-pink);
}

.cloud-tag[data-popularity="medium"] {
    font-size: 1rem;
    color: var(--primary-coral);
}

.cloud-tag[data-popularity="low"] {
    font-size: 0.9rem;
}

.cloud-tag:hover {
    background: var(--primary-pink);
    color: white;
    border-color: var(--primary-pink);
    transform: translateY(-2px);
}

.stats-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
}

.stat-card {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    border-radius: 1rem;
    padding: 2rem;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    border-color: var(--primary-pink);
}

.stat-card i {
    font-size: 2rem;
    color: var(--primary-pink);
    width: 40px;
    flex-shrink: 0;
}

.stat-number {
    display: block;
    font-family: 'Orbitron', monospace;
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-primary);
}

.stat-label {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .categories-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .category-stats {
        flex-direction: column;
        gap: 0.5rem;
        text-align: center;
    }
    
    .tags-cloud {
        gap: 0.5rem;
    }
    
    .stat-card {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
}
</style>

<script>
function filterByCategory(category) {
    // Redirect to crosshairs page with category filter
    window.location.href = `/crosshairs?category=${category}`;
}

// Tag click functionality
document.querySelectorAll('.cloud-tag').forEach(tag => {
    tag.addEventListener('click', function() {
        const tagName = this.textContent.toLowerCase();
        window.location.href = `/crosshairs?search=${tagName}`;
    });
});

// Add hover animations
document.querySelectorAll('.category-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        const svg = this.querySelector('svg');
        if (svg) {
            svg.style.filter = 'drop-shadow(0 0 20px currentColor)';
        }
    });
    
    card.addEventListener('mouseleave', function() {
        const svg = this.querySelector('svg');
        if (svg) {
            svg.style.filter = 'none';
        }
    });
});
</script>
@endsection