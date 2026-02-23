'use client';

import { useEffect, useRef, useCallback, createContext, useContext } from 'react';
import { gsap, ScrollTrigger } from '@/lib/gsap';
import { initLenis, getLenis, destroyLenis, getScrollVelocity } from '@/lib/lenis';

interface ScrollState {
  progress: number;
  velocity: number;
  direction: 'up' | 'down' | 'none';
  currentSection: number;
}

interface ScrollContextType {
  scrollState: ScrollState;
  registerSection: (element: HTMLElement, index: number) => void;
}

const ScrollContext = createContext<ScrollContextType | null>(null);

export function useScroll() {
  const context = useContext(ScrollContext);
  if (!context) {
    throw new Error('useScroll must be used within ScrollDirector');
  }
  return context;
}

interface ScrollDirectorProps {
  children: React.ReactNode;
}

export default function ScrollDirector({ children }: ScrollDirectorProps) {
  const scrollStateRef = useRef<ScrollState>({
    progress: 0,
    velocity: 0,
    direction: 'none',
    currentSection: 0,
  });
  const sectionsRef = useRef<Map<number, HTMLElement>>(new Map());
  const lastScrollRef = useRef(0);

  // Initialize Lenis and ScrollTrigger
  useEffect(() => {
    const prefersReducedMotion = window.matchMedia(
      '(prefers-reduced-motion: reduce)'
    ).matches;

    if (!prefersReducedMotion) {
      initLenis();
    }

    // Refresh ScrollTrigger on load
    ScrollTrigger.refresh();

    // Update scroll state on scroll
    const updateScrollState = () => {
      const lenis = getLenis();
      if (!lenis) return;

      const currentScroll = lenis.scroll;
      const velocity = getScrollVelocity();

      scrollStateRef.current = {
        progress: lenis.progress,
        velocity: Math.min(velocity / 100, 1), // Normalize
        direction: currentScroll > lastScrollRef.current ? 'down' :
                   currentScroll < lastScrollRef.current ? 'up' : 'none',
        currentSection: scrollStateRef.current.currentSection,
      };

      lastScrollRef.current = currentScroll;

      // Dispatch custom event for components to listen
      window.dispatchEvent(new CustomEvent('scrollUpdate', {
        detail: scrollStateRef.current
      }));
    };

    // RAF loop for smooth updates
    let rafId: number;
    const raf = () => {
      updateScrollState();
      rafId = requestAnimationFrame(raf);
    };
    rafId = requestAnimationFrame(raf);

    return () => {
      cancelAnimationFrame(rafId);
      destroyLenis();
      ScrollTrigger.getAll().forEach(t => t.kill());
    };
  }, []);

  // Register section for tracking
  const registerSection = useCallback((element: HTMLElement, index: number) => {
    sectionsRef.current.set(index, element);

    // Create ScrollTrigger for this section
    ScrollTrigger.create({
      trigger: element,
      start: 'top center',
      end: 'bottom center',
      onEnter: () => {
        scrollStateRef.current.currentSection = index;
      },
      onEnterBack: () => {
        scrollStateRef.current.currentSection = index;
      },
    });
  }, []);

  const contextValue: ScrollContextType = {
    scrollState: scrollStateRef.current,
    registerSection,
  };

  return (
    <ScrollContext.Provider value={contextValue}>
      {children}
    </ScrollContext.Provider>
  );
}
