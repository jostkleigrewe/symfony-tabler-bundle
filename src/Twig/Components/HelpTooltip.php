<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\TablerColor;
use Jostkleigrewe\TablerBundle\Enum\TooltipPlacement;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Hover-Tooltip mit Info-Icon für kontextuelle Hilfe.
 * EN: Hover tooltip with info icon for contextual help.
 *
 * Usage:
 *   <twig:Tabler:HelpTooltip text="Explanation here" />
 *   <twig:Tabler:HelpTooltip text="With title" title="Redirect URI" />
 *   <twig:Tabler:HelpTooltip text="Custom icon" icon="question-mark" />
 */
#[AsTwigComponent('Tabler:HelpTooltip', template: '@Tabler/components/HelpTooltip.html.twig')]
final class HelpTooltip
{
    public string $text;

    public ?string $title = null;

    public string $icon = 'info-circle';

    public TooltipPlacement $placement = TooltipPlacement::Top;

    public TablerColor $color = TablerColor::Secondary;

    /**
     * DE: Normalisiert String-Werte zu Enums (für Twig-Kompatibilität).
     * EN: Normalizes string values to enums (for Twig compatibility).
     */
    public function mount(
        string|TooltipPlacement|null $placement = null,
        string|TablerColor|null $color = null,
    ): void {
        if ($placement !== null) {
            $this->placement = $placement instanceof TooltipPlacement ? $placement : TooltipPlacement::tryFrom($placement) ?? TooltipPlacement::Top;
        }
        if ($color !== null) {
            $this->color = $color instanceof TablerColor ? $color : TablerColor::tryFrom($color) ?? TablerColor::Secondary;
        }
    }
}
