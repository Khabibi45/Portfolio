window.initPrototype = function (labState) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '../prototypes/10-continuous-take/prototype.css';
    document.head.appendChild(link);
    setTimeout(() => initContinuousTake(labState), 100);
};

function initContinuousTake(state) {
    const section = document.querySelector('.proto-continuous-take');
    const moments = document.querySelectorAll('.take-moment');
    const viewport = document.getElementById('lab-viewport');
    if (!moments.length) return;

    // Scene transition at mid-point
    ScrollTrigger.create({
        trigger: section,
        scroller: viewport,
        start: '40% center',
        end: '60% center',
        onEnter: () => section.classList.add('scene-b'),
        onLeaveBack: () => section.classList.remove('scene-b')
    });

    moments.forEach(moment => {
        ScrollTrigger.create({
            trigger: moment,
            scroller: viewport,
            start: 'top 60%',
            end: 'bottom 40%',
            onEnter: () => moment.classList.add('active'),
            onLeave: () => moment.classList.remove('active'),
            onEnterBack: () => moment.classList.add('active'),
            onLeaveBack: () => moment.classList.remove('active')
        });
    });
}
