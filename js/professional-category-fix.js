/**
 * Professional Category Fix
 * This script ensures the Professional Qualifications category shows correctly
 * when filtered
 */
window.addEventListener('load', function() {
    // Get all filter buttons
    const filterButtons = document.querySelectorAll('.cert-filter-btn');
    const professionalButton = document.querySelector('.cert-filter-btn[data-filter="professional"]');
    const professionalCategory = document.getElementById('professional-category');
    
    if (professionalButton && professionalCategory) {
        // Professional category setup - ready to fix filtering
        
        // Make sure the professional category has proper attributes
        professionalCategory.setAttribute('data-category-type', 'professional');
        
        // Force professional category to be visible initially
        if (window.getComputedStyle(professionalCategory).display === 'none') {
            professionalCategory.style.display = 'block';
        }
    }
    
    // Enhanced professional category filtering logic
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filterValue = this.getAttribute('data-filter');
            
            // Special handling for professional category filter
            if (filterValue === 'professional' && professionalCategory) {
                // Force show professional category
                professionalCategory.style.display = 'block';
                professionalCategory.classList.add('active-category');
                
                // Make sure it's visible and properly styled
                setTimeout(() => {
                    if (window.getComputedStyle(professionalCategory).display === 'none') {
                        professionalCategory.style.display = 'block';
                        professionalCategory.style.opacity = '1';
                        professionalCategory.style.transform = 'translateY(0)';
                    }
                }, 100);
            }
            
            // Special handling for 'all' filter to ensure professional category is shown
            if (filterValue === 'all' && professionalCategory) {
                professionalCategory.style.display = 'block';
                professionalCategory.classList.add('active-category');
            }
        });
    });

    // Final fallback - force professional category to be visible after page load
    setTimeout(() => {
        if (professionalCategory && window.getComputedStyle(professionalCategory).display === 'none') {
            professionalCategory.style.display = 'block';
            professionalCategory.style.opacity = '1';
            professionalCategory.style.transform = 'translateY(0)';
        }
    }, 1000);
});
