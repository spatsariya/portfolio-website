/**
 * Initialize the certifications section
 * 
 * This script runs after DOM content is loaded to ensure
 * proper display of certification categories and items
 */
document.addEventListener('DOMContentLoaded', function() {
    // Check for duplicated certification items and remove them if necessary
    const checkForDuplicates = () => {
        const certificationSection = document.getElementById('certifications');
        if (!certificationSection) return;
        
        // Get all items by certification title
        const certTitles = {};
        const certItems = certificationSection.querySelectorAll('.certification-item');
        
        certItems.forEach(item => {
            const title = item.querySelector('h3')?.innerText.trim() || '';
            const issuer = item.querySelector('.certification-issuer')?.innerText.trim() || '';
            const key = `${title}-${issuer}`;
            
            if (certTitles[key]) {
                // Found a duplicate, remove it
                item.parentNode.removeChild(item);
            } else {
                certTitles[key] = true;
            }
        });
    };
    
    // Ensure organizations section is not affected by certification filtering
    const ensureOrganizationsSectionVisible = () => {
        const organizationsSection = document.getElementById('organizations');
        if (organizationsSection) {
            // Make sure it has the correct class
            if (organizationsSection.classList.contains('certifications-section')) {
                organizationsSection.classList.remove('certifications-section');
                organizationsSection.classList.add('organizations-section');
            }
        }
    };
    
    // Make sure the All filter is active by default
    const setDefaultFilter = () => {
        const allFilterBtn = document.querySelector('.cert-filter-btn[data-filter="all"]');
        if (allFilterBtn) {
            allFilterBtn.classList.add('active');
            
            // Ensure all categories are visible on initial load
            const categories = document.querySelectorAll('#certifications .cert-category');
            categories.forEach(category => {
                category.style.display = 'block';
            });
        }
    };
    
    // Run initialization functions
    checkForDuplicates();
    ensureOrganizationsSectionVisible();
    setDefaultFilter();
});
