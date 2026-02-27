<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Trend-Richtung für StatCard.
 * EN: Trend direction for StatCard.
 */
enum StatCardTrend: string
{
    case Up = 'up';
    case Down = 'down';
}
