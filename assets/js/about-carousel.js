/**
 * About Section: Mountain Carousel Logic
 * Using GSAP for smooth performance and premium animations
 */

document.addEventListener('DOMContentLoaded', () => {
    const track = document.querySelector('.about-carousel-track');
    const items = document.querySelectorAll('.about-carousel-item');
    if (!track || items.length === 0) return;

    window.addEventListener('about:carousel_ready', () => {
        initCarouselAnimations();
    });

    function initCarouselAnimations() {
        // Center the track
        gsap.set(track, { x: 0 });

        // Animated entrance for items
        gsap.from(items, {
            y: 60,
            opacity: 0,
            rotateY: -20,
            stagger: 0.2,
            duration: 1.5,
            ease: "expo.out"
        });

        // Subtle synchronized float effect
        gsap.to(items, {
            y: 12,
            duration: 3,
            repeat: -1,
            yoyo: true,
            ease: "sine.inOut",
            stagger: {
                each: 0.3,
                from: "center"
            }
        });

        // Setup individual item interactions
        items.forEach((item) => {
            // Hover effect
            item.addEventListener('mouseenter', () => {
                gsap.to(item, {
                    scale: 1.05,
                    rotateY: 10,
                    borderColor: "rgba(99, 102, 241, 0.5)",
                    zIndex: 10,
                    duration: 0.4
                });
            });

            item.addEventListener('mouseleave', () => {
                gsap.to(item, {
                    scale: 1,
                    rotateY: 0,
                    borderColor: "rgba(255, 255, 255, 0.1)",
                    zIndex: 1,
                    duration: 0.4
                });
            });
        });
    }

    // Simple horizontal scroll sync
    let isDown = false;
    let startX;
    let scrollLeft;

    track.addEventListener('mousedown', (e) => {
        isDown = true;
        track.style.cursor = 'grabbing';
        startX = e.pageX - track.offsetLeft;
        scrollLeft = track.scrollLeft;
    });

    track.addEventListener('mouseleave', () => {
        isDown = false;
        track.style.cursor = 'grab';
    });

    track.addEventListener('mouseup', () => {
        isDown = false;
        track.style.cursor = 'grab';
    });

    track.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - track.offsetLeft;
        const walk = (x - startX) * 2;
        gsap.to(track, {
            x: `+=${walk * 0.1}`,
            duration: 0.5,
            ease: "power2.out"
        });
    });
});
