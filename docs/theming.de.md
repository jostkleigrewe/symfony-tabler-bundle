> 🇬🇧 [English Version](theming.en.md) | 🇩🇪 **Deutsche Version**

# Theming & CSS

Das Bundle liefert vier CSS-Dateien, sechs Farbthemen und volle Unterstuetzung fuer Dark/Light
Mode. Dieser Abschnitt erklaert die CSS-Architektur und wie Themes angepasst werden koennen.

---

## CSS-Dateien Uebersicht

| Datei | Groesse | Zweck |
|-------|---------|-------|
| `tabler-forms.css` | ~18 KB | Styling fuer alle 5 FormTypes |
| `pattern-backgrounds.css` | ~35 KB | 14 animierte Hintergrund-Muster |
| `tabler-themes.css` | ~11 KB | 6 Farbthemen mit CSS-Variablen |

Alle Dateien liegen unter `assets/styles/` im Bundle-Verzeichnis.

---

## CSS einbinden

### AssetMapper (empfohlen)

Das Bundle registriert seine Assets automatisch im AssetMapper. Die Pfade werden in
`TablerBundle::prependExtension()` konfiguriert — es ist keine manuelle Konfiguration noetig.

```twig
{# FormType-Styling (fuer alle 5 FormTypes) #}
<link rel="stylesheet" href="{{ asset('@jostkleigrewe/tabler-bundle/styles/tabler-forms.css') }}">

{# Farbthemen (6 Themes + CSS-Variablen) #}
<link rel="stylesheet" href="{{ asset('@jostkleigrewe/tabler-bundle/styles/tabler-themes.css') }}">

{# Hintergrund-Muster (optional, 35 KB) #}
<link rel="stylesheet" href="{{ asset('@jostkleigrewe/tabler-bundle/styles/pattern-backgrounds.css') }}">
```

### Manuell per Link-Tag

Falls kein AssetMapper verwendet wird, koennen die CSS-Dateien aus dem Vendor-Verzeichnis kopiert
und direkt eingebunden werden:

```twig
<link rel="stylesheet" href="{{ asset('css/tabler-forms.css') }}">
```

### Inline per source() (CSP-kompatibel)

Fuer strikte Content-Security-Policies ohne `style-src 'unsafe-inline'` kann CSS inline
eingebettet werden:

```twig
<style>{{ source('@Tabler/styles/pattern-backgrounds.css.twig') }}</style>
```

---

## Farbthemen

Das Bundle liefert sechs Farbthemen, die ueber das `data-theme` Attribut auf `<html>` angewendet
werden:

| Theme | Primaerfarbe | Beschreibung |
|-------|-------------|--------------|
| `eurip` | `#0f3d91` | Corporate Blue — das Standard-Theme |
| `forest` | `#059669` | Natuerliches Gruen |
| `sunset` | `#ea580c` | Warme Orange/Rot-Toene |
| `ocean` | `#0891b2` | Tiefes Teal/Cyan |
| `purple` | `#7c3aed` | Royales Lila |
| `rose` | `#e11d48` | Softes Pink |

Jedes Theme definiert CSS-Variablen wie `--tblr-primary`, `--tblr-primary-rgb` und weitere.
Die Aktivierung erfolgt durch Setzen des Attributs:

```html
<html data-theme="forest">
```

### Theme-Auswahl per Komponente

Am einfachsten laesst sich die Theme-Auswahl ueber die eingebauten Komponenten integrieren:

```twig
{# Vollstaendiger Theme-Picker mit Mode-Toggle und Farbauswahl #}
<twig:Tabler:ThemePicker />

{# Nur Farbauswahl ohne Mode-Toggle #}
<twig:Tabler:ThemePicker :showModeToggle="false" />
```

Beide Komponenten nutzen den `theme` Stimulus Controller und speichern die Auswahl in localStorage.

---

## Dark/Light Mode

Der Dark/Light Mode verwendet das Bootstrap 5.3+ Attribut `data-bs-theme` auf `<html>`:

```html
<html data-bs-theme="light">  {# oder "dark" #}
```

### Drei Modi

- **Light:** Helles Theme (`data-bs-theme="light"`)
- **Dark:** Dunkles Theme (`data-bs-theme="dark"`)
- **Auto:** Respektiert `prefers-color-scheme` des Betriebssystems; setzt zusaetzlich
  `data-theme-mode="auto"` auf `<html>`

### Speicherung

Der Modus wird in localStorage gespeichert (Standard-Schluessel: `tabler-theme-mode`).
Beim naechsten Seitenaufruf wird der gespeicherte Modus automatisch wiederhergestellt.

### Komponenten fuer Mode-Wechsel

```twig
{# Einfacher Light/Dark Toggle #}
<twig:Tabler:ThemeSwitch />

{# Drei-Positionen-Slider: Light / Auto / Dark #}
<twig:Tabler:ThemeSwitch variant="tristate" />

{# Durchklicken: Light, Dark, Auto, Light... #}
<twig:Tabler:ThemeSwitch variant="cycle" />
```

---

## Eigene Themes erstellen

Ein eigenes Theme kann durch Definition der CSS-Variablen erstellt werden. Die Struktur folgt
dem Tabler-Pattern:

```css
[data-theme="custom"] {
    --tblr-primary: #e63946;
    --tblr-primary-rgb: 230, 57, 70;
    --tblr-primary-fg: #ffffff;
    --tblr-primary-darken: #b82e38;
    --tblr-primary-lighten: #ff4d5e;
}
```

Das Theme wird aktiviert durch:

```html
<html data-theme="custom">
```

Um es in den ThemePicker zu integrieren, kann das `themes`-Property ueberschrieben werden:

```twig
<twig:Tabler:ThemePicker :themes="{
    custom: {label: 'Mein Theme', color: '#e63946'},
    eurip: {label: 'EURIP', color: '#0f3d91'},
    forest: {label: 'Forest', color: '#059669'}
}" />
```

---

## Pattern-Hintergruende

Das Bundle bietet 14 animierte Hintergrund-Muster ueber die
[PatternBackground](components.de.md#patternbackground) Komponente. Das zugehoerige CSS befindet
sich in `pattern-backgrounds.css` (~35 KB).

Verfuegbare Muster: `particles`, `particles-sso`, `particles-network`, `waves`, `geometric`,
`blob`, `grid`, `topo`, `dots`, `circuit`, `stream`, `rain`, `sandstorm`, `autumn`.

```twig
<twig:Tabler:PatternBackground pattern="waves" theme="dark" size="hero">
    <div class="container text-center text-white py-5">
        <h1>Hero Section</h1>
    </div>
</twig:Tabler:PatternBackground>
```

---

## Performance-Hinweise

- **pattern-backgrounds.css** ist mit ~35 KB die groesste CSS-Datei. Sie sollte nur eingebunden
  werden, wenn die `PatternBackground`-Komponente tatsaechlich verwendet wird.
- Lazy Loading fuer Pattern-CSS: Die Datei kann per `media="print" onload="this.media='all'"`
  geladen werden, um den initialen Seitenaufbau nicht zu blockieren.
- **tabler-themes.css** und **tabler-forms.css** sind fuer die Grundfunktionalitaet relevant
  und sollten frueh im `<head>` eingebunden werden.
- Die `speed="static"` Option der PatternBackground-Komponente deaktiviert Animationen
  und reduziert die GPU-Last.

---

## Siehe auch

- [Twig-Komponenten](components.de.md) — ThemeSwitch, ThemePicker, PatternBackground
- [Stimulus Controller](stimulus-controllers.de.md#theme_controllerjs) — Theme Controller Details
- [Installationsanleitung](installation.de.md#5-css-dateien-einbinden) — CSS einbinden
- [Showcase / Demo](showcase.de.md) — Themes und Patterns live ansehen
