@extends('layouts.app')

@section('title', 'Valorant Crosshairs: Copy Crosshair Codes in Seconds | Velocrosshairs')
@section('description', 'Pick any crosshair Valorant players love, copy its code, and paste it into the game. Browse the best Valorant crosshairs, pro styles, and one-click import codes.')

@push('structured_data')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'HowTo',
    'name' => 'How to copy crosshair in Valorant',
    'description' => 'Copy a Valorant crosshair code from Velocrosshairs and import it into the game in about a minute.',
    'step' => [
        ['@type' => 'HowToStep', 'position' => 1, 'name' => 'Copy the Code', 'text' => 'Open any crosshair in our list and press the Copy Code button.'],
        ['@type' => 'HowToStep', 'position' => 2, 'name' => 'Open Settings', 'text' => 'Launch Valorant, open Settings, and go to the Crosshair tab.'],
        ['@type' => 'HowToStep', 'position' => 3, 'name' => 'Import the Code', 'text' => 'Click Import Profile Code and paste your copied code into the box.'],
        ['@type' => 'HowToStep', 'position' => 4, 'name' => 'Test and Play', 'text' => 'Check the crosshair in the Range, tweak if needed, then jump into a match.'],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => [
        ['@type' => 'Question', 'name' => 'What is the best crosshair in Valorant?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'There is no single best crosshair. The best one is clear on every map and fits your aim style—start with a small dot or simple cross and adjust.']],
        ['@type' => 'Question', 'name' => 'What are funny Valorant crosshairs?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Funny Valorant crosshairs include hearts, flowers, glasses, and other shapes for casual matches—not built for serious ranked play.']],
        ['@type' => 'Question', 'name' => 'Does crosshair size matter?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes. A small crosshair covers less of your target for precise shots; a big crosshair is easier to spot in a fight. Try medium first.']],
        ['@type' => 'Question', 'name' => 'Can I use a custom crosshair?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes. Build your own in Settings, then copy its code and share it.']],
        ['@type' => 'Question', 'name' => 'Is a dot crosshair better than lines?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'A dot gives one clean point for headshots; lines help judge distance and spray. Try both and keep what you hit with most.']],
        ['@type' => 'Question', 'name' => 'Why is my crosshair not showing properly?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Check the active profile, center dot, line length, outline, and screen resolution if lines look thin or stretched.']],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

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

    <!-- Intro -->
    <section class="content-section" style="padding: 4rem 0 2rem;">
        <div class="container">
            <div class="section-header fade-in">
                <h1 class="section-title" style="font-size: clamp(1.75rem, 4vw, 2.75rem);">
                    Valorant Crosshairs: Copy <span class="text-gradient">Valorant Crosshair Codes</span> in Seconds
                </h1>
                <p class="section-subtitle" style="max-width: 720px;">
                    Pick any crosshair Valorant players love, copy its code, and paste it into the game. Looking for a val crosshair that fits your aim? Browse every crosshair and test it in the Range.
                </p>
            </div>
        </div>
    </section>

    <!-- Popular Crosshairs Showcase -->
    <section class="showcase">
        <div class="container">
            <div class="section-header fade-in">
                <h2 class="section-title">Popular <span class="text-gradient">Crosshairs</span></h2>
                <p class="section-subtitle">
                    Popular val crosshair codes players copy every day—preview, copy, and try them in the Range.
                </p>
            </div>

            @if($popularCrosshairs && $popularCrosshairs->count() > 0)
                <div class="showcase-grid">
                    @foreach($popularCrosshairs as $crosshair)
                        <a href="{{ route('crosshairs.show', $crosshair->slug) }}" class="crosshair-card fade-in">
                            <div class="crosshair-preview-container">
                                @if($crosshair->image)
                                    <img
                                        src="{{ asset('storage/' . $crosshair->image) }}"
                                        alt="{{ $crosshair->name }}"
                                        class="crosshair-preview-img"
                                        @if($loop->first) fetchpriority="high" @else loading="lazy" @endif
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
                <h2 class="section-title">Best Valorant Crosshairs: <span class="text-gradient">Styles That Work</span></h2>
                <p class="section-subtitle">
                    The best crosshair Valorant has to offer is the one you can read in every fight. Pick your best val crosshair by clarity, aim style, and comfort. These six styles are good crosshairs for Valorant to start with.
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-dot-circle"></i>
                    </div>
                    <h3 class="feature-title">Minimal Beginner Crosshair</h3>
                    <p class="feature-description">A small, clean crosshair keeps the screen clear so you can focus on headshots. It is the easiest style for a new player to learn.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-circle"></i>
                    </div>
                    <h3 class="feature-title">Dot Crosshair Valorant</h3>
                    <p class="feature-description">A Valorant dot crosshair gives you one exact point to aim at, which suits one-tap headshots. Go small for precision or big to track targets.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-circle-notch"></i>
                    </div>
                    <h3 class="feature-title">Circle Crosshair Valorant</h3>
                    <p class="feature-description">A circle crosshair gives you a ring to aim inside, which many players like for spray control. Diamond and square shapes offer a similar look.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <h3 class="feature-title">Classic Four-Line Crosshair</h3>
                    <p class="feature-description">The classic cross uses four short lines with a gap in the middle. It stays easy to see up close and at long range.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3 class="feature-title">Static Crosshair for Valorant</h3>
                    <p class="feature-description">A static crosshair keeps the same size when you move or fire. Unlike a Valorant crosshair that changes when you move, it builds steady muscle memory.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <h3 class="feature-title">Pro Crosshairs</h3>
                    <p class="feature-description">Want a setup built from a pro or top-ranked player’s settings? Copy one of these and tweak it until it feels right.</p>
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
                    <h2 class="section-title">How to Copy Crosshair <span class="text-gradient">in Valorant</span></h2>
                    <p class="section-subtitle">
                        It takes about a minute to get a crosshair into your game. Copy one of our val crosshair codes, then use our step-by-step guide if you get stuck.
                    </p>
                </div>

                <div class="import-steps">
                    <div class="import-step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h3>Copy the Code</h3>
                            <p>Open any crosshair in our list and press the Copy Code button. It is a quick copy and paste, so the whole code lands on your clipboard in one click.</p>
                        </div>
                    </div>

                    <div class="import-step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h3>Open Settings</h3>
                            <p>To change your crosshair in Valorant, launch the game and open Settings. Then go to the Crosshair tab, where all your reticle options live.</p>
                        </div>
                    </div>

                    <div class="import-step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h3>Import the Code</h3>
                            <p>Click Import Profile Code and paste your copied code into the box. Confirm it, and the new crosshair loads right away.</p>
                        </div>
                    </div>

                    <div class="import-step">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h3>Test and Play</h3>
                            <p>Your crosshair is ready once the import finishes. Check it in the Range, tweak the size if you like, then jump into a match.</p>
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
                <h2 class="section-title">Valorant Crosshair <span class="text-gradient">FAQs</span></h2>
                <p class="section-subtitle">
                    Quick answers to what players ask most, from crosshair codes Valorant players copy to fixing a crosshair that looks wrong.
                </p>
            </div>

            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="fas fa-question-circle"></i>
                        <h3>What Is the Best Crosshair in Valorant?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>There is no single best crosshair in Valorant. The best one is the one you can see clearly on every map and that fits your aim style. Start with a small dot or a simple cross and adjust from there.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <i class="fas fa-question-circle"></i>
                        <h3>What Are Funny Valorant Crosshairs?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>Funny Valorant crosshairs are hearts, flowers, glasses, and other odd shapes. Players use these troll crosshairs in casual matches for laughs, since they are not built for serious ranked play. Browse the Fun category on our <a href="{{ route('crosshairs.index') }}">crosshair list</a> to find cute and troll picks.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <i class="fas fa-question-circle"></i>
                        <h3>Does Crosshair Size Matter?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, it can. A small crosshair covers less of your target, which helps with precise shots. A big crosshair in Valorant is easier to spot in a fight, so try a medium size first and adjust the line length from there.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <i class="fas fa-question-circle"></i>
                        <h3>Can I Use a Custom Crosshair?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>Yes. Valorant lets you build your own custom crosshair in Settings, from the center dot to the line length and color. Once you like it, you can copy its code and share it.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <i class="fas fa-question-circle"></i>
                        <h3>Is a Dot Crosshair Better Than Lines?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>A dot gives you one clean point and keeps the screen clear, which suits headshot-focused aim. Lines help you judge distance and spray. Try both and keep the one you hit with most.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <i class="fas fa-question-circle"></i>
                        <h3>Why Is My Crosshair Not Showing Properly?</h3>
                    </div>
                    <div class="faq-answer">
                        <p>First, check that you picked the right profile in your Crosshair settings. Then look at the center dot, line length, and outline, since thin lines can be hard to see on bright maps. If it looks stretched or blurry, check your screen resolution setting too.</p>
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
                    <h2 class="section-title">Our Valorant Crosshair <span class="text-gradient">Database</span></h2>
                    <p class="section-subtitle">
                        Every one of our Valorant crosshairs comes with a code, a preview, and a category, so the Valorant crosshair data you need is easy to find. Browse, copy, and play.
                    </p>
                </div>

                <div class="why-us-grid">
                    <div class="why-us-item">
                        <i class="fas fa-database"></i>
                        <h3>Big Library</h3>
                        <p>Browse crosshairs for every style, from tiny dots to circles and fun shapes. It all sits in one place, so you do not have to hunt around.</p>
                    </div>

                    <div class="why-us-item">
                        <i class="fas fa-copy"></i>
                        <h3>One-Click Copy</h3>
                        <p>Every crosshair has a Copy Code button. Press it, paste the code into Valorant, and you are ready to go.</p>
                    </div>

                    <div class="why-us-item">
                        <i class="fas fa-file-import"></i>
                        <h3>Ready-to-Import Codes</h3>
                        <p>Each code is ready to paste into the game’s import box. Pick one from the complete list of codes and try it.</p>
                    </div>

                    <div class="why-us-item">
                        <i class="fas fa-eye"></i>
                        <h3>Clean Previews</h3>
                        <p>Spot the coolest Valorant crosshairs at a glance. Each one has a preview, so you can judge its size and shape before you copy the code.</p>
                    </div>

                    <div class="why-us-item">
                        <i class="fas fa-filter"></i>
                        <h3>Browse by Category</h3>
                        <p>Crosshairs are sorted into Teams, Other, and Fun. Open Fun for cute and troll crosshairs, or Other for the rest of the list.</p>
                    </div>

                    <div class="why-us-item">
                        <i class="fab fa-discord"></i>
                        <h3>Discord Community</h3>
                        <p>Join our <a href="https://discord.gg/wHZQyb5PZ" target="_blank" rel="noopener noreferrer">Discord</a> to talk crosshairs with other players. Share what works for you and see what others are using.</p>
                    </div>
                </div>

                <div class="why-us-cta">
                    <a href="{{ route('crosshairs.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-th"></i> Browse All Crosshairs
                    </a>
                    <a href="https://discord.gg/wHZQyb5PZ" class="btn btn-outline btn-lg" target="_blank" rel="noopener noreferrer" style="margin-left: 0.75rem;">
                        <i class="fab fa-discord"></i> Join Discord
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