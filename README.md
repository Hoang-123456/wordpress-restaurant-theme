# Restaurant Theme

Individuelles WordPress-**FSE-Theme** (Full Site Editing) für Restaurants –
vom Schnellimbiss bis zur gehobenen Küche. Eigenes Blank-Theme, kein
Drittanbieter-Theme, kein Page-Builder, kein jQuery.

## Eigenschaften

- **DSGVO-konform** – alle Fonts lokal selbst gehostet (kein Google-Fonts-CDN
  zur Laufzeit), kein Tracking ohne Consent
- **Barrierefrei (WCAG AA)** – Skip-Link, sichtbarer `:focus-visible`-Zustand,
  `prefers-reduced-motion` respektiert, korrekte Landmark-Struktur
  (`header`/`main`/`footer`), Live-Region für die Menü-Filterung
- **Mobile-first** – Core-Block-Responsivität (Navigation-Overlay,
  automatisches Stacking bei Columns) statt eigener Breakpoints, wo möglich
- **Kein Bloat** – Menü-Skript wird nur auf Seiten geladen, die das
  Menü-Pattern tatsächlich enthalten
- **Datengetriebene Speisekarte** – Gerichte, Kategorien und Tags liegen
  zentral in `assets/data/menu.json`, gerendert per Vanilla-JS mit
  Kategorie-Filter, Volltextsuche und "Nur vegetarisch"-Umschalter

## Struktur

```
functions.php           Theme-Supports, i18n, Font-Preload, Menü-Asset-Loading
style.css                Theme-Header + schlankes Zusatz-CSS (Großteil läuft über theme.json)
theme.json                Farbpalette, Typografie, Spacing, Presets (Single Source of Truth)
templates/                Block-Templates (front-page, page, index, 404)
parts/                    Header und Footer als Template-Parts
patterns/                 Eigenständige Sektionen: Hero, Menü, Über uns, Kontakt, Impressum, Datenschutz
assets/data/menu.json     Speisekarten-Daten (Kategorien, Gerichte, Preise, Tags)
assets/js/menu.js         Rendering, Filter und Suche für die Speisekarte
assets/fonts/             Selbst gehostete WOFF2-Dateien (Figtree, Fraunces)
languages/                Übersetzungsdateien (aktuell nur Deutsch gepflegt)
```

Jede Sektion (Hero, Menü, Über uns, Kontakt) ist ein eigenständiges,
im Editor wählbares Pattern. `patterns/front-page.php` bündelt sie optional
zu einer kompletten Startseite. Für "Über uns" und "Kontakt" gibt es sowohl
getrennte Patterns als auch eine kombinierte Alternative
(`about-contact.php`) – im Projekt wird nur eine der beiden Varianten
verwendet, die andere kann im Editor gelöscht werden.

## Voraussetzungen

- WordPress ≥ 6.6 (`theme.json`-Schema-Version 3)
- PHP ≥ 8.2

## Farben & Typografie anpassen

Die komplette Farbpalette und Typografie läuft über `theme.json`-Presets
(Slugs `primary`, `accent`, `highlight`, `text`, `muted`, `white`, `cream`,
`surface`, `border`). Für ein anderes Projekt genügt es, die Farbwerte dort
auszutauschen – der restliche Code referenziert nur die Slugs, nicht die
Hex-Werte direkt.

Schriftfamilien: **Figtree** (Fließtext) und **Fraunces** (Überschriften),
beide selbst gehostet in `assets/fonts/`. Details zum Zeichensatz-Subsetting
in [`assets/fonts/README.md`](assets/fonts/README.md).

## Offene Punkte

Siehe [`OFFENE-ENTSCHEIDUNG-RGBA-FARBWERTE.md`](OFFENE-ENTSCHEIDUNG-RGBA-FARBWERTE.md):
eine noch nicht final entschiedene Frage zu zwei `rgba()`-Weißwerten mit
Transparenz in `patterns/hero.php` und `parts/footer.html`, die (anders als
der Rest der Farben) noch nicht über einen `theme.json`-Slug abgebildet
sind – bewusst vertagt, kein Blocker.
