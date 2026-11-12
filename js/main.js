/**
 * Main JavaScript for Shivam Patsariya's UX Designer Portfolio
 */

// Initialize AOS animations
document.addEventListener('DOMContentLoaded', function() {
    // First-load interaction safety: ensure pointer interactions are never globally blocked
    function ensurePageInteractive() {
        if (document.documentElement) {
            document.documentElement.style.pointerEvents = 'auto';
        }
        if (document.body) {
            document.body.style.pointerEvents = 'auto';
        }
    }

    ensurePageInteractive();
    window.addEventListener('load', ensurePageInteractive, { once: true });
    setTimeout(ensurePageInteractive, 1200);

    // Mobile navigation is keyboard-accessible by using the native button behavior.
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const mobileMenu = document.querySelector('.mobile-menu');
    if (mobileMenuBtn && mobileMenu) {
        const closeMenu = (returnFocus = false) => {
            const wasOpen = mobileMenuBtn.getAttribute('aria-expanded') === 'true';
            mobileMenu.classList.remove('active');
            mobileMenuBtn.classList.remove('active');
            mobileMenuBtn.setAttribute('aria-expanded', 'false');
            mobileMenuBtn.setAttribute('aria-label', 'Open navigation menu');
            mobileMenu.setAttribute('aria-hidden', 'true');
            mobileMenu.inert = true;
            if (wasOpen && returnFocus) mobileMenuBtn.focus();
        };
        mobileMenuBtn.addEventListener('click', () => {
            const shouldOpen = mobileMenuBtn.getAttribute('aria-expanded') !== 'true';
            if (!shouldOpen) return closeMenu();
            mobileMenu.classList.add('active');
            mobileMenuBtn.classList.add('active');
            mobileMenuBtn.setAttribute('aria-expanded', 'true');
            mobileMenuBtn.setAttribute('aria-label', 'Close navigation menu');
            mobileMenu.setAttribute('aria-hidden', 'false');
            mobileMenu.inert = false;
            mobileMenu.querySelector('a')?.focus();
        });
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => closeMenu());
        });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') closeMenu(true);
        });
        document.addEventListener('pointerdown', (event) => {
            if (mobileMenuBtn.getAttribute('aria-expanded') === 'true' &&
                !mobileMenu.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                closeMenu();
            }
        });
        window.addEventListener('resize', () => {
            if (window.innerWidth > 920) closeMenu();
        }, { passive: true });
    }

    // Timeline Expandable Functionality
    function setTimelineExpandedState(toggleBtn, detailsDiv, isExpanded) {
        const toggleIcon = toggleBtn.querySelector('.toggle-icon');
        const toggleText = toggleBtn.querySelector('.toggle-text');

        toggleBtn.setAttribute('data-expanded', isExpanded ? 'true' : 'false');
        toggleBtn.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
        detailsDiv.hidden = !isExpanded;
        detailsDiv.style.display = isExpanded ? 'block' : 'none';
        detailsDiv.classList.toggle('expanded', isExpanded);
        detailsDiv.setAttribute('aria-hidden', isExpanded ? 'false' : 'true');
        const roleHeading = toggleBtn.closest('.timeline-content')?.querySelector('h3');
        const roleName = roleHeading ? roleHeading.textContent.trim() : 'this entry';
        toggleBtn.setAttribute('aria-label', (isExpanded ? 'Hide details for ' : 'View details for ') + roleName);

        if (toggleText) {
            toggleText.textContent = isExpanded ? 'Hide details' : 'View details';
        }

        if (toggleIcon) {
            toggleIcon.classList.toggle('fa-chevron-up', isExpanded);
            toggleIcon.classList.toggle('fa-chevron-down', !isExpanded);
        }
    }

    function bindTimelineToggle(toggleBtn, detailsDiv) {
        if (!toggleBtn || !detailsDiv || toggleBtn.hasAttribute('data-listener-added')) {
            return;
        }

        toggleBtn.setAttribute('data-listener-added', 'true');
        setTimelineExpandedState(toggleBtn, detailsDiv, toggleBtn.getAttribute('data-expanded') === 'true');

        toggleBtn.addEventListener('click', function() {
            const isExpanded = this.getAttribute('data-expanded') === 'true';
            setTimelineExpandedState(this, detailsDiv, !isExpanded);
        });
    }

    function initializeTimelineExpandable() {
        const timelineItems = document.querySelectorAll('.timeline-item');

        timelineItems.forEach(item => {
            const timelineContent = item.querySelector('.timeline-content');
            if (!timelineContent) {
                return;
            }

            let timelineExpandable = timelineContent.querySelector('.timeline-expandable');
            let detailsDiv = timelineExpandable ? timelineExpandable.querySelector('.timeline-details') : null;
            let toggleBtn = timelineExpandable ? timelineExpandable.querySelector('.timeline-toggle') : null;

            if (!timelineExpandable) {
                const timelineList = timelineContent.querySelector('.timeline-list');

                if (!timelineList) {
                    return;
                }

                timelineExpandable = document.createElement('div');
                timelineExpandable.className = 'timeline-expandable';

                detailsDiv = document.createElement('div');
                detailsDiv.className = 'timeline-details';
                detailsDiv.hidden = true;

                toggleBtn = document.createElement('button');
                toggleBtn.className = 'timeline-toggle';
                toggleBtn.setAttribute('type', 'button');
                toggleBtn.setAttribute('data-expanded', 'false');
                toggleBtn.innerHTML = `
                    <span class="toggle-text">View</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                `;

                detailsDiv.appendChild(timelineList);
                timelineExpandable.appendChild(detailsDiv);
                timelineExpandable.appendChild(toggleBtn);
                timelineContent.appendChild(timelineExpandable);
            }

            if (!detailsDiv.id) {
                detailsDiv.id = `timeline-details-${Math.random().toString(36).slice(2, 10)}`;
            }

            toggleBtn.setAttribute('type', 'button');
            toggleBtn.setAttribute('aria-controls', detailsDiv.id);
            bindTimelineToggle(toggleBtn, detailsDiv);
        });
    }

    initializeTimelineExpandable();

    // Stats animation functionality
    function animateStats() {
        const stats = document.querySelectorAll('.stat-number');
        stats.forEach(stat => {
            const target = parseInt(stat.getAttribute('data-count'));
            let count = 0;
            const increment = Math.ceil(target / 50);
            
            const timer = setInterval(() => {
                count += increment;
                if (count >= target) {
                    count = target;
                    clearInterval(timer);
                }
                
                if (target >= 1000) {
                    stat.textContent = (count / 1000).toFixed(1) + 'k+';
                } else {
                    stat.textContent = count + '+';
                }
            }, 50);
        });
    }

    // Trigger stats animation on scroll
    const statsSection = document.querySelector('.about-stats');
    if (statsSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStats();
                    observer.disconnect();
                }
            });
        });
        observer.observe(statsSection);
    }

    // Projects filter: keep the featured grid and the expandable index in sync.
    const projectsSection = document.getElementById('projects');
    if (projectsSection) {
        const filterBtns = projectsSection.querySelectorAll('.filter-btn');
        const projectItems = projectsSection.querySelectorAll('.project-item');
        const featuredProjects = projectsSection.querySelector('#featured-projects');
        const featuredCards = featuredProjects.querySelectorAll('.project-item');
        const moreProjects = projectsSection.querySelector('#more-projects');
        const moreCards = moreProjects.querySelectorAll('.project-item');
        const projectCount = projectsSection.querySelector('#projects-count');
        const moreLabel = projectsSection.querySelector('#more-projects-label');
        const filterNames = { all: 'all projects', mobile: 'mobile apps', web: 'websites', branding: 'branding' };

        const updateProjectFilter = (filter) => {
            let total = 0;
            projectItems.forEach(item => {
                const matches = filter === 'all' || item.dataset.category === filter;
                item.hidden = !matches;
                if (matches) total += 1;
            });

            const featuredVisible = [...featuredCards].filter(item => !item.hidden).length;
            const moreVisible = [...moreCards].filter(item => !item.hidden).length;

            featuredProjects.hidden = featuredVisible === 0;
            moreProjects.hidden = moreVisible === 0;
            moreProjects.open = filter !== 'all' && moreVisible > 0;
            if (moreLabel) {
                moreLabel.textContent = `Explore ${moreVisible} more ${moreVisible === 1 ? 'project' : 'projects'}`;
            }
            if (projectCount) {
                projectCount.textContent = filter === 'all'
                    ? `${featuredVisible} featured projects · ${moreVisible} more to explore`
                    : `${total} ${total === 1 ? 'project' : 'projects'} in ${filterNames[filter] || filter}`;
            }

            filterBtns.forEach(button => {
                const active = button.dataset.filter === filter;
                button.classList.toggle('active', active);
                button.setAttribute('aria-pressed', String(active));
            });

            if (typeof AOS !== 'undefined' && typeof AOS.refresh === 'function') {
                AOS.refresh();
            }
        };

        filterBtns.forEach(button => {
            button.addEventListener('click', () => {
                updateProjectFilter(button.dataset.filter);
            });
        });
    }

    // Native anchor navigation updates the URL while respecting reduced-motion.
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', (event) => {
            const href = link.getAttribute('href');
            if (!href || href === '#') return;
            const target = document.getElementById(href.slice(1));
            if (!target) return;
            event.preventDefault();
            target.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'start' });
            if (window.location.hash !== href) history.replaceState(null, '', href);
        });
    });

    const header = document.querySelector('.header');
    if (header) {
        let scrollScheduled = false;
        const onScroll = () => {
            if (scrollScheduled) return;
            scrollScheduled = true;
            requestAnimationFrame(() => {
                header.classList.toggle('scrolled', window.scrollY > 80);
                scrollScheduled = false;
            });
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    // Reflect the section in view without reading layout every scroll frame.
    const navLinks = [...document.querySelectorAll('.nav-menu a[href^="#"],.mobile-menu a[href^="#"]')];
    const sections = [...new Set(navLinks.map(link => document.getElementById(link.getAttribute('href').slice(1))))]
        .filter(Boolean);
    if (sections.length && 'IntersectionObserver' in window) {
        let activeId = '';
        const navObserver = new IntersectionObserver((entries) => {
            const visible = entries.filter(entry => entry.isIntersecting)
                .sort((a,b) => b.intersectionRatio - a.intersectionRatio);
            if (!visible.length) return;
            const id = visible[0].target.id;
            if (id === activeId) return;
            activeId = id;
            navLinks.forEach(link => {
                const active = link.getAttribute('href') === '#' + id;
                link.classList.toggle('active', active);
                if (active) link.setAttribute('aria-current', 'location');
                else link.removeAttribute('aria-current');
            });
        }, { rootMargin: '-20% 0px -55% 0px', threshold: [0, 0.25, 0.5] });
        sections.forEach(section => navObserver.observe(section));
    }

    // Scroll to Top Button Functionality
    const scrollToTopBtn = document.getElementById('scrollToTop');
    
    if (scrollToTopBtn) {
        // Show/hide scroll to top button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.add('show');
            } else {
                scrollToTopBtn.classList.remove('show');
            }
        });
        
        // Smooth scroll to top when button is clicked
        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});
