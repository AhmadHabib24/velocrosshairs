@extends('layouts.app')

@section('title', 'About Us - Velocrosshairs | The Authority on Valorant Crosshairs')
@section('description', 'Learn about Velocrosshairs - the most accurate, up-to-date, and trustworthy resource for Valorant crosshairs, pro player setups, and customization tools.')

@push('styles')
<style>
    /* Hero Section */
    .about-hero {
        position: relative;
        padding: 8rem 0 6rem;
        overflow: hidden;
        background: linear-gradient(135deg, var(--dark-bg) 0%, #0F1419 50%, var(--dark-bg) 100%);
    }

    .about-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(ellipse at center, rgba(255, 45, 95, 0.15) 0%, transparent 70%);
        z-index: 0;
    }

    .about-hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
        max-width: 900px;
        margin: 0 auto;
    }

    .about-title {
        font-family: 'Orbitron', monospace;
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 900;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .text-gradient {
        background: linear-gradient(135deg, #ff2d5f 0%, #ff6b7a 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .about-subtitle {
        font-size: 1.3rem;
        color: var(--text-secondary);
        line-height: 1.8;
        margin-bottom: 2rem;
    }

    /* Content Sections */
    .content-section {
        padding: 5rem 0;
        position: relative;
    }

    .content-section:nth-child(even) {
        background: linear-gradient(180deg, var(--dark-card) 0%, var(--dark-bg) 100%);
    }

    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-title {
        font-family: 'Orbitron', monospace;
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1rem;
    }

    .section-description {
        font-size: 1.1rem;
        color: var(--text-secondary);
        max-width: 800px;
        margin: 0 auto;
        line-height: 1.8;
    }

    /* Mission Cards */
    .mission-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .mission-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 1rem;
        padding: 2rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .mission-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .mission-card:hover::before {
        transform: scaleX(1);
    }

    .mission-card:hover {
        transform: translateY(-8px);
        border-color: rgba(255, 45, 95, 0.4);
        box-shadow: 0 20px 60px rgba(255, 45, 95, 0.15);
    }

    .mission-icon {
        width: 60px;
        height: 60px;
        background: var(--primary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
        color: white;
    }

    .mission-card h3 {
        font-family: 'Orbitron', monospace;
        font-size: 1.2rem;
        color: var(--text-primary);
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .mission-card p {
        color: var(--text-secondary);
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* Trust Factors */
    .trust-list {
        max-width: 900px;
        margin: 3rem auto 0;
    }

    .trust-item {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: flex-start;
        gap: 1.5rem;
        transition: all 0.3s ease;
    }

    .trust-item:hover {
        border-color: rgba(255, 45, 95, 0.4);
        transform: translateX(10px);
        box-shadow: 0 10px 40px rgba(255, 45, 95, 0.1);
    }

    .trust-icon {
        width: 50px;
        height: 50px;
        min-width: 50px;
        background: linear-gradient(135deg, rgba(255, 45, 95, 0.2) 0%, rgba(255, 107, 122, 0.1) 100%);
        border: 1px solid rgba(255, 45, 95, 0.3);
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-pink);
        font-size: 1.3rem;
    }

    .trust-content h4 {
        font-family: 'Orbitron', monospace;
        font-size: 1.1rem;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        font-weight: 700;
    }

    .trust-content p {
        color: var(--text-secondary);
        line-height: 1.6;
        margin: 0;
    }

    /* Process Steps */
    .process-steps {
        max-width: 800px;
        margin: 3rem auto 0;
    }

    .process-step {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
        position: relative;
    }

    .process-step:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 24px;
        top: 60px;
        bottom: -20px;
        width: 2px;
        background: linear-gradient(180deg, rgba(255, 45, 95, 0.5) 0%, transparent 100%);
    }

    .step-number {
        width: 50px;
        height: 50px;
        min-width: 50px;
        background: var(--primary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Orbitron', monospace;
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
        box-shadow: 0 8px 24px rgba(255, 45, 95, 0.4);
    }

    .step-content {
        flex: 1;
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 1rem;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .step-content:hover {
        border-color: rgba(255, 45, 95, 0.4);
        transform: translateX(10px);
    }

    .step-content h4 {
        font-family: 'Orbitron', monospace;
        font-size: 1.1rem;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
        font-weight: 700;
    }

    .step-content p {
        color: var(--text-secondary);
        line-height: 1.6;
        margin: 0;
    }

    /* Expertise Grid */
    .expertise-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .expertise-item {
        background: linear-gradient(145deg, #1a1a1a 0%, #0f0f0f 100%);
        border: 1px solid rgba(255, 45, 95, 0.2);
        border-radius: 0.75rem;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .expertise-item:hover {
        border-color: rgba(255, 45, 95, 0.6);
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(255, 45, 95, 0.2);
    }

    .expertise-item i {
        font-size: 2rem;
        color: var(--primary-pink);
        margin-bottom: 1rem;
        display: block;
    }

    .expertise-item span {
        color: var(--text-primary);
        font-weight: 600;
        font-size: 0.95rem;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, rgba(255, 45, 95, 0.1) 0%, transparent 100%);
        border: 1px solid rgba(255, 45, 95, 0.2);
        border-radius: 1.5rem;
        padding: 4rem 3rem;
        text-align: center;
        margin-top: 4rem;
    }

    .cta-section h3 {
        font-family: 'Orbitron', monospace;
        font-size: 2rem;
        color: var(--text-primary);
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .cta-section p {
        font-size: 1.1rem;
        color: var(--text-secondary);
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2rem;
        border-radius: 0.75rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-primary {
        background: var(--primary-gradient);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(255, 45, 95, 0.4);
    }

    .btn-outline {
        background: transparent;
        border: 2px solid var(--primary-pink);
        color: var(--primary-pink);
    }

    .btn-outline:hover {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-3px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .about-hero {
            padding: 5rem 0 3rem;
        }

        .about-title {
            font-size: 2rem;
        }

        .section-title {
            font-size: 1.8rem;
        }

        .mission-grid {
            grid-template-columns: 1fr;
        }

        .expertise-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .trust-item {
            flex-direction: column;
            text-align: center;
        }

        .process-step {
            gap: 1rem;
        }

        .step-number {
            width: 40px;
            height: 40px;
            min-width: 40px;
            font-size: 1.1rem;
        }

        .cta-section {
            padding: 2.5rem 1.5rem;
        }
    }
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="about-hero">
    <div class="container">
        <div class="about-hero-content">
            <h1 class="about-title">About <span class="text-gradient">Velocrosshairs</span></h1>
            <p class="about-subtitle">
                The most accurate, up-to-date, and trustworthy resource for Valorant crosshairs, 
                pro player setups, and customization tools on the internet.
            </p>
        </div>
    </div>
</section>

<!-- Mission Section -->
<section class="content-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Our <span class="text-gradient">Mission</span></h2>
            <p class="section-description">
                We exist because players were tired of outdated lists, inconsistent crosshair previews, 
                and missing settings scattered across multiple sites. So we consolidated everything into one reliable hub.
            </p>
        </div>

        <div class="mission-grid">
            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>Complete Verification</h3>
                <p>Provide complete and verified Valorant crosshair codes tested inside the game.</p>
            </div>

            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-image"></i>
                </div>
                <h3>Clean Previews</h3>
                <p>Offer clean previews on multiple backgrounds for accurate visibility testing.</p>
            </div>

            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-sync-alt"></i>
                </div>
                <h3>Daily Updates</h3>
                <p>Update pro and streamer crosshairs daily to keep you ahead of the meta.</p>
            </div>

            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <h3>Custom Tools</h3>
                <p>Give players tools to build custom crosshairs tailored to their playstyle.</p>
            </div>

            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3>Clear Explanations</h3>
                <p>Explain settings in a clear, helpful, game-driven way without confusion.</p>
            </div>

            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3>Performance Focus</h3>
                <p>Help you find a reticle that actually improves gameplay, not just looks cool.</p>
            </div>
        </div>
    </div>
</section>

<!-- Why Players Trust Us -->
<section class="content-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Why Players <span class="text-gradient">Trust Us</span></h2>
            <p class="section-description">
                Trust doesn't come from claiming authority. It comes from repetition, accuracy, and expertise.
            </p>
        </div>

        <div class="trust-list">
            <div class="trust-item">
                <div class="trust-icon">
                    <i class="fas fa-check-double"></i>
                </div>
                <div class="trust-content">
                    <h4>Verified Every Crosshair Code</h4>
                    <p>No random or outdated lists. Every entry is tested inside Valorant before publishing.</p>
                </div>
            </div>

            <div class="trust-item">
                <div class="trust-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="trust-content">
                    <h4>Track Pro Crosshair Changes</h4>
                    <p>When pros update their crosshairs across tournaments, our team updates them immediately.</p>
                </div>
            </div>

            <div class="trust-item">
                <div class="trust-icon">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="trust-content">
                    <h4>Categorize by Gameplay Needs</h4>
                    <p>Aim improvement, visibility, recoil control, reaction consistency, and more.</p>
                </div>
            </div>

            <div class="trust-item">
                <div class="trust-icon">
                    <i class="fas fa-palette"></i>
                </div>
                <div class="trust-content">
                    <h4>Test Colors on Real Maps</h4>
                    <p>Different lighting affects performance. We analyze crosshairs on real map backgrounds.</p>
                </div>
            </div>

            <div class="trust-item">
                <div class="trust-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="trust-content">
                    <h4>Review Community Submissions</h4>
                    <p>Every user-submitted crosshair is manually screened for accuracy and usefulness.</p>
                </div>
            </div>

            <div class="trust-item">
                <div class="trust-icon">
                    <i class="fas fa-code"></i>
                </div>
                <div class="trust-content">
                    <h4>Structured Data & Clean Format</h4>
                    <p>Search engines and players both understand our pages easily with clear organization.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Process -->
<section class="content-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Our <span class="text-gradient">Verification Process</span></h2>
            <p class="section-description">
                Every crosshair on our platform goes through a rigorous validation process.
            </p>
        </div>

        <div class="process-steps">
            <div class="process-step">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h4>Source Discovery</h4>
                    <p>We pull data from pro streams, esports footage, patch updates, or the player's own profiles.</p>
                </div>
            </div>

            <div class="process-step">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h4>In-Game Recreation</h4>
                    <p>We manually enter each crosshair into Valorant to match visuals and verify accuracy.</p>
                </div>
            </div>

            <div class="process-step">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h4>Cross-Reference Check</h4>
                    <p>We compare our test results with other sources for consistency and validation.</p>
                </div>
            </div>

            <div class="process-step">
                <div class="step-number">4</div>
                <div class="step-content">
                    <h4>Smart Categorization</h4>
                    <p>We tag each preset by style, color, use case, visibility level, difficulty, and aiming purpose.</p>
                </div>
            </div>

            <div class="process-step">
                <div class="step-number">5</div>
                <div class="step-content">
                    <h4>Multi-Background Preview</h4>
                    <p>We capture how it looks on different backgrounds (light, dark, and mixed) for real gameplay testing.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Expertise Section -->
<section class="content-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Our <span class="text-gradient">Expertise</span></h2>
            <p class="section-description">
                Built by players who study the science and mechanics behind effective crosshairs.
            </p>
        </div>

        <div class="expertise-grid">
            <div class="expertise-item">
                <i class="fas fa-crosshairs"></i>
                <span>Aim Mechanics</span>
            </div>
            <div class="expertise-item">
                <i class="fas fa-eye"></i>
                <span>Reticle Visibility</span>
            </div>
            <div class="expertise-item">
                <i class="fas fa-chart-line"></i>
                <span>Pro Aiming Patterns</span>
            </div>
            <div class="expertise-item">
                <i class="fas fa-adjust"></i>
                <span>Color Contrast</span>
            </div>
            <div class="expertise-item">
                <i class="fas fa-bullseye"></i>
                <span>Spray Control</span>
            </div>
            <div class="expertise-item">
                <i class="fas fa-dot-circle"></i>
                <span>Dot-Tracking</span>
            </div>
            <div class="expertise-item">
                <i class="fas fa-layer-group"></i>
                <span>Hybrid Design</span>
            </div>
            <div class="expertise-item">
                <i class="fas fa-gamepad"></i>
                <span>Competitive Strategy</span>
            </div>
        </div>
    </div>
</section>

<!-- Who We Serve -->
<section class="content-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Who We <span class="text-gradient">Serve</span></h2>
        </div>

        <div class="mission-grid">
            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3>New Players</h3>
                <p>We simplify complex settings and guide you to reliable presets for learning the game.</p>
            </div>

            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Ranked Grinders</h3>
                <p>We highlight crosshairs built for stability, visibility, and consistent aim improvement.</p>
            </div>

            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Competitive Teams</h3>
                <p>We offer crosshairs optimized for discipline, recoil control, and team coordination.</p>
            </div>

            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <h3>Esports Fans</h3>
                <p>We track the latest changes from tournaments and keep you updated on pro setups.</p>
            </div>

            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-video"></i>
                </div>
                <h3>Content Creators</h3>
                <p>We provide unique and fun designs for content creation and streaming.</p>
            </div>

            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-dumbbell"></i>
                </div>
                <h3>Aim Trainers</h3>
                <p>We offer crosshairs designed specifically for warm-ups and aim training routines.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="content-section">
    <div class="container">
        <div class="cta-section">
            <h3>Join Thousands of Players Improving Their Aim</h3>
            <p>
                Explore our database of verified crosshairs, submit your own designs, or connect with our community.
            </p>
            <div class="hero-cta">
                <a href="{{ route('crosshairs.index') }}" class="btn btn-primary">
                    <i class="fas fa-th"></i> Browse Crosshairs
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline">
                    <i class="fas fa-envelope"></i> Contact Us
                </a>
            </div>
        </div>
    </div>
</section>

@endsection