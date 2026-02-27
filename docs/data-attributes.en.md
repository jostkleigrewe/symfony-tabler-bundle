> 🇩🇪 [Deutsche Version](data-attributes.de.md) | 🇬🇧 **English Version**

# Card Data Attributes Reference

This is a shared reference for all `data-*` attributes supported by the card-based FormTypes: [ChoiceCardType](form-types.en.md#choicecardtype), [EntityCardType](form-types.en.md#entitycardtype), and [CardSelectType](form-types.en.md#cardselecttype).

These attributes are passed via the `choice_attr` option and control the appearance of each individual card.

---

## Attribute Reference

| Attribute | Type | Description | Example |
|-----------|------|-------------|---------|
| `data-icon` | string | Tabler icon name (without `ti-` prefix) | `shield`, `key`, `lock` |
| `data-icon-color` | string | Icon background color | `azure`, `green`, `purple` |
| `data-description` | string | Description text displayed below the label | `For server-to-server...` |
| `data-badge` | string | Badge text shown in the card corner | `M2M`, `OIDC`, `NEW` |
| `data-badge-class` | string | CSS class for the badge | `bg-azure-lt`, `bg-purple-lt` |
| `data-code` | string | Technical code shown in monospace font | `client_credentials` |
| `data-required` | string | `"1"` makes the card non-deselectable | `1` |
| `data-indicator-icon` | string | Additional indicator icon (Tabler name) | `check`, `eye-off` |
| `data-indicator-class` | string | CSS class for the indicator | `text-success`, `bg-yellow-lt` |
| `data-indicator-title` | string | Tooltip text for the indicator | `Enabled`, `No consent` |

**Notes:**
- `data-icon` overrides the global `icon` option set on the FormType.
- `data-icon-color` overrides the global `icon_color` option.
- `data-required="1"` activates the `required-checkbox` Stimulus controller, preventing the user from unchecking the card. See [required_checkbox_controller.js](stimulus-controllers.en.md#required_checkbox_controllerjs).
- `data-code` is specific to `CardSelectType` and renders the value in a monospace `<code>` tag.
- `data-indicator-*` attributes are specific to `CardSelectType` and add a small icon badge to the card.

---

## Supported by FormType

| Attribute | ChoiceCardType | EntityCardType | CardSelectType |
|-----------|:-:|:-:|:-:|
| `data-icon` | yes | yes | yes |
| `data-icon-color` | yes | yes | yes |
| `data-description` | yes | yes | yes |
| `data-badge` | yes | yes | yes |
| `data-badge-class` | yes | yes | yes |
| `data-code` | -- | -- | yes |
| `data-required` | yes | yes | yes |
| `data-indicator-icon` | -- | -- | yes |
| `data-indicator-class` | -- | -- | yes |
| `data-indicator-title` | -- | -- | yes |

---

## Complete Example with Static Choices

Using `ChoiceCardType` with all common data attributes:

```php
use Jostkleigrewe\TablerBundle\Form\Type\ChoiceCardType;

$builder->add('grantTypes', ChoiceCardType::class, [
    'label' => 'Grant Types',
    'choices' => [
        'Authorization Code' => 'authorization_code',
        'Client Credentials' => 'client_credentials',
        'Refresh Token' => 'refresh_token',
        'Device Code' => 'device_code',
    ],
    'icon' => 'key',
    'icon_color' => 'azure',
    'columns' => 2,
    'choice_attr' => fn(string $value) => match ($value) {
        'authorization_code' => [
            'data-icon' => 'shield-lock',
            'data-icon-color' => 'green',
            'data-badge' => 'OIDC',
            'data-badge-class' => 'bg-azure-lt',
            'data-description' => 'For browser-based applications with user interaction',
            'data-required' => '1',
        ],
        'client_credentials' => [
            'data-icon' => 'server',
            'data-icon-color' => 'purple',
            'data-badge' => 'M2M',
            'data-badge-class' => 'bg-purple-lt',
            'data-description' => 'For server-to-server communication without user',
        ],
        'refresh_token' => [
            'data-icon' => 'refresh',
            'data-description' => 'Allows obtaining new access tokens',
        ],
        'device_code' => [
            'data-icon' => 'device-tv',
            'data-badge' => 'NEW',
            'data-badge-class' => 'bg-green-lt',
            'data-description' => 'For devices with limited input capabilities',
        ],
        default => [],
    },
]);
```

---

## Entity Example with Doctrine

Using `CardSelectType` with a Doctrine entity that provides data attributes via getter methods:

```php
use App\Entity\Scope;
use Jostkleigrewe\TablerBundle\Form\Type\CardSelectType;

$builder->add('scopes', CardSelectType::class, [
    'class' => Scope::class,
    'query_builder' => fn($repo) => $repo->createQueryBuilder('s')
        ->where('s.active = true')
        ->orderBy('s.sortOrder', 'ASC'),
    'choice_label' => fn(Scope $scope) => $scope->getDisplayName(),
    'choice_attr' => fn(Scope $scope) => [
        'data-icon' => $scope->getIcon() ?? 'lock',
        'data-icon-color' => $scope->getIconColor() ?? 'secondary',
        'data-description' => $scope->getDescription(),
        'data-badge' => $scope->isStandard() ? 'OIDC-Standard' : null,
        'data-badge-class' => $scope->isStandard() ? 'bg-purple-lt' : null,
        'data-code' => $scope->getName(),
        'data-required' => $scope->isRequired() ? '1' : null,
        'data-indicator-icon' => $scope->requiresConsent() ? null : 'eye-off',
        'data-indicator-class' => $scope->requiresConsent() ? null : 'bg-yellow-lt',
        'data-indicator-title' => $scope->requiresConsent() ? null : 'No consent required',
    ],
]);
```

### Corresponding Entity

```php
<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Scope
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private string $name;

    #[ORM\Column(length: 255)]
    private string $displayName;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $icon = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $iconColor = null;

    #[ORM\Column]
    private bool $standard = false;

    #[ORM\Column]
    private bool $required = false;

    #[ORM\Column]
    private bool $requiresConsent = true;

    // Getters used by choice_attr callback:
    public function getName(): string { return $this->name; }
    public function getDisplayName(): string { return $this->displayName; }
    public function getDescription(): ?string { return $this->description; }
    public function getIcon(): ?string { return $this->icon; }
    public function getIconColor(): ?string { return $this->iconColor; }
    public function isStandard(): bool { return $this->standard; }
    public function isRequired(): bool { return $this->required; }
    public function requiresConsent(): bool { return $this->requiresConsent; }
}
```

The entity's getter methods map directly to `data-*` attributes in the `choice_attr` callback. Null values are ignored by Symfony and will not render as HTML attributes.

## See Also

- [Form Types](form-types.en.md) -- ChoiceCardType, EntityCardType, CardSelectType usage
- [Stimulus Controllers](stimulus-controllers.en.md#required_checkbox_controllerjs) -- required-checkbox controller for `data-required`
- [Showcase](showcase.en.md) -- Live demos of all card types
