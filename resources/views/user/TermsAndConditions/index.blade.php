@extends('layouts.app')

@section('title', 'Terms and Conditions - Velocrosshairs')
@section('description', 'Read our Terms and Conditions to understand the rules and guidelines for using Velocrosshairs.')

@push('styles')
<style>
    /* Hero Section */
    .privacy-hero {
        position: relative;
        padding: 6rem 0 4rem;
        overflow: hidden;
        background: linear-gradient(135deg, var(--dark-bg) 0%, #0F1419 50%, var(--dark-bg) 100%);
    }

    .privacy-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(ellipse at center, rgba(255, 45, 95, 0.1) 0%, transparent 70%);
        z-index: 0;
    }

    .privacy-hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
    }

    .privacy-title {
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

    .privacy-subtitle {
        font-size: 1.1rem;
        color: var(--text-secondary);
        line-height: 1.6;
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
    .privacy-content {
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

    /* Table of Contents */
    .table-of-contents {
        background: linear-gradient(145deg, #1a1a1a 0%, #0f0f0f 100%);
        border: 1px solid rgba(255, 45, 95, 0.2);
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 3rem;
    }

    .toc-title {
        font-family: 'Orbitron', monospace;
        font-size: 1.3rem;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .toc-title i {
        color: var(--primary-pink);
    }

    .toc-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .toc-list li {
        margin-bottom: 0.75rem;
    }

    .toc-list a {
        color: var(--text-secondary);
        text-decoration: none;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
    }

    .toc-list a:hover {
        color: var(--primary-pink);
        background: rgba(255, 45, 95, 0.1);
        transform: translateX(5px);
    }

    .toc-list a i {
        font-size: 0.8rem;
        opacity: 0.6;
    }

    /* Section Styling */
    .policy-section {
        margin-bottom: 3rem;
        scroll-margin-top: 100px;
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

    .subsection-title {
        font-family: 'Orbitron', monospace;
        font-size: 1.3rem;
        color: var(--text-primary);
        margin: 2rem 0 1rem;
        font-weight: 600;
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

    /* Definition List */
    .definition-list {
        background: linear-gradient(145deg, #1a1a1a 0%, #0f0f0f 100%);
        border: 1px solid rgba(255, 45, 95, 0.2);
        border-radius: 1rem;
        padding: 1.5rem;
        margin: 1.5rem 0;
    }

    .definition-item {
        padding: 1rem;
        margin-bottom: 1rem;
        border-left: 3px solid var(--primary-pink);
        background: rgba(255, 45, 95, 0.05);
        border-radius: 0 0.5rem 0.5rem 0;
    }

    .definition-item:last-child {
        margin-bottom: 0;
    }

    .definition-term {
        font-weight: 700;
        color: var(--primary-pink);
        margin-bottom: 0.5rem;
        font-size: 1.05rem;
    }

    .definition-desc {
        color: var(--text-secondary);
        line-height: 1.6;
        margin: 0;
    }

    /* Info Box */
    .info-box {
        background: rgba(255, 45, 95, 0.1);
        border: 1px solid rgba(255, 45, 95, 0.3);
        border-radius: 0.75rem;
        padding: 1.5rem;
        margin: 1.5rem 0;
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
        .privacy-hero {
            padding: 4rem 0 2rem;
        }

        .privacy-title {
            font-size: 1.8rem;
        }

        .content-wrapper {
            padding: 2rem 1.5rem;
        }

        .section-title {
            font-size: 1.4rem;
        }

        .subsection-title {
            font-size: 1.1rem;
        }

        .table-of-contents {
            padding: 1.5rem;
        }

        .policy-section ul {
            padding-left: 1.5rem;
        }
    }

    /* Smooth Scroll */
    html {
        scroll-behavior: smooth;
    }
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="privacy-hero">
    <div class="container">
        <div class="privacy-hero-content">
            <h1 class="privacy-title">Terms & <span class="text-gradient">Conditions</span></h1>
            <p class="privacy-subtitle">
                These Terms and Conditions explain the rules and guidelines that apply when you access or use our website.
            </p>
            <span class="last-updated">
                <i class="fas fa-calendar-alt"></i> Last Updated: Oct 4, 2026
            </span>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="privacy-content">
    <div class="container">
        <div class="content-wrapper">

            <!-- Introduction -->
            <div class="info-box">
                <i class="fas fa-info-circle"></i>
                <div class="info-box-content">
                    <p>
                        Welcome to Velocrosshairs. These Terms and Conditions explain the rules and guidelines that apply when you access or use our website, crosshair database, and guides at velocrosshairs.com.<br><br>
                        By visiting or using Velocrosshairs, you agree to follow these Terms and Conditions. If you do not agree with any part of these terms, please stop using our website.
                    </p>
                </div>
            </div>

            <!-- Table of Contents -->
            <div class="table-of-contents">
                <h2 class="toc-title">
                    <i class="fas fa-list"></i>
                    Table of Contents
                </h2>
                <ul class="toc-list">
                    <li><a href="#about-service"><i class="fas fa-chevron-right"></i> 1. About Our Service</a></li>
                    <li><a href="#acceptable-use"><i class="fas fa-chevron-right"></i> 2. Acceptable Use</a></li>
                    <li><a href="#user-responsibility"><i class="fas fa-chevron-right"></i> 3. Crosshair Codes and User Responsibility</a></li>
                    <li><a href="#no-guarantee"><i class="fas fa-chevron-right"></i> 4. No Guarantee of Results</a></li>
                    <li><a href="#intellectual-property"><i class="fas fa-chevron-right"></i> 5. Intellectual Property and Riot Games</a></li>
                    <li><a href="#user-generated-content"><i class="fas fa-chevron-right"></i> 6. User-Generated Content</a></li>
                    <li><a href="#third-party-websites"><i class="fas fa-chevron-right"></i> 7. Third-Party Websites and Services</a></li>
                    <li><a href="#advertising"><i class="fas fa-chevron-right"></i> 8. Advertising</a></li>
                    <li><a href="#website-availability"><i class="fas fa-chevron-right"></i> 9. Website Availability</a></li>
                    <li><a href="#disclaimer"><i class="fas fa-chevron-right"></i> 10. Disclaimer of Warranties</a></li>
                    <li><a href="#limitation"><i class="fas fa-chevron-right"></i> 11. Limitation of Liability</a></li>
                    <li><a href="#privacy"><i class="fas fa-chevron-right"></i> 12. Privacy</a></li>
                    <li><a href="#changes"><i class="fas fa-chevron-right"></i> 13. Changes to These Terms</a></li>
                    <li><a href="#termination"><i class="fas fa-chevron-right"></i> 14. Termination or Restriction of Access</a></li>
                    <li><a href="#governing-law"><i class="fas fa-chevron-right"></i> 15. Governing Law</a></li>
                    <li><a href="#contact"><i class="fas fa-chevron-right"></i> 16. Contact Us</a></li>
                    <li><a href="#agreement"><i class="fas fa-chevron-right"></i> 17. Agreement to These Terms</a></li>
                </ul>
            </div>

            <!-- 1. About Our Service -->
            <div id="about-service" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-info-circle"></i>
                    1. About Our Service
                </h2>
                <p>Velocrosshairs provides a free online database of Valorant crosshair codes, including pro player crosshairs, popular styles, and clean presets that players can copy and import into the game. We also publish guides about crosshair styles, colors, settings, and importing codes.</p>
                <p>Our website is provided for general informational, personal, educational, and entertainment purposes.</p>
                <p>We may add, remove, modify, or improve crosshairs, guides, and features of the website at any time without prior notice.</p>
            </div>

            <!-- 2. Acceptable Use -->
            <div id="acceptable-use" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-check-circle"></i>
                    2. Acceptable Use
                </h2>
                <p>You agree to use Velocrosshairs responsibly and only for lawful purposes.</p>
                <p>You must not use our website to:</p>
                <ul>
                    <li>Break or violate any applicable law or regulation</li>
                    <li>Harass, threaten, or harm another person</li>
                    <li>Promote violence or illegal activities</li>
                    <li>Create or share content intended to deceive or defraud others</li>
                    <li>Impersonate another person, professional player, team, or organization</li>
                    <li>Distribute malware, viruses, or harmful code</li>
                    <li>Attempt to interfere with the normal operation of our website</li>
                    <li>Attempt to gain unauthorized access to our systems</li>
                    <li>Abuse, overload, or disrupt our services</li>
                    <li>Use bots, scrapers, or other automated methods to copy our crosshair database or excessively access our website</li>
                </ul>
                <p>We reserve the right to restrict access to users who misuse the website or violate these Terms and Conditions.</p>
            </div>

            <!-- 3. Crosshair Codes and User Responsibility -->
            <div id="user-responsibility" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-copy"></i>
                    3. Crosshair Codes and User Responsibility
                </h2>
                <p>Velocrosshairs lets you copy crosshair codes and import them into Valorant through the game's "Import Profile Code" option.</p>
                <p>You are solely responsible for the crosshair codes you copy, import, or share, and for any changes you make to your in-game settings.</p>
                <p>Crosshair codes are imported through the Valorant game client, which is operated by Riot Games. Your use of the game is governed by Riot Games' own terms of service.</p>
                <p>You should review a crosshair in the Range before using it in a match, and make sure your use of our content complies with the rules of any platform, tournament, or community where you play or share it.</p>
            </div>

            <!-- 4. No Guarantee of Results -->
            <div id="no-guarantee" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-times-circle"></i>
                    4. No Guarantee of Results
                </h2>
                <p>While we aim to keep our crosshair database accurate and useful, we do not guarantee that any crosshair will improve your aim, rank, or performance.</p>
                <p>Pro player crosshairs are collected from publicly available sources and reflect settings at the time they were added. Professional players often change their crosshairs, so a code on our website may not match the one a player currently uses.</p>
                <p>Game updates by Riot Games may also change how crosshair codes work or how crosshairs appear in the game. As a result, some codes may stop working or look different after an update.</p>
            </div>

            <!-- 5. Intellectual Property and Riot Games -->
            <div id="intellectual-property" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-copyright"></i>
                    5. Intellectual Property and Riot Games
                </h2>
                <p>The design, branding, layout, graphics, guides, original written content, and the way our crosshair database is organized are protected by applicable intellectual property laws unless otherwise stated.</p>
                <p>You may copy individual crosshair codes for your own personal use in Valorant.</p>
                <p>You may not copy, reproduce, scrape, modify, distribute, sell, or republish substantial portions of our website's content, crosshair database, design, or branding without prior written permission.</p>
                <p>Velocrosshairs is an independent fan website. It is not endorsed by, affiliated with, or sponsored by Riot Games. Valorant and Riot Games are trademarks or registered trademarks of Riot Games, Inc. Names of professional players and teams are used only to identify the crosshairs associated with them and remain the property of their respective owners.</p>
            </div>

            <!-- 6. User-Generated Content -->
            <div id="user-generated-content" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-users"></i>
                    6. User-Generated Content
                </h2>
                <p>Velocrosshairs may allow users to share feedback, suggestions, or crosshair codes with us, for example by email.</p>
                <p>We do not claim ownership of content you send us. By sending it, you allow us to review it and, where suitable, use or publish it on our website.</p>
                <p>You remain responsible for ensuring that you have the necessary rights to share any content you submit.</p>
                <p>You should not send confidential or sensitive information, such as your Riot Games login details, through our website or by email.</p>
            </div>

            <!-- 7. Third-Party Websites and Services -->
            <div id="third-party-websites" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-external-link-alt"></i>
                    7. Third-Party Websites and Services
                </h2>
                <p>Our website may contain links to third-party websites, services, or resources, such as esports sites, player profiles, or official game pages.</p>
                <p>These links may be provided for convenience or additional information. We do not control third-party websites and are not responsible for their content, availability, security, privacy practices, or terms.</p>
                <p>Your use of third-party websites is subject to the terms and policies of those websites.</p>
            </div>

            <!-- 8. Advertising -->
            <div id="advertising" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-ad"></i>
                    8. Advertising
                </h2>
                <p>Velocrosshairs may display advertisements provided by third-party advertising networks, including Google AdSense. Advertising helps keep our crosshair database and guides free.</p>
                <p>Advertisements may be selected and displayed by third-party advertising providers based on various factors.</p>
                <p>We are not responsible for the content, accuracy, availability, or claims made in advertisements displayed by third parties.</p>
                <p>Any interaction, transaction, or communication you have with an advertiser is solely between you and that advertiser.</p>
            </div>

            <!-- 9. Website Availability -->
            <div id="website-availability" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-server"></i>
                    9. Website Availability
                </h2>
                <p>We aim to keep Velocrosshairs available and working properly. However, we do not guarantee that the website or its features will always be available, uninterrupted, secure, or free from errors.</p>
                <p>The website may occasionally be unavailable because of:</p>
                <ul>
                    <li>Maintenance</li>
                    <li>Technical issues</li>
                    <li>Server problems</li>
                    <li>Security updates</li>
                    <li>Internet or network failures</li>
                    <li>Unforeseen circumstances</li>
                </ul>
                <p>We may also temporarily suspend or discontinue any part of the website without prior notice.</p>
            </div>

            <!-- 10. Disclaimer of Warranties -->
            <div id="disclaimer" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    10. Disclaimer of Warranties
                </h2>
                <p>Velocrosshairs, its crosshair database, and its guides are provided on an "as is" and "as available" basis.</p>
                <p>To the fullest extent permitted by applicable law, we make no warranties or representations regarding the accuracy, reliability, availability, suitability, or completeness of the website or its content.</p>
                <p>We do not guarantee that the website will meet every user's specific requirements or that every crosshair code will be accurate, current, or suitable for every player.</p>
            </div>

            <!-- 11. Limitation of Liability -->
            <div id="limitation" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-shield-alt"></i>
                    11. Limitation of Liability
                </h2>
                <p>To the maximum extent permitted by applicable law, Velocrosshairs and its operators will not be responsible for any direct, indirect, incidental, consequential, or other losses arising from or related to your use of the website or its content.</p>
                <p>This includes, but is not limited to, losses resulting from:</p>
                <ul>
                    <li>Your use or inability to use the website</li>
                    <li>Reliance on crosshair codes, settings, or guides</li>
                    <li>Changes to your in-game settings</li>
                    <li>Game updates or changes made by Riot Games</li>
                    <li>Errors or interruptions</li>
                    <li>Loss of data</li>
                    <li>Third-party websites or services</li>
                    <li>Any other issue connected with your use of the website</li>
                </ul>
                <p>You use Velocrosshairs at your own discretion and risk.</p>
            </div>

            <!-- 12. Privacy -->
            <div id="privacy" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-user-secret"></i>
                    12. Privacy
                </h2>
                <p>Your use of Velocrosshairs is also subject to our Privacy Policy.</p>
                <p>Our Privacy Policy explains how information may be collected, used, and handled when you visit or use our website, including information about cookies, analytics, and advertising.</p>
                <p>We encourage you to read our Privacy Policy carefully before using our website.</p>
            </div>

            <!-- 13. Changes to These Terms -->
            <div id="changes" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-edit"></i>
                    13. Changes to These Terms
                </h2>
                <p>We may update or change these Terms and Conditions from time to time.</p>
                <p>When changes are made, we will update the Last Updated date at the top of this page.</p>
                <p>Your continued use of Velocrosshairs after changes are posted means that you accept the updated Terms and Conditions.</p>
            </div>

            <!-- 14. Termination or Restriction of Access -->
            <div id="termination" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-ban"></i>
                    14. Termination or Restriction of Access
                </h2>
                <p>We reserve the right to restrict, suspend, or terminate access to Velocrosshairs if we believe that a user has violated these Terms and Conditions, misused our website, scraped our crosshair database, or engaged in activities that may harm our website or other users.</p>
                <p>We may take such action without prior notice where reasonably necessary.</p>
            </div>

            <!-- 15. Governing Law -->
            <div id="governing-law" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-gavel"></i>
                    15. Governing Law
                </h2>
                <p>These Terms and Conditions shall be interpreted and applied in accordance with applicable laws.</p>
                <p>Any dispute related to the use of Velocrosshairs shall be handled through the appropriate legal authorities and courts having jurisdiction over the matter.</p>
            </div>

            <!-- 16. Contact Us -->
            <div id="contact" class="contact-section">
                <h3>16. Contact Us</h3>
                <p>If you have questions, concerns, or suggestions regarding these Terms and Conditions, please contact us.</p>
                <a href="mailto:velocrosshairs@gmail.com" class="contact-email">
                    <i class="fas fa-envelope"></i>
                    velocrosshairs@gmail.com
                </a>
            </div>

            <!-- 17. Agreement to These Terms -->
            <div id="agreement" class="policy-section" style="margin-top: 3rem;">
                <h2 class="section-title">
                    <i class="fas fa-check-circle"></i>
                    17. Agreement to These Terms
                </h2>
                <p>By accessing or using Velocrosshairs, you confirm that you have read, understood, and agreed to these Terms and Conditions.</p>
                <p>If you do not agree with these terms, you should discontinue using our website.</p>
                <p>Thank you for using Velocrosshairs. Good luck in your next match!</p>
            </div>

        </div>
    </div>
</section>

@endsection