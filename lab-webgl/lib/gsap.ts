// GSAP Plugin Registration
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/dist/ScrollTrigger';
import { Flip } from 'gsap/dist/Flip';

// Only register on client side
if (typeof window !== 'undefined') {
  gsap.registerPlugin(ScrollTrigger, Flip);

  // Default settings for smooth animations
  gsap.defaults({
    ease: 'power3.out',
    duration: 1,
  });

  // ScrollTrigger defaults
  ScrollTrigger.defaults({
    markers: false,
  });
}

export { gsap, ScrollTrigger, Flip };
