/**
 * LAB — Main Controller
 * Initializes all Lab modules
 * CSS-first, minimal motion approach
 */

// Load modules when DOM is ready
document.addEventListener('DOMContentLoaded', function () {
  'use strict';

  // Check if Lab section exists
  const labSection = document.getElementById('lab');
  if (!labSection) return;

  console.log('[Lab] Initializing Awwwards-grade experience...');

  // Dynamic script loading for Lab modules
  const labScripts = [
    'assets/js/lab/reveal.js',
    'assets/js/lab/active-chapters.js',
    'assets/js/lab/horizontal-scroll.js',
    'assets/js/lab/nav-rail.js',
    'assets/js/lab/theme-toggle.js'
  ];

  // Load scripts sequentially to avoid race conditions
  function loadScript(src) {
    return new Promise((resolve, reject) => {
      const script = document.createElement('script');
      script.src = src;
      script.onload = resolve;
      script.onerror = reject;
      document.body.appendChild(script);
    });
  }

  // Load all scripts
  Promise.all(labScripts.map(loadScript))
    .then(() => {
      console.log('[Lab] All modules loaded');
    })
    .catch((err) => {
      console.warn('[Lab] Module loading error:', err);
    });
});
