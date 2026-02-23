// Portal Transition Fragment Shader
precision highp float;

uniform sampler2D tDiffuse;
uniform sampler2D uNextScene;
uniform float uProgress;
uniform vec2 uCenter;
uniform vec2 uResolution;
uniform float uTime;

varying vec2 vUv;

// Simplex noise for organic edge
vec3 mod289(vec3 x) { return x - floor(x * (1.0 / 289.0)) * 289.0; }
vec2 mod289(vec2 x) { return x - floor(x * (1.0 / 289.0)) * 289.0; }
vec3 permute(vec3 x) { return mod289(((x*34.0)+1.0)*x); }

float snoise(vec2 v) {
  const vec4 C = vec4(0.211324865405187, 0.366025403784439, -0.577350269189626, 0.024390243902439);
  vec2 i = floor(v + dot(v, C.yy));
  vec2 x0 = v - i + dot(i, C.xx);
  vec2 i1 = (x0.x > x0.y) ? vec2(1.0, 0.0) : vec2(0.0, 1.0);
  vec4 x12 = x0.xyxy + C.xxzz;
  x12.xy -= i1;
  i = mod289(i);
  vec3 p = permute(permute(i.y + vec3(0.0, i1.y, 1.0)) + i.x + vec3(0.0, i1.x, 1.0));
  vec3 m = max(0.5 - vec3(dot(x0, x0), dot(x12.xy, x12.xy), dot(x12.zw, x12.zw)), 0.0);
  m = m*m; m = m*m;
  vec3 x = 2.0 * fract(p * C.www) - 1.0;
  vec3 h = abs(x) - 0.5;
  vec3 ox = floor(x + 0.5);
  vec3 a0 = x - ox;
  m *= 1.79284291400159 - 0.85373472095314 * (a0*a0 + h*h);
  vec3 g;
  g.x = a0.x * x0.x + h.x * x0.y;
  g.yz = a0.yz * x12.xz + h.yz * x12.yw;
  return 130.0 * dot(m, g);
}

void main() {
  vec2 uv = vUv;
  vec2 center = uCenter;

  // Aspect ratio correction
  vec2 aspect = vec2(uResolution.x / uResolution.y, 1.0);
  vec2 uvCorrected = (uv - 0.5) * aspect + 0.5;
  vec2 centerCorrected = (center - 0.5) * aspect + 0.5;

  // Distance from center
  float dist = distance(uvCorrected, centerCorrected);

  // Animated noise for organic edge
  float noise = snoise((uv - center) * 5.0 + uTime * 0.5) * 0.1;
  noise += snoise((uv - center) * 10.0 - uTime * 0.3) * 0.05;

  // Portal radius with easing
  float easedProgress = uProgress * uProgress * (3.0 - 2.0 * uProgress); // smoothstep
  float radius = easedProgress * 2.0 + noise * easedProgress;

  // Portal mask
  float portalMask = smoothstep(radius, radius - 0.1, dist);

  // Edge glow
  float edge = smoothstep(radius - 0.15, radius - 0.05, dist) * smoothstep(radius + 0.05, radius - 0.05, dist);
  vec3 edgeColor = vec3(0.4, 0.4, 1.0) * edge * 2.0;

  // RGB shift on edge
  float rgbShift = edge * 0.02;
  vec4 currentScene = texture2D(tDiffuse, uv);
  vec4 nextScene = texture2D(uNextScene, uv);

  // Apply RGB shift to transition edge
  if (edge > 0.01) {
    vec2 dir = normalize(uv - center);
    currentScene.r = texture2D(tDiffuse, uv + dir * rgbShift).r;
    currentScene.b = texture2D(tDiffuse, uv - dir * rgbShift).b;
  }

  // Blend scenes
  vec4 color = mix(currentScene, nextScene, portalMask);

  // Add edge glow
  color.rgb += edgeColor;

  // Bloom on portal edge
  color.rgb += edge * vec3(0.2, 0.2, 0.4);

  gl_FragColor = color;
}
