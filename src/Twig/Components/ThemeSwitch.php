<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\ThemeSwitchSize;
use Jostkleigrewe\TablerBundle\Enum\ThemeSwitchVariant;
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
    /**
     * DE: Variante des Toggles
     * EN: Variant of the toggle
     */
    public ThemeSwitchVariant $variant = ThemeSwitchVariant::Toggle;

    /**
     * DE: Größe des Toggles
     * EN: Size of the toggle
     */
    public ThemeSwitchSize $size = ThemeSwitchSize::Normal;

    /**
     * DE: Normalisiert String-Werte zu Enums (für Twig-Kompatibilität).
     * EN: Normalizes string values to enums (for Twig compatibility).
     */
    public function mount(string|ThemeSwitchVariant|null $variant = null, string|ThemeSwitchSize|null $size = null): void
    {
        if ($variant !== null) {
            $this->variant = $variant instanceof ThemeSwitchVariant
                ? $variant
                : ThemeSwitchVariant::from($variant);
        }

        if ($size !== null) {
            $this->size = $size instanceof ThemeSwitchSize
                ? $size
                : ThemeSwitchSize::from($size);
        }
    }

    /**
     * DE: Tooltip-Text für den Button
     * EN: Tooltip text for the button
     */
    public string $title = 'Switch theme';

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

        if ($this->variant !== ThemeSwitchVariant::Toggle) {
            $classes[] = 'tabler-theme-switch--' . $this->variant->value;
        }

        if ($this->size === ThemeSwitchSize::Compact) {
            $classes[] = 'tabler-theme-switch-compact';
        }

        return implode(' ', $classes);
    }

    public function getDataAction(): string
    {
        return match ($this->variant) {
            ThemeSwitchVariant::Tristate => 'click->theme#choosePosition',
            ThemeSwitchVariant::Cycle => 'click->theme#cycle',
            default => 'click->theme#toggle',
        };
    }
}
