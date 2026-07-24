# Schriftarten (lokal, DSGVO-konform)

Die fünf benötigten `.woff2`-Dateien liegen bereits in diesem Ordner –
keine weitere Aktion nötig. Das Theme lädt keine Fonts von externen
Servern (kein Google-Fonts-CDN, keine Laufzeit-Verbindung zu Google).

## Enthaltene Dateien

```
figtree-400.woff2          Figtree Regular      – Fließtext
figtree-500.woff2          Figtree Medium       – Navigation, Filter, Labels
figtree-600.woff2          Figtree SemiBold     – Buttons, Preise, Telefonnummer
fraunces-600.woff2         Fraunces 72pt Soft SemiBold        – Überschriften h1–h3
fraunces-600-italic.woff2  Fraunces 72pt Soft SemiBold Italic – Zitat-Akzent
```

Für die Überschriften wurde bewusst die **Soft-Variante** von Fraunces
gewählt (nicht der Standard-Schnitt) – rundere, wärmere Anmutung, passend
zum familiären Charakter des Themes statt zum strengeren Editorial-Look
des Standard-Schnitts.

## Zeichensatz

Aktuell ausschließlich **deutsches Zeichenrepertoire** (ca. 80 KB gesamt,
alle fünf Dateien zusammen):

- Basic Latin + Latin-1 Supplement (deckt ä ö ü ß und alle deutschen
  Sonderzeichen ab)
- Allgemeine Interpunktion (– „ " … etc.), Euro-Zeichen

Bewusst **kein** erweitertes Zeichenrepertoire für andere Sprachen
(z. B. Vietnamesisch) mehr enthalten – auf Wunsch entfernt, da die
Inhalte vorerst rein deutsch gepflegt werden.

## Später wieder mehrsprachig?

Falls doch fremdsprachiger Text mit Sonderzeichen dazukommt (z. B.
vietnamesische Gerichtnamen mit Diakritika), müssen die Fonts neu
subgesettet werden – sonst fällt der Browser für die fehlenden Zeichen
auf eine System-Schrift zurück, was innerhalb eines Wortes sichtbar
inkonsistent aussieht. Vorgehen: Google-Fonts-Paket (Figtree, Fraunces)
erneut besorgen und mit einem breiteren Unicode-Bereich subsetten:

```bash
pip install fonttools brotli --break-system-packages

pyftsubset Figtree-Regular.ttf \
  --unicodes="U+0000-00FF,U+0100-017F,U+0300-036F,U+1E00-1EFF,U+2000-206F,U+20AC" \
  --flavor=woff2 \
  --output-file=figtree-400.woff2
```

Der zusätzliche Bereich `U+1E00-1EFF` (Latin Extended Additional) deckt
vietnamesische Diakritika ab, `U+0300-036F` kombinierende Akzentzeichen.

## Andere Schriftfamilie verwenden

Dateien ersetzen und in `theme.json` unter
`settings.typography.fontFamilies` `name`, `fontFamily` und
`src`-Pfade anpassen. Der Rest des Themes referenziert nur die Slugs
`body` und `display`, es muss sonst nichts angefasst werden.
