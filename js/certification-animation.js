/**
 * Certificate Animation Script
 * Adds staggered animations to certification items
 */

window.addEventListener('load', function() {
    // Add animation order to certification items for staggered animation
    const certItems = document.querySelectorAll('.certification-item');
    const certSection = document.querySelector('.certifications-section');
    
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

    if (!filterButtons.length || !categories.length) {
        return;
    }

    categories.forEach(category => {
        if (!category.dataset.categoryType && category.id) {
            category.dataset.categoryType = category.id.replace('-category', '');
        }
        category.style.opacity = '1';
    });

    function refreshVisibleCategoryAnimations() {
        const visibleItems = document.querySelectorAll('.cert-category:not(.is-hidden) .certification-item');
        visibleItems.forEach((item, index) => {
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
            item.style.animation = 'none';
            item.style.setProperty('--animation-order', index % 10);
            requestAnimationFrame(() => {
                item.style.animation = '';
            });
        });
    }

    function refreshAOS() {
        if (typeof AOS !== 'undefined' && typeof AOS.refreshHard === 'function') {
            AOS.refreshHard();
        } else if (typeof AOS !== 'undefined' && typeof AOS.refresh === 'function') {
            AOS.refresh();
        }
    }

    function filterCategories(filterValue) {
        filterButtons.forEach(btn => {
            btn.classList.toggle('active', btn.getAttribute('data-filter') === filterValue);
        });

        categories.forEach(category => {
            const categoryType = category.dataset.categoryType || 'unknown';
            const shouldShow = filterValue === 'all' || categoryType === filterValue;

            category.classList.toggle('is-hidden', !shouldShow);
            category.classList.toggle('active-category', shouldShow);
            category.setAttribute('aria-hidden', shouldShow ? 'false' : 'true');
            category.style.display = shouldShow ? 'block' : 'none';
            category.style.opacity = shouldShow ? '1' : '0';
        });

        refreshVisibleCategoryAnimations();
        refreshAOS();
    }

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter') || 'all';
            filterCategories(filter);
        });
    });

    if (certSection) {
        certSection.setAttribute('data-cert-filter-ready', 'true');
    }

    filterCategories('all');
});
