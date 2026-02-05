window.initPrototype = function (labState) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '../prototypes/02-time-folding/prototype.css';
    document.head.appendChild(link);
    setTimeout(() => initTimeFolding(labState), 100);
};

function initTimeFolding(state) {
    const panels = document.querySelectorAll('.corridor-panel');
    const viewport = document.getElementById('lab-viewport');
    if (!panels.length) return;

    panels.forEach(panel => {
        ScrollTrigger.create({
            trigger: panel,
            scroller: viewport,
            start: 'top 65%',
            end: 'bottom 35%',
            onEnter: () => panel.classList.add('active'),
            onLeave: () => panel.classList.remove('active'),
            onEnterBack: () => panel.classList.add('active'),
            onLeaveBack: () => panel.classList.remove('active')
        });
    });
}
