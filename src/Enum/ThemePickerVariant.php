<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Varianten für ThemePicker.
 * EN: Variants for ThemePicker.
 */
enum ThemePickerVariant: string
{
    case Default = 'default';
    case Compact = 'compact';
    case Inline = 'inline';
}
