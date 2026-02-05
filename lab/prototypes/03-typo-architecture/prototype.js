window.initPrototype = function (labState) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '../prototypes/03-typo-architecture/prototype.css';
    document.head.appendChild(link);
    setTimeout(() => initTypoArchitecture(labState), 100);
};

function initTypoArchitecture(state) {
    const blocks = document.querySelectorAll('.typo-block');
    const viewport = document.getElementById('lab-viewport');
    if (!blocks.length) return;

    blocks.forEach(block => {
        const bg = block.querySelector('.typo-background');

        ScrollTrigger.create({
            trigger: block,
            scroller: viewport,
            start: 'top 65%',
            end: 'bottom 35%',
            onEnter: () => block.classList.add('active'),
            onLeave: () => block.classList.remove('active'),
            onEnterBack: () => block.classList.add('active'),
            onLeaveBack: () => block.classList.remove('active'),
            onUpdate: (self) => {
                if (bg) {
                    gsap.to(bg, { y: -50 * self.progress, duration: 0.3, ease: 'none' });
                }
            }
        });
    });
}
