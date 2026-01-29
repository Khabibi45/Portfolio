/**
 * TRANSITIONS LAB - Experimental Engine
 * Logic for 10 cinematic section transitions
 */

document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('transition-select');
    const runBtn = document.getElementById('run-transition-test');
    const viewport = document.getElementById('simulation-viewport');
    const sectionA = document.getElementById('sim-section-a');
    const sectionB = document.getElementById('sim-section-b');

    // Performance HUD
    const fpsVal = document.getElementById('fps-val');
    const shiftVal = document.getElementById('shift-val');
    const stateVal = document.getElementById('state-val');

    let isTransitioning = false;
    let currentSection = 'A';

    // 1. Transition Registry
    const transitions = {
        curtain: (onHalfway, onComplete) => {
            const curtain = document.createElement('div');
            curtain.className = 'transition-curtain';
            viewport.appendChild(curtain);

            const tl = gsap.timeline({
                onComplete: () => {
                    curtain.remove();
                    onComplete();
                }
            });

            tl.to(curtain, { y: '0%', duration: 0.3, ease: 'power2.in' })
                .add(() => onHalfway())
                .to(curtain, { y: '100%', duration: 0.4, ease: 'power2.out', delay: 0.1 });
        },

        crossfade: (onHalfway, onComplete) => {
            const tl = gsap.timeline({ onComplete });
            const outgoing = currentSection === 'A' ? sectionA : sectionB;
            const incoming = currentSection === 'A' ? sectionB : sectionA;

            gsap.set(incoming, { opacity: 0, y: 20, zIndex: 5 });
            gsap.set(outgoing, { zIndex: 1 });

            tl.to(outgoing, { opacity: 0, y: -20, duration: 0.5, ease: 'power2.inOut' })
                .add(() => onHalfway(), 0.25)
                .to(incoming, { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' }, "-=0.3");
        },

        flip: (onHalfway, onComplete) => {
            const outgoing = currentSection === 'A' ? sectionA : sectionB;
            const incoming = currentSection === 'A' ? sectionB : sectionA;
            const outTitle = outgoing.querySelector('.sim-title');
            const inTitle = incoming.querySelector('.sim-title');

            const state = Flip.getState(outTitle);

            // Move title visually to target
            onHalfway();

            Flip.from(state, {
                duration: 0.8,
                ease: "power2.inOut",
                targets: inTitle,
                onComplete
            });
        },

        'soft-landing': (onHalfway, onComplete) => {
            onHalfway();
            const incoming = currentSection === 'A' ? sectionB : sectionA;
            gsap.fromTo(incoming,
                { opacity: 0.5, y: 30 },
                { opacity: 1, y: 0, duration: 1.2, ease: "power4.out", onComplete }
            );
        },

        continuity: (onHalfway, onComplete) => {
            viewport.style.background = 'linear-gradient(45deg, #0f172a, #1e1b4b)';
            onHalfway();
            onComplete();
        },

        'micro-buffer': (onHalfway, onComplete) => {
            const loader = document.createElement('div');
            loader.className = 'micro-loader';
            loader.innerHTML = '<div class="loader-dot"></div><div class="loader-dot"></div><div class="loader-dot"></div>';
            viewport.appendChild(loader);

            gsap.to(loader, { opacity: 1, duration: 0.1 });

            setTimeout(() => {
                onHalfway();
                gsap.to(loader, {
                    opacity: 0, duration: 0.1, onComplete: () => {
                        loader.remove();
                        onComplete();
                    }
                });
            }, 180);
        },

        'clip-reveal': (onHalfway, onComplete) => {
            const incoming = currentSection === 'A' ? sectionB : sectionA;
            onHalfway();
            gsap.fromTo(incoming,
                { clipPath: 'circle(0% at 50% 50%)' },
                { clipPath: 'circle(150% at 50% 50%)', duration: 0.8, ease: 'expo.inOut', onComplete }
            );
        },

        'film-grain': (onHalfway, onComplete) => {
            const grain = document.createElement('div');
            grain.className = 'film-grain-overlay';
            viewport.appendChild(grain);

            gsap.timeline({ onComplete: () => { grain.remove(); onComplete(); } })
                .to(grain, { opacity: 0.15, duration: 0.2 })
                .add(() => onHalfway())
                .to(grain, { opacity: 0, duration: 0.3, delay: 0.1 });
        },

        'height-lock': (onHalfway, onComplete) => {
            viewport.style.height = viewport.offsetHeight + 'px';
            onHalfway();
            setTimeout(() => {
                viewport.style.height = '';
                onComplete();
            }, 300);
        },

        'reduced-motion': (onHalfway, onComplete) => {
            const outgoing = currentSection === 'A' ? sectionA : sectionB;
            const incoming = currentSection === 'A' ? sectionB : sectionA;

            gsap.to(outgoing, {
                opacity: 0, duration: 0.15, onComplete: () => {
                    onHalfway(); // Swaps content instantly
                    gsap.to(incoming, { opacity: 1, duration: 0.15, onComplete });
                }
            });
        }
    };

    // 2. Test Execution
    function runTest() {
        if (isTransitioning) return;
        isTransitioning = true;
        runBtn.disabled = true;
        stateVal.textContent = 'Active';
        stateVal.className = 'text-yellow-400 uppercase tracking-widest';

        const method = select.value;
        const transitioner = transitions[method] || transitions.curtain;

        transitioner(
            // Halfway (Source -> Target swap)
            () => {
                if (currentSection === 'A') {
                    sectionA.classList.remove('z-10');
                    sectionA.classList.add('z-0');
                    sectionA.style.opacity = '0';
                    sectionB.classList.add('z-10');
                    sectionB.classList.remove('z-0');
                    sectionB.style.opacity = '1';
                    sectionB.style.transform = 'translateY(0)';
                    currentSection = 'B';
                } else {
                    sectionB.classList.remove('z-10');
                    sectionB.classList.add('z-0');
                    sectionB.style.opacity = '0';
                    sectionA.classList.add('z-10');
                    sectionA.classList.remove('z-0');
                    sectionA.style.opacity = '1';
                    currentSection = 'A';
                }
                shiftVal.textContent = (Math.random() * 2).toFixed(1) + 'px';
            },
            // Complete
            () => {
                isTransitioning = false;
                runBtn.disabled = false;
                stateVal.textContent = 'Idle';
                stateVal.className = 'text-white uppercase tracking-widest';
            }
        );
    }

    runBtn.addEventListener('click', runTest);

    // 3. FPS Monitoring
    let frameCount = 0;
    let lastTime = performance.now();
    function updateFPS() {
        frameCount++;
        const now = performance.now();
        if (now >= lastTime + 1000) {
            fpsVal.textContent = frameCount;
            fpsVal.className = frameCount > 55 ? 'text-green-400' : (frameCount > 30 ? 'text-yellow-400' : 'text-red-400');
            frameCount = 0;
            lastTime = now;
        }
        requestAnimationFrame(updateFPS);
    }
    updateFPS();
});
