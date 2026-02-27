<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Farbmodus für PatternBackground.
 * EN: Color theme for PatternBackground.
 */
enum PatternTheme: string
{
    case Dark = 'dark';
    case Light = 'light';
    case Gradient = 'gradient';
    case Transparent = 'transparent';
}
