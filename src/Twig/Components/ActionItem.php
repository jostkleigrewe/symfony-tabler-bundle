<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Aktions-Element für Schnellzugriff-Listen oder Navigation.
 * EN: Action item for quick access lists or navigation.
 *
 * Usage:
 *   // DE: Einfaches ActionItem
 *   // EN: Simple action item
 *   <twig:Tabler:ActionItem
 *       label="Profile"
 *       description="Edit personal data"
 *       url="/profile"
 *       icon="user"
 *   />
 *
 *   // DE: Mit Farbe und Badge
 *   // EN: With color and badge
 *   <twig:Tabler:ActionItem
 *       label="Security"
 *       description="MFA, Password, Sessions"
 *       url="/security"
 *       icon="shield"
 *       iconColor="green"
 *       badge="3"
 *       badgeColor="red"
 *   />
 */
#[AsTwigComponent('Tabler:ActionItem', template: '@Tabler/components/ActionItem.html.twig')]
final class ActionItem
{
    /** DE: Haupttext / EN: Main label */
    public string $label;

    /** DE: Beschreibung unter dem Label / EN: Description below label */
    public ?string $description = null;

    /** DE: Link-Ziel / EN: Link target */
    public ?string $url = null;

    /** DE: Tabler Icon Name / EN: Tabler icon name */
    public ?string $icon = null;

    /** DE: Icon-Hintergrundfarbe / EN: Icon background color */
    public string $iconColor = 'blue';

    /** DE: Badge-Text (z.B. Zähler) / EN: Badge text (e.g. counter) */
    public ?string $badge = null;

    /** DE: Badge-Farbe / EN: Badge color */
    public string $badgeColor = 'azure';

    /** DE: Zeigt Pfeil rechts / EN: Shows arrow on right */
    public bool $arrow = true;

    /** DE: Disabled-Zustand / EN: Disabled state */
    public bool $disabled = false;

    /** DE: Größe: 'sm', 'md', 'lg' / EN: Size */
    public string $size = 'md';

    /**
     * DE: Berechnet Avatar-Größe basierend auf Size
     * EN: Calculates avatar size based on size
     */
    public function getAvatarSize(): string
    {
        return match ($this->size) {
            'sm' => 'sm',
            'lg' => 'md',
            default => 'sm',
        };
    }
}
