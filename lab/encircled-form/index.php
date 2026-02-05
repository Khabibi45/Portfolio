<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encircled Progress Form — Premium | Camil Belmehdi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <style>
        :root {
            --accent: #06b6d4;
            --accent2: #22d3ee;
            --accent3: #67e8f9;
            --deep: #0c4a6e;
            --bg: #060c18;
            --surface: rgba(6, 18, 34, 0.82);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: #e2e8f0;
            min-height: 100vh;
            overflow: hidden;
            cursor: none;
        }

        /* ── Custom Cursor ── */
        .cursor-dot, .cursor-ring {
            position: fixed; top: 0; left: 0;
            transform: translate(-50%, -50%);
            border-radius: 50%; pointer-events: none; z-index: 9999;
        }
        .cursor-dot { width: 6px; height: 6px; background: var(--accent2); }
        .cursor-ring {
            width: 36px; height: 36px;
            border: 1.5px solid rgba(6, 182, 212, 0.4);
            transition: width 0.25s, height 0.25s, border-color 0.25s, background 0.25s;
        }
        .cursor-ring.hover {
            width: 52px; height: 52px;
            border-color: var(--accent2);
            background: rgba(6, 182, 212, 0.06);
        }

        /* ── Canvas Background ── */
        #bgCanvas {
            position: fixed; inset: 0; z-index: 0;
        }

        /* ── Back Button ── */
        .back {
            position: fixed; top: 1.2rem; left: 1.2rem; z-index: 100;
            display: flex; align-items: center; gap: 0.5rem;
            padding: 0.55rem 1rem;
            background: rgba(6, 18, 34, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(6, 182, 212, 0.15);
            border-radius: 10px;
            color: #64748b; text-decoration: none; font-size: 0.8rem;
            transition: all 0.3s;
        }
        .back:hover { color: #fff; border-color: var(--accent); }

        /* ── Layout ── */
        .page-wrap {
            position: relative; z-index: 1;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            min-height: 100vh; padding: 2rem;
        }

        /* ── Title ── */
        .page-title {
            font-size: clamp(1.6rem, 4vw, 2.4rem);
            font-weight: 700; letter-spacing: -0.03em;
            margin-bottom: 0.4rem; opacity: 0;
        }
        .page-subtitle {
            font-size: 0.9rem; color: #475569;
            margin-bottom: clamp(1.5rem, 4vw, 3rem); opacity: 0;
        }

        /* ── Encircled Container ── */
        .encircled-container {
            position: relative;
            width: min(82vmin, 560px); height: min(82vmin, 560px);
            display: flex; align-items: center; justify-content: center;
        }

        /* ── Ring SVG ── */
        .progress-ring {
            position: absolute; inset: 0; width: 100%; height: 100%;
            transform: rotate(-90deg);
        }

        .ring-orbit { fill: none; stroke-width: 1; }
        .ring-orbit-1 {
            stroke: rgba(6, 182, 212, 0.04);
            stroke-dasharray: 6 18;
            animation: orbitSpin 80s linear infinite;
        }
        .ring-orbit-2 {
            stroke: rgba(6, 182, 212, 0.03);
            stroke-dasharray: 3 24;
            animation: orbitSpin 55s linear infinite reverse;
        }
        .ring-orbit-3 {
            stroke: rgba(6, 182, 212, 0.02);
            stroke-dasharray: 10 10;
            animation: orbitSpin 100s linear infinite;
        }

        @keyframes orbitSpin {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }

        .ring-progress {
            fill: none; stroke: url(#ringGrad);
            stroke-width: 3; stroke-linecap: round;
            stroke-dasharray: 1445; stroke-dashoffset: 1445;
            transition: stroke-dashoffset 1s cubic-bezier(0.16, 1, 0.3, 1);
            filter: url(#waterRipple);
        }

        .ring-glow {
            fill: none; stroke: url(#ringGrad);
            stroke-width: 16; stroke-linecap: round;
            stroke-dasharray: 1445; stroke-dashoffset: 1445;
            filter: blur(20px); opacity: 0;
            transition: stroke-dashoffset 1s cubic-bezier(0.16, 1, 0.3, 1);
            animation: glowBreath 5s ease-in-out infinite;
        }

        @keyframes glowBreath {
            0%, 100% { opacity: 0.2; filter: blur(16px); }
            40%      { opacity: 0.5; filter: blur(24px); }
            70%      { opacity: 0.3; filter: blur(18px); }
        }

        .ring-sweep {
            fill: none; stroke: var(--accent3);
            stroke-width: 2; stroke-linecap: round;
            stroke-dasharray: 120 1325;
            stroke-dashoffset: 0; opacity: 0;
            filter: url(#waterRipple);
        }

        /* ── Checkpoints ── */
        .checkpoint {
            fill: #0c2d48; stroke: rgba(6, 182, 212, 0.3);
            stroke-width: 2; transition: all 0.4s;
            transform-box: fill-box; transform-origin: center;
            opacity: 0;
        }
        .checkpoint.visible { opacity: 0.5; animation: cpFloat 3s ease-in-out infinite; }
        .checkpoint.active {
            fill: var(--accent); stroke: var(--accent2);
            opacity: 1; animation: cpActive 2.5s ease-in-out infinite;
        }
        @keyframes cpFloat {
            0%, 100% { transform: scale(1); }
            50%      { transform: scale(1.2); }
        }
        @keyframes cpActive {
            0%, 100% { transform: scale(1.1); filter: drop-shadow(0 0 3px var(--accent)); }
            50%      { transform: scale(1.5); filter: drop-shadow(0 0 8px var(--accent)); }
        }

        /* ── Satellite ── */
        .satellite {
            fill: var(--accent3);
            filter: drop-shadow(0 0 10px rgba(34, 211, 238, 0.8));
            opacity: 0; transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* ── Ripple Rings (on step change) ── */
        .ripple-ring {
            fill: none; stroke: var(--accent2); stroke-width: 2;
            opacity: 0; transform-origin: center;
        }

        /* ── Form Card ── */
        .form-card {
            position: relative; width: 62%;
            border-radius: 24px; padding: 2.5rem 2rem;
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: transform, opacity;
            opacity: 0;
        }

        /* Animated gradient border */
        .form-card::before {
            content: ''; position: absolute; inset: -1px;
            border-radius: 25px;
            background: conic-gradient(from var(--border-angle, 0deg),
                transparent 30%, var(--accent) 50%, var(--accent2) 55%, transparent 70%);
            opacity: 0.4;
            animation: borderSpin 6s linear infinite;
            z-index: -2;
        }
        @keyframes borderSpin {
            to { --border-angle: 360deg; }
        }
        @property --border-angle {
            syntax: "<angle>"; initial-value: 0deg; inherits: false;
        }

        /* Glass fill */
        .form-card::after {
            content: ''; position: absolute; inset: 0;
            border-radius: 24px;
            background: var(--surface);
            backdrop-filter: blur(24px);
            z-index: -1;
        }

        /* Lock overlay */
        .form-lock {
            position: absolute; inset: 0;
            background: rgba(6, 12, 24, 0.75);
            border-radius: 24px; pointer-events: none;
            transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 1;
        }
        .form-card.step1 .form-lock { opacity: 0.5; }
        .form-card.step2 .form-lock { opacity: 0.2; }
        .form-card.unlocked .form-lock { opacity: 0; }

        /* ── Floating Label Inputs ── */
        .field-wrap {
            position: relative;
            opacity: 0; transform: translateY(12px);
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 2;
        }
        .field-wrap.revealed { opacity: 1; transform: translateY(0); }

        .field-wrap label {
            position: absolute; left: 1.2rem; top: 50%;
            transform: translateY(-50%);
            color: #475569; font-size: 0.9rem;
            pointer-events: none;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .field-wrap.is-textarea label { top: 1.15rem; transform: none; }

        .field-wrap.focused label,
        .field-wrap.filled label {
            top: 0; transform: translateY(-50%) scale(0.78);
            color: var(--accent2);
            background: linear-gradient(to bottom, transparent 40%, var(--bg) 40%);
            padding: 0 6px;
        }

        .form-input {
            width: 100%; padding: 1rem 1.2rem;
            background: rgba(6, 18, 34, 0.5);
            border: 1px solid rgba(6, 182, 212, 0.12);
            border-radius: 14px; color: #fff;
            font-size: 0.95rem; outline: none;
            transition: all 0.35s;
        }
        .form-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1),
                        0 0 20px -4px rgba(6, 182, 212, 0.15);
            background: rgba(6, 18, 34, 0.7);
        }
        .form-input::placeholder { color: transparent; }

        /* ── Submit Button ── */
        .form-btn {
            position: relative; z-index: 2;
            width: 100%; padding: 1rem;
            background: linear-gradient(135deg, var(--deep), var(--accent));
            border: 1px solid rgba(6, 182, 212, 0.2);
            border-radius: 14px; color: #fff;
            font-weight: 600; font-size: 0.95rem;
            cursor: pointer; overflow: hidden;
            opacity: 0.3; pointer-events: none;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .form-btn.armed {
            opacity: 1; pointer-events: auto;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border-color: var(--accent2);
        }
        .form-btn.armed:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 36px -8px rgba(6, 182, 212, 0.45);
        }

        /* Button ripple */
        .btn-ripple {
            position: absolute; border-radius: 50%;
            background: rgba(255,255,255,0.3);
            transform: scale(0); animation: rippleOut 0.6s ease-out forwards;
            pointer-events: none;
        }
        @keyframes rippleOut {
            to { transform: scale(4); opacity: 0; }
        }

        /* ── Step Counter ── */
        .step-counter {
            position: absolute; top: -2.2rem; right: 0;
            font-size: 0.7rem; color: #334155;
            letter-spacing: 0.1em; text-transform: uppercase;
            z-index: 2; opacity: 0;
            transition: opacity 0.5s;
        }
        .step-counter.visible { opacity: 1; }
        .step-counter span { color: var(--accent2); font-weight: 600; }

        /* ── Info Footer ── */
        .info-footer {
            position: absolute; bottom: -55px; left: 50%;
            transform: translateX(-50%);
            display: flex; gap: 1.5rem;
            font-size: 0.72rem; color: #334155;
            white-space: nowrap; opacity: 0;
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .info-footer.revealed { opacity: 1; color: #64748b; }
        .info-footer span { cursor: pointer; transition: color 0.2s; }
        .info-footer span:hover { color: var(--accent2); }

        /* ── Success ── */
        .success-overlay {
            position: absolute; inset: 0;
            background: var(--surface);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            opacity: 0; pointer-events: none; z-index: 5;
            transition: opacity 0.5s;
        }
        .success-overlay.show { opacity: 1; pointer-events: auto; }
        .success-icon {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1rem;
        }

        /* ── Reduced Motion ── */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation: none !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body>
    <!-- Custom Cursor -->
    <div class="cursor-dot" id="cursorDot"></div>
    <div class="cursor-ring" id="cursorRing"></div>

    <!-- Background Canvas -->
    <canvas id="bgCanvas"></canvas>

    <a href="/lab/contact-rings" class="back"><i class="fas fa-arrow-left"></i> Retour</a>

    <div class="page-wrap">
        <h1 class="page-title">Travaillons
            <span class="bg-gradient-to-r from-cyan-400 to-cyan-200 bg-clip-text text-transparent">Ensemble</span>
        </h1>
        <p class="page-subtitle">Une idée ? Un projet ? Ou simplement envie de discuter ?</p>

        <div class="encircled-container" id="encircledContainer">
            <!-- Ring SVG -->
            <svg class="progress-ring" viewBox="0 0 500 500">
                <defs>
                    <linearGradient id="ringGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#0e7490">
                            <animate attributeName="stop-color" values="#0e7490;#06b6d4;#0e7490" dur="3s" repeatCount="indefinite"/>
                        </stop>
                        <stop offset="50%" stop-color="#22d3ee">
                            <animate attributeName="stop-color" values="#22d3ee;#67e8f9;#22d3ee" dur="2.2s" repeatCount="indefinite"/>
                        </stop>
                        <stop offset="100%" stop-color="#a5f3fc">
                            <animate attributeName="stop-color" values="#a5f3fc;#cffafe;#a5f3fc" dur="1.8s" repeatCount="indefinite"/>
                        </stop>
                    </linearGradient>

                    <filter id="waterRipple" x="-15%" y="-15%" width="130%" height="130%">
                        <feTurbulence type="turbulence" baseFrequency="0.008 0.022"
                                      numOctaves="4" stitchTiles="stitch" result="water"/>
                        <feOffset in="water" result="flow">
                            <animate attributeName="dx" from="0" to="60" dur="6s" repeatCount="indefinite"/>
                            <animate attributeName="dy" from="0" to="40" dur="8s" repeatCount="indefinite"/>
                        </feOffset>
                        <feDisplacementMap in="SourceGraphic" in2="flow"
                                           scale="4" xChannelSelector="R" yChannelSelector="G"/>
                    </filter>

                    <filter id="causticFilter" x="-20%" y="-20%" width="140%" height="140%">
                        <feTurbulence type="turbulence" baseFrequency="0.035 0.05"
                                      numOctaves="2" stitchTiles="stitch" result="c"/>
                        <feOffset in="c" result="cf">
                            <animate attributeName="dx" from="0" to="45" dur="4.5s" repeatCount="indefinite"/>
                            <animate attributeName="dy" from="0" to="-25" dur="6s" repeatCount="indefinite"/>
                        </feOffset>
                        <feDisplacementMap in="SourceGraphic" in2="cf"
                                           scale="2" xChannelSelector="G" yChannelSelector="B"/>
                    </filter>
                </defs>

                <!-- Orbit rings -->
                <circle class="ring-orbit ring-orbit-1" cx="250" cy="250" r="245"/>
                <circle class="ring-orbit ring-orbit-2" cx="250" cy="250" r="215"/>
                <circle class="ring-orbit ring-orbit-3" cx="250" cy="250" r="235"/>

                <!-- Caustic layer -->
                <circle cx="250" cy="250" r="225" fill="none"
                        stroke="rgba(34,211,238,0.03)" stroke-width="45"
                        filter="url(#causticFilter)"
                        style="animation: glowBreath 7s ease-in-out infinite;"/>

                <!-- Progress glow -->
                <circle class="ring-glow" cx="250" cy="250" r="230"/>

                <!-- Main progress -->
                <circle class="ring-progress" cx="250" cy="250" r="230"/>

                <!-- Sweep -->
                <circle class="ring-sweep" cx="250" cy="250" r="230"/>

                <!-- Ripple rings (animated via JS) -->
                <circle class="ripple-ring" id="ripple1" cx="250" cy="250" r="230"/>
                <circle class="ripple-ring" id="ripple2" cx="250" cy="250" r="230"/>

                <!-- Checkpoints at 0°, 90°, 180° -->
                <circle class="checkpoint" cx="250" cy="20"  r="7" data-step="1"/>
                <circle class="checkpoint" cx="480" cy="250" r="7" data-step="2"/>
                <circle class="checkpoint" cx="250" cy="480" r="7" data-step="3"/>

                <!-- Satellite -->
                <circle class="satellite" cx="250" cy="20" r="4.5"/>
            </svg>

            <!-- Form Card -->
            <div class="form-card locked" id="formCard">
                <div class="form-lock" id="formLock"></div>

                <div class="step-counter" id="stepCounter">
                    Étape <span id="stepNum">0</span>/3
                </div>

                <form id="encircledForm" class="space-y-5 relative" style="z-index:2">
                    <div class="field-wrap" data-field="name">
                        <input type="text" class="form-input" id="inputName" data-step="1" autocomplete="off">
                        <label for="inputName">Votre nom</label>
                    </div>
                    <div class="field-wrap is-textarea" data-field="email">
                        <input type="email" class="form-input" id="inputEmail" data-step="2" autocomplete="off">
                        <label for="inputEmail">Votre email</label>
                    </div>
                    <div class="field-wrap is-textarea" data-field="message">
                        <textarea class="form-input min-h-[110px]" id="inputMessage" data-step="3"></textarea>
                        <label for="inputMessage">Votre message</label>
                    </div>
                    <button type="submit" class="form-btn" id="submitBtn">
                        <span>Envoyer le message</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </form>

                <div class="success-overlay" id="successOverlay">
                    <div class="success-icon"><i class="fas fa-check text-white text-2xl"></i></div>
                    <p class="text-lg font-semibold">Message envoyé !</p>
                    <p class="text-gray-500 text-sm mt-1">Je vous réponds rapidement.</p>
                </div>
            </div>

            <!-- Info Footer -->
            <div class="info-footer" id="infoFooter">
                <span onclick="copyText('camil.belmehdi@etu.iut-tlse3.fr')">
                    <i class="fas fa-envelope mr-1"></i>camil.belmehdi@etu.iut-tlse3.fr</span>
                <span><i class="fas fa-map-marker-alt mr-1"></i>Toulouse / Albi</span>
                <span onclick="copyText('+33 6 63 06 38 17')">
                    <i class="fas fa-phone mr-1"></i>+33 6 63 06 38 17</span>
            </div>
        </div>
    </div>

    <script>
    // ═══════════════════════════════════════════
    //  CUSTOM CURSOR
    // ═══════════════════════════════════════════
    const dot = document.getElementById('cursorDot');
    const ring = document.getElementById('cursorRing');
    let mx = 0, my = 0, rx = 0, ry = 0;

    document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; });

    (function cursorLoop() {
        rx += (mx - rx) * 0.15;
        ry += (my - ry) * 0.15;
        dot.style.left = mx + 'px'; dot.style.top = my + 'px';
        ring.style.left = rx + 'px'; ring.style.top = ry + 'px';
        requestAnimationFrame(cursorLoop);
    })();

    document.querySelectorAll('a, button, input, textarea, .info-footer span').forEach(el => {
        el.addEventListener('mouseenter', () => ring.classList.add('hover'));
        el.addEventListener('mouseleave', () => ring.classList.remove('hover'));
    });

    // ═══════════════════════════════════════════
    //  CANVAS BACKGROUND — Bubbles & Depth
    // ═══════════════════════════════════════════
    const canvas = document.getElementById('bgCanvas');
    const ctx = canvas.getContext('2d');
    let W, H;

    function resize() {
        W = canvas.width = window.innerWidth;
        H = canvas.height = window.innerHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    class Bubble {
        constructor() { this.reset(true); }
        reset(init) {
            this.x = Math.random() * W;
            this.y = init ? Math.random() * H : H + 20;
            this.r = Math.random() * 2.5 + 0.5;
            this.speed = 0.15 + Math.random() * 0.4;
            this.drift = (Math.random() - 0.5) * 0.3;
            this.alpha = Math.random() * 0.25 + 0.03;
            this.phase = Math.random() * Math.PI * 2;
        }
        update() {
            this.y -= this.speed;
            this.x += this.drift + Math.sin(this.phase + performance.now() * 0.001) * 0.15;
            if (this.y < -10) this.reset(false);
        }
        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(34, 211, 238, ${this.alpha})`;
            ctx.fill();
        }
    }

    const bubbles = Array.from({ length: 80 }, () => new Bubble());

    function drawBg() {
        ctx.clearRect(0, 0, W, H);

        // Subtle radial depth glow
        const g = ctx.createRadialGradient(W / 2, H / 2, 0, W / 2, H / 2, W * 0.5);
        g.addColorStop(0, 'rgba(6, 182, 212, 0.03)');
        g.addColorStop(1, 'transparent');
        ctx.fillStyle = g;
        ctx.fillRect(0, 0, W, H);

        bubbles.forEach(b => { b.update(); b.draw(); });
        requestAnimationFrame(drawBg);
    }
    drawBg();

    // ═══════════════════════════════════════════
    //  FORM LOGIC
    // ═══════════════════════════════════════════
    const card = document.getElementById('formCard');
    const form = document.getElementById('encircledForm');
    const inputs = form.querySelectorAll('.form-input');
    const fields = form.querySelectorAll('.field-wrap');
    const btn = document.getElementById('submitBtn');
    const ringProgress = document.querySelector('.ring-progress');
    const ringGlow = document.querySelector('.ring-glow');
    const ringDash = 1445;
    const checkpoints = document.querySelectorAll('.checkpoint');
    const satellite = document.querySelector('.satellite');
    const infoFooter = document.getElementById('infoFooter');
    const stepNum = document.getElementById('stepNum');
    const stepCounter = document.getElementById('stepCounter');
    let currentStep = 0;

    // ── Floating labels ──
    fields.forEach(wrap => {
        const input = wrap.querySelector('.form-input');
        input.addEventListener('focus', () => wrap.classList.add('focused'));
        input.addEventListener('blur', () => {
            wrap.classList.remove('focused');
            wrap.classList.toggle('filled', input.value.trim().length > 0);
        });
    });

    // ── Entry Animation ──
    function animateEntry() {
        const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

        tl.to('.page-title', { opacity: 1, y: 0, duration: 0.7 })
          .to('.page-subtitle', { opacity: 1, y: 0, duration: 0.5 }, '-=0.3')
          .fromTo('.ring-orbit', { opacity: 0 }, { opacity: 1, stagger: 0.12, duration: 0.6 }, '-=0.3')
          .fromTo(card, { opacity: 0, scale: 0.92 },
                        { opacity: 1, scale: 1, duration: 0.7 }, '-=0.3')
          .to('#encircledContainer', { scale: 1.015, duration: 0.12, ease: 'power2.out' })
          .to('#encircledContainer', { scale: 1, duration: 0.2, ease: 'power2.inOut' })
          .add(() => {
              checkpoints.forEach((cp, i) => {
                  setTimeout(() => cp.classList.add('visible'), i * 150);
              });
          })
          .add(() => {
              fields[0].classList.add('revealed');
              stepCounter.classList.add('visible');
          }, '-=0.1');
    }

    // ── Update Progress ──
    function updateProgress() {
        let filled = 0;
        inputs.forEach(inp => { if (inp.value.trim().length > 0) filled++; });

        const offset = ringDash - (ringDash * filled / 3);
        ringProgress.style.strokeDashoffset = offset;
        ringGlow.style.strokeDashoffset = offset;

        // Card state
        card.classList.remove('locked', 'step1', 'step2', 'unlocked');
        if (filled === 0) card.classList.add('locked');
        else if (filled === 1) card.classList.add('step1');
        else if (filled === 2) card.classList.add('step2');
        else card.classList.add('unlocked');

        // Reveal fields
        fields.forEach((f, i) => { if (i <= filled) f.classList.add('revealed'); });

        // Checkpoints
        checkpoints.forEach((cp, i) => cp.classList.toggle('active', i < filled));

        // Step counter
        stepNum.textContent = filled;

        // Button
        btn.classList.toggle('armed', filled === 3);

        // Footer
        infoFooter.classList.toggle('revealed', filled >= 2);

        // Ripple on step up
        if (filled > currentStep) {
            gsap.to('#encircledContainer', { scale: 1.015, duration: 0.12, ease: 'power2.out' });
            gsap.to('#encircledContainer', { scale: 1, duration: 0.25, delay: 0.12, ease: 'elastic.out(1, 0.5)' });

            // Water ripple effect
            const ripple = document.getElementById('ripple1');
            gsap.fromTo(ripple,
                { attr: { r: 230 }, strokeWidth: 3, opacity: 0.6 },
                { attr: { r: 260 }, strokeWidth: 0, opacity: 0, duration: 0.8, ease: 'power2.out' });

            // Sweep
            gsap.fromTo('.ring-sweep',
                { strokeDashoffset: ringDash * (1 - (filled - 1) / 3) },
                { strokeDashoffset: ringDash * (1 - filled / 3), opacity: 0.5, duration: 0.5, ease: 'power2.out' });
            gsap.to('.ring-sweep', { opacity: 0, duration: 0.3, delay: 0.5 });
        }

        currentStep = filled;
    }

    // ── Input Events ──
    inputs.forEach((input, i) => {
        input.addEventListener('input', updateProgress);

        input.addEventListener('focus', () => {
            const angles = [0, 90, 180];
            const a = angles[i] * Math.PI / 180;
            satellite.setAttribute('cx', 250 + 230 * Math.sin(a));
            satellite.setAttribute('cy', 250 - 230 * Math.cos(a));
            gsap.to(satellite, { opacity: 1, duration: 0.3 });
        });

        input.addEventListener('blur', () => {
            gsap.to(satellite, { opacity: 0, duration: 0.3 });
        });
    });

    // ── Button Ripple Effect ──
    btn.addEventListener('click', function(e) {
        const rect = this.getBoundingClientRect();
        const ripple = document.createElement('span');
        ripple.className = 'btn-ripple';
        const size = Math.max(rect.width, rect.height);
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
        ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
        this.appendChild(ripple);
        setTimeout(() => ripple.remove(), 600);
    });

    // ── Submit ──
    form.addEventListener('submit', e => {
        e.preventDefault();
        btn.innerHTML = '<i class="fas fa-circle-notch fa-spin text-lg"></i>';
        btn.disabled = true;

        // Full ring + ripple burst
        gsap.to('.ring-progress', { strokeDashoffset: 0, duration: 0.8, ease: 'power2.inOut' });

        // Concentric ripples
        [0, 200, 400].forEach(delay => {
            setTimeout(() => {
                const r = document.getElementById(delay < 300 ? 'ripple1' : 'ripple2');
                gsap.fromTo(r,
                    { attr: { r: 230 }, strokeWidth: 2, opacity: 0.4 },
                    { attr: { r: 280 }, strokeWidth: 0, opacity: 0, duration: 1, ease: 'power2.out' });
            }, delay);
        });

        gsap.to('#encircledContainer', { rotation: 360, duration: 1.4, ease: 'power2.inOut' });

        setTimeout(() => {
            gsap.set('#encircledContainer', { rotation: 0 });
            document.getElementById('successOverlay').classList.add('show');
            gsap.from('.success-icon', { scale: 0, duration: 0.5, ease: 'back.out(2)' });
        }, 1400);
    });

    // ── Copy ──
    function copyText(text) {
        navigator.clipboard.writeText(text);
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-4 right-4 text-sm px-4 py-2 rounded-xl shadow-lg z-50 text-white';
        toast.style.background = 'linear-gradient(135deg, var(--accent), var(--accent2))';
        toast.textContent = 'Copié !';
        document.body.appendChild(toast);
        gsap.from(toast, { y: 20, opacity: 0, duration: 0.3 });
        setTimeout(() => {
            gsap.to(toast, { y: -10, opacity: 0, duration: 0.3, onComplete: () => toast.remove() });
        }, 1800);
    }

    // ── Init ──
    gsap.set('.page-title', { y: 20 });
    gsap.set('.page-subtitle', { y: 15 });
    animateEntry();
    </script>
</body>

</html>
