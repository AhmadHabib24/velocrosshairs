@extends('layouts.app')

@section('title', 'Blog - Velocrosshairs')
@section('description', 'Read the latest news, guides, and tips about gaming crosshairs and overlays from Velocrosshairs.')

@section('content')
<style>
    .blog-header {
        padding: 4rem 0 2rem;
        text-align: center;
        background: radial-gradient(circle at center, rgba(255, 45, 95, 0.1) 0%, transparent 70%);
    }
    
    .blog-title {
        font-family: 'Orbitron', monospace;
        font-size: 3rem;
        margin-bottom: 1rem;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .blog-subtitle {
        color: var(--text-secondary);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto 3rem;
    }

    .filters-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .filter-tags {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .filter-tag {
        padding: 0.5rem 1rem;
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 20px;
        color: var(--text-secondary);
        text-decoration: none;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }

    .filter-tag:hover, .filter-tag.active {
        background: rgba(255, 45, 95, 0.1);
        border-color: var(--primary-pink);
        color: var(--primary-pink);
    }

    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .blog-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--glow-pink);
        border-color: var(--primary-pink);
    }

    .blog-img-container {
        width: 100%;
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .blog-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .blog-card:hover .blog-img {
        transform: scale(1.05);
    }

    .blog-category-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: var(--primary-gradient);
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 1;
    }

    .blog-content-wrapper {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .blog-meta {
        color: var(--text-muted);
        font-size: 0.8rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .blog-item-title {
        font-size: 1.25rem;
        color: var(--text-primary);
        text-decoration: none;
        margin-bottom: 1rem;
        font-weight: 600;
        line-height: 1.4;
        transition: color 0.3s ease;
    }

    .blog-item-title:hover {
        color: var(--primary-pink);
    }

    .blog-excerpt {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }

    .blog-tags {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .blog-tag {
        color: var(--text-muted);
        font-size: 0.75rem;
    }
    
    .blog-tag::before {
        content: '#';
    }

    .read-more {
        color: var(--primary-pink);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: gap 0.3s ease;
    }

    .read-more:hover {
        gap: 0.75rem;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }
</style>

<div class="container">
    <div class="blog-header">
        <h1 class="blog-title">Our Blog</h1>
        <p class="blog-subtitle">Latest news, guides, and updates from the Velocrosshairs team.</p>
    </div>

    <div class="filters-container">
        <div class="filter-tags">
            <a href="{{ route('blogs.index') }}" class="filter-tag {{ !request('category') ? 'active' : '' }}">All Categories</a>
            @foreach($categories as $cat)
                <a href="{{ route('blogs.index', ['category' => $cat->slug]) }}" class="filter-tag {{ request('category') == $cat->slug ? 'active' : '' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="blog-grid">
        @forelse($blogs as $blog)
            <div class="blog-card">
                <a href="{{ route('blogs.show', $blog->slug) }}" class="blog-img-container">
                    @if($blog->category)
                        <span class="blog-category-badge">{{ $blog->category->name }}</span>
                    @endif
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="blog-img">
                </a>
                
                <div class="blog-content-wrapper">
                    <div class="blog-meta">
                        <span><i class="far fa-calendar-alt"></i> {{ $blog->published_at->format('M d, Y') }}</span>
                    </div>
                    
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="blog-item-title">
                        {{ $blog->title }}
                    </a>
                    
                    <div class="blog-excerpt">
                        {{ Str::limit(strip_tags($blog->content), 120) }}
                    </div>

                    @if($blog->tags->count() > 0)
                        <div class="blog-tags">
                            @foreach($blog->tags->take(3) as $tag)
                                <a href="{{ route('blogs.index', ['tag' => $tag->slug]) }}" class="blog-tag" style="text-decoration: none; color: var(--text-muted);">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    @endif
                    
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="read-more">
                        Read Article <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 0; color: var(--text-muted);">
                <i class="fas fa-newspaper" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                <h2>No blogs found</h2>
                <p>Check back later for new content.</p>
            </div>
        @endforelse
    </div>

    @if($blogs->hasPages())
        <div class="pagination-wrapper">
            {{ $blogs->links() }}
        </div>
    @endif
</div>
@endsection
