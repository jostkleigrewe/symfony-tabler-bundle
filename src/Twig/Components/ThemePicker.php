<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Theme-Picker für Farbschema und Dark/Light-Modus.
 * EN: Theme picker for color scheme and dark/light mode.
 *
 * Usage:
 *   <twig:Tabler:ThemePicker />
 *   <twig:Tabler:ThemePicker :showModeToggle="true" :showThemeSelector="true" />
 *   <twig:Tabler:ThemePicker variant="compact" />
 */
#[AsTwigComponent('Tabler:ThemePicker', template: '@Tabler/components/ThemePicker.html.twig')]
final class ThemePicker
{
    /**
     * DE: Zeigt den Dark/Light-Modus Toggle
     * EN: Show dark/light mode toggle
     */
    public bool $showModeToggle = true;

    /**
     * DE: Zeigt den Theme-Selector (Farbpalette)
     * EN: Show theme selector (color palette)
     */
    public bool $showThemeSelector = true;

    /**
     * DE: Darstellungsvariante
     * EN: Display variant
     */
    public string $variant = 'default'; // default, compact, inline

    /**
     * DE: Verfügbare Themes
     * EN: Available themes
     *
     * @var array<string, array{label: string, color: string}>
     */
    public array $themes = [
        'eurip' => ['label' => 'EURIP', 'color' => '#0f3d91'],
        'forest' => ['label' => 'Forest', 'color' => '#059669'],
        'sunset' => ['label' => 'Sunset', 'color' => '#ea580c'],
        'ocean' => ['label' => 'Ocean', 'color' => '#0891b2'],
        'purple' => ['label' => 'Purple', 'color' => '#7c3aed'],
        'rose' => ['label' => 'Rose', 'color' => '#e11d48'],
    ];

    /**
     * DE: Gibt die Theme-Namen als Array zurück (für JS)
     * EN: Returns theme names as array (for JS)
     *
     * @return string[]
     */
    public function getThemeNames(): array
    {
        return array_keys($this->themes);
    }
}
