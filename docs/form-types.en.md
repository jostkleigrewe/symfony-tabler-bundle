> 🇩🇪 [Deutsche Version](form-types.de.md) | 🇬🇧 **English Version**

# Form Types

The bundle provides 5 custom Symfony FormTypes that render as Tabler-styled UI elements. Each type has a matching Twig form theme and is styled via `tabler-forms.css`.

Make sure the form themes are registered in your `twig.yaml` -- see [Installation](installation.en.md#3-register-form-themes).

---

## FloatingUnderlineType

Material Design-style input with a floating label and animated underline. Supports an optional leading icon.

- **Parent:** `TextType`
- **Block prefix:** `tabler_floating_underline`
- **Class:** `Jostkleigrewe\TablerBundle\Form\Type\FloatingUnderlineType`

### Options

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| `icon` | string or null | `null` | Tabler icon name (without `ti-` prefix) |
| `input_type` | string | `'text'` | HTML input type: `text`, `email`, `password`, `tel`, `url`, `search` |

### Examples

```php
use Jostkleigrewe\TablerBundle\Form\Type\FloatingUnderlineType;

$builder
    ->add('email', FloatingUnderlineType::class, [
        'label' => 'Email Address',
        'icon' => 'mail',
        'input_type' => 'email',
    ])
    ->add('password', FloatingUnderlineType::class, [
        'label' => 'Password',
        'icon' => 'lock',
        'input_type' => 'password',
    ]);
```

---

## SwitchType

Renders a checkbox as a Tabler toggle switch. No additional options beyond the standard `CheckboxType`.

- **Parent:** `CheckboxType`
- **Block prefix:** `tabler_switch`
- **Class:** `Jostkleigrewe\TablerBundle\Form\Type\SwitchType`

### Example

```php
use Jostkleigrewe\TablerBundle\Form\Type\SwitchType;

$builder->add('isActive', SwitchType::class, [
    'label' => 'Active',
    'help' => 'Enable or disable this item',
]);
```

---

## ChoiceCardType

Renders choices as compact cards in a responsive grid. Ideal for feature toggles, grant types, or category selection.

- **Parent:** `ChoiceType`
- **Block prefix:** `tabler_choice_card`
- **Class:** `Jostkleigrewe\TablerBundle\Form\Type\ChoiceCardType`
- **Forces:** `expanded: true`, `multiple: true`

### Options

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| `icon` | string or null | `null` | Global icon for all choices (without `ti-` prefix) |
| `icon_color` | string | `'secondary'` | Global icon background color |
| `columns` | int | `2` | Grid columns on `md+` breakpoint (1-4) |

Per-choice customization is possible via `choice_attr` data attributes. See the [Card Data Attributes Reference](data-attributes.en.md) for all supported attributes.

### Example

```php
use Jostkleigrewe\TablerBundle\Form\Type\ChoiceCardType;

$builder->add('grantTypes', ChoiceCardType::class, [
    'label' => 'Grant Types',
    'choices' => [
        'Authorization Code' => 'authorization_code',
        'Client Credentials' => 'client_credentials',
        'Refresh Token' => 'refresh_token',
    ],
    'icon' => 'key',
    'icon_color' => 'azure',
    'columns' => 3,
    'choice_attr' => fn(string $value) => match ($value) {
        'authorization_code' => [
            'data-badge' => 'OIDC',
            'data-badge-class' => 'bg-azure-lt',
            'data-description' => 'For browser-based applications',
        ],
        'client_credentials' => [
            'data-badge' => 'M2M',
            'data-badge-class' => 'bg-purple-lt',
            'data-description' => 'For server-to-server communication',
        ],
        default => [],
    },
]);
```

---

## EntityCardType

Like `ChoiceCardType`, but backed by Doctrine entities. Shares the same Twig theme block (`tabler_choice_card`).

- **Parent:** `EntityType`
- **Block prefix:** `tabler_choice_card`
- **Class:** `Jostkleigrewe\TablerBundle\Form\Type\EntityCardType`
- **Forces:** `expanded: true`, `multiple: true`
- **Requires:** `doctrine/orm`

### Options

All options from `ChoiceCardType` (`icon`, `icon_color`, `columns`) plus the standard `EntityType` options (`class`, `query_builder`, `choice_label`, `choice_attr`).

### Example

```php
use App\Entity\Scope;
use Jostkleigrewe\TablerBundle\Form\Type\EntityCardType;

$builder->add('scopes', EntityCardType::class, [
    'class' => Scope::class,
    'query_builder' => fn($repo) => $repo->createQueryBuilder('s')
        ->where('s.active = true')
        ->orderBy('s.name', 'ASC'),
    'choice_label' => fn(Scope $scope) => $scope->getDisplayName(),
    'choice_attr' => fn(Scope $scope) => [
        'data-icon' => $scope->getIcon() ?? 'lock',
        'data-icon-color' => $scope->getIconColor() ?? 'azure',
        'data-description' => $scope->getDescription(),
        'data-badge' => $scope->isStandard() ? 'OIDC' : null,
        'data-badge-class' => 'bg-purple-lt',
    ],
    'columns' => 2,
]);
```

---

## CardSelectType

Generic card-based multi-select for Doctrine entities. Supports a richer set of data attributes including `data-code`, `data-indicator-icon`, `data-indicator-class`, and `data-indicator-title`.

- **Parent:** `EntityType`
- **Block prefix:** `tabler_card_select`
- **Class:** `Jostkleigrewe\TablerBundle\Form\Type\CardSelectType`
- **Forces:** `expanded: true`, `multiple: true`
- **Requires:** `doctrine/orm`

### Example

```php
use App\Entity\Scope;
use Jostkleigrewe\TablerBundle\Form\Type\CardSelectType;

$builder->add('scopes', CardSelectType::class, [
    'class' => Scope::class,
    'choice_label' => fn(Scope $s) => $s->getDisplayName(),
    'choice_attr' => fn(Scope $s) => [
        'data-icon' => $s->getIcon() ?? 'lock',
        'data-icon-color' => $s->getIconColor() ?? 'secondary',
        'data-badge' => $s->isStandard() ? 'OIDC-Standard' : null,
        'data-badge-class' => 'bg-purple-lt',
        'data-code' => $s->getName(),
        'data-description' => $s->getDescription(),
        'data-required' => $s->isRequired() ? '1' : null,
    ],
]);
```

See the [Card Data Attributes Reference](data-attributes.en.md) for a complete list of supported `data-*` attributes.

---

## Complete Login Form Example

A full form class using `FloatingUnderlineType` and `SwitchType`:

```php
<?php

declare(strict_types=1);

namespace App\Form;

use Jostkleigrewe\TablerBundle\Form\Type\FloatingUnderlineType;
use Jostkleigrewe\TablerBundle\Form\Type\SwitchType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

final class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', FloatingUnderlineType::class, [
                'label' => 'Email Address',
                'icon' => 'mail',
                'input_type' => 'email',
            ])
            ->add('password', FloatingUnderlineType::class, [
                'label' => 'Password',
                'icon' => 'lock',
                'input_type' => 'password',
            ])
            ->add('rememberMe', SwitchType::class, [
                'label' => 'Remember me',
                'required' => false,
            ]);
    }
}
```

## See Also

- [Installation](installation.en.md) -- Setup and form theme registration
- [Card Data Attributes](data-attributes.en.md) -- All `data-*` attributes for card types
- [Theming & CSS](theming.en.md) -- Including `tabler-forms.css`
- [Showcase](showcase.en.md) -- Live demos of all form types
