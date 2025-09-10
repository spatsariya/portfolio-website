/**
 * Enhanced Certifications Filter Script
 * Handles filtering and categorization of certifications
 */
document.addEventListener('DOMContentLoaded', function() {
    // Configuration
    const filterButtonsSelector = '.cert-filter-btn';
    const certificationItemsSelector = '.certification-item';
    const categoriesSelector = '.certification-category';
    
    // Get DOM elements
    const filterButtons = document.querySelectorAll(filterButtonsSelector);
    const certificationItems = document.querySelectorAll(certificationItemsSelector);
    const categories = document.querySelectorAll(categoriesSelector);
    
    // Category mapping
    const categoryMapping = {
        'ux-design': ['ux', 'design', 'user experience', 'figma', 'adobe', 'sketch'],
        'technical': ['technical', 'programming', 'coding', 'software', 'development', 'web'],
        'professional': ['professional', 'business', 'management', 'leadership', 'career'],
        'academic': ['academic', 'university', 'degree', 'education', 'course'],
        'certifications': ['certification', 'certificate', 'certified', 'credential']
    };
    
    // Function to determine category based on content
    function determineCategory(item) {
        const title = item.querySelector('.cert-title')?.textContent.toLowerCase() || '';
        const description = item.querySelector('.cert-description')?.textContent.toLowerCase() || '';
        const provider = item.querySelector('.cert-provider')?.textContent.toLowerCase() || '';
        const content = `${title} ${description} ${provider}`;
        
        for (const [category, keywords] of Object.entries(categoryMapping)) {
            if (keywords.some(keyword => content.includes(keyword))) {
                return category;
            }
        }
        return 'other';
    }
    
    // Auto-assign categories to items without explicit categories
    certificationItems.forEach(item => {
        if (!item.hasAttribute('data-category')) {
            const category = determineCategory(item);
            item.setAttribute('data-category', category);
        }
    });
    
    // Filter function
    function filterCertifications(filterValue) {
        // Update active button
        filterButtons.forEach(btn => btn.classList.remove('active'));
        document.querySelector(`[data-filter="${filterValue}"]`)?.classList.add('active');
        
        // Show/hide categories and items
        categories.forEach(category => {
            const categoryType = category.getAttribute('data-category-type') || 
                               category.id?.replace('-category', '') || 
                               'unknown';
            
            if (filterValue === 'all' || filterValue === categoryType) {
                category.style.display = 'block';
                category.classList.add('active-category');
                
                // Show relevant items within this category
                const itemsInCategory = category.querySelectorAll(certificationItemsSelector);
                itemsInCategory.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');
                    if (filterValue === 'all' || filterValue === itemCategory || filterValue === categoryType) {
                        item.style.display = 'block';
                        item.classList.add('active-item');
                    } else {
                        item.style.display = 'none';
                        item.classList.remove('active-item');
                    }
                });
            } else {
                category.style.display = 'none';
                category.classList.remove('active-category');
            }
        });
        
        // Handle standalone items (not in categories)
        const standaloneItems = document.querySelectorAll(`${certificationItemsSelector}:not(.certification-category ${certificationItemsSelector})`);
        standaloneItems.forEach(item => {
            const itemCategory = item.getAttribute('data-category');
            if (filterValue === 'all' || filterValue === itemCategory) {
                item.style.display = 'block';
                item.classList.add('active-item');
            } else {
                item.style.display = 'none';
                item.classList.remove('active-item');
            }
        });
        
        // Trigger animations
        setTimeout(() => {
            const visibleItems = document.querySelectorAll(`${certificationItemsSelector}.active-item`);
            visibleItems.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.1}s`;
                item.classList.add('animate-in');
            });
        }, 50);
    }
    
    // Add event listeners to filter buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const filterValue = this.getAttribute('data-filter');
            filterCertifications(filterValue);
        });
    });
    
    // Initialize with 'all' filter
    filterCertifications('all');
    
    // Handle any dynamic content loading
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1 && node.matches(certificationItemsSelector)) {
                        if (!node.hasAttribute('data-category')) {
                            const category = determineCategory(node);
                            node.setAttribute('data-category', category);
                        }
                    }
                });
            }
        });
    });
    
    const certContainer = document.querySelector('.certifications-container') || document.body;
    observer.observe(certContainer, {
        childList: true,
        subtree: true
    });
});
