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
            <div class="stat-item"></div>
            <div class="stat-item"></div>
        </div>
        
        @if($crosshair->description)
            <p class="crosshair-description">{{ $crosshair->description }}</p>
        @endif
    </div>
</a>