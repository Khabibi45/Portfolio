/**
 * Skills Cards Interaction Logic (Focus Mode Enhanced)
 */

document.addEventListener('DOMContentLoaded', () => {
    const section = document.getElementById('skills');
    const container = document.querySelector('.skills-container');
    const grid = document.querySelector('.skills-grid');
    const cards = document.querySelectorAll('.skill-card, .skill-tag');
    let activeCard = null;

    // Create Back Button (Safety check for grid)
    const backBtn = document.createElement('button');
    backBtn.className = 'skill-back-btn';
    backBtn.innerHTML = '<i class="fas fa-arrow-left"></i> Retour aux compétences';
    if (grid) grid.appendChild(backBtn);

    backBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        exitFocusMode();
    });

    cards.forEach(card => {
        // Hover Interaction
        card.addEventListener('mouseenter', () => {
            if (activeCard) return;

            // Dim others only if they are cards
            cards.forEach(c => {
                if (c !== card && c.classList.contains('skill-card')) c.classList.add('is-dimmed');
            });

            const key = card.getAttribute('data-skill');
            const label = card.textContent.trim();
            if (key) dispatchSkillEvent('skill:preview', { key, label });
        });

        card.addEventListener('mouseleave', () => {
            if (activeCard) return;

            // Remove dim
            cards.forEach(c => {
                c.classList.remove('is-dimmed');
            });
        });

        // Click Interaction (Focus Mode)
        card.addEventListener('click', () => {
            if (activeCard === card) return; // Already active

            enterFocusMode(card);
        });

        card.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                card.click();
            }
        });
    });

    function enterFocusMode(selectedCard) {
        activeCard = selectedCard;
        document.body.classList.add('focus-active');
        container.classList.add('skills-focus-mode');

        // Update cards state
        cards.forEach(c => {
            if (c === selectedCard) {
                c.classList.remove('is-dimmed');
                c.classList.add('skill-selected');
                c.classList.remove('skill-hidden');
            } else {
                c.classList.remove('skill-selected');
                c.classList.remove('is-dimmed');
                c.classList.add('skill-hidden');
            }
        });

        // Dispatch select event
        const key = selectedCard.getAttribute('data-skill');
        const label = selectedCard.textContent.trim();
        dispatchSkillEvent('skill:select', { key, label });
    }

    function exitFocusMode() {
        if (!activeCard) return;

        // Reset states
        activeCard = null;
        document.body.classList.remove('focus-active');
        container.classList.remove('skills-focus-mode');

        // Restore cards with stagger (visual trick via timeout? or just CSS transition)
        // CSS transition handles opacity nicely. We just remove classes.
        cards.forEach(c => {
            c.classList.remove('skill-selected');
            c.classList.remove('skill-hidden');
            c.classList.remove('is-dimmed');
        });

        // Dispatch clear
        dispatchSkillEvent('skill:clear');
    }

    // Reset on mouse leave section (only if not active)
    if (section) {
        section.addEventListener('mouseleave', () => {
            if (!activeCard) {
                dispatchSkillEvent('skill:clear');
            }
        });
    }

    function dispatchSkillEvent(name, detail = {}) {
        const event = new CustomEvent(name, { detail });
        document.dispatchEvent(event);
    }
});
