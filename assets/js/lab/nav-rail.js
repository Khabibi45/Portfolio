/**
 * LAB — Navigation Rail Controller
 * Lateral navigation with active section tracking
 */

(function () {
  'use strict';

  const navRail = document.querySelector('.lab-nav-rail');
  if (!navRail) return;

  const navItems = navRail.querySelectorAll('.lab-nav-rail__item');
  const labSection = document.getElementById('lab');
  if (!labSection) return;

  // Sections to track
  const sections = [
    { id: 'lab-hero', el: labSection.querySelector('.lab-hero') },
    { id: 'lab-stacked', el: labSection.querySelector('.lab-stacked') },
    { id: 'lab-chapter', el: labSection.querySelector('.lab-sticky-chapter') },
    { id: 'lab-horizontal', el: labSection.querySelector('.lab-horizontal') },
    { id: 'lab-windows', el: labSection.querySelector('.lab-windows') },
    { id: 'lab-broken', el: labSection.querySelector('.lab-broken') }
  ].filter(s => s.el);

  // Show/hide rail based on Lab section visibility
  const labObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        navRail.classList.add('is-visible');
      } else {
        navRail.classList.remove('is-visible');
      }
    });
  }, {
    root: null,
    threshold: 0.1
  });

  labObserver.observe(labSection);

  // Track active section
  const sectionObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const sectionId = entry.target.dataset.labSection;

        navItems.forEach((item) => {
          const itemTarget = item.getAttribute('href')?.replace('#', '');
          if (itemTarget === sectionId) {
            item.classList.add('is-active');
          } else {
            item.classList.remove('is-active');
          }
        });
      }
    });
  }, {
    root: null,
    rootMargin: '-40% 0px -40% 0px',
    threshold: 0
  });

  sections.forEach(({ id, el }) => {
    if (el) {
      el.dataset.labSection = id;
      sectionObserver.observe(el);
    }
  });

  // Smooth scroll on click
  navItems.forEach((item) => {
    item.addEventListener('click', (e) => {
      e.preventDefault();
      const targetId = item.getAttribute('href');
      const target = document.querySelector(targetId);

      if (target) {
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        target.scrollIntoView({
          behavior: prefersReducedMotion ? 'auto' : 'smooth',
          block: 'start'
        });
      }
    });
  });
})();
