/**
 * COLLECTION - Premium Motion Design Logic
 * Upgraded with Cinematic Scatter, Flip Snap, and Refined Physics
 */

if (typeof gsap !== 'undefined') {
    gsap.registerPlugin(Flip, ScrollTrigger);
}

document.addEventListener('collection:rendered', () => {
    const cards = document.querySelectorAll('.collection-card');
    const hub = document.getElementById('collection-hub');
    const main = document.getElementById('collection-main');
    const finalGrid = document.getElementById('collection-grid-final');

    if (!cards.length) return;

    // 1. Initial Stack State - Z-Monotone for realism
    if (main.classList.contains('is-stacked')) {
        gsap.set(cards, {
            x: (i) => i * 1.5,
            y: (i) => i * -1.5,
            rotation: (i) => (i - cards.length / 2) * 2,
            z: (i) => -i * 15,
            transformOrigin: "center center"
        });
    }

    // 2. Interactive ScrollTrigger
    ScrollTrigger.create({
        trigger: hub,
        start: "top 70%",
        once: true,
        onEnter: () => {
            if (!hub.classList.contains('exploration-active')) {
                triggerExploration();
            }
        }
    });

    // 3. Premium Hover & 3D Friction
    cards.forEach(card => {
        const inner = card.querySelector('.c-card-inner');
        const cover = card.querySelector('.c-cover');
        const wrapper = card.querySelector('.c-image-wrapper');
        const indicator = card.querySelector('.c-indicator');

        // State for LERP (friction)
        let targetX = 0, targetY = 0;
        let currentX = 0, currentY = 0;
        let isHovered = false;

        const hoverTl = gsap.timeline({ paused: true });

        // Soft Mask Reveal
        hoverTl.to(wrapper, {
            webkitMaskPosition: '0% 0%',
            maskPosition: '0% 0%',
            duration: 1.2,
            ease: "expo.out"
        }, 0)
            .to(cover, {
                opacity: 1,
                scale: 1,
                duration: 1.2,
                ease: "expo.out"
            }, 0)
            .to(indicator, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: "back.out(1.7)"
            }, 0.2);

        card.addEventListener('mouseenter', () => {
            isHovered = true;
            hoverTl.play();
            gsap.set(card, { willChange: "transform" });
        });

        card.addEventListener('mouseleave', () => {
            isHovered = false;
            hoverTl.reverse();
            gsap.to(inner, { rotateX: 0, rotateY: 0, duration: 0.8, ease: "power2.out" });
            setTimeout(() => gsap.set(card, { willChange: "auto" }), 800);
        });

        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            targetX = ((e.clientX - rect.left) / rect.width - 0.5) * 12; // 6° max tilt
            targetY = ((e.clientY - rect.top) / rect.height - 0.5) * -12;
        });

        // Loop for friction (LERP)
        function updateParallax() {
            if (isHovered) {
                currentX += (targetX - currentX) * 0.1; // 0.1 friction
                currentY += (targetY - currentY) * 0.1;
                gsap.set(inner, {
                    rotateY: currentX,
                    rotateX: currentY,
                    transformPerspective: 1000,
                    force3D: true
                });
            }
            requestAnimationFrame(updateParallax);
        }
        updateParallax();
    });

    // 4. Click Feedback
    cards.forEach(card => {
        card.addEventListener('click', (e) => {
            const link = card.querySelector('.c-link');
            if (e.target.closest('.c-link')) return;
            gsap.to(card, { scale: 0.97, duration: 0.2, yoyo: true, repeat: 1, ease: "power2.inOut" });
            if (link) setTimeout(() => window.location.href = link.href, 250);
        });
    });
});

/**
 * PHASE: Deck -> Scatter -> Snap (using FLIP)
 */
function triggerExploration() {
    const hub = document.getElementById('collection-hub');
    const main = document.getElementById('collection-main');
    const info = document.querySelector('.collection-info');
    const finalGrid = document.getElementById('collection-grid-final');
    const cards = document.querySelectorAll('.collection-card');

    if (hub.classList.contains('exploration-active')) return;
    hub.classList.add('exploration-active');

    // 1. Capture INITIAL (Deck)
    const initialState = Flip.getState(cards);

    const tl = gsap.timeline();

    // 2. Camera Move & Info Fade Out
    tl.to(hub, { scale: 1.01, duration: 0.6, ease: "power2.inOut" });
    tl.to(info, {
        opacity: 0,
        y: 20,
        filter: "blur(10px)",
        duration: 0.8,
        ease: "power2.inOut"
    }, 0);

    // 3. Cinematic Scatter (Manual GSAP)
    tl.to(cards, {
        duration: 0.9,
        stagger: {
            amount: 0.4,
            from: "end" // Scatter from the bottom of stack
        },
        ease: "expo.inOut",
        onStart: () => gsap.set(cards, { willChange: "transform, filter" }),
        x: (i) => (Math.random() - 0.5) * window.innerWidth * 0.5,
        y: (i) => -150 - Math.random() * 250,
        rotation: (i) => (Math.random() - 0.5) * 40,
        opacity: 0.7,
        scale: 0.9,
        filter: "blur(4px)",
    }, "-=0.4");

    // 4. Capture SCATTERED state and Execute Layout Switch
    tl.add(() => {
        const scatterState = Flip.getState(cards);

        // 5. Layout Switch (Physical move)
        main.style.display = 'none';
        finalGrid.style.marginTop = '0';
        cards.forEach(card => finalGrid.appendChild(card));

        // 6. Flip Snap (Return the tween so the timeline waits for it)
        return Flip.from(scatterState, {
            duration: 1.2,
            stagger: {
                amount: 0.4,
                from: "center"
            },
            ease: "power4.out",
            onComplete: () => {
                gsap.set(cards, { clearProps: "all" });
                cards.forEach(c => c.classList.add('is-snapped'));
                gsap.to(hub, { scale: 1, duration: 0.6, ease: "power2.out" });
            },
            spin: false,
            fade: true,
            absolute: true
        });
    });

    // 7. Final Reveal (Only after Flip is done)
    tl.fromTo(cards,
        { y: 40, opacity: 0 },
        { y: 0, opacity: 1, duration: 0.8, stagger: 0.05, ease: "power2.out" },
        "+=0.1"
    );
}

document.addEventListener('collection:explore', triggerExploration);
