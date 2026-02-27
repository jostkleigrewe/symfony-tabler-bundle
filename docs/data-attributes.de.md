> 🇬🇧 [English Version](data-attributes.en.md) | 🇩🇪 **Deutsche Version**

# Card Data-Attribute Referenz

Die Card-basierten FormTypes (`ChoiceCardType`, `EntityCardType`, `CardSelectType`) unterstuetzen
Data-Attribute pro Choice, um das Aussehen einzelner Cards individuell anzupassen. Die Attribute
werden ueber den `choice_attr` Callback gesetzt.

---

## Vollstaendige Attribut-Tabelle

| Attribut | Typ | Beschreibung | Beispiel |
|----------|-----|--------------|---------|
| `data-icon` | string | Tabler Icon Name (ohne `ti-` Prefix) | `shield`, `key`, `lock` |
| `data-icon-color` | string | Icon-Hintergrundfarbe | `azure`, `green`, `purple` |
| `data-description` | string | Beschreibungstext unter dem Label | `Fuer Server-zu-Server...` |
| `data-badge` | string | Badge-Text rechts oben | `M2M`, `OIDC`, `NEU` |
| `data-badge-class` | string | Badge CSS-Klasse | `bg-azure-lt`, `bg-purple-lt` |
| `data-code` | string | Technischer Code in Monospace-Darstellung | `client_credentials` |
| `data-required` | string | `"1"` = Card kann nicht abgewaehlt werden | `1` |
| `data-indicator-icon` | string | Zusaetzliches Indikator-Icon | `check`, `eye-off` |
| `data-indicator-class` | string | Indikator CSS-Klasse | `text-success`, `bg-yellow-lt` |
| `data-indicator-title` | string | Tooltip fuer den Indikator | `Aktiviert`, `Kein Consent` |

### Unterstuetzung pro FormType

| Attribut | ChoiceCardType | EntityCardType | CardSelectType |
|----------|:--------------:|:--------------:|:--------------:|
| `data-icon` | ja | ja | ja |
| `data-icon-color` | ja | ja | ja |
| `data-description` | ja | ja | ja |
| `data-badge` | ja | ja | ja |
| `data-badge-class` | ja | ja | ja |
| `data-code` | — | — | ja |
| `data-required` | ja | ja | ja |
| `data-indicator-icon` | — | — | ja |
| `data-indicator-class` | — | — | ja |
| `data-indicator-title` | — | — | ja |

`ChoiceCardType` und `EntityCardType` teilen dasselbe Twig Theme (`tabler_choice_card`).
`CardSelectType` hat ein eigenstaendiges Theme (`tabler_card_select`) mit erweiterten Attributen.

---

## Verwendung mit choice_attr

Data-Attribute werden ueber den `choice_attr` Callback gesetzt. Der Callback erhaelt den Wert
(bei `ChoiceCardType`) bzw. die Entity-Instanz (bei `EntityCardType` / `CardSelectType`).

### Einfaches Beispiel mit ChoiceCardType

```php
use Jostkleigrewe\TablerBundle\Form\Type\ChoiceCardType;

$builder->add('features', ChoiceCardType::class, [
    'choices' => [
        'E-Mail Benachrichtigungen' => 'email_notify',
        'Zwei-Faktor-Authentifizierung' => '2fa',
        'API-Zugriff' => 'api_access',
    ],
    'icon' => 'settings',
    'columns' => 3,
    'choice_attr' => fn(string $value) => match ($value) {
        'email_notify' => [
            'data-icon' => 'mail',
            'data-icon-color' => 'blue',
            'data-description' => 'Erhalte E-Mails bei wichtigen Ereignissen',
        ],
        '2fa' => [
            'data-icon' => 'shield-lock',
            'data-icon-color' => 'green',
            'data-badge' => 'Empfohlen',
            'data-badge-class' => 'bg-green-lt',
            'data-description' => 'Zusaetzliche Sicherheit fuer dein Konto',
            'data-required' => '1',
        ],
        'api_access' => [
            'data-icon' => 'api',
            'data-icon-color' => 'purple',
            'data-description' => 'Zugriff ueber REST API ermoeglichen',
            'data-badge' => 'Beta',
            'data-badge-class' => 'bg-orange-lt',
        ],
        default => [],
    },
]);
```

### Vollstaendiges Beispiel mit CardSelectType

```php
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
        'data-indicator-title' => $scope->requiresConsent() ? null : 'Kein Consent erforderlich',
    ],
]);
```

---

## Doctrine Entity Beispiel

Eine Entity-Klasse kann Getter-Methoden bereitstellen, die direkt auf Data-Attribute abbilden:

```php
<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class Scope
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

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $iconColor = null;

    #[ORM\Column]
    private bool $standard = false;

    #[ORM\Column]
    private bool $required = false;

    // Getter fuer FormType choice_attr
    public function getName(): string { return $this->name; }
    public function getDisplayName(): string { return $this->displayName; }
    public function getDescription(): ?string { return $this->description; }
    public function getIcon(): ?string { return $this->icon; }
    public function getIconColor(): ?string { return $this->iconColor; }
    public function isStandard(): bool { return $this->standard; }
    public function isRequired(): bool { return $this->required; }
}
```

Im `choice_attr` Callback koennen die Getter direkt verwendet werden:

```php
'choice_attr' => fn(Scope $s) => [
    'data-icon' => $s->getIcon() ?? 'lock',
    'data-icon-color' => $s->getIconColor() ?? 'azure',
    'data-description' => $s->getDescription(),
    'data-badge' => $s->isStandard() ? 'Standard' : null,
    'data-required' => $s->isRequired() ? '1' : null,
],
```

---

## Globale vs. individuelle Attribute

`ChoiceCardType` und `EntityCardType` bieten zusaetzlich **globale** Optionen, die fuer alle
Cards gelten und von individuellen Data-Attributen pro Choice ueberschrieben werden koennen:

| Globale Option | Ueberschrieben durch | Beschreibung |
|---------------|---------------------|--------------|
| `icon` | `data-icon` | Standard-Icon fuer alle Cards |
| `icon_color` | `data-icon-color` | Standard-Icon-Farbe |

```php
$builder->add('roles', EntityCardType::class, [
    'class' => Role::class,
    'icon' => 'shield',           // Standard-Icon fuer alle
    'icon_color' => 'secondary',  // Standard-Farbe fuer alle
    'choice_attr' => fn(Role $r) => [
        'data-icon' => $r->getIcon(),         // Ueberschreibt globales Icon
        'data-icon-color' => $r->getColor(),  // Ueberschreibt globale Farbe
    ],
]);
```

---

## Hinweis zu data-required

Wenn `data-required="1"` gesetzt ist, wird der `required-checkbox` Stimulus Controller aktiviert.
Die Checkbox ist dann initial aktiviert und kann vom Benutzer nicht abgewaehlt werden. Dies
erfordert das `symfony/stimulus-bundle`. Siehe
[Required Checkbox Controller](stimulus-controllers.de.md#required_checkbox_controllerjs).

---

## Siehe auch

- [Formular-Typen](form-types.de.md) — Alle 5 FormTypes im Detail
- [Stimulus Controller](stimulus-controllers.de.md#required_checkbox_controllerjs) — Required Checkbox
- [Showcase / Demo](showcase.de.md) — Card-Typen live ansehen
