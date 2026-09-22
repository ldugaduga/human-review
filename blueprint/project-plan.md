# Project Plan

## 1. Problem - What problem are we solving?

`about.html` and `how-it-works.html` are pixel-precise static Tailwind
prototypes with no CMS behind them. Convert them into a real WordPress site
(`s1.kanesherwell.com`, site title "Human Review") as a standalone custom
theme, preserving exact visual fidelity.

## 2. Users - Who is this for?

Whoever manages the site going forward (Kane / site admins). Not the site's
public visitors directly - this project is about shipping the exact design as
real WordPress templates, not new visitor-facing functionality.

## 3. Features - What does the MVP need?

A standalone custom WordPress theme with PHP templates for each page, built
from the existing HTML/Tailwind markup almost verbatim:

- `header.php` / `footer.php` - shared across all pages
- About page template (hero, why we exist, what we believe, team grid +
  stats bar, CTA)
- How-it-works page template (hero, steps timeline, how we can help,
  testimonial card, FAQ accordion, shared CTA)
- Compiled, purged Tailwind CSS build (no CDN script in production)

## 4. Data - What are we storing?

No database/backend. Theme-bundled assets (images/icons/textures, already in
`assets/img/`) ship inside the theme's own folder, not the WP Media Library.

## 5. Tech - What stack are we using?

WordPress 7.1.1 on `s1.kanesherwell.com`. **Standalone custom PHP theme**
(not a child theme, replaces Hello Elementor as the active theme), built
locally in this repo and deployed manually by the user (SFTP / Filester file
manager / WP-CLI - this MCP connection cannot write files to the server).

Pages are **code-only templates**, not Elementor content - not drag-and-drop
editable in Elementor afterward. This trades editability for guaranteed
pixel-fidelity, since the real Tailwind markup ships as-is instead of being
re-mapped into Elementor widget/container controls.

Tailwind is compiled at build time into one static, purged CSS file bundled
with the theme (per the earlier CSS-delivery decision) - no CDN script, no
runtime JIT.

**Superseded approach:** an earlier pass built the Header as live Elementor
Theme Builder content on the site (global colors/typography, atomic elements,
per-element Custom CSS) via the `emcp-s1-kanesherwell-com` MCP tools. That
work is left in place on the live site but is no longer the delivery
mechanism going forward; the real theme templates supersede it once deployed.

## 6. Monetize - How will this make money?

N/A, out of scope (marketing site only).

## 7. UI/UX - How should this look and feel?

Match `about.html`/`how-it-works.html` exactly - the real markup and Tailwind
classes ship as the theme's templates, so fidelity is by construction rather
than by re-approximation.

## 8. Deployment - Where and how will this ship?

Theme is built locally in this repo (`wp-theme/` or similar). The user
transfers the finished theme folder to `wp-content/themes/` on
`s1.kanesherwell.com` themselves (SFTP, the Filester file-manager plugin, or
WP-CLI/SSH if available), then activates it in wp-admin. No CI/CD.

## 9. Usage model and constraints (optional)

Single site (`s1.kanesherwell.com`), single trusted editor (Kane), internal
use. No compliance, multi-tenant, or scale constraints known or assumed.
