<?php
/**
 * Header Component for Shivam Patsariya's Portfolio
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
  <title>Shivam Patsariya | UI/UX Designer & Digital Strategist | imShivam</title>
  <meta name="description" content="Explore the portfolio of Shivam Patsariya – a Toronto-based UI/UX Designer, Visual Strategist, and Content Creator. Expert in product design, branding, and web experiences for digital-first businesses.">
  <meta name="keywords" content="Shivam Patsariya, UI UX Designer Toronto, Visual Designer, Digital Product Designer, Portfolio, Personal Website, imShivam, Figma, Behance, Web Design, Freelance Designer">
  <meta name="author" content="Shivam Patsariya">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" href="images/logo-con.png" type="image/png">
    <link rel="apple-touch-icon" href="images/logo-con.png">
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Shivam Patsariya | UI/UX Designer & Digital Strategist" />
    <meta property="og:description" content="View the creative portfolio of Shivam Patsariya – Product Designer, Content Creator, and Visual Branding Expert." />
    <meta property="og:image" content="https://imshivam.com/images/land-2.png" />
    <meta property="og:url" content="https://imshivam.com/" />  
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Shivam Patsariya | UI/UX Designer & Digital Strategist" />
    <meta name="twitter:description" content="Portfolio of Shivam Patsariya – UI/UX Designer based in Toronto. Crafting intuitive digital experiences." />
    <meta name="twitter:image" content="https://imshivam.com/images/land-2.png" />
    <!-- Prioritize the lightweight hero portrait over the previous 6.7 MB GIF -->
    <link rel="preload" as="image" href="images/cutout-main.png" fetchpriority="high">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>
    <!-- hCaptcha loads near the contact form, not on the first screen. -->
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css?v=<?php echo filemtime(__DIR__ . '/../css/style.css'); ?>">
    <link rel="stylesheet" href="css/certifications.css?v=<?php echo filemtime(__DIR__ . '/../css/certifications.css'); ?>">

</head>
<body>
    <!-- Skip Navigation Link for Accessibility -->
    <a href="#main-content" class="skip-nav">Skip to main content</a>
    
    <header class="header site-header" role="banner">
        <div class="header-main">
            <div class="container">
                <div class="header-content">
                    <div class="header-brand">
                        <div class="logo">
                            <a href="/" aria-label="Shivam Patsariya, home">
                                <img src="images/logo-sp.png" alt="Shivam Patsariya" class="logo-img" width="150" height="42" decoding="async">
                            </a>
                        </div>
                        <div class="brand-context" aria-label="Designer, developer and writer">
                            <strong>DESIGN · BUILD · WRITE</strong>
                            <span>Independent work &amp; ideas</span>
                        </div>
                    </div>
                    <div class="header-actions">
                        <span class="header-availability"><span class="availability-dot" aria-hidden="true"></span>Open to opportunities</span>
                        <a href="#contact" class="header-contact">Let's talk <span aria-hidden="true">↗</span></a>
                        <a href="document/shivam_patsariya_resume_ux_designer.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-secondary header-resume">Resume <span aria-hidden="true">↗</span></a>
                    </div>
                    <button class="mobile-menu-btn" type="button" aria-label="Open navigation menu" aria-expanded="false" aria-controls="mobile-menu">
                        <span></span><span></span><span></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="header-nav-band">
            <div class="container">
                <div class="nav-band-inner">
                    <span class="nav-band-label">Explore / Portfolio</span>
                    <nav class="nav-menu" aria-label="Main navigation">
                        <ul>
                            <li><a href="#about"><span class="nav-index" aria-hidden="true">01</span>About</a></li>
                            <li><a href="#experience"><span class="nav-index" aria-hidden="true">02</span>Experience</a></li>
                            <li><a href="#skills"><span class="nav-index" aria-hidden="true">03</span>Skills</a></li>
                            <li><a href="#projects"><span class="nav-index" aria-hidden="true">04</span>Projects</a></li>
                            <li><a href="#certifications"><span class="nav-index" aria-hidden="true">05</span>Credentials</a></li>
                            <li><a href="#contact"><span class="nav-index" aria-hidden="true">06</span>Contact</a></li>
                        </ul>
                    </nav>
                    <a class="nav-band-shortcut" href="#projects">Selected work <span aria-hidden="true">↗</span></a>
                </div>
            </div>
        </div>
    </header>
    <nav class="mobile-menu" id="mobile-menu" role="navigation" aria-label="Mobile navigation" aria-hidden="true" inert>
        <ul>
            <li><a href="#about">About</a></li>
            <li><a href="#experience">Experience</a></li>
            <li><a href="#skills">Skills</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#certifications">Certifications</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="document/shivam_patsariya_resume_ux_designer.pdf" target="_blank">Resume</a></li>
        </ul>
    </nav>
    <main id="main-content" role="main">