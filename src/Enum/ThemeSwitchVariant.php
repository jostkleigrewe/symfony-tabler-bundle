<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Varianten für ThemeSwitch.
 * EN: Variants for ThemeSwitch.
 */
enum ThemeSwitchVariant: string
{
    case Toggle = 'toggle';
    case Tristate = 'tristate';
    case Cycle = 'cycle';
}
