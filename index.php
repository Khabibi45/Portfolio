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
                <a href="forms.php" class="block px-3 py-2 rounded-md text-base font-medium text-secondary hover:bg-gray-800"><i class="fas fa-flask mr-1"></i> Labo / Forms</a>
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

    <!-- About Section -->
    <section id="about" class="py-20 relative bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-5xl font-bold text-center mb-16"><span
                    class="border-b-4 border-primary/50 pb-2">A Propos</span></h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <h3 class="text-2xl font-bold">Passionné par le Développement et l'Automatisation</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Etudiant en 3ème année de BUT Informatique (Parcours "Déploiement d'Applications Sécurisées") à
                        l'IUT Paul-Sabatier, je combine ma passion pour le code propre avec la puissance de
                        l'automatisation.
                    </p>
                    <p class="text-gray-400 leading-relaxed">
                        Que ce soit pour créer un site vitrine "Haluscinant" ou optimiser des flux de travail complexes
                        avec n8n et Python, je cherche toujours l'excellence et l'efficacité.
                    </p>

                    <div class="grid grid-cols-2 gap-4 pt-4">
                        <div
                            class="p-4 rounded-xl bg-white/5 border border-white/5 hover:border-primary/30 transition-colors">
                            <i class="fas fa-graduation-cap text-2xl text-primary mb-2"></i>
                            <h4 class="font-bold">Formation</h4>
                            <p class="text-sm text-gray-400">BUT Informatique (Toulouse)</p>
                        </div>
                        <div
                            class="p-4 rounded-xl bg-white/5 border border-white/5 hover:border-primary/30 transition-colors">
                            <i class="fas fa-language text-2xl text-secondary mb-2"></i>
                            <h4 class="font-bold">Langues</h4>
                            <p class="text-sm text-gray-400">Français (Natif)<br>Anglais (C1)</p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <!-- Timeline-ish Visual -->
                    <div
                        class="absolute left-8 top-0 bottom-0 w-1 bg-gradient-to-b from-indigo-500 to-transparent opacity-30">
                    </div>
                    <div class="space-y-8 pl-16">
                        <div class="relative group">
                            <div
                                class="absolute -left-[2.85rem] top-1 w-6 h-6 rounded-full bg-slate-900 border-2 border-primary group-hover:scale-125 transition-transform">
                            </div>
                            <h4 class="text-xl font-bold text-white group-hover:text-primary transition-colors">2025 -
                                Aujourd'hui</h4>
                            <p class="text-gray-400">BUT III Informatique - Parcours Sécurité</p>
                            <p class="text-sm text-gray-500 mt-1">Recherche de stage active</p>
                        </div>
                        <div class="relative group">
                            <div
                                class="absolute -left-[2.85rem] top-1 w-6 h-6 rounded-full bg-slate-900 border-2 border-gray-600 group-hover:border-primary transition-colors">
                            </div>
                            <h4 class="text-xl font-bold text-white">Stage - Adonis Education</h4>
                            <p class="text-gray-400">Automatisation, Maintenance & API</p>
                        </div>
                        <div class="relative group">
                            <div
                                class="absolute -left-[2.85rem] top-1 w-6 h-6 rounded-full bg-slate-900 border-2 border-gray-600 group-hover:border-primary transition-colors">
                            </div>
                            <h4 class="text-xl font-bold text-white">Bac STI2D</h4>
                            <p class="text-gray-400">Option Systèmes d'Information et Numérique</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-20 bg-dark relative overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute right-0 top-1/4 w-1/3 h-1/2 bg-indigo-900/10 blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-5xl font-bold text-center mb-4">Compétences</h2>
            <p class="text-center text-gray-400 mb-12 max-w-2xl mx-auto">Cliquez sur une compétence pour mettre en
                évidence les projets associés. (Transitivité)</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Frontend -->
                <div class="bg-white/5 rounded-2xl p-6 border border-white/5 hover:border-white/10 transition-all">
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
                <div class="bg-white/5 rounded-2xl p-6 border border-white/5 hover:border-white/10 transition-all">
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
                <div class="bg-white/5 rounded-2xl p-6 border border-white/5 hover:border-white/10 transition-all">
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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="projects-grid">

                <!-- Project 1 -->
                <div class="project-card group relative h-96 rounded-2xl overflow-hidden cursor-pointer"
                    data-skills="html js php tailwind">
                    <!-- Background Image -->
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                        style="background-image: url('pics_Montagne.png');"></div>
                    <div class="absolute inset-0 bg-dark/70 group-hover:bg-dark/50 transition-colors duration-300">
                    </div>

                    <!-- Content -->
                    <div class="absolute inset-0 p-6 flex flex-col justify-end">
                        <div
                            class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            <div class="flex gap-2 mb-3">
                                <span
                                    class="text-xs px-2 py-1 rounded bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">PHP</span>
                                <span
                                    class="text-xs px-2 py-1 rounded bg-blue-500/20 text-blue-300 border border-blue-500/30">JS</span>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2">Web Builder (Delfoin)</h3>
                            <p
                                class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 mb-4">
                                CMS et builder de site web personnalisé avec gestion drag & drop.
                            </p>
                            <a href="https://delfoin-multiservices.onrender.com" target="_blank"
                                class="inline-flex items-center text-primary font-bold hover:text-white transition-colors">
                                Voir le site <i class="fas fa-external-link-alt ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Project 2 -->
                <div class="project-card group relative h-96 rounded-2xl overflow-hidden cursor-pointer"
                    data-skills="html css js">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-gray-800 to-black transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <div class="absolute inset-0 bg-dark/40 group-hover:bg-dark/20 transition-colors duration-300">
                    </div>

                    <div class="absolute inset-0 p-6 flex flex-col justify-end">
                        <div
                            class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            <div class="flex gap-2 mb-3">
                                <span
                                    class="text-xs px-2 py-1 rounded bg-orange-500/20 text-orange-300 border border-orange-500/30">HTML</span>
                                <span
                                    class="text-xs px-2 py-1 rounded bg-blue-500/20 text-blue-300 border border-blue-500/30">CSS</span>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2">Fluidanse</h3>
                            <p
                                class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 mb-4">
                                Site vitrine pour une association de danse, responsive et moderne.
                            </p>
                            <a href="https://fluidanse.org" target="_blank"
                                class="inline-flex items-center text-primary font-bold hover:text-white transition-colors">
                                Voir le site <i class="fas fa-external-link-alt ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Project 3 -->
                <div class="project-card group relative h-96 rounded-2xl overflow-hidden cursor-pointer"
                    data-skills="python automation ai">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-900 to-slate-900 transition-transform duration-500 group-hover:scale-110">
                    </div>

                    <div class="absolute inset-0 p-6 flex flex-col justify-end">
                        <div
                            class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            <div class="flex gap-2 mb-3">
                                <span
                                    class="text-xs px-2 py-1 rounded bg-green-500/20 text-green-300 border border-green-500/30">Python</span>
                                <span
                                    class="text-xs px-2 py-1 rounded bg-yellow-500/20 text-yellow-300 border border-yellow-500/30">Automation</span>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2">Stage Hunter Bot</h3>
                            <p
                                class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 mb-4">
                                Script Python pour automatiser l'envoi de candidatures et le scraping d'offres.
                            </p>
                            <span class="text-gray-500 text-xs italic">Projet Interne</span>
                        </div>
                    </div>
                </div>

                <!-- Project 4 (Extra for grid balance) -->
                <div class="project-card group relative h-96 rounded-2xl overflow-hidden cursor-pointer"
                    data-skills="automation ai python">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-purple-900 to-slate-900 transition-transform duration-500 group-hover:scale-110">
                    </div>

                    <div class="absolute inset-0 p-6 flex flex-col justify-end">
                        <div
                            class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            <div class="flex gap-2 mb-3">
                                <span
                                    class="text-xs px-2 py-1 rounded bg-pink-500/20 text-pink-300 border border-pink-500/30">n8n</span>
                                <span
                                    class="text-xs px-2 py-1 rounded bg-purple-500/20 text-purple-300 border border-purple-500/30">Instagram</span>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2">InstaAuto Post</h3>
                            <p
                                class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 mb-4">
                                Workflow n8n pour la création et la publication automatique de posts Instagram.
                            </p>
                            <span class="text-gray-500 text-xs italic">Projet Interne</span>
                        </div>
                    </div>
                </div>

            </div>
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

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
</body>

</html>