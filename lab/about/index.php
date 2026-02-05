<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Lab | Prototypes</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&family=Space+Mono:wght@400;700&display=swap"
        rel="stylesheet">

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <!-- Lab Styles -->
    <link rel="stylesheet" href="lab.css">
</head>

<body>
    <!-- Lab Controls Sidebar -->
    <aside class="lab-sidebar" id="lab-sidebar">
        <div class="lab-header">
            <span class="lab-logo">⚗️</span>
            <h1>ABOUT LAB</h1>
        </div>

        <!-- Prototype List -->
        <nav class="lab-nav">
            <button class="lab-nav-item active" data-prototype="01">#01 Camera Rail</button>
            <button class="lab-nav-item" data-prototype="02">#02 Time Folding</button>
            <button class="lab-nav-item" data-prototype="03">#03 Typo Architecture</button>
            <button class="lab-nav-item" data-prototype="04">#04 Glass Museum</button>
            <button class="lab-nav-item" data-prototype="05">#05 Ink Gravity</button>
            <button class="lab-nav-item" data-prototype="06">#06 Magnetic Timeline</button>
            <button class="lab-nav-item" data-prototype="07">#07 Shadow Theatre</button>
            <button class="lab-nav-item" data-prototype="08">#08 Blueprint Reality</button>
            <button class="lab-nav-item" data-prototype="09">#09 Kinetic Gallery</button>
            <button class="lab-nav-item" data-prototype="10">#10 Continuous Take</button>
            <button class="lab-nav-item featured" data-prototype="11">#11 Mountain Ascent ⭐</button>
        </nav>

        <!-- Controls -->
        <div class="lab-controls">
            <h2>Controls</h2>

            <label class="lab-toggle">
                <input type="checkbox" id="perf-mode">
                <span class="toggle-slider"></span>
                <span class="toggle-label">Perf Mode</span>
            </label>

            <label class="lab-toggle">
                <input type="checkbox" id="reduced-motion">
                <span class="toggle-slider"></span>
                <span class="toggle-label">Reduced Motion</span>
            </label>

            <div class="lab-slider">
                <label>Intensity: <span id="intensity-value">50</span>%</label>
                <input type="range" id="intensity" min="0" max="100" value="50">
            </div>
        </div>

        <!-- FPS Counter -->
        <div class="lab-fps">
            <span>FPS:</span>
            <span id="fps-counter">60</span>
        </div>

        <!-- Back Link -->
        <a href="/Belmehdi_Portfolio/" class="lab-back">← Back to Portfolio</a>
    </aside>

    <!-- Main Viewport -->
    <main class="lab-viewport" id="lab-viewport">
        <!-- Prototype Container -->
        <div class="prototype-container" id="prototype-container">
            <!-- Prototypes are loaded here dynamically -->
        </div>
    </main>

    <!-- Shared Data -->
    <script src="../shared/data.js"></script>

    <!-- Lab Controller -->
    <script src="lab.js"></script>
</body>

</html>