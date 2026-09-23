# Project Status — The Human Review

Last updated: 2026-09-23

## What this project is

Two parallel deliverables built from the same Figma design ("The Human Review" marketing site):

1. **Static HTML/Tailwind prototypes** — `about.html`, `how-it-works.html`, `contact.html` at the repo root. Pixel-reference builds, served directly (no backend), styled with the Tailwind CDN build + `assets/css/main.css`.
2. **WordPress mu-plugin** — `wp-mu-plugins/human-review-widgets/`, a set of registered Elementor widgets that reproduce the same design sections, built to be manually deployed to the live site at `s1.kanesherwell.com`.

The mu-plugin is the **production deliverable**. The static HTML files are the reference/prototype layer — when a fix lands on the static pages, it generally needs to be ported into the matching widget by hand (they are not code-shared).

## Architecture

### Static prototypes (repo root)
- `about.html`, `how-it-works.html`, `contact.html`
- `assets/css/main.css` — small hand-written CSS (`.texture-bg`, font-family fallback)
- `assets/img/` — all images/SVGs (hero map, team photos, icons, footer logo, etc.)
- Tailwind loaded via CDN `<script>` with an inline `tailwind.config` (colors: `orange`, `ink`, `surface`; font: Onest)

### WP mu-plugin (`wp-mu-plugins/human-review-widgets/`)
- `human-review-widgets.php` — loader: enqueues fonts/CSS/JS, registers the `human-review` Elementor category, requires + registers every widget class
- `widgets/class-*.php` — one file per design section, each a classic Elementor `Widget_Base` with `Controls_Manager` fields (text/media/repeater) so content is editable in Elementor
- `tailwind.config.js` / `src/input.css` — **separate** Tailwind pipeline from the static prototypes (own compiled output, must be rebuilt independently)
- `assets/css/tailwind.css` — **compiled, committed output**. Must be rebuilt after any class change:
  ```bash
  cd wp-mu-plugins/human-review-widgets
  npx tailwindcss -i src/input.css -o assets/css/tailwind.css --minify
  ```
- `assets/js/main.js` — shared vanilla JS: mobile hamburger menu (scoped per `.hr-header` instance) + scroll-triggered counter animation (`.js-counter`)
- Deployment is **manual**: whoever pushes to the live site copies changed PHP files + the rebuilt `tailwind.css` (and `main.js` if touched) into the live `wp-content/mu-plugins/` — there is no CI/automation for this yet

### Widget-to-section map
| Widget file | Section |
|---|---|
| `class-header-widget.php` | Site header/nav (shared) |
| `class-footer-widget.php` | Footer + "Ready for real feedback?" CTA banner (shared) |
| `class-hero-widget.php` | About page hero |
| `class-why-exist-widget.php` | About — Why We Exist |
| `class-beliefs-widget.php` | About — What We Believe |
| `class-team-widget.php` | About — The Humans Behind the Reviews |
| `class-hiw-hero-widget.php` | How It Works hero |
| `class-steps-widget.php` | How It Works — 4-step process (fixed to exactly 4 steps, see code comment) |
| `class-help-cards-widget.php` | How It Works — How We Can Help |
| `class-unfiltered-truth-widget.php` | How It Works — Unfiltered Truth |
| `class-faq-widget.php` | FAQ accordion (shared, used on multiple pages) |

`contact.html` has no corresponding widget yet — it's static-only so far.

## Known recurring gotcha: Elementor atomic style stripping

Elementor's newer "atomic" container/flexbox elements can override certain Tailwind utility classes (observed with `box-shadow` and `border-radius`) due to cascade/specificity on the live site — even when the class compiles correctly and looks right locally. **Fix pattern**: bake the property into an inline `style="..."` attribute directly on the element in the PHP, since inline styles win regardless of Elementor's injected atomic styles. Already applied to: Why We Exist button shadow, Hero button shadow, Steps card shadows, Help Cards image border-radius.

If a class-based style looks correct in local preview but not on the live site, this is the first thing to check.

## What was fixed this session (chronological)

1. Ported the Figma "all CSS layers" spec accuracy pass across `about.html`, `how-it-works.html`, and their widgets: hero H1 responsive scale (40→56→84px), section H2 scale (32→40→56px), full-opacity `#0F172A` body text (was muted grays), section background `#F9FAFB`, button shadows/borders, FAQ accordion peach `#FFE4D5` open-state styling, Team section card typography
2. Fixed a real CSS Grid bug: an unconditional `display:grid` (only `grid-cols-2` was breakpoint-gated) let content overflow on mobile because implicit grid tracks size to max-content by default — switched to `flex flex-col lg:grid` so mobile properly shrinks
3. Fixed Hero H1 overlapping the map image specifically at 1024px width — root cause was the two-column grid squeezing exactly when text jumped to a large size; solved with an intermediate `lg:` font step + increased column gap rather than relying on translate alone
4. Footer: switched from muted `white/40`/`white/70` text to solid white (matching a literal `color: #FFFFFF` on every text layer in the Figma export) — briefly tried Outfit/Figtree fonts to match another artifact in the export, then **reverted to Onest globally** per explicit instruction, since the whole site should use one font
5. Fixed step icons being double-wrapped in a small flat circle when the SVG assets (`icon-01.svg`–`icon-04.svg`) already contain the full 100px gradient badge — removed the redundant wrapper
6. CTA "Ready for real feedback?" banner: background `#000000` → `#171717` with `mix-blend-mode: hard-light` on the texture image, matching the Figma blend spec
7. Header nav: background → `#F9FAFB` (blends with Hero below it) + `backdrop-blur-[6px]` + `border-bottom: 1px solid #F3F4F6`; nav link/button sizing and colors corrected to spec
8. **Removed all `lg:` side padding** from header, hero, and every content section (Why We Exist, What We Believe, Team, FAQ, Steps, Help Cards, Unfiltered Truth, CTA) across all 3 static pages and all widgets — content now fills the full `max-w` container edge-to-edge at desktop widths instead of having an extra inset. Mobile still keeps `px-6` since there's no `max-w` constraint on a narrow viewport.
9. Team section: on mobile/tablet, restructured from "all 4 photos, then all 4 name cards" (two separate grids) into per-person combined cards (photo directly above its own name/role) — desktop keeps the original split-row Figma layout
10. Added a scroll-triggered count-up animation (`12k+`, `24h` stats) via `IntersectionObserver` + `requestAnimationFrame`, generic enough to animate any numeric-prefixed stat value
11. Hero globe image nudge: found and fixed a bug where a flat (non-responsive) inline `margin-right: -100px` — added earlier to nudge the globe right on desktop — was also firing on mobile and pushing the image off-screen. Fixed by scoping it inside a `@media (min-width: 1280px)` block in a small `<style>` tag in the widget's `render()`.

## Open items / things to check next

- `contact.html` has no Elementor widget counterpart yet
- No automated deploy pipeline — every fix needs manual file copy to the live site's `mu-plugins/` folder, plus a `tailwind.css` rebuild before copying
- Worth an audit pass: any other widgets using Tailwind classes for `box-shadow`/`border-radius`/similar properties that haven't yet hit the "Elementor strips it" bug in testing, but might on the live site (see gotcha section above)
- The FAQ widget has a "Section Background" control (Textured / Custom Color) added earlier — worth double-checking it still renders correctly after the `#F9FAFB` accuracy pass

## Local dev quickstart

```bash
# Static prototypes — just open the HTML files directly, or:
python3 -m http.server 4322
# then visit http://localhost:4322/about.html etc.

# Widget CSS rebuild (after any class change in wp-mu-plugins/human-review-widgets/widgets/*.php)
cd wp-mu-plugins/human-review-widgets
npx tailwindcss -i src/input.css -o assets/css/tailwind.css --minify

# PHP lint check after any widget edit
php -l widgets/class-<name>-widget.php
```
