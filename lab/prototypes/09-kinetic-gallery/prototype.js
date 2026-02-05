window.initPrototype = function (labState) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '../prototypes/09-kinetic-gallery/prototype.css';
    document.head.appendChild(link);
    setTimeout(() => initKineticGallery(labState), 100);
};

function initKineticGallery(state) {
    const frames = document.querySelectorAll('.gallery-frame');
    const viewport = document.getElementById('lab-viewport');
    if (!frames.length) return;

    frames.forEach(frame => {
        ScrollTrigger.create({
            trigger: frame,
            scroller: viewport,
            start: 'top 50%',
            end: 'bottom 50%',
            onEnter: () => frame.classList.add('active'),
            onLeave: () => frame.classList.remove('active'),
            onEnterBack: () => frame.classList.add('active'),
            onLeaveBack: () => frame.classList.remove('active')
        });
    });
}
