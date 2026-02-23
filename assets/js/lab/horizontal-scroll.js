/**
 * LAB — Horizontal Scroll Controller
 * Pattern 3: Vertical scroll drives horizontal content
 * Minimal JS, CSS-first approach
 */

(function () {
  'use strict';

  // Elements
  const section = document.querySelector('.lab-horizontal');
  if (!section) return;

  const wrapper = section.querySelector('.lab-horizontal__wrapper');
  const track = section.querySelector('.lab-horizontal__track');
  const spacer = section.querySelector('.lab-horizontal__spacer');
  const panels = section.querySelectorAll('.lab-horizontal__panel');
  const progressBar = section.querySelector('.lab-horizontal__progress');
  const progressFill = section.querySelector('.lab-horizontal__progress-fill');
  const counter = section.querySelector('.lab-horizontal__counter-current');

  if (!wrapper || !track || !panels.length) return;

  // Skip on mobile (native scroll)
  const isMobile = window.matchMedia('(max-width: 768px)').matches;
  if (isMobile) return;

  // Respect reduced motion
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Calculate dimensions
  const panelCount = panels.length;
  let trackWidth = 0;
  let scrollHeight = 0;
  let sectionTop = 0;

  function calculateDimensions() {
    trackWidth = track.scrollWidth - window.innerWidth;
    scrollHeight = spacer.offsetHeight;
    sectionTop = section.offsetTop;
  }

  // Scroll handler
  function handleScroll() {
    const scrollY = window.scrollY;
    const sectionStart = sectionTop;
    const sectionEnd = sectionTop + scrollHeight;

    // Check if we're in the section
    if (scrollY < sectionStart || scrollY > sectionEnd) {
      if (progressBar) progressBar.classList.remove('is-visible');
      return;
    }

    // Calculate progress (0 to 1)
    const progress = Math.min(Math.max((scrollY - sectionStart) / scrollHeight, 0), 1);

    // Apply transform
    const translateX = -trackWidth * progress;

    if (prefersReducedMotion) {
      track.style.transform = `translateX(${translateX}px)`;
    } else {
      track.style.transform = `translateX(${translateX}px)`;
    }

    // Update progress bar
    if (progressBar) {
      progressBar.classList.add('is-visible');
      if (progressFill) {
        progressFill.style.width = `${progress * 100}%`;
      }
    }

    // Update counter
    if (counter) {
      const currentPanel = Math.min(
        Math.floor(progress * panelCount) + 1,
        panelCount
      );
      counter.textContent = String(currentPanel).padStart(2, '0');
    }
  }

  // Throttled scroll
  let ticking = false;
  function onScroll() {
    if (!ticking) {
      requestAnimationFrame(() => {
        handleScroll();
        ticking = false;
      });
      ticking = true;
    }
  }

  // Resize handler
  function onResize() {
    // Check if still desktop
    if (window.matchMedia('(max-width: 768px)').matches) {
      track.style.transform = '';
      window.removeEventListener('scroll', onScroll);
      return;
    }
    calculateDimensions();
    handleScroll();
  }

  // Initialize
  calculateDimensions();
  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', onResize, { passive: true });

  // Initial call
  handleScroll();
})();
