<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Positionierung für Bootstrap-Tooltips.
 * EN: Placement for Bootstrap tooltips.
 */
enum TooltipPlacement: string
{
    case Top = 'top';
    case Bottom = 'bottom';
    case Left = 'left';
    case Right = 'right';
}
