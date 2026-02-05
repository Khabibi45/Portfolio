/**
 * ABOUT LAB - Controller
 * Manages prototype loading, controls, and FPS monitoring
 */

(function () {
    'use strict';

    // === STATE ===
    const state = {
        currentPrototype: '01',
        perfMode: false,
        reducedMotion: false,
        intensity: 50
    };

    // === ELEMENTS ===
    const elements = {
        container: document.getElementById('prototype-container'),
        viewport: document.getElementById('lab-viewport'),
        navItems: document.querySelectorAll('.lab-nav-item'),
        perfToggle: document.getElementById('perf-mode'),
        motionToggle: document.getElementById('reduced-motion'),
        intensitySlider: document.getElementById('intensity'),
        intensityValue: document.getElementById('intensity-value'),
        fpsCounter: document.getElementById('fps-counter')
    };

    // === FPS COUNTER ===
    let frameCount = 0;
    let lastTime = performance.now();

    function updateFPS() {
        frameCount++;
        const now = performance.now();

        if (now - lastTime >= 1000) {
            elements.fpsCounter.textContent = frameCount;

            // Color based on FPS
            if (frameCount >= 55) {
                elements.fpsCounter.style.color = '#22c55e'; // Green
            } else if (frameCount >= 30) {
                elements.fpsCounter.style.color = '#eab308'; // Yellow
            } else {
                elements.fpsCounter.style.color = '#ef4444'; // Red
            }

            frameCount = 0;
            lastTime = now;
        }

        requestAnimationFrame(updateFPS);
    }

    // === PROTOTYPE LOADING ===
    const prototypeHTML = {
        '01': generateCameraRailHTML,
        '02': generateTimeFoldingHTML,
        '03': generateTypoArchitectureHTML,
        '04': generateGlassMuseumHTML,
        '05': generateInkGravityHTML,
        '06': generateMagneticTimelineHTML,
        '07': generateShadowTheatreHTML,
        '08': generateBlueprintRealityHTML,
        '09': generateKineticGalleryHTML,
        '10': generateContinuousTakeHTML,
        '11': generateMountainAscentHTML
    };

    async function loadPrototype(id) {
        // Clear current
        elements.container.innerHTML = '';
        elements.viewport.scrollTop = 0;

        // Kill existing ScrollTriggers
        if (typeof ScrollTrigger !== 'undefined') {
            ScrollTrigger.getAll().forEach(st => st.kill());
        }

        // Generate HTML
        const generator = prototypeHTML[id];
        if (generator) {
            elements.container.innerHTML = generator();
        } else {
            elements.container.innerHTML = `
                <div style="padding: 4rem; text-align: center; color: #64748b;">
                    <h2>Prototype #${id}</h2>
                    <p>Coming soon...</p>
                </div>
            `;
        }

        // Load prototype-specific JS
        const scriptPath = `../prototypes/${id}-${getPrototypeName(id)}/prototype.js`;
        try {
            await loadScript(scriptPath);
        } catch (e) {
            console.log(`No JS for prototype ${id}`);
        }

        // Initialize prototype
        if (window.initPrototype) {
            window.initPrototype(state);
            window.initPrototype = null;
        }
    }

    function getPrototypeName(id) {
        const names = {
            '01': 'camera-rail',
            '02': 'time-folding',
            '03': 'typo-architecture',
            '04': 'glass-museum',
            '05': 'ink-gravity',
            '06': 'magnetic-timeline',
            '07': 'shadow-theatre',
            '08': 'blueprint-reality',
            '09': 'kinetic-gallery',
            '10': 'continuous-take',
            '11': 'mountain-ascent'
        };
        return names[id] || '';
    }

    function loadScript(src) {
        return new Promise((resolve, reject) => {
            const script = document.createElement('script');
            script.src = src;
            script.onload = resolve;
            script.onerror = reject;
            document.body.appendChild(script);
        });
    }

    // === HTML GENERATORS ===
    function generateCameraRailHTML() {
        return `
            <section class="prototype-section proto-camera-rail">
                <div class="proto-container">
                    <h2 class="proto-title">Mon Parcours Scolaire et Professionnel</h2>
                    <p class="proto-subtitle">Camera Rail Journey</p>
                    
                    <div class="rail-container">
                        <div class="rail-line">
                            <div class="rail-progress"></div>
                        </div>
                        
                        ${MILESTONES.map((m, i) => `
                            <div class="rail-station ${i % 2 === 0 ? 'left' : 'right'} ${m.hero ? 'hero' : ''}" data-station="${i}">
                                <div class="station-node"></div>
                                <div class="station-card">
                                    <span class="station-year">${m.year}</span>
                                    <h3 class="station-title">${m.title}</h3>
                                    <p class="station-desc">${m.desc}</p>
                                </div>
                                <div class="station-keyword">${m.keyword}</div>
                                <div class="station-metric">
                                    <span class="metric-label">STATUS</span>
                                    <span class="metric-value">${m.metric}</span>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </section>
        `;
    }

    function generateTimeFoldingHTML() {
        return `
            <section class="prototype-section proto-time-folding">
                <div class="proto-container">
                    <h2 class="proto-title">TIME FOLDING CORRIDOR</h2>
                    <p class="proto-subtitle">Space bends with scroll</p>
                    
                    <div class="corridor-container">
                        ${MILESTONES.map((m, i) => `
                            <div class="corridor-panel" data-panel="${i}">
                                <div class="panel-content">
                                    <span class="panel-year">${m.year}</span>
                                    <h3 class="panel-title">${m.title}</h3>
                                    <p class="panel-desc">${m.desc}</p>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </section>
        `;
    }

    function generateTypoArchitectureHTML() {
        return `
            <section class="prototype-section proto-typo-architecture">
                <div class="proto-container">
                    <h2 class="proto-title">TYPOGRAPHY AS ARCHITECTURE</h2>
                    <p class="proto-subtitle">Words become structures</p>
                    
                    <div class="typo-container">
                        ${MILESTONES.map((m, i) => `
                            <div class="typo-block" data-block="${i}">
                                <div class="typo-background">${m.keyword}</div>
                                <div class="typo-card">
                                    <span class="typo-year">${m.year}</span>
                                    <h3 class="typo-title">${m.title}</h3>
                                    <p class="typo-desc">${m.desc}</p>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </section>
        `;
    }

    function generateGlassMuseumHTML() {
        return `
            <section class="prototype-section proto-glass-museum">
                <div class="proto-container">
                    <h2 class="proto-title">MEMORY GLASS MUSEUM</h2>
                    <p class="proto-subtitle">Floating vitrines of experience</p>
                    
                    <div class="museum-container">
                        ${MILESTONES.map((m, i) => `
                            <div class="vitrine" data-vitrine="${i}">
                                <div class="vitrine-glass"></div>
                                <div class="vitrine-content">
                                    <span class="vitrine-year">${m.year}</span>
                                    <h3 class="vitrine-title">${m.title}</h3>
                                    <p class="vitrine-desc">${m.desc}</p>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </section>
        `;
    }

    function generateInkGravityHTML() {
        return `
            <section class="prototype-section proto-ink-gravity">
                <div class="proto-container">
                    <h2 class="proto-title">INK IN GRAVITY</h2>
                    <p class="proto-subtitle">Ink reveals the path</p>
                    
                    <canvas id="ink-canvas"></canvas>
                    
                    <div class="ink-container">
                        ${MILESTONES.map((m, i) => `
                            <div class="ink-station" data-ink="${i}">
                                <div class="ink-card">
                                    <span class="ink-year">${m.year}</span>
                                    <h3 class="ink-title">${m.title}</h3>
                                    <p class="ink-desc">${m.desc}</p>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </section>
        `;
    }

    function generateMagneticTimelineHTML() {
        return `
            <section class="prototype-section proto-magnetic-timeline">
                <div class="proto-container">
                    <h2 class="proto-title">MAGNETIC TIMELINE</h2>
                    <p class="proto-subtitle">Suspended by invisible forces</p>
                    
                    <div class="magnetic-container">
                        <div class="magnetic-field"></div>
                        ${MILESTONES.map((m, i) => `
                            <div class="magnetic-node" data-node="${i}">
                                <div class="node-connector"></div>
                                <div class="node-card">
                                    <span class="node-year">${m.year}</span>
                                    <h3 class="node-title">${m.title}</h3>
                                    <p class="node-desc">${m.desc}</p>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </section>
        `;
    }

    function generateShadowTheatreHTML() {
        return `
            <section class="prototype-section proto-shadow-theatre">
                <div class="proto-container">
                    <h2 class="proto-title">SHADOW THEATRE</h2>
                    <p class="proto-subtitle">Light illuminates memory</p>
                    
                    <div class="spotlight" id="spotlight"></div>
                    
                    <div class="theatre-container">
                        ${MILESTONES.map((m, i) => `
                            <div class="theatre-scene" data-scene="${i}">
                                <div class="scene-card">
                                    <span class="scene-year">${m.year}</span>
                                    <h3 class="scene-title">${m.title}</h3>
                                    <p class="scene-desc">${m.desc}</p>
                                </div>
                                <div class="scene-shadow"></div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </section>
        `;
    }

    function generateBlueprintRealityHTML() {
        return `
            <section class="prototype-section proto-blueprint">
                <div class="proto-container">
                    <h2 class="proto-title">BLUEPRINT → REALITY</h2>
                    <p class="proto-subtitle">From wireframe to substance</p>
                    
                    <div class="blueprint-container">
                        ${MILESTONES.map((m, i) => `
                            <div class="blueprint-block" data-block="${i}">
                                <div class="block-wireframe">
                                    <div class="wire-corner tl"></div>
                                    <div class="wire-corner tr"></div>
                                    <div class="wire-corner bl"></div>
                                    <div class="wire-corner br"></div>
                                </div>
                                <div class="block-fill">
                                    <span class="fill-year">${m.year}</span>
                                    <h3 class="fill-title">${m.title}</h3>
                                    <p class="fill-desc">${m.desc}</p>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </section>
        `;
    }

    function generateKineticGalleryHTML() {
        return `
            <section class="prototype-section proto-kinetic-gallery">
                <div class="proto-container">
                    <h2 class="proto-title">KINETIC GALLERY</h2>
                    <p class="proto-subtitle">Snapping frames of experience</p>
                    
                    <div class="gallery-container">
                        ${MILESTONES.map((m, i) => `
                            <div class="gallery-frame" data-frame="${i}">
                                <div class="frame-content">
                                    <span class="frame-year">${m.year}</span>
                                    <h3 class="frame-title">${m.title}</h3>
                                    <p class="frame-desc">${m.desc}</p>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </section>
        `;
    }

    function generateContinuousTakeHTML() {
        return `
            <section class="prototype-section proto-continuous-take">
                <div class="proto-container">
                    <h2 class="proto-title">ONE CONTINUOUS TAKE</h2>
                    <p class="proto-subtitle">A single breath of experience</p>
                    
                    <div class="take-container">
                        <div class="take-rail"></div>
                        ${MILESTONES.map((m, i) => `
                            <div class="take-moment" data-moment="${i}">
                                <div class="moment-content">
                                    <span class="moment-year">${m.year}</span>
                                    <h3 class="moment-title">${m.title}</h3>
                                    <p class="moment-desc">${m.desc}</p>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </section>
        `;
    }

    function generateMountainAscentHTML() {
        // Projects data for stations
        const PROJECTS = [
            { year: '2023', title: 'Pastel Builder', desc: 'Site builder no-code avec système de thèmes et modules dynamiques.', tags: ['PHP', 'JS', 'CSS'] },
            { year: '2023', title: 'AI Agents Hub', desc: "Orchestration d'agents IA autonomes pour l'automatisation.", tags: ['Python', 'LangChain', 'API'] },
            { year: '2024', title: 'Portfolio V2', desc: 'Refonte complète avec animations Awwwards-tier.', tags: ['GSAP', 'Canvas', 'PHP'] },
            { year: '2024', title: 'Automation Suite', desc: 'Suite complète de workflows automatisés.', tags: ['N8N', 'API', 'Zapier'] }
        ];

        return `
            <section class="prototype-section proto-mountain-ascent">
                <!-- Grain overlay -->
                <div class="mountain-grain"></div>
                
                <!-- Parallax layers -->
                <div class="mountain-layers">
                    <div class="mountain-layer layer-stars"></div>
                    <div class="mountain-layer layer-peaks"></div>
                    <div class="mountain-layer layer-mid"></div>
                    <div class="mountain-layer layer-fog"></div>
                    <div class="mountain-layer layer-ridge"></div>
                </div>
                
                <!-- Trail SVG -->
                <div class="trail-container">
                    <svg class="trail-svg" viewBox="0 0 800 2000" preserveAspectRatio="xMidYMax slice">
                        <defs>
                            <linearGradient id="trailGradient" x1="0%" y1="100%" x2="0%" y2="0%">
                                <stop offset="0%" stop-color="#818cf8" stop-opacity="0.2"/>
                                <stop offset="50%" stop-color="#818cf8"/>
                                <stop offset="100%" stop-color="#c084fc"/>
                            </linearGradient>
                        </defs>
                        <!-- Zigzag path from bottom to top -->
                        <path class="trail-path" d="M 400 1950 
                            L 200 1700 L 600 1450 L 200 1200 L 600 950 L 200 700 L 400 400 L 400 150"/>
                        <path class="trail-progress" d="M 400 1950 
                            L 200 1700 L 600 1450 L 200 1200 L 600 950 L 200 700 L 400 400 L 400 150"/>
                    </svg>
                    
                    <!-- Flow runner -->
                    <div class="flow-runner"></div>
                </div>
                
                <!-- Camera Rig -->
                <div class="camera-rig">
                    <!-- Stations -->
                    ${PROJECTS.map((p, i) => {
            const positions = [
                { top: '75%', side: 'left' },
                { top: '55%', side: 'right' },
                { top: '35%', side: 'left' },
                { top: '18%', side: 'right' }
            ];
            const pos = positions[i] || positions[0];
            return `
                            <div class="mountain-station ${pos.side}" style="top: ${pos.top}" data-position="${(i + 1) * 0.2}">
                                <div class="station-marker"></div>
                                <div class="station-card">
                                    <span class="station-year">${p.year}</span>
                                    <h3 class="station-title">${p.title}</h3>
                                    <p class="station-desc">${p.desc}</p>
                                    <div class="station-tags">
                                        ${p.tags.map(t => `<span class="station-tag">${t}</span>`).join('')}
                                    </div>
                                </div>
                            </div>
                        `;
        }).join('')}
                    
                    <!-- Summit -->
                    <div class="summit-zone" style="top: 3%">
                        <div class="summit-halo"></div>
                        <div class="summit-bg-text">SUMMIT</div>
                        <div class="summit-content">
                            <span class="summit-label">AUJOURD'HUI</span>
                            <h2 class="summit-title">Elite Automation Developer</h2>
                            <div class="summit-skills">
                                <span class="summit-skill">Agents IA</span>
                                <span class="summit-skill">Fullstack</span>
                                <span class="summit-skill">Automation</span>
                            </div>
                            <a href="#contact" class="summit-cta">Me Contacter</a>
                        </div>
                    </div>
                </div>
                
                <!-- Altitude indicator -->
                <div class="altitude-indicator">
                    <div class="altitude-bar">
                        <div class="altitude-progress"></div>
                    </div>
                    <span>ALT</span>
                </div>
            </section>
        `;
    }

    // === EVENT HANDLERS ===
    function setupEventListeners() {
        // Navigation
        elements.navItems.forEach(item => {
            item.addEventListener('click', () => {
                const id = item.dataset.prototype;

                elements.navItems.forEach(n => n.classList.remove('active'));
                item.classList.add('active');

                state.currentPrototype = id;
                loadPrototype(id);
            });
        });

        // Perf Mode
        elements.perfToggle.addEventListener('change', (e) => {
            state.perfMode = e.target.checked;
            document.body.classList.toggle('perf-mode', state.perfMode);
        });

        // Reduced Motion
        elements.motionToggle.addEventListener('change', (e) => {
            state.reducedMotion = e.target.checked;
            document.body.classList.toggle('reduced-motion', state.reducedMotion);
        });

        // Intensity
        elements.intensitySlider.addEventListener('input', (e) => {
            state.intensity = parseInt(e.target.value);
            elements.intensityValue.textContent = state.intensity;
            document.documentElement.style.setProperty('--intensity', state.intensity / 100);
        });
    }

    // === INIT ===
    function init() {
        setupEventListeners();
        updateFPS();
        loadPrototype('01');
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
