<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Verbindungstyp für Network-Pattern.
 * EN: Connection type for network pattern.
 */
enum ConnectionType: string
{
    case Css = 'css';
    case Svg = 'svg';
}
