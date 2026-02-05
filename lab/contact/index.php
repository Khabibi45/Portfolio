<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Lab - 10 Form Concepts | Camil Belmehdi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <link rel="stylesheet" href="contact-lab.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="contact-lab">

    <!-- Back Link -->
    <a href="/" class="back-link">
        <i class="fas fa-arrow-left"></i> Retour
    </a>

    <!-- Quick Nav -->
    <nav class="lab-nav">
        <a href="#concept-1" title="Capsule Dock">1</a>
        <a href="#concept-2" title="Rail Camera">2</a>
        <a href="#concept-3" title="Paper Fold">3</a>
        <a href="#concept-4" title="Constellation">4</a>
        <a href="#concept-5" title="Command Palette">5</a>
        <a href="#concept-6" title="Split Screen">6</a>
        <a href="#concept-7" title="Floating Magnet">7</a>
        <a href="#concept-8" title="Progress Ring">8</a>
        <a href="#concept-9" title="Card Stack">9</a>
        <a href="#concept-10" title="Signature Wave">10</a>
    </nav>

    <!-- ============================================
         CONCEPT 1: CAPSULE DOCK
         ============================================ -->
    <section id="concept-1" class="form-section">
        <span class="section-title"><span class="section-number">1</span> Capsule Dock</span>

        <div class="flex flex-col lg:flex-row items-center gap-8 max-w-4xl w-full">
            <!-- Capsule Form -->
            <div class="capsule-dock flex-1 w-full">
                <div
                    class="capsule-container bg-slate-900/80 backdrop-blur-xl border border-indigo-500/30 rounded-3xl p-8 shadow-2xl">
                    <h3 class="text-2xl font-bold text-white mb-6 text-center">Travaillons Ensemble</h3>

                    <form class="capsule-form space-y-4" onsubmit="handleSubmit(event, this)">
                        <div class="dock-module" style="--delay: 0">
                            <input type="text" name="name" class="form-input" placeholder="Votre nom" required>
                        </div>
                        <div class="dock-module" style="--delay: 1">
                            <input type="email" name="email" class="form-input" placeholder="Votre email" required>
                        </div>
                        <div class="dock-module" style="--delay: 2">
                            <textarea name="message" class="form-input form-textarea" placeholder="Votre message"
                                required></textarea>
                        </div>
                        <button type="submit" class="form-btn w-full relative overflow-hidden">
                            <span class="btn-text">Envoyer</span>
                            <span class="btn-loader hidden"><i class="fas fa-circle-notch fa-spin"></i></span>
                        </button>
                    </form>

                    <div class="form-success mt-6">
                        <div class="success-icon"><i class="fas fa-check"></i></div>
                        <p class="text-lg font-semibold">Message envoyé !</p>
                        <p class="text-gray-400 text-sm">Je vous réponds rapidement.</p>
                    </div>
                </div>
            </div>

            <!-- Info Badge -->
            <div class="contact-info-badge lg:w-64">
                <div class="info-item" onclick="copyText('camil.belmehdi@etu.iut-tlse3.fr')">
                    <i class="fas fa-envelope"></i>
                    <span>camil.belmehdi@etu.iut-tlse3.fr</span>
                    <i class="fas fa-copy copy-icon"></i>
                </div>
                <div class="info-item" onclick="copyText('Toulouse / Albi')">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Toulouse / Albi</span>
                    <i class="fas fa-copy copy-icon"></i>
                </div>
                <div class="info-item" onclick="copyText('+33 6 63 06 38 17')">
                    <i class="fas fa-phone"></i>
                    <span>+33 6 63 06 38 17</span>
                    <i class="fas fa-copy copy-icon"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         CONCEPT 2: RAIL CAMERA FORM
         ============================================ -->
    <section id="concept-2" class="form-section">
        <span class="section-title"><span class="section-number">2</span> Rail Camera Form</span>

        <div class="max-w-2xl w-full">
            <div class="rail-camera-form">
                <!-- Progress Track -->
                <div class="flex justify-between mb-8 relative">
                    <div class="absolute top-1/2 left-0 right-0 h-0.5 bg-slate-700 -translate-y-1/2"></div>
                    <div class="rail-progress absolute top-1/2 left-0 h-0.5 bg-indigo-500 -translate-y-1/2 transition-all duration-500"
                        style="width: 0%"></div>

                    <div class="rail-station active" data-step="1">
                        <div
                            class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold z-10 relative">
                            1</div>
                        <span class="text-xs mt-2 text-gray-400">Nom</span>
                    </div>
                    <div class="rail-station" data-step="2">
                        <div
                            class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-gray-400 font-bold z-10 relative">
                            2</div>
                        <span class="text-xs mt-2 text-gray-400">Email</span>
                    </div>
                    <div class="rail-station" data-step="3">
                        <div
                            class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-gray-400 font-bold z-10 relative">
                            3</div>
                        <span class="text-xs mt-2 text-gray-400">Message</span>
                    </div>
                </div>

                <!-- Form Steps -->
                <form class="rail-form bg-slate-900/80 backdrop-blur-xl border border-indigo-500/30 rounded-2xl p-8"
                    onsubmit="handleSubmit(event, this)">
                    <div class="rail-step active" data-step="1">
                        <label class="block text-lg font-semibold mb-4">Comment vous appelez-vous ?</label>
                        <input type="text" name="name" class="form-input mb-4" placeholder="Votre nom" required>
                        <button type="button" class="form-btn w-full" onclick="nextRailStep(2)">Suivant <i
                                class="fas fa-arrow-right ml-2"></i></button>
                    </div>

                    <div class="rail-step hidden" data-step="2">
                        <label class="block text-lg font-semibold mb-4">Quel est votre email ?</label>
                        <input type="email" name="email" class="form-input mb-4" placeholder="Votre email" required>
                        <div class="flex gap-4">
                            <button type="button" class="form-btn flex-1 bg-slate-700" onclick="nextRailStep(1)"><i
                                    class="fas fa-arrow-left mr-2"></i> Retour</button>
                            <button type="button" class="form-btn flex-1" onclick="nextRailStep(3)">Suivant <i
                                    class="fas fa-arrow-right ml-2"></i></button>
                        </div>
                    </div>

                    <div class="rail-step hidden" data-step="3">
                        <label class="block text-lg font-semibold mb-4">Votre message</label>
                        <textarea name="message" class="form-input form-textarea mb-4"
                            placeholder="Décrivez votre projet..." required></textarea>
                        <div class="flex gap-4">
                            <button type="button" class="form-btn flex-1 bg-slate-700" onclick="nextRailStep(2)"><i
                                    class="fas fa-arrow-left mr-2"></i> Retour</button>
                            <button type="submit" class="form-btn flex-1">Envoyer <i
                                    class="fas fa-paper-plane ml-2"></i></button>
                        </div>
                    </div>

                    <div class="form-success">
                        <div class="success-icon"><i class="fas fa-check"></i></div>
                        <p class="text-lg font-semibold">Message envoyé !</p>
                    </div>
                </form>

                <!-- HUD Info Bar -->
                <div class="flex justify-center gap-8 mt-6 text-sm text-gray-500">
                    <span><i class="fas fa-envelope mr-2 text-indigo-400"></i>camil.belmehdi@etu.iut-tlse3.fr</span>
                    <span><i class="fas fa-map-marker-alt mr-2 text-indigo-400"></i>Toulouse / Albi</span>
                    <span><i class="fas fa-phone mr-2 text-indigo-400"></i>+33 6 63 06 38 17</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         CONCEPT 3: PAPER FOLD GLASS
         ============================================ -->
    <section id="concept-3" class="form-section">
        <span class="section-title"><span class="section-number">3</span> Paper Fold Glass</span>

        <div class="max-w-3xl w-full perspective-1000">
            <form class="paper-fold-form" onsubmit="handleSubmit(event, this)">
                <div class="flex gap-1">
                    <div class="paper-panel flex-1 bg-slate-900/90 backdrop-blur-xl border border-indigo-500/20 p-6 rounded-l-2xl transition-all duration-500 origin-right"
                        data-panel="1">
                        <label class="block text-sm font-semibold mb-3 text-indigo-400">01 / NOM</label>
                        <input type="text" name="name"
                            class="form-input bg-transparent border-b border-t-0 border-l-0 border-r-0 rounded-none px-0"
                            placeholder="Votre nom" required>
                    </div>
                    <div class="paper-panel flex-1 bg-slate-900/90 backdrop-blur-xl border border-indigo-500/20 p-6 transition-all duration-500"
                        data-panel="2">
                        <label class="block text-sm font-semibold mb-3 text-indigo-400">02 / EMAIL</label>
                        <input type="email" name="email"
                            class="form-input bg-transparent border-b border-t-0 border-l-0 border-r-0 rounded-none px-0"
                            placeholder="Votre email" required>
                    </div>
                    <div class="paper-panel flex-1 bg-slate-900/90 backdrop-blur-xl border border-indigo-500/20 p-6 rounded-r-2xl transition-all duration-500 origin-left"
                        data-panel="3">
                        <label class="block text-sm font-semibold mb-3 text-indigo-400">03 / MESSAGE</label>
                        <textarea name="message"
                            class="form-input bg-transparent border-b border-t-0 border-l-0 border-r-0 rounded-none px-0 min-h-[80px]"
                            placeholder="Message..." required></textarea>
                    </div>
                </div>
                <div class="mt-6 flex justify-between items-center">
                    <div class="text-xs text-gray-500">
                        <span class="mr-4">camil.belmehdi@etu.iut-tlse3.fr</span>
                        <span class="mr-4">Toulouse / Albi</span>
                        <span>+33 6 63 06 38 17</span>
                    </div>
                    <button type="submit" class="form-btn">Envoyer <i class="fas fa-paper-plane ml-2"></i></button>
                </div>

                <div class="form-success mt-6">
                    <div class="success-icon"><i class="fas fa-check"></i></div>
                    <p class="text-lg font-semibold">Message envoyé !</p>
                </div>
            </form>
        </div>
    </section>

    <!-- ============================================
         CONCEPT 4: CONSTELLATION INPUTS
         ============================================ -->
    <section id="concept-4" class="form-section">
        <span class="section-title"><span class="section-number">4</span> Constellation Inputs</span>

        <div class="max-w-xl w-full">
            <form class="constellation-form relative" onsubmit="handleSubmit(event, this)" style="height: 400px;">
                <!-- SVG Lines -->
                <svg class="absolute inset-0 w-full h-full pointer-events-none" style="z-index: 0;">
                    <line x1="20%" y1="30%" x2="50%" y2="50%" stroke="rgba(99,102,241,0.3)" stroke-width="1" />
                    <line x1="50%" y1="50%" x2="80%" y2="30%" stroke="rgba(99,102,241,0.3)" stroke-width="1" />
                    <line x1="50%" y1="50%" x2="50%" y2="85%" stroke="rgba(99,102,241,0.3)" stroke-width="1" />
                </svg>

                <!-- Star Points -->
                <div class="constellation-point absolute"
                    style="left: 20%; top: 30%; transform: translate(-50%, -50%);">
                    <div class="star-point w-12 h-12 rounded-full bg-indigo-500/20 border-2 border-indigo-500 flex items-center justify-center cursor-pointer hover:bg-indigo-500/40 transition-all"
                        onclick="showConstellationField('name')">
                        <i class="fas fa-user text-indigo-400"></i>
                    </div>
                    <span class="text-xs text-gray-400 mt-2 block text-center">Nom</span>
                </div>

                <div class="constellation-point absolute"
                    style="left: 80%; top: 30%; transform: translate(-50%, -50%);">
                    <div class="star-point w-12 h-12 rounded-full bg-indigo-500/20 border-2 border-indigo-500 flex items-center justify-center cursor-pointer hover:bg-indigo-500/40 transition-all"
                        onclick="showConstellationField('email')">
                        <i class="fas fa-envelope text-indigo-400"></i>
                    </div>
                    <span class="text-xs text-gray-400 mt-2 block text-center">Email</span>
                </div>

                <div class="constellation-point absolute"
                    style="left: 50%; top: 50%; transform: translate(-50%, -50%);">
                    <div class="star-point w-16 h-16 rounded-full bg-purple-500/20 border-2 border-purple-500 flex items-center justify-center cursor-pointer hover:bg-purple-500/40 transition-all"
                        onclick="showConstellationField('message')">
                        <i class="fas fa-comment text-purple-400 text-xl"></i>
                    </div>
                    <span class="text-xs text-gray-400 mt-2 block text-center">Message</span>
                </div>

                <!-- Floating Fields -->
                <div id="constellation-field-name"
                    class="constellation-field hidden absolute bg-slate-900/95 backdrop-blur-xl border border-indigo-500/40 rounded-xl p-4 shadow-2xl"
                    style="left: 20%; top: 50%; width: 250px;">
                    <input type="text" name="name" class="form-input" placeholder="Votre nom">
                    <button type="button" class="text-xs text-indigo-400 mt-2"
                        onclick="hideConstellationField('name')">Fermer</button>
                </div>

                <div id="constellation-field-email"
                    class="constellation-field hidden absolute bg-slate-900/95 backdrop-blur-xl border border-indigo-500/40 rounded-xl p-4 shadow-2xl"
                    style="left: 55%; top: 50%; width: 250px;">
                    <input type="email" name="email" class="form-input" placeholder="Votre email">
                    <button type="button" class="text-xs text-indigo-400 mt-2"
                        onclick="hideConstellationField('email')">Fermer</button>
                </div>

                <div id="constellation-field-message"
                    class="constellation-field hidden absolute bg-slate-900/95 backdrop-blur-xl border border-purple-500/40 rounded-xl p-4 shadow-2xl"
                    style="left: 25%; top: 65%; width: 300px;">
                    <textarea name="message" class="form-input form-textarea" placeholder="Votre message"></textarea>
                    <button type="button" class="text-xs text-purple-400 mt-2"
                        onclick="hideConstellationField('message')">Fermer</button>
                </div>

                <!-- Submit -->
                <div class="absolute" style="left: 50%; top: 85%; transform: translate(-50%, -50%);">
                    <button type="submit" class="form-btn">Envoyer <i class="fas fa-rocket ml-2"></i></button>
                </div>

                <div class="form-success absolute inset-0 flex items-center justify-center bg-slate-900/90">
                    <div class="text-center">
                        <div class="success-icon mx-auto"><i class="fas fa-check"></i></div>
                        <p class="text-lg font-semibold mt-4">Message envoyé !</p>
                    </div>
                </div>
            </form>

            <!-- Coordinates -->
            <div class="flex justify-center gap-6 mt-8 text-xs text-gray-500 font-mono">
                <span>EMAIL: camil.belmehdi@etu.iut-tlse3.fr</span>
                <span>LOC: 43.6°N, 1.4°E</span>
                <span>TEL: +33 6 63 06 38 17</span>
            </div>
        </div>
    </section>

    <!-- ============================================
         CONCEPT 5: COMMAND PALETTE CONTACT
         ============================================ -->
    <section id="concept-5" class="form-section">
        <span class="section-title"><span class="section-number">5</span> Command Palette</span>

        <div class="max-w-xl w-full">
            <div
                class="command-palette bg-slate-900/90 backdrop-blur-xl border border-indigo-500/30 rounded-2xl overflow-hidden shadow-2xl">
                <div class="flex items-center gap-3 px-4 py-3 border-b border-slate-700">
                    <i class="fas fa-terminal text-indigo-400"></i>
                    <input type="text" id="command-input"
                        class="flex-1 bg-transparent border-none outline-none text-white"
                        placeholder="Une idée ? Un projet ? Tapez pour commencer...">
                    <span class="text-xs text-gray-500 bg-slate-800 px-2 py-1 rounded">⌘K</span>
                </div>

                <form id="command-form" class="p-4 space-y-3" onsubmit="handleSubmit(event, this)">
                    <div class="command-action flex items-center gap-3 p-3 rounded-lg hover:bg-slate-800/50 cursor-pointer transition-all"
                        data-field="name">
                        <div class="w-8 h-8 bg-indigo-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user text-indigo-400 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-sm">Ajouter votre nom</p>
                            <input type="text" name="name" class="hidden form-input mt-2" placeholder="Votre nom">
                        </div>
                        <span class="text-xs text-gray-500">→</span>
                    </div>

                    <div class="command-action flex items-center gap-3 p-3 rounded-lg hover:bg-slate-800/50 cursor-pointer transition-all"
                        data-field="email">
                        <div class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-envelope text-purple-400 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-sm">Ajouter votre email</p>
                            <input type="email" name="email" class="hidden form-input mt-2" placeholder="Votre email">
                        </div>
                        <span class="text-xs text-gray-500">→</span>
                    </div>

                    <div class="command-action flex items-center gap-3 p-3 rounded-lg hover:bg-slate-800/50 cursor-pointer transition-all"
                        data-field="message">
                        <div class="w-8 h-8 bg-pink-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-comment text-pink-400 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-sm">Écrire votre message</p>
                            <textarea name="message" class="hidden form-input form-textarea mt-2"
                                placeholder="Décrivez votre projet..."></textarea>
                        </div>
                        <span class="text-xs text-gray-500">→</span>
                    </div>

                    <div class="pt-3 border-t border-slate-700">
                        <button type="submit" class="form-btn w-full">
                            <i class="fas fa-paper-plane mr-2"></i> Envoyer le message
                        </button>
                    </div>

                    <div class="form-success">
                        <div class="success-icon"><i class="fas fa-check"></i></div>
                        <p class="text-lg font-semibold">Commité avec succès !</p>
                    </div>
                </form>

                <div class="px-4 py-2 bg-slate-800/50 text-xs text-gray-500 flex justify-between">
                    <span>camil.belmehdi@etu.iut-tlse3.fr</span>
                    <span>Toulouse / Albi</span>
                    <span>+33 6 63 06 38 17</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================
         CONCEPT 6: SPLIT SCREEN STORY
         ============================================ -->
    <section id="concept-6" class="form-section">
        <span class="section-title"><span class="section-number">6</span> Split Screen Story</span>

        <div class="flex flex-col lg:flex-row w-full max-w-5xl">
            <!-- Story Side -->
            <div class="flex-1 flex items-center justify-center p-8 lg:p-16">
                <div class="text-center lg:text-left">
                    <h2 id="split-headline"
                        class="text-4xl lg:text-5xl font-bold text-white mb-4 transition-all duration-500">
                        Travaillons<br><span class="text-indigo-400">Ensemble</span></h2>
                    <p id="split-subtext" class="text-gray-400 text-lg transition-all duration-500">Une idée ? Un projet
                        ? Parlons-en.</p>
                </div>
            </div>

            <!-- Form Side -->
            <div class="flex-1 flex items-center justify-center p-8 bg-slate-900/50">
                <form class="split-form w-full max-w-md space-y-4" onsubmit="handleSubmit(event, this)">
                    <div>
                        <input type="text" name="name" class="form-input" placeholder="Votre nom"
                            onfocus="updateSplitStory('Enchanté 👋', 'Ravi de faire votre connaissance.')"
                            onblur="resetSplitStory()">
                    </div>
                    <div>
                        <input type="email" name="email" class="form-input" placeholder="Votre email"
                            onfocus="updateSplitStory('Je vous réponds', 'dans les 24h, promis.')"
                            onblur="resetSplitStory()">
                    </div>
                    <div>
                        <textarea name="message" class="form-input form-textarea" placeholder="Votre message"
                            onfocus="updateSplitStory('Décrivez votre', 'besoin en détail.')"
                            onblur="resetSplitStory()"></textarea>
                    </div>
                    <button type="submit" class="form-btn w-full">Envoyer <i
                            class="fas fa-arrow-right ml-2"></i></button>

                    <div class="form-success">
                        <div class="success-icon"><i class="fas fa-check"></i></div>
                        <p class="text-lg font-semibold">Message envoyé ✔</p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bottom Info -->
        <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-8 text-sm text-gray-500">
            <span>camil.belmehdi@etu.iut-tlse3.fr</span>
            <span>Toulouse / Albi</span>
            <span>+33 6 63 06 38 17</span>
        </div>
    </section>

    <!-- ============================================
         CONCEPT 7: FLOATING MAGNET
         ============================================ -->
    <section id="concept-7" class="form-section">
        <span class="section-title"><span class="section-number">7</span> Floating Magnet</span>

        <div class="max-w-md w-full">
            <h3 class="text-3xl font-bold text-center mb-8">Contactez-moi</h3>

            <form class="floating-magnet-form space-y-6" onsubmit="handleSubmit(event, this)">
                <div class="magnet-field transform transition-all duration-300 hover:scale-[1.02]"
                    style="animation: float 3s ease-in-out infinite;">
                    <input type="text" name="name" class="form-input" placeholder="Votre nom">
                </div>
                <div class="magnet-field transform transition-all duration-300 hover:scale-[1.02]"
                    style="animation: float 3s ease-in-out infinite 0.5s;">
                    <input type="email" name="email" class="form-input" placeholder="Votre email">
                </div>
                <div class="magnet-field transform transition-all duration-300 hover:scale-[1.02]"
                    style="animation: float 3s ease-in-out infinite 1s;">
                    <textarea name="message" class="form-input form-textarea" placeholder="Votre message"></textarea>
                </div>
                <button type="submit" class="form-btn w-full">Envoyer <i class="fas fa-magnet ml-2"></i></button>

                <div class="form-success">
                    <div class="success-icon"><i class="fas fa-check"></i></div>
                    <p class="text-lg font-semibold">Envoyé !</p>
                </div>
            </form>

            <!-- Mini Card -->
            <div class="contact-info-badge mt-8">
                <div class="info-item" onclick="copyText('camil.belmehdi@etu.iut-tlse3.fr')">
                    <i class="fas fa-envelope"></i>
                    <span>camil.belmehdi@etu.iut-tlse3.fr</span>
                    <i class="fas fa-copy copy-icon"></i>
                </div>
                <div class="info-item" onclick="copyText('Toulouse / Albi')">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Toulouse / Albi</span>
                </div>
                <div class="info-item" onclick="copyText('+33 6 63 06 38 17')">
                    <i class="fas fa-phone"></i>
                    <span>+33 6 63 06 38 17</span>
                </div>
            </div>
        </div>

        <style>
            @keyframes float {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-5px);
                }
            }
        </style>
    </section>

    <!-- ============================================
         CONCEPT 8: PROGRESS RING MINIMAL
         ============================================ -->
    <section id="concept-8" class="form-section">
        <span class="section-title"><span class="section-number">8</span> Progress Ring</span>

        <div class="flex flex-col lg:flex-row items-center gap-12 max-w-4xl w-full">
            <!-- Ring -->
            <div class="relative w-48 h-48">
                <svg class="w-full h-full transform -rotate-90">
                    <circle cx="96" cy="96" r="88" stroke="rgba(99,102,241,0.2)" stroke-width="8" fill="none" />
                    <circle id="progress-ring" cx="96" cy="96" r="88" stroke="#6366f1" stroke-width="8" fill="none"
                        stroke-dasharray="553" stroke-dashoffset="553" stroke-linecap="round"
                        class="transition-all duration-500" />
                </svg>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span id="progress-percent" class="text-3xl font-bold text-white">0%</span>
                </div>

                <!-- Contact Direct -->
                <div
                    class="absolute -bottom-16 left-1/2 -translate-x-1/2 text-center text-xs text-gray-500 whitespace-nowrap">
                    <p class="font-semibold text-gray-400 mb-1">Contact Direct</p>
                    <p>camil.belmehdi@etu.iut-tlse3.fr</p>
                </div>
            </div>

            <!-- Form -->
            <form class="flex-1 w-full max-w-md space-y-4" onsubmit="handleSubmit(event, this)" id="ring-form">
                <div>
                    <input type="text" name="name" class="form-input ring-input" placeholder="Votre nom"
                        oninput="updateRingProgress()">
                </div>
                <div>
                    <input type="email" name="email" class="form-input ring-input" placeholder="Votre email"
                        oninput="updateRingProgress()">
                </div>
                <div>
                    <textarea name="message" class="form-input form-textarea ring-input" placeholder="Votre message"
                        oninput="updateRingProgress()"></textarea>
                </div>
                <button type="submit" class="form-btn w-full">Envoyer</button>

                <div class="form-success">
                    <div class="success-icon"><i class="fas fa-check"></i></div>
                    <p class="text-lg font-semibold">100% Envoyé !</p>
                </div>
            </form>
        </div>
    </section>

    <!-- ============================================
         CONCEPT 9: CARD STACK
         ============================================ -->
    <section id="concept-9" class="form-section">
        <span class="section-title"><span class="section-number">9</span> Card Stack</span>

        <div class="max-w-md w-full relative" style="height: 450px;">
            <form class="card-stack-form" onsubmit="handleStackSubmit(event)">
                <!-- Card 3: Message (Bottom) -->
                <div class="stack-card absolute inset-x-4 bg-slate-800/90 backdrop-blur-xl border border-indigo-500/20 rounded-2xl p-6 transition-all duration-500"
                    style="top: 40px; z-index: 1; transform: scale(0.92);" data-card="3">
                    <label class="block text-sm font-semibold mb-3 text-gray-400">03 / MESSAGE</label>
                    <textarea name="message" class="form-input form-textarea" placeholder="Votre message"></textarea>
                    <button type="submit" class="form-btn w-full mt-4">Envoyer <i
                            class="fas fa-paper-plane ml-2"></i></button>
                </div>

                <!-- Card 2: Email (Middle) -->
                <div class="stack-card absolute inset-x-2 bg-slate-900/90 backdrop-blur-xl border border-indigo-500/30 rounded-2xl p-6 transition-all duration-500"
                    style="top: 20px; z-index: 2; transform: scale(0.96);" data-card="2">
                    <label class="block text-sm font-semibold mb-3 text-gray-400">02 / EMAIL</label>
                    <input type="email" name="email" class="form-input" placeholder="Votre email">
                    <button type="button" class="form-btn w-full mt-4" onclick="advanceStack(2)">Suivant</button>
                </div>

                <!-- Card 1: Name (Top) -->
                <div class="stack-card absolute inset-0 bg-slate-900 backdrop-blur-xl border border-indigo-500/40 rounded-2xl p-6 shadow-2xl transition-all duration-500"
                    style="z-index: 3;" data-card="1">
                    <label class="block text-sm font-semibold mb-3 text-indigo-400">01 / NOM</label>
                    <input type="text" name="name" class="form-input" placeholder="Votre nom">
                    <button type="button" class="form-btn w-full mt-4" onclick="advanceStack(1)">Suivant</button>
                </div>

                <!-- Success Card -->
                <div class="stack-success hidden absolute inset-0 bg-slate-900 backdrop-blur-xl border border-green-500/40 rounded-2xl p-6 shadow-2xl flex items-center justify-center"
                    style="z-index: 10;">
                    <div class="text-center">
                        <div class="success-icon mx-auto"><i class="fas fa-check"></i></div>
                        <p class="text-xl font-semibold mt-4">Message envoyé !</p>
                    </div>
                </div>
            </form>

            <!-- Mini Info Card -->
            <div class="absolute -bottom-20 left-1/2 -translate-x-1/2 flex gap-4 text-xs text-gray-500">
                <span><i class="fas fa-envelope mr-1 text-indigo-400"></i> camil.belmehdi@etu.iut-tlse3.fr</span>
                <span><i class="fas fa-map-marker-alt mr-1 text-indigo-400"></i> Toulouse</span>
                <span><i class="fas fa-phone mr-1 text-indigo-400"></i> +33 6 63 06 38 17</span>
            </div>
        </div>
    </section>

    <!-- ============================================
         CONCEPT 10: SIGNATURE WAVE
         ============================================ -->
    <section id="concept-10" class="form-section">
        <span class="section-title"><span class="section-number">10</span> Signature Wave</span>

        <div class="max-w-xl w-full">
            <h2 class="text-4xl font-bold mb-8">Travaillons <span class="text-indigo-400">Ensemble</span></h2>

            <form class="signature-form space-y-4" onsubmit="handleSubmit(event, this)">
                <div>
                    <input type="text" name="name" class="form-input signature-input" placeholder="Votre nom"
                        data-wave="small">
                </div>
                <div>
                    <input type="email" name="email" class="form-input signature-input" placeholder="Votre email"
                        data-wave="medium">
                </div>
                <div>
                    <textarea name="message" class="form-input form-textarea signature-input"
                        placeholder="Votre message" data-wave="large"></textarea>
                </div>
                <button type="submit" class="form-btn w-full">Envoyer</button>

                <div class="form-success">
                    <div class="success-icon"><i class="fas fa-check"></i></div>
                    <p class="text-lg font-semibold">Signé et envoyé !</p>
                </div>
            </form>

            <!-- Signature Line -->
            <div class="mt-8 relative h-8">
                <svg id="signature-wave" class="w-full h-full" viewBox="0 0 400 30" preserveAspectRatio="none">
                    <path id="wave-path" d="M0,15 Q100,15 200,15 T400,15" stroke="url(#wave-gradient)" stroke-width="2"
                        fill="none" />
                    <defs>
                        <linearGradient id="wave-gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#6366f1" />
                            <stop offset="100%" stop-color="#8b5cf6" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>

            <!-- Info under signature -->
            <div class="flex justify-between mt-4 text-sm text-gray-500">
                <span class="hover:text-white hover:underline cursor-pointer transition-all"
                    onclick="copyText('camil.belmehdi@etu.iut-tlse3.fr')">camil.belmehdi@etu.iut-tlse3.fr</span>
                <span>Toulouse / Albi</span>
                <span class="hover:text-white hover:underline cursor-pointer transition-all"
                    onclick="copyText('+33 6 63 06 38 17')">+33 6 63 06 38 17</span>
            </div>
        </div>
    </section>

    <!-- ============================================
         JAVASCRIPT
         ============================================ -->
    <script>
        // Copy to clipboard
        function copyText(text) {
            navigator.clipboard.writeText(text).then(() => {
                // Show toast
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
                toast.textContent = 'Copié !';
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 2000);
            });
        }

        // Generic form submit handler
        function handleSubmit(e, form) {
            e.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            const btnText = btn.querySelector('.btn-text');
            const btnLoader = btn.querySelector('.btn-loader');

            if (btnText) btnText.classList.add('hidden');
            if (btnLoader) btnLoader.classList.remove('hidden');
            btn.disabled = true;

            // Simulate sending
            setTimeout(() => {
                form.querySelectorAll('input, textarea').forEach(el => el.style.display = 'none');
                form.querySelectorAll('.dock-module, .magnet-field, label, .flex, p').forEach(el => el.style.display = 'none');
                btn.style.display = 'none';
                const success = form.querySelector('.form-success');
                if (success) success.classList.add('active');
            }, 1500);
        }

        // Rail Camera Form
        function nextRailStep(step) {
            document.querySelectorAll('.rail-step').forEach(s => s.classList.add('hidden'));
            document.querySelector(`.rail-step[data-step="${step}"]`).classList.remove('hidden');

            document.querySelectorAll('.rail-station').forEach(s => {
                const stationStep = parseInt(s.dataset.step);
                const dot = s.querySelector('div');
                if (stationStep <= step) {
                    s.classList.add('active');
                    dot.classList.remove('bg-slate-700', 'text-gray-400');
                    dot.classList.add('bg-indigo-500', 'text-white');
                } else {
                    s.classList.remove('active');
                    dot.classList.add('bg-slate-700', 'text-gray-400');
                    dot.classList.remove('bg-indigo-500', 'text-white');
                }
            });

            const progress = ((step - 1) / 2) * 100;
            document.querySelector('.rail-progress').style.width = progress + '%';
        }

        // Constellation
        function showConstellationField(field) {
            document.getElementById(`constellation-field-${field}`).classList.remove('hidden');
        }
        function hideConstellationField(field) {
            document.getElementById(`constellation-field-${field}`).classList.add('hidden');
        }

        // Command Palette
        document.querySelectorAll('.command-action').forEach(action => {
            action.addEventListener('click', () => {
                const input = action.querySelector('input, textarea');
                const label = action.querySelector('p');
                if (input.classList.contains('hidden')) {
                    input.classList.remove('hidden');
                    label.classList.add('text-indigo-400');
                    input.focus();
                }
            });
        });

        // Split Screen Story
        function updateSplitStory(headline, subtext) {
            const h = document.getElementById('split-headline');
            const s = document.getElementById('split-subtext');
            h.innerHTML = headline.split(' ')[0] + '<br><span class="text-indigo-400">' + headline.split(' ').slice(1).join(' ') + '</span>';
            s.textContent = subtext;
        }
        function resetSplitStory() {
            updateSplitStory('Travaillons Ensemble', 'Une idée ? Un projet ? Parlons-en.');
        }

        // Progress Ring
        function updateRingProgress() {
            const form = document.getElementById('ring-form');
            const inputs = form.querySelectorAll('.ring-input');
            let filled = 0;
            inputs.forEach(input => {
                if (input.value.trim()) filled++;
            });
            const percent = Math.round((filled / inputs.length) * 100);
            const offset = 553 - (553 * percent / 100);
            document.getElementById('progress-ring').style.strokeDashoffset = offset;
            document.getElementById('progress-percent').textContent = percent + '%';
        }

        // Card Stack
        let currentStack = 1;
        function advanceStack(from) {
            const cards = document.querySelectorAll('.stack-card');
            cards.forEach(card => {
                const cardNum = parseInt(card.dataset.card);
                if (cardNum < from + 1) {
                    card.style.transform = 'translateY(-100%) scale(0.9)';
                    card.style.opacity = '0';
                }
                if (cardNum === from + 1) {
                    card.style.zIndex = '3';
                    card.style.transform = 'scale(1)';
                    card.style.top = '0';
                    card.style.inset = '0';
                }
            });
            currentStack = from + 1;
        }
        function handleStackSubmit(e) {
            e.preventDefault();
            document.querySelectorAll('.stack-card').forEach(c => c.style.display = 'none');
            document.querySelector('.stack-success').classList.remove('hidden');
        }

        // Signature Wave Animation
        document.querySelectorAll('.signature-input').forEach(input => {
            input.addEventListener('focus', () => {
                const wave = input.dataset.wave;
                let amplitude = 5;
                if (wave === 'medium') amplitude = 10;
                if (wave === 'large') amplitude = 15;
                animateWave(amplitude);
            });
            input.addEventListener('blur', () => {
                animateWave(0);
            });
        });

        function animateWave(amplitude) {
            const path = document.getElementById('wave-path');
            const y1 = 15 - amplitude;
            const y2 = 15 + amplitude;
            path.setAttribute('d', `M0,15 Q100,${y1} 200,15 T400,${y2}`);
        }

        // Smooth scroll for nav
        document.querySelectorAll('.lab-nav a').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(link.getAttribute('href'));
                target.scrollIntoView({ behavior: 'smooth' });
            });
        });

        // Update active nav on scroll
        const sections = document.querySelectorAll('.form-section');
        const navLinks = document.querySelectorAll('.lab-nav a');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (scrollY >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>