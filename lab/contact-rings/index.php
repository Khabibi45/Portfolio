<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ring Variants Lab | Camil Belmehdi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <style>
        :root {
            --accent: #6366f1;
            --bg: #0a0e1a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: #e2e8f0;
        }

        .section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            position: relative;
        }

        .section:nth-child(even) {
            background: rgba(99, 102, 241, 0.02);
        }

        .tag {
            position: absolute;
            top: 2rem;
            left: 2rem;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--accent);
            opacity: 0.7;
        }

        .num {
            display: inline-block;
            width: 22px;
            height: 22px;
            background: var(--accent);
            color: #fff;
            border-radius: 4px;
            text-align: center;
            line-height: 22px;
            margin-right: 0.5rem;
            font-size: 0.65rem;
        }

        .input {
            width: 100%;
            padding: 0.875rem 1rem;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 10px;
            color: #fff;
            font-size: 0.9rem;
            outline: none;
            transition: all 0.3s;
        }

        .input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .input::placeholder {
            color: #64748b;
        }

        .btn {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px -8px rgba(99, 102, 241, 0.5);
        }

        .card {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 16px;
            padding: 2rem;
            backdrop-filter: blur(10px);
        }

        .nav {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 100;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .nav a {
            width: 36px;
            height: 36px;
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 0.7rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
        }

        .nav a:hover,
        .nav a.active {
            background: var(--accent);
            color: #fff;
        }

        .back {
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 100;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1rem;
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 6px;
            color: #64748b;
            text-decoration: none;
            font-size: 0.8rem;
            transition: all 0.2s;
        }

        .back:hover {
            color: #fff;
            border-color: var(--accent);
        }

        .success {
            display: none;
            text-align: center;
        }

        .success.show {
            display: block;
        }

        .success-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            animation: pop 0.4s ease;
        }

        @keyframes pop {
            0% {
                transform: scale(0);
            }

            60% {
                transform: scale(1.15);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes draw {
            to {
                stroke-dashoffset: 0;
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.02);
            }
        }
    </style>
</head>

<body>
    <a href="/lab/contact" class="back"><i class="fas fa-arrow-left"></i> Retour</a>
    <nav class="nav">
        <a href="#v1">8.1</a><a href="#v2">8.2</a><a href="#v3">8.3</a><a href="#v4">8.4</a>
        <a href="#v5">8.5</a><a href="#v6">8.6</a><a href="#v7">8.7</a><a href="#v8">8.8</a>
    </nav>

    <!-- 8.1 ORBITAL HUD -->
    <section id="v1" class="section">
        <span class="tag"><span class="num">8.1</span> Orbital HUD</span>
        <div class="flex flex-col lg:flex-row items-center gap-10 max-w-4xl">
            <div class="relative w-52 h-52">
                <svg class="w-full h-full" viewBox="0 0 200 200">
                    <circle cx="100" cy="100" r="90" stroke="rgba(99,102,241,0.1)" stroke-width="1" fill="none" />
                    <circle cx="100" cy="100" r="80" stroke="rgba(99,102,241,0.15)" stroke-width="6" fill="none" />
                    <circle class="ring-progress" cx="100" cy="100" r="80" stroke="#6366f1" stroke-width="6" fill="none"
                        stroke-dasharray="502" stroke-dashoffset="502" stroke-linecap="round"
                        transform="rotate(-90 100 100)"
                        style="transition: stroke-dashoffset 0.5s cubic-bezier(0.16,1,0.3,1);" />
                    <g class="ticks" opacity="0.4"></g>
                    <circle class="satellite" cx="100" cy="20" r="4" fill="#818cf8" opacity="0" />
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="ring-percent text-3xl font-bold">0%</span>
                    <span class="ring-label text-xs text-gray-500 mt-1">Démarrer</span>
                </div>
            </div>
            <form class="card w-full max-w-sm space-y-3" onsubmit="return handleRingSubmit(event, this)">
                <input type="text" class="input ring-input" placeholder="Nom" data-label="Nom" data-arc="0">
                <input type="email" class="input ring-input" placeholder="Email" data-label="Email" data-arc="120">
                <textarea class="input ring-input min-h-[100px]" placeholder="Message" data-label="Message"
                    data-arc="240"></textarea>
                <button type="submit" class="btn">Envoyer</button>
                <div class="success">
                    <div class="success-icon"><i class="fas fa-check text-white text-xl"></i></div>
                    <p class="font-semibold">Envoyé !</p>
                </div>
            </form>
        </div>
    </section>

    <!-- 8.2 LIQUID RING -->
    <section id="v2" class="section">
        <span class="tag"><span class="num">8.2</span> Liquid Ring</span>
        <div class="flex flex-col lg:flex-row items-center gap-10 max-w-4xl">
            <div class="relative w-52 h-52">
                <svg class="w-full h-full" viewBox="0 0 200 200">
                    <defs>
                        <filter id="glow">
                            <feGaussianBlur stdDeviation="3" result="blur" />
                            <feMerge>
                                <feMergeNode in="blur" />
                                <feMergeNode in="SourceGraphic" />
                            </feMerge>
                        </filter>
                    </defs>
                    <circle cx="100" cy="100" r="80" stroke="rgba(99,102,241,0.15)" stroke-width="8" fill="none" />
                    <circle class="ring-progress" cx="100" cy="100" r="80" stroke="url(#liquidGrad)" stroke-width="8"
                        fill="none" stroke-dasharray="502" stroke-dashoffset="502" stroke-linecap="round"
                        transform="rotate(-90 100 100)" filter="url(#glow)"
                        style="transition: stroke-dashoffset 0.6s cubic-bezier(0.16,1,0.3,1);" />
                    <linearGradient id="liquidGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#6366f1" />
                        <stop offset="100%" stop-color="#a855f7" />
                    </linearGradient>
                </svg>
                <div class="absolute inset-0 flex items-center justify-center"><span
                        class="ring-percent text-3xl font-bold">0%</span></div>
            </div>
            <form class="card w-full max-w-sm space-y-3" onsubmit="return handleRingSubmit(event, this)">
                <input type="text" class="input ring-input" placeholder="Nom"><input type="email"
                    class="input ring-input" placeholder="Email">
                <textarea class="input ring-input min-h-[100px]" placeholder="Message"></textarea>
                <button type="submit" class="btn">Envoyer</button>
                <div class="success">
                    <div class="success-icon"><i class="fas fa-check text-white text-xl"></i></div>
                    <p class="font-semibold">Scellé !</p>
                </div>
            </form>
        </div>
    </section>

    <!-- 8.3 COMPASS RING -->
    <section id="v3" class="section">
        <span class="tag"><span class="num">8.3</span> Compass Ring</span>
        <div class="flex flex-col lg:flex-row items-center gap-10 max-w-4xl">
            <div class="relative w-52 h-52">
                <svg class="w-full h-full" viewBox="0 0 200 200">
                    <circle cx="100" cy="100" r="85" stroke="rgba(99,102,241,0.2)" stroke-width="2" fill="none" />
                    <circle cx="100" cy="100" r="75" stroke="rgba(99,102,241,0.1)" stroke-width="1" fill="none" />
                    <text x="100" y="25" text-anchor="middle" fill="#64748b" font-size="10">N</text>
                    <text x="180" y="104" text-anchor="middle" fill="#64748b" font-size="10">E</text>
                    <text x="100" y="185" text-anchor="middle" fill="#64748b" font-size="10">S</text>
                    <text x="20" y="104" text-anchor="middle" fill="#64748b" font-size="10">W</text>
                    <line class="needle" x1="100" y1="100" x2="100" y2="35" stroke="#6366f1" stroke-width="3"
                        stroke-linecap="round"
                        style="transform-origin: center; transition: transform 0.5s cubic-bezier(0.16,1,0.3,1);" />
                    <circle cx="100" cy="100" r="8" fill="#1e1b4b" stroke="#6366f1" stroke-width="2" />
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center mt-6">
                    <span class="text-[10px] text-gray-500 uppercase tracking-widest">Progress</span>
                    <span class="ring-percent text-2xl font-bold">0%</span>
                </div>
            </div>
            <form class="card w-full max-w-sm space-y-3" onsubmit="return handleRingSubmit(event, this)">
                <input type="text" class="input ring-input" placeholder="Nom" data-angle="0">
                <input type="email" class="input ring-input" placeholder="Email" data-angle="90">
                <textarea class="input ring-input min-h-[100px]" placeholder="Message" data-angle="180"></textarea>
                <button type="submit" class="btn">Envoyer</button>
                <div class="success">
                    <div class="success-icon"><i class="fas fa-check text-white text-xl"></i></div>
                    <p class="font-semibold">Direction OK !</p>
                </div>
            </form>
        </div>
    </section>

    <!-- 8.4 SPLIT REVEAL -->
    <section id="v4" class="section">
        <span class="tag"><span class="num">8.4</span> Ring + Split Reveal</span>
        <div class="flex flex-col lg:flex-row items-center gap-10 max-w-4xl">
            <div class="relative w-52 h-52">
                <svg class="w-full h-full" viewBox="0 0 200 200">
                    <circle cx="100" cy="100" r="80" stroke="rgba(99,102,241,0.15)" stroke-width="6" fill="none" />
                    <circle class="ring-progress" cx="100" cy="100" r="80" stroke="#6366f1" stroke-width="6" fill="none"
                        stroke-dasharray="502" stroke-dashoffset="502" stroke-linecap="round"
                        transform="rotate(-90 100 100)" style="transition: stroke-dashoffset 0.5s;" />
                </svg>
                <div class="absolute inset-0 flex items-center justify-center"><span
                        class="ring-percent text-3xl font-bold">0%</span></div>
            </div>
            <form class="card w-full max-w-sm space-y-3 relative overflow-hidden"
                onsubmit="return handleRingSubmit(event, this)">
                <input type="text" class="input ring-input reveal-field" placeholder="Nom" style="opacity:1;">
                <input type="email" class="input ring-input reveal-field" placeholder="Email"
                    style="opacity:0.3; filter:blur(2px);">
                <textarea class="input ring-input reveal-field min-h-[100px]" placeholder="Message"
                    style="opacity:0.3; filter:blur(2px);"></textarea>
                <button type="submit" class="btn">Envoyer</button>
                <div class="success">
                    <div class="success-icon"><i class="fas fa-check text-white text-xl"></i></div>
                    <p class="font-semibold">Révélé !</p>
                </div>
            </form>
        </div>
    </section>

    <!-- 8.5 ECLIPSE RING -->
    <section id="v5" class="section">
        <span class="tag"><span class="num">8.5</span> Eclipse Ring</span>
        <div class="flex flex-col lg:flex-row items-center gap-10 max-w-4xl">
            <div class="relative w-52 h-52">
                <svg class="w-full h-full" viewBox="0 0 200 200">
                    <defs>
                        <radialGradient id="halo">
                            <stop offset="70%" stop-color="transparent" />
                            <stop offset="100%" stop-color="rgba(99,102,241,0.3)" />
                        </radialGradient>
                    </defs>
                    <circle cx="100" cy="100" r="85" fill="url(#halo)" />
                    <circle cx="100" cy="100" r="80" stroke="rgba(99,102,241,0.1)" stroke-width="6" fill="none" />
                    <circle class="ring-progress" cx="100" cy="100" r="80" stroke="#6366f1" stroke-width="6" fill="none"
                        stroke-dasharray="502" stroke-dashoffset="502" stroke-linecap="round"
                        transform="rotate(-90 100 100)" style="transition: stroke-dashoffset 0.5s;" />
                    <circle class="moon" cx="60" cy="60" r="35" fill="#0a0e1a"
                        style="transition: all 0.6s cubic-bezier(0.16,1,0.3,1);" />
                </svg>
                <div class="absolute inset-0 flex items-center justify-center"><span
                        class="ring-percent text-3xl font-bold">0%</span></div>
            </div>
            <form class="card w-full max-w-sm space-y-3" onsubmit="return handleRingSubmit(event, this)">
                <input type="text" class="input ring-input" placeholder="Nom"><input type="email"
                    class="input ring-input" placeholder="Email">
                <textarea class="input ring-input min-h-[100px]" placeholder="Message"></textarea>
                <button type="submit" class="btn">Envoyer</button>
                <div class="success">
                    <div class="success-icon"><i class="fas fa-check text-white text-xl"></i></div>
                    <p class="font-semibold">Éclipse !</p>
                </div>
            </form>
        </div>
    </section>

    <!-- 8.6 RING LADDER -->
    <section id="v6" class="section">
        <span class="tag"><span class="num">8.6</span> Ring Ladder</span>
        <div class="flex flex-col lg:flex-row items-center gap-10 max-w-4xl">
            <div class="flex items-center gap-6">
                <div class="relative w-44 h-44">
                    <svg class="w-full h-full" viewBox="0 0 200 200">
                        <circle cx="100" cy="100" r="75" stroke="rgba(99,102,241,0.15)" stroke-width="6" fill="none" />
                        <circle class="ring-progress" cx="100" cy="100" r="75" stroke="#6366f1" stroke-width="6"
                            fill="none" stroke-dasharray="471" stroke-dashoffset="471" stroke-linecap="round"
                            transform="rotate(-90 100 100)" style="transition: stroke-dashoffset 0.5s;" />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center"><span
                            class="ring-percent text-2xl font-bold">0%</span></div>
                </div>
                <div class="flex flex-col gap-3">
                    <div class="step flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-gray-700 step-dot"></div><span
                            class="text-xs text-gray-500">Nom</span>
                    </div>
                    <div class="step flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-gray-700 step-dot"></div><span
                            class="text-xs text-gray-500">Email</span>
                    </div>
                    <div class="step flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-gray-700 step-dot"></div><span
                            class="text-xs text-gray-500">Message</span>
                    </div>
                </div>
            </div>
            <form class="card w-full max-w-sm space-y-3" onsubmit="return handleRingSubmit(event, this)">
                <input type="text" class="input ring-input" placeholder="Nom" data-step="0">
                <input type="email" class="input ring-input" placeholder="Email" data-step="1">
                <textarea class="input ring-input min-h-[100px]" placeholder="Message" data-step="2"></textarea>
                <button type="submit" class="btn">Envoyer</button>
                <div class="success">
                    <div class="success-icon"><i class="fas fa-check text-white text-xl"></i></div>
                    <p class="font-semibold">Complet !</p>
                </div>
            </form>
        </div>
    </section>

    <!-- 8.7 KINETIC PARALLAX -->
    <section id="v7" class="section">
        <span class="tag"><span class="num">8.7</span> Kinetic Parallax</span>
        <div class="flex flex-col lg:flex-row items-center gap-10 max-w-4xl">
            <div class="kinetic-card relative w-56 h-56 rounded-2xl overflow-hidden"
                style="background: linear-gradient(135deg, rgba(99,102,241,0.1), rgba(139,92,246,0.05)); border: 1px solid rgba(99,102,241,0.2); perspective: 1000px;">
                <div class="kinetic-inner absolute inset-0 flex items-center justify-center"
                    style="transition: transform 0.3s ease;">
                    <svg class="w-40 h-40" viewBox="0 0 200 200">
                        <circle cx="100" cy="100" r="80" stroke="rgba(99,102,241,0.2)" stroke-width="6" fill="none" />
                        <circle class="ring-progress" cx="100" cy="100" r="80" stroke="#6366f1" stroke-width="6"
                            fill="none" stroke-dasharray="502" stroke-dashoffset="502" stroke-linecap="round"
                            transform="rotate(-90 100 100)" style="transition: stroke-dashoffset 0.5s;" />
                    </svg>
                    <div class="absolute"><span class="ring-percent text-2xl font-bold">0%</span></div>
                </div>
            </div>
            <form class="card w-full max-w-sm space-y-3" onsubmit="return handleRingSubmit(event, this)">
                <input type="text" class="input ring-input" placeholder="Nom"><input type="email"
                    class="input ring-input" placeholder="Email">
                <textarea class="input ring-input min-h-[100px]" placeholder="Message"></textarea>
                <button type="submit" class="btn">Envoyer</button>
                <div class="success">
                    <div class="success-icon"><i class="fas fa-check text-white text-xl"></i></div>
                    <p class="font-semibold">Scellé !</p>
                </div>
            </form>
        </div>
    </section>

    <!-- 8.8 CURSOR MAGNET -->
    <section id="v8" class="section">
        <span class="tag"><span class="num">8.8</span> Cursor Magnet</span>
        <div class="flex flex-col lg:flex-row items-center gap-10 max-w-4xl">
            <div class="magnet-ring relative w-52 h-52">
                <svg class="w-full h-full" viewBox="0 0 200 200">
                    <circle cx="100" cy="100" r="80" stroke="rgba(99,102,241,0.15)" stroke-width="6" fill="none" />
                    <circle class="ring-progress" cx="100" cy="100" r="80" stroke="#6366f1" stroke-width="6" fill="none"
                        stroke-dasharray="502" stroke-dashoffset="502" stroke-linecap="round"
                        transform="rotate(-90 100 100)" style="transition: stroke-dashoffset 0.5s;" />
                    <circle class="spark" cx="100" cy="20" r="3" fill="#a855f7" opacity="0" />
                </svg>
                <div class="absolute inset-0 flex items-center justify-center"><span
                        class="ring-percent text-3xl font-bold">0%</span></div>
            </div>
            <form class="card w-full max-w-sm space-y-3" onsubmit="return handleRingSubmit(event, this)">
                <input type="text" class="input ring-input magnet-input" placeholder="Nom" data-arc="0">
                <input type="email" class="input ring-input magnet-input" placeholder="Email" data-arc="120">
                <textarea class="input ring-input magnet-input min-h-[100px]" placeholder="Message"
                    data-arc="240"></textarea>
                <button type="submit" class="btn">Envoyer</button>
                <div class="success">
                    <div class="success-icon"><i class="fas fa-check text-white text-xl"></i></div>
                    <p class="font-semibold">Magnétisé !</p>
                </div>
            </form>
        </div>
    </section>

    <script>
        gsap.registerPlugin(ScrollTrigger);

        // Update ring progress
        document.querySelectorAll('.section').forEach(section => {
            const inputs = section.querySelectorAll('.ring-input');
            const ring = section.querySelector('.ring-progress');
            const percent = section.querySelector('.ring-percent');
            const label = section.querySelector('.ring-label');
            const steps = section.querySelectorAll('.step-dot');
            const moon = section.querySelector('.moon');
            const revealFields = section.querySelectorAll('.reveal-field');

            inputs.forEach((input, i) => {
                input.addEventListener('input', () => {
                    let filled = 0;
                    inputs.forEach(inp => { if (inp.value.trim()) filled++; });
                    const pct = Math.round((filled / inputs.length) * 100);
                    const dashLen = parseFloat(ring.getAttribute('stroke-dasharray'));
                    ring.style.strokeDashoffset = dashLen - (dashLen * pct / 100);
                    if (percent) percent.textContent = pct + '%';

                    // Steps (8.6)
                    if (steps.length) {
                        inputs.forEach((inp, idx) => {
                            steps[idx].style.background = inp.value.trim() ? '#6366f1' : '#374151';
                        });
                    }

                    // Moon (8.5)
                    if (moon) {
                        const offset = 40 + (pct * 0.6);
                        moon.setAttribute('cx', offset);
                        moon.setAttribute('cy', offset);
                    }

                    // Reveal (8.4)
                    if (revealFields.length) {
                        revealFields.forEach((f, idx) => {
                            if (idx === 0 || (idx === 1 && pct >= 33) || (idx === 2 && pct >= 66)) {
                                f.style.opacity = '1';
                                f.style.filter = 'blur(0)';
                            }
                        });
                    }
                });

                input.addEventListener('focus', () => {
                    if (label) label.textContent = input.placeholder;
                    // Compass needle (8.3)
                    const needle = section.querySelector('.needle');
                    if (needle && input.dataset.angle) {
                        needle.style.transform = `rotate(${input.dataset.angle}deg)`;
                    }
                });
            });
        });

        // Kinetic parallax (8.7)
        document.querySelectorAll('.kinetic-card').forEach(card => {
            card.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = (e.clientX - rect.left - rect.width / 2) / rect.width * 8;
                const y = (e.clientY - rect.top - rect.height / 2) / rect.height * 8;
                card.querySelector('.kinetic-inner').style.transform = `rotateY(${x}deg) rotateX(${-y}deg)`;
            });
            card.addEventListener('mouseleave', () => {
                card.querySelector('.kinetic-inner').style.transform = 'rotateY(0) rotateX(0)';
            });
        });

        // Form submit
        function handleRingSubmit(e, form) {
            e.preventDefault();
            const btn = form.querySelector('.btn');
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>';
            btn.disabled = true;

            const ring = form.closest('.section').querySelector('.ring-progress');
            const percent = form.closest('.section').querySelector('.ring-percent');
            const dashLen = parseFloat(ring.getAttribute('stroke-dasharray'));
            ring.style.strokeDashoffset = '0';
            if (percent) percent.textContent = '100%';

            setTimeout(() => {
                form.querySelectorAll('input, textarea, .btn').forEach(el => el.style.display = 'none');
                form.querySelector('.success').classList.add('show');
            }, 1200);
            return false;
        }

        // Scroll animations
        document.querySelectorAll('.section').forEach(section => {
            ScrollTrigger.create({
                trigger: section,
                start: 'top 80%',
                onEnter: () => {
                    const ring = section.querySelector('.ring-progress');
                    if (ring) gsap.fromTo(ring, { strokeDashoffset: 502 }, { strokeDashoffset: 502, duration: 0 });
                    gsap.from(section.querySelector('.card'), { opacity: 0, y: 16, duration: 0.6, ease: 'power3.out' });
                }
            });
        });

        // Nav active
        window.addEventListener('scroll', () => {
            document.querySelectorAll('.section').forEach(s => {
                const link = document.querySelector(`.nav a[href="#${s.id}"]`);
                if (link) link.classList.toggle('active', s.getBoundingClientRect().top < 300 && s.getBoundingClientRect().bottom > 300);
            });
        });
    </script>
</body>

</html>