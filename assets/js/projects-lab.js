/**
 * Premium Project Modules - Laboratory Logic
 * Motion Design using GSAP & ScrollTrigger
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Cinematic Reveal
    if (document.querySelector('.cinematic-reveal')) {
        gsap.to('.cinematic-frame', {
            clipPath: 'inset(0% 0% 0% 0%)',
            duration: 1.5,
            ease: 'expo.inOut',
            scrollTrigger: {
                trigger: '.cinematic-reveal',
                start: 'top 60%',
            }
        });
        gsap.to('.cinematic-img', {
            scale: 1,
            duration: 2,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: '.cinematic-reveal',
                start: 'top 60%',
            }
        });
    }

    // 2. Orbit Showcase
    const orbitModule = document.querySelector('.orbit-showcase');
    if (orbitModule) {
        const sats = orbitModule.querySelectorAll('.module-tag');
        sats.forEach((sat, i) => {
            gsap.to(sat, {
                rotation: 360,
                duration: 10 + (i * 2),
                repeat: -1,
                ease: 'none',
                transformOrigin: '200px 0px' // Orbit radius
            });
        });
    }

    // 3. Liquid Glass Portal (Mouse follow for lens)
    const liquidGlass = document.querySelector('.liquid-glass');
    if (liquidGlass) {
        liquidGlass.addEventListener('mousemove', (e) => {
            const rect = liquidGlass.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            gsap.to('.module-info', {
                x: (x - rect.width / 2) * 0.1,
                y: (y - rect.height / 2) * 0.1,
                duration: 0.5
            });
        });
    }

    // 4. Blueprint Assembly
    if (document.querySelector('.blueprint-assembly')) {
        gsap.from('.blueprint-svg path', {
            drawSVG: "0%", // Note: requires GSAP DrawSVGPlugin if used, fallback to dashoffset
            strokeDashoffset: 1000,
            strokeDasharray: 1000,
            duration: 2,
            scrollTrigger: {
                trigger: '.blueprint-assembly',
                start: 'top 70%'
            }
        });
    }

    // 5. Holographic Map
    const mapNodes = document.querySelectorAll('.holo-card');
    mapNodes.forEach((node, i) => {
        gsap.to(node, {
            opacity: 1,
            translateY: -70,
            duration: 1,
            delay: i * 0.2,
            scrollTrigger: {
                trigger: '.holographic-map',
                start: 'top 60%'
            }
        });
    });

    // 6. Parallax Diorama
    const diorama = document.querySelector('.diorama-card');
    if (diorama) {
        window.addEventListener('mousemove', (e) => {
            const x = (e.clientX / window.innerWidth - 0.5) * 40;
            const y = (e.clientY / window.innerHeight - 0.5) * 40;
            gsap.to(diorama, {
                rotateY: x,
                rotateX: -y,
                duration: 0.5
            });
        });
    }

    // 7. Typography Kinetic
    const kineticTitle = document.querySelector('.kinetic-title');
    if (kineticTitle) {
        kineticTitle.addEventListener('mousemove', (e) => {
            const rect = kineticTitle.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width;
            gsap.to(kineticTitle, {
                fontStretch: (100 + x * 100) + '%',
                fontWeight: (100 + x * 800),
                duration: 0.3
            });
        });
    }

    // 9. Gallery Stack
    if (document.querySelector('.stack-item')) {
        gsap.set('.stack-item', { scale: (i) => 1 - i * 0.1, y: (i) => i * 20, zIndex: (i) => 10 - i });
        ScrollTrigger.create({
            trigger: '.gallery-stack',
            start: 'top center',
            onEnter: () => {
                gsap.to('.stack-item', {
                    rotate: (i) => (i - 1) * 10,
                    x: (i) => (i - 1) * 50,
                    duration: 1,
                    ease: 'elastic.out(1, 0.5)'
                });
            }
        });
    }

    // 10. Focus Spotlight
    const spotlight = document.querySelector('.focus-spotlight');
    if (spotlight) {
        spotlight.addEventListener('mousemove', (e) => {
            const rect = spotlight.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            spotlight.style.setProperty('--x', x + 'px');
            spotlight.style.setProperty('--y', y + 'px');
        });
    }

    // Shared hover effects for all modules
    document.querySelectorAll('.project-module').forEach(module => {
        module.addEventListener('mouseenter', () => {
            gsap.to(module.querySelectorAll('.module-tag'), {
                borderColor: 'rgba(99, 102, 241, 0.6)',
                duration: 0.3,
                stagger: 0.05
            });
        });
        module.addEventListener('mouseleave', () => {
            gsap.to(module.querySelectorAll('.module-tag'), {
                borderColor: 'rgba(255, 255, 255, 0.08)',
                duration: 0.3
            });
        });
    });
});
