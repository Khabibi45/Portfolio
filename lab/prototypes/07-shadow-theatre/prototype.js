window.initPrototype = function (labState) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '../prototypes/07-shadow-theatre/prototype.css';
    document.head.appendChild(link);
    setTimeout(() => initShadowTheatre(labState), 100);
};

function initShadowTheatre(state) {
    const scenes = document.querySelectorAll('.theatre-scene');
    const spotlight = document.getElementById('spotlight');
    const viewport = document.getElementById('lab-viewport');
    if (!scenes.length) return;

    scenes.forEach(scene => {
        ScrollTrigger.create({
            trigger: scene,
            scroller: viewport,
            start: 'top 60%',
            end: 'bottom 40%',
            onEnter: () => { scene.classList.add('active'); moveSpotlight(scene); },
            onLeave: () => scene.classList.remove('active'),
            onEnterBack: () => { scene.classList.add('active'); moveSpotlight(scene); },
            onLeaveBack: () => scene.classList.remove('active')
        });
    });

    function moveSpotlight(scene) {
        if (!spotlight) return;
        const rect = scene.getBoundingClientRect();
        const viewportRect = viewport.getBoundingClientRect();
        spotlight.style.left = (rect.left + rect.width / 2) + 'px';
        spotlight.style.top = (rect.top - viewportRect.top + rect.height / 2 + viewport.scrollTop) + 'px';
    }
}
