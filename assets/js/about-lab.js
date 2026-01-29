/**
 * About-Me Laboratory Logic (Full Collection)
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Tab Switching Logic (If present)
    const tabBtns = document.querySelectorAll('.lab-tab-btn');
    const tabPanels = document.querySelectorAll('.tab-panel');

    if (tabBtns.length) {
        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const tabId = btn.getAttribute('data-tab');

                tabBtns.forEach(b => {
                    b.classList.remove('active');
                    b.classList.add('text-gray-400');
                });
                btn.classList.add('active');
                btn.classList.remove('text-gray-400');

                tabPanels.forEach(p => p.classList.remove('active'));
                const targetOutput = document.getElementById(tabId);
                if (targetOutput) {
                    targetOutput.classList.add('active');
                }

                if (typeof ScrollTrigger !== 'undefined') {
                    ScrollTrigger.refresh();
                }
            });
        });
    }

    // 2. Cinematic Odyssey (The Path of Innovation)
    const journeyContainer = document.querySelector('.about-journey-container');
    const pods = document.querySelectorAll('.journey-pod');
    const progressLine = document.getElementById('journey-progress');

    if (journeyContainer && pods.length) {
        // Growth of the central line
        gsap.to(progressLine, {
            height: '100%',
            ease: 'none',
            scrollTrigger: {
                trigger: journeyContainer,
                start: 'top 30%',
                end: 'bottom 80%',
                scrub: 0.5
            }
        });

        // Extension into Skills section
        const bridgeProgress = document.getElementById('bridge-progress');
        if (bridgeProgress) {
            gsap.to(bridgeProgress, {
                height: '100%',
                ease: 'none',
                scrollTrigger: {
                    trigger: '#skills',
                    start: 'top 95%',
                    end: 'top 30%',
                    scrub: 0.5
                }
            });
        }

        // Activation of each pod
        pods.forEach((pod, i) => {
            gsap.to(pod, {
                opacity: 1,
                scale: 1,
                y: 0,
                duration: 1,
                scrollTrigger: {
                    trigger: pod,
                    start: 'top 80%',
                    end: 'top 40%',
                    toggleActions: 'play none none reverse',
                    onEnter: () => pod.classList.add('active'),
                    onLeaveBack: () => pod.classList.remove('active')
                }
            });

            // Count up numbers in pods if they exist
            const metric = pod.querySelector('.info-metric');
            if (metric && /\d+/.test(metric.textContent)) {
                const drawValue = parseInt(metric.textContent.match(/\d+/)[0]);
                const suffix = metric.textContent.replace(/\d+/, '');
                const obj = { val: 0 };
                ScrollTrigger.create({
                    trigger: pod,
                    start: 'top 70%',
                    onEnter: () => {
                        gsap.to(obj, {
                            val: drawValue,
                            duration: 2,
                            onUpdate: () => metric.textContent = Math.round(obj.val) + suffix,
                            ease: "power2.out"
                        });
                    }
                });
            }
        });
    }

    // 3. Identity Scanner (01)
    const scanner = document.querySelector('.id-scanner');
    if (scanner) {
        ScrollTrigger.create({
            trigger: scanner,
            start: "top 70%",
            onEnter: () => {
                gsap.to('.scanner-line', { top: '100%', duration: 1.5, ease: "power2.inOut" });
                gsap.to('.scanner-reveal', { opacity: 1, y: 0, stagger: 0.1, duration: 0.8, ease: "back.out(1.7)" });
            }
        });
    }

    // 3. Split Reality (02)
    const split = document.querySelector('.split-reality');
    if (split) {
        split.addEventListener('mousemove', (e) => {
            const rect = split.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            gsap.to('.split-divider', { left: `${x}%`, duration: 0.4, ease: "power2.out" });
        });
        split.addEventListener('mouseleave', () => {
            gsap.to('.split-divider', { left: '50%', duration: 0.6, ease: "elastic.out(1, 0.8)" });
        });
    }

    // 4. Timeline Cinematic (03)
    const steps = document.querySelectorAll('.timeline-step');
    steps.forEach((step) => {
        ScrollTrigger.create({
            trigger: step,
            start: "top 85%",
            onEnter: () => step.classList.add('active'),
            onLeaveBack: () => step.classList.remove('active')
        });
    });

    // 5. Workflows Under Glass (04)
    const glass = document.querySelector('.glass-table');
    if (glass) {
        glass.addEventListener('mousemove', (e) => {
            const rect = glass.getBoundingClientRect();
            glass.style.setProperty('--x', `${e.clientX - rect.left}px`);
            glass.style.setProperty('--y', `${e.clientY - rect.top}px`);
        });
    }

    // 6. Monogram Morph (05)
    gsap.to('.monogram-svg', { rotate: 360, duration: 40, repeat: -1, ease: "none" });

    // 7. Command Palette Filter (09)
    const cmdInput = document.querySelector('.cmd-palette input');
    const cmdItems = document.querySelectorAll('.cmd-item');
    if (cmdInput) {
        cmdInput.addEventListener('input', (e) => {
            const val = e.target.value.toLowerCase();
            cmdItems.forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(val) ? 'flex' : 'none';
            });
        });
    }

    // 8. Story Orb Satellites (10)
    gsap.to('.orb-container', {
        rotation: 360,
        duration: 30,
        repeat: -1,
        ease: "none"
    });

});
