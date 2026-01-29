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
        this.maxPoints = this.isMobile ? 800 : 3000; // Increased density significantly
        this.animationId = null;
        this.isVisible = true;

        this.colors = { point: '#6366f1', line: 'rgba(99, 102, 241, 0.1)' }; // Dimmed lines for density

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
            this.maxPoints = this.isMobile ? 800 : 3000;
            this.repopulatePoints();
        });

        // Pre-map icons to keys
        this.iconMap = {
            'js': 'fab fa-js',
            'php': 'fab fa-php',
            'css': 'fab fa-css3-alt',
            'html': 'fab fa-html5',
            'mysql': 'fas fa-database',
            'git': 'fab fa-git-alt',
            'docker': 'fab fa-docker',
            'linux': 'fab fa-linux',
            'tailwind': 'fab fa-css3', // Fallback
            'sql': 'fas fa-database',
            'java': 'fab fa-java',
            'automation': 'fas fa-robot',
            'python': 'fab fa-python',
            'ai': 'fas fa-brain'
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
            });
        }
        this.morph(this.targetShape);
    }

    // Unified async morph method below

    render() {
        if (!this.isVisible) return;
        this.ctx.clearRect(0, 0, this.width, this.height);

        const isPreset = this.targetShape !== 'default';

        // --- ADAPTIVE RENDERING (Blob vs Preset) ---
        const dotSize = isPreset ? 0.9 : (this.isMobile ? 0.8 : 1.2);
        const glowAmount = isPreset ? 8 : (this.isMobile ? 10 : 15);
        const pointColor = isPreset ? 'rgba(129, 140, 248, 0.95)' : this.colors.point; // Using Odyssey purple for presets

        this.ctx.beginPath();
        this.ctx.fillStyle = pointColor;
        this.ctx.shadowBlur = glowAmount;
        this.ctx.shadowColor = pointColor;

        this.points.forEach(p => {
            // Smooth morphing
            p.x += (p.tx - p.x) * 0.08;
            p.y += (p.ty - p.y) * 0.08;

            // DRAW POINTS
            this.ctx.moveTo(p.x + dotSize, p.y);
            this.ctx.arc(p.x, p.y, dotSize, 0, Math.PI * 2);
        });
        this.ctx.fill();
        this.ctx.shadowBlur = 0;

        // --- PRESET-ONLY: DATA STREAM CONNECTIONS (Liaisons) ---
        if (isPreset && !this.isMobile) {
            this.ctx.strokeStyle = 'rgba(129, 140, 248, 0.15)';
            this.ctx.lineWidth = 0.5;
            this.ctx.beginPath();
            // sample fewer points for lines to keep performance high
            for (let i = 0; i < this.points.length; i += 6) {
                for (let j = i + 1; j < Math.min(i + 4, this.points.length); j++) {
                    const p1 = this.points[i];
                    const p2 = this.points[j];
                    const d = (p1.x - p2.x) ** 2 + (p1.y - p2.y) ** 2;
                    if (d < 1200) { // Tight threshold for sharp "fil" look
                        this.ctx.moveTo(p1.x, p1.y);
                        this.ctx.lineTo(p2.x, p2.y);
                    }
                }
            }
            this.ctx.stroke();
        }

        this.animationId = requestAnimationFrame(() => this.render());
    }

    start() { if (!this.animationId) this.render(); }
    stop() { if (this.animationId) { cancelAnimationFrame(this.animationId); this.animationId = null; } }

    // --- PIXEL PERFECT SAMPLING ---

    async sampleIcon(iconClass) {
        // Cache check
        if (this.shapes[iconClass]) return this.shapes[iconClass];

        const size = 250; // Increased sample resolution
        const tempCanvas = document.createElement('canvas');
        tempCanvas.width = size;
        tempCanvas.height = size;
        const tempCtx = tempCanvas.getContext('2d', { willReadFrequently: true });

        // Identify Font Family and Unicode from class
        const isBrand = iconClass.includes('fab');
        const fontFamily = isBrand ? '"Font Awesome 6 Brands"' : '"Font Awesome 6 Free"';
        const fontWeight = isBrand ? '400' : '900';

        // Wait for fonts to ensure render
        await document.fonts.ready;

        // Create a temporary element to get the character code
        const tempI = document.createElement('i');
        tempI.className = iconClass;
        tempI.style.display = 'none';
        document.body.appendChild(tempI);
        const content = window.getComputedStyle(tempI, ':before').content;
        const charCode = content.replace(/['"]/g, '');
        document.body.removeChild(tempI);

        // Render to offscreen
        tempCtx.clearRect(0, 0, size, size);
        tempCtx.fillStyle = 'white';
        tempCtx.font = `${fontWeight} ${size * 0.85}px ${fontFamily}`;
        tempCtx.textAlign = 'center';
        tempCtx.textBaseline = 'middle';
        tempCtx.fillText(charCode, size / 2, size / 2);

        // Extract points
        const imgData = tempCtx.getImageData(0, 0, size, size).data;
        const validCoords = [];

        for (let y = 0; y < size; y++) {
            for (let x = 0; x < size; x++) {
                const alpha = imgData[(y * size + x) * 4 + 3];
                if (alpha > 50) { // Lower threshold for "softer" edges/more points
                    validCoords.push({ x: x / size, y: y / size });
                }
            }
        }

        if (validCoords.length === 0) return this.genBlob();

        this.shapes[iconClass] = validCoords;
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
        const cacheKey = `${key}_${label}`;
        if (this.shapes[cacheKey]) return this.shapes[cacheKey];

        const iconClass = this.iconMap[key];
        let iconRaw = iconClass ? await this.sampleIcon(iconClass) : this.genBlob();
        let textRaw = label ? await this.sampleText(label) : [];

        const finalPts = [];
        // Lower density for text as requested (e.g., 12% for text, 88% for logo)
        const nLogo = Math.floor(this.maxPoints * 0.88);
        const nText = this.maxPoints - nLogo;

        // --- Layout Parameters (Enlarged Text, Minimal Gap) ---
        const logoScale = 0.55;
        const textScale = 0.38; // Significantly larger text
        const gap = 0.01;      // Minimal space

        const groupHeight = logoScale + gap + textScale;
        const startY = (1.05 - groupHeight) / 2;

        // 1. Logo Block (Preserve Square)
        for (let i = 0; i < nLogo; i++) {
            const idx = Math.floor((i / nLogo) * iconRaw.length);
            const p = iconRaw[idx];
            finalPts.push({
                x: 0.5 - (logoScale / 2) + (p.x * logoScale), // Centered horizontally
                y: startY + (p.y * logoScale)
            });
        }

        // 2. Text Block (Preserve Aspect Ratio ~4.16)
        if (textRaw.length > 0) {
            const textY = startY + logoScale + gap;
            // Cap width to 0.95 to avoid clipping
            const textWidth = Math.min(0.95, textScale * (500 / 120)); // Use actual aspect ratio
            const textX = (1.0 - textWidth) / 2;

            for (let i = 0; i < nText; i++) {
                const idx = Math.floor((i / nText) * textRaw.length);
                const p = textRaw[idx];
                finalPts.push({
                    x: textX + (p.x * textWidth),
                    y: textY + (p.y * textScale)
                });
            }
        } else {
            for (let i = 0; i < nText; i++) {
                finalPts.push({ x: 0.5 + (Math.random() - 0.5) * 0.5, y: 0.85 + (Math.random() - 0.5) * 0.05 });
            }
        }

        this.shapes[cacheKey] = finalPts;
        return finalPts;
    }

    // --- GENERATORS ---

    genBlob() {
        const pts = [];
        for (let i = 0; i < this.maxPoints; i++) {
            const a = Math.random() * Math.PI * 2;
            const r = Math.sqrt(Math.random()) * 0.55;
            pts.push({ x: 0.5 + Math.cos(a) * r, y: 0.5 + Math.sin(a) * r });
        }
        return pts;
    }

    async morph(shapeKey, label = null) {
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

        const margin = this.isMobile ? 40 : 120;
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
            p.tx += (Math.random() - 0.5) * 4;
            p.ty += (Math.random() - 0.5) * 4;
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    window.SkillsCloudInstance = new SkillsCloud();
});
