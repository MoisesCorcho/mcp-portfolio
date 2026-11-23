---
name: Portfolio V2 Design System
description: Cyber-Industrial Neo-Brutalism & Sustainable Geo-Editorial frontend design specification for Moisés Corcho's portfolio.
colors:
  bg-canvas: "#07090e"
  bg-chamber: "#090c14"
  bg-card: "#080b11"
  bg-floor: "#06080e"
  border-structural: "#27272a"
  border-card: "#3f3f46"
  accent-amber: "#f59e0b"
  accent-amber-light: "#fbbf24"
  accent-orange: "#f97316"
  text-primary: "#ffffff"
  text-secondary: "#cbd5e1"
  text-muted: "#71717a"
typography:
  display:
    fontFamily: "Oxanium, sans-serif"
    fontWeight: 800
    letterSpacing: "-0.03em"
    textTransform: "uppercase"
  body:
    fontFamily: "Roboto Mono, monospace"
    fontWeight: 400
    lineHeight: "1.6"
  code:
    fontFamily: "Roboto Mono, monospace"
    fontWeight: 600
rounded:
  none: "0px"
spacing:
  cad-node: "12px"
  grid-unit: "56px"
components:
  cad-node:
    size: "12px"
    backgroundColor: "{colors.accent-amber}"
    borderColor: "#000000"
    rounded: "{rounded.none}"
  button-primary:
    backgroundColor: "{colors.accent-amber}"
    textColor: "#000000"
    typography: "{typography.code}"
    padding: "14px 24px"
    rounded: "{rounded.none}"
  button-secondary:
    backgroundColor: "{colors.bg-chamber}"
    textColor: "{colors.text-primary}"
    typography: "{typography.code}"
    padding: "14px 24px"
    rounded: "{rounded.none}"
---

# Design System Specification — Portfolio V2

## Overview
A high-contrast, technical, and architectural design language blending **Cyber-Industrial Neo-Brutalism** (orthogonal structural honesty, visible steel-wireframe joints, precision typography) with **Sustainable Geo-Editorial** design (low-cognitive load, high readability, genuine content hierarchy).

The objective is to project authority as a **Senior Full-Stack Engineer and Architect**: technical precision without gimmicks.

---

## Core Philosophy & Anti-Clutter Laws

> [!IMPORTANT]
> **Zero "Sci-Fi Cosplay" / Zero Artificial Clutter**:
> - **NEVER** invent fake system labels, mock terminal coordinates, sci-fi badges, or artificial code comments (e.g. `// AUTOMATED_CYCLING`, `SPEC: SYSTEMS_ENGINEER`, `// 02. SECTION_ABOUT`, `LATERAL_THINKING`, `// GITHUB_PROFILE`).
> - Every piece of text must correspond to **real, factual information** (actual CV data, real project metrics, actual navigation labels).
> - Structural honesty: Visual impact is achieved through the **1px continuous steel grid, CAD intersection nodes, precision typography, and content**, NOT decorative pseudotext.

---

## Colors

| Token | Hex | Role |
| :--- | :--- | :--- |
| `bg-canvas` | `#07090e` | Deep background canvas behind the chassis. |
| `bg-chamber` | `#090c14` | Semi-translucent architectural chamber fill (`rgba(9, 12, 20, 0.6)` with backdrop blur). |
| `bg-card` | `#080b11` | High-contrast callout boxes and photo frames. |
| `bg-floor` | `#06080e` | Marquee technical floor beam fill. |
| `border-structural` | `#27272a` (`zinc-800`) | Continuous 1px outer rails, column dividers, and floor lines. |
| `border-card` | `#3f3f46` (`zinc-700`) | Frame borders on images and focal cards. |
| `accent-amber` | `#f59e0b` (`amber-500`) | Intersection CAD pins, active badges, primary CTA fill, accent rulers. |
| `accent-amber-light` | `#fbbf24` (`amber-400`) | Gradient headings, hover highlights. |
| `text-primary` | `#ffffff` | Headings, hero macro title, high-emphasis metrics. |
| `text-secondary` | `#cbd5e1` (`slate-300`) | Narrative paragraphs, quote text. |
| `text-muted` | `#71717a` (`zinc-500`) | Subtitles, section indicator labels, subtle metadata. |

---

## Typography

### Display Font: [Oxanium](https://fonts.google.com/specimen/Oxanium)
- **Use**: Main hero headings, section titles (`h1`, `h2`), prominent numerical metrics.
- **Weights**: Bold (`700`), ExtraBold (`800`).
- **Characteristics**: Uppercase (`uppercase`), tight letter-spacing (`tracking-tight` or `-0.03em`), chamfered industrial angles.
- **Rule**: Headings always use fluid typography with `clamp()` for responsive viewport scaling.

### Body & Monospace Font: [Roboto Mono](https://fonts.google.com/specimen/Roboto+Mono)
- **Use**: Subtitles, body narrative paragraphs, quote card, buttons, tech stack pills, social links, footer, micro-labels.
- **Weights**: Regular (`400`), Medium (`500`), SemiBold (`600`), Bold (`700`).
- **Rule**: Standard sentence casing or lowercase where appropriate. Maintain unitless relative line heights (`leading-relaxed` / `1.6`) for high readability.

---

## Layout & Structural Grid (The Continuous Spine)

1. **Monolithic Chassis**:
   - The page does **NOT** consist of separate floating card boxes.
   - The entire page runs inside a continuous **1280px (`max-w-7xl mx-auto`)** container with outer rails: `border-x border-zinc-800`.
   - These vertical rails run **unbroken** from the top of the hero through all sections to the footer.
2. **Background Coordinate Grid**:
   - A single coordinate grid overlay (`56px x 56px`, 1px stroke at `rgba(245, 158, 11, 0.05)`) spans 100% of the viewport width and full height behind the spine.
3. **Shared Floor Beams**:
   - Sections are separated by **a single horizontal 1px line (`border-b border-zinc-800`)**.
   - NEVER create parallel double lines or empty gaps between sections.
4. **CAD Intersection Pins**:
   - Square amber markers: `w-3 h-3 bg-amber-500 border border-black z-20`.
   - Placed **strictly** at the intersection where a structural vertical rail (outer border or column divider) crosses a horizontal floor beam.
   - Never duplicate pins at the same junction.

---

## Shapes & Framing

- **Zero Rounded Corners**: All components, buttons, and cards use orthogonal 90° corners (`rounded-none`).
- **Photo Framing**:
  - Image frames: `border border-zinc-700/80 bg-[#080b11] p-2 sm:p-3 shadow-[0_20px_50px_rgba(0,0,0,0.6)]`.
  - Four corner reticle marks placed at image borders:
    ```html
    <span class="absolute top-1 left-1 font-mono text-[10px] text-amber-500 leading-none select-none" aria-hidden="true">⌜</span>
    <span class="absolute top-1 right-1 font-mono text-[10px] text-amber-500 leading-none select-none" aria-hidden="true">⌝</span>
    <span class="absolute bottom-1 left-1 font-mono text-[10px] text-amber-500 leading-none select-none" aria-hidden="true">⌞</span>
    <span class="absolute bottom-1 right-1 font-mono text-[10px] text-amber-500 leading-none select-none" aria-hidden="true">⌟</span>
    ```
  - Images retain `aspect-ratio` (`aspect-[16/9]`, `aspect-square`, `aspect-[4/5]`) with `object-cover`.

---

## Components

### 1. Primary Action Button (CTA)
```html
<a href="..." class="inline-flex items-center gap-2 px-6 py-3.5 bg-amber-500 hover:bg-amber-400 text-black font-roboto-mono font-bold text-xs uppercase tracking-wider transition-all duration-200 border border-amber-300 shadow-[0_0_25px_rgba(245,158,11,0.25)]">
    <span>BUTTON_LABEL</span>
    <svg ...></svg>
</a>
```

### 2. Secondary Action Button
```html
<a href="..." class="inline-flex items-center gap-2 px-6 py-3.5 bg-zinc-900/90 hover:bg-zinc-800 text-zinc-200 font-roboto-mono font-semibold text-xs uppercase tracking-wider transition-all duration-200 border border-zinc-700 hover:border-zinc-500">
    <span>BUTTON_LABEL</span>
</a>
```

### 3. Orthogonal Icon / Tag Cells
Square 40x40px 1px-bordered cells for social links, tech tags, or navigation items:
```html
<a href="..." class="w-10 h-10 border border-zinc-800 bg-zinc-900/70 hover:border-amber-500 hover:text-amber-400 hover:bg-amber-500/10 text-zinc-400 transition-all duration-200 flex items-center justify-center font-roboto-mono text-xs">
    <svg ...></svg>
</a>
```

### 4. Quote / Callout Card
```html
<div class="relative border border-zinc-800 bg-[#080b11] p-6 border-l-2 border-l-amber-500 shadow-[0_10px_30px_rgba(0,0,0,0.5)]">
    <p class="text-slate-200 text-sm sm:text-base font-roboto-mono font-medium leading-relaxed italic">
        ...
    </p>
</div>
```

---

## Directory & File Structure (V2 Architecture)

```text
resources/views/v2/
├── index.blade.php           ← Main page wrapper mounting the continuous chassis
├── layout/
│   └── app.blade.php         ← V2 Layout with Google Fonts & global head
└── sections/
    ├── hero.blade.php        ← Hero chamber
    ├── marquee.blade.php     ← Marquee data beam
    ├── about.blade.php       ← About chamber
    ├── projects.blade.php    ← Portfolio showcase chamber
    ├── experience.blade.php  ← Career timeline chamber
    └── contact.blade.php     ← Contact form chamber
```

---

## Do's and Don'ts

### Do:
- **Do** maintain continuous 1px outer borders (`max-w-7xl border-x border-zinc-800`) across all sections.
- **Do** use `Oxanium` exclusively for titles and `Roboto Mono` for body and UI copy.
- **Do** place amber CAD pins only where vertical rails cross horizontal dividers.
- **Do** honor real portfolio content from `lang/es/` and `lang/en/`.
- **Do** ensure 100% responsive behavior with `grid-cols-1 lg:grid-cols-12` and fluid typography.

### Don't:
- **Don't** close sections into independent floating boxes with 4 corners each.
- **Don't** add fake sci-fi comments (`//`), mock coordinates, fake system IDs, or bogus tech badges.
- **Don't** use border-radius or rounded pill buttons.
- **Don't** touch production files (`resources/views/home.blade.php`, `resources/views/components/home/*`) during V2 construction.
