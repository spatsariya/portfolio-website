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

<!-- Hero: personal editorial introduction -->
<section id="hero" class="hero-section" aria-labelledby="hero-heading">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-eyebrow">
                    <span class="hero-eyebrow-rule" aria-hidden="true"></span>
                    <span>Shivam Patsariya / UI·UX &amp; Product Design</span>
                </div>
                <h1 id="hero-heading">Complex ideas.<br><em>Clear experiences.</em></h1>
                <p class="hero-intro">I'm Shivam. I design digital products that make complicated things feel simple.</p>
                <p class="hero-description">With a background in engineering, visual design, and business, I connect what people need with what teams can actually build.</p>
                <div class="hero-cta">
                    <a href="#projects" class="hero-primary-action">Explore my work <span aria-hidden="true">↗</span></a>
                    <a href="#contact" class="hero-secondary-action">Let's talk <span aria-hidden="true">↗</span></a>
                </div>
                <div class="hero-social-links" aria-label="Find me online">
                    <span>Elsewhere</span>
                    <a href="https://www.linkedin.com/in/shivampatsariya/" target="_blank" rel="noopener noreferrer">LinkedIn <span aria-hidden="true">↗</span></a>
                    <a href="https://www.behance.net/shivampatsariya" target="_blank" rel="noopener noreferrer">Behance <span aria-hidden="true">↗</span></a>
                </div>
            </div>
            <figure class="hero-visual">
                <div class="hero-portrait">
                    <img src="images/cutout-main.png" alt="Illustrated portrait of Shivam Patsariya" width="800" height="900" fetchpriority="high" loading="eager" decoding="async">
                    <span class="hero-portrait-index" aria-hidden="true">SP / 01</span>
                </div>
                <figcaption class="hero-image-caption">
                    <span>Designing with curiosity. Building with purpose.</span>
                    <span>Based in Ontario, Canada</span>
                </figcaption>
            </figure>
        </div>
        <div class="hero-bottom">
            <div class="hero-metrics" aria-label="Experience at a glance">
                <div><strong>10+</strong><span>Years of experience</span></div>
                <div><strong>50+</strong><span>Projects delivered</span></div>
                <div><strong>15+</strong><span>Clients</span></div>
            </div>
            <a class="hero-next" href="#about">More about me <span aria-hidden="true">↓</span></a>
        </div>
    </div>
</section>


<!-- About: editorial introduction -->
<section id="about" class="about-section" aria-labelledby="about-heading">
<style>
#about.about-section{background:var(--bg);color:var(--text-color);padding:clamp(82px,9vw,138px) 0}
#about .container{max-width:1200px}
#about .about-header{display:grid;grid-template-columns:minmax(0,1.1fr) minmax(240px,.54fr);gap:clamp(26px,6vw,110px);align-items:end;margin-bottom:clamp(46px,6vw,84px)}
#about .about-kicker{display:block;font-size:.75rem;letter-spacing:.15em;font-weight:750;text-transform:uppercase;color:var(--text-soft);margin-bottom:19px}
#about .about-header h2{font-size:clamp(3rem,6vw,5.8rem);font-weight:650;line-height:1.02;letter-spacing:-.065em;margin:0;color:var(--text-color)}
#about .about-header h2 em{font-family:Georgia,'Times New Roman',serif;font-weight:400;color:var(--text-soft)}
#about .about-header>p{font-size:clamp(.98rem,1.45vw,1.1rem);line-height:1.73;color:var(--text-muted);max-width:360px;margin:0 0 7px}
#about .about-main{display:grid;grid-template-columns:minmax(0,1.15fr) minmax(265px,.66fr);gap:clamp(34px,7vw,115px);align-items:start;border-top:1px solid var(--line-color);padding:clamp(30px,4.2vw,52px) 0 clamp(44px,6vw,78px)}
#about .about-story{max-width:690px}
#about .about-story .about-intro{font-size:clamp(1.38rem,2.35vw,2.2rem);line-height:1.43;letter-spacing:-.039em;font-weight:590;color:var(--text-color);margin:0 0 28px}
#about .about-story p:not(.about-intro){font-size:1.04rem;line-height:1.78;color:var(--text-muted);margin:0 0 20px}
#about .about-actions{display:flex;gap:13px 25px;align-items:center;flex-wrap:wrap;margin-top:33px}
#about .about-resume{display:inline-flex;align-items:center;gap:14px;min-height:49px;padding:11px 20px;background:var(--primary-color);color:#fff;border:1px solid var(--primary-color);border-radius:4px;font-size:.91rem;font-weight:700;text-decoration:none;transition:background-color .2s ease}
#about .about-resume:hover{background:var(--text-color);color:#fff}
#about .about-contact-link{color:var(--primary-color);border-bottom:1px solid var(--text-soft);min-height:36px;display:inline-flex;align-items:center;gap:10px;font-weight:700;font-size:.9rem;text-decoration:none}
#about .about-contact-link:hover{border-bottom-color:var(--primary-color)}
#about .about-profile{padding:clamp(25px,3.5vw,39px);background:var(--surface-muted);border:1px solid var(--line-color)}
#about .about-profile h3{font-size:.73rem;letter-spacing:.14em;text-transform:uppercase;font-weight:750;color:var(--text-soft);margin:0 0 26px}
#about .profile-row{display:grid;grid-template-columns:88px minmax(0,1fr);gap:12px;align-items:start;padding:15px 0;border-top:1px solid var(--line-color)}
#about .profile-row:last-child{padding-bottom:0}
#about .profile-row dt{font-size:.75rem;letter-spacing:.025em;color:var(--text-soft);font-weight:650}
#about .profile-row dd{font-size:.9rem;line-height:1.55;color:var(--text-color);font-weight:650;overflow-wrap:anywhere;margin:0}
#about .profile-row dd a{color:var(--primary-color);border-bottom:1px solid var(--line-color);text-decoration:none}
#about .profile-row dd a:hover{border-bottom-color:var(--primary-color)}
#about .about-proof{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:0;border-top:1px solid var(--line-color)}
#about .about-stat{padding:28px 24px 5px 0;min-width:0}
#about .about-stat+.about-stat{padding-left:clamp(14px,2vw,30px);border-left:1px solid var(--line-color)}
#about .about-stat .stat-number{font-family:var(--heading-font);font-size:clamp(2.1rem,3.4vw,3.45rem);letter-spacing:-.05em;line-height:1.1;color:var(--text-color);font-weight:650;display:block;margin-bottom:9px}
#about .about-stat .stat-text{font-size:.86rem;color:var(--text-soft);line-height:1.45}
#about a:focus-visible{outline:3px solid var(--primary-color);outline-offset:5px}
@media(max-width:950px){#about .about-header{grid-template-columns:1fr;gap:24px}#about .about-main{grid-template-columns:1fr;gap:34px}#about .about-profile{max-width:none}}
@media(max-width:650px){#about .about-proof{grid-template-columns:repeat(2,minmax(0,1fr));row-gap:18px}#about .about-stat:nth-child(3){padding-left:0;border-left:0}#about .about-stat:nth-child(n+3){border-top:1px solid var(--line-color);padding-top:23px}#about .about-story .about-intro{font-size:clamp(1.4rem,5.5vw,1.9rem)}}
@media(max-width:400px){#about .profile-row{grid-template-columns:1fr;gap:4px}}
@media(prefers-reduced-motion:reduce){#about .about-resume{transition:none}}
</style>
    <div class="container">
        <header class="about-header">
            <div>
                <span class="about-kicker">A little about me / Shivam Patsariya</span>
                <h2 id="about-heading">Design, engineering,<br><em>and the space between.</em></h2>
            </div>
            <p>I bring together the detail of visual design, the logic of engineering, and a broader view of how products work.</p>
        </header>
        <div class="about-main">
            <div class="about-story">
                <p class="about-intro">I'm a UI/UX and visual designer who enjoys making complicated things feel simple.</p>
                <p>My background is in computer science engineering, and I later studied global business management. That mix shapes the way I work: I look at the people using a product, the system behind it, and the decisions needed to make it useful.</p>
                <p>I've worked across mobile apps, web platforms, branding, and product teams. Outside client work, I build independent software, explore healthcare education tools, and write fiction.</p>
                <p>For me, good design isn't about more decoration. It's about clarity, thoughtful details, and something that works when people actually use it.</p>
                <div class="about-actions">
                    <a href="document/shivam_patsariya_resume_ux_designer.pdf" target="_blank" rel="noopener noreferrer" class="about-resume">View my resume <span aria-hidden="true">↗</span></a>
                    <a href="#contact" class="about-contact-link">Get in touch <span aria-hidden="true">↗</span></a>
                </div>
            </div>
            <aside class="about-profile" aria-label="Profile at a glance">
                <h3>A few details</h3>
                <dl>
                    <div class="profile-row"><dt>Name</dt><dd>Shivam Patsariya</dd></div>
                    <div class="profile-row"><dt>Email</dt><dd><a href="mailto:contact@imshivam.com">contact@imshivam.com</a></dd></div>
                    <div class="profile-row"><dt>Based in</dt><dd>East York, Ontario, Canada</dd></div>
                    <div class="profile-row"><dt>Languages</dt><dd>English · Hindi</dd></div>
                    <div class="profile-row"><dt>Availability</dt><dd>Open to new opportunities</dd></div>
                </dl>
            </aside>
        </div>
        <div class="about-stats about-proof" aria-label="Portfolio at a glance">
            <div class="about-stat"><span class="stat-number" data-count="50">50+</span><span class="stat-text">Projects completed</span></div>
            <div class="about-stat"><span class="stat-number" data-count="10">10+</span><span class="stat-text">Years of experience</span></div>
            <div class="about-stat"><span class="stat-number" data-count="15">15+</span><span class="stat-text">Clients</span></div>
            <div class="about-stat"><span class="stat-number" data-count="4000">4.0k+</span><span class="stat-text">LinkedIn followers</span></div>
        </div>
    </div>
</section>

<!-- Beyond the canvas: editorial showcase -->
<section id="highlights" class="highlights-section" aria-labelledby="highlights-heading">
<style>
.highlights-section{--ink:var(--text-color);--muted:var(--text-muted);--line:var(--surface-strong);background:var(--bg);color:var(--ink);padding:clamp(76px,9vw,132px) 0}
.highlights-section .container{max-width:1200px}
.highlights-section .highlights-heading{display:grid;grid-template-columns:minmax(0,1.2fr) minmax(250px,.65fr);gap:clamp(22px,6vw,90px);align-items:end;margin-bottom:clamp(35px,5vw,64px)}
.highlights-section .highlights-kicker{display:inline-block;font-size:.76rem;letter-spacing:.16em;text-transform:uppercase;font-weight:700;color:var(--text-muted);margin-bottom:20px}
.highlights-section .highlights-heading h2{font-size:clamp(2.6rem,6.3vw,6.2rem);font-weight:650;line-height:.99;letter-spacing:-.065em;margin:0;color:var(--ink);max-width:850px}
.highlights-section .highlights-heading h2 em{font-family:Georgia,'Times New Roman',serif;font-weight:400;letter-spacing:-.07em}
.highlights-section .highlights-heading p{font-size:clamp(.98rem,1.4vw,1.13rem);line-height:1.65;color:var(--muted);max-width:350px;margin:0 0 7px}
.highlights-section .highlights-grid{display:grid;grid-template-columns:1fr 1fr;grid-template-areas:"product product" "learning books";gap:18px}
.highlights-section .highlight-story{min-width:0;border:1px solid var(--line);position:relative;overflow:hidden;background:var(--surface-muted)}
.highlights-section .highlight-story--product{grid-area:product;background:var(--surface-muted);display:grid;grid-template-columns:minmax(0,.85fr) minmax(0,1.15fr);min-height:460px}
.highlights-section .highlight-story--learning{grid-area:learning;background:var(--bg-elevated)}
.highlights-section .highlight-story--books{grid-area:books;background:var(--surface-strong)}
.highlights-section .story-content{position:relative;z-index:1;padding:clamp(26px,4vw,54px)}
.highlights-section .story-meta{display:flex;justify-content:space-between;align-items:center;gap:16px;font-size:.72rem;letter-spacing:.13em;text-transform:uppercase;font-weight:750;color:var(--text-muted);margin-bottom:clamp(24px,4vw,46px)}
.highlights-section .highlight-story h3{font-size:clamp(2rem,3.5vw,3.65rem);font-weight:630;letter-spacing:-.057em;line-height:1.06;margin:0 0 16px;color:var(--text-color)}
.highlights-section .highlight-story p{font-size:1rem;line-height:1.7;color:var(--text-muted);margin:0 0 25px;max-width:420px}
.highlights-section .story-link{display:inline-flex;align-items:center;gap:10px;color:var(--primary-color);font-size:.91rem;font-weight:750;text-decoration:none;border-bottom:1px solid currentColor;padding-bottom:5px;transition:gap .2s ease}
.highlights-section .story-link:hover{gap:17px}
.highlights-section a:focus-visible{outline:3px solid var(--primary-color);outline-offset:5px}
.highlights-section .product-stage{padding:36px clamp(26px,4vw,54px);display:flex;flex-direction:column;justify-content:center;gap:12px;position:relative}
.highlights-section .product-stage:before{content:"";position:absolute;inset:12% 12% 7% 4%;border:1px solid rgba(22,24,29,.17);border-radius:50%;transform:rotate(-18deg);pointer-events:none}
.highlights-section .product-feature{position:relative;background:var(--bg-elevated);border:1px solid var(--line-color);padding:23px 26px;min-height:142px;box-shadow:12px 14px 0 rgba(22,24,29,.08);display:flex;flex-direction:column;justify-content:space-between;color:var(--text-color);text-decoration:none;transition:transform .25s ease,box-shadow .25s ease}
.highlights-section .product-feature .small-label{font-size:.7rem;text-transform:uppercase;letter-spacing:.13em;color:var(--text-soft);font-weight:700}
.highlights-section .product-feature strong{display:block;font-size:clamp(1.35rem,2.4vw,2.3rem);font-weight:650;letter-spacing:-.045em;line-height:1.1;color:var(--text-color)}
.highlights-section .product-feature .visit{font-size:.84rem;font-weight:700;color:var(--primary-color);align-self:flex-end}
.highlights-section .product-feature:hover{transform:translateY(-3px);box-shadow:12px 18px 0 rgba(22,24,29,.1)}
.highlights-section .product-subgrid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:10px;position:relative}
.highlights-section .product-mini{background:var(--primary-color);color:#f5f2ec;padding:20px 18px;min-height:122px;display:flex;flex-direction:column;justify-content:space-between;gap:15px;text-decoration:none;transition:transform .2s ease,filter .2s ease}
.highlights-section .product-mini:nth-child(2){background:var(--line-color);color:var(--text-color)}
.highlights-section .product-mini:nth-child(3){background:var(--surface-strong);color:var(--text-color)}
.highlights-section .product-mini:hover{transform:translateY(-3px);filter:brightness(1.04)}
.highlights-section .product-mini span{font-size:.65rem;text-transform:uppercase;letter-spacing:.1em;opacity:.8}
.highlights-section .product-mini strong{font-size:clamp(.9rem,1.25vw,1.1rem);line-height:1.2;letter-spacing:-.025em}
.highlights-section .product-mini .mini-arrow{align-self:flex-end;font-size:1rem;font-weight:700}
.highlights-section .highlight-story--learning .story-meta,.highlights-section .highlight-story--books .story-meta{margin-bottom:27px}
.highlights-section .highlight-story--learning .story-content,.highlights-section .highlight-story--books .story-content{padding-bottom:18px}
.highlights-section .highlight-story--learning h3,.highlights-section .highlight-story--books h3{font-size:clamp(1.95rem,3vw,3rem)}
.highlights-section .health-projects{display:grid;gap:12px;margin:8px clamp(26px,4vw,54px) clamp(26px,4vw,54px)}
.highlights-section .health-project{display:flex;align-items:center;justify-content:space-between;gap:20px;border:1px solid var(--line-color);background:var(--bg-elevated);padding:20px 22px;min-height:107px;color:var(--text-color);text-decoration:none;transition:background .2s ease,transform .2s ease}
.highlights-section .health-project:nth-child(2){background:var(--surface-strong)}
.highlights-section .health-project:hover{background:#fff;transform:translateX(3px)}
.highlights-section .health-project small{font-size:.67rem;letter-spacing:.1em;text-transform:uppercase;color:var(--text-muted);font-weight:700}
.highlights-section .health-project strong{display:block;font-size:clamp(1rem,1.5vw,1.26rem);margin-top:7px;line-height:1.25;letter-spacing:-.03em}
.highlights-section .health-project .health-arrow{font-size:1.4rem;flex:none}
.highlights-section .book-display{display:flex;align-items:end;justify-content:center;gap:clamp(13px,3vw,30px);padding:18px 26px clamp(38px,4vw,58px);min-height:315px}
.highlights-section .book-cover{display:block;position:relative;width:clamp(128px,36%,192px);aspect-ratio:.62;box-shadow:9px 14px 18px rgba(61,43,35,.17);transform:rotate(-6deg);background:var(--primary-dark);color:var(--bg);text-decoration:none;overflow:hidden;transition:transform .25s ease,box-shadow .25s ease}
.highlights-section .book-cover:nth-child(2){background:var(--primary-dark);transform:translateY(-13px) rotate(6deg)}
.highlights-section .book-cover:hover{transform:translateY(-10px) rotate(-3deg);box-shadow:13px 19px 25px rgba(61,43,35,.22)}
.highlights-section .book-cover:nth-child(2):hover{transform:translateY(-22px) rotate(3deg)}
.highlights-section .book-cover img{width:100%;height:100%;object-fit:cover;display:block;position:relative;z-index:2}
.highlights-section .book-cover .cover-fallback{position:absolute;inset:0;display:flex;flex-direction:column;justify-content:center;padding:16px;font:1.25rem/1.2 Georgia,'Times New Roman',serif;text-align:center;z-index:1}
.highlights-section .books-note{text-align:center;font-size:.82rem;color:var(--text-muted);margin:-22px 26px 28px}
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
.projects-section{background:var(--bg);color:var(--text-color);border-top:1px solid var(--line-color)}
.projects-section .container{max-width:1200px}
.projects-section .work-head{display:grid;grid-template-columns:minmax(0,1.2fr) minmax(270px,.7fr);align-items:end;gap:42px;margin-bottom:34px}
.projects-section .work-kicker,.projects-section .work-label{display:block;color:var(--text-muted);font-weight:700;letter-spacing:.14em;text-transform:uppercase;font-size:.75rem}
.projects-section .work-kicker{margin-bottom:17px}
.projects-section .work-head h2{color:var(--text-color);font-size:clamp(3rem,6vw,5.6rem);line-height:1.02;letter-spacing:-.065em;font-weight:650;margin:0}
.projects-section .work-head p{color:var(--text-muted);font-size:1.06rem;line-height:1.65;max-width:370px;margin:0 0 7px}
.projects-section .projects-filter{display:flex;justify-content:flex-start;align-items:center;gap:9px;margin:0 0 20px;flex-wrap:wrap}
.projects-section .projects-filter .filter-btn{border-radius:6px;background:transparent;color:var(--text-muted);border:1px solid var(--line-color);font-size:.87rem;font-weight:650;padding:9px 16px;min-height:44px;transition:background .18s ease,color .18s ease,border-color .18s ease}
.projects-section .projects-filter .filter-btn:hover,.projects-section .projects-filter .filter-btn.active{background:var(--primary-color);border-color:var(--primary-color);color:#fff}
.projects-section .filter-btn:focus-visible,.projects-section a:focus-visible,.projects-section summary:focus-visible{outline:3px solid var(--primary-color);outline-offset:4px}
.projects-section .projects-count{font-size:.87rem;color:var(--text-muted);min-height:1.4em;margin-bottom:42px}
.projects-section .work-label{margin-bottom:18px}
.projects-section .projects-grid{display:grid;grid-template-columns:repeat(6,minmax(0,1fr));gap:18px;margin-bottom:42px}
.projects-section .project-item[hidden],.projects-section #featured-projects[hidden],.projects-section #more-projects[hidden]{display:none!important}
.projects-section .project-item{border:0;border-radius:0;box-shadow:none;cursor:default;min-width:0}
.projects-section .work-card{grid-column:span 2;background:#fff;border:1px solid var(--line-color);display:flex;flex-direction:column;overflow:hidden;transition:box-shadow .2s ease,transform .2s ease}
.projects-section .work-card:hover{transform:translateY(-3px);box-shadow:0 15px 35px rgba(22,24,29,.08)}
.projects-section .work-card--lead{grid-column:1/-1;display:grid;grid-template-columns:minmax(0,1.15fr) minmax(0,.85fr);background:var(--surface-strong)}
.projects-section .work-media{display:block;position:relative;overflow:hidden;aspect-ratio:16/10;background:var(--surface-strong)}
.projects-section .work-card--lead .work-media{height:100%;min-height:390px;aspect-ratio:auto}
.projects-section .work-media img{display:block;width:100%;height:100%;object-fit:cover;transition:transform .35s ease;position:absolute;inset:0}
.projects-section .work-card:hover .work-media img{transform:scale(1.035)}
.projects-section .work-copy{padding:24px 25px 26px;display:flex;flex-direction:column;align-items:flex-start;flex:1}
.projects-section .work-card--lead .work-copy{padding:clamp(32px,4.8vw,61px);justify-content:center}
.projects-section .work-category{display:block;font-size:.72rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--text-muted);margin-bottom:22px}
.projects-section .work-card h3{font-size:clamp(1.4rem,2.2vw,1.95rem);letter-spacing:-.045em;line-height:1.12;color:var(--text-color);margin:0 0 13px}
.projects-section .work-card--lead h3{font-size:clamp(2.3rem,4.2vw,4rem);line-height:1.02;margin-bottom:18px}
.projects-section .work-card p{font-size:.97rem;line-height:1.62;color:var(--text-muted);margin:0 0 27px}
.projects-section .work-card--lead p{font-size:1.05rem;max-width:330px}
.projects-section .work-action{margin-top:auto;color:var(--primary-color);border-bottom:1px solid var(--primary-color);text-decoration:none;padding-bottom:5px;font-size:.9rem;font-weight:700;display:inline-flex;gap:12px;transition:gap .2s ease}
.projects-section .work-action:hover{gap:18px}
.projects-section .project-more{border-top:1px solid var(--line-color);padding-top:28px}
.projects-section .project-more summary{list-style:none;display:flex;align-items:center;justify-content:space-between;gap:18px;cursor:pointer;min-height:56px;padding:4px 0 17px;color:var(--text-color);font-weight:650;font-size:clamp(1.1rem,2.1vw,1.5rem);letter-spacing:-.03em}
.projects-section .project-more summary::-webkit-details-marker{display:none}
.projects-section .project-more summary .more-label{display:flex;align-items:center;gap:19px;flex-wrap:wrap}
.projects-section .project-more summary .more-kicker{font-size:.69rem;font-weight:750;letter-spacing:.14em;text-transform:uppercase;color:var(--text-soft)}
.projects-section .project-more summary .more-toggle{border:1px solid var(--line-color);border-radius:50%;width:38px;height:38px;display:grid;place-items:center;flex:none;font-size:1.2rem;transition:transform .2s ease}
.projects-section .project-more[open] summary .more-toggle{transform:rotate(45deg)}
.projects-section .project-index{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:0 26px;padding:18px 0 0}
.projects-section .index-entry{display:grid;grid-template-columns:42px minmax(0,1fr) auto;gap:12px;align-items:center;padding:19px 0;border-bottom:1px solid var(--line-color);background:transparent;color:var(--text-color);min-width:0}
.projects-section .index-entry:hover{transform:none;box-shadow:none}
.projects-section .index-number{font-size:.75rem;color:var(--text-soft);font-weight:750;align-self:start;padding-top:5px}
.projects-section .index-entry h3{font-size:1.12rem;letter-spacing:-.03em;line-height:1.25;margin:0 0 6px;color:var(--text-color);font-weight:680}
.projects-section .index-entry p{font-size:.82rem;color:var(--text-muted);margin:0}
.projects-section .index-link{font-size:.8rem;white-space:nowrap;color:var(--primary-color);text-decoration:none;border-bottom:1px solid var(--line-color);padding-bottom:3px;font-weight:700}
.projects-section .index-link:hover{border-color:var(--primary-color)}
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
#skills{background:var(--bg);color:var(--text-color);padding:clamp(80px,9vw,138px) 0;border-top:1px solid var(--line-color)}
#skills .container{max-width:1200px}
#skills .skills-lead{display:grid;grid-template-columns:minmax(0,1.1fr) minmax(260px,.55fr);gap:clamp(28px,6vw,110px);align-items:end;margin-bottom:clamp(42px,6.5vw,88px)}
#skills .skills-kicker{display:block;margin-bottom:20px;font-size:.75rem;font-weight:750;letter-spacing:.15em;text-transform:uppercase;color:var(--text-muted)}
#skills .skills-lead h2{font-size:clamp(2.85rem,6.2vw,5.9rem);line-height:1.01;font-weight:650;letter-spacing:-.064em;color:var(--text-color);margin:0;max-width:830px}
#skills .skills-lead h2 em{font-family:Georgia,'Times New Roman',serif;font-weight:400}
#skills .skills-lead p{color:var(--text-muted);font-size:clamp(1rem,1.5vw,1.13rem);line-height:1.75;max-width:360px;margin:0 0 6px}
#skills .skills-body{display:grid;grid-template-columns:minmax(190px,.48fr) minmax(0,1.52fr);gap:clamp(30px,5vw,85px);border-top:1px solid var(--line-color);padding-top:36px}
#skills .skills-aside{position:relative}
#skills .skills-aside span{display:block;font-size:.76rem;letter-spacing:.13em;text-transform:uppercase;font-weight:750;color:var(--text-soft);margin-bottom:17px}
#skills .skills-aside p{font-size:clamp(1.28rem,2vw,1.9rem);line-height:1.35;color:var(--text-color);font-weight:600;letter-spacing:-.035em;max-width:280px;margin:0}
#skills .capability-list{display:grid;gap:0;list-style:none;padding:0;margin:0}
#skills .capability-item{display:grid;grid-template-columns:44px minmax(0,1fr);gap:22px;padding:30px 0 32px;border-bottom:1px solid var(--line-color);align-items:start}
#skills .capability-item:first-child{padding-top:0}
#skills .capability-number{font-size:.81rem;font-weight:750;color:var(--text-soft);letter-spacing:.07em;padding-top:6px}
#skills .capability-item h3{font-size:clamp(1.55rem,2.5vw,2.35rem);line-height:1.13;letter-spacing:-.047em;font-weight:650;color:var(--text-color);margin:0 0 11px}
#skills .capability-item p{font-size:1rem;color:var(--text-muted);line-height:1.62;margin:0 0 16px;max-width:660px}
#skills .capability-topics{display:flex;flex-wrap:wrap;gap:8px 18px}
#skills .capability-topics span{font-size:.87rem;line-height:1.4;font-weight:600;color:var(--text-muted)}
#skills .capability-topics span:not(:last-child)::after{content:"/";color:var(--accent-color);margin-left:18px}
#skills .toolbox{display:grid;grid-template-columns:minmax(190px,.48fr) minmax(0,1.52fr);gap:clamp(30px,5vw,85px);padding:32px 0 0;margin-top:48px;border-top:1px solid var(--line-color)}
#skills .toolbox h3{font-size:.76rem;letter-spacing:.13em;text-transform:uppercase;font-weight:750;color:var(--text-soft);margin:0}
#skills .tool-groups{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:30px}
#skills .tool-group strong{font-size:.9rem;display:block;margin-bottom:12px;color:var(--text-color);font-weight:700}
#skills .tool-group p{color:var(--text-muted);line-height:1.7;font-size:.97rem;margin:0}
#skills .skills-footer{margin:33px 0 0;font-size:.83rem;color:var(--text-soft)}
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
#experience{background:var(--bg);color:var(--text-color);padding:clamp(83px,9vw,138px) 0}
#experience .container{max-width:1200px}
#experience .experience-lead{display:grid;grid-template-columns:minmax(0,1.1fr) minmax(260px,.6fr);gap:clamp(25px,7vw,110px);align-items:end;margin-bottom:clamp(44px,6vw,82px)}
#experience .experience-kicker{display:block;margin-bottom:20px;font-size:.75rem;font-weight:750;letter-spacing:.15em;text-transform:uppercase;color:var(--text-soft)}
#experience .experience-lead h2{font-size:clamp(2.9rem,6vw,5.65rem);line-height:1.02;letter-spacing:-.065em;font-weight:650;color:var(--text-color);margin:0;max-width:780px}
#experience .experience-lead h2 em{font-family:Georgia,'Times New Roman',serif;font-weight:400}
#experience .experience-lead p{font-size:clamp(1rem,1.45vw,1.12rem);line-height:1.68;color:var(--text-muted);max-width:370px;margin:0 0 6px}
#experience .experience-timeline{max-width:none;margin:0;display:grid;gap:0;border-top:1px solid var(--line-color)}
#experience .timeline-item{margin:0;border-bottom:1px solid var(--line-color)}
#experience .timeline-item .timeline-content{display:grid;grid-template-columns:minmax(145px,.28fr) minmax(0,1fr);grid-template-rows:repeat(4,auto);column-gap:clamp(22px,6vw,95px);align-items:start;box-shadow:none;background:transparent;border:0;border-radius:0;transform:none;min-width:0;padding:clamp(30px,4vw,48px) 6px!important}
#experience .timeline-item:hover,#experience .timeline-item:hover .timeline-content{transform:none;box-shadow:none}
#experience .timeline-item:first-child .timeline-content{background:var(--surface-muted);padding-left:clamp(20px,3vw,38px)!important;padding-right:clamp(20px,3vw,38px)!important}
#experience .timeline-content .date{grid-column:1;grid-row:1/span 4;display:block;background:transparent;border:0;border-radius:0;margin:7px 0 0;padding:0;min-height:0;color:var(--text-muted);font-size:.88rem;letter-spacing:.025em;font-weight:750}
#experience .timeline-content h3{grid-column:2;color:var(--text-color);font-size:clamp(1.55rem,2.7vw,2.5rem);line-height:1.17;letter-spacing:-.045em;font-weight:650;margin:0 0 7px}
#experience .timeline-content h4{grid-column:2;color:var(--text-muted);font-size:1rem;font-weight:650;line-height:1.4;margin:0 0 14px}
#experience .timeline-content > p{grid-column:2;color:var(--text-muted);font-size:.98rem;line-height:1.7;max-width:780px;margin:0}
#experience .timeline-content > p strong{color:var(--text-muted);font-weight:700}
#experience .timeline-content .timeline-expandable{grid-column:2;margin:15px 0 0}
#experience .timeline-content > .timeline-list{grid-column:2}
#experience .timeline-toggle{background:transparent;border:0;border-radius:0;padding:0 0 7px;min-height:39px;margin:0;color:var(--primary-color);font-size:.88rem;font-weight:750;border-bottom:1px solid var(--text-soft);display:inline-flex;align-items:center;gap:12px;cursor:pointer;transition:gap .2s ease}
#experience .timeline-toggle:hover{color:var(--text-color);gap:17px;background:transparent}
#experience .timeline-toggle:focus-visible{outline:3px solid var(--primary-color);outline-offset:5px}
#experience .timeline-toggle .toggle-icon{transition:transform .2s ease}
#experience .timeline-details{padding:17px 0 0;color:var(--text-muted);max-width:800px}
#experience .timeline-list{display:grid;gap:12px;list-style:none;padding:0;margin:0}
#experience .timeline-list li{line-height:1.65;font-size:.93rem;padding-left:18px;color:var(--text-muted)}
#experience .timeline-list li::before{background:var(--line-strong);width:6px;height:6px;top:.66em}
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

<!-- Organizations & communities -->
<section id="organizations" class="organizations-section" aria-labelledby="organizations-heading">
<style>
#organizations{background:var(--bg);color:var(--text-color);padding:clamp(76px,9vw,132px) 0}
#organizations .container{max-width:1200px}
#organizations .org-header{display:grid;grid-template-columns:minmax(0,1fr) minmax(255px,.55fr);gap:clamp(28px,7vw,110px);align-items:end;margin-bottom:clamp(40px,5vw,65px)}
#organizations .org-kicker{display:block;font-size:.75rem;font-weight:750;letter-spacing:.14em;text-transform:uppercase;color:var(--text-muted);margin-bottom:19px}
#organizations .org-header h2{font-size:clamp(2.9rem,5.8vw,5.5rem);font-weight:650;letter-spacing:-.065em;line-height:1.03;color:var(--text-color);margin:0}
#organizations .org-header h2 em{font-family:Georgia,'Times New Roman',serif;font-weight:400}
#organizations .org-header p{max-width:375px;line-height:1.7;color:var(--text-muted);font-size:1.04rem;margin:0 0 7px}
#organizations .org-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:0 clamp(20px,5vw,72px)}
#organizations .org-record{display:grid;grid-template-columns:35px minmax(0,1fr);gap:16px;align-items:start;border-top:1px solid var(--line-color);padding:clamp(22px,3vw,34px) 0;min-width:0}
#organizations .org-number{color:var(--text-soft);font-size:.8rem;font-weight:750;letter-spacing:.04em;padding-top:6px}
#organizations .org-record h3{font-size:clamp(1.27rem,1.9vw,1.75rem);font-weight:650;letter-spacing:-.04em;line-height:1.2;color:var(--text-color);margin:0 0 12px}
#organizations .org-role{font-size:.95rem;color:var(--text-muted);margin:0 0 6px;font-weight:650}
#organizations .org-date{color:var(--text-soft);font-size:.83rem}
@media(max-width:810px){#organizations .org-header{grid-template-columns:1fr;gap:22px}}
@media(max-width:600px){#organizations .org-grid{grid-template-columns:1fr}#organizations .org-record{padding:24px 0}}
</style>
    <div class="container">
        <header class="org-header">
            <div>
                <span class="org-kicker">Communities / Ventures / Leadership</span>
                <h2 id="organizations-heading">Beyond the <em>day job.</em></h2>
            </div>
            <p>Studios, initiatives, and communities I've helped lead or contribute to, across design, education, and social impact.</p>
        </header>
        <div class="org-grid" aria-label="Organizations and roles">
            <article class="org-record">
                <span class="org-number" aria-hidden="true">01</span>
                <div><h3>InstiWitty Media Studios</h3><p class="org-role">Director</p><p class="org-date">May 2018 – Present</p></div>
            </article>
            <article class="org-record">
                <span class="org-number" aria-hidden="true">02</span>
                <div><h3>Aashayen Foundation</h3><p class="org-role">Founder &amp; President</p><p class="org-date">2015 – Present</p></div>
            </article>
            <article class="org-record">
                <span class="org-number" aria-hidden="true">03</span>
                <div><h3>Microsoft Student Association</h3><p class="org-role">Student Ambassador</p></div>
            </article>
            <article class="org-record">
                <span class="org-number" aria-hidden="true">04</span>
                <div><h3>OmniCan</h3><p class="org-role">Founder</p><p class="org-date">2023 – Present</p></div>
            </article>
            <article class="org-record">
                <span class="org-number" aria-hidden="true">05</span>
                <div><h3>EazyHaven</h3><p class="org-role">Founder</p><p class="org-date">2021 – Present</p></div>
            </article>
            <article class="org-record">
                <span class="org-number" aria-hidden="true">06</span>
                <div><h3>Dahej</h3><p class="org-role">City Leader</p><p class="org-date">2014 – 2015</p></div>
            </article>
        </div>
    </div>
</section>

<!-- Education -->
<section id="education" class="experience-section education-editorial" aria-labelledby="education-heading">
<style>
#education.education-editorial{background:var(--bg-elevated);color:var(--text-color);padding:clamp(77px,9vw,132px) 0}
#education .container{max-width:1200px}
#education .education-header{display:grid;grid-template-columns:minmax(0,1fr) minmax(260px,.58fr);gap:clamp(25px,7vw,100px);align-items:end;margin-bottom:clamp(39px,6vw,70px)}
#education .education-kicker{display:block;font-size:.75rem;font-weight:750;letter-spacing:.14em;text-transform:uppercase;color:var(--text-soft);margin-bottom:19px}
#education .education-header h2{font-size:clamp(2.9rem,5.9vw,5.65rem);letter-spacing:-.065em;line-height:1.03;font-weight:650;color:var(--text-color);margin:0}
#education .education-header h2 em{font-family:Georgia,'Times New Roman',serif;font-weight:400}
#education .education-header p{max-width:365px;line-height:1.7;font-size:1.04rem;color:var(--text-muted);margin:0 0 7px}
#education .education-list{display:grid;border-top:1px solid var(--line-color)}
#education .education-record{display:grid;grid-template-columns:minmax(145px,.35fr) minmax(0,1fr);gap:clamp(28px,6vw,100px);padding:clamp(30px,4vw,52px) 0;border-bottom:1px solid var(--line-color)}
#education .education-years{font-weight:750;font-size:.92rem;color:var(--text-soft);letter-spacing:.015em;margin:5px 0 0}
#education .education-type{display:block;font-size:.74rem;font-weight:750;text-transform:uppercase;letter-spacing:.11em;color:var(--text-muted);margin-bottom:16px}
#education .education-record h3{font-size:clamp(1.9rem,3.6vw,3.25rem);font-weight:650;letter-spacing:-.055em;line-height:1.13;color:var(--text-color);margin:0 0 11px}
#education .education-school{color:var(--text-muted);font-weight:650;font-size:1rem;margin:0 0 14px}
#education .education-description{font-size:1rem;line-height:1.7;color:var(--text-muted);margin:0;max-width:750px}
#education .education-details{margin-top:24px;border-top:1px solid var(--line-color);padding-top:14px}
#education .education-details summary{cursor:pointer;list-style:none;display:inline-flex;align-items:center;gap:12px;color:var(--primary-color);font-size:.9rem;font-weight:750;min-height:34px}
#education .education-details summary::-webkit-details-marker{display:none}
#education .education-details summary:after{content:"+";font-size:1.22rem;line-height:1;transition:transform .2s ease}
#education .education-details[open] summary:after{transform:rotate(45deg)}
#education .education-details summary:focus-visible{outline:3px solid var(--primary-color);outline-offset:4px}
#education .education-details ul{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px 25px;list-style:none;margin:18px 0 0;padding:0}
#education .education-details li{font-size:.92rem;line-height:1.55;color:var(--text-muted);position:relative;padding-left:15px}
#education .education-details li:before{content:"";background:var(--line-strong);width:5px;height:5px;border-radius:50%;position:absolute;left:0;top:.66em}
@media(max-width:810px){#education .education-header{grid-template-columns:1fr;gap:22px}}
@media(max-width:620px){#education .education-record{grid-template-columns:1fr;gap:18px}#education .education-details ul{grid-template-columns:1fr}}
@media(prefers-reduced-motion:reduce){#education .education-details summary:after{transition:none}}
</style>
    <div class="container">
        <header class="education-header">
            <div>
                <span class="education-kicker">Education / Foundations</span>
                <h2 id="education-heading">Two worlds.<br><em>One perspective.</em></h2>
            </div>
            <p>Engineering taught me how systems work. Business taught me how decisions travel. Design connects the two.</p>
        </header>
        <div class="education-list">
            <article class="education-record">
                <p class="education-years">2024 – 2025</p>
                <div>
                    <span class="education-type">Graduate Certificate</span>
                    <h3>Global Business Management</h3>
                    <p class="education-school">Fleming College · Ontario, Canada</p>
                    <p class="education-description">Specializing in international business strategies, cross-cultural management, and global marketing with a focus on digital transformation.</p>
                    <details class="education-details">
                        <summary>Coursework &amp; areas of study</summary>
                        <ul>
                            <li>Global Business Strategies and Leadership</li>
                            <li>International Marketing and Digital Branding</li>
                            <li>Cross-Cultural Management and Communication</li>
                            <li>Financial Management for Global Operations</li>
                            <li>Digital Transformation and Innovation</li>
                        </ul>
                    </details>
                </div>
            </article>
            <article class="education-record">
                <p class="education-years">2012 – 2016</p>
                <div>
                    <span class="education-type">Bachelor of Engineering (BE)</span>
                    <h3>Computer Science Engineering</h3>
                    <p class="education-school">Jiwaji University · Madhya Pradesh, India</p>
                    <p class="education-description">Comprehensive education in computer science principles, programming, and software development with additional focus on design and user experience.</p>
                    <details class="education-details">
                        <summary>Coursework &amp; areas of study</summary>
                        <ul>
                            <li>Data Structures and Algorithms</li>
                            <li>Software Engineering and Development</li>
                            <li>Database Management Systems</li>
                            <li>Web Development and UI Design</li>
                            <li>Computer Networks and Security</li>
                        </ul>
                    </details>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- Certifications Section -->
<?php include 'certifications-section.php'; ?>


<!-- Contact Section: editorial closing and preserved message form -->
<section id="contact" class="contact-section" aria-labelledby="contact-heading">
<style>
/* Contact: an editorial closing section, scoped so the existing form logic stays intact. */
#contact.contact-section{background:var(--text-color);color:var(--bg);padding:clamp(84px,9vw,138px) 0}
#contact .container{max-width:1200px}
#contact .contact-head{display:grid;grid-template-columns:minmax(0,1.2fr) minmax(250px,.55fr);gap:clamp(26px,6vw,110px);align-items:end;padding-bottom:clamp(40px,6vw,70px);margin-bottom:clamp(36px,5vw,58px);border-bottom:1px solid rgba(245,242,236,.2)}
#contact .contact-kicker{display:block;font-size:.74rem;letter-spacing:.16em;text-transform:uppercase;font-weight:750;color:var(--accent-color);margin:0 0 22px}
#contact .contact-head h2{font-size:clamp(3rem,6.8vw,6.65rem);line-height:.98;letter-spacing:-.065em;font-weight:650;color:#f5f2ec;max-width:920px;margin:0}
#contact .contact-head h2 em{font-family:Georgia,'Times New Roman',serif;font-weight:400;color:var(--line-color)}
#contact .contact-head p{font-size:clamp(1rem,1.45vw,1.12rem);line-height:1.72;color:var(--accent-color);margin:0 0 6px;max-width:350px}
#contact .contact-content{display:grid;grid-template-columns:minmax(0,.9fr) minmax(0,1.1fr);gap:clamp(32px,6vw,94px);align-items:start}
#contact .contact-info{padding:0;border:0;border-radius:0;box-shadow:none;background:transparent}
#contact .contact-info h3{color:#f5f2ec;font-size:clamp(1.65rem,3vw,2.7rem);font-weight:640;letter-spacing:-.048em;line-height:1.13;margin:0 0 18px}
#contact .contact-info>p{color:var(--accent-color);font-size:1.04rem;line-height:1.7;max-width:460px;margin:0 0 36px}
#contact .contact-details{display:block;margin:0;border-top:1px solid rgba(245,242,236,.2)}
#contact .contact-item{display:grid;grid-template-columns:minmax(98px,.32fr) minmax(0,1fr);gap:12px;align-items:start;padding:23px 0;border:0;border-bottom:1px solid rgba(245,242,236,.2);border-radius:0;background:transparent;min-width:0}
#contact .contact-icon{display:none}
#contact .contact-text{min-width:0}
#contact .contact-item h4{font-size:.76rem;font-weight:750;letter-spacing:.12em;text-transform:uppercase;color:var(--accent-color);margin:3px 0 0}
#contact .contact-item p{color:var(--bg);font-size:.96rem;line-height:1.55;margin:0 0 9px}
#contact .contact-item p:last-child{margin-bottom:0}
#contact .contact-item p strong{color:var(--accent-color);font-size:.8rem;display:block;line-height:1.6;font-weight:600;letter-spacing:.015em}
#contact .contact-item p a{color:var(--bg);font-size:1.08rem;font-weight:600;line-height:1.45;text-decoration:none;border-bottom:1px solid rgba(245,242,236,.45);padding-bottom:2px;overflow-wrap:anywhere}
#contact .contact-item p a:hover{border-bottom-color:#fff}
#contact .contact-item .contact-mail-link{font-size:1rem}
#contact .contact-socials{display:flex;flex-wrap:wrap;gap:10px 24px;padding-top:30px}
#contact .contact-socials a{color:var(--surface-strong);text-decoration:none;font-size:.88rem;font-weight:650;display:inline-flex;align-items:center;gap:7px;min-height:40px;border-bottom:1px solid rgba(245,242,236,.35);transition:color .2s ease,border-color .2s ease}
#contact .contact-socials a:hover{color:#fff;border-bottom-color:#fff}
#contact .contact-form{border:1px solid var(--line-color);border-radius:0;background:var(--bg-elevated);box-shadow:none;padding:clamp(26px,4.3vw,52px);color:var(--text-color)}
#contact .contact-form-intro{border-bottom:1px solid var(--line-color);padding-bottom:27px;margin-bottom:30px}
#contact .contact-form-label{display:block;color:var(--text-soft);font-size:.72rem;font-weight:750;letter-spacing:.14em;text-transform:uppercase;margin-bottom:18px}
#contact .contact-form-intro h3{font-size:clamp(1.8rem,2.65vw,2.8rem);line-height:1.1;font-weight:650;color:var(--text-color);letter-spacing:-.05em;margin:0 0 14px}
#contact .contact-form-intro p{color:var(--text-soft);line-height:1.6;font-size:.96rem;margin:0}
#contact .contact-form fieldset{min-width:0}
#contact .contact-form .form-group{margin-bottom:20px}
#contact .contact-form .form-group label{display:block;margin-bottom:9px;color:var(--text-color);font-size:.85rem;font-weight:700}
#contact .contact-form .form-group input,#contact .contact-form .form-group textarea{display:block;width:100%;border:1px solid var(--line-color);border-radius:4px;min-height:52px;padding:14px 16px;color:var(--text-color);background:#fff;font-size:.96rem;box-shadow:none;transition:border-color .2s ease,box-shadow .2s ease}
#contact .contact-form .form-group textarea{min-height:148px;resize:vertical}
#contact .contact-form .form-group input:focus,#contact .contact-form .form-group textarea:focus{outline:none;border-color:var(--primary-color);box-shadow:0 0 0 3px rgba(22,24,29,.12)}
#contact .contact-form .form-group input::placeholder,#contact .contact-form .form-group textarea::placeholder{color:var(--line-strong)}
#contact .contact-form .form-help{font-size:.8rem;color:var(--text-soft);line-height:1.5}
#contact .contact-form .btn.btn-primary{display:inline-flex;align-items:center;justify-content:center;gap:12px;width:100%;min-height:56px;border-radius:4px;border:1px solid var(--primary-color);background:var(--primary-color);color:#fff;font-size:.97rem;font-weight:700;transition:background-color .2s ease,transform .2s ease}
#contact .contact-form .btn.btn-primary:hover{background:var(--primary-dark);transform:translateY(-2px)}
#contact .contact-form .btn.btn-primary:focus-visible,#contact .contact-socials a:focus-visible,#contact .contact-item a:focus-visible{outline:3px solid var(--line-color);outline-offset:4px}
#contact .contact-form #submit-help{text-align:center;margin-top:13px}
#contact .contact-form .h-captcha{max-width:100%;overflow:hidden}
#contact .form-message{border-radius:4px;line-height:1.4}
@media(max-width:1000px){#contact .contact-head{grid-template-columns:1fr;gap:24px}#contact .contact-content{grid-template-columns:1fr;gap:40px}#contact .contact-info>p{max-width:700px}#contact .contact-details{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:0 25px}}
@media(max-width:620px){#contact .contact-head h2{font-size:clamp(3rem,12vw,4.65rem)}#contact .contact-details{grid-template-columns:1fr}#contact .contact-item{grid-template-columns:90px 1fr}#contact .contact-form{padding:25px 20px}#contact .contact-content{gap:38px}}
@media(max-width:360px){#contact .contact-item{grid-template-columns:1fr;gap:10px}#contact .contact-item h4{margin:0}}
@media(prefers-reduced-motion:reduce){#contact .contact-socials a,#contact .contact-form .btn.btn-primary,#contact .contact-form .form-group input,#contact .contact-form .form-group textarea{transition:none}}
</style>
    <div class="container">
        <header class="contact-head">
            <div>
                <span class="contact-kicker">Contact / Start a conversation</span>
                <h2 id="contact-heading">Have something in mind?<br><em>Let's talk.</em></h2>
            </div>
            <p>From product experiences to new ideas worth testing, I'm always interested in a thoughtful collaboration.</p>
        </header>
        <div class="contact-content">
            <div class="contact-info" data-aos="fade-up">
                <h3>You can reach me directly.</h3>
                <p>Prefer email or a call? Choose whatever works for you. I'm happy to discuss design work, product opportunities, and new collaborations.</p>
                <div class="contact-details">
                    <div class="contact-item">
                        <h4>Phone</h4>
                        <div class="contact-text">
                            <p><strong>India</strong><a href="tel:+918770496690">+91 87704 96690</a></p>
                            <p><strong>Canada / US</strong><a href="tel:+16472745418">+1 (647) 274 5418</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <h4>Email</h4>
                        <div class="contact-text">
                            <p><a class="contact-mail-link" href="mailto:contact@imshivam.com">contact@imshivam.com</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <h4>Location</h4>
                        <div class="contact-text"><p>East York, Ontario, Canada</p></div>
                    </div>
                    <div class="contact-item">
                        <h4>Availability</h4>
                        <div class="contact-text"><p>Open to freelance &amp; full-time opportunities</p></div>
                    </div>
                </div>
                <nav class="contact-socials" aria-label="Social profiles">
                    <a href="https://www.linkedin.com/in/shivampatsariya/" target="_blank" rel="noopener noreferrer">LinkedIn <span aria-hidden="true">↗</span></a>
                    <a href="https://www.behance.net/shivampatsariya" target="_blank" rel="noopener noreferrer">Behance <span aria-hidden="true">↗</span></a>
                    <a href="https://www.instagram.com/savvyshivam/" target="_blank" rel="noopener noreferrer">Instagram <span aria-hidden="true">↗</span></a>
                    <a href="https://twitter.com/spatsariya" target="_blank" rel="noopener noreferrer">Twitter <span aria-hidden="true">↗</span></a>
                </nav>
            </div>
            <div class="contact-form contact-form-editorial" data-aos="fade-up" data-aos-delay="100">
                <div class="contact-form-intro">
                    <span class="contact-form-label">Or send a message</span>
                    <h3>Tell me what you're working on.</h3>
                    <p>A little context is all I need to get the conversation started.</p>
                </div>
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