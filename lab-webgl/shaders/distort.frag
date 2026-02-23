// Distortion Fragment Shader
precision highp float;

uniform sampler2D uTexture;
uniform sampler2D uDisplacement;
uniform float uTime;
uniform float uVelocity;
uniform float uIntensity;
uniform vec2 uMouse;
uniform vec2 uResolution;

varying vec2 vUv;

// Simplex noise functions
vec3 mod289(vec3 x) { return x - floor(x * (1.0 / 289.0)) * 289.0; }
vec2 mod289(vec2 x) { return x - floor(x * (1.0 / 289.0)) * 289.0; }
vec3 permute(vec3 x) { return mod289(((x*34.0)+1.0)*x); }

float snoise(vec2 v) {
  const vec4 C = vec4(0.211324865405187, 0.366025403784439, -0.577350269189626, 0.024390243902439);
  vec2 i  = floor(v + dot(v, C.yy));
  vec2 x0 = v - i + dot(i, C.xx);
  vec2 i1 = (x0.x > x0.y) ? vec2(1.0, 0.0) : vec2(0.0, 1.0);
  vec4 x12 = x0.xyxy + C.xxzz;
  x12.xy -= i1;
  i = mod289(i);
  vec3 p = permute(permute(i.y + vec3(0.0, i1.y, 1.0)) + i.x + vec3(0.0, i1.x, 1.0));
  vec3 m = max(0.5 - vec3(dot(x0, x0), dot(x12.xy, x12.xy), dot(x12.zw, x12.zw)), 0.0);
  m = m*m;
  m = m*m;
  vec3 x = 2.0 * fract(p * C.www) - 1.0;
  vec3 h = abs(x) - 0.5;
  vec3 ox = floor(x + 0.5);
  vec3 a0 = x - ox;
  m *= 1.79284291400159 - 0.85373472095314 * (a0*a0 + h*h);
  vec3 g;
  g.x  = a0.x  * x0.x  + h.x  * x0.y;
  g.yz = a0.yz * x12.xz + h.yz * x12.yw;
  return 130.0 * dot(m, g);
}

void main() {
  vec2 uv = vUv;

  // Get displacement from fluid simulation
  vec4 displacement = texture2D(uDisplacement, uv);

  // Base noise distortion
  float noise = snoise(uv * 3.0 + uTime * 0.1);

  // Mouse influence
  vec2 mouseUv = uMouse / uResolution;
  float mouseDist = distance(uv, mouseUv);
  float mouseInfluence = smoothstep(0.3, 0.0, mouseDist);

  // Velocity-based warp
  vec2 warp = displacement.xy * uVelocity * uIntensity;
  warp += noise * 0.01 * uVelocity;
  warp += mouseInfluence * (uv - mouseUv) * 0.05;

  // Apply distortion
  vec2 distortedUv = uv + warp;

  // Sample texture with distortion
  vec4 color = texture2D(uTexture, distortedUv);

  // Add subtle vignette
  float vignette = 1.0 - smoothstep(0.5, 1.5, length(uv - 0.5) * 2.0);
  color.rgb *= vignette * 0.3 + 0.7;

  gl_FragColor = color;
}
