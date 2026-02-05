/**
 * Prototype #01 - Camera Rail Journey
 * GSAP + ScrollTrigger animations
 */

window.initPrototype = function (labState) {
    // Load CSS
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '../prototypes/01-camera-rail/prototype.css';
    document.head.appendChild(link);

    // Wait for CSS
    setTimeout(() => {
        initCameraRail(labState);
    }, 100);
};

function initCameraRail(state) {
    const container = document.querySelector('.rail-container');
    const stations = document.querySelectorAll('.rail-station');
    const progress = document.querySelector('.rail-progress');
    const viewport = document.getElementById('lab-viewport');

    if (!container || !stations.length) return;

    const intensity = state.intensity / 100;

    // Progress line
    gsap.to(progress, {
        height: '100%',
        ease: 'none',
        scrollTrigger: {
            trigger: container,
            scroller: viewport,
            start: 'top 30%',
            end: 'bottom 70%',
            scrub: 0.5
        }
    });

    // Station activation
    let currentStation = null;

    stations.forEach((station, i) => {
        ScrollTrigger.create({
            trigger: station,
            scroller: viewport,
            start: 'top 60%',
            end: 'bottom 40%',
            onEnter: () => activateStation(station),
            onLeave: () => deactivateStation(station),
            onEnterBack: () => activateStation(station),
            onLeaveBack: () => deactivateStation(station)
        });
    });

    function activateStation(station) {
        if (currentStation === station) return;

        if (currentStation) {
            currentStation.classList.remove('active');
        }

        station.classList.add('active');
        currentStation = station;

        // Keyword parallax
        const keyword = station.querySelector('.station-keyword');
        if (keyword) {
            gsap.to(keyword, {
                y: -20 * intensity,
                duration: 0.6,
                ease: 'power2.out'
            });
        }

        // Metric reveal
        const metric = station.querySelector('.metric-value');
        if (metric && !metric.dataset.animated) {
            animateMetric(metric);
        }
    }

    function deactivateStation(station) {
        station.classList.remove('active');

        const keyword = station.querySelector('.station-keyword');
        if (keyword) {
            gsap.to(keyword, { y: 0, duration: 0.4 });
        }
    }

    function animateMetric(el) {
        const text = el.textContent;
        const match = text.match(/(\d+)/);

        if (match) {
            el.dataset.animated = 'true';
            const target = parseInt(match[1]);
            const suffix = text.replace(/\d+/, '');
            const obj = { val: 0 };

            gsap.to(obj, {
                val: target,
                duration: 1,
                ease: 'power2.out',
                onUpdate: () => el.textContent = Math.round(obj.val) + suffix
            });
        }
    }
}
