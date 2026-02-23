'use client';

import { useEffect, useRef } from 'react';
import { gsap, ScrollTrigger } from '@/lib/gsap';
import SplitType from 'split-type';

interface TypographyRevealProps {
  children: React.ReactNode;
  as?: 'h1' | 'h2' | 'h3' | 'h4' | 'p' | 'span';
  className?: string;
  variant?: 'chars' | 'words' | 'lines';
  stagger?: number;
  delay?: number;
  duration?: number;
  trigger?: 'scroll' | 'load';
  scrub?: boolean;
  glowOnHover?: boolean;
}

export default function TypographyReveal({
  children,
  as: Tag = 'h1',
  className = '',
  variant = 'chars',
  stagger = 0.02,
  delay = 0,
  duration = 0.8,
  trigger = 'scroll',
  scrub = false,
  glowOnHover = false,
}: TypographyRevealProps) {
  const containerRef = useRef<HTMLElement>(null);
  const splitRef = useRef<SplitType | null>(null);
  const timelineRef = useRef<gsap.core.Timeline | null>(null);

  useEffect(() => {
    if (!containerRef.current) return;

    // Check for reduced motion
    const prefersReducedMotion = window.matchMedia(
      '(prefers-reduced-motion: reduce)'
    ).matches;

    if (prefersReducedMotion) {
      // Just show the text without animation
      containerRef.current.style.opacity = '1';
      return;
    }

    // Split text
    splitRef.current = new SplitType(containerRef.current, {
      types: variant === 'chars' ? 'chars' :
             variant === 'words' ? 'words' : 'lines',
      tagName: 'span',
    });

    const elements = variant === 'chars' ? splitRef.current.chars :
                     variant === 'words' ? splitRef.current.words :
                     splitRef.current.lines;

    if (!elements) return;

    // Set initial state
    gsap.set(elements, {
      opacity: 0,
      y: variant === 'lines' ? 40 : 20,
      rotateX: variant === 'chars' ? 90 : 0,
    });

    // Create animation timeline
    const tl = gsap.timeline({
      paused: trigger === 'scroll',
      delay,
    });

    tl.to(elements, {
      opacity: 1,
      y: 0,
      rotateX: 0,
      duration,
      stagger: {
        each: stagger,
        from: 'start',
      },
      ease: 'power3.out',
    });

    timelineRef.current = tl;

    // Trigger based on scroll or load
    if (trigger === 'scroll') {
      ScrollTrigger.create({
        trigger: containerRef.current,
        start: 'top 80%',
        end: scrub ? 'bottom 20%' : undefined,
        scrub: scrub ? 1 : false,
        onEnter: () => {
          if (!scrub) tl.play();
        },
        animation: scrub ? tl : undefined,
      });
    } else {
      tl.play();
    }

    // Hover glow effect
    if (glowOnHover && elements) {
      elements.forEach((el) => {
        el.addEventListener('mouseenter', () => {
          gsap.to(el, {
            textShadow: `
              0 0 10px var(--color-accent-glow),
              0 0 20px var(--color-accent-glow),
              0 0 40px var(--color-accent-glow)
            `,
            color: 'var(--color-accent-light)',
            duration: 0.2,
          });
        });

        el.addEventListener('mouseleave', () => {
          gsap.to(el, {
            textShadow: 'none',
            color: 'inherit',
            duration: 0.3,
          });
        });
      });
    }

    return () => {
      timelineRef.current?.kill();
      splitRef.current?.revert();
      ScrollTrigger.getAll().forEach(st => {
        if (st.trigger === containerRef.current) st.kill();
      });
    };
  }, [variant, stagger, delay, duration, trigger, scrub, glowOnHover]);

  return (
    <Tag
      ref={containerRef as any}
      className={`typography-reveal ${className}`}
      style={{
        perspective: '1000px',
        opacity: 0,
      }}
    >
      {children}
    </Tag>
  );
}
