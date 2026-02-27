<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Animationsgeschwindigkeit für PatternBackground.
 * EN: Animation speed for PatternBackground.
 */
enum PatternSpeed: string
{
    case Slow = 'slow';
    case Normal = 'normal';
    case Fast = 'fast';
    case Static = 'static';
}
