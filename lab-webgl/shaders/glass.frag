// Glass Refraction Fragment Shader
precision highp float;

uniform sampler2D uBackground;
uniform sampler2D uDisplacement;
uniform vec2 uResolution;
uniform float uRefractPower;
uniform float uFresnelPower;
uniform float uTime;

varying vec2 vUv;
varying vec3 vNormal;
varying vec3 vViewPosition;

void main() {
  vec2 uv = vUv;

  // Get displacement for refraction
  vec4 disp = texture2D(uDisplacement, uv);

  // Fresnel effect (more refraction at edges)
  vec3 viewDir = normalize(vViewPosition);
  vec3 normal = normalize(vNormal);
  float fresnel = pow(1.0 - abs(dot(viewDir, normal)), uFresnelPower);

  // Calculate refraction offset
  vec2 refractOffset = disp.xy * uRefractPower * fresnel;

  // Add some chromatic aberration
  float rOffset = refractOffset.x * 1.1;
  float bOffset = refractOffset.x * 0.9;

  vec2 redUv = uv + vec2(rOffset, refractOffset.y);
  vec2 greenUv = uv + refractOffset;
  vec2 blueUv = uv + vec2(bOffset, refractOffset.y);

  // Sample background with chromatic aberration
  float r = texture2D(uBackground, redUv).r;
  float g = texture2D(uBackground, greenUv).g;
  float b = texture2D(uBackground, blueUv).b;

  vec3 color = vec3(r, g, b);

  // Add subtle tint
  color = mix(color, color * vec3(0.95, 0.95, 1.05), fresnel * 0.3);

  // Edge highlight
  float edgeHighlight = pow(fresnel, 3.0) * 0.3;
  color += vec3(edgeHighlight);

  gl_FragColor = vec4(color, 1.0);
}
