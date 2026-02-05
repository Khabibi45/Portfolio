/**
 * Skills Cloud - Canvas Logic (Enhanced Logos)
 */

class SkillsCloud {
    constructor() {
        this.canvas = document.getElementById('skills-canvas');
        if (!this.canvas) return;

        this.ctx = this.canvas.getContext('2d');
        this.points = [];
        this.width = 0;
        this.height = 0;
        this.targetShape = 'default';
        this.morphId = 0; // NEW: Lock for async morphs
        this.isMobile = window.innerWidth < 768;
        this.maxPoints = this.isMobile ? 1500 : 4000; // Balanced density
        this.animationId = null;
        this.isVisible = true;

        this.colors = { point: '#818cf8', line: 'rgba(99, 102, 241, 0.1)' };

        // --- SHAPE GENERATORS ---
        this.shapes = {
            'default': this.genBlob()
        };

        this.init();
    }

    init() {
        this.resize();
        window.addEventListener('resize', () => {
            this.resize();
            this.isMobile = window.innerWidth < 768;
            this.maxPoints = this.isMobile ? 1500 : 4000;
            this.repopulatePoints();
        });

        // Pre-map icons to CDN URLs (Using solid white icons for better point sampling)
        // These are used ONLY for the cloud morph, not for display
        this.iconMap = {
            'js': 'https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/javascript.svg',
            'php': 'https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/php.svg',
            'css': 'https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/css3.svg',
            'html': 'https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/html5.svg',
            'mysql': 'https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/mysql.svg',
            'git': 'https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/git.svg',
            'docker': 'https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/docker.svg',
            'linux': 'https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/linux.svg',
            'tailwind': 'https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/tailwindcss.svg',
            'sql': 'https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/mysql.svg',
            'java': 'assets/icons/java.svg',
            'automation': 'assets/icons/n8n.svg',
            'python': 'https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/python.svg',
            'ai': 'https://cdn.jsdelivr.net/npm/simple-icons@v11/icons/openai.svg'
        };

        this.skillDescriptions = {
            'html': "Structurer une page de façon sémantique (header/main/section/article/footer)\nConstruire des interfaces accessibles (labels, aria de base, focus, navigation clavier)\nIntégrer des médias (images responsive, vidéo, favicon, meta SEO)\nCréer des formulaires propres (types, validation côté navigateur, contraintes, UX)\nOrganiser un site multi-pages (routing côté serveur, liens propres, structure)",

            'css': "Mise en page moderne : Flexbox, Grid, layouts responsives\nGestion fine du responsive (breakpoints, fluidité, clamp(), unités modernes)\nAnimations/transitions (timing, easing, keyframes, micro-interactions)\nEffets UI premium (glassmorphism, blur, gradients, glow, overlays, shadows)\nArchitecture CSS maintenable (tokens, variables CSS, séparation par composants)\nOptimisation visuelle (cohérence typographique, spacing system, hiérarchie)",

            'js': "DOM / événements : interactions UI (hover/click/scroll), state simple\nAnimations web (timelines, transitions complexes, effets immersifs)\nGestion de composants “front” maison (modules réutilisables, options, init)\nFetch/API : appels HTTP, gestion réponses/erreurs, async/await\nValidation et logique côté client (formulaires, affichage d’erreurs ciblées)\nPerformance : debounce/throttle, lazy init, réduction des reflows\nIntégration d’outils/libs (ex: GSAP, effets de background type particles)",

            'php': "Backend web : routing, pages dynamiques, templates, formulaires\nArchitecture MVC (contrôleurs / modèles / vues), séparation des responsabilités\nAccès base de données via PDO (requêtes préparées, CRUD, sécurité)\nGestion des sessions, droits, logique d’authentification (selon besoin)\nGestion d’erreurs propre (validation, messages, exceptions)\nSécurisation web : bonnes pratiques d’entrées/sorties, attaques classiques\nOrganisation projet : arborescence claire, code réutilisable, config propre",

            'tailwind': "Construction d’UI rapide et cohérente (utility-first)\nSystèmes de design (couleurs, spacing, typographie) via config/tokens\nResponsive et variantes (hover/focus/dark/breakpoints) très rapidement\nComposants réutilisables (cards, badges, boutons, sections)\nProduction clean : classes maîtrisées, cohérence visuelle, composants homogènes",

            'python': "Scripts utilitaires (automatisation, génération, traitement de données simple)\nManipulation de fichiers (JSON/CSV), parsing, transformation\nAppels API et intégration de services (requests, gestion tokens/headers)\nPrototypage rapide d’outils internes (helpers, petites CLI)\nLogique propre : structures, fonctions, exceptions, organisation",

            'mysql': "Modélisation : tables, relations, clés primaires/étrangères\nRequêtes SQL : SELECT/INSERT/UPDATE/DELETE, jointures, agrégations\nContraintes : NOT NULL, UNIQUE, index, intégrité référentielle\nBonnes pratiques : requêtes préparées (via PDO), prévention injection SQL\nLecture/écriture efficace pour CRUD applicatif (app web typique)",

            'java': "POO solide : classes, héritage, interfaces, encapsulation, polymorphisme\nCollections : List/Map/Set, itérateurs, comparateurs, tri\nProgrammation fonctionnelle moderne : lambdas, interfaces fonctionnelles\nGestion du null propre : Optional, exceptions, validation\nConception : structuration claire, méthodes utilitaires, responsabilités",

            'linux': "Utilisation quotidienne : shell, navigation, gestion fichiers/droits\nAdministration de base : users/groups, permissions, services\nRéseau : diagnostics (ping, curl, ports), logs, outils système\nDéploiement simple : structure serveur, organisation, bonnes pratiques\nCulture “prod” : comprendre environnement, erreurs, journaux, process",

            'docker': "Containerisation d’apps (isoler runtime, reproduire un environnement)\nDockerfile : build, images propres, dépendances, optimisation basique\nDocker Compose : multi-services (app + DB), réseaux, volumes\nExposition ports, variables d’environnement, persistance des données\nDéploiement/preview reproductible (idéal pour montrer des projets à des clients)",

            'automation': "Automatisation no-code/low-code : workflows déclenchés (webhook, cron, events)\nChaînage d’actions : filtres, conditions, transformations, mapping JSON\nIntégrations : APIs tierces, envoi emails, Slack/Discord, Google Sheets, etc.\nConception de flux fiables : gestion erreurs, retries, logs, alerting simple\nIndustrialisation : templates de workflows, réutilisation, paramètres",

            'ai': "Prompting orienté produit : consignes claires, formats stricts, rôles\nIntégration API (logique) : générer du contenu, résumer, classifier, extraire\nAutomatisation IA : pipeline “outil → IA → action” (ex: via n8n)\nQualité : contrôle de sortie (JSON, contraintes, validation), anti-hallucination basique\nCas d’usage concrets : génération de textes, aides UI/UX, assistants, contenu marketing"
        };

        // Display names for card headers
        this.skillDisplayNames = {
            'html': 'HTML5',
            'css': 'CSS3',
            'js': 'JavaScript',
            'php': 'PHP',
            'tailwind': 'Tailwind CSS',
            'python': 'Python',
            'mysql': 'MySQL',
            'java': 'Java',
            'linux': 'Linux',
            'docker': 'Docker',
            'automation': 'n8n Automation',
            'ai': 'OpenAI / IA'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) { this.isVisible = true; this.start(); }
                else { this.isVisible = false; this.stop(); }
            });
        });
        const section = document.getElementById('skills-section') || document.getElementById('skills') || document.body;
        observer.observe(section);

        document.addEventListener('skill:preview', (e) => this.morph(e.detail.key, e.detail.label));
        document.addEventListener('skill:select', (e) => this.morph(e.detail.key, e.detail.label));
        document.addEventListener('skill:clear', () => this.morph('default'));

        this.repopulatePoints();
        this.start();

        // --- AUTO ROTATION ENABLED ---
        this.isHovering = false;
        this.startAutoRotation();
    }

    startAutoRotation() {
        const skills = Object.keys(this.skillDescriptions);
        let currentIndex = 0;

        const rotate = () => {
            if (!this.isHovering) {
                const skill = skills[currentIndex];
                this.morph(skill);
                currentIndex = (currentIndex + 1) % skills.length;
            }
        };

        // Initial delay before first rotation
        setTimeout(() => {
            rotate();
            this.autoRotationInterval = setInterval(rotate, 4000); // Change every 4 seconds
        }, 2000);
    }

    stopAutoRotation() {
        if (this.autoRotationInterval) {
            clearInterval(this.autoRotationInterval);
            this.autoRotationInterval = null;
        }
    }

    manualSelect(key) {
        this.isHovering = true;
        this.morph(key);
    }

    manualLeave() {
        this.isHovering = false;
        // Don't morph to default - let auto-rotation take over
    }

    resize() {
        this.width = this.canvas.parentElement.offsetWidth;
        this.height = this.canvas.parentElement.offsetHeight;
        this.canvas.width = this.width;
        this.canvas.height = this.height;
    }

    repopulatePoints() {
        this.points = [];
        for (let i = 0; i < this.maxPoints; i++) {
            this.points.push({
                x: Math.random() * this.width, y: Math.random() * this.height,
                tx: Math.random() * this.width, ty: Math.random() * this.height,
                vx: (Math.random() - 0.5) * 0.5, // Velocity for life
                vy: (Math.random() - 0.5) * 0.5
            });
        }
        this.morph(this.targetShape);
    }

    // Unified async morph method below

    render() {
        if (!this.isVisible) return;
        this.ctx.clearRect(0, 0, this.width, this.height);

        const isPreset = this.targetShape !== 'default';
        const time = Date.now() * 0.0015; // Time factor for organic movement

        // --- ADAPTIVE RENDERING (Blob vs Preset) ---
        // Increase dot size slightly for better visibility
        const dotSize = isPreset ? 1.4 : (this.isMobile ? 1.2 : 1.8);

        // HUGE Glow increase
        const glowAmount = isPreset ? 25 : (this.isMobile ? 20 : 40);

        // Brighter colors
        const pointColor = isPreset ? 'rgba(165, 180, 252, 0.95)' : this.colors.point;

        this.ctx.beginPath();
        this.ctx.fillStyle = pointColor;
        // Optimization: Shadow blur is extremely expensive for 1500+ points on canvas. 
        // Disabling it for a massive performance boost.
        // this.ctx.shadowBlur = glowAmount;
        // this.ctx.shadowColor = pointColor;

        this.points.forEach(p => {
            // Smooth morphing
            p.x += (p.tx - p.x) * 0.08;
            p.y += (p.ty - p.y) * 0.08;

            // --- PERMANENT ORGANIC MOVEMENT (ALIVE) ---
            // Sine wave offset based on position and time
            const waveX = Math.sin(time + p.y * 0.01) * 0.4;
            const waveY = Math.cos(time + p.x * 0.01) * 0.4;

            // Random brownian motion (jitter)
            p.vx += (Math.random() - 0.5) * 0.02;
            p.vy += (Math.random() - 0.5) * 0.02;
            p.vx *= 0.95; // Friction
            p.vy *= 0.95;

            // Apply movement to drawing position (not physical position to avoid drift)
            const drawX = p.x + waveX + p.vx * 10;
            const drawY = p.y + waveY + p.vy * 10;

            // DRAW POINTS
            this.ctx.moveTo(drawX + dotSize, drawY);
            this.ctx.arc(drawX, drawY, dotSize, 0, Math.PI * 2);
        });
        this.ctx.fill();
        this.ctx.shadowBlur = 0;

        // --- PRESET-ONLY: DATA STREAM CONNECTIONS (Liaisons) ---
        if (isPreset && !this.isMobile) {
            this.ctx.strokeStyle = 'rgba(165, 180, 252, 0.2)'; // Brighter lines
            this.ctx.lineWidth = 0.8;
            this.ctx.beginPath();
            // sample fewer points for lines to keep performance high
            for (let i = 0; i < this.points.length; i += 6) {
                for (let j = i + 1; j < Math.min(i + 4, this.points.length); j++) {
                    const p1 = this.points[i];
                    const p2 = this.points[j];

                    // Apply same offsets for lines
                    const w1X = Math.sin(time + p1.y * 0.01) * 0.4;
                    const w1Y = Math.cos(time + p1.x * 0.01) * 0.4;
                    const w2X = Math.sin(time + p2.y * 0.01) * 0.4;
                    const w2Y = Math.cos(time + p2.x * 0.01) * 0.4;

                    const d1x = p1.x + w1X + p1.vx * 10;
                    const d1y = p1.y + w1Y + p1.vy * 10;
                    const d2x = p2.x + w2X + p2.vx * 10;
                    const d2y = p2.y + w2Y + p2.vy * 10;

                    const d = (d1x - d2x) ** 2 + (d1y - d2y) ** 2;
                    if (d < 1500) {
                        this.ctx.moveTo(d1x, d1y);
                        this.ctx.lineTo(d2x, d2y);
                    }
                }
            }
            this.ctx.stroke();
        }

        this.animationId = requestAnimationFrame(() => this.render());
    }

    start() { if (!this.animationId) this.render(); }
    stop() { if (this.animationId) { cancelAnimationFrame(this.animationId); this.animationId = null; } }

    // --- PIXEL PERFECT SAMPLING (IMAGES) ---

    async sampleImage(imageUrl) {
        // Cache check
        if (this.shapes[imageUrl]) return this.shapes[imageUrl];

        const size = 300; // Increased for more detail
        const tempCanvas = document.createElement('canvas');
        tempCanvas.width = size;
        tempCanvas.height = size;
        const tempCtx = tempCanvas.getContext('2d', { willReadFrequently: true });

        // Load Image
        const img = new Image();
        img.crossOrigin = "Anonymous"; // Crucial for reading pixel data from CDN
        img.src = imageUrl;

        await new Promise((resolve, reject) => {
            img.onload = resolve;
            img.onerror = (e) => {
                console.error("Failed to load skill image:", imageUrl);
                reject(e);
            };
        }).catch(() => null);

        if (!img.complete || img.naturalWidth === 0) return this.genBlob();

        // Clear and prepare canvas
        tempCtx.clearRect(0, 0, size, size);

        // For SVGs (especially SimpleIcons which are black), we need to 
        // fill them with white so they show up when sampling
        tempCtx.fillStyle = 'white';

        // Draw image centered and contained
        const aspect = img.width / img.height;
        let drawW = size * 0.8; // Leave some margin
        let drawH = size * 0.8;
        if (aspect > 1) drawH = drawW / aspect;
        else drawW = drawH * aspect;

        const offsetX = (size - drawW) / 2;
        const offsetY = (size - drawH) / 2;

        tempCtx.drawImage(img, offsetX, offsetY, drawW, drawH);

        // Extract points
        const imgData = tempCtx.getImageData(0, 0, size, size).data;
        const validCoords = [];

        // Sample points where there's visible content
        for (let y = 0; y < size; y++) {
            for (let x = 0; x < size; x++) {
                const idx = (y * size + x) * 4;
                const r = imgData[idx];
                const g = imgData[idx + 1];
                const b = imgData[idx + 2];
                const alpha = imgData[idx + 3];

                // Accept any pixel that has alpha OR has color (for SVGs rendered as shapes)
                const hasColor = (r > 10 || g > 10 || b > 10);
                const hasAlpha = alpha > 30;

                if (hasAlpha || hasColor) {
                    validCoords.push({ x: x / size, y: y / size });
                }
            }
        }

        if (validCoords.length === 0) {
            console.warn("No points sampled from:", imageUrl);
            return this.genBlob();
        }

        console.log(`Sampled ${validCoords.length} points from ${imageUrl}`);

        this.shapes[imageUrl] = validCoords;
        return validCoords;
    }

    // NEW: High Quality Text Sampling (with Auto-Scaling for long labels)
    async sampleText(text) {
        const size = 500; // Increased width to accommodate longer labels
        const height = 120;
        const tempCanvas = document.createElement('canvas');
        tempCanvas.width = size;
        tempCanvas.height = height;
        const tempCtx = tempCanvas.getContext('2d', { willReadFrequently: true });

        // Dynamic Font Scaling
        let fontSize = 48;
        tempCtx.font = `900 ${fontSize}px "Inter", sans-serif`;
        const metrics = tempCtx.measureText(text);
        if (metrics.width > size * 0.9) {
            fontSize = Math.floor(fontSize * (size * 0.9 / metrics.width));
            tempCtx.font = `900 ${fontSize}px "Inter", sans-serif`;
        }

        tempCtx.fillStyle = 'white';
        tempCtx.textAlign = 'center';
        tempCtx.textBaseline = 'middle';
        tempCtx.fillText(text, size / 2, height / 2);

        const imgData = tempCtx.getImageData(0, 0, size, height).data;
        const coords = [];
        for (let y = 0; y < height; y++) {
            for (let x = 0; x < size; x++) {
                if (imgData[(y * size + x) * 4 + 3] > 128) {
                    coords.push({ x: x / size, y: y / height });
                }
            }
        }
        return coords;
    }

    // Combined Preset Logic (Refined Layout & Density)
    async getCombinedPreset(key, label) {
        // Use Image Cache Key (Label ignored now)
        const cacheKey = `${key}_logo_only`;
        if (this.shapes[cacheKey]) return this.shapes[cacheKey];

        const iconUrl = this.iconMap[key];
        // Use sampleImage instead of sampleIcon
        let iconRaw = iconUrl ? await this.sampleImage(iconUrl) : this.genBlob();

        // NO TEXT SAMPLING - User requested removal

        const finalPts = [];
        // All points dedicated to the logo for maximum density/quality
        const nLogo = this.maxPoints;

        // --- Layout Parameters ---
        const logoScale = 0.5;

        // Center vertically (Zero offset)
        // 0.5 is center.
        const startY = 0.5 - (logoScale / 2);

        // 1. Logo Block (Preserve Square)
        for (let i = 0; i < nLogo; i++) {
            const idx = Math.floor((i / nLogo) * iconRaw.length);
            const p = iconRaw[idx];
            finalPts.push({
                x: 0.5 - (logoScale / 2) + (p.x * logoScale), // Centered horizontally
                y: startY + (p.y * logoScale)
            });
        }

        this.shapes[cacheKey] = finalPts;
        return finalPts;
    }

    // --- GENERATORS ---

    genBlob() {
        const pts = [];
        for (let i = 0; i < this.maxPoints; i++) {
            const a = Math.random() * Math.PI * 2;
            const r = Math.sqrt(Math.random()) * 0.9; // Fill the whole screen (radius ~0.9)
            pts.push({ x: 0.5 + Math.cos(a) * r, y: 0.6 + Math.sin(a) * r }); // y: 0.6 moves it down
        }
        return pts;
    }

    async morph(shapeKey, label = null) {
        // Handle Description Typewriter
        let desc = this.skillDescriptions[shapeKey];

        // Clear active intervals
        if (this.typingTimeouts) {
            this.typingTimeouts.forEach(t => clearTimeout(t));
        }
        this.typingTimeouts = [];

        // Always Type (even if null to clear)
        const displayName = this.skillDisplayNames[shapeKey] || shapeKey.toUpperCase();
        this.typeText(desc, displayName);

        if (this.targetShape === shapeKey && !label) return;
        this.targetShape = shapeKey;

        const activeMorph = ++this.morphId; // Capture ID at start

        let shape;
        if (shapeKey === 'default') {
            shape = this.shapes['default'];
        } else {
            shape = await this.getCombinedPreset(shapeKey, label);
        }

        // --- CANCEL IF NEW MORPH STARTED ---
        if (activeMorph !== this.morphId) return;

        const margin = this.isMobile ? -100 : -200; // Negative margin to flow off screen
        const size = Math.min(this.width, this.height) - (margin * 2);
        const offsetX = (this.width - size) / 2;
        const offsetY = (this.height - size) / 2;

        // Use the LATEST points array reference
        const currentPoints = this.points;
        currentPoints.forEach((p, i) => {
            const shapePt = shape[i % shape.length];
            p.tx = offsetX + (shapePt.x * size);
            p.ty = offsetY + (shapePt.y * size);
            // Subtle vibration (organic jitter)
            p.tx += (Math.random() - 0.5) * 10;
            p.ty += (Math.random() - 0.5) * 10;
        });
    }

    typeText(text, skillName = 'Skill') {
        const el = document.getElementById('skill-typewriter-display');
        if (!el) return;

        // Reset Styles & Content
        el.innerHTML = '';

        // Clear Intervals
        if (this.typingIntervals) {
            this.typingIntervals.forEach(i => clearInterval(i));
        }
        this.typingIntervals = [];

        if (!text) {
            el.style.opacity = '0';
            el.style.transform = 'translate(-50%, 20px)';
            return;
        }

        console.log("Showing card for:", text.substring(0, 20) + "...");

        // --- PREMIUM CARD STYLE (Force Inline for Reliability) ---
        el.className = ''; // Clear classes to avoid conflicts
        Object.assign(el.style, {
            position: 'absolute',
            bottom: '10%',
            left: '50%',
            transform: 'translateX(-50%)',
            width: 'min(90%, 650px)',
            backgroundColor: 'rgba(15, 23, 42, 0.6)',
            backdropFilter: 'blur(4px)',
            border: '1px solid rgba(99, 102, 241, 0.3)',
            borderRadius: '16px',
            padding: '2rem',
            boxShadow: '0 15px 40px -10px rgba(0, 0, 0, 0.4)',
            zIndex: '9999',
            fontFamily: 'monospace',
            textAlign: 'left',
            color: '#fff',
            fontSize: '14px',
            opacity: '1',
            pointerEvents: 'none',
            transition: 'opacity 0.2s ease, transform 0.2s ease'
        });

        // Add subtle "terminal" header with dynamic skill name - BLURRED
        const header = document.createElement('div');
        header.className = "flex items-center gap-2 mb-4 pb-2";
        header.style.cssText = 'background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(12px); margin: -2rem -2rem 1rem -2rem; padding: 1rem 2rem; border-radius: 16px 16px 0 0; border-bottom: 1px solid rgba(255,255,255,0.1);';
        header.innerHTML = `
            <div class="w-3 h-3 rounded-full bg-red-500"></div>
            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
            <div class="w-3 h-3 rounded-full bg-green-500"></div>
            <span class="ml-2 text-indigo-400 font-semibold text-xs tracking-wider">${skillName} — Skill Details</span>
        `;
        el.appendChild(header);

        // Content Container
        const contentContainer = document.createElement('div');
        contentContainer.className = "flex flex-col gap-2";
        el.appendChild(contentContainer);

        const lines = text.split('\n');

        lines.forEach((lineText, index) => {
            const lineEl = document.createElement('div');
            lineEl.style.cssText = 'display: flex; align-items: flex-start; color: rgba(199, 210, 254, 0.9); min-height: 24px; line-height: 1.5;';

            // Line Number
            const num = document.createElement('span');
            num.style.cssText = 'width: 28px; color: #475569; text-align: right; margin-right: 12px; font-size: 11px; flex-shrink: 0; user-select: none;';
            num.textContent = (index + 1).toString().padStart(2, '0');
            lineEl.appendChild(num);

            // Text Content wrapper
            const span = document.createElement('span');
            span.style.cssText = 'flex: 1; word-wrap: break-word; font-size: 13px;';

            // Simple cursor (underscore)
            const cursor = document.createElement('span');
            cursor.style.cssText = 'color: #6366f1; font-weight: bold; opacity: 0;';
            cursor.textContent = '_';

            lineEl.appendChild(span);
            lineEl.appendChild(cursor);
            contentContainer.appendChild(lineEl);

            // Typing Logic: Parallel execution with minimal stagger
            const startDelay = 50;
            const charDelay = 12;

            const timeoutId = setTimeout(() => {
                cursor.style.opacity = '1';

                let i = 0;
                const interval = setInterval(() => {
                    if (i < lineText.length) {
                        span.textContent += lineText[i];
                        i++;
                    } else {
                        clearInterval(interval);
                        cursor.style.opacity = '0';
                    }
                }, charDelay + (Math.random() * 10)); // Slight random variance for human feel

                this.typingIntervals.push(interval);

            }, startDelay); // No index-based delay -> All start at once!

            if (!this.typingTimeouts) this.typingTimeouts = [];
            this.typingTimeouts.push(timeoutId);
        });
    }
}

// Global Init with safety check
if (!window.SkillsCloudInstance) {
    document.addEventListener('DOMContentLoaded', () => {
        if (!window.SkillsCloudInstance) {
            window.SkillsCloudInstance = new SkillsCloud();
            console.log("SkillsCloud initialized");
        }
    });
}
