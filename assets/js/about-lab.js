// === ABOUT DISCOVERY SYSTEM (CAROUSEL) ===
window.AboutDiscovery = {
    currentStep: 1,
    isAnimating: false,

    gotoStep: function (targetStep) {
        if (this.isAnimating || targetStep === this.currentStep) return;

        const currentEl = document.querySelector(`.about-step[data-step="${this.currentStep}"]`);
        const targetEl = document.querySelector(`.about-step[data-step="${targetStep}"]`);
        const scannerCard = document.querySelector('.scanner-card');
        const indicators = document.querySelectorAll('.step-indicator');

        if (!currentEl || !targetEl) return;
        this.isAnimating = true;

        // 1. Update Indicators
        indicators.forEach(ind => ind.classList.remove('active'));
        document.querySelector(`.step-indicator[data-step="${targetStep}"]`)?.classList.add('active');

        // 2. Trigger Scanner Line
        gsap.to('.scanner-line, .scanner-line-primary', {
            top: '110%',
            duration: 0.8,
            ease: 'power2.inOut',
            onStart: () => {
                scannerCard.classList.add('scanning');
                gsap.set('.scanner-line, .scanner-line-primary', { top: '-10%' });
            }
        });

        // 3. Step Transition (Slide & Fade)
        const direction = targetStep > this.currentStep ? 1 : -1;

        gsap.to(currentEl, {
            opacity: 0,
            x: -40 * direction,
            duration: 0.5,
            ease: 'power2.in',
            onComplete: () => {
                currentEl.style.display = 'none';

                // Final Step Unframing Logic
                if (targetStep === 3) {
                    scannerCard.classList.add('step-3-active');
                } else {
                    scannerCard.classList.remove('step-3-active');
                }

                targetEl.style.display = 'block';
                gsap.fromTo(targetEl,
                    { opacity: 0, x: 40 * direction },
                    {
                        opacity: 1,
                        x: 0,
                        duration: 0.7,
                        ease: 'expo.out',
                        onComplete: () => {
                            this.currentStep = targetStep;
                            this.isAnimating = false;
                            scannerCard.classList.remove('scanning');
                            this.updateArrows();

                            if (targetStep === 3) {
                                window.dispatchEvent(new Event('about:carousel_ready'));
                            }
                        }
                    }
                );
            }
        });
    },

    next: function () {
        const nextStep = this.currentStep < 3 ? this.currentStep + 1 : 1;
        this.gotoStep(nextStep);
    },

    prev: function () {
        const prevStep = this.currentStep > 1 ? this.currentStep - 1 : 3;
        this.gotoStep(prevStep);
    },

    nextComponent: function () { this.next(); },
    prevComponent: function () { this.prev(); },

    updateArrows: function () {
        const prevBtn = document.querySelector('.step-nav-arrow.prev');
        const nextBtn = document.querySelector('.step-nav-arrow.next');
        if (!prevBtn || !nextBtn) return;

        // Optional: Hide arrows at boundaries if not looping, 
        // but here we allow looping for better UX
        // prevBtn.style.opacity = this.currentStep === 1 ? '0' : '1';
        // nextBtn.style.opacity = this.currentStep === 3 ? '0' : '1';
    }
};

document.addEventListener('DOMContentLoaded', () => {
    initOptimizedJourney();

    // INITIAL INDICATOR & ARROW STATE
    document.querySelector('.step-indicator[data-step="1"]')?.classList.add('active');
    AboutDiscovery.updateArrows();
});

function initOptimizedJourney() {
    const journeyContainer = document.querySelector('.about-journey-container');
    const pods = document.querySelectorAll('.journey-pod');
    const progressLine = document.getElementById('journey-progress');

    if (!journeyContainer || !pods.length) return;

    // === CONSTANTS ===
    const FOCUS_ZONE = { top: 0.35, bottom: 0.65 };

    let currentStation = null;
    let ticking = false;

    // === SCANNER INITIAL REVEAL ===
    const scanner = document.querySelector('.id-scanner');
    if (scanner) {
        ScrollTrigger.create({
            trigger: scanner,
            start: 'top 70%',
            once: true,
            onEnter: () => {
                gsap.to('.scanner-line, .scanner-line-primary', {
                    top: '110%',
                    duration: 1.2,
                    ease: 'power2.inOut'
                });
            }
        });
    }

    // === PROGRESS LINE ===
    if (progressLine) {
        gsap.to(progressLine, {
            height: '100%',
            ease: 'none',
            scrollTrigger: {
                trigger: journeyContainer,
                start: 'top 30%',
                end: 'bottom 80%',
                scrub: 0.8
            }
        });
    }

    // === INITIAL STATE ===
    pods.forEach(pod => {
        pod.classList.add('inactive');
        const content = pod.querySelectorAll('.pod-year, .pod-title, .pod-desc, .pod-info');
        gsap.set(content, { opacity: 0, y: 15 });
    });

    // === SCROLL HANDLER (Throttled) ===
    function onScroll() {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(() => {
            detectActiveStation();
            ticking = false;
        });
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    detectActiveStation();

    function detectActiveStation() {
        const vh = window.innerHeight;
        let activeFound = false;

        pods.forEach(pod => {
            const rect = pod.getBoundingClientRect();
            const center = rect.top + rect.height / 2;
            const normalizedPos = center / vh;
            const inFocus = normalizedPos > FOCUS_ZONE.top && normalizedPos < FOCUS_ZONE.bottom;

            if (inFocus && !activeFound) {
                activeFound = true;
                if (currentStation !== pod) {
                    if (currentStation) exitStation(currentStation);
                    enterStation(pod);
                    currentStation = pod;
                }
            }
        });

        if (!activeFound && currentStation) {
            exitStation(currentStation);
            currentStation = null;
        }
    }

    function enterStation(pod) {
        pod.classList.remove('inactive');
        pod.classList.add('active');

        const content = pod.querySelectorAll('.pod-year, .pod-title, .pod-desc');
        const info = pod.querySelector('.pod-info');

        gsap.to(content, {
            opacity: 1,
            y: 0,
            duration: 0.5,
            stagger: 0.08,
            ease: 'power2.out'
        });

        if (info) {
            gsap.to(info, { opacity: 1, y: 0, duration: 0.5, delay: 0.2 });
        }

        const glow = pod.querySelector('.pod-glow');
        if (glow) {
            gsap.to(glow, { opacity: 0.2, duration: 0.3 });
            gsap.to(glow, { opacity: 0, duration: 0.4, delay: 0.3 });
        }

        const metric = pod.querySelector('.info-metric');
        if (metric && !metric.dataset.animated) {
            animateCounter(metric);
        }
    }

    function exitStation(pod) {
        pod.classList.remove('active');
        pod.classList.add('inactive');
        const content = pod.querySelectorAll('.pod-year, .pod-title, .pod-desc, .pod-info');
        gsap.to(content, { opacity: 0, y: 15, duration: 0.3 });
    }

    function animateCounter(metric) {
        const text = metric.textContent;
        const match = text.match(/(\d+)/);
        if (!match) return;
        metric.dataset.animated = 'true';
        const target = parseInt(match[1]);
        const suffix = text.replace(/\d+/, '');
        const obj = { val: 0 };
        gsap.to(obj, {
            val: target,
            duration: 1,
            ease: 'power2.out',
            onUpdate: () => metric.textContent = Math.round(obj.val) + suffix
        });
    }
}
