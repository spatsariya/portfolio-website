/**
 * Script to update all timeline items with expandable functionality
 */

// Function to wrap timeline items with expandable structure
function updateTimelineItems() {
    const timelineItems = document.querySelectorAll('.timeline-item');
    
    timelineItems.forEach(item => {
        const timelineContent = item.querySelector('.timeline-content');
        const timelineList = timelineContent.querySelector('.timeline-list');
        
        // Skip if already has expandable structure
        if (timelineContent.querySelector('.timeline-expandable')) {
            return;
        }
        
        if (timelineList) {
            // Create expandable structure
            const expandableDiv = document.createElement('div');
            expandableDiv.className = 'timeline-expandable';
            
            const detailsDiv = document.createElement('div');
            detailsDiv.className = 'timeline-details';
            detailsDiv.style.display = 'none';
            
            const toggleBtn = document.createElement('button');
            toggleBtn.className = 'timeline-toggle';
            toggleBtn.setAttribute('data-expanded', 'false');
            toggleBtn.innerHTML = `
                <span class="toggle-text">View more</span>
                <i class="fas fa-chevron-down toggle-icon"></i>
            `;
            
            // Move the timeline-list to details
            detailsDiv.appendChild(timelineList);
            
            // Append to expandable div
            expandableDiv.appendChild(detailsDiv);
            expandableDiv.appendChild(toggleBtn);
            
            // Append expandable div to timeline content
            timelineContent.appendChild(expandableDiv);
            
            // Add click event
            toggleBtn.addEventListener('click', function() {
                const isExpanded = this.getAttribute('data-expanded') === 'true';
                const toggleText = this.querySelector('.toggle-text');
                
                if (isExpanded) {
                    detailsDiv.classList.remove('expanded');
                    this.setAttribute('data-expanded', 'false');
                    toggleText.textContent = 'View more';
                } else {
                    detailsDiv.classList.add('expanded');
                    this.setAttribute('data-expanded', 'true');
                    toggleText.textContent = 'View less';
                }
            });
        }
    });
}

// Run when DOM is loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', updateTimelineItems);
} else {
    updateTimelineItems();
}
