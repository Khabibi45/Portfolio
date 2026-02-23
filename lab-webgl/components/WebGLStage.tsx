'use client';

import { useEffect, useRef, useCallback } from 'react';
import * as THREE from 'three';
import { EffectComposer } from 'postprocessing';
import { getQualitySettings, FPSMonitor, QualitySettings } from '@/lib/perf';
import { getScrollVelocity } from '@/lib/lenis';

// Shader imports
import baseVert from '@/shaders/base.vert';
import distortFrag from '@/shaders/distort.frag';
import fluidFrag from '@/shaders/fluid.frag';
import filmGrainFrag from '@/shaders/filmGrain.frag';
import metaballFrag from '@/shaders/metaball.frag';

interface WebGLStageProps {
  className?: string;
}

export default function WebGLStage({ className }: WebGLStageProps) {
  const containerRef = useRef<HTMLDivElement>(null);
  const rendererRef = useRef<THREE.WebGLRenderer | null>(null);
  const sceneRef = useRef<THREE.Scene | null>(null);
  const cameraRef = useRef<THREE.OrthographicCamera | null>(null);
  const composerRef = useRef<EffectComposer | null>(null);
  const qualityRef = useRef<QualitySettings>(getQualitySettings());
  const mouseRef = useRef({ x: 0, y: 0, vx: 0, vy: 0 });
  const prevMouseRef = useRef({ x: 0, y: 0 });
  const timeRef = useRef(0);
  const frameIdRef = useRef<number>(0);

  // Fluid simulation FBOs
  const fluidFBOsRef = useRef<{
    read: THREE.WebGLRenderTarget;
    write: THREE.WebGLRenderTarget;
  } | null>(null);

  // Materials
  const fluidMaterialRef = useRef<THREE.ShaderMaterial | null>(null);
  const mainMaterialRef = useRef<THREE.ShaderMaterial | null>(null);

  // FPS monitor
  const fpsMonitorRef = useRef<FPSMonitor | null>(null);

  // Initialize Three.js scene
  const initScene = useCallback(() => {
    if (!containerRef.current) return;

    const quality = qualityRef.current;
    const container = containerRef.current;
    const width = container.clientWidth;
    const height = container.clientHeight;

    // Renderer
    const renderer = new THREE.WebGLRenderer({
      antialias: false,
      alpha: true,
      powerPreference: 'high-performance',
    });
    renderer.setSize(width, height);
    renderer.setPixelRatio(quality.pixelRatio);
    renderer.outputColorSpace = THREE.SRGBColorSpace;
    container.appendChild(renderer.domElement);
    rendererRef.current = renderer;

    // Scene
    const scene = new THREE.Scene();
    sceneRef.current = scene;

    // Orthographic camera for 2D effects
    const camera = new THREE.OrthographicCamera(-1, 1, 1, -1, 0, 1);
    cameraRef.current = camera;

    // Create fluid simulation FBOs
    const fluidRes = quality.fluidResolution;
    const fluidFBOOptions: THREE.RenderTargetOptions = {
      minFilter: THREE.LinearFilter,
      magFilter: THREE.LinearFilter,
      format: THREE.RGBAFormat,
      type: THREE.FloatType,
    };

    fluidFBOsRef.current = {
      read: new THREE.WebGLRenderTarget(fluidRes, fluidRes, fluidFBOOptions),
      write: new THREE.WebGLRenderTarget(fluidRes, fluidRes, fluidFBOOptions),
    };

    // Fluid material
    const fluidMaterial = new THREE.ShaderMaterial({
      vertexShader: baseVert,
      fragmentShader: fluidFrag,
      uniforms: {
        uPrevState: { value: null },
        uResolution: { value: new THREE.Vector2(fluidRes, fluidRes) },
        uMouse: { value: new THREE.Vector2(0, 0) },
        uMouseVelocity: { value: new THREE.Vector2(0, 0) },
        uTime: { value: 0 },
        uDissipation: { value: 0.98 },
        uRadius: { value: 0.15 },
        uStrength: { value: 0.3 },
        uPass: { value: 0 },
      },
    });
    fluidMaterialRef.current = fluidMaterial;

    // Main display material with metaballs + distortion
    const mainMaterial = new THREE.ShaderMaterial({
      vertexShader: baseVert,
      fragmentShader: metaballFrag,
      uniforms: {
        uTime: { value: 0 },
        uResolution: { value: new THREE.Vector2(width, height) },
        uMouse: { value: new THREE.Vector2(0, 0) },
        uBlobCount: { value: 6 },
      },
    });
    mainMaterialRef.current = mainMaterial;

    // Fullscreen quad
    const geometry = new THREE.PlaneGeometry(2, 2);
    const mesh = new THREE.Mesh(geometry, mainMaterial);
    scene.add(mesh);

    // FPS monitor for adaptive quality
    fpsMonitorRef.current = new FPSMonitor({
      threshold: 30,
      onLowFPS: () => {
        console.log('Low FPS detected, reducing quality');
        // Could trigger quality reduction here
      },
    });

  }, []);

  // Swap fluid FBOs
  const swapFluidFBOs = useCallback(() => {
    if (!fluidFBOsRef.current) return;
    const temp = fluidFBOsRef.current.read;
    fluidFBOsRef.current.read = fluidFBOsRef.current.write;
    fluidFBOsRef.current.write = temp;
  }, []);

  // Update fluid simulation
  const updateFluid = useCallback(() => {
    if (!rendererRef.current || !fluidFBOsRef.current || !fluidMaterialRef.current) return;

    const renderer = rendererRef.current;
    const fluidMaterial = fluidMaterialRef.current;
    const { read, write } = fluidFBOsRef.current;

    // Fluid quad (reuse geometry)
    const fluidQuad = new THREE.Mesh(
      new THREE.PlaneGeometry(2, 2),
      fluidMaterial
    );
    const fluidScene = new THREE.Scene();
    fluidScene.add(fluidQuad);

    const fluidCamera = new THREE.OrthographicCamera(-1, 1, 1, -1, 0, 1);

    // Pass 1: Advection
    fluidMaterial.uniforms.uPrevState.value = read.texture;
    fluidMaterial.uniforms.uPass.value = 0;
    renderer.setRenderTarget(write);
    renderer.render(fluidScene, fluidCamera);
    swapFluidFBOs();

    // Pass 2: Add force
    fluidMaterial.uniforms.uPrevState.value = fluidFBOsRef.current!.read.texture;
    fluidMaterial.uniforms.uPass.value = 1;
    fluidMaterial.uniforms.uMouse.value.set(mouseRef.current.x, mouseRef.current.y);
    fluidMaterial.uniforms.uMouseVelocity.value.set(mouseRef.current.vx, mouseRef.current.vy);
    renderer.setRenderTarget(fluidFBOsRef.current!.write);
    renderer.render(fluidScene, fluidCamera);
    swapFluidFBOs();

    // Cleanup
    fluidQuad.geometry.dispose();
    renderer.setRenderTarget(null);

  }, [swapFluidFBOs]);

  // Animation loop
  const animate = useCallback((time: number) => {
    frameIdRef.current = requestAnimationFrame(animate);

    const delta = time - timeRef.current;
    timeRef.current = time;

    // FPS monitoring
    fpsMonitorRef.current?.update(time);

    // Update mouse velocity
    mouseRef.current.vx = (mouseRef.current.x - prevMouseRef.current.x) * 0.1;
    mouseRef.current.vy = (mouseRef.current.y - prevMouseRef.current.y) * 0.1;
    prevMouseRef.current.x = mouseRef.current.x;
    prevMouseRef.current.y = mouseRef.current.y;

    // Update fluid simulation
    updateFluid();

    // Update main material uniforms
    if (mainMaterialRef.current) {
      mainMaterialRef.current.uniforms.uTime.value = time * 0.001;
      mainMaterialRef.current.uniforms.uMouse.value.set(
        mouseRef.current.x,
        mouseRef.current.y
      );
    }

    // Update fluid material time
    if (fluidMaterialRef.current) {
      fluidMaterialRef.current.uniforms.uTime.value = time * 0.001;
    }

    // Render
    if (rendererRef.current && sceneRef.current && cameraRef.current) {
      rendererRef.current.render(sceneRef.current, cameraRef.current);
    }

  }, [updateFluid]);

  // Handle mouse move
  const handleMouseMove = useCallback((e: MouseEvent) => {
    if (!containerRef.current) return;
    const rect = containerRef.current.getBoundingClientRect();
    mouseRef.current.x = e.clientX - rect.left;
    mouseRef.current.y = rect.height - (e.clientY - rect.top); // Flip Y for WebGL
  }, []);

  // Handle resize
  const handleResize = useCallback(() => {
    if (!containerRef.current || !rendererRef.current || !mainMaterialRef.current) return;

    const width = containerRef.current.clientWidth;
    const height = containerRef.current.clientHeight;

    rendererRef.current.setSize(width, height);
    mainMaterialRef.current.uniforms.uResolution.value.set(width, height);

  }, []);

  // Initialize
  useEffect(() => {
    // Check for reduced motion preference
    const prefersReducedMotion = window.matchMedia(
      '(prefers-reduced-motion: reduce)'
    ).matches;

    if (prefersReducedMotion) {
      console.log('Reduced motion preferred, skipping WebGL');
      return;
    }

    initScene();
    frameIdRef.current = requestAnimationFrame(animate);

    window.addEventListener('mousemove', handleMouseMove);
    window.addEventListener('resize', handleResize);

    return () => {
      cancelAnimationFrame(frameIdRef.current);
      window.removeEventListener('mousemove', handleMouseMove);
      window.removeEventListener('resize', handleResize);

      // Cleanup
      if (rendererRef.current) {
        rendererRef.current.dispose();
        containerRef.current?.removeChild(rendererRef.current.domElement);
      }
      fluidFBOsRef.current?.read.dispose();
      fluidFBOsRef.current?.write.dispose();
      fluidMaterialRef.current?.dispose();
      mainMaterialRef.current?.dispose();
    };
  }, [initScene, animate, handleMouseMove, handleResize]);

  return (
    <div
      ref={containerRef}
      className={`webgl-container ${className || ''}`}
      aria-hidden="true"
    />
  );
}
