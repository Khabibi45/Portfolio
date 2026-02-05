/**
 * CINEMATIC TRANSITION MANAGER
 * Handles the "Entry" phase of the page transition.
 * Checks if we arrived from a cinematic click and plays the reverse animation.
 */

(function () {
    // Run immediately to catch the render before paint if possible
    function handleEntrance() {
        if (sessionStorage.getItem('cinema_transition') === 'true') {
            const imageUrl = sessionStorage.getItem('cinema_image');

            // Create overlay immediately
            const overlay = document.createElement('div');
            overlay.style.cssText = `
                position: fixed; inset: 0; z-index: 9999;
                background-image: ${imageUrl};
                background-size: cover;
                background-position: center;
                transform-origin: center center;
                pointer-events: none;
                transform: scale(1.15);
                filter: blur(4px);
            `;
            document.body.appendChild(overlay);

            // Overlay backdrop (to hide page content initially)
            const backdrop = document.createElement('div');
            backdrop.style.cssText = `
                position: fixed; inset: 0; background: #000; z-index: 9998;
                pointer-events: none; opacity: 1;
            `;
            document.body.appendChild(backdrop);

            // Clear flags
            sessionStorage.removeItem('cinema_transition');

            // Wait for GSAP or use vanilla WAAPI if GSAP not ready
            // We'll use a simple RAF loop or setTimeout to ensure DOM is ready for animation
            requestAnimationFrame(() => {
                // Animate Out (Reverse "Dive")
                // Start: Scale 1.15, Blur 4px
                // End: Scale 1, Blur 0, Opacity 0

                // Using GSAP if available, else CSS transition
                if (typeof gsap !== 'undefined') {
                    const tl = gsap.timeline({
                        delay: 0.1, // Small pause to let page render behind
                        onComplete: () => {
                            overlay.remove();
                            backdrop.remove();
                        }
                    });

                    // Reveal page content by fading backdrop FASTER
                    tl.to(backdrop, {
                        opacity: 0,
                        duration: 0.5,
                        ease: "power2.inOut"
                    }, 0);

                    // Image settles and clarifies FASTER
                    tl.to(overlay, {
                        scale: 1,
                        filter: 'blur(0px)',
                        duration: 0.6,
                        ease: "expo.out"
                    }, 0);

                    // Fade out overlay to reveal actual hero image
                    tl.to(overlay, {
                        opacity: 0,
                        duration: 0.4,
                        ease: "power2.inOut"
                    }, 0.3);

                } else {
                    // Fallback CSS animation
                    overlay.style.transition = 'transform 1s cubic-bezier(0.19, 1, 0.22, 1), filter 1s ease, opacity 0.5s ease 0.5s';
                    backdrop.style.transition = 'opacity 0.8s ease';

                    requestAnimationFrame(() => {
                        overlay.style.transform = 'scale(1)';
                        overlay.style.filter = 'blur(0px)';
                        overlay.style.opacity = '0';
                        backdrop.style.opacity = '0';

                        setTimeout(() => {
                            overlay.remove();
                            backdrop.remove();
                        }, 1200);
                    });
                }
            });
        }
    }

    // Try to run as soon as possible
    if (document.body) {
        handleEntrance();
    } else {
        document.addEventListener('DOMContentLoaded', handleEntrance);
    }
})();
