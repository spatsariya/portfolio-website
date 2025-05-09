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

    // Header scroll effect
    const header = document.querySelector('.header');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Skill progress animation
    const skillProgressBars = document.querySelectorAll('.skill-progress');
    
    function animateSkills() {
        skillProgressBars.forEach(progress => {
            const value = progress.getAttribute('data-progress');
            progress.style.width = value + '%';
        });
    }
    
    // Run skill animation when the skills section is in view
    const skillsSection = document.querySelector('.skills-section');
    
    if (skillsSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(animateSkills, 400);
                }
            });
        }, { threshold: 0.3 });
        
        observer.observe(skillsSection);
    }

    // Stats counter animation
    const statNumbers = document.querySelectorAll('.stat-number');
    
    function animateCounter(counter, target, duration) {
        let startTime = null;
        const startValue = parseInt(counter.textContent, 10);
        
        function updateCounter(timestamp) {
            if (!startTime) startTime = timestamp;
            const progress = timestamp - startTime;
            const percentage = Math.min(progress / duration, 1);
            
            const value = Math.floor(percentage * (target - startValue) + startValue);
            counter.textContent = value;
            
            if (progress < duration) {
                window.requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        }
        
        window.requestAnimationFrame(updateCounter);
    }
    
    // Run counter animation when the about section is in view
    const aboutSection = document.querySelector('.about-section');
    
    if (aboutSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    statNumbers.forEach(counter => {
                        const target = parseInt(counter.getAttribute('data-count'), 10);
                        animateCounter(counter, target, 2000);
                    });
                }
            });
        }, { threshold: 0.3 });
        
        observer.observe(aboutSection);
    }

    // Project filtering
    const filterButtons = document.querySelectorAll('.filter-btn');
    const projectItems = document.querySelectorAll('.project-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            const filterValue = this.getAttribute('data-filter');
            
            projectItems.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                    item.style.display = 'block';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                    }, 100);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });

    // Certificate category filtering
    const certFilterButtons = document.querySelectorAll('.cert-filter-btn');
    const certCategories = document.querySelectorAll('.cert-category');
    const certItems = document.querySelectorAll('.certification-item');
    
    // Show all certificates by default
    function showAllCertificates() {
        certCategories.forEach(category => {
            category.style.display = 'block';
        });
        
        certItems.forEach(item => {
            item.style.display = 'flex';
            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, 100);
        });
    }
    
    // Filter certificates by category
    certFilterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            certFilterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            const filterValue = this.getAttribute('data-filter');
            
            if (filterValue === 'all') {
                showAllCertificates();
            } else {
                // Hide all categories first
                certCategories.forEach(category => {
                    if (category.id === filterValue + '-category') {
                        category.style.display = 'block';
                    } else {
                        category.style.display = 'none';
                    }
                });
                
                // Show/hide individual certificates within visible categories
                certItems.forEach(item => {
                    const parentCategory = item.closest('.cert-category');
                    if (parentCategory && parentCategory.id === filterValue + '-category') {
                        item.style.display = 'flex';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'translateY(0)';
                        }, 100);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            }
        });
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Form validation and AJAX submission
    const contactForm = document.getElementById('contactForm');
    const formResponse = document.getElementById('form-response');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate form
            let isValid = true;
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const message = document.getElementById('message');
            
            // Reset previous errors
            removeError(name);
            removeError(email);
            removeError(message);
            
            if (name.value.trim() === '') {
                showError(name, 'Please enter your name');
                isValid = false;
            }
            
            if (email.value.trim() === '') {
                showError(email, 'Please enter your email');
                isValid = false;
            } else if (!isValidEmail(email.value)) {
                showError(email, 'Please enter a valid email address');
                isValid = false;
            }
            
            if (message.value.trim() === '') {
                showError(message, 'Please enter your message');
                isValid = false;
            }
            
            if (isValid) {
                // Show loading state
                const submitBtn = contactForm.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                submitBtn.disabled = true;
                
                // Collect form data
                const formData = new FormData(contactForm);
                
                // Send AJAX request
                fetch('process-form.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Reset button
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    
                    // Show response
                    if (data.status === 'success') {
                        formResponse.className = 'form-response success';
                        formResponse.innerHTML = data.message;
                        contactForm.reset();
                    } else {
                        formResponse.className = 'form-response error';
                        formResponse.innerHTML = data.message;
                    }
                    
                    // Hide response after some time
                    setTimeout(() => {
                        formResponse.style.display = 'none';
                    }, 5000);
                })
                .catch(error => {
                    console.error('Error:', error);
                    formResponse.className = 'form-response error';
                    formResponse.innerHTML = 'There was an error sending your message. Please try again later.';
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
            }
        });
    }

    function showError(input, message) {
        const formGroup = input.parentElement;
        const errorMessage = document.createElement('div');
        errorMessage.className = 'error-message';
        errorMessage.textContent = message;
        
        formGroup.classList.add('error');
        
        // Remove any existing error messages first
        const existingError = formGroup.querySelector('.error-message');
        if (existingError) {
            formGroup.removeChild(existingError);
        }
        
        formGroup.appendChild(errorMessage);
    }

    function removeError(input) {
        const formGroup = input.parentElement;
        const errorMessage = formGroup.querySelector('.error-message');
        
        if (errorMessage) {
            formGroup.removeChild(errorMessage);
        }
        
        formGroup.classList.remove('error');
    }

    function isValidEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }
});