</main>
<style>
/* Footer: restrained editorial finish, related to the green contact section above. */
#site-footer{background:#111318;color:#f5f2ec;padding:clamp(64px,8vw,116px) 0 26px;border-top:1px solid rgba(245,242,236,.16)}
#site-footer .container{max-width:1200px}
#site-footer .footer-topline{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:20px;padding-bottom:clamp(24px,4vw,44px);border-bottom:1px solid rgba(245,242,236,.2)}
#site-footer .footer-label{font-size:.75rem;letter-spacing:.16em;text-transform:uppercase;color:var(--accent-color);font-weight:750;margin:0}
#site-footer .footer-back{font-size:.9rem;font-weight:700;color:var(--surface-strong);display:inline-flex;align-items:center;gap:12px;text-decoration:none;border-bottom:1px solid rgba(245,242,236,.5);padding:5px 0;transition:gap .2s ease,color .2s ease}
#site-footer .footer-back:hover{gap:18px;color:#fff}
#site-footer .footer-signature{font-size:clamp(3.7rem,9vw,9.7rem);font-family:var(--heading-font);font-weight:650;letter-spacing:-.082em;line-height:.95;color:var(--bg);padding:clamp(38px,6vw,70px) 0 clamp(42px,6vw,72px);margin:0;overflow-wrap:normal}
#site-footer .footer-signature em{font-family:Georgia,'Times New Roman',serif;font-weight:400;color:var(--accent-color);letter-spacing:-.07em}
#site-footer .footer-content{display:grid;grid-template-columns:minmax(0,1.45fr) repeat(2,minmax(155px,.55fr));gap:clamp(28px,4vw,65px);padding:clamp(30px,4vw,50px) 0 clamp(40px,5vw,64px);border-top:1px solid rgba(245,242,236,.2);border-bottom:1px solid rgba(245,242,236,.2)}
#site-footer .footer-brand{max-width:360px}
#site-footer .footer-brand>span{display:block;color:var(--accent-color);font-weight:750;font-size:.76rem;text-transform:uppercase;letter-spacing:.14em;margin:0 0 18px}
#site-footer .footer-brand p{color:var(--line-color);font-size:1.01rem;line-height:1.75;margin:0 0 20px}
#site-footer .footer-mail{font-size:.96rem;font-weight:700;color:var(--bg);border-bottom:1px solid rgba(245,242,236,.48);padding-bottom:5px;text-decoration:none;overflow-wrap:anywhere}
#site-footer .footer-mail:hover{border-color:#fff}
#site-footer .footer-links h4{font-size:.75rem;line-height:1.35;font-weight:750;text-transform:uppercase;letter-spacing:.14em;color:var(--accent-color);margin:0 0 21px}
#site-footer .footer-links ul{list-style:none;margin:0;padding:0;display:grid;grid-template-columns:1fr;gap:12px}
#site-footer .footer-links li{margin:0}
#site-footer .footer-links a{font-size:.95rem;font-weight:520;color:var(--surface-strong);text-decoration:none;display:inline-block;padding:0 0 2px;border-bottom:1px solid transparent;transition:color .2s ease,border-color .2s ease}
#site-footer .footer-links a:hover{color:#fff;border-color:var(--line-color)}
#site-footer .copyright{display:flex;justify-content:space-between;gap:15px 30px;align-items:center;padding:25px 0 0;margin:0;flex-wrap:wrap}
#site-footer .copyright p{font-size:.79rem;letter-spacing:.01em;color:var(--line-strong);line-height:1.5;margin:0}
#site-footer a:focus-visible{outline:3px solid var(--line-color);outline-offset:6px}
@media(max-width:850px){#site-footer .footer-content{grid-template-columns:repeat(2,minmax(0,1fr))}#site-footer .footer-brand{grid-column:1/-1;max-width:520px}}
@media(max-width:530px){#site-footer .footer-signature{font-size:clamp(3.15rem,14vw,5.5rem)}#site-footer .footer-content{grid-template-columns:1fr;gap:37px}#site-footer .footer-brand{grid-column:auto}#site-footer .footer-links ul{grid-template-columns:repeat(2,minmax(0,1fr));gap:11px 15px}#site-footer .copyright{flex-direction:column;align-items:flex-start}}
@media(prefers-reduced-motion:reduce){#site-footer .footer-back,#site-footer .footer-links a{transition:none}}
</style>
    <footer class="footer editorial-footer" id="site-footer" aria-label="Site footer">
        <div class="container">
            <div class="footer-topline">
                <span class="footer-label">imShivam / Personal portfolio</span>
                <a href="#main-content" class="footer-back">Back to top <span aria-hidden="true">↑</span></a>
            </div>
            <p class="footer-signature">Shivam <em>Patsariya.</em></p>
            <div class="footer-content">
                <div class="footer-brand">
                    <span>Design · Build · Write</span>
                    <p>Making digital experiences feel simpler, more useful, and more human.</p>
                    <a href="mailto:contact@imshivam.com" class="footer-mail">contact@imshivam.com</a>
                </div>
                <nav class="footer-links" aria-label="Footer site navigation">
                    <h4>Explore</h4>
                    <ul>
                        <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#about">About</a></li>
                        <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#experience">Experience</a></li>
                        <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#skills">Skills</a></li>
                        <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#projects">Projects</a></li>
                        <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#education">Education</a></li>
                        <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#certifications">Certifications</a></li>
                        <li><a href="<?php echo $seoIsHomepage ? '' : '/'; ?>#contact">Contact</a></li>
                    </ul>
                </nav>
                <nav class="footer-links" aria-label="Footer social navigation">
                    <h4>Elsewhere</h4>
                    <ul>
                        <li><a href="https://www.linkedin.com/in/shivampatsariya/" target="_blank" rel="noopener noreferrer">LinkedIn</a></li>
                        <li><a href="https://www.behance.net/shivampatsariya" target="_blank" rel="noopener noreferrer">Behance</a></li>
                        <li><a href="https://www.instagram.com/savvyshivam/" target="_blank" rel="noopener noreferrer">Instagram</a></li>
                        <li><a href="https://twitter.com/spatsariya" target="_blank" rel="noopener noreferrer">Twitter</a></li>
                        <li><a href="document/shivam_patsariya_resume_ux_designer.pdf" target="_blank" rel="noopener noreferrer">Resume</a></li>
                    </ul>
                </nav>
            </div>
            <div class="copyright">
                <p>&copy; <?php echo date("Y"); ?> Shivam Patsariya. All rights reserved.</p>
                <p>Design · Development · Writing</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="scroll-to-top" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </button>
    
    <!-- Core behaviors: cached by file modification time instead of an ever-changing timestamp. -->
    <script src="js/main.js?v=<?php echo filemtime(__DIR__ . '/../js/main.js'); ?>" defer></script>
</body>
</html>