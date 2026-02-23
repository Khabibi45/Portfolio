/**
 * LAB — Reveal Controller
 * Lightweight scroll-triggered reveals
 * Uses IntersectionObserver, respects reduced motion
 */

(function () {
  'use strict';

  // Check for reduced motion preference
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Get all reveal elements
  const reveals = document.querySelectorAll('.lab-reveal');
  if (!reveals.length) return;

  // If reduced motion, show all immediately
  if (prefersReducedMotion) {
    reveals.forEach((el) => el.classList.add('is-visible'));
    return;
  }

  // Observer options
  const observerOptions = {
    root: null,
    rootMargin: '0px 0px -10% 0px',
    threshold: 0.1
  };

  // Create observer
  const revealObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target); // Only animate once
      }
    });
  }, observerOptions);

  // Observe all reveal elements
  reveals.forEach((el) => {
    revealObserver.observe(el);
  });
})();
