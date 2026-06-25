<footer class="footer">
    <div class="container">
        <div class="footer-content">
            
            <!-- Brand Section -->
            <div class="footer-section">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <!-- ✅ LOGO IMAGE ADDED -->
                        <img src="{{ asset('crosshairlogo.png') }}" alt="Velocrosshairs Logo" class="footer-logo-img">

                        <h3 class="font-gaming">Velocrosshairs</h3>
                    </div>

                    <p style="color: var(--text-secondary); margin-bottom: 1.5rem; line-height: 1.6;">
                        Professional gaming crosshairs and overlay technology for competitive gamers. 
                        Trusted by over 50,000 players worldwide.
                    </p>

                    <div class="social-links">
                        <a href="#" class="social-link" title="Discord"><i class="fab fa-discord"></i></a>
                        <a href="#" class="social-link" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link" title="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="social-link" title="Twitch"><i class="fab fa-twitch"></i></a>
                        <a href="#" class="social-link" title="Reddit"><i class="fab fa-reddit"></i></a>
                    </div>
                </div>
            </div>

            <!-- Product Links -->
            <div class="footer-section">
                <h4 class="footer-title">Product</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('crosshairs.index') }}">Browse Crosshairs</a></li>
                    <li><a href="{{ route('crosshairs.categories') }}">Categories</a></li>
                    <li><a href="#">System Requirements</a></li>
                </ul>
            </div>

            <!-- Support Links -->
            <div class="footer-section">
                <h4 class="footer-title">Support</h4>
                <ul class="footer-links">
                    {{-- ✅ REMOVED: Help Center --}}
                    {{-- ✅ REMOVED: Installation Guide --}}
                    {{-- ✅ REMOVED: Compatibility / Game Compatibility --}}

                    <li><a href="#">Troubleshooting</a></li>
                    <li><a href="#">Contact Support</a></li>
                    <li><a href="#">Report Bug</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="footer-section">
                <h4 class="footer-title">Stay Updated</h4>
                <p style="color: var(--text-secondary); margin-bottom: 1rem;">
                    Get notified about new crosshairs, features, and updates.
                </p>

                <form class="newsletter-form" onsubmit="subscribeNewsletter(event)">
                    <div class="newsletter-input">
                        <input type="email" placeholder="Enter your email" required>
                        <button type="submit" class="newsletter-btn">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>

                <div class="newsletter-stats">
                    <div class="stat">
                        <span class="stat-number">50K+</span>
                        <span class="stat-label">Active Users</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">1M+</span>
                        <span class="stat-label">Downloads</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <div class="footer-legal">
                    <p>&copy; {{ date('Y') }} Velocrosshairs. All rights reserved.</p>
                    <div class="legal-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Cookie Policy</a>
                        <a href="#">DMCA</a>
                    </div>
                </div>

                <div class="footer-info">
                    <span class="status-indicator">
                        <span class="status-dot online"></span>
                        All systems operational
                    </span>
                    <span class="version-info">Version 2.4.1</span>
                </div>
            </div>
        </div>

    </div>
</footer>


<style>
.footer {
    background: var(--dark-card);
    border-top: 1px solid var(--dark-border);
    padding: 4rem 0 1rem;
    margin-top: 4rem;
}

.footer-content {
    display: grid;
    grid-template-columns: 2fr repeat(4, 1fr);
    gap: 3rem;
    margin-bottom: 3rem;
}

.footer-brand .footer-logo {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.footer-title {
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    font-family: 'Orbitron', monospace;
    font-weight: 600;
    font-size: 1.1rem;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 0.75rem;
}

.footer-links a {
    color: var(--text-secondary);
    text-decoration: none;
    transition: color 0.3s ease;
    font-size: 0.9rem;
}

.footer-links a:hover {
    color: var(--primary-pink);
}

.social-links {
    display: flex;
    gap: 1rem;
}

.social-link {
    width: 40px;
    height: 40px;
    background: var(--dark-bg);
    border: 1px solid var(--dark-border);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-link:hover {
    background: var(--primary-pink);
    color: white;
    border-color: var(--primary-pink);
    transform: translateY(-2px);
}

.newsletter-form {
    margin-bottom: 2rem;
}

.newsletter-input {
    display: flex;
    background: var(--dark-bg);
    border: 1px solid var(--dark-border);
    border-radius: 0.5rem;
    overflow: hidden;
    transition: border-color 0.3s ease;
}

.newsletter-input:focus-within {
    border-color: var(--primary-pink);
}

.newsletter-input input {
    flex: 1;
    background: transparent;
    border: none;
    padding: 0.875rem 1rem;
    color: var(--text-primary);
    outline: none;
}

.newsletter-input input::placeholder {
    color: var(--text-muted);
}

.newsletter-btn {
    background: var(--primary-gradient);
    border: none;
    padding: 0 1rem;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
}

.newsletter-btn:hover {
    background: var(--primary-pink);
}

.newsletter-stats {
    display: flex;
    gap: 2rem;
}

.stat {
    text-align: center;
}

.stat-number {
    display: block;
    font-family: 'Orbitron', monospace;
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--primary-pink);
}

.stat-label {
    font-size: 0.8rem;
    color: var(--text-muted);
}

.footer-bottom {
    border-top: 1px solid var(--dark-border);
    padding-top: 2rem;
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.footer-legal {
    display: flex;
    align-items: center;
    gap: 2rem;
    flex-wrap: wrap;
}

.footer-legal p {
    color: var(--text-muted);
    margin: 0;
}

.legal-links {
    display: flex;
    gap: 1.5rem;
}

.legal-links a {
    color: var(--text-muted);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.legal-links a:hover {
    color: var(--primary-pink);
}

.footer-info {
    display: flex;
    align-items: center;
    gap: 2rem;
    color: var(--text-muted);
    font-size: 0.9rem;
}

.status-indicator {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    animation: pulse 2s infinite;
}

.status-dot.online {
    background: var(--success);
}
.footer-logo {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 1rem;
}

.footer-logo-img {
    width: 56px;
    height: 56px;
    object-fit: contain;
    display: block;
    filter: drop-shadow(0 0 10px rgba(255,45,95,0.25));
}


@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

/* Responsive */
@media (max-width: 1024px) {
    .footer-content {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .footer {
        padding: 3rem 0 1rem;
    }
    
    .footer-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .footer-bottom-content {
        flex-direction: column;
        text-align: center;
    }
    
    .footer-legal {
        flex-direction: column;
        gap: 1rem;
    }
    
    .newsletter-stats {
        justify-content: center;
    }
}

</style>

<script>
function subscribeNewsletter(event) {
    event.preventDefault();
    const email = event.target.querySelector('input[type="email"]').value;
    
    // Simulate subscription
    const button = event.target.querySelector('.newsletter-btn');
    const originalContent = button.innerHTML;
    
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    button.disabled = true;
    
    setTimeout(() => {
        button.innerHTML = '<i class="fas fa-check"></i>';
        setTimeout(() => {
            button.innerHTML = originalContent;
            button.disabled = false;
            event.target.reset();
        }, 2000);
    }, 1000);
}
</script>