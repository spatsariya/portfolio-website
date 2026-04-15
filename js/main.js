/**
 * Main JavaScript for Shivam Patsariya's UX Designer Portfolio
 */

// Initialize AOS animations
document.addEventListener('DOMContentLoaded', function() {
    // First-load interaction safety: ensure pointer interactions are never globally blocked
    function ensurePageInteractive() {
        if (document.documentElement) {
            document.documentElement.style.pointerEvents = 'auto';
        }
        if (document.body) {
            document.body.style.pointerEvents = 'auto';
        }
    }

    ensurePageInteractive();
    window.addEventListener('load', ensurePageInteractive, { once: true });
    setTimeout(ensurePageInteractive, 1200);

    // Initialize AOS animations with improved settings for better reliability
    if (typeof AOS !== 'undefined' && typeof AOS.init === 'function') {
        AOS.init({
            duration: 600,
            once: true,
            mirror: false,
            offset: 50,
            delay: 0,
            easing: 'ease-out-cubic',
            disable: function() {
                // Disable AOS on very small screens or if user prefers reduced motion
                var maxWidth = 768;
                var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                return window.innerWidth < maxWidth || prefersReducedMotion;
            }
        });
    }

    // Mobile menu toggle with accessibility improvements
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileMenuBtn && mobileMenu) {
        // Add keyboard support for mobile menu button
        mobileMenuBtn.addEventListener('click', toggleMobileMenu);
        mobileMenuBtn.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleMobileMenu();
            }
        });

        function toggleMobileMenu() {
            const isActive = mobileMenuBtn.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            
            // Update ARIA attributes for accessibility
            mobileMenuBtn.setAttribute('aria-expanded', isActive);
            mobileMenu.setAttribute('aria-hidden', !isActive);
            
            // Animate hamburger icon
            const spans = mobileMenuBtn.querySelectorAll('span');
            if (isActive) {
                spans[0].style.transform = 'rotate(45deg) translate(6px, 6px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
                
                // Focus management - focus first menu item when opening
                const firstMenuItem = mobileMenu.querySelector('a');
                if (firstMenuItem) {
                    setTimeout(() => firstMenuItem.focus(), 100);
                }
            } else {
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
                
                // Return focus to menu button when closing
                mobileMenuBtn.focus();
            }
        }

        // Handle Escape key to close menu
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                toggleMobileMenu();
            }
        });
    }
    
    // Close mobile menu when clicking on a link
    const mobileMenuLinks = document.querySelectorAll('.mobile-menu a');
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (mobileMenu && mobileMenuBtn) {
                mobileMenu.classList.remove('active');
                mobileMenuBtn.classList.remove('active');
                
                // Update ARIA attributes
                mobileMenuBtn.setAttribute('aria-expanded', 'false');
                mobileMenu.setAttribute('aria-hidden', 'true');
                
                // Reset hamburger icon
                const spans = mobileMenuBtn.querySelectorAll('span');
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });
    });

    // Timeline Expandable Functionality
    function setTimelineExpandedState(toggleBtn, detailsDiv, isExpanded) {
        const toggleIcon = toggleBtn.querySelector('.toggle-icon');
        const toggleText = toggleBtn.querySelector('.toggle-text');

        toggleBtn.setAttribute('data-expanded', isExpanded ? 'true' : 'false');
        toggleBtn.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
        detailsDiv.hidden = !isExpanded;
        detailsDiv.style.display = isExpanded ? 'block' : 'none';
        detailsDiv.classList.toggle('expanded', isExpanded);
        detailsDiv.setAttribute('aria-hidden', isExpanded ? 'false' : 'true');

        if (toggleText) {
            toggleText.textContent = isExpanded ? 'Hide' : 'View';
        }

        if (toggleIcon) {
            toggleIcon.classList.toggle('fa-chevron-up', isExpanded);
            toggleIcon.classList.toggle('fa-chevron-down', !isExpanded);
        }
    }

    function bindTimelineToggle(toggleBtn, detailsDiv) {
        if (!toggleBtn || !detailsDiv || toggleBtn.hasAttribute('data-listener-added')) {
            return;
        }

        toggleBtn.setAttribute('data-listener-added', 'true');
        setTimelineExpandedState(toggleBtn, detailsDiv, toggleBtn.getAttribute('data-expanded') === 'true');

        toggleBtn.addEventListener('click', function() {
            const isExpanded = this.getAttribute('data-expanded') === 'true';
            setTimelineExpandedState(this, detailsDiv, !isExpanded);
        });
    }

    function initializeTimelineExpandable() {
        const timelineItems = document.querySelectorAll('.timeline-item');

        timelineItems.forEach(item => {
            const timelineContent = item.querySelector('.timeline-content');
            if (!timelineContent) {
                return;
            }

            let timelineExpandable = timelineContent.querySelector('.timeline-expandable');
            let detailsDiv = timelineExpandable ? timelineExpandable.querySelector('.timeline-details') : null;
            let toggleBtn = timelineExpandable ? timelineExpandable.querySelector('.timeline-toggle') : null;

            if (!timelineExpandable) {
                const timelineList = timelineContent.querySelector('.timeline-list');

                if (!timelineList) {
                    return;
                }

                timelineExpandable = document.createElement('div');
                timelineExpandable.className = 'timeline-expandable';

                detailsDiv = document.createElement('div');
                detailsDiv.className = 'timeline-details';
                detailsDiv.hidden = true;

                toggleBtn = document.createElement('button');
                toggleBtn.className = 'timeline-toggle';
                toggleBtn.setAttribute('type', 'button');
                toggleBtn.setAttribute('data-expanded', 'false');
                toggleBtn.innerHTML = `
                    <span class="toggle-text">View</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                `;

                detailsDiv.appendChild(timelineList);
                timelineExpandable.appendChild(detailsDiv);
                timelineExpandable.appendChild(toggleBtn);
                timelineContent.appendChild(timelineExpandable);
            }

            if (!detailsDiv.id) {
                detailsDiv.id = `timeline-details-${Math.random().toString(36).slice(2, 10)}`;
            }

            toggleBtn.setAttribute('type', 'button');
            toggleBtn.setAttribute('aria-controls', detailsDiv.id);
            bindTimelineToggle(toggleBtn, detailsDiv);
        });
    }

    initializeTimelineExpandable();

    // Stats animation functionality
    function animateStats() {
        const stats = document.querySelectorAll('.stat-number');
        stats.forEach(stat => {
            const target = parseInt(stat.getAttribute('data-count'));
            let count = 0;
            const increment = Math.ceil(target / 50);
            
            const timer = setInterval(() => {
                count += increment;
                if (count >= target) {
                    count = target;
                    clearInterval(timer);
                }
                
                if (target >= 1000) {
                    stat.textContent = (count / 1000).toFixed(1) + 'k+';
                } else {
                    stat.textContent = count + '+';
                }
            }, 50);
        });
    }

    // Trigger stats animation on scroll
    const statsSection = document.querySelector('.about-stats');
    if (statsSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStats();
                    observer.disconnect();
                }
            });
        });
        observer.observe(statsSection);
    }

    // Skills progress animation
    function animateSkills() {
        const skillBars = document.querySelectorAll('.skill-progress');
        skillBars.forEach(bar => {
            const progress = bar.getAttribute('data-progress');
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = progress + '%';
            }, 100);
        });
    }

    // Trigger skills animation on scroll
    const skillsSection = document.querySelector('.skills-section');
    if (skillsSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateSkills();
                    observer.disconnect();
                }
            });
        });
        observer.observe(skillsSection);
    }

    // Projects filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const projectItems = document.querySelectorAll('.project-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');

            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Filter projects
            projectItems.forEach(item => {
                const category = item.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    item.style.display = 'block';
                    if (typeof AOS !== 'undefined' && typeof AOS.refresh === 'function') {
                        AOS.refresh();
                    }
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Smooth scrolling for navigation links
    const navLinks = document.querySelectorAll('a[href^="#"]');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Header scroll effect
    const header = document.querySelector('.header');

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        // Keep header always visible - removed hide/show functionality
        // Header will always stay in place
    });

    // Form submission - DISABLED - Using inline handler in HTML to avoid cache issues
    const contactForm = document.getElementById('contactForm-DISABLED');
    const formResponse = document.getElementById('form-response-DISABLED');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Update button to show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            submitBtn.disabled = true;
            
            // Clear previous messages
            formResponse.innerHTML = '';
            
            // Use explicit full relative URL with cache busting
            const timestamp = Date.now();
            const formAction = `./process-form-simple.php?v=${timestamp}`;
            
            fetch(formAction, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Cache-Control': 'no-cache'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showFormMessage(data.message || 'Message sent successfully!', 'success');
                    contactForm.reset();
                } else {
                    showFormMessage(data.message || 'Failed to send message. Please try again.', 'error');
                }
            })
            .catch(error => {
                showFormMessage('Network error. Please check your connection and try again.', 'error');
            })
            .finally(() => {
                // Restore button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
        
        function showFormMessage(message, type) {
            formResponse.innerHTML = `<div class="form-message ${type}">${message}</div>`;
            formResponse.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            
            // Auto-hide success messages
            if (type === 'success') {
                setTimeout(() => {
                    formResponse.innerHTML = '';
                }, 5000);
            }
        }
    }
    
    // Scroll to Top Button Functionality
    const scrollToTopBtn = document.getElementById('scrollToTop');
    
    if (scrollToTopBtn) {
        // Show/hide scroll to top button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.add('show');
            } else {
                scrollToTopBtn.classList.remove('show');
            }
        });
        
        // Smooth scroll to top when button is clicked
        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});
