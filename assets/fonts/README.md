# Fonts (local, GDPR-compliant)

The five required `.woff2` files are already in this folder –
no further action is needed. The theme loads no fonts from external
servers (no Google Fonts CDN, no runtime connection to Google).

## Included files

```
figtree-400.woff2          Figtree Regular      – body text
figtree-500.woff2          Figtree Medium       – navigation, filters, labels
figtree-600.woff2          Figtree SemiBold     – buttons, prices, phone numbers
fraunces-600.woff2         Fraunces 72pt Soft SemiBold        – headings h1–h3
fraunces-600-italic.woff2  Fraunces 72pt Soft SemiBold Italic – quote accent
```

For the headings, the **soft version** of Fraunces was intentionally chosen
(instead of the default cut) – a rounder, warmer look that fits the
family-oriented character of the theme better than the stricter editorial
style of the default cut.

## Character set

Currently only a **German character repertoire** is included (about 80 KB in total,
for all five files combined):

- Basic Latin + Latin-1 Supplement (covers accented Latin characters and other German
  special characters)
- General punctuation (– „ " … etc.), euro sign

No extended character repertoire for other languages is included by design
(e.g. Vietnamese) – if needed, it can be removed because the content is
currently maintained in English only.

## Later again for multilingual use?

If foreign-language text with special characters is added later (e.g.
Vietnamese dish names with diacritics), the fonts need to be subset again –
otherwise the browser falls back to a system font for the missing characters,
which can look visibly inconsistent within a word. Approach: fetch the Google
Fonts package again (Figtree, Fraunces) and subset it with a broader Unicode
range:

```bash
pip install fonttools brotli --break-system-packages

pyftsubset Figtree-Regular.ttf \
  --unicodes="U+0000-00FF,U+0100-017F,U+0300-036F,U+1E00-1EFF,U+2000-206F,U+20AC" \
  --flavor=woff2 \
  --output-file=figtree-400.woff2
```

The additional range `U+1E00-1EFF` (Latin Extended Additional) covers
Vietnamese diacritics, and `U+0300-036F` covers combining accent marks.

## Use another font family

Replace the files and adjust `name`, `fontFamily`, and `src` paths in
`theme.json` under `settings.typography.fontFamilies`. The rest of the theme
only references the slugs `body` and `display`, so nothing else needs to be changed.
