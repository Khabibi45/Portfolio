window.initPrototype = function (labState) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '../prototypes/06-magnetic-timeline/prototype.css';
    document.head.appendChild(link);
    setTimeout(() => initMagneticTimeline(labState), 100);
};

function initMagneticTimeline(state) {
    const nodes = document.querySelectorAll('.magnetic-node');
    const viewport = document.getElementById('lab-viewport');
    if (!nodes.length) return;

    nodes.forEach(node => {
        ScrollTrigger.create({
            trigger: node,
            scroller: viewport,
            start: 'top 60%',
            end: 'bottom 40%',
            onEnter: () => { node.classList.add('active'); vibrate(node); },
            onLeave: () => node.classList.remove('active'),
            onEnterBack: () => { node.classList.add('active'); vibrate(node); },
            onLeaveBack: () => node.classList.remove('active')
        });
    });

    function vibrate(node) {
        gsap.timeline()
            .to(node, { x: 2, duration: 0.03 })
            .to(node, { x: -2, duration: 0.03 })
            .to(node, { x: 0, duration: 0.03 });
    }
}
