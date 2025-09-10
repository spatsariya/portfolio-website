/**
 * Certification Initialization Script
 * Handles the initialization and setup of certification filtering system
 */
document.addEventListener('DOMContentLoaded', function() {
    // Wait for DOM to be fully loaded
    setTimeout(function() {
        // Initialize certification filtering system
        
        // Check if required elements exist
        const filterContainer = document.querySelector('.cert-filters');
        const certContainer = document.querySelector('.certifications-container');
        
        if (!filterContainer || !certContainer) {
            return;
        }
        
        // Add any additional initialization logic here
        
        // Ensure all certification items have proper data attributes
        const certItems = document.querySelectorAll('.certification-item');
        certItems.forEach(item => {
            // Add fallback category if none exists
            if (!item.hasAttribute('data-category')) {
                item.setAttribute('data-category', 'other');
            }
            
            // Add animation class for later use
            item.classList.add('cert-item-ready');
        });
        
        // Initialize category containers
        const categories = document.querySelectorAll('.certification-category');
        categories.forEach(category => {
            category.classList.add('category-ready');
        });
        
        // Setup complete
        document.body.classList.add('certifications-initialized');
        
    }, 100); // Small delay to ensure all other scripts have loaded
});
