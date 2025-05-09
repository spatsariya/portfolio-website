/**
 * Certificate Animation Script
 * Adds staggered animations to certification items
 */

document.addEventListener('DOMContentLoaded', function() {
    // Add animation order to certification items for staggered animation
    const certItems = document.querySelectorAll('.certification-item');
    
    // Set a random delay between 0-5 for each item
    certItems.forEach((item, index) => {
        const randomDelay = Math.floor(Math.random() * 3) + (index % 5);
        item.style.setProperty('--animation-order', randomDelay);
        
        // Add intersection observer for better performance
        let observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, randomDelay * 100);
                    observer.unobserve(entry.target);
                }
            });
        }, {threshold: 0.1});
        
        observer.observe(item);
    });

    // Enhanced filter functionality with smooth transitions
    const filterButtons = document.querySelectorAll('.cert-filter-btn');
    const categories = document.querySelectorAll('.cert-category');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Update active button state
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            // Show/hide categories with smooth animation
            if (filter === 'all') {
                categories.forEach(category => {
                    category.style.display = 'block';
                    setTimeout(() => {
                        category.style.opacity = '1';
                    }, 50);
                });
            } else {
                categories.forEach(category => {
                    const categoryId = category.getAttribute('id');
                    
                    if (categoryId === filter + '-category') {
                        category.style.display = 'block';
                        setTimeout(() => {
                            category.style.opacity = '1';
                        }, 50);
                    } else {
                        category.style.opacity = '0';
                        setTimeout(() => {
                            category.style.display = 'none';
                        }, 500);
                    }
                });
            }
            
            // Reset animation for newly visible items
            const visibleItems = document.querySelectorAll('.cert-category[style*="display: block"] .certification-item');
            visibleItems.forEach((item, index) => {
                item.style.animation = 'none';
                setTimeout(() => {
                    item.style.animation = '';
                    item.style.setProperty('--animation-order', index % 10);
                }, 10);
            });
        });
    });
});
