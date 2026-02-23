# Lab — Design Experiments

> Pages cachees, non indexees, non linkees depuis le site principal.

---

## URL d'acces (Docker port 8888)

| Page | URL |
|---|---|
| **Site principal** | `http://localhost:8888/` |
| **Motion Design Lab** | `http://localhost:8888/lab-motion.php` |
| **Image Reveal** | `http://localhost:8888/lab-reveal.php` |
| **Lab Patterns** | `http://localhost:8888/lab.php` |

---

## lab-motion.php — 10 Motion Design Modules

Showcase interactif de 10 techniques motion design. Chaque module s'active au scroll (IntersectionObserver).

| # | Module | Technique |
|---|---|---|
| 01 | **Magnetic Letters** | Repulsion physique par lettre, spring animation |
| 02 | **Liquid Blobs** | SVG path morphing avec bruit sinusoidal + bezier |
| 03 | **Parallax Depth** | Multi-layer mouse tracking, profondeur simulee |
| 04 | **Kinetic Typography** | Mots reveles au scroll avec clip-path stagger |
| 05 | **Velocity Cards** | Skew dynamique base sur la vitesse de scroll |
| 06 | **Aurora Borealis** | Bandes de gradient animees en canvas (screen blend) |
| 07 | **Constellation** | Particules connectees, attraction au curseur |
| 08 | **Text Scramble** | Caracteres aleatoires qui resolvent progressivement |
| 09 | **Infinite Marquee** | Rubans CSS infinis, acceleration au hover |
| 10 | **3D Tilt Cards** | Perspective mouse tracking + reflet glossy dynamique |

---

## lab-reveal.php — Hero Image Reveal

Hero plein ecran. Image de base visible, image cachee revelee au survol via Canvas 2D avec trainee persistante + decay.

### Images

| Role | Fichier |
|---|---|
| Base (visible) | `assets/images/Montagne_PP.jpg` |
| Revelee (cachee) | `assets/images/Estaragne_pic.png` |

### 16 Effets

| Classiques | Dynamiques | Avances | Experimentaux |
|---|---|---|---|
| Circle | Ondulation | Thermal | Dissolve |
| Brume | X-Ray | Glitch | Voronoi |
| Peinture | Brise | Smoke | ASCII |
| Pixel | Spirale | Magnetique | Matrix |

---

## Stack technique

- **Vanilla JS** — zero dependance externe
- **Canvas 2D** — moteur reveal + aurora + particules
- **CSS transitions/animations** — kinetic, marquee, tilt
- **IntersectionObserver** — activation lazy des modules
- **requestAnimationFrame** — animations 60fps
- **prefers-reduced-motion** — accessibilite respectee
- **noindex, nofollow** — pages non indexees

## Fichiers

```
lab-motion.php              <- 10 modules motion design
assets/css/lab-motion.css   <- styles motion
assets/js/lab-motion.js     <- interactions motion

lab-reveal.php              <- hero image reveal
assets/css/lab-reveal.css   <- styles reveal
assets/js/lab-reveal.js     <- moteur canvas + 16 effets + trail

lab.php                     <- lab patterns (5 sections premium)
assets/css/lab.css          <- styles lab patterns

LAB.md                      <- cette doc
```
