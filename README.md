# Tabler Bundle for Symfony

Symfony Bundle providing FormTypes and Twig Components following the [Tabler](https://tabler.io) Design System.

## Features

- **FloatingUnderlineType** - Elegant input with floating label and animated underline
- **SwitchType** - Checkbox rendered as Tabler switch
- **ChoiceCardType** - Card-based choice selection with icons and badges
- **EntityCardType** - Like ChoiceCardType, but for Doctrine entities
- **CardSelectType** - Generic card-based multiple selection
- **Tabler:FloatingInput** - Standalone TwigComponent for login forms etc.

## Requirements

This bundle requires **Tabler** to be installed in your application:

- [Tabler](https://tabler.io) CSS Framework
- [Tabler Icons](https://tabler.io/icons) (for icon support in FormTypes)

**The bundle does NOT ship Tabler assets** - you need to install them yourself.

## Installation

```bash
composer require jostkleigrewe/symfony-tabler-bundle
```

### Register Bundle

```php
// config/bundles.php
return [
    // ...
    Jostkleigrewe\TablerBundle\TablerBundle::class => ['all' => true],
];
```

### Register Form Themes

```yaml
# config/packages/twig.yaml
twig:
    form_themes:
        - 'bootstrap_5_layout.html.twig'
        - '@Tabler/form/floating_underline.html.twig'
        - '@Tabler/form/switch.html.twig'
        - '@Tabler/form/choice_card.html.twig'
        - '@Tabler/form/card_select.html.twig'
```

### Include CSS

Copy `assets/styles/tabler-forms.css` to your project or include it via Asset Mapper:

```twig
{# templates/base.html.twig #}
<link rel="stylesheet" href="{{ asset('path/to/tabler-forms.css') }}">
```

## Usage

### FloatingUnderlineType

```php
use Jostkleigrewe\TablerBundle\Form\Type\FloatingUnderlineType;

$builder->add('email', FloatingUnderlineType::class, [
    'label' => 'Email Address',
    'icon' => 'mail',              // Tabler Icon name
    'input_type' => 'email',       // text, email, password, tel, url, search
    'help' => 'Your business email',
]);
```

### SwitchType

```php
use Jostkleigrewe\TablerBundle\Form\Type\SwitchType;

$builder->add('isActive', SwitchType::class, [
    'label' => 'Active',
    'help' => 'User can log in',
]);
```

### ChoiceCardType

```php
use Jostkleigrewe\TablerBundle\Form\Type\ChoiceCardType;

$builder->add('grantTypes', ChoiceCardType::class, [
    'choices' => [
        'Authorization Code' => 'authorization_code',
        'Client Credentials' => 'client_credentials',
    ],
    'icon' => 'key',
    'icon_color' => 'azure',
    'columns' => 2,  // 1, 2, 3, or 4
    'choice_attr' => fn($value) => match($value) {
        'client_credentials' => [
            'data-badge' => 'M2M',
            'data-badge-class' => 'bg-purple-lt',
            'data-description' => 'For server-to-server communication',
        ],
        default => [],
    },
]);
```

### EntityCardType

```php
use Jostkleigrewe\TablerBundle\Form\Type\EntityCardType;

$builder->add('scopes', EntityCardType::class, [
    'class' => Scope::class,
    'query_builder' => fn($repo) => $repo->createQueryBuilder('s')
        ->where('s.active = true'),
    'choice_label' => fn(Scope $s) => $s->getDisplayName(),
    'choice_attr' => fn(Scope $s) => [
        'data-icon' => $s->getIcon() ?? 'lock',
        'data-icon-color' => $s->getIconColor() ?? 'azure',
        'data-description' => $s->getDescription(),
        'data-badge' => $s->isStandard() ? 'OIDC' : null,
    ],
    'columns' => 2,
]);
```

### Tabler:FloatingInput (TwigComponent)

For standalone use outside Symfony Forms (e.g. login pages):

```twig
<twig:Tabler:FloatingInput
    name="_username"
    type="email"
    label="Email Address"
    icon="mail"
    :value="last_username"
    autocomplete="email"
    required
/>

<twig:Tabler:FloatingInput
    name="_password"
    type="password"
    label="Password"
    icon="lock"
    required
/>
```

## Data Attributes for Cards

| Attribute | Description |
|-----------|-------------|
| `data-icon` | Tabler Icon name (without `ti-` prefix) |
| `data-icon-color` | Color: azure, green, purple, orange, etc. |
| `data-description` | Description text |
| `data-badge` | Badge text |
| `data-badge-class` | Badge CSS class (e.g. `bg-azure-lt`) |
| `data-code` | Technical code (monospace) |
| `data-required` | `"1"` for required entries (not deselectable) |

## Configuration

```yaml
# config/packages/tabler.yaml
tabler:
    register_twig_components: true  # Set to false if not using TwigComponents
```

## Requirements

- PHP 8.4+
- Symfony 7.0+ or 8.0+
- Tabler CSS Framework
- Tabler Icons CSS
- Optional: symfony/ux-twig-component (for TwigComponents)
- Optional: doctrine/orm (for EntityCardType)

## License

MIT License - see [LICENSE](LICENSE) file.
