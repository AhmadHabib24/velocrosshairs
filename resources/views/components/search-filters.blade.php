@props(['categories', 'selectedCategory' => '', 'search' => '', 'sort' => 'popular'])

<div class="search-filters">
    <form method="GET" class="filters-form">
        <!-- Search Input -->
        <div class="search-group">
            <div class="search-input">
                <i class="fas fa-search"></i>
                <input type="text" name="search" placeholder="Search crosshairs..." value="{{ $search }}">
            </div>
        </div>
        
        <!-- Category Filter -->
        <div class="filter-group">
            <select name="category" class="filter-select">
                @foreach($categories as $key => $label)
                    <option value="{{ $key }}" {{ $selectedCategory == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <!-- Game Filter -->
        <div class="filter-group">
            <select name="game" class="filter-select">
                <option value="">All Games</option>
                <option value="valorant">Valorant</option>
                <option value="cs2">CS2</option>
                <option value="apex">Apex Legends</option>
                <option value="overwatch">Overwatch 2</option>
            </select>
        </div>
        
        <!-- Sort -->
        <div class="filter-group">
            <select name="sort" class="filter-select" onchange="this.form.submit()">
                <option value="popular" {{ $sort == 'popular' ? 'selected' : '' }}>Most Popular</option>
                <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>Newest</option>
                <option value="downloads" {{ $sort == 'downloads' ? 'selected' : '' }}>Most Downloads</option>
                <option value="rating" {{ $sort == 'rating' ? 'selected' : '' }}>Highest Rated</option>
            </select>
        </div>
        
        <!-- Quick Filters -->
        <div class="quick-filters">
            <button type="button" class="quick-filter active" data-filter="all">All</button>
            <button type="button" class="quick-filter" data-filter="pro">Pro</button>
            <button type="button" class="quick-filter" data-filter="featured">Featured</button>
            <button type="button" class="quick-filter" data-filter="new">New</button>
        </div>
    </form>
</div>

<style>
.search-filters {
    background: var(--dark-card);
    padding: 2rem;
    border-radius: 1rem;
    border: 1px solid var(--dark-border);
    margin-bottom: 2rem;
}

.filters-form {
    display: grid;
    grid-template-columns: 2fr repeat(3, 1fr);
    gap: 1rem;
    align-items: end;
}

.search-input {
    position: relative;
    display: flex;
    align-items: center;
}

.search-input i {
    position: absolute;
    left: 1rem;
    color: var(--text-muted);
    z-index: 2;
}

.search-input input {
    width: 100%;
    padding: 0.875rem 1rem 0.875rem 2.5rem;
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

.filter-select {
    width: 100%;
    padding: 0.875rem 1rem;
    background: var(--dark-bg);
    border: 1px solid var(--dark-border);
    border-radius: 0.5rem;
    color: var(--text-primary);
    transition: all 0.3s ease;
}

.filter-select:focus {
    outline: none;
    border-color: var(--primary-pink);
}

.quick-filters {
    grid-column: 1 / -1;
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--dark-border);
}

.quick-filter {
    padding: 0.5rem 1rem;
    background: var(--dark-bg);
    border: 1px solid var(--dark-border);
    border-radius: 2rem;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s ease;
}

.quick-filter:hover,
.quick-filter.active {
    background: var(--primary-pink);
    color: white;
    border-color: var(--primary-pink);
}

@media (max-width: 768px) {
    .filters-form {
        grid-template-columns: 1fr;
    }
    
    .quick-filters {
        flex-wrap: wrap;
    }
}
</style>
