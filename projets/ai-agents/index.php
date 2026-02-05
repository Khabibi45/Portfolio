<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Agents | Camil Belmehdi</title>

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

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">

    <!-- Screen Transition Manager -->
    <script src="../../assets/js/transition-manager.js"></script>

    <style>
        .hero-bg {
            background-image: url('https://images.unsplash.com/photo-1620712943543-bcc4688e7485?q=80&w=1600');
            background-size: cover;
            background-position: center;
        }

        .glass-panel {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="bg-dark text-slate-100 antialiased">

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-nav transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a href="../../index.php" class="flex-shrink-0 cursor-pointer">
                    <span
                        class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">
                        <i class="fas fa-arrow-left mr-2"></i> Retour
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="h-screen relative flex items-center justify-center overflow-hidden">
        <!-- Background Image (Matches the card) -->
        <div class="absolute inset-0 hero-bg"></div>
        <div class="absolute inset-0 bg-black/60"></div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
            <span
                class="inline-block py-1 px-3 rounded-full bg-indigo-500/30 border border-indigo-500/50 text-indigo-300 text-sm font-bold tracking-wider mb-6">
                Python / LLM
            </span>
            <h1 class="text-5xl md:text-8xl font-black mb-6 leading-tight">
                AI AGENTS
            </h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-10">
                Développement d'agents autonomes pour la génération de contenu, l'analyse de données et l'interaction
                client intelligente.
            </p>
            <div class="flex gap-4 justify-center">
                <button
                    class="px-8 py-3 rounded-full bg-white text-dark font-bold hover:scale-105 transition-transform">
                    Voir la démo
                </button>
            </div>
        </div>
    </section>

    <!-- Tech Stack Section -->
    <section class="py-20 bg-dark relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2
                class="text-3xl md:text-5xl font-black text-center mb-16 bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">
                Stack Technique
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                <!-- Python -->
                <div
                    class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-default">
                    <img src="https://cdn.simpleicons.org/python/white" alt="Python"
                        class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-gray-200">Python</span>
                </div>

                <!-- OpenAI -->
                <div
                    class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-default">
                    <img src="https://cdn.simpleicons.org/openai/white" alt="OpenAI"
                        class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-gray-200">OpenAI</span>
                </div>

                <!-- LangChain -->
                <div
                    class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-default">
                    <img src="https://cdn.simpleicons.org/langchain/white" alt="LangChain"
                        class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-gray-200">LangChain</span>
                </div>

                <!-- FastAPI -->
                <div
                    class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-default">
                    <img src="https://cdn.simpleicons.org/fastapi/white" alt="FastAPI"
                        class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-gray-200">FastAPI</span>
                </div>

                <!-- Docker -->
                <div
                    class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-default">
                    <img src="https://cdn.simpleicons.org/docker/white" alt="Docker"
                        class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-gray-200">Docker</span>
                </div>

                <!-- Git -->
                <div
                    class="glass-panel p-6 rounded-2xl flex flex-col items-center justify-center hover:scale-105 transition-transform duration-300 group cursor-default">
                    <img src="https://cdn.simpleicons.org/git/white" alt="Git"
                        class="w-12 h-12 mb-4 group-hover:brightness-125 transition-all opacity-90">
                    <span class="font-bold text-gray-200">Git</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
</body>

</html>