'use client';

import { useEffect, useState } from 'react';
import dynamic from 'next/dynamic';
import ScrollDirector from '@/components/ScrollDirector';
import CursorForceField from '@/components/CursorForceField';
import Section from '@/components/Section';
import TypographyReveal from '@/components/TypographyReveal';
import styles from './page.module.css';

// Dynamic import for WebGL to avoid SSR issues
const WebGLStage = dynamic(() => import('@/components/WebGLStage'), {
  ssr: false,
});

export default function Home() {
  const [isLoaded, setIsLoaded] = useState(false);
  const [prefersReducedMotion, setPrefersReducedMotion] = useState(false);

  useEffect(() => {
    // Check for reduced motion preference
    const mediaQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
    setPrefersReducedMotion(mediaQuery.matches);

    // Simulate loading
    const timer = setTimeout(() => setIsLoaded(true), 100);
    return () => clearTimeout(timer);
  }, []);

  return (
    <ScrollDirector>
      {/* WebGL Canvas Layer */}
      {!prefersReducedMotion && <WebGLStage />}

      {/* Custom Cursor */}
      {!prefersReducedMotion && <CursorForceField />}

      {/* Content Layer */}
      <main className={`content-layer ${styles.main}`}>

        {/* ═══════════════════════════════════════════════════════════════
            HERO SECTION — Portal / Living Matter
            ═══════════════════════════════════════════════════════════════ */}
        <Section
          id="hero"
          className={styles.hero}
          pinned
          pinnedDuration={2}
        >
          <div className="container">
            <div className={styles.heroContent}>
              <TypographyReveal
                as="h1"
                className={styles.heroTitle}
                variant="chars"
                stagger={0.03}
                delay={0.5}
                trigger="load"
                glowOnHover
              >
                Creative
              </TypographyReveal>
              <TypographyReveal
                as="h1"
                className={`${styles.heroTitle} ${styles.heroTitleOutline}`}
                variant="chars"
                stagger={0.03}
                delay={0.8}
                trigger="load"
              >
                Developer
              </TypographyReveal>
              <TypographyReveal
                as="p"
                className={styles.heroSubtitle}
                variant="words"
                stagger={0.05}
                delay={1.2}
                trigger="load"
              >
                Crafting immersive digital experiences through
                code, motion, and visual experimentation.
              </TypographyReveal>
              <div className={styles.heroCta}>
                <a href="#work" className={styles.ctaButton} data-cursor-hover>
                  <span>Explore Work</span>
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                    <path d="M7 17L17 7M17 7H7M17 7V17"/>
                  </svg>
                </a>
              </div>
            </div>
            <div className={styles.scrollIndicator}>
              <span>Scroll</span>
              <div className={styles.scrollLine} />
            </div>
          </div>
        </Section>

        {/* ═══════════════════════════════════════════════════════════════
            ABOUT SECTION — Distorted Panels
            ═══════════════════════════════════════════════════════════════ */}
        <Section
          id="about"
          className={styles.about}
          parallax
          parallaxSpeed={0.3}
        >
          <div className="container">
            <div className={styles.aboutGrid}>
              <div className={styles.aboutContent}>
                <TypographyReveal
                  as="span"
                  className={styles.sectionLabel}
                  variant="chars"
                  stagger={0.02}
                >
                  01 — About
                </TypographyReveal>
                <TypographyReveal
                  as="h2"
                  className={styles.sectionTitle}
                  variant="words"
                  stagger={0.04}
                >
                  Where Art Meets Algorithm
                </TypographyReveal>
                <TypographyReveal
                  as="p"
                  className={styles.sectionText}
                  variant="lines"
                  stagger={0.1}
                >
                  I build experiences that blur the line between technology
                  and art. Through custom shaders, procedural generation,
                  and fluid simulations, I create digital environments
                  that feel alive and responsive.
                </TypographyReveal>
              </div>
              <div className={styles.aboutVisual}>
                <div className={styles.glassCard} data-cursor-hover>
                  <span className={styles.cardNumber}>01</span>
                  <h3>WebGL & Shaders</h3>
                  <p>Custom GLSL for unique visual effects</p>
                </div>
                <div className={styles.glassCard} data-cursor-hover>
                  <span className={styles.cardNumber}>02</span>
                  <h3>Creative Coding</h3>
                  <p>Generative art and procedural design</p>
                </div>
                <div className={styles.glassCard} data-cursor-hover>
                  <span className={styles.cardNumber}>03</span>
                  <h3>Motion Design</h3>
                  <p>Fluid animations and transitions</p>
                </div>
              </div>
            </div>
          </div>
        </Section>

        {/* ═══════════════════════════════════════════════════════════════
            WORK SECTION — Horizontal Scroll with Distortion
            ═══════════════════════════════════════════════════════════════ */}
        <Section
          id="work"
          className={styles.work}
          pinned
          pinnedDuration={3}
        >
          <div className="container">
            <div className={styles.workHeader}>
              <TypographyReveal
                as="span"
                className={styles.sectionLabel}
                variant="chars"
              >
                02 — Selected Work
              </TypographyReveal>
              <TypographyReveal
                as="h2"
                className={styles.sectionTitle}
                variant="words"
              >
                Projects
              </TypographyReveal>
            </div>
            <div className={styles.workTrack}>
              {[
                { title: 'Fluid Dreams', category: 'WebGL Experience', year: '2024' },
                { title: 'Neural Garden', category: 'Generative Art', year: '2024' },
                { title: 'Void Interface', category: 'Interactive Installation', year: '2023' },
                { title: 'Digital Matter', category: 'Creative Development', year: '2023' },
              ].map((project, i) => (
                <div key={i} className={styles.workItem} data-cursor-hover>
                  <div className={styles.workItemVisual} />
                  <div className={styles.workItemContent}>
                    <span className={styles.workItemCategory}>{project.category}</span>
                    <h3 className={styles.workItemTitle}>{project.title}</h3>
                    <span className={styles.workItemYear}>{project.year}</span>
                  </div>
                </div>
              ))}
            </div>
          </div>
        </Section>

        {/* ═══════════════════════════════════════════════════════════════
            CAPABILITIES SECTION — Sliced Panels
            ═══════════════════════════════════════════════════════════════ */}
        <Section
          id="capabilities"
          className={styles.capabilities}
        >
          <div className="container">
            <div className={styles.capGrid}>
              <div className={styles.capLeft}>
                <TypographyReveal
                  as="span"
                  className={styles.sectionLabel}
                  variant="chars"
                >
                  03 — Capabilities
                </TypographyReveal>
                <TypographyReveal
                  as="h2"
                  className={styles.sectionTitle}
                  variant="words"
                >
                  Technical Expertise
                </TypographyReveal>
              </div>
              <div className={styles.capRight}>
                {[
                  'WebGL / Three.js / GLSL',
                  'React / Next.js / TypeScript',
                  'GSAP / Framer Motion',
                  'Creative Coding / P5.js',
                  'Procedural Generation',
                  'Real-time Graphics',
                ].map((skill, i) => (
                  <div key={i} className={styles.capItem}>
                    <span className={styles.capNumber}>{String(i + 1).padStart(2, '0')}</span>
                    <span className={styles.capName}>{skill}</span>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </Section>

        {/* ═══════════════════════════════════════════════════════════════
            CONTACT SECTION — Portal Transition
            ═══════════════════════════════════════════════════════════════ */}
        <Section
          id="contact"
          className={styles.contact}
        >
          <div className="container">
            <div className={styles.contactContent}>
              <TypographyReveal
                as="span"
                className={styles.sectionLabel}
                variant="chars"
              >
                04 — Contact
              </TypographyReveal>
              <TypographyReveal
                as="h2"
                className={styles.contactTitle}
                variant="chars"
                stagger={0.02}
                glowOnHover
              >
                Let's Create Something
              </TypographyReveal>
              <TypographyReveal
                as="h2"
                className={`${styles.contactTitle} ${styles.contactTitleOutline}`}
                variant="chars"
                stagger={0.02}
              >
                Extraordinary
              </TypographyReveal>
              <div className={styles.contactLinks}>
                <a href="mailto:hello@example.com" className={styles.contactLink} data-cursor-hover>
                  hello@example.com
                </a>
                <div className={styles.contactSocials}>
                  <a href="#" className={styles.socialLink} data-cursor-hover>GitHub</a>
                  <a href="#" className={styles.socialLink} data-cursor-hover>Twitter</a>
                  <a href="#" className={styles.socialLink} data-cursor-hover>LinkedIn</a>
                </div>
              </div>
            </div>
          </div>
        </Section>

        {/* ═══════════════════════════════════════════════════════════════
            FOOTER
            ═══════════════════════════════════════════════════════════════ */}
        <footer className={styles.footer}>
          <div className="container">
            <div className={styles.footerInner}>
              <a href="../index.php" className={styles.footerBack}>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                  <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Back to Portfolio
              </a>
              <span className={styles.footerCopy}>
                WebGL Lab — {new Date().getFullYear()}
              </span>
            </div>
          </div>
        </footer>
      </main>
    </ScrollDirector>
  );
}
