/**
 * LAB — Theme Toggle Controller
 * Light/Dark mode switch with localStorage persistence
 */

(function () {
  'use strict';

  const toggle = document.querySelector('.lab-theme-toggle');
  if (!toggle) return;

  const STORAGE_KEY = 'lab-theme';
  const html = document.documentElement;

  // Get saved theme or system preference
  function getPreferredTheme() {
    const saved = localStorage.getItem(STORAGE_KEY);
    if (saved) return saved;

    return window.matchMedia('(prefers-color-scheme: light)').matches
      ? 'light'
      : 'dark';
  }

  // Apply theme
  function setTheme(theme) {
    if (theme === 'light') {
      html.setAttribute('data-theme', 'light');
    } else {
      html.removeAttribute('data-theme');
    }
    localStorage.setItem(STORAGE_KEY, theme);
  }

  // Initialize
  const initialTheme = getPreferredTheme();
  setTheme(initialTheme);

  // Toggle handler
  toggle.addEventListener('click', () => {
    const currentTheme = html.getAttribute('data-theme') === 'light' ? 'light' : 'dark';
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    setTheme(newTheme);
  });

  // Listen for system preference changes
  window.matchMedia('(prefers-color-scheme: light)').addEventListener('change', (e) => {
    // Only update if no manual override
    if (!localStorage.getItem(STORAGE_KEY)) {
      setTheme(e.matches ? 'light' : 'dark');
    }
  });
})();
