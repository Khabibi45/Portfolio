/* ═══════════════════════════════════════════════════════════════
   LAB MOTION — 10 Motion Design Modules
   Each module activates only when visible (IntersectionObserver)
   ═══════════════════════════════════════════════════════════════ */
(function () {
    'use strict';

    const raf = requestAnimationFrame;
    let activeModules = new Set();

    /* ═══════════════════════════════════════════════════════════════
       INTERSECTION OBSERVER — activate sections on scroll
       ═══════════════════════════════════════════════════════════════ */
    const sections = document.querySelectorAll('.mo-section');
    const progressDots = document.querySelectorAll('.mo-progress__dot');
    const allSections = document.querySelectorAll('.mo-hero, .mo-section');

    const sectionObs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('is-visible');
                activateModule(e.target.id);
            }
        });
    }, { threshold: 0.3 });

    const progressObs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                progressDots.forEach(d => d.classList.remove('is-active'));
                const dot = document.querySelector(`.mo-progress__dot[data-section="${e.target.id}"]`);
                if (dot) dot.classList.add('is-active');
            }
        });
    }, { threshold: 0.5 });

    sections.forEach(s => sectionObs.observe(s));
    allSections.forEach(s => progressObs.observe(s));

    function activateModule(id) {
        if (activeModules.has(id)) return;
        activeModules.add(id);
        switch (id) {
            case 'mo-01': initMagnetic();  break;
            case 'mo-02': initBlobs();     break;
            case 'mo-03': initParallax();  break;
            case 'mo-04': initKinetic();   break;
            case 'mo-05': initVelocity();  break;
            case 'mo-06': initAurora();    break;
            case 'mo-07': initParticles(); break;
            case 'mo-08': initScramble();  break;
            case 'mo-10': initTilt();      break;
        }
    }

    /* ═══════════════════════════════════════════════════════════════
       01 — MAGNETIC LETTERS
       ═══════════════════════════════════════════════════════════════ */
    function initMagnetic() {
        const el = document.querySelector('[data-magnetic]');
        if (!el) return;
        const text = el.textContent;
        el.innerHTML = '';
        const letters = [];

        text.split('').forEach(ch => {
            const span = document.createElement('span');
            span.textContent = ch === ' ' ? '\u00A0' : ch;
            el.appendChild(span);
            letters.push({ el: span, x: 0, y: 0, vx: 0, vy: 0 });
        });

        const demo = document.getElementById('magnetic-demo');
        let mx = -9999, my = -9999;

        demo.addEventListener('mousemove', e => {
            const r = demo.getBoundingClientRect();
            mx = e.clientX - r.left;
            my = e.clientY - r.top;
        });
        demo.addEventListener('mouseleave', () => { mx = -9999; my = -9999; });

        function tick() {
            letters.forEach(l => {
                const rect = l.el.getBoundingClientRect();
                const demoRect = demo.getBoundingClientRect();
                const cx = rect.left - demoRect.left + rect.width / 2;
                const cy = rect.top - demoRect.top + rect.height / 2;
                const dx = cx - mx;
                const dy = cy - my;
                const dist = Math.hypot(dx, dy);
                const radius = 180;

                if (dist < radius && mx > 0) {
                    const force = (1 - dist / radius) * 50;
                    const angle = Math.atan2(dy, dx);
                    l.vx += Math.cos(angle) * force * 0.15;
                    l.vy += Math.sin(angle) * force * 0.15;
                }

                // Spring back
                l.vx += -l.x * 0.06;
                l.vy += -l.y * 0.06;
                // Damping
                l.vx *= 0.85;
                l.vy *= 0.85;

                l.x += l.vx;
                l.y += l.vy;

                l.el.style.transform = `translate(${l.x}px, ${l.y}px)`;
            });
            raf(tick);
        }
        tick();
    }

    /* ═══════════════════════════════════════════════════════════════
       02 — LIQUID BLOBS
       ═══════════════════════════════════════════════════════════════ */
    function initBlobs() {
        const paths = [
            document.getElementById('blob-1'),
            document.getElementById('blob-2'),
            document.getElementById('blob-3'),
        ];

        function blobPath(cx, cy, r, t, seed) {
            const pts = 8;
            let d = '';
            for (let i = 0; i < pts; i++) {
                const a = (Math.PI * 2 / pts) * i;
                const n = Math.sin(a * 3 + t * 0.8 + seed) * 0.3 +
                          Math.sin(a * 2 + t * 1.2 + seed * 2) * 0.2;
                const dr = r * (1 + n);
                const x = cx + Math.cos(a) * dr;
                const y = cy + Math.sin(a) * dr;
                d += (i === 0 ? 'M' : 'L') + x.toFixed(1) + ',' + y.toFixed(1);
            }
            return d + 'Z';
        }

        function smooth(d) {
            // Convert polygon to smooth bezier
            const pts = d.replace('Z', '').split(/[ML]/).filter(Boolean).map(p => {
                const [x, y] = p.split(',').map(Number);
                return { x, y };
            });
            let s = `M${pts[0].x},${pts[0].y}`;
            for (let i = 0; i < pts.length; i++) {
                const p0 = pts[(i - 1 + pts.length) % pts.length];
                const p1 = pts[i];
                const p2 = pts[(i + 1) % pts.length];
                const p3 = pts[(i + 2) % pts.length];
                const cp1x = p1.x + (p2.x - p0.x) / 6;
                const cp1y = p1.y + (p2.y - p0.y) / 6;
                const cp2x = p2.x - (p3.x - p1.x) / 6;
                const cp2y = p2.y - (p3.y - p1.y) / 6;
                s += `C${cp1x.toFixed(1)},${cp1y.toFixed(1)},${cp2x.toFixed(1)},${cp2y.toFixed(1)},${p2.x.toFixed(1)},${p2.y.toFixed(1)}`;
            }
            return s + 'Z';
        }

        let t = 0;
        function tick() {
            t += 0.012;
            paths[0].setAttribute('d', smooth(blobPath(350, 250, 140, t, 0)));
            paths[1].setAttribute('d', smooth(blobPath(450, 220, 120, t, 5)));
            paths[2].setAttribute('d', smooth(blobPath(380, 280, 100, t, 10)));
            raf(tick);
        }
        tick();
    }

    /* ═══════════════════════════════════════════════════════════════
       03 — PARALLAX DEPTH
       ═══════════════════════════════════════════════════════════════ */
    function initParallax() {
        const demo = document.getElementById('parallax-demo');
        const layers = demo.querySelectorAll('.mo-parallax__layer');

        demo.addEventListener('mousemove', e => {
            const r = demo.getBoundingClientRect();
            const mx = (e.clientX - r.left) / r.width - 0.5;
            const my = (e.clientY - r.top) / r.height - 0.5;

            layers.forEach(layer => {
                const depth = parseFloat(layer.dataset.depth);
                const x = mx * depth * 600;
                const y = my * depth * 600;
                const rot = mx * depth * 5;
                layer.style.transform = `translate(${x}px, ${y}px) rotate(${rot}deg)`;
            });
        });

        demo.addEventListener('mouseleave', () => {
            layers.forEach(l => { l.style.transform = 'translate(0,0) rotate(0)'; });
        });
    }

    /* ═══════════════════════════════════════════════════════════════
       04 — KINETIC TYPOGRAPHY
       ═══════════════════════════════════════════════════════════════ */
    function initKinetic() {
        document.getElementById('kinetic-demo').classList.add('is-triggered');
    }

    /* ═══════════════════════════════════════════════════════════════
       05 — VELOCITY CARDS
       ═══════════════════════════════════════════════════════════════ */
    function initVelocity() {
        const cards = document.querySelectorAll('.mo-velocity__card');
        let lastScroll = window.scrollY;
        let velocity = 0;
        let currentSkew = 0;

        function tick() {
            const scroll = window.scrollY;
            velocity = scroll - lastScroll;
            lastScroll = scroll;

            // Smooth skew towards velocity
            const targetSkew = Math.max(-12, Math.min(12, velocity * 0.3));
            currentSkew += (targetSkew - currentSkew) * 0.12;

            if (Math.abs(currentSkew) > 0.01) {
                cards.forEach(c => {
                    c.style.transform = `skewY(${currentSkew}deg)`;
                });
            }
            raf(tick);
        }
        tick();
    }

    /* ═══════════════════════════════════════════════════════════════
       06 — AURORA BOREALIS
       ═══════════════════════════════════════════════════════════════ */
    function initAurora() {
        const canvas = document.getElementById('aurora-canvas');
        const ctx = canvas.getContext('2d');
        const demo = document.getElementById('aurora-demo');
        let w, h, t = 0;

        function resize() {
            const r = demo.getBoundingClientRect();
            const dpr = Math.min(devicePixelRatio, 2);
            w = r.width; h = r.height;
            canvas.width = w * dpr;
            canvas.height = h * dpr;
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        }
        resize();
        window.addEventListener('resize', resize);

        const bands = [
            { color: [125, 211, 252], y: 0.3, amp: 60, freq: 0.003, speed: 0.4, width: 120 },
            { color: [167, 139, 250], y: 0.4, amp: 50, freq: 0.004, speed: 0.3, width: 100 },
            { color: [74, 222, 128],  y: 0.5, amp: 70, freq: 0.002, speed: 0.5, width: 90 },
            { color: [244, 114, 182], y: 0.6, amp: 40, freq: 0.005, speed: 0.35, width: 80 },
            { color: [251, 146, 60],  y: 0.35, amp: 55, freq: 0.003, speed: 0.45, width: 70 },
        ];

        function tick() {
            t += 0.016;
            ctx.clearRect(0, 0, w, h);
            ctx.globalCompositeOperation = 'screen';

            bands.forEach(b => {
                ctx.beginPath();
                const baseY = h * b.y;
                ctx.moveTo(0, h);

                for (let x = 0; x <= w; x += 4) {
                    const wave = Math.sin(x * b.freq + t * b.speed) * b.amp
                               + Math.sin(x * b.freq * 1.5 + t * b.speed * 0.7) * b.amp * 0.5;
                    ctx.lineTo(x, baseY + wave);
                }

                ctx.lineTo(w, h);
                ctx.closePath();

                const grad = ctx.createLinearGradient(0, baseY - b.width, 0, baseY + b.width);
                grad.addColorStop(0, `rgba(${b.color.join(',')},0)`);
                grad.addColorStop(0.5, `rgba(${b.color.join(',')},0.15)`);
                grad.addColorStop(1, `rgba(${b.color.join(',')},0)`);
                ctx.fillStyle = grad;
                ctx.fill();
            });

            ctx.globalCompositeOperation = 'source-over';
            raf(tick);
        }
        tick();
    }

    /* ═══════════════════════════════════════════════════════════════
       07 — PARTICLE CONSTELLATION
       ═══════════════════════════════════════════════════════════════ */
    function initParticles() {
        const canvas = document.getElementById('particles-canvas');
        const ctx = canvas.getContext('2d');
        const demo = document.getElementById('particles-demo');
        let w, h;
        let mx = -9999, my = -9999;

        function resize() {
            const r = demo.getBoundingClientRect();
            const dpr = Math.min(devicePixelRatio, 2);
            w = r.width; h = r.height;
            canvas.width = w * dpr;
            canvas.height = h * dpr;
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        }
        resize();
        window.addEventListener('resize', resize);

        demo.addEventListener('mousemove', e => {
            const r = demo.getBoundingClientRect();
            mx = e.clientX - r.left;
            my = e.clientY - r.top;
        });
        demo.addEventListener('mouseleave', () => { mx = -9999; my = -9999; });

        const count = 80;
        const particles = [];
        for (let i = 0; i < count; i++) {
            particles.push({
                x: Math.random() * 1100,
                y: Math.random() * 400,
                vx: (Math.random() - 0.5) * 0.4,
                vy: (Math.random() - 0.5) * 0.4,
                r: 1.5 + Math.random() * 1.5,
            });
        }

        function tick() {
            ctx.clearRect(0, 0, w, h);
            const connectDist = 120;
            const mouseDist = 180;

            for (const p of particles) {
                p.x += p.vx;
                p.y += p.vy;
                if (p.x < 0 || p.x > w) p.vx *= -1;
                if (p.y < 0 || p.y > h) p.vy *= -1;

                // Mouse attraction
                if (mx > 0) {
                    const dx = mx - p.x, dy = my - p.y;
                    const d = Math.hypot(dx, dy);
                    if (d < mouseDist) {
                        p.vx += dx / d * 0.08;
                        p.vy += dy / d * 0.08;
                        p.vx *= 0.97;
                        p.vy *= 0.97;
                    }
                }

                // Draw particle
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(125,211,252,0.6)';
                ctx.fill();
            }

            // Connections
            for (let i = 0; i < particles.length; i++) {
                for (let j = i + 1; j < particles.length; j++) {
                    const d = Math.hypot(particles[i].x - particles[j].x, particles[i].y - particles[j].y);
                    if (d < connectDist) {
                        ctx.beginPath();
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.strokeStyle = `rgba(125,211,252,${(1 - d / connectDist) * 0.2})`;
                        ctx.lineWidth = 0.5;
                        ctx.stroke();
                    }
                }
            }

            // Mouse connections
            if (mx > 0) {
                for (const p of particles) {
                    const d = Math.hypot(p.x - mx, p.y - my);
                    if (d < mouseDist) {
                        ctx.beginPath();
                        ctx.moveTo(p.x, p.y);
                        ctx.lineTo(mx, my);
                        ctx.strokeStyle = `rgba(167,139,250,${(1 - d / mouseDist) * 0.4})`;
                        ctx.lineWidth = 0.8;
                        ctx.stroke();
                    }
                }
            }

            raf(tick);
        }
        tick();
    }

    /* ═══════════════════════════════════════════════════════════════
       08 — TEXT SCRAMBLE
       ═══════════════════════════════════════════════════════════════ */
    function initScramble() {
        const lines = document.querySelectorAll('.mo-scramble__line');
        const charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%&*!';

        lines.forEach((line, li) => {
            const target = line.dataset.text;
            const len = target.length;
            let frame = 0;
            const totalFrames = len * 3 + 20;

            function tick() {
                let out = '';
                for (let i = 0; i < len; i++) {
                    if (target[i] === ' ') { out += ' '; continue; }
                    const resolveAt = i * 3 + 8;
                    if (frame >= resolveAt) {
                        out += target[i];
                    } else {
                        out += `<span class="char-random">${charset[Math.floor(Math.random() * charset.length)]}</span>`;
                    }
                }
                line.innerHTML = out;
                frame++;

                if (frame < totalFrames) {
                    setTimeout(tick, 30);
                } else {
                    line.textContent = target;
                    line.classList.add('is-resolved');
                }
            }

            setTimeout(() => tick(), li * 400);
        });
    }

    /* ═══════════════════════════════════════════════════════════════
       10 — 3D TILT CARDS
       ═══════════════════════════════════════════════════════════════ */
    function initTilt() {
        const cards = document.querySelectorAll('[data-tilt]');

        cards.forEach(card => {
            const gloss = card.querySelector('.mo-tilt__gloss');

            card.addEventListener('mousemove', e => {
                const r = card.getBoundingClientRect();
                const x = (e.clientX - r.left) / r.width;
                const y = (e.clientY - r.top) / r.height;

                const rotY = (x - 0.5) * 20;
                const rotX = (0.5 - y) * 15;

                card.style.transform = `perspective(800px) rotateX(${rotX}deg) rotateY(${rotY}deg) scale(1.02)`;

                if (gloss) {
                    gloss.style.background = `radial-gradient(circle at ${x * 100}% ${y * 100}%, rgba(255,255,255,0.15), transparent 50%)`;
                }
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(800px) rotateX(0) rotateY(0) scale(1)';
                if (gloss) gloss.style.background = '';
            });
        });
    }

})();
