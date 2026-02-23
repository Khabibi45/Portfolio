/* ═══════════════════════════════════════════════════════════════
   LAB REVEAL — Image Hover Reveal Engine v2
   Trail-based: every effect leaves a decaying trail
   16 effects with persistent reveal + gradual cover-back
   ═══════════════════════════════════════════════════════════════ */

(function () {
    'use strict';

    /* ─── DOM ─── */
    const canvas     = document.getElementById('reveal-canvas');
    const ctx        = canvas.getContext('2d');
    const imgBase    = document.getElementById('img-base');
    const imgReveal  = document.getElementById('img-reveal');
    const cursorEl   = document.getElementById('custom-cursor');
    const brushInput = document.getElementById('brush-range');
    const resetBtn   = document.getElementById('reset-btn');
    const effectBar  = document.getElementById('effects-bar');
    const hero       = document.getElementById('reveal-hero');

    /* ─── State ─── */
    let w, h, dpr;
    let mouseX = -9999, mouseY = -9999;
    let isHovering = false;
    let brushSize  = 100;
    let currentEffect = 'circle';
    let imagesLoaded = 0;
    let raf;
    let animTime = 0;

    // Trail system: accumulates effect renders, decays over time
    let trailCanvas, trailCtx;
    // Reusable offscreen for reveal image
    let offCanvas, offCtx;
    // Stamp interpolation: last position where we stamped
    let lastStampX = -1, lastStampY = -1;

    // Smoke particles
    let smokeParticles = [];
    // Matrix rain columns
    let matrixColumns = [];
    // Shatter tiles
    let shatterTiles = [];
    // Voronoi seeds
    let voronoiSeeds = [];

    /* ─── Decay rates per effect (higher = faster fade-back) ─── */
    const DECAY = {
        circle:   0.012,
        fog:      0.008,
        paint:    0.005,
        pixel:    0.014,
        ripple:   0.016,
        xray:     0.011,
        shatter:  0.014,
        swirl:    0.016,
        thermal:  0.011,
        glitch:   0.028,
        smoke:    0.007,
        magnetic: 0.013,
        dissolve: 0.004,
        voronoi:  0.013,
        ascii:    0.010,
        matrix:   0.018,
    };

    /* ─── Image Loading ─── */
    function onImageLoad() {
        imagesLoaded++;
        if (imagesLoaded >= 2) { resize(); draw(); }
    }
    imgBase.addEventListener('load', onImageLoad);
    imgReveal.addEventListener('load', onImageLoad);
    if (imgBase.complete) onImageLoad();
    if (imgReveal.complete) onImageLoad();

    /* ─── Resize ─── */
    function resize() {
        dpr = Math.min(window.devicePixelRatio || 1, 2);
        w = window.innerWidth;
        h = window.innerHeight;

        canvas.width  = w * dpr;
        canvas.height = h * dpr;
        canvas.style.width  = w + 'px';
        canvas.style.height = h + 'px';
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

        // Trail canvas (accumulates + decays)
        trailCanvas = document.createElement('canvas');
        trailCanvas.width  = w * dpr;
        trailCanvas.height = h * dpr;
        trailCtx = trailCanvas.getContext('2d');
        trailCtx.setTransform(dpr, 0, 0, dpr, 0, 0);

        // Offscreen for reveal image
        offCanvas = document.createElement('canvas');
        offCanvas.width  = w * dpr;
        offCanvas.height = h * dpr;
        offCtx = offCanvas.getContext('2d');
        offCtx.setTransform(dpr, 0, 0, dpr, 0, 0);

        generateShatterTiles();
        generateVoronoiSeeds();
        initMatrixColumns();
    }

    window.addEventListener('resize', () => { resize(); draw(); });

    /* ─── Mouse / Touch ─── */
    hero.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        isHovering = true;
        cursorEl.style.transform = `translate(${mouseX}px, ${mouseY}px) translate(-50%, -50%)`;
        cursorEl.style.width  = brushSize + 'px';
        cursorEl.style.height = brushSize + 'px';
    });

    hero.addEventListener('mouseleave', () => {
        isHovering = false;
        lastStampX = -1;
        lastStampY = -1;
    });

    hero.addEventListener('touchmove', (e) => {
        const t = e.touches[0];
        mouseX = t.clientX;
        mouseY = t.clientY;
        isHovering = true;
    }, { passive: true });

    hero.addEventListener('touchend', () => {
        isHovering = false;
        lastStampX = -1;
        lastStampY = -1;
    });

    /* ─── Brush Size ─── */
    brushInput.addEventListener('input', (e) => {
        brushSize = parseInt(e.target.value, 10);
        cursorEl.style.width  = brushSize + 'px';
        cursorEl.style.height = brushSize + 'px';
    });

    /* ─── Reset ─── */
    resetBtn.addEventListener('click', () => {
        if (trailCtx) trailCtx.clearRect(0, 0, w, h);
        smokeParticles = [];
        matrixColumns.forEach(c => { c.active = false; c.y = -20; });
        lastStampX = -1;
        lastStampY = -1;
    });

    /* ─── Effect Selector ─── */
    effectBar.addEventListener('click', (e) => {
        const btn = e.target.closest('.reveal-hero__effect-btn');
        if (!btn) return;
        effectBar.querySelectorAll('.reveal-hero__effect-btn').forEach(b => b.classList.remove('is-active'));
        btn.classList.add('is-active');
        currentEffect = btn.dataset.effect;
        // Clear trail on switch
        if (trailCtx) trailCtx.clearRect(0, 0, w, h);
        smokeParticles = [];
        matrixColumns.forEach(c => { c.active = false; c.y = -20; });
        lastStampX = -1;
        lastStampY = -1;
    });

    /* ─── Data generators ─── */
    function generateShatterTiles() {
        shatterTiles = [];
        const sz = 40;
        for (let ty = 0; ty < h; ty += sz) {
            for (let tx = 0; tx < w; tx += sz) {
                shatterTiles.push({
                    x: tx, y: ty,
                    w: Math.min(sz, w - tx), h: Math.min(sz, h - ty),
                    ox: (Math.random() - 0.5) * 20,
                    oy: (Math.random() - 0.5) * 20,
                    rot: (Math.random() - 0.5) * 0.3,
                });
            }
        }
    }

    function generateVoronoiSeeds() {
        voronoiSeeds = [];
        const sz = 50;
        for (let y = 0; y < h; y += sz)
            for (let x = 0; x < w; x += sz)
                voronoiSeeds.push({ x: x + Math.random() * sz, y: y + Math.random() * sz });
    }

    function initMatrixColumns() {
        matrixColumns = [];
        const cw = 14;
        for (let x = 0; x < w; x += cw)
            matrixColumns.push({ x, y: Math.random() * h, speed: 2 + Math.random() * 6, active: false });
    }

    /* ─── Cover-fit helper ─── */
    function drawCover(c, img, dx, dy, dw, dh) {
        const ir = img.naturalWidth / img.naturalHeight;
        const tr = dw / dh;
        let sx, sy, sw, sh;
        if (ir > tr) { sh = img.naturalHeight; sw = sh * tr; sx = (img.naturalWidth - sw) / 2; sy = 0; }
        else { sw = img.naturalWidth; sh = sw / tr; sx = 0; sy = (img.naturalHeight - sh) / 2; }
        c.drawImage(img, sx, sy, sw, sh, dx, dy, dw, dh);
    }

    /* ─── Prepare reveal offscreen (once per frame) ─── */
    function prepareReveal() {
        offCtx.clearRect(0, 0, w, h);
        drawCover(offCtx, imgReveal, 0, 0, w, h);
    }

    /* ═══════════════════════════════════════════════════════════════
       DRAW LOOP — Trail Architecture
       1. Decay trail canvas (gradual cover-back)
       2. Stamp effect at cursor onto trail (with interpolation)
       3. Composite: base image + trail
       ═══════════════════════════════════════════════════════════════ */

    function draw() {
        if (imagesLoaded < 2) { raf = requestAnimationFrame(draw); return; }
        animTime += 0.016;

        // 1. DECAY — gradually erase the trail (cover back to base)
        const decay = DECAY[currentEffect] || 0.012;
        trailCtx.globalCompositeOperation = 'destination-out';
        trailCtx.globalAlpha = decay;
        trailCtx.fillStyle = '#000';
        trailCtx.fillRect(0, 0, w, h);
        trailCtx.globalAlpha = 1;
        trailCtx.globalCompositeOperation = 'source-over';

        // 2. Prepare reveal image offscreen
        prepareReveal();

        // 3. STAMP effect onto trail
        if (isHovering) {
            stampEffect();
        }
        // Particle/column effects update even when not hovering
        if (currentEffect === 'smoke' && smokeParticles.length > 0) {
            updateSmokeParticles();
        }
        if (currentEffect === 'matrix') {
            updateMatrixColumns();
        }

        // 4. COMPOSITE: base + trail
        ctx.clearRect(0, 0, w, h);
        drawCover(ctx, imgBase, 0, 0, w, h);
        ctx.drawImage(trailCanvas, 0, 0, w, h);

        raf = requestAnimationFrame(draw);
    }

    /* ─── Stamp with interpolation (smooth trail, no gaps) ─── */
    function stampEffect() {
        // Smoke and matrix have their own update logic
        if (currentEffect === 'smoke') {
            spawnSmokeParticles();
            return;
        }
        if (currentEffect === 'matrix') {
            activateMatrixColumns();
            return;
        }

        // Interpolate between last stamp and current mouse
        if (lastStampX >= 0 && lastStampY >= 0) {
            const dist = Math.hypot(mouseX - lastStampX, mouseY - lastStampY);
            const step = Math.max(brushSize * 0.25, 6);
            const steps = Math.min(Math.max(1, Math.ceil(dist / step)), 15);

            for (let i = 1; i <= steps; i++) {
                const t = i / steps;
                const x = lastStampX + (mouseX - lastStampX) * t;
                const y = lastStampY + (mouseY - lastStampY) * t;
                renderAt(x, y);
            }
        } else {
            renderAt(mouseX, mouseY);
        }

        lastStampX = mouseX;
        lastStampY = mouseY;
    }

    /* ─── Route to correct effect ─── */
    function renderAt(x, y) {
        switch (currentEffect) {
            case 'circle':   stampCircle(x, y);   break;
            case 'fog':      stampFog(x, y);      break;
            case 'paint':    stampPaint(x, y);     break;
            case 'pixel':    stampPixel(x, y);     break;
            case 'ripple':   stampRipple(x, y);    break;
            case 'xray':     stampXRay(x, y);      break;
            case 'shatter':  stampShatter(x, y);   break;
            case 'swirl':    stampSwirl(x, y);     break;
            case 'thermal':  stampThermal(x, y);   break;
            case 'glitch':   stampGlitch(x, y);    break;
            case 'magnetic': stampMagnetic(x, y);  break;
            case 'dissolve': stampDissolve(x, y);  break;
            case 'voronoi':  stampVoronoi(x, y);   break;
            case 'ascii':    stampAscii(x, y);     break;
        }
    }

    /* ═══════════════════════════════════════════════════════════════
       EFFECTS — All stamp onto trailCtx
       ═══════════════════════════════════════════════════════════════ */

    /* 1. Circle */
    function stampCircle(x, y) {
        trailCtx.save();
        trailCtx.beginPath();
        trailCtx.arc(x, y, brushSize / 2, 0, Math.PI * 2);
        trailCtx.clip();
        trailCtx.drawImage(offCanvas, 0, 0, w, h);
        trailCtx.restore();
    }

    /* 2. Fog */
    function stampFog(x, y) {
        const tmp = document.createElement('canvas');
        tmp.width = canvas.width; tmp.height = canvas.height;
        const tc = tmp.getContext('2d');
        tc.setTransform(dpr, 0, 0, dpr, 0, 0);
        tc.drawImage(offCanvas, 0, 0, w, h);

        tc.globalCompositeOperation = 'destination-in';
        const grad = tc.createRadialGradient(x, y, brushSize * 0.05, x, y, brushSize);
        grad.addColorStop(0, 'rgba(255,255,255,1)');
        grad.addColorStop(0.4, 'rgba(255,255,255,0.7)');
        grad.addColorStop(0.75, 'rgba(255,255,255,0.2)');
        grad.addColorStop(1, 'rgba(255,255,255,0)');
        tc.fillStyle = grad;
        tc.fillRect(0, 0, w, h);

        trailCtx.drawImage(tmp, 0, 0, w, h);
    }

    /* 3. Paint */
    function stampPaint(x, y) {
        const sz = brushSize / 2 * (0.8 + Math.random() * 0.4);
        trailCtx.save();
        trailCtx.beginPath();
        trailCtx.arc(x, y, sz, 0, Math.PI * 2);
        trailCtx.clip();
        trailCtx.drawImage(offCanvas, 0, 0, w, h);
        trailCtx.restore();
    }

    /* 4. Pixel */
    function stampPixel(x, y) {
        const ps = 10;
        const r = brushSize;
        const sx = Math.max(0, Math.floor((x - r) / ps) * ps);
        const sy = Math.max(0, Math.floor((y - r) / ps) * ps);
        const ex = Math.min(w, Math.ceil((x + r) / ps) * ps);
        const ey = Math.min(h, Math.ceil((y + r) / ps) * ps);
        if (ex - sx <= 0 || ey - sy <= 0) return;

        const imgData = offCtx.getImageData(sx * dpr, sy * dpr, (ex - sx) * dpr, (ey - sy) * dpr);

        for (let py = sy; py < ey; py += ps) {
            for (let px = sx; px < ex; px += ps) {
                const d = Math.hypot(px + ps / 2 - x, py + ps / 2 - y);
                if (d > r) continue;

                const t = d / r;
                const spx = Math.floor((px - sx + ps / 2) * dpr);
                const spy = Math.floor((py - sy + ps / 2) * dpr);
                const idx = (spy * imgData.width + spx) * 4;

                if (t < 0.35) {
                    trailCtx.save();
                    trailCtx.beginPath();
                    trailCtx.rect(px, py, ps, ps);
                    trailCtx.clip();
                    trailCtx.drawImage(offCanvas, 0, 0, w, h);
                    trailCtx.restore();
                } else {
                    const ts = Math.max(3, Math.floor(ps * t));
                    trailCtx.fillStyle = `rgb(${imgData.data[idx]},${imgData.data[idx + 1]},${imgData.data[idx + 2]})`;
                    trailCtx.fillRect(px, py, ts, ts);
                }
            }
        }
    }

    /* 5. Ripple */
    function stampRipple(x, y) {
        const r = brushSize * 1.2;
        const sl = 4;
        for (let ry = Math.max(0, y - r); ry < Math.min(h, y + r); ry += sl) {
            const dn = Math.abs(ry - y) / r;
            if (dn > 1) continue;
            const wave = Math.sin(dn * 8 + animTime * 3) * (1 - dn) * 14;
            const hw = Math.sqrt(1 - dn * dn) * r;
            trailCtx.save();
            trailCtx.beginPath();
            trailCtx.rect(x - hw + wave, ry, hw * 2, sl);
            trailCtx.clip();
            trailCtx.drawImage(offCanvas, 0, 0, w, h);
            trailCtx.restore();
        }
    }

    /* 6. X-Ray */
    function stampXRay(x, y) {
        trailCtx.save();
        trailCtx.beginPath();
        trailCtx.arc(x, y, brushSize / 2, 0, Math.PI * 2);
        trailCtx.clip();
        trailCtx.drawImage(offCanvas, 0, 0, w, h);

        trailCtx.globalCompositeOperation = 'difference';
        trailCtx.fillStyle = '#fff';
        trailCtx.fillRect(x - brushSize / 2, y - brushSize / 2, brushSize, brushSize);
        trailCtx.globalCompositeOperation = 'screen';
        trailCtx.fillStyle = 'rgba(100,180,255,0.2)';
        trailCtx.fillRect(x - brushSize / 2, y - brushSize / 2, brushSize, brushSize);
        trailCtx.restore();

        // Dashed ring
        trailCtx.save();
        trailCtx.strokeStyle = 'rgba(100,180,255,0.35)';
        trailCtx.lineWidth = 1;
        trailCtx.setLineDash([3, 3]);
        trailCtx.beginPath();
        trailCtx.arc(x, y, brushSize / 2, 0, Math.PI * 2);
        trailCtx.stroke();
        trailCtx.setLineDash([]);
        trailCtx.restore();
    }

    /* 7. Shatter */
    function stampShatter(x, y) {
        const r = brushSize * 1.4;
        for (const t of shatterTiles) {
            const cx = t.x + t.w / 2;
            const cy = t.y + t.h / 2;
            const d = Math.hypot(cx - x, cy - y);
            if (d > r) continue;

            const p = 1 - d / r;
            const ease = p * p;
            const ox = t.ox * ease * 0.5;
            const oy = t.oy * ease * 0.5;

            trailCtx.save();
            trailCtx.globalAlpha = 0.4 + ease * 0.6;
            trailCtx.translate(cx, cy);
            trailCtx.rotate(t.rot * ease);
            trailCtx.translate(-cx, -cy);
            trailCtx.drawImage(offCanvas, (t.x + ox) * dpr, (t.y + oy) * dpr, t.w * dpr, t.h * dpr, t.x + ox, t.y + oy, t.w, t.h);

            trailCtx.strokeStyle = `rgba(125,211,252,${ease * 0.25})`;
            trailCtx.lineWidth = 0.5;
            trailCtx.strokeRect(t.x + ox, t.y + oy, t.w, t.h);
            trailCtx.restore();
        }
    }

    /* 8. Swirl */
    function stampSwirl(x, y) {
        const r = brushSize;
        const segs = 20;
        const as = (Math.PI * 2) / segs;

        for (let ring = r; ring > 0; ring -= 10) {
            const t = ring / r;
            const twist = (1 - t) * 1.8 + animTime * 1.2;
            for (let a = 0; a < Math.PI * 2; a += as) {
                const a1 = a + twist, a2 = a + as + twist;
                trailCtx.save();
                trailCtx.beginPath();
                trailCtx.moveTo(x + Math.cos(a1) * ring, y + Math.sin(a1) * ring);
                trailCtx.lineTo(x + Math.cos(a2) * ring, y + Math.sin(a2) * ring);
                trailCtx.lineTo(x + Math.cos(a2) * (ring - 10), y + Math.sin(a2) * (ring - 10));
                trailCtx.lineTo(x + Math.cos(a1) * (ring - 10), y + Math.sin(a1) * (ring - 10));
                trailCtx.closePath();
                trailCtx.clip();
                trailCtx.globalAlpha = 1 - t * 0.5;
                trailCtx.drawImage(offCanvas, 0, 0, w, h);
                trailCtx.restore();
            }
        }
    }

    /* 9. Thermal */
    function stampThermal(x, y) {
        const r = brushSize;
        const left = Math.max(0, Math.floor(x - r));
        const top  = Math.max(0, Math.floor(y - r));
        const right  = Math.min(w, Math.ceil(x + r));
        const bottom = Math.min(h, Math.ceil(y + r));
        const rw = right - left, rh = bottom - top;
        if (rw <= 0 || rh <= 0) return;

        const imgData = offCtx.getImageData(left * dpr, top * dpr, rw * dpr, rh * dpr);
        const d = imgData.data;

        for (let i = 0; i < d.length; i += 4) {
            const lum = d[i] * 0.299 + d[i + 1] * 0.587 + d[i + 2] * 0.114;
            const t = lum / 255;
            if (t < 0.25)      { d[i] = 0;   d[i+1] = 0;   d[i+2] = Math.floor(100 + t * 620); }
            else if (t < 0.5)  { const s=(t-0.25)*4; d[i]=Math.floor(s*200); d[i+1]=0; d[i+2]=Math.floor(255-s*100); }
            else if (t < 0.75) { const s=(t-0.5)*4; d[i]=200+Math.floor(s*55); d[i+1]=Math.floor(s*200); d[i+2]=0; }
            else               { const s=(t-0.75)*4; d[i]=255; d[i+1]=200+Math.floor(s*55); d[i+2]=Math.floor(s*180); }
        }

        const tmp = document.createElement('canvas');
        tmp.width = rw * dpr; tmp.height = rh * dpr;
        tmp.getContext('2d').putImageData(imgData, 0, 0);

        trailCtx.save();
        trailCtx.beginPath();
        trailCtx.arc(x, y, r, 0, Math.PI * 2);
        trailCtx.clip();
        trailCtx.drawImage(tmp, 0, 0, rw * dpr, rh * dpr, left, top, rw, rh);
        trailCtx.restore();

        trailCtx.save();
        trailCtx.strokeStyle = 'rgba(255,80,40,0.4)';
        trailCtx.lineWidth = 1;
        trailCtx.beginPath();
        trailCtx.arc(x, y, r, 0, Math.PI * 2);
        trailCtx.stroke();
        trailCtx.restore();
    }

    /* 10. Glitch */
    function stampGlitch(x, y) {
        const r = brushSize;
        const sliceCount = 6 + Math.floor(Math.random() * 5);
        const sliceH = (r * 2) / sliceCount;

        // Base reveal in circle
        trailCtx.save();
        trailCtx.beginPath();
        trailCtx.arc(x, y, r, 0, Math.PI * 2);
        trailCtx.clip();
        trailCtx.drawImage(offCanvas, 0, 0, w, h);
        trailCtx.restore();

        // RGB shifts on random slices
        for (let i = 0; i < sliceCount; i++) {
            if (Math.random() > 0.45) continue;
            const sy = y - r + i * sliceH;
            const shift = (Math.random() - 0.5) * 18;

            trailCtx.save();
            trailCtx.globalCompositeOperation = 'screen';
            trailCtx.globalAlpha = 0.35;
            trailCtx.beginPath();
            trailCtx.rect(x - r, sy, r * 2, sliceH);
            trailCtx.clip();
            trailCtx.drawImage(offCanvas, shift, 0, w, h);
            trailCtx.restore();
        }

        // Scanlines
        trailCtx.save();
        trailCtx.beginPath();
        trailCtx.arc(x, y, r, 0, Math.PI * 2);
        trailCtx.clip();
        trailCtx.fillStyle = 'rgba(0,0,0,0.06)';
        for (let sy = y - r; sy < y + r; sy += 3) {
            trailCtx.fillRect(x - r, sy, r * 2, 1);
        }
        trailCtx.restore();
    }

    /* 11. Smoke — particle system */
    function spawnSmokeParticles() {
        for (let i = 0; i < 4; i++) {
            smokeParticles.push({
                x: mouseX + (Math.random() - 0.5) * brushSize * 0.5,
                y: mouseY + (Math.random() - 0.5) * brushSize * 0.5,
                vx: (Math.random() - 0.5) * 0.6,
                vy: -0.4 - Math.random() * 1.8,
                size: brushSize * 0.15 + Math.random() * brushSize * 0.35,
                life: 1,
                decay: 0.004 + Math.random() * 0.008,
            });
        }
    }

    function updateSmokeParticles() {
        for (let i = smokeParticles.length - 1; i >= 0; i--) {
            const p = smokeParticles[i];
            p.x += p.vx;
            p.y += p.vy;
            p.size *= 1.003;
            p.life -= p.decay;
            if (p.life <= 0) { smokeParticles.splice(i, 1); continue; }

            // Stamp this particle as a masked circle of the reveal image
            trailCtx.save();
            trailCtx.globalAlpha = p.life * 0.8;
            trailCtx.beginPath();
            trailCtx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
            trailCtx.clip();
            trailCtx.drawImage(offCanvas, 0, 0, w, h);
            trailCtx.restore();
        }
        if (smokeParticles.length > 250) smokeParticles.splice(0, smokeParticles.length - 250);
    }

    /* 12. Magnetic (lens zoom) */
    function stampMagnetic(x, y) {
        const r = brushSize / 2;
        const zoom = 1.8;
        const srcSz = r * 2 / zoom;

        trailCtx.save();
        trailCtx.beginPath();
        trailCtx.arc(x, y, r, 0, Math.PI * 2);
        trailCtx.clip();
        trailCtx.drawImage(offCanvas, (x - srcSz / 2) * dpr, (y - srcSz / 2) * dpr, srcSz * dpr, srcSz * dpr, x - r, y - r, r * 2, r * 2);
        trailCtx.restore();

        // Lens ring
        trailCtx.save();
        trailCtx.strokeStyle = 'rgba(255,255,255,0.25)';
        trailCtx.lineWidth = 2;
        trailCtx.beginPath();
        trailCtx.arc(x, y, r, 0, Math.PI * 2);
        trailCtx.stroke();

        // Crosshair
        trailCtx.strokeStyle = 'rgba(125,211,252,0.25)';
        trailCtx.lineWidth = 0.5;
        trailCtx.beginPath();
        trailCtx.moveTo(x - 10, y); trailCtx.lineTo(x + 10, y);
        trailCtx.moveTo(x, y - 10); trailCtx.lineTo(x, y + 10);
        trailCtx.stroke();
        trailCtx.restore();
    }

    /* 13. Dissolve (sand noise) */
    function stampDissolve(x, y) {
        const count = Math.floor(brushSize * 1.8);
        for (let i = 0; i < count; i++) {
            const angle = Math.random() * Math.PI * 2;
            const dist = Math.random() * brushSize / 2;
            const px = x + Math.cos(angle) * dist;
            const py = y + Math.sin(angle) * dist;
            const sz = 1 + Math.random() * 3.5;

            trailCtx.save();
            trailCtx.beginPath();
            trailCtx.rect(px, py, sz, sz);
            trailCtx.clip();
            trailCtx.drawImage(offCanvas, 0, 0, w, h);
            trailCtx.restore();
        }
    }

    /* 14. Voronoi (hexagonal cells) */
    function stampVoronoi(x, y) {
        const r = brushSize * 1.2;
        const imgData = offCtx.getImageData(0, 0, w * dpr, h * dpr);

        for (const seed of voronoiSeeds) {
            const d = Math.hypot(seed.x - x, seed.y - y);
            if (d > r) continue;

            const t = 1 - d / r;
            const px = Math.min(Math.floor(seed.x * dpr), w * dpr - 1);
            const py = Math.min(Math.floor(seed.y * dpr), h * dpr - 1);
            const idx = (py * imgData.width + px) * 4;

            const cellR = 20 + t * 8;
            trailCtx.save();
            trailCtx.globalAlpha = t * 0.85;
            trailCtx.fillStyle = `rgb(${imgData.data[idx]},${imgData.data[idx + 1]},${imgData.data[idx + 2]})`;
            trailCtx.strokeStyle = `rgba(125,211,252,${t * 0.12})`;
            trailCtx.lineWidth = 0.5;
            trailCtx.beginPath();
            for (let a = 0; a < 6; a++) {
                const ang = (Math.PI / 3) * a - Math.PI / 6;
                const vx = seed.x + Math.cos(ang) * cellR;
                const vy = seed.y + Math.sin(ang) * cellR;
                a === 0 ? trailCtx.moveTo(vx, vy) : trailCtx.lineTo(vx, vy);
            }
            trailCtx.closePath();
            trailCtx.fill();
            trailCtx.stroke();
            trailCtx.restore();
        }
    }

    /* 15. ASCII */
    function stampAscii(x, y) {
        const r = brushSize;
        const cs = 9;
        const chars = ' .:-=+*#%@';

        const left   = Math.max(0, Math.floor((x - r) / cs) * cs);
        const top    = Math.max(0, Math.floor((y - r) / cs) * cs);
        const right  = Math.min(w, Math.ceil((x + r) / cs) * cs);
        const bottom = Math.min(h, Math.ceil((y + r) / cs) * cs);
        const rw = right - left, rh = bottom - top;
        if (rw <= 0 || rh <= 0) return;

        const imgData = offCtx.getImageData(left * dpr, top * dpr, rw * dpr, rh * dpr);

        // Dark backdrop
        trailCtx.save();
        trailCtx.beginPath();
        trailCtx.arc(x, y, r, 0, Math.PI * 2);
        trailCtx.clip();
        trailCtx.fillStyle = 'rgba(6,8,13,0.8)';
        trailCtx.fillRect(x - r, y - r, r * 2, r * 2);

        trailCtx.font = `${cs - 1}px "JetBrains Mono",monospace`;
        trailCtx.textBaseline = 'top';

        for (let py = top; py < bottom; py += cs) {
            for (let px = left; px < right; px += cs) {
                const d = Math.hypot(px + cs / 2 - x, py + cs / 2 - y);
                if (d > r) continue;

                const spx = Math.floor((px - left + cs / 2) * dpr);
                const spy = Math.floor((py - top + cs / 2) * dpr);
                const idx = (spy * imgData.width + spx) * 4;
                const rv = imgData.data[idx], gv = imgData.data[idx + 1], bv = imgData.data[idx + 2];
                const lum = (rv * 0.299 + gv * 0.587 + bv * 0.114) / 255;
                const ci = Math.floor(lum * (chars.length - 1));
                const fade = 1 - d / r;

                trailCtx.fillStyle = `rgba(${rv},${gv},${bv},${fade})`;
                trailCtx.fillText(chars[ci], px, py);
            }
        }
        trailCtx.restore();
    }

    /* 16. Matrix (digital rain) */
    function activateMatrixColumns() {
        const r = brushSize * 1.3;
        const cw = 14;
        for (const col of matrixColumns) {
            if (Math.abs(col.x + cw / 2 - mouseX) <= r && isHovering) {
                col.active = true;
            }
        }
    }

    function updateMatrixColumns() {
        const matChars = 'アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲン0123456789';
        const cw = 14;

        trailCtx.font = `${cw - 2}px "JetBrains Mono",monospace`;
        trailCtx.textBaseline = 'top';

        for (const col of matrixColumns) {
            if (!col.active) continue;

            col.y += col.speed;
            if (col.y > h + 60) {
                col.y = -30;
                if (!isHovering) { col.active = false; continue; }
            }

            const trailLen = 10 + Math.floor(Math.random() * 8);
            for (let i = 0; i < trailLen; i++) {
                const cy = col.y - i * cw;
                if (cy < 0 || cy > h) continue;
                const fade = 1 - i / trailLen;
                const ch = matChars[Math.floor(Math.random() * matChars.length)];

                if (i === 0) {
                    trailCtx.fillStyle = `rgba(180,255,180,${fade})`;
                } else {
                    trailCtx.fillStyle = `rgba(0,${Math.floor(150 + fade * 105)},0,${fade * 0.65})`;
                }
                trailCtx.fillText(ch, col.x, cy);
            }
        }

        // Also show faint reveal under active columns
        if (isHovering) {
            const r = brushSize * 1.3;
            trailCtx.save();
            trailCtx.globalAlpha = 0.15;
            trailCtx.beginPath();
            trailCtx.arc(mouseX, mouseY, r, 0, Math.PI * 2);
            trailCtx.clip();
            trailCtx.drawImage(offCanvas, 0, 0, w, h);
            trailCtx.restore();
        }
    }

    /* ─── START ─── */
    raf = requestAnimationFrame(draw);

})();
