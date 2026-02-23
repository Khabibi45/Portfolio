<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motion Design Lab — Camil Belmehdi</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/lab-motion.css">
</head>
<body>

    <!-- Side progress -->
    <nav class="mo-progress" id="mo-progress" aria-label="Section progress">
        <a href="#mo-hero" class="mo-progress__dot is-active" data-section="mo-hero"></a>
        <a href="#mo-01" class="mo-progress__dot" data-section="mo-01"></a>
        <a href="#mo-02" class="mo-progress__dot" data-section="mo-02"></a>
        <a href="#mo-03" class="mo-progress__dot" data-section="mo-03"></a>
        <a href="#mo-04" class="mo-progress__dot" data-section="mo-04"></a>
        <a href="#mo-05" class="mo-progress__dot" data-section="mo-05"></a>
        <a href="#mo-06" class="mo-progress__dot" data-section="mo-06"></a>
        <a href="#mo-07" class="mo-progress__dot" data-section="mo-07"></a>
        <a href="#mo-08" class="mo-progress__dot" data-section="mo-08"></a>
        <a href="#mo-09" class="mo-progress__dot" data-section="mo-09"></a>
        <a href="#mo-10" class="mo-progress__dot" data-section="mo-10"></a>
    </nav>

    <!-- Back -->
    <a href="lab.php" class="mo-back">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Lab
    </a>

    <!-- ═══════════════════════════════════════════════════════════
         HERO
         ═══════════════════════════════════════════════════════════ -->
    <section class="mo-hero" id="mo-hero">
        <div class="mo-hero__line"></div>
        <h1 class="mo-hero__title">
            <span class="mo-hero__word mo-hero__word--fill" data-delay="0">MOTION</span>
            <span class="mo-hero__word mo-hero__word--stroke" data-delay="1">DESIGN</span>
        </h1>
        <p class="mo-hero__sub">10 modules interactifs &mdash; scroll pour explorer</p>
        <div class="mo-hero__scroll">
            <div class="mo-hero__scroll-line"></div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         01 — MAGNETIC LETTERS
         ═══════════════════════════════════════════════════════════ -->
    <section class="mo-section" id="mo-01">
        <div class="mo-section__header">
            <span class="mo-num">01</span>
            <h2 class="mo-section__title">Magnetic Letters</h2>
            <p class="mo-section__desc">Hover to repel. Physics-based spring animation on each glyph.</p>
        </div>
        <div class="mo-section__demo mo-magnetic" id="magnetic-demo">
            <h3 class="mo-magnetic__text" data-magnetic>INTERACTION</h3>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         02 — LIQUID BLOBS
         ═══════════════════════════════════════════════════════════ -->
    <section class="mo-section" id="mo-02">
        <div class="mo-section__header">
            <span class="mo-num">02</span>
            <h2 class="mo-section__title">Liquid Blobs</h2>
            <p class="mo-section__desc">Organic SVG shapes morphing with sine-based noise.</p>
        </div>
        <div class="mo-section__demo mo-blobs" id="blobs-demo">
            <svg class="mo-blobs__svg" viewBox="0 0 800 500" preserveAspectRatio="xMidYMid meet">
                <defs>
                    <linearGradient id="blob-grad-1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#7dd3fc"/>
                        <stop offset="100%" stop-color="#a78bfa"/>
                    </linearGradient>
                    <linearGradient id="blob-grad-2" x1="0%" y1="100%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#fb923c"/>
                        <stop offset="100%" stop-color="#f472b6"/>
                    </linearGradient>
                    <linearGradient id="blob-grad-3" x1="50%" y1="0%" x2="50%" y2="100%">
                        <stop offset="0%" stop-color="#4ade80"/>
                        <stop offset="100%" stop-color="#7dd3fc"/>
                    </linearGradient>
                </defs>
                <path class="mo-blobs__path" id="blob-1" fill="url(#blob-grad-1)" opacity="0.7"/>
                <path class="mo-blobs__path" id="blob-2" fill="url(#blob-grad-2)" opacity="0.5"/>
                <path class="mo-blobs__path" id="blob-3" fill="url(#blob-grad-3)" opacity="0.6"/>
            </svg>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         03 — PARALLAX DEPTH
         ═══════════════════════════════════════════════════════════ -->
    <section class="mo-section" id="mo-03">
        <div class="mo-section__header">
            <span class="mo-num">03</span>
            <h2 class="mo-section__title">Parallax Depth</h2>
            <p class="mo-section__desc">Multi-layer mouse tracking. Move to feel the depth.</p>
        </div>
        <div class="mo-section__demo mo-parallax" id="parallax-demo">
            <div class="mo-parallax__layer" data-depth="0.02">
                <div class="mo-parallax__circle mo-parallax__circle--1"></div>
                <div class="mo-parallax__circle mo-parallax__circle--2"></div>
            </div>
            <div class="mo-parallax__layer" data-depth="0.05">
                <div class="mo-parallax__line mo-parallax__line--1"></div>
                <div class="mo-parallax__line mo-parallax__line--2"></div>
                <div class="mo-parallax__ring"></div>
            </div>
            <div class="mo-parallax__layer" data-depth="0.09">
                <div class="mo-parallax__cross mo-parallax__cross--1">+</div>
                <div class="mo-parallax__cross mo-parallax__cross--2">+</div>
                <div class="mo-parallax__dot mo-parallax__dot--1"></div>
                <div class="mo-parallax__dot mo-parallax__dot--2"></div>
                <div class="mo-parallax__dot mo-parallax__dot--3"></div>
            </div>
            <div class="mo-parallax__layer" data-depth="0.14">
                <span class="mo-parallax__label">DEPTH</span>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         04 — KINETIC TYPOGRAPHY
         ═══════════════════════════════════════════════════════════ -->
    <section class="mo-section" id="mo-04">
        <div class="mo-section__header">
            <span class="mo-num">04</span>
            <h2 class="mo-section__title">Kinetic Typography</h2>
            <p class="mo-section__desc">Scroll-triggered word reveals with staggered clip-path.</p>
        </div>
        <div class="mo-section__demo mo-kinetic" id="kinetic-demo">
            <p class="mo-kinetic__line">
                <span class="mo-kinetic__word" style="--i:0">Design</span>
                <span class="mo-kinetic__word" style="--i:1">is</span>
                <span class="mo-kinetic__word" style="--i:2">not</span>
                <span class="mo-kinetic__word mo-kinetic__word--accent" style="--i:3">decoration.</span>
            </p>
            <p class="mo-kinetic__line">
                <span class="mo-kinetic__word" style="--i:4">It</span>
                <span class="mo-kinetic__word" style="--i:5">is</span>
                <span class="mo-kinetic__word mo-kinetic__word--accent" style="--i:6">communication</span>
            </p>
            <p class="mo-kinetic__line">
                <span class="mo-kinetic__word" style="--i:7">at</span>
                <span class="mo-kinetic__word" style="--i:8">its</span>
                <span class="mo-kinetic__word mo-kinetic__word--stroke" style="--i:9">purest</span>
                <span class="mo-kinetic__word" style="--i:10">form.</span>
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         05 — VELOCITY CARDS
         ═══════════════════════════════════════════════════════════ -->
    <section class="mo-section" id="mo-05">
        <div class="mo-section__header">
            <span class="mo-num">05</span>
            <h2 class="mo-section__title">Velocity Cards</h2>
            <p class="mo-section__desc">Cards skew based on scroll speed. Inertia-driven physics.</p>
        </div>
        <div class="mo-section__demo mo-velocity" id="velocity-demo">
            <div class="mo-velocity__card" style="--accent: #7dd3fc">
                <span class="mo-velocity__card-num">01</span>
                <h4>Strategy</h4>
                <p>Research-driven decisions at every step.</p>
            </div>
            <div class="mo-velocity__card" style="--accent: #a78bfa">
                <span class="mo-velocity__card-num">02</span>
                <h4>Design</h4>
                <p>Pixel-perfect interfaces that breathe.</p>
            </div>
            <div class="mo-velocity__card" style="--accent: #fb923c">
                <span class="mo-velocity__card-num">03</span>
                <h4>Develop</h4>
                <p>Clean code, performant delivery.</p>
            </div>
            <div class="mo-velocity__card" style="--accent: #4ade80">
                <span class="mo-velocity__card-num">04</span>
                <h4>Launch</h4>
                <p>Seamless deployment, continuous iteration.</p>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         06 — AURORA
         ═══════════════════════════════════════════════════════════ -->
    <section class="mo-section" id="mo-06">
        <div class="mo-section__header">
            <span class="mo-num">06</span>
            <h2 class="mo-section__title">Aurora Borealis</h2>
            <p class="mo-section__desc">Flowing gradient bands rendered in real-time on canvas.</p>
        </div>
        <div class="mo-section__demo mo-aurora" id="aurora-demo">
            <canvas class="mo-aurora__canvas" id="aurora-canvas"></canvas>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         07 — PARTICLE CONSTELLATION
         ═══════════════════════════════════════════════════════════ -->
    <section class="mo-section" id="mo-07">
        <div class="mo-section__header">
            <span class="mo-num">07</span>
            <h2 class="mo-section__title">Constellation</h2>
            <p class="mo-section__desc">Particles forming a network. Hover to interact.</p>
        </div>
        <div class="mo-section__demo mo-particles" id="particles-demo">
            <canvas class="mo-particles__canvas" id="particles-canvas"></canvas>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         08 — TEXT SCRAMBLE
         ═══════════════════════════════════════════════════════════ -->
    <section class="mo-section" id="mo-08">
        <div class="mo-section__header">
            <span class="mo-num">08</span>
            <h2 class="mo-section__title">Text Scramble</h2>
            <p class="mo-section__desc">Characters decode on scroll. Randomize then resolve.</p>
        </div>
        <div class="mo-section__demo mo-scramble" id="scramble-demo">
            <p class="mo-scramble__line" data-text="CREATIVE DEVELOPER">CREATIVE DEVELOPER</p>
            <p class="mo-scramble__line" data-text="MOTION ENTHUSIAST">MOTION ENTHUSIAST</p>
            <p class="mo-scramble__line" data-text="PIXEL PERFECTIONIST">PIXEL PERFECTIONIST</p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         09 — INFINITE MARQUEE
         ═══════════════════════════════════════════════════════════ -->
    <section class="mo-section" id="mo-09">
        <div class="mo-section__header">
            <span class="mo-num">09</span>
            <h2 class="mo-section__title">Infinite Marquee</h2>
            <p class="mo-section__desc">Continuous scroll ribbons. Hover to warp speed.</p>
        </div>
        <div class="mo-section__demo mo-marquee" id="marquee-demo">
            <div class="mo-marquee__row mo-marquee__row--1">
                <div class="mo-marquee__track">
                    <span>DESIGN &mdash; </span><span>DEVELOP &mdash; </span><span>DEPLOY &mdash; </span><span>ITERATE &mdash; </span>
                    <span>DESIGN &mdash; </span><span>DEVELOP &mdash; </span><span>DEPLOY &mdash; </span><span>ITERATE &mdash; </span>
                </div>
            </div>
            <div class="mo-marquee__row mo-marquee__row--2">
                <div class="mo-marquee__track mo-marquee__track--reverse">
                    <span>STRATEGY &bull; </span><span>BRANDING &bull; </span><span>MOTION &bull; </span><span>UI/UX &bull; </span>
                    <span>STRATEGY &bull; </span><span>BRANDING &bull; </span><span>MOTION &bull; </span><span>UI/UX &bull; </span>
                </div>
            </div>
            <div class="mo-marquee__row mo-marquee__row--3">
                <div class="mo-marquee__track">
                    <span>CREATIVE CODE &mdash; </span><span>INTERACTIVE ART &mdash; </span><span>GENERATIVE DESIGN &mdash; </span>
                    <span>CREATIVE CODE &mdash; </span><span>INTERACTIVE ART &mdash; </span><span>GENERATIVE DESIGN &mdash; </span>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════
         10 — 3D TILT CARDS
         ═══════════════════════════════════════════════════════════ -->
    <section class="mo-section" id="mo-10">
        <div class="mo-section__header">
            <span class="mo-num">10</span>
            <h2 class="mo-section__title">3D Tilt Cards</h2>
            <p class="mo-section__desc">Perspective tracking with dynamic light reflection.</p>
        </div>
        <div class="mo-section__demo mo-tilt" id="tilt-demo">
            <div class="mo-tilt__card" data-tilt>
                <div class="mo-tilt__gloss"></div>
                <img src="assets/images/projets/fluidanse-org.png" alt="Fluidanse" class="mo-tilt__img">
                <div class="mo-tilt__info">
                    <span class="mo-tilt__tag">UI/UX</span>
                    <h4>Fluidanse</h4>
                </div>
            </div>
            <div class="mo-tilt__card" data-tilt>
                <div class="mo-tilt__gloss"></div>
                <img src="assets/images/projets/delfoin-multiservices.png" alt="Delfoin" class="mo-tilt__img">
                <div class="mo-tilt__info">
                    <span class="mo-tilt__tag">Web Dev</span>
                    <h4>Delfoin</h4>
                </div>
            </div>
            <div class="mo-tilt__card" data-tilt>
                <div class="mo-tilt__gloss"></div>
                <img src="assets/images/projets/site builder.png" alt="Site Builder" class="mo-tilt__img">
                <div class="mo-tilt__info">
                    <span class="mo-tilt__tag">SaaS</span>
                    <h4>Site Builder</h4>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/js/lab-motion.js"></script>
</body>
</html>
