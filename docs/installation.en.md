> 🇩🇪 [Deutsche Version](installation.de.md) | 🇬🇧 **English Version**

# Installation

This guide covers how to install and configure the Symfony Tabler Bundle in your application.

## Requirements

- PHP >= 8.4
- Symfony 7.0+ or 8.0+
- Tabler CSS and Icons (installed separately by the host application)

## 1. Install the Bundle

```bash
composer require jostkleigrewe/symfony-tabler-bundle
```

If your project uses **Symfony Flex**, the bundle is registered automatically. Otherwise, add it manually to `config/bundles.php`:

```php
return [
    // ...
    Jostkleigrewe\TablerBundle\TablerBundle::class => ['all' => true],
];
```

## 2. Install Tabler (Required)

The bundle does **not** ship Tabler CSS or Icons. Install them in your host application:

```bash
npm install @tabler/core @tabler/icons-webfont
```

Include Tabler in your base template (`templates/base.html.twig`):

```twig
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('node_modules/@tabler/core/dist/css/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/@tabler/icons-webfont/dist/tabler-icons.min.css') }}">
    {% block stylesheets %}{% endblock %}
</head>
<body>
    {% block body %}{% endblock %}
    <script src="{{ asset('node_modules/@tabler/core/dist/js/tabler.min.js') }}"></script>
    {% block javascripts %}{% endblock %}
</body>
</html>
```

Adjust the asset paths depending on your build setup (AssetMapper, Webpack Encore, or Vite).

## 3. Register Form Themes

To use the bundle's FormTypes, register their Twig themes in `config/packages/twig.yaml`:

```yaml
twig:
    form_themes:
        - 'bootstrap_5_layout.html.twig'
        - '@Tabler/form/floating_underline.html.twig'
        - '@Tabler/form/switch.html.twig'
        - '@Tabler/form/choice_card.html.twig'
        - '@Tabler/form/card_select.html.twig'
```

The `bootstrap_5_layout.html.twig` theme is recommended as a base since Tabler builds on Bootstrap 5.

## 4. Include Bundle CSS

The bundle provides 4 CSS files in `assets/styles/`:

| File | Size | Purpose |
|------|------|---------|
| `tabler-forms.css` | ~18 KB | Styling for all 5 FormTypes |
| `pattern-backgrounds.css` | ~35 KB | 14 animated background patterns |
| `tabler-themes.css` | ~11 KB | 6 color theme definitions |

### Method A: AssetMapper (Recommended)

The bundle auto-registers its assets with AssetMapper when `symfony/asset-mapper` is installed. Use them directly in your templates:

```twig
{# FormType styling (include on pages with forms) #}
<link rel="stylesheet" href="{{ asset('@jostkleigrewe/tabler-bundle/styles/tabler-forms.css') }}">

{# Color themes (include globally) #}
<link rel="stylesheet" href="{{ asset('@jostkleigrewe/tabler-bundle/styles/tabler-themes.css') }}">

{# Pattern backgrounds (include where needed) #}
<link rel="stylesheet" href="{{ asset('@jostkleigrewe/tabler-bundle/styles/pattern-backgrounds.css') }}">
```

### Method B: Manual Copy

Copy the CSS files from `vendor/jostkleigrewe/symfony-tabler-bundle/assets/styles/` to your `public/` directory and reference them with standard `<link>` tags.

### Method C: Webpack Encore / Vite

Import the CSS files in your JavaScript entry point or add them to your build configuration.

## 5. Stimulus Controllers (Optional)

The bundle ships 6 Stimulus controllers for interactive features (theme switching, clipboard, sidebar, etc.). They are auto-discovered when `symfony/stimulus-bundle` is installed.

```bash
composer require symfony/stimulus-bundle
```

No additional configuration is needed. See the [Stimulus Controllers documentation](stimulus-controllers.en.md) for details on each controller.

## 6. Showcase Routes (Optional)

The bundle includes a built-in showcase demonstrating all components and form types. To enable it, import the routes in `config/routes/tabler.yaml`:

```yaml
tabler_bundle:
    resource: '@TablerBundle/config/routes.yaml'
```

The showcase is then available at `/tabler/showcase`. See the [Showcase documentation](showcase.en.md) for details.

## Troubleshooting

**Missing Tabler CSS:** If components render without styling, verify that `@tabler/core` CSS is loaded in your base template before the bundle's CSS files.

**Icons not showing:** Ensure `@tabler/icons-webfont` is installed and its CSS is included. Icons use the `ti ti-{name}` class pattern.

**AssetMapper not finding bundle assets:** The bundle registers its paths automatically via `prependExtension()`. If assets are not found, check that `symfony/asset-mapper` is installed and clear the cache with `bin/console cache:clear`.

**Form themes not applied:** Verify that the form themes are listed in `config/packages/twig.yaml` under `twig.form_themes` and that the `@Tabler` namespace is resolvable.

## See Also

- [Form Types](form-types.en.md) -- All 5 FormTypes with examples
- [Twig Components](components.en.md) -- All 15 TwigComponents
- [Stimulus Controllers](stimulus-controllers.en.md) -- 6 JavaScript controllers
- [Theming & CSS](theming.en.md) -- Dark/light mode, color themes, patterns
- [Card Data Attributes](data-attributes.en.md) -- Reference for card-based FormTypes
- [Showcase](showcase.en.md) -- Built-in demo pages
