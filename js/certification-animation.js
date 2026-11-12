/**
 * Certifications category index.
 * Native details/summary handles keyboard interaction; filters reveal and open the chosen category.
 */
document.addEventListener('DOMContentLoaded', () => {
    const section = document.getElementById('certifications');
    if (!section) return;

    const buttons = [...section.querySelectorAll('.cert-filter-btn')];
    const categories = [...section.querySelectorAll('.cert-category')];
    const hint = section.querySelector('#certifications-hint');

    if (!buttons.length || !categories.length) return;

    function refreshLayout() {
        if (typeof AOS !== 'undefined' && typeof AOS.refresh === 'function') {
            AOS.refresh();
        }
    }

    function selectCategory(filter) {
        const selectedButton = buttons.find(button => button.dataset.filter === filter);
        if (!selectedButton) return;

        buttons.forEach(button => {
            const active = button === selectedButton;
            button.classList.toggle('active', active);
            button.setAttribute('aria-pressed', String(active));
        });

        let visibleCount = 0;
        let visibleCategories = 0;
        categories.forEach(category => {
            const matches = filter === 'all' || category.dataset.categoryType === filter;
            category.hidden = !matches;
            category.classList.toggle('is-hidden', !matches);
            category.setAttribute('aria-hidden', String(!matches));
            // The overview is compact; selecting a particular field opens it.
            category.open = filter !== 'all' && matches;
            if (matches) {
                visibleCategories += 1;
                visibleCount += category.querySelectorAll('.certification-item').length;
            }
        });

        if (hint) {
            hint.textContent = filter === 'all'
                ? '36 credentials across 6 fields. Expand a row to explore.'
                : visibleCount + ' ' + (visibleCount === 1 ? 'credential' : 'credentials') +
                    ' in ' + selectedButton.textContent.replace(/\d+/g, '').trim() + '.';
        }

        refreshLayout();
    }

    buttons.forEach(button => {
        button.addEventListener('click', () => selectCategory(button.dataset.filter || 'all'));
    });

    categories.forEach(category => {
        category.addEventListener('toggle', refreshLayout);
    });

    selectCategory('all');
});
