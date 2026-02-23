// RGB Shift / Chromatic Aberration Fragment Shader
precision highp float;

uniform sampler2D tDiffuse;
uniform float uAmount;
uniform float uAngle;
uniform vec2 uCenter;

varying vec2 vUv;

void main() {
  vec2 uv = vUv;
  vec2 center = uCenter;

  // Direction from center
  vec2 dir = uv - center;
  float dist = length(dir);

  // Radial chromatic aberration
  vec2 offset = normalize(dir) * uAmount * dist * dist;

  // Also add directional shift based on angle
  vec2 angleOffset = vec2(cos(uAngle), sin(uAngle)) * uAmount * 0.5;

  // Sample each channel with different offsets
  float r = texture2D(tDiffuse, uv + offset + angleOffset).r;
  float g = texture2D(tDiffuse, uv).g;
  float b = texture2D(tDiffuse, uv - offset - angleOffset).b;

  gl_FragColor = vec4(r, g, b, 1.0);
}
