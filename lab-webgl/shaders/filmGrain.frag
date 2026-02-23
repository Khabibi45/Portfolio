// Film Grain + Vignette Fragment Shader
precision highp float;

uniform sampler2D tDiffuse;
uniform float uTime;
uniform float uGrainIntensity;
uniform float uGrainSize;
uniform float uVignetteIntensity;
uniform float uVignetteRoundness;

varying vec2 vUv;

// Hash function for noise
float hash(vec2 p) {
  vec3 p3 = fract(vec3(p.xyx) * 0.1031);
  p3 += dot(p3, p3.yzx + 33.33);
  return fract((p3.x + p3.y) * p3.z);
}

// Film grain noise
float grain(vec2 uv, float time) {
  vec2 noise = vec2(
    hash(uv + vec2(time * 0.1, 0.0)),
    hash(uv + vec2(0.0, time * 0.1))
  );
  return hash(uv + noise) * 2.0 - 1.0;
}

void main() {
  vec2 uv = vUv;
  vec4 color = texture2D(tDiffuse, uv);

  // Film grain
  float grainNoise = grain(uv * uGrainSize, uTime);
  color.rgb += grainNoise * uGrainIntensity;

  // Vignette
  vec2 vignetteUv = uv * (1.0 - uv.yx);
  float vignette = vignetteUv.x * vignetteUv.y * 15.0;
  vignette = pow(vignette, uVignetteRoundness);
  color.rgb *= mix(1.0 - uVignetteIntensity, 1.0, vignette);

  // Subtle color grading (lift shadows slightly blue, highlights warm)
  color.rgb = mix(color.rgb, color.rgb * vec3(0.95, 0.95, 1.05), 1.0 - vignette);

  gl_FragColor = color;
}
