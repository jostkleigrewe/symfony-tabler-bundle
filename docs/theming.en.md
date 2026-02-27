> 🇩🇪 [Deutsche Version](theming.de.md) | 🇬🇧 **English Version**

# Theming & CSS

This guide covers the bundle's CSS assets, color themes, dark/light mode, and performance considerations.

---

## CSS Files Overview

The bundle provides 4 CSS files in `assets/styles/`:

| File | Size | Purpose |
|------|------|---------|
| `tabler-forms.css` | ~18 KB | Styling for all 5 FormTypes |
| `pattern-backgrounds.css` | ~35 KB | 14 animated background patterns |
| `tabler-themes.css` | ~11 KB | 6 color theme definitions with CSS variables |

---

## Including CSS

### AssetMapper (Recommended)

The bundle auto-registers its asset paths with Symfony AssetMapper. Reference the files directly in your templates:

```twig
{# FormType styling -- include on pages with Tabler forms #}
<link rel="stylesheet" href="{{ asset('@jostkleigrewe/tabler-bundle/styles/tabler-forms.css') }}">

{# Color themes -- include globally for theme support #}
<link rel="stylesheet" href="{{ asset('@jostkleigrewe/tabler-bundle/styles/tabler-themes.css') }}">

{# Pattern backgrounds -- include where patterns are used #}
<link rel="stylesheet" href="{{ asset('@jostkleigrewe/tabler-bundle/styles/pattern-backgrounds.css') }}">
```

### Manual Link Tags

If not using AssetMapper, copy the CSS files from the vendor directory to your `public/` folder:

```bash
cp vendor/jostkleigrewe/symfony-tabler-bundle/assets/styles/*.css public/css/tabler/
```

Then reference them with standard `<link>` tags:

```html
<link rel="stylesheet" href="/css/tabler/tabler-forms.css">
```

### Inline via source() (CSP Compatible)

For strict Content Security Policy setups, you can inline the CSS:

```twig
<style>{{ source('@Tabler/styles/pattern-backgrounds.css') }}</style>
```

---

## Color Themes

The bundle includes 6 built-in color themes defined in `tabler-themes.css`:

| Theme | Name | Primary Color | Description |
|-------|------|---------------|-------------|
| `eurip` | EURIP | `#0f3d91` | Corporate blue (default) |
| `forest` | Forest | `#059669` | Natural green |
| `sunset` | Sunset | `#ea580c` | Warm orange |
| `ocean` | Ocean | `#0891b2` | Deep teal/cyan |
| `purple` | Purple | `#7c3aed` | Royal purple |
| `rose` | Rose | `#e11d48` | Soft pink/rose |

### How Themes Work

Themes are applied via the `data-theme` attribute on the `<html>` element:

```html
<html data-theme="forest">
```

Each theme defines CSS custom properties that override Tabler's default colors:

```css
[data-theme="forest"] {
    --tblr-primary: #059669;
    --tblr-primary-rgb: 5, 150, 105;
    /* ... additional variables */
}
```

### Using the ThemePicker Component

The easiest way to let users select a theme is the [ThemePicker](components.en.md#themepicker) component:

```twig
<twig:Tabler:ThemePicker />
```

This renders a visual palette of all themes. The selection is persisted in localStorage via the [theme Stimulus controller](stimulus-controllers.en.md#theme_controllerjs).

### Creating Custom Themes

Add your own theme by defining CSS variables under a `data-theme` selector:

```css
[data-theme="custom"] {
    --tblr-primary: #ff6600;
    --tblr-primary-rgb: 255, 102, 0;
    --tblr-primary-fg: #ffffff;
    --tblr-primary-darken: #cc5200;
    --tblr-primary-lighten: #ff8533;
}
```

Then add the theme to the ThemePicker's `themes` prop:

```twig
<twig:Tabler:ThemePicker :themes="{
    custom: {label: 'My Theme', color: '#ff6600'},
    eurip: {label: 'EURIP', color: '#0f3d91'},
}" />
```

---

## Dark/Light Mode

The bundle supports three display modes using Bootstrap 5.3+ `data-bs-theme`:

| Mode | Attribute | Behavior |
|------|-----------|----------|
| Light | `data-bs-theme="light"` | Always light |
| Dark | `data-bs-theme="dark"` | Always dark |
| Auto | `data-bs-theme="light"` + `data-theme-mode="auto"` | Follows `prefers-color-scheme` |

### Using the ThemeSwitch Component

Add a toggle to your layout with the [ThemeSwitch](components.en.md#themeswitch) component:

```twig
{# Simple light/dark toggle #}
<twig:Tabler:ThemeSwitch />

{# Three-state slider: light / auto / dark #}
<twig:Tabler:ThemeSwitch variant="tristate" />

{# Click-through cycle: light > dark > auto #}
<twig:Tabler:ThemeSwitch variant="cycle" size="compact" />
```

The selected mode is persisted in localStorage under the key `tabler-theme-mode`.

### Programmatic Mode Switching

The [theme Stimulus controller](stimulus-controllers.en.md#theme_controllerjs) manages mode switching. You can also set the mode directly:

```html
<html data-bs-theme="dark">
```

Or listen for theme changes via the dispatched event:

```javascript
document.addEventListener('theme:themeChanged', (event) => {
    console.log('New theme:', event.detail.theme);
});
```

---

## Pattern Backgrounds

The `pattern-backgrounds.css` file provides 14 animated CSS patterns:

`particles`, `particles-sso`, `particles-network`, `waves`, `geometric`, `blob`, `grid`, `topo`, `dots`, `circuit`, `stream`, `rain`, `sandstorm`, `autumn`.

Use them via the [PatternBackground](components.en.md#patternbackground) component:

```twig
<twig:Tabler:PatternBackground pattern="waves" theme="dark" size="hero" speed="slow">
    <div class="container">
        <h1 class="text-white">Welcome</h1>
    </div>
</twig:Tabler:PatternBackground>
```

See the [PatternBackground component documentation](components.en.md#patternbackground) for all available props and pattern types.

---

## Performance Notes

- **pattern-backgrounds.css** is ~35 KB and contains complex CSS animations. Only include it on pages that actually use pattern backgrounds. Consider lazy-loading it or inlining only the patterns you need.
- **tabler-themes.css** is ~11 KB. Safe to include globally since it only defines CSS variable overrides.
- **tabler-forms.css** is ~18 KB. Include on pages with Tabler form types.

For production, consider extracting only the patterns/themes you use into a smaller custom stylesheet.

## See Also

- [Installation](installation.en.md) -- Including CSS in your project
- [Twig Components](components.en.md) -- ThemeSwitch, ThemePicker, PatternBackground
- [Stimulus Controllers](stimulus-controllers.en.md) -- theme_controller.js internals
- [Showcase](showcase.en.md) -- Live theme and pattern previews
