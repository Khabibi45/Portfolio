// Fluid Simulation Fragment Shader (Ping-Pong)
precision highp float;

uniform sampler2D uPrevState;
uniform vec2 uResolution;
uniform vec2 uMouse;
uniform vec2 uMouseVelocity;
uniform float uTime;
uniform float uDissipation;
uniform float uRadius;
uniform float uStrength;
uniform int uPass; // 0 = advect, 1 = add force

varying vec2 vUv;

// Bilinear sampling for smooth advection
vec4 textureBilinear(sampler2D tex, vec2 uv, vec2 res) {
  vec2 st = uv * res - 0.5;
  vec2 i = floor(st);
  vec2 f = fract(st);

  vec4 a = texture2D(tex, (i + vec2(0.5, 0.5)) / res);
  vec4 b = texture2D(tex, (i + vec2(1.5, 0.5)) / res);
  vec4 c = texture2D(tex, (i + vec2(0.5, 1.5)) / res);
  vec4 d = texture2D(tex, (i + vec2(1.5, 1.5)) / res);

  return mix(mix(a, b, f.x), mix(c, d, f.x), f.y);
}

void main() {
  vec2 uv = vUv;
  vec2 texel = 1.0 / uResolution;

  // Get previous state
  vec4 prev = texture2D(uPrevState, uv);

  if (uPass == 0) {
    // Advection pass - move the fluid
    vec2 velocity = prev.xy;
    vec2 advectedUv = uv - velocity * texel * 1.0;
    vec4 advected = textureBilinear(uPrevState, advectedUv, uResolution);

    // Apply dissipation
    advected *= uDissipation;

    gl_FragColor = advected;
  } else {
    // Force injection pass - add mouse/scroll influence
    vec2 mouseUv = uMouse / uResolution;
    float dist = distance(uv, mouseUv);

    // Gaussian splat
    float influence = exp(-dist * dist / (uRadius * uRadius));

    // Add mouse velocity as force
    vec2 force = uMouseVelocity * influence * uStrength;

    // Also add some swirl
    vec2 toMouse = mouseUv - uv;
    vec2 swirl = vec2(-toMouse.y, toMouse.x) * influence * 0.1;

    prev.xy += force + swirl;

    // Clamp velocity
    prev.xy = clamp(prev.xy, -1.0, 1.0);

    gl_FragColor = prev;
  }
}
