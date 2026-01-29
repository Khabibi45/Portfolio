// Custom Cursor Logic
const cursorDot = document.querySelector('.cursor-dot');
const cursorOutline = document.querySelector('.cursor-outline');

// Hide cursor on touch devices
if (window.matchMedia("(pointer: fine)").matches) {
    window.addEventListener('mousemove', (e) => {
        const posX = e.clientX;
        const posY = e.clientY;

        // Dot follows instantly
        cursorDot.style.left = `${posX}px`;
        cursorDot.style.top = `${posY}px`;

        // Outline follows with slight delay (animation in CSS or via GSAP)
        cursorOutline.animate({
            left: `${posX}px`,
            top: `${posY}px`
        }, { duration: 500, fill: "forwards" });
    });

    // Hover effects on cursor
    const hoverables = document.querySelectorAll('a, button, .project-card, input, textarea');
    hoverables.forEach(el => {
        el.addEventListener('mouseenter', () => {
            cursorOutline.style.transform = 'translate(-50%, -50%) scale(1.5)';
            cursorOutline.style.backgroundColor = 'rgba(255, 255, 255, 0.1)';
        });
        el.addEventListener('mouseleave', () => {
            cursorOutline.style.transform = 'translate(-50%, -50%) scale(1)';
            cursorOutline.style.backgroundColor = 'transparent';
        });
    });
}

// Loader
window.addEventListener('load', () => {
    const loader = document.getElementById('loader');
    setTimeout(() => {
        loader.classList.add('loader-hidden');
    }, 500);
});

// GSAP Animations
gsap.registerPlugin(ScrollTrigger);

// Hero Reveal
const tl = gsap.timeline();

tl.from(".gs-reveal", {
    y: 50,
    opacity: 0,
    duration: 1,
    stagger: 0.2,
    ease: "power3.out",
    delay: 0.5
})
    .from(".gs-reveal-img", {
        scale: 0.8,
        opacity: 0,
        duration: 1.5,
        ease: "elastic.out(1, 0.5)"
    }, "-=1");

// Section Headers
gsap.utils.toArray('h2').forEach(heading => {
    gsap.from(heading, {
        scrollTrigger: {
            trigger: heading,
            start: "top 80%",
            toggleActions: "play none none reverse"
        },
        y: 30,
        opacity: 0,
        duration: 0.8
    });
});

// Project Cards Stagger
gsap.from(".project-card", {
    scrollTrigger: {
        trigger: "#projects-grid",
        start: "top 80%"
    },
    y: 50,
    opacity: 0,
    duration: 0.8,
    stagger: 0.2
});

// Transitivity Logic (Skills -> Projects) - DISABLED (Controlled by collection.ui.js & skills-cards.js)
/*
const skillTags = document.querySelectorAll('.skill-tag');
...
*/

function styleCard(card, isVisible) {
    if (isVisible) {
        gsap.to(card, { opacity: 1, scale: 1, filter: "grayscale(0%) blur(0px)", duration: 0.4 });
        card.style.pointerEvents = "all";
    } else {
        gsap.to(card, { opacity: 0.2, scale: 0.95, filter: "grayscale(100%) blur(2px)", duration: 0.4 });
        card.style.pointerEvents = "none";
    }
}

// Contact Form Handling
const contactForm = document.getElementById('contact-form');
const formResponse = document.getElementById('form-response');

contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    // UI Loading state
    const btn = contactForm.querySelector('button');
    const originalBtnText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi...';
    btn.disabled = true;

    const formData = new FormData(contactForm);

    try {
        const response = await fetch('contact.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (response.ok) {
            formResponse.className = "text-center text-sm font-medium mt-4 text-green-400";
            formResponse.innerHTML = `<i class="fas fa-check-circle"></i> ${result.message}`;
            contactForm.reset();
        } else {
            throw new Error(result.message);
        }
    } catch (error) {
        formResponse.className = "text-center text-sm font-medium mt-4 text-red-400";
        formResponse.innerHTML = `<i class="fas fa-exclamation-circle"></i> Erreur: ${error.message}`;
    } finally {
        btn.innerHTML = originalBtnText;
        btn.disabled = false;
        formResponse.classList.remove('hidden');

        setTimeout(() => {
            formResponse.classList.add('hidden');
        }, 5000);
    }
});

// Navbar Scroll Effect
window.addEventListener('scroll', () => {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('lg:py-0');
        navbar.classList.add('shadow-lg');
    } else {
        navbar.classList.remove('lg:py-0');
        navbar.classList.remove('shadow-lg');
    }
});
