# Offene Entscheidung: `rgba()`-Weißwerte mit Transparenz

**Status: nicht entschieden, noch nicht umgesetzt.** Dieses Dokument hält den
Befund und die Optionen fest, damit die Entscheidung später (in diesem oder
einem anderen Chat) ohne erneute Analyse getroffen werden kann.

## Befund

`kanzlei-theme` nutzt an vier Stellen `rgba(255,255,255,x)` – also Weiß mit
individueller Deckkraft – direkt als Literal, statt über einen `theme.json`-
Preset-Slug:

| Datei | Zeile | Wert |
|---|---|---|
| `parts/footer.html` | 19–20 | `rgba(255,255,255,0.45)` |
| `patterns/about.php` | 52–53 | `rgba(255,255,255,0.75)` |
| `style.css` | 107 | `rgba(255,255,255,0.6)` |
| `style.css` | 311 | `rgba(255,255,255,0.75)` |

Das ist dieselbe Kategorie Problem wie bei hartcodierten Hex-Werten (Ziel laut
Theme-Standard: Farben über `theme.json`-Slugs, keine Literale im Code) – nur
dass reguläre Preset-Slugs keine Transparenz abbilden können, eine 1:1-
Ersetzung durch einen bestehenden Slug also nicht möglich ist.

**Warum das ursprünglich nicht aufgefallen ist:** `THEME-STANDARDS-FIXES.md`
prüft ausdrücklich nur auf Hex-Literale (`grep "#[0-9a-fA-F]..."`), nicht auf
`rgba()`. Blinder Fleck im ursprünglichen Audit, nicht weil dieses Theme
sauberer wäre als andere.

**Einordnung:** Wartbarkeits-/Konsistenzthema, **kein Sicherheitsrisiko**.
Eilt nicht.

## Drei Optionen zur Auswahl

### Option A – CSS-Custom-Property (`--white-rgb`)
```css
:root { --white-rgb: 255, 255, 255; }
```
```css
color: rgba(var(--white-rgb), 0.45);
```
- ✅ Farbton zentral änderbar (einmal `--white-rgb` anpassen, alle vier Stellen ziehen mit)
- ❌ Die vier unterschiedlichen Deckkraft-Werte (0.45 / 0.6 / 0.75 / 0.75) bleiben einzelne Literale, nicht zentralisiert
- ❌ Kein echtes `theme.json`-Preset – im Block-Editor für Redakteure nicht als Farboption sichtbar/wählbar, nur ein Code-interner Kniff
- Aufwand: klein

### Option B – Feste Slugs mit eingebrannter Deckkraft
Neue `theme.json`-Palette-Einträge, z. B. `white-45`, `white-60`, `white-75`
als eigene Presets mit fest hinterlegter Transparenz.
- ✅ "Echtes" Design-Token-Niveau, erscheint im Block-Editor wie die anderen Farben
- ❌ Mehr Slugs in der Palette, mehr Pflegeaufwand
- ❌ Nur sinnvoll, falls diese Transparenzstufen auch künftig an weiteren Stellen wiederverwendet werden – für genau vier feste Vorkommen eventuell Overkill
- Aufwand: mittel

### Option C – So lassen wie es ist
- ✅ Kein Aufwand, kein Risiko
- ❌ Inkonsistenz zum Rest des Themes (das sonst durchgängig Slugs nutzt) bleibt bestehen

## Offene Frage vor der Entscheidung

Sind die vier unterschiedlichen Deckkraft-Werte (45 %/60 %/75 %/75 %) bewusst
unterschiedlich gewählt (z. B. Copyright-Zeile bewusst dezenter als Fließtext),
oder wäre eine Vereinheitlichung auf einen einzigen Wert inhaltlich ohnehin
sinnvoll? Das beeinflusst, ob Option A oder B mehr Sinn ergibt.

## Zusätzlich zu prüfen

`THEME-STANDARDS-FIXES.md` sollte um diesen `rgba()`-Fall erweitert werden,
damit er bei künftigen Theme-Audits (z. B. im anderen Theme oder weiteren
Kunden-Themes) nicht wieder übersehen wird – unabhängig davon, welche Option
hier gewählt wird.

**Hinweis:** `THEME-STANDARDS-FIXES.md` existiert im `restaurant-theme`-
Repo inzwischen nicht mehr (Datei verschwunden, nicht durch diese Session
gelöscht). Die Ergänzung ist daher noch nicht nachgezogen worden – falls die
Datei im anderen Theme noch existiert, dort trotzdem ergänzen.

## Entscheidung für `restaurant-theme`: noch offen

Für `restaurant-theme` wurde die Wahl zwischen Option A/B/C bewusst
**vertagt** (2 Stellen: `patterns/hero.php:31-32` mit `rgba(255,255,255,0.85)`,
`parts/footer.html:7-8` mit `rgba(255,255,255,0.6)`). Einschätzung aus der
Prüfung: bei nur 2 Vorkommen, beide auf denselben festen Weißton (kein
Rebranding-Risiko), lohnt sich die Zentralisierung über Option A vermutlich
nicht – Empfehlung „Option C, erstmal so lassen", aber nicht final
entschieden, liegt beim Projektverantwortlichen.

---

## Nachtrag (2026-07-24, restaurant-theme): zwei weitere Befunde außerhalb des Hex/rgba-Themas

Bei einer vollständigen Prüfung von `restaurant-theme` gegen die allgemeine
Standards-Checkliste (`Allgemeine-Standards-WordPress-Themes.md`, Prüf-
Workflow-Abschnitt) kamen zwei zusätzliche, unabhängige Bug-Klassen zum
Vorschein, die sich lohnen, auch im anderen Theme zu prüfen:

### A) Verschachtelte `<header>`/`<footer>`-Landmarks

**Muster:** In den Templates wird ein Template-Part korrekt mit `tagName`
eingebunden, z. B.
```
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->
```
Das wrapt den **gesamten** Part-Inhalt bereits in `<header>`. Wenn die
Part-Datei selbst (`header.html`/entsprechend) *zusätzlich* eine innere
Gruppe mit statisch gespeicherter `<header>`/`<footer>`-Markierung enthält,
deren JSON-Attribute aber kein `"tagName"` setzen (z. B. nur
`{"className":"site-header",...}`), entsteht eine doppelte, identische,
ineinander verschachtelte Landmark (`<header><header>...</header></header>`).

**Erkennung:** JSON-Attribute jeder Gruppe mit `<header>`/`<footer>`/`<main>`-
Markierung gegen das tatsächlich gespeicherte Tag abgleichen – nicht nur
zählen, ob Klammern balanciert sind, sondern ob `tagName` im JSON zum
gespeicherten Tag passt. Gegenprobe im selben Theme: `<main>` war korrekt
(`"tagName":"main"` im JSON vorhanden, passend zur Markierung) – das zeigt,
dass es kein bewusstes Muster war, sondern ein Versehen nur bei
Header/Footer.

**Fix in `restaurant-theme`:** innere Gruppe zurück auf `<div>` (passend zu
ihren eigenen, tagName-losen Attributen) – die Landmark kommt bereits vom
äußeren Template-Part. Umgesetzt in `parts/header.html` und
`parts/footer.html`.

**Status:** in `restaurant-theme` behoben. Im anderen Theme noch zu prüfen.

### B) Heading-Hierarchie in Spalten-Layouts (falsche Eltern-Kind-Beziehung)

**Muster:** Ein Pattern mit zwei nebeneinander liegenden Spalten hatte in
der linken Spalte eine H2 und in der rechten Spalte eine H3 – nicht weil die
rechte Spalte inhaltlich ein Unterpunkt der linken wäre, sondern weil beide
Spalten einfach im selben Abschnitt liegen. Für Screenreader-Nutzer mit
Heading-Navigation suggeriert das fälschlich eine Eltern-Kind-Beziehung
zwischen zwei eigentlich gleichrangigen Themen.

**Erkennung:** nicht nur zählen, ob Heading-Level übersprungen werden,
sondern bei jeder H3 (oder tieferem Level) inhaltlich prüfen: ist das
wirklich ein Unterpunkt der zuletzt vorausgegangenen höheren Überschrift,
oder nur zufällig direkt danach im DOM? Hilfreich: Vergleich mit einer
alternativen Variante desselben Inhalts im selben Theme – gab es dort keine
vergleichbare Überschrift, ist das ein Hinweis, dass sie hier auch nicht
nötig/richtig ist.

**Fix in `restaurant-theme`:** `<h3>` → `<h2>` in
`patterns/about-contact.php` (Info-Block „Öffnungszeiten & Kontakt"), dazu
CSS-Selektor `.info-panel h3` → `.info-panel h2` in `style.css` mit
angepasst, sonst hätte die global viel größere H2-Stildefinition aus
`theme.json` (statt der bewusst kompakten Card-Typografie) gegriffen.

**Status:** in `restaurant-theme` behoben. Im anderen Theme noch zu prüfen
(insbesondere alle Spalten-/Nebeneinander-Layouts mit mehr als einer
Überschrift pro Sektion).
