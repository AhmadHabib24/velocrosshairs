@extends('layouts.app')

@section('title', 'Privacy Policy - Velocrosshairs')
@section('description', 'Read our privacy policy to understand how we collect, use, and protect your personal information on Velocrosshairs.')

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
            <h1 class="privacy-title">Privacy <span class="text-gradient">Policy</span></h1>
            <p class="privacy-subtitle">
                We are committed to protecting your privacy and ensuring the security of your personal information.
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
                        Welcome to Velocrosshairs. We respect your privacy and believe you should know what information may be collected when you use our website and how that information is handled.<br><br>
                        This Privacy Policy explains our approach to information collection, cookies, third-party services, advertising, and your privacy choices when you visit velocrosshairs.com.<br><br>
                        By accessing or using Velocrosshairs, you agree to the practices described in this Privacy Policy. If you do not agree with this policy, please discontinue using our website.
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
                    <li><a href="#about"><i class="fas fa-chevron-right"></i> 1. About Velocrosshairs</a></li>
                    <li><a href="#information-we-collect"><i class="fas fa-chevron-right"></i> 2. Information We Collect</a></li>
                    <li><a href="#crosshair-codes"><i class="fas fa-chevron-right"></i> 3. Crosshair Codes and the Copy Feature</a></li>
                    <li><a href="#cookies"><i class="fas fa-chevron-right"></i> 4. Cookies</a></li>
                    <li><a href="#google-adsense"><i class="fas fa-chevron-right"></i> 5. Google AdSense and Advertising</a></li>
                    <li><a href="#third-party-services"><i class="fas fa-chevron-right"></i> 6. Third-Party Services</a></li>
                    <li><a href="#analytics"><i class="fas fa-chevron-right"></i> 7. Analytics</a></li>
                    <li><a href="#how-we-use-information"><i class="fas fa-chevron-right"></i> 8. How We Use Information</a></li>
                    <li><a href="#childrens-privacy"><i class="fas fa-chevron-right"></i> 9. Children's Privacy</a></li>
                    <li><a href="#data-security"><i class="fas fa-chevron-right"></i> 10. Data Security</a></li>
                    <li><a href="#external-links"><i class="fas fa-chevron-right"></i> 11. External Links and Riot Games</a></li>
                    <li><a href="#your-privacy-rights"><i class="fas fa-chevron-right"></i> 12. Your Privacy Rights</a></li>
                    <li><a href="#changes-to-policy"><i class="fas fa-chevron-right"></i> 13. Changes to This Privacy Policy</a></li>
                    <li><a href="#contact"><i class="fas fa-chevron-right"></i> 14. Contact Us</a></li>
                    <li><a href="#consent"><i class="fas fa-chevron-right"></i> 15. Consent</a></li>
                </ul>
            </div>

            <!-- 1. About Velocrosshairs -->
            <div id="about" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-info-circle"></i>
                    1. About Velocrosshairs
                </h2>
                <p>Velocrosshairs is a free online resource for Valorant players. Our website provides a database of Valorant crosshair codes, including pro player crosshairs, popular styles, and clean presets that players can copy and import into the game.</p>
                <p>We also publish guides about crosshair styles, colors, settings, and how to import crosshair codes into Valorant.</p>
                <p>Our goal is to help players find a crosshair that gives them clarity, stability, and confidence in every fight, whether they are beginners, ranked players, or experienced competitors.</p>
            </div>

            <!-- 2. Information We Collect -->
            <div id="information-we-collect" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-database"></i>
                    2. Information We Collect
                </h2>
                <p>You can browse Velocrosshairs, explore the crosshair database, and copy crosshair codes without creating an account or providing personal information.</p>
                <p>However, certain technical information may be collected automatically when you visit our website. This information may include:</p>
                <ul>
                    <li>IP address</li>
                    <li>Browser type</li>
                    <li>Device type</li>
                    <li>Operating system</li>
                    <li>Approximate geographic location</li>
                    <li>Pages visited, such as crosshair pages and guides</li>
                    <li>Time and date of your visit</li>
                    <li>Referring website</li>
                    <li>General information about website usage</li>
                </ul>
                <p>This information may be collected through standard web technologies and third-party services. We use it mainly to understand how our website is used, improve performance, maintain security, and provide a better experience for players.</p>
            </div>

            <!-- 3. Crosshair Codes and the Copy Feature -->
            <div id="crosshair-codes" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-copy"></i>
                    3. Crosshair Codes and the Copy Feature
                </h2>
                <p>Velocrosshairs allows users to copy crosshair codes with a "Copy Code" button so they can paste them into Valorant using the "Import Profile Code" option.</p>
                <p>Copying a crosshair code happens in your browser. We do not collect or store the contents of your clipboard, and we do not access your Riot Games account or your in-game settings.</p>
                <p>We may record general, non-personal usage information, such as how often a crosshair is viewed or copied, to understand which crosshairs are most popular and to improve our database.</p>
                <p>Your browser may temporarily store information through features such as cache, clipboard history, or local storage. We recommend that you never share your Riot Games login details, passwords, or other sensitive information on any crosshair website, including ours.</p>
            </div>

            <!-- 4. Cookies -->
            <div id="cookies" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-cookie"></i>
                    4. Cookies
                </h2>
                <p>Velocrosshairs may use cookies and similar technologies to improve website functionality, understand visitor activity, analyze traffic, and support advertising.</p>
                <p>Cookies are small files that websites may store on your device when you visit them.</p>
                <p>Cookies may be used to:</p>
                <ul>
                    <li>Improve website functionality</li>
                    <li>Remember certain preferences, such as your cookie consent choice</li>
                    <li>Understand how visitors use our crosshair database and guides</li>
                    <li>Analyze website traffic</li>
                    <li>Measure advertising performance</li>
                    <li>Support relevant advertising</li>
                </ul>
                <p>You can manage or disable cookies through your browser settings. However, disabling cookies may affect how certain websites or features work.</p>
            </div>

            <!-- 5. Google AdSense and Advertising -->
            <div id="google-adsense" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-ad"></i>
                    5. Google AdSense and Advertising
                </h2>
                <p>Velocrosshairs may display advertisements through Google AdSense or other third-party advertising providers. Advertising helps us keep the crosshair database and guides free for all players.</p>
                <p>Third-party vendors, including Google, use cookies to serve ads based on a user's prior visits to this website or other websites on the internet.</p>
                <p>Google's use of advertising cookies enables it and its partners to serve ads to users based on their visits to Velocrosshairs and/or other sites on the internet.</p>
                <p>You can opt out of personalized advertising by visiting Google Ads Settings. You can also opt out of some third-party vendors' use of cookies for personalized advertising by visiting www.aboutads.info.</p>
                <p>To learn more about how Google uses information from sites that use its services, please visit How Google uses information from sites or apps that use our services.</p>
                <p>If you visit our website from the European Economic Area, the United Kingdom, or Switzerland, we may ask for your consent before personalized ads or certain cookies are used. If you do not give consent, you may see non-personalized ads instead.</p>
                <p>Because third-party advertising providers operate independently, their use of information is governed by their own privacy policies and terms.</p>
            </div>

            <!-- 6. Third-Party Services -->
            <div id="third-party-services" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-plug"></i>
                    6. Third-Party Services
                </h2>
                <p>We may use third-party services to help operate, analyze, secure, and improve Velocrosshairs.</p>
                <p>These services may include:</p>
                <ul>
                    <li>Website analytics providers</li>
                    <li>Advertising networks</li>
                    <li>Hosting providers</li>
                    <li>Security services</li>
                    <li>Content delivery services</li>
                </ul>
                <p>Third-party services may collect certain technical or usage information in accordance with their own privacy policies.</p>
                <p>We recommend reviewing the privacy policies of these third-party services for more information about how they collect and process data.</p>
            </div>

            <!-- 7. Analytics -->
            <div id="analytics" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-chart-line"></i>
                    7. Analytics
                </h2>
                <p>Velocrosshairs may use analytics services, such as Google Analytics, to understand how visitors interact with our website.</p>
                <p>Analytics services may collect information such as:</p>
                <ul>
                    <li>Pages visited</li>
                    <li>Time spent on pages</li>
                    <li>Crosshairs viewed or copied</li>
                    <li>Device information</li>
                    <li>Browser information</li>
                    <li>Approximate geographic information</li>
                    <li>General usage patterns</li>
                </ul>
                <p>We use this information to improve our crosshair database and guides, identify technical issues, understand visitor behavior, and enhance the overall user experience.</p>
            </div>

            <!-- 8. How We Use Information -->
            <div id="how-we-use-information" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-tasks"></i>
                    8. How We Use Information
                </h2>
                <p>Information collected through Velocrosshairs may be used for the following purposes:</p>
                <ul>
                    <li>To operate and maintain our website</li>
                    <li>To improve our crosshair database and import tools</li>
                    <li>To understand which crosshairs and guides players find most useful</li>
                    <li>To improve website performance</li>
                    <li>To understand visitor behavior</li>
                    <li>To analyze website traffic</li>
                    <li>To detect technical problems</li>
                    <li>To protect our website against misuse and security threats</li>
                    <li>To measure advertising performance</li>
                    <li>To comply with applicable laws and legal obligations</li>
                </ul>
                <p>We do not sell personal information as part of our ordinary website operations.</p>
            </div>

            <!-- 9. Children's Privacy -->
            <div id="childrens-privacy" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-child"></i>
                    9. Children's Privacy
                </h2>
                <p>Velocrosshairs is not specifically intended for children under the age of 13.</p>
                <p>We do not knowingly collect personal information from children under 13 years of age.</p>
                <p>If you believe that a child has provided personal information through our website, please contact us. If we become aware of such information being collected, we will take reasonable steps to remove it where required by applicable law.</p>
            </div>

            <!-- 10. Data Security -->
            <div id="data-security" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-shield-alt"></i>
                    10. Data Security
                </h2>
                <p>We take reasonable measures to protect information associated with our website.</p>
                <p>However, no method of transmitting information over the internet or storing information electronically is completely secure.</p>
                <p>For this reason, we cannot guarantee that information transmitted to or through our website will always remain completely secure.</p>
            </div>

            <!-- 11. External Links and Riot Games -->
            <div id="external-links" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-external-link-alt"></i>
                    11. External Links and Riot Games
                </h2>
                <p>Velocrosshairs may sometimes contain links to third-party websites or services, such as esports sites, player profiles, or official game pages.</p>
                <p>We do not control and are not responsible for the privacy practices, security, content, or policies of external websites.</p>
                <p>When you visit an external website through a link on our website, we recommend reviewing its privacy policy before providing any personal information.</p>
                <p>Velocrosshairs is an independent fan website. It is not endorsed by, affiliated with, or sponsored by Riot Games. Valorant and Riot Games are trademarks or registered trademarks of Riot Games, Inc. Any information you share with Riot Games, including through the Valorant game client, is governed by Riot Games' own privacy policy.</p>
            </div>

            <!-- 12. Your Privacy Rights -->
            <div id="your-privacy-rights" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-user-shield"></i>
                    12. Your Privacy Rights
                </h2>
                <p>Depending on your location and applicable privacy laws, such as the GDPR in Europe or the CCPA in California, you may have certain rights regarding your personal information.</p>
                <p>These rights may include:</p>
                <ul>
                    <li>Requesting information about personal data collected about you</li>
                    <li>Requesting correction of inaccurate information</li>
                    <li>Requesting deletion of certain personal information</li>
                    <li>Objecting to certain data processing activities</li>
                    <li>Requesting restrictions on certain types of processing</li>
                    <li>Withdrawing consent you previously gave</li>
                    <li>Managing cookie preferences</li>
                    <li>Managing certain personalized advertising choices</li>
                </ul>
                <p>These rights may vary depending on applicable laws and circumstances.</p>
                <p>If you would like to make a privacy-related request, please contact us using the email address provided below.</p>
            </div>

            <!-- 13. Changes to This Privacy Policy -->
            <div id="changes-to-policy" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-edit"></i>
                    13. Changes to This Privacy Policy
                </h2>
                <p>We may update this Privacy Policy from time to time to reflect changes in our website, services, technology, or applicable legal requirements.</p>
                <p>Whenever this policy is updated, we will revise the Last Updated date shown at the beginning of this page.</p>
                <p>We encourage you to review this Privacy Policy periodically to stay informed about how we handle information.</p>
            </div>

            <!-- 14. Contact Us -->
            <div id="contact" class="contact-section">
                <h3>14. Contact Us</h3>
                <p>If you have any questions, concerns, or requests regarding this Privacy Policy or our privacy practices, please contact us.</p>
                <a href="mailto:velocrosshairs@gmail.com" class="contact-email">
                    <i class="fas fa-envelope"></i>
                    velocrosshairs@gmail.com
                </a>
            </div>

            <!-- 15. Consent -->
            <div id="consent" class="policy-section" style="margin-top: 3rem;">
                <h2 class="section-title">
                    <i class="fas fa-check-circle"></i>
                    15. Consent
                </h2>
                <p>By using Velocrosshairs, you acknowledge that you have read and understood this Privacy Policy and agree to the practices described here.</p>
                <p>If you do not agree with this Privacy Policy, please discontinue using our website.</p>
                <p>Thank you for using Velocrosshairs. Good luck in your next match!</p>
            </div>

        </div>
    </div>
</section>

@endsection