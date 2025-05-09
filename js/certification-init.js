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
            const title = item.querySelector('h3').innerText.trim();
            
            if (certTitles[title]) {
                // Found a duplicate, remove it
                item.parentNode.removeChild(item);
            } else {
                certTitles[title] = true;
            }
        });
    };
    
    // Run the check for duplicates
    checkForDuplicates();
});
