<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Varianten für FeatureCard.
 * EN: Variants for FeatureCard.
 */
enum FeatureCardVariant: string
{
    case Default = 'default';
    case Highlight = 'highlight';
    case Minimal = 'minimal';
    case Horizontal = 'horizontal';
}
