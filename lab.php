<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab — Design Experiments | Camil Belmehdi</title>
    <meta name="description" content="Experimental Design Lab — A collection of premium UI patterns, asymmetric layouts, and refined interactions by Camil Belmehdi.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Lab CSS -->
    <link rel="stylesheet" href="assets/css/lab.css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Page-level styles */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--lab-bg-deep, #06080d);
            color: var(--lab-text-primary, #f4f4f6);
            font-family: var(--lab-font-body, 'Outfit', sans-serif);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        /* Custom selection */
        ::selection {
            background: var(--lab-accent, #7dd3fc);
            color: var(--lab-bg-deep, #06080d);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--lab-bg-primary, #0a0d14);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--lab-bg-card, #161b28);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--lab-bg-card-hover, #1c2235);
        }
    </style>
</head>

<body>
    <!-- ═══════════════════════════════════════════════════════════════════════════════
         LAB PAGE — Awwwards-Grade Premium Patterns
         CSS-First, Minimal Motion, Maximum Visual Impact
         ═══════════════════════════════════════════════════════════════════════════════ -->
    <main id="lab">
        <!-- Skip Link (Accessibility) -->
        <a href="#lab-stacked" class="lab-skip-link">Skip to content</a>

        <!-- SVG Definitions for Masks -->
        <svg class="lab-windows__svg-defs" aria-hidden="true">
            <defs>
                <clipPath id="lab-blob-mask" clipPathUnits="objectBoundingBox">
                    <path d="M0.5,0.05 C0.75,0.05 0.95,0.25 0.95,0.5 C0.95,0.75 0.75,0.95 0.5,0.95 C0.25,0.95 0.05,0.75 0.05,0.5 C0.05,0.25 0.25,0.05 0.5,0.05 M0.45,0.1 C0.3,0.12 0.15,0.3 0.12,0.45 C0.1,0.6 0.2,0.8 0.4,0.88 C0.55,0.92 0.75,0.85 0.85,0.7 C0.92,0.55 0.9,0.35 0.8,0.2 C0.7,0.12 0.55,0.08 0.45,0.1" />
                </clipPath>
            </defs>
        </svg>

        <!-- Lateral Navigation Rail -->
        <nav class="lab-nav-rail" aria-label="Lab sections">
            <a href="#lab-hero" class="lab-nav-rail__item lab-focus-ring">
                <span class="lab-nav-rail__dot"></span>
                <span class="lab-nav-rail__label">Intro</span>
            </a>
            <a href="#lab-stacked" class="lab-nav-rail__item lab-focus-ring">
                <span class="lab-nav-rail__dot"></span>
                <span class="lab-nav-rail__label">Services</span>
            </a>
            <a href="#lab-chapter" class="lab-nav-rail__item lab-focus-ring">
                <span class="lab-nav-rail__dot"></span>
                <span class="lab-nav-rail__label">Approach</span>
            </a>
            <a href="#lab-horizontal" class="lab-nav-rail__item lab-focus-ring">
                <span class="lab-nav-rail__dot"></span>
                <span class="lab-nav-rail__label">Work</span>
            </a>
            <a href="#lab-windows" class="lab-nav-rail__item lab-focus-ring">
                <span class="lab-nav-rail__dot"></span>
                <span class="lab-nav-rail__label">Vision</span>
            </a>
            <a href="#lab-broken" class="lab-nav-rail__item lab-focus-ring">
                <span class="lab-nav-rail__dot"></span>
                <span class="lab-nav-rail__label">Impact</span>
            </a>
        </nav>

        <!-- Theme Toggle -->
        <button class="lab-theme-toggle lab-focus-ring" aria-label="Toggle theme">
            <svg class="lab-icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
            </svg>
            <svg class="lab-icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="12" cy="12" r="5"/>
                <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
            </svg>
        </button>

        <!-- ═══════════════════════════════════════════════════════════════
             HERO — Full-screen Intro
             ═══════════════════════════════════════════════════════════════ -->
        <header id="lab-hero" class="lab-hero">
            <div class="lab-container lab-hero__content">
                <div class="lab-hero__title-group">
                    <div class="lab-hero__overline">
                        <span class="lab-overline">Experimental Design Lab</span>
                    </div>
                    <h1 class="lab-hero__title lab-h1">
                        <span>Crafting</span>
                        <span class="lab-hero__title--stroke">Digital</span>
                        <span>Experiences</span>
                    </h1>
                    <p class="lab-hero__subtitle lab-body">
                        A collection of premium UI patterns, asymmetric layouts, and refined interactions.
                        No heavy motion — just pure visual craftsmanship.
                    </p>
                </div>
                <div class="lab-hero__cta">
                    <a href="#lab-stacked" class="lab-btn lab-btn--primary lab-focus-ring">
                        Explore Patterns
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M7 17L17 7M17 7H7M17 7V17"/>
                        </svg>
                    </a>
                    <span class="lab-hero__cta-divider"></span>
                    <span class="lab-caption">5 unique sections</span>
                </div>
            </div>
            <nav class="lab-hero__nav" aria-label="Section index">
                <a href="#lab-stacked" class="lab-hero__nav-item lab-focus-ring">
                    <span class="lab-hero__nav-num">01</span> Stacked Cards
                </a>
                <a href="#lab-chapter" class="lab-hero__nav-item lab-focus-ring">
                    <span class="lab-hero__nav-num">02</span> Split Sticky
                </a>
                <a href="#lab-horizontal" class="lab-hero__nav-item lab-focus-ring">
                    <span class="lab-hero__nav-num">03</span> Horizontal Scroll
                </a>
                <a href="#lab-windows" class="lab-hero__nav-item lab-focus-ring">
                    <span class="lab-hero__nav-num">04</span> Masked Windows
                </a>
                <a href="#lab-broken" class="lab-hero__nav-item lab-focus-ring">
                    <span class="lab-hero__nav-num">05</span> Broken Grid
                </a>
            </nav>
            <div class="lab-hero__scroll" aria-hidden="true">
                <span>Scroll</span>
                <div class="lab-hero__scroll-line"></div>
            </div>
        </header>

        <!-- ═══════════════════════════════════════════════════════════════
             PATTERN 1 — Stacked Cards
             ═══════════════════════════════════════════════════════════════ -->
        <section id="lab-stacked" class="lab-stacked lab-section">
            <div class="lab-container">
                <header class="lab-stacked__header lab-reveal">
                    <div class="lab-stacked__header-inner">
                        <div>
                            <span class="lab-overline">Pattern 01</span>
                            <h2 class="lab-h2">Services & Expertise</h2>
                        </div>
                        <span class="lab-stacked__count">04</span>
                    </div>
                </header>
                <div class="lab-stacked__cards">
                    <!-- Card 1 -->
                    <article class="lab-stacked__card lab-reveal lab-reveal--delay-1">
                        <div class="lab-stacked__card-inner">
                            <div class="lab-stacked__card-content">
                                <span class="lab-stacked__card-num">01</span>
                                <h3 class="lab-stacked__card-title">Interface Design</h3>
                                <p class="lab-stacked__card-desc">
                                    Designing systems that scale. From design tokens to component libraries,
                                    every pixel serves a purpose in the larger ecosystem.
                                </p>
                                <ul class="lab-stacked__card-list">
                                    <li>Design Systems</li>
                                    <li>Component Libraries</li>
                                    <li>Responsive Layouts</li>
                                    <li>Accessibility</li>
                                </ul>
                            </div>
                            <div class="lab-stacked__card-cta">
                                <a href="#" class="lab-stacked__card-btn lab-focus-ring">
                                    Learn more
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M7 17L17 7M17 7H7M17 7V17"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                    <!-- Card 2 -->
                    <article class="lab-stacked__card lab-reveal lab-reveal--delay-2">
                        <div class="lab-stacked__card-inner">
                            <div class="lab-stacked__card-content">
                                <span class="lab-stacked__card-num">02</span>
                                <h3 class="lab-stacked__card-title">Frontend Development</h3>
                                <p class="lab-stacked__card-desc">
                                    Building performant, accessible interfaces with modern technologies.
                                    Clean code that's a joy to maintain and scale.
                                </p>
                                <ul class="lab-stacked__card-list">
                                    <li>React / Vue</li>
                                    <li>TypeScript</li>
                                    <li>CSS Architecture</li>
                                    <li>Performance</li>
                                </ul>
                            </div>
                            <div class="lab-stacked__card-cta">
                                <a href="#" class="lab-stacked__card-btn lab-focus-ring">
                                    Learn more
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M7 17L17 7M17 7H7M17 7V17"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                    <!-- Card 3 -->
                    <article class="lab-stacked__card lab-reveal lab-reveal--delay-3">
                        <div class="lab-stacked__card-inner">
                            <div class="lab-stacked__card-content">
                                <span class="lab-stacked__card-num">03</span>
                                <h3 class="lab-stacked__card-title">Creative Direction</h3>
                                <p class="lab-stacked__card-desc">
                                    Guiding visual strategy from concept to execution. Ensuring every touchpoint
                                    reinforces the brand's unique identity.
                                </p>
                                <ul class="lab-stacked__card-list">
                                    <li>Brand Strategy</li>
                                    <li>Visual Identity</li>
                                    <li>Art Direction</li>
                                    <li>Motion Design</li>
                                </ul>
                            </div>
                            <div class="lab-stacked__card-cta">
                                <a href="#" class="lab-stacked__card-btn lab-focus-ring">
                                    Learn more
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M7 17L17 7M17 7H7M17 7V17"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                    <!-- Card 4 -->
                    <article class="lab-stacked__card lab-reveal lab-reveal--delay-4">
                        <div class="lab-stacked__card-inner">
                            <div class="lab-stacked__card-content">
                                <span class="lab-stacked__card-num">04</span>
                                <h3 class="lab-stacked__card-title">Technical Consulting</h3>
                                <p class="lab-stacked__card-desc">
                                    Strategic guidance on architecture decisions, tooling, and best practices.
                                    Helping teams build with confidence.
                                </p>
                                <ul class="lab-stacked__card-list">
                                    <li>Architecture</li>
                                    <li>Code Reviews</li>
                                    <li>Team Training</li>
                                    <li>Process Design</li>
                                </ul>
                            </div>
                            <div class="lab-stacked__card-cta">
                                <a href="#" class="lab-stacked__card-btn lab-focus-ring">
                                    Learn more
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M7 17L17 7M17 7H7M17 7V17"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- ═══════════════════════════════════════════════════════════════
             PATTERN 2 — Sticky Chapter (Split Sticky)
             ═══════════════════════════════════════════════════════════════ -->
        <section id="lab-chapter" class="lab-sticky-chapter lab-section">
            <div class="lab-container">
                <div class="lab-sticky-chapter__layout">
                    <!-- Left Column: Sticky Nav -->
                    <aside class="lab-sticky-chapter__nav">
                        <span class="lab-overline lab-reveal">Pattern 02</span>
                        <h2 class="lab-sticky-chapter__title lab-reveal lab-reveal--delay-1">My Approach</h2>
                        <p class="lab-sticky-chapter__intro lab-reveal lab-reveal--delay-2">
                            A structured methodology that balances creativity with technical precision.
                        </p>
                        <nav class="lab-sticky-chapter__index" aria-label="Chapter navigation">
                            <a href="#chapter-1" class="lab-sticky-chapter__index-item is-active lab-focus-ring">
                                <span class="lab-sticky-chapter__index-num">01</span>
                                <span class="lab-sticky-chapter__index-line"></span>
                                <span class="lab-sticky-chapter__index-label">Discovery</span>
                            </a>
                            <a href="#chapter-2" class="lab-sticky-chapter__index-item lab-focus-ring">
                                <span class="lab-sticky-chapter__index-num">02</span>
                                <span class="lab-sticky-chapter__index-line"></span>
                                <span class="lab-sticky-chapter__index-label">Design</span>
                            </a>
                            <a href="#chapter-3" class="lab-sticky-chapter__index-item lab-focus-ring">
                                <span class="lab-sticky-chapter__index-num">03</span>
                                <span class="lab-sticky-chapter__index-line"></span>
                                <span class="lab-sticky-chapter__index-label">Development</span>
                            </a>
                            <a href="#chapter-4" class="lab-sticky-chapter__index-item lab-focus-ring">
                                <span class="lab-sticky-chapter__index-num">04</span>
                                <span class="lab-sticky-chapter__index-line"></span>
                                <span class="lab-sticky-chapter__index-label">Delivery</span>
                            </a>
                        </nav>
                    </aside>
                    <!-- Right Column: Scrolling Content -->
                    <div class="lab-sticky-chapter__content">
                        <!-- Block 1 -->
                        <article id="chapter-1" class="lab-sticky-chapter__block">
                            <header class="lab-sticky-chapter__block-header">
                                <span class="lab-sticky-chapter__block-num">01</span>
                                <h3 class="lab-sticky-chapter__block-title">Discovery & Research</h3>
                            </header>
                            <div class="lab-sticky-chapter__block-body">
                                <p class="lab-sticky-chapter__block-text">
                                    Every project begins with deep understanding. I immerse myself in your business,
                                    your users, and your goals to uncover the insights that will drive design decisions.
                                </p>
                                <p class="lab-sticky-chapter__block-text">
                                    Through stakeholder interviews, competitive analysis, and user research,
                                    we establish a solid foundation for the work ahead.
                                </p>
                                <ul class="lab-sticky-chapter__block-features">
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Stakeholder Workshops
                                    </li>
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Competitive Analysis
                                    </li>
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        User Interviews
                                    </li>
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Requirements Definition
                                    </li>
                                </ul>
                                <div class="lab-sticky-chapter__block-visual lab-img-placeholder"></div>
                            </div>
                        </article>
                        <!-- Block 2 -->
                        <article id="chapter-2" class="lab-sticky-chapter__block">
                            <header class="lab-sticky-chapter__block-header">
                                <span class="lab-sticky-chapter__block-num">02</span>
                                <h3 class="lab-sticky-chapter__block-title">Design & Prototyping</h3>
                            </header>
                            <div class="lab-sticky-chapter__block-body">
                                <p class="lab-sticky-chapter__block-text">
                                    With research insights in hand, I translate strategy into tangible design concepts.
                                    Wireframes evolve into high-fidelity mockups, validated through iterative prototyping.
                                </p>
                                <p class="lab-sticky-chapter__block-text">
                                    Design systems ensure consistency while enabling rapid iteration.
                                    Every component is crafted with scalability in mind.
                                </p>
                                <ul class="lab-sticky-chapter__block-features">
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Wireframing
                                    </li>
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Visual Design
                                    </li>
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Interactive Prototypes
                                    </li>
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Design Systems
                                    </li>
                                </ul>
                                <div class="lab-sticky-chapter__block-visual lab-img-placeholder"></div>
                            </div>
                        </article>
                        <!-- Block 3 -->
                        <article id="chapter-3" class="lab-sticky-chapter__block">
                            <header class="lab-sticky-chapter__block-header">
                                <span class="lab-sticky-chapter__block-num">03</span>
                                <h3 class="lab-sticky-chapter__block-title">Development & Build</h3>
                            </header>
                            <div class="lab-sticky-chapter__block-body">
                                <p class="lab-sticky-chapter__block-text">
                                    Design meets code. I build with modern frameworks and best practices,
                                    ensuring performance, accessibility, and maintainability are never afterthoughts.
                                </p>
                                <p class="lab-sticky-chapter__block-text">
                                    Clean architecture and comprehensive testing create a foundation
                                    that your team can confidently build upon.
                                </p>
                                <ul class="lab-sticky-chapter__block-features">
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Component Development
                                    </li>
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Responsive Implementation
                                    </li>
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Performance Optimization
                                    </li>
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Accessibility Audits
                                    </li>
                                </ul>
                                <div class="lab-sticky-chapter__block-visual lab-img-placeholder"></div>
                            </div>
                        </article>
                        <!-- Block 4 -->
                        <article id="chapter-4" class="lab-sticky-chapter__block">
                            <header class="lab-sticky-chapter__block-header">
                                <span class="lab-sticky-chapter__block-num">04</span>
                                <h3 class="lab-sticky-chapter__block-title">Launch & Iterate</h3>
                            </header>
                            <div class="lab-sticky-chapter__block-body">
                                <p class="lab-sticky-chapter__block-text">
                                    Launch is just the beginning. I ensure smooth deployment and provide
                                    documentation that empowers your team to maintain and evolve the product.
                                </p>
                                <p class="lab-sticky-chapter__block-text">
                                    Post-launch analytics inform continuous improvements,
                                    keeping the experience aligned with user needs.
                                </p>
                                <ul class="lab-sticky-chapter__block-features">
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Deployment Support
                                    </li>
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Documentation
                                    </li>
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Analytics Setup
                                    </li>
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Iteration Planning
                                    </li>
                                </ul>
                                <div class="lab-sticky-chapter__block-visual lab-img-placeholder"></div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══════════════════════════════════════════════════════════════
             PATTERN 3 — Horizontal Scrollytelling
             ═══════════════════════════════════════════════════════════════ -->
        <section id="lab-horizontal" class="lab-horizontal lab-section">
            <div class="lab-container">
                <header class="lab-horizontal__header lab-reveal">
                    <div class="lab-horizontal__header-inner">
                        <div class="lab-horizontal__header-text">
                            <span class="lab-overline">Pattern 03</span>
                            <h2 class="lab-h2">Selected Work</h2>
                            <p class="lab-body" style="margin-top: var(--lab-space-4);">
                                A curated collection of projects that showcase diverse capabilities
                                and creative problem-solving.
                            </p>
                            <div class="lab-horizontal__scroll-hint">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                                Swipe to explore
                            </div>
                        </div>
                        <div class="lab-horizontal__counter">
                            <span class="lab-horizontal__counter-current">01</span>
                            <span>/</span>
                            <span>05</span>
                        </div>
                    </div>
                </header>
            </div>
            <div class="lab-horizontal__wrapper">
                <div class="lab-horizontal__track">
                    <!-- Panel 1 -->
                    <div class="lab-horizontal__panel">
                        <div class="lab-horizontal__panel-inner">
                            <div class="lab-horizontal__panel-content">
                                <span class="lab-horizontal__panel-num">01</span>
                                <h3 class="lab-horizontal__panel-title">E-Commerce Platform</h3>
                                <p class="lab-horizontal__panel-desc">
                                    A complete redesign of a luxury fashion retailer's digital presence.
                                    Focused on editorial presentation and seamless checkout experience.
                                </p>
                                <div class="lab-horizontal__panel-tags">
                                    <span class="lab-horizontal__panel-tag">UI/UX</span>
                                    <span class="lab-horizontal__panel-tag">E-Commerce</span>
                                    <span class="lab-horizontal__panel-tag">React</span>
                                </div>
                            </div>
                            <div class="lab-horizontal__panel-visual lab-img-placeholder"></div>
                        </div>
                    </div>
                    <!-- Panel 2 -->
                    <div class="lab-horizontal__panel">
                        <div class="lab-horizontal__panel-inner">
                            <div class="lab-horizontal__panel-content">
                                <span class="lab-horizontal__panel-num">02</span>
                                <h3 class="lab-horizontal__panel-title">SaaS Dashboard</h3>
                                <p class="lab-horizontal__panel-desc">
                                    An analytics platform for enterprise clients. Complex data made
                                    accessible through thoughtful information architecture.
                                </p>
                                <div class="lab-horizontal__panel-tags">
                                    <span class="lab-horizontal__panel-tag">Dashboard</span>
                                    <span class="lab-horizontal__panel-tag">Data Viz</span>
                                    <span class="lab-horizontal__panel-tag">Vue</span>
                                </div>
                            </div>
                            <div class="lab-horizontal__panel-visual lab-img-placeholder"></div>
                        </div>
                    </div>
                    <!-- Panel 3 -->
                    <div class="lab-horizontal__panel">
                        <div class="lab-horizontal__panel-inner">
                            <div class="lab-horizontal__panel-content">
                                <span class="lab-horizontal__panel-num">03</span>
                                <h3 class="lab-horizontal__panel-title">Brand Identity</h3>
                                <p class="lab-horizontal__panel-desc">
                                    Complete visual identity for a climate tech startup.
                                    Modern, bold, and purposeful — reflecting their mission.
                                </p>
                                <div class="lab-horizontal__panel-tags">
                                    <span class="lab-horizontal__panel-tag">Branding</span>
                                    <span class="lab-horizontal__panel-tag">Identity</span>
                                    <span class="lab-horizontal__panel-tag">Guidelines</span>
                                </div>
                            </div>
                            <div class="lab-horizontal__panel-visual lab-img-placeholder"></div>
                        </div>
                    </div>
                    <!-- Panel 4 -->
                    <div class="lab-horizontal__panel">
                        <div class="lab-horizontal__panel-inner">
                            <div class="lab-horizontal__panel-content">
                                <span class="lab-horizontal__panel-num">04</span>
                                <h3 class="lab-horizontal__panel-title">Mobile Application</h3>
                                <p class="lab-horizontal__panel-desc">
                                    A wellness app designed for daily use. Micro-interactions and
                                    gentle animations create a calming user experience.
                                </p>
                                <div class="lab-horizontal__panel-tags">
                                    <span class="lab-horizontal__panel-tag">Mobile</span>
                                    <span class="lab-horizontal__panel-tag">iOS</span>
                                    <span class="lab-horizontal__panel-tag">Android</span>
                                </div>
                            </div>
                            <div class="lab-horizontal__panel-visual lab-img-placeholder"></div>
                        </div>
                    </div>
                    <!-- Panel 5 -->
                    <div class="lab-horizontal__panel">
                        <div class="lab-horizontal__panel-inner">
                            <div class="lab-horizontal__panel-content">
                                <span class="lab-horizontal__panel-num">05</span>
                                <h3 class="lab-horizontal__panel-title">Design System</h3>
                                <p class="lab-horizontal__panel-desc">
                                    A comprehensive design system serving multiple product teams.
                                    Tokens, components, and documentation for consistent experiences.
                                </p>
                                <div class="lab-horizontal__panel-tags">
                                    <span class="lab-horizontal__panel-tag">System</span>
                                    <span class="lab-horizontal__panel-tag">Tokens</span>
                                    <span class="lab-horizontal__panel-tag">Figma</span>
                                </div>
                            </div>
                            <div class="lab-horizontal__panel-visual lab-img-placeholder"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lab-horizontal__spacer"></div>
            <!-- Progress indicator -->
            <div class="lab-horizontal__progress">
                <div class="lab-horizontal__progress-bar">
                    <div class="lab-horizontal__progress-fill"></div>
                </div>
                <span class="lab-horizontal__progress-text">Scroll to navigate</span>
            </div>
        </section>

        <!-- ═══════════════════════════════════════════════════════════════
             PATTERN 4 — Masked Windows
             ═══════════════════════════════════════════════════════════════ -->
        <section id="lab-windows" class="lab-windows lab-section">
            <div class="lab-windows__bg"></div>
            <div class="lab-container">
                <div class="lab-windows__grid">
                    <!-- Text Content -->
                    <div class="lab-windows__content">
                        <span class="lab-overline lab-reveal">Pattern 04</span>
                        <h2 class="lab-windows__title lab-reveal lab-reveal--delay-1">
                            Design with<br>Purpose
                        </h2>
                        <p class="lab-windows__desc lab-reveal lab-reveal--delay-2">
                            Every element serves the narrative. Shapes become windows into
                            carefully curated moments — organic forms that feel alive.
                        </p>
                        <ul class="lab-windows__features lab-reveal lab-reveal--delay-3">
                            <li class="lab-windows__feature">
                                <span class="lab-windows__feature-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <path d="M12 6v6l4 2"/>
                                    </svg>
                                </span>
                                Timeless aesthetics
                            </li>
                            <li class="lab-windows__feature">
                                <span class="lab-windows__feature-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                    </svg>
                                </span>
                                Layered compositions
                            </li>
                            <li class="lab-windows__feature">
                                <span class="lab-windows__feature-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                                    </svg>
                                </span>
                                Structural clarity
                            </li>
                        </ul>
                    </div>
                    <!-- Window Frames -->
                    <div class="lab-windows__frames lab-reveal lab-reveal--delay-2">
                        <!-- Main blob window -->
                        <div class="lab-windows__main">
                            <div class="lab-windows__main-mask">
                                <div class="lab-windows__main-inner lab-img-placeholder">
                                    <!-- Image would go here -->
                                </div>
                            </div>
                        </div>
                        <!-- Secondary windows -->
                        <div class="lab-windows__window lab-windows__window--1 lab-img-placeholder">
                            <!-- Capsule image -->
                        </div>
                        <div class="lab-windows__window lab-windows__window--2 lab-img-placeholder">
                            <!-- Rounded rect image -->
                        </div>
                        <div class="lab-windows__window lab-windows__window--3 lab-img-placeholder">
                            <!-- Circle image -->
                        </div>
                        <!-- Decorative elements -->
                        <div class="lab-windows__deco lab-windows__deco--line lab-windows__deco--line-1"></div>
                        <div class="lab-windows__deco lab-windows__deco--line lab-windows__deco--line-2"></div>
                        <div class="lab-windows__deco lab-windows__deco--dot lab-windows__deco--dot-1"></div>
                        <div class="lab-windows__deco lab-windows__deco--dot lab-windows__deco--dot-2"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══════════════════════════════════════════════════════════════
             PATTERN 5 — Broken Grid
             ═══════════════════════════════════════════════════════════════ -->
        <section id="lab-broken" class="lab-broken lab-section">
            <div class="lab-container">
                <div class="lab-broken__grid">
                    <!-- Hero Title -->
                    <div class="lab-broken__hero lab-reveal">
                        <h2 class="lab-broken__hero-title">
                            <span>Measure</span>
                            <span class="lab-broken__hero-outline">What</span>
                            <span>Matters</span>
                        </h2>
                    </div>
                    <!-- Side Note -->
                    <aside class="lab-broken__side-note lab-reveal lab-reveal--delay-1">
                        <span class="lab-broken__side-note-num">Note 01</span>
                        <p class="lab-broken__side-note-text">
                            Impact is measured not just in metrics, but in the experiences
                            we create and the problems we solve.
                        </p>
                    </aside>
                    <!-- Main Image -->
                    <figure class="lab-broken__image lab-reveal lab-reveal--delay-2">
                        <div class="lab-broken__image-frame lab-img-placeholder">
                            <!-- Large featured image -->
                        </div>
                        <figcaption class="lab-broken__image-caption">
                            Featured: Annual Review 2024
                        </figcaption>
                    </figure>
                    <!-- Content Block -->
                    <div class="lab-broken__content lab-reveal lab-reveal--delay-1">
                        <h3 class="lab-broken__content-title">Beyond the surface</h3>
                        <p class="lab-broken__content-text">
                            Great design is invisible. It gets out of the way and lets people
                            accomplish their goals. But behind that simplicity lies careful
                            consideration of every detail, every interaction, every moment.
                        </p>
                    </div>
                    <!-- Cards Row -->
                    <div class="lab-broken__cards">
                        <article class="lab-broken__card lab-reveal">
                            <span class="lab-broken__card-label">Strategy</span>
                            <h4 class="lab-broken__card-title">User-Centered</h4>
                            <p class="lab-broken__card-desc">
                                Research-driven decisions that put real users at the heart of every solution.
                            </p>
                        </article>
                        <article class="lab-broken__card lab-broken__card--featured lab-reveal lab-reveal--delay-1">
                            <span class="lab-broken__card-label">Philosophy</span>
                            <h4 class="lab-broken__card-title">Purposeful Simplicity</h4>
                            <p class="lab-broken__card-desc">
                                Complexity is easy. Simplicity is hard. We embrace the challenge of
                                distilling ideas to their essential form without losing meaning.
                            </p>
                        </article>
                        <article class="lab-broken__card lab-reveal lab-reveal--delay-2">
                            <span class="lab-broken__card-label">Approach</span>
                            <h4 class="lab-broken__card-title">Iterative</h4>
                            <p class="lab-broken__card-desc">
                                Progress through cycles of creation, testing, and refinement.
                            </p>
                        </article>
                    </div>
                    <!-- Annotation -->
                    <aside class="lab-broken__annotation lab-reveal">
                        <p class="lab-broken__annotation-text">
                            * These numbers reflect verified client results from 2023–2024 engagements.
                        </p>
                    </aside>
                    <!-- Stats -->
                    <div class="lab-broken__stats lab-reveal lab-reveal--delay-1">
                        <div class="lab-broken__stat">
                            <span class="lab-broken__stat-value">94%</span>
                            <span class="lab-broken__stat-label">Client satisfaction</span>
                        </div>
                        <div class="lab-broken__stat">
                            <span class="lab-broken__stat-value">2.3x</span>
                            <span class="lab-broken__stat-label">Average conversion lift</span>
                        </div>
                        <div class="lab-broken__stat">
                            <span class="lab-broken__stat-value">40+</span>
                            <span class="lab-broken__stat-label">Projects delivered</span>
                        </div>
                    </div>
                    <!-- Tagline -->
                    <div class="lab-broken__tagline lab-reveal">
                        <p class="lab-broken__tagline-text">
                            Design is not just what it looks like.<br>
                            <strong>Design is how it works.</strong>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══════════════════════════════════════════════════════════════
             LAB FOOTER
             ═══════════════════════════════════════════════════════════════ -->
        <footer id="lab-footer" class="lab-footer">
            <div class="lab-container">
                <div class="lab-footer__inner">
                    <a href="index.php" class="lab-footer__back lab-focus-ring">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Back to Portfolio
                    </a>
                    <div class="lab-footer__brand">
                        <span class="lab-footer__logo">Lab Experiments</span>
                        <p class="lab-footer__copy">Premium UI Patterns Collection</p>
                    </div>
                    <div class="lab-footer__links">
                        <a href="https://github.com/Khabibi45" target="_blank" rel="noopener noreferrer"
                           class="lab-footer__link lab-focus-ring" aria-label="GitHub">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                            </svg>
                        </a>
                        <a href="index.php#contact" class="lab-footer__link lab-focus-ring" aria-label="Contact">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!-- Lab Scripts -->
    <script src="assets/js/lab/reveal.js"></script>
    <script src="assets/js/lab/active-chapters.js"></script>
    <script src="assets/js/lab/horizontal-scroll.js"></script>
    <script src="assets/js/lab/nav-rail.js"></script>
    <script src="assets/js/lab/theme-toggle.js"></script>
</body>

</html>
