<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Varianten für CollapsiblePanel.
 * EN: Variants for CollapsiblePanel.
 */
enum CollapsiblePanelVariant: string
{
    case Default = 'default';
    case Bordered = 'bordered';
    case Card = 'card';
    case Subtle = 'subtle';
}
