@extends('layouts.app')

@section('title', 'Disclaimer - Velocrosshairs')
@section('description', 'Read our disclaimer for using Velocrosshairs.')

@push('styles')
<style>
    /* Hero Section */
    .disclaimer-hero {
        position: relative;
        padding: 6rem 0 4rem;
        overflow: hidden;
        background: linear-gradient(135deg, var(--dark-bg) 0%, #0F1419 50%, var(--dark-bg) 100%);
    }

    .disclaimer-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(ellipse at center, rgba(255, 45, 95, 0.1) 0%, transparent 70%);
        z-index: 0;
    }

    .disclaimer-hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
    }

    .disclaimer-title {
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
    .disclaimer-content {
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
        .disclaimer-hero {
            padding: 4rem 0 2rem;
        }

        .disclaimer-title {
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
<section class="disclaimer-hero">
    <div class="container">
        <div class="disclaimer-hero-content">
            <h1 class="disclaimer-title"><span class="text-gradient">Disclaimer</span></h1>
            <span class="last-updated">
                <i class="fas fa-calendar-alt"></i> Last Updated: Oct 4, 2026
            </span>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="disclaimer-content">
    <div class="container">
        <div class="content-wrapper">

            <!-- Introduction -->
            <div class="info-box">
                <i class="fas fa-info-circle"></i>
                <div class="info-box-content">
                    <p>
                        Welcome to Velocrosshairs. The information, crosshair codes, guides, and other content provided on this website are intended for general informational, educational, and entertainment purposes.<br><br>
                        By using Velocrosshairs, you acknowledge and agree to the terms outlined in this Disclaimer.
                    </p>
                </div>
            </div>

            <!-- 1. General Information -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-info-circle"></i>
                    1. General Information
                </h2>
                <p>Velocrosshairs is a free online database of Valorant crosshair codes, including pro player crosshairs, popular styles, and clean presets, along with guides about crosshair styles, colors, settings, and importing codes.</p>
                <p>While we make reasonable efforts to keep our website useful and accurate, we do not guarantee that all information, crosshair codes, or guides will always be complete, accurate, reliable, or up to date.</p>
                <p>You use the website and its content at your own discretion and risk.</p>
            </div>

            <!-- 2. Crosshair Codes -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-crosshairs"></i>
                    2. Crosshair Codes
                </h2>
                <p>Crosshair codes on Velocrosshairs are provided so players can copy them and import them into Valorant using the game's "Import Profile Code" option.</p>
                <p>We do not control how users use, import, or share crosshair codes.</p>
                <p>Users are solely responsible for deciding which crosshairs to use and for any changes they make to their in-game settings. We recommend testing any new crosshair in the Range before using it in a match.</p>
                <p>A crosshair that works well for one player may not suit another. Results depend on your monitor, resolution, sensitivity, personal preference, and play style.</p>
            </div>

            <!-- 3. Pro Player Crosshairs -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-user-ninja"></i>
                    3. Pro Player Crosshairs
                </h2>
                <p>Pro player crosshair codes on Velocrosshairs are collected from publicly available sources, such as streams, tournament broadcasts, and esports websites.</p>
                <p>Professional players often change their crosshairs, settings, and teams. A code listed on our website reflects the information available when it was added and may not match what a player currently uses.</p>
                <p>The use of a professional player's or team's name does not mean that the player or team endorses, sponsors, or is affiliated with Velocrosshairs. Player and team names are used only to identify the crosshairs associated with them.</p>
                <p>If you are a professional player or team representative and would like information about you updated or removed, please contact us.</p>
            </div>

            <!-- 4. No Professional Advice -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-ban"></i>
                    4. No Professional Advice
                </h2>
                <p>The content on Velocrosshairs is not intended to provide professional coaching, technical, medical, or other specialized advice.</p>
                <p>Our guides share general tips about crosshairs and settings. They are not a substitute for advice from a qualified coach, technician, or other expert.</p>
                <p>If you experience eye strain, discomfort, or any health concerns while gaming, you should consult an appropriately qualified professional.</p>
            </div>

            <!-- 5. Accuracy and Completeness -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-clipboard-check"></i>
                    5. Accuracy and Completeness
                </h2>
                <p>We try to provide useful and reliable information, but we cannot guarantee that every crosshair code, setting, or guide on the website is completely accurate, current, or free from errors.</p>
                <p>Information and features may change over time without notice.</p>
                <p>We are not responsible for any loss or damage that may result from relying solely on information provided on this website.</p>
            </div>

            <!-- 6. Game Updates and Compatibility -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-gamepad"></i>
                    6. Game Updates and Compatibility
                </h2>
                <p>Valorant is developed and updated by Riot Games. Game patches may change crosshair options, the crosshair code format, or how crosshairs appear in the game.</p>
                <p>As a result, some crosshair codes on our website may stop working, import incorrectly, or look different after an update.</p>
                <p>We cannot guarantee that every crosshair code will work with every version of the game.</p>
            </div>

            <!-- 7. Riot Games Affiliation -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    7. Riot Games Affiliation
                </h2>
                <p>Velocrosshairs is an independent fan website. It is not endorsed by, affiliated with, sponsored by, or approved by Riot Games.</p>
                <p>Valorant and Riot Games are trademarks or registered trademarks of Riot Games, Inc. All game-related names, images, and trademarks belong to their respective owners.</p>
                <p>Any questions about your Valorant account, the game client, or game features should be directed to Riot Games.</p>
            </div>

            <!-- 8. Third-Party Websites and Links -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-link"></i>
                    8. Third-Party Websites and Links
                </h2>
                <p>Velocrosshairs may include links to third-party websites or external resources, such as esports sites, player profiles, or official game pages.</p>
                <p>These links may be provided for convenience or informational purposes.</p>
                <p>We do not own or control third-party websites and are not responsible for their content, accuracy, availability, security, or privacy practices.</p>
                <p>Visiting or using any third-party website is done at your own risk. We recommend reviewing the terms and privacy policies of external websites before using them.</p>
            </div>

            <!-- 9. Advertising Disclaimer -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-ad"></i>
                    9. Advertising Disclaimer
                </h2>
                <p>Velocrosshairs may display advertisements from third-party advertising providers, including Google AdSense.</p>
                <p>The appearance of an advertisement on our website does not mean that we endorse, recommend, or guarantee the advertised product, service, company, or website.</p>
                <p>We are not responsible for the claims, accuracy, quality, availability, or reliability of products or services promoted through third-party advertisements.</p>
                <p>Any purchase, transaction, or communication with an advertiser is solely between you and the advertiser.</p>
            </div>

            <!-- 10. Website Availability -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-server"></i>
                    10. Website Availability
                </h2>
                <p>We make reasonable efforts to keep Velocrosshairs accessible and functional. However, we do not guarantee that the website or its features will always be available, uninterrupted, secure, or free of technical errors.</p>
                <p>The website may become temporarily unavailable due to maintenance, technical problems, server issues, security updates, internet disruptions, or circumstances beyond our control.</p>
                <p>We may also modify, suspend, or discontinue any feature or part of the website at any time without prior notice.</p>
            </div>

            <!-- 11. Limitation of Responsibility -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-shield-alt"></i>
                    11. Limitation of Responsibility
                </h2>
                <p>To the fullest extent permitted by applicable law, Velocrosshairs and its operators shall not be held responsible for any direct, indirect, incidental, consequential, or other losses resulting from your use of, or reliance on, the information or content available on this website.</p>
                <p>This includes any loss or damage related to:</p>
                <ul>
                    <li>Crosshair codes or settings</li>
                    <li>Changes to your in-game settings</li>
                    <li>Game updates or changes made by Riot Games</li>
                    <li>Errors or inaccuracies</li>
                    <li>Website interruptions</li>
                    <li>Third-party websites or services</li>
                    <li>Loss of data</li>
                    <li>Any other use of the website or its content</li>
                </ul>
                <p>You are responsible for determining whether any crosshair, setting, or guide is appropriate for your intended use.</p>
            </div>

            <!-- 12. External Content -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-share-alt"></i>
                    12. External Content
                </h2>
                <p>Our website may reference or link to content created by third parties, such as esports websites, player streams, and community resources.</p>
                <p>We do not guarantee the accuracy, reliability, or completeness of information provided by external sources.</p>
                <p>Any opinions or information expressed by third parties belong to those parties and do not necessarily represent the views of Velocrosshairs.</p>
            </div>

            <!-- 13. Changes to This Disclaimer -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-edit"></i>
                    13. Changes to This Disclaimer
                </h2>
                <p>We may update this Disclaimer from time to time to reflect changes to our website, services, or applicable requirements.</p>
                <p>Any changes will be posted on this page, and the Last Updated date will be revised accordingly.</p>
                <p>We encourage you to review this page periodically.</p>
            </div>

            <!-- 14. Your Acceptance -->
            <div class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-check-circle"></i>
                    14. Your Acceptance
                </h2>
                <p>By using Velocrosshairs, you acknowledge that you have read and understood this Disclaimer and agree to the terms described above.</p>
                <p>If you do not agree with this Disclaimer, please discontinue using our website.</p>
            </div>

            <!-- 15. Contact Us -->
            <div class="contact-section">
                <h3>15. Contact Us</h3>
                <p>If you have any questions or concerns regarding this Disclaimer, you can contact us at:</p>
                <a href="mailto:velocrosshairs@gmail.com" class="contact-email">
                    <i class="fas fa-envelope"></i>
                    velocrosshairs@gmail.com
                </a>
                <p style="margin-top: 1.5rem; color: var(--text-secondary);">We will make reasonable efforts to respond to legitimate inquiries.</p>
                <p style="color: var(--text-secondary);">Thank you for using Velocrosshairs. Good luck in your next match!</p>
            </div>

        </div>
    </div>
</section>

@endsection
