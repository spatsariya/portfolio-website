/**
 * Enhanced certificate section styles
 */

/* Add a subtle gradient background to the entire certification-section */
document.addEventListener('DOMContentLoaded', function() {
    // Add animation delay to filter buttons
    const filterButtons = document.querySelectorAll('.cert-filter-btn');
    filterButtons.forEach((btn, index) => {
        btn.style.setProperty('--btn-index', index);
    });
    
    // Enhanced hover effects for certification items
    const certItems = document.querySelectorAll('.certification-item');
    
    certItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.querySelectorAll('.certification-content h3').forEach(el => {
                el.style.color = 'var(--primary-color)';
            });
        });
        
        item.addEventListener('mouseleave', function() {
            this.querySelectorAll('.certification-content h3').forEach(el => {
                el.style.color = 'var(--text-color)';
            });
        });
    });
    
    // Add subtle background animations
    const certSection = document.querySelector('.certifications-section');
    
    if (certSection) {
        // Create and append background element
        const bgElement = document.createElement('div');
        bgElement.classList.add('cert-bg-animation');
        certSection.appendChild(bgElement);
        
        // Create floating elements
        for (let i = 0; i < 5; i++) {
            const floatingEl = document.createElement('div');
            floatingEl.classList.add('floating-cert-element');
            
            // Random position and size
            const size = Math.floor(Math.random() * 100) + 50;
            const posX = Math.floor(Math.random() * 100);
            const posY = Math.floor(Math.random() * 100);
            const delay = Math.floor(Math.random() * 10);
            const duration = Math.floor(Math.random() * 20) + 15;
            
            floatingEl.style.width = `${size}px`;
            floatingEl.style.height = `${size}px`;
            floatingEl.style.left = `${posX}%`;
            floatingEl.style.top = `${posY}%`;
            floatingEl.style.animationDelay = `${delay}s`;
            floatingEl.style.animationDuration = `${duration}s`;
            
            bgElement.appendChild(floatingEl);
        }
        
        // Add scroll to top button
        const scrollTopBtn = document.createElement('button');
        scrollTopBtn.classList.add('cert-scroll-top');
        scrollTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
        certSection.appendChild(scrollTopBtn);
        
        // Hide button initially
        scrollTopBtn.style.opacity = '0';
        scrollTopBtn.style.visibility = 'hidden';
        
        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            const certSectionTop = certSection.offsetTop;
            const certSectionHeight = certSection.offsetHeight;
            const scrollPosition = window.scrollY;
            
            if (scrollPosition > certSectionTop + 300 && scrollPosition < certSectionTop + certSectionHeight - 500) {
                scrollTopBtn.style.opacity = '1';
                scrollTopBtn.style.visibility = 'visible';
            } else {
                scrollTopBtn.style.opacity = '0';
                scrollTopBtn.style.visibility = 'hidden';
            }
        });
        
        // Scroll to top of certifications section when button is clicked
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: certSection.offsetTop - 80,
                behavior: 'smooth'
            });
        });
    }
});
