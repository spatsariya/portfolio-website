<?php
/**
 * Shivam Patsariya Portfolio Website
 * A modern UX designer portfolio showcasing experience, skills, projects, and certifications
 */

// Include configuration file (not tracked in git)
if (file_exists('config.php')) {
    require_once 'config.php';
} else {
    // Fallback values for development/demo
    define('HCAPTCHA_SECRET', 'YOUR_HCAPTCHA_SECRET_KEY');
    define('HCAPTCHA_SITEKEY', '2b96e9ce-d828-41b8-99e6-718a9e145f74');
    define('CONTACT_EMAIL', 's.patsariya@gmail.com');
}

// Handle contact form submission
$form_success = false;
$form_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form'])) {
    // Validate form data
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? 'Contact Form Submission from Portfolio');
    $message = trim($_POST['message'] ?? '');
    $hcaptcha_response = $_POST['h-captcha-response'] ?? '';
    
    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        $form_error = 'Please fill all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $form_error = 'Please enter a valid email address.';
    } elseif (empty($hcaptcha_response)) {
        $form_error = 'Please complete the captcha verification.';
    } else {
        // Verify hCaptcha using config
        $hcaptcha_secret = HCAPTCHA_SECRET;
        $hcaptcha_verify_url = 'https://hcaptcha.com/siteverify';
        
        $hcaptcha_data = [
            'secret' => $hcaptcha_secret,
            'response' => $hcaptcha_response,
            'remoteip' => $_SERVER['REMOTE_ADDR'] ?? ''
        ];
        
        $hcaptcha_options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($hcaptcha_data)
            ]
        ];
        
        $hcaptcha_context = stream_context_create($hcaptcha_options);
        $hcaptcha_result = file_get_contents($hcaptcha_verify_url, false, $hcaptcha_context);
        $hcaptcha_response_data = json_decode($hcaptcha_result, true);
        
        if (!$hcaptcha_response_data['success']) {
            $form_error = 'Captcha verification failed. Please try again.';
        } else {
            // Sanitize inputs
            $name = htmlspecialchars($name);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $subject = htmlspecialchars($subject);
            $message = htmlspecialchars($message);
            
            // Prepare email content (same format as working mail-test)
            $to = CONTACT_EMAIL;
            $email_subject = "[Portfolio Contact] $subject";
            
            $email_content = "Contact Form Submission\n";
            $email_content .= "========================\n\n";
            $email_content .= "Name: $name\n";
            $email_content .= "Email: $email\n";
            $email_content .= "Subject: $subject\n";
            $email_content .= "Submitted: " . date('Y-m-d H:i:s') . "\n";
            $email_content .= "IP Address: " . ($_SERVER['REMOTE_ADDR'] ?? 'Unknown') . "\n\n";
            $email_content .= "Message:\n";
            $email_content .= "--------\n";
            $email_content .= "$message\n";
            $email_content .= "--------\n\n";
            $email_content .= "This message was sent from the portfolio contact form with hCaptcha verification.";
            
            // Set headers (same as working mail-test)
            $headers = "From: Portfolio Contact <no-reply@imshivam.com>\r\n";
            $headers .= "Reply-To: $name <$email>\r\n";
            $headers .= "X-Mailer: Portfolio Contact Form\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            
            // Send email using same method as mail-test
            if (mail($to, $email_subject, $email_content, $headers)) {
                $form_success = true;
            } else {
                $form_error = 'Sorry, there was an error sending your message. Please try again.';
            }
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<!-- Add the favicon link here -->
<link rel="icon" type="image/gif" href="images/fav-ico.gif">

<!-- Hero Section -->
<section id="hero" class="hero-section">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text" data-aos="fade-right" data-aos-duration="1000">
                <span class="hero-kicker">Product Design • UX Strategy • Visual Systems</span>
                <span class="hero-greeting">Hello, I'm Shivam.</span>
                <h1>Designing digital products that feel clear, credible, and ready to scale.</h1>
                <h2>UI/UX Designer & Creative Innovator with 10+ years building user-centered experiences.</h2>
                <p class="hero-description">Transforming ideas into exceptional digital experiences that bridge user needs and business goals. With a focus on human-centered design, I craft intuitive interfaces that drive engagement, enhance satisfaction, and deliver measurable results.</p>
                <div class="hero-proof-list" aria-label="Professional highlights">
                    <span>Based in Ontario, Canada</span>
                    <span>Available for freelance & full-time roles</span>
                    <span>Product, mobile, web, and brand experience</span>
                </div>
                <div class="hero-cta">
                    <a href="#projects" class="btn btn-primary">View My Work</a>
                    <a href="#contact" class="btn btn-secondary">Let's Connect</a>
                </div>
                <div class="hero-social-links">
                    <a href="https://www.linkedin.com/in/shivampatsariya/" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin" style="width: 20px; height: 20px;"></i></a>
                    <!-- <a href="#" target="_blank" aria-label="Dribbble"><i class="fab fa-dribbble" style="width: 20px; height: 20px;"></i></a> -->
                    <a href="https://www.behance.net/shivampatsariya" target="_blank" aria-label="Behance"><i class="fab fa-behance" style="width: 20px; height: 20px;"></i></a>
                </div>
            </div>
            <div class="hero-image" data-aos="fade-left" data-aos-duration="1000">
                <div class="hero-portrait-card">
                    <div class="image-cutout">
                        <img src="images/waving-shivam.gif" alt="Shivam Patsariya waving - UI/UX Designer">
                    </div>
                    <div class="hero-card-details">
                        <div>
                            <p class="hero-card-label">Currently focused on</p>
                            <strong>Product design, UX research, design systems, and growth-oriented digital experiences.</strong>
                        </div>
                        <div>
                            <p class="hero-card-label">Open to</p>
                            <strong>Senior product design, UX leadership, and consulting opportunities.</strong>
                        </div>
                    </div>
                </div>
                <div class="hero-stats-highlight">
                    <div class="stat-highlight">
                        <span class="stat-number" data-count="10">10+</span>
                        <span class="stat-label">Years Experience</span>
                    </div>
                    <div class="stat-highlight">
                        <span class="stat-number" data-count="50">50</span>
                        <span class="stat-label">Projects Delivered</span>
                    </div>
                    <div class="stat-highlight">
                        <span class="stat-number" data-count="15">15</span>
                        <span class="stat-label">Happy Clients</span>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="hero-scroll">
        <a href="#about">
            <span>Discover More</span>
            <i class="fas fa-chevron-down" style="width: 16px; height: 16px;"></i>
        </a>
    </div>
</section>   



<!-- About Section -->
<section id="about" class="about-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>About Me</h2>
            <div class="section-line"></div>
        </div>
        <div class="about-content">
            <div class="about-text" data-aos="fade-right" data-aos-delay="100">
                <p>I am a versatile professional with expertise in Management, Engineering, and Design. As a UI/UX and Visual Design Specialist, I create human-centered digital experiences that solve real problems and help businesses connect with their audience through intuitive and engaging products.</p>
                <p>My design approach combines analytical thinking with creative vision, resulting in experiences that are both functional and delightful. I believe that great design should be invisible, allowing users to achieve their goals effortlessly.</p>
                <p>Beyond design, I develop radiology learning tools and AI-powered experiences, create digital products, and write fiction. My work includes Radiology without Tears, RWT Smart AI, Radiology Resident, Subscription Manager, IAuthiq, and Kinfolk.</p>
                <div class="about-details">
                    <div class="detail-item">
                        <span class="detail-label">Name:</span>
                        <span class="detail-value">Shivam Patsariya</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Email:</span>
                        <span class="detail-value">contact@imshivam.com</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Location:</span>
                        <span class="detail-value">East York, Ontario, Canada</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Languages:</span>
                        <span class="detail-value">English (Native), Hindi (Native)</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Availability:</span>
                        <span class="detail-value">Available for new opportunities</span>
                    </div>
                </div>
                <a href="document/shivam_patsariya_resume_ux_designer.pdf" target="_blank" class="btn btn-primary download-cv">Get a copy of Resume <i class="fas fa-download" style="width: 16px; height: 16px;"></i></a>
            </div>
            <div class="about-stats" data-aos="fade-left" data-aos-delay="100">
                <div class="stat-item">
                    <div class="stat-number" data-count="50">50+</div>
                    <div class="stat-text">Projects<br>Completed</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-count="10">10+</div>
                    <div class="stat-text">Years of<br>Experience</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-count="15">15+</div>
                    <div class="stat-text">Happy<br>Clients</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-count="4000">4000+</div>
                    <div class="stat-text">LinkedIn<br>Followers</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Beyond the canvas: editorial showcase -->
<section id="highlights" class="highlights-section" aria-labelledby="highlights-heading">
<style>
.highlights-section{--ink:#202822;--muted:#5c625b;--line:#d9d9cf;background:#f6f5ef;color:var(--ink);padding:clamp(76px,9vw,132px) 0}
.highlights-section .container{max-width:1200px}
.highlights-section .highlights-heading{display:grid;grid-template-columns:minmax(0,1.2fr) minmax(250px,.65fr);gap:clamp(22px,6vw,90px);align-items:end;margin-bottom:clamp(35px,5vw,64px)}
.highlights-section .highlights-kicker{display:inline-block;font-size:.76rem;letter-spacing:.16em;text-transform:uppercase;font-weight:700;color:#5d6a5d;margin-bottom:20px}
.highlights-section .highlights-heading h2{font-size:clamp(2.6rem,6.3vw,6.2rem);font-weight:650;line-height:.99;letter-spacing:-.065em;margin:0;color:var(--ink);max-width:850px}
.highlights-section .highlights-heading h2 em{font-family:Georgia,'Times New Roman',serif;font-weight:400;letter-spacing:-.07em}
.highlights-section .highlights-heading p{font-size:clamp(.98rem,1.4vw,1.13rem);line-height:1.65;color:var(--muted);max-width:350px;margin:0 0 7px}
.highlights-section .highlights-grid{display:grid;grid-template-columns:1fr 1fr;grid-template-areas:"product product" "learning books";gap:18px}
.highlights-section .highlight-story{min-width:0;border:1px solid var(--line);position:relative;overflow:hidden;background:#eeeee6}
.highlights-section .highlight-story--product{grid-area:product;background:#e6e9df;display:grid;grid-template-columns:minmax(0,.85fr) minmax(0,1.15fr);min-height:460px}
.highlights-section .highlight-story--learning{grid-area:learning;background:#e8e9e4}
.highlights-section .highlight-story--books{grid-area:books;background:#e9e0d8}
.highlights-section .story-content{position:relative;z-index:1;padding:clamp(26px,4vw,54px)}
.highlights-section .story-meta{display:flex;justify-content:space-between;align-items:center;gap:16px;font-size:.72rem;letter-spacing:.13em;text-transform:uppercase;font-weight:750;color:#555f55;margin-bottom:clamp(24px,4vw,46px)}
.highlights-section .highlight-story h3{font-size:clamp(2rem,3.5vw,3.65rem);font-weight:630;letter-spacing:-.057em;line-height:1.06;margin:0 0 16px;color:#202822}
.highlights-section .highlight-story p{font-size:1rem;line-height:1.7;color:#4c554d;margin:0 0 25px;max-width:420px}
.highlights-section .story-link{display:inline-flex;align-items:center;gap:10px;color:#243b2e;font-size:.91rem;font-weight:750;text-decoration:none;border-bottom:1px solid currentColor;padding-bottom:5px;transition:gap .2s ease}
.highlights-section .story-link:hover{gap:17px}
.highlights-section a:focus-visible{outline:3px solid #2b5f43;outline-offset:5px}
.highlights-section .product-stage{padding:36px clamp(26px,4vw,54px);display:flex;flex-direction:column;justify-content:center;gap:12px;position:relative}
.highlights-section .product-stage:before{content:"";position:absolute;inset:12% 12% 7% 4%;border:1px solid rgba(55,79,58,.17);border-radius:50%;transform:rotate(-18deg);pointer-events:none}
.highlights-section .product-feature{position:relative;background:#fcfcf8;border:1px solid #c6cbc0;padding:23px 26px;min-height:142px;box-shadow:12px 14px 0 rgba(45,64,46,.08);display:flex;flex-direction:column;justify-content:space-between;color:#233c2d;text-decoration:none;transition:transform .25s ease,box-shadow .25s ease}
.highlights-section .product-feature .small-label{font-size:.7rem;text-transform:uppercase;letter-spacing:.13em;color:#737d73;font-weight:700}
.highlights-section .product-feature strong{display:block;font-size:clamp(1.35rem,2.4vw,2.3rem);font-weight:650;letter-spacing:-.045em;line-height:1.1;color:#233c2d}
.highlights-section .product-feature .visit{font-size:.84rem;font-weight:700;color:#245e42;align-self:flex-end}
.highlights-section .product-feature:hover{transform:translateY(-3px);box-shadow:12px 18px 0 rgba(45,64,46,.1)}
.highlights-section .product-subgrid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:10px;position:relative}
.highlights-section .product-mini{background:#294438;color:#f4f5eb;padding:20px 18px;min-height:122px;display:flex;flex-direction:column;justify-content:space-between;gap:15px;text-decoration:none;transition:transform .2s ease,filter .2s ease}
.highlights-section .product-mini:nth-child(2){background:#c8d1bf;color:#24392b}
.highlights-section .product-mini:nth-child(3){background:#d8dfd2;color:#24392b}
.highlights-section .product-mini:hover{transform:translateY(-3px);filter:brightness(1.04)}
.highlights-section .product-mini span{font-size:.65rem;text-transform:uppercase;letter-spacing:.1em;opacity:.8}
.highlights-section .product-mini strong{font-size:clamp(.9rem,1.25vw,1.1rem);line-height:1.2;letter-spacing:-.025em}
.highlights-section .product-mini .mini-arrow{align-self:flex-end;font-size:1rem;font-weight:700}
.highlights-section .highlight-story--learning .story-meta,.highlights-section .highlight-story--books .story-meta{margin-bottom:27px}
.highlights-section .highlight-story--learning .story-content,.highlights-section .highlight-story--books .story-content{padding-bottom:18px}
.highlights-section .highlight-story--learning h3,.highlights-section .highlight-story--books h3{font-size:clamp(1.95rem,3vw,3rem)}
.highlights-section .health-projects{display:grid;gap:12px;margin:8px clamp(26px,4vw,54px) clamp(26px,4vw,54px)}
.highlights-section .health-project{display:flex;align-items:center;justify-content:space-between;gap:20px;border:1px solid #c9cfc7;background:#f5f6f0;padding:20px 22px;min-height:107px;color:#213c32;text-decoration:none;transition:background .2s ease,transform .2s ease}
.highlights-section .health-project:nth-child(2){background:#d9e1d8}
.highlights-section .health-project:hover{background:#fff;transform:translateX(3px)}
.highlights-section .health-project small{font-size:.67rem;letter-spacing:.1em;text-transform:uppercase;color:#647369;font-weight:700}
.highlights-section .health-project strong{display:block;font-size:clamp(1rem,1.5vw,1.26rem);margin-top:7px;line-height:1.25;letter-spacing:-.03em}
.highlights-section .health-project .health-arrow{font-size:1.4rem;flex:none}
.highlights-section .book-display{display:flex;align-items:end;justify-content:center;gap:clamp(13px,3vw,30px);padding:18px 26px clamp(38px,4vw,58px);min-height:315px}
.highlights-section .book-cover{display:block;position:relative;width:clamp(128px,36%,192px);aspect-ratio: .62;box-shadow:9px 14px 18px rgba(61,43,35,.17);transform:rotate(-6deg);background:#24303a;color:#f7ead9;text-decoration:none;overflow:hidden;transition:transform .25s ease,box-shadow .25s ease}
.highlights-section .book-cover:nth-child(2){background:#201631;transform:translateY(-13px) rotate(6deg)}
.highlights-section .book-cover:hover{transform:translateY(-10px) rotate(-3deg);box-shadow:13px 19px 25px rgba(61,43,35,.22)}
.highlights-section .book-cover:nth-child(2):hover{transform:translateY(-22px) rotate(3deg)}
.highlights-section .book-cover img{width:100%;height:100%;object-fit:cover;display:block;position:relative;z-index:2}
.highlights-section .book-cover .cover-fallback{position:absolute;inset:0;display:flex;flex-direction:column;justify-content:center;padding:16px;font:1.25rem/1.2 Georgia,'Times New Roman',serif;text-align:center;z-index:1}
.highlights-section .books-note{text-align:center;font-size:.82rem;color:#665b54;margin:-22px 26px 28px}
@media(max-width:900px){.highlights-section .highlights-heading{grid-template-columns:1fr;gap:22px}.highlights-section .highlight-story--product{grid-template-columns:1fr}.highlights-section .product-stage{padding-top:8px;padding-bottom:42px}.highlights-section .highlights-heading h2{max-width:700px}}
@media(max-width:680px){.highlights-section .highlights-grid{grid-template-columns:1fr;grid-template-areas:"product" "learning" "books";gap:14px}.highlights-section .highlight-story--product{min-height:0}.highlights-section .story-meta{margin-bottom:30px}.highlights-section .highlight-story h3{font-size:clamp(2rem,9vw,3.3rem)}.highlights-section .product-stage{padding:0 26px 34px}.highlights-section .product-feature{min-height:132px}.highlights-section .product-subgrid{grid-template-columns:repeat(2,minmax(0,1fr))}.highlights-section .product-mini{padding:16px;min-height:100px}.highlights-section .book-display{min-height:260px}}
@media(max-width:390px){.highlights-section .product-subgrid{grid-template-columns:1fr}.highlights-section .product-mini{min-height:78px}}
@media(prefers-reduced-motion:reduce){.highlights-section .story-link,.highlights-section .product-feature,.highlights-section .product-mini,.highlights-section .health-project,.highlights-section .book-cover{transition:none}}
</style>
<div class="container">
    <header class="highlights-heading">
        <div>
            <span class="highlights-kicker">A little more about what I do / 2026</span>
            <h2 id="highlights-heading">I make things <em>beyond</em> interfaces.</h2>
        </div>
        <p>Some things I design. Some I build from scratch. Others I write. Here's the work that doesn't fit neatly into a job title.</p>
    </header>
    <div class="highlights-grid">
        <article class="highlight-story highlight-story--product">
            <div class="story-content">
                <div class="story-meta"><span>01 / Independent products</span><span>Built & shipped</span></div>
                <h3>Ideas are better when they're real.</h3>
                <p>Side projects have a way of becoming real products. These are a few I've been building, from everyday utilities to tools for specific communities.</p>
                <a class="story-link" href="https://subscriptionmanager.app/" target="_blank" rel="noopener noreferrer">Explore Subscription Manager <span aria-hidden="true">↗</span></a>
            </div>
            <div class="product-stage" aria-label="Independent products">
                <a class="product-feature" href="https://subscriptionmanager.app/" target="_blank" rel="noopener noreferrer" aria-label="Subscription Manager, opens in a new tab">
                    <span class="small-label">01 — Featured product / Subscription tracking</span>
                    <strong>Subscription<br>Manager</strong>
                    <span class="visit">Visit product ↗</span>
                </a>
                <div class="product-subgrid">
                    <a class="product-mini" href="https://spatsariya.github.io/whatsapp-tools/#download" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp Tools, opens in a new tab"><span>02 — Desktop tools</span><strong>WhatsApp Tools</strong><span class="mini-arrow" aria-hidden="true">↗</span></a>
                    <a class="product-mini" href="https://www.iauthiq.com/" target="_blank" rel="noopener noreferrer" aria-label="IAuthiq, opens in a new tab"><span>03 — Identity</span><strong>IAuthiq</strong><span class="mini-arrow" aria-hidden="true">↗</span></a>
                    <a class="product-mini" href="https://kinfolk.sbs/" target="_blank" rel="noopener noreferrer" aria-label="Kinfolk, opens in a new tab"><span>04 — Family & community</span><strong>Kinfolk</strong><span class="mini-arrow" aria-hidden="true">↗</span></a>
                </div>
            </div>
        </article>
        <article class="highlight-story highlight-story--learning">
            <div class="story-content">
                <div class="story-meta"><span>02 / Healthcare education</span><span>Digital tools</span></div>
                <h3>Learning shouldn't feel like decoding.</h3>
                <p>Healthcare projects focused on making radiology learning and communication clearer and easier to access.</p>
            </div>
            <div class="health-projects" aria-label="Healthcare projects">
                <a class="health-project" href="https://rwtradiology.com/" target="_blank" rel="noopener noreferrer" aria-label="Radiology without Tears, opens in a new tab"><span><small>01 / Radiology education</small><strong>Radiology without Tears</strong></span><span class="health-arrow" aria-hidden="true">↗</span></a>
                <a class="health-project" href="https://radverba.com/" target="_blank" rel="noopener noreferrer" aria-label="RadVerba, opens in a new tab"><span><small>02 / Healthcare technology</small><strong>RadVerba</strong></span><span class="health-arrow" aria-hidden="true">↗</span></a>
            </div>
        </article>
        <article class="highlight-story highlight-story--books">
            <div class="story-content">
                <div class="story-meta"><span>03 / Writing</span><span>Published books</span></div>
                <h3>Some ideas need words, not pixels.</h3>
                <p>Outside the screen, I write stories about imagination, emotion, and everything that makes us human.</p>
            </div>
            <div class="book-display" aria-label="Published books by Shivam Patsariya">
                <a class="book-cover" href="https://www.amazon.in/-/hi/Shivam-Patsariya-ebook/dp/B0GX2YP4PL" target="_blank" rel="noopener noreferrer" aria-label="The Blueprint of Broken Things, view on Amazon (opens in a new tab)">
                    <span class="cover-fallback">The Blueprint of Broken Things</span>
                    <img src="https://m.media-amazon.com/images/P/B0GX2YP4PL.01._SCLZZZZZZZ_SX500_.jpg" alt="Cover of The Blueprint of Broken Things by Shivam Patsariya" loading="lazy" width="313" height="522" onerror="this.remove()">
                </a>
                <a class="book-cover" href="https://www.amazon.in/Shivam-Patsariya-ebook/dp/B0GXTR8545?ref_=ast_author_dp&amp;th=1&amp;psc=1" target="_blank" rel="noopener noreferrer" aria-label="Realm of Imagination, view on Amazon (opens in a new tab)">
                    <span class="cover-fallback">Realm of Imagination</span>
                    <img src="https://m.media-amazon.com/images/P/B0GXTR8545.01._SCLZZZZZZZ_SX500_.jpg" alt="Cover of Realm of Imagination by Shivam Patsariya" loading="lazy" width="326" height="522" onerror="this.remove()">
                </a>
            </div>
            <p class="books-note">Select a cover to view the book on Amazon ↗</p>
        </article>
    </div>
</div>
</section>

<!-- Projects Section: curated screenshots + honest project index -->
<section id="projects" class="projects-section" aria-labelledby="projects-heading">
<style>
/* Editorial selected work: scoped to this section so the rest of the site is unchanged. */
.projects-section{background:#f6f5ef;color:#202822;border-top:1px solid #e6e2d9}
.projects-section .container{max-width:1200px}
.projects-section .work-head{display:grid;grid-template-columns:minmax(0,1.2fr) minmax(270px,.7fr);align-items:end;gap:42px;margin-bottom:34px}
.projects-section .work-kicker,.projects-section .work-label{display:block;color:#566558;font-weight:700;letter-spacing:.14em;text-transform:uppercase;font-size:.75rem}
.projects-section .work-kicker{margin-bottom:17px}
.projects-section .work-head h2{color:#202822;font-size:clamp(3rem,6vw,5.6rem);line-height:1.02;letter-spacing:-.065em;font-weight:650;margin:0}
.projects-section .work-head p{color:#626a61;font-size:1.06rem;line-height:1.65;max-width:370px;margin:0 0 7px}
.projects-section .projects-filter{display:flex;justify-content:flex-start;align-items:center;gap:9px;margin:0 0 20px;flex-wrap:wrap}
.projects-section .projects-filter .filter-btn{border-radius:6px;background:transparent;color:#5a665e;border:1px solid #d1d6cb;font-size:.87rem;font-weight:650;padding:9px 16px;min-height:44px;transition:background .18s ease,color .18s ease,border-color .18s ease}
.projects-section .projects-filter .filter-btn:hover,.projects-section .projects-filter .filter-btn.active{background:#243e31;border-color:#243e31;color:#fff}
.projects-section .filter-btn:focus-visible,.projects-section a:focus-visible,.projects-section summary:focus-visible{outline:3px solid #37694a;outline-offset:4px}
.projects-section .projects-count{font-size:.87rem;color:#667064;min-height:1.4em;margin-bottom:42px}
.projects-section .work-label{margin-bottom:18px}
.projects-section .projects-grid{display:grid;grid-template-columns:repeat(6,minmax(0,1fr));gap:18px;margin-bottom:42px}
.projects-section .project-item[hidden],.projects-section #featured-projects[hidden],.projects-section #more-projects[hidden]{display:none!important}
.projects-section .project-item{border:0;border-radius:0;box-shadow:none;cursor:default;min-width:0}
.projects-section .work-card{grid-column:span 2;background:#fff;border:1px solid #d9dcd2;display:flex;flex-direction:column;overflow:hidden;transition:box-shadow .2s ease,transform .2s ease}
.projects-section .work-card:hover{transform:translateY(-3px);box-shadow:0 15px 35px rgba(22,37,28,.08)}
.projects-section .work-card--lead{grid-column:1/-1;display:grid;grid-template-columns:minmax(0,1.15fr) minmax(0,.85fr);background:#e2e9df}
.projects-section .work-media{display:block;position:relative;overflow:hidden;aspect-ratio:16/10;background:#d5ded5}
.projects-section .work-card--lead .work-media{height:100%;min-height:390px;aspect-ratio:auto}
.projects-section .work-media img{display:block;width:100%;height:100%;object-fit:cover;transition:transform .35s ease;position:absolute;inset:0}
.projects-section .work-card:hover .work-media img{transform:scale(1.035)}
.projects-section .work-copy{padding:24px 25px 26px;display:flex;flex-direction:column;align-items:flex-start;flex:1}
.projects-section .work-card--lead .work-copy{padding:clamp(32px,4.8vw,61px);justify-content:center}
.projects-section .work-category{display:block;font-size:.72rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#596b5c;margin-bottom:22px}
.projects-section .work-card h3{font-size:clamp(1.4rem,2.2vw,1.95rem);letter-spacing:-.045em;line-height:1.12;color:#23352a;margin:0 0 13px}
.projects-section .work-card--lead h3{font-size:clamp(2.3rem,4.2vw,4rem);line-height:1.02;margin-bottom:18px}
.projects-section .work-card p{font-size:.97rem;line-height:1.62;color:#667167;margin:0 0 27px}
.projects-section .work-card--lead p{font-size:1.05rem;max-width:330px}
.projects-section .work-action{margin-top:auto;color:#264b37;border-bottom:1px solid #264b37;text-decoration:none;padding-bottom:5px;font-size:.9rem;font-weight:700;display:inline-flex;gap:12px;transition:gap .2s ease}
.projects-section .work-action:hover{gap:18px}
.projects-section .project-more{border-top:1px solid #cdd2c8;padding-top:28px}
.projects-section .project-more summary{list-style:none;display:flex;align-items:center;justify-content:space-between;gap:18px;cursor:pointer;min-height:56px;padding:4px 0 17px;color:#273b2e;font-weight:650;font-size:clamp(1.1rem,2.1vw,1.5rem);letter-spacing:-.03em}
.projects-section .project-more summary::-webkit-details-marker{display:none}
.projects-section .project-more summary .more-label{display:flex;align-items:center;gap:19px;flex-wrap:wrap}
.projects-section .project-more summary .more-kicker{font-size:.69rem;font-weight:750;letter-spacing:.14em;text-transform:uppercase;color:#718073}
.projects-section .project-more summary .more-toggle{border:1px solid #c9d0c7;border-radius:50%;width:38px;height:38px;display:grid;place-items:center;flex:none;font-size:1.2rem;transition:transform .2s ease}
.projects-section .project-more[open] summary .more-toggle{transform:rotate(45deg)}
.projects-section .project-index{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:0 26px;padding:18px 0 0}
.projects-section .index-entry{display:grid;grid-template-columns:42px minmax(0,1fr) auto;gap:12px;align-items:center;padding:19px 0;border-bottom:1px solid #d7dbd2;background:transparent;color:#253a2d;min-width:0}
.projects-section .index-entry:hover{transform:none;box-shadow:none}
.projects-section .index-number{font-size:.75rem;color:#849084;font-weight:750;align-self:start;padding-top:5px}
.projects-section .index-entry h3{font-size:1.12rem;letter-spacing:-.03em;line-height:1.25;margin:0 0 6px;color:#26382c;font-weight:680}
.projects-section .index-entry p{font-size:.82rem;color:#657065;margin:0}
.projects-section .index-link{font-size:.8rem;white-space:nowrap;color:#285641;text-decoration:none;border-bottom:1px solid #aebfaf;padding-bottom:3px;font-weight:700}
.projects-section .index-link:hover{border-color:#285641}
@media(max-width:990px){.projects-section .work-head{grid-template-columns:1fr;gap:18px}.projects-section .work-card{grid-column:span 3}.projects-section .work-card--lead{grid-column:1/-1}.projects-section .project-index{grid-template-columns:1fr}}
@media(max-width:700px){.projects-section .work-head{margin-bottom:29px}.projects-section .work-head h2{font-size:clamp(2.7rem,13vw,4.3rem)}.projects-section .projects-count{margin-bottom:30px}.projects-section .projects-grid{gap:14px}.projects-section .work-card,.projects-section .work-card--lead{grid-column:1/-1;display:flex}.projects-section .work-card--lead .work-media{height:auto;min-height:0;aspect-ratio:16/10}.projects-section .work-card--lead .work-copy{padding:27px}.projects-section .work-card--lead h3{font-size:2.45rem}.projects-section .work-copy{padding:23px}.projects-section .index-entry{grid-template-columns:28px minmax(0,1fr);gap:9px}.projects-section .index-link{grid-column:2;justify-self:start}.projects-section .project-more summary .more-label{gap:8px}}
@media(prefers-reduced-motion:reduce){.projects-section .work-card,.projects-section .work-media img,.projects-section .work-action,.projects-section .project-more summary .more-toggle{transition:none}}
</style>
    <div class="container">
        <header class="work-head">
            <div>
                <span class="work-kicker">Portfolio / 16 projects</span>
                <h2 id="projects-heading">Selected work.</h2>
            </div>
            <p>A selection of mobile products, publishing platforms, and nonprofit websites. Explore the featured work or browse the full project index.</p>
        </header>
        <div class="projects-filter" role="group" aria-label="Filter projects by category">
            <button class="filter-btn active" type="button" data-filter="all" aria-pressed="true">All <span aria-hidden="true">/ 16</span></button>
            <button class="filter-btn" type="button" data-filter="mobile" aria-pressed="false">Mobile apps</button>
            <button class="filter-btn" type="button" data-filter="web" aria-pressed="false">Websites</button>
            <button class="filter-btn" type="button" data-filter="branding" aria-pressed="false">Branding</button>
        </div>
        <p class="projects-count" id="projects-count" role="status" aria-live="polite">4 featured projects · 12 more to explore</p>
        <div id="featured-projects">
            <span class="work-label">01 / Featured projects</span>
            <div class="projects-grid">

            <article class="project-item work-card work-card--lead" data-category="mobile">
                <a class="work-media" href="https://www.figma.com/proto/QF4Mrfc8NR1oupQOVrri75/Shivam-Patsariya---Portfolio?page-id=12%3A68&amp;node-id=13-83&amp;starting-point-node-id=13%3A83&amp;t=URGumBC1RI91aJOu-1" target="_blank" rel="noopener noreferrer" aria-label="View Virgin Plus My Benefits project (opens in a new tab)">
                    <img src="images/content/virgin-plus.webp" alt="Virgin Plus My Benefits app interface and rewards screens" loading="lazy">
                </a>
                <div class="work-copy">
                    <span class="work-category">01 / Mobile experience · UX design</span>
                    <h3>Virgin Plus My Benefits</h3>
                    <p>A rewards experience designed around everyday benefits, clear navigation, and easier discovery.</p>
                    <a class="work-action" href="https://www.figma.com/proto/QF4Mrfc8NR1oupQOVrri75/Shivam-Patsariya---Portfolio?page-id=12%3A68&amp;node-id=13-83&amp;starting-point-node-id=13%3A83&amp;t=URGumBC1RI91aJOu-1" target="_blank" rel="noopener noreferrer">View project <span aria-hidden="true">↗</span></a>
                </div>
            </article>

            <article class="project-item work-card" data-category="web">
                <a class="work-media" href="https://www.instiwitty.com/" target="_blank" rel="noopener noreferrer" aria-label="View InstiWitty project (opens in a new tab)">
                    <img src="images/content/instiwitty-blog.webp" alt="InstiWitty publishing platform website shown on desktop" loading="lazy">
                </a>
                <div class="work-copy">
                    <span class="work-category">02 / Publishing platform · Web</span>
                    <h3>InstiWitty</h3>
                    <p>A content platform built for people who read, write, and share stories.</p>
                    <a class="work-action" href="https://www.instiwitty.com/" target="_blank" rel="noopener noreferrer">View project <span aria-hidden="true">↗</span></a>
                </div>
            </article>

            <article class="project-item work-card" data-category="web">
                <a class="work-media" href="https://www.beingshivam.com/" target="_blank" rel="noopener noreferrer" aria-label="View BeingShivam Online project (opens in a new tab)">
                    <img src="images/content/beingshivam-blog.webp" alt="BeingShivam Online technology blog homepage" loading="lazy">
                </a>
                <div class="work-copy">
                    <span class="work-category">03 / Personal publishing · Web</span>
                    <h3>BeingShivam Online</h3>
                    <p>An independent technology blog, with content and discovery at its core.</p>
                    <a class="work-action" href="https://www.beingshivam.com/" target="_blank" rel="noopener noreferrer">View project <span aria-hidden="true">↗</span></a>
                </div>
            </article>

            <article class="project-item work-card" data-category="web">
                <a class="work-media" href="https://www.aashayenfoundation.org/" target="_blank" rel="noopener noreferrer" aria-label="View Aashayen Foundation project (opens in a new tab)">
                    <img src="images/content/aafdn.webp" alt="Aashayen Foundation nonprofit website homepage" loading="lazy">
                </a>
                <div class="work-copy">
                    <span class="work-category">04 / Nonprofit · Web design</span>
                    <h3>Aashayen Foundation</h3>
                    <p>A web presence for a nonprofit, with a clear focus on its mission and community.</p>
                    <a class="work-action" href="https://www.aashayenfoundation.org/" target="_blank" rel="noopener noreferrer">View project <span aria-hidden="true">↗</span></a>
                </div>
            </article>
            </div>
        </div>
        <details class="project-more" id="more-projects">
            <summary>
                <span class="more-label"><span class="more-kicker">02 / Project index</span><span id="more-projects-label">Explore 12 more projects</span></span>
                <span class="more-toggle" aria-hidden="true">+</span>
            </summary>
            <div class="project-index">

            <article class="project-item index-entry" data-category="mobile">
                <span class="index-number">05</span>
                <div><h3>rCycle</h3><p>Sustainability · Mobile app</p></div>
                <a class="index-link" href="#contact">Request details <span aria-hidden="true">→</span></a>
            </article>

            <article class="project-item index-entry" data-category="mobile">
                <span class="index-number">06</span>
                <div><h3>Radiology without Tears</h3><p>Healthcare learning · Mobile</p></div>
                <a class="index-link" href="https://rwtradiology.com/" target="_blank" rel="noopener noreferrer">Visit website <span aria-hidden="true">↗</span></a>
            </article>

            <article class="project-item index-entry" data-category="mobile">
                <span class="index-number">07</span>
                <div><h3>Radiology Resident</h3><p>Medical education · Mobile</p></div>
                <a class="index-link" href="https://radiology-resident.com/" target="_blank" rel="noopener noreferrer">Visit website <span aria-hidden="true">↗</span></a>
            </article>

            <article class="project-item index-entry" data-category="mobile">
                <span class="index-number">08</span>
                <div><h3>Dr Outlier</h3><p>Healthcare · Product design</p></div>
                <a class="index-link" href="#contact">Request details <span aria-hidden="true">→</span></a>
            </article>

            <article class="project-item index-entry" data-category="mobile">
                <span class="index-number">09</span>
                <div><h3>Subscription Manager</h3><p>Subscription tracking · App</p></div>
                <a class="index-link" href="https://subscriptionmanager.app/" target="_blank" rel="noopener noreferrer">Visit product <span aria-hidden="true">↗</span></a>
            </article>

            <article class="project-item index-entry" data-category="mobile">
                <span class="index-number">10</span>
                <div><h3>Play Classic</h3><p>Entertainment · Mobile</p></div>
                <a class="index-link" href="#contact">Request details <span aria-hidden="true">→</span></a>
            </article>

            <article class="project-item index-entry" data-category="mobile">
                <span class="index-number">11</span>
                <div><h3>Shopsy</h3><p>Social commerce · Mobile</p></div>
                <a class="index-link" href="#contact">Request details <span aria-hidden="true">→</span></a>
            </article>

            <article class="project-item index-entry" data-category="mobile">
                <span class="index-number">12</span>
                <div><h3>2Gud</h3><p>Commerce · Mobile</p></div>
                <a class="index-link" href="#contact">Request details <span aria-hidden="true">→</span></a>
            </article>

            <article class="project-item index-entry" data-category="mobile">
                <span class="index-number">13</span>
                <div><h3>PayQwik</h3><p>Payments · Fintech</p></div>
                <a class="index-link" href="#contact">Request details <span aria-hidden="true">→</span></a>
            </article>

            <article class="project-item index-entry" data-category="mobile">
                <span class="index-number">14</span>
                <div><h3>Cashier</h3><p>Merchant payments · Mobile</p></div>
                <a class="index-link" href="#contact">Request details <span aria-hidden="true">→</span></a>
            </article>

            <article class="project-item index-entry" data-category="mobile">
                <span class="index-number">15</span>
                <div><h3>Circuit Launcher</h3><p>Android launcher · UI</p></div>
                <a class="index-link" href="#contact">Request details <span aria-hidden="true">→</span></a>
            </article>

            <article class="project-item index-entry" data-category="branding">
                <span class="index-number">16</span>
                <div><h3>Flipkart Graphics Design</h3><p>Brand and marketing graphics</p></div>
                <a class="index-link" href="#contact">Request details <span aria-hidden="true">→</span></a>
            </article>
            </div>
        </details>
    </div>
</section>

<!-- Skills Section: editorial capabilities -->
<section id="skills" class="skills-section" aria-labelledby="skills-heading">
<style>
/* Scoped editorial skills layout */
#skills{background:#f6f5ef;color:#202822;padding:clamp(80px,9vw,138px) 0;border-top:1px solid #e3e4db}
#skills .container{max-width:1200px}
#skills .skills-lead{display:grid;grid-template-columns:minmax(0,1.1fr) minmax(260px,.55fr);gap:clamp(28px,6vw,110px);align-items:end;margin-bottom:clamp(42px,6.5vw,88px)}
#skills .skills-kicker{display:block;margin-bottom:20px;font-size:.75rem;font-weight:750;letter-spacing:.15em;text-transform:uppercase;color:#566858}
#skills .skills-lead h2{font-size:clamp(2.85rem,6.2vw,5.9rem);line-height:1.01;font-weight:650;letter-spacing:-.064em;color:#202822;margin:0;max-width:830px}
#skills .skills-lead h2 em{font-family:Georgia,'Times New Roman',serif;font-weight:400}
#skills .skills-lead p{color:#626c63;font-size:clamp(1rem,1.5vw,1.13rem);line-height:1.75;max-width:360px;margin:0 0 6px}
#skills .skills-body{display:grid;grid-template-columns:minmax(190px,.48fr) minmax(0,1.52fr);gap:clamp(30px,5vw,85px);border-top:1px solid #cbd1c8;padding-top:36px}
#skills .skills-aside{position:relative}
#skills .skills-aside span{display:block;font-size:.76rem;letter-spacing:.13em;text-transform:uppercase;font-weight:750;color:#6b796e;margin-bottom:17px}
#skills .skills-aside p{font-size:clamp(1.28rem,2vw,1.9rem);line-height:1.35;color:#283d30;font-weight:600;letter-spacing:-.035em;max-width:280px;margin:0}
#skills .capability-list{display:grid;gap:0;list-style:none;padding:0;margin:0}
#skills .capability-item{display:grid;grid-template-columns:44px minmax(0,1fr);gap:22px;padding:30px 0 32px;border-bottom:1px solid #d7dcd2;align-items:start}
#skills .capability-item:first-child{padding-top:0}
#skills .capability-number{font-size:.81rem;font-weight:750;color:#839083;letter-spacing:.07em;padding-top:6px}
#skills .capability-item h3{font-size:clamp(1.55rem,2.5vw,2.35rem);line-height:1.13;letter-spacing:-.047em;font-weight:650;color:#223729;margin:0 0 11px}
#skills .capability-item p{font-size:1rem;color:#68736b;line-height:1.62;margin:0 0 16px;max-width:660px}
#skills .capability-topics{display:flex;flex-wrap:wrap;gap:8px 18px}
#skills .capability-topics span{font-size:.87rem;line-height:1.4;font-weight:600;color:#3b5747}
#skills .capability-topics span:not(:last-child)::after{content:"/";color:#aebcaf;margin-left:18px}
#skills .toolbox{display:grid;grid-template-columns:minmax(190px,.48fr) minmax(0,1.52fr);gap:clamp(30px,5vw,85px);padding:32px 0 0;margin-top:48px;border-top:1px solid #cbd1c8}
#skills .toolbox h3{font-size:.76rem;letter-spacing:.13em;text-transform:uppercase;font-weight:750;color:#6b796e;margin:0}
#skills .tool-groups{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:30px}
#skills .tool-group strong{font-size:.9rem;display:block;margin-bottom:12px;color:#253c2d;font-weight:700}
#skills .tool-group p{color:#667168;line-height:1.7;font-size:.97rem;margin:0}
#skills .skills-footer{margin:33px 0 0;font-size:.83rem;color:#7b867c}
@media(max-width:920px){#skills .skills-lead{grid-template-columns:1fr;gap:24px}#skills .skills-body,#skills .toolbox{grid-template-columns:1fr;gap:24px}#skills .skills-aside p{max-width:550px}#skills .tool-groups{gap:22px}}
@media(max-width:600px){#skills .capability-item{grid-template-columns:27px 1fr;gap:14px;padding:26px 0}#skills .capability-topics{gap:8px 13px}#skills .capability-topics span:not(:last-child)::after{margin-left:13px}#skills .tool-groups{grid-template-columns:1fr;gap:22px}#skills .skills-footer{margin-top:25px}}
</style>
    <div class="container">
        <header class="skills-lead">
            <div>
                <span class="skills-kicker">Capabilities / My approach</span>
                <h2 id="skills-heading">Thinking in systems.<br><em>Designing for people.</em></h2>
            </div>
            <p>My work moves from understanding the problem to shaping the experience and getting it ready to build. These are the disciplines I bring together.</p>
        </header>

        <div class="skills-body">
            <div class="skills-aside">
                <span>01 / What I do</span>
                <p>From the first question to the final interaction.</p>
            </div>
            <ol class="capability-list">
                <li class="capability-item">
                    <span class="capability-number" aria-hidden="true">01</span>
                    <div>
                        <h3>Research &amp; direction</h3>
                        <p>Understand what people need, make sense of constraints, and turn messy problems into clear design priorities.</p>
                        <div class="capability-topics" aria-label="Research and direction skills">
                            <span>User research</span><span>Usability testing</span><span>Information architecture</span><span>User flows</span>
                        </div>
                    </div>
                </li>
                <li class="capability-item">
                    <span class="capability-number" aria-hidden="true">02</span>
                    <div>
                        <h3>Product &amp; interface design</h3>
                        <p>Design usable, expressive interfaces across mobile and web, with careful attention to how they behave in real life.</p>
                        <div class="capability-topics" aria-label="Product and interface design skills">
                            <span>UX/UI design</span><span>Wireframing</span><span>Prototyping</span><span>Interaction design</span>
                        </div>
                    </div>
                </li>
                <li class="capability-item">
                    <span class="capability-number" aria-hidden="true">03</span>
                    <div>
                        <h3>Systems &amp; delivery</h3>
                        <p>Create the structure teams need to ship consistently, collaborate with engineers, and improve products after launch.</p>
                        <div class="capability-topics" aria-label="Systems and delivery skills">
                            <span>Design systems</span><span>Accessibility</span><span>Responsive design</span><span>A/B testing</span>
                        </div>
                    </div>
                </li>
                <li class="capability-item">
                    <span class="capability-number" aria-hidden="true">04</span>
                    <div>
                        <h3>Visual communication</h3>
                        <p>Make complex ideas easier to understand through visual hierarchy, motion, branding, and clear content.</p>
                        <div class="capability-topics" aria-label="Visual communication skills">
                            <span>Visual design</span><span>Branding</span><span>Motion design</span><span>Content strategy</span>
                        </div>
                    </div>
                </li>
            </ol>
        </div>

        <div class="toolbox" aria-label="Tools and technical capabilities">
            <h3>02 / The toolkit</h3>
            <div class="tool-groups">
                <div class="tool-group">
                    <strong>Design &amp; prototyping</strong>
                    <p>Figma · Motiff · Framer · Adobe Creative Suite · Sketch · Adobe XD</p>
                </div>
                <div class="tool-group">
                    <strong>Build &amp; collaboration</strong>
                    <p>HTML/CSS · JavaScript · Product strategy · Cross-functional collaboration · Project management</p>
                </div>
            </div>
        </div>
        <p class="skills-footer">Tools change. Good judgment, clarity, and craft stay useful.</p>
    </div>
</section>

<!-- Experience Section: editorial career history -->
<section id="experience" class="experience-section" aria-labelledby="experience-heading">
<style>
/* Scoped career timeline: does not affect the education section. */
#experience{background:#edf0e9;color:#24332a;padding:clamp(83px,9vw,138px) 0}
#experience .container{max-width:1200px}
#experience .experience-lead{display:grid;grid-template-columns:minmax(0,1.1fr) minmax(260px,.6fr);gap:clamp(25px,7vw,110px);align-items:end;margin-bottom:clamp(44px,6vw,82px)}
#experience .experience-kicker{display:block;margin-bottom:20px;font-size:.75rem;font-weight:750;letter-spacing:.15em;text-transform:uppercase;color:#687768}
#experience .experience-lead h2{font-size:clamp(2.9rem,6vw,5.65rem);line-height:1.02;letter-spacing:-.065em;font-weight:650;color:#223329;margin:0;max-width:780px}
#experience .experience-lead h2 em{font-family:Georgia,'Times New Roman',serif;font-weight:400}
#experience .experience-lead p{font-size:clamp(1rem,1.45vw,1.12rem);line-height:1.68;color:#606b61;max-width:370px;margin:0 0 6px}
#experience .experience-timeline{max-width:none;margin:0;display:grid;gap:0;border-top:1px solid #c6cec2}
#experience .timeline-item{margin:0;border-bottom:1px solid #c6cec2}
#experience .timeline-item .timeline-content{display:grid;grid-template-columns:minmax(145px,.28fr) minmax(0,1fr);grid-template-rows:repeat(4,auto);column-gap:clamp(22px,6vw,95px);align-items:start;box-shadow:none;background:transparent;border:0;border-radius:0;transform:none;min-width:0;padding:clamp(30px,4vw,48px) 6px!important}
#experience .timeline-item:hover,#experience .timeline-item:hover .timeline-content{transform:none;box-shadow:none}
#experience .timeline-item:first-child .timeline-content{background:#e0e9dd;padding-left:clamp(20px,3vw,38px)!important;padding-right:clamp(20px,3vw,38px)!important}
#experience .timeline-content .date{grid-column:1;grid-row:1/span 4;display:block;background:transparent;border:0;border-radius:0;margin:7px 0 0;padding:0;min-height:0;color:#5d705f;font-size:.88rem;letter-spacing:.025em;font-weight:750}
#experience .timeline-content h3{grid-column:2;color:#23372a;font-size:clamp(1.55rem,2.7vw,2.5rem);line-height:1.17;letter-spacing:-.045em;font-weight:650;margin:0 0 7px}
#experience .timeline-content h4{grid-column:2;color:#657368;font-size:1rem;font-weight:650;line-height:1.4;margin:0 0 14px}
#experience .timeline-content > p{grid-column:2;color:#59685e;font-size:.98rem;line-height:1.7;max-width:780px;margin:0}
#experience .timeline-content > p strong{color:#3a5341;font-weight:700}
#experience .timeline-content .timeline-expandable{grid-column:2;margin:15px 0 0}
#experience .timeline-content > .timeline-list{grid-column:2}
#experience .timeline-toggle{background:transparent;border:0;border-radius:0;padding:0 0 7px;min-height:39px;margin:0;color:#2c5b40;font-size:.88rem;font-weight:750;border-bottom:1px solid #71917a;display:inline-flex;align-items:center;gap:12px;cursor:pointer;transition:gap .2s ease}
#experience .timeline-toggle:hover{color:#183e2a;gap:17px;background:transparent}
#experience .timeline-toggle:focus-visible{outline:3px solid #2c6842;outline-offset:5px}
#experience .timeline-toggle .toggle-icon{transition:transform .2s ease}
#experience .timeline-details{padding:17px 0 0;color:#526258;max-width:800px}
#experience .timeline-list{display:grid;gap:12px;list-style:none;padding:0;margin:0}
#experience .timeline-list li{line-height:1.65;font-size:.93rem;padding-left:18px;color:#526358}
#experience .timeline-list li::before{background:#799d82;width:6px;height:6px;top:.66em}
#experience .timeline-details .timeline-list{padding:9px 0 16px}
#experience .timeline-item:nth-child(odd) .timeline-content::before,#experience .timeline-item:nth-child(even) .timeline-content::before{display:none}
@media(max-width:880px){#experience .experience-lead{grid-template-columns:1fr;gap:24px}#experience .timeline-item .timeline-content{grid-template-columns:minmax(115px,.25fr) minmax(0,1fr);gap:0 26px}}
@media(max-width:650px){#experience .timeline-item .timeline-content{display:block;padding:30px 0!important}#experience .timeline-item:first-child .timeline-content{padding:28px 21px!important}#experience .timeline-content .date{margin:0 0 16px;font-size:.83rem}#experience .timeline-content h3{font-size:clamp(1.5rem,6.4vw,2rem)}#experience .timeline-content h4{margin-bottom:13px}#experience .timeline-content .timeline-expandable{margin-top:16px}}
@media(prefers-reduced-motion:reduce){#experience .timeline-toggle,#experience .timeline-toggle .toggle-icon{transition:none}}
</style>

    <div class="container">
        <header class="experience-lead">
            <div>
                <span class="experience-kicker">Experience / 2016–present</span>
                <h2 id="experience-heading">Work, across <em>disciplines.</em></h2>
            </div>
            <p>From interface design and creative direction to leading product experiences and building working prototypes. A look at the teams, roles, and problems that shaped my practice.</p>
        </header>
        <div class="experience-timeline">
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="date">2024 - Present</span>
                    <h3>Product Consultant – AI Prototyping Lead</h3>
                    <h4>Omnican Canada</h4>
                    <p>Leading rapid development of <strong>AI-assisted prototypes</strong> and <strong>full-stack applications</strong> across <strong>healthcare</strong> and <strong>SaaS platforms</strong>, turning ideas into working MVPs for validation and iteration.</p>

                    <div class="timeline-expandable">
                        <div class="timeline-details" id="timeline-details-omnican" style="display: none;" role="region" aria-label="Additional role details">
                            <ul class="timeline-list">
                                <li>Translate <strong>stakeholder ideas</strong> into <strong>functional product prototypes</strong> ready for testing and decision-making</li>
                                <li>Use <strong>AI tools</strong> and <strong>LLM workflows</strong> to generate application logic and accelerate development</li>
                                <li>Design <strong>system architecture</strong>, <strong>UI flows</strong>, and <strong>backend structure</strong> simultaneously for faster delivery</li>
                                <li>Build and deploy <strong>working MVPs</strong> for validation, stakeholder demos, and rapid iteration</li>
                                <li>Document <strong>product logic</strong>, <strong>prompt architecture</strong>, and key <strong>technical decisions</strong> for continuity and scale</li>
                                <li><strong>Radiology Without Tears (RWT)</strong> — Built the full web platform and mobile applications using AI-assisted workflows, designed the medical learning interface, and structured the content system for a healthcare learning platform</li>
                                <li><strong>Radiology Resident</strong> — Developed the full-stack web platform including frontend, backend, and database architecture, and built a responsive learning experience for radiology residents</li>
                                <li><strong>Subscription Manager</strong> — Built a SaaS application for subscription tracking using <strong>React</strong>, <strong>Next.js</strong>, and <strong>Supabase</strong>, with a responsive cross-platform interface</li>
                                <li><strong>Dr. Outlier</strong> — Developed a working web application prototype with data visualization and medical content features</li>
                                <li><strong>Web Authenticator</strong> — Built a secure authentication system prototype with login workflows, session management, and authentication logic</li>
                                <li><strong>AI Radiology Report Builder</strong> — Designed and prototyped an AI-assisted reporting system for generating structured radiology reports using prompt-driven workflows and medical templates</li>
                                <li><strong>Radiology Clinic Appointment System</strong> — Built a healthcare scheduling platform covering patient booking, appointment management, clinic operations, and a scalable responsive web interface</li>
                            </ul>
                        </div>

                        <button class="timeline-toggle" data-expanded="false" aria-expanded="false" aria-controls="timeline-details-omnican" aria-label="Expand to view more details about this role">
                            <span class="toggle-text">View</span>
                            <i class="fas fa-chevron-down toggle-icon" style="width: 16px; height: 16px;" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="150">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="date">2024 - 2024</span>
                    <h3>UI/UX Designer</h3>
                    <h4>rCycle</h4>
                    <p>Leading design initiatives for <strong>sustainability-focused applications</strong>, creating <strong>user-centered solutions</strong> that promote <strong>environmental responsibility</strong>.</p>
                    
                    <!-- Collapsible content -->
                    <div class="timeline-expandable">
                        <div class="timeline-details" id="timeline-details-1" style="display: none;" role="region" aria-label="Additional role details">
                            <ul class="timeline-list">
                                <li>Redesigned the <strong>mobile app interface</strong>, resulting in a <strong>35%</strong> increase in <strong>user engagement</strong> and a <strong>42%</strong> improvement in <strong>user retention rates</strong></li>
                                <li>Led comprehensive <strong>usability testing</strong>, to identify pain points and create data-driven solutions</li>
                                <li>Developed and implemented a <strong>modular design system</strong> that reduced design inconsistencies by <strong>60%</strong> and accelerated development cycles by <strong>25%</strong></li>
                                <li>Created responsive designs that improved <strong>accessibility scores</strong> from <strong>72%</strong> to <strong>98%</strong>, ensuring compliance with <strong>WCAG 2.1 standards</strong></li>
                                <li>Facilitated <strong>cross-functional design workshops</strong> that aligned stakeholders across <strong>product, engineering, and marketing teams</strong> on sustainable design practices</li>
                                <li>Implemented user behavioral analytics that provided insights leading to a <strong>28%</strong> increase in <strong>recycling activity</strong> among app users</li>
                            </ul>
                        </div>
                        
                        <button class="timeline-toggle" data-expanded="false" aria-expanded="false" aria-controls="timeline-details-1" aria-label="Expand to view more details about this role">
                            <span class="toggle-text">View</span>
                            <i class="fas fa-chevron-down toggle-icon" style="width: 16px; height: 16px;" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="date">2021 - 2024</span>
                    <h3>Product Design Lead</h3>
                    <h4>Virgin Plus (Bell Canada)</h4>
                    <p>Led the end-to-end redesign of the <strong>MyBenefits mobile app</strong> used by <strong>1M+ active users</strong>, collaborating with PMs and engineers across iOS, Android, and web.</p>
                    <ul class="timeline-list">
                        <li><strong>Redesigned the entire app experience</strong>, resolving major <strong>usability and accessibility issues</strong>, boosting the App Store rating from <strong>1.3★ to 4.5★.</strong></li>
                        <li>Created and launched <strong>“GetOnThis”</strong> event ticket redemption flow, replacing clunky 3rd-party redirects with <strong>a seamless in-app journey.</strong></li>
                        <li>Introduced a <strong>gamified rewards system</strong>, leading to a <strong>75% increase in feature engagement</strong> and a <strong>55% boost in average session time.</strong></li>
                        <li>Rolled out a <strong>full UI/UX overhaul</strong> aligned with new brand identity, improving <strong>user retention and satisfaction.</strong></li>
                        <li><strong>Tools</strong>: Figma, InVision, Axure, Illustrator, After Effects, Keynote.</li>

                    </ul>
                </div>
            </div>
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="date">2021 - 2023</span>
                    <h3>Senior Graphics Designer</h3>
                    <h4>Media.net</h4>
                    <p>Produced high-volume, multi-format <strong>marketing creatives</strong> to support global ad campaigns, product launches, and app visibility.</p>
                    <ul class="timeline-list">
                        <li>Designed <strong>emailers, ad banners, app UI mockups, Play Store/App Store assets</strong>, and high-conversion <strong>animated ad videos.</strong></li>
                        <li>Introduced <strong>component-based ad creative library</strong>, enabling scalable production across <strong>multiple dimensions and resolutions.</strong></li>
                        <li>Implemented <strong>email templating system</strong> for faster creative delivery, reducing turnaround time by over <strong>30%</strong>.</li>
                        <li>Collaborated with <strong>BDMs, analysts, PMs, and devs</strong> to ensure alignment on performance goals and cross-platform delivery.</li>
                        <li>Led A/B testing initiatives that boosted creative performance and contributed to a <strong>33% increase in user reach</strong> and direct <strong>revenue growth.</strong></li>
                        <li>Pioneered the use of <strong>animated ads</strong>, accelerating production cycles and campaign deployment.</li>
                        <li><strong>Tools:</strong> Figma, After Effects, Premiere Pro, Illustrator, Photoshop, Google Ad Creative Generator.</li>

                    </ul>
                </div>
            </div>
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="date">2021 - 2023</span>
                    <h3>Senior Analyst Visual Design</h3>
                    <h4>Accenture, ATCi</h4>
                    <p>Delivered high-impact visual content for internal teams and <strong>government clients in the US and India</strong>, aligned with learning and communication goals.</p>
                    <ul class="timeline-list">
                        <li>Designed <strong>learning content, explainer videos, emailers, and digital creatives</strong> for multiple L&D and training initiatives.</li>
                        <li>Collaborated with <strong>team leads and external stakeholders</strong> to understand requirements and deliver on-brand, timely creative solutions.</li>
                        <li>Improved <strong>turnaround time by 20%</strong> through efficient stakeholder communication and design iteration.</li>
                        <li>Maintained consistent visual quality across formats including <strong>motion graphics, interactive media, and presentations.</strong></li>
                        <li><strong>Tools:</strong> Illustrator, Photoshop, Figma, After Effects, Premiere Pro, Adobe Animate, Camtasia, Pawtoon, SharePoint, SendGrid, Outlook.</li>
                    </ul>
                </div>
            </div>
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="date">2020 - 2023</span>
                    <h3>Social Communication Manager & Admissions Manager</h3>
                    <h4>NIMS University, Jaipur</h4>
                    <p>Managed social media presence, communication strategies, and student admissions for 15 academic Graduatestreams and K–12 schooling, enhancing the university’s digital footprint and engagement.</p>
                    <ul class="timeline-list">
                        <li>Developed and executed a comprehensive <strong>social media strategy</strong>, increasing student engagement and boosting application rates.</li>
                        <li>Created engaging content and managed <strong>crisis communications</strong>, enhancing reputation management online.</li>
                        <li>Directed <strong>lead generation</strong> through <strong>Google Ads</strong>, <strong>Meta Ads</strong>, and digital campaigns targeting domestic and international students.</li>
                        <li>Streamlined <strong>lead distribution systems</strong> for call centers, improving conversion rates and optimizing the student admission pipeline.</li>
                        <li>Supervised <strong>university entrance exams</strong> via online platforms, prepared merit lists, and communicated results.</li>
                        <li>Regularly updated the <strong>university website</strong>, ensuring the latest sessions, regulations, and academic calendars were communicated effectively.</li>
                        <li>Provided <strong>IT support</strong> across departments, ensuring smooth operations and resolving technical issues as needed.</li>
                        <li>Delivered <strong>guest lectures</strong> on <strong>Branding, Design, and Digital Communication</strong> for <strong>Management and Fine Arts students</strong>.</li>
                        <li>Facilitated <strong>online and in-person workshops</strong> for students, junior designers, and interns at <strong>InstiWitty Media Studios</strong>, <strong>NIMS University</strong>, and <strong>Virgin Plus</strong>.</li>
                    </ul>
                </div>
            </div>

            <div class="timeline-item" data-aos="fade-up" data-aos-delay="300">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="date">2020 - 2021</span>
                    <h3>Product Designer</h3>
                    <h4>Flipkart</h4>
                    <p>Led the <strong>UX and visual design</strong> for multiple high-impact Flipkart initiatives including India’s <strong>first social commerce app</strong>, reaching millions of users.</p>
                    <ul class="timeline-list">
                        <li>Designed end-to-end interfaces for <strong>2Gud Social Commerce</strong> and <strong>Shopsy</strong>, enabling users to <strong>shop directly from video content</strong>, merging entertainment with e-commerce. </li>
                        <li>Shaped the experience for <strong>reseller-driven social commerce</strong> through Shopsy, streamlining discovery, carting, and earning workflows. </li>
                        <li>Delivered <strong>marketing assets</strong> for <strong>SuperCoin</strong>, <strong>2Gud</strong>, and <strong>Shopsy</strong> including <strong>push notifications</strong>, <strong>emailers</strong>, <strong>ad creatives</strong>, and <strong>promotional videos</strong>. </li>
                        <li>Collaborated with <strong>merchandisers</strong>, <strong>business analysts</strong>, and <strong>devs</strong> to iterate rapidly and align with business growth targets. </li>
                        <li>Contributed to the launch of <strong>Flipkart’s AI assistant “Flippi”</strong>, designing <strong>onboarding flows</strong>, <strong>micro-interactions</strong>, and <strong>animations</strong> for intuitive guidance. </li>
                        <li>Achieved <strong>89% app engagement rate</strong> and drove app ratings to <strong>4.7★</strong> through polished UX and high-performance design. </li>
                        <li>Tools: <strong>Figma</strong>, <strong>Photoshop</strong>, <strong>Illustrator</strong>, <strong>Lottie</strong>, <strong>Framer</strong>. </li>
                    </ul>
                </div>
            </div>
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="date">2019 - 2020</span>
                    <h3>Customer Experience Lead</h3>
                    <h4>NextGen Invent Corporation</h4>
                    <p>Led design initiatives to enhance <strong>client-facing websites</strong> and <strong>internal tools</strong>, focusing on usability, accessibility, and visual appeal.</p>
                    <ul class="timeline-list">
                        <li>Designed <strong>social media creatives</strong>, <strong>promotional videos</strong>, and <strong>brand assets</strong> to support marketing campaigns and client acquisition.</li>
                        <li><strong>Redesigned client websites and apps</strong>, resolving major <strong>usability</strong> and <strong>accessibility</strong> issues to improve engagement and user satisfaction.</li>
                        <li>Collaborated closely with <strong>developers</strong> and <strong>PMs</strong> to execute seamless handoffs and align design with product functionality.</li>
                        <li>Contributed to improved <strong>site rankings</strong> and <strong>user reach</strong> through design-driven enhancements across multiple client platforms.</li>
                        <li>Tools: <strong>Figma</strong>, <strong>Adobe Creative Suite</strong>, <strong>Dreamweaver</strong>.</li>
                    </ul>
                </div>
            </div>
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="date">2018 - 2019</span>
                    <h3>Creative Director</h3>
                    <h4>MSS Payments</h4>
                    <p>Designed and launched <strong>white-labeled mobile wallet and prepaid card apps</strong> for national and global banks, enabling millions to access seamless financial services.</p>
                    <ul class="timeline-list">
                        <li>Led end-to-end design for mobile wallets that allowed users to <strong>send/receive money</strong>, <strong>pay bills</strong>, <strong>buy tickets</strong>, and more — tailored for financial institutions and micro-finance clients.</li>
                        <li>Developed the UX/UI for <strong>India’s first user-controlled prepaid card system</strong>, enabling users to <strong>load funds</strong> and <strong>manage cards</strong> directly via <strong>app</strong> or <strong>web</strong>, <strong>secured with bank-level protocols.</strong></li>
                        <li>Partnered with <strong>developers</strong>, <strong>testers</strong>, <strong>BDMs</strong>, and <strong>client stakeholders</strong> to ensure regulatory and brand alignment.</li>
                        <li>Boosted <strong>app engagement time</strong> by <strong>30%</strong>, resolved over <strong>100+</strong> broken flows, and raised app rating to <strong>4.5★</strong> through streamlined experience design.</li>
                        <li>Tools: <strong>Illustrator</strong>, <strong>Sketch</strong>, <strong>Photoshop</strong>.</li>
                    </ul>
                </div>
            </div>
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="200">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="date">2016 - 2018</span>
                    <h3>Software Engineer (UI/UX)</h3>
                    <h4>Launchers World Software</h4>
                    <p>Specialized in designing high-performance <strong>Android phone launchers</strong>, downloaded and loved by <strong>20M+</strong> users worldwide.</p>
                    <ul class="timeline-list">
                        <li>Created and launched <strong>20+</strong> custom Android launchers, each featuring unique UI concepts and personalized themes — consistently rated <strong>4★+</strong> on the Play Store.</li>
                        <li>Designed <strong>Play Store</strong> assets, including <strong>feature graphics</strong>, <strong>banners</strong>, and <strong>videos</strong>, that helped boost visibility and user acquisition.</li>
                        <li>Developed and maintained <strong>WordPress</strong> websites to promote launcher products and support user engagement.</li>
                        <li>Delivered polished UI design with a focus on <strong>performance</strong>, <strong>personalization</strong>, and <strong>aesthetic consistency</strong>.</li>
                        <li>Tools: <strong>Illustrator</strong>, <strong>Photoshop</strong>, <strong>WordPress</strong>, <strong>Android Studio</strong> (design support only).</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Organizations Section -->
<section id="organizations" class="organizations-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>Organizations</h2>
            <div class="section-line"></div>
        </div>
        <div class="certifications-grid">
            <div class="certification-item" data-aos="fade-up" data-aos-delay="100">
                <div class="certification-icon">
                    <span class="solar-icon building" style="width: 24px; height: 24px;"></span>
                </div>
                <div class="certification-content">
                    <h3>InstiWitty Media Studios</h3>
                    <p class="certification-issuer">Director</p>
                    <p class="certification-date">May 2018 - Present</p>
                </div>
            </div>
            <div class="certification-item" data-aos="fade-up" data-aos-delay="200">
                <div class="certification-icon">
                    <span class="solar-icon heart" style="width: 24px; height: 24px;"></span>
                </div>
                <div class="certification-content">
                    <h3>Aashayen Foundation</h3>
                    <p class="certification-issuer">Founder & President</p>
                    <p class="certification-date">2015 - Present</p>
                </div>
            </div>
            <div class="certification-item" data-aos="fade-up" data-aos-delay="300">
                <div class="certification-icon">
                    <span class="solar-icon graduation-cap" style="width: 24px; height: 24px;"></span>
                </div>
                <div class="certification-content">
                    <h3>Microsoft Student Association</h3>
                    <p class="certification-issuer">Student Ambassador</p>
                </div>
            </div>
            <div class="certification-item" data-aos="fade-up" data-aos-delay="400">
                <div class="certification-icon">
                    <span class="solar-icon paint-brush" style="width: 24px; height: 24px;"></span>
                </div>
                <div class="certification-content">
                    <h3>OmniCan</h3>
                    <p class="certification-issuer">Founder</p>
                    <p class="certification-date">2023 - Present</p>
                </div>
            </div>
            <div class="certification-item" data-aos="fade-up" data-aos-delay="400">
                <div class="certification-icon">
                    <span class="solar-icon paint-brush" style="width: 24px; height: 24px;"></span>
                </div>
                <div class="certification-content">
                    <h3>EazyHaven</h3>
                    <p class="certification-issuer">Founder</p>
                    <p class="certification-date">2021 - Present</p>
                </div>
            </div>
            <div class="certification-item" data-aos="fade-up" data-aos-delay="500">
                <div class="certification-icon">
                    <span class="solar-icon certificate" style="width: 24px; height: 24px;"></span>
                </div>
                <div class="certification-content">
                    <h3>Dahej</h3>
                    <p class="certification-issuer">City Leader</p>
                    <p class="certification-date">2014 - 2015</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Education Section -->
<section id="education" class="experience-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>Education</h2>
            <div class="section-line"></div>
        </div>
        <p class="section-subheading">Academic foundation and continuous learning</p>
        <div class="experience-timeline">
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="date">2024 - 2025</span>
                    <h4>Graduate Certificate</h4>
                    <h3>Global Business Management</h3>
                    <h4>Fleming College, Ontario, Canada</h4>
                    <p>Specializing in international business strategies, cross-cultural management, and global marketing with a focus on digital transformation.</p>
                    <ul class="timeline-list">
                        <li>Global Business Strategies and Leadership</li>
                        <li>International Marketing and Digital Branding</li>
                        <li>Cross-Cultural Management and Communication</li>
                        <li>Financial Management for Global Operations</li>
                        <li>Digital Transformation and Innovation</li>
                    </ul>
                </div>
            </div>
            <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span class="date">2012 - 2016</span>
                    <h4>Bachelors in Engineering (BE)</h4>
                    <h3>Computer Science Engineering</h3>
                    <h4>Jiwaji University, Madhya Pradesh, India</h4>
                    <p>Comprehensive education in computer science principles, programming, and software development with additional focus on design and user experience.</p>
                    <ul class="timeline-list">
                        <li>Data Structures and Algorithms</li>
                        <li>Software Engineering and Development</li>
                        <li>Database Management Systems</li>
                        <li>Web Development and UI Design</li>
                        <li>Computer Networks and Security</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Certifications Section -->
<?php include 'certifications-section.php'; ?>


<!-- Contact Section -->
<section id="contact" class="contact-section">
    <div class="container">        <div class="section-header" data-aos="fade-up">
            <h2>Get In Touch</h2>
            <div class="section-line"></div>
        </div>
        <p class="section-subheading">Let's collaborate on your next project</p>
        <div class="contact-content">
            <div class="contact-info" data-aos="fade-right" data-aos-delay="100">
                <h3>Let's Create Something Amazing Together</h3>
                <p>I'm always interested in hearing about new projects and opportunities. Whether you need a complete design overhaul or just want to discuss potential collaborations, I'm here to help turn your vision into reality.</p>
                <div class="contact-details">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone" style="width: 24px; height: 24px;"></i>
                        </div>
                        <div class="contact-text">
                            <h4>Phone</h4>
                            <p>+1 (647) 333 9098</p>
                            <p>+1 (647) 274 5418</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope" style="width: 24px; height: 24px;"></i>
                        </div>
                        <div class="contact-text">
                            <h4>Email</h4>
                            <p>contact@imshivam.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt" style="width: 24px; height: 24px;"></i>
                        </div>
                        <div class="contact-text">
                            <h4>Location</h4>
                            <p>East York, Ontario, Canada</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-calendar-alt" style="width: 24px; height: 24px;"></i>
                        </div>
                        <div class="contact-text">
                            <h4>Availability</h4>
                            <p>Open to freelance & full-time opportunities</p>
                        </div>
                    </div>
                </div>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/shivampatsariya/" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin" style="width: 20px; height: 20px;"></i></a>
                    <!-- <a href="#" target="_blank" aria-label="Dribbble"><i class="fab fa-dribbble" style="width: 20px; height: 20px;"></i></a> -->
                    <a href="https://www.behance.net/shivampatsariya" target="_blank" aria-label="Behance"><i class="fab fa-behance" style="width: 20px; height: 20px;"></i></a>
                    <a href="https://www.instagram.com/savvyshivam/" target="_blank" aria-label="Instagram"><i class="fab fa-instagram" style="width: 20px; height: 20px;"></i></a>
                    <a href="https://twitter.com/spatsariya" target="_blank" aria-label="Twitter"><i class="fab fa-twitter" style="width: 20px; height: 20px;"></i></a>
                </div>
            </div>
            <div class="contact-form" data-aos="fade-left" data-aos-delay="100">
                <!-- Display success or error messages -->
                <?php if ($form_success): ?>
                    <div class="form-message success" role="alert">
                        <i class="fas fa-check-circle"></i> Thank you! Your message has been sent successfully. I'll get back to you soon.
                    </div>
                <?php elseif ($form_error): ?>
                    <div class="form-message error" role="alert">
                        <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($form_error); ?>
                    </div>
                <?php endif; ?>
                
                <!-- Contact Form -->
                <form action="#contact" method="POST" id="contactForm" novalidate>
                    <input type="hidden" name="contact_form" value="1">
                    <fieldset>
                        <legend class="sr-only">Contact Information Form</legend>
                        
                        <div class="form-group">
                            <label for="name">Your Name <span aria-label="required">*</span></label>
                            <input type="text" name="name" id="name" placeholder="Enter your name" required 
                                   value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" aria-describedby="name-error">
                            <div id="name-error" class="error-message" role="alert" aria-live="polite"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Your Email <span aria-label="required">*</span></label>
                            <input type="email" name="email" id="email" placeholder="Enter your email" required 
                                   value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" aria-describedby="email-error">
                            <div id="email-error" class="error-message" role="alert" aria-live="polite"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="subject" placeholder="What's this about?" 
                                   value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>" aria-describedby="subject-help">
                            <div id="subject-help" class="form-help">Optional: Brief description of your inquiry</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Your Message <span aria-label="required">*</span></label>
                            <textarea name="message" id="message" placeholder="Tell me about your project..." required aria-describedby="message-error"><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                            <div id="message-error" class="error-message" role="alert" aria-live="polite"></div>
                        </div>
                        
                        <!-- hCaptcha -->
                        <div class="form-group">
                            <div class="h-captcha" data-sitekey="2b96e9ce-d828-41b8-99e6-718a9e145f74" data-theme="light"></div>
                        </div>
                    </fieldset>
                    
                    <button type="submit" class="btn btn-primary" aria-describedby="submit-help">
                        Send Message <i class="fas fa-paper-plane" style="width: 16px; height: 16px;" aria-hidden="true"></i>
                    </button>
                    <div id="submit-help" class="form-help">Your message will be sent directly to Shivam Patsariya</div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>