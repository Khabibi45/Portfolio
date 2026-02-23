// Section Slicing Effect Fragment Shader
precision highp float;

uniform sampler2D uTexture;
uniform float uTime;
uniform float uVelocity;
uniform float uSlices;
uniform int uDirection; // 0 = horizontal, 1 = vertical

varying vec2 vUv;

// Noise for organic offset
float hash(float n) {
  return fract(sin(n) * 43758.5453123);
}

void main() {
  vec2 uv = vUv;

  // Determine slice
  float sliceSize = 1.0 / uSlices;
  float sliceIndex;

  if (uDirection == 0) {
    // Horizontal slices
    sliceIndex = floor(uv.y / sliceSize);

    // Calculate offset for this slice
    float offset = hash(sliceIndex) * 2.0 - 1.0;
    offset *= uVelocity * 0.05;
    offset *= sin(uTime * 2.0 + sliceIndex * 0.5) * 0.5 + 0.5;

    uv.x += offset;
  } else {
    // Vertical slices
    sliceIndex = floor(uv.x / sliceSize);

    float offset = hash(sliceIndex + 100.0) * 2.0 - 1.0;
    offset *= uVelocity * 0.05;
    offset *= sin(uTime * 2.0 + sliceIndex * 0.5) * 0.5 + 0.5;

    uv.y += offset;
  }

  // Add subtle wave to slice edges
  float edge = mod(uDirection == 0 ? vUv.y : vUv.x, sliceSize) / sliceSize;
  float edgeWave = sin(edge * 3.14159) * 0.002 * uVelocity;

  if (uDirection == 0) {
    uv.x += edgeWave;
  } else {
    uv.y += edgeWave;
  }

  // Sample with edge feathering
  vec4 color = texture2D(uTexture, clamp(uv, 0.0, 1.0));

  // Add subtle line at slice boundaries
  float line = smoothstep(0.0, 0.02, edge) * smoothstep(1.0, 0.98, edge);
  color.rgb *= 0.95 + line * 0.05;

  gl_FragColor = color;
}
