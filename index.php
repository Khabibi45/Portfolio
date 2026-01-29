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
</head>

<body class="bg-dark text-slate-100 overflow-x-hidden antialiased">

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
                        <a href="forms.php"
                            class="hover:text-secondary text-secondary transition-colors duration-300 px-3 py-2 rounded-md text-sm font-bold"><i
                                class="fas fa-flask mr-1"></i> Labo / Forms</a>
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
                <a href="forms.php"
                    class="block px-3 py-2 rounded-md text-base font-medium text-secondary hover:bg-gray-800"><i
                        class="fas fa-flask mr-1"></i> Labo / Forms</a>
                <a href="#contact" class="block px-3 py-2 rounded-md text-base font-medium text-primary font-bold">Me
                    Contacter</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl animate-blob"></div>
            <div
                class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-600/20 rounded-full blur-3xl animate-blob animation-delay-2000">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col-reverse md:flex-row items-center gap-12">
            <div class="w-full md:w-1/2 space-y-6 text-center md:text-left z-10" id="hero-text">
                <p class="text-primary font-medium tracking-wider uppercase text-sm gs-reveal">Portfolio 2025</p>
                <h1 class="text-5xl md:text-7xl font-bold leading-tight gs-reveal">
                    <span class="text-gradient">Camil Belmehdi</span>
                </h1>
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
                        <img src="Montagne_PP.jpg" alt="Camil Belmehdi"
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
                <div class="scanner-card mx-auto">
                    <div class="scanner-line"></div>
                    <div class="card-content">
                        <h2 class="text-5xl font-black mb-2 scanner-reveal"
                            style="opacity:0; transform: translateY(20px);">CAMIL BELMEHDI</h2>
                        <p class="text-indigo-400 font-bold mb-6 scanner-reveal"
                            style="opacity:0; transform: translateY(20px);">DÉVELOPPEUR & AUTOMATISATION</p>

                        <div class="space-y-4 text-gray-300">
                            <p class="scanner-reveal" style="opacity:0; transform: translateY(20px);">Passionné par le
                                Développement et l’Automatisation</p>
                            <p class="scanner-reveal" style="opacity:0; transform: translateY(20px);">BUT Informatique
                                (Sécurisation d’Applications) — IUT Paul Sabatier</p>
                        </div>

                        <div class="flex gap-4 mt-8">
                            <span class="scanner-reveal badge" style="opacity:0; transform: translateY(20px);">FR
                                NATIF</span>
                            <span class="scanner-reveal badge" style="opacity:0; transform: translateY(20px);">EN
                                C1</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vertical Journey: The Path of Innovation -->
            <div class="about-journey-container" id="innovation-path">
                <h2 class="text-6xl font-black text-center mb-20 tracking-tighter">THE PATH OF INNOVATION</h2>

                <div class="journey-data-line">
                    <div class="journey-data-progress" id="journey-progress"></div>
                </div>

                <!-- Milestone 1: Awakening -->
                <div class="journey-pod left" data-pod="1">
                    <div class="pod-node"></div>
                    <div class="pod-card">
                        <span class="pod-year">2018 - 2021</span>
                        <h3 class="pod-title">BAC STI2D SIN</h3>
                        <p class="pod-desc">L'entrée dans le monde du numérique. Spécialisation SIN (Systèmes
                            d'Information et Numérique) et découverte des premiers langages de programmation.</p>
                    </div>
                    <div class="pod-info">
                        <span class="info-label">FIRST COMMIT</span>
                        <span class="info-metric">HELLO WORLD</span>
                    </div>
                </div>

                <!-- Milestone 2: Foundation -->
                <div class="journey-pod right" data-pod="2">
                    <div class="pod-node"></div>
                    <div class="pod-card">
                        <span class="pod-year">2021 - 2024</span>
                        <h3 class="pod-title">BUT INFORMATIQUE</h3>
                        <p class="pod-desc">IUT Paul-Sabatier. Approfondissement de l'architecture logicielle, des
                            réseaux et de la sécurité. Focus sur le déploiement et la sécurisation d'applications.</p>
                    </div>
                    <div class="pod-info">
                        <span class="info-label">ALGORITHMS</span>
                        <span class="info-metric">O(log n)</span>
                    </div>
                </div>

                <!-- Milestone 3: Real World -->
                <div class="journey-pod left" data-pod="3">
                    <div class="pod-node"></div>
                    <div class="pod-card">
                        <span class="pod-year">2023 (STAGE)</span>
                        <h3 class="pod-title">ADONIS EDUCATION</h3>
                        <p class="pod-desc">Immersion professionnelle. Maintenance d'API complexes, automatisation de
                            workflows critiques et gestion d'écosystèmes scalables.</p>
                    </div>
                    <div class="pod-info">
                        <span class="info-label">AUTOMATION</span>
                        <span class="info-metric">95% FLOWS</span>
                    </div>
                </div>

                <!-- Milestone 4: Present -->
                <div class="journey-pod right" data-pod="4">
                    <div class="pod-node"></div>
                    <div class="pod-card">
                        <span class="pod-year">2025 & BEYOND</span>
                        <h3 class="pod-title">ELITE AUTOMATION</h3>
                        <p class="pod-desc">Développement d'agents intelligents et de systèmes autonomes. Toujours à la
                            recherche du prochain défi d'ingénierie.</p>
                    </div>
                    <div class="pod-info">
                        <span class="info-label">CURRENT STATUS</span>
                        <span class="info-metric">ACTIVE SEARCH</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-20 relative bg-slate-900/50 overflow-hidden">
        <!-- Vertical Data Bridge -->
        <div class="journey-data-line skills-bridge">
            <div class="journey-data-progress" id="bridge-progress"></div>
        </div>

        <canvas id="skills-canvas"></canvas>
        <!-- Background Decor -->
        <div class="absolute right-0 top-1/4 w-1/3 h-1/2 bg-indigo-900/10 blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-5xl font-bold text-center mb-4">Compétences</h2>
            <p class="text-center text-gray-400 mb-12 max-w-2xl mx-auto">Cliquez sur une compétence pour mettre en
                évidence les projets associés. (Transitivité)</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Frontend -->
                <div
                    class="skill-card bg-white/5 rounded-2xl p-6 border border-white/5 hover:border-white/10 transition-all">
                    <h3 class="text-xl font-bold mb-6 flex items-center gap-2"><i class="fas fa-code text-primary"></i>
                        Développement Web</h3>
                    <div class="flex flex-wrap gap-3">
                        <button
                            class="skill-tag px-4 py-2 rounded-lg bg-slate-800 border border-white/10 hover:bg-slate-700 text-sm"
                            data-skill="html">HTML5 / CSS3</button>
                        <button
                            class="skill-tag px-4 py-2 rounded-lg bg-slate-800 border border-white/10 hover:bg-slate-700 text-sm"
                            data-skill="js">JavaScript</button>
                        <button
                            class="skill-tag px-4 py-2 rounded-lg bg-slate-800 border border-white/10 hover:bg-slate-700 text-sm"
                            data-skill="php">PHP</button>
                        <button
                            class="skill-tag px-4 py-2 rounded-lg bg-slate-800 border border-white/10 hover:bg-slate-700 text-sm"
                            data-skill="tailwind">Tailwind</button>
                    </div>
                </div>

                <!-- Backend & Data -->
                <div
                    class="skill-card bg-white/5 rounded-2xl p-6 border border-white/5 hover:border-white/10 transition-all">
                    <h3 class="text-xl font-bold mb-6 flex items-center gap-2"><i
                            class="fas fa-database text-secondary"></i> Backend & Data</h3>
                    <div class="flex flex-wrap gap-3">
                        <button
                            class="skill-tag px-4 py-2 rounded-lg bg-slate-800 border border-white/10 hover:bg-slate-700 text-sm"
                            data-skill="sql">PL/SQL & MySQL</button>
                        <button
                            class="skill-tag px-4 py-2 rounded-lg bg-slate-800 border border-white/10 hover:bg-slate-700 text-sm"
                            data-skill="java">Java</button>
                        <button
                            class="skill-tag px-4 py-2 rounded-lg bg-slate-800 border border-white/10 hover:bg-slate-700 text-sm"
                            data-skill="linux">Linux</button>
                    </div>
                </div>

                <!-- Automation & Tools -->
                <div
                    class="skill-card bg-white/5 rounded-2xl p-6 border border-white/5 hover:border-white/10 transition-all">
                    <h3 class="text-xl font-bold mb-6 flex items-center gap-2"><i
                            class="fas fa-robot text-pink-500"></i> Automation & IA</h3>
                    <div class="flex flex-wrap gap-3">
                        <button
                            class="skill-tag px-4 py-2 rounded-lg bg-slate-800 border border-white/10 hover:bg-slate-700 text-sm"
                            data-skill="automation">n8n / Make</button>
                        <button
                            class="skill-tag px-4 py-2 rounded-lg bg-slate-800 border border-white/10 hover:bg-slate-700 text-sm"
                            data-skill="python">Python</button>
                        <button
                            class="skill-tag px-4 py-2 rounded-lg bg-slate-800 border border-white/10 hover:bg-slate-700 text-sm"
                            data-skill="ai">Cursor / AI Agents</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-20 relative bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-5xl font-bold text-center mb-16">Mes Projets</h2>

            <!-- UNIFIED COLLECTION SECTION -->
            <div id="collection-hub" class="relative group">
                <div class="collection-hub-inner is-stacked" id="collection-main">

                    <!-- Left: Card Stack -->
                    <div class="collection-stack-container" id="stack-target">
                        <!-- Injected by collection.ui.js -->
                    </div>

                    <!-- Right: Info (Will fade out on explore) -->
                    <div class="collection-info flex-1 transition-all duration-700">
                        <div class="max-w-md">
                            <h3 class="text-xs font-bold text-indigo-400 tracking-widest uppercase mb-2">Portfolio</h3>
                            <h3 class="text-5xl font-black text-white mb-4">WORKS</h3>
                            <p class="text-indigo-200/80 mb-8 text-lg">Découvrez mes réalisations via cette interface
                                immersive.</p>

                            <button class="collection-trigger module-btn !py-3 !px-8">
                                Explorer <i class="fas fa-layer-group ml-1"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Unified Grid Target (Hidden by default, used for FLIP) -->
                <div class="collection-grid mt-10" id="collection-grid-final"></div>
            </div>
        </div>
    </section>
    </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-slate-800/50 backdrop-blur-xl p-8 md:p-12 rounded-3xl border border-white/5 shadow-2xl">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold mb-4">Travaillons Ensemble</h2>
                    <p class="text-gray-400">Une idée ? Un projet ? Ou simplement envie de discuter ?</p>
                </div>

                <form id="contact-form" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="text-sm font-medium text-gray-300">Nom</label>
                            <input type="text" id="name" name="name" required
                                class="form-input w-full px-4 py-3 rounded-xl bg-dark/50 border border-white/10 text-white placeholder-gray-500 focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-medium text-gray-300">Email</label>
                            <input type="email" id="email" name="email" required
                                class="form-input w-full px-4 py-3 rounded-xl bg-dark/50 border border-white/10 text-white placeholder-gray-500 focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="message" class="text-sm font-medium text-gray-300">Message</label>
                        <textarea id="message" name="message" rows="4" required
                            class="form-input w-full px-4 py-3 rounded-xl bg-dark/50 border border-white/10 text-white placeholder-gray-500 focus:border-primary focus:ring-1 focus:ring-primary transition-all"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full py-4 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 font-bold text-white shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:scale-[1.02] transition-all duration-300 flex justify-center items-center gap-2">
                        <span>Envoyer le message</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>

                    <div id="form-response" class="text-center text-sm font-medium hidden"></div>
                </form>

                <div class="mt-12 pt-8 border-t border-white/5 grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                    <div>
                        <div
                            class="w-10 h-10 mx-auto bg-white/5 rounded-full flex items-center justify-center mb-3 text-primary">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <p class="text-sm text-gray-400">camil.belmehdi@etu.iut-tlse3.fr</p>
                    </div>
                    <div>
                        <div
                            class="w-10 h-10 mx-auto bg-white/5 rounded-full flex items-center justify-center mb-3 text-secondary">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <p class="text-sm text-gray-400">Toulouse / Albi</p>
                    </div>
                    <div>
                        <div
                            class="w-10 h-10 mx-auto bg-white/5 rounded-full flex items-center justify-center mb-3 text-pink-500">
                            <i class="fas fa-phone"></i>
                        </div>
                        <p class="text-sm text-gray-400">+33 6 63 06 38 17</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-6 text-center text-gray-500 text-sm border-t border-white/5 bg-slate-900">
        <p>&copy; 2025 Camil Belmehdi. Fait avec <i class="fas fa-heart text-red-500 mx-1"></i> et beaucoup de café.</p>
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

    <!-- Collection Module -->
    <script type="module" src="assets/js/collection.data.js"></script>
    <script type="module" src="assets/js/collection.ui.js"></script>
    <script src="assets/js/collection.animations.js"></script>
</body>

</html>