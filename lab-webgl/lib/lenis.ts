// Lenis Smooth Scroll Setup
import Lenis from '@studio-freight/lenis';
import { gsap } from './gsap';

let lenisInstance: Lenis | null = null;

export function initLenis(): Lenis {
  if (lenisInstance) return lenisInstance;

  lenisInstance = new Lenis({
    duration: 1.2,
    easing: (t: number) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    orientation: 'vertical',
    gestureOrientation: 'vertical',
    smoothWheel: true,
    wheelMultiplier: 1,
    touchMultiplier: 2,
    infinite: false,
  });

  // Integrate with GSAP ScrollTrigger
  lenisInstance.on('scroll', () => {
    if (typeof window !== 'undefined' && (window as any).ScrollTrigger) {
      (window as any).ScrollTrigger.update();
    }
  });

  // Animation frame loop
  function raf(time: number) {
    lenisInstance?.raf(time);
    requestAnimationFrame(raf);
  }

  requestAnimationFrame(raf);

  // GSAP ticker integration
  gsap.ticker.add((time: number) => {
    lenisInstance?.raf(time * 1000);
  });

  gsap.ticker.lagSmoothing(0);

  return lenisInstance;
}

export function getLenis(): Lenis | null {
  return lenisInstance;
}

export function destroyLenis(): void {
  if (lenisInstance) {
    lenisInstance.destroy();
    lenisInstance = null;
  }
}

// Get scroll velocity for shader uniforms
export function getScrollVelocity(): number {
  if (!lenisInstance) return 0;
  return Math.abs(lenisInstance.velocity);
}

// Get normalized scroll progress
export function getScrollProgress(): number {
  if (!lenisInstance) return 0;
  return lenisInstance.progress;
}
