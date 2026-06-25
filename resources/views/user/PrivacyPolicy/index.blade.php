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
                <i class="fas fa-calendar-alt"></i> Last Updated: December 07, 2025
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
                        This Privacy Policy describes our policies and procedures on the collection, use, and disclosure 
                        of your information when you use Velocrosshairs. By using our Service, you agree to the collection 
                        and use of information in accordance with this Privacy Policy.
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
                    <li><a href="#definitions"><i class="fas fa-chevron-right"></i> Interpretation and Definitions</a></li>
                    <li><a href="#collecting-data"><i class="fas fa-chevron-right"></i> Collecting and Using Your Personal Data</a></li>
                    <li><a href="#use-of-data"><i class="fas fa-chevron-right"></i> Use of Your Personal Data</a></li>
                    <li><a href="#sharing-data"><i class="fas fa-chevron-right"></i> Sharing Your Personal Information</a></li>
                    <li><a href="#retention"><i class="fas fa-chevron-right"></i> Retention of Your Personal Data</a></li>
                    <li><a href="#transfer"><i class="fas fa-chevron-right"></i> Transfer of Your Personal Data</a></li>
                    <li><a href="#delete"><i class="fas fa-chevron-right"></i> Delete Your Personal Data</a></li>
                    <li><a href="#disclosure"><i class="fas fa-chevron-right"></i> Disclosure of Your Personal Data</a></li>
                    <li><a href="#security"><i class="fas fa-chevron-right"></i> Security of Your Personal Data</a></li>
                    <li><a href="#children"><i class="fas fa-chevron-right"></i> Children's Privacy</a></li>
                    <li><a href="#links"><i class="fas fa-chevron-right"></i> Links to Other Websites</a></li>
                    <li><a href="#changes"><i class="fas fa-chevron-right"></i> Changes to This Privacy Policy</a></li>
                    <li><a href="#contact"><i class="fas fa-chevron-right"></i> Contact Us</a></li>
                </ul>
            </div>

            <!-- Interpretation and Definitions -->
            <div id="definitions" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-book"></i>
                    Interpretation and Definitions
                </h2>
                
                <h3 class="subsection-title">Interpretation</h3>
                <p>
                    The words with capitalized initial letters have meanings defined under the following conditions. 
                    These definitions shall have the same meaning regardless of whether they appear in singular or plural form.
                </p>

                <h3 class="subsection-title">Definitions</h3>
                <p>For the purposes of this Privacy Policy:</p>

                <div class="definition-list">
                    <div class="definition-item">
                        <div class="definition-term">Account</div>
                        <div class="definition-desc">
                            A unique account created for you to access our Service or parts of our Service.
                        </div>
                    </div>

                    <div class="definition-item">
                        <div class="definition-term">Affiliate</div>
                        <div class="definition-desc">
                            An entity that controls, is controlled by, or is under common control with a party, where "control" 
                            means ownership of 50% or more of the shares, equity interest, or other securities entitled to vote 
                            for election of directors or other managing authority.
                        </div>
                    </div>

                    <div class="definition-item">
                        <div class="definition-term">Company</div>
                        <div class="definition-desc">
                            Refers to Velo Crosshairs (referred to as either "the Company", "We", "Us" or "Our" in this Agreement).
                        </div>
                    </div>

                    <div class="definition-item">
                        <div class="definition-term">Cookies</div>
                        <div class="definition-desc">
                            Small files placed on your computer, mobile device, or any other device by a website, containing 
                            details of your browsing history on that website among its many uses.
                        </div>
                    </div>

                    <div class="definition-item">
                        <div class="definition-term">Country</div>
                        <div class="definition-desc">
                            Refers to Wyoming, United States.
                        </div>
                    </div>

                    <div class="definition-item">
                        <div class="definition-term">Device</div>
                        <div class="definition-desc">
                            Any device that can access the Service such as a computer, cell phone, or digital tablet.
                        </div>
                    </div>

                    <div class="definition-item">
                        <div class="definition-term">Personal Data</div>
                        <div class="definition-desc">
                            Any information that relates to an identified or identifiable individual.
                        </div>
                    </div>

                    <div class="definition-item">
                        <div class="definition-term">Service</div>
                        <div class="definition-desc">
                            Refers to the Website.
                        </div>
                    </div>

                    <div class="definition-item">
                        <div class="definition-term">Service Provider</div>
                        <div class="definition-desc">
                            Any natural or legal person who processes data on behalf of the Company to facilitate the Service, 
                            provide the Service on behalf of the Company, perform services related to the Service, or assist 
                            the Company in analyzing how the Service is used.
                        </div>
                    </div>

                    <div class="definition-item">
                        <div class="definition-term">Usage Data</div>
                        <div class="definition-desc">
                            Data collected automatically, either generated by the use of the Service or from the Service 
                            infrastructure itself (for example, the duration of a page visit).
                        </div>
                    </div>

                    <div class="definition-item">
                        <div class="definition-term">Website</div>
                        <div class="definition-desc">
                            Refers to Velo Crosshairs, accessible from <a href="https://velocrosshairs.com/" style="color: var(--primary-pink);">https://velocrosshairs.com/</a>
                        </div>
                    </div>

                    <div class="definition-item">
                        <div class="definition-term">You</div>
                        <div class="definition-desc">
                            The individual accessing or using the Service, or the company or other legal entity on behalf of 
                            which such individual is accessing or using the Service.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Collecting and Using Your Personal Data -->
            <div id="collecting-data" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-database"></i>
                    Collecting and Using Your Personal Data
                </h2>

                <h3 class="subsection-title">Types of Data Collected</h3>

                <h4 style="color: var(--primary-pink); margin: 1.5rem 0 0.75rem; font-weight: 600;">Personal Data</h4>
                <p>
                    While using our Service, we may ask you to provide us with certain personally identifiable information 
                    that can be used to contact or identify you. This may include, but is not limited to:
                </p>
                <ul>
                    <li>Email address</li>
                    <li>First name and last name</li>
                    <li>Usage Data</li>
                </ul>

                <h4 style="color: var(--primary-pink); margin: 1.5rem 0 0.75rem; font-weight: 600;">Usage Data</h4>
                <p>Usage Data is collected automatically when using the Service.</p>
                <p>
                    Usage Data may include information such as your Device's Internet Protocol address (IP address), 
                    browser type, browser version, the pages of our Service that you visit, the time and date of your 
                    visit, time spent on pages, unique device identifiers, and other diagnostic data.
                </p>
                <p>
                    When you access the Service through a mobile device, we may collect certain information automatically, 
                    including the type of mobile device, your mobile device's unique ID, IP address, mobile operating system, 
                    mobile Internet browser type, and other diagnostic data.
                </p>

                <h3 class="subsection-title">Tracking Technologies and Cookies</h3>
                <p>
                    We use Cookies and similar tracking technologies to track activity on our Service and store certain 
                    information. Technologies we use include:
                </p>
                <ul>
                    <li>
                        <strong>Cookies or Browser Cookies:</strong> A cookie is a small file placed on your Device. You can 
                        instruct your browser to refuse all Cookies or to indicate when a Cookie is being sent. However, if 
                        you do not accept Cookies, you may not be able to use some parts of our Service.
                    </li>
                    <li>
                        <strong>Web Beacons:</strong> Certain sections of our Service and emails may contain small electronic 
                        files known as web beacons (also referred to as clear gifs, pixel tags, and single-pixel gifs) that 
                        permit the Company to count users who have visited pages or opened emails and for other related website 
                        statistics.
                    </li>
                </ul>

                <div class="definition-list" style="margin-top: 1.5rem;">
                    <div class="definition-item">
                        <div class="definition-term">Necessary / Essential Cookies</div>
                        <div class="definition-desc">
                            <strong>Type:</strong> Session Cookies<br>
                            <strong>Purpose:</strong> Essential to provide you with services available through the Website and 
                            enable you to use some of its features. They help authenticate users and prevent fraudulent use of 
                            user accounts.
                        </div>
                    </div>

                    <div class="definition-item">
                        <div class="definition-term">Cookies Policy / Notice Acceptance Cookies</div>
                        <div class="definition-desc">
                            <strong>Type:</strong> Persistent Cookies<br>
                            <strong>Purpose:</strong> Identify if users have accepted the use of cookies on the Website.
                        </div>
                    </div>

                    <div class="definition-item">
                        <div class="definition-term">Functionality Cookies</div>
                        <div class="definition-desc">
                            <strong>Type:</strong> Persistent Cookies<br>
                            <strong>Purpose:</strong> Allow us to remember choices you make when you use the Website, such as 
                            remembering your login details or language preference, to provide you with a more personal experience.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Use of Your Personal Data -->
            <div id="use-of-data" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-tasks"></i>
                    Use of Your Personal Data
                </h2>
                <p>The Company may use Personal Data for the following purposes:</p>
                <ul>
                    <li>
                        <strong>To provide and maintain our Service:</strong> Including monitoring the usage of our Service.
                    </li>
                    <li>
                        <strong>To manage your Account:</strong> To manage your registration as a user of the Service and give 
                        you access to different functionalities.
                    </li>
                    <li>
                        <strong>For contract performance:</strong> The development, compliance, and undertaking of purchase 
                        contracts for products, items, or services you have purchased.
                    </li>
                    <li>
                        <strong>To contact you:</strong> By email, telephone calls, SMS, or other equivalent forms of electronic 
                        communication regarding updates or informative communications related to functionalities, products, or 
                        contracted services.
                    </li>
                    <li>
                        <strong>To provide you with news and offers:</strong> General information about other goods, services, 
                        and events which we offer that are similar to those you have already purchased or inquired about, unless 
                        you have opted not to receive such information.
                    </li>
                    <li>
                        <strong>To manage your requests:</strong> To attend and manage your requests to us.
                    </li>
                    <li>
                        <strong>For business transfers:</strong> We may use your information to evaluate or conduct a merger, 
                        divestiture, restructuring, reorganization, dissolution, or other sale or transfer of assets.
                    </li>
                    <li>
                        <strong>For other purposes:</strong> Such as data analysis, identifying usage trends, determining the 
                        effectiveness of promotional campaigns, and evaluating and improving our Service, products, services, 
                        marketing, and your experience.
                    </li>
                </ul>
            </div>

            <!-- Sharing Your Personal Information -->
            <div id="sharing-data" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-share-alt"></i>
                    Sharing Your Personal Information
                </h2>
                <p>We may share your personal information in the following situations:</p>
                <ul>
                    <li>
                        <strong>With Service Providers:</strong> To monitor and analyze the use of our Service and to contact you.
                    </li>
                    <li>
                        <strong>For business transfers:</strong> In connection with or during negotiations of any merger, sale of 
                        Company assets, financing, or acquisition.
                    </li>
                    <li>
                        <strong>With Affiliates:</strong> We may share your information with our affiliates, requiring them to 
                        honor this Privacy Policy.
                    </li>
                    <li>
                        <strong>With business partners:</strong> To offer you certain products, services, or promotions.
                    </li>
                    <li>
                        <strong>With other users:</strong> When you share personal information or interact in public areas, such 
                        information may be viewed by all users and publicly distributed.
                    </li>
                    <li>
                        <strong>With your consent:</strong> We may disclose your personal information for any other purpose with 
                        your consent.
                    </li>
                </ul>
            </div>

            <!-- Retention of Your Personal Data -->
            <div id="retention" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-clock"></i>
                    Retention of Your Personal Data
                </h2>
                <p>
                    The Company will retain your Personal Data only for as long as necessary for the purposes set out in this 
                    Privacy Policy. We will retain and use your Personal Data to comply with legal obligations, resolve disputes, 
                    and enforce our agreements and policies.
                </p>
                <p>
                    Usage Data is generally retained for a shorter period, except when used to strengthen security, improve 
                    functionality, or when legally obligated to retain it longer.
                </p>
            </div>

            <!-- Transfer of Your Personal Data -->
            <div id="transfer" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-exchange-alt"></i>
                    Transfer of Your Personal Data
                </h2>
                <p>
                    Your information, including Personal Data, is processed at the Company's operating offices and in any other 
                    places where parties involved in processing are located. This means information may be transferred to and 
                    maintained on computers located outside of your state, province, country, or other governmental jurisdiction 
                    where data protection laws may differ.
                </p>
                <p>
                    Your consent to this Privacy Policy followed by your submission of such information represents your agreement 
                    to that transfer.
                </p>
                <p>
                    The Company will take all steps reasonably necessary to ensure your data is treated securely and in accordance 
                    with this Privacy Policy. No transfer of your Personal Data will take place unless there are adequate controls 
                    in place including the security of your data.
                </p>
            </div>

            <!-- Delete Your Personal Data -->
            <div id="delete" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-trash-alt"></i>
                    Delete Your Personal Data
                </h2>
                <p>
                    You have the right to delete or request that we assist in deleting the Personal Data we have collected about you.
                </p>
                <p>
                    Our Service may give you the ability to delete certain information about you from within the Service. You may 
                    update, amend, or delete your information at any time by signing in to your Account (if you have one) and 
                    visiting the account settings section. You may also contact us to request access to, correct, or delete any 
                    personal information you have provided.
                </p>
                <p>
                    Please note that we may need to retain certain information when we have a legal obligation or lawful basis to do so.
                </p>
            </div>

            <!-- Disclosure of Your Personal Data -->
            <div id="disclosure" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-file-alt"></i>
                    Disclosure of Your Personal Data
                </h2>

                <h3 class="subsection-title">Business Transactions</h3>
                <p>
                    If the Company is involved in a merger, acquisition, or asset sale, your Personal Data may be transferred. 
                    We will provide notice before your Personal Data is transferred and becomes subject to a different Privacy Policy.
                </p>

                <h3 class="subsection-title">Law Enforcement</h3>
                <p>
                    Under certain circumstances, the Company may be required to disclose your Personal Data if required to do so 
                    by law or in response to valid requests by public authorities (e.g., a court or government agency).
                </p>

                <h3 class="subsection-title">Other Legal Requirements</h3>
                <p>The Company may disclose your Personal Data in the good faith belief that such action is necessary to:</p>
                <ul>
                    <li>Comply with a legal obligation</li>
                    <li>Protect and defend the rights or property of the Company</li>
                    <li>Prevent or investigate possible wrongdoing in connection with the Service</li>
                    <li>Protect the personal safety of users of the Service or the public</li>
                    <li>Protect against legal liability</li>
                </ul>
            </div>

            <!-- Security of Your Personal Data -->
            <div id="security" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-shield-alt"></i>
                    Security of Your Personal Data
                </h2>
                <p>
                    The security of your Personal Data is important to us, but remember that no method of transmission over the 
                    Internet or method of electronic storage is 100% secure. While we strive to use commercially reasonable means 
                    to protect your Personal Data, we cannot guarantee its absolute security.
                </p>
            </div>

            <!-- Children's Privacy -->
            <div id="children" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-child"></i>
                    Children's Privacy
                </h2>
                <p>
                    Our Service does not address anyone under the age of 13. We do not knowingly collect personally identifiable 
                    information from anyone under 13. If you are a parent or guardian and you are aware that your child has provided 
                    us with Personal Data, please contact us.
                </p>
                <p>
                    If we become aware that we have collected Personal Data from anyone under 13 without verification of parental 
                    consent, we take steps to remove that information from our servers.
                </p>
                <p>
                    If we need to rely on consent as a legal basis for processing your information and your country requires consent 
                    from a parent, we may require your parent's consent before we collect and use that information.
                </p>
            </div>

            <!-- Links to Other Websites -->
            <div id="links" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-link"></i>
                    Links to Other Websites
                </h2>
                <p>
                    Our Service may contain links to other websites that are not operated by us. If you click on a third-party link, 
                    you will be directed to that third party's site. We strongly advise you to review the Privacy Policy of every 
                    site you visit.
                </p>
                <p>
                    We have no control over and assume no responsibility for the content, privacy policies, or practices of any 
                    third-party sites or services.
                </p>
            </div>

            <!-- Changes to This Privacy Policy -->
            <div id="changes" class="policy-section">
                <h2 class="section-title">
                    <i class="fas fa-edit"></i>
                    Changes to This Privacy Policy
                </h2>
                <p>
                    We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new 
                    Privacy Policy on this page and updating the "Last updated" date at the top of this Privacy Policy.
                </p>
                <p>
                    We will let you know via email and/or a prominent notice on our Service, prior to the change becoming effective.
                </p>
                <p>
                    You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are 
                    effective when they are posted on this page.
                </p>
            </div>

            <!-- Contact Us -->
            <div id="contact" class="contact-section">
                <h3>Questions About This Privacy Policy?</h3>
                <p>
                    If you have any questions about this Privacy Policy, please don't hesitate to contact us.
                </p>
                <a href="mailto:contact@velocrosshairs.com" class="contact-email">
                    <i class="fas fa-envelope"></i>
                    contact
                </a>
            </div>

        </div>
    </div>
</section>

@endsection