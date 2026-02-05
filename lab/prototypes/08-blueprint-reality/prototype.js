window.initPrototype = function (labState) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '../prototypes/08-blueprint-reality/prototype.css';
    document.head.appendChild(link);
    setTimeout(() => initBlueprintReality(labState), 100);
};

function initBlueprintReality(state) {
    const blocks = document.querySelectorAll('.blueprint-block');
    const viewport = document.getElementById('lab-viewport');
    if (!blocks.length) return;

    blocks.forEach(block => {
        ScrollTrigger.create({
            trigger: block,
            scroller: viewport,
            start: 'top 60%',
            end: 'bottom 40%',
            onEnter: () => block.classList.add('active'),
            onLeave: () => block.classList.remove('active'),
            onEnterBack: () => block.classList.add('active'),
            onLeaveBack: () => block.classList.remove('active')
        });
    });
}
