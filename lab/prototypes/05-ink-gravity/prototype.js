window.initPrototype = function (labState) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '../prototypes/05-ink-gravity/prototype.css';
    document.head.appendChild(link);
    setTimeout(() => initInkGravity(labState), 100);
};

function initInkGravity(state) {
    const stations = document.querySelectorAll('.ink-station');
    const viewport = document.getElementById('lab-viewport');
    if (!stations.length) return;

    stations.forEach(station => {
        ScrollTrigger.create({
            trigger: station,
            scroller: viewport,
            start: 'top 60%',
            end: 'bottom 40%',
            onEnter: () => station.classList.add('active'),
            onLeave: () => station.classList.remove('active'),
            onEnterBack: () => station.classList.add('active'),
            onLeaveBack: () => station.classList.remove('active')
        });
    });
}
