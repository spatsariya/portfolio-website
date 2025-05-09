/**
 * Initialize the certifications section
 * 
 * This script runs after DOM content is loaded to ensure
 * proper display of certification categories and items
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('Certification initialization started');
    
    // Check for duplicated certification items and remove them if necessary
    const checkForDuplicates = () => {
        const certificationSection = document.getElementById('certifications');
        if (!certificationSection) {
            console.log('Certification section not found in DOM');
            return;
        }
        
        // Get all items by certification title
        const certTitles = {};
        const certItems = certificationSection.querySelectorAll('.certification-item');
        
        console.log(`Found ${certItems.length} certification items`);
        
        certItems.forEach(item => {
            const title = item.querySelector('h3')?.innerText.trim() || '';
            const issuer = item.querySelector('.certification-issuer')?.innerText.trim() || '';
            const key = `${title}-${issuer}`;
            
            if (certTitles[key]) {
                // Found a duplicate, remove it
                console.log(`Removing duplicate: ${key}`);
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
    
    // Make sure the All filter is active by default and all items are visible
    const setDefaultFilter = () => {
        const allFilterBtn = document.querySelector('.cert-filter-btn[data-filter="all"]');
        if (allFilterBtn) {
            allFilterBtn.classList.add('active');
            
            // Ensure all categories are visible on initial load
            const categories = document.querySelectorAll('#certifications .cert-category');
            console.log(`Found ${categories.length} certification categories`);
            
            categories.forEach(category => {
                category.style.display = 'block';
            });
            
            // Make all certification items visible
            const certItems = document.querySelectorAll('#certifications .certification-item');
            certItems.forEach(item => {
                item.style.display = 'flex';
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
                item.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            });
        } else {
            console.log('All filter button not found');
        }
    };
    
    // Ensure empty certification items have a minimum height and proper styling
    const fixEmptyCertItems = () => {
        const emptyCertItems = document.querySelectorAll('#certifications .certification-item:empty');
        emptyCertItems.forEach(item => {
            // If item is completely empty or only has empty divs
            if (!item.textContent.trim()) {
                if (item.parentNode) {
                    item.parentNode.removeChild(item);
                    console.log('Removed empty certification item');
                }
            }
        });
        
        // Check for items with incomplete content
        const incompleteItems = document.querySelectorAll('#certifications .certification-item');
        incompleteItems.forEach(item => {
            const content = item.querySelector('.certification-content');
            const icon = item.querySelector('.certification-icon');
            
            // If content is missing but there's an icon, add a placeholder
            if (icon && (!content || !content.innerHTML.trim())) {
                const placeholder = document.createElement('div');
                placeholder.className = 'certification-content';
                placeholder.innerHTML = '<h3>Certification</h3><p class="certification-issuer">Not specified</p>';
                item.appendChild(placeholder);
                console.log('Added placeholder content to incomplete certification item');
            }
        });
    };
    
    // Run initialization functions
    checkForDuplicates();
    ensureOrganizationsSectionVisible();
    fixEmptyCertItems();
    setDefaultFilter();
    
    console.log('Certification initialization completed');
});
