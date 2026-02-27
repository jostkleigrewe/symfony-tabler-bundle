<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Theme Switch Komponente - Day/Night Toggle für Light/Dark Mode.
 *     Visueller Toggle mit Sonne/Mond-Icons, speichert Wert in localStorage.
 *     Benötigt einen Stimulus Controller (theme_controller.js) für die Funktionalität.
 *
 * EN: Theme Switch Component - Day/Night toggle for light/dark mode.
 *     Visual toggle with sun/moon icons, stores value in localStorage.
 *     Requires a Stimulus controller (theme_controller.js) for functionality.
 *
 * Usage:
 *   <twig:Tabler:ThemeSwitch />
 *
 *   <twig:Tabler:ThemeSwitch size="compact" />
 *
 *   <twig:Tabler:ThemeSwitch variant="tristate" />
 *
 *   <twig:Tabler:ThemeSwitch variant="cycle" />
 */
#[AsTwigComponent('Tabler:ThemeSwitch', template: '@Tabler/components/ThemeSwitch.html.twig')]
final class ThemeSwitch
{
    public const SIZE_COMPACT = 'compact';
    public const SIZE_NORMAL = 'normal';

    public const VARIANT_TOGGLE = 'toggle';
    public const VARIANT_TRISTATE = 'tristate';
    public const VARIANT_CYCLE = 'cycle';

    /**
     * DE: Variante des Toggles
     *     - 'toggle': Standard 2-State (Light/Dark)
     *     - 'tristate': Drei-Positionen-Slider (Light/Auto/Dark)
     *     - 'cycle': Durchklicken (Light → Dark → Auto → ...)
     *
     * EN: Variant of the toggle
     *     - 'toggle': Standard 2-state (Light/Dark)
     *     - 'tristate': Three-position slider (Light/Auto/Dark)
     *     - 'cycle': Click through (Light → Dark → Auto → ...)
     */
    public string $variant = self::VARIANT_TOGGLE;

    /**
     * DE: Größe des Toggles: 'normal' (60x30px) oder 'compact' (50x26px)
     * EN: Size of the toggle: 'normal' (60x30px) or 'compact' (50x26px)
     */
    public string $size = self::SIZE_NORMAL;

    /**
     * DE: Tooltip-Text für den Button
     * EN: Tooltip text for the button
     */
    public string $title = 'Theme wechseln';

    /**
     * DE: Zeigt ein Label neben dem Toggle an
     * EN: Shows a label next to the toggle
     */
    public bool $showLabel = false;

    /**
     * DE: Label-Text (nur wenn showLabel=true)
     * EN: Label text (only when showLabel=true)
     */
    public string $label = 'Theme';

    /**
     * DE: Zusätzliche CSS-Klassen für den Container
     * EN: Additional CSS classes for the container
     */
    public string $class = '';

    public function getCssClass(): string
    {
        $classes = ['tabler-theme-switch'];

        // Variant class
        if ($this->variant !== self::VARIANT_TOGGLE) {
            $classes[] = 'tabler-theme-switch--' . $this->variant;
        }

        // Size class
        if ($this->size === self::SIZE_COMPACT) {
            $classes[] = 'tabler-theme-switch-compact';
        }

        return implode(' ', $classes);
    }

    public function getDataAction(): string
    {
        return match ($this->variant) {
            self::VARIANT_TRISTATE => 'click->theme#choosePosition',
            self::VARIANT_CYCLE => 'click->theme#cycle',
            default => 'click->theme#toggle',
        };
    }
}
