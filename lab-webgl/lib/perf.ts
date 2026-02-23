// Performance Detection & Quality Adaptation

export interface QualitySettings {
  pixelRatio: number;
  fluidResolution: number;
  bloomEnabled: boolean;
  chromaticEnabled: boolean;
  particleCount: number;
  shadowsEnabled: boolean;
}

export type QualityLevel = 'low' | 'medium' | 'high' | 'ultra';

// Detect device capabilities
export function detectCapabilities(): {
  isMobile: boolean;
  isLowEnd: boolean;
  prefersReducedMotion: boolean;
  devicePixelRatio: number;
  gpuTier: 'low' | 'mid' | 'high';
} {
  if (typeof window === 'undefined') {
    return {
      isMobile: false,
      isLowEnd: false,
      prefersReducedMotion: false,
      devicePixelRatio: 1,
      gpuTier: 'mid',
    };
  }

  const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

  const prefersReducedMotion = window.matchMedia(
    '(prefers-reduced-motion: reduce)'
  ).matches;

  const devicePixelRatio = Math.min(window.devicePixelRatio || 1, 2);

  // Simple GPU detection via WebGL
  let gpuTier: 'low' | 'mid' | 'high' = 'mid';
  try {
    const canvas = document.createElement('canvas');
    const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
    if (gl) {
      const debugInfo = (gl as WebGLRenderingContext).getExtension('WEBGL_debug_renderer_info');
      if (debugInfo) {
        const renderer = (gl as WebGLRenderingContext).getParameter(debugInfo.UNMASKED_RENDERER_WEBGL);
        const rendererLower = renderer.toLowerCase();

        // Check for known high-end GPUs
        if (
          rendererLower.includes('nvidia') ||
          rendererLower.includes('radeon rx') ||
          rendererLower.includes('geforce rtx') ||
          rendererLower.includes('apple m')
        ) {
          gpuTier = 'high';
        }
        // Check for known low-end
        else if (
          rendererLower.includes('intel hd') ||
          rendererLower.includes('intel uhd') ||
          rendererLower.includes('mali') ||
          rendererLower.includes('adreno 5')
        ) {
          gpuTier = 'low';
        }
      }
    }
  } catch (e) {
    console.warn('GPU detection failed:', e);
  }

  const isLowEnd = isMobile || gpuTier === 'low';

  return {
    isMobile,
    isLowEnd,
    prefersReducedMotion,
    devicePixelRatio,
    gpuTier,
  };
}

// Get quality settings based on capabilities
export function getQualitySettings(level?: QualityLevel): QualitySettings {
  const caps = detectCapabilities();

  // Force low quality if reduced motion is preferred
  if (caps.prefersReducedMotion) {
    return {
      pixelRatio: 1,
      fluidResolution: 64,
      bloomEnabled: false,
      chromaticEnabled: false,
      particleCount: 0,
      shadowsEnabled: false,
    };
  }

  // Auto-detect level if not provided
  if (!level) {
    if (caps.isMobile) {
      level = 'low';
    } else if (caps.gpuTier === 'high') {
      level = 'ultra';
    } else if (caps.gpuTier === 'mid') {
      level = 'high';
    } else {
      level = 'medium';
    }
  }

  const settings: Record<QualityLevel, QualitySettings> = {
    low: {
      pixelRatio: 1,
      fluidResolution: 64,
      bloomEnabled: false,
      chromaticEnabled: false,
      particleCount: 500,
      shadowsEnabled: false,
    },
    medium: {
      pixelRatio: Math.min(caps.devicePixelRatio, 1.5),
      fluidResolution: 128,
      bloomEnabled: false,
      chromaticEnabled: true,
      particleCount: 1000,
      shadowsEnabled: false,
    },
    high: {
      pixelRatio: Math.min(caps.devicePixelRatio, 2),
      fluidResolution: 256,
      bloomEnabled: true,
      chromaticEnabled: true,
      particleCount: 2000,
      shadowsEnabled: true,
    },
    ultra: {
      pixelRatio: caps.devicePixelRatio,
      fluidResolution: 512,
      bloomEnabled: true,
      chromaticEnabled: true,
      particleCount: 5000,
      shadowsEnabled: true,
    },
  };

  return settings[level];
}

// FPS Monitor for adaptive quality
export class FPSMonitor {
  private samples: number[] = [];
  private lastTime: number = 0;
  private maxSamples: number = 60;
  private onLowFPS?: () => void;
  private lowFPSThreshold: number = 30;
  private lowFPSCount: number = 0;

  constructor(options?: { onLowFPS?: () => void; threshold?: number }) {
    this.onLowFPS = options?.onLowFPS;
    this.lowFPSThreshold = options?.threshold || 30;
  }

  update(time: number): void {
    if (this.lastTime === 0) {
      this.lastTime = time;
      return;
    }

    const delta = time - this.lastTime;
    const fps = 1000 / delta;

    this.samples.push(fps);
    if (this.samples.length > this.maxSamples) {
      this.samples.shift();
    }

    this.lastTime = time;

    // Check for consistently low FPS
    if (fps < this.lowFPSThreshold) {
      this.lowFPSCount++;
      if (this.lowFPSCount > 30 && this.onLowFPS) {
        this.onLowFPS();
        this.lowFPSCount = 0;
      }
    } else {
      this.lowFPSCount = Math.max(0, this.lowFPSCount - 1);
    }
  }

  getAverageFPS(): number {
    if (this.samples.length === 0) return 60;
    return this.samples.reduce((a, b) => a + b, 0) / this.samples.length;
  }
}
