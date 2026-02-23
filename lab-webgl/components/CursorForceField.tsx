'use client';

import { useEffect, useRef, useCallback } from 'react';
import { gsap } from '@/lib/gsap';

interface CursorForceFieldProps {
  className?: string;
}

export default function CursorForceField({ className }: CursorForceFieldProps) {
  const cursorRef = useRef<HTMLDivElement>(null);
  const cursorInnerRef = useRef<HTMLDivElement>(null);
  const positionRef = useRef({ x: 0, y: 0 });
  const targetRef = useRef({ x: 0, y: 0 });
  const velocityRef = useRef({ x: 0, y: 0 });
  const isHoveringRef = useRef(false);
  const rafIdRef = useRef<number>(0);

  // Smooth cursor following
  const updateCursor = useCallback(() => {
    const ease = 0.15;

    // Calculate velocity
    velocityRef.current.x = targetRef.current.x - positionRef.current.x;
    velocityRef.current.y = targetRef.current.y - positionRef.current.y;

    // Smooth lerp
    positionRef.current.x += velocityRef.current.x * ease;
    positionRef.current.y += velocityRef.current.y * ease;

    // Apply transform
    if (cursorRef.current) {
      cursorRef.current.style.transform = `translate(${positionRef.current.x}px, ${positionRef.current.y}px)`;
    }

    // Stretch based on velocity for organic feel
    const speed = Math.sqrt(
      velocityRef.current.x ** 2 + velocityRef.current.y ** 2
    );
    const stretch = Math.min(speed * 0.02, 0.3);
    const angle = Math.atan2(velocityRef.current.y, velocityRef.current.x);

    if (cursorInnerRef.current && speed > 0.5) {
      cursorInnerRef.current.style.transform = `
        rotate(${angle}rad)
        scaleX(${1 + stretch})
        scaleY(${1 - stretch * 0.5})
      `;
    }

    rafIdRef.current = requestAnimationFrame(updateCursor);
  }, []);

  // Handle mouse move
  const handleMouseMove = useCallback((e: MouseEvent) => {
    targetRef.current.x = e.clientX;
    targetRef.current.y = e.clientY;

    // Dispatch custom event for WebGL
    window.dispatchEvent(new CustomEvent('cursorMove', {
      detail: {
        x: e.clientX,
        y: e.clientY,
        vx: velocityRef.current.x,
        vy: velocityRef.current.y,
      }
    }));
  }, []);

  // Handle hover states
  const handleMouseEnter = useCallback((e: Event) => {
    const target = e.target as HTMLElement | null;
    if (!target || typeof target.matches !== 'function') return;

    try {
      if (target.matches('a, button, [data-cursor-hover]')) {
        isHoveringRef.current = true;
        gsap.to(cursorRef.current, {
          scale: 2,
          duration: 0.3,
          ease: 'power2.out',
        });

        // Add magnetic effect
        const rect = target.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;

        gsap.to(targetRef.current, {
          x: centerX,
          y: centerY,
          duration: 0.3,
          ease: 'power2.out',
        });
      }
    } catch (err) {
      // Silently ignore matches errors
    }
  }, []);

  const handleMouseLeave = useCallback((e: Event) => {
    const target = e.target as HTMLElement | null;
    if (!target || typeof target.matches !== 'function') return;

    try {
      if (target.matches('a, button, [data-cursor-hover]')) {
        isHoveringRef.current = false;
        gsap.to(cursorRef.current, {
          scale: 1,
          duration: 0.3,
          ease: 'power2.out',
        });
      }
    } catch (err) {
      // Silently ignore matches errors
    }
  }, []);

  // Handle click ripple
  const handleClick = useCallback(() => {
    if (!cursorRef.current) return;

    gsap.to(cursorRef.current, {
      scale: 0.8,
      duration: 0.1,
      yoyo: true,
      repeat: 1,
      ease: 'power2.out',
    });

    // Dispatch click event for WebGL
    window.dispatchEvent(new CustomEvent('cursorClick', {
      detail: {
        x: positionRef.current.x,
        y: positionRef.current.y,
      }
    }));
  }, []);

  useEffect(() => {
    // Check for touch device
    const isTouchDevice = 'ontouchstart' in window;
    if (isTouchDevice) return;

    // Check for reduced motion
    const prefersReducedMotion = window.matchMedia(
      '(prefers-reduced-motion: reduce)'
    ).matches;
    if (prefersReducedMotion) return;

    // Start animation loop
    rafIdRef.current = requestAnimationFrame(updateCursor);

    // Event listeners
    window.addEventListener('mousemove', handleMouseMove);
    document.addEventListener('mouseenter', handleMouseEnter, true);
    document.addEventListener('mouseleave', handleMouseLeave, true);
    window.addEventListener('click', handleClick);

    return () => {
      cancelAnimationFrame(rafIdRef.current);
      window.removeEventListener('mousemove', handleMouseMove);
      document.removeEventListener('mouseenter', handleMouseEnter, true);
      document.removeEventListener('mouseleave', handleMouseLeave, true);
      window.removeEventListener('click', handleClick);
    };
  }, [updateCursor, handleMouseMove, handleMouseEnter, handleMouseLeave, handleClick]);

  return (
    <div
      ref={cursorRef}
      className={`cursor ${className || ''}`}
      style={{
        position: 'fixed',
        top: -10,
        left: -10,
        pointerEvents: 'none',
        zIndex: 9999,
      }}
    >
      <div
        ref={cursorInnerRef}
        style={{
          width: 20,
          height: 20,
          border: '1px solid var(--color-accent)',
          borderRadius: '50%',
          mixBlendMode: 'difference',
        }}
      />
    </div>
  );
}
