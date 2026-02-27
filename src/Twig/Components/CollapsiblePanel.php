<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Ausklappbares Panel mit ARIA-Attributen für Accessibility.
 *     Ideal für FAQ-Bereiche, Hilfe-Sektionen oder optionale Informationen.
 * EN: Collapsible panel with ARIA attributes for accessibility.
 *     Ideal for FAQ sections, help areas or optional information.
 *
 * Usage:
 *   <twig:Tabler:CollapsiblePanel title="Hilfe zu diesem Feld">
 *       <p>Hier steht die Erklärung...</p>
 *   </twig:Tabler:CollapsiblePanel>
 *
 *   <twig:Tabler:CollapsiblePanel
 *       title="Erweiterte Optionen"
 *       icon="settings"
 *       :expanded="true"
 *       variant="bordered"
 *   >
 *       ...
 *   </twig:Tabler:CollapsiblePanel>
 */
#[AsTwigComponent('Tabler:CollapsiblePanel', template: '@Tabler/components/CollapsiblePanel.html.twig')]
final class CollapsiblePanel
{
    public string $title;

    /**
     * DE: Tabler Icon Name (ohne ti- Prefix)
     * EN: Tabler icon name (without ti- prefix)
     */
    public ?string $icon = null;

    /**
     * DE: Icon-Farbe
     * EN: Icon color
     */
    public string $iconColor = 'primary';

    /**
     * DE: Initial ausgeklappt
     * EN: Initially expanded
     */
    public bool $expanded = false;

    /**
     * DE: Eindeutige ID (wird automatisch generiert wenn nicht angegeben)
     * EN: Unique ID (auto-generated if not provided)
     */
    public ?string $panelId = null;

    /**
     * DE: Variante der Darstellung
     * EN: Display variant
     * - 'default': Einfacher Stil
     * - 'bordered': Mit Rahmen
     * - 'card': Als Card
     * - 'subtle': Dezenter Hintergrund
     */
    public string $variant = 'default';

    /**
     * DE: Hilfetext unter dem Titel
     * EN: Help text below title
     */
    public ?string $subtitle = null;
}
