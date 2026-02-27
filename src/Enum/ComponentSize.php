<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Standard-Größen für Komponenten (sm/md/lg).
 * EN: Standard sizes for components (sm/md/lg).
 */
enum ComponentSize: string
{
    case Sm = 'sm';
    case Md = 'md';
    case Lg = 'lg';
}
