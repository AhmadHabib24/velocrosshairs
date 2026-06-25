<section class="hero">
    <div class="hero-background"></div>
    <div class="hero-pattern"></div>
    
    <!-- Floating Elements -->
    <div class="floating-elements">
        <div class="floating-crosshair" style="top: 15%; left: 10%;">
            <svg width="30" height="30" viewBox="0 0 30 30">
                <g stroke="rgba(255, 45, 95, 0.3)" stroke-width="2" fill="none">
                    <line x1="15" y1="5" x2="15" y2="12" />
                    <line x1="15" y1="18" x2="15" y2="25" />
                    <line x1="5" y1="15" x2="12" y2="15" />
                    <line x1="18" y1="15" x2="25" y2="15" />
                </g>
            </svg>
        </div>
        <div class="floating-crosshair" style="top: 70%; right: 15%;">
            <svg width="25" height="25" viewBox="0 0 25 25">
                <circle cx="12.5" cy="12.5" r="10" stroke="rgba(255, 107, 122, 0.4)" stroke-width="2" fill="none"/>
            </svg>
        </div>
        <div class="floating-crosshair" style="top: 30%; right: 20%;">
            <svg width="20" height="20" viewBox="0 0 20 20">
                <g stroke="rgba(255, 45, 95, 0.2)" stroke-width="1" fill="none">
                    <line x1="10" y1="3" x2="10" y2="8" />
                    <line x1="10" y1="12" x2="10" y2="17" />
                    <line x1="3" y1="10" x2="8" y2="10" />
                    <line x1="12" y1="10" x2="17" y2="10" />
                    <circle cx="10" cy="10" r="1" fill="rgba(255, 45, 95, 0.3)" />
                </g>
            </svg>
        </div>
    </div>
    
    <div class="container">
        <div class="hero-content fade-in">
            <!-- Main Heading -->
            <div class="hero-badge">
                <span class="badge-icon">🎯</span>
                <span>Trusted by 50,000+ Gamers</span>
            </div>
            
            <h1 class="hero-title">
                Elevate Your <span class="text-gradient">Gaming Aim</span><br>
                with Professional Crosshairs
            </h1>
            
            <p class="hero-subtitle">
                Join thousands of competitive gamers who trust PrecisionAim for custom crosshair overlays, 
                professional gaming enhancement, and unmatched accuracy in every shot. Compatible with 
                <strong>Valorant, CS2, Apex Legends</strong>, and 200+ more games.
            </p>
            
            <!-- Feature Pills -->
            <div class="hero-features">
                <div class="feature-pill">
                    <i class="fas fa-shield-alt"></i>
                    <span>Anti-Cheat Safe</span>
                </div>
                <div class="feature-pill">
                    <i class="fas fa-bolt"></i>
                    <span>Zero Input Lag</span>
                </div>
                <div class="feature-pill">
                    <i class="fas fa-download"></i>
                    <span>Free Forever</span>
                </div>
            </div>
            
            <!-- Call to Action -->
            <div class="hero-cta">
                <a href="{{ route('download') }}" class="btn btn-primary pulse cta-primary">
                    <i class="fas fa-download"></i>
                    <span>Download Free</span>
                    <small>Windows, Mac, Linux</small>
                </a>
                <a href="{{ route('crosshairs.create') }}" class="btn btn-outline cta-secondary">
                    <i class="fas fa-paint-brush"></i>
                    <span>Try Designer</span>
                </a>
            </div>
            
            <!-- Trust Indicators -->
            <div class="trust-indicators">
                <div class="trust-item">
                    <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=80&h=40&fit=crop" alt="Valorant" class="trust-logo">
                    <span>Valorant</span>
                </div>
                <div class="trust-item">
                    <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?w=80&h=40&fit=crop" alt="CS2" class="trust-logo">
                    <span>CS2</span>
                </div>
                <div class="trust-item">
                    <img src="https://images.unsplash.com/photo-1511512578047-dfb367046420?w=80&h=40&fit=crop" alt="Apex" class="trust-logo">
                    <span>Apex Legends</span>
                </div>
                <div class="trust-item">
                    <img src="https://images.unsplash.com/photo-1518709268805-4e9042af2176?w=80&h=40&fit=crop" alt="OW2" class="trust-logo">
                    <span>Overwatch 2</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <div class="scroll-mouse">
            <div class="scroll-wheel"></div>
        </div>
        <span>Scroll to explore</span>
    </div>
</section>

<style>
.hero {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(ellipse at center, rgba(255, 45, 95, 0.15) 0%, transparent 70%),
                linear-gradient(135deg, var(--dark-bg) 0%, #0F1419 50%, var(--dark-bg) 100%);
    z-index: -2;
}

.hero-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 25% 25%, rgba(255, 45, 95, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(255, 107, 122, 0.08) 0%, transparent 50%),
        linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px),
        linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px);
    background-size: 100% 100%, 100% 100%, 50px 50px, 50px 50px;
    z-index: -1;
}

.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.floating-crosshair {
    position: absolute;
    animation: float 6s ease-in-out infinite;
    opacity: 0.6;
}

.floating-crosshair:nth-child(2) {
    animation-delay: -2s;
}

.floating-crosshair:nth-child(3) {
    animation-delay: -4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.hero-content {
    text-align: center;
    max-width: 900px;
    margin: 0 auto;
    z-index: 10;
    position: relative;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 45, 95, 0.1);
    border: 1px solid rgba(255, 45, 95, 0.3);
    padding: 0.75rem 1.5rem;
    border-radius: 2rem;
    color: var(--primary-pink);
    font-weight: 600;
    margin-bottom: 2rem;
    font-size: 0.9rem;
    backdrop-filter: blur(10px);
    animation: glow-pulse 3s ease-in-out infinite;
}

@keyframes glow-pulse {
    0%, 100% { 
        box-shadow: 0 0 20px rgba(255, 45, 95, 0.3);
    }
    50% { 
        box-shadow: 0 0 30px rgba(255, 45, 95, 0.5);
    }
}

.badge-icon {
    font-size: 1.1rem;
}

.hero-title {
    font-family: 'Orbitron', monospace;
    font-size: clamp(2.5rem, 5vw, 4.5rem);
    font-weight: 900;
    margin-bottom: 1.5rem;
    line-height: 1.1;
    text-shadow: 0 0 30px rgba(255, 45, 95, 0.3);
}

.hero-subtitle {
    font-size: clamp(1rem, 2vw, 1.3rem);
    color: var(--text-secondary);
    margin-bottom: 2.5rem;
    line-height: 1.6;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

.hero-subtitle strong {
    color: var(--primary-coral);
    font-weight: 600;
}

.hero-features {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin: 2rem 0;
    flex-wrap: wrap;
}

.feature-pill {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--dark-card);
    border: 1px solid var(--dark-border);
    padding: 0.75rem 1.25rem;
    border-radius: 2rem;
    color: var(--text-secondary);
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.feature-pill:hover {
    border-color: var(--primary-pink);
    color: var(--primary-pink);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(255, 45, 95, 0.2);
}

.feature-pill i {
    color: var(--primary-coral);
    font-size: 1.1rem;
}

.hero-cta {
    display: flex;
    gap: 1.5rem;
    justify-content: center;
    flex-wrap: wrap;
    margin: 3rem 0;
}

.cta-primary {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.25rem;
    padding: 1.25rem 2.5rem;
    font-size: 1.1rem;
    position: relative;
    overflow: hidden;
}

.cta-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.cta-primary:hover::before {
    left: 100%;
}

.cta-primary small {
    font-size: 0.75rem;
    opacity: 0.9;
    font-weight: 400;
}

.cta-secondary {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1.25rem 2rem;
    font-size: 1.1rem;
}

.trust-indicators {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-top: 4rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    flex-wrap: wrap;
}

.trust-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    opacity: 0.7;
    transition: all 0.3s ease;
}

.trust-item:hover {
    opacity: 1;
    transform: scale(1.05);
}

.trust-logo {
    width: 60px;
    height: 30px;
    object-fit: cover;
    border-radius: 0.5rem;
    border: 1px solid var(--dark-border);
    filter: grayscale(1) brightness(0.8);
    transition: all 0.3s ease;
}

.trust-item:hover .trust-logo {
    filter: grayscale(0) brightness(1);
    border-color: var(--primary-pink);
}

.trust-item span {
    font-size: 0.85rem;
    color: var(--text-muted);
    font-weight: 500;
}

.scroll-indicator {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-muted);
    animation: bounce 2s infinite;
}

.scroll-mouse {
    width: 24px;
    height: 40px;
    border: 2px solid var(--text-muted);
    border-radius: 12px;
    position: relative;
}

.scroll-wheel {
    width: 4px;
    height: 8px;
    background: var(--primary-pink);
    border-radius: 2px;
    position: absolute;
    top: 6px;
    left: 50%;
    transform: translateX(-50%);
    animation: scroll-wheel 2s infinite;
}

@keyframes scroll-wheel {
    0% { transform: translateX(-50%) translateY(0); opacity: 1; }
    100% { transform: translateX(-50%) translateY(16px); opacity: 0; }
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
    40% { transform: translateX(-50%) translateY(-5px); }
    60% { transform: translateX(-50%) translateY(-3px); }
}

.scroll-indicator span {
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero {
        min-height: 90vh;
        padding: 2rem 0;
    }
    
    .hero-features {
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
    }
    
    .feature-pill {
        width: 100%;
        max-width: 250px;
        justify-content: center;
    }
    
    .hero-cta {
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }
    
    .cta-primary,
    .cta-secondary {
        width: 100%;
        max-width: 300px;
        justify-content: center;
    }
    
    .trust-indicators {
        gap: 1.5rem;
        margin-top: 3rem;
    }
    
    .trust-logo {
        width: 50px;
        height: 25px;
    }
    
    .floating-elements {
        display: none; /* Hide floating elements on mobile for better performance */
    }
}

@media (max-width: 480px) {
    .hero-badge {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }
    
    .trust-indicators {
        gap: 1rem;
    }
    
    .trust-item span {
        font-size: 0.75rem;
    }
}

/* Dark mode enhancements */
@media (prefers-color-scheme: dark) {
    .hero-background {
        background: radial-gradient(ellipse at center, rgba(255, 45, 95, 0.2) 0%, transparent 70%),
                    linear-gradient(135deg, var(--dark-bg) 0%, #0A0B0F 50%, var(--dark-bg) 100%);
    }
}

/* Reduced motion for accessibility */
@media (prefers-reduced-motion: reduce) {
    .floating-crosshair,
    .scroll-indicator,
    .scroll-wheel,
    .pulse,
    .glow-pulse {
        animation: none;
    }
    
    .cta-primary::before {
        display: none;
    }
}

/* High contrast mode */
@media (prefers-contrast: high) {
    .hero-badge {
        background: var(--primary-pink);
        color: var(--dark-bg);
        border-color: var(--primary-pink);
    }
    
    .feature-pill {
        border-width: 2px;
    }
    
    .trust-logo {
        filter: contrast(1.2);
    }
}
</style>