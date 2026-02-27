<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: PageHeader-Varianten.
 * EN: PageHeader variants.
 */
enum PageHeaderVariant: string
{
    case Default = 'default';
    case Bordered = 'bordered';
    case Compact = 'compact';
}
