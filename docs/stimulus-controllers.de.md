> 🇬🇧 [English Version](stimulus-controllers.en.md) | 🇩🇪 **Deutsche Version**

# Stimulus Controller

Das Bundle liefert sechs Stimulus Controller in `assets/controllers/`. Voraussetzung ist das
`symfony/stimulus-bundle` — die Controller werden automatisch erkannt, wenn das StimulusBundle
installiert ist.

```bash
composer require symfony/stimulus-bundle
```

---

## theme_controller.js

Steuert Dark/Light Mode und Farbthema-Wechsel mit localStorage-Persistenz.

- **Fetch:** eager (auf jeder Seite geladen)
- **Verwendet von:** [ThemeSwitch](components.de.md#themeswitch), [ThemePicker](components.de.md#themepicker)

### Values

| Name | Typ | Standard | Beschreibung |
|------|-----|----------|--------------|
| `themes` | Array | `['eurip', 'forest', 'sunset', 'ocean', 'purple', 'rose']` | Verfuegbare Farbthemen |
| `modeStorageKey` | String | `'tabler-theme-mode'` | localStorage-Schluessel fuer Modus |
| `themeStorageKey` | String | `'tabler-theme-color'` | localStorage-Schluessel fuer Farbthema |

### Targets

| Name | Beschreibung |
|------|--------------|
| `option` | Mode-Buttons (light/dark/auto) |
| `label` | Text-Label fuer aktuellen Modus |
| `icon` | Icon fuer aktuellen Modus |
| `indicator` | Visueller Indikator fuer Tristate |
| `themeOption` | Theme-Auswahl-Buttons |
| `currentTheme` | Text-Anzeige des aktuellen Themes |

### Actions

| Name | Beschreibung |
|------|--------------|
| `choose` | Modus waehlen via `data-theme-value` (light/dark/auto) |
| `toggle` | Zwischen Light und Dark umschalten |
| `cycle` | Zyklisch: Light, Dark, Auto, Light... |
| `selectTheme` | Farbthema waehlen via `data-theme` |

### Events

| Name | Detail | Beschreibung |
|------|--------|--------------|
| `theme:themeChanged` | `{ theme }` | Wird bei jedem Theme-Wechsel ausgeloest |

### HTML-Attribute

Der Controller setzt folgende Attribute auf `<html>`:

- `data-bs-theme` — `light` oder `dark` (Bootstrap 5.3+ kompatibel)
- `data-theme-mode` — `auto` (nur im Auto-Modus gesetzt)
- `data-theme` — Name des Farbthemas (z.B. `eurip`, `forest`)

### Beispiel

```html
<div data-controller="theme"
     data-theme-themes-value='["eurip","forest","sunset"]'>
    <button data-action="click->theme#toggle">Theme umschalten</button>
    <button data-action="click->theme#selectTheme" data-theme="forest">Forest</button>
</div>
```

---

## clipboard_controller.js

Generische Copy-to-Clipboard Funktionalitaet mit Browser-Fallback fuer aeltere Browser.

- **Fetch:** lazy
- **Verwendet von:** [CodeBlock](components.de.md#codeblock)

### Values

| Name | Typ | Standard | Beschreibung |
|------|-----|----------|--------------|
| `text` | String | `''` | Direkt zu kopierender Text |
| `separator` | String | `''` | Trennzeichen, das durch Zeilenumbrueche ersetzt wird |
| `successText` | String | `'Kopiert!'` | Erfolgs-Feedback-Text |
| `successDuration` | Number | `2000` | Dauer des Feedback in Millisekunden |

### Targets

| Name | Beschreibung |
|------|--------------|
| `source` | Element mit dem zu kopierenden Inhalt |
| `sourceCurl` | Alternative Source fuer cURL-Modus |
| `button` | Copy-Button fuer Button-Feedback |
| `icon` | Icon im Button fuer Icon-Feedback |
| `text` | Text im Button fuer Text-Feedback |

### Actions

| Name | Parameter | Beschreibung |
|------|-----------|--------------|
| `copy` | `mode`: `code` oder `curl` | Kopiert Inhalt in die Zwischenablage |

### Beispiel

```html
<div data-controller="clipboard">
    <pre data-clipboard-target="source">npm install @tabler/core</pre>
    <button data-action="click->clipboard#copy">
        <i data-clipboard-target="icon" class="ti ti-copy"></i>
        <span data-clipboard-target="text">Kopieren</span>
    </button>
</div>
```

---

## sidebar_controller.js

Sidebar ein-/ausklappen mit mobilem Backdrop und localStorage-Persistenz.

- **Fetch:** lazy

### Values

| Name | Typ | Standard | Beschreibung |
|------|-----|----------|--------------|
| `storageKey` | String | `'tabler-sidebar-state'` | localStorage-Schluessel |
| `menuId` | String | `'sidebar-menu'` | ID des Sidebar-Menue-Elements |
| `collapsedClass` | String | `'sidebar-collapsed'` | CSS-Klasse fuer eingeklappten Zustand |
| `breakpoint` | Number | `992` | Breakpoint fuer Mobile/Desktop in Pixeln |

### Actions

| Name | Beschreibung |
|------|--------------|
| `toggle` | Sidebar ein-/ausklappen |
| `expand` | Sidebar ausklappen |
| `collapse` | Sidebar einklappen |

### Beispiel

```html
<body data-controller="sidebar"
      data-sidebar-storage-key-value="my-app-sidebar"
      data-sidebar-menu-id-value="sidebar-menu">

    <button data-action="click->sidebar#toggle">
        <i class="ti ti-menu-2"></i>
    </button>

    <aside class="navbar navbar-vertical">
        <div id="sidebar-menu" class="collapse navbar-collapse">
            <!-- Navigation -->
        </div>
    </aside>
</body>
```

Der Controller erstellt automatisch einen Backdrop auf mobilen Geraeten und schliesst
die Sidebar bei Klick auf einen Navigationslink.

---

## modal-frame_controller.js

Laedt Modal-Inhalte dynamisch via `fetch`. Loest das Problem, dass Bootstrap Modal und
Turbo Frame nicht gut zusammenarbeiten.

- **Fetch:** lazy

### Values

| Name | Typ | Standard | Beschreibung |
|------|-----|----------|--------------|
| `modal` | String | *(erforderlich)* | CSS-Selektor fuer das Modal-Element |
| `container` | String | *(erforderlich)* | ID des Content-Containers im Modal |
| `loadingHtml` | String | *(Spinner)* | Benutzerdefiniertes Loading-HTML |

### Actions

| Name | Beschreibung |
|------|--------------|
| `open` | Modal oeffnen und Content von `href` laden |

### Events

| Name | Detail | Beschreibung |
|------|--------|--------------|
| `modal-frame:loaded` | `{ url, container }` | Wird nach erfolgreichem Laden ausgeloest |

### Beispiel

```html
<a href="/users/42/details"
   data-controller="modal-frame"
   data-modal-frame-modal-value="#detailModal"
   data-modal-frame-container-value="modal-content"
   data-action="click->modal-frame#open">
    Details anzeigen
</a>

<div class="modal" id="detailModal">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content">
            <!-- Wird dynamisch geladen -->
        </div>
    </div>
</div>
```

---

## required_checkbox_controller.js

Verhindert das Abwaehlen von Pflicht-Checkboxen. Wird automatisch von `ChoiceCardType` und
`EntityCardType` verwendet, wenn `data-required="1"` gesetzt ist.

- **Fetch:** lazy
- **Verwendet von:** [ChoiceCardType](form-types.de.md#choicecardtype), [EntityCardType](form-types.de.md#entitycardtype) (bei `data-required`)

### Targets

| Name | Beschreibung |
|------|--------------|
| `checkbox` | Die Checkbox, die nicht abgewaehlt werden darf |

### Actions

| Name | Beschreibung |
|------|--------------|
| `prevent` | Verhindert Klick, wenn Checkbox bereits aktiviert ist |
| `enforce` | Stellt sicher, dass die Checkbox aktiviert bleibt |

### Beispiel

```html
<label data-controller="required-checkbox">
    <input type="checkbox"
           data-required-checkbox-target="checkbox"
           data-action="click->required-checkbox#prevent"
           checked>
    Pflicht-Option (kann nicht abgewaehlt werden)
</label>
```

---

## collapsible_controller.js

Aufklappbare Panels mit ARIA-Unterstuetzung und Chevron-Animation.

- **Fetch:** lazy
- **Verwendet von:** [CollapsiblePanel](components.de.md#collapsiblepanel)

### Values

| Name | Typ | Standard | Beschreibung |
|------|-----|----------|--------------|
| `expanded` | Boolean | `false` | Initialer Zustand |

### Targets

| Name | Beschreibung |
|------|--------------|
| `button` | Toggle-Button (bekommt `aria-expanded`) |
| `content` | Inhaltselement (wird ein-/ausgeblendet) |
| `chevron` | Chevron-Icon (wird rotiert) |

### Actions

| Name | Beschreibung |
|------|--------------|
| `toggle` | Zustand umschalten |
| `expand` | Panel ausklappen |
| `collapse` | Panel einklappen |

### Beispiel

```html
<div data-controller="collapsible" data-collapsible-expanded-value="false">
    <button data-collapsible-target="button" data-action="click->collapsible#toggle">
        Mehr anzeigen
        <i data-collapsible-target="chevron" class="ti ti-chevron-down"></i>
    </button>
    <div data-collapsible-target="content" class="d-none">
        <p>Versteckter Inhalt...</p>
    </div>
</div>
```

---

## Siehe auch

- [Twig-Komponenten](components.de.md) — Komponenten, die diese Controller intern nutzen
- [Installationsanleitung](installation.de.md) — Stimulus-Setup
- [Theming & CSS](theming.de.md) — Theme Controller im Kontext
