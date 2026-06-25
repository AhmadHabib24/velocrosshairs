@extends('layouts.app')

@section('title', 'Download PrecisionAim - Free Gaming Crosshair Overlay')
@section('description', 'Download the PrecisionAim crosshair overlay application. Free, safe, and compatible with all major FPS games. Improve your aim instantly.')

@push('styles')
<style>
    .download-hero {
        padding: 4rem 0;
        background: linear-gradient(135deg, var(--dark-bg) 0%, var(--dark-card) 100%);
        text-align: center;
        border-bottom: 1px solid var(--dark-border);
    }
    
    .download-title {
        font-family: 'Orbitron', monospace;
        font-size: clamp(2.5rem, 4vw, 3.5rem);
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .download-subtitle {
        color: var(--text-secondary);
        font-size: 1.2rem;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .version-info {
        display: inline-flex;
        align-items: center;
        gap: 1rem;
        background: var(--dark-card);
        padding: 0.75rem 1.5rem;
        border-radius: 2rem;
        border: 1px solid var(--dark-border);
        margin-bottom: 3rem;
        color: var(--text-secondary);
    }
    
    .version-badge {
        background: var(--primary-gradient);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .download-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }
    
    .download-btn {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2rem;
        background: var(--primary-gradient);
        color: white;
        text-decoration: none;
        border-radius: 0.75rem;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: var(--glow-pink);
        border: none;
        cursor: pointer;
    }
    
    .download-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 40px rgba(255, 45, 95, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .download-btn i {
        font-size: 1.3rem;
    }
    
    .download-btn.secondary {
        background: var(--dark-card);
        border: 2px solid var(--primary-pink);
        color: var(--primary-pink);
        box-shadow: none;
    }
    
    .download-btn.secondary:hover {
        background: var(--primary-pink);
        color: white;
    }
    
    .platform-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin: 4rem 0;
    }
    
    .platform-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 1rem;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .platform-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 50px rgba(255, 45, 95, 0.1);
        border-color: var(--primary-pink);
    }
    
    .platform-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: var(--primary-pink);
    }
    
    .platform-name {
        font-family: 'Orbitron', monospace;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .platform-desc {
        color: var(--text-secondary);
        margin-bottom: 2rem;
        line-height: 1.6;
    }
    
    .platform-requirements {
        text-align: left;
        background: var(--dark-bg);
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
    }
    
    .platform-requirements h4 {
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }
    
    .platform-requirements ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .platform-requirements li {
        color: var(--text-secondary);
        font-size: 0.85rem;
        margin-bottom: 0.25rem;
        padding-left: 1rem;
        position: relative;
    }
    
    .platform-requirements li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: var(--success);
        font-weight: bold;
    }
    
    .features-section {
        padding: 4rem 0;
        background: var(--dark-bg);
    }
    
    .features-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .features-title {
        font-family: 'Orbitron', monospace;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .features-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .feature-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1.5rem;
        background: var(--dark-card);
        border-radius: 1rem;
        border: 1px solid var(--dark-border);
        transition: all 0.3s ease;
    }
    
    .feature-item:hover {
        border-color: var(--primary-pink);
        transform: translateY(-2px);
    }
    
    .feature-icon {
        width: 50px;
        height: 50px;
        background: var(--primary-gradient);
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    
    .feature-content h4 {
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        font-weight: 600;
    }
    
    .feature-content p {
        color: var(--text-secondary);
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 0;
    }
    
    .installation-section {
        padding: 4rem 0;
        background: var(--dark-card);
    }
    
    .installation-steps {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }
    
    .step-card {
        background: var(--dark-bg);
        border-radius: 1rem;
        padding: 2rem;
        border: 1px solid var(--dark-border);
        position: relative;
    }
    
    .step-number {
        position: absolute;
        top: -15px;
        left: 2rem;
        width: 30px;
        height: 30px;
        background: var(--primary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 0.9rem;
    }
    
    .step-title {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 1rem;
        margin-top: 0.5rem;
    }
    
    .step-desc {
        color: var(--text-secondary);
        line-height: 1.6;
    }
    
    .faq-section {
        padding: 4rem 0;
    }
    
    .faq-item {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 0.75rem;
        margin-bottom: 1rem;
        overflow: hidden;
    }
    
    .faq-question {
        padding: 1.5rem 2rem;
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        color: var(--text-primary);
        font-weight: 600;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
    }
    
    .faq-question:hover {
        color: var(--primary-pink);
    }
    
    .faq-answer {
        padding: 0 2rem 1.5rem;
        color: var(--text-secondary);
        line-height: 1.6;
        display: none;
    }
    
    .faq-answer.active {
        display: block;
    }
    
    .warning-box {
        background: rgba(255, 184, 0, 0.1);
        border: 1px solid var(--warning);
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin: 2rem 0;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .warning-icon {
        color: var(--warning);
        font-size: 1.5rem;
        flex-shrink: 0;
        margin-top: 0.1rem;
    }
    
    .warning-content h4 {
        color: var(--warning);
        margin-bottom: 0.5rem;
    }
    
    .warning-content p {
        color: var(--text-secondary);
        margin: 0;
        line-height: 1.5;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .download-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .download-btn {
            width: 100%;
            max-width: 300px;
            justify-content: center;
        }
        
        .platform-grid {
            grid-template-columns: 1fr;
        }
        
        .installation-steps {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
    <!-- Download Hero -->
    <section class="download-hero">
        <div class="container">
            <h1 class="download-title">Download <span class="text-gradient">PrecisionAim</span></h1>
            <p class="download-subtitle">
                The ultimate gaming crosshair overlay application. Free, safe, and trusted by over 50,000 competitive gamers worldwide.
            </p>
            
            <div class="version-info">
                <span class="version-badge">v2.4.1</span>
                <span>Latest Release • January 2024</span>
            </div>
            
            <div class="download-buttons">
                <button class="download-btn" onclick="downloadForWindows()">
                    <i class="fab fa-windows"></i>
                    Download for Windows
                </button>
                <a href="#platforms" class="download-btn secondary">
                    <i class="fas fa-th-large"></i>
                    Other Platforms
                </a>
            </div>
            
            <div class="warning-box">
                <i class="fas fa-exclamation-triangle warning-icon"></i>
                <div class="warning-content">
                    <h4>Anti-Cheat Compatibility</h4>
                    <p>PrecisionAim is completely safe and undetectable by all major anti-cheat systems. However, always check your game's Terms of Service before use.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Platform Downloads -->
    <section class="features-section" id="platforms">
        <div class="container">
            <div class="features-header">
                <h2 class="features-title">Choose Your <span class="text-gradient">Platform</span></h2>
                <p style="color: var(--text-secondary); font-size: 1.1rem;">
                    PrecisionAim is available on multiple platforms with full feature parity.
                </p>
            </div>
            
            <div class="platform-grid">
                <!-- Windows -->
                <div class="platform-card">
                    <i class="fab fa-windows platform-icon"></i>
                    <h3 class="platform-name">Windows</h3>
                    <p class="platform-desc">Full-featured desktop application with advanced overlay technology and game integration.</p>
                    
                    <div class="platform-requirements">
                        <h4>System Requirements:</h4>
                        <ul>
                            <li>Windows 10/11 (64-bit)</li>
                            <li>DirectX 11 or higher</li>
                            <li>2GB RAM minimum</li>
                            <li>50MB free disk space</li>
                        </ul>
                    </div>
                    
                    <button class="btn btn-primary" onclick="downloadForWindows()">
                        <i class="fas fa-download"></i>
                        Download (15.2 MB)
                    </button>
                </div>
                
                <!-- Mac -->
                <div class="platform-card">
                    <i class="fab fa-apple platform-icon"></i>
                    <h3 class="platform-name">macOS</h3>
                    <p class="platform-desc">Native macOS application optimized for Apple Silicon and Intel processors.</p>
                    
                    <div class="platform-requirements">
                        <h4>System Requirements:</h4>
                        <ul>
                            <li>macOS 11.0 or later</li>
                            <li>Apple Silicon or Intel CPU</li>
                            <li>2GB RAM minimum</li>
                            <li>50MB free disk space</li>
                        </ul>
                    </div>
                    
                    <button class="btn btn-primary" onclick="downloadForMac()">
                        <i class="fas fa-download"></i>
                        Download (18.4 MB)
                    </button>
                </div>
                
                <!-- Linux -->
                <div class="platform-card">
                    <i class="fab fa-linux platform-icon"></i>
                    <h3 class="platform-name">Linux</h3>
                    <p class="platform-desc">AppImage package compatible with most Linux distributions. No installation required.</p>
                    
                    <div class="platform-requirements">
                        <h4>System Requirements:</h4>
                        <ul>
                            <li>Ubuntu 18.04+ / Similar distro</li>
                            <li>X11 display server</li>
                            <li>2GB RAM minimum</li>
                            <li>50MB free disk space</li>
                        </ul>
                    </div>
                    
                    <button class="btn btn-primary" onclick="downloadForLinux()">
                        <i class="fas fa-download"></i>
                        Download (16.8 MB)
                    </button>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Features -->
    <section class="features-section">
        <div class="container">
            <div class="features-header">
                <h2 class="features-title">What's <span class="text-gradient">Included</span></h2>
            </div>
            
            <div class="features-list">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-crosshairs"></i>
                    </div>
                    <div class="feature-content">
                        <h4>500+ Professional Crosshairs</h4>
                        <p>Access thousands of crosshairs created by pro players and the community.</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Advanced Designer Tool</h4>
                        <p>Create custom crosshairs with precision controls and live preview.</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-gamepad"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Universal Game Support</h4>
                        <p>Works with Valorant, CS2, Apex Legends, Overwatch 2, and 200+ games.</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Zero Performance Impact</h4>
                        <p>Optimized overlay technology with no frame drops or input lag.</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-keyboard"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Customizable Hotkeys</h4>
                        <p>Quick-switch between crosshairs and toggle visibility with hotkeys.</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-cloud"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Cloud Sync</h4>
                        <p>Sync your crosshairs and settings across all your devices.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Installation Guide -->
    <section class="installation-section">
        <div class="container">
            <div class="features-header">
                <h2 class="features-title">Installation <span class="text-gradient">Guide</span></h2>
                <p style="color: var(--text-secondary);">Get started in under 60 seconds</p>
            </div>
            
            <div class="installation-steps">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h4 class="step-title">Download & Install</h4>
                    <p class="step-desc">Download the installer for your platform and run it. No administrator privileges required for basic installation.</p>
                </div>
                
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h4 class="step-title">Launch Application</h4>
                    <p class="step-desc">Start PrecisionAim and complete the quick setup wizard. Choose your preferred crosshair and settings.</p>
                </div>
                
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h4 class="step-title">Configure Game</h4>
                    <p class="step-desc">Set your game to windowed or borderless fullscreen mode for optimal overlay compatibility.</p>
                </div>
                
                <div class="step-card">
                    <div class="step-number">4</div>
                    <h4 class="step-title">Start Gaming</h4>
                    <p class="step-desc">Launch your favorite FPS game and enjoy your new precision crosshair overlay!</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- FAQ -->
    <section class="faq-section">
        <div class="container">
            <div class="features-header">
                <h2 class="features-title">Frequently Asked <span class="text-gradient">Questions</span></h2>
            </div>
            
            <div class="faq-list">
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFAQ(this)">
                        Is PrecisionAim safe to use with anti-cheat systems?
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        Yes, PrecisionAim uses overlay technology that is completely undetectable by all major anti-cheat systems including BattlEye, EasyAntiCheat, and Vanguard. Our software doesn't modify game files or inject code into game processes.
                    </div>
                </div>
                
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFAQ(this)">
                        Will this work with my game?
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        PrecisionAim works with any game that supports windowed or borderless fullscreen mode. This includes virtually all popular FPS games like Valorant, CS2, Apex Legends, Overwatch 2, and many more.
                    </div>
                </div>
                
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFAQ(this)">
                        Does it affect game performance?
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        No, PrecisionAim is highly optimized and uses minimal system resources. The overlay has zero impact on game performance, FPS, or input lag.
                    </div>
                </div>
                
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFAQ(this)">
                        Is it really free?
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        Yes! PrecisionAim is completely free with no hidden costs, subscriptions, or premium features. All functionality is available to every user at no charge.
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function downloadForWindows() {
        // Simulate download
        showDownloadMessage('Windows version downloading...', 'success');
        // In real implementation, this would trigger the actual download
        // window.location.href = '/downloads/PrecisionAim-Setup-Windows.exe';
    }
    
    function downloadForMac() {
        showDownloadMessage('macOS version downloading...', 'success');
        // window.location.href = '/downloads/PrecisionAim-Setup-macOS.dmg';
    }
    
    function downloadForLinux() {
        showDownloadMessage('Linux AppImage downloading...', 'success');
        // window.location.href = '/downloads/PrecisionAim-Linux.AppImage';
    }
    
    function showDownloadMessage(message, type) {
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
        notification.innerHTML = `<i class="fas fa-download"></i> ${message}`;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease forwards';
            setTimeout(() => document.body.removeChild(notification), 300);
        }, 3000);
    }
    
    function toggleFAQ(button) {
        const answer = button.nextElementSibling;
        const icon = button.querySelector('i');
        
        // Close all other FAQs
        document.querySelectorAll('.faq-answer').forEach(a => {
            if (a !== answer) {
                a.classList.remove('active');
                a.previousElementSibling.querySelector('i').style.transform = '';
            }
        });
        
        // Toggle current FAQ
        answer.classList.toggle('active');
        icon.style.transform = answer.classList.contains('active') ? 'rotate(180deg)' : '';
    }
    
    // Add download tracking (analytics)
    document.querySelectorAll('.download-btn, .btn').forEach(btn => {
        if (btn.textContent.includes('Download')) {
            btn.addEventListener('click', function() {
                // Track download event
                console.log('Download initiated:', this.textContent);
            });
        }
    });
</script>
@endpush