// Forms Laboratory Scripts
gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {

    // 1. Liquid Login
    const liquidInputs = document.querySelectorAll('.liquid-input');
    const liquidBg = document.querySelector('.liquid-bg');

    liquidInputs.forEach(input => {
        input.addEventListener('focus', () => {
            gsap.to(liquidBg, { scale: 1.2, opacity: 0.8, duration: 0.5 });
        });
        input.addEventListener('blur', () => {
            gsap.to(liquidBg, { scale: 1, opacity: 0.5, duration: 0.5 });
        });
        input.addEventListener('input', (e) => {
            // Random wobble on type
            gsap.to(liquidBg, { x: Math.random() * 20 - 10, y: Math.random() * 20 - 10, duration: 0.2 });
        });
    });

    // 2. Flip Form
    const flipForm = document.getElementById('flip-form');
    const flipCard = document.querySelector('.flip-card');
    if (flipForm) {
        flipForm.addEventListener('submit', (e) => {
            e.preventDefault();
            flipCard.classList.add('flip-active');
            // Reset after 3 seconds
            setTimeout(() => {
                flipCard.classList.remove('flip-active');
                flipForm.reset();
            }, 3000);
        });
    }

    // 3. Spotlight
    const spotContainer = document.querySelector('.spotlight-container');
    if (spotContainer) {
        spotContainer.addEventListener('mousemove', (e) => {
            const rect = spotContainer.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            spotContainer.children[0].style.setProperty('--x', `${x}px`);
            spotContainer.children[0].style.setProperty('--y', `${y}px`);
        });
    }

    // 5. Minimalist Typeform
    const slides = document.querySelectorAll('.minimal-slide');
    const minimalInputs = document.querySelectorAll('.minimal-input');
    let currentSlide = 0;

    minimalInputs.forEach((input, index) => {
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                if (input.value.trim() !== '') {
                    nextSlide();
                }
            }
        });
    });

    function nextSlide() {
        if (currentSlide < slides.length - 1) {
            gsap.to(slides[currentSlide], { y: -100, opacity: 0, duration: 0.5 });
            currentSlide++;
            gsap.fromTo(slides[currentSlide], { y: 100, opacity: 0 }, { y: 0, opacity: 1, duration: 0.5 });
            setTimeout(() => {
                minimalInputs[currentSlide].focus();
            }, 500);
        } else {
            // Finish
            gsap.to(slides[currentSlide], { scale: 1.2, opacity: 0, duration: 0.5 });
            setTimeout(() => {
                slides[0].parentNode.innerHTML = '<div class="text-2xl text-green-400 font-bold text-center">Merci !</div>';
            }, 500);
        }
    }

    // 6. Knob / Dial
    const knob = document.querySelector('.knob-value');
    const knobDisplay = document.querySelector('.knob-display');
    const knobContainer = document.querySelector('.knob-container');
    let isDragging = false;
    let startY = 0;
    let currentValue = 0;

    if (knobContainer) {
        knobContainer.addEventListener('mousedown', (e) => {
            isDragging = true;
            startY = e.clientY;
        });

        window.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            const delta = startY - e.clientY;
            currentValue = Math.min(100, Math.max(0, currentValue + delta * 0.5));
            startY = e.clientY;
            updateKnob(currentValue);
        });

        window.addEventListener('mouseup', () => {
            isDragging = false;
        });
    }

    function updateKnob(val) {
        const circum = 565; // 2 * PI * 90
        const offset = circum - (val / 100) * circum;
        if (knob) knob.style.strokeDashoffset = offset;
        if (knobDisplay) knobDisplay.textContent = Math.round(val) + '%';
    }

    // 7. Holographic
    const holoCard = document.querySelector('.holo-card');
    const holoGlare = document.querySelector('.holo-glare');
    if (holoCard) {
        holoCard.addEventListener('mousemove', (e) => {
            const rect = holoCard.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const rotateX = ((y - centerY) / centerY) * -10; // Max 10deg
            const rotateY = ((x - centerX) / centerX) * 10;

            gsap.to(holoCard, { rotationX: rotateX, rotationY: rotateY, duration: 0.1 });

            // Move glare
            gsap.to(holoGlare, { x: (x - rect.width) + x, duration: 0.1 }); // Simplified glare movement
        });

        holoCard.addEventListener('mouseleave', () => {
            gsap.to(holoCard, { rotationX: 0, rotationY: 0, duration: 0.5 });
        });
    }

    // 8. Password Visualizer
    const pwdInput = document.getElementById('pwd-visual');
    const entropyBar = document.querySelector('.entropy-fill');
    const particleContainer = document.querySelector('.pwd-particles');

    if (pwdInput) {
        pwdInput.addEventListener('input', (e) => {
            const val = e.target.value;
            let strength = 0;
            if (val.length > 5) strength += 20;
            if (val.match(/[A-Z]/)) strength += 20;
            if (val.match(/[0-9]/)) strength += 20;
            if (val.match(/[^a-zA-Z0-9]/)) strength += 20;
            if (val.length > 10) strength += 20;

            entropyBar.style.width = `${strength}%`;

            // Color
            let color = 'red';
            if (strength > 40) color = 'orange';
            if (strength > 70) color = 'yellow';
            if (strength >= 100) color = 'green';
            entropyBar.style.backgroundColor = color;

            // Particles
            particleContainer.innerHTML = '';
            const numParticles = Math.floor(strength / 10);
            for (let i = 0; i < numParticles; i++) {
                const p = document.createElement('div');
                p.className = 'particle';
                p.style.backgroundColor = color;
                p.style.animationDelay = `${i * 0.1}s`;
                // Add simple bounce animation using GSAP
                gsap.to(p, { y: -10, duration: 0.3, yoyo: true, repeat: -1, ease: 'power1.inOut', delay: i * 0.05 });
                particleContainer.appendChild(p);
            }
        });
    }

    // 10. Emoji Slider
    const emojiSlider = document.getElementById('emoji-slider');
    const feedbackEmoji = document.querySelector('.feedback-emoji');
    const emojis = ['😡', '😠', '😐', '🙂', '😃', '🤩'];

    if (emojiSlider) {
        emojiSlider.addEventListener('input', (e) => {
            const val = parseInt(e.target.value);
            const index = Math.min(emojis.length - 1, Math.floor((val / 100) * emojis.length));
            feedbackEmoji.textContent = emojis[index];

            gsap.to(feedbackEmoji, {
                scale: 1 + (val / 200),
                rotation: (val - 50) / 2,
                duration: 0.2
            });
        });
    }

    // 9. Drag Upload
    const dragZone = document.querySelector('.drag-zone');
    if (dragZone) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dragZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) { e.preventDefault(); e.stopPropagation(); }

        ['dragenter', 'dragover'].forEach(eventName => {
            dragZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dragZone.addEventListener(eventName, unhighlight, false);
            // 11. Pro Shell Logic (Chatbot Update)
            const shellInput = document.getElementById('pro-shell-input');
            const shellOutput = document.getElementById('pro-shell-output');
            let shellFlowState = 'init'; // init, name, email, message, sending, done

            if (shellInput) {
                // Auto-start greeting
                setTimeout(() => addShellLine(`System connected.`, '#58cc02'), 500);
                setTimeout(() => addShellLine(`Bonjour. Je suis l'assistant virtuel de Camil.`, '#cdd6f4'), 1200);
                setTimeout(() => addShellLine(`Puis-je avoir votre Nom ?`, '#fab387'), 2000);

                shellInput.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') {
                        const val = shellInput.value.trim();
                        if (!val) return;

                        shellInput.value = '';
                        addShellLine(`> ${val}`, '#a6adc8'); // User echo

                        if (shellFlowState === 'init') {
                            // Name received
                            setTimeout(() => addShellLine(`Enchanté ${val}.`, '#cdd6f4'), 400);
                            setTimeout(() => addShellLine(`Quelle est votre adresse Email ?`, '#fab387'), 1000);
                            shellFlowState = 'email';
                        } else if (shellFlowState === 'email') {
                            // Email received
                            setTimeout(() => addShellLine(`Noté.`, '#cdd6f4'), 400);
                            setTimeout(() => addShellLine(`Quel est votre message pour Camil ?`, '#fab387'), 800);
                            shellFlowState = 'message';
                        } else if (shellFlowState === 'message') {
                            // Message received
                            shellFlowState = 'sending';
                            setTimeout(() => addShellLine(`Analyse du message...`, '#cdd6f4'), 300);
                            setTimeout(() => addShellLine(`Envoi en cours... [||||||    ] 60%`, '#89b4fa'), 1000);
                            setTimeout(() => addShellLine(`Envoi en cours... [||||||||||] 100%`, '#89b4fa'), 2000);
                            setTimeout(() => {
                                addShellLine(`Message transmis avec succès !`, '#58cc02');
                                addShellLine(`Camil vous recontactera rapidement.`, '#cdd6f4');
                                shellInput.placeholder = "Session terminée.";
                                shellInput.disabled = true;
                            }, 3000);
                        }
                    }
                });
            }

            function addShellLine(text, color = '#cdd6f4') {
                const div = document.createElement('div');
                div.className = 'mb-1';
                div.style.color = color;
                div.textContent = text;
                shellOutput.appendChild(div);
                shellOutput.scrollTop = shellOutput.scrollHeight;
            }
        }

            // 12. IDE Run Logic
            const runBtn = document.getElementById('ide-run-btn');
        const consoleOutput = document.getElementById('ide-console-output');
        const consoleContainer = document.getElementById('ide-console');
        const ideName = document.getElementById('ide-name');
        const ideEmail = document.getElementById('ide-email');
        const ideMsg = document.getElementById('ide-msg');

        if (runBtn) {
            runBtn.addEventListener('click', () => {
                consoleContainer.style.height = '150px';
                consoleOutput.innerHTML = '<div class="console-log">Running "contact.js"...</div>';

                setTimeout(() => {
                    const name = ideName.value;
                    const email = ideEmail.value;
                    const msg = ideMsg.value;

                    if (!name || !email || !msg) {
                        consoleOutput.innerHTML += `<div class="console-log" style="color: #f38ba8">Error: Missing fields in message object.</div>`;
                        consoleOutput.innerHTML += `<div class="console-log" style="color: #f38ba8">at sendMessage (contact.js:15:23)</div>`;
                        consoleOutput.innerHTML += `<div class="console-log box-shadow: 0 0 10px rgba(243, 139, 168, 0.5);">Process exited with code 1</div>`;
                    } else {
                        consoleOutput.innerHTML += `<div class="console-log console-info">Payload constructed. Validating... OK.</div>`;
                        consoleOutput.innerHTML += `<div class="console-log console-info">Connecting to mail server...</div>`;

                        setTimeout(() => {
                            consoleOutput.innerHTML += `<div class="console-log console-success">200 OK: Message sent successfully.</div>`;
                            consoleOutput.innerHTML += `<div class="console-log">Done in 1.24s</div>`;
                        }, 1000);
                    }

                    consoleContainer.scrollTop = consoleContainer.scrollHeight;
                }, 600);
            });
        }
    }

});

function highlight() { dragZone.classList.add('drag-active'); }
function unhighlight() { dragZone.classList.remove('drag-active'); }

dragZone.addEventListener('drop', (e) => {
    const dt = e.dataTransfer;
    const files = dt.files;
    if (files.length > 0) {
        dragZone.querySelector('p').textContent = `Fichier: ${files[0].name} (Simulé)`;
        gsap.from(dragZone, { scale: 0.8, duration: 0.5, ease: "elastic.out(1, 0.3)" });
    }
});
    }

});
