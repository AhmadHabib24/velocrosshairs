@extends('layouts.app')

@section('title', $crosshair->name . ' - Crosshair Details')

@section('content')
<div class="crosshair-details">
    <div class="container">
        <!-- Breadcrumb -->
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('crosshairs.index') }}">Crosshairs</a>
            <i class="fas fa-chevron-right"></i>
            <span>{{ $crosshair->name }}</span>
        </nav>

        <!-- Main Content -->
        <div class="details-grid">
            <!-- Preview Section -->
            <div class="preview-section">
                <div class="preview-container">
                    <div class="preview-header">
                        <h1 class="crosshair-title">{{ $crosshair->name }}</h1>
                        <div class="crosshair-badges">
                            @if($crosshair->category && $crosshair->category->slug === 'pro')
                                <span class="badge pro">Pro Player</span>
                            @endif
                            <span class="badge category">{{ $crosshair->category->name ?? 'Uncategorized' }}</span>
                        </div>
                    </div>

                    <div class="preview-area" onclick="openBackgroundGalleryModal()">
                        <div class="preview-background" id="previewBackground"></div>

                        <div class="crosshair-display">
                            @if($crosshair->image)
                                {{-- ✅ Using asset('storage/') format --}}
                                @php
                                    $imagePath = $crosshair->image;
                                    // Remove 'public/storage/' or 'storage/app/public/' if present
                                    $imagePath = preg_replace('#^(public/storage/|storage/app/public/)#', '', $imagePath);
                                @endphp
                                <img 
                                    src="{{ asset('storage/' . $imagePath) }}"
                                    alt="{{ $crosshair->name }}"
                                    class="main-crosshair-img"
                                >
                            @elseif($crosshair->crosshair_code)
                                {!! \App\Helpers\CrosshairCodeParser::generateSVG($crosshair->crosshair_code, 150) !!}
                            @else
                                <svg class="crosshair-svg" width="150" height="150" viewBox="0 0 150 150">
                                    <g stroke="#FF2D5F" stroke-width="4" fill="none">
                                        <line x1="75" y1="30" x2="75" y2="60" stroke-linecap="round" />
                                        <line x1="75" y1="90" x2="75" y2="120" stroke-linecap="round" />
                                        <line x1="30" y1="75" x2="60" y2="75" stroke-linecap="round" />
                                        <line x1="90" y1="75" x2="120" y2="75" stroke-linecap="round" />
                                        <circle cx="75" cy="75" r="4" fill="#FF2D5F" />
                                    </g>
                                </svg>
                            @endif
                        </div>

                        <div class="click-to-preview-overlay">
                            <i class="fas fa-images"></i>
                            <span>Click to preview on backgrounds</span>
                        </div>

                        <div class="preview-controls" onclick="event.stopPropagation()">
                            <button class="control-btn active" onclick="changeBackground('default')" id="btn-default">
                                <i class="fas fa-th"></i>
                                Default
                            </button>
                            <button class="control-btn" onclick="changeBackground('dark')" id="btn-dark">
                                <i class="fas fa-moon"></i>
                                Dark
                            </button>
                            <button class="control-btn" onclick="changeBackground('light')" id="btn-light">
                                <i class="fas fa-sun"></i>
                                Light
                            </button>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <button class="btn btn-primary btn-lg download-btn" data-crosshair-id="{{ $crosshair->id }}">
                            <i class="fas fa-copy"></i>
                            Copy Crosshair
                        </button>
                        <button class="btn btn-outline favorite-btn">
                            <i class="far fa-heart"></i>
                            Add to Favorites
                        </button>
                        <button class="btn btn-ghost share-btn">
                            <i class="fas fa-share-alt"></i>
                            Share
                        </button>
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="info-section">
                <!-- Stats -->
                <div class="stats-card">
                    <h3 class="card-title">Statistics</h3>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <i class="fas fa-copy"></i>
                            <div class="stat-content">
                                <span class="stat-value" id="copies-count">{{ number_format($crosshair->copies ?? 0) }}</span>
                                <span class="stat-label">Copies</span>
                            </div>
                        </div>

                        <div class="stat-item">
                            <i class="fas fa-star"></i>
                            <div class="stat-content">
                                <span class="stat-value">{{ $crosshair->rating ?? 'N/A' }}</span>
                                <span class="stat-label">Rating</span>
                            </div>
                        </div>

                        <div class="stat-item">
                            <i class="fas fa-eye"></i>
                            <div class="stat-content">
                                <span class="stat-value">{{ number_format($crosshair->views ?? 0) }}</span>
                                <span class="stat-label">Views</span>
                            </div>
                        </div>

                        <div class="stat-item">
                            <i class="fas fa-calendar"></i>
                            <div class="stat-content">
                                <span class="stat-value">{{ $crosshair->created_at->format('M j') }}</span>
                                <span class="stat-label">Created</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                @if($crosshair->description)
                <div class="description-card">
                    <h3 class="card-title">Description</h3>
                    <p class="description-text">{{ $crosshair->description }}</p>
                </div>
                @endif

                <!-- Settings -->
                @if($crosshair->settings)
                    @php
                        $settings = is_string($crosshair->settings) ? json_decode($crosshair->settings, true) : $crosshair->settings;
                    @endphp
                    @if($settings && is_array($settings) && count($settings) > 0)
                    <div class="settings-card">
                        <h3 class="card-title">Crosshair Settings</h3>
                        <div class="settings-list">
                            @foreach($settings as $key => $value)
                            <div class="setting-item">
                                <span class="setting-name">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                                <span class="setting-value">{{ is_bool($value) ? ($value ? 'Yes' : 'No') : $value }}</span>
                            </div>
                            @endforeach
                        </div>
                        <button class="btn btn-outline btn-sm copy-settings-btn" data-settings='{{ json_encode($settings) }}'>
                            <i class="fas fa-copy"></i>
                            Copy Settings
                        </button>
                    </div>
                    @endif
                @endif

                <!-- Crosshair Code -->
                @if($crosshair->crosshair_code)
                <div class="code-card">
                    <h3 class="card-title">Crosshair Code</h3>
                    <div class="code-display">
                        <code id="crosshair-code">{{ $crosshair->crosshair_code }}</code>
                    </div>
                    <button class="btn btn-outline btn-sm copy-code-btn">
                        <i class="fas fa-copy"></i>
                        Copy Code
                    </button>
                </div>
                @endif

                <!-- Compatible Games -->
                @if($crosshair->games)
                    @php
                        $games = is_string($crosshair->games) ? json_decode($crosshair->games, true) : $crosshair->games;
                    @endphp
                    @if($games && is_array($games) && count($games) > 0)
                    <div class="games-card">
                        <h3 class="card-title">Compatible Games</h3>
                        <div class="games-list">
                            @foreach($games as $game)
                            <div class="game-tag">
                                <i class="fas fa-gamepad"></i>
                                <span>{{ $game }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                @endif

                <!-- Tags -->
                @if($crosshair->tags)
                    @php
                        $tags = is_string($crosshair->tags) ? json_decode($crosshair->tags, true) : $crosshair->tags;
                    @endphp
                    @if($tags && is_array($tags) && count($tags) > 0)
                    <div class="tags-card">
                        <h3 class="card-title">Tags</h3>
                        <div class="tags-list">
                            @foreach($tags as $tag)
                            <span class="tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                @endif
            </div>
        </div>

        <!-- Background Gallery Modal -->
        @if(isset($backgroundImages) && $backgroundImages->count() > 0)
        <div class="background-gallery-modal" id="backgroundGalleryModal" onclick="closeBackgroundGalleryModal()">
            <div class="gallery-modal-content" onclick="event.stopPropagation()">
                <button class="modal-close-btn" onclick="closeBackgroundGalleryModal()">
                    <i class="fas fa-times"></i>
                </button>

                <div class="gallery-modal-header">
                    <h2>
                        <i class="fas fa-images"></i>
                        Preview on Different Backgrounds
                    </h2>
                    <p>Click on any background to see full preview</p>

                    <button class="btn btn-primary btn-lg modal-copy-code-btn" data-crosshair-id="{{ $crosshair->id }}">
                        <i class="fas fa-copy"></i>
                        Copy Code
                    </button>
                </div>

                <div class="background-gallery-grid">
                    @foreach($backgroundImages->take(9) as $bgImage)
                    <div class="background-gallery-item" onclick="openBackgroundPreviewModal({{ $bgImage->id }})">
                        <div class="gallery-preview">
                            @php
                                $bgImagePath = $bgImage->image;
                                $bgImagePath = preg_replace('#^(public/storage/|storage/app/public/)#', '', $bgImagePath);
                            @endphp
                            <img src="{{ asset('storage/' . $bgImagePath) }}"
                                 alt="{{ $bgImage->name }}"
                                 class="gallery-bg-image">

                            <div class="gallery-crosshair-overlay">
                                @if($crosshair->image)
                                    @php
                                        $imagePath = preg_replace('#^(public/storage/|storage/app/public/)#', '', $crosshair->image);
                                    @endphp
                                    <img src="{{ asset('storage/' . $imagePath) }}"
                                         alt="{{ $crosshair->name }}"
                                         class="gallery-crosshair-img">
                                @elseif($crosshair->crosshair_code)
                                    <div class="gallery-crosshair-svg">
                                        {!! \App\Helpers\CrosshairCodeParser::generateSVG($crosshair->crosshair_code, 150) !!}
                                    </div>
                                @endif
                            </div>

                            <div class="gallery-overlay-info">
                                <i class="fas fa-search-plus"></i>
                                <span>Click to enlarge </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Background Preview Modal -->
        <div class="background-modal" id="backgroundModal" onclick="closeBackgroundModal()">
            <div class="background-modal-content" onclick="event.stopPropagation()">
                <button class="modal-close-btn" onclick="closeBackgroundModal()">
                    <i class="fas fa-times"></i>
                </button>

                <div class="modal-preview-container">
                    <img id="modalBackgroundImage" src="" alt="Background" class="modal-bg-image">
                    <!--<p>Testing</p>-->
                    <div class="modal-crosshair-overlay">
                        @if($crosshair->image)
                            @php
                                $imagePath = preg_replace('#^(public/storage/|storage/app/public/)#', '', $crosshair->image);
                            @endphp
                            <img src="{{ asset('storage/' . $imagePath) }}"
                                 alt="{{ $crosshair->name }}"
                                 class="modal-crosshair-img">
                        @elseif($crosshair->crosshair_code)
                            <div class="modal-crosshair-svg">
                                {!! \App\Helpers\CrosshairCodeParser::generateSVG($crosshair->crosshair_code, 150) !!}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="modal-info">
                    <h3 id="modalBackgroundName"></h3>
                    <p id="modalBackgroundCreator"></p>
                </div>
            </div>
        </div>
        @endif

        <!-- Related Crosshairs -->
        @if($relatedCrosshairs && $relatedCrosshairs->count() > 0)
        <div class="related-section">
            <h3 class="section-title">You Might Also Like</h3>
            <div class="related-grid">
                @foreach($relatedCrosshairs as $related)
                <a href="{{ route('crosshairs.show', $related->slug) }}" class="related-card">
                    <div class="related-preview">
                        @if($related->image)
                            @php
                                $relatedImagePath = preg_replace('#^(public/storage/|storage/app/public/)#', '', $related->image);
                            @endphp
                            <img 
                                src="{{ asset('storage/' . $relatedImagePath) }}"
                                alt="{{ $related->name }}"
                                class="related-crosshair-img"
                            >
                        @elseif($related->crosshair_code)
                            {!! \App\Helpers\CrosshairCodeParser::generateSVG($related->crosshair_code, 60) !!}
                        @else
                            <svg width="60" height="60" viewBox="0 0 60 60">
                                <g stroke="#FF6B7A" stroke-width="2" fill="none">
                                    <line x1="30" y1="10" x2="30" y2="22" />
                                    <line x1="30" y1="38" x2="30" y2="50" />
                                    <line x1="10" y1="30" x2="22" y2="30" />
                                    <line x1="38" y1="30" x2="50" y2="30" />
                                </g>
                            </svg>
                        @endif
                    </div>

                    <div class="related-info">
                        <h4>{{ $related->name }}</h4>
                        <p>by {{ $related->author ?? 'Anonymous' }}</p>
                        <div class="related-stats">
                            <span><i class="fas fa-copy"></i> {{ number_format($related->copies ?? 0) }}</span>
                            <span><i class="fas fa-eye"></i> {{ number_format($related->views ?? 0) }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>


<style>
.crosshair-details { padding: 2rem 0; }

.breadcrumb {
    display:flex; align-items:center; gap:0.5rem;
    margin-bottom:2rem; color:var(--text-secondary); font-size:0.9rem;
}
.breadcrumb a { color:var(--text-secondary); text-decoration:none; transition:0.3s; }
.breadcrumb a:hover { color:var(--primary-pink); }
.breadcrumb i { font-size:0.7rem; opacity:0.5; }

.details-grid {
    display:grid; grid-template-columns:2fr 1fr;
    gap:3rem; margin-bottom:4rem;
}

.preview-section {
    background:var(--dark-card); border:1px solid var(--dark-border);
    border-radius:1.5rem; padding:2rem;
}

.preview-header {
    display:flex; justify-content:space-between; align-items:flex-start;
    margin-bottom:2rem; gap:1rem;
}

.crosshair-title {
    font-family:'Orbitron', monospace;
    font-size:2.5rem; color:var(--text-primary); margin:0;
}
.crosshair-badges { display:flex; gap:0.5rem; flex-wrap:wrap; }

.badge {
    padding:0.5rem 1rem; border-radius:1rem;
    font-size:0.8rem; font-weight:600; text-transform:uppercase;
}
.badge.pro { background:linear-gradient(135deg,#FFD700,#FFA500); color:#000; }
.badge.category { background:var(--primary-gradient); color:#fff; }

.preview-area {
    background:radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
    border-radius:1rem; padding:3rem; text-align:center;
    margin-bottom:2rem; position:relative; cursor:pointer;
    transition:all 0.3s ease; min-height:280px;
}
.preview-area:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(255,45,95,0.2); }
.preview-area:hover .click-to-preview-overlay { opacity:1; }

.click-to-preview-overlay {
    position:absolute; top:1rem; right:1rem;
    display:flex; align-items:center; gap:0.5rem;
    padding:0.75rem 1.25rem; background:rgba(255,45,95,0.9); color:#fff;
    border-radius:2rem; font-size:0.85rem; font-weight:600;
    opacity:0; transition:0.3s; z-index:10; pointer-events:none;
}

.preview-background {
    position:absolute; inset:0;
    background-image:
        linear-gradient(90deg, rgba(255,45,95,0.05) 1px, transparent 1px),
        linear-gradient(rgba(255,45,95,0.05) 1px, transparent 1px);
    background-size:30px 30px;
    border-radius:1rem; opacity:0.3; transition:0.5s;
}

.crosshair-display { position:relative; z-index:2; margin-bottom:2rem; }

.main-crosshair-img {
    max-width:150px; max-height:150px;
    width:auto; height:auto;
}

.preview-controls {
    display:flex; justify-content:center; gap:0.5rem;
    position:relative; z-index:2; flex-wrap:wrap; width:100%;
}

.control-btn {
    display:flex; align-items:center; gap:0.5rem;
    padding:0.5rem 1rem; background:var(--dark-bg);
    border:1px solid var(--dark-border); border-radius:0.5rem;
    color:var(--text-secondary); cursor:pointer; transition:0.3s;
    font-size:0.85rem;
}
.control-btn:hover, .control-btn.active {
    background:var(--primary-pink); color:#fff; border-color:var(--primary-pink);
}

.action-buttons {
    display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;
}

.btn {
    display:inline-flex; align-items:center; gap:0.5rem;
    padding:0.75rem 1.5rem; border-radius:0.5rem;
    font-weight:600; transition:0.3s; border:none; cursor:pointer;
}
.btn-primary { background:var(--primary-gradient); color:#fff; }
.btn-primary:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(255,45,95,0.3); }
.btn-outline { background:transparent; border:1px solid var(--dark-border); color:var(--text-secondary); }
.btn-outline:hover { border-color:var(--primary-pink); color:var(--primary-pink); }
.btn-ghost { background:transparent; color:var(--text-secondary); }
.btn-ghost:hover { color:var(--primary-pink); }

.btn-lg { padding:1rem 2rem; font-size:1.1rem; }
.btn-sm { padding:0.5rem 1rem; font-size:0.9rem; }

.info-section { display:flex; flex-direction:column; gap:2rem; }

.author-card,.stats-card,.description-card,.settings-card,.code-card,.games-card,.tags-card {
    background:var(--dark-card); border:1px solid var(--dark-border);
    border-radius:1rem; padding:1.5rem;
}

.author-card { display:flex; align-items:center; gap:1rem; flex-wrap:wrap; }
.author-avatar img {
    width:60px; height:60px; border-radius:50%;
    border:2px solid var(--primary-pink);
}
.author-info { flex:1; min-width:150px; }
.author-name { color:var(--text-primary); margin:0 0 0.25rem; font-weight:600; }
.author-title { color:var(--text-secondary); margin:0 0 0.5rem; font-size:0.9rem; }
.author-stats { display:flex; gap:1rem; color:var(--text-muted); font-size:0.8rem; }

.card-title { color:var(--text-primary); margin:0 0 1.5rem; font-weight:600; }

.stats-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; }
.stat-item { display:flex; align-items:center; gap:1rem; }
.stat-item i { color:var(--primary-coral); font-size:1.2rem; width:20px; }
.stat-content { display:flex; flex-direction:column; }
.stat-value {
    font-family:'Orbitron', monospace; font-weight:700;
    color:var(--text-primary); font-size:1.1rem;
}
.stat-label { color:var(--text-secondary); font-size:0.85rem; }

.description-text { color:var(--text-secondary); line-height:1.7; }

.settings-list { display:flex; flex-direction:column; gap:1rem; margin-bottom:1.5rem; }
.setting-item {
    display:flex; justify-content:space-between; align-items:center;
    padding:0.75rem; background:rgba(255,255,255,0.02); border-radius:0.5rem;
}
.setting-name { color:var(--text-secondary); }
.setting-value { color:var(--text-primary); font-weight:600; }

.code-card .code-display {
    background:rgba(0,0,0,0.3); padding:1rem; border-radius:0.5rem;
    margin-bottom:1rem; overflow-x:auto;
}
.code-card code {
    color:var(--primary-pink); font-family:'Courier New', monospace; font-size:0.9rem;
    word-break:break-all;
}

.games-list { display:flex; flex-direction:column; gap:0.75rem; }
.game-tag {
    display:flex; align-items:center; gap:0.75rem;
    padding:0.75rem; background:rgba(255,45,95,0.1);
    border:1px solid rgba(255,45,95,0.2); border-radius:0.5rem;
    color:var(--primary-pink);
}

.tags-list { display:flex; flex-wrap:wrap; gap:0.5rem; }
.tag {
    background:rgba(255,45,95,0.1); color:var(--primary-pink);
    padding:0.5rem 1rem; border-radius:1rem; font-size:0.85rem;
    border:1px solid rgba(255,45,95,0.2);
}

/* Background Gallery Modal */
.background-gallery-modal {
    display:none; position:fixed; inset:0;
    background:rgba(0,0,0,0.95); z-index:3000;
    align-items:center; justify-content:center; padding:2rem; overflow-y:auto;
}
.background-gallery-modal.active { display:flex; }
.gallery-modal-content {
    background:var(--dark-card); border:1px solid var(--dark-border);
    border-radius:1.5rem; max-width:900px; width:100%; /* Changed from 1400px to 900px */
    position:relative; padding:2rem; max-height:80vh; overflow-y:auto; /* Changed padding from 3rem to 2rem, height from 90vh to 80vh */
    animation:modalSlideIn 0.3s ease;
}
.gallery-modal-header { text-align:center; margin-bottom:2rem; } /* Changed from 3rem to 2rem */
.gallery-modal-header h2 {
    font-family:'Orbitron', monospace; font-size:1.5rem; color:var(--text-primary); /* Changed from 2rem to 1.5rem */
    margin:0 0 0.75rem; display:flex; align-items:center; justify-content:center; gap:1rem;
}
.gallery-modal-header h2 i { color:var(--primary-pink); }
.gallery-modal-header p { color:var(--text-secondary); margin:0 0 1.5rem; font-size:0.9rem; } /* Changed from 1rem to 0.9rem */
.background-gallery-grid {
    display:grid; grid-template-columns:repeat(3,1fr); gap:1.5rem;
}
.background-gallery-item {
    background:var(--dark-card); border:1px solid var(--dark-border);
    border-radius:1rem; cursor:pointer; padding:1rem;
    transition:0.3s; aspect-ratio:1; position:relative;
}
.background-gallery-item:hover {
    transform:translateY(-5px); border-color:var(--primary-pink);
    box-shadow:0 15px 45px rgba(255,45,95,0.2);
}
.gallery-preview { position:relative; width:100%; height:100%; overflow:hidden; background:#000; border-radius:0.5rem; }
.gallery-bg-image {
    width:100%; height:100%; object-fit:cover; transition:0.3s;
}
.background-gallery-item:hover .gallery-bg-image { transform:scale(1.05); }
.gallery-crosshair-overlay {
    position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);
    z-index:2; pointer-events:none;
}
.gallery-crosshair-img,.gallery-crosshair-svg {
    max-width:100px; max-height:100px;
    filter:drop-shadow(0 0 10px rgba(0,0,0,0.8));
}
.gallery-overlay-info {
    position:absolute; inset:0; background:rgba(0,0,0,0.7);
    display:flex; flex-direction:column; align-items:center; justify-content:center;
    gap:0.5rem; opacity:0; transition:0.3s; z-index:3;
}
.background-gallery-item:hover .gallery-overlay-info { opacity:1; }
.gallery-overlay-info i { font-size:1.5rem; color:var(--primary-pink); } /* Changed from 2rem to 1.5rem */
.gallery-overlay-info span { color:#fff; font-weight:600; font-size:0.85rem; } /* Added font-size */
/* Background Preview Modal */
.background-modal {
    display:none; position:fixed; inset:0;
    background:rgba(0,0,0,0.95); z-index:4000;
    align-items:center; justify-content:center; padding:2rem;
}
.background-modal.active { display:flex; }
.background-modal-content {
    background:var(--dark-card); border:1px solid var(--dark-border);
    border-radius:1.5rem; max-width:1200px; width:100%;
    position:relative; animation:modalSlideIn 0.3s ease;
}
@keyframes modalSlideIn { from{opacity:0; transform:scale(0.9);} to{opacity:1; transform:scale(1);} }

.modal-close-btn {
    position:absolute; top:1rem; right:1rem; width:40px; height:40px;
    background:rgba(255,45,95,0.2); border:1px solid var(--primary-pink);
    border-radius:50%; color:var(--primary-pink); font-size:1.2rem;
    cursor:pointer; transition:0.3s; z-index:10; display:flex; align-items:center; justify-content:center;
}
.modal-close-btn:hover { background:var(--primary-pink); color:#fff; transform:rotate(90deg); }

.modal-preview-container {
    position:relative; width:100%; aspect-ratio:16/9;
    overflow:hidden; border-radius:1.5rem 1.5rem 0 0; background:#000;
}
.modal-bg-image { width:100%; height:100%; object-fit:cover; }

.modal-crosshair-overlay {
    position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);
    z-index:2; pointer-events:none;
}
.modal-crosshair-img {
    max-width:150px; max-height:150px;
    filter:drop-shadow(0 0 20px rgba(0,0,0,0.9));
}
.modal-crosshair-svg { filter:drop-shadow(0 0 20px rgba(0,0,0,0.9)); }

.modal-info { padding:2rem; text-align:center; }
.modal-info h3 { color:var(--text-primary); margin:0 0 0.5rem; font-size:1.5rem; }
.modal-info p { color:var(--text-secondary); margin:0; font-size:1rem; }

/* Related */
.related-section { margin-bottom:4rem; }
.section-title {
    font-family:'Orbitron', monospace; font-size:1.5rem;
    color:var(--text-primary); margin-bottom:2rem;
}
.related-grid {
    display:grid; grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:2rem;
}
.related-card {
    background:var(--dark-card); border:1px solid var(--dark-border);
    border-radius:1rem; padding:1.5rem; cursor:pointer;
    transition:0.3s; text-decoration:none; color:inherit; display:block;
}
.related-card:hover {
    transform:translateY(-4px); border-color:var(--primary-pink);
    box-shadow:0 15px 40px rgba(255,45,95,0.15);
}
.related-preview {
    text-align:center; margin-bottom:1rem; padding:1rem;
    background:rgba(255,255,255,0.02); border-radius:0.5rem;
}
.related-crosshair-img { max-width:60px; max-height:60px; }
.related-info h4 { color:var(--text-primary); margin-bottom:0.5rem; font-weight:600; }
.related-info p { color:var(--text-secondary); margin-bottom:1rem; font-size:0.9rem; }
.related-stats { display:flex; gap:1rem; color:var(--text-muted); font-size:0.8rem; }
.related-stats i { color:var(--primary-coral); }

/* ✅ ENHANCED MOBILE RESPONSIVE DESIGN */
@media (max-width: 1024px) {
    .details-grid { grid-template-columns:1fr; gap:2rem; }
    .background-gallery-grid { grid-template-columns:repeat(2,1fr); }
    .stats-grid { grid-template-columns:repeat(2,1fr); gap:1rem; }
}

@media (max-width: 768px) {
    /* General */
    .crosshair-details { padding:1rem 0; }
    .container { padding:0 1rem; }
    
    /* Breadcrumb */
    .breadcrumb {
        margin-bottom:1.5rem; font-size:0.8rem;
        flex-wrap:wrap;
    }
    
    /* Preview Section */
    .preview-section { padding:1.25rem; border-radius:1rem; }
    .preview-header {
        flex-direction:column; align-items:flex-start;
        margin-bottom:1.5rem; gap:1rem;
    }
    .crosshair-title { font-size:1.6rem; line-height:1.2; }
    .preview-area { padding:1.5rem; min-height:240px; }
    
    .click-to-preview-overlay {
        top:0.5rem; right:0.5rem;
        padding:0.5rem 0.75rem; font-size:0.75rem;
    }
    
    /* Action Buttons */
    .action-buttons { 
        flex-direction:column; 
        gap:0.75rem;
    }
    .action-buttons .btn { 
        width:100%; 
        justify-content:center;
        padding:0.875rem 1.25rem;
    }
    
    /* Info Cards - Mobile Optimized */
    .info-section { gap:1.5rem; }
    .author-card,.stats-card,.description-card,.settings-card,.code-card,.games-card,.tags-card {
        padding:1.25rem;
        border-radius:0.875rem;
    }
    
    /* ✅ Statistics - Full Mobile Responsive */
    .stats-card .card-title {
        font-size:1.1rem;
        margin-bottom:1.25rem;
    }
    .stats-grid { 
        grid-template-columns:1fr;
        gap:1rem;
    }
    .stat-item { 
        padding:0.875rem;
        background:rgba(255,255,255,0.02);
        border-radius:0.5rem;
        gap:0.875rem;
    }
    .stat-item i { 
        font-size:1.4rem; 
        min-width:24px;
    }
    .stat-value { 
        font-size:1.25rem;
        line-height:1.2;
    }
    .stat-label { 
        font-size:0.8rem;
        margin-top:0.125rem;
    }
    
    /* ✅ Description - Mobile Optimized */
    .description-card .card-title {
        font-size:1.1rem;
        margin-bottom:1rem;
    }
    .description-text { 
        font-size:0.95rem;
        line-height:1.6;
        word-wrap:break-word;
        overflow-wrap:break-word;
    }
    
    /* ✅ Crosshair Code - Mobile Responsive */
    .code-card .card-title {
        font-size:1.1rem;
        margin-bottom:1rem;
    }
    .code-card .code-display {
        padding:0.875rem;
        margin-bottom:1rem;
        border-radius:0.5rem;
        overflow-x:auto;
        -webkit-overflow-scrolling:touch;
    }
    .code-card code {
        font-size:0.75rem;
        line-height:1.4;
        word-break:break-all;
        white-space:pre-wrap;
        display:block;
    }
    .code-card .btn-sm {
        width:100%;
        justify-content:center;
        padding:0.75rem 1rem;
    }
    
    /* Settings */
    .settings-card .card-title {
        font-size:1.1rem;
        margin-bottom:1rem;
    }
    .settings-list { gap:0.75rem; margin-bottom:1.25rem; }
    .setting-item {
        padding:0.625rem 0.75rem;
        flex-direction:column;
        align-items:flex-start;
        gap:0.375rem;
    }
    .setting-name { 
        font-size:0.85rem;
        font-weight:600;
    }
    .setting-value { 
        font-size:0.9rem;
    }
    .settings-card .btn-sm {
        width:100%;
        justify-content:center;
    }
    
    /* Games & Tags */
    .games-card .card-title,
    .tags-card .card-title {
        font-size:1.1rem;
        margin-bottom:1rem;
    }
    .game-tag {
        padding:0.625rem 0.75rem;
        font-size:0.85rem;
    }
    .tag {
        padding:0.425rem 0.875rem;
        font-size:0.8rem;
    }
    
    /* Modals */
    .background-gallery-modal { padding:1rem; }
    .gallery-modal-content { 
        padding:1.25rem; 
        border-radius:1rem; 
        max-height:92vh;
    }
    .gallery-modal-header { margin-bottom:2rem; }
    .gallery-modal-header h2 {
        font-size:1.3rem; 
        flex-direction:column; 
        gap:0.4rem;
    }
    .gallery-modal-header p { font-size:0.9rem; }
    .background-gallery-grid { 
        grid-template-columns:repeat(2,1fr); 
        gap:1rem;
    }

    .modal-preview-container { aspect-ratio:4/3; }
    .modal-crosshair-img { max-width:90px; max-height:90px; }
    .modal-info { padding:1.25rem; }
    .modal-info h3 { font-size:1.2rem; }
    .modal-info p { font-size:0.9rem; }
    
    /* Related */
    .related-grid { 
        grid-template-columns:1fr; 
        gap:1.5rem;
    }
}

@media (max-width: 480px) {
    /* Container */
    .container { padding:0 0.875rem; }
    
    /* Preview */
    .preview-section { padding:1rem; }
    .preview-area { padding:1rem; min-height:220px; }
    .main-crosshair-img, .crosshair-display svg {
        max-width:110px !important; 
        max-height:110px !important;
    }
    
    /* Header */
    .crosshair-title { font-size:1.4rem; }
    .badge { 
        font-size:0.65rem; 
        padding:0.35rem 0.7rem;
    }
    
    /* Controls */
    .control-btn {
        font-size:0.75rem;
        padding:0.5rem 0.75rem;
        gap:0.375rem;
    }
    .control-btn i { font-size:0.875rem; }
    
    /* Statistics - Extra Small Screens */
    .stat-item {
        padding:0.75rem;
    }
    .stat-item i {
        font-size:1.2rem;
    }
    .stat-value {
        font-size:1.1rem;
    }
    .stat-label {
        font-size:0.75rem;
    }
    
    /* Description */
    .description-text {
        font-size:0.9rem;
    }
    
    /* Code */
    .code-card code {
        font-size:0.7rem;
    }
    
    /* Modals */
    .background-gallery-grid { 
        grid-template-columns:1fr;
        gap:0.875rem;
    }
    .gallery-modal-content { padding:1rem; }
    .gallery-modal-header h2 { font-size:1.15rem; }
    
    .modal-preview-container { aspect-ratio:1/1; }
    .modal-crosshair-img { max-width:70px; max-height:70px; }
    
    /* Related */
    .section-title { font-size:1.3rem; }
}

/* Landscape Mode for Small Devices */
@media (max-width: 768px) and (orientation: landscape) {
    .stats-grid {
        grid-template-columns:repeat(2,1fr);
    }
    .modal-preview-container {
        aspect-ratio:16/9;
    }
}
</style>


<script>
// Background images data for modal
const backgroundImagesData = {
    @if(isset($backgroundImages) && $backgroundImages->count() > 0)
        @foreach($backgroundImages as $bgImage)
            @php
                $jsImagePath = preg_replace('#^(public/storage/|storage/app/public/)#', '', $bgImage->image);
            @endphp
            {{ $bgImage->id }}: {
                image: '{{ asset('storage/' . $jsImagePath) }}',
                name: '{{ addslashes($bgImage->name) }}',
                creator: '{{ $bgImage->creator ? addslashes($bgImage->creator->name) : 'Background Image' }}'
            },
        @endforeach
    @endif
};

// Background change functionality for main preview
function changeBackground(type) {
    const previewBackground = document.getElementById('previewBackground');
    const allButtons = document.querySelectorAll('.control-btn');

    allButtons.forEach(btn => btn.classList.remove('active'));

    const activeButton = document.getElementById('btn-' + type);
    if (activeButton) activeButton.classList.add('active');

    switch(type) {
        case 'default':
            previewBackground.style.backgroundImage =
                'linear-gradient(90deg, rgba(255, 45, 95, 0.05) 1px, transparent 1px), linear-gradient(rgba(255, 45, 95, 0.05) 1px, transparent 1px)';
            previewBackground.style.backgroundSize = '30px 30px';
            previewBackground.style.backgroundColor = 'transparent';
            previewBackground.style.opacity = '0.3';
            break;

        case 'dark':
            previewBackground.style.backgroundImage = 'none';
            previewBackground.style.backgroundColor = 'rgba(0, 0, 0, 0.85)';
            previewBackground.style.opacity = '1';
            break;

        case 'light':
            previewBackground.style.backgroundImage = 'none';
            previewBackground.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
            previewBackground.style.opacity = '1';
            break;
    }
}

function openBackgroundGalleryModal() {
    const modal = document.getElementById('backgroundGalleryModal');
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeBackgroundGalleryModal() {
    const modal = document.getElementById('backgroundGalleryModal');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

function openBackgroundPreviewModal(bgId) {
    const modal = document.getElementById('backgroundModal');
    const bgData = backgroundImagesData[bgId];

    if (bgData && modal) {
        document.getElementById('modalBackgroundImage').src = bgData.image;
        document.getElementById('modalBackgroundName').textContent = bgData.name;
        document.getElementById('modalBackgroundCreator').textContent = 'by ' + bgData.creator;
        modal.classList.add('active');
    }
}

function closeBackgroundModal() {
    const modal = document.getElementById('backgroundModal');
    if (modal) modal.classList.remove('active');
}

// Copy settings
const copySettingsBtn = document.querySelector('.copy-settings-btn');
if (copySettingsBtn) {
    copySettingsBtn.addEventListener('click', function() {
        const settings = this.getAttribute('data-settings');
        navigator.clipboard.writeText(settings).then(() => {
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check"></i> Copied!';
            setTimeout(() => this.innerHTML = originalText, 2000);
        }).catch(() => alert('Failed to copy settings'));
    });
}

// Copy code
const copyCodeBtn = document.querySelector('.copy-code-btn');
if (copyCodeBtn) {
    copyCodeBtn.addEventListener('click', function() {
        const code = document.getElementById('crosshair-code').textContent;
        navigator.clipboard.writeText(code).then(() => {
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check"></i> Copied!';
            setTimeout(() => this.innerHTML = originalText, 2000);
        }).catch(() => alert('Failed to copy code'));
    });
}

// Copy code in modal (increments counter)
const modalCopyCodeBtn = document.querySelector('.modal-copy-code-btn');
if (modalCopyCodeBtn) {
    modalCopyCodeBtn.addEventListener('click', function() {
        const btn = this;
        const crosshairId = btn.getAttribute('data-crosshair-id');
        const originalText = btn.innerHTML;

        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Copying...';
        btn.disabled = true;

        fetch(`/crosshairs/${crosshairId}/copy`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
                const copiesElement = document.getElementById('copies-count');
                if (copiesElement && data.copies) {
                    copiesElement.textContent = data.copies.toLocaleString();
                }
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }, 2000);
            }
        })
        .catch(() => {
            btn.innerHTML = '<i class="fas fa-times"></i> Error';
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
            }, 2000);
        });
    });
}

// Main copy button
const downloadBtn = document.querySelector('.download-btn');
if (downloadBtn) {
    downloadBtn.addEventListener('click', function() {
        const btn = this;
        const crosshairId = btn.getAttribute('data-crosshair-id');
        const originalText = btn.innerHTML;

        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        btn.disabled = true;

        fetch(`/crosshairs/${crosshairId}/copy`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
                const copiesElement = document.getElementById('copies-count');
                if (copiesElement && data.copies) {
                    copiesElement.textContent = data.copies.toLocaleString();
                }
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }, 2000);
            }
        })
        .catch(() => {
            btn.innerHTML = '<i class="fas fa-times"></i> Error';
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
            }, 2000);
        });
    });
}

// Favorite button
const favoriteBtn = document.querySelector('.favorite-btn');
if (favoriteBtn) {
    favoriteBtn.addEventListener('click', function() {
        const icon = this.querySelector('i');
        if (icon.classList.contains('far')) {
            icon.classList.remove('far'); icon.classList.add('fas');
            this.style.background = 'var(--primary-pink)';
            this.style.color = 'white';
            this.style.borderColor = 'var(--primary-pink)';
        } else {
            icon.classList.remove('fas'); icon.classList.add('far');
            this.style.background = '';
            this.style.color = '';
            this.style.borderColor = '';
        }
    });
}

// Share
const shareBtn = document.querySelector('.share-btn');
if (shareBtn) {
    shareBtn.addEventListener('click', function() {
        if (navigator.share) {
            navigator.share({
                title: document.querySelector('.crosshair-title').textContent,
                url: window.location.href
            });
        } else {
            navigator.clipboard.writeText(window.location.href).then(() => {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check"></i> Link Copied!';
                setTimeout(() => this.innerHTML = originalText, 2000);
            });
        }
    });
}

// Escape key closes modals
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeBackgroundModal();
        closeBackgroundGalleryModal();
    }
});

// Prevent body scroll when modal is open
document.addEventListener('DOMContentLoaded', function() {
    const modals = document.querySelectorAll('.background-gallery-modal, .background-modal');
    modals.forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                if (this.classList.contains('background-gallery-modal')) {
                    closeBackgroundGalleryModal();
                } else {
                    closeBackgroundModal();
                }
            }
        });
    });
});
</script>
@endsection