# Tabler Bundle for Symfony

Symfony Bundle providing FormTypes following the [Tabler](https://tabler.io) Design System.

## Features

- **FloatingUnderlineType** - Elegant input with floating label and animated underline
- **SwitchType** - Checkbox rendered as Tabler switch
- **ChoiceCardType** - Card-based choice selection with icons and badges
- **EntityCardType** - Like ChoiceCardType, but for Doctrine entities
- **CardSelectType** - Generic card-based multiple selection

## Requirements

This bundle requires **Tabler** to be installed in your application:

- [Tabler](https://tabler.io) CSS Framework
- [Tabler Icons](https://tabler.io/icons) (for icon support in FormTypes)

**The bundle does NOT ship Tabler assets** - you need to install them yourself.

## Installation

### Step 1: Install via Composer

```bash
composer require jostkleigrewe/symfony-tabler-bundle
```

### Step 2: Register Bundle

If not using Symfony Flex, add to `config/bundles.php`:

```php
return [
    // ...
    Jostkleigrewe\TablerBundle\TablerBundle::class => ['all' => true],
];
```

### Step 3: Register Form Themes

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

### Step 4: Include CSS

Copy `assets/styles/tabler-forms.css` from this bundle to your project's public directory, or include it via Asset Mapper:

```twig
{# templates/base.html.twig #}
<link rel="stylesheet" href="{{ asset('path/to/tabler-forms.css') }}">
```

## Usage

### FloatingUnderlineType

Material Design inspired input with floating label and animated underline.

```php
use Jostkleigrewe\TablerBundle\Form\Type\FloatingUnderlineType;

$builder->add('email', FloatingUnderlineType::class, [
    'label' => 'Email Address',
    'icon' => 'mail',              // Tabler Icon name (without ti- prefix)
    'input_type' => 'email',       // text, email, password, tel, url, search
    'help' => 'Your business email',
]);
```

**Options:**
| Option | Type | Default | Description |
|--------|------|---------|-------------|
| `icon` | string\|null | null | Tabler Icon name |
| `input_type` | string | 'text' | HTML input type |

### SwitchType

Renders a checkbox as a Tabler switch toggle.

```php
use Jostkleigrewe\TablerBundle\Form\Type\SwitchType;

$builder->add('isActive', SwitchType::class, [
    'label' => 'Active',
    'help' => 'User can log in',
]);
```

### ChoiceCardType

Card-based choice selection with icons, badges, and descriptions.

```php
use Jostkleigrewe\TablerBundle\Form\Type\ChoiceCardType;

$builder->add('grantTypes', ChoiceCardType::class, [
    'choices' => [
        'Authorization Code' => 'authorization_code',
        'Client Credentials' => 'client_credentials',
    ],
    'icon' => 'key',           // Global icon for all choices
    'icon_color' => 'azure',   // Global icon color
    'columns' => 2,            // Grid columns: 1, 2, 3, or 4
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

**Options:**
| Option | Type | Default | Description |
|--------|------|---------|-------------|
| `icon` | string\|null | null | Global icon for all choices |
| `icon_color` | string | 'secondary' | Global icon color |
| `columns` | int | 2 | Grid columns (1-4) |

### EntityCardType

Like ChoiceCardType, but for Doctrine entities.

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

### CardSelectType

Generic card-based multiple selection (extends EntityType).

```php
use Jostkleigrewe\TablerBundle\Form\Type\CardSelectType;

$builder->add('roles', CardSelectType::class, [
    'class' => Role::class,
    'choice_label' => 'name',
    'choice_attr' => fn(Role $r) => [
        'data-icon' => 'shield',
        'data-description' => $r->getDescription(),
    ],
]);
```

## Data Attributes for Cards

Use these in `choice_attr` to customize card appearance:

| Attribute | Description |
|-----------|-------------|
| `data-icon` | Tabler Icon name (without `ti-` prefix) |
| `data-icon-color` | Color: azure, green, purple, orange, red, etc. |
| `data-description` | Description text below the label |
| `data-badge` | Badge text (e.g., "M2M", "OIDC") |
| `data-badge-class` | Badge CSS class (e.g., `bg-azure-lt`, `bg-purple-lt`) |
| `data-code` | Technical code displayed in monospace |
| `data-required` | Set to `"1"` for required entries (not deselectable) |
| `data-indicator-icon` | Additional indicator icon |
| `data-indicator-class` | Indicator CSS class |
| `data-indicator-title` | Tooltip for indicator |

## Example: Login Form

```php
// src/Form/LoginFormType.php
use Jostkleigrewe\TablerBundle\Form\Type\FloatingUnderlineType;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('_username', FloatingUnderlineType::class, [
                'label' => 'Email',
                'icon' => 'mail',
                'input_type' => 'email',
            ])
            ->add('_password', FloatingUnderlineType::class, [
                'label' => 'Password',
                'icon' => 'lock',
                'input_type' => 'password',
            ]);
    }

    public function getBlockPrefix(): string
    {
        return ''; // No prefix for Security form fields
    }
}
```

## Requirements

- PHP 8.4+
- Symfony 7.0+ or 8.0+
- Tabler CSS Framework (not included)
- Tabler Icons CSS (not included)
- Optional: doctrine/orm (for EntityCardType)

## License

MIT License - see [LICENSE](LICENSE) file.
