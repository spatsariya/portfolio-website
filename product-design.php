<?php
/**
 * Product design case studies.
 *
 * This native page uses verified portfolio content and the site's shared
 * components. The external ChatGPT-hosted portfolio remains linked so its
 * additional material stays accessible without an unreliable iframe.
 */
$seoIsHomepage = false;
$seoCanonicalEnabled = true;
$seoTitle = 'Product Design Case Studies | Shivam Patsariya';
$seoDescription = 'Selected UX and product design work by Shivam Patsariya, spanning Virgin Plus, Flipkart, healthcare learning, and subscription management.';
$seoCanonical = 'https://imshivam.com/product-design';
include 'includes/header.php';
?>

<style>
/* Product design page: use the portfolio's existing design tokens. */
.pd-page { background: var(--bg); color: var(--text-color); }
.pd-page .pd-container { max-width: 1200px; }
.pd-page .pd-kicker { display: inline-flex; align-items: center; gap: 14px; margin-bottom: 24px; text-transform: uppercase; letter-spacing: .16em; font-size: .75rem; font-weight: 750; color: var(--text-muted); }
.pd-page .pd-kicker::before { content: ""; display: inline-block; width: 27px; height: 1px; background: var(--secondary-color); }
.pd-page .pd-hero { padding: clamp(70px, 9vw, 130px) 0 clamp(60px, 7vw, 100px); }
.pd-page .pd-hero-grid { display: grid; grid-template-columns: minmax(0, 1.5fr) minmax(230px, .62fr); gap: clamp(28px, 6vw, 100px); align-items: end; }
.pd-page .pd-hero h1 { font-size: clamp(3.2rem, 7vw, 7.1rem); font-weight: 650; line-height: 1.03; letter-spacing: -.073em; max-width: 960px; }
.pd-page .pd-hero h1 em, .pd-page .pd-section-heading em { font-family: Georgia, 'Times New Roman', serif; font-weight: 400; color: var(--text-soft); }
.pd-page .pd-lede { font-size: clamp(1.06rem, 1.55vw, 1.22rem); line-height: 1.72; margin-bottom: 27px; max-width: 395px; }
.pd-page .pd-actions { display: flex; flex-wrap: wrap; gap: 13px 24px; align-items: center; }
.pd-page .pd-link-primary { display: inline-flex; align-items: center; justify-content: center; min-height: 48px; padding: 12px 20px; background: var(--primary-color); color: white; font-weight: 700; border: 1px solid var(--primary-color); border-radius: 4px; font-size: .92rem; }
.pd-page .pd-link-primary:hover { color: white; background: var(--primary-dark); }
.pd-page .pd-link-text { display: inline-flex; gap: 10px; align-items: center; color: var(--primary-color); font-size: .9rem; font-weight: 700; border-bottom: 1px solid var(--line-strong); min-height: 42px; }
.pd-page .pd-link-text:hover { border-bottom-color: var(--primary-color); }
.pd-page .pd-note { margin-top: 23px; font-size: .78rem; color: var(--text-soft); max-width: 380px; }
.pd-page .pd-rail { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 0; margin-top: clamp(48px, 7vw, 90px); border-top: 1px solid var(--line-color); border-bottom: 1px solid var(--line-color); }
.pd-page .pd-rail > div { padding: 23px 16px 23px 0; }
.pd-page .pd-rail > div + div { border-left: 1px solid var(--line-color); padding-left: clamp(15px, 3vw, 34px); }
.pd-page .pd-rail strong { display: block; font-size: .75rem; letter-spacing: .14em; font-weight: 750; text-transform: uppercase; margin-bottom: 7px; }
.pd-page .pd-rail span { color: var(--text-muted); font-size: .91rem; }
.pd-page .pd-section-heading { font-size: clamp(2.65rem, 5.2vw, 5.1rem); font-weight: 650; letter-spacing: -.065em; line-height: 1.07; }
.pd-page .pd-section-intro { display: grid; grid-template-columns: minmax(0, 1.25fr) minmax(250px, .64fr); align-items: end; gap: 32px; margin-bottom: 47px; }
.pd-page .pd-section-intro > p { max-width: 360px; line-height: 1.78; font-size: 1.02rem; }
.pd-page .pd-work { padding: clamp(75px, 8vw, 115px) 0; background: var(--bg-elevated); }
.pd-page .pd-case { display: grid; grid-template-columns: minmax(0, 1.04fr) minmax(0, .96fr); background: var(--surface); border: 1px solid var(--line-color); min-height: 445px; }
.pd-page .pd-case + .pd-case { margin-top: 20px; }
.pd-page .pd-case:nth-of-type(even) .pd-visual { order: 2; }
.pd-page .pd-case:nth-of-type(even) .pd-case-content { order: 1; }
.pd-page .pd-visual { position: relative; overflow: hidden; background: var(--primary-color); display: flex; align-items: center; justify-content: center; min-height: 350px; }
.pd-page .pd-visual img { width: 100%; height: 100%; object-fit: cover; position: absolute; inset: 0; }
.pd-page .pd-visual-abstract { background: #e7e0d6; padding: 38px; display: flex; flex-direction: column; justify-content: space-between; align-items: flex-start; }
.pd-page .pd-visual-abstract::before { content: ""; position: absolute; width: 270px; height: 270px; border: 1px solid rgba(31,58,95,.18); border-radius: 50%; right: -55px; top: -75px; box-shadow: 0 0 0 52px rgba(31,58,95,.045), 0 0 0 105px rgba(31,58,95,.035); }
.pd-page .pd-visual-abstract .pd-visual-label { position: relative; z-index: 1; text-transform: uppercase; font-size: .72rem; letter-spacing: .16em; color: var(--primary-color); font-weight: 750; }
.pd-page .pd-visual-abstract strong { position: relative; z-index: 1; color: var(--primary-color); font-family: var(--heading-font); font-size: clamp(3rem, 5.6vw, 6.5rem); line-height: .99; letter-spacing: -.08em; font-weight: 750; max-width: 540px; overflow-wrap: anywhere; }
.pd-page .pd-visual-abstract.pd-visual-dark { background: #1f3a5f; }
.pd-page .pd-visual-abstract.pd-visual-dark .pd-visual-label, .pd-page .pd-visual-abstract.pd-visual-dark strong { color: #f4f1ea; }
.pd-page .pd-visual-abstract.pd-visual-dark::before { border-color: rgba(255,255,255,.2); box-shadow: 0 0 0 52px rgba(255,255,255,.045), 0 0 0 105px rgba(255,255,255,.035); }
.pd-page .pd-case-content { display: flex; flex-direction: column; justify-content: center; align-items: flex-start; padding: clamp(31px, 5vw, 70px); }
.pd-page .pd-case-index { color: var(--text-soft); font-weight: 750; text-transform: uppercase; font-size: .72rem; letter-spacing: .14em; margin-bottom: 20px; }
.pd-page .pd-case h3 { font-size: clamp(1.9rem, 3vw, 3.15rem); font-weight: 650; line-height: 1.12; letter-spacing: -.05em; margin-bottom: 20px; }
.pd-page .pd-case-content > p { line-height: 1.75; margin-bottom: 25px; font-size: .99rem; }
.pd-page .pd-case-facts { display: flex; flex-wrap: wrap; gap: 9px; margin: 0 0 27px; }
.pd-page .pd-case-facts li { color: var(--primary-color); font-size: .73rem; font-weight: 650; border: 1px solid var(--line-color); padding: 7px 10px; border-radius: 3px; }
.pd-page .pd-method { padding: clamp(70px, 8vw, 115px) 0; }
.pd-page .pd-method-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px; }
.pd-page .pd-method-grid article { padding: clamp(24px, 3vw, 36px); background: var(--surface); border: 1px solid var(--line-color); }
.pd-page .pd-method-grid .pd-method-number { font-size: .76rem; color: var(--text-soft); letter-spacing: .13em; font-weight: 750; }
.pd-page .pd-method-grid h3 { margin: 44px 0 17px; font-size: clamp(1.4rem, 2vw, 2rem); letter-spacing: -.035em; }
.pd-page .pd-method-grid p { font-size: .95rem; line-height: 1.72; }
.pd-page .pd-cta { padding: clamp(66px, 7vw, 100px) 0; background: var(--primary-color); }
.pd-page .pd-cta-grid { display: grid; grid-template-columns: minmax(0, 1.15fr) minmax(230px, .65fr); gap: 32px; align-items: end; }
.pd-page .pd-cta .pd-kicker, .pd-page .pd-cta h2, .pd-page .pd-cta p { color: #f4f1ea; }
.pd-page .pd-cta .pd-kicker::before { background: var(--accent-color); }
.pd-page .pd-cta h2 { font-size: clamp(2.6rem, 5.4vw, 5.5rem); font-weight: 650; letter-spacing: -.065em; line-height: 1.05; }
.pd-page .pd-cta .pd-link-primary { background: #f4f1ea; color: var(--primary-color); border-color: #f4f1ea; }
.pd-page .pd-cta .pd-link-primary:hover { background: white; color: var(--primary-color); }
.pd-page .pd-cta p { margin-bottom: 22px; line-height: 1.7; }
.pd-page a:focus-visible { outline: 3px solid var(--secondary-color); outline-offset: 4px; }
@media (max-width: 850px) {
  .pd-page .pd-hero-grid, .pd-page .pd-section-intro, .pd-page .pd-cta-grid { grid-template-columns: 1fr; }
  .pd-page .pd-lede { max-width: 650px; }
  .pd-page .pd-case { grid-template-columns: 1fr; }
  .pd-page .pd-case:nth-of-type(even) .pd-visual, .pd-page .pd-case:nth-of-type(even) .pd-case-content { order: initial; }
  .pd-page .pd-visual { min-height: 330px; }
}
@media (max-width: 620px) {
  .pd-page .pd-rail { grid-template-columns: 1fr; }
  .pd-page .pd-rail > div, .pd-page .pd-rail > div + div { padding: 15px 0; border-left: 0; }
  .pd-page .pd-rail > div + div { border-top: 1px solid var(--line-color); }
  .pd-page .pd-method-grid { grid-template-columns: 1fr; }
  .pd-page .pd-case-content { padding: 28px 23px 35px; }
  .pd-page .pd-visual { min-height: 280px; }
  .pd-page .pd-visual-abstract strong { font-size: clamp(3.5rem, 12vw, 5rem); }
}
</style>

<div class="pd-page">
    <section class="pd-hero" aria-labelledby="pd-hero-title">
        <div class="container pd-container">
            <span class="pd-kicker">Product design / Selected work</span>
            <div class="pd-hero-grid">
                <div>
                    <h1 id="pd-hero-title">Useful by design.<br><em>Clear by intention.</em></h1>
                </div>
                <div>
                    <p class="pd-lede">From the first user flow to a product people can rely on, I work across research, interfaces, design systems and implementation.</p>
                    <div class="pd-actions">
                        <a class="pd-link-primary" href="#case-studies">Explore case studies <span aria-hidden="true">↗</span></a>
                        <a class="pd-link-text" href="https://shivam-patsariya-product-design-portfolio.shivampatsariya.chatgpt.site" target="_blank" rel="noopener noreferrer">View original portfolio <span aria-hidden="true">↗</span></a>
                    </div>
                    <p class="pd-note">A focused collection of product work, alongside the original interactive portfolio.</p>
                </div>
            </div>
            <div class="pd-rail" aria-label="Areas of practice">
                <div><strong>01 / Discover</strong><span>Understand users, friction and goals</span></div>
                <div><strong>02 / Design</strong><span>Shape accessible, coherent experiences</span></div>
                <div><strong>03 / Deliver</strong><span>Work closely with development and product</span></div>
            </div>
        </div>
    </section>

    <section class="pd-work" id="case-studies" aria-labelledby="pd-work-title">
        <div class="container pd-container">
            <div class="pd-section-intro">
                <div>
                    <span class="pd-kicker">01 / The work</span>
                    <h2 class="pd-section-heading" id="pd-work-title">Selected projects.<br><em>Real problems.</em></h2>
                </div>
                <p>Consumer journeys, commerce experiences, and self-initiated products. Each one calls for a different balance of clarity, usability and technical execution.</p>
            </div>

            <article class="pd-case" aria-labelledby="pd-case-virgin">
                <div class="pd-visual">
                    <img src="images/content/virgin-plus.webp" alt="Virgin Plus My Benefits mobile rewards app interface concepts" loading="lazy" decoding="async" width="1024" height="768">
                </div>
                <div class="pd-case-content">
                    <span class="pd-case-index">01 / Telecom · Mobile experience</span>
                    <h3 id="pd-case-virgin">Virgin Plus<br>My Benefits</h3>
                    <p>Making a mobile rewards experience easier to explore, with clearer navigation, benefit categories and more understandable paths from discovery to redemption.</p>
                    <ul class="pd-case-facts" aria-label="Design focus"><li>UX design</li><li>Navigation</li><li>Accessibility</li></ul>
                    <a class="pd-link-text" href="https://www.figma.com/proto/QF4Mrfc8NR1oupQOVrri75/Shivam-Patsariya---Portfolio?page-id=12%3A68&amp;node-id=13-83&amp;starting-point-node-id=13%3A83&amp;t=URGumBC1RI91aJOu-1" target="_blank" rel="noopener noreferrer">Explore Figma prototype <span aria-hidden="true">↗</span></a>
                </div>
            </article>

            <article class="pd-case" aria-labelledby="pd-case-commerce">
                <div class="pd-visual pd-visual-abstract">
                    <span class="pd-visual-label">Commerce / Discovery</span>
                    <strong>Shop.<br>Share.<br>Earn.</strong>
                </div>
                <div class="pd-case-content">
                    <span class="pd-case-index">02 / Social commerce · Mobile UX</span>
                    <h3 id="pd-case-commerce">Flipkart, 2GUD<br>&amp; Shopsy</h3>
                    <p>Exploring how social shopping can make discovery and purchasing feel connected, including video-led commerce and reseller-oriented journeys.</p>
                    <ul class="pd-case-facts" aria-label="Design focus"><li>Product design</li><li>Commerce flows</li><li>Visual systems</li></ul>
                    <a class="pd-link-text" href="/#experience">Read about this experience <span aria-hidden="true">↗</span></a>
                </div>
            </article>

            <article class="pd-case" aria-labelledby="pd-case-rwt">
                <div class="pd-visual pd-visual-abstract pd-visual-dark">
                    <span class="pd-visual-label">Healthcare / Learning</span>
                    <strong>Learn.<br>Practice.<br>Review.</strong>
                </div>
                <div class="pd-case-content">
                    <span class="pd-case-index">03 / Healthcare education · Platform design</span>
                    <h3 id="pd-case-rwt">Radiology<br>Without Tears</h3>
                    <p>Designing and building a learning experience that brings educational resources, structured cases and medical imaging tools into one connected workflow.</p>
                    <ul class="pd-case-facts" aria-label="Design focus"><li>Information architecture</li><li>Web platform</li><li>Clinical learning</li></ul>
                    <a class="pd-link-text" href="https://rwtradiology.com/" target="_blank" rel="noopener noreferrer">Explore live platform <span aria-hidden="true">↗</span></a>
                </div>
            </article>

            <article class="pd-case" aria-labelledby="pd-case-subs">
                <div class="pd-visual pd-visual-abstract">
                    <span class="pd-visual-label">Personal finance / SaaS</span>
                    <strong>Every<br>renewal.<br>In view.</strong>
                </div>
                <div class="pd-case-content">
                    <span class="pd-case-index">04 / SaaS · Product design &amp; development</span>
                    <h3 id="pd-case-subs">Subscription<br>Manager</h3>
                    <p>A recurring-expense tool designed to help people organize their subscriptions, understand spending and keep upcoming renewals visible.</p>
                    <ul class="pd-case-facts" aria-label="Design focus"><li>Product strategy</li><li>Responsive UI</li><li>Full-stack build</li></ul>
                    <a class="pd-link-text" href="https://www.subscriptionmanager.app/" target="_blank" rel="noopener noreferrer">Explore live product <span aria-hidden="true">↗</span></a>
                </div>
            </article>
        </div>
    </section>

    <section class="pd-method" aria-labelledby="pd-method-title">
        <div class="container pd-container">
            <div class="pd-section-intro">
                <div>
                    <span class="pd-kicker">02 / My approach</span>
                    <h2 class="pd-section-heading" id="pd-method-title">Thoughtful systems.<br><em>Practical execution.</em></h2>
                </div>
                <p>My engineering and business backgrounds help me connect a polished interface to the system, team and constraints behind it.</p>
            </div>
            <div class="pd-method-grid">
                <article>
                    <span class="pd-method-number">01 / Understand</span>
                    <h3>Start with the problem.</h3>
                    <p>Clarify user needs, business goals and where a current experience creates friction before jumping into screens.</p>
                </article>
                <article>
                    <span class="pd-method-number">02 / Shape</span>
                    <h3>Make complexity feel simple.</h3>
                    <p>Build information hierarchies, accessible interaction patterns and reusable components that support real tasks.</p>
                </article>
                <article>
                    <span class="pd-method-number">03 / Ship</span>
                    <h3>Design with delivery in mind.</h3>
                    <p>Prototype, collaborate with engineers and refine the working product rather than stopping at a static mockup.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="pd-cta" aria-labelledby="pd-cta-title">
        <div class="container pd-container pd-cta-grid">
            <div>
                <span class="pd-kicker">03 / Let's build</span>
                <h2 id="pd-cta-title">Have a problem<br>worth solving?</h2>
            </div>
            <div>
                <p>I'm interested in thoughtful product challenges, UX design, and turning complex workflows into clear experiences.</p>
                <a class="pd-link-primary" href="/#contact">Start a conversation <span aria-hidden="true">↗</span></a>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>
