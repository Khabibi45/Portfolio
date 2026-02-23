/**
 * LAB — Active Chapters Controller
 * Pattern 2: Sticky sidebar with active state tracking
 * Uses IntersectionObserver for performance
 */

(function () {
  'use strict';

  // Elements
  const section = document.querySelector('.lab-sticky-chapter');
  if (!section) return;

  const navItems = section.querySelectorAll('.lab-sticky-chapter__index-item');
  const blocks = section.querySelectorAll('.lab-sticky-chapter__block');
  const progressFill = section.querySelector('.lab-sticky-chapter__progress-fill');

  if (!navItems.length || !blocks.length) return;

  // Respect reduced motion
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Create observer for blocks
  const observerOptions = {
    root: null,
    rootMargin: '-20% 0px -60% 0px', // Trigger when block is in middle third
    threshold: 0
  };

  let currentActive = null;

  const blockObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const blockId = entry.target.id;

        // Update active nav item
        navItems.forEach((item) => {
          const href = item.getAttribute('href');
          if (href === `#${blockId}`) {
            item.classList.add('is-active');
            currentActive = item;
          } else {
            item.classList.remove('is-active');
          }
        });
      }
    });
  }, observerOptions);

  // Observe all blocks
  blocks.forEach((block) => {
    blockObserver.observe(block);
  });

  // Progress bar (optional)
  if (progressFill && !prefersReducedMotion) {
    let ticking = false;

    function updateProgress() {
      const sectionRect = section.getBoundingClientRect();
      const sectionHeight = section.offsetHeight;
      const viewportHeight = window.innerHeight;

      // Calculate scroll progress through section
      const scrolled = -sectionRect.top;
      const totalScroll = sectionHeight - viewportHeight;
      const progress = Math.min(Math.max(scrolled / totalScroll, 0), 1);

      progressFill.style.height = `${progress * 100}%`;
    }

    function onScroll() {
      if (!ticking) {
        requestAnimationFrame(() => {
          updateProgress();
          ticking = false;
        });
        ticking = true;
      }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    updateProgress();
  }

  // Smooth scroll for nav clicks
  navItems.forEach((item) => {
    item.addEventListener('click', (e) => {
      e.preventDefault();
      const targetId = item.getAttribute('href');
      const target = document.querySelector(targetId);

      if (target) {
        const offsetTop = target.getBoundingClientRect().top + window.scrollY;
        const offset = window.innerHeight * 0.2; // Match rootMargin

        window.scrollTo({
          top: offsetTop - offset,
          behavior: prefersReducedMotion ? 'auto' : 'smooth'
        });

        // Focus management for accessibility
        target.setAttribute('tabindex', '-1');
        target.focus({ preventScroll: true });
      }
    });
  });
})();
