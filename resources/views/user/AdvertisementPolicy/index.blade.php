@extends('layouts.app')

@section('title', 'Advertisement Policy - Velocrosshairs')
@section('description', 'Read our advertisement policy for Velocrosshairs.')

@push('styles')
<style>
    /* Hero Section */
    .ad-policy-hero {
        position: relative;
        padding: 6rem 0 4rem;
        overflow: hidden;
        background: linear-gradient(135deg, var(--dark-bg) 0%, #0F1419 50%, var(--dark-bg) 100%);
    }

    .ad-policy-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(ellipse at center, rgba(255, 45, 95, 0.1) 0%, transparent 70%);
        z-index: 0;
    }

    .ad-policy-hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
    }

    .ad-policy-title {
        font-family: 'Orbitron', monospace;
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 900;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .text-gradient {
        background: linear-gradient(135deg, #ff2d5f 0%, #ff6b7a 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .last-updated {
        display: inline-block;
        margin-top: 1rem;
        padding: 0.5rem 1rem;
        background: rgba(255, 45, 95, 0.1);
        border: 1px solid rgba(255, 45, 95, 0.3);
        border-radius: 0.5rem;
        color: var(--primary-pink);
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* Content Section */
    .ad-policy-content {
        padding: 4rem 0;
    }

    .content-wrapper {
        max-width: 900px;
        margin: 0 auto;
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 1.5rem;
        padding: 3rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    }

    /* Info Box */
    .info-box {
        background: rgba(255, 45, 95, 0.1);
        border: 1px solid rgba(255, 45, 95, 0.3);
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin: 1.5rem 0 3rem;
        display: flex;
        gap: 1rem;
    }

    .info-box i {
        color: var(--primary-pink);
        font-size: 1.5rem;
        margin-top: 0.25rem;
    }

    .info-box-content p {
        margin: 0;
        color: var(--text-secondary);
        line-height: 1.6;
    }

    /* Section Styling */
    .policy-section {
        margin-bottom: 3rem;
    }

    .policy-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        font-family: 'Orbitron', monospace;
        font-size: 1.8rem;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid rgba(255, 45, 95, 0.3);
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: var(--primary-pink);
        font-size: 1.5rem;
    }

    .policy-section p {
        color: var(--text-secondary);
        line-height: 1.8;
        margin-bottom: 1rem;
        font-size: 1rem;
    }

    .policy-section ul {
        color: var(--text-secondary);
        line-height: 1.8;
        margin: 1rem 0;
        padding-left: 2rem;
    }

    .policy-section ul li {
        margin-bottom: 0.75rem;
        position: relative;
    }

    .policy-section ul li::marker {
        color: var(--primary-pink);
    }

    /* Contact Section */
    .contact-section {
        background: linear-gradient(135deg, rgba(255, 45, 95, 0.1) 0%, transparent 100%);
        border: 1px solid rgba(255, 45, 95, 0.2);
        border-radius: 1rem;
        padding: 2rem;
        text-align: center;
        margin-top: 3rem;
    }

    .contact-section h3 {
        font-family: 'Orbitron', monospace;
        font-size: 1.5rem;
        color: var(--text-primary);
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .contact-section p {
        color: var(--text-secondary);
        margin-bottom: 1.5rem;
    }

    .contact-email {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2rem;
        background: var(--primary-gradient);
        color: white;
        text-decoration: none;
        border-radius: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .contact-email:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(255, 45, 95, 0.4);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .ad-policy-hero {
            padding: 4rem 0 2rem;
        }

        .ad-policy-title {
            font-size: 1.8rem;
        }

        .content-wrapper {
            padding: 2rem 1.5rem;
        }

        .section-title {
            font-size: 1.4rem;
        }
    }
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="ad-policy-hero">
    <div class="container">
        <div class="ad-policy-hero-content">
            <h1 class="ad-policy-title">Advertisement <span class="text-gradient">Policy</span></h1>
            <span class="last-updated">
                <i class="fas fa-calendar-alt"></i> Last Updated: Oct 4, 2026
            </span>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="ad-policy-content">
    <div class="container">
        <div class="content-wrapper">

            <!-- Introduction -->
            <div class="info-box">
                <i class="fas fa-info-circle"></i>
                <div class="info-box-content">
                    <p>
                        At Velocrosshairs, we believe in keeping our advertising practices clear and transparent. This Advertisement Policy explains how advertisements may appear on our website, how third-party advertising services may operate, and what visitors should know when interacting with advertisements.<br><br>
                        By using Velocrosshairs, you acknowledge and understand the advertising practices described in this policy.
                    </p>
                </div>
            </div>

            <!-- 1. Advertising on Velocrosshairs -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-ad"></i>
                    1. Advertising on Velocrosshairs
                </h2>
                <p>Velocrosshairs may display advertisements to help support the operation, maintenance, and development of our website, crosshair database, and guides.</p>
                <p>Advertising revenue may help us cover expenses related to hosting, website maintenance, development, security, adding new crosshairs, and keeping our content free for all Valorant players.</p>
                <p>Our goal is to display advertisements in a way that does not interfere with finding, copying, or importing crosshair codes.</p>
            </div>

            <!-- 2. Google AdSense -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fab fa-google"></i>
                    2. Google AdSense
                </h2>
                <p>Velocrosshairs may use Google AdSense to display advertisements.</p>
                <p>Third-party vendors, including Google, use cookies to serve ads based on a user's prior visits to this website or other websites on the internet.</p>
                <p>Google's use of advertising cookies enables it and its partners to serve ads to users based on their visits to Velocrosshairs and/or other sites on the internet.</p>
                <p>Advertisements may be displayed based on various factors, which can include the content of a webpage, general location, device information, or a user's previous interactions with websites and advertising services.</p>
            </div>

            <!-- 3. Personalized Advertising -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-user-tag"></i>
                    3. Personalized Advertising
                </h2>
                <p>Depending on the user's location, consent choices, and applicable privacy requirements, advertisements displayed on Velocrosshairs may be personalized or non-personalized.</p>
                <p>Personalized advertising may use information about a user's interests or browsing activity to help display more relevant advertisements.</p>
                <p>If you visit our website from the European Economic Area, the United Kingdom, or Switzerland, we may ask for your consent before personalized ads are shown. If you do not give consent, you may see non-personalized ads instead.</p>
                <p>You can opt out of personalized advertising by visiting Google Ads Settings. You can also opt out of some third-party vendors' use of cookies for personalized advertising by visiting www.aboutads.info.</p>
            </div>

            <!-- 4. Cookies and Similar Technologies -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-cookie-bite"></i>
                    4. Cookies and Similar Technologies
                </h2>
                <p>Third-party advertising providers may use cookies, web beacons, pixels, or similar technologies when advertisements are displayed on our website.</p>
                <p>These technologies may be used to:</p>
                <ul>
                    <li>Display relevant advertisements</li>
                    <li>Measure advertising performance</li>
                    <li>Prevent advertising fraud</li>
                    <li>Understand general advertising interactions</li>
                    <li>Improve advertising services</li>
                </ul>
                <p>Users can manage or disable cookies through their browser settings. Some advertising preferences may also be managed through the settings provided by third-party advertising services.</p>
                <p>Disabling cookies may affect certain website features or the way advertisements are displayed.</p>
            </div>

            <!-- 5. Third-Party Advertisers -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-building"></i>
                    5. Third-Party Advertisers
                </h2>
                <p>Advertisements displayed on Velocrosshairs may be provided by companies or advertising networks that operate independently from us.</p>
                <p>We do not control the products, services, claims, or content presented in third-party advertisements. This includes ads for games, gaming hardware, software, or in-game items.</p>
                <p>The appearance of an advertisement does not mean that Velocrosshairs endorses, recommends, or guarantees the advertised product or service.</p>
                <p>Visitors should independently evaluate any product, service, offer, or company before making a purchase or providing personal information.</p>
            </div>

            <!-- 6. Interaction With Advertisements -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-hand-pointer"></i>
                    6. Interaction With Advertisements
                </h2>
                <p>If you click on or interact with an advertisement displayed on Velocrosshairs, your interaction may take you to a third-party website.</p>
                <p>Any communication, purchase, transaction, subscription, or other interaction between you and an advertiser is solely between you and that third party.</p>
                <p>Velocrosshairs is not responsible for:</p>
                <ul>
                    <li>The products or services offered by advertisers</li>
                    <li>The accuracy of advertising claims</li>
                    <li>The quality of third-party products</li>
                    <li>Third-party websites</li>
                    <li>Transactions between users and advertisers</li>
                    <li>Privacy practices of external advertisers</li>
                </ul>
                <p>We recommend reviewing the terms and privacy policies of any third-party website you visit.</p>
            </div>

            <!-- 7. Ad Placement and No Misleading Advertisements -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-map-pin"></i>
                    7. Ad Placement and No Misleading Advertisements
                </h2>
                <p>We aim to maintain a clear distinction between our website content and advertisements.</p>
                <p>We do not place advertisements in a way that makes them look like crosshair cards, "Copy Code" buttons, download links, or other parts of our website.</p>
                <p>We do not ask or encourage visitors to click on advertisements, and we do not offer rewards for clicking on ads.</p>
                <p>Advertising placements may change over time as we improve the website and work with advertising partners.</p>
            </div>

            <!-- 8. Advertising and Younger Players -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-child"></i>
                    8. Advertising and Younger Players
                </h2>
                <p>Velocrosshairs is not specifically intended for children under the age of 13.</p>
                <p>We do not knowingly serve personalized advertising to children under 13. If you believe a child under 13 is using our website, please contact us.</p>
            </div>

            <!-- 9. User Responsibility -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-user-shield"></i>
                    9. User Responsibility
                </h2>
                <p>Visitors are responsible for making their own decisions when interacting with advertisements.</p>
                <p>Before purchasing a product, using a service, or sharing personal information with an advertiser, we recommend reviewing the advertiser's website, terms, privacy policy, and other relevant information.</p>
                <p>Never enter your Riot Games login details on a website you reached through an advertisement. Velocrosshairs does not verify every claim made by third-party advertisers.</p>
            </div>

            <!-- 10. Advertising and Privacy -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-user-secret"></i>
                    10. Advertising and Privacy
                </h2>
                <p>Our use of advertising services may involve the collection or processing of certain information through cookies and similar technologies.</p>
                <p>For more information about how information may be collected and used on Velocrosshairs, please review our <a href="{{ route('Privacy-Policy') }}" style="color: var(--primary-pink); text-decoration: none;">Privacy Policy</a>.</p>
                <p>Our Privacy Policy explains more about cookies, analytics, third-party services, and your available privacy choices.</p>
            </div>

            <!-- 11. Changes to This Advertisement Policy -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-edit"></i>
                    11. Changes to This Advertisement Policy
                </h2>
                <p>We may update this Advertisement Policy from time to time to reflect changes in our advertising practices, third-party services, website features, or applicable requirements.</p>
                <p>When we make changes, we will update the Last Updated date shown at the top of this page.</p>
                <p>We encourage visitors to review this policy periodically to stay informed.</p>
            </div>

            <!-- 12. Contact Us & 13. Acceptance -->
            <div class="contact-section">
                <h3 style="margin-bottom: 1.5rem;">12. Contact Us</h3>
                <p>If you have any questions or concerns about advertising on Velocrosshairs, or if you want to report an inappropriate ad, you can contact us at:</p>
                <a href="mailto:velocrosshairs@gmail.com" class="contact-email">
                    <i class="fas fa-envelope"></i>
                    velocrosshairs@gmail.com
                </a>
                <p style="margin-top: 1.5rem; color: var(--text-secondary);">We will make reasonable efforts to respond to legitimate advertising-related inquiries.</p>

                <h3 style="margin-top: 3rem; margin-bottom: 1.5rem;">13. Acceptance of This Policy</h3>
                <p style="color: var(--text-secondary); margin-bottom: 1rem;">By using Velocrosshairs, you acknowledge that you have read and understood this Advertisement Policy.</p>
                <p style="color: var(--text-secondary); margin-bottom: 1rem;">If you do not agree with the practices described in this policy, please discontinue using our website.</p>
                <p style="color: var(--text-secondary);">Thank you for visiting Velocrosshairs. Good luck in your next match!</p>
            </div>

        </div>
    </div>
</section>

@endsection
