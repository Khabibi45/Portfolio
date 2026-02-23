'use client';

import { useEffect, useRef } from 'react';
import { gsap, ScrollTrigger } from '@/lib/gsap';

interface SectionProps {
  children: React.ReactNode;
  id?: string;
  className?: string;
  pinned?: boolean;
  pinnedDuration?: number;
  fadeIn?: boolean;
  parallax?: boolean;
  parallaxSpeed?: number;
}

export default function Section({
  children,
  id,
  className = '',
  pinned = false,
  pinnedDuration = 1,
  fadeIn = true,
  parallax = false,
  parallaxSpeed = 0.5,
}: SectionProps) {
  const sectionRef = useRef<HTMLElement>(null);
  const contentRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    if (!sectionRef.current) return;

    const prefersReducedMotion = window.matchMedia(
      '(prefers-reduced-motion: reduce)'
    ).matches;

    if (prefersReducedMotion) {
      if (sectionRef.current) {
        sectionRef.current.style.opacity = '1';
      }
      return;
    }

    const section = sectionRef.current;
    const content = contentRef.current;

    // Fade in animation
    if (fadeIn && content) {
      gsap.set(content, { opacity: 0, y: 50 });

      ScrollTrigger.create({
        trigger: section,
        start: 'top 70%',
        onEnter: () => {
          gsap.to(content, {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: 'power3.out',
          });
        },
      });
    }

    // Pinned section
    if (pinned) {
      const height = `${pinnedDuration * 100}vh`;
      section.style.height = height;

      ScrollTrigger.create({
        trigger: section,
        start: 'top top',
        end: `+=${pinnedDuration * 100}%`,
        pin: content,
        pinSpacing: false,
        scrub: 1,
      });
    }

    // Parallax effect
    if (parallax && content) {
      gsap.to(content, {
        y: () => window.innerHeight * parallaxSpeed * -1,
        ease: 'none',
        scrollTrigger: {
          trigger: section,
          start: 'top bottom',
          end: 'bottom top',
          scrub: true,
        },
      });
    }

    return () => {
      ScrollTrigger.getAll().forEach(st => {
        if (st.trigger === section) st.kill();
      });
    };
  }, [pinned, pinnedDuration, fadeIn, parallax, parallaxSpeed]);

  return (
    <section
      ref={sectionRef}
      id={id}
      className={`section ${pinned ? 'section--pinned' : ''} ${className}`}
      style={pinned ? { height: `${pinnedDuration * 100}vh` } : undefined}
    >
      <div ref={contentRef} className="section__content">
        {children}
      </div>
    </section>
  );
}
