<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Größen-Presets für PatternBackground.
 * EN: Size presets for PatternBackground.
 */
enum PatternSize: string
{
    case Hero = 'hero';
    case Section = 'section';
    case Header = 'header';
    case Footer = 'footer';
    case Card = 'card';
    case Compact = 'compact';
    case Divider = 'divider';
    case Auto = 'auto';
}
