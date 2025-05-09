/**
 * Certifications filter enhancement script
 * This script adds better filtering capabilities to the certifications section
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('Enhanced certifications filter script loaded');

    const certFilterButtons = document.querySelectorAll('.cert-filter-btn');
    const certCategories = document.querySelectorAll('#certifications .cert-category');
    const certItems = document.querySelectorAll('#certifications .certification-item');
    
    // Create direct references to important categories to ensure they're properly identified
    const professionalCategory = document.getElementById('professional-category');
    console.log('Professional category found:', professionalCategory ? true : false);
      // Add data-category attributes to all certification items based on their parent category
    function addCategoryAttributes() {
        certItems.forEach(item => {
            const parentCategory = item.closest('.cert-category');
            if (parentCategory) {
                const categoryId = parentCategory.id;
                if (categoryId) {
                    const categoryName = categoryId.replace('-category', '');
                    item.setAttribute('data-category', categoryName);
                    
                    // Add category label to each item for the decoration
                    const filterButton = Array.from(certFilterButtons).find(btn => 
                        btn.getAttribute('data-filter') === categoryName
                    );
                    
                    const readableCategoryName = filterButton ? filterButton.textContent : categoryName;
                    
                    // Set the readable category name for the hover label
                    item.setAttribute('data-category', readableCategoryName);
                    
                    // Log for debugging
                    console.log(`Item assigned to category: ${categoryName}, Display as: ${readableCategoryName}`);
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
    }    // Filter certificates by category
    function filterCertificates(filterValue) {
        console.log('Filtering certificates by:', filterValue);
        
        // Special handling for professional category
        if (filterValue === 'professional') {
            const professionalCategory = document.getElementById('professional-category');
            if (professionalCategory) {
                // Let the professional-category-fix.js handle this case
                return;
            }
        }
        
        if (filterValue === 'all') {
            showAllCertificates();
            return;
        }
        
        // Debug: check which categories exist
        console.log('Available categories:');
        certCategories.forEach(cat => {
            console.log('Category ID:', cat.id);
        });
          // Show only the selected category, hide others
        let categoryFound = false;
        
        // First, remove all active-category classes
        certCategories.forEach(cat => {
            cat.classList.remove('active-category');
        });
        
        // Add a special class to the body to force professional category to show when selected
        document.body.classList.remove('show-professional');
        if (filterValue === 'professional') {
            document.body.classList.add('show-professional');
        }
        
        certCategories.forEach(category => {
            // Normalize the comparison to ensure matching works regardless of exact ID format
            const categoryId = category.id.toLowerCase().replace(/[^a-z0-9]/g, '');
            const filterMatch = (filterValue + 'category').toLowerCase().replace(/[^a-z0-9]/g, '');
            
            if (categoryId === filterMatch || category.id === filterValue + '-category') {
                console.log('Showing category:', category.id);
                category.style.display = 'block';
                category.classList.add('active-category');
                categoryFound = true;
            } else {
                category.style.display = 'none';
            }
        });
        
        // If no category was found, check if there might be a different ID format
        if (!categoryFound) {
            console.warn('No category found for filter:', filterValue);
            // As a fallback, try a less strict matching
            certCategories.forEach(category => {
                if (category.id.includes(filterValue)) {
                    console.log('Fallback showing category:', category.id);
                    category.style.display = 'block';
                }
            });
        }
        
        // Ensure items in the visible category are shown properly
        certItems.forEach(item => {
            const parentCategory = item.closest('.cert-category');
            
            if (parentCategory && parentCategory.style.display !== 'none') {
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
            
            // Log all categories for debugging
            console.log('All categories in DOM:');
            document.querySelectorAll('.cert-category').forEach(cat => {
                console.log(`- ${cat.id} (display: ${window.getComputedStyle(cat).display})`);
            });
            
            // Apply filter
            filterCertificates(filterValue);
            
            // Force recheck to ensure the professional category is shown when needed
            if (filterValue === 'professional') {
                const profCategory = document.getElementById('professional-category');
                if (profCategory) {
                    console.log('Forcing professional category to display block');
                    profCategory.style.display = 'block';
                }
            }
        });
    });
      // Initialize certifications
    ensureProperCertStructure();
    addCategoryAttributes();
    
    // Add certification count badges to category titles
    function addCertificationCounters() {
        certCategories.forEach(category => {
            const categoryItems = category.querySelectorAll('.certification-item');
            const categoryTitle = category.querySelector('.cert-category-title');
            
            if (categoryTitle && categoryItems.length > 0) {
                // Create counter element
                const counter = document.createElement('span');
                counter.classList.add('cert-count-badge');
                counter.textContent = categoryItems.length;
                
                // Add to title
                categoryTitle.appendChild(counter);
            }
        });
    }
    
    // Add count badges to filter buttons
    function addFilterButtonCounters() {
        certFilterButtons.forEach(button => {
            const filterValue = button.getAttribute('data-filter');
            
            if (filterValue === 'all') {
                const totalCount = certItems.length;
                const counter = document.createElement('span');
                counter.classList.add('filter-count-badge');
                counter.textContent = totalCount;
                button.appendChild(counter);
            } else {
                const categoryItems = document.querySelectorAll(`#${filterValue}-category .certification-item`);
                if (categoryItems.length > 0) {
                    const counter = document.createElement('span');
                    counter.classList.add('filter-count-badge');
                    counter.textContent = categoryItems.length;
                    button.appendChild(counter);
                }
            }
        });
    }
    
    // Add counters
    addCertificationCounters();
    addFilterButtonCounters();
      // Ensure all categories have proper IDs and are accessible via filters
    function validateCategoryIds() {
        // Check all categories against their expected filter values
        const allFilters = Array.from(certFilterButtons).map(btn => btn.getAttribute('data-filter'));
        console.log('Available filters:', allFilters);
        
        certCategories.forEach(category => {
            const categoryId = category.id;
            const expectedFilter = categoryId.replace('-category', '');
            console.log(`Category ${categoryId} should match filter '${expectedFilter}'`);
            
            // For professional category, add extra attribute to ensure it's always findable
            if (categoryId === 'professional-category') {
                category.setAttribute('data-cert-type', 'professional');
            }
        });
    }
    
    // Run validation
    validateCategoryIds();
    
    // Make sure 'All' filter is active by default
    const allButton = document.querySelector('.cert-filter-btn[data-filter="all"]');
    if (allButton) {
        allButton.classList.add('active');
        showAllCertificates();
    }
});
