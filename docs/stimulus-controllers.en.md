> 🇩🇪 [Deutsche Version](stimulus-controllers.de.md) | 🇬🇧 **English Version**

# Stimulus Controllers

The bundle ships 6 Stimulus controllers in `assets/controllers/`. They are auto-discovered when `symfony/stimulus-bundle` is installed -- no additional configuration is needed.

---

## theme_controller.js

Dark/light mode switching and color theme selection with localStorage persistence.

**Fetch:** eager (loaded on every page)

### Values

| Name | Type | Default | Description |
|------|------|---------|-------------|
| `themes` | Array | `['eurip', 'forest', 'sunset', 'ocean', 'purple', 'rose']` | Available theme names |
| `modeStorageKey` | String | `'tabler-theme-mode'` | localStorage key for mode |
| `themeStorageKey` | String | `'tabler-theme-color'` | localStorage key for color theme |

### Targets

| Name | Description |
|------|-------------|
| `option` | Mode buttons (light/dark/auto) |
| `label` | Text label for current mode |
| `icon` | Icon element for current mode |
| `indicator` | Visual indicator for tristate slider |
| `themeOption` | Theme selection buttons |
| `currentTheme` | Text display of current theme name |

### Actions

| Name | Description |
|------|-------------|
| `choose` | Select mode via `data-theme-value` attribute (light/dark/auto) |
| `toggle` | Switch between light and dark |
| `cycle` | Cycle through light, dark, auto |
| `selectTheme` | Choose color theme via `data-theme` attribute |

### Events

| Name | Detail | Description |
|------|--------|-------------|
| `theme:themeChanged` | `{theme}` | Dispatched when the color theme changes |

### HTML Attributes Set

- `data-bs-theme` on `<html>` -- resolved mode (`light` or `dark`)
- `data-theme-mode` on `<html>` -- set to `auto` when auto mode is active
- `data-theme` on `<html>` -- current color theme name

**Used by:** [ThemeSwitch](components.en.md#themeswitch), [ThemePicker](components.en.md#themepicker)

---

## clipboard_controller.js

Copy-to-clipboard with visual feedback and a fallback for older browsers.

**Fetch:** lazy

### Values

| Name | Type | Default | Description |
|------|------|---------|-------------|
| `text` | String | `''` | Static text to copy (overrides source target) |
| `separator` | String | `''` | Separator for joining multiple source elements |
| `successText` | String | `'Kopiert!'` | Feedback text after copy |
| `successDuration` | Number | `2000` | Duration of feedback in milliseconds |

### Targets

| Name | Description |
|------|-------------|
| `source` | Element containing the content to copy |
| `sourceCurl` | Alternative source element for cURL mode |
| `button` | Copy button (receives feedback styling) |
| `icon` | Icon inside the button (swapped during feedback) |
| `text` | Text inside the button (swapped during feedback) |

### Actions

| Name | Description |
|------|-------------|
| `copy` | Copy content to clipboard. Supports `mode` param: `code` (default) or `curl` |

### Example

```html
<div data-controller="clipboard">
    <pre data-clipboard-target="source">composer require jostkleigrewe/symfony-tabler-bundle</pre>
    <button data-action="clipboard#copy" data-clipboard-target="button">
        <i class="ti ti-copy" data-clipboard-target="icon"></i>
        <span data-clipboard-target="text">Copy</span>
    </button>
</div>
```

**Used by:** [CodeBlock](components.en.md#codeblock)

---

## sidebar_controller.js

Sidebar collapse/expand with mobile backdrop and localStorage persistence.

**Fetch:** lazy

### Values

| Name | Type | Default | Description |
|------|------|---------|-------------|
| `storageKey` | String | `'tabler-sidebar-state'` | localStorage key |
| `menuId` | String | `'sidebar-menu'` | ID of the sidebar menu element |
| `collapsedClass` | String | `'sidebar-collapsed'` | CSS class applied when collapsed |
| `breakpoint` | Number | `992` | Pixel width below which mobile mode activates |

### Actions

| Name | Description |
|------|-------------|
| `toggle` | Toggle sidebar collapsed/expanded |
| `expand` | Expand the sidebar |
| `collapse` | Collapse the sidebar |

### Example

```html
<body data-controller="sidebar">
    <button data-action="sidebar#toggle">Toggle Sidebar</button>
    <aside id="sidebar-menu">
        <!-- Sidebar content -->
    </aside>
</body>
```

---

## modal-frame_controller.js

Load modal content dynamically via `fetch`. Compatible with Turbo.

**Fetch:** lazy

### Values

| Name | Type | Default | Description |
|------|------|---------|-------------|
| `modal` | String | *(required)* | CSS selector for the modal element |
| `container` | String | *(required)* | CSS selector for the content container inside the modal |
| `loadingHtml` | String | *(spinner)* | HTML shown while loading |

### Actions

| Name | Description |
|------|-------------|
| `open` | Open the modal and load content from the link's `href` |

### Events

| Name | Description |
|------|-------------|
| `modal-frame:loaded` | Dispatched after content is successfully loaded |

### Example

```html
<div data-controller="modal-frame"
     data-modal-frame-modal-value="#my-modal"
     data-modal-frame-container-value="#my-modal .modal-body">
    <a href="/users/42/details"
       data-action="click->modal-frame#open"
       data-turbo-frame="_top">
        View Details
    </a>
</div>

<div class="modal" id="my-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body"><!-- loaded here --></div>
        </div>
    </div>
</div>
```

---

## required_checkbox_controller.js

Prevents unchecking required checkboxes in card-based form types.

**Fetch:** lazy

### Targets

| Name | Description |
|------|-------------|
| `checkbox` | The checkbox input that must remain checked |

### Actions

| Name | Description |
|------|-------------|
| `prevent` | Prevents click event if checkbox is currently checked |
| `enforce` | Ensures the checkbox stays in checked state |

### Example

```html
<div data-controller="required-checkbox">
    <input type="checkbox"
           data-required-checkbox-target="checkbox"
           data-action="click->required-checkbox#prevent change->required-checkbox#enforce"
           checked>
    <label>Required Option (cannot be deselected)</label>
</div>
```

**Used by:** [ChoiceCardType](form-types.en.md#choicecardtype) and [EntityCardType](form-types.en.md#entitycardtype) when a choice has `data-required="1"`.

---

## collapsible_controller.js

Collapsible panel state management with ARIA attribute updates and chevron animation.

**Fetch:** lazy

### Values

| Name | Type | Default | Description |
|------|------|---------|-------------|
| `expanded` | Boolean | `false` | Initial expanded state |

### Targets

| Name | Description |
|------|-------------|
| `button` | Toggle button (receives `aria-expanded` attribute) |
| `content` | Collapsible content container |
| `chevron` | Chevron icon (rotated 180 degrees when expanded) |

### Actions

| Name | Description |
|------|-------------|
| `toggle` | Toggle between expanded and collapsed |
| `expand` | Force expand |
| `collapse` | Force collapse |

### Example

```html
<div data-controller="collapsible" data-collapsible-expanded-value="false">
    <button data-action="collapsible#toggle"
            data-collapsible-target="button"
            aria-expanded="false">
        Toggle Section
        <i class="ti ti-chevron-down" data-collapsible-target="chevron"></i>
    </button>
    <div data-collapsible-target="content" class="d-none">
        <p>Collapsible content here...</p>
    </div>
</div>
```

**Used by:** [CollapsiblePanel](components.en.md#collapsiblepanel)

## See Also

- [Installation](installation.en.md) -- Stimulus setup with `symfony/stimulus-bundle`
- [Twig Components](components.en.md) -- Components that use these controllers
- [Theming & CSS](theming.en.md) -- Theme system powered by the theme controller
