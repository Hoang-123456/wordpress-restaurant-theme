# Restaurant Theme

A custom WordPress **FSE theme** (Full Site Editing) for restaurants –
from a quick-service spot to upscale dining. It is a standalone blank theme,
not a third-party theme, not a page builder, and not jQuery-based.

## Features

- **GDPR-compliant** – all fonts are self-hosted locally (no Google Fonts CDN at runtime), no tracking without consent
- **Accessible (WCAG AA)** – skip link, visible `:focus-visible` state,
  `prefers-reduced-motion` respected, correct landmark structure
  (`header`/`main`/`footer`), live region for menu filtering
- **Mobile-first** – core block responsiveness (navigation overlay,
  automatic stacking in columns) instead of custom breakpoints where possible
- **No bloat** – the menu script is only loaded on pages that actually contain
  the menu pattern
- **Data-driven menu** – dishes, categories, and tags live centrally in
  `assets/data/menu.json`, rendered with vanilla JS using category filters,
  full-text search, and a vegetarian-only toggle

## Structure

```
functions.php           Theme supports, i18n, font preloading, menu asset loading
style.css                Theme header plus lightweight extra CSS (most styling runs via theme.json)
theme.json                Color palette, typography, spacing, presets (single source of truth)
templates/                Block templates (front-page, page, index, 404)
parts/                    Header and footer as template parts
patterns/                 Standalone sections: Hero, Menu, About us, Contact, Imprint, Privacy policy
assets/data/menu.json     Menu data (categories, dishes, prices, tags)
assets/js/menu.js         Rendering, filtering, and search for the menu
assets/fonts/             Self-hosted WOFF2 files (Figtree, Fraunces)
languages/                Translation files (currently only English content is maintained)
```

Each section (Hero, Menu, About us, Contact) is a standalone pattern that can be selected in the editor. `patterns/front-page.php` optionally combines them into a complete homepage. For "About us" and "Contact", there are both separate patterns and a combined alternative (`about-contact.php`) – only one of these variants should be used in a project, and the other can be deleted in the editor.

## Requirements

- WordPress ≥ 6.6 (`theme.json` schema version 3)
- PHP ≥ 8.2

## Customizing colors and typography

The full color palette and typography are driven by `theme.json` presets
(slugs `primary`, `accent`, `highlight`, `text`, `muted`, `white`, `cream`,
`surface`, `border`). For a different project, it is enough to swap the color values there – the rest of the code references the slugs, not the hex values directly.

Font families: **Figtree** (body text) and **Fraunces** (headings), both self-hosted in `assets/fonts/`. Details about character subsetting are in [`assets/fonts/README.md`](assets/fonts/README.md).

## Open points

See [`OFFENE-ENTSCHEIDUNG-RGBA-FARBWERTE.md`](OFFENE-ENTSCHEIDUNG-RGBA-FARBWERTE.md): a still undecided question about two `rgba()` white values with transparency in `patterns/hero.php` and `parts/footer.html`, which (unlike the rest of the colors) are not yet mapped to a `theme.json` slug – intentionally deferred, not a blocker.
