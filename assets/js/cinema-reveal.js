/**
 * CINEMATIC REVEAL - Scroll Reveal Animation
 * Smooth alternating slide-in: left-to-right, then right-to-left
 */

(function () {
    'use strict';

    const CinemaScrollReveal = {
        rows: [],

        init() {
            this.rows = document.querySelectorAll('.cinema-row');
            if (this.rows.length === 0) return;

            // Check if GSAP and ScrollTrigger are available
            if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
                console.warn('GSAP or ScrollTrigger not loaded, falling back to CSS');
                this.fallbackInit();
                return;
            }

            gsap.registerPlugin(ScrollTrigger);
            this.setupAnimations();
        },

        setupAnimations() {
            this.rows.forEach((row, index) => {
                // Simple alternation: even index = from left, odd index = from right
                const xOffset = (index % 2 === 0) ? -150 : 150;

                // Initial state - hidden and offset
                gsap.set(row, {
                    opacity: 0,
                    x: xOffset
                });

                // Animate on scroll
                gsap.to(row, {
                    opacity: 1,
                    x: 0,
                    duration: 1.2,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: row,
                        start: 'top 80%',
                        end: 'top 40%',
                        toggleActions: 'play none none reverse'
                    }
                });
            });
        },

        // Fallback if GSAP not available
        fallbackInit() {
            const options = {
                root: null,
                rootMargin: '-10% 0px -10% 0px',
                threshold: 0.2
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                    }
                });
            }, options);

            this.rows.forEach(row => {
                observer.observe(row);
            });
        }
    };

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => CinemaScrollReveal.init());
    } else {
        CinemaScrollReveal.init();
    }
})();
