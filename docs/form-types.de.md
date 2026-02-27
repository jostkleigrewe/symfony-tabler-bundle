> 🇬🇧 [English Version](form-types.en.md) | 🇩🇪 **Deutsche Version**

# Formular-Typen

Das Bundle stellt fuenf FormTypes bereit, die auf dem Tabler Design System aufbauen. Jeder Typ
hat ein eigenes Twig Form Theme und wird ueber `tabler-forms.css` gestylt.

Voraussetzung: Die Form Themes muessen in `config/packages/twig.yaml` registriert sein
(siehe [Installationsanleitung](installation.de.md#4-form-themes-registrieren)).

---

## FloatingUnderlineType

Material-Design-inspiriertes Input-Feld mit schwebendem Label und animiertem Unterstrich.

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `icon` | string\|null | `null` | Tabler Icon Name (ohne `ti-` Prefix) |
| `input_type` | string | `'text'` | HTML Input Typ: `text`, `email`, `password`, `tel`, `url`, `search` |

- **Elterntyp:** `TextType`
- **Block-Prefix:** `tabler_floating_underline`
- **Namespace:** `Jostkleigrewe\TablerBundle\Form\Type\FloatingUnderlineType`

```php
use Jostkleigrewe\TablerBundle\Form\Type\FloatingUnderlineType;

$builder
    ->add('email', FloatingUnderlineType::class, [
        'label' => 'E-Mail-Adresse',
        'icon' => 'mail',
        'input_type' => 'email',
    ])
    ->add('password', FloatingUnderlineType::class, [
        'label' => 'Passwort',
        'icon' => 'lock',
        'input_type' => 'password',
    ])
    ->add('search', FloatingUnderlineType::class, [
        'label' => 'Suche',
        'icon' => 'search',
        'input_type' => 'search',
    ]);
```

---

## SwitchType

Rendert eine Checkbox als Tabler Toggle-Switch. Einfacher Wrapper ohne zusaetzliche Optionen.

- **Elterntyp:** `CheckboxType`
- **Block-Prefix:** `tabler_switch`
- **Namespace:** `Jostkleigrewe\TablerBundle\Form\Type\SwitchType`

```php
use Jostkleigrewe\TablerBundle\Form\Type\SwitchType;

$builder->add('isActive', SwitchType::class, [
    'label' => 'Benutzer aktiv',
    'help' => 'Deaktivierte Benutzer koennen sich nicht anmelden.',
]);
```

---

## ChoiceCardType

Rendert Auswahlmoeglichkeiten als kompakte Cards in einem responsiven Grid. Ideal fuer
Grant Types, Feature-Toggles, Kategorien oder aehnliche Mehrfachauswahlen.

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `icon` | string\|null | `null` | Globales Icon fuer alle Optionen |
| `icon_color` | string | `'secondary'` | Globale Icon-Hintergrundfarbe |
| `columns` | int | `2` | Grid-Spalten (1, 2, 3 oder 4) |

- **Elterntyp:** `ChoiceType`
- **Block-Prefix:** `tabler_choice_card`
- **Erzwingt:** `expanded: true`, `multiple: true`
- **Namespace:** `Jostkleigrewe\TablerBundle\Form\Type\ChoiceCardType`

Unterstuetzt `choice_attr` Data-Attribute fuer individuelle Card-Anpassung pro Option.
Siehe [Data-Attribute Referenz](data-attributes.de.md) fuer die vollstaendige Liste.

```php
use Jostkleigrewe\TablerBundle\Form\Type\ChoiceCardType;

$builder->add('grantTypes', ChoiceCardType::class, [
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
            'data-badge-class' => 'bg-purple-lt',
            'data-description' => 'Fuer Web-Apps mit Benutzer-Login',
        ],
        'client_credentials' => [
            'data-badge' => 'M2M',
            'data-badge-class' => 'bg-azure-lt',
            'data-description' => 'Fuer Server-zu-Server Kommunikation',
        ],
        default => [],
    },
]);
```

---

## EntityCardType

Wie `ChoiceCardType`, aber fuer Doctrine Entities. Teilt dasselbe Twig Theme und hat identische
Styling-Optionen.

| Eigenschaft | Typ | Standard | Beschreibung |
|-------------|-----|----------|--------------|
| `icon` | string\|null | `null` | Globales Icon fuer alle Optionen |
| `icon_color` | string | `'secondary'` | Globale Icon-Hintergrundfarbe |
| `columns` | int | `2` | Grid-Spalten (1, 2, 3 oder 4) |

Zusaetzlich stehen alle `EntityType`-Optionen zur Verfuegung: `class`, `query_builder`,
`choice_label`, `choice_attr` usw.

- **Elterntyp:** `EntityType`
- **Block-Prefix:** `tabler_choice_card` (teilt Theme mit ChoiceCardType)
- **Erzwingt:** `expanded: true`, `multiple: true`
- **Namespace:** `Jostkleigrewe\TablerBundle\Form\Type\EntityCardType`
- **Voraussetzung:** `doctrine/orm` muss installiert sein

```php
use Jostkleigrewe\TablerBundle\Form\Type\EntityCardType;

$builder->add('scopes', EntityCardType::class, [
    'class' => Scope::class,
    'query_builder' => fn($repo) => $repo->createQueryBuilder('s')
        ->where('s.active = true')
        ->orderBy('s.sortOrder', 'ASC'),
    'choice_label' => fn(Scope $s) => $s->getDisplayName(),
    'choice_attr' => fn(Scope $s) => [
        'data-icon' => $s->getIcon() ?? 'lock',
        'data-icon-color' => $s->getIconColor() ?? 'azure',
        'data-description' => $s->getDescription(),
        'data-badge' => $s->isStandard() ? 'OIDC' : null,
        'data-badge-class' => 'bg-purple-lt',
    ],
    'columns' => 2,
]);
```

---

## CardSelectType

Generischer Card-basierter Mehrfach-Selektor fuer Doctrine Entities. Bietet ein
eigenstaendiges Template mit erweiterten Data-Attributen (Indicator-Icons, Code-Anzeige).

- **Elterntyp:** `EntityType`
- **Block-Prefix:** `tabler_card_select`
- **Erzwingt:** `expanded: true`, `multiple: true`
- **Namespace:** `Jostkleigrewe\TablerBundle\Form\Type\CardSelectType`
- **Voraussetzung:** `doctrine/orm` muss installiert sein

Unterstuetzt erweiterte Data-Attribute wie `data-code`, `data-indicator-icon`,
`data-indicator-class` und `data-indicator-title`. Siehe [Data-Attribute Referenz](data-attributes.de.md).

```php
use Jostkleigrewe\TablerBundle\Form\Type\CardSelectType;

$builder->add('permissions', CardSelectType::class, [
    'class' => Permission::class,
    'choice_label' => fn(Permission $p) => $p->getDisplayName(),
    'choice_attr' => fn(Permission $p) => [
        'data-icon' => $p->getIcon() ?? 'lock',
        'data-icon-color' => $p->getIconColor() ?? 'secondary',
        'data-code' => $p->getSlug(),
        'data-description' => $p->getDescription(),
        'data-badge' => $p->getCategory(),
        'data-badge-class' => 'bg-azure-lt',
        'data-required' => $p->isRequired() ? '1' : null,
    ],
]);
```

---

## Vollstaendiges Login-Formular Beispiel

```php
<?php

declare(strict_types=1);

namespace App\Form;

use Jostkleigrewe\TablerBundle\Form\Type\FloatingUnderlineType;
use Jostkleigrewe\TablerBundle\Form\Type\SwitchType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

final class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', FloatingUnderlineType::class, [
                'label' => 'E-Mail-Adresse',
                'icon' => 'mail',
                'input_type' => 'email',
                'attr' => ['autocomplete' => 'email'],
            ])
            ->add('password', FloatingUnderlineType::class, [
                'label' => 'Passwort',
                'icon' => 'lock',
                'input_type' => 'password',
                'attr' => ['autocomplete' => 'current-password'],
            ])
            ->add('rememberMe', SwitchType::class, [
                'label' => 'Angemeldet bleiben',
                'required' => false,
            ]);
    }
}
```

---

## Siehe auch

- [Installationsanleitung](installation.de.md) — Form Themes registrieren
- [Data-Attribute](data-attributes.de.md) — Vollstaendige Referenz fuer Card-Typen
- [Theming & CSS](theming.de.md) — FormType CSS anpassen
- [Showcase / Demo](showcase.de.md) — Alle FormTypes live ansehen
