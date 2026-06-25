@extends('layouts.app')

@section('title', $blog->meta_title ?? $blog->title)
@section('description', $blog->meta_description ?? Str::limit(strip_tags($blog->content), 150))
@section('keywords', $blog->meta_keywords ?? '')

@section('content')
<style>
    .blog-post-header {
        position: relative;
        padding: 4rem 0 0;
        margin-bottom: 3rem;
    }

    .blog-post-cover {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 16px;
        margin-bottom: -100px;
        position: relative;
        z-index: 1;
        box-shadow: var(--card-shadow);
        border: 1px solid var(--dark-border);
    }

    .blog-post-info {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 16px;
        padding: 3rem 2rem 2rem;
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
        box-shadow: 0 -10px 30px rgba(0,0,0,0.5);
    }

    .blog-post-category {
        display: inline-block;
        background: rgba(255, 45, 95, 0.1);
        color: var(--primary-pink);
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        margin-bottom: 1rem;
        text-decoration: none;
    }

    .blog-post-title {
        font-family: 'Orbitron', monospace;
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: var(--text-primary);
        line-height: 1.2;
        word-break: break-word;
    }

    .blog-post-meta {
        color: var(--text-muted);
        font-size: 0.9rem;
        display: flex;
        justify-content: center;
        gap: 1.5rem;
    }

    .blog-post-content {
        max-width: 800px;
        margin: 4rem auto;
        color: var(--text-secondary);
        font-size: 1.1rem;
        line-height: 1.8;
    }

    /* Typography inside content */
    .blog-post-content h1, 
    .blog-post-content h2, 
    .blog-post-content h3 {
        color: var(--text-primary);
        font-family: 'Orbitron', monospace;
        margin: 2rem 0 1rem;
    }

    .blog-post-content p {
        margin-bottom: 1.5rem;
    }

    .blog-post-content a {
        color: var(--primary-pink);
        text-decoration: none;
    }

    .blog-post-content a:hover {
        text-decoration: underline;
    }

    .blog-post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5rem 0;
    }

    .blog-post-content blockquote {
        border-left: 4px solid var(--primary-pink);
        padding-left: 1rem;
        margin: 1.5rem 0;
        font-style: italic;
        background: rgba(255, 45, 95, 0.05);
        padding: 1rem;
        border-radius: 0 8px 8px 0;
    }

    .blog-post-tags {
        max-width: 800px;
        margin: 0 auto 4rem;
        padding-top: 2rem;
        border-top: 1px solid var(--dark-border);
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .blog-post-tag {
        background: var(--dark-bg);
        border: 1px solid var(--dark-border);
        color: var(--text-secondary);
        padding: 0.4rem 1rem;
        border-radius: 20px;
        text-decoration: none;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }

    .blog-post-tag:hover {
        border-color: var(--primary-pink);
        color: var(--primary-pink);
    }

    .related-blogs {
        margin-top: 4rem;
        padding-top: 4rem;
        border-top: 1px solid var(--dark-border);
    }

    .related-title {
        font-family: 'Orbitron', monospace;
        font-size: 2rem;
        margin-bottom: 2rem;
        text-align: center;
    }

    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    /* Reuse card styles from index */
    .blog-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .blog-card:hover {
        transform: translateY(-5px);
        border-color: var(--primary-pink);
    }

    .blog-img-container {
        width: 100%;
        height: 200px;
        overflow: hidden;
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

    .blog-content-wrapper {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .blog-item-title {
        font-size: 1.2rem;
        color: var(--text-primary);
        text-decoration: none;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .blog-item-title:hover { color: var(--primary-pink); }
</style>

<div class="container">
    <div class="blog-post-header">
        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="blog-post-cover">
        
        <div class="blog-post-info">
            @if($blog->category)
                <a href="{{ route('blogs.index', ['category' => $blog->category->slug]) }}" class="blog-post-category">
                    {{ $blog->category->name }}
                </a>
            @endif
            
            <h1 class="blog-post-title">{{ $blog->title }}</h1>
            
            <div class="blog-post-meta">
                <span><i class="far fa-calendar-alt"></i> {{ $blog->published_at->format('M d, Y') }}</span>
                <span><i class="far fa-clock"></i> {{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read</span>
            </div>
        </div>
    </div>

    <div class="blog-post-content">
        {!! $blog->content !!}
    </div>

    @if($blog->tags->count() > 0)
        <div class="blog-post-tags">
            <span style="color: var(--text-primary); font-weight: 600; margin-right: 0.5rem;">Tags:</span>
            @foreach($blog->tags as $tag)
                <a href="{{ route('blogs.index', ['tag' => $tag->slug]) }}" class="blog-post-tag">{{ $tag->name }}</a>
            @endforeach
        </div>
    @endif

    @if($relatedBlogs->count() > 0)
        <div class="related-blogs">
            <h2 class="related-title">Read Next</h2>
            <div class="blog-grid">
                @foreach($relatedBlogs as $related)
                    <div class="blog-card">
                        <a href="{{ route('blogs.show', $related->slug) }}" class="blog-img-container">
                            <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}" class="blog-img">
                        </a>
                        <div class="blog-content-wrapper">
                            <a href="{{ route('blogs.show', $related->slug) }}" class="blog-item-title">
                                {{ $related->title }}
                            </a>
                            <span style="color: var(--text-muted); font-size: 0.85rem;">{{ $related->published_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
