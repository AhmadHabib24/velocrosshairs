@extends('layouts.app')

@section('title', 'Valorant Crosshairs Database: Best Pro & Community Codes')
@section('description', 'Browse our complete Valorant crosshair database. Get the best crosshair codes used by pro players, discover popular styles, and copy them instantly to improve your aim.')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--dark-bg) 0%, var(--dark-card) 100%);
        padding: 3rem 0;
        border-bottom: 1px solid var(--dark-border);
    }
    
    .page-title {
        font-family: 'Orbitron', monospace;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .text-gradient {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .page-subtitle {
        color: var(--text-secondary);
        font-size: 1.1rem;
    }
    
    .filters-section {
        background: var(--dark-card);
        padding: 2rem 0;
        border-bottom: 1px solid var(--dark-border);
    }
    
    .filters-container {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
    }
    
    .search-filters {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: center;
    }
    
    .search-box {
        position: relative;
    }
    
    .search-box input {
        background: var(--dark-bg);
        border: 1px solid var(--dark-border);
        border-radius: 0.5rem;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        color: var(--text-primary);
        width: 300px;
        transition: all 0.3s ease;
    }
    
    .search-box input:focus {
        outline: none;
        border-color: var(--primary-pink);
        box-shadow: 0 0 0 3px rgba(255, 45, 95, 0.1);
    }
    
    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }
    
    .filter-select {
        background: var(--dark-bg);
        border: 1px solid var(--dark-border);
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        color: var(--text-primary);
        min-width: 150px;
    }
    
    .filter-select:focus {
        outline: none;
        border-color: var(--primary-pink);
    }
    
    .sort-options {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .crosshairs-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 1rem;
        padding: 3rem 0;
    }
    
    .crosshair-card {
        width: 100%;
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 1rem;
        overflow: hidden;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        display: block;
    }
    
    .crosshair-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(255, 45, 95, 0.15);
        border-color: var(--primary-pink);
    }
    
    .crosshair-preview-area {
        width: 100%;
        aspect-ratio: 1 / 1;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    
    .crosshair-preview-area::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: 
            linear-gradient(90deg, rgba(255, 45, 95, 0.1) 1px, transparent 1px),
            linear-gradient(rgba(255, 45, 95, 0.1) 1px, transparent 1px);
        background-size: 20px 20px;
        opacity: 0.3;
    }
    
    .crosshair-preview-area img {
        max-width: 70%;
        max-height: 70%;
        object-fit: contain;
        z-index: 2;
    }
    
    .crosshair-icon {
        width: 60px;
        height: 60px;
        color: var(--primary-pink);
        opacity: 0.5;
        z-index: 2;
    }
    
    .crosshair-info {
        padding: 1.1rem;
    }
    
    .crosshair-name {
        font-family: 'Orbitron', monospace;
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .crosshair-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.9rem;
        color: var(--text-secondary);
        font-size: 0.85rem;
        gap: .5rem;
    }
    
    .crosshair-category {
        color: var(--primary-pink);
        text-decoration: none;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .crosshair-stats {
        display: flex;
        gap: 0.8rem;
        margin-bottom: 0.8rem;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        color: var(--text-secondary);
        font-size: 0.85rem;
    }
    
    .stat-item i {
        color: var(--primary-coral);
    }
    
    .crosshair-description {
        color: var(--text-secondary);
        font-size: 0.8rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .no-results {
        text-align: center;
        padding: 4rem 0;
        color: var(--text-secondary);
    }
    
    .no-results i {
        font-size: 4rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
    }
    
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: var(--primary-gradient);
        color: white;
        text-decoration: none;
        border-radius: 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(255, 45, 95, 0.3);
    }
    
    .load-more-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 3rem 0;
    }
    
    .load-more-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2.5rem;
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 0.75rem;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .load-more-btn::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transform: translateX(-100%);
        transition: transform 0.6s;
    }
    
    .load-more-btn:hover::before {
        transform: translateX(100%);
    }
    
    .load-more-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(255, 45, 95, 0.4);
    }
    
    .load-more-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }
    
    .load-more-btn .spinner {
        display: none;
        width: 18px;
        height: 18px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }
    
    .load-more-btn.loading .spinner {
        display: block;
    }
    
    .load-more-btn.loading .load-text {
        display: none;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    .end-message {
        text-align: center;
        padding: 2rem;
        color: var(--text-muted);
        font-size: 0.95rem;
    }
    
    .end-message i {
        display: block;
        font-size: 2rem;
        margin-bottom: 0.5rem;
        color: var(--primary-coral);
    }

    @media (max-width: 1400px) {
        .crosshairs-grid { grid-template-columns: repeat(5, 1fr); }
    }
    @media (max-width: 1200px) {
        .crosshairs-grid { grid-template-columns: repeat(4, 1fr); }
    }
    @media (max-width: 900px) {
        .crosshairs-grid { grid-template-columns: repeat(3, 1fr); gap: 1rem; }
    }
    @media (max-width: 600px) {
        .crosshairs-grid { grid-template-columns: repeat(2, 1fr); gap: 0.9rem; }
    }
    @media (max-width: 480px) {
        .crosshairs-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
        .page-title { font-size: 2rem; }
        
        .filters-container {
            flex-direction: column;
            align-items: stretch;
        }
        
        .search-filters { flex-direction: column; }
        
        .search-box input { width: 100%; }
    }
</style>
@endpush

@section('content')
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">Browse <span class="text-gradient">Crosshairs</span></h1>
            <p class="page-subtitle">
                Discover thousands of professional crosshairs created by our gaming community.
                Filter by category and style to find your perfect aim enhancement.
            </p>
        </div>
    </section>
    
    <section class="filters-section">
        <div class="container">
            <form method="GET" action="{{ route('crosshairs.index') }}" class="filters-container" id="filterForm">
                <div class="search-filters">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input 
                            type="text" 
                            name="search" 
                            id="searchInput"
                            placeholder="Search crosshairs..." 
                            value="{{ request('search') }}"
                        >
                    </div>
                    
                    <select name="category" class="filter-select" id="categoryFilter">
                        @foreach($categories as $key => $label)
                            <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="sort-options">
                    <label style="color: var(--text-secondary); margin-right: 0.5rem;">Sort by:</label>
                    <select name="sort" class="filter-select" id="sortFilter">
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                        <option value="downloads" {{ request('sort') == 'downloads' ? 'selected' : '' }}>Most Copies</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Most Views</option>
                    </select>
                </div>
            </form>
        </div>
    </section>
    
    <section class="crosshairs-section">
        <div class="container">
            @if($crosshairs->count() > 0)
                <div class="crosshairs-grid" id="crosshairsGrid">
                    @foreach($crosshairs as $crosshair)
                        <a href="{{ route('crosshairs.show', $crosshair->slug) }}" class="crosshair-card">
                            <div class="crosshair-preview-area">
                                @if($crosshair->image)
                                    <img 
                                        src="{{ asset('storage/' . $crosshair->image) }}" 
                                        alt="{{ $crosshair->name }}"
                                    >
                                @else
                                    <i class="fas fa-crosshairs crosshair-icon"></i>
                                @endif
                            </div>
                            
                            <div class="crosshair-info">
                                <h3 class="crosshair-name">{{ $crosshair->name }}</h3>
                                
                                <div class="crosshair-meta">
                                    <span class="crosshair-category">{{ $crosshair->category->name }}</span>
                                </div>
                                
                                <div class="crosshair-stats">
                                    <div class="stat-item">
                                    </div>
                                    <div class="stat-item">
                                    </div>
                                </div>
                                
                                @if($crosshair->description)
                                    <p class="crosshair-description">{{ $crosshair->description }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
                
                @if($crosshairs->hasMorePages())
                    <div class="load-more-container">
                        <button type="button" class="load-more-btn" id="loadMoreBtn" data-page="2">
                            <span class="spinner"></span>
                            <span class="load-text">
                                <i class="fas fa-arrow-down"></i>
                                Load More Crosshairs
                            </span>
                        </button>
                    </div>
                @else
                    <div class="end-message">
                        <i class="fas fa-check-circle"></i>
                        You've reached the end of the list
                    </div>
                @endif
            @else
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <h3>No crosshairs found</h3>
                    <p>Try adjusting your search criteria or browse all categories.</p>
                    <a href="{{ route('crosshairs.index') }}" class="btn">
                        <i class="fas fa-refresh"></i>
                        Clear Filters
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');
        const sortFilter = document.getElementById('sortFilter');
        const filterForm = document.getElementById('filterForm');
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        const crosshairsGrid = document.getElementById('crosshairsGrid');
        let searchTimeout;
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    filterForm.submit();
                }, 800);
            });
        }
        
        if (categoryFilter) {
            categoryFilter.addEventListener('change', function() {
                filterForm.submit();
            });
        }
        
        if (sortFilter) {
            sortFilter.addEventListener('change', function() {
                filterForm.submit();
            });
        }
        
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                const page = parseInt(this.getAttribute('data-page'));
                const search = searchInput ? searchInput.value : '';
                const category = categoryFilter ? categoryFilter.value : '';
                const sort = sortFilter ? sortFilter.value : 'popular';
                
                loadMoreBtn.classList.add('loading');
                loadMoreBtn.disabled = true;
                
                const url = new URL(window.location.href);
                url.searchParams.set('page', page);
                if (search) url.searchParams.set('search', search);
                if (category) url.searchParams.set('category', category);
                if (sort) url.searchParams.set('sort', sort);
                
                fetch(url.toString(), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.html) {
                        crosshairsGrid.insertAdjacentHTML('beforeend', data.html);
                        
                        if (data.hasMorePages) {
                            loadMoreBtn.setAttribute('data-page', page + 1);
                            loadMoreBtn.classList.remove('loading');
                            loadMoreBtn.disabled = false;
                        } else {
                            loadMoreBtn.parentElement.innerHTML = `
                                <div class="end-message">
                                    <i class="fas fa-check-circle"></i>
                                    You've reached the end of the list
                                </div>
                            `;
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    loadMoreBtn.classList.remove('loading');
                    loadMoreBtn.disabled = false;
                    alert('Failed to load more crosshairs. Please try again.');
                });
            });
        }
    });
</script>
@endpush