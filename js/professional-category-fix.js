/**
 * Professional Category Fix
 * This script ensures the Professional Qualifications category shows correctly
 * when filtered
 */
document.addEventListener('DOMContentLoaded', function() {
    // Get all filter buttons
    const filterButtons = document.querySelectorAll('.cert-filter-btn');
    const professionalButton = document.querySelector('.cert-filter-btn[data-filter="professional"]');
    const professionalCategory = document.getElementById('professional-category');
    const allButton = document.querySelector('.cert-filter-btn[data-filter="all"]');
    
    if (professionalButton && professionalCategory) {
        console.log('Professional category setup - ready to fix filtering');
        
        // Make sure the professional category has proper attributes
        professionalCategory.setAttribute('data-category-type', 'professional');
        
        // Force professional category to be visible initially
        if (window.getComputedStyle(professionalCategory).display === 'none') {
            console.log('Professional category was initially hidden - fixing...');
            professionalCategory.style.display = 'block';
        }
        
        // Add a special click handler for the professional button
        professionalButton.addEventListener('click', function(e) {
            console.log('Professional button clicked');
            
            // Show the professional category IMMEDIATELY
            professionalCategory.style.display = 'block';
            professionalCategory.classList.add('active-category');
            
            // Add a special class to the body to help with CSS targeting
            document.body.classList.add('show-professional');
            
            // Hide all other categories
            document.querySelectorAll('.cert-category').forEach(cat => {
                if (cat.id !== 'professional-category') {
                    cat.style.display = 'none';
                    cat.classList.remove('active-category');
                }
            });
            
            // Also set it again after a slight delay to override any other scripts
            setTimeout(() => {
                professionalCategory.style.display = 'block';
                professionalCategory.classList.add('active-category');
            }, 50);
        });
        
        // Also monitor all button clicks to reset properly
        if (allButton) {
            allButton.addEventListener('click', function() {
                professionalCategory.style.display = 'block';
                document.body.classList.remove('show-professional');
            });
        }
        
        // Monitor all other filter buttons
        filterButtons.forEach(btn => {
            if (btn !== professionalButton && btn !== allButton) {
                btn.addEventListener('click', function() {
                    // When any other category button is clicked, make sure professional is hidden
                    professionalCategory.style.display = 'none';
                    professionalCategory.classList.remove('active-category');
                    document.body.classList.remove('show-professional');
                });
            }
        });
    }
    
    // Add a global event listener to catch any display changes to professional category
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.target === professionalCategory && 
                mutation.attributeName === 'style' &&
                professionalButton.classList.contains('active')) {
                    
                // If the professional button is active but the category is hidden, show it
                if (professionalCategory.style.display === 'none') {
                    professionalCategory.style.display = 'block';
                    console.log('Corrected professional category visibility');
                }
            }
        });
    });
    
    // Start observing the professional category for attribute changes
    if (professionalCategory) {
        observer.observe(professionalCategory, { attributes: true });
    }
});
