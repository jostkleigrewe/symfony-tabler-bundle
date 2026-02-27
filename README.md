# Tabler Bundle for Symfony

[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D8.4-blue)](https://php.net)
[![Symfony Version](https://img.shields.io/badge/Symfony-7.x%20%7C%208.x-black)](https://symfony.com)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)

Symfony bundle providing **FormTypes**, **TwigComponents**, and **Stimulus Controllers** for the [Tabler](https://tabler.io) Design System.

> **Note:** This bundle does **not** ship Tabler assets. You must install [Tabler CSS](https://tabler.io) and [Tabler Icons](https://tabler.io/icons) in your application.

---

<details>
<summary>Deutsche Kurzfassung</summary>

### Beschreibung

Symfony Bundle mit **FormTypes**, **TwigComponents** und **Stimulus Controllern** für das [Tabler](https://tabler.io) Design System. Tabler CSS und Icons müssen separat installiert werden.

### Schnellinstallation

```bash
composer require jostkleigrewe/symfony-tabler-bundle
npm install @tabler/core @tabler/icons-webfont
```

Form Themes in `config/packages/twig.yaml` registrieren und CSS einbinden — siehe [Installationsanleitung](docs/installation.de.md).

### Dokumentation (Deutsch)

| Thema | Link |
|-------|------|
| Installation | [Installationsanleitung](docs/installation.de.md) |
| Formular-Typen | [FormTypes](docs/form-types.de.md) |
| Twig-Komponenten | [Komponenten](docs/components.de.md) |
| Stimulus Controller | [Controller](docs/stimulus-controllers.de.md) |
| Theming & CSS | [Theming](docs/theming.de.md) |
| Card Data-Attribute | [Data-Attribute](docs/data-attributes.de.md) |
| Showcase / Demo | [Showcase](docs/showcase.de.md) |

</details>

---

## Features

### FormTypes (5)

Custom Symfony form types with Tabler styling.

- **FloatingUnderlineType** — Material-style floating label input with icon support
- **SwitchType** — Checkbox rendered as toggle switch
- **ChoiceCardType** — Card grid for choices with icons, badges, descriptions
- **EntityCardType** — Card grid for Doctrine entities
- **CardSelectType** — Generic multi-select cards

[Full documentation](docs/form-types.en.md) | [Data attributes reference](docs/data-attributes.en.md)

### TwigComponents (15)

Reusable Symfony UX components with `<twig:Tabler:*>` prefix.

| Category | Components |
|----------|------------|
| Layout | PageHeader, Panel, CollapsiblePanel |
| Data Display | StatCard, FeatureCard, CodeBlock |
| Feedback | Alert, EmptyState, HelpTooltip |
| Navigation | ActionList, ActionItem, Stepper |
| Theming | ThemeSwitch, ThemePicker |
| Decorative | PatternBackground (14 animated patterns) |

[Full documentation](docs/components.en.md)

### Stimulus Controllers (6)

Interactive JavaScript controllers auto-discovered via StimulusBundle.

- **theme** — Dark/light mode + color theme switching with localStorage
- **clipboard** — Copy-to-clipboard with fallback
- **sidebar** — Sidebar collapse with mobile backdrop
- **modal-frame** — Dynamic modal content loading
- **required-checkbox** — Prevent unchecking required cards
- **collapsible** — Expandable panels with ARIA support

[Full documentation](docs/stimulus-controllers.en.md)

### Theming

6 built-in color themes (EURIP, Forest, Sunset, Ocean, Purple, Rose) with dark/light mode support.

[Full documentation](docs/theming.en.md)

---

## Requirements

- **PHP** >= 8.4
- **Symfony** 7.0+ or 8.0+
- **Tabler CSS** (not included — [install separately](https://tabler.io))
- **Tabler Icons** (not included — [install separately](https://tabler.io/icons))
- **symfony/ux-twig-component** (for TwigComponents)
- *Optional:* `symfony/stimulus-bundle` (for Stimulus controllers)
- *Optional:* `doctrine/orm` (for EntityCardType / CardSelectType)

---

## Quick Start

### 1. Install

```bash
composer require jostkleigrewe/symfony-tabler-bundle
npm install @tabler/core @tabler/icons-webfont
```

### 2. Register Form Themes

Add to `config/packages/twig.yaml`:

```yaml
twig:
    form_themes:
        - 'bootstrap_5_layout.html.twig'
        - '@Tabler/form/floating_underline.html.twig'
        - '@Tabler/form/switch.html.twig'
        - '@Tabler/form/choice_card.html.twig'
        - '@Tabler/form/card_select.html.twig'
```

### 3. Include CSS

CSS files are auto-registered with AssetMapper:

```twig
<link rel="stylesheet" href="{{ asset('@jostkleigrewe/tabler-bundle/styles/tabler-forms.css') }}">
```

### 4. Use

```twig
{# TwigComponent #}
<twig:Tabler:StatCard label="Users" value="1,234" icon="users" trend="up" />

{# FormType (in your form class) #}
$builder->add('email', FloatingUnderlineType::class, [
    'label' => 'Email',
    'icon' => 'mail',
    'input_type' => 'email',
]);
```

[Detailed installation guide](docs/installation.en.md)

---

## Documentation

| Topic | EN | DE |
|-------|----|----|
| Installation | [Installation Guide](docs/installation.en.md) | [Installationsanleitung](docs/installation.de.md) |
| Form Types | [Form Types](docs/form-types.en.md) | [Formular-Typen](docs/form-types.de.md) |
| Twig Components | [Components](docs/components.en.md) | [Komponenten](docs/components.de.md) |
| Stimulus Controllers | [Controllers](docs/stimulus-controllers.en.md) | [Controller](docs/stimulus-controllers.de.md) |
| Theming & CSS | [Theming](docs/theming.en.md) | [Theming](docs/theming.de.md) |
| Card Data Attributes | [Data Attributes](docs/data-attributes.en.md) | [Data-Attribute](docs/data-attributes.de.md) |
| Showcase / Demo | [Showcase](docs/showcase.en.md) | [Showcase](docs/showcase.de.md) |

---

## Showcase

The bundle includes a built-in demo at `/tabler/showcase` showing all components and form types in action.

To enable, add to `config/routes/tabler.yaml`:

```yaml
tabler_bundle:
    resource: '@TablerBundle/config/routes.yaml'
```

[Showcase documentation](docs/showcase.en.md)

---

## License

MIT License — see [LICENSE](LICENSE) file.
