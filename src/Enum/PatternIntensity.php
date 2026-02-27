<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Effekt-Intensität für PatternBackground.
 * EN: Effect intensity for PatternBackground.
 */
enum PatternIntensity: string
{
    case Subtle = 'subtle';
    case Medium = 'medium';
    case Intense = 'intense';
}
