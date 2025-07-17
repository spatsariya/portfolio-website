/**
 * Main JavaScript for Shivam Patsariya's UX Designer Portfolio
 */

// Initialize AOS animations
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS animations
    AOS.init({
        duration: 800,
        once: false,
        mirror: true
    });

    // Mobile menu toggle
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
            this.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            
            // Animate hamburger icon
            const spans = this.querySelectorAll('span');
            if (this.classList.contains('active')) {
                spans[0].style.transform = 'rotate(45deg) translate(6px, 6px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
            } else {
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });
    }
    
    // Close mobile menu when clicking on a link
    const mobileMenuLinks = document.querySelectorAll('.mobile-menu a');
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
            if (mobileMenuBtn) {
                mobileMenuBtn.classList.remove('active');
                const spans = mobileMenuBtn.querySelectorAll('span');
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });
    });

    // Timeline Expandable Functionality - Auto-convert existing timeline items
    function initializeTimelineExpandable() {
        const timelineItems = document.querySelectorAll('.timeline-item');
        
        timelineItems.forEach(item => {
            const timelineContent = item.querySelector('.timeline-content');
            const timelineList = timelineContent.querySelector('.timeline-list');
            
            // Skip if already has expandable structure or no timeline-list
            if (timelineContent.querySelector('.timeline-expandable') || !timelineList) {
                return;
            }
            
            // Create expandable structure
            const expandableDiv = document.createElement('div');
            expandableDiv.className = 'timeline-expandable';
            
            const detailsDiv = document.createElement('div');
            detailsDiv.className = 'timeline-details';
            detailsDiv.style.display = 'none';
            
            const toggleBtn = document.createElement('button');
            toggleBtn.className = 'timeline-toggle';
            toggleBtn.setAttribute('data-expanded', 'false');
            toggleBtn.innerHTML = `
                <span class="toggle-text">View more</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            `;
            
            // Move the timeline-list to details
            detailsDiv.appendChild(timelineList.cloneNode(true));
            timelineList.remove();
            
            // Append to expandable div
            expandableDiv.appendChild(detailsDiv);
            expandableDiv.appendChild(toggleBtn);
            
            // Append expandable div to timeline content
            timelineContent.appendChild(expandableDiv);
            
            // Add click event to this specific toggle button
            toggleBtn.addEventListener('click', function() {
                const toggleIcon = this.querySelector('.toggle-icon');
                const toggleText = this.querySelector('.toggle-text');
                const isExpanded = this.getAttribute('data-expanded') === 'true';
                
                if (isExpanded) {
                    // Collapse
                    detailsDiv.classList.remove('expanded');
                    detailsDiv.style.display = 'none';
                    this.setAttribute('data-expanded', 'false');
                    toggleText.textContent = 'View more';
                } else {
                    // Expand
                    detailsDiv.style.display = 'block';
                    setTimeout(() => {
                        detailsDiv.classList.add('expanded');
                    }, 10);
                    this.setAttribute('data-expanded', 'true');
                    toggleText.textContent = 'View less';
                }
            });
        });
    }
    
    // Initialize timeline expandable
    initializeTimelineExpandable();
    
    // Timeline Expandable Functionality for manually created elements
    const timelineToggles = document.querySelectorAll('.timeline-toggle');
    
    timelineToggles.forEach(toggle => {
        // Skip if already has event listener (from auto-conversion)
        if (toggle.hasAttribute('data-listener-added')) {
            return;
        }
        
        toggle.setAttribute('data-listener-added', 'true');
        toggle.addEventListener('click', function() {
            const timelineExpandable = this.closest('.timeline-expandable');
            const timelineDetails = timelineExpandable.querySelector('.timeline-details');
            const toggleIcon = this.querySelector('.toggle-icon');
            const toggleText = this.querySelector('.toggle-text');
            const isExpanded = this.getAttribute('data-expanded') === 'true';
            
            if (isExpanded) {
                // Collapse
                timelineDetails.classList.remove('expanded');
                timelineDetails.style.display = 'none';
                this.setAttribute('data-expanded', 'false');
                toggleText.textContent = 'View more';
            } else {
                // Expand
                timelineDetails.style.display = 'block';
                setTimeout(() => {
                    timelineDetails.classList.add('expanded');
                }, 10);
                this.setAttribute('data-expanded', 'true');
                toggleText.textContent = 'View less';
            }
        });
    });

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
                    AOS.refresh();
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
    let lastScrollTop = 0;

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        // Hide/show header on scroll
        if (scrollTop > lastScrollTop && scrollTop > 200) {
            header.style.transform = 'translateY(-100%)';
        } else {
            header.style.transform = 'translateY(0)';
        }
        lastScrollTop = scrollTop;
    });

    // Form submission
    const contactForm = document.getElementById('contactForm');
    const formResponse = document.getElementById('form-response');
    
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
            
            fetch(contactForm.action, {
                method: 'POST',
                body: formData
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
                console.error('Form submission error:', error);
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
