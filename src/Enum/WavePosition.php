<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Position der Wellen im Waves-Pattern.
 * EN: Position of waves in waves pattern.
 */
enum WavePosition: string
{
    case Top = 'top';
    case Bottom = 'bottom';
    case Both = 'both';
}
