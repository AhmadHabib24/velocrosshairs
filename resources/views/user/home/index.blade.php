@extends('layouts.app')

@section('title', 'Valorant Crosshairs: Pro Codes, Best Settings & Crosshair Guide')
@section('description', 'Find the best Valorant crosshairs, pro player codes, popular styles, and clean presets. Explore top crosshairs for aim, visibility, ranked play, and beginners.')

@push('styles')
<style>
    /* Hero Section */
    .hero {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .hero-background {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(ellipse at center, rgba(255, 45, 95, 0.1) 0%, transparent 70%),
            linear-gradient(135deg, var(--dark-bg) 0%, #0F1419 50%, var(--dark-bg) 100%);
        z-index: -2;
    }

    .hero-pattern {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image:
            radial-gradient(circle at 25% 25%, rgba(255, 45, 95, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 75% 75%, rgba(255, 107, 122, 0.1) 0%, transparent 50%);
        z-index: -1;
    }

    .hero-content {
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
        z-index: 1;
    }

    .hero-title {
        font-family: 'Orbitron', monospace;
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 900;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: clamp(1rem, 2vw, 1.25rem);
        color: var(--text-secondary);
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .hero-stats {
        display: flex;
        justify-content: center;
        gap: 3rem;
        margin: 3rem 0;
        flex-wrap: wrap;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-family: 'Orbitron', monospace;
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-pink);
        display: block;
    }

    .stat-label {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }

    .hero-cta {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* Features Section */
    .features {
        padding: 6rem 0;
        background: linear-gradient(180deg, var(--dark-bg) 0%, var(--dark-card) 100%);
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 4rem;
    }

    .feature-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 1rem;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .feature-card:hover::before { transform: scaleX(1); }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(255, 45, 95, 0.1);
    }

    .feature-icon {
        width: 80px; height: 80px;
        margin: 0 auto 1.5rem;
        background: var(--primary-gradient);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem; color: white;
    }

    .feature-title {
        font-family: 'Orbitron', monospace;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--text-primary);
    }

    .feature-description {
        color: var(--text-secondary);
        line-height: 1.6;
    }

    /* Crosshairs Showcase */
    .showcase {
        padding: 6rem 0;
        background: linear-gradient(180deg, #0a0a0a 0%, #121212 100%);
    }

    .section-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .section-title {
        font-family: 'Orbitron', monospace;
        font-size: 3rem;
        color: var(--text-primary);
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .text-gradient {
        background: linear-gradient(135deg, #ff2d5f 0%, #ff6b7a 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .section-subtitle {
        font-size: 1.2rem;
        color: var(--text-secondary);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .showcase-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 1rem;
        margin-bottom: 4rem;
    }

    .crosshair-card {
        width: 100%;
        background: linear-gradient(145deg, #1a1a1a 0%, #0f0f0f 100%);
        border: 1px solid rgba(255, 45, 95, 0.15);
        border-radius: 1.25rem;
        overflow: hidden;
        transition: all 0.35s ease;
        position: relative;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
    }

    .crosshair-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255, 45, 95, 0.15) 0%, rgba(255, 107, 122, 0.08) 100%);
        opacity: 0;
        transition: opacity 0.35s ease;
        z-index: 0;
    }

    .crosshair-card:hover::before { opacity: 1; }

    .crosshair-card:hover {
        transform: translateY(-8px) scale(1.02);
        border-color: rgba(255, 45, 95, 0.6);
        box-shadow: 0 20px 45px rgba(255, 45, 95, 0.25);
    }

    .crosshair-preview-container {
        position: relative;
        width: 100%;
        aspect-ratio: 1 / 1;
        background: radial-gradient(circle at center, rgba(255, 45, 95, 0.05) 0%, transparent 70%),
                    linear-gradient(180deg, #0a0a0a 0%, #050505 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.75rem;
        overflow: hidden;
        z-index: 1;
    }

    .crosshair-preview-img {
        max-width: 90px;
        max-height: 90px;
        object-fit: contain;
        transition: all 0.4s ease;
        filter: drop-shadow(0 0 20px rgba(255, 45, 95, 0.4));
    }

    .crosshair-card:hover .crosshair-preview-img {
        transform: scale(1.15) rotate(4deg);
        filter: drop-shadow(0 0 32px rgba(255, 45, 95, 0.8));
    }

    .crosshair-svg-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
        filter: drop-shadow(0 0 18px rgba(255, 45, 95, 0.5));
    }

    .crosshair-svg-wrapper svg {
        width: 90px !important;
        height: 90px !important;
    }

    .crosshair-card:hover .crosshair-svg-wrapper {
        transform: scale(1.15) rotate(4deg);
        filter: drop-shadow(0 0 28px rgba(255, 45, 95, 0.9));
    }

    .crosshair-placeholder {
        font-size: 3.5rem;
        color: var(--primary-pink);
        opacity: 0.4;
        transition: all 0.3s ease;
    }

    .crosshair-card:hover .crosshair-placeholder {
        transform: scale(1.15) rotate(4deg);
        opacity: 0.7;
    }

    .crosshair-info {
        padding: 1rem 1.1rem;
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
        flex: 1;
        position: relative;
        z-index: 1;
        background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.4) 100%);
    }

    .crosshair-name {
        font-family: 'Orbitron', monospace;
        font-size: 0.95rem;
        color: #ffffff;
        margin: 0;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        letter-spacing: 0.5px;
        text-shadow: 0 2px 8px rgba(255, 45, 95, 0.3);
    }

    .crosshair-meta {
        display: flex; align-items: center; gap: 0.5rem;
        min-height: 18px;
    }

    .crosshair-author {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.78rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-weight: 500;
    }

    .crosshair-author i {
        color: #ff6b7a;
        font-size: 0.8rem;
    }

    .crosshair-stats {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding-top: 0.6rem;
        border-top: 1px solid rgba(255, 45, 95, 0.15);
    }

    .crosshair-stats .stat-item {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        color: rgba(255, 255, 255, 0.65);
        font-size: 0.8rem;
        font-weight: 600;
    }

    .crosshair-stats .stat-item i {
        color: #ff6b7a;
        font-size: 0.85rem;
    }

    .category-badge {
        display: inline-block;
        background: linear-gradient(135deg, rgba(255, 45, 95, 0.2) 0%, rgba(255, 107, 122, 0.15) 100%);
        border: 1px solid rgba(255, 45, 95, 0.4);
        color: #ff2d5f;
        padding: 0.3rem 0.6rem;
        border-radius: 0.5rem;
        font-size: 0.62rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        margin-top: 0.25rem;
        align-self: flex-start;
        box-shadow: 0 2px 8px rgba(255, 45, 95, 0.2);
    }

    .crosshair-hover-overlay { display: none; }

    .section-footer {
        text-align: center;
        margin-top: 2.5rem;
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

    .btn-lg {
        padding: 1.25rem 2.5rem;
        font-size: 1.1rem;
    }

    .no-crosshairs {
        text-align: center;
        padding: 6rem 2rem;
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 1.5rem;
    }

    .no-crosshairs-icon { margin-bottom: 2rem; }

    .no-crosshairs-icon i {
        font-size: 5rem;
        color: var(--primary-pink);
        opacity: 0.3;
    }

    .no-crosshairs h3 {
        font-family: 'Orbitron', monospace;
        color: var(--text-primary);
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .no-crosshairs p {
        color: var(--text-secondary);
        font-size: 1.1rem;
        margin-bottom: 2rem;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Content Section */
    .content-section {
        padding: 5rem 0;
        background: linear-gradient(180deg, var(--dark-card) 0%, var(--dark-bg) 100%);
    }

    /* Colors Section */
    .colors-section {
        padding: 5rem 0;
        background: linear-gradient(180deg, var(--dark-bg) 0%, #0a0a0a 100%);
    }

    .colors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .color-card {
        text-align: center;
        padding: 2rem;
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 1rem;
        transition: all 0.3s ease;
    }

    .color-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(255, 45, 95, 0.2);
    }

    .color-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
    }

    .color-card h4 {
        font-family: 'Orbitron', monospace;
        font-size: 1.2rem;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
        font-weight: 700;
    }

    .color-card p {
        color: var(--text-secondary);
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* Import Section */
    .import-section {
        padding: 5rem 0;
        background: linear-gradient(180deg, #0a0a0a 0%, var(--dark-card) 100%);
    }

    .import-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .import-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .import-steps {
        display: grid;
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .import-step {
        display: flex;
        gap: 2rem;
        align-items: flex-start;
    }

    .step-number {
        width: 60px;
        height: 60px;
        min-width: 60px;
        background: var(--primary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Orbitron', monospace;
        font-size: 1.5rem;
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
    }

    .step-content h4 {
        font-family: 'Orbitron', monospace;
        font-size: 1.2rem;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
        font-weight: 700;
    }

    .step-content p {
        color: var(--text-secondary);
        line-height: 1.6;
        margin: 0;
    }

    .import-cta {
        text-align: center;
    }

    /* FAQ Section */
    .faq-section {
        padding: 5rem 0;
        background: linear-gradient(180deg, var(--dark-card) 0%, var(--dark-bg) 100%);
    }

    .faq-container {
        max-width: 900px;
        margin: 3rem auto 0;
    }

    .faq-item {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 1rem;
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .faq-item:hover {
        border-color: rgba(255, 45, 95, 0.4);
    }

    .faq-question {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .faq-question:hover {
        background: rgba(255, 45, 95, 0.05);
    }

    .faq-question i {
        color: var(--primary-pink);
        font-size: 1.5rem;
    }

    .faq-question h4 {
        font-family: 'Orbitron', monospace;
        font-size: 1.1rem;
        color: var(--text-primary);
        margin: 0;
        font-weight: 600;
    }

    .faq-answer {
        padding: 0 1.5rem 0 4rem;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .faq-item.active .faq-answer {
        max-height: 500px;
        padding: 0 1.5rem 1.5rem 4rem;
    }

    .faq-answer p {
        color: var(--text-secondary);
        line-height: 1.8;
        margin: 0;
    }

    /* Why Us Section */
    .why-us-section {
        padding: 5rem 0;
        background: linear-gradient(180deg, var(--dark-bg) 0%, #0a0a0a 100%);
    }

    .why-us-content {
        max-width: 1200px;
        margin: 0 auto;
    }

    .why-us-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .why-us-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .why-us-item {
        text-align: center;
        padding: 2rem;
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 1rem;
        transition: all 0.3s ease;
    }

    .why-us-item:hover {
        transform: translateY(-8px);
        border-color: rgba(255, 45, 95, 0.4);
        box-shadow: 0 15px 40px rgba(255, 45, 95, 0.2);
    }

    .why-us-item i {
        font-size: 3rem;
        color: var(--primary-pink);
        margin-bottom: 1.5rem;
    }

    .why-us-item h4 {
        font-family: 'Orbitron', monospace;
        font-size: 1.2rem;
        color: var(--text-primary);
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .why-us-item p {
        color: var(--text-secondary);
        line-height: 1.6;
    }

    .why-us-cta {
        text-align: center;
    }

    .fade-in {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .crosshair-card:nth-child(1) { animation-delay: 0.1s; }
    .crosshair-card:nth-child(2) { animation-delay: 0.2s; }
    .crosshair-card:nth-child(3) { animation-delay: 0.3s; }
    .crosshair-card:nth-child(4) { animation-delay: 0.4s; }
    .crosshair-card:nth-child(5) { animation-delay: 0.5s; }
    .crosshair-card:nth-child(6) { animation-delay: 0.6s; }

    /* Responsive */
    @media (max-width: 1400px) {
        .showcase-grid { grid-template-columns: repeat(5, 1fr); }
    }
    @media (max-width: 1200px) {
        .showcase-grid { grid-template-columns: repeat(4, 1fr); }
    }
    @media (max-width: 900px) {
        .showcase-grid { grid-template-columns: repeat(3, 1fr); gap: 1rem; }
    }
    @media (max-width: 600px) {
        .showcase-grid { grid-template-columns: repeat(2, 1fr); gap: 0.9rem; }
    }
    @media (max-width: 480px) {
        .showcase-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
        .hero-stats { gap: 2rem; }
        .hero-cta { flex-direction: column; align-items: center; }
        .features-grid { grid-template-columns: 1fr; }
        .section-title { font-size: 2rem; }
        .section-subtitle { font-size: 1rem; }
        .crosshair-info { padding: 0.9rem; }
        .colors-grid { grid-template-columns: 1fr; }
        .why-us-grid { grid-template-columns: 1fr; }
        .import-step {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')

    <!-- SEO H1 Tag -->
    <h1 style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); border: 0;">Valorant Crosshairs: Pro Codes, Best Settings & Crosshair Guide</h1>

    <!-- Popular Crosshairs Showcase -->
    <section class="showcase">
        <div class="container">
            <div class="section-header fade-in">
                <h2 class="section-title">Popular <span class="text-gradient">Crosshairs</span></h2>
                <p class="section-subtitle">
                    Discover the most downloaded crosshairs from our community of professional gamers.
                </p>
            </div>

            @if($popularCrosshairs && $popularCrosshairs->count() > 0)
                <div class="showcase-grid">
                    @foreach($popularCrosshairs as $crosshair)
                        <a href="{{ route('crosshairs.show', $crosshair->slug) }}" class="crosshair-card fade-in">
                            <div class="crosshair-preview-container">
                                @if($crosshair->image)
                                    <img
                                        src="{{ url('storage/app/public/' . $crosshair->image) }}"
                                        alt="{{ $crosshair->name }}"
                                        class="crosshair-preview-img"
                                        loading="lazy"
                                        width="90"
                                        height="90"
                                    >
                                @elseif($crosshair->crosshair_code)
                                    <div class="crosshair-svg-wrapper">
                                        {!! \App\Helpers\CrosshairCodeParser::generateSVG($crosshair->crosshair_code, 80) !!}
                                    </div>
                                @else
                                    <div class="crosshair-placeholder">
                                        <i class="fas fa-crosshairs"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="crosshair-info">
                                <h3 class="crosshair-name">{{ $crosshair->name }}</h3>

                                <div class="crosshair-meta">
                                    @if($crosshair->author)
                                        <span class="crosshair-author">
                                            <!--<i class="fas fa-user"></i> {{ $crosshair->author }}-->
                                        </span>
                                    @endif
                                </div>

                                <div class="crosshair-stats">
                                    <span class="stat-item">
                                        <!--<i class="fas fa-eye"></i>-->
                                        <!--{{ number_format($crosshair->views) }}-->
                                    </span>
                                    <span class="stat-item">
                                        <!--<i class="fas fa-copy"></i>-->
                                        <!--{{ number_format($crosshair->copies) }}-->
                                    </span>
                                </div>

                                @if($crosshair->category)
                                    <span class="category-badge">{{ $crosshair->category->name }}</span>
                                @endif
                            </div>

                            <div class="crosshair-hover-overlay">
                                <i class="fas fa-eye"></i>
                                <span>View Details</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="section-footer">
                    <a href="{{ route('crosshairs.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-th"></i> View All Crosshairs
                    </a>
                </div>
            @else
                <div class="no-crosshairs">
                    <div class="no-crosshairs-icon">
                        <i class="fas fa-crosshairs"></i>
                    </div>
                    <h3>No Crosshairs Available Yet</h3>
                    <p>Be the first to create and share your crosshair with the community!</p>
                    <a href="{{ route('crosshairs.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus"></i> Create Crosshair
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- What Makes a Good Crosshair -->
    <section class="content-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">What Makes a Good <span class="text-gradient">Valorant Crosshair?</span></h2>
                <p class="section-subtitle">
                    A good crosshair gives you clarity, stability, and confidence in every fight. Players choose different styles based on visibility, aim preference, and comfort.
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-dot-circle"></i>
                    </div>
                    <h3 class="feature-title">Minimal Crosshairs</h3>
                    <p class="feature-description">Clean, distraction-free designs that help you focus on headshots and precision aiming.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-circle"></i>
                    </div>
                    <h3 class="feature-title">Dot-Only Crosshairs</h3>
                    <p class="feature-description">Perfect for pixel-perfect accuracy and one-tap headshot consistency.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-circle-notch"></i>
                    </div>
                    <h3 class="feature-title">Circle Crosshairs</h3>
                    <p class="feature-description">Excellent for spray control and understanding bullet spread patterns.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <h3 class="feature-title">Classic Four-Line</h3>
                    <p class="feature-description">Traditional style with balanced visibility for all ranges and situations.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3 class="feature-title">Static Crosshairs</h3>
                    <p class="feature-description">No movement or firing error for consistent muscle memory and competitive play.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3 class="feature-title">Pro Crosshairs</h3>
                    <p class="feature-description">Exact settings from professional players and top-tier ranked competitors.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Crosshair Colors Section -->
    <section class="colors-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Crosshair <span class="text-gradient">Colors</span> That Matter</h2>
                <p class="section-subtitle">
                    Color choice is one of the biggest crosshair advantages. Choose the right color for maximum visibility and performance.
                </p>
            </div>

            <div class="colors-grid">
                <div class="color-card">
                    <div class="color-icon" style="background: linear-gradient(135deg, #00ffff 0%, #00cccc 100%);">
                        <i class="fas fa-crosshairs"></i>
                    </div>
                    <h3>Cyan</h3>
                    <p>High contrast on most maps, preferred by many pro players for visibility.</p>
                </div>

                <div class="color-card">
                    <div class="color-icon" style="background: linear-gradient(135deg, #00ff00 0%, #00cc00 100%);">
                        <i class="fas fa-crosshairs"></i>
                    </div>
                    <h3>Green</h3>
                    <p>Clean visibility with excellent contrast against dark and light backgrounds.</p>
                </div>

                <div class="color-card">
                    <div class="color-icon" style="background: linear-gradient(135deg, #ffff00 0%, #cccc00 100%);">
                        <i class="fas fa-crosshairs"></i>
                    </div>
                    <h3>Yellow</h3>
                    <p>Great against dark backgrounds, highly visible in shadowed areas.</p>
                </div>

                <div class="color-card">
                    <div class="color-icon" style="background: linear-gradient(135deg, #ff1493 0%, #cc1177 100%);">
                        <i class="fas fa-crosshairs"></i>
                    </div>
                    <h3>Pink</h3>
                    <p>Strong on bright maps, stands out in most lighting conditions.</p>
                </div>

                <div class="color-card">
                    <div class="color-icon" style="background: linear-gradient(135deg, #ffffff 0%, #cccccc 100%);">
                        <i class="fas fa-crosshairs"></i>
                    </div>
                    <h3>White</h3>
                    <p>Simple and universal, works well for players who prefer classic styling.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How to Import Section -->
    <section class="import-section">
        <div class="container">
            <div class="import-container">
                <div class="import-header">
                    <h2 class="section-title">How to Import <span class="text-gradient">Crosshair Codes</span></h2>
                    <p class="section-subtitle">
                        Importing a crosshair takes just seconds. Follow these simple steps to get started.
                    </p>
                </div>

                <div class="import-steps">
                    <div class="import-step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h3>Copy the Code</h3>
                            <p>Click the "Copy Code" button on any crosshair you like from our database.</p>
                        </div>
                    </div>

                    <div class="import-step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h3>Open Valorant Settings</h3>
                            <p>Launch Valorant and navigate to Settings → Crosshair settings menu.</p>
                        </div>
                    </div>

                    <div class="import-step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h3>Import Profile Code</h3>
                            <p>Click "Import Profile Code" and paste the copied code into the text box.</p>
                        </div>
                    </div>

                    <div class="import-step">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h3>Save and Play</h3>
                            <p>Your new crosshair appears instantly. Test it in the Range or jump into a match!</p>
                        </div>
                    </div>
                </div>

                <div class="import-cta">
                    <a href="{{ route('crosshairs.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-download"></i> Browse Crosshairs to Import
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Frequently Asked <span class="text-gradient">Questions</span></h2>
                <p class="section-subtitle">
                    Find answers to the most common questions about Valorant crosshairs.
                </p>
            </div>

            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="fas fa-question-circle"></i>
                        <h3>What is the best crosshair for Valorant?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>The best crosshair depends on visibility and comfort. Most players prefer minimal, static crosshairs with bright colors. Dot crosshairs and classic four-line crosshairs are the most popular among competitive players.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <i class="fas fa-question-circle"></i>
                        <h3>What crosshair do pro players use?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>Pro players use clean, minimal setups with short inner lines, no outer lines, and bright colors like cyan or green. You can find every Valorant pro crosshair in our database with ready-to-import codes.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <i class="fas fa-question-circle"></i>
                        <h3>How do I copy Valorant crosshair codes?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>Click the "Copy Code" button on any crosshair page, open Valorant, go to Settings → Crosshair, select "Import Profile Code," and paste the code into the text box.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <i class="fas fa-question-circle"></i>
                        <h3>What color crosshair is easiest to see?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>Cyan, green, and yellow are the highest-visibility colors for most maps. These colors provide excellent contrast against both dark and light backgrounds.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <i class="fas fa-question-circle"></i>
                        <h3>Should I use a dot or lines crosshair?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>Dots help with precision and headshot accuracy, while lines help with general tracking and spray control. Many competitive players use hybrid crosshairs that combine both elements.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <i class="fas fa-question-circle"></i>
                        <h3>Why is my crosshair not showing properly?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>You may have movement or firing error enabled, ADS override active, or a color that blends into the map. Try resetting your crosshair settings or adjusting the color for better visibility.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-us-section">
        <div class="container">
            <div class="why-us-content">
                <div class="why-us-header">
                    <h2 class="section-title">Why <span class="text-gradient">Velocrosshairs?</span></h2>
                    <p class="section-subtitle">
                        We're the most trusted source for Valorant crosshairs, codes, and pro settings.
                    </p>
                </div>

                <div class="why-us-grid">
                    <div class="why-us-item">
                        <i class="fas fa-database"></i>
                        <h3>Massive Crosshair Database</h3>
                        <p>Thousands of verified crosshairs from pros, streamers, and the community.</p>
                    </div>

                    <div class="why-us-item">
                        <i class="fas fa-sync-alt"></i>
                        <h3>Daily Updates</h3>
                        <p>Pro crosshairs and trending designs updated every day to keep you current.</p>
                    </div>

                    <div class="why-us-item">
                        <i class="fas fa-check-double"></i>
                        <h3>Verified Codes</h3>
                        <p>Every crosshair code is tested and verified to work perfectly in-game.</p>
                    </div>

                    <div class="why-us-item">
                        <i class="fas fa-eye"></i>
                        <h3>Clean Previews</h3>
                        <p>High-quality previews on multiple backgrounds for accurate visibility testing.</p>
                    </div>

                    <div class="why-us-item">
                        <i class="fas fa-filter"></i>
                        <h3>Advanced Filtering</h3>
                        <p>Sort by style, color, visibility, purpose, and pro player for easy searching.</p>
                    </div>

                    <div class="why-us-item">
                        <i class="fas fa-users"></i>
                        <h3>Community Driven</h3>
                        <p>Submit your own crosshairs and discover unique designs from other players.</p>
                    </div>
                </div>

                <div class="why-us-cta">
                    <a href="{{ route('crosshairs.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-rocket"></i> Start Exploring Now
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    // Fade in animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });

    // Crosshair preview click effect
    document.querySelectorAll('.crosshair-preview').forEach(preview => {
        preview.addEventListener('click', function () {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => { this.style.transform = ''; }, 150);
        });
    });

    // FAQ Accordion
    document.querySelectorAll('.faq-question').forEach(question => {
        question.addEventListener('click', function() {
            const faqItem = this.parentElement;
            const isActive = faqItem.classList.contains('active');
            
            // Close all FAQs
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Open clicked FAQ if it wasn't active
            if (!isActive) {
                faqItem.classList.add('active');
            }
        });
    });
</script>
@endpush