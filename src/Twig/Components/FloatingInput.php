<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Floating Underline Input als TwigComponent.
 *     Für Standalone-Nutzung außerhalb von Symfony Forms (z.B. Login, Suchfelder).
 *     Teil des Tabler Design System.
 *
 * EN: Floating Underline Input as TwigComponent.
 *     For standalone use outside Symfony Forms (e.g. login, search fields).
 *     Part of the Tabler Design System.
 *
 * Usage:
 *     <twig:Tabler:FloatingInput
 *         name="_username"
 *         type="email"
 *         label="E-Mail-Adresse"
 *         icon="mail"
 *         value="{{ last_username }}"
 *         required
 *     />
 *
 *     <twig:Tabler:FloatingInput
 *         name="_password"
 *         type="password"
 *         label="Passwort"
 *         icon="lock"
 *         required
 *     />
 *
 *     <twig:Tabler:FloatingInput
 *         name="search"
 *         label="Suchen..."
 *         icon="search"
 *         help="Mindestens 3 Zeichen eingeben"
 *     />
 */
#[AsTwigComponent('Tabler:FloatingInput', template: '@Tabler/components/FloatingInput.html.twig')]
final class FloatingInput
{
    public string $name;
    public string $type = 'text';
    public string $label;
    public ?string $icon = null;
    public ?string $value = null;
    public ?string $help = null;
    public ?string $error = null;
    public bool $required = false;
    public bool $autofocus = false;
    public ?string $autocomplete = null;
    public ?string $id = null;

    /**
     * @api
     */
    public function getId(): string
    {
        return $this->id ?? 'fl-' . $this->name;
    }

    /**
     * @api
     */
    public function hasIcon(): bool
    {
        return $this->icon !== null;
    }

    /**
     * @api
     */
    public function hasError(): bool
    {
        return $this->error !== null;
    }
}
