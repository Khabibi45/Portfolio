<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labo Forms | Camil Belmehdi</title>

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
    <link rel="stylesheet" href="assets/css/forms.css">
    <link rel="stylesheet" href="assets/css/skills.css">
    <link rel="import" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-dark text-slate-100 overflow-x-hidden antialiased">

    <!-- Custom Cursor -->
    <div class="cursor-dot hidden md:block"></div>
    <div class="cursor-outline hidden md:block"></div>

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-nav" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a href="index.php"
                    class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">
                    <i class="fas fa-arrow-left mr-2"></i> Retour
                </a>
                <h1
                    class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-pink-400">
                    LABORATOIRE D'EXPÉRIMENTATIONS</h1>
            </div>
        </div>
    </nav>

    <div class="pt-24 pb-12 px-4 text-center">
        <p class="text-gray-400 max-w-2xl mx-auto">
            Bienvenue dans le Labo. Ici, j'expérimente des concepts d'interface utilisateur, d'interactions et
            d'animations avancés.
            <br><span class="text-primary text-sm font-bold">10 EXPÉRIENCES UNIQUES</span>
        </p>
    </div>

    <!-- MAIN GRID -->
    <div class="lab-grid max-w-7xl mx-auto pb-20">

        <!-- 1. Liquid Login -->
        <div class="lab-card overflow-hidden">
            <span class="lab-title">01. Liquid Morphing</span>
            <div class="liquid-bg"></div>
            <div class="liquid-form space-y-4">
                <h3 class="text-2xl font-bold mb-4">Space Login</h3>
                <input type="text" placeholder="Username" class="liquid-input">
                <input type="password" placeholder="Password" class="liquid-input">
                <button
                    class="w-full py-3 mt-4 bg-white/10 hover:bg-white/20 rounded-full transition-colors font-bold">Enter
                    Orbit</button>
            </div>
        </div>

        <!-- 2. 3D Perspective Flip -->
        <div class="lab-card">
            <span class="lab-title">02. 3D Flip Card</span>
            <div class="flip-container">
                <div class="flip-card">
                    <div class="flip-front">
                        <h3 class="text-2xl font-bold mb-6">Sign Up</h3>
                        <form id="flip-form" class="space-y-4">
                            <input type="email" placeholder="Email" required
                                class="w-full p-3 rounded bg-slate-800 border border-slate-600 focus:border-primary outline-none">
                            <button type="submit"
                                class="w-full py-3 bg-primary rounded font-bold hover:scale-105 transition-transform">Create
                                Account</button>
                        </form>
                    </div>
                    <div class="flip-back">
                        <i class="fas fa-check-circle text-5xl text-green-500 mb-4"></i>
                        <h3 class="text-xl font-bold">Welcome Aboard!</h3>
                        <p class="text-sm text-gray-400 mt-2">Redirecting you to the dashboard...</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Spotlight Survey -->
        <div class="lab-card" style="padding:0; overflow:hidden;">
            <span class="lab-title" style="z-index:10; top: 2rem; left: 2rem;">03. Spotlight UX</span>
            <div class="spotlight-container">
                <div class="spotlight"></div>
                <div class="spotlight-content text-center">
                    <h3 class="text-3xl font-bold mb-4">Trouvez la réponse</h3>
                    <p class="text-gray-400 max-w-xs mx-auto mb-8">Utilisez votre lampe torche pour révéler le contenu
                        caché dans l'obscurité.</p>
                    <button
                        class="px-6 py-2 border border-white/30 rounded-full hover:bg-white/10 transition">Révéler</button>
                </div>
            </div>
        </div>

        <!-- 4. Neumorphism -->
        <div class="lab-card bg-slate-200 text-slate-800">
            <span class="lab-title text-slate-400">04. Soft UI / Neumorphism</span>
            <div class="neu-box">
                <h3 class="text-xl font-bold mb-6 text-slate-300">Settings</h3>
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-400 text-sm">Notifications</span>
                        <div class="w-10 h-5 bg-[#1e293b] rounded-full shadow-inner relative cursor-pointer">
                            <div class="absolute left-1 top-1 w-3 h-3 bg-primary rounded-full shadow-md"></div>
                        </div>
                    </div>
                    <input type="text" placeholder="Search..." class="neu-input">
                    <button class="neu-btn">Save Changes</button>
                </div>
            </div>
        </div>

        <!-- 5. Minimal Typeform -->
        <div class="lab-card">
            <span class="lab-title">05. Minimalist Flow</span>
            <div class="minimal-container px-8">
                <div class="minimal-slide active">
                    <label class="text-sm text-primary mb-2">01. Quel est votre prénom ?</label>
                    <input type="text" class="minimal-input" placeholder="Tapez ici..." autofocus>
                    <p class="text-xs text-gray-500 mt-4">Appuyez sur <span class="bg-white/10 px-1 rounded">Entrée
                            ↵</span></p>
                </div>
                <div class="minimal-slide">
                    <label class="text-sm text-primary mb-2">02. Votre couleur préférée ?</label>
                    <input type="text" class="minimal-input" placeholder="Tapez ici...">
                    <p class="text-xs text-gray-500 mt-4">Appuyez sur <span class="bg-white/10 px-1 rounded">Entrée
                            ↵</span></p>
                </div>
            </div>
        </div>

        <!-- 6. Interactive Knob -->
        <div class="lab-card">
            <span class="lab-title">06. Interactive Dial</span>
            <h3 class="text-xl font-bold mb-8">Niveau de Budget</h3>
            <div class="knob-container">
                <svg class="knob-svg" viewBox="0 0 200 200">
                    <circle class="knob-track" cx="100" cy="100" r="90"></circle>
                    <circle class="knob-value" cx="100" cy="100" r="90"></circle>
                </svg>
                <div class="knob-display">0%</div>
            </div>
            <p class="text-xs text-gray-500 mt-6">Glissez de haut en bas pour ajuster</p>
        </div>

        <!-- 7. Holographic Card -->
        <div class="lab-card">
            <span class="lab-title">07. Holographic Payment</span>
            <div class="holo-card p-6 flex flex-col justify-between">
                <div class="holo-glare"></div>
                <!-- <div class="holo-border"></div> -->
                <div class="flex justify-between items-start z-10">
                    <i class="fas fa-wifi text-2xl opacity-80"></i>
                    <span class="font-mono text-xl text-white/50">VISA</span>
                </div>
                <div class="z-10">
                    <p class="font-mono text-xl tracking-widest mb-2">4521 8890 1023 4567</p>
                    <div class="flex justify-between text-xs text-gray-300 uppercase">
                        <span>Camil Belmehdi</span>
                        <span>12/28</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 8. Password Visualizer -->
        <div class="lab-card">
            <span class="lab-title">08. Security Visualizer</span>
            <div class="pwd-container">
                <label class="text-lg font-bold mb-2 block">Mot de passe maître</label>
                <input type="password" id="pwd-visual"
                    class="w-full p-3 bg-slate-800 rounded-lg border border-slate-600 focus:border-white transition-colors outline-none"
                    placeholder="••••••••">
                <div class="entropy-bar">
                    <div class="entropy-fill"></div>
                </div>
                <div class="pwd-particles">
                    <!-- Particles auto generated -->
                </div>
            </div>
        </div>

        <!-- 9. Drag Upload -->
        <div class="lab-card">
            <span class="lab-title">09. Physics Upload</span>
            <div class="drag-zone">
                <i class="fas fa-cloud-upload-alt bounce-icon mb-4"></i>
                <h3 class="font-bold text-lg">Glissez un fichier</h3>
                <p class="text-sm text-gray-500">ou cliquez pour parcourir</p>
            </div>
        </div>

        <!-- 10. Emoji Feedback -->
        <div class="lab-card">
            <span class="lab-title">10. Morphing Feedback</span>
            <div class="emoji-slider-container">
                <div class="feedback-emoji">😐</div>
                <input type="range" min="0" max="100" value="50" class="custom-range" id="emoji-slider">
                <p class="text-sm text-gray-400 mt-4">Comment évaluez-vous cette expérience ?</p>
            </div>
        </div>

    </div>

    <!-- SECTION 2: DEVELOPER EXPERIENCE -->
    <div class="max-w-7xl mx-auto px-4 pt-16 pb-4 text-center">
        <h2
            class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-indigo-400 mb-2">
            DEVELOPER EXPERIENCE</h2>
        <p class="text-gray-400">Interfaces épurées pour développeurs avertis.</p>
    </div>

    <div class="lab-grid max-w-7xl mx-auto pb-20 grid-cols-1 md:grid-cols-2">

        <!-- 11. Pro Shell (Linux) -->
        <div class="lab-card" style="padding: 0; background: transparent; border: none; overflow: visible;">
            <span class="lab-title" style="top: -2rem; left: 0;">11. Pro Shell ~ Linux</span>

            <div
                class="pro-shell-window w-full h-[500px] bg-[#1e1e2e] rounded-xl shadow-2xl overflow-hidden flex flex-col font-mono relative border border-white/10">
                <!-- Title Bar -->
                <div class="bg-[#181825] px-4 py-3 flex items-center justify-between border-b border-white/5">
                    <div class="flex space-x-2">
                        <div class="w-3 h-3 rounded-full bg-[#ff5f56]"></div>
                        <div class="w-3 h-3 rounded-full bg-[#ffbd2e]"></div>
                        <div class="w-3 h-3 rounded-full bg-[#27c93f]"></div>
                    </div>
                    <div class="text-xs text-gray-500 font-medium">camil@portfolio: ~/contact</div>
                    <div class="w-10"></div>
                </div>

                <!-- Terminal Content -->
                <div class="flex-1 p-4 text-[#cdd6f4] text-sm overflow-y-auto scrollbar-hide" id="pro-shell-output">
                    <!-- Dynamic content will be typed here -->
                </div>

                <!-- Input Line -->
                <div class="p-4 pt-0 flex items-center">
                    <span class="text-[#f5c2e7] mr-2">➜</span>
                    <span class="text-[#89b4fa] mr-2">~</span>
                    <input type="text" id="pro-shell-input"
                        class="bg-transparent border-none outline-none text-[#cdd6f4] flex-1 font-bold caret-white"
                        autocomplete="off" autofocus>
                </div>
            </div>
        </div>

        <!-- 12. IDE Experience (VS Code) -->
        <div class="lab-card" style="padding: 0; background: transparent; border: none; overflow: visible;">
            <span class="lab-title" style="top: -2rem; left: 0;">12. IDE Experience</span>

            <div
                class="ide-window w-full h-[500px] bg-[#1e1e1e] rounded-xl shadow-2xl overflow-hidden flex flex-col font-mono border border-white/10">
                <!-- Toolbar -->
                <div class="bg-[#252526] px-4 py-2 flex items-center justify-between text-xs text-gray-400 select-none">
                    <div class="flex space-x-4">
                        <span class="hover:text-white cursor-pointer">File</span>
                        <span class="hover:text-white cursor-pointer">Edit</span>
                        <span class="hover:text-white cursor-pointer">Selection</span>
                        <span class="hover:text-white cursor-pointer">View</span>
                        <span class="hover:text-white cursor-pointer">Go</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>contact.js</span>
                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                    </div>
                </div>

                <!-- Editor Area -->
                <div class="flex flex-1 relative">
                    <!-- Line Numbers -->
                    <div
                        class="w-12 bg-[#1e1e1e] border-r border-white/5 text-gray-600 text-right pr-3 pt-4 text-xs select-none">
                        1<br>2<br>3<br>4<br>5<br>6<br>7<br>8<br>9<br>10<br>11<br>12<br>13
                    </div>

                    <!-- Code -->
                    <div class="flex-1 p-4 text-sm text-[#d4d4d4] font-mono leading-6">
                        <div><span class="text-[#569cd6]">const</span> <span class="text-[#4fc1ff]">message</span> = {
                        </div>

                        <div class="pl-4">
                            <span class="text-[#9cdcfe]">to</span>: <span
                                class="text-[#ce9178]">'camil.belmehdi@...3.fr'</span>,
                        </div>

                        <div class="pl-4 flex items-center">
                            <span class="text-[#9cdcfe]">from</span>:
                            <span class="text-[#ce9178] ml-2">'</span>
                            <input type="text"
                                class="ide-input text-[#ce9178] bg-transparent outline-none w-32 border-b border-transparent focus:border-[#ce9178]/50 placeholder-white/20"
                                placeholder="your_email" id="ide-email">
                            <span class="text-[#ce9178]">'</span>,
                        </div>

                        <div class="pl-4 flex items-center">
                            <span class="text-[#9cdcfe]">name</span>:
                            <span class="text-[#ce9178] ml-2">'</span>
                            <input type="text"
                                class="ide-input text-[#ce9178] bg-transparent outline-none w-32 border-b border-transparent focus:border-[#ce9178]/50 placeholder-white/20"
                                placeholder="your_name" id="ide-name">
                            <span class="text-[#ce9178]">'</span>,
                        </div>

                        <div class="pl-4">
                            <span class="text-[#9cdcfe]">msg</span>: <span class="text-[#ce9178] ml-2">`</span>
                        </div>
                        <div class="pl-8">
                            <textarea
                                class="ide-textarea text-[#ce9178] bg-transparent outline-none w-full h-20 resize-none font-mono placeholder-white/20"
                                placeholder="Write your message here..." id="ide-msg"></textarea>
                        </div>
                        <div class="pl-4">
                            <span class="text-[#ce9178]">`</span>
                        </div>

                        <div>};</div>
                        <div class="mt-4">
                            <span class="text-[#6a9955]">// Click run to send</span><br>
                            <span class="text-[#dcdcaa]">sendMessage</span>(<span
                                class="text-[#9cdcfe]">message</span>);
                        </div>
                    </div>

                    <!-- Play Button -->
                    <button
                        class="absolute top-4 right-4 bg-green-600 hover:bg-green-500 text-white p-2 rounded shadow-lg transition-transform hover:scale-110 active:scale-95"
                        id="ide-run-btn" title="Run Code">
                        <i class="fas fa-play"></i>
                    </button>

                    <!-- Console Overlay -->
                    <div id="ide-console"
                        class="absolute bottom-0 left-12 right-0 h-0 bg-[#181818] border-t border-white/10 transition-all duration-300 overflow-hidden">
                        <div
                            class="flex justify-between items-center px-4 py-1 bg-[#1e1e1e] text-xs text-gray-400 uppercase tracking-wider border-b border-white/5">
                            <span>Console</span>
                            <i class="fas fa-times cursor-pointer hover:text-white"
                                onclick="document.getElementById('ide-console').style.height='0'"></i>
                        </div>
                        <div class="p-2 text-xs font-mono" id="ide-console-output"></div>
                    </div>

                </div>

                <!-- Status Bar -->
                <div class="bg-[#007acc] text-white px-3 py-1 text-[10px] flex justify-between items-center">
                    <div class="flex gap-4">
                        <span><i class="fas fa-code-branch"></i> main</span>
                        <span>0 errors, 0 warnings</span>
                    </div>
                    <div class="flex gap-4">
                        <span>Ln 12, Col 34</span>
                        <span>UTF-8</span>
                        <span>JavaScript</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- SECTION 3: ULTRA PREMIUM COLLECTION -->
    <div class="max-w-7xl mx-auto px-4 pt-16 pb-4 text-center">
        <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-amber-200 to-yellow-500 mb-2">
            ULTRA PREMIUM COLLECTION</h2>
        <p class="text-gray-400">10 Concepts Avant-Gardistes (User Prompts)</p>
    </div>

    <div class="lab-grid max-w-7xl mx-auto pb-20 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

        <!-- 1. Living Glass Organism -->
        <div class="lab-card" id="form-glass-card" style="position: relative; overflow: hidden; background: #05070f;">
            <div class="absolute inset-0 bg-transparent z-0" id="glass-lens-bg"></div>
            <div class="glass-organism relative z-10 p-8 rounded-2xl border border-white/10 backdrop-blur-xl">
                <h3 class="text-2xl font-light text-white mb-6">Contact</h3>
                <div class="space-y-6">
                    <div class="glass-field relative">
                        <input type="text" class="bg-transparent w-full py-2 outline-none text-white relative z-10"
                            placeholder=" ">
                        <label class="absolute left-0 top-2 text-white/50 transition-all">Nom</label>
                        <div class="liquid-line"></div>
                    </div>
                    <div class="glass-field relative">
                        <input type="email" class="bg-transparent w-full py-2 outline-none text-white relative z-10"
                            placeholder=" ">
                        <label class="absolute left-0 top-2 text-white/50 transition-all">Email</label>
                        <div class="liquid-line"></div>
                    </div>
                    <button
                        class="glass-btn mt-4 w-full py-3 rounded-full border border-white/20 relative overflow-hidden group">
                        <span class="relative z-10">Envoyer</span>
                        <div
                            class="specular-sweep absolute inset-0 bg-white/20 -translate-x-full group-hover:animate-sweep">
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <!-- 2. Magnetic Ink -->
        <div class="lab-card bg-black" id="form-magnetic-card">
            <h3 class="text-2xl font-bold text-[#e8ecff] mb-8 tracking-tighter">MAGNETIC</h3>
            <div class="space-y-8 magnetic-form">
                <div class="magnetic-field group">
                    <label class="block text-[#e8ecff] text-sm mb-2 magnetic-label">NAME</label>
                    <input type="text"
                        class="w-full bg-transparent border-b border-[#333] text-[#b6d3fe] outline-none py-2 focus:border-[#b6d3fe] transition-colors caret-transparent magnetic-input">
                </div>
                <div class="magnetic-field group">
                    <label class="block text-[#e8ecff] text-sm mb-2 magnetic-label">EMAIL</label>
                    <input type="email"
                        class="w-full bg-transparent border-b border-[#333] text-[#b6d3fe] outline-none py-2 focus:border-[#b6d3fe] transition-colors caret-transparent magnetic-input">
                </div>
                <button
                    class="w-full py-4 text-[#e8ecff] text-sm font-bold tracking-widest relative overflow-hidden group">
                    <span class="magnetic-btn-text transition-all duration-300 group-hover:opacity-0">SEND
                        MESSAGE</span>
                    <span
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <i class="fas fa-arrow-right text-[#b6d3fe]"></i>
                    </span>
                </button>
            </div>
        </div>

        <!-- 3. Blueprint Hologram -->
        <div class="lab-card bg-[#001] " id="form-blueprint-card"
            style="background-image: linear-gradient(rgba(0,100,255,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,100,255,0.1) 1px, transparent 1px); background-size: 20px 20px;">
            <div class="holo-interface p-6 border border-blue-900/50 relative">
                <!-- Holo decorative corners -->
                <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-blue-400"></div>
                <div class="absolute top-0 right-0 w-2 h-2 border-t border-r border-blue-400"></div>
                <div class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-blue-400"></div>
                <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-blue-400"></div>

                <h3 class="text-blue-400 font-mono text-xs mb-6 uppercase tracking-widest">Sys.Construct_v9</h3>
                <div class="space-y-4">
                    <div class="holo-input-container relative">
                        <label class="text-[10px] text-blue-600 uppercase">Input_Stream_01</label>
                        <input type="text"
                            class="w-full bg-blue-900/10 border border-blue-900 text-blue-300 font-mono text-xs p-2 focus:border-blue-400 focus:shadow-[0_0_10px_rgba(59,130,246,0.5)] outline-none transition-all">
                        <div class="holo-calib hidden absolute -right-2 top-1/2 w-4 h-[1px] bg-blue-500"></div>
                    </div>
                    <button
                        class="holo-compile w-full py-2 bg-blue-900/20 border border-blue-800 text-blue-400 text-xs uppercase hover:bg-blue-500/20 transition-all">
                        Compile & Transmit
                    </button>
                </div>
            </div>
        </div>

        <!-- 4. Time Capsule -->
        <div class="lab-card flex items-center justify-center" id="form-time-card">
            <div
                class="time-interface relative w-64 h-64 rounded-full border border-white/10 flex items-center justify-center">
                <div
                    class="time-ring absolute inset-0 rounded-full border-t border-r border-white/80 transition-all duration-500">
                </div>

                <div
                    class="time-form w-48 text-center bg-black/50 backdrop-blur-md rounded-full p-4 relative z-10 overflow-hidden h-48 flex flex-col justify-center">
                    <div class="time-step active" data-step="1">
                        <label class="text-xs text-gray-400 uppercase">Year 2026</label>
                        <input type="text" placeholder="Your Name"
                            class="bg-transparent text-center border-b border-white/20 text-white outline-none w-full text-sm py-1 mt-2 focus:border-white">
                    </div>
                    <div class="time-step hidden" data-step="2">
                        <label class="text-xs text-gray-400 uppercase">Message</label>
                        <textarea
                            class="bg-transparent text-center border-none text-white outline-none w-full text-xs py-1 mt-2 resize-none h-16"
                            placeholder="For the future..."></textarea>
                    </div>
                    <div class="time-controls mt-2 flex justify-center gap-2">
                        <button class="w-2 h-2 rounded-full bg-white/20 hover:bg-white"></button>
                        <button class="w-2 h-2 rounded-full bg-white/20 hover:bg-white"></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. Kinetic Paper Fold -->
        <div class="lab-card overflow-visible" id="form-paper-card">
            <div class="perspective-1000 w-full h-64 flex items-center justify-center">
                <div
                    class="kinetic-paper bg-[#f0f0f0] text-gray-800 w-64 h-80 p-6 shadow-xl relative transition-transform duration-500 transform-style-3d">
                    <div
                        class="absolute top-0 left-0 w-full h-1/2 bg-[#f8f8f8] origin-bottom transition-transform duration-300 fold-flap-top z-10 border-b border-gray-200">
                    </div>
                    <div class="content relative z-0 mt-8">
                        <h3 class="font-serif text-xl mb-4">Note</h3>
                        <input type="text" placeholder="Subject"
                            class="w-full bg-transparent border-b border-gray-300 outline-none mb-4 text-sm font-serif">
                        <textarea placeholder="Write here..."
                            class="w-full bg-transparent border-none outline-none text-sm font-serif resize-none h-20"></textarea>
                    </div>
                    <button
                        class="absolute bottom-4 right-4 text-xs font-bold uppercase tracking-widest hover:text-red-500 transition-colors">Fold</button>
                </div>
            </div>
        </div>

        <!-- 6. Reactive Aura -->
        <div class="lab-card" id="form-aura-card">
            <h3 class="text-center font-light text-white/50 mb-8">AURA FIELD</h3>
            <div class="aura-container space-y-8 relative px-4">
                <div class="aura-field relative">
                    <input type="text"
                        class="w-full bg-transparent border border-white/20 rounded-full py-3 px-6 text-white outline-none relative z-10"
                        placeholder="Identity">
                    <div
                        class="aura-glow absolute inset-0 rounded-full bg-purple-500/20 blur-xl opacity-0 transition-opacity duration-300 -z-0">
                    </div>
                </div>
                <div class="aura-field relative">
                    <input type="text"
                        class="w-full bg-transparent border border-white/20 rounded-full py-3 px-6 text-white outline-none relative z-10"
                        placeholder="Frequency">
                    <div
                        class="aura-glow absolute inset-0 rounded-full bg-blue-500/20 blur-xl opacity-0 transition-opacity duration-300 -z-0">
                    </div>
                </div>
            </div>
        </div>

        <!-- 7. Signal Noise -->
        <div class="lab-card relative overflow-hidden" id="form-noise-card">
            <div class="absolute inset-0 bg-noise opacity-10 pointer-events-none"></div> <!-- CSS Noise BG -->
            <div
                class="noise-content transition-all duration-500 blur-[2px] hover:blur-none opacity-80 hover:opacity-100 p-8">
                <h3 class="font-mono text-green-500 mb-6">SIGNAL_LOST...</h3>
                <input type="text"
                    class="block w-full bg-black border border-green-900 p-2 text-green-500 font-mono text-sm mb-4 outline-none focus:border-green-400 focus:shadow-[0_0_15px_rgba(74,222,128,0.2)] transition-all"
                    placeholder="Re-establish link...">
                <button
                    class="text-green-500 border border-green-500 px-4 py-2 hover:bg-green-500 hover:text-black transition-colors font-mono text-xs">BROADCAST</button>
            </div>
        </div>

        <!-- 8. Constellation Sender -->
        <div class="lab-card overflow-hidden relative" id="form-constellation-card">
            <canvas id="constellation-canvas" class="absolute inset-0 z-0"></canvas>
            <div class="relative z-10 p-8 bg-black/20 backdrop-blur-sm h-full flex flex-col justify-center">
                <input type="text"
                    class="constell-input bg-transparent border-b border-white/20 text-white w-full mb-6 pb-2 outline-none focus:border-white transition-colors text-center placeholder-white/30"
                    placeholder="Star Name">
                <input type="text"
                    class="constell-input bg-transparent border-b border-white/20 text-white w-full mb-6 pb-2 outline-none focus:border-white transition-colors text-center placeholder-white/30"
                    placeholder="Galaxy Origin">
            </div>
        </div>

        <!-- 9. Gravity Well -->
        <div class="lab-card flex items-center justify-center" id="form-gravity-card">
            <div
                class="gravity-wrapper relative w-full h-full p-8 flex flex-col justify-center items-center transition-all duration-300">
                <div class="gravity-element mb-6 w-full max-w-xs transition-transform duration-500">
                    <label class="block text-xs text-gray-500 mb-1 text-center">MASS 1</label>
                    <input type="text"
                        class="w-full bg-[#222] rounded-lg py-3 px-4 text-white text-center outline-none focus:scale-110 focus:bg-[#333] transition-all duration-500"
                        placeholder="Graviton">
                </div>
                <div class="gravity-element w-full max-w-xs transition-transform duration-500">
                    <label class="block text-xs text-gray-500 mb-1 text-center">MASS 2</label>
                    <input type="text"
                        class="w-full bg-[#222] rounded-lg py-3 px-4 text-white text-center outline-none focus:scale-110 focus:bg-[#333] transition-all duration-500"
                        placeholder="Photon">
                </div>
            </div>
        </div>

        <!-- 10. Encrypted Letter -->
        <div class="lab-card" id="form-crypto-card">
            <h3 class="font-mono text-xs text-gray-500 mb-6 flex justify-between">
                <span>ENCRYPTED_CHANNEL</span>
                <span id="crypto-status" class="text-red-500">UNSECURED</span>
            </h3>
            <div class="space-y-4">
                <div class="crypto-field">
                    <input type="text"
                        class="w-full bg-black border border-gray-800 p-3 text-white font-mono text-sm outline-none focus:border-white transition-colors"
                        data-placeholder="CODENAME" placeholder="CODENAME">
                </div>
                <div class="crypto-field">
                    <input type="text"
                        class="w-full bg-black border border-gray-800 p-3 text-white font-mono text-sm outline-none focus:border-white transition-colors"
                        data-placeholder="SECRET KEY" placeholder="SECRET KEY">
                </div>
                <button
                    class="w-full bg-white text-black font-bold py-3 text-xs uppercase hover:bg-gray-200 transition-colors"
                    id="crypto-send">Encrypt & Send</button>
            </div>
        </div>

    </div>

    <!-- SECTION 4: SKILLS CLOUD INTELLIGENCE -->
    <section id="skills-section">
        <canvas id="skills-canvas"></canvas>

        <div class="skills-container">
            <div class="skills-header">
                <h2 class="skills-title">COMPÉTENCES TECHNIQUES</h2>
                <p class="skills-subtitle">Survolez les cartes pour visualiser l'empreinte numérique.</p>
            </div>

            <div class="skills-grid">

                <!-- JS -->
                <div class="skill-card" data-skill="js" tabindex="0">
                    <div class="skill-header-row">
                        <h3 class="skill-name">JavaScript</h3>
                        <i class="fab fa-js skill-icon"></i>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag">ES6+</span>
                        <span class="skill-tag">DOM</span>
                        <span class="skill-tag">Canvas</span>
                    </div>
                    <p class="skill-desc">Logique interactive, animations GSAP et manipulation de données.</p>
                    <div class="skill-level-container" aria-label="Niveau: 90%">
                        <div class="skill-level-bar" style="width: 90%"></div>
                    </div>
                </div>

                <!-- PHP -->
                <div class="skill-card" data-skill="php" tabindex="0">
                    <div class="skill-header-row">
                        <h3 class="skill-name">PHP / Laravel</h3>
                        <i class="fab fa-php skill-icon"></i>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag">Backend</span>
                        <span class="skill-tag">MVC</span>
                        <span class="skill-tag">API</span>
                    </div>
                    <p class="skill-desc">Architecture robuste et traitement de données sécurisé.</p>
                    <div class="skill-level-container" aria-label="Niveau: 85%">
                        <div class="skill-level-bar" style="width: 85%"></div>
                    </div>
                </div>

                <!-- CSS -->
                <div class="skill-card" data-skill="css" tabindex="0">
                    <div class="skill-header-row">
                        <h3 class="skill-name">CSS / Tailwind</h3>
                        <i class="fab fa-css3-alt skill-icon"></i>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag">Responsive</span>
                        <span class="skill-tag">Flex/Grid</span>
                        <span class="skill-tag">Animations</span>
                    </div>
                    <p class="skill-desc">Design system, intégration pixel-perfect et interfaces fluides.</p>
                    <div class="skill-level-container" aria-label="Niveau: 95%">
                        <div class="skill-level-bar" style="width: 95%"></div>
                    </div>
                </div>

                <!-- HTML -->
                <div class="skill-card" data-skill="html" tabindex="0">
                    <div class="skill-header-row">
                        <h3 class="skill-name">HTML5 / Accessibilité</h3>
                        <i class="fab fa-html5 skill-icon"></i>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag">Sémantique</span>
                        <span class="skill-tag">SEO</span>
                        <span class="skill-tag">WAI-ARIA</span>
                    </div>
                    <p class="skill-desc">Structure sémantique optimisée pour le référencement.</p>
                    <div class="skill-level-container" aria-label="Niveau: 100%">
                        <div class="skill-level-bar" style="width: 100%"></div>
                    </div>
                </div>

                <!-- MySQL -->
                <div class="skill-card" data-skill="mysql" tabindex="0">
                    <div class="skill-header-row">
                        <h3 class="skill-name">MySQL</h3>
                        <i class="fas fa-database skill-icon"></i>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag">Relationnel</span>
                        <span class="skill-tag">Requêtes</span>
                        <span class="skill-tag">Optimisation</span>
                    </div>
                    <p class="skill-desc">Gestion de bases de données et intégrité des données.</p>
                    <div class="skill-level-container" aria-label="Niveau: 80%">
                        <div class="skill-level-bar" style="width: 80%"></div>
                    </div>
                </div>

                <!-- Git -->
                <div class="skill-card" data-skill="git" tabindex="0">
                    <div class="skill-header-row">
                        <h3 class="skill-name">Git / DevOps</h3>
                        <i class="fab fa-git-alt skill-icon"></i>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag">Versioning</span>
                        <span class="skill-tag">CI/CD</span>
                        <span class="skill-tag">Workflow</span>
                    </div>
                    <p class="skill-desc">Collaboration et gestion de versions de code.</p>
                    <div class="skill-level-container" aria-label="Niveau: 85%">
                        <div class="skill-level-bar" style="width: 85%"></div>
                    </div>
                </div>

                <!-- Docker -->
                <div class="skill-card" data-skill="docker" tabindex="0">
                    <div class="skill-header-row">
                        <h3 class="skill-name">Docker</h3>
                        <i class="fab fa-docker skill-icon"></i>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag">Conteneurs</span>
                        <span class="skill-tag">Déploiement</span>
                        <span class="skill-tag">Environnement</span>
                    </div>
                    <p class="skill-desc">Virtualisation légère pour des environnements iso.</p>
                    <div class="skill-level-container" aria-label="Niveau: 75%">
                        <div class="skill-level-bar" style="width: 75%"></div>
                    </div>
                </div>

                <!-- Linux -->
                <div class="skill-card" data-skill="linux" tabindex="0">
                    <div class="skill-header-row">
                        <h3 class="skill-name">Linux / Système</h3>
                        <i class="fab fa-linux skill-icon"></i>
                    </div>
                    <div class="skill-tags">
                        <span class="skill-tag">Shell</span>
                        <span class="skill-tag">Admin</span>
                        <span class="skill-tag">Sécurité</span>
                    </div>
                    <p class="skill-desc">Administration système et script bash.</p>
                    <div class="skill-level-container" aria-label="Niveau: 80%">
                        <div class="skill-level-bar" style="width: 80%"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="assets/js/main.js"></script> <!-- Core JS for cursor -->
    <script src="assets/js/forms.js"></script> <!-- Specific Lab JS -->
    <script src="assets/js/skills-cloud.js"></script> <!-- Skills Canvas -->
    <script src="assets/js/skills-cards.js"></script> <!-- Skills Interaction -->

</body>

</html>