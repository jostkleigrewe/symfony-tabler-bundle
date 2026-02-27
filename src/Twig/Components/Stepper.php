<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Stepper-Komponente für Prozess-Visualisierung.
 *     Zeigt nummerierte Schritte mit optionalen Icons und Beschreibungen.
 * EN: Stepper component for process visualization.
 *     Shows numbered steps with optional icons and descriptions.
 *
 * Usage:
 *   {% set steps = [
 *       { title: 'Discovery', text: 'Find endpoints', icon: 'ti-radar', icon_color: 'blue' },
 *       { title: 'Authorize', text: 'Start login', icon: 'ti-shield-lock', icon_color: 'green' },
 *       { title: 'Token', text: 'Exchange code', icon: 'ti-key', icon_color: 'purple' },
 *   ] %}
 *   <twig:Tabler:Stepper :steps="steps" />
 *
 *   <twig:Tabler:Stepper :steps="steps" variant="compact" :showNumbers="false" />
 *
 * Steps array format:
 *   - title: string (required) - Step title
 *   - text: string (optional) - Step description
 *   - icon: string (optional) - Tabler icon class (e.g., 'ti-key')
 *   - icon_color: string (optional) - Color name (blue, green, purple, etc.)
 */
#[AsTwigComponent('Tabler:Stepper', template: '@Tabler/components/Stepper.html.twig')]
final class Stepper
{
    /** @var array<array{title: string, text?: string, icon?: string, icon_color?: string}> */
    public array $steps = [];

    /**
     * DE: Variante der Darstellung
     * EN: Display variant
     * - 'default': Cards mit voller Breite
     * - 'compact': Kleinere Cards
     * - 'horizontal': Horizontale Linie mit Punkten
     */
    public string $variant = 'default';

    /**
     * DE: Spaltenanzahl pro Zeile (Bootstrap Grid)
     * EN: Columns per row (Bootstrap Grid)
     */
    public int $columns = 4;

    /**
     * DE: Nummern anzeigen
     * EN: Show step numbers
     */
    public bool $showNumbers = true;

    /**
     * DE: Verbindungslinien zwischen Schritten anzeigen
     * EN: Show connector lines between steps
     */
    public bool $showConnectors = false;
}
