<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camil Belmehdi | Portfolio Pro</title>
    <meta name="description"
        content="Portfolio de Camil Belmehdi, Développeur Web & Automation. Etudiant en BUT Informatique.">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1',
                        secondary: '#a855f7',
                        dark: '#0f172a',
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/skills.css">
    <link rel="stylesheet" href="assets/css/projects-lab.css">
    <link rel="stylesheet" href="assets/css/collection.css">
    <link rel="stylesheet" href="assets/css/about-lab.css">
    <link rel="stylesheet" href="assets/css/about-journey.css">
    <link rel="stylesheet" href="assets/css/netflix-saga.css">
    <link rel="stylesheet" href="assets/css/cinema-reveal.css">
    <link rel="stylesheet" href="assets/css/awwwards-cards.css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS/GSAP -->
    <style>
        /* Loader Styles */
        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #0f172a;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out, visibility 0.5s;
        }

        .loader-hidden {
            opacity: 0;
            visibility: hidden;
        }
    </style>
    <script src="assets/js/transition-manager.js"></script>
</head>

<body class="bg-dark text-slate-100 overflow-x-hidden antialiased">

    <!-- Shared Flame Text SVG Defs -->
    <svg id="flame-shared-defs" style="position:absolute;width:0;height:0;overflow:hidden" aria-hidden="true">
        <defs>
            <linearGradient id="ft-grad-stroke" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" stop-color="#818cf8" />
                <stop offset="50%" stop-color="#c084fc" />
                <stop offset="100%" stop-color="#f472b6" />
            </linearGradient>
            <linearGradient id="ft-grad-flame" x1="0%" y1="100%" x2="0%" y2="0%">
                <stop offset="0%" stop-color="#4338ca">
                    <animate attributeName="stop-color" values="#4338ca;#4f46e5;#4338ca" dur="2s"
                        repeatCount="indefinite" />
                </stop>
                <stop offset="30%" stop-color="#7c3aed">
                    <animate attributeName="stop-color" values="#7c3aed;#8b5cf6;#7c3aed" dur="1.4s"
                        repeatCount="indefinite" />
                </stop>
                <stop offset="55%" stop-color="#c084fc">
                    <animate attributeName="stop-color" values="#c084fc;#e879f9;#c084fc" dur="1s"
                        repeatCount="indefinite" />
                </stop>
                <stop offset="80%" stop-color="#f472b6">
                    <animate attributeName="stop-color" values="#f472b6;#fb7185;#ec4899;#f472b6" dur="0.7s"
                        repeatCount="indefinite" />
                </stop>
                <stop offset="100%" stop-color="#fbbf24">
                    <animate attributeName="stop-color" values="#fbbf24;#fde68a;#f59e0b;#fbbf24" dur="0.5s"
                        repeatCount="indefinite" />
                </stop>
            </linearGradient>
            <filter id="ft-flame-fx" x="-10%" y="-40%" width="120%" height="180%">
                <feTurbulence type="fractalNoise" baseFrequency="0.018 0.06" numOctaves="3" stitchTiles="stitch"
                    result="noise" />
                <feOffset in="noise" result="rising">
                    <animate attributeName="dy" from="0" to="-50" dur="2s" repeatCount="indefinite" />
                </feOffset>
                <feDisplacementMap in="SourceGraphic" in2="rising" scale="5" xChannelSelector="R" yChannelSelector="G"
                    result="warped" />
                <feGaussianBlur in="warped" stdDeviation="2.5" result="glow" />
                <feColorMatrix in="glow" type="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 0.45 0"
                    result="soft-glow" />
                <feMerge>
                    <feMergeNode in="soft-glow" />
                    <feMergeNode in="warped" />
                </feMerge>
            </filter>
        </defs>
    </svg>

    <!-- Custom Cursor -->
    <div class="cursor-dot hidden md:block"></div>
    <div class="cursor-outline hidden md:block"></div>

    <!-- Loader -->
    <div id="loader" class="loader-container">
        <h1 class="text-4xl md:text-6xl font-bold tracking-tighter animate-pulse">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">CB.</span>
        </h1>
    </div>

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-nav transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex-shrink-0 cursor-pointer" onclick="window.scrollTo(0,0)">
                    <span
                        class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">Camil.B</span>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="#about"
                            class="hover:text-primary transition-colors duration-300 px-3 py-2 rounded-md text-sm font-medium">À
                            propos</a>
                        <a href="#skills"
                            class="hover:text-primary transition-colors duration-300 px-3 py-2 rounded-md text-sm font-medium">Compétences</a>
                        <a href="#projects"
                            class="hover:text-primary transition-colors duration-300 px-3 py-2 rounded-md text-sm font-medium">Projets</a>

                        <a href="#contact"
                            class="px-4 py-2 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 transition-all duration-300 text-sm font-bold shadow-lg shadow-indigo-500/30">Me
                            Contacter</a>
                    </div>
                </div>
                <div class="-mr-2 flex md:hidden">
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none"
                        aria-controls="mobile-menu" aria-expanded="false" id="mobile-menu-btn">
                        <span class="sr-only">Open main menu</span>
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden hidden bg-slate-900 border-b border-gray-800" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#about"
                    class="block px-3 py-2 rounded-md text-base font-medium hover:text-primary hover:bg-gray-800">À
                    propos</a>
                <a href="#skills"
                    class="block px-3 py-2 rounded-md text-base font-medium hover:text-primary hover:bg-gray-800">Compétences</a>
                <a href="#projects"
                    class="block px-3 py-2 rounded-md text-base font-medium hover:text-primary hover:bg-gray-800">Projets</a>

                <a href="#contact" class="block px-3 py-2 rounded-md text-base font-medium text-primary font-bold">Me
                    Contacter</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home"
        class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden optimize-gpu">
        <!-- Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 optimize-filter">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl animate-blob"></div>
            <div
                class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-600/20 rounded-full blur-3xl animate-blob animation-delay-2000">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col-reverse md:flex-row items-center gap-12">
            <div class="w-full md:w-1/2 space-y-6 text-center md:text-left z-10" id="hero-text">
                <p class="text-primary font-medium tracking-wider uppercase text-sm gs-reveal">Portfolio 2025</p>
                <h1 class="gs-reveal" style="line-height:1.1">
                    <svg id="hero-name-svg" class="hero-name-svg" aria-label="Camil Belmehdi">
                        <defs>
                            <!-- Trait initial pour le tracé -->
                            <linearGradient id="hero-grad-stroke" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#818cf8" />
                                <stop offset="50%" stop-color="#c084fc" />
                                <stop offset="100%" stop-color="#f472b6" />
                            </linearGradient>

                            <!-- Gradient flamme vertical : base stable, pointes vives -->
                            <linearGradient id="hero-grad-flame" x1="0%" y1="100%" x2="0%" y2="0%">
                                <stop offset="0%" stop-color="#4338ca">
                                    <animate attributeName="stop-color" values="#4338ca;#4f46e5;#4338ca" dur="2s"
                                        repeatCount="indefinite" />
                                </stop>
                                <stop offset="30%" stop-color="#7c3aed">
                                    <animate attributeName="stop-color" values="#7c3aed;#8b5cf6;#7c3aed" dur="1.4s"
                                        repeatCount="indefinite" />
                                </stop>
                                <stop offset="55%" stop-color="#c084fc">
                                    <animate attributeName="stop-color" values="#c084fc;#e879f9;#c084fc" dur="1s"
                                        repeatCount="indefinite" />
                                </stop>
                                <stop offset="80%" stop-color="#f472b6">
                                    <animate attributeName="stop-color" values="#f472b6;#fb7185;#ec4899;#f472b6"
                                        dur="0.7s" repeatCount="indefinite" />
                                </stop>
                                <stop offset="100%" stop-color="#fbbf24">
                                    <animate attributeName="stop-color" values="#fbbf24;#fde68a;#f59e0b;#fbbf24"
                                        dur="0.5s" repeatCount="indefinite" />
                                </stop>
                            </linearGradient>

                            <!-- Filtre flamme : turbulence + déplacement + glow -->
                            <filter id="flame-filter" x="-10%" y="-40%" width="120%" height="180%">
                                <feTurbulence type="fractalNoise" baseFrequency="0.018 0.06" numOctaves="3"
                                    stitchTiles="stitch" result="noise" />
                                <feOffset in="noise" result="rising">
                                    <animate attributeName="dy" from="0" to="-50" dur="2s" repeatCount="indefinite" />
                                </feOffset>
                                <feDisplacementMap in="SourceGraphic" in2="rising" scale="5" xChannelSelector="R"
                                    yChannelSelector="G" result="warped" />
                                <feGaussianBlur in="warped" stdDeviation="2.5" result="glow" />
                                <feColorMatrix in="glow" type="matrix"
                                    values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 0.45 0" result="soft-glow" />
                                <feMerge>
                                    <feMergeNode in="soft-glow" />
                                    <feMergeNode in="warped" />
                                </feMerge>
                            </filter>

                            <!-- Clip progressif pour révélation gauche → droite -->
                            <clipPath id="flame-clip">
                                <rect id="flame-clip-rect" x="0" y="-300" width="0" height="800" />
                            </clipPath>
                        </defs>

                        <!-- Couche 1 : trait pour le tracé initial -->
                        <text id="hero-name-stroke" font-family="'Outfit', sans-serif" font-weight="700" fill="none"
                            stroke="url(#hero-grad-stroke)" stroke-width="1.5">Camil Belmehdi</text>

                        <!-- Couche 2 : flamme, révélée progressivement via clipPath -->
                        <text id="hero-name-flame" font-family="'Outfit', sans-serif" font-weight="700"
                            fill="url(#hero-grad-flame)" filter="url(#flame-filter)" clip-path="url(#flame-clip)"
                            opacity="0">Camil Belmehdi</text>
                    </svg>
                </h1>
                <script>
                        (function () {
                            var svg = document.getElementById('hero-name-svg');
                            var strokeEl = document.getElementById('hero-name-stroke');
                            var flameEl = document.getElementById('hero-name-flame');
                            var clipRect = document.getElementById('flame-clip-rect');
                            if (!svg || !strokeEl || !flameEl || !clipRect) return;

                            document.fonts.ready.then(function () {
                                var fontSize = window.innerWidth >= 768 ? 72 : 48;
                                strokeEl.setAttribute('font-size', fontSize);
                                flameEl.setAttribute('font-size', fontSize);

                                var bbox = strokeEl.getBBox();
                                svg.setAttribute('viewBox',
                                    (bbox.x - 4) + ' ' + (bbox.y - 10) + ' ' + (bbox.width + 8) + ' ' + (bbox.height + 16));

                                // Positionner le clip rect sur la zone du texte
                                clipRect.setAttribute('x', bbox.x - 20);

                                var dashLen = 5000;
                                strokeEl.style.strokeDasharray = dashLen;
                                strokeEl.style.strokeDashoffset = dashLen;

                                setTimeout(function () {
                                    // Phase 1 : tracé du contour
                                    strokeEl.animate([
                                        { strokeDashoffset: dashLen },
                                        { strokeDashoffset: 0 }
                                    ], { duration: 2500, easing: 'ease-in-out', fill: 'forwards' });

                                    // Phase 2 : ignition progressive gauche → droite
                                    setTimeout(function () {
                                        flameEl.setAttribute('opacity', '1');

                                        // Révélation progressive du clip
                                        var totalW = bbox.width + 40;
                                        var revealStart = performance.now();
                                        var revealDur = 2000;
                                        function revealStep(now) {
                                            var t = Math.min((now - revealStart) / revealDur, 1);
                                            var ease = t < 0.5 ? 2 * t * t : 1 - Math.pow(-2 * t + 2, 2) / 2;
                                            clipRect.setAttribute('width', totalW * ease);
                                            if (t < 1) requestAnimationFrame(revealStep);
                                        }
                                        requestAnimationFrame(revealStep);

                                        // Extinction du trait
                                        strokeEl.animate([
                                            { strokeOpacity: 1 },
                                            { strokeOpacity: 0 }
                                        ], { duration: 1200, fill: 'forwards' });

                                        // Ondulation douce
                                        svg.classList.add('flame-on');
                                    }, 2100);
                                }, 600);
                            });
                        })();
                </script>
                <h2 class="text-xl md:text-2xl text-gray-400 gs-reveal">
                    Développeur Web & <span class="text-white font-semibold">Automation</span>
                </h2>
                <p class="text-gray-400 max-w-lg mx-auto md:mx-0 gs-reveal">
                    Actuellement en 3ème année de BUT Informatique. Je crée des expériences web immersives et
                    j'automatise vos processus métiers.
                </p>

                <div class="flex flex-wrap gap-4 justify-center md:justify-start pt-4 gs-reveal">
                    <a href="#projects"
                        class="group relative px-6 py-3 font-bold text-white rounded-full bg-slate-800 overflow-hidden border border-white/10 transition-all hover:border-primary/50">
                        <div
                            class="absolute inset-0 w-full h-full bg-gradient-to-r from-indigo-500 to-purple-600 opacity-0 group-hover:opacity-20 transition-opacity">
                        </div>
                        <span>Voir mes travaux</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="CV_Belmehdi_Camil_WEB_FullStack.pdf" target="_blank"
                        class="px-6 py-3 font-medium text-gray-300 hover:text-white transition-colors border border-white/5 hover:bg-white/5 rounded-full">
                        <i class="fas fa-download mr-2"></i>Télécharger CV
                    </a>
                </div>
            </div>

            <div class="w-full md:w-1/2 flex justify-center z-10 gs-reveal-img">
                <div class="relative w-64 h-64 md:w-96 md:h-96">
                    <!-- Rotating border rings -->
                    <div
                        class="absolute inset-0 rounded-full border border-indigo-500/30 animate-[spin_10s_linear_infinite]">
                    </div>
                    <div
                        class="absolute -inset-4 rounded-full border border-purple-500/20 animate-[spin_15s_linear_infinite_reverse]">
                    </div>

                    <!-- Image Container -->
                    <div
                        class="relative w-full h-full rounded-full overflow-hidden border-4 border-slate-800 shadow-2xl shadow-indigo-500/20 hero-image-container">
                        <img src="assets/images/Presentation/Photo_Pro.png" alt="Camil Belmehdi"
                            class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-700">
                    </div>

                    <!-- Floating Badge -->
                    <div
                        class="absolute -bottom-4 -right-4 bg-slate-800/90 backdrop-blur-md p-4 rounded-2xl border border-white/10 shadow-xl animate-bounce-slow">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-sm font-medium">Recherche de Stage</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section: Cinematic Odyssey -->
    <section id="about" class="py-20 relative bg-slate-900/50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Identity Profile (Scanner) -->
            <div class="about-module id-scanner mb-32" id="about-01">
                <div class="scanner-card mx-auto optimize-gpu">
                    <!-- Premium: Dual Scan Lines + Grain -->
                    <div class="scanner-line"></div>
                    <div class="scanner-line-primary"></div>
                    <div class="scanner-line-secondary"></div>
                    <div class="scanner-grain"></div>
                    <div class="card-content">
                        <!-- Navigation Arrows -->
                        <button class="step-nav-arrow prev" onclick="AboutDiscovery.prevComponent()"
                            aria-label="Précédent">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="step-nav-arrow next" onclick="AboutDiscovery.nextComponent()"
                            aria-label="Suivant">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                        <!-- Step Stage: Container for sliding/fading steps -->
                        <div class="step-stage">
                            <!-- Step 1: Signature Numérique -->
                            <div class="about-step active" data-step="1">
                                <h2 class="section-title heading-aura bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400 scanner-reveal"
                                    style="opacity:1; transform: translateY(0);">CAMIL BELMEHDI</h2>
                                <p class="text-indigo-400 font-bold mb-12 scanner-reveal tracking-widest text-center"
                                    style="opacity:1; transform: translateY(0);">DÉVELOPPEUR & AUTOMATISATION</p>
                            </div>

                            <!-- Step 2: Données Bio -->
                            <div class="about-step" data-step="2" style="display:none; opacity:0;">
                                <div class="space-y-8 text-gray-300 max-w-2xl mx-auto mb-12">
                                    <div class="system-tag mb-2">NEURAL LINK : ACTIVE</div>
                                    <p class="text-xl leading-relaxed">
                                        Passionné par la fusion entre le <span
                                            class="text-white font-semibold">code</span>
                                        et le <span class="text-white font-semibold">monde réel</span>, j'aime créer des
                                        systèmes qui respirent et s'automatisent.
                                    </p>
                                    <p class="text-xl leading-relaxed">
                                        La <span class="text-indigo-400 font-bold">montagne</span> est mon terrain de
                                        jeu
                                        favori, là où la rigueur de l'ascension rencontre la liberté absolue.
                                    </p>
                                    <div class="flex flex-wrap gap-4 mt-8">
                                        <span class="badge">FR NATIF</span>
                                        <span class="badge">EN C1</span>
                                        <span class="badge">PYRÉNÉISTE</span>
                                        <span class="badge">PHOTOGRAPHIE</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Carousel (Visual Archive) -->
                            <div class="about-step" data-step="3" style="display:none; opacity:0;">
                                <div class="text-center mb-10">
                                    <div class="system-tag mb-4">GALLERY : FRAGMENT_IDENTIFIED</div>
                                    <h3 class="text-2xl font-bold text-white mb-2 tracking-[0.2em]">ARCHIVES DE TERRAIN
                                    </h3>
                                    <p class="text-gray-400 font-mono text-xs uppercase tracking-widest opacity-70">
                                        Rapports de mission • Analyse photogrammétrique</p>
                                </div>

                                <div class="about-carousel-container">
                                    <div class="about-carousel-track">
                                        <div class="about-carousel-item">
                                            <img src="assets/images/Estaragne_pic.png" alt="Estaragne Peak">
                                            <div class="carousel-caption">
                                                <span class="data-tag">IDENT_OBJ :</span> ESTARAGNE — ALT_3012M
                                            </div>
                                        </div>
                                        <div class="about-carousel-item">
                                            <img src="assets/images/Montagne_PP.jpg" alt="Mountain View">
                                            <div class="carousel-caption">
                                                <span class="data-tag">LOC_DATA :</span> PYRÉNÉES CENTRALES
                                            </div>
                                        </div>
                                        <div class="about-carousel-item">
                                            <img src="assets/images/pics_Montagne.png" alt="High Peaks">
                                            <div class="carousel-caption">
                                                <span class="data-tag">OPTIC_RES :</span> FRAGMENT_CELESTE_V1
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-12">
                                    <p class="text-xs text-indigo-500/50 tracking-[0.5em] font-mono">DIAGNOSTIC COMPLET
                                        : 100%</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step Navigation: Discreet and Cinematic -->
                        <div class="about-step-nav mt-12">
                            <div class="step-indicator" data-step="1" onclick="AboutDiscovery.gotoStep(1)"></div>
                            <div class="step-indicator" data-step="2" onclick="AboutDiscovery.gotoStep(2)"></div>
                            <div class="step-indicator" data-step="3" onclick="AboutDiscovery.gotoStep(3)"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vertical Journey: The Path of Innovation -->
            <div class="about-journey-container" id="innovation-path">
                <!-- Film Noise Overlay -->
                <div class="noise-overlay"></div>

                <!-- Ambient Light Beams -->
                <div class="ambient-beams"></div>

                <!-- Rail Glow Layer -->
                <div class="rail-glow"></div>

                <!-- Dust Micro Particles -->
                <div class="dust-particles">
                    <div class="dust-particle" style="left: 20%; animation-delay: 0s;"></div>
                    <div class="dust-particle" style="left: 45%; animation-delay: 4s;"></div>
                    <div class="dust-particle" style="left: 70%; animation-delay: 8s;"></div>
                    <div class="dust-particle" style="left: 85%; animation-delay: 12s;"></div>
                </div>

                <h2 class="section-title heading-aura text-white">
                    MON <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">PARCOURS</span>
                </h2>

                <!-- Camera Rig (dolly wrapper) -->
                <div class="camera-rig" id="camera-rig">

                    <div class="journey-data-line">
                        <div class="journey-data-progress" id="journey-progress"></div>
                    </div>

                    <!-- Milestone 1: Awakening -->
                    <div class="journey-pod left" data-pod="1">
                        <div class="pod-node"></div>
                        <div class="portal-ring"></div>
                        <div class="pod-card">
                            <div class="pod-glow"></div>
                            <span class="pod-year">2022</span>
                            <h3 class="pod-title text-silver-gradient">BAC STI2D SIN</h3>
                            <p class="pod-desc">Lycée polyvalent Jean Jaurès à Carmaux. L'entrée dans le monde du
                                numérique. Spécialisation SIN (Systèmes
                                d'Information et Numérique) et découverte des premiers langages de programmation.</p>
                        </div>
                        <div class="pod-info">
                            <img src="assets/images/Campus/photo_Lycee_JJ_Cx.jpg" alt="Lycée Jean Jaurès"
                                class="w-full h-48 object-cover rounded-lg border border-white/10 hover:brightness-110 transition-all">
                        </div>
                    </div>

                    <!-- Milestone 2: Foundation -->
                    <div class="journey-pod right" data-pod="2">
                        <div class="pod-node"></div>
                        <div class="portal-ring"></div>
                        <div class="pod-card">
                            <div class="pod-glow"></div>
                            <span class="pod-year">2023 - 2026</span>
                            <h3 class="pod-title text-silver-gradient">BUT INFORMATIQUE</h3>
                            <p class="pod-desc">IUT III Paul-Sabatier à Toulouse. Approfondissement de l'architecture
                                logicielle, des
                                réseaux et de la sécurité. Focus sur le déploiement et la sécurisation d'applications.
                            </p>
                        </div>
                        <div class="pod-info">
                            <img src="assets/images/Campus/Photo_campus_IUT_Toulouse.jpg" alt="Campus IUT Toulouse"
                                class="w-full h-48 object-cover rounded-lg border border-white/10 hover:brightness-110 transition-all">
                        </div>
                    </div>

                    <!-- Milestone 3: Real World (HERO STATION) -->
                    <div class="journey-pod left hero-station" data-pod="3">
                        <div class="pod-node"></div>
                        <div class="portal-ring"></div>
                        <div class="pod-card">
                            <div class="pod-glow"></div>
                            <span class="pod-year">2025 (STAGE)</span>
                            <h3 class="pod-title text-silver-gradient">ADONIS EDUCATION</h3>
                            <p class="pod-desc">Immersion professionnelle. Maintenance de multiples sites web, création
                                de site Wordpress et utilisation de workflow n8n, manipulation d'Api et de bases de
                                données.</p>
                        </div>
                        <div class="pod-info">
                            <img src="assets/images/Campus/Adonis.webp" alt="Adonis Education"
                                class="w-full h-48 object-cover rounded-lg border border-white/10 hover:brightness-110 transition-all">
                        </div>
                    </div>

                    <!-- Milestone 4: Present -->
                    <div class="journey-pod right" data-pod="4">
                        <div class="pod-node"></div>
                        <div class="portal-ring"></div>
                        <div class="pod-card">
                            <div class="pod-glow"></div>
                            <span class="pod-year">2025 - 2026</span>
                            <h3 class="pod-title text-silver-gradient">Freelance & Innovation</h3>
                            <div class="pod-desc space-y-3">
                                <p><strong class="text-indigo-400">Belmehdi WebDev :</strong> Vente de sites vitrines &
                                    solutions d'automatisation sur-mesure.</p>
                                <p><strong class="text-indigo-400">R&D Personnel :</strong> Développement de SaaS et
                                    finalisation du cursus universitaire.</p>
                                <div class="mt-4 p-3 bg-indigo-500/10 border border-indigo-500/20 rounded-lg">
                                    <p class="text-white font-bold text-xs uppercase tracking-wider mb-1">Objectif
                                        Prioritaire</p>
                                    <p class="text-indigo-300 text-sm">Recherche active d'un stage à partir du <span
                                            class="text-white">2 Mars 2026</span>.</p>
                                </div>
                            </div>
                        </div>
                        <div class="pod-info">
                            <img src="assets/images/Presentation/Photo_Pro.png" alt="Camil Belmehdi"
                                class="w-full h-48 object-cover rounded-lg border border-white/10 hover:brightness-110 transition-all">
                        </div>
                    </div>
                </div><!-- /camera-rig -->

            </div><!-- /about-journey-container -->
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-20 relative bg-slate-900/50 overflow-hidden optimize-gpu">
        <!-- Vertical Data Bridge -->
        <div class="journey-data-line skills-bridge">
            <div class="journey-data-progress" id="bridge-progress"></div>
        </div>

        <canvas id="skills-canvas"></canvas>
        <!-- Background Decor -->
        <div
            class="absolute right-0 top-1/4 w-1/3 h-1/2 bg-indigo-900/10 blur-[100px] pointer-events-none optimize-filter">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2
                class="section-title heading-aura bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">
                Compétences</h2>
            <p class="text-center text-gray-400 mb-12 max-w-2xl mx-auto">Passez sur les icones des langages pour montrer
                les compétences que j'ai acquises</p>

            <!-- Skills Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6"
                onmouseleave="SkillsCloudInstance.manualLeave()">
                <!-- HTML5 -->
                <div class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-pointer"
                    onmouseenter="SkillsCloudInstance.manualSelect('html')">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" alt="HTML5"
                        class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-silver-gradient">HTML5</span>
                </div>

                <!-- CSS3 -->
                <div class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-pointer"
                    onmouseenter="SkillsCloudInstance.manualSelect('css')">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" alt="CSS3"
                        class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-silver-gradient">CSS3</span>
                </div>

                <!-- JavaScript -->
                <div class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-pointer"
                    onmouseenter="SkillsCloudInstance.manualSelect('js')">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg"
                        alt="JavaScript" class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-silver-gradient">JavaScript</span>
                </div>

                <!-- PHP -->
                <div class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-pointer"
                    onmouseenter="SkillsCloudInstance.manualSelect('php')">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP"
                        class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-silver-gradient">PHP</span>
                </div>

                <!-- Tailwind -->
                <div class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-pointer"
                    onmouseenter="SkillsCloudInstance.manualSelect('tailwind')">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/tailwindcss/tailwindcss-original.svg"
                        alt="Tailwind" class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-silver-gradient">Tailwind</span>
                </div>

                <!-- Python -->
                <div class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-pointer"
                    onmouseenter="SkillsCloudInstance.manualSelect('python')">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg"
                        alt="Python" class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-silver-gradient">Python</span>
                </div>

                <!-- MySQL -->
                <div class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-pointer"
                    onmouseenter="SkillsCloudInstance.manualSelect('mysql')">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" alt="MySQL"
                        class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-silver-gradient">MySQL</span>
                </div>

                <!-- Java -->
                <div class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-pointer"
                    onmouseenter="SkillsCloudInstance.manualSelect('java')">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-original.svg" alt="Java"
                        class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-silver-gradient">Java</span>
                </div>

                <!-- Linux -->
                <div class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-pointer"
                    onmouseenter="SkillsCloudInstance.manualSelect('linux')">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/linux/linux-original.svg" alt="Linux"
                        class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-silver-gradient">Linux</span>
                </div>

                <!-- Docker -->
                <div class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-pointer"
                    onmouseenter="SkillsCloudInstance.manualSelect('docker')">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg"
                        alt="Docker" class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-silver-gradient">Docker</span>
                </div>

                <!-- n8n -->
                <div class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-pointer"
                    onmouseenter="SkillsCloudInstance.manualSelect('automation')">
                    <img src="https://n8n.io/favicon.ico" alt="n8n"
                        class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-silver-gradient">n8n</span>
                </div>

                <!-- OpenAI -->
                <div class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-pointer"
                    onmouseenter="SkillsCloudInstance.manualSelect('ai')">
                    <svg class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90" viewBox="0 0 24 24"
                        fill="white">
                        <path
                            d="M22.282 9.821a5.985 5.985 0 0 0-.516-4.91 6.046 6.046 0 0 0-6.51-2.9A6.065 6.065 0 0 0 4.981 4.18a5.985 5.985 0 0 0-3.998 2.9 6.046 6.046 0 0 0 .743 7.097 5.98 5.98 0 0 0 .51 4.911 6.051 6.051 0 0 0 6.515 2.9A5.985 5.985 0 0 0 13.26 24a6.056 6.056 0 0 0 5.772-4.206 5.99 5.99 0 0 0 3.997-2.9 6.056 6.056 0 0 0-.747-7.073zM13.26 22.43a4.476 4.476 0 0 1-2.876-1.04l.141-.081 4.779-2.758a.795.795 0 0 0 .392-.681v-6.737l2.02 1.168a.071.071 0 0 1 .038.052v5.583a4.504 4.504 0 0 1-4.494 4.494zM3.6 18.304a4.476 4.476 0 0 1-.535-3.014l.142.085 4.783 2.759a.771.771 0 0 0 .78 0l5.843-3.369v2.332a.08.08 0 0 1-.033.062L9.74 19.95a4.5 4.5 0 0 1-6.14-1.646zM2.34 7.896a4.485 4.485 0 0 1 2.366-1.973V11.6a.766.766 0 0 0 .388.676l5.815 3.355-2.02 1.168a.076.076 0 0 1-.071 0l-4.83-2.786A4.504 4.504 0 0 1 2.34 7.896zm16.597 3.855l-5.833-3.387L15.119 7.2a.076.076 0 0 1 .071 0l4.83 2.791a4.494 4.494 0 0 1-.676 8.105v-5.678a.79.79 0 0 0-.407-.667zm2.01-3.023l-.141-.085-4.774-2.782a.776.776 0 0 0-.785 0L9.409 9.23V6.897a.066.066 0 0 1 .028-.061l4.83-2.787a4.5 4.5 0 0 1 6.68 4.66zm-12.64 4.135l-2.02-1.164a.08.08 0 0 1-.038-.057V6.075a4.5 4.5 0 0 1 7.375-3.453l-.142.08L8.704 5.46a.795.795 0 0 0-.393.681zm1.097-2.365l2.602-1.5 2.607 1.5v2.999l-2.597 1.5-2.607-1.5z" />
                    </svg>
                    <span class="font-bold text-silver-gradient">OpenAI</span>
                </div>
            </div>
        </div>

        <!-- Skill Description Card (Typewriter Effect) -->
        <div id="skill-typewriter-display"
            style="position: absolute; bottom: 5%; left: 50%; transform: translateX(-50%); z-index: 9999; opacity: 0; pointer-events: none;">
        </div>
    </section>

    <!-- Projects Section - Netflix Saga (HIDDEN) -->
    <section id="projects" class="hidden py-20 relative bg-slate-900/50 overflow-hidden">
        <!-- Film grain overlay -->
        <div class="netflix-grain"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Netflix-style Header -->
            <div class="text-center mb-20">
                <p class="text-red-500 font-bold tracking-[0.3em] text-sm uppercase mb-4">COLLECTION 2025</p>
                <h2 class="section-title heading-aura text-silver-gradient netflix-title">
                    Ma Saga de Projets
                </h2>
                <p class="text-gray-400 text-lg md:text-xl italic max-w-2xl mx-auto">
                    "J'ai toujours rêvé d'avoir mes propres affiches de film"
                </p>
            </div>

            <!-- Movie Posters Row -->
            <div id="netflix-saga" class="netflix-posters-container">

                <!-- Poster 1: Pastel Builder -->
                <div class="netflix-poster-wrapper" data-index="0">
                    <div class="netflix-poster">
                        <div class="poster-image"
                            style="background-image: url('https://images.unsplash.com/photo-1551650975-87deedd944c3?q=80&w=800');">
                        </div>
                        <div class="poster-overlay"></div>
                        <div class="poster-rating">9.2</div>
                        <div class="poster-bottom">
                            <span class="poster-genre block mb-1">Site-Builder No-Code</span>
                            <h3 class="poster-title">PASTEL<br>BUILDER</h3>
                        </div>
                        <div class="poster-play">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <!-- Description floats to the RIGHT -->
                    <div class="poster-description right-side">
                        <span class="desc-tag">PHP / GSAP / Tailwind</span>
                        <h4 class="desc-title text-silver-gradient">Site-Builder No-Code</h4>
                        <p class="desc-text">Un générateur de sites web avec système de modules et thèmes
                            personnalisables. Interface drag & drop et prévisualisation en temps réel.</p>
                        <a href="projets/pastel-builder" class="desc-btn">
                            <i class="fas fa-play mr-2"></i> Voir le projet
                        </a>
                    </div>
                </div>

                <!-- Poster 2: API Automation -->
                <div class="netflix-poster-wrapper" data-index="1">
                    <div class="netflix-poster">
                        <div class="poster-image"
                            style="background-image: url('https://images.unsplash.com/photo-1558494949-ef010cbdcc31?q=80&w=800');">
                        </div>
                        <div class="poster-overlay"></div>
                        <div class="poster-rating">8.7</div>
                        <div class="poster-bottom">
                            <span class="poster-genre">AUTOMATION • 2024</span>
                            <h3 class="poster-title">API<br>AUTOMATION</h3>
                        </div>
                        <div class="poster-play">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <!-- Description floats to the LEFT -->
                    <div class="poster-description left-side">
                        <span class="desc-tag">n8n / Make / Webhooks</span>
                        <h4 class="desc-title">Workflows Automatisés</h4>
                        <p class="desc-text">Orchestration de processus métiers complexes. Intégrations API,
                            synchronisation de données et automatisation des tâches répétitives.</p>
                        <a href="projets/api-automation" class="desc-btn">
                            <i class="fas fa-play mr-2"></i> Voir le projet
                        </a>
                    </div>
                </div>

                <!-- Poster 3: AI Agents -->
                <div class="netflix-poster-wrapper" data-index="2">
                    <div class="netflix-poster">
                        <div class="poster-image"
                            style="background-image: url('https://images.unsplash.com/photo-1677442136019-21780ecad995?q=80&w=800');">
                        </div>
                        <div class="poster-overlay"></div>
                        <div class="poster-rating">9.5</div>
                        <div class="poster-bottom">
                            <span class="poster-genre">INTELLIGENCE • 2025</span>
                            <h3 class="poster-title">AI<br>AGENTS</h3>
                        </div>
                        <div class="poster-play">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <!-- Description floats to the RIGHT -->
                    <div class="poster-description right-side">
                        <span class="desc-tag">Python / LLM / Cursor</span>
                        <h4 class="desc-title">Agents Intelligents</h4>
                        <p class="desc-text">Développement d'agents autonomes basés sur les LLMs. Automatisation
                            cognitive et systèmes de décision intelligents.</p>
                        <a href="projets/ai-agents" class="desc-btn">
                            <i class="fas fa-play mr-2"></i> Voir le projet
                        </a>
                    </div>
                </div>

                <!-- Poster 4: Data Dashboard -->
                <div class="netflix-poster-wrapper" data-index="3">
                    <div class="netflix-poster">
                        <div class="poster-image"
                            style="background-image: url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=800');">
                        </div>
                        <div class="poster-overlay"></div>
                        <div class="poster-rating">8.9</div>
                        <div class="poster-bottom">
                            <span class="poster-genre">DATA VIZ • 2024</span>
                            <h3 class="poster-title">DATA<br>DASHBOARD</h3>
                        </div>
                        <div class="poster-play">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <!-- Description floats to the LEFT -->
                    <div class="poster-description left-side">
                        <span class="desc-tag">React / D3.js / Charts</span>
                        <h4 class="desc-title">Visualisation Temps Réel</h4>
                        <p class="desc-text">Dashboard analytique avec graphiques interactifs. Monitoring de métriques
                            et tableaux de bord personnalisables.</p>
                        <a href="projets/data-dashboard" class="desc-btn">
                            <i class="fas fa-play mr-2"></i> Voir le projet
                        </a>
                    </div>
                </div>

            </div>

            <!-- Letterbox effect -->
            <div class="netflix-letterbox">
                <div class="bar top"></div>
                <div class="bar bottom"></div>
                <!-- Canvas for Cloud -->
                <canvas id="skills-canvas" class="w-full h-full"></canvas>
            </div>
        </div>
    </section>

    <!-- Projects Gallery -->
    <section id="projects-gallery" class="py-20 relative bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="section-title heading-aura text-white">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">Projets </span><span
                    id="project-type-text"
                    class="bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">Professionnels</span><span
                    class="text-indigo-400 animate-pulse">|</span>
            </h2>
            <script>
                (function () {
                    const words = ['Professionnels', 'Universitaires'];
                    let wordIndex = 0;
                    let charIndex = words[0].length;
                    let isDeleting = true;
                    const el = document.getElementById('project-type-text');
                    if (!el) return;

                    function type() {
                        const currentWord = words[wordIndex];

                        if (isDeleting) {
                            el.textContent = currentWord.substring(0, charIndex - 1);
                            charIndex--;
                        } else {
                            el.textContent = currentWord.substring(0, charIndex + 1);
                            charIndex++;
                        }

                        let delay = isDeleting ? 40 : 80;

                        if (!isDeleting && charIndex === currentWord.length) {
                            delay = 3000;
                            isDeleting = true;
                        } else if (isDeleting && charIndex === 0) {
                            isDeleting = false;
                            wordIndex = (wordIndex + 1) % words.length;
                            delay = 400;
                        }

                        setTimeout(type, delay);
                    }

                    setTimeout(type, 3000);
                })();
            </script>
            <div id="cinema-demo" class="no-letterbox cinema-rows">

                <!-- Row 1: Pastel Builder -->
                <div class="cinema-row">
                    <div class="cinema-card">
                        <div class="card-bg"
                            style="background-image: url('https://images.unsplash.com/photo-1551650975-87deedd944c3?q=80&w=800');">
                        </div>
                        <div class="card-vignette"></div>
                        <div class="card-content">
                            <span class="aww-card-tag">PHP / GSAP</span>
                            <h4 class="aww-card-title text-silver-gradient">PASTEL BUILDER</h4>
                        </div>
                    </div>
                    <div class="cinema-desc">
                        <div class="flex flex-col items-start mb-6">
                            <span class="desc-tag mb-3">Site-Builder No-Code</span>
                            <h4 class="desc-title text-silver-gradient" style="display: block !important;">Pastel
                                Builder</h4>
                        </div>
                        <p class="desc-text">Un générateur de sites web avec système de modules et thèmes
                            personnalisables. Interface drag & drop et prévisualisation en temps réel.</p>
                        <span class="desc-btn" style="cursor: default; opacity: 0.6;"><i class="fas fa-clock mr-2"></i>
                            Bientôt disponible</span>
                    </div>
                </div>

                <!-- Row 2: Fluidanse.org — Avant / Après -->
                <div class="cinema-row reverse">
                    <div class="ba-card-fluid" id="beforeAfterFluidanse">
                        <img src="assets/images/projets/fluidanse/Fluidanse-après.png" alt="Fluidanse après"
                            class="ba-img ba-before" draggable="false">
                        <img src="assets/images/projets/fluidanse/Fluidanse-avant.png" alt="Fluidanse avant"
                            class="ba-img ba-after" draggable="false">
                        <div class="ba-slider" id="baSlider" style="left:5%;">
                            <svg class="ba-organic-svg" viewBox="0 0 60 500" preserveAspectRatio="none">
                                <defs>
                                    <filter id="ba-warp" x="-80%" y="-5%" width="260%" height="110%">
                                        <feTurbulence type="fractalNoise" baseFrequency="0.015 0.08" numOctaves="4"
                                            stitchTiles="stitch" result="noise">
                                            <animate attributeName="seed" from="0" to="200" dur="12s"
                                                repeatCount="indefinite" />
                                        </feTurbulence>
                                        <feDisplacementMap in="SourceGraphic" in2="noise" scale="18"
                                            xChannelSelector="R" yChannelSelector="G" />
                                    </filter>
                                    <filter id="ba-shadow" x="-100%" y="-5%" width="300%" height="110%">
                                        <feTurbulence type="fractalNoise" baseFrequency="0.012 0.06" numOctaves="3"
                                            stitchTiles="stitch" result="noise2">
                                            <animate attributeName="seed" from="50" to="250" dur="10s"
                                                repeatCount="indefinite" />
                                        </feTurbulence>
                                        <feDisplacementMap in="SourceGraphic" in2="noise2" scale="25"
                                            xChannelSelector="R" yChannelSelector="G" result="warped" />
                                        <feGaussianBlur in="warped" stdDeviation="8" result="glow" />
                                        <feMerge>
                                            <feMergeNode in="glow" />
                                            <feMergeNode in="warped" />
                                        </feMerge>
                                    </filter>
                                </defs>
                                <!-- Shadow / halo layer -->
                                <line x1="30" y1="-20" x2="30" y2="520" stroke="rgba(99,102,241,0.25)" stroke-width="14"
                                    filter="url(#ba-shadow)" stroke-linecap="round" />
                                <!-- Outer glow -->
                                <line x1="30" y1="-20" x2="30" y2="520" stroke="rgba(139,92,246,0.15)" stroke-width="6"
                                    filter="url(#ba-warp)" stroke-linecap="round" />
                                <!-- Core line -->
                                <line x1="30" y1="-20" x2="30" y2="520" stroke="rgba(255,255,255,0.5)"
                                    stroke-width="1.5" filter="url(#ba-warp)" stroke-linecap="round" />
                            </svg>
                        </div>
                        <span class="ba-label ba-label-after">APRÈS</span>
                        <span class="ba-label ba-label-before">AVANT</span>
                    </div>
                    <div class="cinema-desc">
                        <div class="flex flex-col items-start mb-6">
                            <span class="desc-tag mb-3">Refonte Web Complète</span>
                            <h4 class="desc-title text-silver-gradient" style="display: block !important;">Fluidanse.org
                            </h4>
                        </div>
                        <p class="desc-text">Refonte complète du site vitrine d'une école de danse. Nouveau design
                            moderne,
                            responsive, avec animations et optimisation SEO.</p>
                        <a href="https://fluidanse.org" target="_blank" rel="noopener" class="desc-btn">
                            <i class="fas fa-external-link-alt mr-2"></i>Voir le site</a>
                    </div>
                </div>

                <!-- Row 3: Delfoin Multiservices -->
                <div class="cinema-row">
                    <div class="cinema-card">
                        <div class="card-bg"
                            style="background-image: url('assets/images/projets/delfoin-multiservices.png');">
                        </div>
                        <div class="card-vignette"></div>
                        <div class="card-content">
                            <span class="aww-card-tag">PHP / JS / Tailwind</span>
                            <h4 class="aww-card-title text-silver-gradient">DELFOIN MULTISERVICES</h4>
                        </div>
                    </div>
                    <div class="cinema-desc">
                        <div class="flex flex-col items-start mb-6">
                            <span class="desc-tag mb-3">Site Vitrine Professionnel</span>
                            <h4 class="desc-title text-silver-gradient" style="display: block !important;">Delfoin
                                Multiservices</h4>
                        </div>
                        <p class="desc-text">Site web professionnel pour une entreprise multiservices. Design sur
                            mesure,
                            formulaire de contact et présentation des prestations.</p>
                        <a href="https://delfoin-multiservices.onrender.com" target="_blank" rel="noopener"
                            class="desc-btn">
                            <i class="fas fa-external-link-alt mr-2"></i>Voir le site</a>
                    </div>
                </div>

                <!-- Row 4: API Automation -->
                <div class="cinema-row reverse">
                    <div class="cinema-card">
                        <div class="card-bg"
                            style="background-image: url('https://images.unsplash.com/photo-1558494949-ef010cbdcc31?q=80&w=800');">
                        </div>
                        <div class="card-vignette"></div>
                        <div class="card-content">
                            <span class="aww-card-tag">n8n / Make</span>
                            <h4 class="aww-card-title text-silver-gradient">API AUTOMATION</h4>
                        </div>
                    </div>
                    <div class="cinema-desc">
                        <div class="flex flex-col items-start mb-6">
                            <span class="desc-tag mb-3">Workflows Automatisés</span>
                            <h4 class="desc-title text-silver-gradient" style="display: block !important;">API
                                Automation</h4>
                        </div>
                        <p class="desc-text">Orchestration de processus métiers complexes. Intégrations API,
                            synchronisation de données et automatisation des tâches répétitives.</p>
                        <span class="desc-btn" style="cursor: default; opacity: 0.6;"><i class="fas fa-clock mr-2"></i>
                            Bientôt disponible</span>
                    </div>
                </div>

            </div>

            <!-- Before/After Slider CSS + JS -->
            <style>
                /* ---- Fluid organic before/after card ---- */
                .ba-card-fluid {
                    position: relative;
                    width: 560px;
                    height: 380px;
                    flex-shrink: 0;
                    cursor: none;
                    overflow: hidden;
                    border-radius: 30% 70% 66% 34% / 40% 30% 70% 60%;
                    animation: baBlobMorph 12s ease-in-out infinite;
                    box-shadow: 0 8px 60px -12px rgba(99, 102, 241, 0.35);
                    transition: box-shadow 0.5s ease;
                    will-change: border-radius;
                    isolation: isolate;
                    -webkit-backface-visibility: hidden;
                    backface-visibility: hidden;
                }

                .ba-card-fluid:hover {
                    box-shadow: 0 12px 80px -10px rgba(99, 102, 241, 0.55);
                }

                @keyframes baBlobMorph {

                    0%,
                    100% {
                        border-radius: 30% 70% 66% 34% / 40% 30% 70% 60%;
                    }

                    25% {
                        border-radius: 58% 42% 36% 64% / 52% 68% 32% 48%;
                    }

                    50% {
                        border-radius: 34% 66% 54% 46% / 64% 38% 62% 36%;
                    }

                    75% {
                        border-radius: 62% 38% 44% 56% / 36% 58% 42% 64%;
                    }
                }

                .ba-card-fluid .ba-img {
                    position: absolute;
                    inset: 0;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    pointer-events: none;
                }

                .ba-card-fluid .ba-before {
                    z-index: 1;
                }

                .ba-card-fluid .ba-after {
                    z-index: 2;
                }

                .ba-card-fluid .ba-slider {
                    position: absolute;
                    top: 0;
                    bottom: 0;
                    width: 60px;
                    z-index: 3;
                    transform: translateX(-50%);
                    pointer-events: none;
                }

                .ba-organic-svg {
                    position: absolute;
                    inset: -20px -10px;
                    width: calc(100% + 20px);
                    height: calc(100% + 40px);
                }

                .ba-card-fluid .ba-label {
                    position: absolute;
                    top: 16px;
                    z-index: 4;
                    padding: 5px 14px;
                    border-radius: 20px;
                    font-size: 0.6rem;
                    font-weight: 700;
                    text-transform: uppercase;
                    letter-spacing: 0.15em;
                    pointer-events: none;
                    backdrop-filter: blur(8px);
                }

                .ba-card-fluid .ba-label-before {
                    right: 20px;
                    background: rgba(239, 68, 68, 0.6);
                    color: #fff;
                    border: 1px solid rgba(239, 68, 68, 0.3);
                }

                .ba-card-fluid .ba-label-after {
                    left: 20px;
                    background: rgba(34, 197, 94, 0.6);
                    color: #fff;
                    border: 1px solid rgba(34, 197, 94, 0.3);
                }

                @media (max-width: 1100px) {
                    .ba-card-fluid {
                        width: 100%;
                        max-width: 560px;
                        height: 320px;
                    }
                }

                @media (max-width: 640px) {
                    .ba-card-fluid {
                        height: 240px;
                    }
                }
            </style>
            <script>
                (function () {
                    var wrap = document.getElementById('beforeAfterFluidanse');
                    var slider = document.getElementById('baSlider');
                    var after = wrap ? wrap.querySelector('.ba-after') : null;
                    if (!wrap || !slider || !after) return;

                    var current = 0.05;
                    var target = 0.05;
                    var ease = 0.08;
                    var feather = 10;
                    var running = false;
                    var startTime = 0;

                    var cycleDur = 4500;
                    var pauseFrac = 0.1;

                    function autoTarget(now) {
                        var elapsed = (now - startTime) % cycleDur;
                        var t = elapsed / cycleDur;
                        // Plateau at extremes, smooth sine in between
                        if (t < pauseFrac) {
                            return 0.05;
                        } else if (t < 0.5 - pauseFrac) {
                            var p = (t - pauseFrac) / (0.5 - 2 * pauseFrac);
                            return 0.05 + 0.9 * (0.5 - 0.5 * Math.cos(p * Math.PI));
                        } else if (t < 0.5 + pauseFrac) {
                            return 0.95;
                        } else if (t < 1.0 - pauseFrac) {
                            var p = (t - 0.5 - pauseFrac) / (0.5 - 2 * pauseFrac);
                            return 0.95 - 0.9 * (0.5 - 0.5 * Math.cos(p * Math.PI));
                        } else {
                            return 0.05;
                        }
                    }

                    function applyMask(pct) {
                        var p = pct * 100;
                        var lo = Math.max(0, p - feather);
                        var hi = Math.min(100, p + feather);
                        after.style.webkitMaskImage = 'linear-gradient(to right, black ' + lo + '%, transparent ' + hi + '%)';
                        after.style.maskImage = 'linear-gradient(to right, black ' + lo + '%, transparent ' + hi + '%)';
                    }

                    applyMask(current);

                    function render(now) {
                        if (!running) return;
                        target = autoTarget(now);
                        current += (target - current) * ease;
                        slider.style.left = (current * 100) + '%';
                        applyMask(current);
                        requestAnimationFrame(render);
                    }

                    // Start animation when card enters viewport
                    var obs = new IntersectionObserver(function (entries) {
                        if (entries[0].isIntersecting && !running) {
                            running = true;
                            startTime = performance.now();
                            requestAnimationFrame(render);
                        } else if (!entries[0].isIntersecting) {
                            running = false;
                        }
                    }, { threshold: 0.2 });
                    obs.observe(wrap);
                })();
            </script>
        </div>
    </section>

    <!-- Contact Section - Progress Ring -->
    <section id="contact" class="py-20 relative overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12">
                <h2 class="section-title heading-aura text-white">
                    Travaillons <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">Ensemble</span>
                </h2>
                <p class="text-gray-400">Une idée ? Un projet ? Ou simplement envie de discuter ?</p>
            </div>

            <div class="flex flex-col lg:flex-row items-center justify-center gap-12">
                <!-- Progress Ring -->
                <div class="relative w-48 h-48 flex-shrink-0">
                    <svg class="w-full h-full transform -rotate-90">
                        <circle cx="96" cy="96" r="88" stroke="rgba(99,102,241,0.2)" stroke-width="8" fill="none" />
                        <circle id="contact-progress-ring" cx="96" cy="96" r="88" stroke="#6366f1" stroke-width="8"
                            fill="none" stroke-dasharray="553" stroke-dashoffset="553" stroke-linecap="round"
                            class="transition-all duration-500" />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span id="contact-progress-percent" class="text-3xl font-bold text-white">0%</span>
                    </div>

                    <!-- Contact Direct -->
                    <div
                        class="absolute -bottom-20 left-1/2 -translate-x-1/2 text-center text-xs text-gray-500 whitespace-nowrap">
                        <p class="font-semibold text-indigo-400 mb-2">Contact Direct</p>
                        <p class="hover:text-white cursor-pointer transition-colors"
                            onclick="copyContactText('camil.belmehdi@etu.iut-tlse3.fr')">
                            <i class="fas fa-envelope mr-1"></i> camil.belmehdi@etu.iut-tlse3.fr
                        </p>
                        <p class="mt-1"><i class="fas fa-map-marker-alt mr-1"></i> Toulouse / Albi</p>
                        <p class="mt-1 hover:text-white cursor-pointer transition-colors"
                            onclick="copyContactText('+33 6 63 06 38 17')">
                            <i class="fas fa-phone mr-1"></i> +33 6 63 06 38 17
                        </p>
                    </div>
                </div>

                <!-- Form -->
                <div class="flex-1 w-full max-w-md">
                    <form id="contact-ring-form"
                        class="bg-slate-800/50 backdrop-blur-xl p-8 rounded-2xl border border-white/5 space-y-4">
                        <div>
                            <input type="text" name="name"
                                class="contact-ring-input w-full px-4 py-3 rounded-xl bg-dark/50 border border-white/10 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all outline-none"
                                placeholder="Votre nom" oninput="updateContactRingProgress()">
                        </div>
                        <div>
                            <input type="email" name="email"
                                class="contact-ring-input w-full px-4 py-3 rounded-xl bg-dark/50 border border-white/10 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all outline-none"
                                placeholder="Votre email" oninput="updateContactRingProgress()">
                        </div>
                        <div>
                            <textarea name="message"
                                class="contact-ring-input w-full px-4 py-3 rounded-xl bg-dark/50 border border-white/10 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all outline-none min-h-[120px]"
                                placeholder="Votre message" oninput="updateContactRingProgress()"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full py-4 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 font-bold text-white shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:scale-[1.02] transition-all duration-300 flex justify-center items-center gap-2">
                            <span>Envoyer</span>
                            <i class="fas fa-paper-plane"></i>
                        </button>

                        <div id="contact-form-success" class="hidden text-center py-6">
                            <div class="w-16 h-16 mx-auto bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mb-4"
                                style="animation: successPop 0.5s ease-out;">
                                <i class="fas fa-check text-white text-2xl"></i>
                            </div>
                            <p class="text-lg font-semibold text-white">Message envoyé !</p>
                            <p class="text-gray-400 text-sm mt-1">Je vous réponds rapidement.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function updateContactRingProgress() {
                const form = document.getElementById('contact-ring-form');
                const inputs = form.querySelectorAll('.contact-ring-input');
                let filled = 0;
                inputs.forEach(input => {
                    if (input.value.trim()) filled++;
                });
                const percent = Math.round((filled / inputs.length) * 100);
                const offset = 553 - (553 * percent / 100);
                document.getElementById('contact-progress-ring').style.strokeDashoffset = offset;
                document.getElementById('contact-progress-percent').textContent = percent + '%';
            }

            function copyContactText(text) {
                navigator.clipboard.writeText(text).then(() => {
                    const toast = document.createElement('div');
                    toast.className = 'fixed bottom-4 right-4 bg-indigo-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
                    toast.textContent = 'Copié : ' + text;
                    document.body.appendChild(toast);
                    setTimeout(() => toast.remove(), 2000);
                });
            }

            document.getElementById('contact-ring-form').addEventListener('submit', function (e) {
                e.preventDefault();
                const form = this;
                const btn = form.querySelector('button[type="submit"]');
                btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>';
                btn.disabled = true;

                setTimeout(() => {
                    form.querySelectorAll('input, textarea, button').forEach(el => el.style.display = 'none');
                    document.getElementById('contact-form-success').classList.remove('hidden');
                    document.getElementById('contact-progress-ring').style.strokeDashoffset = 0;
                    document.getElementById('contact-progress-percent').textContent = '100%';
                }, 1500);
            });
        </script>

        <style>
            @keyframes successPop {
                0% {
                    transform: scale(0);
                }

                50% {
                    transform: scale(1.2);
                }

                100% {
                    transform: scale(1);
                }
            }
        </style>
    </section>

    <footer class="py-6 text-center text-gray-500 text-sm border-t border-white/5 bg-slate-900">
        <p>&copy; 2026 Camil Belmehdi. Fait avec <i class="fas fa-heart text-red-500 mx-1"></i> et beaucoup de café.</p>
    </footer>

    <!-- Scripts -->
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/Flip.min.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/skills-cloud.js"></script>
    <script src="assets/js/skills-cards.js"></script>
    <script src="assets/js/projects-lab.js"></script>
    <script src="assets/js/about-lab.js"></script>
    <script src="assets/js/cinema-reveal.js"></script>
    <script src="assets/js/awwwards-cards.js"></script>
    <script src="assets/js/about-carousel.js"></script>

    <!-- Flame Title System -->
    <script>
        (function () {
            var counter = 0;
            var targets = document.querySelectorAll('[data-flame]');
            if (!targets.length) return;
            var ns = 'http://www.w3.org/2000/svg';

            document.fonts.ready.then(function () {
                targets.forEach(function (el) {
                    var text = el.getAttribute('data-flame');
                    var sizes = (el.getAttribute('data-flame-size') || '48,30').split(',');
                    var weight = el.getAttribute('data-flame-weight') || '700';
                    var fontSize = window.innerWidth >= 768 ? parseInt(sizes[0]) : parseInt(sizes[1]);
                    var id = 'ft-' + (counter++);

                    var svg = document.createElementNS(ns, 'svg');
                    svg.setAttribute('class', 'hero-name-svg');
                    svg.setAttribute('aria-label', text);

                    var defs = document.createElementNS(ns, 'defs');
                    var cp = document.createElementNS(ns, 'clipPath');
                    cp.setAttribute('id', id + '-clip');
                    var cr = document.createElementNS(ns, 'rect');
                    cr.setAttribute('x', '0'); cr.setAttribute('y', '-300');
                    cr.setAttribute('width', '0'); cr.setAttribute('height', '800');
                    cp.appendChild(cr); defs.appendChild(cp); svg.appendChild(defs);

                    var st = document.createElementNS(ns, 'text');
                    st.setAttribute('font-family', "'Outfit', sans-serif");
                    st.setAttribute('font-weight', weight);
                    st.setAttribute('font-size', fontSize);
                    st.setAttribute('fill', 'none');
                    st.setAttribute('stroke', 'url(#ft-grad-stroke)');
                    st.setAttribute('stroke-width', '1.5');
                    st.textContent = text;
                    svg.appendChild(st);

                    var ft = document.createElementNS(ns, 'text');
                    ft.setAttribute('font-family', "'Outfit', sans-serif");
                    ft.setAttribute('font-weight', weight);
                    ft.setAttribute('font-size', fontSize);
                    ft.setAttribute('fill', 'url(#ft-grad-flame)');
                    ft.setAttribute('filter', 'url(#ft-flame-fx)');
                    ft.setAttribute('clip-path', 'url(#' + id + '-clip)');
                    ft.setAttribute('opacity', '0');
                    ft.textContent = text;
                    svg.appendChild(ft);

                    el.textContent = '';
                    el.appendChild(svg);

                    var bbox = st.getBBox();
                    svg.setAttribute('viewBox',
                        (bbox.x - 4) + ' ' + (bbox.y - 10) + ' ' + (bbox.width + 8) + ' ' + (bbox.height + 16));
                    cr.setAttribute('x', bbox.x - 20);

                    var dashLen = 5000;
                    st.style.strokeDasharray = dashLen;
                    st.style.strokeDashoffset = dashLen;

                    var animated = false;
                    var obs = new IntersectionObserver(function (entries) {
                        if (entries[0].isIntersecting && !animated) {
                            animated = true;
                            st.animate([
                                { strokeDashoffset: dashLen },
                                { strokeDashoffset: 0 }
                            ], { duration: 2000, easing: 'ease-in-out', fill: 'forwards' });

                            setTimeout(function () {
                                ft.setAttribute('opacity', '1');
                                var totalW = bbox.width + 40;
                                var revealStart = performance.now();
                                var revealDur = 1500;
                                function revealStep(now) {
                                    var t = Math.min((now - revealStart) / revealDur, 1);
                                    var e = t < 0.5 ? 2 * t * t : 1 - Math.pow(-2 * t + 2, 2) / 2;
                                    cr.setAttribute('width', totalW * e);
                                    if (t < 1) requestAnimationFrame(revealStep);
                                }
                                requestAnimationFrame(revealStep);

                                st.animate([
                                    { strokeOpacity: 1 },
                                    { strokeOpacity: 0 }
                                ], { duration: 1000, fill: 'forwards' });

                                svg.classList.add('flame-on');
                            }, 1700);
                        }
                    }, { threshold: 0.3 });
                    obs.observe(el);
                });
            });
        })();
    </script>
</body>

</html>