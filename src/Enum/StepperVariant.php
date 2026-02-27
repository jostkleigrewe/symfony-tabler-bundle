<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Varianten für Stepper.
 * EN: Variants for Stepper.
 */
enum StepperVariant: string
{
    case Default = 'default';
    case Compact = 'compact';
    case Horizontal = 'horizontal';
}
