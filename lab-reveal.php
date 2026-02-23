<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Reveal Lab — Camil Belmehdi</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Lab Reveal CSS -->
    <link rel="stylesheet" href="assets/css/lab-reveal.css">
</head>

<body>
    <!-- ═══════════════════════════════════════════════════════════════
         HERO — Image Reveal on Hover
         ═══════════════════════════════════════════════════════════════ -->
    <section class="reveal-hero" id="reveal-hero">
        <!-- Canvas layer (the reveal happens here) -->
        <canvas class="reveal-hero__canvas" id="reveal-canvas"></canvas>

        <!-- Fallback / base image (visible by default) -->
        <img
            class="reveal-hero__img reveal-hero__img--base"
            src="assets/images/Montagne_PP.jpg"
            alt="Montagne — image de base"
            id="img-base"
        >
        <!-- Hidden / revealed image -->
        <img
            class="reveal-hero__img reveal-hero__img--reveal"
            src="assets/images/Estaragne_pic.png"
            alt="Pic d'Estaragne — image révélée"
            id="img-reveal"
        >

        <!-- Overlay content -->
        <div class="reveal-hero__overlay">
            <div class="reveal-hero__content">
                <span class="reveal-hero__overline">Image Reveal Lab</span>
                <h1 class="reveal-hero__title">Hover to<br><span class="reveal-hero__title--accent">Reveal</span></h1>
                <p class="reveal-hero__subtitle">Move your cursor to unveil the hidden image beneath.</p>
            </div>
        </div>

        <!-- Effect Selector (bottom bar) -->
        <nav class="reveal-hero__effects" id="effects-bar">
            <span class="reveal-hero__effects-label">Effect:</span>
            <div class="reveal-hero__effects-list">
                <!-- Groupe 1 — Classiques -->
                <button class="reveal-hero__effect-btn is-active" data-effect="circle">
                    <span class="reveal-hero__effect-icon">&#9679;</span>
                    Circle
                </button>
                <button class="reveal-hero__effect-btn" data-effect="fog">
                    <span class="reveal-hero__effect-icon">&#9788;</span>
                    Brume
                </button>
                <button class="reveal-hero__effect-btn" data-effect="paint">
                    <span class="reveal-hero__effect-icon">&#9998;</span>
                    Peinture
                </button>
                <button class="reveal-hero__effect-btn" data-effect="pixel">
                    <span class="reveal-hero__effect-icon">&#9638;</span>
                    Pixel
                </button>
                <!-- Groupe 2 — Dynamiques -->
                <span class="reveal-hero__effects-sep"></span>
                <button class="reveal-hero__effect-btn" data-effect="ripple">
                    <span class="reveal-hero__effect-icon">&#8776;</span>
                    Ondulation
                </button>
                <button class="reveal-hero__effect-btn" data-effect="xray">
                    <span class="reveal-hero__effect-icon">&#9672;</span>
                    X-Ray
                </button>
                <button class="reveal-hero__effect-btn" data-effect="shatter">
                    <span class="reveal-hero__effect-icon">&#9830;</span>
                    Bris&eacute;
                </button>
                <button class="reveal-hero__effect-btn" data-effect="swirl">
                    <span class="reveal-hero__effect-icon">&#10042;</span>
                    Spirale
                </button>
                <!-- Groupe 3 — Avanc&eacute;s -->
                <span class="reveal-hero__effects-sep"></span>
                <button class="reveal-hero__effect-btn" data-effect="thermal">
                    <span class="reveal-hero__effect-icon">&#9832;</span>
                    Thermal
                </button>
                <button class="reveal-hero__effect-btn" data-effect="glitch">
                    <span class="reveal-hero__effect-icon">&#9107;</span>
                    Glitch
                </button>
                <button class="reveal-hero__effect-btn" data-effect="smoke">
                    <span class="reveal-hero__effect-icon">&#9729;</span>
                    Smoke
                </button>
                <button class="reveal-hero__effect-btn" data-effect="magnetic">
                    <span class="reveal-hero__effect-icon">&#8982;</span>
                    Magn&eacute;tique
                </button>
                <!-- Groupe 4 — Exp&eacute;rimentaux -->
                <span class="reveal-hero__effects-sep"></span>
                <button class="reveal-hero__effect-btn" data-effect="dissolve">
                    <span class="reveal-hero__effect-icon">&#8943;</span>
                    Dissolve
                </button>
                <button class="reveal-hero__effect-btn" data-effect="voronoi">
                    <span class="reveal-hero__effect-icon">&#11042;</span>
                    Voronoi
                </button>
                <button class="reveal-hero__effect-btn" data-effect="ascii">
                    <span class="reveal-hero__effect-icon">A</span>
                    ASCII
                </button>
                <button class="reveal-hero__effect-btn" data-effect="matrix">
                    <span class="reveal-hero__effect-icon">&#9783;</span>
                    Matrix
                </button>
            </div>
        </nav>

        <!-- Brush size control -->
        <div class="reveal-hero__brush-size" id="brush-control">
            <label for="brush-range">Brush</label>
            <input type="range" id="brush-range" min="30" max="250" value="100">
            <button class="reveal-hero__reset-btn" id="reset-btn" title="Reset canvas">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M1 4v6h6M23 20v-6h-6"/>
                    <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"/>
                </svg>
            </button>
        </div>

        <!-- Custom cursor -->
        <div class="reveal-hero__cursor" id="custom-cursor"></div>
    </section>

    <!-- Back link -->
    <a href="lab.php" class="reveal-hero__back">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Lab
    </a>

    <!-- Lab Reveal JS -->
    <script src="assets/js/lab-reveal.js"></script>
</body>

</html>
