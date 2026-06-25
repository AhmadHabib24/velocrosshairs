@extends('layouts.app')

@section('title', 'Crosshair Designer - Create Custom Crosshairs | PrecisionAim')
@section('description', 'Create custom gaming crosshairs with our advanced designer. Adjust size, color, opacity, and style to create the perfect crosshair for your gaming setup.')

@push('styles')
<style>
    .designer-container {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 2rem;
        padding: 2rem 0;
        min-height: calc(100vh - 80px);
    }
    
    .canvas-section {
        background: var(--dark-card);
        border-radius: 1rem;
        border: 1px solid var(--dark-border);
        display: flex;
        flex-direction: column;
    }
    
    .canvas-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--dark-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .canvas-title {
        font-family: 'Orbitron', monospace;
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-primary);
    }
    
    .canvas-actions {
        display: flex;
        gap: 1rem;
    }
    
    .canvas-area {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background: 
            linear-gradient(90deg, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
            linear-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 20px 20px;
        min-height: 600px;
    }
    
    .crosshair-preview {
        position: relative;
        z-index: 10;
    }
    
    .controls-panel {
        background: var(--dark-card);
        border-radius: 1rem;
        border: 1px solid var(--dark-border);
        height: fit-content;
        max-height: calc(100vh - 140px);
        overflow-y: auto;
    }
    
    .panel-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--dark-border);
        position: sticky;
        top: 0;
        background: var(--dark-card);
        z-index: 10;
    }
    
    .panel-title {
        font-family: 'Orbitron', monospace;
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-primary);
    }
    
    .controls-content {
        padding: 2rem;
    }
    
    .control-group {
        margin-bottom: 2rem;
    }
    
    .control-label {
        display: block;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }
    
    .control-input {
        width: 100%;
        background: var(--dark-bg);
        border: 1px solid var(--dark-border);
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        color: var(--text-primary);
        transition: all 0.3s ease;
    }
    
    .control-input:focus {
        outline: none;
        border-color: var(--primary-pink);
        box-shadow: 0 0 0 3px rgba(255, 45, 95, 0.1);
    }
    
    .slider-container {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .slider {
        flex: 1;
        -webkit-appearance: none;
        appearance: none;
        height: 6px;
        border-radius: 3px;
        background: var(--dark-border);
        outline: none;
    }
    
    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: var(--primary-pink);
        cursor: pointer;
        box-shadow: var(--glow-pink);
    }
    
    .slider::-moz-range-thumb {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: var(--primary-pink);
        cursor: pointer;
        border: none;
        box-shadow: var(--glow-pink);
    }
    
    .slider-value {
        min-width: 40px;
        text-align: center;
        color: var(--text-secondary);
        font-weight: 500;
    }
    
    .color-picker-container {
        display: flex;
        gap: 1rem;
        align-items: center;
    }
    
    .color-picker {
        width: 60px;
        height: 40px;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        background: transparent;
    }
    
    .preset-colors {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    
    .preset-color {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }
    
    .preset-color:hover,
    .preset-color.active {
        border-color: var(--text-primary);
        transform: scale(1.1);
    }
    
    .checkbox-container {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    
    .checkbox {
        width: 18px;
        height: 18px;
        border: 2px solid var(--dark-border);
        border-radius: 4px;
        background: transparent;
        cursor: pointer;
        position: relative;
        transition: all 0.3s ease;
    }
    
    .checkbox:checked {
        background: var(--primary-pink);
        border-color: var(--primary-pink);
    }
    
    .checkbox:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 12px;
    }
    
    .presets-section {
        border-top: 1px solid var(--dark-border);
        padding-top: 2rem;
        margin-top: 2rem;
    }
    
    .presets-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.5rem;
        margin-top: 1rem;
    }
    
    .preset-btn {
        padding: 0.75rem;
        background: var(--dark-bg);
        border: 1px solid var(--dark-border);
        border-radius: 0.5rem;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        font-size: 0.9rem;
    }
    
    .preset-btn:hover,
    .preset-btn.active {
        background: var(--primary-pink);
        color: white;
        border-color: var(--primary-pink);
    }
    
    .save-section {
        border-top: 1px solid var(--dark-border);
        padding-top: 2rem;
        margin-top: 2rem;
    }
    
    .save-form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    /* Mobile Responsive */
    @media (max-width: 1024px) {
        .designer-container {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .controls-panel {
            order: -1;
            max-height: none;
        }
        
        .canvas-area {
            min-height: 400px;
        }
    }
    
    @media (max-width: 768px) {
        .designer-container {
            padding: 1rem 0;
        }
        
        .canvas-header,
        .panel-header,
        .controls-content {
            padding: 1rem;
        }
        
        .presets-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="designer-container">
        <!-- Canvas Section -->
        <div class="canvas-section">
            <div class="canvas-header">
                <h1 class="canvas-title">Crosshair <span class="text-gradient">Designer</span></h1>
                <div class="canvas-actions">
                    <button class="btn btn-ghost" id="resetBtn">
                        <i class="fas fa-undo"></i>
                        Reset
                    </button>
                    <button class="btn btn-outline" id="exportBtn">
                        <i class="fas fa-download"></i>
                        Export
                    </button>
                </div>
            </div>
            
            <div class="canvas-area" id="canvasArea">
                <svg id="crosshairPreview" width="200" height="200" viewBox="0 0 200 200">
                    <!-- Crosshair will be rendered here -->
                </svg>
            </div>
        </div>
        
        <!-- Controls Panel -->
        <div class="controls-panel">
            <div class="panel-header">
                <h2 class="panel-title">Controls</h2>
            </div>
            
            <div class="controls-content">
                <!-- Basic Settings -->
                <div class="control-group">
                    <label class="control-label">Crosshair Style</label>
                    <select class="control-input" id="styleSelect">
                        <option value="cross">Cross</option>
                        <option value="dot">Dot Only</option>
                        <option value="circle">Circle</option>
                        <option value="square">Square</option>
                        <option value="plus">Plus</option>
                    </select>
                </div>
                
                <!-- Size Controls -->
                <div class="control-group">
                    <label class="control-label">Size</label>
                    <div class="slider-container">
                        <input type="range" class="slider" id="sizeSlider" min="5" max="50" value="20">
                        <span class="slider-value" id="sizeValue">20</span>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Thickness</label>
                    <div class="slider-container">
                        <input type="range" class="slider" id="thicknessSlider" min="1" max="10" value="2">
                        <span class="slider-value" id="thicknessValue">2</span>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Gap</label>
                    <div class="slider-container">
                        <input type="range" class="slider" id="gapSlider" min="0" max="20" value="4">
                        <span class="slider-value" id="gapValue">4</span>
                    </div>
                </div>
                
                <!-- Color Settings -->
                <div class="control-group">
                    <label class="control-label">Color</label>
                    <div class="color-picker-container">
                        <input type="color" class="color-picker" id="colorPicker" value="#FF2D5F">
                        <input type="text" class="control-input" id="colorInput" value="#FF2D5F" style="flex: 1;">
                    </div>
                    <div class="preset-colors">
                        <div class="preset-color" style="background: #FF2D5F;" data-color="#FF2D5F"></div>
                        <div class="preset-color" style="background: #FF6B7A;" data-color="#FF6B7A"></div>
                        <div class="preset-color" style="background: #00D25B;" data-color="#00D25B"></div>
                        <div class="preset-color" style="background: #FFB800;" data-color="#FFB800"></div>
                        <div class="preset-color" style="background: #FF4757;" data-color="#FF4757"></div>
                        <div class="preset-color" style="background: #FFFFFF;" data-color="#FFFFFF"></div>
                        <div class="preset-color" style="background: #00FFFF;" data-color="#00FFFF"></div>
                        <div class="preset-color" style="background: #FF00FF;" data-color="#FF00FF"></div>
                        <div class="preset-color" style="background: #FFFF00;" data-color="#FFFF00"></div>
                        <div class="preset-color" style="background: #FFA500;" data-color="#FFA500"></div>
                        <div class="preset-color" style="background: #8A2BE2;" data-color="#8A2BE2"></div>
                        <div class="preset-color" style="background: #32CD32;" data-color="#32CD32"></div>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Opacity</label>
                    <div class="slider-container">
                        <input type="range" class="slider" id="opacitySlider" min="10" max="100" value="100">
                        <span class="slider-value" id="opacityValue">100%</span>
                    </div>
                </div>
                
                <!-- Advanced Settings -->
                <div class="control-group">
                    <label class="control-label">Advanced Options</label>
                    <div class="checkbox-container">
                        <input type="checkbox" class="checkbox" id="outlineCheck">
                        <label for="outlineCheck" style="color: var(--text-secondary);">Add Outline</label>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" class="checkbox" id="centerDotCheck">
                        <label for="centerDotCheck" style="color: var(--text-secondary);">Center Dot</label>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" class="checkbox" id="dynamicCheck">
                        <label for="dynamicCheck" style="color: var(--text-secondary);">Dynamic Scaling</label>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Outline Thickness</label>
                    <div class="slider-container">
                        <input type="range" class="slider" id="outlineThicknessSlider" min="1" max="5" value="1" disabled>
                        <span class="slider-value" id="outlineThicknessValue">1</span>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Center Dot Size</label>
                    <div class="slider-container">
                        <input type="range" class="slider" id="dotSizeSlider" min="1" max="8" value="2" disabled>
                        <span class="slider-value" id="dotSizeValue">2</span>
                    </div>
                </div>
                
                <!-- Presets Section -->
                <div class="presets-section">
                    <label class="control-label">Quick Presets</label>
                    <div class="presets-grid">
                        <button class="preset-btn" data-preset="classic">Classic</button>
                        <button class="preset-btn" data-preset="minimal">Minimal</button>
                        <button class="preset-btn" data-preset="dot">Dot Only</button>
                        <button class="preset-btn" data-preset="thick">Thick</button>
                        <button class="preset-btn" data-preset="pro">Pro Style</button>
                        <button class="preset-btn" data-preset="sniper">Sniper</button>
                    </div>
                </div>
                
                <!-- Save Section -->
                <div class="save-section">
                    <label class="control-label">Save Crosshair</label>
                    <div class="save-form">
                        <input type="text" class="control-input" id="crosshairName" placeholder="Enter crosshair name...">
                        <textarea class="control-input" id="crosshairDescription" placeholder="Description (optional)" rows="3" style="resize: vertical;"></textarea>
                        <button class="btn btn-primary" id="saveBtn">
                            <i class="fas fa-save"></i>
                            Save Crosshair
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
class CrosshairDesigner {
    constructor() {
        this.settings = {
            style: 'cross',
            size: 20,
            thickness: 2,
            gap: 4,
            color: '#FF2D5F',
            opacity: 100,
            outline: false,
            centerDot: false,
            dynamic: false,
            outlineThickness: 1,
            dotSize: 2
        };
        
        this.initializeElements();
        this.bindEvents();
        this.updatePreview();
    }
    
    initializeElements() {
        this.preview = document.getElementById('crosshairPreview');
        this.elements = {
            style: document.getElementById('styleSelect'),
            size: document.getElementById('sizeSlider'),
            thickness: document.getElementById('thicknessSlider'),
            gap: document.getElementById('gapSlider'),
            color: document.getElementById('colorPicker'),
            colorInput: document.getElementById('colorInput'),
            opacity: document.getElementById('opacitySlider'),
            outline: document.getElementById('outlineCheck'),
            centerDot: document.getElementById('centerDotCheck'),
            dynamic: document.getElementById('dynamicCheck'),
            outlineThickness: document.getElementById('outlineThicknessSlider'),
            dotSize: document.getElementById('dotSizeSlider')
        };
        
        this.values = {
            size: document.getElementById('sizeValue'),
            thickness: document.getElementById('thicknessValue'),
            gap: document.getElementById('gapValue'),
            opacity: document.getElementById('opacityValue'),
            outlineThickness: document.getElementById('outlineThicknessValue'),
            dotSize: document.getElementById('dotSizeValue')
        };
    }
    
    bindEvents() {
        // Sliders
        Object.keys(this.elements).forEach(key => {
            const element = this.elements[key];
            if (element.type === 'range') {
                element.addEventListener('input', (e) => {
                    this.settings[key] = parseInt(e.target.value);
                    this.values[key].textContent = key === 'opacity' ? e.target.value + '%' : e.target.value;
                    this.updatePreview();
                });
            } else if (element.type === 'color') {
                element.addEventListener('input', (e) => {
                    this.settings.color = e.target.value;
                    this.elements.colorInput.value = e.target.value;
                    this.updatePreview();
                });
            } else if (element.type === 'text') {
                element.addEventListener('input', (e) => {
                    if (key === 'colorInput' && /^#[0-9A-F]{6}$/i.test(e.target.value)) {
                        this.settings.color = e.target.value;
                        this.elements.color.value = e.target.value;
                        this.updatePreview();
                    }
                });
            } else if (element.type === 'checkbox') {
                element.addEventListener('change', (e) => {
                    this.settings[key] = e.target.checked;
                    this.toggleAdvancedControls();
                    this.updatePreview();
                });
            } else if (element.tagName === 'SELECT') {
                element.addEventListener('change', (e) => {
                    this.settings[key] = e.target.value;
                    this.updatePreview();
                });
            }
        });
        
        // Preset colors
        document.querySelectorAll('.preset-color').forEach(preset => {
            preset.addEventListener('click', (e) => {
                const color = e.target.dataset.color;
                this.settings.color = color;
                this.elements.color.value = color;
                this.elements.colorInput.value = color;
                this.updatePreview();
                
                // Update active state
                document.querySelectorAll('.preset-color').forEach(p => p.classList.remove('active'));
                e.target.classList.add('active');
            });
        });
        
        // Preset buttons
        document.querySelectorAll('.preset-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                this.loadPreset(e.target.dataset.preset);
                
                // Update active state
                document.querySelectorAll('.preset-btn').forEach(p => p.classList.remove('active'));
                e.target.classList.add('active');
            });
        });
        
        // Action buttons
        document.getElementById('resetBtn').addEventListener('click', () => this.reset());
        document.getElementById('exportBtn').addEventListener('click', () => this.export());
        document.getElementById('saveBtn').addEventListener('click', () => this.save());
    }
    
    toggleAdvancedControls() {
        const outlineSlider = this.elements.outlineThickness;
        const dotSlider = this.elements.dotSize;
        
        outlineSlider.disabled = !this.settings.outline;
        dotSlider.disabled = !this.settings.centerDot;
        
        outlineSlider.style.opacity = this.settings.outline ? '1' : '0.5';
        dotSlider.style.opacity = this.settings.centerDot ? '1' : '0.5';
    }
    
    updatePreview() {
        const centerX = 100;
        const centerY = 100;
        const opacity = this.settings.opacity / 100;
        
        let svg = '';
        
        // Create outline if enabled
        if (this.settings.outline) {
            svg += this.generateCrosshair(centerX, centerY, true);
        }
        
        // Create main crosshair
        svg += this.generateCrosshair(centerX, centerY, false);
        
        // Add center dot if enabled
        if (this.settings.centerDot) {
            svg += `<circle cx="${centerX}" cy="${centerY}" r="${this.settings.dotSize}" 
                    fill="${this.settings.color}" opacity="${opacity}" />`;
        }
        
        this.preview.innerHTML = svg;
    }
    
    generateCrosshair(centerX, centerY, isOutline) {
        const size = this.settings.size;
        const thickness = isOutline ? this.settings.thickness + this.settings.outlineThickness * 2 : this.settings.thickness;
        const gap = this.settings.gap;
        const color = isOutline ? '#000000' : this.settings.color;
        const opacity = isOutline ? 0.8 : this.settings.opacity / 100;
        
        let svg = '';
        
        switch (this.settings.style) {
            case 'cross':
                // Vertical lines
                svg += `<line x1="${centerX}" y1="${centerY - size - gap}" x2="${centerX}" y2="${centerY - gap}" 
                        stroke="${color}" stroke-width="${thickness}" stroke-linecap="round" opacity="${opacity}" />`;
                svg += `<line x1="${centerX}" y1="${centerY + gap}" x2="${centerX}" y2="${centerY + size + gap}" 
                        stroke="${color}" stroke-width="${thickness}" stroke-linecap="round" opacity="${opacity}" />`;
                // Horizontal lines
                svg += `<line x1="${centerX - size - gap}" y1="${centerY}" x2="${centerX - gap}" y2="${centerY}" 
                        stroke="${color}" stroke-width="${thickness}" stroke-linecap="round" opacity="${opacity}" />`;
                svg += `<line x1="${centerX + gap}" y1="${centerY}" x2="${centerX + size + gap}" y2="${centerY}" 
                        stroke="${color}" stroke-width="${thickness}" stroke-linecap="round" opacity="${opacity}" />`;
                break;
                
            case 'dot':
                // Only center dot (handled in updatePreview)
                break;
                
            case 'circle':
                svg += `<circle cx="${centerX}" cy="${centerY}" r="${size}" 
                        stroke="${color}" stroke-width="${thickness}" fill="none" opacity="${opacity}" />`;
                break;
                
            case 'square':
                const halfSize = size;
                svg += `<rect x="${centerX - halfSize}" y="${centerY - halfSize}" width="${halfSize * 2}" height="${halfSize * 2}" 
                        stroke="${color}" stroke-width="${thickness}" fill="none" opacity="${opacity}" />`;
                break;
                
            case 'plus':
                // Full cross without gap
                svg += `<line x1="${centerX}" y1="${centerY - size}" x2="${centerX}" y2="${centerY + size}" 
                        stroke="${color}" stroke-width="${thickness}" stroke-linecap="round" opacity="${opacity}" />`;
                svg += `<line x1="${centerX - size}" y1="${centerY}" x2="${centerX + size}" y2="${centerY}" 
                        stroke="${color}" stroke-width="${thickness}" stroke-linecap="round" opacity="${opacity}" />`;
                break;
        }
        
        return svg;
    }
    
    loadPreset(presetName) {
        const presets = {
            classic: { style: 'cross', size: 20, thickness: 2, gap: 4, color: '#FFFFFF', opacity: 100, outline: false, centerDot: true },
            minimal: { style: 'cross', size: 15, thickness: 1, gap: 3, color: '#00FFFF', opacity: 80, outline: false, centerDot: false },
            dot: { style: 'dot', size: 10, thickness: 1, gap: 0, color: '#FF2D5F', opacity: 100, outline: false, centerDot: true },
            thick: { style: 'cross', size: 25, thickness: 4, gap: 6, color: '#FFFF00', opacity: 100, outline: true, centerDot: false },
            pro: { style: 'cross', size: 18, thickness: 2, gap: 2, color: '#00D25B', opacity: 90, outline: false, centerDot: true },
            sniper: { style: 'circle', size: 30, thickness: 1, gap: 0, color: '#FF4757', opacity: 70, outline: false, centerDot: true }
        };
        
        if (presets[presetName]) {
            this.settings = { ...this.settings, ...presets[presetName] };
            this.updateControls();
            this.updatePreview();
        }
    }
    
    updateControls() {
        // Update all control values to match current settings
        Object.keys(this.elements).forEach(key => {
            const element = this.elements[key];
            const value = this.settings[key];
            
            if (element.type === 'range') {
                element.value = value;
                this.values[key].textContent = key === 'opacity' ? value + '%' : value;
            } else if (element.type === 'color') {
                element.value = value;
            } else if (element.type === 'text' && key === 'colorInput') {
                element.value = value;
            } else if (element.type === 'checkbox') {
                element.checked = value;
            } else if (element.tagName === 'SELECT') {
                element.value = value;
            }
        });
        
        this.toggleAdvancedControls();
    }
    
    reset() {
        this.settings = {
            style: 'cross',
            size: 20,
            thickness: 2,
            gap: 4,
            color: '#FF2D5F',
            opacity: 100,
            outline: false,
            centerDot: false,
            dynamic: false,
            outlineThickness: 1,
            dotSize: 2
        };
        
        this.updateControls();
        this.updatePreview();
        
        // Clear active states
        document.querySelectorAll('.preset-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.preset-color').forEach(color => color.classList.remove('active'));
    }
    
    export() {
        const svgData = this.preview.outerHTML;
        const blob = new Blob([svgData], { type: 'image/svg+xml' });
        const url = URL.createObjectURL(blob);
        
        const a = document.createElement('a');
        a.href = url;
        a.download = 'crosshair.svg';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
        
        // Show success message
        this.showNotification('Crosshair exported successfully!', 'success');
    }
    
    save() {
        const name = document.getElementById('crosshairName').value;
        const description = document.getElementById('crosshairDescription').value;
        
        if (!name.trim()) {
            this.showNotification('Please enter a name for your crosshair.', 'error');
            return;
        }
        
        // Here you would typically send the data to your server
        const crosshairData = {
            name: name.trim(),
            description: description.trim(),
            settings: this.settings,
            svg: this.preview.outerHTML
        };
        
        console.log('Saving crosshair:', crosshairData);
        
        // Simulate save success
        this.showNotification('Crosshair saved successfully!', 'success');
        
        // Clear form
        document.getElementById('crosshairName').value = '';
        document.getElementById('crosshairDescription').value = '';
    }
    
    showNotification(message, type) {
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 2rem;
            border-radius: 0.5rem;
            color: white;
            font-weight: 600;
            z-index: 9999;
            animation: slideIn 0.3s ease;
            background: ${type === 'success' ? 'var(--success)' : 'var(--danger)'};
        `;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease forwards';
            setTimeout(() => document.body.removeChild(notification), 300);
        }, 3000);
    }
}

// Add keyframe animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
`;
document.head.appendChild(style);

// Initialize the designer when the page loads
document.addEventListener('DOMContentLoaded', () => {
    new CrosshairDesigner();
});
</script>
@endpush