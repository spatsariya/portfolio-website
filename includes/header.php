<?php
/**
 * Shared SEO metadata. Error pages can override these variables before including the header.
 * The homepage is the only indexable page in this single-page portfolio.
 */
$seoTitle = $seoTitle ?? 'Shivam Patsariya | UI/UX & Product Designer Portfolio';
$seoDescription = $seoDescription ?? 'Explore Shivam Patsariya’s UI/UX and product design portfolio, featuring mobile apps, websites, design systems, healthcare tools, and independent products.';
$seoRobots = $seoRobots ?? 'index, follow, max-image-preview:large';
$seoCanonical = $seoCanonical ?? 'https://imshivam.com/';
$seoIsHomepage = $seoIsHomepage ?? true;
$seoImage = 'https://imshivam.com/images/shivam-portrait.webp';
$seoTitleSafe = htmlspecialchars($seoTitle, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$seoDescriptionSafe = htmlspecialchars($seoDescription, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$seoRobotsSafe = htmlspecialchars($seoRobots, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title><?php echo $seoTitleSafe; ?></title>
    <meta name="description" content="<?php echo $seoDescriptionSafe; ?>">
    <meta name="robots" content="<?php echo $seoRobotsSafe; ?>">
    <meta name="author" content="Shivam Patsariya">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f4f1ea">
    <?php if ($seoIsHomepage): ?>
    <link rel="canonical" href="https://imshivam.com/">
    <?php endif; ?>
    <!-- Favicon -->
    <link rel="icon" href="images/shivam-sp-favicon.ico" sizes="any">
    <link rel="icon" href="images/shivam-sp-favicon.png" type="image/png" sizes="64x64">
    <link rel="apple-touch-icon" href="images/shivam-sp-touch.png" sizes="180x180">
    <?php if ($seoIsHomepage): ?>
    <!-- Social previews use the same canonical URL and the real hero portrait. -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Shivam Patsariya Portfolio">
    <meta property="og:locale" content="en_CA">
    <meta property="og:title" content="<?php echo $seoTitleSafe; ?>">
    <meta property="og:description" content="<?php echo $seoDescriptionSafe; ?>">
    <meta property="og:url" content="https://imshivam.com/">
    <meta property="og:image" content="https://imshivam.com/images/shivam-portrait.webp">
    <meta property="og:image:secure_url" content="https://imshivam.com/images/shivam-portrait.webp">
    <meta property="og:image:type" content="image/webp">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="1000">
    <meta property="og:image:alt" content="Portrait of UI/UX and product designer Shivam Patsariya">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?php echo $seoTitleSafe; ?>">
    <meta name="twitter:description" content="<?php echo $seoDescriptionSafe; ?>">
    <meta name="twitter:image" content="https://imshivam.com/images/shivam-portrait.webp">
    <meta name="twitter:image:alt" content="Portrait of Shivam Patsariya">
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Person",
      "@id": "https://imshivam.com/#person",
      "name": "Shivam Patsariya",
      "alternateName": "imShivam",
      "url": "https://imshivam.com/",
      "image": {
        "@type": "ImageObject",
        "url": "https://imshivam.com/images/shivam-portrait.webp",
        "width": 800,
        "height": 1000
      },
      "jobTitle": "UI/UX and Product Designer",
      "description": "UI/UX and visual designer with a background in computer science engineering and global business management.",
      "alumniOf": [
        {
          "@type": "CollegeOrUniversity",
          "name": "Jiwaji University"
        },
        {
          "@type": "CollegeOrUniversity",
          "name": "Fleming College"
        }
      ],
      "knowsAbout": [
        "Product design",
        "User experience design",
        "User interface design",
        "Visual design",
        "Design systems",
        "Prototyping",
        "Web design"
      ],
      "sameAs": [
        "https://www.linkedin.com/in/shivampatsariya/",
        "https://www.behance.net/shivampatsariya",
        "https://www.instagram.com/savvyshivam/",
        "https://github.com/spatsariya"
      ]
    },
    {
      "@type": "WebSite",
      "@id": "https://imshivam.com/#website",
      "url": "https://imshivam.com/",
      "name": "Shivam Patsariya Portfolio",
      "inLanguage": "en-CA",
      "publisher": {
        "@id": "https://imshivam.com/#person"
      }
    },
    {
      "@type": "WebPage",
      "@id": "https://imshivam.com/#webpage",
      "url": "https://imshivam.com/",
      "name": "Shivam Patsariya | UI/UX & Product Designer Portfolio",
      "description": "Explore the UX/UI and product design portfolio of Shivam Patsariya, featuring digital products, visual design and independent projects.",
      "inLanguage": "en-CA",
      "isPartOf": {
        "@id": "https://imshivam.com/#website"
      },
      "about": {
        "@id": "https://imshivam.com/#person"
      },
      "primaryImageOfPage": {
        "@type": "ImageObject",
        "url": "https://imshivam.com/images/shivam-portrait.webp",
        "width": 800,
        "height": 1000
      }
    }
  ]
}
    </script>
    <?php endif; ?>
    <!-- Prioritize the lightweight hero portrait over the previous 6.7 MB GIF -->
    <link rel="preload" as="image" href="images/shivam-portrait.webp" type="image/webp" fetchpriority="high">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>
    <!-- Contact form spam checks run on the server; no CAPTCHA script is needed. -->
    
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
                                <img src="images/shivam-logo-header.webp" alt="Shivam Patsariya, SP monogram and wordmark" class="logo-img" width="760" height="239" decoding="async">
                            </a>
                        </div>
                        <div class="brand-context" aria-label="Designer, developer and writer">
                            <strong>DESIGN · BUILD · WRITE</strong>
                            <span>Independent work &amp; ideas</span>
                        </div>
                    </div>
                    <div class="header-actions">
                        <span class="header-availability"><span class="availability-dot" aria-hidden="true"></span>Open to opportunities</span>
                        <a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#contact" class="header-contact">Let's talk <span aria-hidden="true">↗</span></a>
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
                            <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#about"><span class="nav-index" aria-hidden="true">01</span>About</a></li>
                            <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#experience"><span class="nav-index" aria-hidden="true">02</span>Experience</a></li>
                            <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#skills"><span class="nav-index" aria-hidden="true">03</span>Skills</a></li>
                            <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#projects"><span class="nav-index" aria-hidden="true">04</span>Projects</a></li>
                            <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#certifications"><span class="nav-index" aria-hidden="true">05</span>Credentials</a></li>
                            <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#contact"><span class="nav-index" aria-hidden="true">06</span>Contact</a></li>
                        </ul>
                    </nav>
                    <a class="nav-band-shortcut" href="<?php echo $seoIsHomepage ? '' : '/'; ?>#projects">Selected work <span aria-hidden="true">↗</span></a>
                </div>
            </div>
        </div>
    </header>
    <nav class="mobile-menu" id="mobile-menu" role="navigation" aria-label="Mobile navigation" aria-hidden="true" inert>
        <ul>
            <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#about">About</a></li>
            <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#experience">Experience</a></li>
            <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#skills">Skills</a></li>
            <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#projects">Projects</a></li>
            <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#certifications">Certifications</a></li>
            <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#contact">Contact</a></li>
            <li><a href="document/shivam_patsariya_resume_ux_designer.pdf" target="_blank">Resume</a></li>
        </ul>
    </nav>
    <main id="main-content" role="main">