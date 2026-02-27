<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\ComponentSize;
use Jostkleigrewe\TablerBundle\Enum\TablerColor;
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
    public TablerColor $iconColor = TablerColor::Blue;

    /** DE: Badge-Text (z.B. Zähler) / EN: Badge text (e.g. counter) */
    public ?string $badge = null;

    /** DE: Badge-Farbe / EN: Badge color */
    public TablerColor $badgeColor = TablerColor::Azure;

    /** DE: Zeigt Pfeil rechts / EN: Shows arrow on right */
    public bool $arrow = true;

    /** DE: Disabled-Zustand / EN: Disabled state */
    public bool $disabled = false;

    /** DE: Größe / EN: Size */
    public ComponentSize $size = ComponentSize::Md;

    /**
     * DE: Normalisiert String-Werte zu Enums (für Twig-Kompatibilität).
     * EN: Normalizes string values to enums (for Twig compatibility).
     */
    public function mount(
        string|TablerColor|null $iconColor = null,
        string|TablerColor|null $badgeColor = null,
        string|ComponentSize|null $size = null,
    ): void {
        if ($iconColor !== null) {
            $this->iconColor = $iconColor instanceof TablerColor ? $iconColor : TablerColor::tryFrom($iconColor) ?? TablerColor::Blue;
        }
        if ($badgeColor !== null) {
            $this->badgeColor = $badgeColor instanceof TablerColor ? $badgeColor : TablerColor::tryFrom($badgeColor) ?? TablerColor::Azure;
        }
        if ($size !== null) {
            $this->size = $size instanceof ComponentSize ? $size : ComponentSize::tryFrom($size) ?? ComponentSize::Md;
        }
    }

    /**
     * DE: Berechnet Avatar-Größe basierend auf Size
     * EN: Calculates avatar size based on size
     */
    public function getAvatarSize(): string
    {
        return match ($this->size) {
            ComponentSize::Sm => 'sm',
            ComponentSize::Lg => 'md',
            default => 'sm',
        };
    }
}
