/**
 * Professional Category Fix
 * This script ensures the Professional Qualifications category shows correctly
 * when filtered
 */
window.addEventListener('load', function() {
    const professionalCategory = document.getElementById('professional-category');
    
    if (professionalCategory) {
        professionalCategory.setAttribute('data-category-type', 'professional');
    }
});
