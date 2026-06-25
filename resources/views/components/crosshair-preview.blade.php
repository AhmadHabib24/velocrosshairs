@props(['crosshair', 'size' => 'md'])

<div class="crosshair-preview {{ $size }}">
    <div class="preview-container">
        @if($crosshair['preview'] == 'classic-crosshair')
            <svg class="preview-svg" viewBox="0 0 80 80">
                <g stroke="#FF2D5F" stroke-width="3" fill="none">
                    <line x1="40" y1="15" x2="40" y2="35" stroke-linecap="round" />
                    <line x1="40" y1="45" x2="40" y2="65" stroke-linecap="round" />
                    <line x1="15" y1="40" x2="35" y2="40" stroke-linecap="round" />
                    <line x1="45" y1="40" x2="65" y2="40" stroke-linecap="round" />
                    <circle cx="40" cy="40" r="3" fill="#FF2D5F" />
                </g>
            </svg>
        @else
            <svg class="preview-svg" viewBox="0 0 80 80">
                <g stroke="#00FFFF" stroke-width="2" fill="none">
                    <line x1="40" y1="20" x2="40" y2="36" />
                    <line x1="40" y1="44" x2="40" y2="60" />
                    <line x1="20" y1="40" x2="36" y2="40" />
                    <line x1="44" y1="40" x2="60" y2="40" />
                </g>
            </svg>
        @endif
    </div>
</div>

<style>
.crosshair-preview {
    display: inline-block;
    position: relative;
}

.crosshair-preview.sm .preview-svg { width: 40px; height: 40px; }
.crosshair-preview.md .preview-svg { width: 60px; height: 60px; }
.crosshair-preview.lg .preview-svg { width: 80px; height: 80px; }
.crosshair-preview.xl .preview-svg { width: 120px; height: 120px; }

.preview-container {
    background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
    border-radius: 50%;
    padding: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>