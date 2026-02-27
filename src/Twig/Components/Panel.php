<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\ComponentSize;
use Jostkleigrewe\TablerBundle\Enum\TablerColor;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Generisches Panel/Card mit Titel und optionalem Subtitle.
 * EN: Generic panel/card with title and optional subtitle.
 *
 * Usage:
 *   <twig:Tabler:Panel title="Login" subtitle="Enter your credentials">
 *       <form>...</form>
 *   </twig:Tabler:Panel>
 *
 *   <twig:Tabler:Panel title="Settings" icon="settings" :centered="false">
 *       ...
 *   </twig:Tabler:Panel>
 */
#[AsTwigComponent('Tabler:Panel', template: '@Tabler/components/Panel.html.twig')]
final class Panel
{
    public string $title;

    public ?string $subtitle = null;

    public ?string $icon = null;

    public TablerColor $iconColor = TablerColor::Azure;

    public bool $centered = true;

    public ComponentSize $size = ComponentSize::Md;
}
