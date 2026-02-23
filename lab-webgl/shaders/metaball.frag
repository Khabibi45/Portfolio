// Metaball 2D Fragment Shader
precision highp float;

uniform float uTime;
uniform vec2 uResolution;
uniform vec2 uMouse;
uniform float uBlobCount;

varying vec2 vUv;

// Metaball function
float metaball(vec2 p, vec2 center, float radius) {
  float d = length(p - center);
  return radius / (d * d + 0.0001);
}

void main() {
  vec2 uv = vUv;
  vec2 aspect = vec2(uResolution.x / uResolution.y, 1.0);
  vec2 p = (uv - 0.5) * aspect;

  // Mouse position
  vec2 mouse = (uMouse / uResolution - 0.5) * aspect;

  float field = 0.0;

  // Animated blobs
  for (float i = 0.0; i < 6.0; i++) {
    float angle = i * 1.047 + uTime * 0.3;
    float radius = 0.2 + sin(uTime * 0.5 + i) * 0.1;
    vec2 center = vec2(
      cos(angle) * radius,
      sin(angle * 1.3) * radius
    );

    // Blob size varies
    float blobSize = 0.02 + sin(uTime + i * 2.0) * 0.01;
    field += metaball(p, center, blobSize);
  }

  // Mouse blob (larger)
  field += metaball(p, mouse, 0.04);

  // Threshold for sharp edges
  float threshold = 1.0;
  float edge = smoothstep(threshold - 0.1, threshold + 0.1, field);

  // Color gradient inside blobs
  vec3 color1 = vec3(0.4, 0.4, 1.0);
  vec3 color2 = vec3(0.8, 0.4, 1.0);
  vec3 blobColor = mix(color1, color2, field * 0.5);

  // Add glow
  float glow = smoothstep(threshold - 0.5, threshold, field) * 0.5;

  // Background
  vec3 bg = vec3(0.02, 0.02, 0.05);

  // Final color
  vec3 finalColor = mix(bg + vec3(glow * 0.2, glow * 0.2, glow * 0.4), blobColor, edge);

  // Add edge highlight
  float edgeHighlight = smoothstep(threshold - 0.15, threshold, field) *
                        smoothstep(threshold + 0.15, threshold, field);
  finalColor += vec3(edgeHighlight * 0.5);

  gl_FragColor = vec4(finalColor, 1.0);
}
