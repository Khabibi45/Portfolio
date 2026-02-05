<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pastel Builder | Camil Belmehdi</title>

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
            background-image: url('https://images.unsplash.com/photo-1551650975-87deedd944c3?q=80&w=1600');
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
                PHP / GSAP
            </span>
            <h1 class="text-5xl md:text-8xl font-black mb-6 leading-tight">
                PASTEL BUILDER
            </h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-10">
                Un générateur de sites web avec système de modules et thèmes personnalisables. Interface drag & drop et
                prévisualisation en temps réel.
            </p>
            <div class="flex gap-4 justify-center">
                <button
                    class="px-8 py-3 rounded-full bg-white text-dark font-bold hover:scale-105 transition-transform">
                    Voir la démo
                </button>
                <button class="px-8 py-3 rounded-full glass-panel hover:bg-white/10 transition-colors">
                    GitHub
                </button>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-20 bg-dark">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">À propos du projet</h2>
            <div class="prose prose-invert lg:prose-xl">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat.
                </p>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
</body>

</html>