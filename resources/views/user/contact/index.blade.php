@extends('layouts.app')

@section('title', 'Contact Us - Velocrosshairs | Get In Touch')
@section('description', 'Have questions about Valorant crosshairs? Contact Velocrosshairs for support, submissions, partnerships, or any inquiries.')

@push('styles')
<style>
    /* Hero Section */
    .contact-hero {
        position: relative;
        padding: 8rem 0 6rem;
        overflow: hidden;
        background: linear-gradient(135deg, var(--dark-bg) 0%, #0F1419 50%, var(--dark-bg) 100%);
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(ellipse at center, rgba(255, 45, 95, 0.15) 0%, transparent 70%);
        z-index: 0;
    }

    .contact-hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
        max-width: 900px;
        margin: 0 auto;
    }

    .contact-title {
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

    .contact-subtitle {
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

    /* Contact Methods Grid */
    .contact-methods {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 5rem;
    }

    .contact-method-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 1rem;
        padding: 2.5rem;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .contact-method-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: var(--primary-gradient);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .contact-method-card:hover::before {
        transform: scaleX(1);
    }

    .contact-method-card:hover {
        transform: translateY(-8px);
        border-color: rgba(255, 45, 95, 0.4);
        box-shadow: 0 20px 60px rgba(255, 45, 95, 0.15);
    }

    .contact-icon {
        width: 80px;
        height: 80px;
        background: var(--primary-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: white;
    }

    .contact-method-card h3 {
        font-family: 'Orbitron', monospace;
        font-size: 1.5rem;
        color: var(--text-primary);
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .contact-method-card p {
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .contact-email {
        display: inline-block;
        background: rgba(255, 45, 95, 0.1);
        border: 1px solid rgba(255, 45, 95, 0.3);
        color: var(--primary-pink);
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .contact-email:hover {
        background: var(--primary-gradient);
        color: white;
        transform: scale(1.05);
    }

    /* Form Section */
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 1.5rem;
        padding: 3rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .form-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .form-header h2 {
        font-family: 'Orbitron', monospace;
        font-size: 2.5rem;
        color: var(--text-primary);
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .form-header p {
        color: var(--text-secondary);
        font-size: 1.1rem;
    }

    .form-group {
        margin-bottom: 2rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
        font-size: 1rem;
    }

    .form-label .required {
        color: var(--primary-pink);
        margin-left: 0.25rem;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        background: var(--dark-bg);
        border: 1px solid var(--dark-border);
        border-radius: 0.75rem;
        padding: 1rem 1.25rem;
        color: var(--text-primary);
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--primary-pink);
        box-shadow: 0 0 0 3px rgba(255, 45, 95, 0.1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 150px;
        font-family: inherit;
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
        color: var(--text-muted);
    }

    .form-hint {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: var(--text-muted);
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 1.25rem 2.5rem;
        border-radius: 0.75rem;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        text-decoration: none;
        width: 100%;
    }

    .btn-primary {
        background: var(--primary-gradient);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(255, 45, 95, 0.4);
    }

    .btn-primary:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    /* Alert Messages */
    .alert {
        padding: 1.25rem 1.5rem;
        border-radius: 0.75rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        font-weight: 500;
    }

    .alert-success {
        background: rgba(34, 197, 94, 0.1);
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: #22c55e;
    }

    .alert-error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #ef4444;
    }

    .alert i {
        font-size: 1.5rem;
    }

    /* Response Time */
    .response-time {
        background: linear-gradient(145deg, #1a1a1a 0%, #0f0f0f 100%);
        border: 1px solid rgba(255, 45, 95, 0.2);
        border-radius: 1rem;
        padding: 2rem;
        margin-top: 3rem;
    }

    .response-time h3 {
        font-family: 'Orbitron', monospace;
        font-size: 1.5rem;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        font-weight: 700;
        text-align: center;
    }

    .response-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .response-item {
        text-align: center;
        padding: 1rem;
    }

    .response-item i {
        font-size: 2rem;
        color: var(--primary-pink);
        margin-bottom: 0.75rem;
    }

    .response-item strong {
        display: block;
        color: var(--text-primary);
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }

    .response-item span {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    /* Submission Guidelines */
    .guidelines-box {
        background: rgba(255, 45, 95, 0.05);
        border: 1px solid rgba(255, 45, 95, 0.2);
        border-radius: 1rem;
        padding: 1.5rem;
        margin-top: 1rem;
    }

    .guidelines-box h4 {
        font-family: 'Orbitron', monospace;
        color: var(--text-primary);
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .guidelines-box ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .guidelines-box li {
        color: var(--text-secondary);
        padding: 0.5rem 0;
        padding-left: 1.5rem;
        position: relative;
    }

    .guidelines-box li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: var(--primary-pink);
        font-weight: 700;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .contact-hero {
            padding: 5rem 0 3rem;
        }

        .contact-title {
            font-size: 2rem;
        }

        .contact-methods {
            grid-template-columns: 1fr;
        }

        .form-container {
            padding: 2rem 1.5rem;
        }

        .form-header h2 {
            font-size: 1.8rem;
        }

        .response-list {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="contact-hero">
    <div class="container">
        <div class="contact-hero-content">
            <h1 class="contact-title">Contact <span class="text-gradient">Us</span></h1>
            <p class="contact-subtitle">
                Have questions, feedback, or requests about Valorant crosshairs? We're here to help. 
                Velocrosshairs.com is built for the community, and we respond to every message with care and accuracy.
            </p>
        </div>
    </div>
</section>

<!-- Contact Methods -->
<section class="content-section">
    <div class="container">
        <div class="contact-methods">
            <div class="contact-method-card">
                <div class="contact-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <h3>General Inquiries</h3>
                <p>For any general questions about crosshairs, the site, or how to use our tools.</p>
                <a href="mailto:velocrosshairs@gmail.com" class="contact-email">
                    <i class="fas fa-envelope"></i> velocrosshairs@gmail.com
                </a>
            </div>

            <div class="contact-method-card">
                <div class="contact-icon">
                    <i class="fas fa-crosshairs"></i>
                </div>
                <h3>Crosshair Submissions</h3>
                <p>Found an outdated pro crosshair or want to submit your own custom design?</p>
                <a href="mailto:velocrosshairs@gmail.com" class="contact-email">
                    <i class="fas fa-envelope"></i> velocrosshairs@gmail.com
                </a>
            </div>

            <div class="contact-method-card">
                <div class="contact-icon">
                    <i class="fas fa-wrench"></i>
                </div>
                <h3>Technical Support</h3>
                <p>Having trouble importing a code? Preview not loading? Generator not updating?</p>
                <a href="mailto:velocrosshairs@gmail.com" class="contact-email">
                    <i class="fas fa-envelope"></i> velocrosshairs@gmail.com
                </a>
            </div>

            <div class="contact-method-card">
                <div class="contact-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <h3>Business & Partnerships</h3>
                <p>For collaborations, esports partnerships, integrations, or tool-related discussions.</p>
                <a href="mailto:velocrosshairs@gmail.com" class="contact-email">
                    <i class="fas fa-envelope"></i> velocrosshairs@gmail.com
                </a>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="form-container">
            <div class="form-header">
                <h2>Send Us a <span class="text-gradient">Message</span></h2>
                <p>Fill out the form below and we'll get back to you as soon as possible.</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>Please fix the errors below and try again.</span>
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="name">
                        Your Name <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-input @error('name') is-invalid @enderror" 
                        placeholder="Enter your full name"
                        value="{{ old('name') }}"
                        required
                    >
                    @error('name')
                        <span class="form-hint" style="color: #ef4444;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">
                        Email Address <span class="required">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input @error('email') is-invalid @enderror" 
                        placeholder="your.email@example.com"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <span class="form-hint" style="color: #ef4444;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="subject">
                        Subject <span class="required">*</span>
                    </label>
                    <select 
                        id="subject" 
                        name="subject" 
                        class="form-select @error('subject') is-invalid @enderror"
                        required
                    >
                        <option value="">Select a subject</option>
                        <option value="general" {{ old('subject') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                        <option value="crosshair_submission" {{ old('subject') == 'crosshair_submission' ? 'selected' : '' }}>Crosshair Submission</option>
                        <option value="crosshair_correction" {{ old('subject') == 'crosshair_correction' ? 'selected' : '' }}>Crosshair Correction</option>
                        <option value="technical_support" {{ old('subject') == 'technical_support' ? 'selected' : '' }}>Technical Support</option>
                        <option value="business_partnership" {{ old('subject') == 'business_partnership' ? 'selected' : '' }}>Business & Partnership</option>
                        <option value="feedback" {{ old('subject') == 'feedback' ? 'selected' : '' }}>Feedback/Suggestion</option>
                        <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('subject')
                        <span class="form-hint" style="color: #ef4444;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="crosshair_code">
                        Crosshair Code (Optional)
                    </label>
                    <input 
                        type="text" 
                        id="crosshair_code" 
                        name="crosshair_code" 
                        class="form-input @error('crosshair_code') is-invalid @enderror" 
                        placeholder="e.g., 0;P;c;5;h;0;f;0;0l;4;0o;2;0a;1;0f;0;1b;0"
                        value="{{ old('crosshair_code') }}"
                    >
                    <span class="form-hint">If you're submitting or reporting a crosshair, paste the code here.</span>
                    @error('crosshair_code')
                        <span class="form-hint" style="color: #ef4444;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="message">
                        Message <span class="required">*</span>
                    </label>
                    <textarea 
                        id="message" 
                        name="message" 
                        class="form-textarea @error('message') is-invalid @enderror" 
                        placeholder="Tell us more about your inquiry..."
                        required
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <span class="form-hint" style="color: #ef4444;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="captcha">
                        Anti-Spam Verification: What is {{ $num1 }} + {{ $num2 }}? <span class="required">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="captcha" 
                        name="captcha" 
                        class="form-input @error('captcha') is-invalid @enderror" 
                        placeholder="Enter the sum"
                        required
                    >
                    @error('captcha')
                        <span class="form-hint" style="color: #ef4444;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submission Guidelines -->
                <div class="guidelines-box">
                    <h4><i class="fas fa-info-circle"></i> For Crosshair Submissions, Please Include:</h4>
                    <ul>
                        <li>Crosshair code (paste in the field above)</li>
                        <li>Crosshair name or player name</li>
                        <li>Any notes about usage or visibility</li>
                        <li>Optional: Link to screenshot or preview</li>
                    </ul>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>

        <!-- Response Time -->
        <div class="response-time">
            <h3>Expected Response Time</h3>
            <div class="response-list">
                <div class="response-item">
                    <i class="fas fa-clock"></i>
                    <strong>24 Hours</strong>
                    <span>General Inquiries</span>
                </div>
                <div class="response-item">
                    <i class="fas fa-tools"></i>
                    <strong>12 Hours</strong>
                    <span>Technical Issues</span>
                </div>
                <div class="response-item">
                    <i class="fas fa-briefcase"></i>
                    <strong>48 Hours</strong>
                    <span>Business Inquiries</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Community First -->
<section class="content-section">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto; text-align: center;">
            <h2 class="section-title" style="font-family: 'Orbitron', monospace; font-size: 2.5rem; margin-bottom: 1.5rem;">
                Community <span class="text-gradient">First</span>
            </h2>
            <p style="font-size: 1.2rem; color: var(--text-secondary); line-height: 1.8; margin-bottom: 1.5rem;">
                Velocrosshairs.com exists because of the Valorant community. Your feedback shapes our database, 
                improves our guides, and helps us update pro settings faster.
            </p>
            <p style="font-size: 1.1rem; color: var(--text-secondary); line-height: 1.8;">
                If you ever have a suggestion for improving the site — big or small — we want to hear it.
            </p>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Auto-hide success message after 5 seconds
    setTimeout(function() {
        const successAlert = document.querySelector('.alert-success');
        if (successAlert) {
            successAlert.style.transition = 'opacity 0.5s ease';
            successAlert.style.opacity = '0';
            setTimeout(() => successAlert.remove(), 500);
        }
    }, 5000);
</script>
@endpush