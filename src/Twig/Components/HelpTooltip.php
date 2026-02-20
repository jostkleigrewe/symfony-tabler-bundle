<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

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
    public string $placement = 'top';
    public string $color = 'secondary';
}
