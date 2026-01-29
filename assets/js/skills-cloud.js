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
        this.isMobile = window.innerWidth < 768;
        this.maxPoints = this.isMobile ? 120 : 300;
        this.animationId = null;
        this.isVisible = true;

        this.colors = { point: '#6366f1', line: 'rgba(99, 102, 241, 0.1)' };

        // --- SHAPE GENERATORS ---
        this.shapes = {
            'default': this.genBlob(),
            'js': this.genJS(),
            'php': this.genPHP(),
            'css': this.genCSS(),
            'html': this.genHTML(),
            'mysql': this.genMySQL(),
            'git': this.genGit(),
            'docker': this.genDocker(),
            'linux': this.genLinux()
        };

        this.init();
    }

    init() {
        this.resize();
        window.addEventListener('resize', () => {
            this.resize();
            this.isMobile = window.innerWidth < 768;
            this.maxPoints = this.isMobile ? 120 : 300;
            this.repopulatePoints();
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) { this.isVisible = true; this.start(); }
                else { this.isVisible = false; this.stop(); }
            });
        });
        observer.observe(document.getElementById('skills-section'));

        document.addEventListener('skill:preview', (e) => this.morph(e.detail.key));
        document.addEventListener('skill:select', (e) => this.morph(e.detail.key));
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

    morph(shapeKey) {
        this.targetShape = shapeKey;
        const shape = this.shapes[shapeKey] || this.shapes['default'];

        // center mapping
        const margin = this.isMobile ? 50 : 150;
        const size = Math.min(this.width, this.height) - (margin * 2);
        const offsetX = (this.width - size) / 2;
        const offsetY = (this.height - size) / 2;

        this.points.forEach((p, i) => {
            const shapePt = shape[i % shape.length];
            p.tx = offsetX + (shapePt.x * size);
            p.ty = offsetY + (shapePt.y * size);

            // Jitter for 'cloud' effect
            p.tx += (Math.random() - 0.5) * 15;
            p.ty += (Math.random() - 0.5) * 15;
        });
    }

    render() {
        if (!this.isVisible) return;
        this.ctx.clearRect(0, 0, this.width, this.height);
        this.ctx.fillStyle = this.colors.point;

        this.points.forEach(p => {
            p.x += (p.tx - p.x) * 0.05;
            p.y += (p.ty - p.y) * 0.05;
            this.ctx.beginPath();
            this.ctx.arc(p.x, p.y, this.isMobile ? 1 : 1.5, 0, Math.PI * 2);
            this.ctx.fill();
        });

        // Lines
        if (!this.isMobile && this.points.length < 250) {
            this.ctx.strokeStyle = this.colors.line;
            this.ctx.beginPath();
            for (let i = 0; i < this.points.length; i++) {
                // Optimization: check fewer neighbors
                for (let j = i + 1; j < Math.min(i + 5, this.points.length); j++) {
                    const p1 = this.points[i];
                    const p2 = this.points[j];
                    const d = (p1.x - p2.x) ** 2 + (p1.y - p2.y) ** 2;
                    if (d < 2500) { this.ctx.moveTo(p1.x, p1.y); this.ctx.lineTo(p2.x, p2.y); }
                }
            }
            this.ctx.stroke();
        }

        this.animationId = requestAnimationFrame(() => this.render());
    }

    start() { if (!this.animationId) this.render(); }
    stop() { if (this.animationId) { cancelAnimationFrame(this.animationId); this.animationId = null; } }

    // --- GENERIC UTILS ---
    addPath(pts, x1, y1, x2, y2, steps) {
        for (let i = 0; i <= steps; i++) {
            pts.push({ x: x1 + (x2 - x1) * (i / steps), y: y1 + (y2 - y1) * (i / steps) });
        }
    }

    // --- GENERATORS ---

    genBlob() {
        const pts = [];
        for (let i = 0; i < 300; i++) {
            const a = Math.random() * Math.PI * 2;
            const r = Math.sqrt(Math.random()) * 0.5;
            pts.push({ x: 0.5 + Math.cos(a) * r, y: 0.5 + Math.sin(a) * r });
        }
        return pts;
    }

    genJS() { // Square + JS
        const pts = [];
        // Border Square
        this.addPath(pts, 0.2, 0.2, 0.8, 0.2, 30);
        this.addPath(pts, 0.8, 0.2, 0.8, 0.8, 30);
        this.addPath(pts, 0.8, 0.8, 0.2, 0.8, 30);
        this.addPath(pts, 0.2, 0.8, 0.2, 0.2, 30);
        // J
        this.addPath(pts, 0.35, 0.35, 0.35, 0.6, 15);
        this.addPath(pts, 0.35, 0.6, 0.25, 0.65, 10);
        // S
        const sPts = 30;
        for (let i = 0; i < sPts; i++) {
            const t = i / sPts;
            pts.push({ x: 0.55 + Math.sin(t * Math.PI * 2) * 0.1 + t * 0.1, y: 0.4 + t * 0.3 });
        }
        return pts;
    }

    genPHP() { // Oval + php
        const pts = [];
        // Oval
        for (let i = 0; i < 80; i++) {
            const a = (i / 80) * Math.PI * 2;
            pts.push({ x: 0.5 + Math.cos(a) * 0.4, y: 0.5 + Math.sin(a) * 0.25 });
        }
        // php (simplified lines)
        this.addPath(pts, 0.25, 0.45, 0.25, 0.65, 10); // p
        this.addPath(pts, 0.25, 0.45, 0.35, 0.45, 5);
        this.addPath(pts, 0.35, 0.45, 0.35, 0.55, 5);
        this.addPath(pts, 0.35, 0.55, 0.25, 0.55, 5);

        this.addPath(pts, 0.45, 0.4, 0.45, 0.6, 10); // h
        this.addPath(pts, 0.45, 0.5, 0.55, 0.5, 5);
        this.addPath(pts, 0.55, 0.5, 0.55, 0.6, 5);

        this.addPath(pts, 0.65, 0.45, 0.65, 0.65, 10); // p
        this.addPath(pts, 0.65, 0.45, 0.75, 0.45, 5);
        this.addPath(pts, 0.75, 0.45, 0.75, 0.55, 5);
        this.addPath(pts, 0.75, 0.55, 0.65, 0.55, 5);
        return pts;
    }

    genCSS() { // Shield
        const pts = [];
        // Shield outline
        this.addPath(pts, 0.2, 0.1, 0.8, 0.1, 20); // Top
        this.addPath(pts, 0.8, 0.1, 0.7, 0.75, 20); // Right side
        this.addPath(pts, 0.7, 0.75, 0.5, 0.9, 10); // Bottom right
        this.addPath(pts, 0.5, 0.9, 0.3, 0.75, 10); // Bottom left
        this.addPath(pts, 0.3, 0.75, 0.2, 0.1, 20); // Left side
        // Inner simplified shape
        this.addPath(pts, 0.5, 0.2, 0.5, 0.8, 15);
        this.addPath(pts, 0.5, 0.2, 0.7, 0.2, 10);
        return pts;
    }

    genHTML() { // Shield + <>
        const pts = this.genCSS(); // Base shield
        // <
        this.addPath(pts, 0.4, 0.4, 0.3, 0.5, 5);
        this.addPath(pts, 0.3, 0.5, 0.4, 0.6, 5);
        // >
        this.addPath(pts, 0.6, 0.4, 0.7, 0.5, 5);
        this.addPath(pts, 0.7, 0.5, 0.6, 0.6, 5);
        return pts;
    }

    genMySQL() { // Cylinder
        const pts = [];
        // Top ellipse
        for (let i = 0; i < 40; i++) {
            const a = (i / 40) * Math.PI * 2;
            pts.push({ x: 0.5 + Math.cos(a) * 0.3, y: 0.3 + Math.sin(a) * 0.1 });
        }
        // Bottom ellipse (half)
        for (let i = 0; i <= 20; i++) {
            const a = (i / 40) * Math.PI * 2; // only draw bottom half? no draw full for base
            pts.push({ x: 0.5 + Math.cos(a) * 0.3, y: 0.7 + Math.sin(a) * 0.1 });
        }
        // Sides
        this.addPath(pts, 0.2, 0.3, 0.2, 0.7, 20);
        this.addPath(pts, 0.8, 0.3, 0.8, 0.7, 20);
        return pts;
    }

    genGit() { // Branch
        const pts = [];
        // Main line
        this.addPath(pts, 0.3, 0.8, 0.3, 0.2, 30);
        this.addPath(pts, 0.3, 0.5, 0.6, 0.2, 20); // Branch
        // Dots
        for (let i = 0; i < 10; i++) pts.push({ x: 0.3, y: 0.2 });
        for (let i = 0; i < 10; i++) pts.push({ x: 0.3, y: 0.5 });
        for (let i = 0; i < 10; i++) pts.push({ x: 0.6, y: 0.2 });
        return pts;
    }

    genDocker() { // Whale
        const pts = [];
        // Body (Curve)
        for (let i = 0; i < 50; i++) {
            const t = i / 50;
            pts.push({ x: 0.1 + t * 0.7, y: 0.6 + Math.sin(t * Math.PI) * 0.2 });
        }
        // Containers (Boxes)
        this.addPath(pts, 0.3, 0.5, 0.4, 0.5, 5);
        this.addPath(pts, 0.3, 0.4, 0.4, 0.4, 5);
        this.addPath(pts, 0.45, 0.5, 0.55, 0.5, 5);
        this.addPath(pts, 0.45, 0.4, 0.55, 0.4, 5);
        return pts;
    }

    genLinux() { // Penguin
        const pts = [];
        // Body (Oval)
        for (let i = 0; i < 60; i++) {
            const a = (i / 60) * Math.PI * 2;
            pts.push({ x: 0.5 + Math.cos(a) * 0.25, y: 0.55 + Math.sin(a) * 0.35 });
        }
        // Belly
        for (let i = 0; i < 40; i++) {
            const a = (i / 40) * Math.PI * 2;
            pts.push({ x: 0.5 + Math.cos(a) * 0.15, y: 0.6 + Math.sin(a) * 0.2 });
        }
        // Eyes
        for (let i = 0; i < 5; i++) pts.push({ x: 0.45, y: 0.35 });
        for (let i = 0; i < 5; i++) pts.push({ x: 0.55, y: 0.35 });
        return pts;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    window.SkillsCloudInstance = new SkillsCloud();
});
