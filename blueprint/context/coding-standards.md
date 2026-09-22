# Coding Standards

> Your conventions. Edit these once to match your stack. Tuned for a static
> HTML + Tailwind CDN site with no build step, no framework, and no database.

## HTML

- Plain, standalone `.html` files at the project root (`about.html`,
  `how-it-works.html`, ...). Each page is self-contained: its own `<head>`,
  Tailwind CDN script, and inline Tailwind config.
- Semantic elements (`header`, `nav`, `section`, `footer`) over generic `div`
  soup where it doesn't fight the existing markup style.
- Keep new pages consistent with the existing header/footer/CTA markup already
  shared across `about.html` and `how-it-works.html` (copy the block, then edit
  the content, not the structure).

## Styling

- Tailwind CSS via the CDN Play script (`cdn.tailwindcss.com`), configured
  inline per page with a shared `tailwind.config` (`orange`, `ink`, `surface`
  colors; `Onest` as the display/sans font).
- Shared, reusable CSS rules (font-family, `.texture-bg`, etc.) live in
  `assets/css/main.css`, linked from each page. Don't duplicate rules from
  there back into a `<style>` block.
- Prefer Tailwind utility classes, including arbitrary values (`w-[15.3px]`,
  `shadow-[...]`) to match exact design specs, over hand-written CSS.
- No separate per-component CSS files; keep styling in-markup with Tailwind
  classes.

## JavaScript

- Vanilla JS only, no framework, no bundler. Small inline `<script>` blocks at
  the end of the page body (mobile menu toggle, FAQ accordion via native
  `<details>`/`<summary>`).
- Prefer native HTML behavior (`<details open>`, form elements) over
  hand-rolled JS state where it covers the interaction.

## File Organization

- Pages: `*.html` at the project root.
- Shared stylesheet: `assets/css/main.css`.
- Images/icons: `assets/img/`, with per-section subfolders where it helps
  (`assets/img/how-it-works/`, `assets/img/teams/`).
- Keep new pages' assets under the same `assets/img/` tree rather than
  page-local folders.

## Naming

- Image files: kebab-case, descriptive (`customer-review.png`, `icon-01.svg`).
- CSS classes: Tailwind utilities; avoid inventing custom class names unless
  extracting a rule into `main.css`.

## Data

- No database, no backend. Any form (newsletter signup, etc.) is presentational
  only unless a real submission endpoint is added later.

## Error Handling

- Not applicable at this stage; there is no server-side logic or data fetching
  to fail. Revisit if/when a backend or form submission target is added.

## Testing

No test runner is configured, and none is expected for a static marketing site
without logic-bearing code. If validators, formatters, or other pure logic are
added later, wire up a runner via `/tests` and update `Commands` in `AGENTS.md`
at that point.

## Browser Verification

This is a visual, pixel-matched project (image-to-code work against Figma
screenshots), so browser verification matters more than usual:

- After any visual change, open the page in a real browser and compare against
  the reference screenshot/crop, not just a read of the markup.
- Use the existing local static server (`python3 -m http.server`, wired in
  `.claude/launch.json`) to preview pages rather than assuming `file://`
  rendering matches.
- Check both the primary breakpoint and mobile (the hamburger menu, stacked
  layouts) before calling a change done.

## Code Quality

- No commented-out code unless specified.
- No unused imports or variables.
- Keep functions under 50 lines when possible.

## Comments

Write code that explains itself; comment only what the code cannot say.
Over-commenting is a common AI tell, so resist it.

- Comment the **why**, not the **what**. Delete any comment that restates the code.
- No banner/header blocks, section dividers, or step-by-step narration of obvious
  code. A file does not need a comment announcing each region.
- A comment earns its place only when it captures something the code can't: a
  non-obvious decision, a gotcha or workaround, why a value is what it is, or a
  link to a spec or issue.
- Prefer self-documenting names and small functions over explanatory comments.
- Keep doc comments minimal: a one-line purpose on an exported type or function is
  plenty; don't write JSDoc that just repeats the signature.
- When in doubt, leave the comment out.

## Writing

- No em dashes (U+2014) in generated content: docs, comments, commit messages,
  READMEs, specs. They read as AI-generated.
- Use a hyphen for `term - description` separators; rephrase prose with commas,
  parentheses, or a colon. Avoid en dashes and the ellipsis character too.
