/**
 * Prototype #11 - Mountain Ascent Camera Journey
 * GSAP + ScrollTrigger cinematic camera system
 */

window.initPrototype = function (labState) {
    // Load CSS
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '../prototypes/11-mountain-ascent/prototype.css';
    document.head.appendChild(link);

    setTimeout(() => initMountainAscent(labState), 150);
};

function initMountainAscent(state) {
    const section = document.querySelector('.proto-mountain-ascent');
    const viewport = document.getElementById('lab-viewport');
    const stations = document.querySelectorAll('.mountain-station');
    const summitZone = document.querySelector('.summit-zone');
    const trailProgress = document.querySelector('.trail-progress');
    const flowRunner = document.querySelector('.flow-runner');
    const altitudeProgress = document.querySelector('.altitude-progress');

    if (!section || !stations.length) return;

    // === CONSTANTS ===
    const FOCUS_ZONE = { top: 0.32, bottom: 0.68 };
    const HANDHELD = { rotateZ: 0.15, rotateX: 0.25, translateX: 6 };
    const intensity = state.intensity / 100;

    // === CAMERA STATE ===
    let currentStation = null;
    let handheldTick = 0;
    let animating = false;

    // === PARALLAX LAYERS ===
    const layers = {
        peaks: document.querySelector('.layer-peaks'),
        mid: document.querySelector('.layer-mid'),
        ridge: document.querySelector('.layer-ridge'),
        fog: document.querySelector('.layer-fog'),
        stars: document.querySelector('.layer-stars')
    };

    // === TRAIL PATH LENGTH ===
    const trailPath = document.querySelector('.trail-path');
    let pathLength = 0;
    if (trailPath) {
        pathLength = trailPath.getTotalLength();
        if (trailProgress) {
            trailProgress.style.strokeDasharray = pathLength;
            trailProgress.style.strokeDashoffset = pathLength;
        }
    }

    // === MASTER TIMELINE ===
    const masterTL = gsap.timeline({
        scrollTrigger: {
            trigger: section,
            scroller: viewport,
            start: 'top top',
            end: 'bottom bottom',
            scrub: 0.5,
            onUpdate: (self) => {
                const progress = self.progress;

                // Trail progress
                if (trailProgress && pathLength) {
                    trailProgress.style.strokeDashoffset = pathLength * (1 - progress);
                }

                // Altitude indicator
                if (altitudeProgress) {
                    altitudeProgress.style.height = (progress * 100) + '%';
                }

                // Parallax layers
                updateParallax(progress);

                // Atmosphere (air perspective)
                updateAtmosphere(progress);
            }
        }
    });

    // === PARALLAX UPDATE ===
    function updateParallax(progress) {
        const yOffset = progress * 100;

        if (layers.peaks) gsap.set(layers.peaks, { y: -yOffset * 0.15 * intensity });
        if (layers.mid) gsap.set(layers.mid, { y: -yOffset * 0.3 * intensity });
        if (layers.ridge) gsap.set(layers.ridge, { y: -yOffset * 0.5 * intensity });
        if (layers.fog) gsap.set(layers.fog, { y: -yOffset * 0.2 * intensity, opacity: 0.08 - progress * 0.04 });
    }

    // === ATMOSPHERE UPDATE ===
    function updateAtmosphere(progress) {
        // Higher = clearer, less fog, more contrast
        const fogOpacity = Math.max(0.02, 0.08 - progress * 0.06);
        if (layers.fog) {
            layers.fog.style.opacity = fogOpacity;
        }
    }

    // === STATION DETECTION ===
    stations.forEach((station, index) => {
        const positionPercent = parseFloat(station.dataset.position) || (index + 1) * 0.2;

        ScrollTrigger.create({
            trigger: station,
            scroller: viewport,
            start: 'top 65%',
            end: 'bottom 35%',
            onEnter: () => enterStation(station),
            onLeave: () => exitStation(station, 'up'),
            onEnterBack: () => enterStation(station),
            onLeaveBack: () => exitStation(station, 'down')
        });
    });

    // === SUMMIT DETECTION ===
    if (summitZone) {
        ScrollTrigger.create({
            trigger: summitZone,
            scroller: viewport,
            start: 'top 70%',
            onEnter: () => {
                summitZone.classList.add('active');
                triggerSummitClimax();
            },
            onLeaveBack: () => summitZone.classList.remove('active')
        });
    }

    // === PHASE A+B: ENTER STATION ===
    function enterStation(station) {
        if (animating) return;
        animating = true;

        // Deactivate previous
        if (currentStation && currentStation !== station) {
            currentStation.classList.remove('active');
            currentStation.classList.add('passed');
        }

        station.classList.remove('passed');
        station.classList.add('active');
        currentStation = station;

        // Marker pulse (once)
        const marker = station.querySelector('.station-marker');
        if (marker && !marker.dataset.pulsed) {
            marker.dataset.pulsed = 'true';
            gsap.timeline()
                .to(marker, { scale: 1.8, duration: 0.15 })
                .to(marker, { scale: 1.4, duration: 0.25, ease: 'power2.out' });
        }

        // Flow runner to this station
        triggerFlowRunner(station);

        // Micro jitter (Phase C start)
        const card = station.querySelector('.station-card');
        if (card && intensity > 0.3) {
            gsap.timeline()
                .to(card, { x: 1, duration: 0.03 })
                .to(card, { x: -1, duration: 0.03 })
                .to(card, { x: 0, duration: 0.03 });
        }

        setTimeout(() => animating = false, 200);
    }

    // === PHASE D: EXIT STATION ===
    function exitStation(station, direction) {
        station.classList.remove('active');

        if (direction === 'up') {
            station.classList.add('passed');
        } else {
            station.classList.remove('passed');
        }
    }

    // === FLOW RUNNER ===
    function triggerFlowRunner(station) {
        if (!flowRunner || !trailPath) return;

        const stationRect = station.getBoundingClientRect();
        const containerRect = section.getBoundingClientRect();

        // Simple position near station
        gsap.timeline()
            .set(flowRunner, { opacity: 1 })
            .to(flowRunner, {
                left: stationRect.left - containerRect.left + stationRect.width / 2,
                top: stationRect.top - containerRect.top + stationRect.height / 2,
                duration: 0.4,
                ease: 'power2.out'
            })
            .to(flowRunner, { opacity: 0, duration: 0.3 }, '+=0.1');
    }

    // === SUMMIT CLIMAX ===
    function triggerSummitClimax() {
        const bgText = document.querySelector('.summit-bg-text');
        const halo = document.querySelector('.summit-halo');

        if (bgText) {
            gsap.fromTo(bgText,
                { opacity: 0, scale: 0.95 },
                { opacity: 0.03, scale: 1, duration: 0.8, ease: 'power2.out' }
            );
        }

        if (halo) {
            gsap.fromTo(halo,
                { scale: 0.8, opacity: 0 },
                { scale: 1, opacity: 1, duration: 1, ease: 'power2.out' }
            );
        }
    }

    // === HANDHELD CAMERA (subtle) ===
    if (state.perfMode !== true) {
        function updateHandheld() {
            handheldTick += 0.02;

            const rotZ = Math.sin(handheldTick) * HANDHELD.rotateZ * intensity;
            const rotX = Math.cos(handheldTick * 0.7) * HANDHELD.rotateX * intensity;
            const transX = Math.sin(handheldTick * 0.5) * HANDHELD.translateX * intensity;

            gsap.set(section, {
                rotateZ: rotZ,
                rotateX: rotX,
                x: transX
            });

            requestAnimationFrame(updateHandheld);
        }

        // Only enable handheld if intensity > 30%
        if (intensity > 0.3) {
            updateHandheld();
        }
    }
}
