/**
 * AWWWARDS LAB - Premium Card Animations
 * All 5 concepts in one showcase module
 */

// ============================================
// 1. LIQUID MORPHING CARDS
// ============================================
class LiquidMorphCards {
    constructor(container) {
        this.container = container;
        this.cards = container.querySelectorAll('.liquid-card');
        this.init();
    }

    init() {
        this.cards.forEach((card, i) => {
            // Blob shape animation
            gsap.to(card, {
                borderRadius: this.getRandomBlobRadius(),
                duration: 4 + Math.random() * 2,
                ease: "sine.inOut",
                repeat: -1,
                yoyo: true,
                delay: i * 0.3
            });

            // Magnetic pull on hover
            card.addEventListener('mousemove', (e) => this.magneticPull(card, e));
            card.addEventListener('mouseleave', () => this.resetCard(card));
        });

        // Entry animation
        this.revealCards();
    }

    getRandomBlobRadius() {
        const r = () => 30 + Math.random() * 40;
        return `${r()}% ${100 - r()}% ${r()}% ${100 - r()}% / ${r()}% ${r()}% ${100 - r()}% ${100 - r()}%`;
    }

    magneticPull(card, e) {
        const rect = card.getBoundingClientRect();
        const x = (e.clientX - rect.left - rect.width / 2) * 0.15;
        const y = (e.clientY - rect.top - rect.height / 2) * 0.15;

        gsap.to(card, {
            x: x,
            y: y,
            scale: 1.02,
            duration: 0.6,
            ease: "power2.out"
        });
    }

    resetCard(card) {
        gsap.to(card, {
            x: 0, y: 0, scale: 1,
            duration: 0.8,
            ease: "elastic.out(1, 0.5)"
        });
    }

    revealCards() {
        gsap.from(this.cards, {
            y: 100,
            opacity: 0,
            scale: 0.8,
            stagger: 0.15,
            duration: 1.2,
            ease: "back.out(1.7)"
        });
    }
}

// ============================================
// 2. HOLOGRAPHIC DEPTH CARDS
// ============================================
class HolographicCards {
    constructor(container) {
        this.container = container;
        this.cards = container.querySelectorAll('.holo-card');
        this.init();
    }

    init() {
        this.cards.forEach(card => {
            const layers = card.querySelectorAll('.holo-layer');

            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width - 0.5;
                const y = (e.clientY - rect.top) / rect.height - 0.5;

                // Intense 3D rotation
                gsap.to(card, {
                    rotateY: x * 25,
                    rotateX: -y * 25,
                    transformPerspective: 1000,
                    duration: 0.5,
                    ease: "power2.out"
                });

                // Parallax layers
                layers.forEach((layer, i) => {
                    const depth = (i + 1) * 15;
                    gsap.to(layer, {
                        x: x * depth,
                        y: y * depth,
                        duration: 0.5,
                        ease: "power2.out"
                    });
                });

                // Holographic rainbow effect
                const hue = ((x + 0.5) * 360) | 0;
                card.style.setProperty('--holo-hue', hue);
            });

            card.addEventListener('mouseleave', () => {
                gsap.to(card, {
                    rotateX: 0, rotateY: 0,
                    duration: 0.8,
                    ease: "power3.out"
                });
                layers.forEach(layer => {
                    gsap.to(layer, { x: 0, y: 0, duration: 0.8 });
                });
            });
        });

        this.revealCards();
    }

    revealCards() {
        gsap.from(this.cards, {
            rotateX: -90,
            y: -200,
            opacity: 0,
            stagger: 0.2,
            duration: 1.5,
            ease: "power4.out"
        });

        // Scan line reveal
        this.cards.forEach((card, i) => {
            const scanline = document.createElement('div');
            scanline.className = 'holo-scanline';
            card.appendChild(scanline);

            gsap.fromTo(scanline,
                { top: '-100%' },
                { top: '200%', duration: 0.8, delay: 0.5 + i * 0.2, ease: "power2.inOut" }
            );
        });
    }
}

// ============================================
// 3. CRYSTALLINE SHATTER CARDS
// ============================================
class CrystallineCards {
    constructor(container) {
        this.container = container;
        this.cards = container.querySelectorAll('.crystal-card');
        this.init();
    }

    generateVoronoiFragments(card) {
        const svg = card.querySelector('.crystal-mask');
        const width = 320, height = 400;

        // Generate random seed points
        const points = [];
        for (let i = 0; i < 12; i++) {
            points.push({
                x: Math.random() * width,
                y: Math.random() * height
            });
        }

        // Simple Voronoi approximation (rectangles for performance)
        const fragments = [];
        const cols = 4, rows = 5;
        const cellW = width / cols, cellH = height / rows;

        for (let r = 0; r < rows; r++) {
            for (let c = 0; c < cols; c++) {
                const offsetX = (Math.random() - 0.5) * 10;
                const offsetY = (Math.random() - 0.5) * 10;
                fragments.push({
                    x: c * cellW + offsetX,
                    y: r * cellH + offsetY,
                    w: cellW + Math.random() * 10,
                    h: cellH + Math.random() * 10,
                    rotation: (Math.random() - 0.5) * 5
                });
            }
        }

        return fragments;
    }

    init() {
        this.cards.forEach((card, cardIndex) => {
            const fragments = this.generateVoronoiFragments(card);
            const fragmentsContainer = card.querySelector('.crystal-fragments');

            fragments.forEach((frag, i) => {
                const el = document.createElement('div');
                el.className = 'crystal-fragment';
                el.style.cssText = `
                    left: ${frag.x}px;
                    top: ${frag.y}px;
                    width: ${frag.w}px;
                    height: ${frag.h}px;
                    transform: rotate(${frag.rotation}deg);
                `;
                fragmentsContainer.appendChild(el);
            });

            // Hover: fragments lift
            card.addEventListener('mouseenter', () => {
                const frags = card.querySelectorAll('.crystal-fragment');
                frags.forEach((f, i) => {
                    gsap.to(f, {
                        z: 20 + Math.random() * 30,
                        opacity: 0.9,
                        duration: 0.5,
                        delay: i * 0.02,
                        ease: "power2.out"
                    });
                });
            });

            card.addEventListener('mouseleave', () => {
                const frags = card.querySelectorAll('.crystal-fragment');
                gsap.to(frags, {
                    z: 0,
                    opacity: 1,
                    duration: 0.6,
                    stagger: 0.01,
                    ease: "power2.inOut"
                });
            });
        });

        this.revealCards();
    }

    revealCards() {
        this.cards.forEach((card, cardIndex) => {
            const frags = card.querySelectorAll('.crystal-fragment');

            // Start scattered
            gsap.set(frags, {
                x: () => (Math.random() - 0.5) * 300,
                y: () => (Math.random() - 0.5) * 300,
                rotation: () => (Math.random() - 0.5) * 90,
                opacity: 0,
                scale: 0.5
            });

            // Magnetic reconstitution
            gsap.to(frags, {
                x: 0, y: 0,
                rotation: () => (Math.random() - 0.5) * 5,
                opacity: 1,
                scale: 1,
                stagger: {
                    amount: 0.8,
                    from: "random"
                },
                duration: 1.2,
                delay: cardIndex * 0.3,
                ease: "power3.out"
            });
        });
    }
}

// ============================================
// 4. MAGNETIC CONSTELLATION CARDS
// ============================================
class ConstellationCards {
    constructor(container) {
        this.container = container;
        this.cards = container.querySelectorAll('.constellation-card');
        this.canvas = container.querySelector('.constellation-canvas');
        this.ctx = this.canvas?.getContext('2d');
        this.connections = [];
        this.init();
    }

    init() {
        if (!this.canvas) return;

        this.resizeCanvas();
        window.addEventListener('resize', () => this.resizeCanvas());

        // Define connections between cards
        this.updateConnections();

        // Animate canvas
        this.animate();

        // Card interactions
        this.cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                this.activeCard = card;
                gsap.to(card, { scale: 1.05, duration: 0.4, ease: "power2.out" });
            });
            card.addEventListener('mouseleave', () => {
                this.activeCard = null;
                gsap.to(card, { scale: 1, duration: 0.4, ease: "power2.out" });
            });
        });

        this.revealCards();
    }

    resizeCanvas() {
        const rect = this.container.getBoundingClientRect();
        this.canvas.width = rect.width;
        this.canvas.height = rect.height;
    }

    updateConnections() {
        this.connections = [];
        const cardsArray = Array.from(this.cards);

        // Connect each card to 2 nearest neighbors
        cardsArray.forEach((card, i) => {
            if (i < cardsArray.length - 1) {
                this.connections.push([card, cardsArray[i + 1]]);
            }
            if (i < cardsArray.length - 2) {
                this.connections.push([card, cardsArray[i + 2]]);
            }
        });
    }

    getCardCenter(card) {
        const rect = card.getBoundingClientRect();
        const containerRect = this.container.getBoundingClientRect();
        return {
            x: rect.left - containerRect.left + rect.width / 2,
            y: rect.top - containerRect.top + rect.height / 2
        };
    }

    animate() {
        if (!this.ctx) return;

        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

        const time = Date.now() * 0.001;

        this.connections.forEach(([card1, card2]) => {
            const p1 = this.getCardCenter(card1);
            const p2 = this.getCardCenter(card2);

            // Animated bezier control point
            const midX = (p1.x + p2.x) / 2;
            const midY = (p1.y + p2.y) / 2;
            const wave = Math.sin(time * 2) * 20;

            // Glow effect
            const isActive = this.activeCard === card1 || this.activeCard === card2;
            const alpha = isActive ? 0.6 : 0.2;

            this.ctx.beginPath();
            this.ctx.moveTo(p1.x, p1.y);
            this.ctx.quadraticCurveTo(midX + wave, midY, p2.x, p2.y);
            this.ctx.strokeStyle = `rgba(99, 102, 241, ${alpha})`;
            this.ctx.lineWidth = isActive ? 2 : 1;
            this.ctx.stroke();

            // Connection particles
            if (isActive) {
                const particlePos = this.getPointOnCurve(p1, { x: midX + wave, y: midY }, p2, (time % 1));
                this.ctx.beginPath();
                this.ctx.arc(particlePos.x, particlePos.y, 4, 0, Math.PI * 2);
                this.ctx.fillStyle = '#818cf8';
                this.ctx.fill();
            }
        });

        requestAnimationFrame(() => this.animate());
    }

    getPointOnCurve(p0, p1, p2, t) {
        const x = Math.pow(1 - t, 2) * p0.x + 2 * (1 - t) * t * p1.x + Math.pow(t, 2) * p2.x;
        const y = Math.pow(1 - t, 2) * p0.y + 2 * (1 - t) * t * p1.y + Math.pow(t, 2) * p2.y;
        return { x, y };
    }

    revealCards() {
        // Particle explosion then formation
        gsap.from(this.cards, {
            scale: 0,
            opacity: 0,
            stagger: {
                amount: 0.5,
                from: "center"
            },
            duration: 1,
            ease: "back.out(1.7)"
        });
    }
}

// ============================================
// 5. CINEMATIC REVEAL CARDS
// ============================================
class CinematicCards {
    constructor(container) {
        this.container = container;
        this.cards = container.querySelectorAll('.cinema-card');
        this.focusedIndex = 0;
        this.init();
    }

    init() {
        // Add film grain and letterbox
        this.addFilmEffects();

        // Initial blur state
        // Initial blur state
        /* 
        this.cards.forEach((card, i) => {
            if (i !== 0) {
                card.classList.add('unfocused');
            }
        });
        */

        // Scroll-based focus rack DISABLED - User wants hover only
        /*
        ScrollTrigger.create({
            trigger: this.container,
            start: "top center",
            end: "bottom center",
            onUpdate: (self) => {
                const progress = self.progress;
                const targetIndex = Math.floor(progress * this.cards.length);
                if (targetIndex !== this.focusedIndex) {
                    this.rackFocus(targetIndex);
                }
            }
        });
        */

        // Hover focus managed by CSS now
        /*
        this.cards.forEach((card, i) => {
            card.addEventListener('mouseenter', () => this.rackFocus(i));
        });
        */

        this.revealCards();
    }

    addFilmEffects() {
        // Letterbox (hidden by no-letterbox class)
        const letterbox = document.createElement('div');
        letterbox.className = 'cinema-letterbox';
        letterbox.innerHTML = '<div class="bar top"></div><div class="bar bottom"></div>';
        this.container.appendChild(letterbox);

        // Click listeners for transition DISABLED
        // const buttons = this.container.querySelectorAll('.desc-btn');
        // buttons.forEach(btn => {
        //     btn.addEventListener('click', (e) => this.handlePageTransition(e));
        // });
    }

    handlePageTransition(e) {
        e.preventDefault();
        const btn = e.currentTarget;
        const url = btn.getAttribute('href');

        // Find the associated card
        const row = btn.closest('.cinema-row');
        const cardBg = row.querySelector('.card-bg');

        if (!cardBg || !url) return;

        // --- 0. SETUP ---
        const rect = cardBg.getBoundingClientRect();

        // Extract clean image URL for next page
        const bgImage = window.getComputedStyle(cardBg).backgroundImage;
        const cleanImageUrl = bgImage.replace(/url\(['"]?(.*?)['"]?\)/i, '$1');

        // SAVE STATE FOR NEXT PAGE (Entry Animation)
        sessionStorage.setItem('cinema_transition', 'true');
        sessionStorage.setItem('cinema_image', cleanImageUrl);

        // Depth Dimming Backdrop (behind overlay, over page)
        const backdrop = document.createElement('div');
        backdrop.style.cssText = `
            position: fixed; inset: 0; background: #000; opacity: 0;
            z-index: 9990; pointer-events: none; transition: none;
            backdrop-filter: blur(0px);
        `;
        document.body.appendChild(backdrop);

        // Transition Overlay (The Card Image)
        const overlay = document.createElement('div');
        overlay.style.cssText = `
            position: fixed;
            top: ${rect.top}px;
            left: ${rect.left}px;
            width: ${rect.width}px;
            height: ${rect.height}px;
            background-image: ${bgImage};
            background-size: cover;
            background-position: center;
            z-index: 9999;
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
            pointer-events: none;
            box-shadow: 0 30px 80px -15px rgba(99, 102, 241, 0.5);
            transform-origin: center center;
        `;
        document.body.appendChild(overlay);

        // --- ANIMATION CHOREOGRAPHY (Ultra Fast Blur) ---
        const tl = gsap.timeline({
            onComplete: () => {
                window.location.href = url; // Cut immediately after
            }
        });

        // Phase A: "Lock & Pull" (0-50ms) - Subliminal snap
        tl.to(overlay, {
            scale: 1.03,
            boxShadow: '0 50px 100px -20px rgba(0,0,0,0.8)',
            duration: 0.05,
            ease: "power2.out"
        }, 0);

        // Depth Dimming
        tl.to(backdrop, {
            opacity: 0.85,
            backdropFilter: "blur(2px)",
            duration: 0.4,
            ease: "power2.inOut"
        }, 0);

        // Phase B: "Camera Takeover" (50ms - 450ms)
        tl.to(overlay, {
            top: 0,
            left: 0,
            width: '100vw',
            height: '100vh',
            scale: 1.15,
            duration: 0.4,
            ease: "power3.out"
        }, 0.05);

        // Corner Release
        tl.to(overlay, {
            borderRadius: '0%',
            duration: 0.2,
            ease: "power2.in"
        }, 0.2);

        // INSTANT BLUR (Starts with expansion at 50ms)
        // No more delay. You move, you blur.
        tl.to(overlay, {
            filter: 'blur(8px)', // Stronger blur
            duration: 0.25,
            ease: "power1.in"
        }, 0.05);
    }

    rackFocus(targetIndex) {
        this.focusedIndex = targetIndex;

        this.cards.forEach((card, i) => {
            if (i === targetIndex) {
                card.classList.remove('unfocused');
                gsap.to(card, {
                    filter: 'blur(0px) saturate(1.2)',
                    scale: 1,
                    z: 50,
                    duration: 0.6,
                    ease: "power2.out"
                });
            } else {
                card.classList.add('unfocused');
                const distance = Math.abs(i - targetIndex);
                gsap.to(card, {
                    filter: `blur(${distance * 4}px) saturate(0.7)`,
                    scale: 0.95,
                    z: 0,
                    duration: 0.6,
                    ease: "power2.out"
                });
            }
        });
    }

    revealCards() {
        // Cinematic fade in
        gsap.from(this.cards, {
            opacity: 0,
            y: 50,
            stagger: 0.1,
            duration: 1.5,
            ease: "power2.out"
        });
    }
}

// ============================================
// INITIALIZATION
// ============================================
document.addEventListener('DOMContentLoaded', () => {
    // Initialize each concept when its container is visible
    const observers = {
        'liquid-demo': LiquidMorphCards,
        'holo-demo': HolographicCards,
        'crystal-demo': CrystallineCards,
        'constellation-demo': ConstellationCards,
        'cinema-demo': CinematicCards
    };

    Object.entries(observers).forEach(([id, ClassRef]) => {
        const container = document.getElementById(id);
        if (container) {
            new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !container.dataset.initialized) {
                        container.dataset.initialized = 'true';
                        new ClassRef(container);
                    }
                });
            }).observe(container);
        }
    });
});
