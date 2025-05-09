/**
 * Certifications filter enhancement script
 * This script adds better filtering capabilities to the certifications section
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('Enhanced certifications filter script loaded');

    const certFilterButtons = document.querySelectorAll('.cert-filter-btn');
    const certCategories = document.querySelectorAll('#certifications .cert-category');
    const certItems = document.querySelectorAll('#certifications .certification-item');
    
    // Add data-category attributes to all certification items based on their parent category
    function addCategoryAttributes() {
        certItems.forEach(item => {
            const parentCategory = item.closest('.cert-category');
            if (parentCategory) {
                const categoryId = parentCategory.id;
                if (categoryId) {
                    const categoryName = categoryId.replace('-category', '');
                    item.setAttribute('data-category', categoryName);
                }
            }
        });
    }
    
    // Make sure all cert items have proper structure
    function ensureProperCertStructure() {
        certItems.forEach(item => {
            // Skip items that already have proper content
            if (item.querySelector('.certification-content h3')) return;
            
            // Check if item has icon
            let icon = item.querySelector('.certification-icon');
            if (!icon) {
                icon = document.createElement('div');
                icon.className = 'certification-icon';
                icon.innerHTML = '<i class="fas fa-certificate"></i>';
                item.insertBefore(icon, item.firstChild);
            } else if (!icon.querySelector('i')) {
                icon.innerHTML = '<i class="fas fa-certificate"></i>';
            }
            
            // Check if item has content
            let content = item.querySelector('.certification-content');
            if (!content) {
                content = document.createElement('div');
                content.className = 'certification-content';
                content.innerHTML = `
                    <h3>Certificate</h3>
                    <p class="certification-issuer">Provider</p>
                    <p class="certification-date">Date</p>
                `;
                item.appendChild(content);
            } else if (!content.querySelector('h3')) {
                content.innerHTML = `
                    <h3>Certificate</h3>
                    <p class="certification-issuer">Provider</p>
                    <p class="certification-date">Date</p>
                `;
            }
        });
    }
    
    // Show all certificates
    function showAllCertificates() {
        // Show all categories
        certCategories.forEach(category => {
            category.style.display = 'block';
        });
        
        // Show all items with animation
        certItems.forEach(item => {
            // Reset any previous transitions
            item.style.transition = 'none';
            
            // Set initial state
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            item.style.display = 'flex';
            
            // Force reflow to ensure animation works
            void item.offsetWidth;
            
            // Add transition back and animate
            item.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        });
    }
    
    // Filter certificates by category
    function filterCertificates(filterValue) {
        console.log('Filtering certificates by:', filterValue);
        
        if (filterValue === 'all') {
            showAllCertificates();
            return;
        }
        
        // Show only the selected category, hide others
        certCategories.forEach(category => {
            if (category.id === filterValue + '-category') {
                category.style.display = 'block';
            } else {
                category.style.display = 'none';
            }
        });
        
        // Ensure items in the visible category are shown properly
        certItems.forEach(item => {
            const parentCategory = item.closest('.cert-category');
            
            if (parentCategory && parentCategory.id === filterValue + '-category') {
                // Reset any previous transitions
                item.style.transition = 'none';
                
                // Set initial state
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                item.style.display = 'flex';
                
                // Force reflow to ensure animation works
                void item.offsetWidth;
                
                // Add transition back and animate
                item.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }
        });
    }
    
    // Add click handlers to filter buttons
    certFilterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            certFilterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Get the filter value
            const filterValue = this.getAttribute('data-filter');
            console.log('Filter selected:', filterValue);
            
            // Apply filter
            filterCertificates(filterValue);
        });
    });
    
    // Initialize certifications
    ensureProperCertStructure();
    addCategoryAttributes();
    
    // Make sure 'All' filter is active by default
    const allButton = document.querySelector('.cert-filter-btn[data-filter="all"]');
    if (allButton) {
        allButton.classList.add('active');
        showAllCertificates();
    }
});
