> 🇩🇪 [Deutsche Version](showcase.de.md) | 🇬🇧 **English Version**

# Showcase / Demo

The bundle includes a built-in showcase that demonstrates all components, form types, patterns, and themes in a live environment. It serves as both a visual reference and a development aid.

---

## What the Showcase Provides

The showcase is a set of pre-built pages rendered by `ShowcaseController` that display every bundle feature with real examples. It covers:

- All 5 FormTypes with interactive forms
- All 15 TwigComponents in various configurations
- All 14 animated background patterns
- All 6 color themes with live switching
- PageHeader variants (default, bordered, compact)
- Stimulus controller documentation and demos

---

## Enabling the Showcase

### Step 1: Import Routes

Create or edit `config/routes/tabler.yaml` in your host application:

```yaml
tabler_bundle:
    resource: '@TablerBundle/config/routes.yaml'
```

This registers all showcase routes under the `/tabler/showcase` prefix.

### Step 2: Ensure Tabler CSS is Loaded

The showcase templates extend your application's `base.html.twig`. This means Tabler CSS and Icons must be installed and included in your base template. See the [Installation Guide](installation.en.md) for details.

---

## Available Pages

| Route | URL | Description |
|-------|-----|-------------|
| `tabler_showcase_index` | `/tabler/showcase` | Overview dashboard with StatCards |
| `tabler_showcase_form_types` | `/tabler/showcase/form-types` | All 5 FormTypes with examples |
| `tabler_showcase_components` | `/tabler/showcase/components` | All 15 TwigComponents |
| `tabler_showcase_page_headers` | `/tabler/showcase/page-headers` | PageHeader variants and configurations |
| `tabler_showcase_patterns` | `/tabler/showcase/patterns` | 14 animated background patterns |
| `tabler_showcase_themes` | `/tabler/showcase/themes` | 6 color themes with live preview |
| `tabler_showcase_controllers` | `/tabler/showcase/controllers` | Stimulus controller documentation |

Each controller detail page is available at `/tabler/showcase/controllers/{key}` where `{key}` is one of: `theme`, `clipboard`, `sidebar`, `modal-frame`, `required-checkbox`.

---

## Template Structure

Showcase templates are located in the bundle at `templates/showcase/`:

```
templates/showcase/
    index.html.twig          -- Dashboard overview
    form_types.html.twig     -- FormType demos
    components.html.twig     -- TwigComponent demos
    page_headers.html.twig   -- PageHeader variants
    patterns.html.twig       -- Pattern background gallery
    themes.html.twig         -- Color theme previews
    layout.html.twig         -- Shared layout (extends base.html.twig)
    controllers/
        index.html.twig      -- Controller overview
        detail.html.twig     -- Individual controller page
```

All showcase pages extend `base.html.twig` from the host application via a shared `layout.html.twig`. This ensures the showcase uses your application's Tabler installation and styling.

---

## Production Considerations

The showcase is intended for development and review purposes. In production, you may want to:

- **Not import the routes at all** -- simply omit the `config/routes/tabler.yaml` file.
- **Restrict access** -- if you do import the routes, use Symfony's security configuration to limit access:

```yaml
# config/packages/security.yaml
security:
    access_control:
        - { path: ^/tabler/showcase, roles: ROLE_ADMIN }
```

- **Environment-specific import** -- create the route file only for dev:

```yaml
# config/routes/dev/tabler.yaml
tabler_bundle:
    resource: '@TablerBundle/config/routes.yaml'
```

---

## Using the Showcase for Development

The showcase is useful when:

- **Evaluating the bundle** before integrating it into your project
- **Checking component rendering** after installing Tabler CSS updates
- **Referencing prop names and variants** while building your own templates
- **Testing theme compatibility** with your application's base template

You can also use individual showcase templates as starting points for your own pages.

## See Also

- [Installation](installation.en.md) -- Setting up Tabler CSS and bundle routes
- [Form Types](form-types.en.md) -- Detailed FormType documentation
- [Twig Components](components.en.md) -- All 15 component references
- [Theming & CSS](theming.en.md) -- Color themes and dark/light mode
- [Stimulus Controllers](stimulus-controllers.en.md) -- JavaScript controller details
- [Card Data Attributes](data-attributes.en.md) -- Data attribute reference for card types
