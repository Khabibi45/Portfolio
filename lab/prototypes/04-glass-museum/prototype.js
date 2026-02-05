window.initPrototype = function (labState) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '../prototypes/04-glass-museum/prototype.css';
    document.head.appendChild(link);
    setTimeout(() => initGlassMuseum(labState), 100);
};

function initGlassMuseum(state) {
    const vitrines = document.querySelectorAll('.vitrine');
    const viewport = document.getElementById('lab-viewport');
    if (!vitrines.length) return;

    vitrines.forEach(vitrine => {
        ScrollTrigger.create({
            trigger: vitrine,
            scroller: viewport,
            start: 'top 60%',
            end: 'bottom 40%',
            onEnter: () => vitrine.classList.add('active'),
            onLeave: () => vitrine.classList.remove('active'),
            onEnterBack: () => vitrine.classList.add('active'),
            onLeaveBack: () => vitrine.classList.remove('active')
        });
    });
}
